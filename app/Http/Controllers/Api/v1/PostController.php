<?php

namespace App\Http\Controllers\Api\v1;

use Validator;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\PollOption;
use App\Models\PostComment;
use App\Models\PostActivity;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Services\PostService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;

class PostController extends Controller
{
    public $service;
    function __construct(PostService $postService)
	{
		$this->service = $postService;
	}

    /**
     * Post List API
     * @group Posts
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {       
        if($request->post_type === null || $request->post_type == 'all' || $request->post_type == 'All') {
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
            // ->with(['user.location', 'pollOptions', 'postComments.user', 'postComments.replies.user'])
            ->with(['user.location', 'pollOptions', 'postComments' => function ($query) {
                $query->with(['user', 'replies.user'])
                ->whereHas('user', function ($query) {
                    $query->whereNull('deleted_at');
                });
            }])
            ->where('schedule_datetime', '<=', $today)
            ->whereNotIn('posts.user_id', $blockedUsers)
            ->whereNotIn('posts.user_id', $blockedBy)
            ->whereNotIn('posts.user_id', $reportedUsers)
            ->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->orderBy('id', 'DESC');

                $hiddenPosts = Post::select('posts.id')
                            ->join('post_activities', 'posts.id', '=', 'post_activities.post_id')
                            ->where('post_activities.is_report', '=', 1)
                            ->groupBy('posts.id')
                            ->havingRaw('COUNT(*) >= ?', [3])
                            ->pluck('posts.id');

                $reportedMembers = Post::select('posts.user_id')
                            ->join('post_activities', 'posts.id', '=', 'post_activities.post_id')
                            ->where('post_activities.is_report_member', '=', 1)
                            ->groupBy('posts.user_id')
                            ->havingRaw('COUNT(*) >= ?', [3])
                            ->pluck('posts.user_id');

                if ($hiddenPosts->isNotEmpty() || $reportedMembers->isNotEmpty()) {
                    $posts->where(function ($query) use ($hiddenPosts, $reportedMembers, $userId) {
                        if ($hiddenPosts->isNotEmpty()) {
                            $query->whereNotIn('posts.id', $hiddenPosts);
                        }
                        if ($reportedMembers->isNotEmpty()) {
                            $query->whereNotIn('posts.user_id', $reportedMembers);
                            $query->where('posts.user_id', '!=', $userId);
                        }
                    });
                }

                // if post is hide to not show in this post other user
                $hiddenPosts = Post::select('posts.id')
                    ->join('post_activities', 'posts.id', '=', 'post_activities.post_id')
                    ->where('post_activities.is_hide_post', '=', 1)
                    ->pluck('posts.id');

                if ($hiddenPosts->isNotEmpty()) {
                    $posts->whereNotIn('posts.id', $hiddenPosts);
                }

            $perPage = $request->query('per_page', 10);
            $posts = $posts->pimp()->paginate($perPage);
        } else {
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
            ->where('post_type', $request->post_type)
            ->where('schedule_datetime', '<=', $today)
            ->whereNotIn('posts.user_id', $blockedUsers)
            ->whereNotIn('posts.user_id', $blockedBy)
            ->whereNotIn('posts.user_id', $reportedUsers)
            ->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->orderBy('id', 'DESC');

                $hiddenPosts = Post::select('posts.id')
                            ->join('post_activities', 'posts.id', '=', 'post_activities.post_id')
                            ->where('post_activities.is_report', '=', 1)
                            ->groupBy('posts.id')
                            ->havingRaw('COUNT(*) >= ?', [3])
                            ->pluck('posts.id');

                $reportedMembers = Post::select('posts.user_id')
                            ->join('post_activities', 'posts.id', '=', 'post_activities.post_id')
                            ->where('post_activities.is_report_member', '=', 1)
                            ->groupBy('posts.user_id')
                            ->havingRaw('COUNT(*) >= ?', [3])
                            ->pluck('posts.user_id');

                if ($hiddenPosts->isNotEmpty() || $reportedMembers->isNotEmpty()) {
                    $posts->where(function ($query) use ($hiddenPosts, $reportedMembers, $userId) {
                        if ($hiddenPosts->isNotEmpty()) {
                            $query->whereNotIn('posts.id', $hiddenPosts);
                        }
                        if ($reportedMembers->isNotEmpty()) {
                            $query->whereNotIn('posts.user_id', $reportedMembers);
                            $query->where('posts.user_id', '!=', $userId);
                        }
                    });
                }
                
                if ($request->post_type == 'poll') {
                    $posts->orwhereIn('post_type', ['poll_question' , 'poll_multiple_choice', 'poll_percentage'])
                            ->where(function ($query) {
                                $query->where('post_activities.is_hide_post', '=', 0)
                                    ->orWhereNull('post_activities.is_hide_post');
                            })
                            ->where(function ($query) {
                                $query->where('post_activities.is_report', '=', 0)
                                    ->orWhereNull('post_activities.is_report');
                            })
                            ->where('schedule_datetime', '<=', $today);
                }

                // Featured Post
                if ($request->post_type == 'featured') {
                    // dd('here');
                    $posts->orwhereIn('post_type', ['post','article','poll_question' , 'poll_multiple_choice', 'poll_percentage'])
                        ->where(function ($query) {
                            $query->where('posts.is_featured', '=', 1);
                        })
                        ->where(function ($query) {
                            $query->where('post_activities.is_hide_post', '=', 0)
                                ->orWhereNull('post_activities.is_hide_post');
                        })
                        ->where(function ($query) {
                            $query->where('post_activities.is_report', '=', 0)
                                ->orWhereNull('post_activities.is_report');
                        })
                        ->whereHas('user', function ($query) {
                            $query->whereNull('deleted_at');
                        })
                        ->where('schedule_datetime', '<=', $today);
                }

                // if post is hide to not show in this post other user
                $hiddenPosts = Post::select('posts.id')
                ->join('post_activities', 'posts.id', '=', 'post_activities.post_id')
                ->where('post_activities.is_hide_post', '=', 1)
                ->pluck('posts.id');

                if ($hiddenPosts->isNotEmpty()) {
                    $posts->whereNotIn('posts.id', $hiddenPosts);
                }
            
            $perPage = $request->query('per_page', 10);
            $posts = $posts->pimp()->paginate($perPage);
        }

        $posts = $posts->toArray();

        foreach ($posts['data'] as $key => $post) { 
            // $count_is_like = PostActivity::where('post_id', $post['id'])->where('is_like',1)->get();
            $count_is_like = PostActivity::with('user')
                                        ->join('users', 'users.id', '=', 'post_activities.user_id')
                                        ->where('post_activities.post_id', $post['id'])
                                        ->where('post_activities.is_like',1)
                                        ->whereNull('users.deleted_at')
                                        ->get();
            $count_is_like = !empty($count_is_like) ? count($count_is_like) : 0;
            $count_comments = PostComment::with('user')
                                        ->where('postcommentable_id', $post['id'])
                                        ->whereHas('user', function ($query) {
                                            $query->whereNull('deleted_at');
                                        })
                                        ->count();
            // $post_activity = PostActivity::select('user_id')->where('post_id', $post['id'])->where('is_like',1)->orderBy('id', 'DESC')
            //                                 ->with('user', function ($q) {
            //                                     $q->select('id', 'first_name','last_name', 'profile_image');
            //                                 })->limit(3)->get();
            $post_activity = PostActivity::with(['user' => function($query) {
                $query->select('id', 'first_name', 'last_name', 'profile_image');
            }])
            ->select('post_activities.user_id')
            ->join('users', 'users.id', '=', 'post_activities.user_id')
            ->where('post_activities.post_id', $post['id'])
            ->where('post_activities.is_like', 1)
            ->whereNull('users.deleted_at')
            ->orderBy('post_activities.id', 'DESC')
            ->limit(3)
            ->get();

            $posts['data'][$key]['post_activity'] = $post_activity;
            $posts['data'][$key]['count_is_like'] = $count_is_like;
            $posts['data'][$key]['count_comments'] = $count_comments;

            foreach ($post['poll_options'] as $value => $pollAnswer) {
                // Total answered member count
                $idString = $pollAnswer['answer_member_id'];
                $ids = explode(",", $idString);
                $answeredMemberCount = count(array_filter($ids));
                $posts['data'][$key]['poll_options'][$value]['total_answered_member_count'] = $answeredMemberCount;
            
                // Total answer on this question count
                $pollAnswerData = PollOption::where('post_id', $post['id'])->get();
                $totalAnswerOnThisQuestion = 0;
                foreach ($pollAnswerData as $answerValue) {
                    $totalAnsweredMemberArray = explode(",", $answerValue->answer_member_id);
                    $totalAnsweredMemberArray = array_filter($totalAnsweredMemberArray, 'strlen'); // Remove blank values
                    $totalAnswerOnThisQuestion += count($totalAnsweredMemberArray);
                }
                $posts['data'][$key]['poll_options'][$value]['total_answer_on_this_question_count'] = $totalAnswerOnThisQuestion;
            
                // Auth user poll option answer key 0 or 1 set
                if (($post['post_type'] == "poll_percentage" || $post['post_type'] == "poll_multiple_choice") && !empty($post['poll_options'])) {
                    $anweredMemarray = explode(",", $pollAnswer['answer_member_id']);
                    $answerArray = array_filter($anweredMemarray, 'strlen');
                    if(in_array(Auth::user()->id, $answerArray))
                    {
                        $posts['data'][$key]['poll_options'][$value]['is_answered'] = 1;
                    } else {
                        $posts['data'][$key]['poll_options'][$value]['is_answered'] = 0;
                    }  
                }
                
                // poll expiration key set
                if($posts['data'][$key]['poll_expiration'] < Carbon::now()->format('Y-m-d H:i:s')) {
                    $posts['data'][$key]['is_expired'] = 1;
                } else {
                    $posts['data'][$key]['is_expired'] = 0;
                }
            }   
        }
                
        if($request->wantsJson()) {  
            return sendResponse($posts, 'Posts listed successfully.');
        } else {
            if (!auth()->user()->welcome_checklist_complete==1) {
                return redirect()->route('dashboard');
            }
            if ($request->ajax()) {
                $current_page = $posts['current_page'];
                $last_page = $posts['last_page'];
            
                $view = view('users.post.post_xhr',compact('posts'))->render();
                return response()->json(['html'=>$view,'current_page'=>$current_page,'last_page'=>$last_page],);
            }
            return view('users.post.index' ,  compact('posts'));
        }
    }

    /**
     * Add Post API
     * @group Posts
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
            'post_type' => 'required|in:post,article,poll_question,poll_multiple_choice,poll_percentage',
        ],
        [
            'content.required' => 'Please enter the content',
        ]);

        /* Schedule Post Validation*/
        if ($request->schedule_type) {
            $validator = Validator::make($request->all(), [
                'schedule_type' => 'required|in:schedule_post,post_now',
            ]);

            if ($request->schedule_type == 'schedule_post') {
                $validator = Validator::make($request->all(), [
                    'content' => 'required',
                    'post_type' => 'required|in:post,article,poll_question,poll_multiple_choice,poll_percentage',
                    'schedule_datetime' => 'required|after_or_equal:' . date(DATE_ATOM),
                ],
                [
                    'content.required' => 'Please enter the content',
                    'schedule_datetime.required' => 'Please select the schedule datetime',
                ]);
            }
        }

