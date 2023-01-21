<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
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

    public function addComment()
    {
        # code...
        if($this->newComment == '')
            return ;

        $createdComment = Comment::create([
            'user_id' =>1,
            'body' => $this->newComment,
        ]);

        $this->comments->prepend($createdComment);

        $this->newComment = '';
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
