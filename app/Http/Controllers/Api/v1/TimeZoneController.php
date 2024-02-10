<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TimeZoneResource;
use App\Models\TimeZone;
use Illuminate\Http\Request;

class TimeZoneController extends Controller
{
    /**
     * TimeZone List API
     * @group TimeZones
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timeZones = TimeZone::all();
        $timeZones = TimeZoneResource::collection($timeZones);
        return sendResponse($timeZones, 'Timezones listed successfully.');
    }

    /**
     * Get TimeZone API
     * @group TimeZones
     * @return \Illuminate\Http\Response
     */
    public function show($country_id)
    {
        $timeZone = TimeZone::where('country_id', $country_id)->get();
        if(!empty($timeZone)) {
            $timeZone = TimeZoneResource::collection($timeZone);
            return sendResponse($timeZone, 'Timezone fetched successfully.');
        }  
        else
        {
            return sendError('Error Occurred');
        }
    }
}
