<?php

namespace App\Http\Livewire\Customer\Payment;

use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm;
    public $card_name, $user_id, $card_number;

    public function storeData()
    {
        $this->validate([
            'card_name' => 'required',
            'card_number' => 'required',
        ]);

        $data = new PaymentMethod();
        $data->card_name = $this->card_name;
        $data->user_id = user()->id;
        $data->card_number = $this->card_number;
        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Payment method added successfully!']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->card_name = '';
        $this->user_id = '';
        $this->card_number = '';
    }

    public function deleteCard($id)
    {
        $data = PaymentMethod::find($id);
        $data->delete();

        $this->dispatchBrowserEvent('success', ['message'=>'Payment method deleted successfully!']);
    }

    public function render()
    {
        $paymet_methods = PaymentMethod::orderBy('id', 'ASC')->get();
        return view('livewire.customer.payment.payment-component', ['paymet_methods'=>$paymet_methods])->layout('livewire.layouts.base');
    }
}
