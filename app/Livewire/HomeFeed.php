<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home')]
class HomeFeed extends Component
{
    public $offset;

    public $limit = 5;

    public $posts;

    public $loadMore;

    public function mount($loadMore = true, $offset = 0)
    {
        $this->loadMore = $loadMore;
        $this->offset = $offset;
        $this->posts = collect();
        $this->loadPosts();
    }

    public function loadPosts()
    {
        $newPosts = Post::with('user')->latest()
            ->offset($this->offset)
            ->limit($this->limit)
            ->get();

        $this->posts = $this->posts->merge($newPosts);

        if ($newPosts->count() < $this->limit) {
            $this->loadMore = false;
        }

        $this->offset += $this->limit;
    }

    public function render()
    {
        return view('livewire.home-feed', [
            'posts' => $this->posts,
        ]);
    }
}
