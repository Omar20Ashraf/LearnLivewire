<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    public $newComment;

    protected $rules = [
        'newComment' => 'required|string|max:225',
    ];

    public function addComment()
    {
        # code...
        $this->validate();

        $createdComment = Comment::create([
            'user_id' =>1,
            'body' => $this->newComment,
        ]);

        $this->newComment = '';

        session()->flash('message', 'Comment added successfully 😁');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function remove(Comment $comment)
    {
        # code...
        $comment->delete();

        session()->flash('message', 'Comment deleted successfully 😊');
    }

    public function render()
    {
        return view('livewire.comments',[
            'comments' => Comment::latest()->paginate(2)
        ]);
    }
}
