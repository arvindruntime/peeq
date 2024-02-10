<?php

namespace App\Http\Controllers\Api\v1;

use Validator;
use App\Models\Post;
use App\Mail\PostLikeEmail;
use App\Models\PostActivity;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Models\PushNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Services\PostActivityService;
use App\Http\Resources\PostActivityResource;

class PostActivityController extends Controller
{
    public $service;
    function __construct(PostActivityService $postActivityService)
	{
		$this->service = $postActivityService;
	}

    /**
     * Post Activity List API
     * @group Post Activities
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $postActivities = PostActivity::all();
        $postActivities = PostActivityResource::collection($postActivities);
        return sendResponse($postActivities, 'Post Activity listed successfully.');
    }

    /**
     * Add Post Activity API
     * @group Post Activities
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
        ],
        [
            'post_id.required' => 'Please enter the post id',
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
        $postActivity = PostActivityService::createUpdate(new PostActivity, $request);
        $postActivity = new PostActivityResource($postActivity);
        return sendResponse($postActivity, 'Post activity added successfully.');
    }

    /**
     * Get Post Activity API
     * @group Post Activities
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $postActivity = PostActivity::find($id);
        if(!empty($postActivity)) {
            $postActivity = new PostActivityResource($postActivity);
            return sendResponse($postActivity, 'Post activity fetched successfully.');
        }  
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Edit Post Activity API
     * @group Post Activities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
        ],
        [
            'post_id.required' => 'Please enter the post id',
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

        $postActivity = PostActivity::find($id);
        if(!empty($postActivity)) 
        {
            $postActivity = PostActivityService::createUpdate($postActivity, $request);
            $postActivity = new PostActivityResource($postActivity);
            return sendResponse($postActivity, 'Post activity updated successfully.');
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Delete Post Activity API
     * @group Post Activities
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postActivity = PostActivity::find($id);
        if(!empty($postActivity))
        {
            $postActivity->delete();
            $postActivity = new PostActivityResource($postActivity);
            return sendResponse($postActivity, 'Post activity deleted successfully.');
        }
        else
        {
            return sendError('Error Occurred');
        }
    }
    
    /**
     * Post Activity Action API
     * @group Post Activities
     * @return \Illuminate\Http\Response
     */
    public function postActivityAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|exists:posts,id',
        ],
        [
            'post_id.required' => 'Please enter the post id',
            'post_id.exists' => 'The selected post id is invalid',
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
        $postActivity = PostActivity::where('post_id',$request->post_id)->where('user_id', Auth::user()->id)->first();
        $post = Post::where('id',$request->post_id)->first();
        
        if(!$postActivity){

            $postActivity = new PostActivity();
        }
        
        $postActivity->post_id = (int)$request->post_id;
        
        $type = $request->type;
        $param = $request->param;
        
        if (isset($request->user_id)) {
            $postActivity->user_id = $request->user_id;
        } else {
            $postActivity->user_id = Auth::user()->id;
        } 
        
        $message = ''; // Initialize the $message variable

        if (isset($request->is_like)) {
            $postActivity->is_like = (int)$request->is_like;
            $message = $postActivity->is_like ? 'Post like successfully.' : 'Post unlike successfully.';

            if ($postActivity->is_like == 0) {
                // Delete the push notification entry when is_like is 0
                PushNotification::where('sender_id', Auth::user()->id)
                    ->where('receiver_id', $post['user']['id'])
                    ->where('title', 'Post Like')
                    ->where('post_id', $request->post_id) // Add this condition to filter by post_id
                    ->delete();
            }
        }
        
        if (isset($request->is_save)) {
            $postActivity->is_save = (int)$request->is_save;
            $message = $postActivity->is_save ? 'Post saved successfully.' : 'Post unsaved successfully.';
        }
                
        if (isset($request->is_mute)) {
            $postActivity->is_mute = (int)$request->is_mute;
            $message = $postActivity->is_mute ? 'Post mute successfully.' : 'Post unmute successfully.';
        }elseif($type=='is_mute')
        {
            $postActivity->is_mute = (int)$request->param;
            $message = $postActivity->is_mute ? 'Post mute successfully.' : 'Post unmute successfully.';
        }
        
        if (isset($request->is_report)) {
            $postActivity->is_report = (int)$request->is_report;
            $message = $postActivity->is_report ? 'Post reported successfully.' : 'Post not reported.';
        }elseif($type=='is_report')
        {
            $postActivity->is_report = (int)$request->param;
            $message = $postActivity->is_report ? 'Post reported successfully.' : 'Post not reported.';
        }

        if (isset($request->is_block_member)) {
            $postActivity->is_block_member = (int)$request->is_block_member;
            if($postActivity->is_block_member == 1) {
                $userActivity = new UserActivity;
                $userActivity->is_block_member = 1;
                $userActivity->block_user_id = $post->user_id;
                $userActivity->blocked_by = Auth::user()->id;
                $userActivity->save();
                $message = 'Member blocked successfully.';
            } elseif($postActivity->is_block_member == 0) {
                UserActivity::where('blocked_by', Auth::user()->id)->delete();
                $message = 'Member unblocked successfully.';
            }
        }elseif($type=='is_block_member')
        {
            $postActivity->is_block_member = (int)$request->param;
            if($postActivity->is_block_member == 1) {
                $userActivity = new UserActivity;
                $userActivity->is_block_member = 1;
                $userActivity->block_user_id = $post->user_id;
                $userActivity->blocked_by = Auth::user()->id;
                $userActivity->save();
                $message = 'Member blocked successfully.';
            } elseif($postActivity->is_block_member == 0) {
                UserActivity::where('blocked_by', Auth::user()->id)->delete();
                $message = 'Member unblocked successfully.';
            }
        }

        if (isset($request->is_report_member)) {
            $postActivity->is_report_member = (int)$request->is_report_member;
            if($postActivity->is_report_member == 0) {
                UserActivity::where('reported_by', Auth::user()->id)->delete();
            }
            $message = $postActivity->is_report_member ? 'Member reported successfully.' : 'Member not reported.';
        }elseif($type=='is_report_member')
        {
            $postActivity->is_report_member = (int)$request->param;
            if($postActivity->is_report_member == 0) {
                UserActivity::where('reported_by', Auth::user()->id)->delete();
            }
            $message = $postActivity->is_report_member ? 'Member reported successfully.' : 'Member not reported.';
        }
        
        if (isset($request->is_hide_post)) {
            $postActivity->is_hide_post = (int)$request->is_hide_post;
            $message = $postActivity->is_hide_post ? 'Post hide successfully.' : 'Post unhide successfully.';
        }elseif($type=='is_hide_post')
        {
            $postActivity->is_hide_post = (int)$request->param;
            $message = $postActivity->is_hide_post ? 'Post hide successfully.' : 'Post unhide successfully.';
        }
        
        $postActivity->save();
        $post = postActivityActionResponse($request->post_id);
        
        /** send push notification */
        if(($request->is_like == 1 || $type == 'is_like') || $param == 1) {
            $notification_data = [
                'title' => 'Post Like',
                'body' => Auth::user()->first_name . ' ' . 'liked your post',
                'fcm_token' => $post['user']['fcm_token'],
            ];

            // Retrieve the corresponding post activity record
            $postActivity = PostActivity::where('post_id', $post['id'])
                ->where('user_id', $post['user']['id'])
                ->first();
        
            if ($postActivity) {
                $isMuted = $postActivity->is_mute;
        
                if (!$isMuted) {

                    // Check if the 'notification_setting' key exists in $post['user']
                    if (isset($post['user']['notification_setting'])) {
                        $receiverNotificationSetting = $post['user']['notification_setting'];
                        $receiverNotificationSettingArray = explode(',', $receiverNotificationSetting);

                        // Check if the receiver has notification setting '2' (switched on) for email notification
                        $receiverEmailNotificationSwitchOn = in_array('2', $receiverNotificationSettingArray);

                        // Check if the receiver has notification setting '8' (switched on)
                        $receiverPushNotificationSwitchOn = in_array('8', $receiverNotificationSettingArray);

                        if (isset($post['user']['email']) && $receiverEmailNotificationSwitchOn && Auth::user()->id != $post['user']['id']) {
                            // if ($receiverEmailNotificationSwitchOn) {
                                $receiverName = $post['user']['first_name'];
                                $likeUserName = Auth::user()->first_name;
                                $loginUrl = URL::route('login');
                                try {
                                    Mail::to($post['user']['email'])->send(new PostLikeEmail($receiverName, $likeUserName, $loginUrl));
                                } catch (\Exception $e) {
                                    // Log the email sending error for debugging purposes
                                Log::error('Error sending post like email');
                                Log::error('Error message: ' . $e->getMessage());
                                }
                            // }
                        }
                        
                        if ($receiverPushNotificationSwitchOn && Auth::user()->id != $post['user']['id']) {
                                pushNotification($notification_data);

                            /** notification store in database */
                            $pushNotifictaion = new PushNotification();
                            $pushNotifictaion->sender_id = Auth::user()->id;
                            $pushNotifictaion->receiver_id = $post['user']['id'];
                            $pushNotifictaion->title = $notification_data['title'];
                            $pushNotifictaion->description = $notification_data['body'];
                            $pushNotifictaion->post_id = $post['id'];
                            $pushNotifictaion->save();
                        }
                    }
                }
            }
        }
        return sendResponse($post, $message);
        
    }

    /**
     * Post Report API
     * @group Post Activities
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
            'report_for' => 'required|in:post,member', 
            'report_type' => 'required',
            'report_description' => 'nullable'
        ],
        [
            'post_id.required' => 'Please enter post id',
            'report_for.required' => 'Please enter report for member or post',
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

        $postActivity = PostActivity::where('post_id',$request->post_id)->where('user_id', Auth::user()->id)->first();
        $post = Post::where('id',$request->post_id)->first();
        if(!$postActivity){

            $postActivity = new PostActivity();
        }
        $postActivity->post_id = (int)$request->post_id;

        if (isset($request->user_id)) {
            $postActivity->user_id = $request->user_id;
        } else {
            $postActivity->user_id = Auth::user()->id;
        } 

        if ($request->report_for) {
            $postActivities = PostActivity::where('id', $postActivity->id)->value('report_for');
            $postActivitiesArray = explode(",",$postActivities);

            $key = array_search($request->report_for, $postActivitiesArray, true);

            if ($key !== false) {
                unset($postActivitiesArray[$key]);
            }
            
            $postActivity->report_for = implode(",",$postActivitiesArray) . $request->report_for . ",";
        }

        if ($request->report_type) {
            $postActivities = PostActivity::where('id', $postActivity->id)->value('report_type');
            $postActivitiesArray = explode(",",$postActivities);

            $key = array_search($request->report_type, $postActivitiesArray, true);

            if ($key !== false) {
                unset($postActivitiesArray[$key]);
            }
            
            $postActivity->report_type = implode(",",$postActivitiesArray) . $request->report_type . ",";
        }
   
        if (isset($request->report_description)) {
            $postActivity->report_description = $request->report_description;
        }

        if ($request->report_for == 'member') {
            $postActivity->is_report = 1;
            $postActivity->is_report_member = 1;
            $postActivity->save();
            if($postActivity->is_report_member == 1) {
                $userActivity = new UserActivity;
                $userActivity->is_report_member = 1;
                $userActivity->report_user_id = $post->user_id;
                $userActivity->reported_by = Auth::user()->id;
                $userActivity->save();
            }
            $message = 'Report for the member';
        } elseif ($request->report_for == 'post') {
            $postActivity->is_report = 1;
            $postActivity->save();
            $message = 'Report for the post';
        } elseif ($request->report_for == null) {
            $message = 'success';
        }

        $postActivity->save();
        $post = postResponse($request->post_id);
        return sendResponse($post, $message);
        
    }
}
