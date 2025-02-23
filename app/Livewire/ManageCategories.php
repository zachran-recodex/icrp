<?php

namespace App\Livewire;

use App\WithNotification;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class ManageCategories extends Component
{
    use WithNotification, WithPagination;

    public $title;
    public $category_id;
    public $isOpen = false;
    public $search;

    public function render()
    {
        $categories = Category::when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.manage-categories', [
            'categories' => $categories,
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
        $this->category_id = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
        ]);

        Category::updateOrCreate(['id' => $this->category_id], [
            'title' => $this->title,
        ]);

        $this->notifySuccess(
            $this->category_id
                ? 'Category successfully updated.'
                : 'Category successfully created.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->category_id = $id;
        $this->title = $category->title;

        $this->openModal();
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        $this->notifySuccess('Category successfully deleted.');
    }
}
