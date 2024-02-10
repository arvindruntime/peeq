<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Validator;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\PlanService;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public $service;
    function __construct(PlanService $planService)
	{
		$this->service = $planService;
	}

    /**
     * Plan List API
     * @group Plans
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Plans';
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $userCreatedDate = $user->created_at;
        $oneYearAgo = now()->subYear();
        $planExpire = (int)$userCreatedDate->lessThan($oneYearAgo);
        if($planExpire == 1) {
            $plans = Plan::where('status', 'active')
                        ->where('price_type', 'paid')
                        ->get();
        } else {
            $plans = Plan::where('status', 'active')
                        ->where('price_type', 'free')
                        ->get();
        }
        $message = 'Plan listed successfully.';
        $plans = PlanResource::collection($plans);
        return sendResponse(compact('plans'), $message);
        
    }

    /**
     * Add Plan API
     * @group Plans
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_title' => 'required|regex:/^[\pL\s\-]+$/u',
            'plan_description' => 'required',
            'plan_type' => 'required|in:monthly,yearly',
            'price_type' => 'nullable|in:free,paid',
            'plan_amount' => 'required',
            'plan_duration' => 'nullable',
            'plan_image' => 'nullable',
            'currency_id' => 'nullable',
            'stripe_subscription_plan_id' => 'nullable',
            'google_pay_id' => 'nullable',
            'apple_pay_id' => 'nullable',
            'status' => 'nullable|in:active,inactive',
        ],
        [
            'plan_title.required' => 'Please enter the plan title',
            'plan_description.required' => 'Please enter the plan description',
            'plan_type.required' => 'Please enter the plan type',
            'plan_amount.required' => 'Please enter the plan amount',
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
        $plan = PlanService::createUpdate(new Plan, $request);
        $plan = new PlanResource($plan);
        return sendResponse($plan, 'Plan added successfully.');
    }

    /**
     * Get Plan API
     * @group Plans
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = Plan::find($id);
        if(!empty($plan)) {
            $plan = new PlanResource($plan);
            return sendResponse($plan, 'Plan fetched successfully.');
        }  
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Edit Plan API
     * @group Plans
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'plan_title' => 'required|regex:/^[\pL\s\-]+$/u',
            'plan_description' => 'required',
            'plan_type' => 'required|in:monthly,yearly',
            'price_type' => 'nullable|in:free,paid',
            'plan_amount' => 'required',
            'plan_duration' => 'nullable',
            'plan_image' => 'nullable',
            'currency_id' => 'nullable',
            'stripe_subscription_plan_id' => 'nullable',
            'google_pay_id' => 'nullable',
            'apple_pay_id' => 'nullable',
            'status' => 'nullable|in:active,inactive',
        ],
        [
            'plan_title.required' => 'Please enter the plan title',
            'plan_description.required' => 'Please enter the plan description',
            'plan_type.required' => 'Please enter the plan type',
            'plan_amount.required' => 'Please enter the plan amount',
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

        $plan = Plan::find($id);
        if(!empty($plan)) 
        {
            $plan = PlanService::createUpdate($plan, $request);
            $plan = new PlanResource($plan);
            return sendResponse($plan, 'Plan updated successfully.');
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Delete Plan API
     * @group Plans
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = Plan::find($id);
        if(!empty($plan))
        {
            $plan->delete();
            $plan = new PlanResource($plan);
            return sendResponse($plan, 'Plan deleted successfully.');
        }
        else
        {
            return sendError('Error Occurred');
        }
    }
}
