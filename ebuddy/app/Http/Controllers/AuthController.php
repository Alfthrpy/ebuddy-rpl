<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\LoginRequests\LoginRequest;

class AuthController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login',
        ];
        return view('auth.login', $data);
    }

    public function auth(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $role_id = $user->role_id;

            // Mengembalikan respons JSON dengan role_id pengguna
            return response()->json(
                [
                    'message' => 'Login successful',
                    'role_id' => $role_id,
                ],
                200,
            );
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout()
    {
        auth()->logout();

        request()->session()->regenerate();
        request()->session()->regenerateToken();

        return redirect()->route('index.login')->with('success', 'Anda berhasil keluar.');
    }
}