        /* Poll multiple choice option Validation*/
        if ($request->post_type == 'poll_multiple_choice') {
            $validator = Validator::make($request->all(), [
                'content' => 'required',
                'option' => 'required',
                'poll_expiration' => 'required|after_or_equal:' . date(DATE_ATOM),
            ],
            [
                'content.required' => 'Please enter the content',
                'option.required' => 'Please enter the question option',
                'poll_expiration.required' => 'Please enter the poll expiration datetime',
            ]);
        }

        /* Poll Percentage Validation*/
         if ($request->post_type == 'poll_percentage') {
            $validator = Validator::make($request->all(), [
                'content' => 'required',
                'poll_expiration' => 'required|after_or_equal:' . date(DATE_ATOM),
            ],
            [
                'content.required' => 'Please enter the content',
                'poll_expiration.required' => 'Please enter the poll expiration datetime',
            ]);
        }
        
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
        
        $post = PostService::createUpdate(new Post, $request);
        
        if($request->post_type == 'post') {
            $message = 'Post created successfully.';
        } elseif($request->post_type == 'article') {
            $message = 'Article created successfully.';
        }
        elseif($request->post_type == 'poll_question') {
            $message = 'Poll created successfully.';
        }
        elseif($request->post_type == 'poll_multiple_choice') {
            $message = 'Poll created successfully.';
        }
        elseif($request->post_type == 'poll_percentage') {
            $message = 'Poll created successfully.';
        }
        
