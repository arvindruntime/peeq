<?php

namespace App\Http\Resources;

use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $startDateTime = Carbon::parse($this->start_date);
        $endDateTime = Carbon::parse($this->end_date);

        // Calculate the total minutes between the two dates
        $totalMinutes = $startDateTime->diffInMinutes($endDateTime);

        // Check if the duration is less than one hour
        if ($totalMinutes < 60) {
            // Format the duration as "minutes"
            $durationFormatted = "{$totalMinutes} minutes";
        } else {
            // Calculate the duration in hours and minutes
            $durationInHours = floor($totalMinutes / 60); 
            $durationInMinutes = $totalMinutes % 60;      

            // Format the duration as "hours hours minutes minutes"
            $durationFormatted = "{$durationInHours} hours {$durationInMinutes} minutes";
        }

        // Get the current date and time
        $currentDateTime = Carbon::now();

        // Check the status
        if ($currentDateTime < $startDateTime) {
            $eventStatus = 'Upcoming';
        } elseif ($currentDateTime >= $startDateTime && $currentDateTime <= $endDateTime) {
            $eventStatus = 'Ongoing';
        } else {
            $eventStatus = 'Finished';
        }

        // Check if the user is an admin
        $isAdmin = Auth::user()->is_admin;
        
        $zoomData = [
            'meeting_id' => $this->meeting_id,
            'meeting_join_url' => $this->meeting_join_url,
            'meeting_password' => $this->extractPassword($this->meeting_join_url),
        ];
    
        if ($isAdmin == 1) {
            // removed meeting start url key replace the meeting join url 
            $zoomData['meeting_join_url'] = $this->meeting_start_url;
        }

        return
            [
                'id' => $this->id,
                'user' => new UserInfoResource($this->user),
                'event_title' => $this->event_title,
                'is_also_post_in_feed' => $this->is_also_post_in_feed,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'event_date_time' => Carbon::parse($this->start_date)->format('j-M-Y G:i'),
                'event_date_time_web' => getDateTimeFormat($this->start_date),
                'event_duration' => $durationFormatted,
                'event_status' => $eventStatus,
                'timezone' => new TimeZoneResource($this->timezone),
                'is_repeat_event' => $this->is_repeat_event,
                'zoom' => $zoomData,
                'is_rsvps' => $this->is_rsvps,
                'is_restrick_event_link' => $this->is_restrick_event_link,
                'is_close_rsvps' => $this->is_close_rsvps,
                'is_header_image_or_video' => $this->is_header_image_or_video,
                'upload_header_image_or_video' => $this->upload_header_image_or_video,
                'is_thumbnail_image' => $this->is_thumbnail_image,
                'upload_thumbnail' => $this->upload_thumbnail,
                'is_description' => $this->is_description,
                'description' => $this->description,
                'is_save_to_draft' => $this->is_save_to_draft,
                'schedule_type' => $this->schedule_type,
                'schedule_datetime' => $this->schedule_datetime,
                'is_featured' => $this->is_featured,
                'created_at' => $this->created_at->diffForHumans(),
                'is_save' => $this->is_save,
                'is_mute' => $this->is_mute,
                'download_rsvps' => $this->download_rsvps,
                'is_calendar' => $this->is_calendar,
                'is_attending' => $this->is_attending,
                'total_going' => $this->total_going,
                'going' => $this->going,
                'coaches' => $this->coaches,
                'meeting_join_url_edit' => $this->meeting_join_url,
            ];
    }

    private function extractPassword($meetingJoinUrl)
    {
        $parsedUrl = parse_url($meetingJoinUrl);
        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
            if (isset($queryParams['pwd'])) {
                return $queryParams['pwd'];
            }
        }
        return null;
    }
}
