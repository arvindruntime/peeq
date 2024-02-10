<?php

namespace App\Http\Controllers\Api\v1;

use Mail;
use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Mail\EventGoingEmail;
use App\Models\EventActivity;
// use Illuminate\Support\Facades\Mail;
use App\Models\PushNotification;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EventResource;
use Illuminate\Support\Facades\Validator;

class EventActivityController extends Controller
{
    /**
     * Event Activity Action API
     * @group Event Activities
     * @return \Illuminate\Http\Response
     */
    public function eventActivityAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_id' => 'required|exists:events,id',
            'is_attending' => 'nullable|in:going,maybe,not_going',
        ],
        [
            'event_id.required' => 'Please enter the event id',
            'event_id.exists' => 'The selected event id is invalid',
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
        $eventActivity = EventActivity::where('event_id',$request->event_id)
                                        ->where('user_id', Auth::user()->id)
                                        ->first();
        $event = Event::where('id',$request->event_id)->first();
        
        if(!$eventActivity){

            $eventActivity = new EventActivity();
        }
        
        $message = ''; // Initialize the $message variable
        
        $eventActivity->event_id = (int)$request->event_id;
        
        if (isset($request->user_id)) {
            $eventActivity->user_id = $request->user_id;
        } else {
            $eventActivity->user_id = Auth::user()->id;
        } 
            
        if (isset($request->is_save)) {
            $eventActivity->is_save = (int)$request->is_save;
            $message = $eventActivity->is_save ? 'Event saved successfully.' : 'Event unsaved successfully.';
        }

        if (isset($request->is_mute)) {
            $eventActivity->is_mute = (int)$request->is_mute;
            $message = $eventActivity->is_mute ? 'Event mute successfully.' : 'Event unmute successfully.';
        }

        if (isset($request->download_rsvps)) {
            $eventActivity->download_rsvps = $request->download_rsvps;
            $message = 'Download RSVPs successfully.';
        }

        // if (isset($request->is_calendar)) {
        //     $eventActivity->is_calendar = (int)$request->is_calendar;
        //     $message = 'Event add to calender successfully.';
        // }

        if (isset($request->is_attending)) {
            $eventActivity->is_attending = $request->is_attending;
        
            $message = '';
            switch ($request->is_attending) {
                case 'going':
                    $eventActivity->is_calendar = 1;
                    $message = 'Event attendance status set to "going".';
                    
                    // Check if the user has set their email notification switch on
                    if (isset($request->is_attending) && in_array('4', explode(',', Auth::user()->notification_setting))) {
                        $goingUser = Auth::user();
                        if (isset($goingUser->email)) {
                            $goingUserName = $goingUser->first_name;
                            $zoomJoinLink = $event->meeting_join_url;
                            $startDateFormat = convertUtcToUserTimezone($event->start_date, getUserTimeZone());
                            $endDateFormat = convertUtcToUserTimezone($event->end_date, getUserTimeZone());
                            
                            $dateString = $event->start_date;
                            $date = Carbon::parse($dateString);
                            $startDate = $date->format('Ymd\THis\Z');
                            
                            $dateString = $event->end_date;
                            $date = Carbon::parse($dateString);
                            $endDate = $date->format('Ymd\THis\Z');

                            $eventTitle = $event->event_title;
                            $eventDescription = 'Join Zoom: ' . $event->meeting_join_url;
                            $zoomJoinLink = $event->meeting_join_url;
                            try {
                                    Mail::to($goingUser->email)->send(new EventGoingEmail($goingUserName, $zoomJoinLink, $startDateFormat, $endDateFormat, $startDate, $endDate, $eventTitle, $eventDescription));
                            } catch (\Exception $e) {
                                // Log the email sending error for debugging purposes
                                Log::error('Error sending going in event email');
                                Log::error('Error message: ' . $e->getMessage());
                            }
                        }
                    }
                    break;
                case 'maybe':
                    $eventActivity->is_calendar = 0;
                    $message = 'Event attendance status set to "maybe".';
                    break;
                case 'not_going':
                    $eventActivity->is_calendar = 0;
                    $message = 'Event attendance status set to "not going".';
                    break;
            }
        }

        $eventActivity->save();
        $event = eventResponse($request->event_id);
        $event = new EventResource($event);
        return sendResponse($event, $message);
        
    }
}
