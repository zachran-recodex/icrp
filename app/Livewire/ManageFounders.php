<?php

namespace App\Livewire;

use App\Models\Founder;
use App\Models\FounderContribution;
use App\Models\FounderLegacy;
use Livewire\Component;
use App\WithNotification;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ManageFounders extends Component
{
    use WithFileUploads, WithNotification, WithPagination;

    // Base founder properties
    public $founder_id;
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
        'contributions.*.title' => 'nullable|string|max:255',
        'contributions.*.description' => 'nullable|string',
        'legacyContent' => 'nullable|string',
    ];

    public function mount()
    {
        // Initialize with an empty contribution row
        $this->resetContributions();
    }

    public function render()
    {
        $founders = Founder::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('nickname', 'like', '%' . $this->search . '%');
        })
            ->orderBy('order', 'asc')
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
        $this->founder_id = null;
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

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function store()
    {
        $this->validate();

        // Generate slug if not exists
        if (empty($this->slug)) {
            $this->slug = Str::slug($this->name);
        }

        // Prepare founder data
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
        ];

        // Handle cropped image
        if ($this->croppedImage) {
            // Delete old image if exists when updating
            if ($this->founder_id) {
                $founder = Founder::find($this->founder_id);
                if ($founder && $founder->image) {
                    Storage::disk('public')->delete('founders/' . $founder->image);
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
                Storage::disk('public')->put('founders/' . $imageName, $imageData);

                $data['image'] = $imageName;
            } catch (\Exception $e) {
                $this->notifyError('Terjadi kesalahan dalam memproses gambar: ' . $e->getMessage());
                return;
            }
        }
        // Handle image upload (legacy way, as fallback)
        elseif ($this->temp_image) {
            // Delete old image if exists when updating
            if ($this->founder_id) {
                $founder = Founder::find($this->founder_id);
                if ($founder && $founder->image) {
                    Storage::disk('public')->delete('founders/' . $founder->image);
                }
            }

            // Store new image
            $imageName = time() . '_' . $this->temp_image->getClientOriginalName();
            $this->temp_image->storeAs('founders', $imageName, 'public');
            $data['image'] = $imageName;
        }

        // Create or update founder
        $founder = Founder::updateOrCreate(['id' => $this->founder_id], $data);

        // Handle contributions
        $this->storeContributions($founder);

        // Handle legacy content
        $this->storeLegacy($founder);

        $this->notifySuccess(
            $this->founder_id
                ? 'Pendiri berhasil diperbarui.'
                : 'Pendiri berhasil ditambahkan.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    private function storeContributions($founder)
    {
        // Get existing contribution IDs for this founder
        $existingIds = $founder->contributions()->pluck('id')->toArray();
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
                    $contrib = FounderContribution::find($contribution['id']);
                    if ($contrib) {
                        $contrib->update($contribData);
                        $keepIds[] = $contrib->id;
                    }
                } else {
                    // Create new
                    $contrib = $founder->contributions()->create($contribData);
                    $keepIds[] = $contrib->id;
                }
            }
        }

        // Delete contributions that were removed
        $deleteIds = array_diff($existingIds, $keepIds);
        if (!empty($deleteIds)) {
            FounderContribution::whereIn('id', $deleteIds)->delete();
        }
    }

    private function storeLegacy($founder)
    {
        if ($this->legacyContent) {
            $legacy = $founder->legacies()->first();

            if ($legacy) {
                $legacy->update(['content' => $this->legacyContent]);
            } else {
                $founder->legacies()->create(['content' => $this->legacyContent]);
            }
        } else {
            // Remove legacy if content is empty
            $founder->legacies()->delete();
        }
    }

    public function edit($id)
    {
        $founder = Founder::with(['contributions', 'legacies'])->findOrFail($id);

        // Basic info
        $this->founder_id = $id;
        $this->name = $founder->name;
        $this->nickname = $founder->nickname;
        $this->slug = $founder->slug;
        $this->birth_date = $founder->birth_date ? $founder->birth_date->format('Y-m-d') : null;
        $this->death_date = $founder->death_date ? $founder->death_date->format('Y-m-d') : null;
        $this->birth_place = $founder->birth_place;
        $this->known_as = $founder->known_as;
        $this->quote = $founder->quote;
        $this->biography = $founder->biography;
        $this->image = $founder->image;
        $this->croppedImage = null;
        $this->order = $founder->order;

        // Contributions
        if ($founder->contributions->count() > 0) {
            $this->contributions = $founder->contributions->map(function($contribution) {
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
        $legacy = $founder->legacies->first();
        $this->legacyContent = $legacy ? $legacy->content : '';

        $this->openModal();
    }

    public function delete($id)
    {
        $founder = Founder::find($id);

        if ($founder) {
            // Delete image from storage if exists
            if ($founder->image) {
                Storage::disk('public')->delete('founders/' . $founder->image);
            }

            // Delete will cascade to contributions and legacies because of the migration
            $founder->delete();
            $this->notifySuccess('Pendiri berhasil dihapus.');
        } else {
            $this->notifyError('Pendiri tidak ditemukan.');
        }
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }
}
