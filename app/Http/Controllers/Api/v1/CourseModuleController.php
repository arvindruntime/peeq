<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Course;
use App\Models\CourseModule;
use Illuminate\Http\Request;
use App\Models\UserQuizAnswer;
use App\Models\UserCourseActivity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CourseResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CourseModuleResource;
use App\Models\ModuleOverview;
use Illuminate\Pagination\LengthAwarePaginator;

class CourseModuleController extends Controller
{
    /**
     * Course Module List API
     * @group Course Modules
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $course_id)
    {
        $course = Course::find($course_id);
        if (!$course) {
            return response()->json([
                'status' => 404,
                'statusState' => 'error',
                'message' => 'Course not found.',
            ], 404);
        }
        // $perPage = $request->query('per_page', 100);
        // $courseModules = CourseModule::where('course_id', $course_id)->paginate($perPage);
        $courseModules = CourseModule::where('course_id', $course_id)->get();
        $userId = Auth::user()->id;

        // Iterate through each course module to retrieve user activity for each module
        foreach ($courseModules as $module) {
            $userCourseActivity = UserCourseActivity::where([
                'user_id' => $userId,
                'course_id' => $course_id,
                'course_module_id' => $module->id,
            ])->first();
            $userCheckingActivity = UserCourseActivity::where('course_id', $course_id)->where('user_id',Auth::user()->id)->orderBy('id', 'asc')->get();
            $countActivityLock = 0;
            if(count($userCheckingActivity) > 0){
                $countActivityLock = 0;
            } else {
                $countActivityLock = 1;
            }
            if (!$userCourseActivity) {
                // If it doesn't exist, create a new record
                $userCourseActivity = new UserCourseActivity();
                $userCourseActivity->user_id = $userId;
                $userCourseActivity->course_id = (int)$course_id;
                $userCourseActivity->course_module_id = (int)$module->id;
                $userCourseActivity->introduction = $countActivityLock;
                // $userCourseActivity->mark_as_complete = $countActivityLock;
                $userCourseActivity->save();

                // module overview update
                ModuleOverview::where('user_id', $userId)->where('course_id', $course_id)->update(['module_overviewed' => 1]);
            }
        }
        // CourseModuleResource::collection($courseModules);

        $user = Auth::user();
        $stat_array = ['introduction', 'video_lesson', 'audio_recording', 'task', 'quiz', 'reflection_questions', 'reference_link', 'closure_video'];
        $moduleData = [];

        // Iterate through courseModules to gather data for each module
        foreach ($courseModules as $module) {
            $userCourseActivity = UserCourseActivity::where([
                'user_id' => $userId,
                'course_id' => $course_id,
                'course_module_id' => $module->id,
            ])->first();

            $userCheckingActivity = UserCourseActivity::where('course_id', $course_id)
                ->where('user_id', Auth::user()->id)
                ->orderBy('id', 'asc')
                ->get();

            $countActivityLock = count($userCheckingActivity) > 0 ? 0 : 1;

            if (!$userCourseActivity) {
                // If it doesn't exist, create a new record
                $userCourseActivity = new UserCourseActivity();
                $userCourseActivity->user_id = $userId;
                $userCourseActivity->course_id = (int)$course_id;
                $userCourseActivity->course_module_id = (int)$module->id;
                $userCourseActivity->introduction = $countActivityLock;
                // $userCourseActivity->mark_as_complete = $countActivityLock;
                $userCourseActivity->save();
            }

            $introduction = $userCourseActivity->introduction;
            $markAsComplete = $userCourseActivity->mark_as_complete;

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

            $module_list_array = [];
            $i = 1;
            $completedModuleCount = 0;


            $nextData = null; // Initialize $nextData to null

            foreach ($stat_array as $innerData) {
                $moduleFieldValue = $module->$innerData;

                if (!empty($moduleFieldValue)) {
                    if ($innerData === 'quiz') {
                        // Check if quizzes exist for the current module
                        $quizzesExist = $module->quizzes()->exists();

                        if ($quizzesExist) {
                            $user_course_activity = $userCourseActivity->$innerData;

                            // Find the index of the current module type
                            $currentTypeIndex = array_search($innerData, $stat_array);

                            // Find the index of the next non-empty module type
                            $nextTypeIndex = null;

                            for ($j = $currentTypeIndex + 1; $j < count($stat_array); $j++) {
                                if (!empty($module->{$stat_array[$j]})) {
                                    $nextTypeIndex = $j;
                                    break;
                                }
                            }

                            $nextData = ($nextTypeIndex !== null) ? $stat_array[$nextTypeIndex] : null;

                            $module_list_array[] = [
                                'id' => $i,
                                'type' => $innerData,
                                'status' => $user_course_activity,
                                'name' => $moduleTypeNames[$innerData],
                                'next_type' => $nextData,
                            ];

                            // Check if the module is complete (status 2)
                            if ($user_course_activity == 2) {
                                $completedModuleCount++;
                            }
                        }
                    } else {
                        $user_course_activity = $userCourseActivity->$innerData;

                        // Find the index of the current module type
                        $currentTypeIndex = array_search($innerData, $stat_array);

                        // Find the index of the next non-empty module type
                        $nextTypeIndex = null;

                        for ($j = $currentTypeIndex + 1; $j < count($stat_array); $j++) {

                            if (!empty($module->{$stat_array[$j]})) {
                                $nextTypeIndex = $j;
                                break;
                            }
                        }

                        $nextData = ($nextTypeIndex !== null) ? $stat_array[$nextTypeIndex] : null;
                        if(strcmp($nextData,"quiz")==0)
                        {
                            $nextData="reflection_questions";
                        }
                        $module_list_array[] = [
                            'id' => $i,
                            'type' => $innerData,
                            'status' => $user_course_activity,
                            'name' => $moduleTypeNames[$innerData],
                            'next_type' => $nextData,
                        ];

                        // Check if the module is complete (status 2)
                        if ($user_course_activity == 2) {
                            $completedModuleCount++;
                        }
                    }
                }
                $i++;
            }

            //custom code to skip quiz by kd and to check other module too
            for($k=0;$k<count($module_list_array)-1;$k++)
            {
                if(strcmp($module_list_array[$k]['next_type'],$module_list_array[$k+1]['type'])!=0)
                {
                    $module_list_array[$k]['next_type']=$module_list_array[$k+1]['type'];
                }
            }

            // Calculate the course_completed_progress percentage
            $moduleTotalSubModules = count($module_list_array);
            $courseCompleteProgress = $moduleTotalSubModules > 0 ? ($completedModuleCount / $moduleTotalSubModules) * 100 : 0;
            $roundedCourseCompleteProgress = round($courseCompleteProgress);

            $moduleData[] = [
                'id' => $module->id,
                'course' => new CourseResource($module->course),
                'title' => $module->title,
                'thumbnail_image' => $module->thumbnail_image,
                'course_sub_module' => $module_list_array,
                'course_completed_progress' => (int)$roundedCourseCompleteProgress,
                'introduction' => $introduction,
                'mark_as_complete' => $markAsComplete,
            ];
        }

        $allModulesCompleted = UserCourseActivity::where('course_id', $course_id)
                                                ->where('user_id', Auth::user()->id)
                                                ->where('mark_as_complete', '!=', 2)->count() === 0;

        $message = 'Course module listed successfully.';

        if ($request->wantsJson()) {
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = $request->query('per_page', 100);
            $items = array_slice($moduleData, ($currentPage - 1) * $perPage, $perPage);
            $moduleDataPaginated = new LengthAwarePaginator($items, count($moduleData), $perPage);
            $moduleDataPaginated->setPath($request->url());

            // Return the paginated data in the response
            return sendResponse($moduleDataPaginated, $message);
        } else {
            if (!auth()->user()->welcome_checklist_complete == 1) {
                return redirect()->route('dashboard');
            }
            if ($request->ajax()) {
                $view = view('users.course.course-intro-xhr', compact('moduleData', 'course_id'))->render();
                return response()->json(['html' => $view]);
            }
            return view('users.course.course-intro', compact('course_id', 'moduleData', 'allModulesCompleted', 'user'));
        }
    }

    /**
     * Add Update Course Module API
     * @group Course Modules
     * @return \Illuminate\Http\Response
     */
    public function addUpdate(Request $request, CourseModule $courseModule)
    {
        // Pre-save validation for required fields
        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'title' => 'required',
            'thumbnail_image' => 'required',
            'introduction' => 'required',
        ],
        [
            'course_id.required' => 'Please enter the course id',
            'title.required' => 'Please enter the course module title',
            'thumbnail_image.required' => 'Please enter the course module thumbnail',
            'introduction.required' => 'Please enter the course module introduction',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'statusState' => 'error',
                'message' => $validator->errors()->first(),
            ], 422);
        }
        $courseModuleId = $request->input('course_module_id');
        if (!$courseModuleId) {
            $courseModule = new CourseModule();
        } else {
            $courseModule = CourseModule::find($courseModuleId);
        }

        if (isset($request->course_id)) {
            $courseModule->course_id = $request->course_id;
        }
        if (isset($request->title)) {
            $courseModule->title = $request->title;
        }

        /* Upload thumbnail image */
        if (isset($request->thumbnail_image)) {
            $thumbnailName = md5(time()) . '.' . $request->thumbnail_image->extension();
            $request->thumbnail_image->storeAs('public/courseModule/thumbnailImage', $thumbnailName);
            $input['thumbnail'] = $thumbnailName;
            $courseModule->thumbnail_image = asset('/storage/courseModule/thumbnailImage/' . $input['thumbnail']);
        }

        if (isset($request->introduction)) {
            $courseModule->introduction = $request->introduction;
        }
        // $courseModule->save();

        // course-module-save validation for additional fields
        // $validator = Validator::make($request->all(), [
        //     'video_lesson' => 'required',
        //     'audio_recording' => 'nullable',
        //     'task' => 'required',
        //     'reflection_questions' => 'required',
        //     'reference_link_description' => 'required',
        //     'reference_link' => 'required',
        //     'closure_video_description' => 'nullable',
        //     'closure_video' => 'nullable',
        // ],
        // [
        //     'video_lesson.required' => 'Please select the course module video lesson',
        //     'task.required' => 'Please enter the course module task',
        //     'reflection_questions.required' => 'Please enter the course module reflection questions',
        //     'reference_link_description.required' => 'Please enter the course module reference link description',
        //     'reference_link.required' => 'Please enter the course module reference link',
        // ]);

        // if ($validator->fails()) {
        //     // Optionally, delete the partially saved CourseModule if validation fails
        //     // $courseModule->delete();

        //     return response()->json([
        //         'status' => 422,
        //         'statusState' => 'error',
        //         'message' => $validator->errors()->first(),
        //     ], 422);
        // }
        if (isset($request->video_lesson)) {
            $courseModule->video_lesson = $request->video_lesson;
        }

        if (isset($request->audio_recording_description)) {
            $courseModule->audio_recording_description = $request->audio_recording_description;
        }

        /* upload audio recording */
        if ($request->hasFile('audio_recording') && $request->file('audio_recording')->isValid()) {
            // Handle the new audio_recording upload
            $audioRecordingName = md5(time()) . '.' . $request->file('audio_recording')->extension();
            $request->file('audio_recording')->storeAs('public/courseModule/audioLesson', $audioRecordingName);
            $input['audioLesson'] = $audioRecordingName;
            $courseModule->audio_recording = asset('/storage/courseModule/audioLesson/' . $input['audioLesson']);
        } else if ($request->has('audio_recording')) {
            // Check if the "audio_recording" key exists in the request
            if ($courseModule->audio_recording) {
                // Extract the filename from the URL and remove the asset path
                $oldAudioRecordingName = basename(str_replace(asset(''), '', $courseModule->audio_recording));
                // Build the path to the old audio
                $AudioRecordingPath = public_path('storage/courseModule/audioLesson/' . $oldAudioRecordingName);

                // Check if the old audio file exists and delete it
                if (file_exists($AudioRecordingPath)) {
                    unlink($AudioRecordingPath);
                }

                // Set the "audio_recording" field to null in the database
                $courseModule->audio_recording = null;
            }

        } else if (!isset($request->audio_recording)){
            // Handle the case where the "audio_recording" key is not set in the request
        }

        if (isset($request->task)) {
            $courseModule->task = $request->task;
        }
        if (isset($request->quiz_description)) {
            $courseModule->quiz_description = $request->quiz_description;
        }
        if (isset($request->reflection_questions)) {
            $courseModule->reflection_questions = $request->reflection_questions;
        }
        if (isset($request->reference_link_description)) {
            $courseModule->reference_link_description = $request->reference_link_description;
        }
        if (isset($request->reference_title)) {
            $titleValue = $request->reference_title;
            if (is_array($titleValue)) {
                $titleData = implode(",", $titleValue);
            } else {
                $titleData = $titleValue;
            }
            $courseModule->reference_title = $titleData;
        }
        if (isset($request->reference_link)) {
            $value = $request->reference_link;
            if (is_array($value)) {
                $data = implode(",", $value);
            } else {
                $data = $value;
            }
            $courseModule->reference_link = $data;
        }
        if (isset($request->closure_video_description)) {
            $courseModule->closure_video_description = $request->closure_video_description;
        }
        /* Upload Video recording */
        // if (isset($request->closure_video)) {
        //     $closureVideoName = md5(time()) . '.' . $request->closure_video->extension();
        //     $request->closure_video->storeAs('public/courseModule/closureVideo', $closureVideoName);
        //     $input['closureVideo'] = $closureVideoName;
        //     $courseModule->closure_video = asset('/storage/courseModule/closureVideo/' . $input['closureVideo']);
        // }

        if (isset($request->closure_video)) {
            $courseModule->closure_video = $request->closure_video;
        }

        $courseModule->save();
        $userCourseActivity = UserCourseActivity::where('course_module_id',$courseModule->id)->first();
        $userCheckingActivity = UserCourseActivity::where('course_id', $courseModule->course_id)->where('user_id',Auth::user()->id)->orderBy('id', 'asc')->get();
        $countActivityLock = 0;
        if(count($userCheckingActivity) > 0){
            $countActivityLock = 0;
        } else {
            $countActivityLock = 1;
        }

        if(!$userCourseActivity){

            $userCourseActivity = new UserCourseActivity();
        }
        $userCourseActivity->user_id = Auth::user()->id;
        $userCourseActivity->course_id = $courseModule->course_id;
        $userCourseActivity->course_module_id = $courseModule->id;
        $userCourseActivity->introduction = $countActivityLock;
        $userCourseActivity->save();
        $message = 'Course module updated successfully.';
        $courseModule = new CourseModuleResource($courseModule);
        return sendResponse($courseModule, $message);
    }

    /**
     * Get Course Module API
     * @group Course Modules
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request, $token = null)
    {
        $courseModule = CourseModule::find($id);
        $userId=$request->query('user');
        $requestType = $request->query('type');
        $last_course_module = CourseModule::where('course_id', $courseModule->course_id)->orderBy('id', 'desc')->first();
        $couse_with_activity = UserCourseActivity::where('course_module_id', $courseModule->id)
                                                    ->where('user_id',$userId)
                                                    ->get();
        if($last_course_module->id == $id) {
            if($request->type == "closure_video") {
                $button_label_flag = 1;
            } else {
                $button_label_flag = 0;
            }
            $interactive_work_book_flag = 1;
        } else {
            $button_label_flag = 0;
            $interactive_work_book_flag = 0;
        }
        if (!$courseModule) {
            return response()->json([
                'status' => 404,
                'statusState' => 'error',
                'data' => [],
                'message' => 'No more course module found ! You have completed all modules.'
            ], 404);
        }

        $data = [];
      //  $userId =$request->query('user');
        $authUserId = Auth::user()->id;
        $interactiveWorkbookUrl = env('APP_URL') . '/view-interactive-workbook/' . $id . '/' . $authUserId;

        // Check the requestType and include the corresponding data
        switch ($requestType) {
            case 'introduction':
                $data['detail_data'] = $courseModule->introduction;
                $data['running_task_complate'] = isset($couse_with_activity[0]['introduction']) ? ($couse_with_activity[0]['introduction'] == 2 ? 2 : 1):1;
                $data['type'] = $requestType;
                $data['thumbnail_image'] = $courseModule->thumbnail_image;
                $data['audio_recording'] = '';
                $data['quiz_data'] = [];
                $data['reference_links'] = [];
                $data['closure_video'] = '';
                $data['button_label_flag'] = $button_label_flag;
                $data['all_question_answer_given'] = 0;
                $data['interactive_work_book_flag'] = $interactive_work_book_flag;
                $data['interactive_workbook_url'] = $interactiveWorkbookUrl;
                break;
            case 'video_lesson':
                $data['detail_data'] = $courseModule->video_lesson;
                $data['running_task_complate'] = isset($couse_with_activity[0]['video_lesson']) ? ($couse_with_activity[0]['video_lesson'] == 2 ? 2 : 1):1;
                $data['type'] = $requestType;
                $data['thumbnail_image'] = '';
                $data['audio_recording'] = '';
                $data['quiz_data'] = [];
                $data['reference_links'] = [];
                $data['closure_video'] = '';
                $data['button_label_flag'] = $button_label_flag;
                $data['all_question_answer_given'] = 0;
                $data['interactive_work_book_flag'] = $interactive_work_book_flag;
                $data['interactive_workbook_url'] = $interactiveWorkbookUrl;
                break;
            case 'audio_recording':
                $data['detail_data'] = $courseModule->audio_recording_description;
                $data['running_task_complate'] = isset($couse_with_activity[0]['audio_recording']) ? ($couse_with_activity[0]['audio_recording'] == 2 ? 2 : 1):1;
                $data['type'] = $requestType;
                $data['thumbnail_image'] = '';
                $data['audio_recording'] = $courseModule->audio_recording;
                $data['quiz_data'] = [];
                $data['reference_links'] = [];
                $data['closure_video'] = '';
                $data['button_label_flag'] = $button_label_flag;
                $data['all_question_answer_given'] = 0;
                $data['interactive_work_book_flag'] = $interactive_work_book_flag;
                $data['interactive_workbook_url'] = $interactiveWorkbookUrl;
                break;
            case 'task':
                $data['detail_data'] = $courseModule->task;
                $data['running_task_complate'] = isset($couse_with_activity[0]['task']) ? ($couse_with_activity[0]['task'] == 2 ? 2 : 1):1;
                $data['type'] = $requestType;
                $data['thumbnail_image'] = '';
                $data['audio_recording'] = '';
                $data['quiz_data'] = [];
                $data['reference_links'] = [];
                $data['closure_video'] = '';
                $data['button_label_flag'] = $button_label_flag;
                $data['all_question_answer_given'] = 0;
                $data['interactive_work_book_flag'] = $interactive_work_book_flag;
                $data['interactive_workbook_url'] = $interactiveWorkbookUrl;
                break;
                case 'quiz':
                    $quizzes = $courseModule->quiz;

                    if ($quizzes->isNotEmpty()) {
                        $quizData = [];
                        $allQuestionsAnswered = true;
                        foreach ($quizzes as $quiz) {
                            $quizOptions = $quiz->quizOptions;
                            // Fetch user-wise quiz answers
                            if($userId) {
                                $userAnswers = UserQuizAnswer::where('user_id', $userId)
                                    ->where('quiz_id', $quiz->id)
                                    ->get();
                            } else {
                                $userAnswers = UserQuizAnswer::where('user_id', Auth::user()->id)
                                    ->where('quiz_id', $quiz->id)
                                    ->get();
                            }

                            $user_answers_val = [];

                            if (!empty($userAnswers) && isset($userAnswers[0])) {
                                $user_answers_val = explode('-', $userAnswers[0]->quiz_option_id);
                            }

                            // Check if any answer is given for this question
                            $questionAnswerGiven = count($user_answers_val) > 0 ? 1 : 0;

                            if ($questionAnswerGiven === 0) {
                                $allQuestionsAnswered = false; // At least one question is not answered
                            }

                            $quizData[] = [
                                'id' => $quiz->id,
                                'course_id' => $quiz->course_id,
                                'course_module_id' => $quiz->course_module_id,
                                'question' => $quiz->question,
                                'question_image' => $quiz->question_image,
                                'question_type' => $quiz->question_type,
                                'question_answer_given' => $questionAnswerGiven,
                                'quiz_options' => $quizOptions->map(function ($option) use ($userAnswers, $user_answers_val) {
                                    $user_answers = $userAnswers->filter(function ($userAnswer) use ($option) {
                                        return in_array($option->id, explode('-', $userAnswer->quiz_option_id));
                                    })->pluck('quiz_option_id')->toArray();

                                    $isAnswered = in_array($option->id, $user_answers_val) ? 1 : 0;

                                    return [
                                        'id' => $option->id,
                                        'quiz_id' => $option->quiz_id,
                                        'option' => $option->option,
                                        'option_image' => $option->option_image,
                                        'admin_answer' => ($option->admin_answer) ? $option->id : NULL,
                                        'user_quiz_answer_id' => (in_array($option->id, $user_answers_val)) ? $option->id : NULL,
                                        'is_answered' => $isAnswered,
                                    ];
                                })->all(),
                            ];
                        }
                        $data['detail_data'] = $courseModule->quiz_description;
                        $data['running_task_complate'] = isset($couse_with_activity[0]['quiz']) ? ($couse_with_activity[0]['quiz'] == 2 ? 2 : 1) : 1;
                        $data['type'] = $requestType;
                        $data['thumbnail_image'] = '';
                        $data['audio_recording'] = '';
                        $data['quiz_data'] = $quizData;
                        $data['reference_links'] = [];
                        $data['closure_video'] = '';
                        $data['button_label_flag'] = $button_label_flag;
                        $data['all_question_answer_given'] = $allQuestionsAnswered ? 1 : 0; // Set based on allQuestionsAnswered
                        $data['interactive_work_book_flag'] = $interactive_work_book_flag;
                        $data['interactive_workbook_url'] = $interactiveWorkbookUrl;
                    } else {
                        return response()->json([
                            'status' => 404,
                            'statusState' => 'error',
                            'data' => [],
                            'message' => 'Quizzes not found for this course module.'
                        ], 404);
                    }
                    break;
            case 'reflection_questions':
                $data['detail_data'] = $courseModule->reflection_questions;
                $data['running_task_complate'] = isset($couse_with_activity[0]['reflection_questions']) ? ($couse_with_activity[0]['reflection_questions'] == 2 ? 2 : 1):1;
                $data['type'] = $requestType;
                $data['thumbnail_image'] = '';
                $data['audio_recording'] = '';
                $data['quiz_data'] = [];
                $data['reference_links'] = [];
                $data['closure_video'] = '';
                $data['button_label_flag'] = $button_label_flag;
                $data['all_question_answer_given'] = 0;
                $data['interactive_work_book_flag'] = $interactive_work_book_flag;
                $data['interactive_workbook_url'] = $interactiveWorkbookUrl;
                break;
            case 'reference_link':
                $titles = $courseModule->reference_title;
                $links = $courseModule->reference_link;
                $referenceLinks = [];

                $titleArray = explode(',', $titles);
                $linkArray = explode(',', $links);

                foreach ($linkArray as $key => $link) {
                    $referenceLinks[] = [
                        'title' => isset($titleArray[$key]) ? trim($titleArray[$key]) : trim($link),
                        'link' => trim($link),
                    ];
                }
                $data['detail_data'] = $courseModule->reference_link_description;
                $data['running_task_complate'] = isset($couse_with_activity[0]['reference_link']) ? ($couse_with_activity[0]['reference_link'] == 2 ? 2 : 1):1;
                $data['type'] = $requestType;
                $data['thumbnail_image'] = '';
                $data['audio_recording'] = '';
                $data['quiz_data'] = [];
                $data['reference_links'] = $referenceLinks;
                $data['closure_video'] = '';
                $data['button_label_flag'] = $button_label_flag;
                $data['all_question_answer_given'] = 0;
                $data['interactive_work_book_flag'] = $interactive_work_book_flag;
                $data['interactive_workbook_url'] = $interactiveWorkbookUrl;
                break;
            case 'closure_video':
                $data['detail_data'] = $courseModule->closure_video;
                $data['running_task_complate'] = isset($couse_with_activity[0]['closure_video']) ? ($couse_with_activity[0]['closure_video'] == 2 ? 2 : 1):1;
                $data['type'] = $requestType;
                $data['thumbnail_image'] = '';
                $data['audio_recording'] = '';
                $data['quiz_data'] = [];
                $data['reference_links'] = [];
                $data['closure_video'] = '';
                $data['button_label_flag'] = $button_label_flag;
                $data['all_question_answer_given'] = 0;
                $data['interactive_work_book_flag'] = $interactive_work_book_flag;
                $data['interactive_workbook_url'] = $interactiveWorkbookUrl;
                break;
            default:
                return response()->json([
                    'status' => 400,
                    'statusState' => 'error',
                    'data' => [],
                    'message' => 'Invalid request type.'
                ], 400);
        }

        $message = 'Course module fetched successfully.';

        return response()->json([
            'status' => 200,
            'statusState' => 'success',
            'data' => $data,
            'message' => $message,
        ], 200);
    }

    /**
     * Detail Course Module API
     * @group Course Modules
     * @return \Illuminate\Http\Response
     */
    public function showModuleDetail($id)
    {
        $courseModule = CourseModule::find($id);
        if(!empty($courseModule)) {
            $courseModule = [
                'id' => $courseModule->id,
                'course_id' => $courseModule->course_id,
                'title' => $courseModule->title,
                'thumbnail_image' => $courseModule->thumbnail_image,
                'introduction' => $courseModule->introduction,
                'video_lesson' => $courseModule->video_lesson,
                'audio_recording_description' => $courseModule->audio_recording_description,
                'audio_recording' => $courseModule->audio_recording,
                'task' => $courseModule->task,
                'quiz_description' => $courseModule->quiz_description,
                'reflection_questions' => $courseModule->reflection_questions,
                'reference_link_description' => $courseModule->reference_link_description,
                'reference_title' => $courseModule->reference_title,
                'reference_link' => $courseModule->reference_link,
                'closure_video_description' => $courseModule->closure_video_description,
                'closure_video' => $courseModule->closure_video,

            ];
            return sendResponse($courseModule, 'Show course module details successfully.');
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Delete Course Module API
     * @group Course Modules
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $courseModule = CourseModule::find($id);
        if(!empty($courseModule))
        {
            $courseModule->delete();
            $courseModule = new CourseModuleResource($courseModule);
            $message = 'Course module deleted successfully.';
            return sendResponse($courseModule, $message);
        }
        else
        {
            return sendError('Error Occurred');
        }
    }
}
