<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
            [
                'id' => $this->id,
                'content' => $this->content,
                'post_type' => $this->post_type,
                // 'poll_id' => $this->poll_id,
                'schedule_type' => $this->schedule_type,
                'schedule_datetime' => $this->schedule_datetime,
                'poll_expiration' => $this->poll_expiration,
                'timezone_id' => $this->timezone_id,  
                'status' => $this->status,
                'is_featured' => $this->is_featured,
                'posted_by' => $this->posted_by,
                'created_at' => $this->created_at->diffForHumans(),
                'is_like' => $this->is_like,
                'is_save' => $this->is_save,
                'is_mute' => $this->is_mute,
                'is_report' => $this->is_report,
                'is_block_member' => $this->is_block_member,
                'is_report_member' => $this->is_report_member,
                'is_hide_post' => $this->is_hide_post,
                'user' => new UserResource($this->whenLoaded('user')),
                'post_activity' => new PostActivityResource($this->whenLoaded('postActivities')),
                'count_is_like' => $this->count_is_like,
                'count_comments' => $this->count_comments,
            ];
    }
}
