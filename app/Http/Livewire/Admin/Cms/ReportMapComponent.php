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

class ReportMapComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;

    public $name, $latitude, $longitude, $position, $slug, $vector_map;

    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed' => 'deleteData'];

    public function mount()
    {
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:report_maps,name,' . $this->edit_id . '',
            'latitude' => 'required',
            'longitude' => 'required',
            'position' => 'required',
            'vector_map' => 'required',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'name' => 'required|unique:report_maps',
            'latitude' => 'required',
            'longitude' => 'required',
            'position' => 'required',
            'vector_map' => 'required',
        ]);

        $data = new ReportMap();
        $data->name = $this->name;
        $data->slug = $this->slug;
        $data->latitude = $this->latitude;
        $data->longitude = $this->longitude;
        $data->position = $this->position;
        if ($this->vector_map != '') {
            $imageName = Carbon::now()->timestamp . '_svgmap.' . $this->vector_map->extension();
            $this->vector_map->storeAs('imgs/vector_maps', $imageName, 's3');
            $data->vector_map = env('AWS_BUCKET_URL') . 'imgs/vector_maps/' . $imageName;
        }
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
        $this->slug = '';
        $this->latitude = '';
        $this->longitude = '';
        $this->position = '';
        $this->vector_map = '';
    }


    public function editData($id)
    {
        $getData = ReportMap::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->name = $getData->name;
        $this->slug = $getData->slug;
        $this->latitude = $getData->latitude;
        $this->longitude = $getData->longitude;
        $this->position = $getData->position;

        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'name' => 'required|unique:report_maps,name,' . $this->edit_id . '',
            'latitude' => 'required',
            'longitude' => 'required',
            'position' => 'required',
        ]);

        $data = ReportMap::where('id', $this->edit_id)->first();
        $data->name = $this->name;
        $data->slug = $this->slug;
        $data->latitude = $this->latitude;
        $data->longitude = $this->longitude;
        $data->position = $this->position;
        if ($this->vector_map != '') {
            $imageName = Carbon::now()->timestamp . '_svgmap.svg';
            $this->vector_map->storeAs('imgs/vector_maps', $imageName, 's3');
            $data->vector_map = env('AWS_BUCKET_URL') . 'imgs/vector_maps/' . $imageName;
        }
        $data->save();

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message' => 'Country updated successfully']);

        $this->resetInputs();
    }

    public $country_name, $svg_map;
    public function showSVGMap($id)
    {
        $reportMap = ReportMap::where('id', $id)->first();

        $this->country_name = $reportMap->name;
        $this->svg_map = $reportMap->vector_map;

        $this->dispatchBrowserEvent('showSvgMap');
    }

    public $excel;
    public function uploadTradeProfile()
    {
        $this->validate([
            'excel' => 'required',
        ]);

        Excel::import(new TradeProfileImport, $this->excel);

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message' => 'Profiles imported successfully!']);

        $this->excel = '';
    }

    public function render()
    {
        $countries = ReportMap::orderBy('name', 'ASC')->paginate($this->sortingValue);
        $allCountries = Country::orderBy('name', 'ASC')->get();

        return view('livewire.admin.cms.report-map-component', ['countries' => $countries, 'allCountries' => $allCountries])->layout('livewire.admin.layouts.base');
    }
}
