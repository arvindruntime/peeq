<?php

namespace App\Services;

use App\Models\Option;
use App\Models\PollOption;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\PostActivity;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public static function createUpdate($post, $request)
    {
        if (isset($request->user_id)) {
            $post->user_id = $request->user_id;
        } else {
            $post->user_id = Auth::user()->id;
        }
        if (isset($request->content)) {
            $post->content = $request->content;
        } 
        if (isset($request->post_type)) {
            $post->post_type = $request->post_type;
        }         
        // if (isset($request->poll_id)) {
        //     $post->poll_id = $request->poll_id;
        // } 
        if (isset($request->schedule_type)) {
            $post->schedule_type = $request->schedule_type;
        } 
        if (isset($request->schedule_datetime)) {
            $scheduleCarbonDate = Carbon::parse($request->schedule_datetime);
            $scheduleFormattedDate = $scheduleCarbonDate->format('Y-m-d H:i:s');
            $post->schedule_datetime = $scheduleFormattedDate;
        } else {
            $post->schedule_datetime = Carbon::now()->format('Y-m-d H:i:s');
        }
        if (isset($request->poll_expiration)) {
            $pollCarbonDate = Carbon::parse($request->poll_expiration);
            $expiredFormattedDate = $pollCarbonDate->format('Y-m-d H:i:s');
            $post->poll_expiration = $expiredFormattedDate;
        } else {
            $post->poll_expiration = Carbon::now()->format('Y-m-d H:i:s');
        }
        if (isset($request->timezone_id)) {
            $post->timezone_id = $request->timezone_id;
        }  else {
            $post->timezone_id = Auth::user()->timezone_id;
        }
        if (isset($request->status)) {
            $post->status = (int)$request->status;
        }
        if (isset($request->is_featured)) {
            $post->is_featured = (int)$request->is_featured;
        }
        if (isset($request->posted_by)) {
            $post->posted_by = $request->posted_by;
        } else {
            $post->posted_by = Auth::user()->id;
        }
        $post->save();

        $postActivity = PostActivity::where('post_id',$post->id)->where('user_id', $post->user_id)->first();
            
        if(!$postActivity){

            $postActivity = new PostActivity();
        }
        
        $postActivity->post_id = $post->id;
        
        if (isset($request->user_id)) {
            $postActivity->user_id = $request->user_id;
        } else {
            $postActivity->user_id = Auth::user()->id;
        }

        if (isset($request->is_like)) {
            $postActivity->is_like = (int)$request->is_like;
        }

        if (isset($request->is_save)) {
            $postActivity->is_save = (int)$request->is_save;
        }

        if (isset($request->is_mute)) {
            $postActivity->is_mute = (int)$request->is_mute;
        }

        if (isset($request->is_report)) {
            $postActivity->is_report = (int)$request->is_report;
        }

        if (isset($request->is_block_member)) {
            $postActivity->is_block_member = (int)$request->is_block_member;
        }

        if (isset($request->is_report_member)) {
            $postActivity->is_report_member = (int)$request->is_report_member;
        }
        
        if (isset($request->is_hide_post)) {
            $postActivity->is_hide_post = (int)$request->is_hide_post;
        }

        if (isset($request->report_for)) {
            $postActivity->report_for = $request->report_for;
        }

        if (isset($request->report_type)) {
            $postActivity->report_type = $request->report_type;
        }

        if (isset($request->report_description)) {
            $postActivity->report_description = $request->report_description;
        }
        
        $postActivity->save();

        if ($request->post_type == 'poll_multiple_choice') {

            $pollOption = PollOption::where('post_id',$post->id)->first();

            if(!$pollOption){

                $pollOption = new PollOption();

            }
            $pollOption->post_id = $post->id;

            if (isset($request->answer_member_id)) {
                $pollOption->answer_member_id = $request->answer_member_id;
            }

            if (isset($request->option)) {               
                $option_values = explode(',', $request->option);

                foreach ($option_values as $key => $value) { 
                    $pollOption = new PollOption();
                    $pollOption->post_id = $post->id;
                    $pollOption->option = $value;
                    $pollOption->save();
                }
            }
        }

        if ($request->post_type == 'poll_percentage') {

            $pollOption = new PollOption();

            $pollOption->post_id = $post->id;

            if (isset($request->answer_member_id)) {
                $pollOption->answer_member_id = $request->answer_member_id;
            }

            $option_values = ['Yes', 'No'];
            foreach ($option_values as $key => $value) { 
                $pollOption = new PollOption();
                $pollOption->post_id = $post->id;
                $pollOption->option = $value;
                $pollOption->save();
            }
        }

        return $post;
    }
}
