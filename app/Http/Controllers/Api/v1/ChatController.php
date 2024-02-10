<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use App\Models\ChatMsg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ChatDocument;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct(User $user, ChatMsg $chat)
    {
        $this->_user = $user;
        $this->_chat = $chat;
    }    
    
    
    public function chatMemberList(Request $request)
    {
        $userId = Auth::user()->id;
        $memberList = User::select(
            'users.id',
            'users.first_name',
            'users.last_name',
            'users.user_type',
            'users.profile_image',
            DB::raw('CASE WHEN user_activities.is_block_member = 1 THEN 1 ELSE 0 END AS is_block_member'),
            DB::raw('CASE WHEN user_activities.is_report_member = 1 THEN 1 ELSE 0 END AS is_report_member'),
            DB::raw('(SELECT message FROM chat_msgs WHERE user_id = users.id ORDER BY created_at DESC LIMIT 1) AS last_chat_message'), // Retrieve the last chat message
            DB::raw('(SELECT created_at FROM chat_msgs WHERE user_id = users.id ORDER BY created_at DESC LIMIT 1) AS last_chat_time'), // Retrieve the last chat time
            DB::raw('(SELECT COUNT(*) FROM chat_msgs WHERE user_id = users.id) AS chat_count') // Retrieve the count of chat messages
        )
        ->leftJoin('user_activities', function ($join) use ($userId) {
            $join->on('users.id', '=', 'user_activities.followers')
                ->where('user_activities.following', '=', $userId);
        });

        $search = $request->query('search');
        if ($search) {
            $memberList->where(function ($query) use ($search) {
                $query->where('users.first_name', 'LIKE', "%$search%")
                    ->orWhere('users.last_name', 'LIKE', "%$search%")
                    ->orWhereRaw("CONCAT(users.first_name, ' ', users.last_name) LIKE '%$search%'");
            });
        }

        // Add the condition to filter by welcome_checklist_complete
        $memberList->where('users.welcome_checklist_complete', 1);

        $perPage = $request->query('per_page', 10);
        $chatMemberLists = $memberList->paginate($perPage);
    
        $generatChats = ChatMsg::where('user_id', Auth::user()->id)->pluck('from');
        $results = User::where('status','active')->get();
        $allData = [];
        foreach($results as $user) {
            $last_message =  ChatMsg::where(function($query) use($user){
                $query->where('from', $user->id)->where('user_id', Auth::user()->id);
            })->orWhere(function($query) use($user){
                $query->where('from', Auth::user()->id)->where('user_id', $user->id);
            })->orderBy('id', 'desc')->latest()->first();
            
            // if($last_message && $last_message->message == null){
            //     foreach ( $last_message->documents as $document) {
            //         $doc = $document->document;
            //     }   
            //     $last_message->message = $doc;
            //     $last_message->makeHidden(['documents']);
            // }
            
            $rowRes = new \StdClass;
            $rowRes->id = $user->id;
            $rowRes->name = $user->first_name.' '. $user->last_name;
            $rowRes->profile_image = ($user->profile_image) ? asset('storage/profile/' . $user->profile_image) : asset('assets/images/PersonFill.svg');
            
            $rowRes->created_at = (isset($last_message->created_at) ? $last_message->created_at->format('Y-m-d H:i:s') : '');
            $rowRes->last_message = $last_message;
            $rowRes->message_count = unreadMessagesCount($user->id ,Auth::user()->id);
            $rowRes->allMessageCount = allMessageCount(Auth::user()->id);
            $allData[] = $rowRes;
        }
        $users = (collect($allData)->sortByDesc('created_at')->toArray());
        array_splice($users,1,0);
        
        // dd($users);
        
        $message = 'Chat Member listed successfully.';
        if(!empty($users)) {
            if($request->wantsJson()) {  
                // dd($users);
                return sendResponse($chatMemberLists,$message);
            } else {
                if (!auth()->user()->welcome_checklist_complete==1) {
                    return redirect()->route('dashboard');
                }
                if ($request->ajax()) {
                    $view = view('users.chat.chat_members_xhr',compact('chatMemberLists','users'))->render();
                    return response()->json(['html'=>$view]);
                }
                    return view('users.chat.chat' ,  compact('chatMemberLists','users'));
            }
 
        } else {
            return sendError('Error occurred.');
        }
    }
    
    public function storeChatImage(Request $request)
    {
        $request->validate([
            'documents' => 'required|array|max:10',
            'documents.*' => 'file|max:25600',
        ], [
            'documents.max' => 'File size exceeds maximum limit 25 MB.'
        ]);

        $path = storage_path('app/public/chats/' . Auth::user()->id . '/');

        $documents = [];
        foreach ($request->documents as $key => $file) {
            $name = uniqid() . '_' . $key . '_' . str_replace(' ', '-', trim($file->getClientOriginalName()));
            $file->move($path, $name);
            $link = asset('storage/chats/' . Auth::user()->id . '/' . $name);
            array_push($documents, [
                'link'          => $link,
                'name'          => $name,
                'original_name' => $file->getClientOriginalName(),
            ]);
        }
        return response()->json([
            'documents' => $documents
        ]);
    }
    
    public function showChatMessage(Request $request, $id)
    {
        $chatMemberLists = $this->_chat->where('from', $id)
            ->where('user_id', Auth::user()->id)
            ->where('status', '!=', 2);
            
        $chatMemberLists->update([ 'status' => 2 ]);
        return $this->_chat->with(['vendor', 'documents'])
                // ->whereNull('group_id')
                ->where(function ($query) use ($id) {
                    return $query->where('from', $id)->where('user_id', Auth::user()->id);
                })->orWhere(function ($query) use ($id) {
                    return $query->where('user_id', $id)->where('from', Auth::user()->id);
                })->orderBy('created_at', 'DESC')->paginate(30);                                                                  
        
        $from_user_data = $this->_user->find($id);      
        
        $chatMemberLists['from_user'] = $from_user_data;
        $message = 'Chat user fetched successfully.';   
               
        if($request->wantsJson()) { 
            return sendResponse($chatMemberLists, $message);
        } else {
            if ($request->ajax()) {
                return $chatMemberLists;
            }
            return view('forum.chat.index' ,  compact('chatMemberLists'));
        } 
    }
    
    // public function showChatMessage(Request $request, $id)
    // {
    //     $chatMemberLists = $this->_chat->where('from', $id)
    //                                    ->where('user_id', Auth::user()->id)
    //                                    ->where('status', '!=', 2);
    //     $from_user_data = $this->_user->find($id);
    //     $chatMemberLists->update([ 'status' => 2 ]);
    //     $chatMemberLists = $this->_chat->where(function ($query) use ($id) {
    //         $chatMemberLists = $query->where('from', $id)->where('user_id', Auth::user()->id);
    //     })->orWhere(function ($query) use ($id) {
    //         $chatMemberLists = $query->where('user_id', $id)->where('from', Auth::user()->id);
    //     })->orderBy('created_at', 'DESC')->paginate(30);
        
    //     $chatMemberLists['from_user'] = $from_user_data;
    //     $message = 'Chat Member fetched successfully.';            
    //     if($request->wantsJson()) { 
    //         return sendResponse($chatMemberLists, $message);
    //     } else {
    //         if ($request->ajax()) {
    //             return $chatMemberLists;
    //         }
    //         return view('users.chat.chat' ,  compact('chatMemberLists'));
    //     } 
    // }
    
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


    public function storeChatDocument(Request $request)
    {
        $request->validate([
            'documents' => 'required|array|max:10',
            'documents.*' => 'file|max:25600',
        ], [
            'documents.max' => 'File size exceeds maximum limit 25 MB.'
        ]);

        $path = storage_path('app/public/chats/' . Auth::user()->id . '/');

        $documents = [];
        foreach ($request->documents as $key => $file) {
            $name = uniqid() . '_' . $key . '_' . str_replace(' ', '-', trim($file->getClientOriginalName()));
            $file->move($path, $name);
            $link = asset('storage/chats/' . Auth::user()->id . '/' . $name);
            // $chatMsgId = '';

            // $chatDocument = new ChatDocument();
            // $chatDocument->chat_msg_id = $chatMsgId;
            // $chatDocument->documnet = $name;
            // $chatDocument->save();

            array_push($documents, [
                'link'          => $link,
                'name'          => $name,
                'original_name' => $file->getClientOriginalName(),
            ]);
            $data = [
                'status' => 200,
                'statusState' => 'success',
                'data'    => $documents,
                'message' => 'File send successfully.',
            ];
        }
        return response()->json($data);
    }
}
