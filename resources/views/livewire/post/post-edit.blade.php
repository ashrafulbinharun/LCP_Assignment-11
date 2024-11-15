<form wire:submit.prevent="save" class="px-4 py-5 mx-auto space-y-6 bg-white border-2 border-black rounded-lg shadow max-w-none sm:px-6" x-data="imageUpdate(@entangle('removeExistingImage'), {{ $post->image ? 'true' : 'false' }})">

    <div class="flex space-x-3">
        <div class="flex-shrink-0">
            <img class="w-8 h-8 rounded-full" src="{{ auth()->user()->get_avatar }}" alt="{{ auth()->user()->name }}" />
        </div>

        <div class="flex-1">
            <div class="relative flex items-center justify-center mb-4">
                <template x-if="!imagePreview && hasExistingImage">
                    <img src="{{ asset('storage/' . $post->image) }}" class="object-cover w-full rounded-lg max-h-64 md:max-h-72" alt="Post Image">
                </template>

                <template x-if="imagePreview">
                    <img :src="imagePreview" class="object-cover w-full rounded-lg max-h-64 md:max-h-72" alt="Post Image Preview">
                </template>

                <button type="button" @click="removeImage"
                    class="absolute flex items-center justify-center w-6 h-6 text-white bg-gray-600 rounded-full top-2 right-2 hover:bg-red-600"
                    x-show="imagePreview || hasExistingImage">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <input type="hidden" wire:model="removeExistingImage">

            <div class="w-full font-normal text-gray-700">
                <textarea wire:model="content" class="block w-full p-2 text-gray-900 bg-gray-200 border-none rounded-lg outline-none focus:ring-0" rows="3"></textarea>

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $error }}</p>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="flex items-center justify-between">
        <div class="flex gap-4 text-gray-600">
            <div>
                <input type="file" wire:model="image" id="picture" class="hidden" x-ref="pictureInput" accept="image/*" @change="previewImage">
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
            wire:loading.remove.attr="aria-disabled:false" class="flex items-center gap-2 px-4 py-2 -m-2 text-xs font-semibold text-white bg-gray-800 rounded-full hover:bg-black">
            <span wire:loading>Uploading...</span>
            <span wire:loading.remove>Update Post</span>
        </button>
    </div>
</form>

<script>
    function imageUpdate(removeExistingImage, hasExistingImage) {
        return {
            imagePreview: null,
            hasExistingImage: hasExistingImage,
            removeExistingImage: removeExistingImage,

            previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    this.imagePreview = URL.createObjectURL(file);
                    this.hasExistingImage = false;
                    this.removeExistingImage = false;
                }
            },

            removeImage() {
                this.imagePreview = null;
                this.removeExistingImage = true;
                this.$refs.pictureInput.value = null;
                this.hasExistingImage = false;
            }
        };
    }
</script>
