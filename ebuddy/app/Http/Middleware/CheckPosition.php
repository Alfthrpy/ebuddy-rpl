<?php

namespace App\Http\Middleware;

use App\Models\User;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPosition
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->position_id ==2){
            return $next($request);
        } else {
            return redirect()->route('dashboard.pegawai')->with('failed', 'Kamu tidak memilik izin untuk mengakses halaman tersebut.');
        }
    }
}
