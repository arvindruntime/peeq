<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/choose_plan';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
            'last_name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-zA-Z\d@$!%*?&.#]).*$/',
            ],
            'password_confirmation' => ['required', 'same:password'],
            'is_terms_and_condition' => ['accepted'], // Use 'accepted' rule for checkboxes
        ],
        [
            'first_name.required' => 'Enter a first name',
            'last_name.required' => 'Enter a last name',
            'email.required' => 'Enter a valid email',
            'email.email' => '',
            'password.required' => 'Enter a valid password',
            'password.min' => '',
            'password_confirmation' => 'Enter a password',
            'password_confirmation.same' => 'Password and confirm password must be same',
            'is_terms_and_condition.accepted' => 'You must accept the Terms & Conditions',
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {        
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_terms_and_condition' => $data['is_terms_and_condition'],
            'is_agree_to_commercial_email' => $data['is_agree_to_commercial_email'],
            'is_profile_image_skipped' => 1,
        ]);
    }
}
