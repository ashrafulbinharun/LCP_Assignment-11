<form wire:submit.prevent="save" class="px-4 py-5 mx-auto space-y-6 bg-white border-2 border-black rounded-lg shadow max-w-none sm:px-6" x-data="imagePreview()">
    <div class="flex space-x-3">
        {{-- User Avatar --}}
        <div class="flex-shrink-0">
            <img class="w-8 h-8 rounded-full" src="{{ auth()->user()->get_avatar }}" alt="{{ auth()->user()->name }}" />
        </div>

        <div class="flex-1">
            {{-- Image Preview --}}
            <div class="relative flex items-center justify-center" x-show="imagePreview">
                <img x-bind:src="imagePreview" class="object-cover w-full mb-4 rounded-lg min-h-auto max-h-64 md:max-h-72" alt="Post Image Preview" />

                {{-- Button to Remove Image --}}
                <button type="button" wire:click="clearImage" @click="removeImage()"
                    class="absolute flex items-center justify-center w-6 h-6 text-white bg-gray-600 rounded-full top-2 right-2 hover:bg-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Content --}}
            <div class="w-full font-normal text-gray-700">
                <textarea class="block w-full p-2 text-gray-900 bg-gray-200 border-none rounded-lg outline-none focus:ring-0 focus:ring-offset-0" wire:model="content" rows="3"
                    placeholder="What's going on, {{ auth()->user()->name }}?">{{ old('content') }}</textarea>

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $error }}</p>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    {{-- Create Post Card Bottom --}}
    <div class="flex items-center justify-between">
        <div class="flex gap-4 text-gray-600">
            {{-- Upload Picture Button --}}
            <div>
                <input type="file" wire:model="image" id="picture" class="hidden" x-ref="pictureInput" @change="previewImage($event)" />
                <label for="picture" class="flex items-center gap-2 p-2 -m-2 text-xs text-gray-600 rounded-full cursor-pointer hover:text-gray-800">
                    <span class="sr-only">Picture</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </label>
            </div>
        </div>

        <button type="submit" wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:loading.attr="aria-disabled:true"
            wire:loading.remove.attr="aria-disabled:false" class="flex items-center gap-2 px-4 py-2 -m-2 text-xs font-semibold text-white bg-gray-800 rounded-lg hover:bg-black">
            <span wire:loading>Uploading...</span>
            <span wire:loading.remove>Post</span>
        </button>
    </div>
</form>

<script>
    function imagePreview() {
        return {
            imagePreview: null,

            previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    this.imagePreview = URL.createObjectURL(file);
                }
            },

            removeImage() {
                this.imagePreview = null;
                this.$refs.pictureInput.value = null;
            }
        }
    }
</script>
