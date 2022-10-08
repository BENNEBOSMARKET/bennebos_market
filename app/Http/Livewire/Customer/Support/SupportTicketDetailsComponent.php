<?php

namespace App\Http\Livewire\Customer\Support;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\TicketReplay;
use Illuminate\Support\Facades\Auth;

class SupportTicketDetailsComponent extends Component
{
    public $ticket_id, $user_id, $message, $attachment;
    public $sortingValue = 10, $searchTerm;

    public function mount($id)
    {
        $this->ticket_id = $id;
    }

    public function storeData()
    {
        $this->validate([
            'message' => 'required',
        ]);

        $data = new TicketReplay();
        $data->ticket_id = $this->ticket_id;
        $data->user_id = user()->id;
        $data->reply_mmessage = $this->message;

        if($this->attachment != ''){
            $imageName = Carbon::now()->timestamp. '_reply.' . $this->attachment->extension();
            $this->attachment->storeAs('support',$imageName, 's3');
            $data->attachment = $imageName;
        }

        $data->save();
        $this->dispatchBrowserEvent('success', ['message'=>'Replay submitted successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->user_id = '';
        $this->message = '';
        $this->attachment = '';
    }

    public function render()
    {
        $ticket_replies = TicketReplay::where('ticket_id', $this->ticket_id)->orderBy('id', 'DESC')->get();

        return view('livewire.customer.support.support-ticket-details-component', ['ticket_replies'=>$ticket_replies])->layout('livewire.layouts.base');
    }
}
