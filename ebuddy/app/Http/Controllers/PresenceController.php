<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Permission;
use App\Models\Presence;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PresenceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all()->sortByDesc('batas_start_time');

        return view('presences.index', [
            "title" => "Daftar Absensi Dengan Kehadiran",
            "attendances" => $attendances,
            'role' => 'admin',
            'position' => 'admin'
        ]);
    }

    public function show(Attendance $attendance)
    {
        $attendance->load(['positions', 'presences']);

        // dd($qrcode);
        return view('presences.show', [
            "title" => "Data Detail Kehadiran",
            "attendance" => $attendance,
            'role' => 'admin',
            'position' => 'admin'
        ]);
    }


    public function notPresent(Attendance $attendance)
    {
        $byDate = now()->toDateString();
        if (request('display-by-date'))
            $byDate = request('display-by-date');


        $presences = Presence::query()
            ->where('attendance_id', $attendance->id)
            ->where('presence_date', $byDate)
            ->get(['presence_date', 'user_id']);

        // jika semua karyawan tidak hadir
        if ($presences->isEmpty()) {
            $notPresentData[] =
                [
                    "not_presence_date" => $byDate,
                    "users" => User::query()
                        ->with('position')
                        ->onlyEmployees()
                        ->get()
                        ->toArray()
                ];
        } else {
            $notPresentData = $this->getNotPresentEmployees($presences);
        }


        return view('presences.not-present', [
            "title" => "Data Karyawan Tidak Hadir",
            "attendance" => $attendance,
            "notPresentData" => $notPresentData,
            'role' => 'admin',
            'position' => 'admin'
        ]);
    }



    public function presentUser(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'user_id' => 'required|string|numeric',
            "presence_date" => "required|date"
        ]);

        $user = User::findOrFail($validated['user_id']);

        $presence = Presence::query()
            ->where('attendance_id', $attendance->id)
            ->where('user_id', $user->id)
            ->where('presence_date', $validated['presence_date'])
            ->first();

        // jika data user yang didapatkan dari request user_id, presence_date, sudah absen atau sudah ada ditable presences
        if ($presence || !$user)
            return back()->with('failed', 'Request tidak diterima.');

        Presence::create([
            "attendance_id" => $attendance->id,
            "user_id" => $user->id,
            "presence_date" => $validated['presence_date'],
            "presence_enter_time" => now()->toTimeString(),
            "presence_out_time" => now()->toTimeString()
        ]);

        return back()
            ->with('success', "Berhasil menyimpan data hadir atas nama \"$user->name\".");
    }

    // public function acceptPermission(Request $request, Attendance $attendance)
    // {
    //     $validated = $request->validate([
    //         'user_id' => 'required|string|numeric',
    //         "permission_date" => "required|date"
    //     ]);

    //     $user = User::findOrFail($validated['user_id']);

    //     $permission = Permission::query()
    //         ->where('attendance_id', $attendance->id)
    //         ->where('user_id', $user->id)
    //         ->where('permission_date', $validated['permission_date'])
    //         ->first();

    //     $presence = Presence::query()
    //         ->where('attendance_id', $attendance->id)
    //         ->where('user_id', $user->id)
    //         ->where('presence_date', $validated['permission_date'])
    //         ->first();

    //     // jika data user yang didapatkan dari request user_id, presence_date, sudah absen atau sudah ada ditable presences
    //     if ($presence || !$user)
    //         return back()->with('failed', 'Request tidak diterima.');

    //     Presence::create([
    //         "attendance_id" => $attendance->id,
    //         "user_id" => $user->id,
    //         "presence_date" => $validated['permission_date'],
    //         "presence_enter_time" => now()->toTimeString(),
    //         "presence_out_time" => now()->toTimeString(),
    //         'is_permission' => true
    //     ]);

    //     $permission->update([
    //         'is_accepted' => 1
    //     ]);

    //     return back()
    //         ->with('success', "Berhasil menerima data izin karyawan atas nama \"$user->name\".");
    // }

    private function getNotPresentEmployees($presences)
    {
        $uniquePresenceDates = $presences->unique("presence_date")->pluck('presence_date');
        $uniquePresenceDatesAndCompactTheUserIds = $uniquePresenceDates->map(function ($date) use ($presences) {
            return [
                "presence_date" => $date,
                "user_ids" => $presences->where('presence_date', $date)->pluck('user_id')->toArray()
            ];
        });
        $notPresentData = [];
        foreach ($uniquePresenceDatesAndCompactTheUserIds as $presence) {
            $notPresentData[] =
                [
                    "not_presence_date" => $presence['presence_date'],
                    "users" => User::query()
                        ->with('position')
                        ->onlyEmployees()
                        ->whereNotIn('id', $presence['user_ids'])
                        ->get()
                        ->toArray()
                ];
        }
        return $notPresentData;
    }
}
