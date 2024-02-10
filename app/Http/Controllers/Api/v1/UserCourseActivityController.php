<?php

namespace App\Http\Controllers\Api\v1;

use Validator;
use App\Models\CourseModule;
use Illuminate\Http\Request;
use App\Models\UserCourseActivity;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class UserCourseActivityController extends Controller
{

    public function updateStatus(Request $request)
    {
        $user = Auth::user(); // Assuming you have authentication set up

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|integer',
            'course_module_id' => 'required|integer',
            'complete_status' => 'required|in:0,1,2',
            'complete_type' => 'required|in:introduction,video_lesson,audio_recording,task,quiz,reflection_questions,reference_link,closure_video',
        ],
        [
            'course_id.required' => 'Please enter a course id',
            'course_module_id.required' => 'Please enter a course module id',
            'complete_status.required' => 'Please enter a complete status',
            'complete_type.required' => 'Please enter a complete type',
        ]);

        if($validator->fails()){
            return response()->json(
                [
                    'status' => 422,
                    'statusState' => 'error',
                    'message' => (empty($validator->errors()) ? 'Something went wrong' : $validator->errors())->first(),
                ],422
            );
        }

        $courseId = $request->input('course_id');
        $moduleType = $request->input('complete_type');
        $nextModuleType = $request->input('next_type');
        $courseImageUrl = Course::find($courseId);
        $courseCompletedUrl = $courseImageUrl->course_completed_image;

        // Find the user's course module activity record
        $userCourseActivity = UserCourseActivity::where([
            'user_id' => $user->id,
            'course_id' => $courseId,
            'course_module_id' => $request->input('course_module_id'),
        ])->first();

        if (!$userCourseActivity) {
            return response()->json([
                'status' => 404,
                'statusState' => 'error',
                'message' => 'User course module activity not found.',
            ], 404);
        }

        // Update the current module's status
        if(isset($request->complete_type)) {
            $userCourseActivity->{$moduleType} = $request->input('complete_status');
            if ($moduleType === 'closure_video') {
                // Update mark_as_complete to 1
                // $userCourseActivity->mark_as_complete = 1;
            }
        }

        // Update the next module's status
        // if(isset($request->next_type)) {
        //     $userCourseActivity->{$nextModuleType} = $request->input('next_status');
        // }

        if(isset($request->next_type) && $userCourseActivity->{$moduleType} == 2) {
            if($userCourseActivity->{$nextModuleType} == 2) {
                $userCourseActivity->{$nextModuleType} = 2;
            } else {
                $userCourseActivity->{$nextModuleType} = $request->input('next_status');
            }
        }


        if($userCourseActivity->mark_as_complete == 2) {
            $userCourseActivity->mark_as_complete = $request->input('mark_as_complete', 2);
        } else {
            $userCourseActivity->mark_as_complete = $request->input('mark_as_complete', 1);
        }

        // $userCourseActivity->mark_as_complete = $request->input('mark_as_complete', 1);
        // Save the changes to the model
        $userCourseActivity->save();
        if($userCourseActivity->mark_as_complete == 2)
        {
            $nextStepChecking = UserCourseActivity::where('user_id', Auth::user()->id)
            ->where('course_id', $courseId)
            ->where('mark_as_complete','!=',2)->first();

            if ($nextStepChecking) {
                if($nextStepChecking->introduction == 2) {
                    $nextStepChecking->introduction = 2;
                } else {
                    $nextStepChecking->introduction = 1;
                }
                $nextStepChecking->save();
            }
        }

        // Check if all modules have mark_as_complete equal to 2 for the current course
        $allModulesCompleted = UserCourseActivity::where('course_id', $courseId)->where('user_id', Auth::user()->id)
        ->where('mark_as_complete', '!=', 2)
        ->count() === 0;

        // Set course_completed based on allModulesCompleted
        $userCourseActivity->course_completed = $allModulesCompleted ? 1 : 0;
        $userCourseActivity->save();

        $last_course_module = CourseModule::where('course_id', $request->course_id)->orderBy('id', 'desc')->first();
        if($last_course_module->id == $request->course_module_id) {
            if($request->next_type == "closure_video") {
                $button_label_flag = 1;
            } else {
                $button_label_flag = 0;
            }
            $interactive_work_book_flag = 1;
        } else {
            $button_label_flag = 0;
            $interactive_work_book_flag = 0;
        }


        $responseData = [
            'course_id' => (int)$courseId,
            'course_module_id' => (int)$userCourseActivity->course_module_id,
            'complete_status' => (int)$userCourseActivity->{$moduleType},
            'complete_type' => $moduleType,
            'next_status' => (int)$userCourseActivity->{$nextModuleType},
            'next_type' => $nextModuleType,
            'mark_as_complete' => (int)$userCourseActivity->mark_as_complete,
            'course_completed' => $userCourseActivity->course_completed,
            'course_completed_url' => $courseCompletedUrl,
            'button_label_flag' => $button_label_flag,
            'interactive_work_book_flag' => $interactive_work_book_flag,
        ];
        return response()->json([
            'status' => 200,
            'statusState' => 'success',
            'data' => $responseData,
            'message' => 'Status updated successfully.',
        ], 200);
    }

    // public function userCourseActivityCreate(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'course_id' => 'required|integer',
    //         'course_module_id' => 'required|integer',
    //     ], [
    //         'course_id.required' => 'Please enter a course id',
    //         'course_module_id.required' => 'Please enter a course module id',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 422,
    //             'statusState' => 'error',
    //             'message' => (empty($validator->errors()) ? 'Something went wrong' : $validator->errors())->first(),
    //         ], 422);
    //     }

    //     $userId = Auth::user()->id;
    //     $courseModuleId = $request->course_module_id;

    //     // Check if the user_course_activity record already exists
    //     $userCourseActivity = UserCourseActivity::where([
    //         'user_id' => $userId,
    //         'course_id' => $request->course_id,
    //         'course_module_id' => $courseModuleId,
    //     ])->first();

    //     if (!$userCourseActivity) {
    //         // If it doesn't exist, create a new record
    //         $userCourseActivity = new UserCourseActivity();
    //         $userCourseActivity->user_id = $userId;
    //         $userCourseActivity->course_id = (int)$request->course_id;
    //         $userCourseActivity->course_module_id = (int)$courseModuleId;
    //     }
    //     $userCourseActivity->save();

    //     $message = 'User course activity created or updated successfully.';
    //     return sendResponse($userCourseActivity, $message);
    // }
}
