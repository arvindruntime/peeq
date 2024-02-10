<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public static function createUpdate($user, $request)
    {
        // dd($request);
        if (isset($request->first_name)) {
            $user->first_name = $request->first_name;
        }
        if (isset($request->last_name)) {
            $user->last_name = $request->last_name;
        }
        if (isset($request->email)) {
            $user->email = $request->email;
        }
        if (isset($request->mobile_no)) {
            $user->mobile_no = $request->mobile_no;
        }
        if (isset($request->password)) {
            $user->password = bcrypt($request->password);
        }
        if (isset($request->status)) {
            $user->status = $request->status;
        }
        if (isset($request->profile_image)) {
            $imageName = md5(time()) . '.' . $request->profile_image->extension();
            $request->profile_image->storeAs('public/profile', $imageName);
            $input['image'] = $imageName;
            $user->profile_image = $input['image'];
        } else {
            $user->profile_image = $user->profile_image;
        }
        if (isset($request->cover_image)) {
            $coverImageName = md5(time()) . '.' . $request->cover_image->getClientOriginalExtension();
            $request->cover_image->storeAs('public/coverImage', $coverImageName);
            $input['cover_image'] = $coverImageName;
            $user->cover_image = $input['cover_image'];
        } else {
            $user->cover_image = $user->cover_image;
        }
        if (isset($request->type)) {
            $user->type = $request->type;
        }
        if (isset($request->google_id)) {
            $user->google_id = $request->google_id;
        }
        if (isset($request->facebook_id)) {
            $user->facebook_id = $request->facebook_id;
        }
        if (isset($request->linkedin_id)) {
            $user->linkedin_id = $request->linkedin_id;
        }
        if (isset($request->apple_id)) {
            $user->apple_id = $request->apple_id;
        }
        if (isset($request->fcm_token)) {
            $user->fcm_token = $request->fcm_token;
        }
        if (isset($request->device_type)) {
            $user->device_type = $request->device_type;
        }

        if (isset($request->first_time_login)) {
            $user->first_time_login = (int)$request->first_time_login;
        }
        
        if (isset($request->is_admin)) {
            $user->is_admin = $request->is_admin;
        }

        if (isset($request->user_type)) {
            $user->user_type = $request->user_type;
        }

        if (isset($request->first_time_login)) {
            $user->first_time_login = (int)$request->first_time_login;
        }

        if (isset($request->is_terms_and_condition)) {
            $user->is_terms_and_condition = (int)$request->is_terms_and_condition;
        }

        if (isset($request->is_agree_to_activity_email)) {
            $user->is_agree_to_activity_email = (int)$request->is_agree_to_activity_email;
        }
        
        if (isset($request->is_agree_to_commercial_email)) {
            $user->is_agree_to_commercial_email = (int)$request->is_agree_to_commercial_email;
        }
        
        if (isset($request->is_profile_image_skipped)) {
            $user->is_profile_image_skipped = (int)$request->is_profile_image_skipped;
        }
        
        if (isset($request->is_plan_activated)) {
            $user->is_plan_activated = (int)$request->is_plan_activated;
        }
        if (isset($request->referral_code)) {
            $user->referral_code = $request->referral_code;
        }
        if (isset($request->job_title) || $request->job_title == Null) {
            $user->job_title = $request->job_title;
        }
        if (isset($request->company_name) || $request->company_name == Null) {
            $user->company_name = $request->company_name;
        }
        if (isset($request->bio) || $request->bio == Null) {
            $user->bio = $request->bio;
        }

        if (isset($request->leadership_development)) {
            $user->leadership_development = (int)$request->leadership_development;
        }
        
        if (isset($request->self_development)) {
            $user->self_development = (int)$request->self_development;
        }
        
        if (isset($request->culture_uplift)) {
            $user->culture_uplift = (int)$request->culture_uplift;
        }
        
        if (isset($request->networking)) {
            $user->networking = (int)$request->networking;
        }
        
        if (isset($request->personal_link)) {
            $abc = $request->personal_link;
            $data = implode(",",$abc);
            $user->personal_link = $data;
        }
        if (isset($request->location_id)) {
            $user->location_id = $request->location_id;
        }
        if (isset($request->timezone_id)) {
            $user->timezone_id = $request->timezone_id;
        }
        if (isset($request->general)) {
            $generals = $request->general;
            $data = implode(",",$generals);
            $user->general = $data;
        }
        if (isset($request->course)) {
            $courses = $request->course;
            $data = implode(",",$courses);
            $user->course = $data;
        }
        if (isset($request->find_resource)) {
            $find = $request->find_resource;
            $data = implode(",",$find);
            $user->find_resource = $data;
        }
        if($request->steps) {
            $stepVerification = User::where('id', $user->id)->value('step_verification');
            
            $stepVerification_array = explode(",",$stepVerification);
                foreach($request->steps as $value)
                {    
                    $key = array_search($value, $stepVerification_array, true);
                    if ($key !== false) {
                        unset($stepVerification_array[$key]);
                    }
                }
            $stepVerification_string = implode(",",$stepVerification_array);
            $steps_string = implode(",",$request->steps);
    
            $user->step_verification = $stepVerification_string.",".$steps_string;
        }
        if (isset($request->is_online)) {
            $user->is_online = (int)$request->is_online;
        }

        if (isset($request->is_follow)) {
            $user->is_follow = (int)$request->is_follow;
        }
       
        $user->save();
        if($user->profile_image) {
            $user['profile_image_url'] = 'storage/profile/'.$user->profile_image;
        } else {
            $user['profile_image_url'] = $user->profile_image;
        }

        if($user->cover_image) {
            $user['cover_image_url'] = asset('storage/coverImage/'.$user->cover_image);
        } else {
            $user['cover_image_url'] = $user->cover_image;
        }
        return $user;
    }
}
