<?php

namespace App\Livewire\Dashboard;

use App\Models\Event;
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
    public $showForm = false;

    // Filters
    public $search = '';
    public $dateFilter = '';

    #[Computed]
    public function events()
    {
        return Event::when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('location', 'like', '%' . $this->search . '%');
            })
            ->when($this->dateFilter, function ($query) {
                $query->whereDate('date', $this->dateFilter);
            })
            ->latest('date')
            ->paginate(10);
    }

    public function createEvent()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->dispatch('event-form-shown');
    }

    public function editEvent(Event $event)
    {
        $this->editingEventId = $event->id;
        $this->title = $event->title;
        $this->date = $event->date->format('Y-m-d');
        $this->time = $event->time->format('H:i');
        $this->location = $event->location;
        $this->description = $event->description;
        $this->showForm = true;
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
            Event::find($this->editingEventId)->update($data);
            session()->flash('message', 'Event berhasil diupdate!');
        } else {
            Event::create($data);
            session()->flash('message', 'Event berhasil dibuat!');
        }

        $this->dispatch('event-form-hidden');
        $this->resetForm();
        $this->dispatch('event-updated');
    }

    public function deleteEvent(Event $event)
    {
        $event->delete();
        session()->flash('message', 'Event berhasil dihapus!');
        $this->dispatch('event-updated');
    }

    public function cancelEdit()
    {
        $this->dispatch('event-form-hidden');
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->title = '';
        $this->date = '';
        $this->time = '';
        $this->location = '';
        $this->description = '';
        $this->image = null;
        $this->editingEventId = null;
        $this->showForm = false;
    }

    public function render()
    {
        return view('livewire.dashboard.manage-events');
    }
}