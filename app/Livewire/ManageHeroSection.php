<?php

namespace App\Livewire;

use Livewire\Component;
use App\WithNotification;
use App\Models\HeroSection;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ManageHeroSection extends Component
{
    use WithFileUploads, WithNotification;

    public $hero_id;
    public $title;
    public $subtitle;
    public $image;
    public $temp_image;

    public function mount()
    {
        $this->loadHeroSection();
    }

    public function loadHeroSection()
    {
        // Selalu ambil ID=1 atau record pertama, karena hanya ada satu
        $heroSection = HeroSection::first();

        if ($heroSection) {
            $this->hero_id = $heroSection->id;
            $this->title = $heroSection->title;
            $this->subtitle = $heroSection->subtitle;
            $this->image = $heroSection->image;
        } else {
            // Default values if no hero section exists
            $this->title = 'House of Peace';
            $this->subtitle = 'Dialog Antar Agama, Kemanusiaan dan Persaudaraan Lintas Iman, Rumah Perdamaian, Agama untuk Perdamaian, Demokrasi';
            $this->image = '';
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|min:3',
            'subtitle' => 'required',
            'temp_image' => $this->hero_id ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
        ];

        // Handle image upload
        if ($this->temp_image) {
            // Delete old image if exists
            if ($this->hero_id && $this->image) {
                Storage::disk('public')->delete('hero/' . $this->image);
            }

            // Store new image
            $imageName = time() . '_' . $this->temp_image->getClientOriginalName();
            $this->temp_image->storeAs('hero', $imageName, 'public');
            $data['image'] = $imageName;
            $this->image = $imageName;
        }

        if ($this->hero_id) {
            // Update existing hero section
            HeroSection::find($this->hero_id)->update($data);
            $this->notifySuccess('Hero section successfully deleted.');
        } else {
            // Create new hero section
            $hero = HeroSection::create($data);
            $this->hero_id = $hero->id;
            $this->notifySuccess('Hero section successfully deleted.');
        }

        $this->temp_image = null;
    }

    public function render()
    {
        return view('livewire.manage-hero-section');
    }
}
