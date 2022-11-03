<?php

namespace App\Http\Livewire\Admin\Cms;

use App\Imports\TradeProfileImport;
use App\Models\Country;
use App\Models\ReportMap;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class   ReportMapComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;

    public $name, $latitude, $longitude;

    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed' => 'deleteData'];

    public function mount()
    {
    }



    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:report_maps,name,' . $this->edit_id . '',
            'latitude' => 'required',
            'longitude' => 'required',

        ]);
    }

    public function storeData()
    {
        $this->validate([
            'name' => 'required|unique:report_maps',
            'latitude' => 'required',
            'longitude' => 'required',

        ]);

        $data = new Country();
        $data->name = $this->name;
        $data->latitude = $this->latitude;
        $data->longitude = $this->longitude;


        $data->save();

        $this->dispatchBrowserEvent('success', ['message' => 'Country added successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->edit_id = '';
        $this->delete_id = '';
        $this->name = '';
        $this->latitude = '';
        $this->longitude = '';
    }


    public function editData($id)
    {
        $getData = Country::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->name = $getData->name;
        $this->latitude = $getData->latitude;
        $this->longitude = $getData->longitude;


        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'name' => 'required|unique:countries,name,' . $this->edit_id . '',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $data = Country::where('id', $this->edit_id)->first();
        $data->name = $this->name;
        $data->latitude = $this->latitude;
        $data->longitude = $this->longitude;


        $data->save();

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message' => 'Country updated successfully']);

        $this->resetInputs();
    }

//    public $country_name, $svg_map;
//    public function showSVGMap($id)
//    {
//        $reportMap = ReportMap::where('id', $id)->first();
//
//        $this->country_name = $reportMap->name;
//        $this->svg_map = $reportMap->vector_map;
//
//        $this->dispatchBrowserEvent('showSvgMap');
//    }
//
//    public $excel;
//    public function uploadTradeProfile()
//    {
//        $this->validate([
//            'excel' => 'required',
//        ]);
//
//        Excel::import(new TradeProfileImport, $this->excel);
//
//        $this->dispatchBrowserEvent('closeModal');
//        $this->dispatchBrowserEvent('success', ['message' => 'Profiles imported successfully!']);
//
//        $this->excel = '';
//    }

    public function render()
    {
        $countries = Country::where('name', 'LIKE', '%' . $this->searchTerm . '%')
                    ->orWhere('latitude', 'LIKE', '%' . $this->searchTerm . '%')
                    ->orWhere('longitude', 'LIKE', '%' . $this->searchTerm . '%')
                    ->orWhere('sortname', 'LIKE', '%' . $this->searchTerm . '%')
                    ->orderBy('name', 'ASC')->paginate($this->sortingValue);

        $allCountries = Country::orderBy('name', 'ASC')->get();

        return view('livewire.admin.cms.report-map-component', ['countries' => $countries, 'allCountries' => $allCountries])->layout('livewire.admin.layouts.base');
    }
}
