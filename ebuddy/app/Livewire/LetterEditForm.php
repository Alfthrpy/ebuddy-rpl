<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Letter;
use App\Models\User;
use App\Models\Template;

use Livewire\WithFileUploads;

class LetterEditForm extends Component
{
    use WithFileUploads;

    public $letter;
    public $users;
    public $templates;

    public function mount()
    {
        $this->users = User::where('role_id', 2)->get();
        $this->templates = Template::all(); // Retrieve all templates
    }

    public function update()
    {
        $this->validate([
            'letter.date_out' => 'required|date',
            'letter.no_letter' => 'required|string|max:255',
            'letter.attachment' => 'nullable|string|max:255',
            'letter.subject' => 'required|string|max:255',
            'letter.destination' => 'required|string|max:255',
            'letter.destination_position' => 'nullable|string|max:255',
            'letter.content' => 'required|string',
            'letter.wm_creator' => 'nullable|image|max:1024', // assuming image upload
            'letter.user_id_approver' => 'required|integer|exists:users,id',
            'letter.template_id' => 'required|integer|exists:templates,id',
        ]);

        // Handle the image upload if a new image is uploaded
        if ($this->letter['wm_creator']) {
            $this->letter['wm_creator'] = $this->letter['wm_creator']->store('public/signatures');
        }

        // Set the status to pending
        $this->letter['status'] = 'pending';

        Letter::findOrFail($this->letter['id'])->update($this->letter);

        session()->flash('success', 'Letter updated successfully.');
        return redirect()->route('letters.index'); // Adjust the route as needed
    }

    public function render()
    {
        return view('livewire.letter-edit-form');
    }
}
