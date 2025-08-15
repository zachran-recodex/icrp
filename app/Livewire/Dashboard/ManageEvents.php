<?php

namespace App\Livewire\Dashboard;

use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageEvents extends Component
{
    use WithFileUploads, WithPagination;

    public $title = '';

    public $date = '';

    public $time = '';

    public $location = '';

    public $description = '';

    public $image;

    public $editingEventId = null;

    public $deletingEventId = null;

    // Modal controls using wire:model
    public $showEventModal = false;

    public $showDeleteEventModal = false;

    // Filters
    public $search = '';

    public $dateFilter = '';

    #[Computed]
    public function events()
    {
        return Event::when($this->search, function ($query) {
            $query->where('title', 'like', '%'.$this->search.'%')
                ->orWhere('location', 'like', '%'.$this->search.'%');
        })
            ->when($this->dateFilter, function ($query) {
                $query->whereDate('date', $this->dateFilter);
            })
            ->latest('date')
            ->paginate(10);
    }

    public function createEvent()
    {
        $this->resetEventForm();
        $this->showEventModal = true;
        $this->dispatch('event-form-shown');
    }

    public function editEvent($eventId)
    {
        $event = Event::find($eventId);
        $this->editingEventId = $event->id;
        $this->title = $event->title;
        $this->date = $event->date->format('Y-m-d');
        $this->time = $event->time->format('H:i');
        $this->location = $event->location;
        $this->description = $event->description;
        $this->showEventModal = true;
        $this->dispatch('event-form-shown');
    }

    public function saveEvent()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => $this->editingEventId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'title' => $this->title,
            'date' => $this->date,
            'time' => $this->time,
            'location' => $this->location,
            'description' => $this->description,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('images', 'public');
        }

        if ($this->editingEventId) {
            $event = Event::find($this->editingEventId);
            // Delete old image if new one is uploaded
            if ($this->image && $event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $event->update($data);
            session()->flash('message', 'Event updated successfully!');
        } else {
            Event::create($data);
            session()->flash('message', 'Event created successfully!');
        }

        $this->showEventModal = false;
        $this->resetEventForm();
        $this->dispatch('event-updated');
    }

    public function deleteEvent($eventId)
    {
        $this->deletingEventId = $eventId;
        $this->showDeleteEventModal = true;
    }

    public function confirmDeleteEvent()
    {
        if ($this->deletingEventId) {
            $event = Event::find($this->deletingEventId);
            // Delete associated image file
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $event->delete();
            session()->flash('message', 'Event deleted successfully!');
            $this->deletingEventId = null;
            $this->showDeleteEventModal = false;
            $this->dispatch('event-updated');
        }
    }

    public function cancelEventEdit()
    {
        $this->showEventModal = false;
        $this->resetEventForm();
    }

    private function resetEventForm()
    {
        $this->title = '';
        $this->date = '';
        $this->time = '';
        $this->location = '';
        $this->description = '';
        $this->image = null;
        $this->editingEventId = null;
        $this->showEventModal = false;
    }

    public function render()
    {
        return view('livewire.dashboard.manage-events');
    }
}
