<?php

namespace App\Services;

use App\Models\User;
use App\Models\Session;
use App\Models\SessionCoachTransaction;
use App\Models\SessionPriceTransaction;

class SessionService
{
    public static function createUpdate($session, $request)
    {
        /* upload thumbnail */
        if (isset($request->thumbnail_img)) {
            $thumbnailImageName = md5(time()) . '.' . $request->thumbnail_img->extension();
            $request->thumbnail_img->storeAs('public/session/thumbnailImage', $thumbnailImageName);
            $input['thumbnailImage'] = $thumbnailImageName;
            $session->thumbnail_img = asset('/storage/session/thumbnailImage/'.$input['thumbnailImage']);
            $session->thumbnail_img = $session->thumbnail_img;
        }

        /* session thumbnail video upload */
        if (isset($request->thumbnail_video)) {
            $thumbnailVideoName = md5(time()) . '.' . $request->thumbnail_video->extension();
            $request->thumbnail_video->storeAs('public/session/thumbnailVideo', $thumbnailVideoName);
            $input['thumbnailVideo'] = $thumbnailVideoName;
            $session->thumbnail_video = asset('/storage/session/thumbnailVideo/'.$input['thumbnailVideo']);
            $session->thumbnail_video = $session->thumbnail_video;
        }

        if (isset($request->session_name)) {
            $session->session_name = $request->session_name;
        }

        if (isset($request->short_description )) {
            $session->short_description  = $request->short_description;
        }

        if (isset($request->description )) {
            $session->description  = $request->description;
        }

        if (isset($request->status )) {
            $session->status  = (int)$request->status;
        }

        $session->save();

        
        if(!empty($request->coaches)){
            $sessionCoachTransaction = SessionCoachTransaction::where('session_id', $session->id)->delete();

            foreach ($request->coaches as $coach) {
                if (User::where('id', $coach)->exists()) {
                    $sessionCoachTransaction = new SessionCoachTransaction();
                    $sessionCoachTransaction->session_id = $session->id;
                    $sessionCoachTransaction->coach_id = $coach;
                    $sessionCoachTransaction->save();
                }
            }
        }
        
        if (!empty($request->session_duration) && !empty($request->session_price) && !empty($request->calendly_description)) {

            SessionPriceTransaction::where('session_id', $session->id)->delete();

            $sessionDurations = $request->session_duration;
            $sessionPrices = $request->session_price;
            $sessionCalendlyDescriptions = $request->calendly_description;

            if (count($sessionDurations) == count($sessionPrices) && count($sessionPrices) === count($sessionCalendlyDescriptions)) {
                for ($i = 0; $i < count($sessionDurations); $i++) {
                    $sessionPriceTransaction = new SessionPriceTransaction();
                    $sessionPriceTransaction->session_id = $session->id;
                    $sessionPriceTransaction->session_duration = $sessionDurations[$i];
                    $sessionPriceTransaction->session_price = $sessionPrices[$i];
                    $sessionPriceTransaction->calendly_description = $sessionCalendlyDescriptions[$i];
                    $sessionPriceTransaction->save();
                }
            }
        }

        return $session;
    }
}
