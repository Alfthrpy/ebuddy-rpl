<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UpdatePassword extends Component
{
    public $old_password;
    public $new_password;
    public $confirm_password;

    protected $rules = [
        'current_password' => 'required',
        'password' => 'required|min:8|confirmed',
    ];

    public function updatePassword()
    {
        // dd(Hash::check($this->old_password, Auth::user()->password));
        if (!Hash::check($this->old_password, Auth::user()->password)) {
            session()->flash('failed', 'Current password does not match.');
            return;
        }
        
        if($this->new_password !== $this->confirm_password) {
            session()->flash('failed', 'New password does not match.');
            return;
        }

        $user = Auth::user();

        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        session()->flash('success', 'Password updated successfully.');

        // // Reset input fields
        $this->reset(['old_password', 'new_password', 'confirm_password']);
    }

    public function render()
    {
        return view('livewire.update-password');
    }
}
