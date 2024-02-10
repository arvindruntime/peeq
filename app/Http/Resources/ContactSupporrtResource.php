<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactSupporrtResource extends JsonResource
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
                'email' => $this->email,
                'user_type' => $this->user_type,
                'name' => $this->name,
                'subject' => $this->subject,
                'description' => $this->description,
                'mighty_network_name' => $this->mighty_network_name,
                'attachment' => $this->attachment,
            ];
    }
}
