<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\SupportTicket;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Comments extends Component
{
    use WithPagination, WithFileUploads;

    public $newComment;
    public $image;
    public $fileUploaded = 0;
    public $ticketId;

    protected $listeners = ['ticketSelected'];

    protected $rules = [
        'newComment' => 'required|string|max:225',
        'image' => 'nullable|image',
    ];

    public function ticketSelected($ticketId)
    {
        # code...
        $this->ticketId = $ticketId;
    }

    public function addComment()
    {
        # code...
        $this->validate();

        $image = $this->storeImage();

        Comment::create([
            'user_id' =>1,
            'support_ticket_id' => $this->ticketId,
            'body' => $this->newComment,
            'image' => $image,
        ]);

        $this->newComment = '';
        $this->image      = null;
        $this->fileUploaded++;

        session()->flash('message', 'Comment added successfully 😁');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    private function storeImage()
    {
        $name = null;

        if($this->image){

            $img   = Image::make($this->image)->encode('jpg');
            $name  = Str::random() . '.jpg';
            Storage::disk('public')->put($name, $img);
        }

        return $name;
    }

    public function remove(Comment $comment)
    {
        # code...
        Storage::disk('public')->delete($comment->image);
        $comment->delete();

        session()->flash('message', 'Comment deleted successfully 😊');
    }

    public function render()
    {
        $tickets = SupportTicket::all();

        if (empty($this->ticketId) && count($tickets) > 0)
            $this->ticketId = $tickets->first()->id;

        return view('livewire.comments',[
            'comments' => Comment::where('support_ticket_id',$this->ticketId)->latest()->paginate(2)
        ]);
    }
}
