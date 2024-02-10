<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\WelcomeChecklist;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Event;
use App\Models\Notification;
use App\Models\Post;
use App\Models\TimeZone;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $request['is_mobile'] = 0;
        $welcomeChecklists = WelcomeChecklists($request);
        $welcome_checklist_complete = $welcomeChecklists['welcome_checklist_complete'];
        $users = User::where('id', Auth::user()->id)->get();
        $countries = Country::all();
        $timeZones = TimeZone::all();
        if(!empty($welcomeChecklists)) {         
            if($request->wantsJson()) {  
                return sendResponse($welcomeChecklists,'Welcome checklist listed.');
            } else {
                if ($request->ajax()) {
                    $view = view('admin.dashboard.welcome_checklist_xhr',compact('welcome_checklist_complete','users', 'countries', 'timeZones', 'welcomeChecklists'))->render();
                    return response()->json(['html'=>$view]);
                }
                if ($welcomeChecklists['welcome_checklist_complete'] == 0) {
                    //return view('users.member.members_list' ,  compact('memberLists'));
                    return view('admin.dashboard.index')->with(compact('welcome_checklist_complete','users', 'countries', 'timeZones', 'welcomeChecklists'));
                } else {
                    return redirect()->route('posts.index');
                }
            }
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'job_title' => 'nullable',
            'company_name' => 'nullable',
            'status' => 'nullable|in:active,inactive',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bio' => 'nullable',
            'leadership_development' => 'nullable',
            'self_development' => 'nullable',
            'culture_uplift' => 'nullable',
            'networking' => 'nullable',
            'personal_link' => 'nullable',
            'timezone' => 'nullable',
            'location' => 'nullable',
            'general' => 'nullable',
            'course' => 'nullable',
            'find_resource' => 'nullable',
        ]);
        
        $user = User::find($id);
        if(!empty($user)) 
        {
            $user = UserService::createUpdate($user, $request);
            $message = 'Your Information Updated Successfully.';
            return redirect()->route('dashboard')->with('message',  $message);
        }
        else
        {
            return sendError('Error Occurred');
        }
    }

    public function edit($id)
    {
        $users = User::findorfail($id);
        return response($users);
    }
}
