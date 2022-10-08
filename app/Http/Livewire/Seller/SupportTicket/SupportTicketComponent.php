<?php

namespace App\Http\Livewire\Seller\SupportTicket;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SupportTicketComponent extends Component
{
    public $subject, $user_id, $message, $status, $attachment, $new_attachment;
    public $sortingValue = 10, $searchTerm;
    use WithFileUploads;
    use WithPagination;

    public function storeData()
    {
        $this->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $data = new Ticket();
        $data->user_type = 'seller';
        $data->subject = $this->subject;
        $data->user_id = authSeller()->id;
        $data->message = $this->message;

        if($this->attachment != ''){
            $imageName = Carbon::now()->timestamp. '.' . $this->attachment->extension();
            $this->attachment->storeAs('imgs/support',$imageName, 's3');
            $data->attachment = $imageName;
        }

        $data->save();
        $this->dispatchBrowserEvent('success', ['message'=>'Support ticket submited successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->subject = '';
        $this->user_id = '';
        $this->message = '';
        $this->attachment = '';
    }

    public function render()
    {
        $support_tickets = Ticket::where('user_type', 'seller')->where('user_id', authSeller()->id)->where('subject', 'like', '%'.$this->searchTerm.'%')->orderBy('id', 'DESC')->paginate($this->sortingValue);

        return view('livewire.seller.support-ticket.support-ticket-component', ['support_tickets'=>$support_tickets])->layout('livewire.seller.layouts.base');
    }
}