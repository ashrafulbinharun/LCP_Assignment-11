<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DeleteAccountForm extends Component
{
    public User $user;

    #[Validate('required')]
    public $password;

    public function deleteAccount()
    {
        $this->validate();

        if (! Hash::check($this->password, $this->user->password)) {
            $this->addError('password', 'The provided password is incorrect.');

            return;
        }

        Auth::logout();
        $this->user->delete();

        session()->invalidate();
        session()->regenerateToken();

        return $this->redirectRoute('home', navigate: true);
    }

    public function render()
    {
        return view('livewire.profile.delete-account-form');
    }
}
