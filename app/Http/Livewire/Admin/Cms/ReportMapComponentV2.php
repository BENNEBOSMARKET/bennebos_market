<?php

namespace App\Http\Livewire\Admin\Cms;

use App\Models\Country;
use App\Models\ReportMapv2;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use App\Models\ReportImportCountry;
use App\Models\ReportExportCountry;

class ReportMapComponentV2 extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;

    public $country, $country_code, $value, $slug, $vector_map;

    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteMap'];

    public function mount()
    {
 
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->country);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'country' => 'required|unique:report_mapv2s,country,'.$this->edit_id.'',
            'country_code' => 'required',
            'value' => 'required',
            'vector_map' => 'required',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'country' => 'required|unique:report_mapv2s',
            'country_code' => 'required',
            'value' => 'required',
            'vector_map' => 'required',
            
        ]);

        $data = new ReportMapv2();
        $data->country = $this->country;
        $data->slug = $this->slug;
        $data->country_code = $this->country_code;
        $data->value = $this->value;
        if($this->vector_map != ''){
            $imageName = Carbon::now()->timestamp. '_svgmap.svg';
            $this->vector_map->storeAs('imgs/vector_maps',$imageName, 's3');
            $data->vector_map = env('AWS_BUCKET_URL') . 'imgs/vector_maps/'.$imageName;
        }
        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Country added successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->edit_id = '';
        $this->delete_id = '';
        $this->country = '';
        $this->slug = '';
        $this->country_code = '';
        $this->value = '';
    }


    public function editData($id)
    {
        $getData = ReportMapv2::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->country = $getData->country;
        $this->slug = $getData->slug;
        $this->country_code = $getData->country_code;
        $this->value = $getData->value;

        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'country' => 'required|unique:report_mapv2s,country,'.$this->edit_id.'',
            'country_code' => 'required',
            'value' => 'required',
        ]);

        $data = ReportMapV2::where('id', $this->edit_id)->first();
        $data->country = $this->country;
        $data->slug = $this->slug;
        $data->country_code = $this->country_code;
        $data->value = $this->value;
        if($this->vector_map != ''){
            $imageName = Carbon::now()->timestamp. '_svgmap.svg';
            $this->vector_map->storeAs('imgs/vector_maps',$imageName, 's3');
            $data->vector_map = env('AWS_BUCKET_URL') . 'imgs/vector_maps/'.$imageName;
        }
        $data->save();

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'Country updated successfully']);

        $this->resetInputs();
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteMap()
    {
        $data = ReportMapv2::find($this->delete_id);

        $impdata = ReportImportCountry::where('report_map_id', $this->delete_id)->get();
        foreach($impdata as $imp){
            $im = ReportImportCountry::find($imp->id);
            $im->delete();
        }

        $expdata = ReportExportCountry::where('report_map_id', $this->delete_id)->get();
        foreach($expdata as $exp){
            $ex = ReportExportCountry::find($exp->id);
            $ex->delete();
        }

        $data->delete();

        $this->dispatchBrowserEvent('success', ['message'=>'Map country deleted successfully']);


    }

    public $profile, $profileImportDetails, $profileExportDetails;
    public function showData($id)
    {
        $getData = ReportMapv2::where('id', $id)->first();
        $this->profile = $getData;

        $this->dispatchBrowserEvent('showProfile');
    }

    public $details_country, $details_value, $details_type;
    public function storeDetails()
    {
        $this->validate([
            'details_country' => 'required',
            'details_type' => 'required',
            'details_value' => 'required',
        ]);

        if($this->details_type == 'import'){
            $getVal = ReportImportCountry::where('country', $this->details_country)->get();
            if($getVal->count() > 0){
                $this->dispatchBrowserEvent('error', ['message'=>'Already added']);
            }
            else{
                
                $data = new ReportImportCountry();
                $data->report_map_id = $this->profile->id;
                $data->country = $this->details_country;
                $data->trade_value = $this->details_value;
                $data->save();

                $this->dispatchBrowserEvent('success', ['message'=>'Import data added successfully']);
            
            }
        }
        if($this->details_type == 'export'){
            $getVal = ReportExportCountry::where('country', $this->details_country)->get();
            if($getVal->count() > 0){
                $this->dispatchBrowserEvent('error', ['message'=>'Already added']);
            }
            else{
                
                $data = new ReportExportCountry();
                $data->report_map_id = $this->profile->id;
                $data->country = $this->details_country;
                $data->trade_value = $this->details_value;
                $data->save();

                $this->dispatchBrowserEvent('success', ['message'=>'Export data added successfully']);
            
            }
        }

        $this->details_country = '';
        $this->details_type = '';
        $this->details_value = '';
    }

    public function deleteImp($id)
    {
        $data = ReportImportCountry::find($id);
        $data->delete();
        $this->dispatchBrowserEvent('success', ['message'=>'Import data deleted successfully']);
    }
    public function deleteExp($id)
    {
        $data = ReportExportCountry::find($id);
        $data->delete();
        $this->dispatchBrowserEvent('success', ['message'=>'Export data deleted successfully']);
    }


    public function render()
    {
        $countries = ReportMapV2::orderBy('country', 'ASC')->paginate($this->sortingValue);
        $allCountries = Country::orderBy('name', 'ASC')->get();

        if($this->profile != ''){
            $this->profileImportDetails = ReportImportCountry::where('report_map_id', $this->profile->id)->get();
            $this->profileExportDetails = ReportExportCountry::where('report_map_id', $this->profile->id)->get();
        }

        return view('livewire.admin.cms.report-map-component-v2', ['countries'=>$countries, 'allCountries'=>$allCountries])->layout('livewire.admin.layouts.base');
    }
}
