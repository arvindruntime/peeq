<?php

namespace App\Services;

use Storage;
use App\Models\ContactSupport;

class ContactSupportService
{
    public static function createUpdate($contact_support, $request)
    {
        if (isset($request->email)) {
            $contact_support->email = $request->email;
        }
        if (isset($request->user_type)) {
            $contact_support->user_type = $request->user_type;
        }
        if (isset($request->name)) {
            $contact_support->name = $request->name;
        }
        if (isset($request->subject)) {
            $contact_support->subject = $request->subject;
        }
        if (isset($request->description)) {
            $contact_support->description = $request->description;
        }
        if (isset($request->mighty_network_name)) {
            $contact_support->mighty_network_name = $request->mighty_network_name;
        }
        if (isset($request->attachment)) {
            $imageName = md5(time()) . '.' . $request->attachment->extension();
            $request->attachment->storeAs('public/attachment', $imageName);
            $input['attachment'] = $imageName;
            $contact_support->attachment = asset('storage/attachment/'.$input['attachment']);
            $contact_support->attachment = $contact_support->attachment;
        }
        $contact_support->save();
        return $contact_support;
    }
}
