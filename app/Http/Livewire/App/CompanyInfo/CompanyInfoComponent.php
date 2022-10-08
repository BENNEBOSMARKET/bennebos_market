<?php

namespace App\Http\Livewire\App\CompanyInfo;

use App\Models\CompanyCategory;
use App\Models\CompanyInfo;
use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Str;

class CompanyInfoComponent extends Component
{
    use WithPagination;
    public $country_id, $state, $searchTerm, $category, $sub_category;

    public function mount()
    {
        $ip = request()->ip();
        $location = Location::get($ip);
        if($location == false){
            $this->country_id = 223;
        }
        else{
            $this->country_id = Country::where('name', $location->countryName)->first()->id;
        }
        
    }

    public function selectCountry()
    {
        $this->resetPage();
    }
    public function selectCategory()
    {
        $this->resetPage();
    }

    public function render()
    {
        $countries = Country::all();
        $states = State::where('country_id', $this->country_id)->get();

        DB::statement("SET SQL_MODE=''");
        $info = CompanyInfo::where('id', '!=', '');

        if($this->country_id != ''){
            $info = $info->where('country_id', $this->country_id);
        }
        if($this->state != ''){
            $info = $info->where('state_id', $this->state);
        }

        if($this->category != ''){
            $info = $info->where('category', $this->category);
        }

        if($this->sub_category != ''){
            $info = $info->where('sub_category', $this->sub_category);
        }

        $infos = $info->where('company_name', 'like', '%'.$this->searchTerm.'%')->orderBy('social_media_count', 'DESC')->paginate(10);
        $categories = CompanyCategory::all();
        $sub_categories = CompanyInfo::where('category', $this->category)->groupBy('sub_category')->get();

        return view('livewire.app.company-info.company-info-component', ['countries'=>$countries, 'states'=>$states, 'infos'=>$infos, 'categories'=>$categories, 'sub_categories'=>$sub_categories])->layout('livewire.layouts.base');
    }
}
