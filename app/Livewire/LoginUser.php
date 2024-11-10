<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Sine-In')]
class LoginUser extends GuestComponent
{
    #[Validate('required|email|exists:users,email')]
    public $email = '';

    #[Validate('required')]
    public $password = '';

    public $remember = false;

    public function login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (! Auth::attempt($credentials, $this->remember)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match',
            ]);
        }

        session()->regenerate();

        session()->flash('message', 'Login successfully.');

        return redirect()->intended(route('home'));
    }

    public function render()
    {
        return view('livewire.login-user');
    }
}
