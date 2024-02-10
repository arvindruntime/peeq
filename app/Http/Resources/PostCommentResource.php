<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'comment_text' => $this->comment_text,
            'created_at' => $this->created_at->diffForHumans(),
            'commented_by' => $this->commented_by,
            'user' => new CommentedbyResource($this->whenLoaded('user')),
            'replies' => PostCommentResource::collection($this->whenLoaded('replies'))
        ];
    }
}
