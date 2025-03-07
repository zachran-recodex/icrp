<?php

namespace App\Livewire;

use Livewire\Component;
use App\WithNotification;
use App\Models\Management;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\ManagementContribution;
use Illuminate\Support\Facades\Storage;

class ManageManagements extends Component
{
    use WithFileUploads, WithNotification, WithPagination;

    public $management_id;
    public $name;
    public $nickname;
    public $slug;
    public $birth_date;
    public $death_date;
    public $birth_place;
    public $known_as;
    public $quote;
    public $biography;
    public $image;
    public $temp_image;
    public $croppedImage;
    public $order = 0;
    public $position;
    public $dewan;

    // Legacy and contributions
    public $contributions = [];
    public $legacyContent;

    // UI control
    public $isOpen = false;
    public $activeTab = 'basic'; // tabs: basic, contributions, legacy
    public $search;

    // Contribution temporary variables
    public $newContributionTitle = '';
    public $newContributionDescription = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'nickname' => 'nullable|string|max:255',
        'birth_date' => 'required|date',
        'death_date' => 'nullable|date',
        'birth_place' => 'required|string|max:255',
        'known_as' => 'required|string|max:255',
        'quote' => 'nullable|string',
        'biography' => 'required|string',
        'temp_image' => 'nullable|image|max:2048',
        'order' => 'integer',
        'contributions.*.title' => 'required|string|max:255',
        'contributions.*.description' => 'required|string',
        'legacyContent' => 'nullable|string',
        'position' => 'required',
        'dewan' => 'required|in:Directure Excecutive,Pengurus,Kehormatan,Pembina,Pengawas,Pengurus Harian',
    ];

    public function mount()
    {
        // Initialize with an empty contribution row
        $this->resetContributions();
    }

    public function render()
    {
        $managements = Management::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('nickname', 'like', '%' . $this->search . '%');
        })
            ->orderBy('order', 'asc')
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
        $this->management_id = null;
        $this->name = '';
        $this->nickname = '';
        $this->slug = '';
        $this->birth_date = '';
        $this->death_date = '';
        $this->birth_place = '';
        $this->known_as = '';
        $this->quote = '';
        $this->biography = '';
        $this->image = '';
        $this->temp_image = '';
        $this->croppedImage = null;
        $this->order = 0;
        $this->resetContributions();
        $this->legacyContent = '';
        $this->activeTab = 'basic';
        $this->position = '';
        $this->dewan = '';
    }

    private function resetContributions()
    {
        $this->contributions = [
            [
                'id' => null,
                'title' => '',
                'description' => '',
                'order' => 0
            ]
        ];
    }

    public function addContribution()
    {
        $this->contributions[] = [
            'id' => null,
            'title' => '',
            'description' => '',
            'order' => count($this->contributions)
        ];
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function removeContribution($index)
    {
        if (count($this->contributions) > 1) {
            array_splice($this->contributions, $index, 1);

            // Reset order values
            foreach ($this->contributions as $i => $contribution) {
                $this->contributions[$i]['order'] = $i;
            }
        }
    }

    public function store()
    {
        $this->validate();

        // Generate slug if not exists
        if (empty($this->slug)) {
            $this->slug = Str::slug($this->name);
        }

        // Prepare management data
        $data = [
            'name' => $this->name,
            'nickname' => $this->nickname,
            'slug' => $this->slug,
            'birth_date' => $this->birth_date,
            'death_date' => $this->death_date ?: null,
            'birth_place' => $this->birth_place,
            'known_as' => $this->known_as,
            'quote' => $this->quote,
            'biography' => $this->biography,
            'order' => $this->order,
            'position' => $this->position,
            'dewan' => $this->dewan,
        ];

        // Handle cropped image
        if ($this->croppedImage) {
            // Delete old image if exists when updating
            if ($this->management_id) {
                $management = Management::find($this->management_id);
                if ($management && $management->image) {
                    Storage::disk('public')->delete('managements/' . $management->image);
                }
            }

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
        // Handle image upload (legacy way, as fallback)
        elseif ($this->temp_image) {
            // Delete old image if exists when updating
            if ($this->management_id) {
                $management = Management::find($this->management_id);
                if ($management && $management->image) {
                    Storage::disk('public')->delete('managements/' . $management->image);
                }
            }

            // Store new image
            $imageName = time() . '_' . $this->temp_image->getClientOriginalName();
            $this->temp_image->storeAs('managements', $imageName, 'public');
            $data['image'] = $imageName;
        }

        // Create or update management
        $management = Management::updateOrCreate(['id' => $this->management_id], $data);

        // Handle contributions
        $this->storeContributions($management);

        // Handle legacy content
        $this->storeLegacy($management);

        $this->notifySuccess(
            $this->management_id
                ? 'Pengurus berhasil diperbarui.'
                : 'Pengurus berhasil ditambahkan.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    private function storeContributions($management)
    {
        // Get existing contribution IDs for this management
        $existingIds = $management->contributions()->pluck('id')->toArray();
        $keepIds = [];

        // Update or create contributions
        foreach ($this->contributions as $index => $contribution) {
            if (!empty($contribution['title']) && !empty($contribution['description'])) {
                $contribData = [
                    'title' => $contribution['title'],
                    'description' => $contribution['description'],
                    'order' => $index
                ];

                if (!empty($contribution['id'])) {
                    // Update existing
                    $contrib = ManagementContribution::find($contribution['id']);
                    if ($contrib) {
                        $contrib->update($contribData);
                        $keepIds[] = $contrib->id;
                    }
                } else {
                    // Create new
                    $contrib = $management->contributions()->create($contribData);
                    $keepIds[] = $contrib->id;
                }
            }
        }

        // Delete contributions that were removed
        $deleteIds = array_diff($existingIds, $keepIds);
        if (!empty($deleteIds)) {
            ManagementContribution::whereIn('id', $deleteIds)->delete();
        }
    }

    private function storeLegacy($management)
    {
        if ($this->legacyContent) {
            $legacy = $management->legacies()->first();

            if ($legacy) {
                $legacy->update(['content' => $this->legacyContent]);
            } else {
                $management->legacies()->create(['content' => $this->legacyContent]);
            }
        } else {
            // Remove legacy if content is empty
            $management->legacies()->delete();
        }
    }

    public function edit($id)
    {
        $management = Management::with(['contributions', 'legacies'])->findOrFail($id);

        // Basic info
        $this->management_id = $id;
        $this->name = $management->name;
        $this->nickname = $management->nickname;
        $this->slug = $management->slug;
        $this->birth_date = $management->birth_date ? $management->birth_date->format('Y-m-d') : null;
        $this->death_date = $management->death_date ? $management->death_date->format('Y-m-d') : null;
        $this->birth_place = $management->birth_place;
        $this->known_as = $management->known_as;
        $this->quote = $management->quote;
        $this->biography = $management->biography;
        $this->image = $management->image;
        $this->croppedImage = null;
        $this->order = $management->order;
        $this->position = $management->position;
        $this->dewan = $management->dewan;

        // Contributions
        if ($management->contributions->count() > 0) {
            $this->contributions = $management->contributions->map(function($contribution) {
                return [
                    'id' => $contribution->id,
                    'title' => $contribution->title,
                    'description' => $contribution->description,
                    'order' => $contribution->order
                ];
            })->toArray();
        } else {
            $this->resetContributions();
        }

        // Legacy
        $legacy = $management->legacies->first();
        $this->legacyContent = $legacy ? $legacy->content : '';

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

            // Delete will cascade to contributions and legacies because of the migration
            $management->delete();
            $this->notifySuccess('Pengurus berhasil dihapus.');
        } else {
            $this->notifyError('Pengurus tidak ditemukan.');
        }
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }
}