        if(!empty($request->post_type)) {
            $post = postResponse($post->id);
            return sendResponse($post, $message);
        }  
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Show Post API
     * @group Posts
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $post = Post::find($id);
        if(!empty($post)) {
            $post = postResponse($id);
            $message = "Post fetched successfully.";           
            
            if($request->wantsJson()) {  
                return sendResponse($post, $message);
            } else {
                if (!auth()->user()->welcome_checklist_complete==1) {
                    return redirect()->route('dashboard');
                }
                if ($request->ajax()) {
                    if($request->edit==1)
                    {
                        return sendResponse($post, $message);
                    }else{
                        $view = view('users.post.post_detail_xhr',compact('post'))->render();
                        return response()->json(['html'=>$view]);
                    }
                }
                return view('users.post.post_detail_xhr' ,  compact('post'));
            }
        } else {
            return sendError('Error Occurred');
        }
    }
    
    public function postEdit(Request $request, $id)
    {
        $post = Post::findorfail($id);
        $post = postResponse($id);
        return response($post);
    }

    /**
     * Edit Post API
     * @group Posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
            'post_type' => 'required|in:post,article',
        ],
        [
            'content.required' => 'Please enter the post content',
        ]);

        /* Schedule Post Validation*/
        if (isset($request->schedule_type)) {
            $validator = Validator::make($request->all(), [
                'schedule_type' => 'required|in:schedule_post,post_now',
            ]);
            
            if ($request->schedule_type == 'schedule_post') {
                $validator = Validator::make($request->all(), [
                    'schedule_datetime' => 'required|after_or_equal:' . date(DATE_ATOM),
                ],
                [
                    'schedule_datetime.required' => 'Please select the schedule datetime',
                ]);
            }
        }

        if($validator->fails()){
            return response()->json(
                [
                    'status' => 422,
                    'statusState' => 'error',
                    'message' => (empty($validator->errors()) ? 'Something went wrong' : $validator->errors())->first(),
                ],422
            );       
        }

        $post = Post::find($id);
        if(!empty($post)) 
        {
            $post = PostService::createUpdate($post, $request);
            $post = postResponse($id);
            if($post['post_type'] == 'post') {
                $message = 'Post updated successfully.';
            } elseif($post['post_type'] == 'article') {
                $message = 'Article updated successfully.';
            }
                                                                                               
            return sendResponse($post, $message);
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Delete Post API
     * @group Posts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(!empty($post))
        {
            $postData = postResponse($id);
            $post->delete();

            if($postData['post_type'] == 'post') {
                $message = 'Post deleted successfully.';
            } elseif($postData['post_type'] == 'article') {
                $message = 'Article deleted successfully.';
            }
            elseif($postData['post_type'] == 'poll_question') {
                $message = 'Poll deleted successfully.';
            }
            elseif($postData['post_type'] == 'poll_multiple_choice') {
                $message = 'Poll deleted successfully.';
            }
            elseif($postData['post_type'] == 'poll_percentage') {
                $message = 'Poll deleted successfully.';
            }
            return sendResponse($postData, $message);
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Save & Hide Post API
     * @group Posts
     * @return \Illuminate\Http\Response
     */

    public function filteredPost(Request $request)
    {
        if ($request->type) {
            $userId = Auth::user()->id;
            $perPage = $request->query('per_page', 10);
            $posts = null;
            $message = '';
    
            if ($request->type === 'is_hide_post') {
                $posts = Post::select('posts.id', 'posts.content', 'posts.post_type', 'posts.poll_expiration', 'posts.created_at', 'post_activities.post_id', 'posts.user_id', 'post_activities.is_hide_post')
                    ->leftJoin('post_activities', function ($join) use ($userId) {
                        $join->on('posts.id', '=', 'post_activities.post_id')
                            ->where('post_activities.user_id', '=', $userId);
                    })
                    ->where(function ($query) {
                        $query->where('post_activities.is_hide_post', '=', 1);
                    })
                    ->with('user.location', 'pollOptions')
                    ->orderBy('id', 'DESC')
                    ->paginate($perPage);

                    $posts = $posts->toArray();

                    foreach ($posts['data'] as $key => $post) {
                        foreach ($post['poll_options'] as $optionKey => $pollAnswer) {
                            // Total answered member count
                            $idString = $pollAnswer['answer_member_id'];
                            $ids = explode(",", $idString);
                            $answeredMemberCount = count(array_filter($ids));
                            $posts['data'][$key]['poll_options'][$optionKey]['total_answered_member_count'] = $answeredMemberCount;
                    
                            // Total answer on this question count
                            $pollAnswerData = PollOption::where('post_id', $post['id'])->get();
                            $totalAnswerOnThisQuestion = 0;
                            foreach ($pollAnswerData as $answerValue) {
                                $totalAnsweredMemberArray = explode(",", $answerValue->answer_member_id);
                                $totalAnsweredMemberArray = array_filter($totalAnsweredMemberArray, 'strlen'); // Remove blank values
                                $totalAnswerOnThisQuestion += count($totalAnsweredMemberArray);
                            }
                            $posts['data'][$key]['poll_options'][$optionKey]['total_answer_on_this_question_count'] = $totalAnswerOnThisQuestion;
                    
                            // Auth user poll option answer key 0 or 1 set
                            if (($post['post_type'] == "poll_percentage" || $post['post_type'] == "poll_multiple_choice") && !empty($post['poll_options'])) {
                                $anweredMemarray = explode(",", $pollAnswer['answer_member_id']);
                                $answerArray = array_filter($anweredMemarray, 'strlen');
                                if(in_array(Auth::user()->id, $answerArray))
                                {
                                    $posts['data'][$key]['poll_options'][$optionKey]['is_answered'] = 1;
                                } else {
                                    $posts['data'][$key]['poll_options'][$optionKey]['is_answered'] = 0;
                                }  
                            }

                            // poll expiration key set
                            if($posts['data'][$key]['poll_expiration'] < Carbon::now()->format('Y-m-d H:i:s')) {
                                $posts['data'][$key]['is_expired'] = 1;
                            } else {
                                $posts['data'][$key]['is_expired'] = 0;
                            }
                        }
                    }
                $message = 'Hide post listed successfully';
            } elseif ($request->type === 'is_save') {
                $posts = Post::select('posts.id', 'posts.content', 'posts.post_type', 'posts.poll_expiration', 'posts.created_at', 'post_activities.post_id', 'posts.user_id', 'post_activities.is_save')
                    ->leftJoin('post_activities', function ($join) use ($userId) {
                        $join->on('posts.id', '=', 'post_activities.post_id')
                            ->where('post_activities.user_id', '=', $userId);
                    })
                    ->where(function ($query) {
                        $query->where('post_activities.is_save', '=', 1);
                    })
                    ->with('user.location', 'pollOptions')
                    ->orderBy('id', 'DESC')
                    ->paginate($perPage);

                    $posts = $posts->toArray();

                    foreach ($posts['data'] as $key => $post) {
                        foreach ($post['poll_options'] as $optionKey => $pollAnswer) {
                            // Total answered member count
                            $idString = $pollAnswer['answer_member_id'];
                            $ids = explode(",", $idString);
                            $answeredMemberCount = count(array_filter($ids));
                            $posts['data'][$key]['poll_options'][$optionKey]['total_answered_member_count'] = $answeredMemberCount;
                    
                            // Total answer on this question count
                            $pollAnswerData = PollOption::where('post_id', $post['id'])->get();
                            $totalAnswerOnThisQuestion = 0;
                            foreach ($pollAnswerData as $answerValue) {
                                $totalAnsweredMemberArray = explode(",", $answerValue->answer_member_id);
                                $totalAnsweredMemberArray = array_filter($totalAnsweredMemberArray, 'strlen'); // Remove blank values
                                $totalAnswerOnThisQuestion += count($totalAnsweredMemberArray);
                            }
                            $posts['data'][$key]['poll_options'][$optionKey]['total_answer_on_this_question_count'] = $totalAnswerOnThisQuestion;

                            // Auth user poll option answer key 0 or 1 set
                            if (($post['post_type'] == "poll_percentage" || $post['post_type'] == "poll_multiple_choice") && !empty($post['poll_options'])) {
                                $anweredMemarray = explode(",", $pollAnswer['answer_member_id']);
                                $answerArray = array_filter($anweredMemarray, 'strlen');
                                if(in_array(Auth::user()->id, $answerArray))
                                {
                                    $posts['data'][$key]['poll_options'][$optionKey]['is_answered'] = 1;
                                } else {
                                    $posts['data'][$key]['poll_options'][$optionKey]['is_answered'] = 0;
                                }  
                            }

                            // poll expiration key set
                            if($posts['data'][$key]['poll_expiration'] < Carbon::now()->format('Y-m-d H:i:s')) {
                                $posts['data'][$key]['is_expired'] = 1;
                            } else {
                                $posts['data'][$key]['is_expired'] = 0;
                            }
                        }
                    }
    
                $message = 'Save post listed successfully';
            }
    
            if ($posts) {
                if ($request->wantsJson()) {
                    return sendResponse($posts, $message);
                } else {
                    if (!auth()->user()->welcome_checklist_complete==1) {
                        return redirect()->route('dashboard');
                    }
                    if ($request->ajax()) {
                        $view = view('users.post.filtered_post_xhr', compact('posts'))->render();
                        return response()->json(['html' => $view]);
                    }
                    return view('users.post.filtered_post', compact('posts'));
                }
            } else {
                return sendError('Error Occurred');
            }
        } else {
            return sendError('Error Occurred');
        }
    }
    /**
     * Featured Post Status Update API
     * @group Posts
     * @return \Illuminate\Http\Response
     */
    public function featuredPostStatusUpdate(Request $request)
    {
        // Check if the authenticated user is an admin
        if (!auth()->user()->is_admin) {
            return response()->json([
                'status' => 403,
                'statusState' => 'error',
                'message' => 'Unauthorized. Only administrators can perform this action.'
            ], 403);
        }
        $post = Post::find($request->id);
        if(!$post)
        {
            return sendError('Error Occurred');
        }

        $post->is_featured = !$post->is_featured;
        $post->save();
        $message = $post->is_featured ? 'Post featured successfully' : 'Post unfeatured successfully';
        return sendResponse($post, $message);
    }
    public function featuredPost (Request $request){
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

        
        $posts->orwhereIn('post_type', ['post','article','poll_question' , 'poll_multiple_choice', 'poll_percentage'])
        ->where(function ($query) {
            $query->where('posts.is_featured', '=', 1);
        })
        ->where(function ($query) {
            $query->where('post_activities.is_hide_post', '=', 0)
                ->orWhereNull('post_activities.is_hide_post');
        })
        ->where(function ($query) {
            $query->where('post_activities.is_report', '=', 0)
                ->orWhereNull('post_activities.is_report');
        })
        ->whereHas('user', function ($query) {
            $query->whereNull('deleted_at');
        })
        ->where('schedule_datetime', '<=', $today);

        $hiddenPosts = Post::select('posts.id')
                ->join('post_activities', 'posts.id', '=', 'post_activities.post_id')
                ->where('post_activities.is_hide_post', '=', 1)
                ->pluck('posts.id');

                if ($hiddenPosts->isNotEmpty()) {
                    $posts->whereNotIn('posts.id', $hiddenPosts);
                }
            
        $perPage = $request->query('per_page', 10);
        $posts = $posts->pimp()->paginate($perPage);

        $posts = $posts->toArray();
        if($request->wantsJson()) {  
            return sendResponse($posts, 'Posts listed successfully.');
        } else {
            if (!auth()->user()->welcome_checklist_complete==1) {
                return redirect()->route('dashboard');
            }
            if ($request->ajax()) {
                return view('users.post.featured_post_xhr',compact('posts'))->render();
            }
        }
    }
}
