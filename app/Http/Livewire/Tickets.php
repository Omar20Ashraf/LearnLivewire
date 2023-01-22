<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SupportTicket;

class Tickets extends Component
{
    public $active;

    protected $listeners = ['ticketSelected'];

    public function ticketSelected($ticketId)
    {
        # code...
        $this->active = $ticketId;
    }

    public function render()
    {
        $tickets = SupportTicket::all();

        if(empty($this->active) && count($tickets) > 0){
            $this->active = $tickets->first()->id;
        }

        return view('livewire.tickets',[
            'tickets' => $tickets
        ]);
    }
}
