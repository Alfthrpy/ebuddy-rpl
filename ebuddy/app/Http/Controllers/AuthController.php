<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Login',
        ];
        return view('auth.login',$data);
    }
}
