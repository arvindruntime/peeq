<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
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
                'course_id' => $this->course_id,
                'course_module_id' => $this->course_module_id,
                'question' => $this->question,
                'question_image' => $this->question_image,
                'question_type' => $this->question_type,
                'quiz_options' => QuizOptionResource::collection($this->quizOptions),
            ];
    }
}
