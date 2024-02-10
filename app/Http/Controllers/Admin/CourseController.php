<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Course;
use App\Models\CourseModule;
use Illuminate\Http\Request;
use App\Models\UserCourseActivity;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuizResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserInfoResource;
use App\Http\Resources\CourseModuleResource;

class CourseController extends Controller
{
    public function index()
    {
        return view('admin.course.index');
    }

    public function create()
    {
        return view('admin.course.create');
    }

    public function courseList()
    {
        return view('admin.course.course-list');
    }
    public function courseInner($id){
        // $id = request()->route('id');
        $course = Course::find($id);
        if (!$course) {
            return redirect()->route('admin.course.index')->with('error', 'Course not found.');
        }
        $courseModules = CourseModule::where('course_id', $id)->get();

        return view('admin.course.course-inner', compact('course', 'courseModules', 'id'));
    }
    
    public function quizInner(Request $request, CourseModule $courseModule){
        
        $quizzes = $courseModule->quizzes->load('quizOptions');
        // $course = Course::all();
        $course = "";
        if(isset($quizzes[0]))
        {
            $course = $quizzes[0]->course;
        }
            // if (!empty($quizzes)) {
            //     $quizResources = QuizResource::collection($quizzes);
            //     return sendResponse($quizResources, 'Quizzes fetched successfully.');
            // }

        
        return view('admin.course.quiz-inner', compact('quizzes', 'course', 'courseModule'));
    }
    public function courseAdd($id){
        // $id = request()->route('id');
        return view('admin.course.course-module-add',  compact('id'));
    }
    public function courseModuleEdit($courseModuleId){
        $courseModule = CourseModule::find($courseModuleId);
        // $id = request()->route('id');
        return view('admin.course.course-module-edit',  compact('courseModule'));
    }
    public function courseModuleUpdate($id,Request $request)
    {
        $courseModule = CourseModule::find($id);
        if (isset($request->title)) {
            $courseModule->title = $request->title;
        }

        if (isset($request->thumbnail_image)) {
            $thumbnailName = md5(time()) . '.' . $request->thumbnail_image->extension();
            $request->thumbnail_image->storeAs('public/courseModule/thumbnailImage', $thumbnailName);
            $input['thumbnail'] = $thumbnailName;
            $courseModule->thumbnail_image = asset('/storage/courseModule/thumbnailImage/' . $input['thumbnail']);
        }

        if (isset($request->introduction)) {
            $courseModule->introduction = $request->introduction;
        }
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
            $value = $request->reference_title;
            if (is_array($value)) {
                $data = implode(",", $value);
            } else {
                $data = $value;
            }
            $courseModule->reference_title = $data;
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
        /* Upload video recording */
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
        // $userCourseActivity = UserCourseActivity::where('course_module_id',$id)->first();
        // $userCheckingActivity = UserCourseActivity::where('course_id', $courseModule->course_id)->where('user_id',Auth::user()->id)->orderBy('id', 'asc')->get();
        // $countActivityLock = 0;
        // if(count($userCheckingActivity) > 0){
        //     $countActivityLock = 0;
        // } else {
        //     $countActivityLock = 1;
        // }
            
        // if(!$userCourseActivity){

        //     $userCourseActivity = new UserCourseActivity();
        // }
        // $userCourseActivity->user_id = Auth::user()->id;
        // $userCourseActivity->course_id = $courseModule->course_id;
        // $userCourseActivity->course_module_id = $courseModule->id;
        // $userCourseActivity->introduction = $countActivityLock;
        // $userCourseActivity->save();
        $message = 'Course module updated successfully.';
        $courseModule = new CourseModuleResource($courseModule);
        return sendResponse($courseModule, $message);
    }

    public function courseOverview($id)
    {
        $courseModule = CourseModule::find($id);
        $course = Course::find($courseModule->course_id);
        $course_id = $courseModule->Course_id;

        return view('admin.course.course-overview', compact('course_id', 'course', 'courseModule'));
    }
    public function courseModulesetting(){
        return view('admin.course.course-modulesetting');
    }
    public function courseAddview(){
        return view('admin.course.course-addview');
    }
    public function courseSetting(){
        return view('admin.course.course-setting');
    }
    public function courseEdit(Request $request, $id){
        $course = Course::find($id);
        if (!empty($course)) {
            $coaches = User::whereIn('id', explode(',', $course->coaches))
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();

            $courseModules = CourseModule::where('course_id', $course->id)->get();
            $courseModuleTitles = $courseModules->pluck('title');

            $course = [
                'id' => $course->id,
                'course_thumbnail' => $course->course_thumbnail,
                'course_preview_video' => $course->course_preview_video,
                'course_name' => $course->course_name,
                'course_tagline' => $course->course_tagline,
                'coaches' => UserInfoResource::collection($coaches),
                'coaches_string' => $course->coaches,
                'description' => $course->description,
                'module_overview_description' => $course->module_overview_description,
                'course_price_type' => $course->course_price_type ?? 'free',
                'course_price' => $course->course_price ?? 0.0,
                'member_add_reviews_on_this' => $course->member_add_reviews_on_this ?? 1,
                'upload_pdf' => $course->upload_pdf,
                'course_completed_image' => $course->course_completed_image,
                'status' => $course->status ?? 'private',
                'last_updated' => $course->updated_at ? $course->updated_at->format('M j, Y') : null,
                'stripe_subscription_course_id' =>$course->stripe_subscription_course_id,
                'google_pay_id' =>$course->google_pay_id,
                'apple_pay_id' =>$course->apple_pay_id,
                'course_material' => [
                    'total_modules' => $courseModules->count(),
                    'modules' => $courseModuleTitles->map(function ($title) {
                        return ['title' => $title];
                    })->toArray(),
                ],
            ];

            $course['course_purchase_status'] = 0;
            if ($user = $request->user()) {
                // Assuming you have a relationship named 'purchaseCourse' in your User model
                $purchaseCourse = $user->purchaseCourse()->where('course_id', $id)->first();
    
                if ($purchaseCourse) {
                    // If the user has purchased this course, include the purchase details
                    $purchaseStatus = $purchaseCourse->payment_status;
                    $course['course_purchase_status'] = $purchaseStatus;
                }
            }
            $message = 'Course fetched successfully.';
            return view('admin.course.course-edit',  compact('id','course'));
        }
    }

    public function createQuiz()
    {
        $courseModuleId = request()->query('course_module_id');
        $courseModule = CourseModule::find($courseModuleId);
        $courseTitle = $courseModule->title;
        return view('admin.course.quiz-create', compact('courseTitle', 'courseModule', 'courseModuleId'));
    }
    
    public function editQuiz(Request $request, CourseModule $courseModule)
    {
        $quizzes = $courseModule->quizzes->load('quizOptions');
        $quizResources = QuizResource::collection($quizzes);
        
        // dd($quizResources);
        return view('admin.course.quiz-edit', compact('quizResources', 'courseModule'));
    }

    public function previewQuiz()
    {
        return view('admin.course.quiz-preview');
    }
}
