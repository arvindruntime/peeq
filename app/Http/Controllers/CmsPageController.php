<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CmsPageController extends Controller
{
    public function privacyPolicy()
    {
        return view('cmsPages.privacy_policy');
    }

    public function termsAndCondition()
    {
        return view('cmsPages.terms_of_service');
    }

    public function contactSupport()
    {
        if (!auth()->user()->welcome_checklist_complete==1) {
            return redirect()->route('dashboard');
        }
        return view('cmsPages.contact_support');
    }

    public function cookiePolicy()
    {
        return view('cmsPages.cookie_policy');
    }
}
