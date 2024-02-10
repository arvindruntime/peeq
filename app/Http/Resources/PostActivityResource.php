<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostActivityResource extends JsonResource
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
            'post_id' => $this->post_id,
            'is_like' =>$this->is_like,
            'is_save' =>$this->is_save,
            'is_mute' => $this->is_mute,
            'is_report' =>$this->is_report,
            'is_block_member' =>$this->is_block_member,
            'is_report_member' =>$this->is_report_member,
            'is_hide_post' =>$this->is_hide_post,
        ];
    }
}
