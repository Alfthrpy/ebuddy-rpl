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
    public $positions;
    public $position_ids = [];

    protected $rules = [
        'attendance.title' => 'required|string|min:6',
        'attendance.description' => 'required|string|max:500',
        'attendance.start_time' => 'required|date_format:H:i',
        'attendance.batas_start_time' => 'required|date_format:H:i|after:start_time',
        'attendance.end_time' => 'required|date_format:H:i',
        'attendance.batas_end_time' => 'required|date_format:H:i|after:end_time',
        'attendance.code' => 'sometimes|nullable|boolean',
        'position_ids' => 'required|array',
        'position_ids.*' => 'required|distinct|numeric',
    ];

    public function mount()
    {
        $this->positions = Position::query()
            ->select(['id', 'name'])
            ->get();
    }

    public function save()
    {
        // filter value before validate
        $this->position_ids = array_filter($this->position_ids, function ($id) {
            return is_numeric($id);
        });

        $position_ids = array_values($this->position_ids);
        $this->validate();


        $attendance = Attendance::create($this->attendance);
        $attendance->positions()->attach($position_ids);

        redirect()->route('attendances.index')->with('success', 'Data absensi berhasil ditambahkan.');
    }

    public function render()
    {
        return view('livewire.attendance-form-create');
    }
}
