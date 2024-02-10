<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\PostActivity;
use App\Services\PostService;
use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 0)->orderby('id', 'DESC')->get();
        return view('users.post.index' ,  compact('posts'));
    }

    public function store(Request $request)
    {
       $data = $request->validate([
            'content' => 'required',
        ],
        [
            'content.required' => 'Please enter the Post content',
        ]);
        if($data){
            $plan = Post::create($request->all());
            return response()->json(['status' => 'success', 
            'data' =>$plan, 
            'message' => 'A Post has been created successfully!'
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
        $plans = Post::findorfail($id);
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
            'content' => 'required',
        ],
        [
            'content.required' => 'Please enter the plan title',
        ]);
        $plan = Post::find($id);
        if(!empty($plan)) 
        {
            $plan = PostService::createUpdate($plan, $request);
            return response()->json(['status' => 'success', 
            'data' =>[], 
            'message' => 'Post Updated successfully!'
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
        $plan = Post::find($id);
        if(!empty($plan))
        {
            $plan->delete();
            $plan = new PostResource($plan);
            return response()->json(['status' => 'success','data' =>[$plan], 'message' => 'Post Deleted successfully!'], 200);
        }
        else
        {
            return sendError('Error Occurred');
        }
    }   

    public function mute($id, Request $request)
    {
        $plan = Post::find($id);
        if(!empty($plan)) 
        {
            $plan = PostService::createUpdate($plan, $request);
            return response()->json(['status' => 'success', 
            'data' =>[], 
            'message' => 'Post Updated successfully!'
        ], 200);
        }
        else
        {
            return response()->json(['error'=>'Please enter form detail.']);
        }
    }

    public function save($id, Request $request)
    {
        $plan = PostActivity::where('post_id', '=' ,$id)->first();
        if($plan != null) 
        {
            if($plan->Is_save == 0){
                $plan = PostActivity::where('post_id', $id)->update(["Is_save" => "1"]);
            } else {    
                $plan = PostActivity::where('post_id', $id)->update(["Is_save" => "0"]);
            }
            
            return response()->json(['status' => 'success', 'data' =>[], 'message' => 'Post Has been saved successfully!'], 200);
        }
        else
        {
            $plan = PostActivity::create($request->all());
            return response()->json(['status' => 'success','data' =>[], 'message' => 'Post Has been saved successfully!'], 200);
        }
    }
}
