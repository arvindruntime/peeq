<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InteractiveWorkbookResource extends JsonResource
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
                'page_no' => $this->page_no,
                'pdf_content' => $this->pdf_content,
                'interactive_content' => $this->interactive_content,
                'audio_file' => $this->audio_file,
                'start_page' => $this->start_page,
                'end_page' => $this->end_page,
                'status' => $this->status,
            ];
    }
}
