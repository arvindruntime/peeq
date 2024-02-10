<?php

namespace App\Services;

use App\Models\Course;

class CourseService
{
    public static function createUpdate($course, $request)
    {
        /* upload thumbnail */
        if (isset($request->course_thumbnail)) {
            $thumbnailName = md5(time()) . '.' . $request->course_thumbnail->extension();
            $request->course_thumbnail->storeAs('public/course/thumbnail', $thumbnailName);
            $input['thumbnail'] = $thumbnailName;
            $course->course_thumbnail = asset('/storage/course/thumbnail/'.$input['thumbnail']);
            $course->course_thumbnail = $course->course_thumbnail;
        }
        /* course preview video upload */
        if (isset($request->course_preview_video)) {
            $previewVideoName = md5(time()) . '.' . $request->course_preview_video->extension();
            $request->course_preview_video->storeAs('public/course/coursePreview', $previewVideoName);
            $input['previewVideo'] = $previewVideoName;
            $course->course_preview_video = asset('/storage/course/coursePreview/'.$input['previewVideo']);
            $course->course_preview_video = $course->course_preview_video;
        }
        if (isset($request->course_name)) {
            $course->course_name = $request->course_name;
        }
        if (isset($request->course_tagline)) {
            $course->course_tagline = $request->course_tagline;
        }
        if (isset($request->coaches)) {
            $coaches = is_array($request->coaches) ? $request->coaches : [$request->coaches];
            $course->coaches = implode(',', $coaches);
        }
        if (isset($request->description )) {
            $course->description  = $request->description;
        }
        if (isset($request->module_overview_description )) {
            $course->module_overview_description  = $request->module_overview_description;
        }
        if (isset($request->course_price_type )) {
            $course->course_price_type  = $request->course_price_type;
        }
        if (isset($request->course_price )) {
            $course->course_price  = $request->course_price;
        }
        if (isset($request->is_featured )) {
            $course->is_featured  = $request->is_featured;
        }
        if (isset($request->member_add_reviews_on_this )) {
            $course->member_add_reviews_on_this  = (int)$request->member_add_reviews_on_this;
        }

        if (isset($request->upload_pdf)) {
            $uploadPdfName = md5(time()) . '.' . $request->upload_pdf->extension();
            $request->upload_pdf->storeAs('public/course/uploadPdf', $uploadPdfName);
            $input['uploadPdf'] = $uploadPdfName;
            $course->upload_pdf = asset('/storage/course/uploadPdf/'.$input['uploadPdf']);
            $course->upload_pdf = $course->upload_pdf;
        }
        if (isset($request->currency_id)) {
            $course->currency_id = (int)$request->currency_id;
        }
        if (isset($request->stripe_subscription_course_id)) {
            $course->stripe_subscription_course_id = $request->stripe_subscription_course_id;
        }
        if (isset($request->google_pay_id)) {
            $course->google_pay_id = $request->google_pay_id;
        }
        if (isset($request->apple_pay_id)) {
            $course->apple_pay_id = $request->apple_pay_id;
        }
        if (isset($request->course_completed_image)) {
            $courseCompletedImageName = md5(time()) . '.' . $request->course_completed_image->extension();
            $request->course_completed_image->storeAs('public/course/courseCompletedImage', $courseCompletedImageName);
            $input['courseCompletedImage'] = $courseCompletedImageName;
            $course->course_completed_image = asset('/storage/course/courseCompletedImage/'.$input['courseCompletedImage']);
            $course->course_completed_image = $course->course_completed_image;
        }
        if (isset($request->status )) {
            $course->status  = $request->status;
        }
        $course->save();
        return $course;
    }
}
