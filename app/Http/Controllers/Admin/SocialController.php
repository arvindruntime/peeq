<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    const DEFAULT_PASSWORD = '12345678';

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        return $this->handleSocialCallback('google');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        return $this->handleSocialCallback('facebook');
    }

    public function redirectToLinkedIn()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function handleLinkedInCallback()
    {
        return $this->handleSocialCallback('linkedin');
    }

    private function handleSocialCallback($provider)
    {
        if($provider){
            try {
                $user = Socialite::driver($provider)->user();
                $finduser = User::where($provider . '_id', $user->id)->first();

                if ($finduser) {
                    Auth::login($finduser);
                    return redirect()->intended('dashboard');
                } else {
                    $existingUser = User::where('email', $user->email)->first();

                    if ($existingUser) {
                        $message = 'This email is already used.';
                        Session::flash('error', $message);
                        return redirect()->route('login')->withErrors([$message]);
                    }
                    
                    $parts = explode(" ", $user->name);
                    if(count($parts) > 1) {
                        $last_name = array_pop($parts);
                        $first_name = implode(" ", $parts);
                    }
                    else
                    {
                        $first_name = $name;
                        $last_name = " ";
                    }

                    $nameParts = explode(' ', $user->name);
                    $first_name = $nameParts[0];
                    $last_name = count($nameParts) > 1 ? implode(' ', array_slice($nameParts, 1)) : '';

                    $newUser = User::create([
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'email' => $user->email,
                        'profile_image' => $user->avatar,
                        'type' => $provider,
                        $provider . '_id' => $user->id,
                        'password' => Hash::make(self::DEFAULT_PASSWORD),
                    ]);

                    if ($user->avatar) {
                        $imageContents = file_get_contents($user->avatar);
                        $extension = '';

                        $contentType = get_headers($user->avatar, 1)['Content-Type'];
                        if ($contentType === 'image/jpeg') {
                            $extension = 'jpg';
                        } elseif ($contentType === 'image/png') {
                            $extension = 'png';
                        } elseif ($contentType === 'image/gif') {
                            $extension = 'gif';
                        } elseif ($contentType === 'image/webp') {
                            $extension = 'webp';
                        }

                        $imageName = md5(time()) . '.' . $extension;
                        Storage::put('public/profile/' . $imageName, $imageContents);
                        $newUser->profile_image = $imageName;
                        $newUser->save();
                    }

                    Auth::login($newUser);
                    return redirect()->intended('choose_plan');
                }

            } catch (Exception $e) {
                $message = 'Your account has been deleted. Please contact to your Admin';
                Session::flash('error', $message);
                return redirect()->route('login')->withErrors([$message]);
            }
        } else {
            $message = 'Something went wrong. Please try again later.';
            Session::flash('error', $message);
            return redirect()->route('login')->withErrors([$message]);
        }
    }
}
