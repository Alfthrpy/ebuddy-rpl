<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Letter;
use App\Models\Holiday;
use App\Models\Overtime;
use App\Models\Permission;
use App\Models\Presence;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $attendances = Attendance::query()
            // ->with('positions')
            ->forCurrentUser(auth()->user()->position_id)
            ->get()
            ->sortByDesc('batas_start_time');
        
        $role = auth()->user()->role_id == 2 ? 'pejabat' : 'pegawai';

        $userId = auth()->id(); // Dapatkan ID pengguna saat ini

        $latestApprovedLetter = Letter::where('status', 'approved')
                                      ->where('user_id_creator', $userId)
                                      ->latest()
                                      ->first();
        
        $latestApprovedOvertime = Overtime::where('status', 'approved')
                                          ->where('user_id_creator', $userId)
                                          ->latest()
                                          ->first();


        return view('dashboard.user', [
            "title" => "Beranda",
            "attendances" => $attendances,
            'latestApprovedLetter' => $latestApprovedLetter,
            'latestApprovedOvertime' => $latestApprovedOvertime,
            "role" => 'user',
            "position" => $role
        ]);
    }






    public function show(Attendance $attendance){
        $presences = Presence::query()
            ->where('attendance_id', $attendance->id)
            ->where('user_id', auth()->user()->id)
            ->get();

        $isHasEnterToday = $presences
            ->where('presence_date', now()->toDateString())
            ->isNotEmpty();

        // $isTherePermission = Permission::query()
        //     ->where('permission_date', now()->toDateString())
        //     ->where('attendance_id', $attendance->id)
        //     ->where('user_id', auth()->user()->id)
        //     ->first();

        $data = [
            'is_has_enter_today' => $isHasEnterToday, // sudah absen masuk
            'is_not_out_yet' => $presences->where('presence_out_time', null)->isNotEmpty(), // belum absen pulang
            // 'is_there_permission' => (bool) $isTherePermission,
            // 'is_permission_accepted' => $isTherePermission?->is_accepted ?? false
        ];

        // $holiday = $attendance->data->is_holiday_today ? Holiday::query()
        //     ->where('holiday_date', now()->toDateString())
        //     ->first() : false;

        $history = Presence::query()
            ->where('user_id', auth()->user()->id)
            ->where('attendance_id', $attendance->id)
            ->get();

        // untuku melihat karyawan yang tidak hadir
        $priodDate = CarbonPeriod::create($attendance->created_at->toDateString(), now()->toDateString())
            ->toArray();

        foreach ($priodDate as $i => $date) { // get only stringdate
            $priodDate[$i] = $date->toDateString();
        }

        $priodDate = array_slice(array_reverse($priodDate), 0, 30);

        $position = auth()->user()->position_id == 2 ? 'pejabat' : 'pegawai';

        return view('dashboard.show', [
            "title" => "Informasi Absensi Kehadiran",
            "attendance" => $attendance,
            "data" => $data,
            'history' => $history,
            'priodDate' => $priodDate,
            'role' =>  'user',
            'position' => 'pegawai'
        ]);
    }
}
