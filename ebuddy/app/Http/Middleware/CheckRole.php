<?php

namespace App\Http\Middleware;

use App\Models\User;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->role_id == 1){
            return $next($request);
        } else {
            return redirect()->route('dashboard.user',['position'=>'pegawai'])->with('failed', 'Kamu tidak memilik izin untuk mengakses halaman tersebut.');
        }
    }
}
