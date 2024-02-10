<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Validator;
use App\Models\PostComment;
use Illuminate\Http\Request;
use App\Services\PostCommentService;
use App\Http\Resources\PostCommentResource;

class PostCommentController extends Controller
{
    public $service;
    function __construct(PostCommentService $postCommentService)
    {
        $this->service = $postCommentService;
    }

    /**
     * Post Comment List API
     * @group Post Comments
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, Request $request)
    {
        $postComments = PostComment::whereHas('post', function ($query) use ($post) {
            $query->where('id', $post->id);
            return $query;
        })->get();
        $postComments = PostCommentResource::collection($postComments);
        return sendResponse(compact('post','postComments'), 'Post comments listed successfully.');
    }

    /**
     * Add Post Comment API
     * @group Post Comments
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post, PostComment $postComment, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
            'comment_text' => 'required',
        ],
        [
            'post_id.required' => 'Please enter the post id',
            'comment_text.required' => 'Please enter the comment',
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
        $postComment = PostCommentService::createUpdate($post, $postComment, $request);
        $postComment = new PostCommentResource($postComment);
        return sendResponse($postComment, 'Post comment added successfully.');
    }

    /**
     * Get Post API
     * @group Posts
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, $id, Request $request)
    {
        $postComment = PostComment::find($id);
        if(!empty($postComment)) {
            $postComment = new PostCommentResource($postComment);
            return sendResponse($postComment, 'Post comment fetched successfully.');
        }  
        else
        {
            return sendError('Error Occurred');
        }
    }
}
