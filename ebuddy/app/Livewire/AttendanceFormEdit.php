<?php

namespace App\Livewire;

use App\Models\Position;
use App\Models\Attendance;
use Livewire\Component;

class AttendanceFormEdit extends Component
{
    public $attendance;
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

    public function mount(Attendance $attendance)
    {
        $this->attendance = $attendance->toArray();
        $this->positions = Position::query()->select(['id', 'name'])->get();
        
        // Remove seconds from time fields
        $this->attendance['start_time'] = substr($this->attendance['start_time'], 0, -3);
        $this->attendance['batas_start_time'] = substr($this->attendance['batas_start_time'], 0, -3);
        $this->attendance['end_time'] = substr($this->attendance['end_time'], 0, -3);
        $this->attendance['batas_end_time'] = substr($this->attendance['batas_end_time'], 0, -3);

        // Load the associated positions
        // $this->position_ids = $attendance->positions()->pluck('positions.id')->toArray();
    }

    public function save()
    {
        // Validate the input data
        $this->validate();

        // Update the attendance record
        Attendance::find($this->attendance['id'])->update([
            'title' => $this->attendance['title'],
            'description' => $this->attendance['description'],
            'start_time' => $this->attendance['start_time'],
            'batas_start_time' => $this->attendance['batas_start_time'],
            'end_time' => $this->attendance['end_time'],
            'batas_end_time' => $this->attendance['batas_end_time'],
        ]);
        // dd($this->position_ids);
        // Sync the associated positions
        $filteredPositionIds = array_keys(array_filter($this->position_ids));
        $attendance = Attendance::find($this->attendance['id']);
        $attendance->positions()->sync($filteredPositionIds);

        // Redirect with success message
        return redirect()->route('attendances.index')->with('success', "Data absensi berhasil diubah.");
    }

    public function render()
    {
        return view('livewire.attendance-form-edit');
    }
}
