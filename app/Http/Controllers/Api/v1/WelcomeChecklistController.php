<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\WelcomeChecklist;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WelcomeChecklistController extends Controller
{
    /**
     * Welcome Checklist List API
     * @group Welcome Checklists
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $welcomeChecklists = welcomeChecklists($request);
        $welcome_checklist_complete = $welcomeChecklists['welcome_checklist_complete'];
        $welcomeChecklists = $welcomeChecklists['welcomeChecklists'];
        $message = 'Welcome checklist listed successfully.';        
        
        
        if(!empty($welcomeChecklists)) {         
            if($request->wantsJson()) {  
                return sendResponse(compact('welcome_checklist_complete', 'welcomeChecklists'), $message);
            } else {
                if ($request->ajax()) {
                     $view = view('admin.dashboard.welcome_checklist_xhr',compact('welcome_checklist_complete','welcomeChecklists'))->render();
                    return response()->json(['html'=>$view]);
                }
                return view('admin.dashboard.index')->with(compact('welcome_checklist_complete', 'welcomeChecklists'));
            }
        }
        
        
        // if($request->wantsJson()) {  
            
        // } else {
        //     $users = User::where('id', Auth::user()->id)->get();
        //     $countries = Country::all();
        //     // if ($request->ajax()) {
        //         $view = view('admin.dashboard.welcome_checklist',compact('users', 'countries', 'welcome_checklist_complete', 'welcomeChecklists'))->render();
        //         return response()->json(['html'=>$view]);
        //     // }
        //     // return view('admin.dashboard.index')->with(compact('welcome_checklist_complete','users', 'countries', 'welcomeChecklists'));
        // }
        
        
    }

    /**
     * Download App Step Verification API
     * @group Download APP Step Verification
     * @return \Illuminate\Http\Response
     */
    public function downloadApp(Request $request)
    {
        $request->steps = ["5"];

        $downloadApp = downloadApp($request);

        $message = "Download the app";

        return sendResponse(compact('downloadApp'), $message);
        
    }
}
