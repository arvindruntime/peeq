<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Validator;
use App\Models\UserIssue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserIssueResource;
use App\Services\UserIssueService;

class UserIssueController extends Controller
{
    public $service;
    function __construct(UserIssueService $userIssueService)
	{
		$this->service = $userIssueService;
	}

    /**
     * UserIssue List API
     * @group UserIssues
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userIssues = UserIssue::all();
        $userIssues = UserIssueResource::collection($userIssues);
        return sendResponse($userIssues, 'UserIssue listed successfully.');
    }

    /**
     * Add UserIssue API
     * @group UserIssues
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|regex:/^[\pL\s\-]+$/u',
            'description' => 'required',
        ],
        [
            'title.required' => 'Please enter userIssue title',
            'description.required' => 'Please enter userIssue description',
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
        $userIssue = UserIssueService::createUpdate(new UserIssue, $request);
        $userIssue = new UserIssueResource($userIssue);
        return sendResponse($userIssue, 'userIssue added successfully.');
    }

    /**
     * Get UserIssue API
     * @group UserIssues
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userIssue = UserIssue::find($id);
        if(!empty($userIssue)) {
            $userIssue = new UserIssueResource($userIssue);
            return sendResponse($userIssue, 'UserIssue fetched successfully.');
        }  
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Edit UserIssue API
     * @group UserIssues
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|regex:/^[\pL\s\-]+$/u',
            'description' => 'required',
        ],
        [
            'title.required' => 'Please enter userIssue title',
            'description.required' => 'Please enter userIssue description',
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

        $userIssue = UserIssue::find($id);
        if(!empty($userIssue)) 
        {
            $userIssue = UserIssueService::createUpdate($userIssue, $request);
            $userIssue = new UserIssueResource($userIssue);
            return sendResponse($userIssue, 'UserIssue updated successfully.');
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Delete UserIssue API
     * @group UserIssues
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userIssue = UserIssue::find($id);
        if(!empty($userIssue))
        {
            $userIssue->delete();
            $userIssue = new UserIssueResource($userIssue);
            return sendResponse($userIssue, 'UserIssue deleted successfully.');
        }
        else
        {
            return sendError('Error Occurred');
        }
    }
}
