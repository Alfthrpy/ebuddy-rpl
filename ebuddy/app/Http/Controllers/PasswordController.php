<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function showChangeForm()
    {
        $position = auth()->user()->role_id == 2 ? 'pejabat' : 'pegawai';
        $role = auth()->user()->role_id == 1 ? 'admin' : 'user';
        return view('profile.update-password-form',[
            'role' => $role,
            'position' => $position,
            'title' => 'Update Password'
        ]);
    }
}
