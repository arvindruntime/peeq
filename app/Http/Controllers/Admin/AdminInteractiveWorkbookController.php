<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Course;
use App\Models\CourseModule;
use Illuminate\Http\Request;
use App\Models\InteractiveWorkbook;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminInteractiveWorkbookController extends Controller
{
    public function addInteractiveWorkbook($course_id,$course_module_id)
    {
        return view('admin.interactiveWorkbook.add', compact('course_id','course_module_id'));
    }
    public function InteractiveWorkbookAdd($course_id,$course_module_id){
        return view('admin.interactiveWorkbook.addworkbook',compact('course_id','course_module_id'));
    }

    public function listInteractiveWorkbook(CourseModule $courseModule)
    {
        $userId = auth()->user()->id;
        $interactiveworkbook = InteractiveWorkbook::where('course_module_id',$courseModule->id)
                                                    ->orderBy('page_no', 'ASC')
                                                    ->get();
        $course_id = $courseModule->course_id;
        $course_module_id = $courseModule->id;
        return view('admin.interactiveWorkbook.list',compact('interactiveworkbook', 'course_id', 'userId', 'course_module_id', 'courseModule'));
    }


    public function editorInteractiveWorkbook(Request $request)
    {
        $interactiveworkbook = InteractiveWorkbook::find($request->route('id'));
        return view('admin.interactiveWorkbook.editor',compact('interactiveworkbook'));
    }
    public function viewInteractiveWorkbook(CourseModule $courseModule, User $user)
    {
        $interactiveworkbook = InteractiveWorkbook::where('course_module_id',$courseModule->id)->orderBy('page_no', 'ASC')->paginate(100);   
        $course = $courseModule->course;
        $coachList = $course->coaches;
        $coachListArray = array_map('intval', explode(',', $coachList));
        $coaches = User::whereIn('id', $coachListArray)->get();
        $course_id = $courseModule->course_id;
        $course_module_id = $courseModule->id;
        $course_module_title = $courseModule->title;
        $audio_recording = $courseModule->audio_recording;
        if (Auth::attempt(['email' => $user->email, 'password' => $user->password, 'status' => $user->status])) {
           $user = Auth::user();
        }
        return view('admin.interactiveWorkbook.view',compact('interactiveworkbook','course_id','course_module_id', 'course_module_title', 'audio_recording', 'coaches', 'user'));
    }
}
