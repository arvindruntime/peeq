<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Services\PlanService;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset(Auth::user()->is_admin) && Auth::user()->is_admin==1)
        {   
            $page_title = 'Plans';
            $plans = Plan::all();
            $message = 'Plan listed successfully.';
            return view('admin.plan.index', compact('page_title','plans'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
       $data = $request->validate([
            'plan_title' => 'required',
            'plan_description' => 'required',
            'plan_type' => 'required',
            'plan_amount' => 'required|numeric',
            'plan_image' => 'nullable',
        ],
        [
            'plan_title.required' => 'Please enter the plan title',
            'plan_description.required' => 'Please enter the plan description',
            'plan_type.required' => 'Please select the plan type',
            'plan_amount.required' => 'Please enter the plan amount',
        ]);
        if($data){
            $plan = PlanService::createUpdate(new Plan, $request);
            return response()->json(['status' => 'success', 
            'data' =>[], 
            'message' => 'Plan created successfully!'
        ], 200);
        } else {
            return response()->json(['error'=>'Please enter form detail.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $plans = Plan::findorfail($id);
        return response($plans);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'plan_title' => 'required',
            'plan_description' => 'required',
            'plan_type' => 'required',
            'plan_amount' => 'required|numeric',
            'plan_image' => 'nullable'
        ],
        [
            'plan_title.required' => 'Please enter the plan title',
            'plan_description.required' => 'Please enter the plan description',
            'plan_type.required' => 'Please select the plan type',
            'plan_amount.required' => 'Please enter the plan amount',
        ]);
        $plan = Plan::find($id);
        if(!empty($plan)) 
        {
            $plan = PlanService::createUpdate($plan, $request);
            return response()->json(['status' => 'success', 
            'data' =>[], 
            'message' => 'Plan Updated successfully!'
        ], 200);
        }
        else
        {
            return response()->json(['error'=>'Please enter form detail.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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
