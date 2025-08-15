<?php

namespace App\Livewire\Dashboard;

use App\Models\Advertisement;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageAdvertisements extends Component
{
    use WithFileUploads;

    public $image;
    public $is_active = true;

    #[Computed]
    public function advertisement()
    {
        return Advertisement::first();
    }

    public function mount()
    {
        $advertisement = $this->advertisement;
        if ($advertisement) {
            $this->is_active = $advertisement->is_active;
        }
    }

    public function save()
    {
        $this->validate([
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = [
            'is_active' => $this->is_active,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('advertisements', 'public');
        }

        $advertisement = Advertisement::first();
        if ($advertisement) {
            $advertisement->update($data);
            session()->flash('message', 'Iklan berhasil diupdate!');
        } else {
            Advertisement::create($data);
            session()->flash('message', 'Iklan berhasil dibuat!');
        }

        $this->image = null;
        $this->dispatch('advertisement-updated');
    }

    public function render()
    {
        return view('livewire.dashboard.manage-advertisements');
    }
}