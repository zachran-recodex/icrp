<?php

namespace App\Livewire;

use Livewire\Component;
use App\WithNotification;
use App\Models\Management;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
    public $croppedImage;

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
        $this->croppedImage = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'position' => 'required',
            'description' => 'required',
            'dewan' => 'required|in:Directur Excecutive,Pengurus,Kehormatan,Pembina,Pengawas,Pengurus Harian',
        ]);

        // If there's no management_id and no croppedImage, require an image
        if (!$this->management_id && !$this->croppedImage) {
            $this->validate([
                'croppedImage' => 'required',
            ], [
                'croppedImage.required' => 'Gambar pengurus wajib diunggah.'
            ]);
        }

        $data = [
            'name' => $this->name,
            'position' => $this->position,
            'description' => $this->description,
            'dewan' => $this->dewan,
        ];

        // Handle cropped image
        if ($this->croppedImage) {
            // Delete old image if exists during update
            if ($this->management_id) {
                $management = Management::find($this->management_id);
                if ($management && $management->image) {
                    Storage::disk('public')->delete('managements/' . $management->image);
                }
            }

            // Process the base64 image data
            try {
                // Convert base64 to image and save
                $imageData = $this->croppedImage;

                // Extract the actual base64 string (handle different base64 formats)
                if (strpos($imageData, ';base64,') !== false) {
                    $imageData = explode(';base64,', $imageData)[1];
                } elseif (strpos($imageData, ',') !== false) {
                    $imageData = substr($imageData, strpos($imageData, ',') + 1);
                }

                // Decode the base64 string
                $imageData = base64_decode($imageData);

                if ($imageData === false) {
                    throw new \Exception("Invalid base64 image data");
                }

                // Generate a unique filename
                $imageName = time() . '_' . Str::random(10) . '.jpg';

                // Store the image
                Storage::disk('public')->put('managements/' . $imageName, $imageData);

                $data['image'] = $imageName;
            } catch (\Exception $e) {
                $this->notifyError('Terjadi kesalahan dalam memproses gambar: ' . $e->getMessage());
                return;
            }
        }

        Management::updateOrCreate(['id' => $this->management_id], $data);

        $this->notifySuccess(
            $this->management_id
                ? 'Pengurus berhasil diperbarui.'
                : 'Pengurus berhasil dibuat.'
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
        $this->croppedImage = null;

        $this->openModal();
    }

    public function delete($id)
    {
        $management = Management::find($id);

        if ($management) {
            // Delete image from storage if exists
            if ($management->image) {
                Storage::disk('public')->delete('managements/' . $management->image);
            }

            $management->delete();
            $this->notifySuccess('Pengurus berhasil dihapus.');
        } else {
            $this->notifyError('Pengurus tidak ditemukan.');
        }
    }
}
