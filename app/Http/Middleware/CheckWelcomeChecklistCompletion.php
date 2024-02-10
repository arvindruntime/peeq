<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckWelcomeChecklistCompletion
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user has completed the welcome checklist
        if (!auth()->user()->welcome_checklist_complete==1) {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}

