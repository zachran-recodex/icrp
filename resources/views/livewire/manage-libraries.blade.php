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
                        placeholder="Cari berdasarkan judul...">
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

    <!-- Libraries Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
            <thead>
                <tr class="bg-gray-50">
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Buku
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Kategori
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($libraries as $library)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0 h-20 w-20">
                                    @if ($library->image)
                                        <img class="h-20 w-20 rounded-lg object-cover"
                                            src="{{ Storage::url('libraries/' . $library->image) }}"
                                            alt="{{ $library->title }}">
                                    @else
                                        <div class="h-20 w-20 rounded-lg bg-gray-100 flex items-center justify-center">
                                            <i class="fa-solid fa-image text-gray-400 text-2xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $library->title }}
                                    </div>
                                    <div class="text-sm text-gray-500 mt-1">
                                        {!! Str::limit($library->description, 100) !!}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center gap-3">
                                <button wire:click="edit({{ $library->id }})"
                                    class="bg-blue-100 p-2 rounded-lg text-blue-600 hover:text-blue-900 transition-colors"
                                    title="Edit Library">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button wire:click="delete({{ $library->id }})"
                                    class="bg-red-100 p-2 rounded-lg text-red-600 hover:text-red-900 transition-colors"
                                    title="Delete Library">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fa-solid fa-book text-4xl text-gray-300"></i>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">
                                    Tidak ada buku yang ditemukan
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    @if ($search)
                                        Tidak ada buku yang cocok dengan kriteria pencarian Anda.
                                    @else
                                        Mulailah dengan membuat buku baru.
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
        {{ $libraries->links() }}
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
                    class="inline-block align-middle bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                    <form wire:submit.prevent="store">
                        <!-- Modal content -->
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">
                                    {{ $library_id ? 'Edit Buku' : 'Tambah Buku' }}
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
                                    wire:click="setTab('info')"
                                    class="py-2 px-4 {{ $activeTab === 'info' ? 'border-b-2 border-primary-500 font-medium text-primary-600' : 'text-gray-500 hover:text-gray-700' }}"
                                >
                                    Informasi Buku
                                </button>
                                <button
                                    type="button"
                                    wire:click="setTab('review')"
                                    class="py-2 px-4 {{ $activeTab === 'review' ? 'border-b-2 border-primary-500 font-medium text-primary-600' : 'text-gray-500 hover:text-gray-700' }}"
                                >
                                    Review
                                </button>
                            </div>
                        </div>

                        <!-- Modal content -->
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 max-h-[70vh] overflow-y-auto">
                            <!-- Basic Information Tab -->
                            <div x-show="$wire.activeTab === 'info'">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
                                            Judul Buku
                                        </label>
                                        <input type="text" wire:model="title"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('title')
                                        <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="author" class="block text-gray-700 text-sm font-bold mb-2">
                                            Pembuat
                                        </label>
                                        <input type="text" wire:model="author"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="mb-4 col-span-2">
                                        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Gambar:</label>
                                        <input type="file" wire:model="temp_image"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @if ($temp_image)
                                            <img src="{{ $temp_image->temporaryUrl() }}" class="mt-2"
                                                 style="max-width: 200px;">
                                        @elseif ($image)
                                            <img src="{{ Storage::url('libraries/' . $image) }}" class="mt-2"
                                                 style="max-width: 200px;">
                                        @endif
                                    </div>
                                    <!-- Form Fields Fix - Replace the input fields in manage-libraries.blade.php with these -->

                                    <div class="mb-4">
                                        <label for="publisher" class="block text-gray-700 text-sm font-bold mb-2">
                                            Publisher
                                        </label>
                                        <input type="text" wire:model="publisher"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('publisher')
                                        <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="publication_year" class="block text-gray-700 text-sm font-bold mb-2">
                                            Publication Year
                                        </label>
                                        <input type="number" wire:model="publication_year"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('publication_year')
                                        <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="isbn" class="block text-gray-700 text-sm font-bold mb-2">
                                            ISBN
                                        </label>
                                        <input type="text" wire:model="isbn"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('isbn')
                                        <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="category" class="block text-gray-700 text-sm font-bold mb-2">
                                            Category
                                        </label>
                                        <input type="text" wire:model="category"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('category')
                                        <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="page_count" class="block text-gray-700 text-sm font-bold mb-2">
                                            Page Count
                                        </label>
                                        <input type="number" wire:model="page_count"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('page_count')
                                        <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="language" class="block text-gray-700 text-sm font-bold mb-2">
                                            Language
                                        </label>
                                        <input type="text" wire:model="language"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('language')
                                        <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                                        Deskripsi
                                    </label>
                                    <div x-data="{
                                    description: @entangle('description'),
                                    quill: null,
                                    init() {
                                        this.quill = new Quill(this.$refs.quillEditor, {
                                            theme: 'snow',
                                            placeholder: 'Write your description here...',
                                            modules: {
                                                toolbar: [
                                                    ['bold', 'italic', 'underline', 'strike'],
                                                    ['blockquote'],
                                                    [{ 'header': 1 }, { 'header': 2 }],
                                                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                                                    [{ 'script': 'sub' }, { 'script': 'super' }],
                                                    [{ 'indent': '-1' }, { 'indent': '+1' }],
                                                    [{ 'size': ['small', false, 'large', 'huge'] }],
                                                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                                                    [{ 'color': [] }, { 'background': [] }],
                                                    [{ 'font': [] }],
                                                    ['link', 'image', 'video'],
                                                    [{ 'align': [] }],
                                                    ['clean']
                                                ]
                                            }
                                        });

                                        // Set initial description
                                        if (this.description) {
                                            this.quill.root.innerHTML = this.description;
                                        }

                                        // Update Livewire description when editor changes
                                        this.quill.on('text-change', () => {
                                            this.description = this.quill.root.innerHTML;
                                            @this.set('description', this.quill.root.innerHTML);
                                        });
                                    }
                                }" wire:ignore>
                                        <div x-ref="quillEditor" style="min-height: 200px;"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contributions Tab -->
                            <div x-show="$wire.activeTab === 'review'">
                                <div class="mb-4">
                                    <label for="reviewer" class="block text-gray-700 text-sm font-bold mb-2">
                                        Pengulas
                                    </label>
                                    <input type="text" wire:model="reviewer"
                                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                                <div class="mb-4">
                                    <label for="review" class="block text-gray-700 text-sm font-bold mb-2">
                                        Ulasan
                                    </label>
                                    <div x-data="{
                                    review: @entangle('review'),
                                    quill: null,
                                    init() {
                                        this.quill = new Quill(this.$refs.quillEditor, {
                                            theme: 'snow',
                                            placeholder: 'Write your review here...',
                                            modules: {
                                                toolbar: [
                                                    ['bold', 'italic', 'underline', 'strike'],
                                                    ['blockquote'],
                                                    [{ 'header': 1 }, { 'header': 2 }],
                                                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                                                    [{ 'script': 'sub' }, { 'script': 'super' }],
                                                    [{ 'indent': '-1' }, { 'indent': '+1' }],
                                                    [{ 'size': ['small', false, 'large', 'huge'] }],
                                                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                                                    [{ 'color': [] }, { 'background': [] }],
                                                    [{ 'font': [] }],
                                                    ['link', 'image', 'video'],
                                                    [{ 'align': [] }],
                                                    ['clean']
                                                ]
                                            }
                                        });

                                        // Set initial review
                                        if (this.review) {
                                            this.quill.root.innerHTML = this.review;
                                        }

                                        // Update Livewire review when editor changes
                                        this.quill.on('text-change', () => {
                                            this.review = this.quill.root.innerHTML;
                                            @this.set('review', this.quill.root.innerHTML);
                                        });
                                    }
                                }" wire:ignore>
                                        <div x-ref="quillEditor" style="min-height: 200px;"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Modal footer -->
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button wire:click.prevent="store()" type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-500 text-base font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm">Save</button>
                            <button wire:click="closeModal()" type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
