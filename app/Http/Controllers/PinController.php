<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PinController extends Controller
{
    public function enterPinForm()
    {
        return view('pin.enter');
    }

    public function processPinSubmission(Request $request)
    {
        $accessCode = $request->input('code');

        if ($accessCode === '0505') {
            // The pin is correct, so redirect to the "user-courses" page
            return redirect()->route('user.courses.list');
        } else {
            return redirect()->route('enter.pin.page')->with('error', 'Invalid PIN entered.');
        }
    }
}
