<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseMastersResource extends JsonResource
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
                'course_name' => $this->course_name,
                'description' => $this->description,
                'course_image' => $this->course_image,
                'monthly_plan_price' => $this->monthly_plan_price,
                'yearly_plan_price' => $this->yearly_plan_price,
                'status' => $this->status,
            ];
    }
}
