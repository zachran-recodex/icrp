<?php

namespace App\Livewire\Dashboard;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Joelwmale\LivewireQuill\Traits\HasQuillEditor;

class ManageArticles extends Component
{
    use WithFileUploads, WithPagination, HasQuillEditor;

    public $title = '';
    public $content = '';
    public $image;
    public $article_category_id = '';
    public $editingArticleId = null;
    public $deletingArticleId = null;

    // Category management
    public $categoryTitle = '';
    public $editingCategoryId = null;
    public $deletingCategoryId = null;

    // Modal controls using wire:model
    public $showArticleModal = false;
    public $showCategoryModal = false;
    public $showDeleteArticleModal = false;
    public $showDeleteCategoryModal = false;

    // Filters
    public $selectedCategory = '';
    public $search = '';

    #[Computed]
    public function articles()
    {
        return Article::with('articleCategory')
            ->when($this->selectedCategory, function ($query) {
                $query->where('article_category_id', $this->selectedCategory);
            })
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);
    }

    #[Computed]
    public function categories()
    {
        return ArticleCategory::withCount('articles')->orderBy('title')->get();
    }

    // Article CRUD
    public function createArticle()
    {
        $this->resetArticleForm();
        $this->showArticleModal = true;
        $this->dispatch('article-form-shown');
        // Reset Quill editor content
        $this->dispatch('quill-clear-content', editorId: 'article-editor');
    }

    public function editArticle($articleId)
    {
        $article = Article::find($articleId);
        $this->editingArticleId = $article->id;
        $this->title = $article->title;
        $this->content = $article->content;
        $this->article_category_id = $article->article_category_id;
        $this->showArticleModal = true;
        $this->dispatch('article-form-shown');
        // Update Quill editor with existing content
        $this->dispatch('quill-set-content', editorId: 'article-editor', content: $this->content);
    }

    public function saveArticle()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'article_category_id' => 'required|exists:article_categories,id',
            'image' => $this->editingArticleId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'title' => $this->title,
            'content' => $this->content,
            'article_category_id' => $this->article_category_id,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('images', 'public');
        }

        if ($this->editingArticleId) {
            $article = Article::find($this->editingArticleId);
            // Delete old image if new one is uploaded
            if ($this->image && $article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $article->update($data);
            session()->flash('message', 'Article updated successfully!');
        } else {
            Article::create($data);
            session()->flash('message', 'Article created successfully!');
        }

        $this->showArticleModal = false;
        $this->resetArticleForm();
        // Reset Quill editor content only after saving
        $this->dispatch('quill-clear-content', editorId: 'article-editor');
        $this->dispatch('article-updated');
    }

    public function deleteArticle($articleId)
    {
        $this->deletingArticleId = $articleId;
        $this->showDeleteArticleModal = true;
    }

    public function confirmDeleteArticle()
    {
        if ($this->deletingArticleId) {
            $article = Article::find($this->deletingArticleId);
            // Delete associated image file
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $article->delete();
            session()->flash('message', 'Article deleted successfully!');
            $this->deletingArticleId = null;
            $this->showDeleteArticleModal = false;
            $this->dispatch('article-updated');
        }
    }

    public function cancelArticleEdit()
    {
        $this->showArticleModal = false;
        $this->resetArticleForm();
        // Reset Quill editor content
        $this->dispatch('quill-clear-content', editorId: 'article-editor');
    }

    // Category CRUD
    public function createCategory()
    {
        $this->resetCategoryForm();
        $this->showCategoryModal = true;
    }

    public function editCategory($categoryId)
    {
        // Clear any previous validation errors
        $this->resetValidation();
        
        $category = ArticleCategory::find($categoryId);
        $this->editingCategoryId = $category->id;
        $this->categoryTitle = $category->title;
        
        // Ensure modal stays open
        $this->showCategoryModal = true;
    }

    public function saveCategory()
    {
        $this->validate([
            'categoryTitle' => 'required|string|max:255|unique:article_categories,title,' . $this->editingCategoryId,
        ]);

        if ($this->editingCategoryId) {
            ArticleCategory::find($this->editingCategoryId)->update(['title' => $this->categoryTitle]);
            session()->flash('message', 'Category updated successfully!');
        } else {
            ArticleCategory::create(['title' => $this->categoryTitle]);
            session()->flash('message', 'Category created successfully!');
        }

        $this->showCategoryModal = false;
        $this->resetCategoryForm();
        $this->dispatch('category-updated');
    }

    public function deleteCategory($categoryId)
    {
        $this->deletingCategoryId = $categoryId;
        $this->showDeleteCategoryModal = true;
    }

    public function confirmDeleteCategory()
    {
        if ($this->deletingCategoryId) {
            $category = ArticleCategory::find($this->deletingCategoryId);
            if ($category->articles()->count() > 0) {
                session()->flash('error', 'Category cannot be deleted because it still has articles!');
                $this->deletingCategoryId = null;
                $this->showDeleteCategoryModal = false;
                return;
            }

            $category->delete();
            session()->flash('message', 'Category deleted successfully!');
            $this->deletingCategoryId = null;
            $this->showDeleteCategoryModal = false;
            $this->dispatch('category-updated');
        }
    }

    public function cancelCategoryEdit()
    {
        $this->showCategoryModal = false;
        $this->resetCategoryForm();
    }


    private function resetArticleForm()
    {
        $this->title = '';
        $this->content = '';
        $this->image = null;
        $this->article_category_id = '';
        $this->editingArticleId = null;
        $this->showArticleModal = false;
    }

    private function resetCategoryForm()
    {
        $this->categoryTitle = '';
        $this->editingCategoryId = null;
        $this->showCategoryModal = false;
    }

    public function contentChanged($editorId, $content): void
    {
        $this->content = $content;
    }

    public function render()
    {
        return view('livewire.dashboard.manage-articles');
    }
}
