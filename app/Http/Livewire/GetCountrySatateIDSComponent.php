<?php

namespace App\Http\Livewire;

use App\Models\Country;
use App\Models\State;
use Livewire\Component;

class GetCountrySatateIDSComponent extends Component
{
    public $country, $state;

    public function render()
    {
        $countries = Country::where('name', 'like', '%'.$this->country.'%')->get();
        $states = State::where('name', 'like', '%'.$this->state.'%')->get();

        return view('livewire.get-country-satate-i-d-s-component', ['countries'=>$countries, 'states'=>$states])->layout('livewire.layouts.demobase');
    }
}
