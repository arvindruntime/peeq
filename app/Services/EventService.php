<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\EventActivity;
use Illuminate\Support\Facades\Auth;

class EventService
{
    public static function createUpdate($event, $request)
    {
        if (isset($request->user_id)) {
            $event->user_id = $request->user_id;
        } else {
            $event->user_id = Auth::user()->id;
        }
        if (isset($request->event_title)) {
            $event->event_title = $request->event_title;
        }
        if (isset($request->is_also_post_in_feed)) {
            $event->is_also_post_in_feed = (int)$request->is_also_post_in_feed;
        }
        if (isset($request->start_date)) {
            $event->start_date = $request->start_date;
        }
        if (isset($request->end_date)) {
            $event->end_date = $request->end_date;
        }
        if (isset($request->timezone_id)) {
            $event->timezone_id = $request->timezone_id;
        }
        if (isset($request->meeting_id)) {
            $event->meeting_id = $request->meeting_id;
        }
        if (isset($request->meeting_start_url)) {
            $event->meeting_start_url = $request->meeting_start_url;
        }
        if (isset($request->meeting_join_url)) {
            $event->meeting_join_url = $request->meeting_join_url;
        }
        if (isset($request->coaches)) {
            $event->coaches = $request->coaches;
        }
        if (isset($request->is_repeat_event)) {
            $event->is_repeat_event = (int)$request->is_repeat_event;
        }
        if (isset($request->is_rsvps)) {
            $event->is_rsvps = (int)$request->is_rsvps;
        }
        if (isset($request->is_restrick_event_link)) {
            $event->is_restrick_event_link = (int)$request->is_restrick_event_link;
        }
        if (isset($request->is_close_rsvps)) {
            $event->is_close_rsvps = (int)$request->is_close_rsvps;
        }    
        if (isset($request->is_header_image_or_video)) {
            $event->is_header_image_or_video = (int)$request->is_header_image_or_video;
        }

        /* header image or video upload */
        if (isset($request->upload_header_image_or_video)) {
            $imageOrVideoName = md5(time()) . '.' . $request->upload_header_image_or_video->extension();
            $request->upload_header_image_or_video->storeAs('public/event/headerImageOrVideo', $imageOrVideoName);
            $input['imageOrVideo'] = $imageOrVideoName;
            $event->upload_header_image_or_video = asset('/storage/event/headerImageOrVideo/'.$input['imageOrVideo']);
            $event->upload_header_image_or_video = $event->upload_header_image_or_video;
        }

        if (isset($request->is_thumbnail_image)) {
            $event->is_thumbnail_image = (int)$request->is_thumbnail_image;
        }

        /* upload thumbnail */
        if (isset($request->upload_thumbnail)) {
            $thumbnailName = md5(time()) . '.' . $request->upload_thumbnail->extension();
            $request->upload_thumbnail->storeAs('public/event/thumbnail', $thumbnailName);
            $input['thumbnail'] = $thumbnailName;
            $event->upload_thumbnail = asset('/storage/event/thumbnail/'.$input['thumbnail']);
            $event->upload_thumbnail = $event->upload_thumbnail;
        }

        if (isset($request->is_description)) {
            $event->is_description = (int)$request->is_description;
        }
        if (isset($request->description)) {
            $event->description = $request->description;
        }
        if (isset($request->is_save_to_draft)) {
            $event->is_save_to_draft = (int)$request->is_save_to_draft;
        }
        if (isset($request->schedule_type)) {
            $event->schedule_type = $request->schedule_type;
        }
        if (isset($request->schedule_datetime)) {
            $event->schedule_datetime = $request->schedule_datetime;
        } else {
            $event->schedule_datetime = Carbon::now()->format('Y-m-d H:i:s');
        }
        if (isset($request->is_featured)) {
            $event->is_featured = $request->is_featured;
        }
        $event->save();

        $eventActivity = EventActivity::where('event_id',$event->id)->where('user_id', $event->user_id)->first();
            
        if(!$eventActivity){

            $eventActivity = new EventActivity();
        }
        
        $eventActivity->event_id = $event->id;

        if (isset($request->user_id)) {
            $eventActivity->user_id = $request->user_id;
        } else {
            $eventActivity->user_id = Auth::user()->id;
        }

        if (isset($request->is_save)) {
            $eventActivity->is_save = (int)$request->is_save;
        }

        if (isset($request->is_mute)) {
            $eventActivity->is_mute = (int)$request->is_mute;
        }

        if (isset($request->download_rsvps)) {
            $eventActivity->download_rsvps = $request->download_rsvps;
        }

        if (isset($request->is_calendar)) {
            $eventActivity->is_calendar = (int)$request->is_calendar;
        }
        
        if (isset($request->is_attending)) {
            $eventActivity->is_attending = $request->is_attending;
        }

        $eventActivity->save();

        return $event;
    }
}
