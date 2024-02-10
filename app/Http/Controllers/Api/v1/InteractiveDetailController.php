<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\InteractiveDetailResource;
use App\Models\InteractiveDetail;
use App\Services\InteractiveDetailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class InteractiveDetailController extends Controller
{
    /**
     * Add or update Interactive Detail API
     * @group Interactive Details
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'interactive_workbook_id' => 'required',
            'content' => 'nullable',
        ],
        [
            'interactive_workbook_id.required' => 'Please enter the interactive workbook id',
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
        // Create or update the InteractiveDetail
        $interactiveDetail = InteractiveDetailService::createUpdate(new InteractiveDetail, $request);
        if ($interactiveDetail) {
            $message = 'Workbook is now saved, you may close this tab.';
            $interactiveDetail = new InteractiveDetailResource($interactiveDetail);
            return sendResponse($interactiveDetail, $message);
        } else {
            $message = 'Failed to update interactive detail.';
            return sendError($message);
        }
    }

    /**
     * Delete Interactive Detail API
     * @group Interactive Details
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $interactiveDetail = InteractiveDetail::find($id);
        if(!empty($interactiveDetail))
        {
            $interactiveDetail->delete();
            $interactiveDetail = new InteractiveDetailResource($interactiveDetail);
            $message = 'Interactive detail deleted successfully.';
            return sendResponse($interactiveDetail, $message);
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Get Interactive Details Userwise API
     * @group Interactive Details
     * @return \Illuminate\Http\Response
     */
    public function getDetailsUserwise($interactive_workbook_id, $user_id = '')
    {
       // $authenticatedUser = Auth::user();

        // if (!$authenticatedUser) {
        //     return response()->json(
        //         [
        //             'status' => 401,
        //             'statusState' => 'error',
        //             'message' => 'User not authenticated.',
        //         ],401
        //     );
        // }
       // $authenticatedUser->id=$user_id;
        $interactiveDetails = InteractiveDetail::where('user_id', $user_id)
            ->where('interactive_workbook_id', $interactive_workbook_id)
            ->get();

        if ($interactiveDetails->isEmpty()) {
            $message = 'No interactive details found for the specified user and workbook.';
            return response()->json(
                [
                    'status' => 400,
                    'statusState' => 'error',
                    'message' => $message,
                ],400
            );
        }

        $message = 'Interactive details fetched successfully for the specified user and workbook.';
        return sendResponse($interactiveDetails, $message);
    }
}
