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
        $this->comments = Comment::all();
    }

    public function addComment()
    {
        # code...
        if($this->newComment == ''){
            return ;
        }

        array_unshift($this->comments,[
            'body' => $this->newComment,
            'created_at' => Carbon::now()->diffForHumans(),
            'creator' => 'Sarthak'
        ]);

        $this->newComment = '';
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
