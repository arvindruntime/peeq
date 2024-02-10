<?php

namespace App\Http\Controllers\Api\v1;

use Validator;
use App\Models\User;
use App\Models\Course;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Models\PlanTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SessionCoachTransaction;
use App\Models\SessionPriceTransaction;
use App\Services\PlanTransactionService;
use App\Http\Resources\PlanTransactionResource;
use App\Http\Resources\CourseTransactionResource;
use App\Http\Resources\SessionTransactionResource;

class PlanTransactionsController extends Controller
{
    public $service;
    function __construct(PlanTransaction $plantransactionService)
	{
		$this->service = $plantransactionService;
	}

    /**
     * Plan Transaction List API
     * @group Plan Transactions
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plantransactions = PlanTransaction::all();
        $plantransactions = PlanTransactionResource::collection($plantransactions);
        return sendResponse($plantransactions, 'Plan listed successfully.');
    }

    /**
     * Add Plan Transaction API
     * @group Plan Transactions
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required|exists:plans,id',
            'plan_active_till' => 'nullable',
            'promo_code' => 'nullable',
            'promo_code_dis' => 'nullable',
            'final_amount' => 'nullable',
        ],
        [
            'plan_id.required' => 'Please enter plan id',
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
        $plantransaction = PlanTransactionService::createUpdate(new PlanTransaction, $request);
        $plantransaction = new PlanTransactionResource($plantransaction);
        return sendResponse($plantransaction, 'Plan added successfully.');
    }

    /**
     * Get Plan Transaction API
     * @group Plan Transactions
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plantransaction = PlanTransaction::find($id);
        if(!empty($plantransaction)) {
            $plantransaction = new PlanTransactionResource($plantransaction);
            return sendResponse($plantransaction, 'Plan fetched successfully.');
        }  
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Edit Plan Transaction API
     * @group Plan Transactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required',
            'plan_active_till' => 'nullable',
            'promo_code' => 'nullable',
            'promo_code_dis' => 'nullable',
            'final_amount' => 'nullable',
        ],
        [
            'plan_id.required' => 'Please enter plan id',
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

        $plantransaction = PlanTransaction::find($id);
        if(!empty($plantransaction)) 
        {
            $plantransaction = PlanTransactionService::createUpdate($plantransaction, $request);
            $plantransaction = new PlanTransactionResource($plantransaction);
            return sendResponse($plantransaction, 'Plan updated successfully.');
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Delete Plan Transaction API
     * @group Plan Transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plantransaction = PlanTransaction::find($id);
        if(!empty($plantransaction))
        {
            $plantransaction->delete();
            $plantransaction = new PlanTransactionResource($plantransaction);
            return sendResponse($plantransaction, 'Plan deleted successfully.');
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Purchase Plan Info API
     * @group Plan Transactions
     * @return \Illuminate\Http\Response
     */
    public function purchasePlanInfo(Request $request)
    {
        $user = $request->user();
        if(!empty($user) ) {
            $purchasePlan = $user->purchasePlan;
            $purchasePlan = new PlanTransactionResource($purchasePlan);
            return sendResponse($purchasePlan, 'Purchase plan data fetched successfully.');
        } else {
            return sendError('Error Occurred');
        }
    }

    /**
     * Course Purchase API
     * @group Course Transactions
     * @return \Illuminate\Http\Response
     */
    public function coursePurchase(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id',
            'type' => 'required|in:course',
            'device_type' => 'nullable|in:android,ios,web',
            'course_price_type' => 'nullable|in:free,paid',
        ],
        [
            'course_id.required' => 'Please enter the course id',
            'type.required' => 'Please enter the type',
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
        $course = Course::find($request->course_id);

        if (!$course) {
            return response()->json([
                'status' => 404,
                'statusState' => 'error',
                'message' => 'Course not found',
            ], 404);
        }

        $coursePrice = $course->course_price;
        $finalAmount = $coursePrice; 

        $coursetransaction = new PlanTransaction;
        $coursetransaction->user_id = Auth::user()->id;
        $coursetransaction->course_id = $request->course_id;
        $coursetransaction->type = $request->type;
        $coursetransaction->device_type = $request->device_type;
        $coursetransaction->course_price_type = $request->course_price_type;
        $coursetransaction->transaction_id = $request->transaction_id;
        $coursetransaction->payment_token = $request->payment_token;
        $coursetransaction->final_amount = $finalAmount;
        $coursetransaction->payment_status = (int)$request->payment_status;
        $coursetransaction->save();
        $coursetransaction = new CourseTransactionResource($coursetransaction);
        return sendResponse($coursetransaction, 'Course purchased successfully.');
    }

