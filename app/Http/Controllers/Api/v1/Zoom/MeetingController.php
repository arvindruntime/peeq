<?php

namespace App\Http\Controllers\Api\v1\Zoom;

use App\Http\Controllers\Controller;
use App\Traits\ZoomJWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeetingController extends Controller
{
    
    use ZoomJWT;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    /**
     * Meeting List API
     * @group Zoom Meetings
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request) 
    { 
        $path = 'users/me/meetings';
        $response = $this->zoomGet($path);
        $data = json_decode($response->body(), true);
        return [
            'success' => 200,
            'statusState' => 'success',
            'data' => $data,
            'message' => 'Zoom meeting listed successfully.',
        ]; 
    }

    /**
     * Create Meeting API
     * @group Zoom Meetings
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'topic' => 'required|string',
            'start_time' => 'required|date',
            'agenda' => 'string|nullable',
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
        $data = $validator->validated();
        $path = 'users/me/meetings';
        $response = $this->zoomPost($path, [
            'topic' => $data['topic'],
            'type' => self::MEETING_TYPE_SCHEDULE,
            'start_time' => $this->toZoomTimeFormat($data['start_time']),
            'duration' => 120,
            'agenda' => $data['agenda'],
            'settings' => [
                'host_video' => false,
                'participant_video' => false,
                'waiting_room' => true,
                ]
            ]);
            return [
                'success' => 200,
                'statusState' => 'success',
                'data' => json_decode($response->body(), true),
                'message' => 'Zoom meeting created successfully.',
            ];
        }

    /**
     * Get Meeting API
     * @group Zoom Meetings
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request, string $id) 
    {  
        $path = 'meetings/' . $id;
        $response = $this->zoomGet($path);
        $data = json_decode($response->body(), true);
        return [
            'success' => 200,
            'statusState' => 'success',
            'data' => $data,
            'message' => 'Zoom meeting fetched successfully.',
        ];
    }
    
    /**
     * Edit Meeting API
     * @group Zoom Meetings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'topic' => 'required|string',
            'start_time' => 'required|date',
            'agenda' => 'string|nullable',
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
        $data = $validator->validated();

        $path = 'meetings/' . $id;
        $response = $this->zoomPatch($path, [
            'topic' => $data['topic'],
            'type' => self::MEETING_TYPE_SCHEDULE,
            'start_time' => (new \DateTime($data['start_time']))->format('Y-m-d\TH:i:s'),
            'duration' => 30,
            'agenda' => $data['agenda'],
            'settings' => [
                'host_video' => false,
                'participant_video' => false,
                'waiting_room' => true,
            ]
        ]);

        // Retrieve the updated meeting details
        $updatedMeetingResponse = $this->zoomGet($path);
        $updatedMeetingData = json_decode($updatedMeetingResponse->body(), true);

        return [
            'success' => 200,
            'statusState' => 'success',
            'data' => $updatedMeetingData,
            'message' => 'Zoom meeting updated successfully.',
        ];
    }
    
    /**
     * Delete Meeting API
     * @group Zoom Meetings
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, string $id)
    {
        $path = 'meetings/' . $id;

        // Fetch the meeting data before deleting
        $preDeleteResponse = $this->zoomGet($path);
        $preDeleteData = json_decode($preDeleteResponse->body(), true);

        // Delete the meeting
        $response = $this->zoomDelete($path);

        return [
            'success' => 200,
            'statusState' => 'success',
            'data' => $preDeleteData, // Return the pre-delete meeting data
            'message' => 'Zoom meeting deleted successfully.',
        ];
    }
}
