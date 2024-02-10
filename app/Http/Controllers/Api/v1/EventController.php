<?php

namespace App\Http\Controllers\Api\v1;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Traits\ZoomJWT;
use Illuminate\Http\Request;
use App\Models\EventActivity;
use App\Services\EventService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EventResource;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    use ZoomJWT;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;
    
    public $service;
    function __construct(EventService $EventService)
	{
		$this->service = $EventService;
	}

    /**
     * Event List API
     * @group Events
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->type;
        $now = Carbon::now();
        $userId = Auth::user()->id;
        $user = Auth::user();
    
        $eventsQuery = Event::select('events.*', DB::raw('CASE WHEN event_activities.is_save = 1 THEN 1 ELSE 0 END AS is_save'),
            DB::raw('CASE WHEN event_activities.is_mute = 1 THEN 1 ELSE 0 END AS is_mute'),
            'event_activities.download_rsvps',
            'event_activities.is_attending',
            DB::raw('CASE WHEN event_activities.is_calendar = 1 THEN 1 ELSE 0 END AS is_calendar'))
            ->leftJoin('event_activities', function ($join) use ($userId) {
                $join->on('events.id', '=', 'event_activities.event_id')
                    ->where('event_activities.user_id', '=', $userId);
            })
            ->where('is_save_to_draft', '!=', 1);
    
        // Filter events based on start and end dates
        if ($type === 'all' || $type === '') {
            // No filtering required
        } elseif ($type === 'upcoming') {
            $eventsQuery->where('end_date', '>', $now);
        } elseif ($type === 'past') {
            $eventsQuery->where('end_date', '<', $now);
        } elseif ($type === 'ongoing') {
            $eventsQuery->where('start_date', '<', $now)->where('end_date', '>=', $now);
        }

        $isCalender = $request->has('is_calendar') ? intval($request->input('is_calendar')) : null;
        if ($isCalender === 1) {

            if($user->is_admin != 1 ) {
                $eventsQuery->where(function ($query) use ($userId) {
                    $query->where('event_activities.user_id', $userId)
                    ->where('event_activities.is_calendar', 1);
                });
            } else {
                $eventsQuery->whereHas('eventActivities', function ($query) {
                    $query->where('is_calendar', 1);
                });
            }
        } 
    
        $orderDirection = 'asc';
        if ($type === 'past') {
            $orderDirection = 'desc';
        }
        $perPage = $request->query('per_page', 10);
        $eventsQuery->orderBy('start_date', $orderDirection);
        $events = $eventsQuery->paginate($perPage);
    
        $goingActivities = [];
        $userDetails = [];
    
        foreach ($events as $key => $event) {
            $event_activity = EventActivity::where('event_id', $event->id)
                ->where('is_attending', 'going')
                ->orderBy('id', 'DESC')
                ->with('user:id,first_name,last_name,user_type,profile_image')
                ->limit(3)
                ->get();
        
            $eventActivityCount = EventActivity::where('event_id', $event->id)
                ->where('is_attending', 'going')
                ->orderBy('id', 'DESC')
                ->with('user:id,first_name,last_name,user_type,profile_image')
                ->count();
        
            $goingActivities[$event->id] = $event_activity;
            $userDetails[$event->id] = $event_activity->pluck('user');
            $event->total_going = $eventActivityCount;
        }
    
        foreach ($events as $event) {
            $event->going = $goingActivities[$event->id] ?? null;
            $event->total_going = $event->total_going ?? 0;
            if (isset($userDetails[$event->id])) {
                $event->going = $userDetails[$event->id] ?? null;
            }
            $coaches = User::whereIn('id', explode(',', $event->coaches))
                ->select('id', 'first_name', 'last_name', 'profile_image')
                ->get();
            $event->coaches = $coaches;
        }
    
        EventResource::collection($events);
        $message = 'Event listed successfully.';
    
        if ($request->wantsJson()) {
            return sendResponse($events, $message);
        } else {
            if (!auth()->user()->welcome_checklist_complete==1) {
                return redirect()->route('dashboard');
            }
            if ($request->ajax()) {
                if($request->calendar==1)
                {
                    $eventsRS = [];
                    foreach ($events as $event) {
                        $eventsRS[] = [
                            'id' => $event['id'],
                            'title' => $event['event_title'],
                            'start' => $event['start_date'],
                            'end' => $event['end_date'],
                            'constraint' => $event['description']
                        ];
                    }
                    return $eventsRS;
                }
                else
                {
                    $view = view('users.event.event_xhr',compact('events'))->render();
                    return response()->json(['html'=>$view]);    
                }
            }
            return view('users.event.index', compact('events'))
                ->with('events', $events);
        }
    }

    /**
     * Add Event API
     * @group Events
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_title' => 'required|string',
            'start_date' => $request->is_save_to_draft == 0 ? 'required|date|after_or_equal:today' : 'nullable|date',
            'end_date' => $request->is_save_to_draft == 0 ? 'required_with:start_date|after:start_date' : 'nullable|date',
            'meeting_join_url' => 'required|url|regex:/^https:\/\/(?:[a-zA-Z0-9-]+\.)*zoom\.us/',
            'is_save_to_draft' => 'nullable|boolean',
        ],[
            'event_title.required' => 'Please enter the event title',
            'start_date.required' => 'Please select the start date',
            'start_date.date' => 'The start date must be a valid date',
            'start_date.after_or_equal' => 'The start date must be today or a future date',
            'end_date.required_with' => 'The end date is required when the start date is specified',
            'end_date.date' => 'The end date must be a valid date',
            'end_date.after' => 'The end date must be greater than the start date',
            'meeting_join_url.required' => 'Please provide a valid Zoom link',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'statusState' => 'error',
                'message' => $validator->errors()->first() ?? 'Something went wrong',
            ], 422);
        }

        $data = $validator->validated();
        $path = 'users/me/meetings';

        if (isset($request->is_save_to_draft) && $request->is_save_to_draft == true) {
            // Create the event without creating a Zoom meeting
            $event = EventService::createUpdate(new Event, $request);
        } else {
            $startDateConverted = convertUtcToUserTimezoneForZoom($data['start_date'],getUserTimeZone()).'Z';
            // echo $data['start_date'];
            // dd($this->toZoomTimeFormat($startDateConverted));
            $startDate = convertUtcToUserTimezone($data['start_date'],getUserTimeZone());
            $end_date = convertUtcToUserTimezone($data['end_date'],getUserTimeZone());
            $duration = calculateDurationInMinutes($startDate,$end_date);
            
            // $response = $this->zoomPost($path, [
            //     'event_title' => $data['event_title'],
            //     'type' => self::MEETING_TYPE_SCHEDULE,
            //     'start_time' => $this->toZoomTimeFormat($startDateConverted),
            //     'timezone' => getUserTimeZone(),
            //     'duration' => $duration,
            //     'agenda' => 'Meeting',
            //     'settings' => [
            //         'host_video' => false,
            //         'participant_video' => false,
            //         'waiting_room' => true,
            //     ],
            // ]);

            // if ($response) {
            //     $meetingData = json_decode($response->body(), true);

            //     // Create the event using EventService
            //     $event = EventService::createUpdate(new Event, $request);

            //     // Associate the Zoom meeting details with the event
            //     if ($event && isset($meetingData)) {
            //         $event->meeting_id = $meetingData['id'] ?? '';
            //         $event->meeting_start_url = $meetingData['start_url'] ?? '';
            //         $event->meeting_join_url = $meetingData['join_url'] ?? '';
            //         $event->save();
            //     }
            // }
            
            

            // Create the event using EventService
            $event = EventService::createUpdate(new Event, $request);
            // Associate the Zoom meeting details with the event
            if ($event) {
                // $event->meeting_id = $meetingData['id'] ?? '';
                // $event->meeting_start_url = $meetingData['start_url'] ?? '';
                // $event->meeting_join_url = $meetingData['join_url'] ?? '';
                $event->save();
            }
            
        }

        if ($event) {
            // Transform the event data using EventResource
            $event = eventResponse($event->id);
            $eventResource = new EventResource($event);

            return response()->json([
                'status' => 200,
                'statusState' => 'success',
                'data' => $eventResource,
                'message' => 'Event created successfully.',
            ], 200);
        }

        return response()->json([
            'status' => 500,
            'statusState' => 'error',
            'message' => 'Error occurred while creating the event and Zoom meeting.',
        ], 500);
    }

    /**
     * Get Event API
     * @group Events
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = Auth::user()->id;
        $event = eventResponse($id);
        
        // dd($event);
        if(!empty($event)) {
            $event = new EventResource($event);
            $message = 'Event fetched successfully.';
            return sendResponse($event, $message);
        }  
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Edit Event API
     * @group Events
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'event_title' => 'required|string',
            // 'start_date' => $request->is_save_to_draft == 0 ? 'required|date|after_or_equal:today' : 'nullable|date',
            'end_date' => $request->is_save_to_draft == 0 ? 'required_with:start_date|after:start_date' : 'nullable|date',
            'meeting_join_url' => 'required|url|regex:/^https:\/\/(?:[a-zA-Z0-9-]+\.)*zoom\.us/',
            'is_save_to_draft' => 'nullable|boolean',
        ],[
            'event_title.required' => 'Please enter the event title',
            'start_date.required' => 'Please select the start date',
            'start_date.date' => 'The start date must be a valid date',
            // 'start_date.after_or_equal' => 'The start date must be today or a future date',
            'end_date.required_with' => 'The end date is required when the start date is specified',
            'end_date.date' => 'The end date must be a valid date',
            'end_date.after' => 'The end date must be greater than the start date',
            'meeting_join_url.required' => 'Please provide a valid Zoom link',
        ]);
   
        if($validator->fails()){
            return response()->json(
                [
                    'status' => 422,
                    'statusState' => 'error',
                    'message' => (empty($validator->errors()) ? 'Something went wrong' : $validator->errors())->first(),
                ],422
            );       
        }
        $data = $validator->validated();
        $path = 'users/me/meetings';
        $event = Event::find($id);
        if(!empty($event)) 
        {
            $updateEvent = EventService::createUpdate($event, $request);
            $updateEvent->save();
                    
            // $eventDateChanged = $this->compareDates($event->start_date,$request['start_date']);
            // if($eventDateChanged===false)
            // {
            //     //// Start Zoom Link creation
            //     $startDateConverted = convertUtcToUserTimezoneForZoom($request['start_date'],getUserTimeZone()).'Z';
            //     $startDate = convertUtcToUserTimezone($request['start_date'],getUserTimeZone());
            //     $end_date = convertUtcToUserTimezone($request['end_date'],getUserTimeZone());
            //     $duration = calculateDurationInMinutes($startDate,$end_date);
                
            //     $response = $this->zoomPost($path, [
            //         'event_title' => $request['event_title'],
            //         'type' => self::MEETING_TYPE_SCHEDULE,
            //         'start_time' => $this->toZoomTimeFormat($startDateConverted),
            //         'timezone' => getUserTimeZone(),
            //         'duration' => $duration,
            //         'agenda' => 'Meeting',
            //         'settings' => [
            //             'host_video' => false,
            //             'participant_video' => false,
            //             'waiting_room' => true,
            //         ],
            //     ]);
                
                
                
            //     if ($response) {
            //         $meetingData = json_decode($response->body(), true);
                    
            //         // Update event using EventService
            //         $updateEvent = EventService::createUpdate($event, $request);
                    
            //         // dd($meetingData,$event->start_date,$request['start_date'],$eventDateChanged);
            //         // Associate the Zoom meeting details with the event
            //         if ($updateEvent && isset($meetingData)) {
            //             $updateEvent->meeting_id = $meetingData['id'] ?? '';
            //             $updateEvent->meeting_start_url = $meetingData['start_url'] ?? '';
            //             $updateEvent->meeting_join_url = $meetingData['join_url'] ?? '';
            //             $updateEvent->save();
            //         }
            //     }
        
            //     //// End Zoom Link creation
            // }
        
            $event = eventResponse($id);
            $event = new EventResource($event);
            $message = 'Event updated successfully.';
            return sendResponse($event, $message);
        }
        else
        {
            return sendError('Error Occurred');
        }
    }
    
    public function compareDates($date1, $date2)
    {
        $date1 = Carbon::parse($date1);
        $date2 = Carbon::parse($date2);

        $areDatesEqual = $date1->equalTo($date2);

        return $areDatesEqual;
    }

    /**
     * Delete Event API
     * @group Events
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = eventResponse($id);
        if(!empty($event))
        {
            $event->delete();
            $event = new EventResource($event);
            $message = 'Event deleted successfully.';
            return sendResponse($event, $message);
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Save Draft API
     * @group Events
     * @return \Illuminate\Http\Response
     */
    public function saveDraft(Request $request)
    {
        $userId = Auth::user()->id;
        $eventsQuery = Event::select('events.*',DB::raw('CASE WHEN event_activities.is_save = 1 THEN 1 ELSE 0 END AS is_save'),
                                                DB::raw('CASE WHEN event_activities.is_mute = 1 THEN 1 ELSE 0 END AS is_mute'),
                                                'event_activities.download_rsvps',
                                                'event_activities.is_attending',
                                                DB::raw('CASE WHEN event_activities.is_calendar = 1 THEN 1 ELSE 0 END AS is_calendar'),)
                                        ->leftJoin('event_activities', function($join) use ($userId) {
                                        $join->on('events.id', '=', 'event_activities.event_id')
                                        ->where('event_activities.user_id', '=', $userId);
                                        })->where('is_save_to_draft', 1);
        $perPage = $request->query('per_page', 10);
        $events = $eventsQuery->paginate($perPage);

        $goingActivities = [];
        $userDetails = [];
    
        foreach ($events as $key => $event) {
            $event_activity = EventActivity::where('event_id', $event->id)
                ->where('is_attending', 'going')
                ->orderBy('id', 'DESC')
                ->with('user:id,first_name,last_name,user_type,profile_image')
                ->limit(3)
                ->get();
        
            $eventActivityCount = EventActivity::where('event_id', $event->id)
                ->where('is_attending', 'going')
                ->orderBy('id', 'DESC')
                ->with('user:id,first_name,last_name,user_type,profile_image')
                ->count();
        
            $goingActivities[$event->id] = $event_activity;
            $userDetails[$event->id] = $event_activity->pluck('user');
            $event->total_going = $eventActivityCount;
        }
    
        foreach ($events as $event) {
            $event->going = $goingActivities[$event->id] ?? null;
            $event->total_going = $event->total_going ?? 0;
            if (isset($userDetails[$event->id])) {
                $event->going = $userDetails[$event->id] ?? null;
            }
        }
        
        $response = EventResource::collection($events);
        $message = 'Save draft listed successfully.';        
        
        if ($request->wantsJson()) {
            return sendResponse($events, $message);
        } else {
            if (!auth()->user()->welcome_checklist_complete==1) {
                return redirect()->route('dashboard');
            }
            if ($request->ajax()) {
                    $view = view('users.event.draft_event_xhr',compact('events'))->render();
                    return response()->json(['html'=>$view]);    
            }
            return view('users.event.draft_event', compact('events'))
                ->with('events', $events);
        }
        
        
    }
    
    /**
     * Rsvp List API
     * @group Events
     * @return \Illuminate\Http\Response
     */
    public function rsvpList(Request $request)
    {   
        $type = $request->type;
        $userId = Auth::user()->id;
        $perPage = $request->query('per_page', 30);

        $event_activity = EventActivity::where('event_id', $request->id)
            ->where('is_attending', $type)
            // ->where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->with('user:id,first_name,last_name,user_type,profile_image')
            ->paginate($perPage);

        $message = 'Rsvp listed successfully.';
        
        if($request->wantsJson()) {            
            return sendResponse($event_activity, $message);
        } else {
            if (!auth()->user()->welcome_checklist_complete==1) {
                return redirect()->route('dashboard');
            }
            if ($request->ajax()) {
                
                if($request->type=="going" || $request->type=="not_going")
                {
                    $view = view('users.event.member_attending_xhr',compact('event_activity'))->render();
                    return response()->json(['html'=>$view]);
                }
                else
                {
                    $view = view('users.event.member_attending_xhr',compact('event_activity'))->render();
                    return response()->json(['html'=>$view]);
                }
            }
            
            if($request->type=="going" || $request->type=="not_going")
            {
                // dd($event_activity);
                return view('users.event.member_attending_list' ,  compact('event_activity'));
            }
            else{
                return view('users.event.member_attending_list' ,  compact('event_activity'));
            }
        }
    }

    // public function memberAttending()
    // {
    //     return view('users.event.member_attending_list');
    // }

    public function eventsCalendar(Request $request)
    {
        $message = 'Event listed successfully.';
        if($request->wantsJson()) {  
            return sendResponse($message);
        } else {
            if (!auth()->user()->welcome_checklist_complete==1) {
                return redirect()->route('dashboard');
            }
            if ($request->ajax()) {
                return sendResponse($message);
                //$view = view('users.event.event_xhr',compact('events'))->render();
                //return response()->json(['html'=>$view]);
            }
            return view('users.event.event_calendar')
                ->with('events'); // Pass the paginated events to the view;
        }
    }
    
    public function eventsCreate(Request $request)
    {
        $message = 'Add Event Successfully.';
        if($request->wantsJson()) {  
            return sendResponse($message);
        } else {
            if ($request->ajax()) {
                return sendResponse($message);
                //$view = view('users.event.event_xhr',compact('events'))->render();
                //return response()->json(['html'=>$view]);
            }
            return view('users.event.create_event')
                ->with('events'); // Pass the paginated events to the view;
        }
    }
    
    /**
     * Featured Event Status Update API
     * @group Events
     * @return \Illuminate\Http\Response
     */
    public function featuredEventStatusUpdate(Request $request)
    {
        // Check if the authenticated user is an admin
        if (!auth()->user()->is_admin) {
            return response()->json([
                'status' => 403,
                'statusState' => 'error',
                'message' => 'Unauthorized. Only administrators can perform this action.'
            ], 403);
        }
        $event = Event::find($request->id);
        if(!$event)
        {
            return sendError('Error Occurred');
        }

        $event->is_featured = !$event->is_featured;
        $event->save();
        $message = $event->is_featured ? 'Event featured successfully' : 'Event unfeatured successfully';
        return sendResponse($event, $message);
    }
    
}
