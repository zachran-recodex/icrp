<?php

namespace App\Livewire\Dashboard;

use App\Models\Program;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManagePrograms extends Component
{
    use WithFileUploads, WithPagination;

    public $title = '';
    public $description = '';
    public $image;
    public $editingProgramId = null;
    public $deletingProgramId = null;

    // Modal controls using wire:model
    public $showProgramModal = false;
    public $showDeleteProgramModal = false;

    // Filters
    public $search = '';

    #[Computed]
    public function programs()
    {
        return Program::when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);
    }

    public function createProgram()
    {
        $this->resetProgramForm();
        $this->showProgramModal = true;
        $this->dispatch('program-form-shown');
    }

    public function editProgram($programId)
    {
        $program = Program::find($programId);
        $this->editingProgramId = $program->id;
        $this->title = $program->title;
        $this->description = $program->description;
        $this->showProgramModal = true;
        $this->dispatch('program-form-shown');
    }

    public function saveProgram()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => $this->editingProgramId ? 'nullable|image|max:2048' : 'nullable|image|max:2048',
        ]);

        $data = [
            'title' => $this->title,
            'description' => $this->description,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('images', 'public');
        }

        if ($this->editingProgramId) {
            $program = Program::find($this->editingProgramId);
            // Delete old image if new one is uploaded
            if ($this->image && $program->image) {
                Storage::disk('public')->delete($program->image);
            }
            $program->update($data);
            session()->flash('message', 'Program updated successfully!');
        } else {
            Program::create($data);
            session()->flash('message', 'Program created successfully!');
        }

        $this->showProgramModal = false;
        $this->resetProgramForm();
        $this->dispatch('program-updated');
    }

    public function deleteProgram($programId)
    {
        $this->deletingProgramId = $programId;
        $this->showDeleteProgramModal = true;
    }

    public function confirmDeleteProgram()
    {
        if ($this->deletingProgramId) {
            $program = Program::find($this->deletingProgramId);
            // Delete associated image file
            if ($program->image) {
                Storage::disk('public')->delete($program->image);
            }
            $program->delete();
            session()->flash('message', 'Program deleted successfully!');
            $this->deletingProgramId = null;
            $this->showDeleteProgramModal = false;
            $this->dispatch('program-updated');
        }
    }

    public function cancelProgramEdit()
    {
        $this->showProgramModal = false;
        $this->resetProgramForm();
    }

    private function resetProgramForm()
    {
        $this->title = '';
        $this->description = '';
        $this->image = null;
        $this->editingProgramId = null;
        $this->showProgramModal = false;
    }

    public function render()
    {
        return view('livewire.dashboard.manage-programs');
    }
}