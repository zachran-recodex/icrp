<?php

namespace App\Livewire;

use App\Models\Setting;
use Livewire\Component;
use App\WithNotification;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ManageSetting extends Component
{
    use WithFileUploads, WithNotification;

    // General settings
    public $settingId;
    public $address;
    public $phone;
    public $email;

    // Social media
    public $youtube_link;
    public $instagram_link;
    public $facebook_link;
    public $google_map_link;
    public $twitter_link;
    public $linkedin_link;

    // Content
    public $footer_text;

    // Files
    public $logo;
    public $favicon;
    public $temp_logo;
    public $temp_favicon;

    // UI states
    public $activeTab = 'general';
    public $isSaving = false;

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        // Get first record or create a new one if none exists
        $settings = Setting::first();

        if ($settings) {
            $this->settingId = $settings->id;
            $this->address = $settings->address;
            $this->phone = $settings->phone;
            $this->email = $settings->email;
            $this->youtube_link = $settings->youtube_link;
            $this->instagram_link = $settings->instagram_link;
            $this->facebook_link = $settings->facebook_link;
            $this->google_map_link = $settings->google_map_link;
            $this->twitter_link = $settings->twitter_link;
            $this->linkedin_link = $settings->linkedin_link;
            $this->footer_text = $settings->footer_text;
            $this->logo = $settings->logo;
            $this->favicon = $settings->favicon;
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function save()
    {
        $this->isSaving = true;

        $this->validate([
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'temp_logo' => 'nullable|image|max:2048',
            'temp_favicon' => 'nullable|image|max:2048',
            'youtube_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'facebook_link' => 'nullable|url',
            'google_map_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
        ]);

        $data = [
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'youtube_link' => $this->youtube_link,
            'instagram_link' => $this->instagram_link,
            'facebook_link' => $this->facebook_link,
            'google_map_link' => $this->google_map_link,
            'twitter_link' => $this->twitter_link,
            'linkedin_link' => $this->linkedin_link,
            'footer_text' => $this->footer_text,
        ];

        // Handle logo upload
        if ($this->temp_logo) {
            // Delete old logo if exists
            if ($this->logo) {
                Storage::disk('public')->delete('settings/' . $this->logo);
            }

            // Store new logo
            $logoName = 'logo_' . time() . '.' . $this->temp_logo->getClientOriginalExtension();
            $this->temp_logo->storeAs('settings', $logoName, 'public');
            $data['logo'] = $logoName;
            $this->logo = $logoName;
        }

        // Handle favicon upload
        if ($this->temp_favicon) {
            // Delete old favicon if exists
            if ($this->favicon) {
                Storage::disk('public')->delete('settings/' . $this->favicon);
            }

            // Store new favicon
            $faviconName = 'favicon_' . time() . '.' . $this->temp_favicon->getClientOriginalExtension();
            $this->temp_favicon->storeAs('settings', $faviconName, 'public');
            $data['favicon'] = $faviconName;
            $this->favicon = $faviconName;
        }

        // Update or create settings
        if ($this->settingId) {
            Setting::find($this->settingId)->update($data);
        } else {
            $setting = Setting::create($data);
            $this->settingId = $setting->id;
        }

        $this->temp_logo = null;
        $this->temp_favicon = null;
        $this->isSaving = false;

        $this->notifySuccess('Setting updated successfully.');
    }

    public function render()
    {
        return view('livewire.manage-setting');
    }
}
