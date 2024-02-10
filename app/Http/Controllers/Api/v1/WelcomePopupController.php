<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\WelcomePopup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WelcomePopupResource;

class WelcomePopupController extends Controller
{
    public function index()
    {
        $welcomePopup = WelcomePopup::first();
        $message = 'Welcome popup listed successfully.';
        return sendResponse(compact('welcomePopup'), $message);
    }
}
