<?php

namespace App\Livewire\Dashboard;

use App\Models\Library;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageLibraries extends Component
{
    use WithFileUploads, WithPagination;

    public $title = '';
    public $author = '';
    public $description = '';
    public $image;
    public $editingLibraryId = null;
    public $deletingLibraryId = null;

    // Modal controls using wire:model
    public $showLibraryModal = false;
    public $showDeleteLibraryModal = false;

    // Filters
    public $search = '';

    #[Computed]
    public function libraries()
    {
        return Library::when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('author', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);
    }

    public function createLibrary()
    {
        $this->resetLibraryForm();
        $this->showLibraryModal = true;
        $this->dispatch('library-form-shown');
    }

    public function editLibrary($libraryId)
    {
        $library = Library::find($libraryId);
        $this->editingLibraryId = $library->id;
        $this->title = $library->title;
        $this->author = $library->author;
        $this->description = $library->description;
        $this->showLibraryModal = true;
        $this->dispatch('library-form-shown');
    }

    public function saveLibrary()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => $this->editingLibraryId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'title' => $this->title,
            'author' => $this->author,
            'description' => $this->description,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('images', 'public');
        }

        if ($this->editingLibraryId) {
            $library = Library::find($this->editingLibraryId);
            // Delete old image if new one is uploaded
            if ($this->image && $library->image) {
                Storage::disk('public')->delete($library->image);
            }
            $library->update($data);
            session()->flash('message', 'Library updated successfully!');
        } else {
            Library::create($data);
            session()->flash('message', 'Library created successfully!');
        }

        $this->showLibraryModal = false;
        $this->resetLibraryForm();
        $this->dispatch('library-updated');
    }

    public function deleteLibrary($libraryId)
    {
        $this->deletingLibraryId = $libraryId;
        $this->showDeleteLibraryModal = true;
    }

    public function confirmDeleteLibrary()
    {
        if ($this->deletingLibraryId) {
            $library = Library::find($this->deletingLibraryId);
            // Delete associated image file
            if ($library->image) {
                Storage::disk('public')->delete($library->image);
            }
            $library->delete();
            session()->flash('message', 'Library deleted successfully!');
            $this->deletingLibraryId = null;
            $this->showDeleteLibraryModal = false;
            $this->dispatch('library-updated');
        }
    }

    public function cancelLibraryEdit()
    {
        $this->showLibraryModal = false;
        $this->resetLibraryForm();
    }

    private function resetLibraryForm()
    {
        $this->title = '';
        $this->author = '';
        $this->description = '';
        $this->image = null;
        $this->editingLibraryId = null;
        $this->showLibraryModal = false;
    }

    public function render()
    {
        return view('livewire.dashboard.manage-libraries');
    }
}