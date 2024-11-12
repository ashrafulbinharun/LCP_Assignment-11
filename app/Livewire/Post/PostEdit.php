<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Edit Post')]
class PostEdit extends Component
{
    use WithFileUploads;

    public Post $post;

    #[Validate('required|string|min:5')]
    public $content;

    #[Validate('nullable|max:2048|mimetypes:image/jpeg,image/png,image/jpg')]
    public $image;

    public $removeExistingImage;

    public function mount($post)
    {
        $this->post = $post;
        $this->image = $post->image;
        $this->content = $post->content;
        $this->removeExistingImage = false;
    }

    public function save()
    {
        $this->authorize('manage', $this->post);

        $validated = $this->validate();

        // image removal
        if ($this->removeExistingImage && $this->post->image) {
            Storage::disk('public')->delete($this->post->image);
            $validated['image'] = null;
        }

        // new image
        if ($this->image && $this->post->image) {
            Storage::disk('public')->delete($this->post->image);
            $validated['image'] = $this->image->storePublicly('post_images', ['disk' => 'public']);
        }

        $this->post->update($validated);

        session()->flash('message', 'Post updated');

        return $this->redirectRoute('posts.edit', ['post' => $this->post], navigate: true);
    }

    public function render()
    {
        return view('livewire.post.post-edit');
    }
}
