<?php

namespace App\Livewire\Dashboard;

use App\Models\CallToAction;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageCallToAction extends Component
{
    use WithFileUploads;

    public $title = '';
    public $subtitle = '';
    public $button_text = '';
    public $image;

    #[Computed]
    public function callToAction()
    {
        return CallToAction::first();
    }

    public function mount()
    {
        $callToAction = $this->callToAction;
        if ($callToAction) {
            $this->title = $callToAction->title;
            $this->subtitle = $callToAction->subtitle;
            $this->button_text = $callToAction->button_text;
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'button_text' => $this->button_text,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('images', 'public');
        }

        $callToAction = CallToAction::first();
        if ($callToAction) {
            $callToAction->update($data);
            session()->flash('message', 'Call to Action berhasil diupdate!');
        } else {
            CallToAction::create($data);
            session()->flash('message', 'Call to Action berhasil dibuat!');
        }

        $this->image = null;
        $this->dispatch('call-to-action-updated');
    }

    public function render()
    {
        return view('livewire.dashboard.manage-call-to-action');
    }
}