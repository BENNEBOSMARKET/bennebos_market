<?php

namespace App\Http\Livewire\App\Quotations;

use App\Models\QuoteNow;
use App\Models\Qutotation;
use App\Models\QutotationCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class QuotationsComponent extends Component
{
    use WithPagination;

    public $sortingValue = 10, $searchTerm;

    public $tabStatus = 0, $selectedCategory;
    public $category_id;

    public $total_quotation, $total_quotes;

    public function mount()
    {
        $this->total_quotation = Qutotation::count();
        $this->total_quotes = QuoteNow::count();
    }

    public function selectCategory($id)
    {
        $this->category_id = $id;
        $this->tabStatus = $id;
        $this->resetPage();
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
        $categoryquations = [];

        if ($this->category_id != null) {
            $categoryquations = Qutotation::where('category_id', $this->category_id)->where('status', 1)->paginate($this->sortingValue);
        }

        $quationcategories = QutotationCategory::all();

        $recomandedquations = Qutotation::where('status', 1)->paginate($this->sortingValue);

        $quationsliders = Qutotation::orderBy('id', 'DESC')->where('status', 1)->take(8)->get();
        return view('livewire.app.quotations.quotations-component', ['recomandedquations' => $recomandedquations, 'quationsliders' => $quationsliders, 'quationcategories' => $quationcategories, 'categoryquations' => $categoryquations])->layout('livewire.layouts.base');
    }
}
