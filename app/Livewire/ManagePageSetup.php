<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PageSetup;
use App\WithNotification;
use Livewire\Attributes\Url;

class ManagePageSetup extends Component
{
    use WithNotification;

    // Available pages for tabs
    public $availablePages = [
        'beranda' => 'Beranda',
        'tentang' => 'Tentang Kami',
        'pendiri' => 'Profil Pendiri ICRP',
        'pengurus' => 'Pengurus ICRP',
        'kontak' => 'Kontak Kami',
        'sahabat' => 'Sahabat ICRP',
        'jaringan' => 'Jaringan',
        'berita' => 'Berita & Artikel',
        'pustaka' => 'Pustaka',
        'advokasi' => 'Advokasi KBB'
    ];

    // Selected tab
    #[Url]
    public $activeTab = 'beranda';

    // Form properties
    public $pageSetupId;
    public $page;
    public $title;
    public $meta_description;
    public $meta_keywords;

    // Define listeners for events
    protected $listeners = ['refreshPageSetups' => '$refresh'];

    // Validation rules
    protected function rules()
    {
        return [
            'title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->loadPageData();
    }

    // Change the active tab
    public function changeTab($tabName)
    {
        if (array_key_exists($tabName, $this->availablePages)) {
            $this->activeTab = $tabName;
            $this->loadPageData();
        }
    }

    // Load data for the current active tab
    public function loadPageData()
    {
        $pageSetup = PageSetup::where('page', $this->activeTab)->first();

        if ($pageSetup) {
            $this->resetValidation();

            $this->pageSetupId = $pageSetup->id;
            $this->page = $pageSetup->page;
            $this->title = $pageSetup->title;
            $this->meta_description = $pageSetup->meta_description;
            $this->meta_keywords = $pageSetup->meta_keywords;
        } else {
            $this->resetForm();
            $this->page = $this->activeTab;
        }
    }

    public function save()
    {
        $this->validate();

        try {
            $pageSetup = PageSetup::firstOrNew(['page' => $this->page]);

            $pageSetup->title = $this->title;
            $pageSetup->meta_description = $this->meta_description;
            $pageSetup->meta_keywords = $this->meta_keywords;
            $pageSetup->save();

            $this->notifySuccess('Page setup successfully saved.');

            $this->dispatch('refreshPageSetups');

        } catch (\Exception $e) {
            $this->notifyError('Something wrong: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset(['pageSetupId', 'title', 'meta_description', 'meta_keywords']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.manage-page-setup');
    }
}
