<div class="bg-white rounded-lg shadow-sm border border-gray-100">
    <!-- Header with Search and Create Button -->
    <div class="p-6 border-b border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <!-- Search Input -->
            <div class="flex-1 min-w-0 max-w-lg">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search"
                        class="block w-full rounded-md border-0 py-2 pl-10 ring-1 ring-inset ring-gray-200 focus:ring-2 focus:ring-primary-500"
                        placeholder="Cari berdasarkan nama...">
                </div>
            </div>

            <!-- Create Button -->
            <button wire:click="create()"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-500 rounded-md hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <i class="fa-solid fa-plus mr-2"></i>
                Buat
            </button>
        </div>
    </div>

    <!-- Events Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
            <thead>
                <tr class="bg-gray-50">
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Pengurus
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Posisi
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($managements as $management)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0 h-20 w-20">
                                    @if ($management->image)
                                        <img class="h-20 w-20 rounded-lg object-cover"
                                            src="{{ Storage::url('managements/' . $management->image) }}"
                                            alt="{{ $management->name }}">
                                    @else
                                        <div class="h-20 w-20 rounded-lg bg-gray-100 flex items-center justify-center">
                                            <i class="fa-solid fa-image text-gray-400 text-2xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $management->name }}
                                    </div>
                                    <div class="text-sm text-gray-500 mt-1">
                                        {!! Str::limit($management->biography, 100) !!}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            {{ $management->position }} |
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary-100 text-primary-800">Dewan
                                {{ $management->dewan }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center gap-3">
                                <button wire:click="edit({{ $management->id }})"
                                    class="bg-blue-100 p-2 rounded-lg text-blue-600 hover:text-blue-900 transition-colors"
                                    title="Edit Event">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button wire:click="delete({{ $management->id }})"
                                    class="bg-red-100 p-2 rounded-lg text-red-600 hover:text-red-900 transition-colors"
                                    title="Delete Event">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fa-solid fa-users-line text-4xl text-gray-300"></i>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">
                                    Tidak ada pengurus yang ditemukan
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    @if ($search)
                                        Tidak ada pengurus yang cocok dengan kriteria pencarian Anda.
                                    @else
                                        Mulailah dengan membuat pengurus baru.
                                    @endif
                                </p>
                                @if (!$search)
                                    <div class="mt-6">
                                        <button wire:click="create"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-500 rounded-md hover:bg-primary-600">
                                            <i class="fa-solid fa-plus mr-2"></i>
                                            Buat
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-6 py-4 border-t border-shark-100">
        {{ $managements->links() }}
    </div>

    @if ($isOpen)
        <div class="fixed z-50 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- Modal container -->
                <div
                    class="inline-block align-middle bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <form wire:submit.prevent="store">
                        <!-- Modal header with tabs -->
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">
                                    {{ $management_id ? 'Edit Pengurus' : 'Tambah Pengurus' }}
                                </h3>
                                <button wire:click="closeModal()" type="button" class="text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Close</span>
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>

                            <!-- Tabs -->
                            <div class="flex border-b">
                                <button
                                    type="button"
                                    wire:click="setTab('basic')"
                                    class="py-2 px-4 {{ $activeTab === 'basic' ? 'border-b-2 border-primary-500 font-medium text-primary-600' : 'text-gray-500 hover:text-gray-700' }}"
                                >
                                    Informasi Dasar
                                </button>
                                <button
                                    type="button"
                                    wire:click="setTab('contributions')"
                                    class="py-2 px-4 {{ $activeTab === 'contributions' ? 'border-b-2 border-primary-500 font-medium text-primary-600' : 'text-gray-500 hover:text-gray-700' }}"
                                >
                                    Kontribusi
                                </button>
                                <button
                                    type="button"
                                    wire:click="setTab('legacy')"
                                    class="py-2 px-4 {{ $activeTab === 'legacy' ? 'border-b-2 border-primary-500 font-medium text-primary-600' : 'text-gray-500 hover:text-gray-700' }}"
                                >
                                    Warisan Pemikiran
                                </button>
                            </div>
                        </div>

                        <!-- Modal content -->
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 max-h-[70vh] overflow-y-auto">
                            <!-- Basic Information Tab -->
                            <div x-show="$wire.activeTab === 'basic'">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Image upload with cropping functionality -->
                                    <div class="mb-4" x-data="imageUpload()" x-cloak>
                                        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Gambar</label>

                                        <!-- Image input and preview -->
                                        <div class="space-y-4">
                                            <input type="file" id="image-input" accept="image/*" @change="fileChosen"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                                            <template x-if="showCropper">
                                                <div class="space-y-4">
                                                    <!-- Cropper container -->
                                                    <div>
                                                        <div id="cropper-container" class="max-w-full max-h-96 overflow-hidden">
                                                            <img id="cropperImage" :src="imageSrc" class="max-w-full" />
                                                        </div>
                                                    </div>

                                                    <!-- Cropper controls -->
                                                    <div class="flex flex-wrap gap-2">
                                                        <button type="button" @click="rotate(-90)"
                                                            class="px-3 py-1 bg-gray-200 rounded-md hover:bg-gray-300">
                                                            <i class="fa-solid fa-rotate-left"></i>
                                                        </button>
                                                        <button type="button" @click="rotate(90)"
                                                            class="px-3 py-1 bg-gray-200 rounded-md hover:bg-gray-300">
                                                            <i class="fa-solid fa-rotate-right"></i>
                                                        </button>
                                                        <button type="button" @click="zoom(0.1)"
                                                            class="px-3 py-1 bg-gray-200 rounded-md hover:bg-gray-300">
                                                            <i class="fa-solid fa-magnifying-glass-plus"></i>
                                                        </button>
                                                        <button type="button" @click="zoom(-0.1)"
                                                            class="px-3 py-1 bg-gray-200 rounded-md hover:bg-gray-300">
                                                            <i class="fa-solid fa-magnifying-glass-minus"></i>
                                                        </button>
                                                        <button type="button" @click="resetCrop()"
                                                            class="px-3 py-1 bg-gray-200 rounded-md hover:bg-gray-300">
                                                            <i class="fa-solid fa-arrows-rotate"></i>
                                                        </button>
                                                        <button type="button" @click="applyCrop()"
                                                            class="px-3 py-1 bg-primary-500 text-white rounded-md hover:bg-primary-600">
                                                            <i class="fa-solid fa-crop mr-1"></i> Potong & Simpan
                                                        </button>
                                                    </div>
                                                </div>
                                            </template>

                                            <!-- Preview after cropping -->
                                            <template x-if="!showCropper && croppedImageUrl">
                                                <div class="space-y-2">
                                                    <img :src="croppedImageUrl" class="max-w-xs rounded-lg" />
                                                    <button type="button" @click="resetImage()"
                                                        class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                                                        <i class="fa-solid fa-xmark mr-1"></i> Ganti Gambar
                                                    </button>
                                                </div>
                                            </template>

                                            <!-- Existing image -->
                                            <template x-if="!showCropper && !croppedImageUrl">
                                                <div>
                                                    @if ($image)
                                                        <div class="space-y-2">
                                                            <img src="{{ Storage::url('managements/' . $image) }}" class="max-w-xs rounded-lg">
                                                        </div>
                                                    @endif
                                                </div>
                                            </template>
                                        </div>

                                        <!-- Hidden input for sending image data to Livewire -->
                                        <input type="hidden" wire:model="croppedImage" id="cropped-image-data" />

                                        @error('croppedImage')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
                                        <input type="text" wire:model="name" id="name"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('name')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="nickname" class="block text-gray-700 text-sm font-bold mb-2">Nama Panggilan</label>
                                        <input type="text" wire:model="nickname" id="nickname"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('nickname')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="known_as" class="block text-gray-700 text-sm font-bold mb-2">Dikenal Sebagai</label>
                                        <input type="text" wire:model="known_as" id="known_as"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('known_as')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="birth_date" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Lahir</label>
                                        <input type="date" wire:model="birth_date" id="birth_date"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('birth_date')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="death_date" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Wafat</label>
                                        <input type="date" wire:model="death_date" id="death_date"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('death_date')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="birth_place" class="block text-gray-700 text-sm font-bold mb-2">Tempat Lahir</label>
                                        <input type="text" wire:model="birth_place" id="birth_place"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('birth_place')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="quote" class="block text-gray-700 text-sm font-bold mb-2">Kutipan</label>
                                        <textarea wire:model="quote" id="quote" rows="3"
                                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                                        @error('quote')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="order" class="block text-gray-700 text-sm font-bold mb-2">Urutan</label>
                                        <input type="number" wire:model="order" id="order"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('order')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="position" class="block text-gray-700 text-sm font-bold mb-2">Posisi</label>
                                        <input type="text" wire:model="position" id="position"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('position')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="dewan" class="block text-gray-700 text-sm font-bold mb-2">Dewan</label>
                                        <select wire:model="dewan" id="dewan"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            <option value="">Pilih Dewan</option>
                                            <option value="Directure Excecutive">Directure Excecutive</option>
                                            <option value="Pengurus">Pengurus</option>
                                            <option value="Kehormatan">Kehormatan</option>
                                            <option value="Pembina">Pembina</option>
                                            <option value="Pengawas">Pengawas</option>
                                            <option value="Pengurus Harian">Pengurus Harian</option>
                                        </select>
                                        @error('dewan')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4 col-span-2">
                                    <label for="biography" class="block text-gray-700 text-sm font-bold mb-2">Biografi</label>
                                    <div x-data="{
                                        biography: @entangle('biography'),
                                        quill: null,
                                        init() {
                                            this.quill = new Quill(this.$refs.quillEditor, {
                                                theme: 'snow',
                                                placeholder: 'Tulis biografi pendiri di sini...',
                                                modules: {
                                                    toolbar: [
                                                        ['bold', 'italic', 'underline', 'strike'],
                                                        ['blockquote'],
                                                        [{ 'header': 1 }, { 'header': 2 }],
                                                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                                                        [{ 'indent': '-1' }, { 'indent': '+1' }],
                                                        [{ 'size': ['small', false, 'large', 'huge'] }],
                                                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                                                        [{ 'color': [] }, { 'background': [] }],
                                                        [{ 'align': [] }],
                                                        ['clean']
                                                    ]
                                                }
                                            });

                                            // Set initial content
                                            if (this.biography) {
                                                this.quill.root.innerHTML = this.biography;
                                            }

                                            // Update Livewire when editor changes
                                            this.quill.on('text-change', () => {
                                                this.biography = this.quill.root.innerHTML;
                                                @this.set('biography', this.quill.root.innerHTML);
                                            });
                                        }
                                    }" wire:ignore>
                                        <div x-ref="quillEditor" style="min-height: 200px;"></div>
                                    </div>
                                    @error('biography')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Contributions Tab -->
                            <div x-show="$wire.activeTab === 'contributions'">
                                <div class="mb-4">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-medium text-gray-900">Kontribusi</h3>
                                        <button type="button" wire:click="addContribution"
                                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-primary-500 rounded-md hover:bg-primary-600">
                                            <i class="fa-solid fa-plus mr-1"></i>
                                            Tambah Kontribusi
                                        </button>
                                    </div>

                                    @foreach ($contributions as $index => $contribution)
                                        <div class="p-4 mb-4 border rounded-lg bg-gray-50">
                                            <div class="flex justify-between items-center mb-2">
                                                <h4 class="font-medium">Kontribusi #{{ $index + 1 }}</h4>
                                                <button type="button" wire:click="removeContribution({{ $index }})"
                                                        class="text-red-500 hover:text-red-700">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                                                <div class="mb-2">
                                                    <label class="block text-gray-700 text-sm font-bold mb-1">Judul</label>
                                                    <input type="text" wire:model="contributions.{{ $index }}.title"
                                                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                    @error("contributions.{$index}.title")
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-2">
                                                    <label class="block text-gray-700 text-sm font-bold mb-1">Deskripsi</label>
                                                    <textarea wire:model="contributions.{{ $index }}.description" rows="2"
                                                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                                                    @error("contributions.{$index}.description")
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Legacy Tab -->
                            <div x-show="$wire.activeTab === 'legacy'">
                                <div class="mb-4">
                                    <label for="legacyContent" class="block text-gray-700 text-sm font-bold mb-2">Warisan Pemikiran</label>
                                    <div x-data="{
                                        legacyContent: @entangle('legacyContent'),
                                        quill: null,
                                        init() {
                                            this.quill = new Quill(this.$refs.legacyEditor, {
                                                theme: 'snow',
                                                placeholder: 'Tulis warisan pemikiran pendiri di sini...',
                                                modules: {
                                                    toolbar: [
                                                        ['bold', 'italic', 'underline', 'strike'],
                                                        ['blockquote'],
                                                        [{ 'header': 1 }, { 'header': 2 }],
                                                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                                                        [{ 'indent': '-1' }, { 'indent': '+1' }],
                                                        [{ 'size': ['small', false, 'large', 'huge'] }],
                                                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                                                        [{ 'color': [] }, { 'background': [] }],
                                                        [{ 'align': [] }],
                                                        ['clean']
                                                    ]
                                                }
                                            });

                                            // Set initial content
                                            if (this.legacyContent) {
                                                this.quill.root.innerHTML = this.legacyContent;
                                            }

                                            // Update Livewire when editor changes
                                            this.quill.on('text-change', () => {
                                                this.legacyContent = this.quill.root.innerHTML;
                                                @this.set('legacyContent', this.quill.root.innerHTML);
                                            });
                                        }
                                    }" wire:ignore>
                                        <div x-ref="legacyEditor" style="min-height: 200px;"></div>
                                    </div>
                                    @error('legacyContent')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button wire:loading.attr="disabled" type="submit"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-500 text-base font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm">
                                <span wire:loading wire:target="store" class="mr-2">
                                    <i class="fa-solid fa-spinner fa-spin"></i>
                                </span>
                                Simpan
                            </button>
                            <button wire:click="closeModal()" type="button"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Alpine.js Image Upload and Cropping Script -->
