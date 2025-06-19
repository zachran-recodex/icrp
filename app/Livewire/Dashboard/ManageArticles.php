<?php

namespace App\Livewire\Dashboard;

use App\Models\Article;
use App\Models\ArticleCategory;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageArticles extends Component
{
    use WithFileUploads, WithPagination;

    public $title = '';
    public $content = '';
    public $image;
    public $article_category_id = '';
    public $editingArticleId = null;
    public $showForm = false;

    // Category management
    public $categoryTitle = '';
    public $editingCategoryId = null;
    public $showCategoryForm = false;

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
        return ArticleCategory::orderBy('title')->get();
    }

    // Article CRUD
    public function createArticle()
    {
        $this->resetArticleForm();
        $this->showForm = true;
        $this->dispatch('article-form-shown');
    }

    public function editArticle(Article $article)
    {
        $this->editingArticleId = $article->id;
        $this->title = $article->title;
        $this->content = $article->content;
        $this->article_category_id = $article->article_category_id;
        $this->showForm = true;
        $this->dispatch('article-form-shown');
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
            Article::find($this->editingArticleId)->update($data);
            session()->flash('message', 'Article berhasil diupdate!');
        } else {
            Article::create($data);
            session()->flash('message', 'Article berhasil dibuat!');
        }

        $this->dispatch('article-form-hidden');
        $this->resetArticleForm();
        $this->dispatch('article-updated');
    }

    public function deleteArticle(Article $article)
    {
        $article->delete();
        session()->flash('message', 'Article berhasil dihapus!');
        $this->dispatch('article-updated');
    }

    public function cancelArticleEdit()
    {
        $this->dispatch('article-form-hidden');
        $this->resetArticleForm();
    }

    // Category CRUD
    public function createCategory()
    {
        $this->resetCategoryForm();
        $this->showCategoryForm = true;
    }

    public function editCategory(ArticleCategory $category)
    {
        $this->editingCategoryId = $category->id;
        $this->categoryTitle = $category->title;
        $this->showCategoryForm = true;
    }

    public function saveCategory()
    {
        $this->validate([
            'categoryTitle' => 'required|string|max:255|unique:article_categories,title,' . $this->editingCategoryId,
        ]);

        if ($this->editingCategoryId) {
            ArticleCategory::find($this->editingCategoryId)->update(['title' => $this->categoryTitle]);
            session()->flash('message', 'Category berhasil diupdate!');
        } else {
            ArticleCategory::create(['title' => $this->categoryTitle]);
            session()->flash('message', 'Category berhasil dibuat!');
        }

        $this->resetCategoryForm();
        $this->dispatch('category-updated');
    }

    public function deleteCategory(ArticleCategory $category)
    {
        if ($category->articles()->count() > 0) {
            session()->flash('error', 'Category tidak dapat dihapus karena masih memiliki artikel!');
            return;
        }

        $category->delete();
        session()->flash('message', 'Category berhasil dihapus!');
        $this->dispatch('category-updated');
    }

    public function cancelCategoryEdit()
    {
        $this->resetCategoryForm();
    }


    private function resetArticleForm()
    {
        $this->title = '';
        $this->content = '';
        $this->image = null;
        $this->article_category_id = '';
        $this->editingArticleId = null;
        $this->showForm = false;
    }

    private function resetCategoryForm()
    {
        $this->categoryTitle = '';
        $this->editingCategoryId = null;
        $this->showCategoryForm = false;
    }

    public function render()
    {
        return view('livewire.dashboard.manage-articles');
    }
}
