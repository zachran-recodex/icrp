<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Manage Members</h2>
        <button wire:click="createMember" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Tambah Member
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Member Form Modal -->
    @if ($showForm)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-5 mx-auto p-5 border w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 shadow-lg rounded-md bg-white max-h-screen overflow-y-auto">
                <div class="mt-3">
                    <h3 class="text-lg font-semibold mb-4">
                        {{ $editingMemberId ? 'Edit Member' : 'Tambah Member Baru' }}
                    </h3>

                    <form wire:submit="saveMember" enctype="multipart/form-data">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="member_name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                                <input wire:model="name" type="text" id="member_name"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="member_nickname" class="block text-sm font-medium text-gray-700 mb-2">Nickname</label>
                                <input wire:model="nickname" type="text" id="member_nickname"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('nickname') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Birth Date *</label>
                                <input wire:model="birth_date" type="date" id="birth_date"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('birth_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="death_date" class="block text-sm font-medium text-gray-700 mb-2">Death Date</label>
                                <input wire:model="death_date" type="date" id="death_date"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('death_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="birth_place" class="block text-sm font-medium text-gray-700 mb-2">Birth Place *</label>
                                <input wire:model="birth_place" type="text" id="birth_place"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('birth_place') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="known_as" class="block text-sm font-medium text-gray-700 mb-2">Known As *</label>
                                <input wire:model="known_as" type="text" id="known_as"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('known_as') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="position" class="block text-sm font-medium text-gray-700 mb-2">Position *</label>
                                <input wire:model="position" type="text" id="position"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('position') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="dewan_category" class="block text-sm font-medium text-gray-700 mb-2">Dewan Category *</label>
                                <select wire:model="dewan_category" id="dewan_category"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih Kategori Dewan</option>
                                    <option value="direktur eksekutif">Direktur Eksekutif</option>
                                    <option value="pengurus">Pengurus</option>
                                    <option value="kehormatan">Kehormatan</option>
                                    <option value="pembina">Pembina</option>
                                    <option value="pengawas">Pengawas</option>
                                    <option value="pengurus harian">Pengurus Harian</option>
                                </select>
                                @error('dewan_category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="member_quote" class="block text-sm font-medium text-gray-700 mb-2">Quote</label>
                            <textarea wire:model="quote" id="member_quote" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Famous quote from this member..."></textarea>
                            @error('quote') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="member_biography" class="block text-sm font-medium text-gray-700 mb-2">Biography *</label>
                            <textarea wire:model="biography" id="member_biography" rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Write about this member's life and achievements..."></textarea>
                            @error('biography') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="member_photo" class="block text-sm font-medium text-gray-700 mb-2">Photo *</label>
                            <input wire:model="photo" type="file" id="member_photo" accept="image/*"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                            @if ($photo)
                                <div class="mt-2">
                                    <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="w-32 h-32 object-cover rounded">
                                </div>
                            @endif
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button type="button" wire:click="cancelEdit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </button>
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                {{ $editingMemberId ? 'Update' : 'Simpan' }}
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
                <input wire:model.live="search" type="text" placeholder="Search members by name, known as, birth place, or position..." 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <select wire:model.live="statusFilter" 
                        class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Status</option>
                    <option value="alive">Still Alive</option>
                    <option value="deceased">Deceased</option>
                </select>
            </div>
            <div>
                <select wire:model.live="categoryFilter" 
                        class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Categories</option>
                    <option value="direktur eksekutif">Direktur Eksekutif</option>
                    <option value="pengurus">Pengurus</option>
                    <option value="kehormatan">Kehormatan</option>
                    <option value="pembina">Pembina</option>
                    <option value="pengawas">Pengawas</option>
                    <option value="pengurus harian">Pengurus Harian</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Members Table -->
    <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member Info</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Life Span</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position & Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($this->members as $member)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($member->photo)
                                <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}" class="w-16 h-16 object-cover rounded-full">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                                    <span class="text-gray-500 text-xs">No Photo</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $member->name }}</div>
                            @if($member->nickname)
                                <div class="text-sm text-gray-500">"{{ $member->nickname }}"</div>
                            @endif
                            <div class="text-xs text-gray-400">{{ $member->birth_place }}</div>
                            <div class="text-xs text-gray-600">{{ Str::limit($member->known_as, 40) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div>{{ $member->birth_date->format('d M Y') }}</div>
                            @if($member->death_date)
                                <div>{{ $member->death_date->format('d M Y') }}</div>
                                <div class="text-xs text-red-600">({{ number_format($member->age, 0) }} years)</div>
                            @else
                                <div class="text-green-600">Still Alive</div>
                                <div class="text-xs text-green-600">({{ number_format($member->age, 0) }} years old)</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <div class="font-medium">{{ $member->position }}</div>
                            <div class="text-xs text-blue-600 capitalize">{{ $member->dewan_category }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <button wire:click="editMember({{ $member->id }})" class="text-blue-600 hover:text-blue-900">Edit</button>
                            <button wire:click="deleteMember({{ $member->id }})" 
                                    onclick="return confirm('Yakin ingin menghapus member ini?')"
                                    class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data member</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="px-6 py-4">
            {{ $this->members->links() }}
        </div>
    </div>
</div>