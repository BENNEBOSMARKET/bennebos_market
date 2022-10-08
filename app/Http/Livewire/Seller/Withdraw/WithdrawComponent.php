<?php

namespace App\Http\Livewire\Seller\Withdraw;

use App\Models\SellerWallet;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class WithdrawComponent extends Component
{
    use WithPagination;

    public $amount, $message, $status;
    public $sortingValue = 10, $searchTerm;

    public $wallet;
    public function storeData()
    {
        $this->validate([
            'amount' => 'required',
        ]);

        if($this->wallet->amount >= $this->amount){
            $data = new Withdraw();
            $data->amount = $this->amount;
            $data->message = $this->message;
            $data->seller_id = authSeller()->id;

            $data->save();

            $wallet = SellerWallet::where('seller_id', authSeller()->id)->first();
            $wallet->amount -= $this->amount;
            $wallet->save();

            $this->dispatchBrowserEvent('success', ['message'=>'Withdraw request submited successfully']);
            $this->dispatchBrowserEvent('closeModal');
            $this->resetInputs();
        }else{
            $this->dispatchBrowserEvent('error', ['message'=>'Insufficient Balance']);
        }
    }

    public function resetInputs()
    {
        $this->amount = '';
        $this->status = '';
        $this->message = '';
    }

    public function render()
    {
        $this->wallet = SellerWallet::where('seller_id', authSeller()->id)->first();
        $withdraw_requests = Withdraw::orderBy('id', 'DESC')->where('amount', 'like', '%'.$this->searchTerm.'%')->paginate($this->sortingValue);
        return view('livewire.seller.withdraw.withdraw-component', ['withdraw_requests'=>$withdraw_requests])->layout('livewire.seller.layouts.base');;
    }
}
