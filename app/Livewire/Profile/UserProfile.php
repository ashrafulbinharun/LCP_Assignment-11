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
    public $offset = 0;
    public $limit = 10;
    public $posts;
    public $loadMore;

    public function mount($user, $loadMore = true, $offset = 0)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->bio = $user->bio;
        $this->loadMore = $loadMore;
        $this->offset = $offset;
        $this->posts = collect();
        $this->loadPosts();
    }

    public function loadPosts()
    {
        $newPosts = $this->user->posts()->latest()
            ->offset($this->offset)
            ->limit($this->limit)
            ->get();

        if ($newPosts->count() < $this->limit) {
            $this->loadMore = false;
        }

        $this->posts = $this->posts->merge($newPosts);
        $this->offset += $this->limit;
    }

    public function render()
    {
        return view('livewire.profile.user-profile', [
            'posts' => $this->posts,
        ]);
    }
}
