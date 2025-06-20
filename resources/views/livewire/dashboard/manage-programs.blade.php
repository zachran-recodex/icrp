<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Manage Programs</h2>
        <flux:button variant="primary" wire:click="createProgram">
            Create Program
        </flux:button>
    </div>

    @if (session()->has('message'))
        <flux:callout class="mb-4" variant="success" icon="check-circle" heading="{{ session('message') }}" />
    @endif

    @if (session()->has('error'))
        <flux:callout class="mb-4" variant="danger" icon="x-circle" heading="{{ session('error') }}" />
    @endif

    <!-- Program Form Modal -->
    <flux:modal wire:model.self="showProgramModal" class="md:w-4xl max-w-6xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $editingProgramId ? 'Edit Program' : 'Create New Program' }}</flux:heading>
            </div>

            <form wire:submit="saveProgram" enctype="multipart/form-data">
                <flux:field class="mb-4">
                    <flux:label>Title</flux:label>

                    <flux:input wire:model="title" type="text" />

                    <flux:error name="title" />
                </flux:field>

                <flux:field class="mb-4">
                    <flux:label>Description</flux:label>

                    <flux:textarea wire:model="description" rows="6" />

                    <flux:error name="description" />
                </flux:field>

                <flux:field class="mb-4">
                    <flux:label>Image</flux:label>

                    <flux:input wire:model="image" type="file" accept="image/*" />

                    <flux:error name="image" />

                    @if ($image)
                        <div class="mt-2">
                            <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-32 h-32 object-cover rounded">
                        </div>
                    @endif
                </flux:field>

                <div class="flex space-x-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost" wire:click="cancelProgramEdit">Cancel</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="primary">{{ $editingProgramId ? 'Update' : 'Save' }}</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Delete Program Confirmation Modal -->
    <flux:modal wire:model.self="showDeleteProgramModal" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete program?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to delete this program.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:button wire:click="$set('showDeleteProgramModal', false)" variant="ghost">Cancel</flux:button>

                <flux:button wire:click="confirmDeleteProgram" variant="danger">Delete program</flux:button>
            </div>
        </div>
    </flux:modal>

    <!-- Filters -->
    <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg p-4 mb-6">
        <div class="flex space-x-4">
            <div class="flex-1">
                <flux:input icon="magnifying-glass" type="text" wire:model.live="search" placeholder="Search programs by title or description..." />
            </div>
        </div>
    </div>

    <!-- Programs Table -->
    <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program Info</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($this->programs as $program)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($program->image)
                                <img src="{{ Storage::url($program->image) }}" alt="{{ $program->title }}" class="w-16 h-16 object-cover rounded">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                    <span class="text-gray-500 text-xs">No Image</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ Str::limit($program->title, 40) }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($program->description, 100) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">

                            <!-- Edit -->
                            <flux:button icon="pencil" wire:click="editProgram({{ $program->id }})" size="sm" variant="primary" class="bg-blue-500 hover:bg-blue-600" />

                            <!-- Delete -->
                            <flux:button icon="trash" wire:click="deleteProgram({{ $program->id }})" size="sm" variant="danger" />

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">No programs found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $this->programs->links() }}
        </div>
    </div>
</div>