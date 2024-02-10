<?php

namespace App\Http\Controllers\Api\v1;

use Validator;
use App\Models\Post;
use App\Models\User;
use App\Models\PostComment;
use App\Models\PostActivity;
use Illuminate\Http\Request;
use App\Mail\PostCommentEmail;
use App\Models\PushNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Services\PostCommentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\PostCommentResource;

class PostCommentController extends Controller
{
    public $service;
    function __construct(PostCommentService $postCommentService)
    {
        $this->service = $postCommentService;
    }

    /**
     * Post Comment List API
     * @group Post Comments
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, Request $request)
    {
        $post_comments = PostComment::whereHas('post', function ($query) use ($post) {
            $query->where('id', $post->id);
            return $query;
        })
        ->with(['user','replies.user'])
        ->whereNull('parent_id')
        ->whereHas('user', function ($query) {
            $query->whereNull('deleted_at');
        })
        ->orderBy('id', 'DESC');
        $perPage = $request->query('per_page', 10);
        $post_comments = $post_comments->paginate($perPage);
    
        if($request->wantsJson()) {  
            return sendResponse(compact('post','post_comments'), 'Post comments listed successfully.');
        } else {
            if ($request->ajax()) {
                $view = view('users.post.comments_replies',compact('post','post_comments'))->render();
                return response()->json(['html'=>$view]);
            }
        }
        
    }

    /**
     * Add Post Comment API
     * @group Post Comments
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post, PostComment $postComment, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment_text' => 'required',
        ],
        [
            'comment_text.required' => 'Please enter the comment',
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
        $postComment = PostCommentService::createUpdate($post, $postComment, $request);

        /** send push notification */
        $notification_data = [
            'title' => 'Post Comment',
            'body' => Auth::user()->first_name . ' ' . 'comment your post',
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
                        $receiverName = $post['user']['first_name'];
                        $commentUserName = Auth::user()->first_name;
                        $loginUrl = URL::route('login');
                        try {
                            Mail::to($post['user']['email'])->send(new PostCommentEmail($receiverName, $commentUserName, $loginUrl));
                        } catch (\Exception $e) {
                            // Log the email sending error for debugging purposes
                            Log::error('Error sending post comment email');
                            Log::error('Error message: ' . $e->getMessage());
                        }
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

        $post_comments = PostComment::with(['user','replies.user'])
        ->whereNull('parent_id')
        ->whereHas('user', function ($query) {
            $query->whereNull('deleted_at');
        })
        ->orderBy('id', 'DESC')->first();
        $message = 'Post comment added successfully.';
        $post = postResponse($post->id);
        return sendResponse($post, $message);
    }

    /**
     * Delete Post Comment API
     * @group Post Comments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, PostComment $postComment, Request $request)
    {
        if ($postComment->parent_id != null) {
            $postComment->delete();
            $post_comments = PostComment::with(['user','replies.user'])
            ->whereNull('parent_id')
            ->orderBy('id', 'DESC')->first();
            $message = 'Post Comment deleted successfully.';
            return sendResponse($post_comments, $message);
        } else {
            $post_comments = PostComment::with(['user','replies.user'])
            ->whereNull('parent_id')
            ->orderBy('id', 'DESC')->first();
            $postComment->delete();
            $message = 'Post Comment deleted successfully.';
            return sendResponse($post_comments, $message);
        }
    }

}
