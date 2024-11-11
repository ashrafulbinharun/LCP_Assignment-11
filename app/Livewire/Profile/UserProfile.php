<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Profile')]
class UserProfile extends Component
{
    public User $user;

    public $name;

    public $bio;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->bio = $user->bio;
    }

    public function render()
    {
        return view('livewire.profile.user-profile');
    }
}
