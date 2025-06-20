<?php

namespace App\Livewire\Dashboard;

use App\Models\Advocacy;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageAdvocacies extends Component
{
    use WithFileUploads, WithPagination;

    public $title = '';
    public $content = '';
    public $image;
    public $editingAdvocacyId = null;
    public $deletingAdvocacyId = null;

    // Modal controls using wire:model
    public $showAdvocacyModal = false;
    public $showDeleteAdvocacyModal = false;

    // Filters
    public $search = '';

    #[Computed]
    public function advocacies()
    {
        return Advocacy::when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);
    }

    // Advocacy CRUD
    public function createAdvocacy()
    {
        $this->resetAdvocacyForm();
        $this->showAdvocacyModal = true;
        $this->dispatch('advocacy-form-shown');
    }

    public function editAdvocacy($advocacyId)
    {
        $advocacy = Advocacy::find($advocacyId);
        $this->editingAdvocacyId = $advocacy->id;
        $this->title = $advocacy->title;
        $this->content = $advocacy->content;
        $this->showAdvocacyModal = true;
        $this->dispatch('advocacy-form-shown');
    }

    public function saveAdvocacy()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => $this->editingAdvocacyId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'title' => $this->title,
            'content' => $this->content,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('images', 'public');
        }

        if ($this->editingAdvocacyId) {
            $advocacy = Advocacy::find($this->editingAdvocacyId);
            // Delete old image if new one is uploaded
            if ($this->image && $advocacy->image) {
                Storage::disk('public')->delete($advocacy->image);
            }
            $advocacy->update($data);
            session()->flash('message', 'Advocacy updated successfully!');
        } else {
            Advocacy::create($data);
            session()->flash('message', 'Advocacy created successfully!');
        }

        $this->showAdvocacyModal = false;
        $this->resetAdvocacyForm();
        $this->dispatch('advocacy-updated');
    }

    public function deleteAdvocacy($advocacyId)
    {
        $this->deletingAdvocacyId = $advocacyId;
        $this->showDeleteAdvocacyModal = true;
    }

    public function confirmDeleteAdvocacy()
    {
        if ($this->deletingAdvocacyId) {
            $advocacy = Advocacy::find($this->deletingAdvocacyId);
            // Delete associated image file
            if ($advocacy->image) {
                Storage::disk('public')->delete($advocacy->image);
            }
            $advocacy->delete();
            session()->flash('message', 'Advocacy deleted successfully!');
            $this->deletingAdvocacyId = null;
            $this->showDeleteAdvocacyModal = false;
            $this->dispatch('advocacy-updated');
        }
    }

    public function cancelAdvocacyEdit()
    {
        $this->showAdvocacyModal = false;
        $this->resetAdvocacyForm();
    }

    private function resetAdvocacyForm()
    {
        $this->title = '';
        $this->content = '';
        $this->image = null;
        $this->editingAdvocacyId = null;
        $this->showAdvocacyModal = false;
    }

    public function render()
    {
        return view('livewire.dashboard.manage-advocacies');
    }
}
