<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\Presence;

class PresenceForm extends Component
{
    public Attendance $attendance;
    public $holiday;
    public $data;

    public function mount(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    // NOTED: setiap method send presence agar lebih aman seharusnya menggunakan if statement seperti diviewnya

    public function sendEnterPresence()
    {
        if ($this->attendance->data->is_start) { // sama (harus) dengan view
            Presence::create([
                "user_id" => auth()->user()->id,
                "attendance_id" => $this->attendance->id,
                "presence_date" => now()->toDateString(),
                "presence_enter_time" => now()->toTimeString(),
                "presence_out_time" => null
            ]);
    
            // untuk refresh if statement
            $this->data['is_has_enter_today'] = true;
            $this->data['is_not_out_yet'] = true;
    
            // Redirect to the dashboard with a success message
            return redirect()->route('dashboard.user')->with('success', "Kehadiran atas nama '" . auth()->user()->name . "' berhasil dikirim.");
        }
    }



    public function sendOutPresence()
{
    // jika absensi sudah jam pulang (is_end) dan tidak menggunakan qrcode (kebalikan)
    if (!$this->attendance->data->is_end && $this->attendance->data->is_using_qrcode) // sama (harus) dengan view
        return false;

    $presence = Presence::query()
        ->where('user_id', auth()->user()->id)
        ->where('attendance_id', $this->attendance->id)
        ->where('presence_date', now()->toDateString())
        ->where('presence_out_time', null)
        ->first();

    if (!$presence) // hanya untuk sekedar keamanan (kemungkinan)
        return redirect()->route('dashboard.user')->with('error', "Terjadi masalah pada saat melakukan absensi.");

    // untuk refresh if statement
    $this->data['is_not_out_yet'] = false;
    $presence->update(['presence_out_time' => now()->toTimeString()]);

    return redirect()->route('dashboard.user')->with('success', "Atas nama '" . auth()->user()->name . "' berhasil melakukan absensi pulang.");
}

    public function render()
    {
        return view('livewire.presence-form');
    }
}
