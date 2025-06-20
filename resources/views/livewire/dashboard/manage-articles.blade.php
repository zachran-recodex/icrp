<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Manage Articles</h2>
        <flux:button variant="primary" wire:click="createArticle">
            Create Article
        </flux:button>
    </div>

    @if (session()->has('message'))
        <flux:callout class="mb-4" variant="success" icon="check-circle" heading="{{ session('message') }}" />
    @endif

    @if (session()->has('error'))
        <flux:callout class="mb-4" variant="danger" icon="x-circle" heading="{{ session('error') }}" />
    @endif

    <!-- Category Form Modal -->
    <flux:modal wire:model.self="showCategoryModal" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $editingCategoryId ? 'Edit Category' : 'Create New Category' }}</flux:heading>
            </div>

            <form wire:submit="saveCategory">
                <flux:field class="mb-4">
                    <flux:label>Category Title</flux:label>

                    <flux:input wire:model="categoryTitle" type="text" />

                    <flux:error name="categoryTitle" />
                </flux:field>

                <div class="flex space-x-2">
                    <flux:spacer />

                    <flux:button wire:click="cancelCategoryEdit" variant="ghost">Cancel</flux:button>

                    <flux:button type="submit" variant="primary">{{ $editingCategoryId ? 'Update' : 'Save' }}</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Article Form Modal -->
    <flux:modal wire:model.self="showArticleModal" class="md:w-4xl max-w-6xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $editingArticleId ? 'Edit Article' : 'Create New Article' }}</flux:heading>
            </div>

            <form wire:submit="saveArticle" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <flux:field>
                        <flux:label>Title</flux:label>

                        <flux:input wire:model="title" type="text" />

                        <flux:error name="title" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Category</flux:label>

                        <flux:select wire:model="article_category_id">
                            <flux:select.option value="">Select Category</flux:select.option>
                            @foreach($this->categories as $category)
                                <flux:select.option value="{{ $category->id }}">{{ $category->title }}</flux:select.option>
                            @endforeach
                        </flux:select>

                        <flux:error name="article_category_id" />
                    </flux:field>
                </div>

                <flux:field class="mb-16">
                    <flux:label>Content</flux:label>

                    @livewire('livewire-quill', [
                        'quillId' => 'article-editor',
                        'data' => $content,
                        'placeholder' => 'Type article content...',
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
                        <flux:button variant="ghost" wire:click="cancelArticleEdit">Cancel</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="primary">{{ $editingArticleId ? 'Update' : 'Save' }}</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Delete Article Confirmation Modal -->
    <flux:modal wire:model.self="showDeleteArticleModal" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete article?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to delete this article.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:button wire:click="$set('showDeleteArticleModal', false)" variant="ghost">Cancel</flux:button>

                <flux:button wire:click="confirmDeleteArticle" variant="danger">Delete article</flux:button>
            </div>
        </div>
    </flux:modal>

    <!-- Delete Category Confirmation Modal -->
    <flux:modal wire:model.self="showDeleteCategoryModal" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete category?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to delete this category.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:button wire:click="$set('showDeleteCategoryModal', false)" variant="ghost">Cancel</flux:button>

                <flux:button wire:click="confirmDeleteCategory" variant="danger">Delete category</flux:button>
            </div>
        </div>
    </flux:modal>

    <!-- Filters -->
    <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg p-4 mb-6">
        <div class="flex space-x-4">
            <div class="flex-1">
                <flux:input icon="magnifying-glass" type="text" wire:model.live="search" placeholder="Search articles..." />
            </div>
            <div>
                <flux:select wire:model.live="selectedCategory">
                    <flux:select.option value="">All Categories</flux:select.option>
                    @foreach ($this->categories as $category)
                        <flux:select.option value="{{ $category->id }}">{{ $category->title }}</flux:select.option>
                    @endforeach
                </flux:select>
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

                            <!-- Edit -->
                            <flux:button icon="pencil" wire:click="editArticle({{ $article->id }})" size="sm" variant="primary" color="blue" />

                            <!-- Delete -->
                            <flux:button icon="trash" wire:click="deleteArticle({{ $article->id }})" size="sm" variant="primary" color="red" />

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No articles found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $this->articles->links() }}
        </div>
    </div>

    <!-- Categories Section -->
    <div class="mt-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Manage Categories</h2>
            <flux:button variant="primary" wire:click="createCategory">
                Create Category
            </flux:button>
        </div>

        <!-- Categories Table -->
        <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Articles Count</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($this->categories as $category)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $category->title }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $category->articles_count }} articles
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <!-- Edit -->
                                <flux:button icon="pencil" wire:click="editCategory({{ $category->id }})" size="sm" variant="primary" color="blue" />

                                <!-- Delete -->
                                <flux:button icon="trash" wire:click="deleteCategory({{ $category->id }})" size="sm" variant="primary" color="red" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">No categories found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
    // Listen for Livewire events to reinitialize Quill editor
    document.addEventListener('livewire:init', function() {
        Livewire.on('article-form-shown', function(event) {
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
