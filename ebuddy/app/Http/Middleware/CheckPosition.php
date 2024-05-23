<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPosition
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Mengambil parameter 'param' dari URL
        $param = $request->route('position');
        $user = Auth::user();

        // Logika pengecekan posisi
        if ($param == 'pegawai' && $user->position_id != 1) {
            // Jika pengguna bukan pegawai tapi mencoba mengakses rute pegawai
            return redirect()->route('dashboard.user',['position'=>'pejabat']); // atau rute lain yang sesuai
        }

        if ($param == 'pejabat' && $user->position_id == 1) {
            // Jika pengguna adalah pegawai tapi mencoba mengakses rute pejabat
            return redirect()->route('dashboard.user',['position'=>'pegawai']); // atau rute lain yang sesuai
        } else {
        }

        // Jika tidak ada masalah, lanjutkan ke request berikutnya
        return $next($request);
    }
}
