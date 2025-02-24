<?php

namespace App\Livewire;

use Livewire\Component;
use App\WithNotification;
use App\Models\Management;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ManageManagements extends Component
{
    use WithFileUploads, WithNotification, WithPagination;

    public $image;
    public $name;
    public $position;
    public $description;
    public $dewan;
    public $management_id;
    public $isOpen = false;
    public $temp_image;
    public $search;

    public function render()
    {
        $managements = Management::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->latest()
        ->paginate(10);

        return view('livewire.manage-managements', [
            'managements' => $managements
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
        $this->dewan = '';
        $this->management_id = '';
        $this->temp_image = '';
    }

    public function store()
    {
        $this->validate([
            'temp_image' => $this->management_id ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'name' => 'required',
            'position' => 'required',
            'description' => 'required',
            'dewan' => 'required|in:Pengurus,Kehormatan,Pembina,Pengawas,Pengurus Harian',
        ]);

        $data = [
            'name' => $this->name,
            'position' => $this->position,
            'description' => $this->description,
            'dewan' => $this->dewan,
        ];

        // Handle image upload
        if ($this->temp_image) {
            // Delete old image if exists
            if ($this->management_id) {
                $management = Management::find($this->management_id);
                if ($management->image) {
                    Storage::disk('public')->delete('managements/' . $management->image);
                }
            }

            // Store new image
            $imageName = time() . '_' . $this->temp_image->getClientOriginalName();
            $this->temp_image->storeAs('managements', $imageName, 'public');
            $data['image'] = $imageName;
        }

        Management::updateOrCreate(['id' => $this->management_id], $data);

        $this->notifySuccess(
            $this->management_id
                ? 'Management successfully updated.'
                : 'Management successfully created.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $management = Management::findOrFail($id);
        $this->management_id = $id;
        $this->image = $management->image;
        $this->name = $management->name;
        $this->position = $management->position;
        $this->description = $management->description;
        $this->dewan = $management->dewan;

        $this->openModal();
    }

    public function delete($id)
    {
        $management = Management::find($id);

        // Delete image from storage if exists
        if ($management->image) {
            Storage::disk('public')->delete('managements/' . $management->image);
        }

        $management->delete();
        $this->notifySuccess('Management successfully deleted.');
    }
}
