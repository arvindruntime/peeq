<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebEditorController extends Controller
{
    public function index(){
        return view('users.editor.editor');
    }
    
    public function upload(Request $request)
    {
        $path = $request->file('file')->store('public/videos');
        $url = url(Storage::url($path));

        return response()->json(['link' => $url]);
    }    
    
    public function uploadImage(Request $request)
    {  
         // Get the uploaded file
        $file = $request->file('file');

        // Generate a unique filename  
        $filename = md5(time()) . '.' . $file->extension();    
       
        // Store the image in the storage directory
        $file->storeAs('public/post_image', $filename);

        // Return the URL of the uploaded image
        $url = asset('storage/post_image/' . $filename);
       
        return response()->json([
            'status' => 'success',
            'link' => $url
        ]);
    }
}
