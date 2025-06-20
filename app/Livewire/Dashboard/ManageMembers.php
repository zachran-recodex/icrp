<?php

namespace App\Livewire\Dashboard;

use App\Models\Member;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageMembers extends Component
{
    use WithFileUploads, WithPagination;

    public $name = '';
    public $nickname = '';
    public $birth_date = '';
    public $death_date = '';
    public $birth_place = '';
    public $known_as = '';
    public $position = '';
    public $dewan_category = '';
    public $quote = '';
    public $biography = '';
    public $photo;
    public $editingMemberId = null;
    public $deletingMemberId = null;

    // Modal controls using wire:model
    public $showMemberModal = false;
    public $showDeleteMemberModal = false;

    // Filters
    public $search = '';
    public $statusFilter = ''; // all, alive, deceased
    public $categoryFilter = '';

    #[Computed]
    public function members()
    {
        return Member::when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('known_as', 'like', '%' . $this->search . '%')
                      ->orWhere('birth_place', 'like', '%' . $this->search . '%')
                      ->orWhere('position', 'like', '%' . $this->search . '%');
            })
            ->when($this->statusFilter === 'alive', function ($query) {
                $query->whereNull('death_date');
            })
            ->when($this->statusFilter === 'deceased', function ($query) {
                $query->whereNotNull('death_date');
            })
            ->when($this->categoryFilter, function ($query) {
                $query->where('dewan_category', $this->categoryFilter);
            })
            ->latest()
            ->paginate(10);
    }

    public function createMember()
    {
        $this->resetMemberForm();
        $this->showMemberModal = true;
        $this->dispatch('member-form-shown');
    }

    public function editMember($memberId)
    {
        $member = Member::find($memberId);
        $this->editingMemberId = $member->id;
        $this->name = $member->name;
        $this->nickname = $member->nickname;
        $this->birth_date = $member->birth_date->format('Y-m-d');
        $this->death_date = $member->death_date?->format('Y-m-d');
        $this->birth_place = $member->birth_place;
        $this->known_as = $member->known_as;
        $this->position = $member->position;
        $this->dewan_category = $member->dewan_category;
        $this->quote = $member->quote;
        $this->biography = $member->biography;
        $this->showMemberModal = true;
        $this->dispatch('member-form-shown');
    }

    public function saveMember()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'birth_date' => 'required|date|before:today',
            'death_date' => 'nullable|date|after:birth_date|before:today',
            'birth_place' => 'required|string|max:255',
            'known_as' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'dewan_category' => 'required|in:direktur eksekutif,pengurus,kehormatan,pembina,pengawas,pengurus harian',
            'quote' => 'nullable|string',
            'biography' => 'required|string',
            'photo' => $this->editingMemberId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'name' => $this->name,
            'nickname' => $this->nickname,
            'birth_date' => $this->birth_date,
            'death_date' => $this->death_date ?: null,
            'birth_place' => $this->birth_place,
            'known_as' => $this->known_as,
            'position' => $this->position,
            'dewan_category' => $this->dewan_category,
            'quote' => $this->quote,
            'biography' => $this->biography,
        ];

        if ($this->photo) {
            $data['photo'] = $this->photo->store('images', 'public');
        }

        if ($this->editingMemberId) {
            $member = Member::find($this->editingMemberId);
            // Delete old image if new one is uploaded
            if ($this->photo && $member->photo) {
                Storage::disk('public')->delete($member->photo);
            }
            $member->update($data);
            session()->flash('message', 'Member updated successfully!');
        } else {
            Member::create($data);
            session()->flash('message', 'Member created successfully!');
        }

        $this->showMemberModal = false;
        $this->resetMemberForm();
        $this->dispatch('member-updated');
    }

    public function deleteMember($memberId)
    {
        $this->deletingMemberId = $memberId;
        $this->showDeleteMemberModal = true;
    }

    public function confirmDeleteMember()
    {
        if ($this->deletingMemberId) {
            $member = Member::find($this->deletingMemberId);
            // Delete associated image file
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }
            $member->delete();
            session()->flash('message', 'Member deleted successfully!');
            $this->deletingMemberId = null;
            $this->showDeleteMemberModal = false;
            $this->dispatch('member-updated');
        }
    }

    public function cancelMemberEdit()
    {
        $this->showMemberModal = false;
        $this->resetMemberForm();
    }

    private function resetMemberForm()
    {
        $this->name = '';
        $this->nickname = '';
        $this->birth_date = '';
        $this->death_date = '';
        $this->birth_place = '';
        $this->known_as = '';
        $this->position = '';
        $this->dewan_category = '';
        $this->quote = '';
        $this->biography = '';
        $this->photo = null;
        $this->editingMemberId = null;
        $this->showMemberModal = false;
    }

    public function render()
    {
        return view('livewire.dashboard.manage-members');
    }
}