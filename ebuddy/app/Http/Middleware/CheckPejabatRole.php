<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPejabatRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user's role_id is 2 (Pejabat)
        if (Auth::check() && Auth::user()->role_id == 2) {
            return $next($request);
        }

        // If not, redirect to a forbidden page or show a forbidden message
        return redirect()->route('dahsboard.user')->with('error', 'You do not have permission to access this page.');
    }
}
