<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Manage Call To Action</h2>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg p-6 mb-6">
        <h3 class="text-lg font-semibold mb-4">Update Call To Action Section</h3>

        <form wire:submit="save" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input wire:model="title" type="text" id="title"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                <textarea wire:model="subtitle" id="subtitle" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                @error('subtitle') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="button_text" class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                <input wire:model="button_text" type="text" id="button_text"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('button_text') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image (Optional)</label>
                <input wire:model="image" type="file" id="image" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                @if ($image)
                    <div class="mt-2">
                        <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-32 h-32 object-cover rounded">
                    </div>
                @elseif ($this->callToAction && $this->callToAction->image)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600 mb-2">Current image:</p>
                        <img src="{{ Storage::url($this->callToAction->image) }}" alt="Current" class="w-32 h-32 object-cover rounded">
                    </div>
                @endif
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Update Call To Action
                </button>
            </div>
        </form>
    </div>

    @if ($this->callToAction)
        <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Current Call To Action Preview</h3>
            <div class="flex items-start space-x-4">
                @if ($this->callToAction->image)
                    <img src="{{ Storage::url($this->callToAction->image) }}" alt="{{ $this->callToAction->title }}" class="w-24 h-24 object-cover rounded">
                @endif
                <div class="flex-1">
                    <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $this->callToAction->title }}</h4>
                    <p class="text-gray-600 mb-3">{{ $this->callToAction->subtitle }}</p>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded font-medium" disabled>
                        {{ $this->callToAction->button_text }}
                    </button>
                </div>
            </div>
        </div>
    @else
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <p class="text-yellow-800">Belum ada data call to action. Silakan isi form di atas untuk membuat call to action section.</p>
        </div>
    @endif
</div>