<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function showChangeForm()
    {
        $position = auth()->user()->role_id == 2 ? 'pejabat' : 'pegawai';
        return view('profile.update-password-form',[
            'role' => 'user',
            'position' => $position,
            'title' => 'Update Password'
        ]);
    }
}
