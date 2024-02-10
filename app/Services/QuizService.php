<?php

namespace App\Services;

use App\Models\QuizOption;
use Illuminate\Support\Facades\Storage;

class QuizService
{
    public static function createUpdate($quiz, $request)
    {
        if (isset($request->course_id)) {
            $quiz->course_id = (int)$request->course_id;
        }

        if (isset($request->course_module_id)) {
            $quiz->course_module_id = (int)$request->course_module_id;
        }

        if (isset($request->question)) {
            $quiz->question = $request->question;
        }

        /* upload image */
        if ($request->hasFile('question_image') && $request->file('question_image')->isValid()) {
            // Handle the new question_image upload
            $questionImageName = md5(time()) . '.' . $request->file('question_image')->extension();
            $request->file('question_image')->storeAs('public/quiz/questionImage', $questionImageName);
            $input['questionImage'] = $questionImageName;
            $quiz->question_image = asset('/storage/quiz/questionImage/' . $input['questionImage']);
        } else if ($request->has('question_image')) {
            // Check if the "question_image" key exists in the request
            if ($quiz->question_image) {
                // Extract the filename from the URL and remove the asset path
                $oldImageName = basename(str_replace(asset(''), '', $quiz->question_image));
                // Build the path to the old image
                $oldImagePath = public_path('storage/quiz/questionImage/' . $oldImageName);
        
                // Check if the old image file exists and delete it
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
        
                // Set the "question_image" field to null in the database
                $quiz->question_image = null;
            }
            
        } else if (!isset($request->question_image)){
            // Handle the case where the "question_image" key is not set in the request
        }                      

        if (isset($request->question_type)) {
            $quiz->question_type = $request->question_type;
        }

        $quiz->save();

        // Handle quiz options
        if ($request->question_type == 'multi_select' || $request->question_type == 'single_select') {
            // $option_values = explode(',', $request->option);
            switch ($request->question_type) {
                case 'multi_select':
                    # code...
                    $option_values = $request->option_m;
                    break;
                case 'single_select':
                    # code...
                    $option_values = $request->option_s;
                    break;
                default:
                    # code...
                    break;
            }
            $option_images = $request->option_image;

            // Convert admin answer string to an array
            // $adminAnswers = isset($request->admin_answer) ? explode(',', $request->admin_answer) : [];
            switch ($request->question_type) {
                case 'multi_select':
                    $adminAnswers =isset($request->admin_answer_m) ? $request->admin_answer_m : [];
                    break;
                case 'single_select':
                    $adminAnswers = isset($request->admin_answer) ? explode(',', $request->admin_answer) : [];
                    break;
                default:
                    break;
            }
            // Get existing quiz options
            $existingOptions = QuizOption::where('quiz_id', $quiz->id)->get();
            
            foreach ($option_values as $key => $value) {
                // Check if this is an update for an existing option
                if ($key < count($existingOptions)) {
                    $quizOption = $existingOptions[$key];
                } else {
                    $quizOption = new QuizOption();
                    $quizOption->quiz_id = $quiz->id;
                }

                $quizOption->option = $value;

                $admin_ans_val = [];
                if($request->question_type == "multi_select") {
                    $multi_admin_ans = explode(',', $request->admin_answer);
                    
                    foreach($multi_admin_ans as $ans_val) {
                        $admin_ans_val[] = $ans_val - 1;
                    }
                } else {
                    $admin_ans_val[] = $request->admin_answer - 1; 
                }
                // Check if this option is an admin answer
                if (in_array($key, $admin_ans_val)) {
                    switch ($request->question_type) {
                        case 'multi_select':
                            foreach ($adminAnswers as $adminAnswer) {
                                $quizOption->admin_answer = $value;
                            }
                            break;
                        case 'single_select':
                            $quizOption->admin_answer = $value;
                            break;
                        }
                } else {
                    $quizOption->admin_answer = null; // Clear admin answer if not selected
                }

                // Check if an image is provided for the current option
                if (isset($option_images[$key])) {
                    $optionImage = $option_images[$key];
                    $optionImageName = md5(time()) . '.' . pathinfo($optionImage, PATHINFO_EXTENSION);
                    $path = 'public/quizOption/optionImage';
                    Storage::putFileAs($path, new \Illuminate\Http\File($optionImage), $optionImageName);
                    $quizOption->option_image = asset('storage/quizOption/optionImage/' . $optionImageName);
                } else {
                    $quizOption->option_image = null; // Clear option image if not provided
                }
                $quizOption->save();
            }

            // Delete any extra existing options (if any)
            if (count($existingOptions) > count($option_values)) {
                foreach ($existingOptions->splice(count($option_values)) as $extraOption) {
                    $extraOption->delete();
                }
            }

            // Save the admin answers as a serialized array or in another appropriate format
            $quizOption->admin_answer = json_encode($adminAnswers);
            $quiz->save();
        }

        return $quiz;
    }
}