    /**
     * Purchase Course Info API
     * @group Course Transactions
     * @return \Illuminate\Http\Response
     */
    public function purchaseCourseInfo(Request $request)
    {
        $user = $request->user();

        if (!empty($user)) {
            // Assuming you have a relationship named 'purchaseCourse' in your User model
            $purchaseCourse = $user->purchaseCourse()->where('type', 'course')->where('payment_status', 1)->first();

            if ($purchaseCourse) {
                // If a course payment with 'type' equal to 'course' exists, transform it into a resource
                $purchaseCourseResource = new CourseTransactionResource($purchaseCourse);

                return sendResponse($purchaseCourseResource, 'Purchase course data fetched successfully.');
            } else {
                return sendError('No course payment found for the authenticated user.');
            }
        } else {
            return sendError('Error Occurred');
        }
    }

    /**
     * Session Purchase API
     * @group Session Transactions
     * @return \Illuminate\Http\Response
     */
    public function sessionPurchase(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'session_id' => 'required|exists:sessions,id',
            'session_price_transaction_id' => 'required|exists:session_price_transactions,id',
            'type' => 'required|in:session',
            'device_type' => 'nullable|in:android,ios,web',
            'session_price_type' => 'nullable|in:free,paid',
        ],
        [
            'session_id.required' => 'Please enter the session id',
            'session_price_transaction_id.required' => 'Please enter the session price transaction id',
            'type.required' => 'Please enter the type',
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
        $sessionPrice = SessionPriceTransaction::find($request->session_price_transaction_id);

        if (!$sessionPrice) {
            return response()->json([
                'status' => 404,
                'statusState' => 'error',
                'message' => 'Session not found',
            ], 404);
        }

        if(!empty($request->session_price_transaction_id)){
            $priceSession = SessionPriceTransaction::find($request->session_price_transaction_id);
        }

        $sessionCoach = SessionCoachTransaction::where('session_id', $request->session_id)->first();
        if ($sessionCoach) {
            $user = User::find($sessionCoach->coach_id);
            if ($user) {
                $coachName = $user->first_name . ' ' . $user->last_name;
            }
        }
        
        $sessionTransaction = new PlanTransaction;
        $sessionTransaction->user_id = Auth::user()->id;
        $sessionTransaction->session_id = (int)$request->session_id;
        $sessionTransaction->type = $request->type;
        $sessionTransaction->device_type = $request->device_type;
        $sessionTransaction->session_price_type = $request->session_price_type;
        $sessionTransaction->transaction_id = $request->transaction_id;
        $sessionTransaction->session_duration = (int)$priceSession->session_duration;
        $sessionTransaction->session_price = (int)$priceSession->session_price;
        $sessionTransaction->calendly_description = $priceSession->calendly_description;
        $sessionTransaction->payment_token = $request->payment_token;
        $sessionTransaction->final_amount = (int)$priceSession->session_price;
        $sessionTransaction->payment_status = (int)$request->payment_status;
        $sessionTransaction->save();
        $sessionTransaction = new SessionTransactionResource($sessionTransaction);
        $message = 'Your 1:1 coaching session with ' . $coachName . ' has been successfully secured.';
        return sendResponse($sessionTransaction, $message);
    }

    /**
     * Purchase Session Info API
     * @group Session Transactions
     * @return \Illuminate\Http\Response
     */
    public function purchaseSessionInfo(Request $request)
    {
        $user = $request->user();

        if (!empty($user)) {
            // Assuming you have a relationship named 'purchaseSession' in your User model
            $purchaseSession = $user->purchaseSession()->where('type', 'session')->where('payment_status', 1)->first();

            if ($purchaseSession) {
                // If a session payment with 'type' equal to 'session' exists, transform it into a resource
                $purchaseSessionResource = new SessionTransactionResource($purchaseSession);

                return sendResponse($purchaseSessionResource, 'Purchase session data fetched successfully.');
            } else {
                return sendError('No session payment found for the authenticated user.');
            }
        } else {
            return sendError('Error Occurred');
        }
    }
}
