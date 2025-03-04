<?php

namespace App\Livewire;

use App\Models\Advocacy;
use App\WithNotification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageAdvocacies extends Component
{
    use WithFileUploads, WithNotification, WithPagination;

    public $title;
    public $content;
    public $image;
    public $advocacy_id;
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
        $advocacies = Advocacy::when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.manage-advocacies', [
            'advocacies' => $advocacies,
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
        $this->image = '';
        $this->advocacy_id = '';
        $this->temp_image = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
            'temp_image' => $this->advocacy_id ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
        ];

        // Handle image upload
        if ($this->temp_image) {
            // Delete old image if exists
            if ($this->advocacy_id) {
                $advocacy = Advocacy::find($this->advocacy_id);
                if ($advocacy->image) {
                    Storage::disk('public')->delete('advocacies/' . $advocacy->image);
                }
            }

            // Store new image
            $imageName = time() . '_' . $this->temp_image->getClientOriginalName();
            $this->temp_image->storeAs('advocacies', $imageName, 'public');
            $data['image'] = $imageName;
        }

        Advocacy::updateOrCreate(['id' => $this->advocacy_id], $data);

        $this->notifySuccess(
            $this->advocacy_id
                ? 'Advocacy successfully updated.'
                : 'Advocacy successfully created.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $advocacy = Advocacy::findOrFail($id);
        $this->advocacy_id = $id;
        $this->title = $advocacy->title;
        $this->content = $advocacy->content;
        $this->image = $advocacy->image;

        $this->openModal();
    }

    public function delete($id)
    {
        $advocacy = Advocacy::find($id);

        // Delete image from storage if exists
        if ($advocacy->image) {
            Storage::disk('public')->delete('advocacies/' . $advocacy->image);
        }

        $advocacy->delete();
        $this->notifySuccess('Advocacy successfully deleted.');
    }
}
