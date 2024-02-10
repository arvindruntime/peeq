<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use PharIo\Manifest\Url;

class ChangePasswordController extends Controller
{
    /**
     * Change Password API
     * @group Change Password
     * @return \Illuminate\Http\Response
     */
    public function ChangePassword(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'old_password'        =>'required',
            'new_password'         =>'required|min:6|max:30',
            'confirm_password' =>'required|same:new_password'
        ],
        [
            'old_password.required' => 'Please enter the old password',
            'new_password.min' => 'The password must be atleast 6 or 8 characters',
            'new_password.required' => 'Please enter the new password',
            'confirm_password.required' => 'Please enter the confirm password',
        ]);
        
        if($validator->fails()){
            return response()->json(
                [
                    'status' => 422,
                    'statusState' => 'error',
                    'message' => (empty($validator->errors()) ? 'Something went wrong' : $validator->errors())->first(),
                ],422
            );       
        }
        $user=$request->user();

        if (Hash::check($request->old_password,$user->password)) {
            $user->update([
                'password'=>Hash::make($request->new_password)
            ]);

            return sendResponse($user, 'Password updated successfully');
        }
        else
        {
            return response()->json(
                [
                    'status' => 422,
                    'statusState' => 'error',
                    'message' => 'old password does not match',
                ],422
            );       
        }
    }
}
