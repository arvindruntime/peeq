<?php

namespace App\Http\Controllers\Api\v1;

use DB;
use Cache;
use Exception;
use Carbon\Carbon; 
use App\Models\Post;
use App\Models\User;
use App\Models\Course;
use App\Models\Session;
use Illuminate\Support\Str;
use App\Models\PostActivity;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\PlanTransaction;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\User\EditRequest;
use App\Http\Resources\UserInfoResource;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\User\CreateRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $service;
    function __construct(UserService $userService)
	{
		$this->service = $userService;
	}

    /**
     * User List API
     * @group Users
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where('status', 'active')
                    ->orderBy('created_at', 'desc')
                    ->get();
        $users = UserResource::collection($users);
        $user = $request->user();
        $purchasePlanDetail = $user->purchasePlan;
        if($request->wantsJson()) {
            return sendResponse($users, 'User listed successfully.');
        } else {
            if (!auth()->user()->welcome_checklist_complete==1) {
                return redirect()->route('dashboard');
            }
            return view('admin.user.index', compact('users', 'purchasePlanDetail'));
        }
    }
    
    /**
     * Add User API
     * @group Users
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'mobile_no' => 'nullable',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
            'status' => 'nullable|in:active,inactive',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'job_title' => 'nullable',
            'company_name' => 'nullable',
            'bio' => 'nullable',
            'leadership_development' => 'nullable',
            'self_development' => 'nullable',
            'culture_uplift' => 'nullable',
            'networking' => 'nullable',
            'personal_link' => 'nullable',
            'location_id' => 'nullable',
            'timezone_id' => 'nullable',
        ],
        [
            'email.required' => 'Please enter a email',
            'email.email' => 'You have entered an invalid format',
            'password.required' => 'Please enter a password',
            'password.min' => 'The password must be atleast 6 or 8 characters',
            'c_password.required' => 'Please enter a confirm password',
            'c_password.same' => 'Password and confirmation password do not match',
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

        $user = UserService::createUpdate(new User, $request);
        $user = new UserResource($user);
        return sendResponse($user, 'User added successfully.');
    }

    /**
     * Get User API
     * @group Users
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if(!empty($user)) {
            $user = new UserResource($user);
            $success['userList'] = $user;
            return sendResponse($success, 'User fetched successfully.');
        }  
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Edit User API
     * @group Users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'status' => 'nullable|in:active,inactive',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg',
            'job_title' => 'nullable',
            'company_name' => 'nullable',
            'bio' => 'nullable',
            'leadership_development' => 'nullable',
            'self_development' => 'nullable',
            'culture_uplift' => 'nullable',
            'networking' => 'nullable',
            'personal_link' => 'nullable',
            'location_id' => 'nullable',
            'timezone_id' => 'nullable',
        ]);

        $validator->sometimes('profile_image', 'not_in:gif', function ($input) use ($request) {
            return $request->hasFile('profile_image');
        });
        
        $validator->sometimes('cover_image', 'not_in:gif', function ($input) use ($request) {
            return $request->hasFile('cover_image');
        });
        
        if($validator->fails()){
            return response()->json(
                [
                    'status' => 422,
                    'statusState' => 'error',
                    'message' => (empty($validator->errors()) ? 'Something went wrong' : $validator->errors())->first(),
                ],422
            );       
        }
        
        $user = User::find($id);
        if(!empty($user) &&  Auth::user()->id == $id) 
        {
            // if step_upadte == 1 to step update otherwise step not update
            if($request->step_update == 1) 
            {
                $request->steps = ["2","4"];
            } else
            {
                $request->steps = "";
            }

            $user = UserService::createUpdate($user, $request);
            $user = new UserResource($user);
            $success['userList'] = $user;
            return sendResponse($success, 'Profile updated successfully.');
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Delete User API
     * @group Users
     * @return \Illuminate\Http\Response
     */
    public function deleteAccount($id)
    {
        $user = User::find($id);
        if(!empty($user))
        {
            $user->delete();
            $user = new UserResource($user);
            return sendResponse($user, 'Account deleted successfully.');
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * ForgotPassword API
     * @group Login/Registration
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ],
        [
            'email.required' => 'Please enter the registered email',
            'email.email' => 'You have entered an invalid email',
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

        $user = User::where('email', $request->email)->first();
        if($user) {

            $userName = $user->first_name;
            $token = Str::random(64);
  
            DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
            try {
                Mail::send('email.forgetPassword', ['token' => $token, 'userName' => $userName, 'email' => $request->email], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
                });
            } catch (Exception $e) {
                // Log the email sending error for debugging purposes
                Log::error('Error sending forgot password email');
                Log::error('Error message: ' . $e->getMessage());
            }

            return response()->json([
                'status' => 200,
                'statusState' => 'success',
                "message" => 'Reset password link sent to your registered email.'
            ]);
        } else {
            return response()->json([
                'status' => 422,
                'statusState' => 'error',
                "message" => 'Email not found please enter valid email.'
            ], 422);
        }

    }

    public function resetPassword() {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string',
            'password-confirm'=>'required'
        ]);

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
            });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json([
                'status' => 422,
                'statusState' => 'error',
                "message" => 'Invalid token provided.'
            ], 422);
        }

        return response()->json([
            'status' => 200,
            'statusState' => 'success',
            "message" => 'Password has been successfully changed.'
        ]);

    }
    /**
     * Member Listing API
     * @group Members
     * @return \Illuminate\Http\Response
     */
    public function memberList(Request $request)
    {
        $memberLists = memberLists($request);
    
        if(!empty($memberLists)) {         
            if($request->wantsJson()) {  
                return sendResponse($memberLists,'member listed successfully.');
            } else {
                if (!auth()->user()->welcome_checklist_complete==1) {
                    return redirect()->route('dashboard');
                }
                $user_type = $request->user_type;
                if ($request->ajax()) {
                    
                    if($request->user_type=="all" || $request->user_type=="newest" || $request->user_type=="blocked" || $request->user_type=="host")
                    {
                        $current_page = $memberLists['current_page'];
                        $last_page = $memberLists['last_page'];
                        
                        $view = view('users.member.member_list_xhr',compact('memberLists','user_type'))->render();
                        return response()->json(['html'=>$view,'current_page'=>$current_page,'last_page'=>$last_page],);
                        // return response()->json(['html'=>$view,'current_page'=>$current_page,'last_page'=>$last_page,]);
                    }
                    else
                    {
                        $view = view('users.member.member_list_xhr',compact('memberLists','user_type'))->render();
                        return response()->json(['html'=>$view]);
                    }
                }
                
                if($request->user_type=="all" || $request->user_type=="newest" || $request->user_type=="blocked" || $request->user_type=="host")
                {
                    return view('users.member.member_list_xhr' ,  compact('memberLists','user_type'));
                }
                else{
                    return view('users.member.members_list' ,  compact('memberLists','user_type'));
                }
            }
            
        }  
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Show Member Listing API
     * @group Members
     * @return \Illuminate\Http\Response
     */
    public function showMember($id)
    {
        $user = User::select('id', 'first_name', 'last_name', 'job_title', 'company_name', 'bio', 'location_id', 'personal_link', 'user_type', 'updated_at', 'profile_image', 'cover_image')
            ->with('location')
            ->find($id);

        $loggedInUserId = Auth::user()->id;
        if (!empty($user)) {
            // Get the last_seen timestamp from the user
            $lastSeen = $user->updated_at;
            $lastSeenFormatted = $lastSeen->diffForHumans();

                /** Post count query */
                $userId = Auth::user()->id;
                $today = Carbon::now()->format('Y-m-d H:i:s');
                $blockedUsers = UserActivity::where('blocked_by', $userId)->pluck('block_user_id');
                $blockedBy = UserActivity::where('block_user_id', $userId)->pluck('blocked_by');
                $reportedUsers = UserActivity::where('reported_by', $userId)->pluck('report_user_id');
                $posts = Post::select('posts.*', DB::raw('CASE WHEN post_activities.is_like = 1 THEN 1 ELSE 0 END AS is_like'), 
                                                DB::raw('CASE WHEN post_activities.is_save = 1 THEN 1 ELSE 0 END AS is_save'),
                                                DB::raw('CASE WHEN post_activities.is_mute = 1 THEN 1 ELSE 0 END AS is_mute'),
                                                DB::raw('CASE WHEN post_activities.is_report = 1 THEN 1 ELSE 0 END AS is_report'),
                                                DB::raw('CASE WHEN post_activities.is_block_member = 1 THEN 1 ELSE 0 END AS is_block_member'),
                                                DB::raw('CASE WHEN post_activities.is_report_member = 1 THEN 1 ELSE 0 END AS is_report_member'),
                                                DB::raw('CASE WHEN post_activities.is_hide_post = 1 THEN 1 ELSE 0 END AS is_hide_post'))
                ->leftJoin('post_activities', function($join) use ($userId) {
                    $join->on('posts.id', '=', 'post_activities.post_id')
                        ->where('post_activities.user_id', '=', $userId);
                })
                ->where(function ($query) {
                    $query->where('post_activities.is_hide_post', '=', 0)
                        ->orWhereNull('post_activities.is_hide_post');
                })
                ->where(function ($query) {
                    $query->where('post_activities.is_report', '=', 0)
                        ->orWhereNull('post_activities.is_report');
                })
                ->with(['user.location', 'pollOptions', 'postComments.user', 'postComments.replies.user'])
                ->where('schedule_datetime', '<=', $today)
                ->whereNotIn('posts.user_id', $blockedUsers)
                ->whereNotIn('posts.user_id', $blockedBy)
                ->whereNotIn('posts.user_id', $reportedUsers)
                ->whereHas('user', function ($query) {
                    $query->whereNull('deleted_at');
                })
                ->orderBy('id', 'DESC');
            $postCount = $posts->where('posts.user_id', $user->id)->count();

            /** follower count query */
            $followersCount = UserActivity::where('followers', $user->id)
                                            ->join('users', 'users.id', '=', 'user_activities.following')
                                            ->whereNull('users.deleted_at')
                                            ->count();
            /** following count query */
            $followingCount = UserActivity::where('following', $user->id)
                                            ->join('users', 'users.id', '=', 'user_activities.followers')
                                            ->whereNull('users.deleted_at')
                                            ->count();

            $user['post_count'] = $postCount;
            $user['followers_count'] = $followersCount;
            $user['following_count'] = $followingCount;
            if ($user->id == $loggedInUserId) {
                $user['last_seen'] = '';
                $user['is_online'] = 1;
            } else {
                $user['last_seen'] = $lastSeenFormatted;
                $user['is_online'] = 0;
            }

            $personalink = explode(',', $user->personal_link);
            $socialLinks = [];

            foreach ($personalink as $key => $link) {
                $socialLinks[$key]['socialIcon'] = getSocialIcon($link);
                $socialLinks[$key]['link'] = $link;
            }

            $user['social_link'] = $socialLinks;

            $purchaseCourses = PlanTransaction::with('course')
                                            ->where('user_id', $user->id)
                                            ->where('payment_status', 1)
                                            ->whereNotNull('course_id')
                                            ->get();
            $purchaseSessions = PlanTransaction::with('session')
                                            ->where('user_id', $user->id)
                                            ->where('payment_status', 1)
                                            ->whereNotNull('session_id')
                                            ->get();

            $user['courses'] = $purchaseCourses->map(function ($purchaseCourse) {
                return [
                    'course_name' => optional($purchaseCourse->course)->course_name,
                ];
            });
            $user['session'] = $purchaseSessions->map(function ($purchaseSessions) {
                return [
                    'session_name' => optional($purchaseSessions->session)->session_name,
                ];
            });

            return sendResponse($user, 'Member fetched successfully.');
        } else {
            return sendError('Error occurred.');
        }
    }

    /**
     * Block Member Listing API
     * @group Members
     * @return \Illuminate\Http\Response
     */
    public function blockMemberList()
    {
        $userId = Auth::user()->id;
        $blockMemberList = UserActivity::where('blocked_by', $userId)
                                        ->get();                             
        return sendResponse($blockMemberList, 'Block listed successfully.');
    }
    
    public function changePassword()
    {
        if (!auth()->user()->welcome_checklist_complete==1) {
            return redirect()->route('dashboard');
        }
    return view('users.change-password');
    }

    /**
     * Member Follower Listing API
     * @group Members
     * @return \Illuminate\Http\Response
     */
    public function followerList(Request $request)
    {
        $authUser = auth()->user();

        if (!$authUser) {
            return sendError('Unauthorized', 401);
        }
        
        $perPage = intval($request->query('per_page', 10)); // Convert to integer, default to 10 if not provided

        $followerUserIds = UserActivity::where('followers', $authUser->id)->latest()->pluck('following');

        $followers = User::whereIn('id', $followerUserIds)->orderBy('created_at', 'desc')->paginate($perPage);

        $response = [
            'status' => 200,
            'statusState' => 'success',
            'data' => [
                'current_page' => $followers->currentPage(),
                'followersCount' => $followers->total(),
                'data' => UserInfoResource::collection($followers),
                'from' => $followers->firstItem(),
                'to' => $followers->lastItem(),
                'last_page' => $followers->lastPage(),
                'per_page' => $perPage,
                'total' => $followers->total(),
            ],
            'message' => 'Your followers listed successfully.',
        ];

        if($request->wantsJson()) {  
            return response()->json($response);
        } else {
            if (!auth()->user()->welcome_checklist_complete==1) {
                return redirect()->route('dashboard');
            }
            if ($request->ajax()) {
                
                $view = view('users.member.followers_list_xhr',compact('response'))->render();
                return response()->json(['html'=>$view],);
            }
            
            return view('users.member.followers_list' ,  compact('response'));
        }
    }

    /**
     * Member Following Listing API
     * @group Members
     * @return \Illuminate\Http\Response
     */
    public function followingList(Request $request)
    {
        $authUser = auth()->user();

        if (!$authUser) {
            return sendError('Unauthorized', 401);
        }
        
        $perPage = intval($request->query('per_page', 10)); // Convert to integer, default to 10 if not provided

        $followingUserIds = UserActivity::where('following', $authUser->id)->latest()->pluck('followers');

        $followings = User::whereIn('id', $followingUserIds)->orderBy('created_at', 'desc')->paginate($perPage);

        $response = [
            'status' => 200,
            'statusState' => 'success',
            'data' => [
                'current_page' => $followings->currentPage(),
                'followingCount' => $followings->total(),
                'data' => UserInfoResource::collection($followings),
                'from' => $followings->firstItem(),
                'to' => $followings->lastItem(),
                'last_page' => $followings->lastPage(),
                'per_page' => $perPage,
                'total' => $followings->total(),
            ],
            'message' => 'Your following listed successfully.',
        ];

        
        if($request->wantsJson()) {  
            return response()->json($response);
        } else {
            if (!auth()->user()->welcome_checklist_complete==1) {
                return redirect()->route('dashboard');
            }
            if ($request->ajax()) {
                
                $view = view('users.member.following_list_xhr',compact('response'))->render();
                return response()->json(['html'=>$view],);
            }
            
            return view('users.member.following_list' ,  compact('response'));
        }
        
    }
}
