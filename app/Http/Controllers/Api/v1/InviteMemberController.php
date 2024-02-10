<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Validator;
use App\Models\User;
use App\Models\InviteMember;
use Illuminate\Http\Request;
use App\Mail\InviteMemberMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\InviteMemberResource;

class InviteMemberController extends Controller
{
    /**
     * Invite Member API
     * @group Invite Members
     * @return \Illuminate\Http\Response
     */
    public function sendInviteEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=> 'required|email:dns',
            'invite_type' => 'nullable|in:member,course,session',
            'user_type' => 'nullable|in:host,coach,member',
            // 'message' => 'required',
        ],
        [
            'email.required' => 'Please enter the email',
            'email.email' => 'You have entered an invalid email',
            // 'message.required' => 'Please enter the message',
            // 'user_type.required' => 'Please select the user type',
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

    $email_array = $request->email;    
    
    $emails = explode(',', $email_array);
    foreach ($emails as $email)
    {
        $inviteMember = new InviteMember;
        $inviteMember->email = $email;
        $inviteMember->message = $request->message;
        $inviteMember->user_type = $request->user_type;
        $inviteMember->invite_type = $request->invite_type;
        $inviteMember->subject = 'Invite ' . ($request->invite_type ? $request->invite_type : 'Member');
        $inviteMember->invite_by = Auth::user()->id;

        // if($inviteMember->invite_type == 'course'){
        //     $invitationLink = URL::route('user.courses.list'); 
        // } else {
            $invitationLink = URL::route('login');  
        // }
        $user = User::where('email', $request->email)->first();
        if($user) {
            $inviteMember->status = 'Subscribed';
            // $inviteMember->save();
        } else {
            $inviteMember->status = 'Invitation Sent';
        }
        $inviteMember->save();

        try {
            $receiver = User::where('email', $email)->first();
            if ($receiver) {
                $receiverName = $receiver->first_name;
            } else {
                $receiverName = 'Recipient'; // Set a default greeting
            }
            if(isset($inviteMember->message)) {
                $additionalMessage = $inviteMember->message;
            } else {
                $additionalMessage = '';
            }
                // Send the email to the user
                Mail::to($email)->send(new InviteMemberMail($invitationLink, $receiverName, $additionalMessage));

        } catch (Exception $e) {
            // Log the email sending error for debugging purposes
            Log::error('Error sending invite member email');
            Log::error('Error message: ' . $e->getMessage());
        }
    }

        return sendResponse($inviteMember, 'Invitation sent successfully.');
    }

    /**
     * Sent Invite Member List API
     * @group Invite Members
     * @return \Illuminate\Http\Response
     */
    public function sentInviteMembers(Request $request)
    {
        $perPage = $request->query('per_page', 15);
        $inviteMembers = InviteMember::where('invite_by', Auth::user()->id)->paginate($perPage);

        if ($inviteMembers->count() > 0) {
            // Access the email values
            foreach ($inviteMembers as $inviteMember) {
                $user = User::where('email', $inviteMember->email)->first();

                if ($user) {
                    $inviteMember['last_updated'] = $inviteMember->updated_at->format('D, M j, Y'); // Rename 'updated_at' key to 'last_updated'
                    unset($inviteMember['updated_at']); // Remove the old 'updated_at' key
                    $inviteMember['first_name'] = $user->first_name;
                    $inviteMember['last_name'] = $user->last_name;
                    $inviteMember['invite_by'] = Auth::user()->first_name . ' ' . Auth::user()->last_name;
                } else {
                    $inviteMember->last_updated = $inviteMember->updated_at->format('D, M j, Y');
                    unset($inviteMember->updated_at);
                    $inviteMember->first_name = '--';
                    $inviteMember->last_name = '--';
                    $inviteMember->invite_by = Auth::user()->first_name . ' ' . Auth::user()->last_name;
                }
            }
            $message = 'Sent invites listing successfully.';
        }
        else
        {
            $message = 'Record not found!';
        }
                          
        if($request->wantsJson()) {  
            return sendResponse($inviteMembers, $message);
        } else {
            if (!auth()->user()->welcome_checklist_complete==1) {
                return redirect()->route('dashboard');
            }
            if ($request->ajax()) {
                $view = view('users.invite_members_xhr',compact('inviteMembers'))->render();
                return response()->json(['html'=>$view]);
            }
            return view('users.invite_members_xhr' ,  compact('inviteMembers'));
        }
    }
}
