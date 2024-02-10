<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('landing.index');
    }

    public function aboutUs()
    {
        return view('landing.about');
    }

    public function contactUs()
    {
        return view('landing.contact');
    }
}
