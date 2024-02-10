<?php

namespace App\Http\Controllers\Api\v1;

use Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuizResource;
use App\Models\CourseModule;
use App\Models\Quiz;
use App\Services\QuizService;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Quiz List API
     * @group Quizzes
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $quizzes = Quiz::with('quizOptions')->paginate($perPage);
        QuizResource::collection($quizzes);
        $message = 'Quiz listed successfully.';
        return sendResponse($quizzes, $message);
    }

    /**
     * Add Quiz API
     * @group Quizzes
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'course_module_id' => 'required',
            'question' => 'required',
            'question_image' => 'nullable',
            'question_type' => 'required|in:multi_select,single_select',
        ],
        [
            'course_id.required' => 'Please enter the course id',
            'course_module_id.required' => 'Please enter the course module id',
            'question.required' => 'Please enter the question',
            'question_type' => 'Please select the question type',
        ]);
        if($validator->fails()){
            if($request->is('api/*')) {
                return response()->json(
                    [
                        'status' => 422,
                        'statusState' => 'error',
                        'message' => (empty($validator->errors()) ? 'Something went wrong' : $validator->errors())->first(),
                    ],422
                );

            } else {
                return response()->json(['error'=>$validator->errors()->all()]);
            }
        }

        /* Poll multiple choice option Validation*/
        if ($request->question_type == 'multi_select') {
            $validator = Validator::make($request->all(), [
                'question' => 'required',
                'option' => 'required',
                'option_image' => 'nullable',
                'admin_answer' => 'required',
            ],
            [
                'question.required' => 'Please enter the question',
                'option.required' => 'Please enter the question option',
                'admin_answer.required' => 'Please enter the admin answer',
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
        }

        /* Poll Percentage Validation*/
         if ($request->question_type == 'single_select') {
            $validator = Validator::make($request->all(), [
                'question' => 'required',
                'option' => 'required',
                'option_image' => 'nullable',
                'admin_answer' => 'required',
            ],
            [
                'question.required' => 'Please enter the question',
                'option.required' => 'Please enter the question option',
                'admin_answer.required' => 'Please enter the admin answer',
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
        }
        $quiz = QuizService::createUpdate(new Quiz, $request);
        $quiz = new QuizResource($quiz);
        $message = 'Quiz added successfully.';
        return sendResponse($quiz, $message);
    }

    /**
     * Edit Quiz API
     * @group Quizzes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 'course_id' => 'required',
            // 'course_module_id' => 'required',
            'question' => 'required',
            'question_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'question_type' => 'required|in:multi_select,single_select',
        ],
        [
            // 'course_id.required' => 'Please enter the course id',
            // 'course_module_id.required' => 'Please enter the course module id',
            'question.required' => 'Please enter the question',
            'question_type' => 'Please select the question type',
        ]);
        if($validator->fails()){
            if($request->is('api/*')) {
                return response()->json(
                    [
                        'status' => 422,
                        'statusState' => 'error',
                        'message' => (empty($validator->errors()) ? 'Something went wrong' : $validator->errors())->first(),
                    ],422
                );

            } else {
                return response()->json(['error'=>$validator->errors()->all()]);
            }
        }

        /* Poll multiple choice option Validation*/
        if ($request->question_type == 'multi_select') {
            $validator = Validator::make($request->all(), [
                'question' => 'required',
                'option' => 'required',
                'option_image' => 'nullable',
                'admin_answer' => 'required',
            ],
            [
                'question.required' => 'Please enter the question',
                'option.required' => 'Please enter the question option',
                'admin_answer.required' => 'Please enter the admin answer',
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
        }

        /* Poll Percentage Validation*/
         if ($request->question_type == 'single_select') {
            $validator = Validator::make($request->all(), [
                'question' => 'required',
                'option' => 'required',
                'option_image' => 'nullable',
                'admin_answer' => 'required',
            ],
            [
                'question.required' => 'Please enter the question',
                'option.required' => 'Please enter the question option',
                'admin_answer.required' => 'Please enter the admin answer',
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
        }
        $quiz = Quiz::find($id);
        if(!empty($quiz)) 
        {
            $quiz = QuizService::createUpdate($quiz, $request);
            $quiz = new QuizResource($quiz);
            $message = 'Quiz updated successfully.';
            return sendResponse($quiz, $message);
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Get Quiz API
     * @group Quizzes
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $quiz = Quiz::with('quizOptions')->find($id);
        $courseTitle = $quiz->courseModule->title;
        $courseModuleId = $quiz->courseModule->id;
        if(!empty($quiz)) 
        {
            if ($request->wantsJson()) {
                $quiz = new QuizResource($quiz);
                $message = 'Quiz fetched successfully.';
                return sendResponse($quiz, $message);
            } else {
                return view('admin.course.quiz-update', compact('quiz', 'courseTitle', 'courseModuleId'));
            }
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Get Quiz course module wise API
     * @group Quizzes
     * @return \Illuminate\Http\Response
     */
    public function getQuizModuleWise(Request $request, CourseModule $courseModule)
    {
        $quizzes = $courseModule->quizzes->load('quizOptions');
        if($request->wantsJson()) {  
            if (!empty($quizzes)) {
                $quizResources = QuizResource::collection($quizzes);
                return sendResponse($quizResources, 'Quizzes fetched successfully.');
            } else {
                return sendError('No quizzes found for this course module.');
            }
        } else {
            if (!auth()->user()->welcome_checklist_complete==1) {
                return redirect()->route('dashboard');
            }
            return view('admin.course.quiz-preview' ,  compact('quizzes'));
        }
    }

    /**
     * Delete Quiz API
     * @group Quizzes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::with('quizOptions')->find($id);
        if(!empty($quiz))
        {
            $quiz->delete();
            $quiz = new QuizResource($quiz);
            $message = 'Quiz deleted successfully.';
            return sendResponse($quiz, $message);
        }
        else 
        {
            return sendError('Error Occurred');
        }
    }
}
                