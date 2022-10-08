<?php

namespace App\Http\Livewire\Customer\Ticket;

use Livewire\Component;

class TicketComponent extends Component
{
    public function render()
    {
        return view('livewire.customer.ticket.ticket-component')->layout('livewire.layouts.base');
    }
}
