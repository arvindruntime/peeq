<?php

namespace App\Http\Controllers\Auth; 
  
use DB; 
use Hash;
use Exception;
use Carbon\Carbon; 
use App\Models\User; 
use Illuminate\Support\Str;
use App\Rules\StrongPassword;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
         return view('auth.forgetPassword');
      }
    /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
          ],
          [
              'email.required' => 'Please enter the email',
              'email.exists' => 'Email not found, please enter a registered email',
          ]);
  
          $user = User::where('email', $request->email)->first();
          
          if (!$user) {
            return back()->with('error', 'User not found for the provided email.');
          }

          $userName = $user->first_name;
          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);

          try {
              Mail::send('email.forgetPassword', ['token' => $token, 'userName' => $userName, 'email' => $request->email], function($message) use($request){
                  $message->to($request->email);
                  $message->subject('Reset Password');
              });
          } catch (Exception $e) {
              // Log the email sending error for debugging purposes
              Log::error('Error sending forgot password email');
              Log::error('Error message: ' . $e->getMessage());
          }
  
          return back()->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token,$email) { 
        $user = User::where('email', $email)->first();
        if (!$user) {
            return back()->with('error', 'User not found for the provided email.');
        }   
         return view('auth.forgetPasswordLink', ['token' => $token, 'userName' => $user->name, 'email' => $email]);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => [
                'required',
                'string',
                'min:8', // Adjust the minimum length as needed
                new StrongPassword,
            ],
              'password_confirmation' => 'required|same:password'
          ],
          [
            'email.required' => 'Please enter the email',
            'password.required' => 'Please enter the password',
            'password_confirmation.required' => 'Please enter the confirm password',
            'password.confirmed' => 'The confirm password does not match',
            'password_confirmation.same' => 'The confirm password does not match',
          ]);
  
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect('/login')->with('message', 'Your password has been changed!');
      }

}
