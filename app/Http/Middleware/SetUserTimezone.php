<?php

namespace App\Http\Middleware;

use Closure;
use DateTimeZone;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SetUserTimezone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        if ($user && isset($user->timezone_id) && !empty($user->timezone_id) && $user->timezone_id !== null) {
            $timeZoneInfo = getTimeZoneName($user->timezone_id);

            if ($timeZoneInfo) {
                $timezone = $timeZoneInfo->timezone;

                $utcNow = Carbon::now();

                $date = Carbon::parse($utcNow);

                // Set the timezone for the Carbon instance
                $date->setTimezone(new DateTimeZone($timezone));

            }
        }

        return $next($request);
    }
}
