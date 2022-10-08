<?php

namespace App\Http\Livewire\Customer\Support;

use Carbon\Carbon;
use App\Models\Ticket;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class SupportComponent extends Component
{
    public $subject, $message, $attachment;
    public $sortingValue = 10, $searchTerm;
    use WithFileUploads;
    use WithPagination;

    public function storeTicket()
    {
        $this->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $data = new Ticket();
        $data->user_type = 'user';
        $data->subject = $this->subject;
        $data->user_id = user()->id;
        $data->message = $this->message;

        if($this->attachment != ''){
            $imageName = Str::random(5).Carbon::now()->timestamp. '.' . $this->attachment->extension();
            $this->attachment->storeAs('support',$imageName, 's3');
            $data->attachment = $imageName;
        }

        $data->save();
        $this->dispatchBrowserEvent('success', ['message'=>'Support ticket submitted successfully']);
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
        $support_tickets = Ticket::where('user_type', 'user')->where('user_id', user()->id)->paginate($this->sortingValue);

        return view('livewire.customer.support.support-component', ['support_tickets'=>$support_tickets])->layout('livewire.layouts.base');
    }
}
