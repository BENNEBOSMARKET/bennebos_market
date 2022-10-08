<?php

namespace App\Http\Livewire\Seller\Wallet;

use App\Models\CommissionHistory;
use App\Models\Order;
use App\Models\SellerWallet;
use Livewire\Component;
use Livewire\WithPagination;

class SellerWalletComponent extends Component
{
    use WithPagination;
    public $wallet;
    public function render()
    {
        $this->wallet = SellerWallet::where('seller_id', authSeller()->id)->first();
        $transactions = CommissionHistory::where('seller_id', authSeller()->id)->orderBy('id', 'DESC')->paginate(15);

        return view('livewire.seller.wallet.seller-wallet-component', ['transactions'=>$transactions])->layout('livewire.seller.layouts.base');
    }
}
