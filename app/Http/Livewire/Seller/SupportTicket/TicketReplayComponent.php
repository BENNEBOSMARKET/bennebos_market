<?php

namespace App\Http\Livewire\Seller\SupportTicket;

use App\Models\Ticket;
use App\Models\TicketReplay;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TicketReplayComponent extends Component
{
    public $ticket_id, $user_id, $reply_mmessage, $attachment;
    public $sortingValue = 10, $searchTerm;

    public function mount($id){
        $this->ticket_id = $id;
    }

    public function storeData()
    {
        $this->validate([
            'reply_mmessage' => 'required',
        ]);

        $data = new TicketReplay();
        $data->ticket_id = $this->ticket_id;
        $data->user_id = Auth::user()->id;
        $data->reply_mmessage = $this->reply_mmessage;

        if($this->attachment != ''){
            $imageName = Carbon::now()->timestamp. '.' . $this->attachment->extension();
            $this->attachment->storeAs('imgs/support',$imageName, 's3');
            $data->attachment = $imageName;
        }

        $data->save();
        $this->dispatchBrowserEvent('success', ['message'=>'Replay submited successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->user_id = '';
        $this->reply_mmessage = '';
        $this->attachment = '';
    }

    public function render()
    {
        $ticket_relpays = TicketReplay::where('user_id', authSeller()->id)->orderBy('created_at', 'DESC')->paginate($this->sortingValue);
        return view('livewire.seller.support-ticket.ticket-replay-component', ['ticket_relpays'=>$ticket_relpays])->layout('livewire.seller.layouts.base');
    }
}
