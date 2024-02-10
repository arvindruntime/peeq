<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;

class NotificationController extends Controller
{
    public $service;
    function __construct(NotificationService $notificationService)
	{
		$this->service = $notificationService;
	}

    /**
     * Notification List API
     * @group Notifications
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = notificationList();
        return sendResponse($notifications, 'Notifications listed successfully.');
    }

    /**
     * Add Notification API
     * @group Notifications
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ],
        [
            'title.required' => 'Please enter the notification title',
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
        $notification = NotificationService::createUpdate(new Notification, $request);
        $notification = new NotificationResource($notification);
        return sendResponse($notification, 'Notification added successfully.');
    }

    /**
     * Get Notification API
     * @group Notifications
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = Notification::find($id);
        if(!empty($notification)) {
            $notification = new NotificationResource($notification);
            return sendResponse($notification, 'Notification fetched successfully.');
        }  
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Edit Notification API
     * @group Notifications
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ],
        [
            'title.required' => 'Please enter the notification title',
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

        $notification = Notification::find($id);
        if(!empty($notification)) 
        {
            $notification = NotificationService::createUpdate($notification, $request);
            $notification = new NotificationResource($notification);
            return sendResponse($notification, 'Notification updated successfully.');
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Delete Notification API
     * @group Notifications
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = Notification::find($id);
        if(!empty($notification))
        {
            $notification->delete();
            $notification = new NotificationResource($notification);
            return sendResponse($notification, 'Notification deleted successfully.');
        }
        else
        {
            return sendError('Error Occurred');
        }
    }
}
