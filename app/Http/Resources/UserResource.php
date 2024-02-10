<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
            [
                'id' => $this->id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'job_title' => $this->job_title,
                'company_name' => $this->company_name,
                'bio' => $this->bio,
                'email' => $this->email,
                'mobile_no' => $this->mobile_no,
                'status' => $this->status ? : 'active',
                'profile_image' => $this->profile_image ?? '',
                'cover_image' => $this->cover_image,
                'type' => $this->type ? : 'normal',
                'google_id' => $this->google_id,
                'facebook_id' => $this->facebook_id,
                'linkedin_id' => $this->linkedin_id,
                'apple_id' => $this->apple_id,
                'fcm_token' => $this->fcm_token,
                'personal_link' => $this->personal_link,
                'location' => new CountryResource($this->location),
                'timezone' => new TimeZoneResource($this->timezone),
                'leadership_development' => $this->leadership_development,
                'self_development' => $this->self_development,
                'culture_uplift' => $this->culture_uplift,
                'networking' => $this->networking,
                'device_type' => $this->device_type,
                'first_time_login' => $this->first_time_login,
                'is_terms_and_condition' => $this->is_terms_and_condition,
                'is_agree_to_activity_email'=> $this->is_agree_to_activity_email,
                'is_agree_to_commercial_email'=> $this->is_agree_to_commercial_email,
                'is_profile_image_skipped'=> $this->is_profile_image_skipped,
                'is_plan_activated'=> $this->is_plan_activated,
                'referral_code'=> $this->referral_code,
                'is_admin' => $this->is_admin,
                'user_type' => $this->user_type ? : 'Member',
                'general' => $this->general,
                'course' => $this->course,
                'find_resource' => $this->find_resource,
                'step_verification' => $this->step_verification,
                'notification_setting' => $this->notification_setting,
                'is_online' => $this->is_online,
                'is_follow' => $this->is_follow,
                'is_allow_plan_purchase' => $this->is_allow_plan_purchase ? : 1,
                'profile_image_url' => $this->profile_image_url,
                'cover_image_url' => $this->cover_image_url,
            ];
    }
}
