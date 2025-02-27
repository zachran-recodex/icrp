<div class="bg-white rounded-lg shadow-sm border border-gray-100">
    <!-- Edit Form -->
    <form wire:submit.prevent="save" class="p-6 space-y-6">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                Title
            </label>
            <input type="text" wire:model="title" id="title"
                   class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
            @error('title')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-1">
                Subtitle
            </label>
            <textarea wire:model="subtitle" id="subtitle" rows="3"  class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
            @error('subtitle')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="button_text" class="block text-sm font-medium text-gray-700 mb-1">
                Button Text
            </label>
            <input type="text" wire:model="button_text" id="button_text"
                   class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
            @error('button_text')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                Image
            </label>

            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                 x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                 x-on:livewire-upload-progress="progress = $event.detail.progress">

                <div class="flex items-center space-x-4">
                    <label class="block">
                        <span class="sr-only">Choose file</span>
                        <input type="file" wire:model="temp_image" accept="image/*"
                               class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-medium
                            file:bg-primary-50 file:text-primary-700
                            hover:file:bg-primary-100">
                    </label>

                    @if ($image && !$temp_image)
                        <span class="text-xs text-gray-500">Current: {{ $image }}</span>
                    @endif
                </div>

                <!-- Progress Bar -->
                <div x-show="isUploading" class="mt-2">
                    <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-2 bg-primary-500 rounded-full" :style="`width: ${progress}%`"></div>
                    </div>
                </div>

                @error('temp_image')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image Preview -->
            <div class="mt-4">
                @if ($temp_image)
                    <img src="{{ $temp_image->temporaryUrl() }}" alt="New Hero Preview"
                         class="h-40 w-auto object-cover rounded-md">
                @elseif ($image)
                    <img src="{{ Storage::url('hero/' . $image) }}" alt="Current Hero"
                         class="h-40 w-auto object-cover rounded-md">
                @endif
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Save Changes
            </button>
        </div>
    </form>
</div>
