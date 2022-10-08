<?php

namespace App\Http\Livewire\App\Quotations;

use App\Models\Country;
use App\Models\Qutotation;
use App\Models\QutotationCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class RFQComponent extends Component
{
    use WithFileUploads;

    public $name, $slug, $category_id, $user_id, $sourcing, $sourcing_type, $quantity = 1, $piece = 'Pieces', $trade_terms, $max_budget, $curency, $repitation, $days, $duration, $details, $file, $shipping_method, $country, $lead_time, $payment_method;

    
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name).'-'.Str::random(7);
    }

    public function decrease()
    {
        if($this->quantity > 1){
            $this->quantity -= 1;
        }
    }

    public function increase()
    {
        $this->quantity += 1;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'requiredunique:qutotations',
            'category_id' => 'required',
            'sourcing' => 'required',
            'quantity' => 'required',
            'max_budget' => 'required',
            'curency' => 'required',
        ]);
    }


    public function storeData()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:qutotations',
            'category_id' => 'required',
            'sourcing' => 'required',
            'quantity' => 'required',
            'max_budget' => 'required',
            'curency' => 'required',
        ]);

        $data = new Qutotation();
        $data->name = $this->name;
        $data->slug = $this->slug;
        $data->category_id = $this->category_id;
        $data->user_id = Auth::user()->id;
        $data->sourcing = $this->sourcing;
        $data->sourcing_type = $this->sourcing_type;
        $data->quantity = $this->quantity;
        $data->piece = $this->piece;
        $data->trade_terms = $this->trade_terms;
        $data->max_budget = $this->max_budget;
        $data->curency = $this->curency;
        $data->repitation = $this->repitation;
        $data->days = $this->days;
        $data->duration = $this->duration;
        $data->details = $this->details;
        $data->shipping_method = $this->shipping_method;
        $data->country = $this->country;
        $data->lead_time = $this->lead_time;
        $data->payment_method = $this->payment_method;

        if($this->file){
            $imageName = Carbon::now()->timestamp. '.' . $this->file->extension();
            $this->file->storeAs('rfq',$imageName);
            $data->image = url('/').'/uploads/rfq/'.$imageName;
        }

        $data->save();
        $this->dispatchBrowserEvent('success', ['message'=>'Qutotation Submited successfully']);
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->name = '';
        $this->slug = '';
        $this->category_id = '';
        $this->user_id = '';
        $this->sourcing = '';
        $this->sourcing_type = '';
        $this->quantity = '';
        $this->piece = '';
        $this->trade_terms = '';
        $this->max_budget = '';
        $this->curency = '';
        $this->repitation = '';
        $this->days = '';
        $this->duration = '';
        $this->details = '';
        $this->shipping_method = '';
        $this->country = '';
        $this->lead_time = '';
        $this->payment_method = '';
    }

    public function render()
    {
        $qutationCategory = QutotationCategory::orderBy('id', 'DESC')->get();
        $countries = Country::orderBy('name', 'ASC')->get();
        return view('livewire.app.quotations.r-f-q-component', ['qutationCategory'=>$qutationCategory, 'countries'=>$countries])->layout('livewire.layouts.base');
    }
}
