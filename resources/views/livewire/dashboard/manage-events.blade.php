<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Manage Events</h2>
        <button wire:click="createEvent" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Tambah Event
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Event Form Modal -->
    @if ($showForm)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-semibold mb-4">
                        {{ $editingEventId ? 'Edit Event' : 'Tambah Event Baru' }}
                    </h3>

                    <form wire:submit="saveEvent" enctype="multipart/form-data">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                <input wire:model="title" type="text" id="title"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                                <input wire:model="location" type="text" id="location"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                                <input wire:model="date" type="date" id="date"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="time" class="block text-sm font-medium text-gray-700 mb-2">Time</label>
                                <input wire:model="time" type="time" id="time"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="event_description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea wire:model="description" id="event_description" rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                            <button type="button" wire:click="cancelEdit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </button>
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                {{ $editingEventId ? 'Update' : 'Simpan' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Filters -->
    <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg p-4 mb-6">
        <div class="flex space-x-4">
            <div class="flex-1">
                <input wire:model.live="search" type="text" placeholder="Search events by title or location..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <input wire:model.live="dateFilter" type="date"
                       class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            @if ($dateFilter)
                <button wire:click="$set('dateFilter', '')" class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                    Clear Date
                </button>
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
                            <button wire:click="editEvent({{ $event->id }})" class="text-blue-600 hover:text-blue-900">Edit</button>
                            <button wire:click="deleteEvent({{ $event->id }})"
                                    onclick="return confirm('Yakin ingin menghapus event ini?')"
                                    class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data event</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $this->events->links() }}
        </div>
    </div>
</div>
