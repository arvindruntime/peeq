<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InteractiveWorkbookController extends Controller
{
    public function index()
    {
        return view('users.interactiveWorkbook.index');
    }
}
