<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Manage Articles</h2>
        <div class="flex space-x-2">
            <button wire:click="createCategory" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                Manage Categories
            </button>
            <button wire:click="createArticle" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Article
            </button>
        </div>
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

    <!-- Category Management Modal -->
    @if ($showCategoryForm)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-semibold mb-4">
                        {{ $editingCategoryId ? 'Edit Category' : 'Tambah Category Baru' }}
                    </h3>

                    <form wire:submit="saveCategory">
                        <div class="mb-4">
                            <label for="categoryTitle" class="block text-sm font-medium text-gray-700 mb-2">Category Title</label>
                            <input wire:model="categoryTitle" type="text" id="categoryTitle"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('categoryTitle') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex space-x-2 mb-6">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                {{ $editingCategoryId ? 'Update' : 'Simpan' }}
                            </button>
                            <button type="button" wire:click="cancelCategoryEdit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </button>
                        </div>
                    </form>

                    <div class="border-t pt-4">
                        <h4 class="text-md font-semibold mb-4">Existing Categories</h4>
                        <div class="space-y-2 max-h-60 overflow-y-auto">
                            @foreach ($this->categories as $category)
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                                    <span>{{ $category->title }} ({{ $category->articles_count ?? $category->articles()->count() }} articles)</span>
                                    <div class="space-x-2">
                                        <button wire:click="editCategory({{ $category->id }})" class="text-blue-600 hover:text-blue-900">Edit</button>
                                        <button wire:click="deleteCategory({{ $category->id }})"
                                                onclick="return confirm('Yakin ingin menghapus category ini?')"
                                                class="text-red-600 hover:text-red-900">Delete</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Article Form Modal -->
    @if ($showForm)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-semibold mb-4">
                        {{ $editingArticleId ? 'Edit Article' : 'Tambah Article Baru' }}
                    </h3>

                    <form wire:submit="saveArticle" enctype="multipart/form-data">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                <input wire:model="title" type="text" id="title"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="article_category_id" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                <select wire:model="article_category_id" id="article_category_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Select Category</option>
                                    @foreach ($this->categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('article_category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                            <div wire:ignore>
                                <div id="quill-editor" style="height: 300px;"></div>
                            </div>
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
                            <button type="button" wire:click="cancelArticleEdit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </button>
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                {{ $editingArticleId ? 'Update' : 'Simpan' }}
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
                <input wire:model.live="search" type="text" placeholder="Search articles..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <select wire:model.live="selectedCategory"
                        class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Categories</option>
                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Articles Table -->
    <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($this->articles as $article)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($article->image)
                                <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" class="w-16 h-16 object-cover rounded">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                    <span class="text-gray-500 text-xs">No Image</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ Str::limit($article->title, 30) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $article->articleCategory->title }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ Str::limit(strip_tags($article->content), 50) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <button wire:click="editArticle({{ $article->id }})" class="text-blue-600 hover:text-blue-900">Edit</button>
                            <button wire:click="deleteArticle({{ $article->id }})"
                                    onclick="return confirm('Yakin ingin menghapus article ini?')"
                                    class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data article</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $this->articles->links() }}
        </div>
    </div>

    <!-- Quill.js CSS and JS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
    let quillInstance = null;

    document.addEventListener('livewire:navigated', function () {
        setTimeout(initQuillEditor, 100);
    });

    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(initQuillEditor, 100);
    });

    // Listen for Livewire events to reinitialize editor
    document.addEventListener('livewire:init', function() {
        Livewire.on('article-form-shown', function(event) {
            setTimeout(function() {
                initQuillEditor();
                // Load content if editing
                const content = @this.get('content');
                if (content) {
                    loadContentToEditor(content);
                }
            }, 300);
        });
        
        Livewire.on('article-form-hidden', function() {
            destroyQuillEditor();
        });
    });

    function initQuillEditor() {
        const editorElement = document.getElementById('quill-editor');
        
        if (editorElement && !quillInstance) {
            quillInstance = new Quill('#quill-editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'align': [] }],
                        ['link', 'image'],
                        ['clean']
                    ]
                }
            });

            // Listen for content changes
            quillInstance.on('text-change', function() {
                const content = quillInstance.root.innerHTML;
                @this.set('content', content);
            });
        }
    }

    function destroyQuillEditor() {
        if (quillInstance) {
            quillInstance = null;
        }
    }

    function loadContentToEditor(content) {
        if (quillInstance && content) {
            console.log('Loading content to editor:', content);
            // Use setContents method for better reliability
            quillInstance.clipboard.dangerouslyPasteHTML(content);
            // Trigger change event to sync with Livewire
            @this.set('content', content);
        }
    }

    // Watch for form visibility changes
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                const editorElement = document.getElementById('quill-editor');
                if (editorElement && !quillInstance) {
                    setTimeout(function() {
                        initQuillEditor();
                        // Check if we need to load existing content
                        const content = @this.get('content');
                        if (content && content.trim() !== '') {
                            setTimeout(function() {
                                loadContentToEditor(content);
                            }, 100);
                        }
                    }, 100);
                }
            }
        });
    });

    // Start observing
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
    </script>
</div>
