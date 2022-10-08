<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Country;
use Livewire\Component;
use Jenssegers\Agent\Agent;

class CountryPhoneCodesComponent extends Component
{
    public function changePhoneCode($id, $code)
    {
        $country = Country::find($id);
        $country->phonecode = $code;
        $country->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Phone code updated successfully']);
    }

    public function getMac()
    {
        $agent = new Agent();

        $browser = $agent->browser();
        dd($agent->version($browser));
    }

    public function render()
    {
        $countries = Country::orderBy('name', 'ASC')->get();
        return view('livewire.admin.setting.country-phone-codes-component', ['countries'=>$countries])->layout('livewire.admin.layouts.base');
    }
}
