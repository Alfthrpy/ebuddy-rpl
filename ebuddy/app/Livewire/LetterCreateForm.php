<?php

namespace App\Livewire;

use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Letter;
use App\Models\Template; // Assuming you have a Template model
use Livewire\Component;

class LetterCreateForm extends Component
{
    use WithFileUploads;

    public $letter = [
        'date_out' => '',
        'no_letter' => '',
        'attachment' => '',
        'subject' => '',
        'destination' => '',
        'destination_position' => '',
        'content' => '',
        'wm_creator' => '',
        'user_id_approver' => '',
        'template_id' => '', // Add template_id
    ];

    public $users;
    public $templates; // To store available templates

    protected $rules = [
        'letter.date_out' => 'required|date',
        'letter.no_letter' => 'required|string|max:255',
        'letter.attachment' => 'nullable|string|max:255',
        'letter.subject' => 'required|string|max:255',
        'letter.destination' => 'required|string|max:255',
        'letter.destination_position' => 'string|max:255',
        'letter.content' => 'required|string',
        'letter.wm_creator' => 'nullable|image|max:1024',
        'letter.user_id_approver' => 'required|exists:users,id',
        'letter.template_id' => 'required|exists:templates,id', // Add validation for template_id
    ];

    public function mount()
    {
        $this->users = User::where('role_id', 2)->get();
        $this->templates = Template::all(); // Retrieve all templates
    }

    public function update()
    {
        $this->validate();

        if ($this->letter['wm_creator']) {
            $this->letter['wm_creator'] = $this->letter['wm_creator']->store('public/signatures');
        }

        Letter::create([
            'no_letter' => $this->letter['no_letter'],
            'date_out' => $this->letter['date_out'],
            'subject' => $this->letter['subject'],
            'attachment' => $this->letter['attachment'],
            'destination' => $this->letter['destination'],
            'destination_position' => $this->letter['destination_position'],
            'content' => $this->letter['content'],
            'wm_creator' => $this->letter['wm_creator'],
            'user_id_approver' => $this->letter['user_id_approver'],
            'template_id' => $this->letter['template_id'], 
            'user_id_creator' => auth()->user()->id,
        ]);

        session()->flash('success', 'Laporan dinas luar berhasil ditambahkan.');

        return redirect()->route('letters.index');
    }

    public function render()
    {
        return view('livewire.letter-create-form');
    }
}
