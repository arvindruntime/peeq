<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseModuleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = Auth::user();
        $stat_array = ['introduction', 'video_lesson', 'audio_recording', 'task', 'quiz', 'reflection_questions', 'reference_link', 'closure_video'];

        $moduleTypeNames = [
            'introduction' => 'Introduction',
            'video_lesson' => 'Video Lesson',
            'audio_recording' => 'Audio Recording',
            'task' => 'Tasks',
            'quiz' => 'Quiz',
            'reflection_questions' => 'Reflection Questions',
            'reference_link' => 'Reference Links',
            'closure_video' => 'Closing Video',
        ];
        
        $user_course_module_data = UserCourseActivityResource::collection(
            $this->userCourseActivities->where('user_id', $user->id)
        );
        $module_list_array = [];
        $i = 1;
        
        // Count the completed modules
        $completedModuleCount = 0;

        foreach ($user_course_module_data as $val) {
            foreach ($stat_array as $key=>$innerData) {
                if (strcmp($innerData, $val->$innerData)) {
                    if(isset($stat_array[$key+1]))
                        $nextData = $stat_array[$key+1];
                    else
                        $nextData = null;

                    $moduleStatus = $val->$innerData;
                    $module_list_array[] = [
                        'id' => $i,
                        'type' => $innerData,
                        'status' => $moduleStatus,
                        'name' => $moduleTypeNames[$innerData],
                        'next_type' => $nextData,
                    ];
                    // Check if the module is complete (status 2)
                    if ($moduleStatus == 2) {
                        $completedModuleCount++;
                    }
                    $i++;
                }
            }
        }
        // Calculate the course_completed_progress percentage
        $totalModules = count($module_list_array);
        $courseCompleteProgress = $totalModules > 0 ? ($completedModuleCount / $totalModules) * 100 : 0;
        $roundedCourseCompleteProgress = round($courseCompleteProgress);

        return [
            'id' => $this->id,
            'course' => new CourseResource($this->course),
            'title' => $this->title,
            'thumbnail_image' => $this->thumbnail_image,
            'course_sub_module' => $module_list_array, // Include the course_sub_module data
            'course_completed_progress' => (int)$roundedCourseCompleteProgress, // Cast to integer
        ];
    }
}
