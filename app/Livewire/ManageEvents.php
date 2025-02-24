<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use App\WithNotification;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ManageEvents extends Component
{
    use WithFileUploads, WithNotification, WithPagination;

    public $title;
    public $description;
    public $image;
    public $date;
    public $time;
    public $location;
    public $event_id;
    public $isOpen = false;
    public $temp_image;
    public $search;

    public function render()
    {
        $events = Event::when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.manage-events', [
            'events' => $events
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
        $this->title = '';
        $this->description = '';
        $this->image = '';
        $this->date = '';
        $this->time = '';
        $this->location = '';
        $this->event_id = '';
        $this->temp_image = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'temp_image' => $this->event_id ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
        ]);

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'time' => $this->time,
            'location' => $this->location,
        ];

        // Handle image upload
        if ($this->temp_image) {
            // Delete old image if exists
            if ($this->event_id) {
                $event = Event::find($this->event_id);
                if ($event->image) {
                    Storage::disk('public')->delete('events/' . $event->image);
                }
            }

            // Store new image
            $imageName = time() . '_' . $this->temp_image->getClientOriginalName();
            $this->temp_image->storeAs('events', $imageName, 'public');
            $data['image'] = $imageName;
        }

        Event::updateOrCreate(['id' => $this->event_id], $data);

        $this->notifySuccess(
            $this->event_id
                ? 'Event successfully updated.'
                : 'Event successfully created.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $this->event_id = $id;
        $this->title = $event->title;
        $this->description = $event->description;
        $this->image = $event->image;
        $this->date = $event->date;
        $this->time = $event->time;
        $this->location = $event->location;

        $this->openModal();
    }

    public function delete($id)
    {
        $event = Event::find($id);

        // Delete image from storage if exists
        if ($event->image) {
            Storage::disk('public')->delete('events/' . $event->image);
        }

        $event->delete();
        $this->notifySuccess('Event successfully deleted.');
    }
}
