<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\EmailTemplateService;
use App\Http\Resources\EmailTemplateResource;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset(Auth::user()->is_admin) && Auth::user()->is_admin==1)
        { 
            $page_title = 'Email Templates';
            $emailTemplates = EmailTemplate::all();
            $message = 'Email Template listed successfully.';
            return view('admin.emailTemplate.index', compact('page_title','emailTemplates'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function store(Request $request)
    {
       $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ],
        [
            'title.required' => 'Please enter the email template title',
            'content.required' => 'Please enter the email template content',
        ]);
        if($data){
            $emailTemplate = EmailTemplate::create($request->all());
            return response()->json(['status' => 'success', 
            'data' =>[], 
            'message' => 'Email template created successfully!'
        ], 200);
        } else {
            return response()->json(['error'=>'Please enter form detail.']);
        }
    }

    public function edit(Request $request, $id)
    {
        $emailTemplate = EmailTemplate::findorfail($id);
        return response($emailTemplate);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ],
        [
            'title.required' => 'Please enter the email template title',
            'content.required' => 'Please enter the email template content',
        ]);
        $emailTemplate = EmailTemplate::find($id);
        if(!empty($emailTemplate)) 
        {
            $emailTemplate = EmailTemplateService::createUpdate($emailTemplate, $request);
            return response()->json(['status' => 'success', 
            'data' =>[], 
            'message' => 'Email template Updated successfully!'
        ], 200);
        }
        else
        {
            return response()->json(['error'=>'Please enter form detail.']);
        }
    }

    public function destroy($id)
    {
        $emailTemplate = EmailTemplate::find($id);
        if(!empty($emailTemplate))
        {
            $emailTemplate->delete();
            $emailTemplate = new EmailTemplateResource($emailTemplate);
            return sendResponse($emailTemplate, 'Email template deleted successfully.');
        }
        else
        {
            return sendError('Error Occurred');
        }
    }
}
