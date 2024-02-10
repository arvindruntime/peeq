<?php

namespace App\Http\Controllers\Api\v1;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Event;
use App\Models\Course;
use App\Models\PollOption;
use App\Models\PostComment;
use App\Models\CourseModule;
use App\Models\PostActivity;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Models\EventActivity;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EventResource;
use App\Http\Resources\UserInfoResource;

class FeaturedController extends Controller
{
    public function featuredApi(Request $request)
    {
        /** Featured Course */
        $isAdmin = Auth::user()->is_admin;
        $user = $request->user();

        $coursesQuery = Course::orderBy('created_at', 'desc');

        if (!$isAdmin) {
            // If not an admin, only show public courses by default
            $coursesQuery->where('status', 'public');
        }

        $type = $request->input('type', 'all');
        
        if ($type === 'purchased' && $user) {
            // If type is 'purchased' and user is authenticated, filter purchased courses
            $coursesQuery->whereHas('transactions', function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->where('payment_status', 1);
            });
        }
        $coursesQuery->where('is_featured', 1);
        $courses = $coursesQuery->get();
        $message = 'Courses listed successfully.';

        // Transform the courses data without using a resource
        $courses->transform(function ($course) use ($request) {
            $coaches = User::whereIn('id', explode(',', $course->coaches))
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();

            $courseModules = CourseModule::where('course_id', $course->id)->get();
            $courseModuleTitles = $courseModules->pluck('title');
            $user = $request->user();

            // Check if the user is authenticated before accessing purchase course details
            $purchaseCourse = null;
            if ($user) {
                $purchaseCourse = $user->purchaseCourse()
                                       ->where('course_id', $course->id)
                                       ->orderBy('created_at', 'desc')
                                       ->first();
            }
            $currencyCode = $course->currency ? $course->currency->code : 'AUD';

            return [
                'id' => $course->id,
                'course_thumbnail' => $course->course_thumbnail,
                'course_preview_video' => $course->course_preview_video,
                'course_name' => $course->course_name,
                'course_tagline' => $course->course_tagline,
                'coaches' => UserInfoResource::collection($coaches),
                'description' => $course->description,
                'module_overview_description' => $course->module_overview_description,
                'course_price_type' => $course->course_price_type ?? 'free',
                'course_price' => $course->course_price ?? 0.0,
                'is_featured' => $course->is_featured,
                'member_add_reviews_on_this' => $course->member_add_reviews_on_this ?? 1,
                'upload_pdf' => $course->upload_pdf,
                'currency' => $currencyCode,
                'stripe_subscription_course_id' => $course->stripe_subscription_course_id,
                'google_pay_id' => $course->google_pay_id,
                'apple_pay_id' => $course->apple_pay_id,
                'status' => $course->status ?? 'private',
                'last_updated' => $course->updated_at ? $course->updated_at->format('M j, Y') : null,
                'course_material' => [
                    'total_modules' => $courseModules->count(),
                    'modules' => $courseModuleTitles->map(function ($title) {
                        return ['title' => $title];
                    }),
                ],
                'course_purchase_status' => $purchaseCourse ? $purchaseCourse->payment_status : 0,
            ];
        });

        /** Featured Events */
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

        $eventsQuery->where('is_featured', 1);

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
        $events = $eventsQuery->orderBy('start_date', $orderDirection)->get();
    
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
    
        $events = EventResource::collection($events);

        return sendResponse(compact('courses', 'events'), 'Featured listing successfully.');
        
        
        if ($request->wantsJson()) {
            return sendResponse(compact('courses', 'events'), 'Featured listing successfully.');
        } else {
            if (!auth()->user()->welcome_checklist_complete==1) {
                return redirect()->route('dashboard');
            }
            if ($request->ajax()) {
                $view = view('users.post.featured_xhr',compact('courses', 'events'), 'Featured listing successfully.')->render();
                return response()->json(['html'=>$view]);    
                
            }
            //return view('users.post.index', compact('courses', 'events'), 'Featured listing successfully.');
        }
    }
}
