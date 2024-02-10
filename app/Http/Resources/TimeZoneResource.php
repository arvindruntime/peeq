<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimeZoneResource extends JsonResource
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
            'timezone' => $this->timezone . ' (' . $this->gmt_offset . ' )',
            'timezone_identifier' => $this->timezone,
            'gmt_offset' => $this->gmt_offset,
        ];
    }
}
