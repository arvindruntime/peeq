<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentedbyResource extends JsonResource
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
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'user_type' => $this->user_type,
                'profile_image' => $this->profile_image,
                'cover_image' => $this->cover_image,
                'profile_image_url' => $this->profile_image_url,
                'cover_image_url' => $this->cover_image_url,
            ];
    }
}
