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
            $redirect_to = auth()->user()->isUser() ? route('dashboard.pegawai') : route('dashboard.index');
            return redirect($redirect_to)->with('success', 'Login berhasil, silahkan tunggu!');
        }

        return redirect()->back()->withErrors([
            'email' => 'Login gagal, silahkan coba lagi!',
        ])->withInput($request->only('email'));
    }

    public function logout()
    {
        auth()->logout();

        request()->session()->regenerate();
        request()->session()->regenerateToken();

        return redirect()->route('index.login')->with('success', 'Anda berhasil keluar.');
    }
}
