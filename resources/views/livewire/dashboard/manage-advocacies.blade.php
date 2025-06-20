<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Manage Advocacies</h2>
        <flux:button variant="primary" wire:click="createAdvocacy">
            Create Advocacy
        </flux:button>
    </div>

    @if (session()->has('message'))
        <flux:callout class="mb-4" variant="success" icon="check-circle" heading="{{ session('message') }}" />
    @endif

    @if (session()->has('error'))
        <flux:callout class="mb-4" variant="danger" icon="x-circle" heading="{{ session('error') }}" />
    @endif

    <!-- Advocacy Form Modal -->
    <flux:modal wire:model.self="showAdvocacyModal" class="md:w-4xl max-w-6xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $editingAdvocacyId ? 'Edit Advocacy' : 'Create New Advocacy' }}</flux:heading>
            </div>

            <form wire:submit="saveAdvocacy" enctype="multipart/form-data">
                <flux:field class="mb-4">
                    <flux:label>Title</flux:label>

                    <flux:input wire:model="title" type="text" />

                    <flux:error name="title" />
                </flux:field>

                <flux:field class="mb-16">
                    <flux:label>Content</flux:label>

                    @livewire('livewire-quill', [
                        'quillId' => 'advocacy-editor',
                        'data' => $content,
                        'placeholder' => 'Type advocacy content...',
                        'classes' => 'bg-white min-h-[300px]'
                    ])

                    <flux:error name="content" />
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
                        <flux:button variant="ghost" wire:click="cancelAdvocacyEdit">Cancel</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="primary">{{ $editingAdvocacyId ? 'Update' : 'Save' }}</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Delete Advocacy Confirmation Modal -->
    <flux:modal wire:model.self="showDeleteAdvocacyModal" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete advocacy?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to delete this advocacy.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:button wire:click="$set('showDeleteAdvocacyModal', false)" variant="ghost">Cancel</flux:button>

                <flux:button wire:click="confirmDeleteAdvocacy" variant="danger">Delete advocacy</flux:button>
            </div>
        </div>
    </flux:modal>

    <!-- Search Filter -->
    <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg p-4 mb-6">
        <div class="flex space-x-4">
            <div class="flex-1">
                <flux:input icon="magnifying-glass" type="text" wire:model.live="search" placeholder="Search advocacies..." />
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
                            {{ Str::limit(strip_tags($advocacy->content), 50) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">

                            <!-- Edit -->
                            <flux:button icon="pencil" wire:click="editAdvocacy({{ $advocacy->id }})" size="sm" variant="primary" color="blue" />

                            <!-- Delete -->
                            <flux:button icon="trash" wire:click="deleteAdvocacy({{ $advocacy->id }})" size="sm" variant="primary" color="red" />

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No advocacies found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $this->advocacies->links() }}
        </div>
    </div>

    <script>
    // Listen for Livewire events to reinitialize Quill editor
    document.addEventListener('livewire:init', function() {
        Livewire.on('advocacy-form-shown', function(event) {
            setTimeout(function() {
                // Trigger Livewire Quill initialization
                window.dispatchEvent(new CustomEvent('livewire-quill:init'));
            }, 300);
        });

        // Listen for Quill clear content event
        Livewire.on('quill-clear-content', function(data) {
            setTimeout(function() {
                // Find the Quill editor instance by its container ID
                const editorContainer = document.querySelector('#' + data.editorId);
                if (editorContainer && editorContainer.__quill) {
                    // Clear the Quill editor content
                    editorContainer.__quill.setContents([]);
                    editorContainer.__quill.setText('');
                } else {
                    // If Quill instance not found, try alternative approach
                    const quillEditor = document.querySelector('#' + data.editorId + ' .ql-editor');
                    if (quillEditor) {
                        quillEditor.innerHTML = '<p><br></p>';
                    }
                }
            }, 100);
        });

        // Listen for Quill set content event (for editing)
        Livewire.on('quill-set-content', function(data) {
            setTimeout(function() {
                // Find the Quill editor instance by its container ID
                const editorContainer = document.querySelector('#' + data.editorId);
                if (editorContainer && editorContainer.__quill) {
                    // Set the Quill editor content
                    editorContainer.__quill.root.innerHTML = data.content;
                } else {
                    // If Quill instance not found, try alternative approach
                    const quillEditor = document.querySelector('#' + data.editorId + ' .ql-editor');
                    if (quillEditor) {
                        quillEditor.innerHTML = data.content || '<p><br></p>';
                    }
                }
            }, 100);
        });
    });
    </script>
</div>
