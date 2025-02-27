<?php

namespace App\Livewire;

use App\Models\CallToAction;
use App\WithNotification;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageCallToAction extends Component
{
    use WithFileUploads, WithNotification;

    public $cta_id;
    public $title;
    public $subtitle;
    public $image;
    public $button_text;
    public $temp_image;

    public function mount()
    {
        $this->loadCallToAction();
    }

    public function loadCallToAction()
    {
        $callToAction = CallToAction::first();

        if ($callToAction) {
            $this->cta_id = $callToAction->id;
            $this->title = $callToAction->title;
            $this->subtitle = $callToAction->subtitle;
            $this->image = $callToAction->image;
            $this->button_text = $callToAction->button_text;
        } else {
            $this->title = 'Mari Bergabung Menjadi Mitra Kami';
            $this->subtitle = 'ICRP terus berkomitmen mewujudkan masyarakat yang damai, berkeadilan, dan menghormati keberagaman agama dan keyakinan di Indonesia. Dukungan anda membantu kami mengembangkan dialog antar-iman, advokasi HAM, dan studi perdamaian untuk Indonesia yang lebih baik.';
            $this->image = '';
            $this->button_text = 'Dukung Misi Kami';
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|min:3',
            'subtitle' => 'required|min:3',
            'temp_image' => $this->cta_id ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'button_text' => 'required|min:3',
        ]);

        $data = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'button_text' => $this->button_text,
        ];

        // Handle image upload
        if ($this->temp_image) {
            // Delete old image if exists
            if ($this->cta_id && $this->image) {
                Storage::disk('public')->delete('cta/' . $this->image);
            }

            // Store new image
            $imageName = time() . '_' . $this->temp_image->getClientOriginalName();
            $this->temp_image->storeAs('cta', $imageName, 'public');
            $data['image'] = $imageName;
            $this->image = $imageName;
        }

        if ($this->cta_id) {
            // Update existing call to action
            CallToAction::find($this->cta_id)->update($data);
            $this->notifySuccess('Call to action successfully updated.');
        } else {
            // Create new call to action
            $cta = CallToAction::create($data);
            $this->cta_id = $cta->id;
            $this->notifySuccess('Call to action successfully created.');
        }

        $this->temp_image = null;
    }

    public function render()
    {
        return view('livewire.manage-call-to-action');
    }
}
