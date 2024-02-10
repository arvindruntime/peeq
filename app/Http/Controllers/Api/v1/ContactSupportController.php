<?php

namespace App\Http\Controllers\Api\v1;

use Validator;
use App\Services\ContactSupportService;
use Illuminate\Http\Request;
use App\Models\ContactSupport;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactSupporrtResource;

class ContactSupportController extends Controller
{
    public $support;
    function __construct(ContactSupportService $contactsupportService)
	{
		$this->support = $contactsupportService;
	}

    /**
     * Add ContactSupport API
     * @group ContactSupports
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'user_type' => 'nullable|in:member,host,on_a_mighty_networks_free_trail,curious_about_mighty_networks',
            'name' => 'required',
            'subject'=> 'nullable',
            'description' => 'nullable',
            'mighty_network_name' => 'nullable',
            'attachment' => 'nullable',
        ],
        [
            'email.required' => 'Please enter the email',
            'email.email' => 'You have entered an invalid format',
            'name.required' => 'Please enter the name',
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
        $contactSupport = ContactSupportService::createUpdate(new ContactSupport, $request);
        $contactSupport = new ContactSupporrtResource($contactSupport);
        
        
        if(!empty($contactSupport)) {         
            if($request->wantsJson()) {  
                return sendResponse($contactSupport, 'Contact Support added successfully.');
            } else {
                if ($request->ajax()) {
                    return sendResponse($contactSupport, 'Contact Support added successfully.');
                }
                return view('cmsPages.contact_support')->with(compact('contactSupport'));
            }
        }
    }
}
