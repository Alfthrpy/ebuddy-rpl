<?php

namespace App\Livewire;

use App\Models\Position;
use App\Models\Attendance;
use Livewire\Component;
use Illuminate\Support\Str;

class AttendanceFormCreate extends Component
{
    public $attendance = [
        'title' => '',
        'description' => '',
        'start_time' => '',
        'batas_start_time' => '',
        'end_time' => '',
        'batas_end_time' => '',
    ];

    public $position_ids = [];

    public $positions;

    protected $rules = [
        'attendance.title' => 'required|string|max:255',
        'attendance.description' => 'nullable|string',
        'attendance.start_time' => 'required|date_format:H:i',
        'attendance.batas_start_time' => 'required|date_format:H:i',
        'attendance.end_time' => 'required|date_format:H:i',
        'attendance.batas_end_time' => 'required|date_format:H:i',
        'position_ids' => 'required|array|min:1',
        'position_ids.*' => 'exists:positions,id',
    ];

    public function mount()
    {
        $this->positions = Position::query()->select(['id', 'name'])->get();
    }

    public function save()
    {
        $this->validate();

        $attendance = Attendance::create([
            'title' => $this->attendance['title'],
            'description' => $this->attendance['description'],
            'start_time' => $this->attendance['start_time'],
            'batas_start_time' => $this->attendance['batas_start_time'],
            'end_time' => $this->attendance['end_time'],
            'batas_end_time' => $this->attendance['batas_end_time'],
        ]);

        // dd($this->position_ids);
        // $attendance->positions()->sync($this->position_ids);
        foreach ($this->position_ids as $position_id) {
            $attendance->positions()->attach($position_id);
        }

        // $this->reset('attendance', 'position_ids');
        redirect()->route('attendances.index')->with('success', "Data absensi berhasil ditambahkan.");
    }
    public function render()
    {
        return view('livewire.attendance-form-create');
    }
}
