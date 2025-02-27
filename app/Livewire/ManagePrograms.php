<?php

namespace App\Livewire;

use App\Models\Program;
use App\Models\Category;
use App\WithNotification;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Livewire\Component;

class ManagePrograms extends Component
{
    use WithFileUploads, WithNotification, WithPagination;

    public $title;
    public $description;
    public $image;
    public $program_id;
    public $isOpen = false;
    public $temp_image;
    public $search;

    protected $listeners = [
        'descriptionChanged' => 'updateDescription'
    ];

    public function updateDescription($value)
    {
        $this->description = $value;
    }

    public function render()
    {
        $programs = Program::when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.manage-programs', [
            'programs' => $programs,
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
        $this->description = '';
        $this->image = '';
        $this->program_id = '';
        $this->temp_image = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'temp_image' => $this->program_id ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'title' => $this->title,
            'description' => $this->description,
        ];

        // Handle image upload
        if ($this->temp_image) {
            // Delete old image if exists
            if ($this->program_id) {
                $program = Program::find($this->program_id);
                if ($program->image) {
                    Storage::disk('public')->delete('programs/' . $program->image);
                }
            }

            // Store new image
            $imageName = time() . '_' . $this->temp_image->getClientOriginalName();
            $this->temp_image->storeAs('programs', $imageName, 'public');
            $data['image'] = $imageName;
        }

        Program::updateOrCreate(['id' => $this->program_id], $data);

        $this->notifySuccess(
            $this->program_id
                ? 'Program successfully updated.'
                : 'Program successfully created.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $program = Program::findOrFail($id);
        $this->program_id = $id;
        $this->title = $program->title;
        $this->description = $program->description;
        $this->image = $program->image;

        $this->openModal();
    }

    public function delete($id)
    {
        $program = Program::find($id);

        // Delete image from storage if exists
        if ($program->image) {
            Storage::disk('public')->delete('programs/' . $program->image);
        }

        $program->delete();
        $this->notifySuccess('Program successfully deleted.');
    }
}
