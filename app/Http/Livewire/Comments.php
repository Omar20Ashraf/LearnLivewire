<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class Comments extends Component
{
    public $comments;
    public $newComment;

    public function mount()
    {
        # code...
        $this->comments = Comment::latest()->get();
    }

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

        $this->comments->prepend($createdComment);

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
        $this->comments = $this->comments->except($comment->id);

        $comment->delete();

        session()->flash('message', 'Comment deleted successfully 😊');
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
