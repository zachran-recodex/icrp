<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use App\Models\Category;
use App\WithNotification;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class ManageArticles extends Component
{
    use WithFileUploads, WithNotification, WithPagination;

    public $title;
    public $content;
    public $category_id;
    public $image;
    public $article_id;
    public $isOpen = false;
    public $temp_image;
    public $search;

    protected $listeners = [
        'contentChanged' => 'updateContent'
    ];

    public function updateContent($value)
    {
        $this->content = $value;
    }

    public function render()
    {
        $articles = Article::with('category')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.manage-articles', [
            'articles' => $articles,
            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->content = '';
        $this->category_id = '';
        $this->image = '';
        $this->article_id = '';
        $this->temp_image = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'temp_image' => $this->article_id ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'category_id' => $this->category_id,
        ];

        // Handle image upload
        if ($this->temp_image) {
            // Delete old image if exists
            if ($this->article_id) {
                $article = Article::find($this->article_id);
                if ($article->image) {
                    Storage::disk('public')->delete('articles/' . $article->image);
                }
            }

            // Store new image
            $imageName = time() . '_' . $this->temp_image->getClientOriginalName();
            $this->temp_image->storeAs('articles', $imageName, 'public');
            $data['image'] = $imageName;
        }

        Article::updateOrCreate(['id' => $this->article_id], $data);

        $this->notifySuccess(
            $this->article_id
                ? 'Article successfully updated.'
                : 'Article successfully created.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $this->article_id = $id;
        $this->title = $article->title;
        $this->content = $article->content;
        $this->category_id = $article->category_id;
        $this->image = $article->image;

        $this->openModal();
    }

    public function delete($id)
    {
        $article = Article::find($id);

        // Delete image from storage if exists
        if ($article->image) {
            Storage::disk('public')->delete('articles/' . $article->image);
        }

        $article->delete();
        $this->notifySuccess('Article successfully deleted.');
    }
}
