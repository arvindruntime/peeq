<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Validator;

class MediaController extends Controller
{
    public $service;
    function __construct(MediaService $mediaService)
	{
		$this->service = $mediaService;
	}
    /**
     * Media List API
     * @group Media
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = Media::all();
        $media = MediaResource::collection($media);
        return sendResponse($media, 'Media listed successfully.');
    }

    /**
     * Add Media API
     * @group Media
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'types' => 'required|in:image,video',
            'url' => 'nullable',
            'archive' => 'nullable|in:0,1',
        ],
        [
            'name.required' => 'Please enter name',
            'types.required' => 'Please enter media type',
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
        $media = MediaService::createUpdate(new Media, $request);
        $media = new MediaResource($media);
        return sendResponse($media, 'Media added successfully.');
    }

    /**
     * Get Media API
     * @group Media
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $media = Media::find($id);
        if(!empty($media)) {
            $media = new MediaResource($media);
            return sendResponse($media, 'Media fetched successfully.');
        }  
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Edit Media API
     * @group Media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'types' => 'required|in:image,video',
            'url' => 'nullable',
            'archive' => 'nullable|in:0,1',
        ],
        [
            'name.required' => 'Please enter name',
            'types.required' => 'Please enter media type',
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

        $media = Media::find($id);
        if(!empty($media)) 
        {
            $media = MediaService::createUpdate($media, $request);
            $media = new MediaResource($media);
            return sendResponse($media, 'Media updated successfully.');
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    /**
     * Delete Media API
     * @group Media
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media = Media::find($id);
        if(!empty($media))
        {
            $media->delete();
            $media = new MediaResource($media);
            return sendResponse($media, 'Media deleted successfully.');
        }
        else
        {
            return sendError('Error Occurred');
        }
    }
}
