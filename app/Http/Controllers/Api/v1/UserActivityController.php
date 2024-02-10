<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Validator;
use App\Models\User;
use App\Models\PostActivity;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Models\PushNotification;
use App\Mail\NewMemberFollowEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserActivityController extends Controller
{
    /**
     * Member Activity Action API
     * @group Member Activities
     * @return \Illuminate\Http\Response
     */
    public function memberActivityAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
        ],
        [
            'type.required' => 'Please enter the type',
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

        if ($request->type == 'follow') {

            $validator = Validator::make($request->all(), [
                'followers' => 'required',
                'is_follow' => 'required',
            ],
            [
                'followers.required' => 'Please enter the followers',
                'is_follow.required' => 'Please enter the follow or unfollow',
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
            $memberActivity = UserActivity::where('followers', $request->followers)
                            ->where('following', Auth::user()->id)
                            ->first();
                            
            if ($request->is_follow == 1) {
                if (!$memberActivity) {
                    $memberActivity = new UserActivity();
                    $memberActivity->followers = (int)$request->followers;
                }
                $memberActivity->is_follow = 1;
                $memberActivity->following = Auth::user()->id;
                $memberActivity->save();
                $message = 'Member followed successfully.';

                // Retrieve fcm_token from the user's table
                $follower = User::find($request->followers);
                $fcm_token = $follower->fcm_token;

                /** send push notification */
                $notification_data = [
                    'title' => 'New Member Follow',
                    'body' => Auth::user()->first_name . ' ' . 'is now following you.',
                    'fcm_token' => $fcm_token,
                ];

                // Check if the receiver's notification switch is turned on
                $receiver = User::find($request->followers);
                $receiverName = $receiver->first_name;
                $followerName = Auth::user()->first_name;
                $loginUrl = URL::route('login');
                $receiverNotificationSettingArray = explode(',', $receiver->notification_setting);
                $receiverEmailNotificationSwitchOn = in_array('1', $receiverNotificationSettingArray);
                $receiverPushNotificationSwitchOn = in_array('7', $receiverNotificationSettingArray);

                if ($receiverEmailNotificationSwitchOn) {
                    try {
                        // Send email notification
                        Mail::to($receiver->email)->send(new NewMemberFollowEmail($receiverName, $followerName, $loginUrl));
                    } catch (Exception $e) {
                        // Log the email sending error for debugging purposes
                       Log::error('Error sending new member follow email');
                       Log::error('Error message: ' . $e->getMessage());
                    }
                }
                if ($receiverPushNotificationSwitchOn) {
                        // Send push notification
                        pushNotification($notification_data);

                    /** Store the notification in the database for the receiver */
                    $pushNotifictaion = new PushNotification();
                    $pushNotifictaion->sender_id = Auth::user()->id;
                    $pushNotifictaion->receiver_id = $memberActivity->followers;
                    $pushNotifictaion->title = $notification_data['title'];
                    $pushNotifictaion->description = $notification_data['body'];
                    $pushNotifictaion->save();
                }
                
            } elseif ($request->is_follow == 0) {
                if ($memberActivity) {
                    $memberActivity->delete();
                    $message = 'Member unfollowed successfully.';

                    // Delete the push notification entry when unfollowing a member
                    PushNotification::where('sender_id', Auth::user()->id)
                    ->where('receiver_id', $request->followers)
                    ->where('title', 'New Member Follow')
                    ->delete();
                    
                } else {
                    $message = 'Member is not currently followed.';
                }
                
            }
            $memberActivityFollowResponse = memberFollowResponse($request->followers);
            return sendResponse($memberActivityFollowResponse, $message);
        }

        if ($request->type == 'block') {

            $validator = Validator::make($request->all(), [
                'block_user_id' => 'required',
                'is_block_member' => 'required',
            ],
            [
                'block_user_id.required' => 'Please enter the block user id',
                'is_block_member.required' => 'Please enter the block or unblock',
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

            $memberActivityBlock = UserActivity::where('block_user_id', $request->block_user_id)
                                            ->where('blocked_by', Auth::user()->id)
                                            ->first();

            if (!$memberActivityBlock) {
                $memberActivityBlock = new UserActivity();
            }

            if ($request->is_block_member == 1) {
                $memberActivityBlock->block_user_id = (int)$request->block_user_id;
                $memberActivityBlock->is_block_member = 1;
                $memberActivityBlock->blocked_by = Auth::user()->id;
                $memberActivityBlock->save();
                $data = UserActivity::where('followers', $request->block_user_id)
                                        ->where('following', Auth::user()->id)
                                        ->delete();
                $memberActivityBlockResponse = memberBlockResponse($request->block_user_id);
                $message = 'Member blocked successfully.';
                return sendResponse($memberActivityBlockResponse, $message);
            }

            if ($request->is_block_member == 0) {
                if ($memberActivityBlock) {
                    $postActivity = PostActivity::where('user_id', Auth::user()->id)
                                                ->where('is_block_member', 1)
                                                ->first();
                    if($postActivity){
                        $postActivity->is_block_member = 0;
                        $postActivity->save();
                    }
                    $memberActivityBlock->delete();
                    $message = 'Member unblocked successfully.';
                } else {
                    $message = 'Member is not currently blocked.';
                }
                $memberActivityBlockResponse = memberBlockResponse($request->block_user_id);
                return sendResponse($memberActivityBlockResponse, $message);
            }    
        }
    }

    /**
     * Member Report API
     * @group Member Activities
     * @return \Illuminate\Http\Response
     */
    public function memberReport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'report_user_id' => 'required',
            'report_for' => 'required|in:member', 
            'report_type' => 'required',
            'report_description' => 'nullable'
        ],
        [
            'report_user_id.required' => 'Please enter reported user id',
            'report_for.required' => 'Please enter report for member',
            'report_type' => 'Please enter report type'
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

        $userActivity = UserActivity::where('report_user_id',$request->report_user_id)
                                    ->where('reported_by', Auth::user()->id)
                                    ->first();
        if(!$userActivity){

            $userActivity = new UserActivity();
        }
        $userActivity->report_user_id = (int)$request->report_user_id;
        $userActivity->is_report_member = 1;
        $userActivity->reported_by = Auth::user()->id;

        if ($request->report_for) {
            $userActivities = UserActivity::where('id', $userActivity->id)->value('report_for');
            $userActivitiesArray = explode(",",$userActivities);

            $key = array_search($request->report_for, $userActivitiesArray, true);

            if ($key !== false) {
                unset($userActivitiesArray[$key]);
            }
            
            $userActivity->report_for = implode(",",$userActivitiesArray) . $request->report_for . ",";
        }

        if ($request->report_type) {
            $userActivities = UserActivity::where('id', $userActivity->id)->value('report_type');
            $userActivitiesArray = explode(",",$userActivities);

            $key = array_search($request->report_type, $userActivitiesArray, true);

            if ($key !== false) {
                unset($userActivitiesArray[$key]);
            }
            
            $userActivity->report_type = implode(",",$userActivitiesArray) . $request->report_type . ",";
        }
   
        if (isset($request->report_description)) {
            $userActivity->report_description = $request->report_description;
        }

        $message = 'Report for the member';

        $userActivity->save();
        $data = UserActivity::where('followers', $request->report_user_id)
                                        ->where('following', Auth::user()->id)
                                        ->delete();
        $memberActivityReportResponse = memberReportResponse($request->report_user_id);
        return sendResponse($memberActivityReportResponse, $message);
        
    }
}
