<?php

namespace App\Http\Controllers\Api\v1;

use Validator;
use App\Models\PollOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PollOptionResource;
use App\Models\Post;

class PollOptionController extends Controller
{
    /**
     * Poll Answer API
     * @group Poll Activities
     * @return \Illuminate\Http\Response
     */
    public function pollAnswer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'poll_option_id' => 'required',
        ], [
            'poll_option_id.required' => 'Please enter the poll option id',
        ]);
        
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 422,
                    'statusState' => 'error',
                    'message' => (empty($validator->errors()) ? 'Something went wrong' : $validator->errors())->first(),
                ],
                422
            );
        }
        
        $pollAnswer = PollOption::where('id', $request->poll_option_id)->first();
        
        if ($pollAnswer) {
            $user = Auth::user()->id;
            $pollAnswer = PollOption::find($request->poll_option_id);
        
            // allow only one option to be selected at a time, and selecting one option should automatically deselect the other
            if ($pollAnswer->post->post_type === 'poll_percentage') {
                // Get the options with IDs 'Yes' and 'No'
                $yesOption = PollOption::where('post_id', $pollAnswer->post_id)
                    ->where('option', 'Yes')
                    ->first();
                $noOption = PollOption::where('post_id', $pollAnswer->post_id)
                    ->where('option', 'No')
                    ->first();
        
                if ($pollAnswer->option === 'Yes') {
                    // If the selected option is 'Yes', deselect the 'No' option
                    $noOption->answer_member_id = str_replace($user . ',', '', $noOption->answer_member_id);
                    $noOption->answer_member_id = str_replace(',' . $user, '', $noOption->answer_member_id);
                    $noOption->answer_member_id = str_replace($user, '', $noOption->answer_member_id);
                    $noOption->save();
                } elseif ($pollAnswer->option === 'No') {
                    // If the selected option is 'No', deselect the 'Yes' option
                    $yesOption->answer_member_id = str_replace($user . ',', '', $yesOption->answer_member_id);
                    $yesOption->answer_member_id = str_replace(',' . $user, '', $yesOption->answer_member_id);
                    $yesOption->answer_member_id = str_replace($user, '', $yesOption->answer_member_id);
                    $yesOption->save();
                }
            } elseif ($pollAnswer->post->post_type === 'poll_multiple_choice') {
                // Get all options for the current poll
                $pollOptions = PollOption::where('post_id', $pollAnswer->post_id)->get();
        
                // Deselect all options for the current user
                foreach ($pollOptions as $option) {
                    $option->answer_member_id = str_replace($user . ',', '', $option->answer_member_id);
                    $option->answer_member_id = str_replace(',' . $user, '', $option->answer_member_id);
                    $option->answer_member_id = str_replace($user, '', $option->answer_member_id);
                    $option->save();
                }
            }
        
            // Update the selected option
            $memberArray = explode(",", $pollAnswer->answer_member_id);
        
            if (in_array($user, $memberArray)) {
                // Remove user from the answer_member_id array
                $index = array_search($user, $memberArray);
                if ($index !== false) {
                    $userIdArray = array_diff($memberArray, [$user]);
                    $userIdArray = implode(',', $userIdArray);
                    $pollAnswer->answer_member_id = $userIdArray;
                }
            } else {
                // Add user to the answer_member_id array
                $pollAnswer->answer_member_id = Auth::user()->id . "," . $pollAnswer->answer_member_id;
            }
        
            $pollAnswer->save();
        
            // Total answered member count
            $idString = $pollAnswer->answer_member_id;
            $ids = explode(",", $idString);
            $totalAnsweredMemberCount = count(array_filter($ids));
        
            // Total answer on this question count
            $pollAnswerData = PollOption::where('post_id', $pollAnswer->post_id)->get();
            $TotalansweredMember = '';
            $finalArray = [];
            foreach($pollAnswerData as $key => $answerValue) {
                $totalAnsweredMemberArray = explode(",", $answerValue->answer_member_id);
                $totalAnsweredMemberArray = array_filter($totalAnsweredMemberArray, 'strlen'); // Remove blank values
                foreach ($totalAnsweredMemberArray as $data) {
                    array_push($finalArray, $data);
                }
            }
            $totalAnswerOnThisQuestion = count($finalArray);
            if ($pollAnswer->post_id) {
                $pollAnswerResponse = postResponse($pollAnswer->post_id);

                // Modify poll_options array
                $pollOptions = $pollAnswerResponse['poll_options'];
                foreach ($pollOptions as &$option) {

                    // Auth user poll option answer key 0 or 1 set
                    $anweredMemarray = explode(",", $option['answer_member_id']);
                    $answerArray = array_filter($anweredMemarray, 'strlen');
                    if (in_array(Auth::user()->id, $answerArray)) {
                        $option['is_answered'] = 1;
                    } else {
                        $option['is_answered'] = 0;
                    }

                    if ($option['id'] == $pollAnswer->id) {
                        $option['total_answered_member_count'] = $totalAnsweredMemberCount;
                        $option['total_answer_on_this_question_count'] = $totalAnswerOnThisQuestion;
                    } else {
                        // Calculate counts for other options
                        $optionAnsweredMemberCount = PollOption::where('post_id', $pollAnswer->post_id)
                            ->where('id', $option['id'])
                            ->value('answer_member_id');
                        $optionAnsweredMemberArray = explode(",", $optionAnsweredMemberCount);
                        $optionAnsweredMemberArray = array_filter($optionAnsweredMemberArray, 'strlen'); // Remove blank values
                        $option['total_answered_member_count'] = count($optionAnsweredMemberArray);
                        $option['total_answer_on_this_question_count'] = count($finalArray);
                    }
                }
                $pollAnswerResponse['poll_options'] = $pollOptions; // Update the modified poll_options array

                // poll expiration key set
                $pollAnswerResponse['is_expired'] = 0;

                return sendResponse($pollAnswerResponse, 'Poll answer submitted successfully.');
            }
        } else {
            return sendError('Error Occurred');
        }
    }
}
