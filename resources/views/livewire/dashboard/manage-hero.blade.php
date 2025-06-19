<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Manage Hero</h2>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg p-6 mb-6">
        <h3 class="text-lg font-semibold mb-4">Update Hero Section</h3>

        <form wire:submit="save" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input wire:model="title" type="text" id="title"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                <input wire:model="subtitle" type="text" id="subtitle"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('subtitle') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                @elseif ($this->hero && $this->hero->image)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600 mb-2">Current image:</p>
                        <img src="{{ Storage::url($this->hero->image) }}" alt="Current" class="w-32 h-32 object-cover rounded">
                    </div>
                @endif
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Update Hero
                </button>
            </div>
        </form>
    </div>

    @if ($this->hero)
        <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Current Hero Preview</h3>
            <div class="flex items-center space-x-4">
                @if ($this->hero->image)
                    <img src="{{ Storage::url($this->hero->image) }}" alt="{{ $this->hero->title }}" class="w-24 h-24 object-cover rounded">
                @endif
                <div>
                    <h4 class="text-xl font-bold text-gray-900">{{ $this->hero->title }}</h4>
                    <p class="text-gray-600">{{ $this->hero->subtitle }}</p>
                </div>
            </div>
        </div>
    @else
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <p class="text-yellow-800">Belum ada data hero. Silakan isi form di atas untuk membuat hero section.</p>
        </div>
    @endif
</div>
