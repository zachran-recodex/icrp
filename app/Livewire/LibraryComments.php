<?php

namespace App\Livewire;

use App\Models\Library;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\LibraryComment;

class LibraryComments extends Component
{
    use WithPagination;

    public $library_id;
    public $content;

    protected $rules = [
        'content' => 'required|min:3',
    ];

    public function mount($library_id)
    {
        $this->library_id = $library_id;
    }

    public function saveComment()
    {
        $this->validate();

        LibraryComment::create([
            'library_id' => $this->library_id,
            'user_id' => auth()->id(),
            'content' => $this->content,
        ]);

        $this->reset(['content']);
        session()->flash('message', 'Komentar berhasil ditambahkan');
    }

    public function render()
    {
        return view('livewire.library-comments', [
            'library' => Library::with('comments.user')->findOrFail($this->library_id),
            'comments' => LibraryComment::where('library_id', $this->library_id)
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(5)
        ]);
    }
}
