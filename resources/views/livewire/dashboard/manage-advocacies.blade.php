<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Manage Advocacies</h2>
        <button wire:click="createAdvocacy" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Tambah Advocacy
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Advocacy Form Modal -->
    @if ($showForm)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-semibold mb-4">
                        {{ $editingAdvocacyId ? 'Edit Advocacy' : 'Tambah Advocacy Baru' }}
                    </h3>

                    <form wire:submit="saveAdvocacy" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                            <input wire:model="title" type="text" id="title"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                            <textarea wire:model="content" id="content" rows="6"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                            <input wire:model="image" type="file" id="image" accept="image/*"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                            @if ($image)
                                <div class="mt-2">
                                    <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-32 h-32 object-cover rounded">
                                </div>
                            @endif
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button type="button" wire:click="cancelAdvocacyEdit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </button>
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                {{ $editingAdvocacyId ? 'Update' : 'Simpan' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Search Filter -->
    <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg p-4 mb-6">
        <div class="flex space-x-4">
            <div class="flex-1">
                <input wire:model.live="search" type="text" placeholder="Search advocacies..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
    </div>

    <!-- Advocacies Table -->
    <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($this->advocacies as $advocacy)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($advocacy->image)
                                <img src="{{ Storage::url($advocacy->image) }}" alt="{{ $advocacy->title }}" class="w-16 h-16 object-cover rounded">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                    <span class="text-gray-500 text-xs">No Image</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ Str::limit($advocacy->title, 30) }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ Str::limit($advocacy->content, 50) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <button wire:click="editAdvocacy({{ $advocacy->id }})" class="text-blue-600 hover:text-blue-900">Edit</button>
                            <button wire:click="deleteAdvocacy({{ $advocacy->id }})"
                                    onclick="return confirm('Yakin ingin menghapus advocacy ini?')"
                                    class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data advocacy</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $this->advocacies->links() }}
        </div>
    </div>
</div>
