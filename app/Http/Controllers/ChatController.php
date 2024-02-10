<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function show($id)
    {
        $chat_users = User::select('id', 'first_name', 'last_name', 'bio', 'location_id', 'personal_link', 'user_type', 'updated_at', 'profile_image', 'cover_image')
            ->with('location')
            ->find($id);
        // dd($user);
        return view('users.chat.chat',compact('chat_users'));
    }
    
    public function encodeString(Request $request)
    {
        $string = encryptString($request->string);
        return sendResponse([
            'string' => $string,
        ]);
    }

    public function decodeString(Request $request)
    {
        $string = decryptString($request->string);
        return sendResponse([
            'string' => $string,
        ]);
    }
}
