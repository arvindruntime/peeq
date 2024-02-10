<?php

namespace App\Services;

use Storage;
use App\Models\ContactUs;

class ContactUsService
{
    public static function createUpdate($contact_us, $request)
    {
        if (isset($request->first_name)) {
            $contact_us->first_name = $request->first_name;
        }
        if (isset($request->last_name)) {
            $contact_us->last_name = $request->last_name;
        }
        if (isset($request->company_name)) {
            $contact_us->company_name = $request->company_name;
        }
        if (isset($request->country_id)) {
            $contact_us->country_id = $request->country_id;
        }
        if (isset($request->email)) {
            $contact_us->email = $request->email;
        }
        if (isset($request->description)) {
            $contact_us->description = $request->description;
        }
        $contact_us->save();
        return $contact_us;
    }
}
