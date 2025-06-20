<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Manage Founders</h2>
        <flux:button variant="primary" wire:click="createFounder">
            Create Founder
        </flux:button>
    </div>

    @if (session()->has('message'))
        <flux:callout class="mb-4" variant="success" icon="check-circle" heading="{{ session('message') }}" />
    @endif

    @if (session()->has('error'))
        <flux:callout class="mb-4" variant="danger" icon="x-circle" heading="{{ session('error') }}" />
    @endif

    <!-- Founder Form Modal -->
    <flux:modal wire:model.self="showFounderModal" class="md:w-4xl max-w-6xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $editingFounderId ? 'Edit Founder' : 'Create New Founder' }}</flux:heading>
            </div>

            <form wire:submit="saveFounder" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <flux:field>
                        <flux:label>Name *</flux:label>

                        <flux:input wire:model="name" type="text" />

                        <flux:error name="name" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Nickname</flux:label>

                        <flux:input wire:model="nickname" type="text" />

                        <flux:error name="nickname" />
                    </flux:field>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <flux:field>
                        <flux:label>Birth Date *</flux:label>

                        <flux:input wire:model="birth_date" type="date" />

                        <flux:error name="birth_date" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Death Date</flux:label>

                        <flux:input wire:model="death_date" type="date" />

                        <flux:error name="death_date" />
                    </flux:field>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <flux:field>
                        <flux:label>Birth Place *</flux:label>

                        <flux:input wire:model="birth_place" type="text" />

                        <flux:error name="birth_place" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Known As *</flux:label>

                        <flux:input wire:model="known_as" type="text" />

                        <flux:error name="known_as" />
                    </flux:field>
                </div>

                <flux:field class="mb-4">
                    <flux:label>Quote</flux:label>

                    <flux:textarea wire:model="quote" rows="3" placeholder="Famous quote from this founder..." />

                    <flux:error name="quote" />
                </flux:field>

                <flux:field class="mb-4">
                    <flux:label>Biography *</flux:label>

                    <flux:textarea wire:model="biography" rows="4" placeholder="Write about this founder's life and achievements..." />

                    <flux:error name="biography" />
                </flux:field>

                <flux:field class="mb-4">
                    <flux:label>Photo *</flux:label>

                    <flux:input wire:model="photo" type="file" accept="image/*" />

                    <flux:error name="photo" />

                    @if ($photo)
                        <div class="mt-2">
                            <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="w-32 h-32 object-cover rounded">
                        </div>
                    @endif
                </flux:field>

                <div class="flex space-x-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost" wire:click="cancelFounderEdit">Cancel</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="primary">{{ $editingFounderId ? 'Update' : 'Save' }}</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Delete Founder Confirmation Modal -->
    <flux:modal wire:model.self="showDeleteFounderModal" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete founder?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to delete this founder.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:button wire:click="$set('showDeleteFounderModal', false)" variant="ghost">Cancel</flux:button>

                <flux:button wire:click="confirmDeleteFounder" variant="danger">Delete founder</flux:button>
            </div>
        </div>
    </flux:modal>

    <!-- Filters -->
    <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg p-4 mb-6">
        <div class="flex space-x-4">
            <div class="flex-1">
                <flux:input icon="magnifying-glass" type="text" wire:model.live="search" placeholder="Search founders by name, known as, or birth place..." />
            </div>
            <div>
                <flux:select wire:model.live="statusFilter">
                    <flux:select.option value="">All Status</flux:select.option>
                    <flux:select.option value="alive">Still Alive</flux:select.option>
                    <flux:select.option value="deceased">Deceased</flux:select.option>
                </flux:select>
            </div>
        </div>
    </div>

    <!-- Founders Table -->
    <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Founder Info</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Life Span</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Known As</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($this->founders as $founder)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($founder->photo)
                                <img src="{{ Storage::url($founder->photo) }}" alt="{{ $founder->name }}" class="w-16 h-16 object-cover rounded-full">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                                    <span class="text-gray-500 text-xs">No Photo</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $founder->name }}</div>
                            @if($founder->nickname)
                                <div class="text-sm text-gray-500">"{{ $founder->nickname }}"</div>
                            @endif
                            <div class="text-xs text-gray-400">{{ $founder->birth_place }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div>{{ $founder->birth_date->format('d M Y') }}</div>
                            @if($founder->death_date)
                                <div>{{ $founder->death_date->format('d M Y') }}</div>
                                <div class="text-xs text-red-600">({{ number_format($founder->age, 0) }} years)</div>
                            @else
                                <div class="text-green-600">Still Alive</div>
                                <div class="text-xs text-green-600">({{ number_format($founder->age, 0) }} years old)</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ Str::limit($founder->known_as, 40) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">

                            <!-- Edit -->
                            <flux:button icon="pencil" wire:click="editFounder({{ $founder->id }})" size="sm" variant="primary" color="blue" />

                            <!-- Delete -->
                            <flux:button icon="trash" wire:click="deleteFounder({{ $founder->id }})" size="sm" variant="primary" color="red" />

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No founders found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="px-6 py-4">
            {{ $this->founders->links() }}
        </div>
    </div>
</div>