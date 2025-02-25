<?php

namespace App\Livewire;

use App\Models\Library;
use Livewire\Component;
use App\WithNotification;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ManageLibraries extends Component
{
    use WithFileUploads, WithNotification, WithPagination;

    public $title;
    public $author;
    public $description;
    public $image;
    public $reviewer;
    public $review;
    public $library_id;
    public $isOpen = false;
    public $temp_image;
    public $search;

    public function render()
    {
        $libraries = Library::when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%');
        })
            ->latest()
            ->paginate(10);

        return view('livewire.manage-libraries', [
            'libraries' => $libraries,
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
        $this->author = '';
        $this->description = '';
        $this->image = '';
        $this->reviewer = '';
        $this->review = '';
        $this->library_id = '';
        $this->temp_image = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'reviewer' => 'required',
            'review' => 'required',
            'temp_image' => $this->library_id ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'author' => $this->author,
            'description' => $this->description,
            'reviewer' => $this->reviewer,
            'review' => $this->review,
        ];

        // Handle image upload
        if ($this->temp_image) {
            // Delete old image if exists
            if ($this->library_id) {
                $library = Library::find($this->library_id);
                if ($library->image) {
                    Storage::disk('public')->delete('libraries/' . $library->image);
                }
            }
            // Store new image
            $imageName = time() . '_' . $this->temp_image->getClientOriginalName();
            $this->temp_image->storeAs('libraries', $imageName, 'public');
            $data['image'] = $imageName;
        }

        Library::updateOrCreate(['id' => $this->library_id], $data);
        $this->notifySuccess(
            $this->library_id
                ? 'Library successfully updated.'
                : 'Library successfully created.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $library = Library::findOrFail($id);
        $this->library_id = $id;
        $this->title = $library->title;
        $this->author = $library->author;
        $this->description = $library->description;
        $this->image = $library->image;
        $this->reviewer = $library->reviewer;
        $this->review = $library->review;

        $this->openModal();
    }

    public function delete($id)
    {
        $library = Library::find($id);

        // Delete image from storage if exists
        if ($library->image) {
            Storage::disk('public')->delete('libraries/' . $library->image);
        }

        $library->delete();
        $this->notifySuccess('Library successfully deleted.');
    }
}
