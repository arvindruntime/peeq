<?php

namespace App\Http\Controllers\Api\v1;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Course;
use App\Models\PollOption;
use App\Models\PostComment;
use App\Models\CourseModule;
use App\Models\PostActivity;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserInfoResource;

class SearchController extends Controller
{
    /**
     * Gloab Search API
     * @group Global Search
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = '%' . $request->input('term') . '%';
        
        
            if (empty($request->input('term'))) {
                return response()->json(
                    [
                        'status' => 200,
                        'statusState' => 'error',
                        'message' => (empty($error) ? 'Search field cannot be empty.' : $error),
                    ],200
                );
            }
            $userId = Auth::user()->id;
            $users = User::select(
                'users.id', 'users.first_name', 'users.last_name', 'users.user_type', 'users.profile_image', 'users.cover_image',
                DB::raw('CASE WHEN user_activities.is_follow = 1 THEN 1 ELSE 0 END AS is_follow'), 
                DB::raw('CASE WHEN user_activities.is_block_member = 1 THEN 1 ELSE 0 END AS is_block_member'),
                DB::raw('CASE WHEN user_activities.is_report_member = 1 THEN 1 ELSE 0 END AS is_report_member')
            )
                ->leftJoin('user_activities', function($join) use ($userId) {
                    $join->on('users.id', '=', 'user_activities.followers')
                        ->where('user_activities.following', '=', $userId);
                })
                ->whereNotExists(function ($query) use ($userId) {
                    $query->select(DB::raw(1))
                        ->from('user_activities')
                        ->where(function ($subQuery) use ($userId) {
                            $subQuery->whereColumn('users.id', 'user_activities.block_user_id')
                                ->where('user_activities.blocked_by', $userId);
                        })
                        ->orWhere(function ($subQuery) use ($userId) {
                            $subQuery->whereColumn('users.id', 'user_activities.report_user_id')
                                ->where('user_activities.reported_by', $userId);
                        })
                        ->orWhere(function ($subQuery) use ($userId) {
                            $subQuery->whereColumn('users.id', 'user_activities.blocked_by')
                                ->where('user_activities.block_user_id', $userId);
                        });
                })
                ->where('users.status', 'active')
                ->where(function ($query) use ($search) {
                    $query->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', $search);
                })
                ->get();

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

            $posts = $posts->where('content', 'LIKE', $search)
                    ->orWhere('post_type', 'LIKE', $search)
                    ->orWhere('schedule_type', 'LIKE', $search)
                    ->orWhereHas('user', function ($query) use ($search, $blockedUsers, $blockedBy, $reportedUsers) {
                        $query->where(function ($query) use ($search) {
                            $query->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', $search);
                        })
                        ->whereNotIn('id', $blockedUsers)
                        ->whereNotIn('id', $blockedBy)
                        ->whereNotIn('id', $reportedUsers);
                    })
                    ->where(function ($query) {
                        $query->where('is_hide_post', '=', 0)
                            ->orWhereNull('is_hide_post');
                    })
                    ->where(function ($query) {
                        $query->where('is_report', '=', 0)
                            ->orWhereNull('is_hide_post');
                    })
                    ->get();    

        $posts = $posts->toArray();

        foreach ($posts as $key => $post) { 
            $count_is_like = PostActivity::where('post_id', $post['id'])->where('is_like',1)->get();
            $count_is_like = !empty($count_is_like) ? count($count_is_like) : 0;
            $count_comments = PostComment::where('postcommentable_id', $post['id'])->count();
            $post_activity = PostActivity::select('user_id')->where('post_id', $post['id'])->where('is_like',1)->orderBy('id', 'DESC')
                                            ->with('user', function ($q) {
                                                $q->select('id', 'first_name','last_name', 'profile_image');
                                            })->limit(3)->get();
            $posts[$key]['post_activity'] = $post_activity;
            $posts[$key]['count_is_like'] = $count_is_like;
            $posts[$key]['count_comments'] = $count_comments;

            foreach ($post['poll_options'] as $value => $pollAnswer) {
                // Total answered member count
                $idString = $pollAnswer['answer_member_id'];
                $ids = explode(",", $idString);
                $answeredMemberCount = count(array_filter($ids));
                $posts[$key]['poll_options'][$value]['total_answered_member_count'] = $answeredMemberCount;
            
                // Total answer on this question count
                $pollAnswerData = PollOption::where('post_id', $post['id'])->get();
                $totalAnswerOnThisQuestion = 0;
                foreach ($pollAnswerData as $answerValue) {
                    $totalAnsweredMemberArray = explode(",", $answerValue->answer_member_id);
                    $totalAnsweredMemberArray = array_filter($totalAnsweredMemberArray, 'strlen'); // Remove blank values
                    $totalAnswerOnThisQuestion += count($totalAnsweredMemberArray);
                }
                $posts[$key]['poll_options'][$value]['total_answer_on_this_question_count'] = $totalAnswerOnThisQuestion;

                // Auth user poll option answer key 0 or 1 set
                if (($post['post_type'] == "poll_percentage" || $post['post_type'] == "poll_multiple_choice") && !empty($post['poll_options'])) {
                    $anweredMemarray = explode(",", $pollAnswer['answer_member_id']);
                    $answerArray = array_filter($anweredMemarray, 'strlen');
                    if(in_array(Auth::user()->id, $answerArray))
                    {
                        $posts[$key]['poll_options'][$value]['is_answered'] = 1;
                    } else {
                        $posts[$key]['poll_options'][$value]['is_answered'] = 0;
                    }  
                }

                // poll expiration key set
                if($posts[$key]['poll_expiration'] < Carbon::now()->format('Y-m-d H:i:s')) {
                    $posts[$key]['is_expired'] = 1;
                } else {
                    $posts[$key]['is_expired'] = 0;
                }
            }
        }

        $isAdmin = Auth::user()->is_admin;
        $coursesQuery = Course::where(function ($query) use ($search) {
            $query->where('course_name', 'LIKE', '%' . $search . '%')
                  ->orWhere('description', 'LIKE', '%' . $search . '%')
                  ->orWhere('course_price', 'LIKE', '%' . $search . '%');
        });
        if ($isAdmin) {
            $coursesQuery->orderBy('created_at', 'desc');
        } else {
            $coursesQuery->where('status', 'public')
                ->orderBy('created_at', 'desc');
        }
        
        $courses = $coursesQuery->get();
        $courses->transform(function ($course) use ($request) {
            $coaches = User::whereIn('id', explode(',', $course->coaches))
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();

            $courseModules = CourseModule::where('course_id', $course->id)->get();
            $courseModuleTitles = $courseModules->pluck('title');
            $user = $request->user();

            // Check if the user is authenticated before accessing purchase course details
            $purchaseCourse = null;
            if ($user) {
                $purchaseCourse = $user->purchaseCourse()->where('course_id', $course->id)->first();
            }
            $currencyCode = $course->currency ? $course->currency->code : 'AUD';

            return [
                'id' => $course->id,
                'course_thumbnail' => $course->course_thumbnail,
                'course_preview_video' => $course->course_preview_video,
                'course_name' => $course->course_name,
                'course_tagline' => $course->course_tagline,
                'coaches' => UserInfoResource::collection($coaches),
                'description' => $course->description,
                'course_price_type' => $course->course_price_type ?? 'free',
                'course_price' => $course->course_price ?? 0.0,
                'member_add_reviews_on_this' => $course->member_add_reviews_on_this ?? 1,
                'upload_pdf' => $course->upload_pdf,
                'currency' => $currencyCode,
                'stripe_subscription_course_id' => $course->stripe_subscription_course_id,
                'google_pay_id' => $course->google_pay_id,
                'apple_pay_id' => $course->apple_pay_id,
                'status' => $course->status ?? 'private',
                'last_updated' => $course->updated_at ? $course->updated_at->format('M j, Y') : null,
                'course_material' => [
                    'total_modules' => $courseModules->count(),
                    'modules' => $courseModuleTitles->map(function ($title) {
                        return ['title' => $title];
                    }),
                ],
                'course_purchase_status' => $purchaseCourse ? $purchaseCourse->payment_status : 0,
            ];
        });
                    
        if($request->wantsJson()) {                                               
            return sendResponse(compact('users', 'posts', 'courses'), 'Data listing successfully.');
        } else {
            if (!auth()->user()->welcome_checklist_complete==1) {
                return redirect()->route('dashboard');
            }
            return view('admin.dashboard.search_xhr' ,  compact('users', 'posts', 'courses'));
        }
    }
}
