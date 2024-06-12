<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Letter;
use App\Models\Overtime;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $latestUsers = User::orderBy('created_at', 'desc')->take(2)->get();
        $latestPositions = Position::orderBy('created_at', 'desc')->take(2)->get();    
        
        
        return view('dashboard.admin', [
            "title" => "Dashboard",
            "positionCount" => Position::count(),
            "userCount" => User::count(),
            'latestUsers' => $latestUsers,
            'latestPositions' => $latestPositions,
            'letterCount' => Letter::count(),
            'overtimeCount' => Overtime::count(),
            "role" => 'admin',
            'position' => 'admin'
        ]);
    }
}
