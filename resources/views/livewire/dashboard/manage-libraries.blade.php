<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Manage Libraries</h2>
        <flux:button variant="primary" wire:click="createLibrary">
            Create Library
        </flux:button>
    </div>

    @if (session()->has('message'))
        <flux:callout class="mb-4" variant="success" icon="check-circle" heading="{{ session('message') }}" />
    @endif

    @if (session()->has('error'))
        <flux:callout class="mb-4" variant="danger" icon="x-circle" heading="{{ session('error') }}" />
    @endif

    <!-- Library Form Modal -->
    <flux:modal wire:model.self="showLibraryModal" class="md:w-4xl max-w-6xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $editingLibraryId ? 'Edit Library' : 'Create New Library' }}</flux:heading>
            </div>

            <form wire:submit="saveLibrary" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <flux:field>
                        <flux:label>Title *</flux:label>

                        <flux:input wire:model="title" type="text" />

                        <flux:error name="title" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Author *</flux:label>

                        <flux:input wire:model="author" type="text" />

                        <flux:error name="author" />
                    </flux:field>
                </div>

                <flux:field class="mb-4">
                    <flux:label>Description *</flux:label>

                    <flux:textarea wire:model="description" rows="4" placeholder="Write about this book..." />

                    <flux:error name="description" />
                </flux:field>

                <flux:field class="mb-4">
                    <flux:label>Book Cover *</flux:label>

                    <flux:input wire:model="image" type="file" accept="image/*" />

                    <flux:error name="image" />

                    @if ($image)
                        <div class="mt-2">
                            <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-32 h-40 object-cover rounded">
                        </div>
                    @endif
                </flux:field>

                <div class="flex space-x-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost" wire:click="cancelLibraryEdit">Cancel</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="primary">{{ $editingLibraryId ? 'Update' : 'Save' }}</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Delete Library Confirmation Modal -->
    <flux:modal wire:model.self="showDeleteLibraryModal" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete library?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to delete this library.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:button wire:click="$set('showDeleteLibraryModal', false)" variant="ghost">Cancel</flux:button>

                <flux:button wire:click="confirmDeleteLibrary" variant="danger">Delete library</flux:button>
            </div>
        </div>
    </flux:modal>

    <!-- Filters -->
    <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg p-4 mb-6">
        <div class="flex space-x-4">
            <div class="flex-1">
                <flux:input icon="magnifying-glass" type="text" wire:model.live="search" placeholder="Search books by title, author, or description..." />
            </div>
        </div>
    </div>

    <!-- Libraries Table -->
    <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cover</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book Info</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($this->libraries as $library)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($library->image)
                                <img src="{{ Storage::url($library->image) }}" alt="{{ $library->title }}" class="w-16 h-20 object-cover rounded">
                            @else
                                <div class="w-16 h-20 bg-gray-200 rounded flex items-center justify-center">
                                    <span class="text-gray-500 text-xs">No Cover</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ Str::limit($library->title, 40) }}</div>
                            <div class="text-sm text-gray-500">by {{ $library->author }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ Str::limit($library->description, 100) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">

                            <!-- Edit -->
                            <flux:button icon="pencil" wire:click="editLibrary({{ $library->id }})" size="sm" variant="primary" class="bg-blue-500 hover:bg-blue-600" />

                            <!-- Delete -->
                            <flux:button icon="trash" wire:click="deleteLibrary({{ $library->id }})" size="sm" variant="danger" />

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No libraries found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="px-6 py-4">
            {{ $this->libraries->links() }}
        </div>
    </div>
</div>