<?php

namespace App\Services;

use App\Models\Country;

class CountryService
{
    public static function createUpdate($country, $request)
    {
        if (isset($request->country_code)) {
            $country->country_code = $request->country_code;
        }
        if (isset($request->country_name)) {
            $country->country_name = $request->country_name;
        }
        if (isset($request->dial_code)) {
            $country->dial_code = $request->dial_code;
        }
        $country->save();
        return $country;
    }
}
