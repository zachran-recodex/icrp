<?php

namespace App\Livewire\Dashboard;

use App\Models\Founder;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageFounders extends Component
{
    use WithFileUploads, WithPagination;

    public $name = '';
    public $nickname = '';
    public $birth_date = '';
    public $death_date = '';
    public $birth_place = '';
    public $known_as = '';
    public $quote = '';
    public $biography = '';
    public $photo;
    public $editingFounderId = null;
    public $showForm = false;

    // Filters
    public $search = '';
    public $statusFilter = ''; // all, alive, deceased

    #[Computed]
    public function founders()
    {
        return Founder::when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('known_as', 'like', '%' . $this->search . '%')
                      ->orWhere('birth_place', 'like', '%' . $this->search . '%');
            })
            ->when($this->statusFilter === 'alive', function ($query) {
                $query->whereNull('death_date');
            })
            ->when($this->statusFilter === 'deceased', function ($query) {
                $query->whereNotNull('death_date');
            })
            ->latest()
            ->paginate(10);
    }

    public function createFounder()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->dispatch('founder-form-shown');
    }

    public function editFounder(Founder $founder)
    {
        $this->editingFounderId = $founder->id;
        $this->name = $founder->name;
        $this->nickname = $founder->nickname;
        $this->birth_date = $founder->birth_date->format('Y-m-d');
        $this->death_date = $founder->death_date?->format('Y-m-d');
        $this->birth_place = $founder->birth_place;
        $this->known_as = $founder->known_as;
        $this->quote = $founder->quote;
        $this->biography = $founder->biography;
        $this->showForm = true;
        $this->dispatch('founder-form-shown');
    }

    public function saveFounder()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'birth_date' => 'required|date|before:today',
            'death_date' => 'nullable|date|after:birth_date|before:today',
            'birth_place' => 'required|string|max:255',
            'known_as' => 'required|string|max:255',
            'quote' => 'nullable|string',
            'biography' => 'required|string',
            'photo' => $this->editingFounderId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'name' => $this->name,
            'nickname' => $this->nickname,
            'birth_date' => $this->birth_date,
            'death_date' => $this->death_date ?: null,
            'birth_place' => $this->birth_place,
            'known_as' => $this->known_as,
            'quote' => $this->quote,
            'biography' => $this->biography,
        ];

        if ($this->photo) {
            $data['photo'] = $this->photo->store('images', 'public');
        }

        if ($this->editingFounderId) {
            Founder::find($this->editingFounderId)->update($data);
            session()->flash('message', 'Founder berhasil diupdate!');
        } else {
            Founder::create($data);
            session()->flash('message', 'Founder berhasil dibuat!');
        }

        $this->dispatch('founder-form-hidden');
        $this->resetForm();
        $this->dispatch('founder-updated');
    }

    public function deleteFounder(Founder $founder)
    {
        $founder->delete();
        session()->flash('message', 'Founder berhasil dihapus!');
        $this->dispatch('founder-updated');
    }

    public function cancelEdit()
    {
        $this->dispatch('founder-form-hidden');
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->name = '';
        $this->nickname = '';
        $this->birth_date = '';
        $this->death_date = '';
        $this->birth_place = '';
        $this->known_as = '';
        $this->quote = '';
        $this->biography = '';
        $this->photo = null;
        $this->editingFounderId = null;
        $this->showForm = false;
    }

    public function render()
    {
        return view('livewire.dashboard.manage-founders');
    }
}