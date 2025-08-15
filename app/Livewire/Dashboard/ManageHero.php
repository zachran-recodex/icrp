<?php

namespace App\Livewire\Dashboard;

use App\Models\Hero;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageHero extends Component
{
    use WithFileUploads;

    public $title = '';

    public $subtitle = '';

    public $image;

    #[Computed]
    public function hero()
    {
        return Hero::first();
    }

    public function mount()
    {
        $hero = $this->hero;
        if ($hero) {
            $this->title = $hero->title;
            $this->subtitle = $hero->subtitle;
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('images', 'public');
        }

        $hero = Hero::first();
        if ($hero) {
            $hero->update($data);
            session()->flash('message', 'Hero berhasil diupdate!');
        } else {
            Hero::create($data);
            session()->flash('message', 'Hero berhasil dibuat!');
        }

        $this->image = null;
        $this->dispatch('hero-updated');
    }

    public function render()
    {
        return view('livewire.dashboard.manage-hero');
    }
}
