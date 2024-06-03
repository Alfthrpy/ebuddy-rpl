<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Overtime;

class OvertimeCreateForm extends Component
{
    public $overtime = [
        'objective' => '',
        'place' => '',
        'start_date' => '',
        'end_date' => '',
        'result' => '',
        'user_id_approver' => '',
    ];

    public $users;

    protected $rules = [
        'overtime.objective' => 'required|string|max:255',
        'overtime.place' => 'required|string|max:255',
        'overtime.start_date' => 'required|date',
        'overtime.end_date' => 'required|date|after_or_equal:overtime.start_date',
        'overtime.result' => 'required|string',
        'overtime.user_id_approver' => 'required|exists:users,id',
    ];

    public function mount()
    {
        $this->users = User::where('role_id', 2)->get();
    }

    public function save()
    {
        $this->validate();
        // dd($this->overtime);

        Overtime::create([
            'objective' => $this->overtime['objective'],
            'place' => $this->overtime['place'],
            'start_date' => $this->overtime['start_date'],
            'end_date' => $this->overtime['end_date'],
            'result' => $this->overtime['result'],
            'user_id_approver' => $this->overtime['user_id_approver'],
            'user_id_creator' => auth()->id(),
        ]);

        session()->flash('success', 'Laporan dinas luar berhasil ditambahkan.');
        return redirect()->route('overtimes.index');
    }

    public function render()
    {
        return view('livewire.overtime-create-form');
    }
}
