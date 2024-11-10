<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Registration')]
class RegisterUser extends GuestComponent
{
    #[Validate('required|string')]
    public $name = '';

    #[Validate('required|string|unique:users,username')]
    public $username = '';

    #[Validate('required|email|unique:users,email')]
    public $email = '';

    #[Validate('required|confirmed|min:6')]
    public $password = '';

    public $password_confirmation;

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        Auth::login($user);

        session()->flash('message', 'You have successfully registered.');

        return $this->redirectRoute('home', navigate: true);
    }

    public function render()
    {
        return view('livewire.register-user');
    }
}
