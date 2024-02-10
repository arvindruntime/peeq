<?php

namespace App\Http\Controllers\Api\v1;

use Validator;
use Illuminate\Http\Request;
use App\Models\InteractiveWorkbook;
use App\Http\Controllers\Controller;
use App\Http\Resources\InteractiveWorkbookResource;
use App\Services\InteractiveWorkbookService;

class InteractiveWorkbookController extends Controller
{
    /**
     * Interactive Workbook List API
     * @group Interactive Workbooks
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $interactiveWorkbooks = InteractiveWorkbook::paginate($perPage);
        InteractiveWorkbookResource::collection($interactiveWorkbooks);
        $message = 'Interactive workbooks listed successfully.';
        return sendResponse($interactiveWorkbooks, $message);
    }

    /**
     * Add Interactive Workbook API
     * @group Interactive Workbooks
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'course_module_id' => 'required',
            // 'page_no' => 'required',
            'pdf_content' => 'required',
            // 'interactive_content' => 'required',
            // 'audio_file' => 'required|mimes:mp3,wav,ogg',
        ],
        [
            'course_id.required' => 'Please enter a course id',
            'course_module_id.required' => 'Please enter a course module id',
            // 'page_no.required'=>'Please enter a page number',
            'pdf_content.required' => 'Please enter a pdf content',
            // 'interactive_content.required' => 'Please enter a interactive content',
            // 'audio_file'=>'Please enter a audio file'
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
        $interactiveWorkbook = InteractiveWorkbookService::createUpdate(new InteractiveWorkbook, $request);
        $interactiveWorkbook = new InteractiveWorkbookResource($interactiveWorkbook);
        $message = 'Interactive workbook added successfully.';
        return sendResponse($interactiveWorkbook, $message);
    }

    /**
     * Show Interactive Workbook API
     * @group Interactive Workbooks
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $interactiveWorkbook = InteractiveWorkbook::find($id);
        if(!empty($interactiveWorkbook)) {
            $interactiveWorkbook = new InteractiveWorkbookResource($interactiveWorkbook);
            $message = 'Interactive workbook fetched successfully.';
            return sendResponse($interactiveWorkbook, $message);
        }  
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Edit Interactive Workbook API
     * @group Interactive Workbooks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 'course_id' => 'required',
            // 'course_module_id' => 'required',
            // 'page_no' => 'required',
            'pdf_content' => 'required',
        ],
        [
            // 'course_id.required' => 'Please enter a course id',
            // 'course_module_id.required' => 'Please enter a course module id',
            // 'page_no.required'=>'Please enter a page number',
            'pdf_content.required' => 'Please enter a pdf content',
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

        $interactiveWorkbook = InteractiveWorkbook::find($id);
        if(!empty($interactiveWorkbook)) 
        {
            $interactiveWorkbook = InteractiveWorkbookService::createUpdate($interactiveWorkbook, $request);
            $interactiveWorkbook = new InteractiveWorkbookResource($interactiveWorkbook);
            $message = 'Interactive workbook updated successfully.';
            return sendResponse($interactiveWorkbook, $message);
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Delete Interactive Workbook API
     * @group Interactive Workbooks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $interactiveWorkbook = InteractiveWorkbook::find($id);
        if(!empty($interactiveWorkbook))
        {
            $interactiveWorkbook->delete();
            $interactiveWorkbook = new InteractiveWorkbookResource($interactiveWorkbook);
            $message = 'Interactive workbook deleted successfully.';
            return sendResponse($interactiveWorkbook, $message);
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Interactive Workbook Web Url API
     * @group Interactive Workbooks
     * @return \Illuminate\Http\Response
     */
    public function interactiveWorkbookUrl()
    {
        $app_url = env('APP_URL');
        $interactiveWorkbook = $app_url . '/' . 'interactive-workbook';
        $message = 'Interactive workbook listed successfully.';
        
        $response = [
            'status' => 200,
            'statusState' => 'success',
            'data' => [
                'interactiveWorkbook' => $interactiveWorkbook,
            ],
            'message' => $message,
        ];
        
        return response()->json($response);
    }
}
