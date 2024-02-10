<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectAuthenticatedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // If user is authenticated, redirect to the 'posts' route
            $request['is_mobile'] = 0;
            $welcome_checklist = welcomeChecklists($request);
            if($welcome_checklist == 1) {
                return redirect()->route('posts.index');
            } else {
                return redirect()->route('dashboard');
            }
        }

        // If user is not authenticated, proceed with the request
        return $next($request);
    }
}
