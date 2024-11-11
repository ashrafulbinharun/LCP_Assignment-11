<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home')]
class HomeFeed extends Component
{
    public function render()
    {
        return view('livewire.home-feed');
    }
}
