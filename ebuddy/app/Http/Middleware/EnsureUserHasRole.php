<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;

class EnsureUserHasRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, ...$positions)
    {
        $userPosition = Role::find(auth()->user()->position_id);
        foreach ($positions as $position) {
            // if ($role === "superadmin" && auth()->user()->isSuperadmin()) return $next($request);
            if ($userPosition->name === $position) {
                return $next($request);
            }
        }

        // return abort(403);
        $route  = $userPosition->name === '' ? 'home.index' : 'dashboard.index';
        return redirect()->route($route)->with('failed', 'Kamu tidak memilik izin untuk mengakses halaman tersebut.');
    }
}
