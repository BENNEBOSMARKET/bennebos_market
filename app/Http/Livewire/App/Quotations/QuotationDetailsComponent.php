<?php

namespace App\Http\Livewire\App\Quotations;

use App\Models\QuoteNow;
use App\Models\Qutotation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class QuotationDetailsComponent extends Component
{
    public $quotation;

    public function mount($slug)
    {
        $this->quotation = Qutotation::where('slug', $slug)->first();
    }

    // quote now
    public function quoteNow($id)
    {
        if(Auth::guard('seller')->check()){
            $getData = QuoteNow::where('seller_id', authSeller()->id)->where('quotation_id', $id)->get();

            if($getData->count() > 0){
                $this->dispatchBrowserEvent('warning', ['message' => 'You already quoted!']);
            }else{
                if (Auth::guard('seller')->user()) {
                    $quote_now = new QuoteNow();
                    $quote_now->quotation_id = $id;
                    $quote_now->seller_id = authSeller()->id;
                    $quote_now->save();
                    $this->dispatchBrowserEvent('success', ['message' => 'Quote submited successfully!']);
                }else{
                    return redirect()->route('seller.login');
                }
            }
        }
        else{
            return redirect()->route('seller.login');
        }
    }

    public function render()
    {
        $recomandedrfqs = Qutotation::inRandomOrder()->take(4)->get();
        return view('livewire.app.quotations.quotation-details-component', ['recomandedrfqs' => $recomandedrfqs])->layout('livewire.layouts.base');
    }
}
