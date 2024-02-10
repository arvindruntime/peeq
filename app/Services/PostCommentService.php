<?php

namespace App\Services;

use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;

class PostCommentService
{
    public static function createUpdate($post, $postComment, $request)
    {
        if (isset($request->parent_id)) {
            $postComment->parent_id = $request->parent_id;
        }
        if (isset($request->comment_text)) {
            $postComment->comment_text = $request->comment_text;
        } 
        if (isset($request->commented_by)) {
            $postComment->commented_by = $request->commented_by;
        } else {
            $postComment->commented_by = Auth::user()->id;
        }
        $post->postComments()->save($postComment);
        return $postComment;
    }
}
