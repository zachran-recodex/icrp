<?php

namespace App\Livewire;

use App\Models\Founder;
use Livewire\Component;
use App\WithNotification;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ManageFounders extends Component
{
    use WithFileUploads, WithNotification, WithPagination;

    public $image;
    public $name;
    public $position;
    public $description;
    public $founder_id;
    public $isOpen = false;
    public $temp_image;
    public $search;

    public function render()
    {
        $founders = Founder::when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('livewire.manage-founders', [
            'founders' => $founders
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
        $this->image = '';
        $this->name = '';
        $this->position = '';
        $this->description = '';
        $this->founder_id = '';
        $this->temp_image = '';
    }

    public function store()
    {
        $this->validate([
            'temp_image' => $this->founder_id ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'name' => 'required',
            'position' => 'required',
            'description' => 'required',
        ]);

        $data = [
            'name' => $this->name,
            'position' => $this->position,
            'description' => $this->description,
        ];

        // Handle image upload
        if ($this->temp_image) {
            // Delete old image if exists
            if ($this->founder_id) {
                $founder = Founder::find($this->founder_id);
                if ($founder->image) {
                    Storage::disk('public')->delete('founders/' . $founder->image);
                }
            }

            // Store new image
            $imageName = time() . '_' . $this->temp_image->getClientOriginalName();
            $this->temp_image->storeAs('founders', $imageName, 'public');
            $data['image'] = $imageName;
        }

        Founder::updateOrCreate(['id' => $this->founder_id], $data);

        $this->notifySuccess(
            $this->founder_id
                ? 'Founder successfully updated.'
                : 'Founder successfully created.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $founder = Founder::findOrFail($id);
        $this->founder_id = $id;
        $this->image = $founder->image;
        $this->name = $founder->name;
        $this->position = $founder->position;
        $this->description = $founder->description;

        $this->openModal();
    }

    public function delete($id)
    {
        $founder = Founder::find($id);

        // Delete image from storage if exists
        if ($founder->image) {
            Storage::disk('public')->delete('founders/' . $founder->image);
        }

        $founder->delete();
        $this->notifySuccess('Founder successfully deleted.');
    }
}
