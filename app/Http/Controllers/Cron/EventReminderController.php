<?php
namespace App\Http\Controllers\Cron;
use Exception;
use Carbon\Carbon;
// use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\EventActivity;
use App\Mail\EventReminderEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\EventResource;
use App\Mail\EventReminderBeforeOneDay;
use App\Mail\ReminderEventMail;

class EventReminderController extends Controller
{
    public function eventReminderOneHourBefore()
    {
        $now = Carbon::now();
        $oneHourLater = $now->copy()->addHour();
        
        $events = Event::where('start_date', '>=', $now)
        ->where('start_date', '<', $oneHourLater)
        ->get();

        foreach ($events as $event) {

            $recipients = $event->eventActivities()
                                ->where('is_attending', 'going')
                                ->whereNull('mail_send_before_hour')
                                ->pluck('user_id')
                                ->map(function ($userId) {
                                    $user = User::find($userId);
                                    return [
                                        'first_name' =>$user->first_name,
                                        'email' => $user->email,
                                        'timezone' => $user->timezone ? $user->timezone->timezone : null,
                                    ];
                                })
                                ->toArray();
                
            if (count($recipients) > 0) {
                $eventTitle = $event->event_title;
                
                foreach ($recipients as $recipient) {
                    
                    $userName = $recipient['first_name'];
                    $userTimezone = $recipient['timezone'] ?? 'UTC';
                    $startDateFormat = convertUtcToUserTimezone($event->start_date, $userTimezone);
                    $endDateFormat = convertUtcToUserTimezone($event->end_date, $userTimezone);

                    $dateString = $event->start_date;
                    $date = Carbon::parse($dateString);
                    $startDate = $date->format('Ymd\THis\Z');
                    
                    $dateString = $event->end_date;
                    $date = Carbon::parse($dateString);
                    $endDate = $date->format('Ymd\THis\Z');

                    $eventDescription = 'Join Zoom: ' . $event->meeting_join_url;
                    $webSiteUrl = env('APP_URL');
                    $zoomJoinLink = $event->meeting_join_url;
                
                    try {
                        Mail::to($recipient['email'])->send(new ReminderEventMail($eventTitle, $userName, $startDateFormat, $endDateFormat, $startDate, $endDate, $eventDescription, $webSiteUrl, $zoomJoinLink));
                        // Log successful email sending
                        Log::info('Event reminder 1 hour before email sent successfully to ' . $recipient['email']);

                        // Update the event activity entry to indicate that the reminder email has been sent one day before
                        $event->eventActivities()->where('user_id', User::where('email', $recipient['email'])->first()->id)->update(['mail_send_before_hour' => 1]);

                    } catch (Exception $e) {
                        Log::error('Error sending event reminder 1 hour before event start email');
                        Log::error('Error message: ' . $e->getMessage());
                    }
                }
            }
        }
    }

    public function eventReminderOneDayBefore()
    {
        $now = Carbon::now();
        $tomorrow = $now->copy()->addDay();
        $events = Event::where('start_date', '>=', $now)
                        ->where('start_date', '<', $tomorrow)
                        ->get();
        // $events = Event::whereDate('start_date', $tomorrow)->get();

        foreach ($events as $event) {

            $recipients = $event->eventActivities()
                                ->where('is_attending', 'going')
                                ->whereNull('mail_send_before_day')
                                ->pluck('user_id')
                                ->map(function ($userId) {
                                    $user = User::find($userId);
                                    return [
                                        'first_name' =>$user->first_name,
                                        'email' => $user->email,
                                        'timezone' => $user->timezone ? $user->timezone->timezone : null,
                                    ];
                                })
                                ->toArray();
            
            if (count($recipients) > 0) {
                $eventTitle = $event->event_title;

                foreach ($recipients as $recipient) {

                    $userName = $recipient['first_name'];
                    $userTimezone = $recipient['timezone'] ?? 'UTC';
                    $startDateFormat = convertUtcToUserTimezone($event->start_date, $userTimezone);
                    $endDateFormat = convertUtcToUserTimezone($event->end_date, $userTimezone);

                    $dateString = $event->start_date;
                    $date = Carbon::parse($dateString);
                    $startDate = $date->format('Ymd\THis\Z');
                    
                    $dateString = $event->end_date;
                    $date = Carbon::parse($dateString);
                    $endDate = $date->format('Ymd\THis\Z');

                    $eventDescription = 'Join Zoom: ' . $event->meeting_join_url;
                    $webSiteUrl = env('APP_URL');
                    $zoomJoinLink = $event->meeting_join_url;
                
                    try {
                        Mail::to($recipient['email'])->send(new EventReminderBeforeOneDay($eventTitle, $userName, $startDateFormat, $endDateFormat, $startDate, $endDate, $eventDescription, $webSiteUrl, $zoomJoinLink));
                        // Log successful email sending
                        Log::info('Event reminder 1 day before email sent successfully to ' . $recipient['email']);

                        // Update the event activity entry to indicate that the reminder email has been sent one day before
                        $event->eventActivities()->where('user_id', User::where('email', $recipient['email'])->first()->id)->update(['mail_send_before_day' => 1]);

                    } catch (Exception $e) {
                        Log::error('Error sending event reminder 1 day before event start email');
                        Log::error('Error message: ' . $e->getMessage());
                    }
                }
            }
        }
    }
}
