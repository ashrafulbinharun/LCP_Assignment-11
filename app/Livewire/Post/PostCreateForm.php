<?php

namespace App\Livewire\Post;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostCreateForm extends Component
{
    use WithFileUploads;

    #[Validate('required|string|min:5')]
    public $content;

    #[Validate('nullable|max:2048|mimetypes:image/jpeg,image/png,image/jpg')]
    public $image;

    public function save()
    {
        $validated = $this->validate();

        if ($this->image) {
            $validated['image'] = $this->image->storePublicly('post_images', ['disk' => 'public']);
        }

        auth()->user()->posts()->create($validated);

        session()->flash('message', 'Post created');

        $this->redirectRoute('home', navigate: true);
    }

    public function render()
    {
        return view('livewire.post.post-create-form');
    }
}
