<?php

namespace App\Livewire\Dashboard;

use App\Models\Advocacy;
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
    public $showForm = false;

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
        $this->showForm = true;
        $this->dispatch('advocacy-form-shown');
    }

    public function editAdvocacy(Advocacy $advocacy)
    {
        $this->editingAdvocacyId = $advocacy->id;
        $this->title = $advocacy->title;
        $this->content = $advocacy->content;
        $this->showForm = true;
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
            Advocacy::find($this->editingAdvocacyId)->update($data);
            session()->flash('message', 'Advocacy berhasil diupdate!');
        } else {
            Advocacy::create($data);
            session()->flash('message', 'Advocacy berhasil dibuat!');
        }

        $this->dispatch('advocacy-form-hidden');
        $this->resetAdvocacyForm();
        $this->dispatch('advocacy-updated');
    }

    public function deleteAdvocacy(Advocacy $advocacy)
    {
        $advocacy->delete();
        session()->flash('message', 'Advocacy berhasil dihapus!');
        $this->dispatch('advocacy-updated');
    }

    public function cancelAdvocacyEdit()
    {
        $this->dispatch('advocacy-form-hidden');
        $this->resetAdvocacyForm();
    }

    private function resetAdvocacyForm()
    {
        $this->title = '';
        $this->content = '';
        $this->image = null;
        $this->editingAdvocacyId = null;
        $this->showForm = false;
    }

    public function render()
    {
        return view('livewire.dashboard.manage-advocacies');
    }
}