<script>
    function imageUpload() {
        return {
            cropper: null,
            showCropper: false,
            imageSrc: null,
            croppedImageUrl: null,

            fileChosen(event) {
                const file = event.target.files[0];
                if (!file) return;

                // Create URL for preview
                this.imageSrc = URL.createObjectURL(file);
                this.showCropper = true;

                // Initialize cropper after the image is loaded
                this.$nextTick(() => {
                    // Destroy existing cropper if it exists
                    if (this.cropper) {
                        this.cropper.destroy();
                    }

                    // Initialize Cropper.js
                    const image = document.getElementById('cropperImage');
                    this.cropper = new Cropper(image, {
                        aspectRatio: 1, // Square aspect ratio for profile pictures
                        viewMode: 2,    // Restrict the crop box to not exceed the size of the canvas
                        minCropBoxWidth: 100,
                        minCropBoxHeight: 100,
                        responsive: true,
                        guides: true,
                        background: false,
                        autoCropArea: 0.8, // 80% of the image will be selected by default
                    });
                });
            },

            rotate(degree) {
                if (this.cropper) {
                    this.cropper.rotate(degree);
                }
            },

            zoom(ratio) {
                if (this.cropper) {
                    this.cropper.zoom(ratio);
                }
            },

            resetCrop() {
                if (this.cropper) {
                    this.cropper.reset();
                }
            },

            resetImage() {
                // Reset everything
                this.showCropper = false;
                this.croppedImageUrl = null;
                document.getElementById('image-input').value = '';
                document.getElementById('cropped-image-data').value = '';
                @this.set('croppedImage', null);

                if (this.cropper) {
                    this.cropper.destroy();
                    this.cropper = null;
                }
            },

            applyCrop() {
                if (this.cropper) {
                    // Get cropped canvas
                    const canvas = this.cropper.getCroppedCanvas({
                        width: 400,    // Output image width
                        height: 400,   // Output image height
                        fillColor: '#fff',
                        imageSmoothingEnabled: true,
                        imageSmoothingQuality: 'high',
                    });

                    // Convert canvas to blob
                    canvas.toBlob((blob) => {
                        // Create URL for preview
                        if (this.croppedImageUrl) {
                            URL.revokeObjectURL(this.croppedImageUrl);
                        }
                        this.croppedImageUrl = URL.createObjectURL(blob);

                        // Convert to base64 for sending to server
                        const reader = new FileReader();
                        reader.onloadend = () => {
                            // Set the base64 value to the hidden input for Livewire
                            document.getElementById('cropped-image-data').value = reader.result;
                            @this.set('croppedImage', reader.result);
                        };
                        reader.readAsDataURL(blob);

                        // Hide cropper
                        this.showCropper = false;
                    }, 'image/jpeg', 0.9); // 90% quality JPEG
                }
            }
        };
    }
</script>
