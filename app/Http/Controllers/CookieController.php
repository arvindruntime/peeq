<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CookieController extends Controller
{
    public function acceptCookies(Request $request)
    {
        $cookie = cookie('userCookies', '1', 30 * 24 * 60); // 30 days expiration
        return response('Cookie set')->cookie($cookie);
    }
    
    public function readCookies(Request $request)
    {
        // Read the cookie from the incoming request
        $user = $request->cookie('userCookies');

        if ($user) {
            return $user;
        } else {
            return "Cookie not set!";
        }
    }

}
