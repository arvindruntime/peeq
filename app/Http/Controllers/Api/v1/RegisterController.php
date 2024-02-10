<?php

namespace App\Http\Controllers\Api\v1;
   
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\StrongPassword;
use App\Mail\FirstTimeLoginMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function __construct(User $user) {
        $this->_user = $user;
    }
    
    /**
     * Register API
     * @group Login/Registration
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'nullable|regex:/^[\pL\s\-]+$/u',
            'last_name' => 'nullable|regex:/^[\pL\s\-]+$/u',
            'mobile_no' => 'nullable|min:6|max:15',
            'email' => 'required|string|email|max:100|unique:users|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'password' => [
                'required',
                'min:6', // Adjust the minimum length as needed
                new StrongPassword,
            ],
            'c_password' => 'required|same:password',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'first_time_login' => 'nullable|in:0,1',
            'is_terms_and_condition' => 'nullable|in:0,1',
            'is_agree_to_activity_email' => 'nullable|in:0,1',
            'is_agree_to_commercial_email' => 'nullable|in:0,1',
            'is_profile_image_skipped' => 'nullable|in:0,1',
            'is_plan_activated' => 'nullable|in:0,1',
            'referral_code' => 'nullable',
            'fcm_token' => 'nullable',
        ],
        [
            'email.required' => 'Enter a valid email',
            'email.email' => 'You have entered an invalid email',
            'password.required' => 'Enter a valid password',
            'password.min' => 'Password must be atleast 6 or 8 characters',
            'c_password.required' => 'Enter a confirm password',
            'c_password.same' => 'Password does not match',
            'profile_image.max' => 'Profile image may not be greater than 10 MB.',
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

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        /* image upload */
        if($request->profile_image) {
            $imageName = md5(time()) . '.' . $request->profile_image->extension();
            $request->profile_image->storeAs('public/profile', $imageName);
            $input['profile_image'] = $imageName;
            $user['profile_image'] = ($input['profile_image']);
        }
        $input['leadership_development'] = (int)$request->leadership_development;
        $input['self_development'] = (int)$request->self_development;
        $input['culture_uplift'] = (int)$request->culture_uplift;
        $input['networking'] = (int)$request->networking;
        $input['first_time_login'] = (int)$request->first_time_login;
        $input['is_terms_and_condition'] = (int)$request->is_terms_and_condition;
        $input['is_agree_to_activity_email'] = (int)$request->is_agree_to_activity_email;
        $input['is_agree_to_commercial_email'] = (int)$request->is_agree_to_commercial_email;
        $input['is_profile_image_skipped'] = (int)$request->is_profile_image_skipped;
        $input['is_plan_activated'] = (int)$request->is_plan_activated;
        $input['fcm_token'] = $request->fcm_token;
        
        $user = User::create($input);
        $success['token'] =  $user->createToken(config('app.name'))->plainTextToken;
        if($request->profile_image) {
            $user['profile_image_url'] = ('/storage/profile/'.$user['profile_image']);
        }
        $user = new UserResource($user);
        $loginUrl = URL::route('login');
        try {
            // Send the email to the user
            Mail::to($user->email)->send(new FirstTimeLoginMail($user->first_name, $loginUrl));
        } catch (\Exception $e) {
            // Log the email sending error for debugging purposes
           Log::error('Error sending first-time login email');
           Log::error('Error message: ' . $e->getMessage());
        }

        $success['userList'] =  $user;

        return sendResponse($success, 'User register successfully.');
    }

    /**
     * Login API
     * @group Login/Registration
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'fcm_token' => 'nullable',
        ],
        [
            'email.required' => 'Enter a valid email',
            'email.email' => 'You have entered an invalid email',
            'password.required' => 'Enter a valid password',
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
        
        // Get user using email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(
                [
                    'status' => 422,
                    'statusState' => 'error',
                    'message' => 'These credentials do not match our records',
                ],422
            );     
        }
        // Check login credentials
        if ((!Hash::check($request->password, $user->password)) && !Auth::attempt($request->only('email', 'password'))) {
            return response()->json(
                [
                    'status' => 422,
                    'statusState' => 'error',
                    'message' => 'These credentials do not match our records',
                ],422
            );    
        }
        try {
            // Create Token
            $token = $user->createToken(config('app.name'))->plainTextToken;

            // Update fcm_token if present in the request
            if ($request->has('fcm_token')) {
                $user->fcm_token = $request->fcm_token;
                $user->save();
            }

            // Set null data to empty
            // $user = setEmptyData($user->toArray());

            /* Welcome checklist verification */ 

            $stepVerification = User::where('id', $user->id)->value('step_verification');
        
            $stepVerification_array = explode(",",$stepVerification);
            
            // $verify_array  = ["1","3","2","4","5"]; Updated by arvind
            $verify_array  = ["1","3","2","4","5"];
            
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
        } catch (\Exception $e) {
            return sendError(500, 'Something went wrong', $e->getMessage());
        }
    }
    /**
     * Logout API
     * @group Login/Registration
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try {
            $data['userList'] = auth()->user();
            $user = auth()->user()->tokens()->delete();
            return sendResponse($data, 'user logged out successfully.');
        } catch (\Exception $e) {
            return sendError(500, 'Something went wrong', $e->getMessage());
        }
    }
}
