<?php

namespace App\Http\Controllers\Api\v1;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\IsValidRegistration;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SocialController extends Controller
{
    /**
     * Social Login API
     * @group Social Login
     * @return \Illuminate\Http\Response
     */
    public function socialLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'name' => 'required|string|max:191',
            'email' => ['required', 'email', new IsValidRegistration],
            'type' => 'required|in:google,facebook,linkedin,apple',
            'social_id' => 'required',
            'fcm_token' => 'nullable',
            'device_type' => 'required|in:ios,android',
            'profile_image' => 'nullable'
        ], 
        [
            // 'name.required' => 'Please enter the name',
            'email.required' => 'Please enter the email',
            'email.email' => 'You have entered an invalid email',
            'type.required' => 'Please enter the social type',
            'social_id.required' => 'Please enter the social id',
            'device_type.required' => 'Please enter the device type',
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

        $user = User::where('email', $request->email)
                    ->Where('type', $request->type)
                    ->first();

        if (!empty($user)) {
            // social login
            $input = $request->all();
            
            if($request->type == 'google') {
                $input['google_id'] = $request->social_id;
            } elseif ($request->type == 'facebook') {
                $input['facebook_id'] = $request->social_id;
            } elseif ($request->type == 'linkedin') {
                $input['linkedin_id'] = $request->social_id;
            } elseif ($request->type == 'apple') {
                $input['apple_id'] = $request->social_id;
            }
            
            /* image upload */
            if ($request->hasFile('profile_image')) {
                $imageUrl = $request->file('profile_image');
                $imageName = md5(time()) . '.' . 'png';
                Storage::disk('local')->put('public/profile/' . $imageName, file_get_contents($imageUrl));
                $input['profile_image'] = $imageName;
            }
            
            // $parts = explode(" ", $request->name);
            // if(count($parts) > 1) {
            //     $input['last_name'] = array_pop($parts);
            //     $input['first_name'] = implode(" ", $parts);
            // }
            // else
            // {
            //     $input['first_name'] = $request->name;
            //     $input['last_name'] = " ";
            // }
            // unset($input['type'], $input['social_id'], $input['name']);
            // User::where('id', $user->id)->update($input);
            
            // Create Token
            $token = $user->createToken(config('app.name'))->plainTextToken;
            
            /* Welcome checklist verification */
            
            $stepVerification = User::where('id', $user->id)->value('step_verification');
            
            $stepVerification_array = explode(",",$stepVerification);
            
            // $verify_array  = ["1","3","2","4","5"];
            $verify_array  = ["1","3","2","4","5"]; // Updated by arvind
            
            $result = array_diff($verify_array,$stepVerification_array);
            
            if($result)
            {
                foreach($result as $value)
                {     
                    if(in_array($value,$stepVerification_array)){                
                        $welcome_checklist_complete = 1;
                    } else {
                        $welcome_checklist_complete = 0;
                    }
                }
            }
            else{
                $welcome_checklist_complete = 1;
            }
            $user = new UserResource($user);
            // Make response
            return sendResponse([
                'token' => $token,
                'welcome_checklist_complete' => $welcome_checklist_complete,
                'userList' => $user,
            ], 'User login successfully.');

        } else {
            // social register
            $input = $request->all();

            if($request->type == 'google') {
                $input['google_id'] = $request->social_id;
            } elseif ($request->type == 'facebook') {
                $input['facebook_id'] = $request->social_id;
            } elseif ($request->type == 'linkedin') {
                $input['linkedin_id'] = $request->social_id;
            } elseif ($request->type == 'apple') {
                $input['apple_id'] = $request->social_id;
            }

            // Store the original profile image URL from the request
            $originalProfileImageUrl = $input['profile_image'];

            // Generate a unique filename for the image
            $imageName = md5(time()) . '.' . 'png';
            
            if (!empty($originalProfileImageUrl)) {
                // Download the image using HTTP client
                $response = Http::get($originalProfileImageUrl);

                // Store the image in local storage if the download is successful
                if ($response->successful()) {
                    Storage::disk('local')->put('public/profile/' . $imageName, $response->body());
                    $input['profile_image'] = $imageName;
                }
            }

            // Construct the local storage URL for the stored image
            $localStorageImageUrl = asset('storage/profile/' . $imageName);

            $parts = explode(" ", $request->name);
            if(count($parts) > 1) {
                $input['last_name'] = array_pop($parts);
                $input['first_name'] = implode(" ", $parts);
            }
            else
            {
                $input['first_name'] = $request->name;
                $input['last_name'] = " ";
            }

            // Check if the user with the same email already exists
            $user = User::where('email', $request->email)->first();
            if (!empty($user)) {
                return response()->json([
                    'status' => 422,
                    'statusState' => 'error',
                    'message' => 'This email is already registered',
                ], 422);
            }
            
            $user_data = User::create($input);

            $success['token'] =  $user_data->createToken(config('app.name'))->plainTextToken;
            if($request->profile_image) {
                $user_data['profile_photo'] = $localStorageImageUrl;
            }
            
            /* Welcome checklist verification */

            $stepVerification = User::where('id', $user_data->id)->value('step_verification');
        
            $stepVerification_array = explode(",",$stepVerification);
            
            // $verify_array  = ["1","3","2","4","5"];
            $verify_array  = ["1","3","2","4","5"]; // Updated by arvind
            
            $result = array_diff($verify_array,$stepVerification_array);
            
            if($result)
            {
                foreach($result as $value)
                {     
                    if(in_array($value,$stepVerification_array)){                
                        $welcome_checklist_complete = 1;
                    } else {
                        $welcome_checklist_complete = 0;
                    }
                }
            }
            else{
                $welcome_checklist_complete = 1;
            }
            
            $userData = new UserResource($user_data);
            $success['welcome_checklist_complete'] =  $welcome_checklist_complete;
            $success['userList'] =  $userData;
            return sendResponse($success, 'User login successfully.');
        }
    }
}
