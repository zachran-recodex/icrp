<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Manage Events</h2>
        <flux:button variant="primary" wire:click="createEvent">
            Create Event
        </flux:button>
    </div>

    @if (session()->has('message'))
        <flux:callout class="mb-4" variant="success" icon="check-circle" heading="{{ session('message') }}" />
    @endif

    @if (session()->has('error'))
        <flux:callout class="mb-4" variant="danger" icon="x-circle" heading="{{ session('error') }}" />
    @endif

    <!-- Event Form Modal -->
    <flux:modal wire:model.self="showEventModal" class="md:w-4xl max-w-6xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $editingEventId ? 'Edit Event' : 'Create New Event' }}</flux:heading>
            </div>

            <form wire:submit="saveEvent" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <flux:field>
                        <flux:label>Title</flux:label>

                        <flux:input wire:model="title" type="text" />

                        <flux:error name="title" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Location</flux:label>

                        <flux:input wire:model="location" type="text" />

                        <flux:error name="location" />
                    </flux:field>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <flux:field>
                        <flux:label>Date</flux:label>

                        <flux:input wire:model="date" type="date" />

                        <flux:error name="date" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Time</flux:label>

                        <flux:input wire:model="time" type="time" />

                        <flux:error name="time" />
                    </flux:field>
                </div>

                <flux:field class="mb-4">
                    <flux:label>Description</flux:label>

                    <flux:textarea wire:model="description" rows="4" />

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
                        <flux:button variant="ghost" wire:click="cancelEventEdit">Cancel</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="primary">{{ $editingEventId ? 'Update' : 'Save' }}</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Delete Event Confirmation Modal -->
    <flux:modal wire:model.self="showDeleteEventModal" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete event?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to delete this event.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:button wire:click="$set('showDeleteEventModal', false)" variant="ghost">Cancel</flux:button>

                <flux:button wire:click="confirmDeleteEvent" variant="danger">Delete event</flux:button>
            </div>
        </div>
    </flux:modal>

    <!-- Filters -->
    <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg p-4 mb-6">
        <div class="flex space-x-4">
            <div class="flex-1">
                <flux:input icon="magnifying-glass" type="text" wire:model.live="search" placeholder="Search events by title or location..." />
            </div>
            <div>
                <flux:input wire:model.live="dateFilter" type="date" />
            </div>
            @if ($dateFilter)
                <flux:button wire:click="$set('dateFilter', '')" variant="danger" size="sm">
                    Clear Date
                </flux:button>
            @endif
        </div>
    </div>

    <!-- Events Table -->
    <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Info</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($this->events as $event)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($event->image)
                                <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" class="w-16 h-16 object-cover rounded">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                    <span class="text-gray-500 text-xs">No Image</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ Str::limit($event->title, 40) }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($event->description, 60) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div>{{ $event->date->format('d M Y') }}</div>
                            <div>{{ $event->time->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ Str::limit($event->location, 30) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">

                            <!-- Edit -->
                            <flux:button icon="pencil" wire:click="editEvent({{ $event->id }})" size="sm" variant="primary" color="blue" />

                            <!-- Delete -->
                            <flux:button icon="trash" wire:click="deleteEvent({{ $event->id }})" size="sm" variant="primary" color="red" />

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No events found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $this->events->links() }}
        </div>
    </div>
</div>
