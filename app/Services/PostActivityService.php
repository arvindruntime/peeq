<?php

namespace App\Services;

use App\Models\PostActivity;
use Illuminate\Support\Facades\Auth;

class PostActivityService
{
    public static function createUpdate($postActivity, $request)
    {
        if (isset($request->user_id)) {
            $postActivity->user_id = $request->user_id;
        } else {
            $postActivity->user_id = Auth::user()->id;
        }
        if (isset($request->post_id)) {
            $postActivity->post_id = $request->post_id;
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

        return $postActivity;
    }
}
