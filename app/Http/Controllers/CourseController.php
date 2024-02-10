<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){
        return view('users.course.index');
    }

    public function courseBuy(){
        return view('users.course.course-buy');
    }
    public function courseList(){
        return view('users.course.course-lists');
    }
    public function courseViewpay(){
        return view('users.course.course-viewpay');
    }
    public function courseView(){
        return view('users.course.course-view');
    }
    public function courseIntro($id){
        return view('users.course.course-intro', compact('id'));
    }
    public function courseVideo(){
        return view('users.course.course-video');
    }
    public function courseAudio(){
        return view('users.course.course-audio');
    }
    public function courseTask(){
        return view('users.course.course-task');
    }
    public function courseQuiz(){
        return view('users.course.course-quiz');
    }
    public function courseQuestion(){
        return view('users.course.course-question');
    }
    public function courseLink(){
        return view('users.course.course-link');
    }
    public function courseClosure(){
        return view('users.course.course-closure');
    }
    // Quiz
    public function quizView(){
        return view('users.course.quiz-view');
    }

}
