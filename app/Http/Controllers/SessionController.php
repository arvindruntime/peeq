<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        return view('users.session.index');
    }
    public function details()
    {
        return view('users.session.details');
    }
}
