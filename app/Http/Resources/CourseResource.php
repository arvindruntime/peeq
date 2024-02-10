<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\CourseModule;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $coaches = User::whereIn('id', explode(',', $this->coaches))
                        ->orderBy('created_at', 'desc')
                        ->take(3)
                        ->get();

        $courseModules = CourseModule::where('course_id', $this->id)->get();
        $courseModuleTitles = $courseModules->pluck('title');
        $user = $request->user();
    
        // Check if the user is authenticated before accessing purchase course details
        $purchaseCourse = null;
        if ($user) {
            $purchaseCourse = $user->purchaseCourse()->where('course_id', $this->id)->first();
        }
        $currencyCode = $this->currency ? $this->currency->code : 'AUD';

        return
            [
                'id' => $this->id,
                'course_thumbnail' => $this->course_thumbnail,
                'course_preview_video' => $this->course_preview_video,
                'course_name' => $this->course_name,
                'course_tagline' => $this->course_tagline,
                'coaches' => UserInfoResource::collection($coaches),
                'description' => $this->description,
                'module_overview_description' => $this->module_overview_description,
                'course_price_type' => $this->course_price_type ?? 'free',
                'course_price' => $this->course_price ?? 0.0,
                'is_featured' => $this->is_featured,
                'member_add_reviews_on_this' => $this->member_add_reviews_on_this ?? 1,
                'upload_pdf' => $this->upload_pdf,
                'currency' => $currencyCode,
                'stripe_subscription_course_id' => $this->stripe_subscription_course_id,
                'google_pay_id' => $this->google_pay_id,
                'apple_pay_id' => $this->apple_pay_id,
                'course_completed_image' => $this->course_completed_image,
                'status' => $this->status ?? 'private',
                'last_updated' => $this->updated_at ? $this->updated_at->format('M j, Y') : null,
                'course_material' => [
                    'total_modules' => $courseModules->count(),
                    'modules' => $courseModuleTitles->map(function ($title) {
                        return ['title' => $title];
                    }),
                ],
                'course_purchase_status' => $purchaseCourse ? $purchaseCourse->payment_status : 0,
            ];
    }
}
