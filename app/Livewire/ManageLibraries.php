<?php

namespace App\Livewire;

use App\Models\Library;
use Livewire\Component;
use App\WithNotification;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\LibraryReview;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ManageLibraries extends Component
{
    use WithFileUploads, WithNotification, WithPagination;

    // Base library properties
    public $library_id;
    public $title;
    public $slug;
    public $author;
    public $description;
    public $image;
    public $publisher;
    public $publication_year;
    public $isbn;
    public $category;
    public $page_count;
    public $language;
    public $temp_image;

    // Review
    public $reviewer;
    public $review;

    // UI control
    public $isOpen = false;
    public $activeTab = 'info'; // tabs: info, review
    public $search;

    protected $rules = [
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'required|string',
        'temp_image' => 'nullable|image|max:2048',
        'publisher' => 'nullable|string|max:255',
        'publication_year' => 'nullable|integer',
        'isbn' => 'nullable|string|max:20',
        'category' => 'nullable|string|max:255',
        'page_count' => 'integer|nullable',
        'language' => 'nullable|string|max:255',
        'reviewer' => 'required_if:activeTab,review|string|max:255',
        'review' => 'required_if:activeTab,review|string',
    ];

    public function render()
    {
        $libraries = Library::when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%');
        })
            ->orderBy('created_at', 'desc') // Changed from order to created_at
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
        $this->library_id = null;
        $this->title = '';
        $this->slug = '';
        $this->author = '';
        $this->description = '';
        $this->image = '';
        $this->publisher = '';
        $this->publication_year = '';
        $this->isbn = '';
        $this->category = '';
        $this->page_count = '';
        $this->language = '';
        $this->temp_image = '';
        $this->reviewer = '';
        $this->review = '';
        $this->activeTab = 'info';
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function store()
    {
        $this->validate();

        // Generate slug if not exists
        if (empty($this->slug)) {
            $this->slug = Str::slug($this->title); // Fixed from $this->name to $this->title
        }

        // Prepare library data
        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'author' => $this->author,
            'description' => $this->description,
            'publisher' => $this->publisher,
            'publication_year' => $this->publication_year,
            'isbn' => $this->isbn,
            'category' => $this->category,
            'page_count' => $this->page_count,
            'language' => $this->language,
        ];

        // Handle image upload
        if ($this->temp_image) {
            // Delete old image if exists
            if ($this->library_id) {
                $library = Library::find($this->library_id);
                if ($library && $library->image) {
                    Storage::disk('public')->delete('libraries/' . $library->image);
                }
            }
            // Store new image
            $imageName = time() . '_' . $this->temp_image->getClientOriginalName();
            $this->temp_image->storeAs('libraries', $imageName, 'public');
            $data['image'] = $imageName;
        }

        // Create or update library
        $library = Library::updateOrCreate(['id' => $this->library_id], $data);

        // Handle review content
        if ($this->activeTab === 'review' && !empty($this->reviewer) && !empty($this->review)) {
            $this->storeReview($library);
        }

        $this->notifySuccess(
            $this->library_id
                ? 'Library successfully updated.'
                : 'Library successfully created.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    private function storeReview($library)
    {
        // Implement review creation or update
        if ($library) {
            // Find existing review or create new one
            LibraryReview::updateOrCreate(
                ['library_id' => $library->id],
                [
                    'reviewer' => $this->reviewer,
                    'review' => $this->review
                ]
            );
        }
    }

    public function edit($id)
    {
        $library = Library::with(['reviews'])->findOrFail($id);

        // Basic info
        $this->library_id = $id;
        $this->title = $library->title;
        $this->slug = $library->slug;
        $this->author = $library->author;
        $this->description = $library->description;
        $this->image = $library->image;
        $this->publisher = $library->publisher;
        $this->publication_year = $library->publication_year;
        $this->isbn = $library->isbn;
        $this->category = $library->category;
        $this->page_count = $library->page_count;
        $this->language = $library->language;

        // Review
        $review = $library->reviews->first();
        if ($review) {
            $this->reviewer = $review->reviewer;
            $this->review = $review->review;
        } else {
            $this->reviewer = '';
            $this->review = '';
        }

        $this->openModal();
    }

    public function delete($id)
    {
        $library = Library::find($id);

        if ($library) {
            // Delete image from storage if exists
            if ($library->image) {
                Storage::disk('public')->delete('libraries/' . $library->image);
            }

            $library->delete();
            $this->notifySuccess('Library successfully deleted.');
        }
    }

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }
}
