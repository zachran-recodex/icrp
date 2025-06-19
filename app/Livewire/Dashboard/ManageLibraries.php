<?php

namespace App\Livewire\Dashboard;

use App\Models\Library;
use Livewire\Attributes\Computed;
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
    public $showForm = false;

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
        $this->resetForm();
        $this->showForm = true;
        $this->dispatch('library-form-shown');
    }

    public function editLibrary(Library $library)
    {
        $this->editingLibraryId = $library->id;
        $this->title = $library->title;
        $this->author = $library->author;
        $this->description = $library->description;
        $this->showForm = true;
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
            Library::find($this->editingLibraryId)->update($data);
            session()->flash('message', 'Library berhasil diupdate!');
        } else {
            Library::create($data);
            session()->flash('message', 'Library berhasil dibuat!');
        }

        $this->dispatch('library-form-hidden');
        $this->resetForm();
        $this->dispatch('library-updated');
    }

    public function deleteLibrary(Library $library)
    {
        $library->delete();
        session()->flash('message', 'Library berhasil dihapus!');
        $this->dispatch('library-updated');
    }

    public function cancelEdit()
    {
        $this->dispatch('library-form-hidden');
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->title = '';
        $this->author = '';
        $this->description = '';
        $this->image = null;
        $this->editingLibraryId = null;
        $this->showForm = false;
    }

    public function render()
    {
        return view('livewire.dashboard.manage-libraries');
    }
}