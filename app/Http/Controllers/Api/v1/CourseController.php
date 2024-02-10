<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Models\ModuleOverview;
use App\Services\CourseService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CourseResource;
use App\Http\Resources\TimeZoneResource;
use App\Http\Resources\UserInfoResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CourseTransactionResource;

class CourseController extends Controller
{
    public $course;
    function __construct(CourseService $courseService)
	{
		$this->course = $courseService;
	}

    /**
     * Course List API
     * @group Courses
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $isAdmin = Auth::user()->is_admin;
        $user = $request->user();

        $coursesQuery = Course::orderBy('created_at', 'desc');

        if (!$isAdmin) {
            // If not an admin, only show public courses by default
            $coursesQuery->where('status', 'public');
        }

        $type = $request->input('type', 'all');

        $deviceType = $request->input('device_type');

        if ($type === 'purchased' && $user) {
            $coursesQuery->whereHas('transactions', function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->where('payment_status', 1);
            });
        } elseif ($type === 'all' && $deviceType === 'android') {
            $coursesQuery->where(function ($query) use ($user) {
                $query->whereHas('transactions', function ($query) use ($user) {
                    $query->where('user_id', $user->id)
                        ->where('payment_status', 1);
                })->orWhere(function ($query) {
                    $query->where('course_price', '<', 500)->orWhereNull('course_price');
                });
            });
        } elseif ($type === 'all' && $deviceType === 'ios') {
            $coursesQuery->where(function ($query) use ($user) {
                $query->whereHas('transactions', function ($query) use ($user) {
                    $query->where('user_id', $user->id)
                        ->where('payment_status', 1);
                })->orWhere(function ($query) {
                    $query->where('course_price', '<', 1700)->orWhereNull('course_price');
                });
            });
        } elseif ($type === 'all' && $deviceType === 'web') {
            $coursesQuery;
        }

        $courses = $coursesQuery->paginate($perPage);
        $message = 'Courses listed successfully.';

        // Transform the courses data without using a resource
        $courses->getCollection()->transform(function ($course) use ($request) {
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
                $purchaseCourse = $user->purchaseCourse()
                                       ->where('course_id', $course->id)
                                       ->orderBy('created_at', 'desc')
                                       ->first();
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
                'module_overview_description' => $course->module_overview_description,
                'course_price_type' => $course->course_price_type ?? 'free',
                'course_price' => $course->course_price ?? 0.0,
                'is_featured' => $course->is_featured,
                'member_add_reviews_on_this' => $course->member_add_reviews_on_this ?? 1,
                'upload_pdf' => $course->upload_pdf,
                'currency' => $currencyCode,
                'stripe_subscription_course_id' => $course->stripe_subscription_course_id,
                'google_pay_id' => $course->google_pay_id,
                'apple_pay_id' => $course->apple_pay_id,
                'course_completed_image' => $course->course_completed_image,
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

        if ($request->wantsJson()) {
            return sendResponse($courses, $message);
        } else {
            if (!auth()->user()->welcome_checklist_complete==1) {
                return redirect()->route('dashboard');
            }
            if ($request->ajax()) {
                $view = view('admin.course.course-list-xhr',compact('courses'))->render();
                return response()->json(['html'=>$view]);
            }

            return view('admin.course.course-list', compact('courses'));
        }
    }

    /**
     * Add Course API
     * @group Courses
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif',
            'course_preview_video' => 'required|mimes:mp4,avi,wmv',
            'course_name' => 'required',
            'course_tagline' => 'nullable',
            'coaches' => 'required',
            'description' => 'required',
            'module_overview_description' => 'nullable',
            'course_price_type' => 'nullable|in:free,paid',
            'course_price' => $request->course_price_type == 'paid' ? 'required|numeric' : 'nullable',
            'member_add_reviews_on_this' => 'nullable|in:0,1',
            'upload_pdf' => 'required|file|mimes:pdf',
            'course_completed_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'status' => 'nullable|in:private,public',
        ],
        [
            'course_thumbnail.required' => 'Please enter the course thumbnail',
            'course_thumbnail.image' => 'The course thumbnail must be an image',
            'course_thumbnail.mimes' => 'The course thumbnail must be a valid image format (jpeg, png, jpg, gif)',
            'course_preview_video.required' => 'Please enter the course preview video',
            'course_preview_video.mimes' => 'The course preview video must be a valid video format (mp4, avi, wmv)',
            'course_name.required' => 'Please enter the course name',
            'coaches.required' => 'Please select the coaches',
            'description' => 'Please enter the description',
            'course_price.required' => 'Please enter the course price',
            'course_price.numeric' => 'Please enter a valid numeric value for the course price',
            'upload_pdf.required' => 'Please upload a pdf',
            'course_completed_image.required' => 'Please enter the course completed image',
            'course_completed_image.image' => 'The course completed image must be an image',
            'course_completed_image.mimes' => 'The course completed image must be a valid image format (jpeg, png, jpg, gif)',
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
        $course = CourseService::createUpdate(new Course, $request);
        $course = new CourseResource($course);
        $message = 'Course added successfully.';
        
        if($request->wantsJson()) {  
            return sendResponse($course, $message);
        } else {
            if ($request->ajax()) {
            
                $view = view('users.post.post_xhr',compact('course'))->render();
                return response()->json(['html'=>$view],);
            }
            return view('admin.course.create' ,  compact('course'));
        }
        
    }

    /**
     * Get Course API
     * @group Courses
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $course = Course::find($id);

        if (!empty($course)) {

            $userId = $request->user();
            $moduleOverviewed = 0;
            if ($userId) {
                $existingModuleOverview = ModuleOverview::where('user_id', $userId->id)
                    ->where('course_id', $id)
                    ->first();

                if (!$existingModuleOverview) {
                    // If no entry exists, create a new one
                    $moduleOverview = new ModuleOverview();
                    $moduleOverview->user_id = $userId->id;
                    $moduleOverview->course_id = (int)$course->id;
                    $moduleOverview->save();
                }
                if ($existingModuleOverview) {
                    $moduleOverviewed = $existingModuleOverview->module_overviewed;
                }
            }
            $coaches = User::whereIn('id', explode(',', $course->coaches))
                ->orderBy('created_at', 'asc')
                ->take(3)
                ->get();

            $courseModules = CourseModule::where('course_id', $course->id)->get();
            $courseModuleTitles = $courseModules->pluck('title');
            $currencyCode = $course->currency ? $course->currency->code : 'AUD';

            $coachesData = [];
            foreach($coaches as $coach) {

                $isFollow = UserActivity::where('following', Auth::user()->id)->where('followers', $coach->id)->count();

                $coachesData[] =  [
                    'id' => $coach->id,
                    'first_name' => $coach->first_name,
                    'last_name' => $coach->last_name,
                    'is_follow' =>  $isFollow >=1 ? 1 : 0,
                    'profile_image' => $coach->profile_image,
                    'cover_image' => $coach->cover_image,
                    'user_type' => $coach->user_type,
                    'timezone' => new TimeZoneResource($coach->timezone),
                    'profile_image_url' => $coach->profile_image_url,
                    'cover_image_url' => $coach->cover_image_url,
                ];
            }

            $course = [
                'id' => $course->id,
                'course_thumbnail' => $course->course_thumbnail,
                'course_preview_video' => $course->course_preview_video,
                'course_name' => $course->course_name,
                'course_tagline' => $course->course_tagline,
                // 'coaches' => UserInfoResource::collection($coaches),
                'coaches' => $coachesData,
                'description' => $course->description,
                'module_overview_description' => $course->module_overview_description,
                'module_overviewed' => $moduleOverviewed,
                'course_price_type' => $course->course_price_type ?? 'free',
                'course_price' => $course->course_price ?? 0.0,
                'is_featured' => $course->is_featured,
                'member_add_reviews_on_this' => $course->member_add_reviews_on_this ?? 1,
                'upload_pdf' => $course->upload_pdf,
                'currency' => $currencyCode,
                'stripe_subscription_course_id' => $course->stripe_subscription_course_id,
                'google_pay_id' => $course->google_pay_id,
                'apple_pay_id' => $course->apple_pay_id,
                'course_completed_image' => $course->course_completed_image,
                'status' => $course->status ?? 'private',
                'last_updated' => $course->updated_at ? $course->updated_at->format('M j, Y') : null,
                'course_material' => [
                    'total_modules' => $courseModules->count(),
                    'modules' => $courseModuleTitles->map(function ($title) {
                        return ['title' => $title];
                    })->toArray(),
                ],
            ];

            $course['course_purchase_status'] = 0;
            if ($user = $request->user()) {
                // Assuming you have a relationship named 'purchaseCourse' in your User model
                $purchaseCourse = $user->purchaseCourse()->where('course_id', $id)->latest()->first();
    
                if ($purchaseCourse) {
                    // If the user has purchased this course, include the purchase details
                    $purchaseStatus = $purchaseCourse->payment_status;
                    $course['course_purchase_status'] = $purchaseStatus;
                }
            }

            $message = 'Course fetched successfully.';
            
            if ($request->wantsJson()) {  
                return sendResponse($course, $message);
            } else {
                if (!auth()->user()->welcome_checklist_complete==1) {
                    return redirect()->route('dashboard');
                }
                if ($request->ajax()) {
                    // Handle AJAX request if needed.
                }
                
                // dd($course['coaches'][0]->first_name);
                return view('users.course.course-buy', compact('course'));
            }
        } else {
            return sendError('Error Occurred');
        }
    }
    
    // public function show(Request $request, $id)
    // {
    //     // $course = Course::find($id);
    //     $course = Course::with('coaches')->find($id);
    //     if(!empty($course)) {
    //         $course = new CourseResource($course);
    //         $message = 'Course fetched successfully.';
            
    //         if($request->wantsJson()) {  
    //             return sendResponse($course, $message);
    //         } else {
    //             if ($request->ajax()) {
    //             }
                
    //             // dd($course);
    //             return view('users.course.course-buy' ,  compact('course'));
    //             // return view('users.course.course-view' ,  compact('course'));   /// This is for Start course
                
    //         }
            
    //     }  
    //     else
    //     {
    //         return sendError('Error Occurred');
    //     }
    // }

    /**
     * Edit Course API
     * @group Courses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 'course_thumbnail' => 'required',
            // 'course_preview_video' => 'required|mimes:mp4,avi,wmv',
            'course_name' => 'required',
            'course_tagline' => 'nullable',
            'coaches' => 'required',
            'description' => 'required',
            'module_overview_description' => 'nullable',
            'course_price_type' => 'nullable|in:free,paid',
            'course_price' => $request->course_price_type == 'paid' ? 'required|numeric' : 'nullable',
            'member_add_reviews_on_this' => 'nullable|in:0,1',
            // 'upload_pdf' => 'required|file|mimes:pdf',
            'status' => 'nullable|in:private,public',
        ],
        [
            // 'course_thumbnail.required' => 'Please enter the course thumbnail',
            // 'course_preview_video.required' => 'Please enter the course preview video',
            'course_name.required' => 'Please enter the course name',
            'coaches.required' => 'Please select the coaches',
            'description' => 'Please enter the description',
            'course_price.required' => 'Please enter the course price',
            'course_price.numeric' => 'Please enter a valid numeric value for the course price',
            // 'upload_pdf.required' => 'Please upload a pdf',
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
        $course = Course::find($id);
        if(!empty($course)) 
        {
            $course = CourseService::createUpdate($course, $request);
            $course = new CourseResource($course);
            $message = 'Course updated successfully.';
            
            if ($request->wantsJson()) {  
                return sendResponse($course, $message);
            } else {
                if ($request->ajax()) {
                    // Handle AJAX request if needed.
                }
                dd($course);
                
                return view('admin.course.course-edit', compact('course'));
            }
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Delete Course API
     * @group Courses
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        if(!empty($course))
        {
            $course->delete();
            $course = new CourseResource($course);
            $message = 'Course deleted successfully.';
            return sendResponse($course, $message);
        }
        else
        {
            return sendError('Error Occurred');
        }
    }
    /**
     * Coach List API
     * @group Courses
     * @return \Illuminate\Http\Response
     */
    public function coachList()
    {
        $coaches = User::select('id', 'first_name', 'last_name', 'profile_image', 'cover_image', 'user_type')
                        ->where('user_type', 'coach')->get();
        $message = 'Coach listed successfully.';
        return sendResponse($coaches, $message);
    }

    /**
     * Featured Course Status Update API
     * @group Courses
     * @return \Illuminate\Http\Response
     */
    public function featuredCourseStatusUpdate(Request $request)
    {
        // Check if the authenticated user is an admin
        if (!auth()->user()->is_admin) {
            return response()->json([
                'status' => 403,
                'statusState' => 'error',
                'message' => 'Unauthorized. Only administrators can perform this action.'
            ], 403);
        }
        $course = Course::find($request->id);
        if(!$course)
        {
            return sendError('Error Occurred');
        }

        $course->is_featured = !$course->is_featured;
        $course->save();
        $message = $course->is_featured ? 'Course featured successfully' : 'Course unfeatured successfully';
        return sendResponse($course, $message);
    }
}
