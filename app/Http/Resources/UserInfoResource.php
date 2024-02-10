<?php

namespace App\Http\Resources;

use App\Models\UserActivity;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $isFollow = UserActivity::where('following', Auth::user()->id)->where('followers', $this->id)->count();
        return
            [
                'id' => $this->id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'is_follow' =>  $isFollow >=1 ? 1 : 0,
                'profile_image' => $this->profile_image,
                'cover_image' => $this->cover_image,
                'user_type' => $this->user_type,
                'timezone' => new TimeZoneResource($this->timezone),
                'profile_image_url' => $this->profile_image_url,
                'cover_image_url' => $this->cover_image_url,
            ];
    }
}
