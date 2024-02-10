<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCourseActivityResource extends JsonResource
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
                'user_id' => $this->user_id,
                'course_id' => $this->course_id,
                'course_module_id' => $this->course_module_id,
                'introduction' => $this->introduction,
                'video_lesson' => $this->video_lesson,
                'audio_recording_description' => $this->audio_recording_description,
                'audio_recording' => $this->audio_recording,
                'task' => $this->task,
                'quiz_description' => $this->quiz_description,
                'quiz' => $this->quiz,
                'reflection_questions' => $this->reflection_questions,
                'reference_link' => $this->reference_link,
                'closure_video' => $this->closure_video,
            ];
    }
}
