<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\UserQuizAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserQuizAnswerController extends Controller
{
    public function UserQuizAnswerApi(Request $request)
    {
        $userId = Auth::user()->id;
        $quizIds = explode(',', $request->input('quiz_id'));
        $quizOptionIds = explode(',', $request->input('quiz_option_id'));
        

        // Check if the number of quiz IDs matches the number of quiz option IDs
        if (count($quizIds) !== count($quizOptionIds)) {
            return response()->json([
                'status' => 422,
                'statusState' => 'error',
                'message' => 'Mismatch between quiz_ids and quiz_option_ids',
            ], 422);
        }

        $responses = [];

        // Loop through each quiz_id and quiz_option_id
        foreach ($quizIds as $index => $quizId) {
            $quizOptionId = $quizOptionIds[$index];

            // Check if a user's answer for the same quiz question already exists
            $existingAnswer = UserQuizAnswer::where('user_id', $userId)
                ->where('quiz_id', $quizId)
                ->first();

            if ($existingAnswer) {
                // If an existing answer is found, update it
                $existingAnswer->quiz_option_id = $quizOptionId;
                $existingAnswer->save();
                $responses[] = [
                    'quiz_id' => $quizId,
                    'quiz_option_id' => $quizOptionId,
                    // 'message' => 'Quiz answer updated successfully',
                ];
                $message = 'Quiz answer submitted successfully';
            } else {
                // If no existing answer is found, create a new one
                $newAnswer = new UserQuizAnswer();
                $newAnswer->user_id = $userId;
                $newAnswer->quiz_id = $quizId;
                $newAnswer->quiz_option_id = $quizOptionId; // Ensure it's an integer
                $newAnswer->save();
                $responses[] = [
                    'quiz_id' => $quizId,
                    'quiz_option_id' => $quizOptionId,
                    // 'message' => 'Quiz answer added successfully',
                ];
                $message = 'Quiz answer added successfully';
            }
        }

        return response()->json([
            'status' => 200,
            'statusState' => 'success',
            'data' => $responses,
            'message' => $message,
        ], 200);
    }
}
