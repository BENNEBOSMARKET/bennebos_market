<?php

namespace App\Http\Livewire\Admin\Ticket;

use App\Models\Ticket;
use Livewire\Component;

class TicketComponent extends Component
{
    public $sortingValue = 10, $searchTerm;

    public function render()
    {
        $tickets = Ticket::orderBy('id', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.ticket.ticket-component', ['tickets'=> $tickets])->layout('livewire.admin.layouts.base');
    }
}
