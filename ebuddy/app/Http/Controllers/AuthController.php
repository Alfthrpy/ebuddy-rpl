<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\LoginRequests\LoginRequest;

class AuthController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Login',
        ];
        return view('auth.login',$data);
    }

    public function auth(Request $request)
    {
        $remember = $request->boolean('remember');
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials, $remember)) {
            request()->session()->regenerate();
            if(auth()->user()->isPegawai()){
                $redirect_to = route('dashboard.user',['role'=>'pegawai']);
            } else if(auth()->user()->isPejabat()) {
                $redirect_to = route('dashboard.user',['role'=>'pejabat']);

            } else if(auth()->user()->isAdmin()){
                $redirect_to = route('dashboard.admin',['role'=>'admin']);
            }
            return redirect($redirect_to)->with('success', 'Login berhasil!');
        }

        return redirect()->back()->with('error','Login Gagal!');
    }

    public function logout()
    {
        auth()->logout();

        request()->session()->regenerate();
        request()->session()->regenerateToken();

        return redirect()->route('index.login')->with('success', 'Anda berhasil keluar.');
    }
}
