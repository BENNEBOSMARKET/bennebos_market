<?php

namespace App\Http\Livewire\Admin\CompanyInfo;

use App\Imports\CompanyInfoImport;
use App\Models\CompanyInfo;
use App\Models\Country;
use App\Models\QueueFiles;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class CompanyInfoComponent extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;

    public $company_name, $category, $sub_category, $established, $proprietor, $telephone, $fax, $mobile, $website, $zip_code,$address,$state_id, $country_id, $email,$facebook,$twitter,$instragram,$linkedin, $logo, $description, $uploadedLogo;

    public $edit_id, $delete_id, $formStatus;

    public $excel;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    public function mount()
    {
        //
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'excel'=>'required',
        ]);
    }

    public function resetInputs()
    {
        $this->company_name = '';
        $this->category = '';
        $this->sub_category = '';
        $this->established = '';
        $this->proprietor = '';
        $this->telephone = '';
        $this->fax = '';
        $this->mobile = '';
        $this->website = '';
        $this->zip_code = '';
        $this->address = '';
        $this->country_id = '';
        $this->state_id = '';
        $this->email = '';
        $this->facebook = '';
        $this->twitter = '';
        $this->instragram = '';
        $this->linkedin = '';
        $this->logo = '';
        $this->description = '';

    }

    public function close()
    {
        $this->resetInputs();
    }

    public function storeData()
    {
        $this->validate([
            'company_name' => 'required',
            'category' => 'required',
            'country_id' => 'required',
        ]);

        $data = new CompanyInfo();
        $data->company_name = $this->company_name;
        $data->category = $this->category;
        $data->sub_category = $this->sub_category;
        $data->established = $this->established;
        $data->proprietor = $this->proprietor;
        $data->telephone = $this->telephone;
        $data->fax = $this->fax;
        $data->mobile = $this->mobile;
        $data->website = $this->website;
        $data->zip_code = $this->zip_code;
        $data->address = $this->address;
        $data->country_id = $this->country_id;
        $data->state_id = $this->state_id;

        $data->email = $this->email;
        $data->facebook = $this->facebook;
        $data->twitter = $this->twitter;
        $data->instragram = $this->instragram;
        $data->linkedin = $this->linkedin;
        $data->description = $this->description;

        $imageName = Carbon::now()->timestamp. '.' . $this->logo->extension();
        $this->logo->storeAs('imgs/company',$imageName, 's3');
        $data->logo = env('AWS_BUCKET_URL') . 'imgs/company/'.$imageName;

        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Company created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function editData($id)
    {
        $getData = CompanyInfo::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->company_name = $getData->company_name;
        $this->category = $getData->category;
        $this->sub_category = $getData->sub_category;
        $this->established = $getData->established;
        $this->proprietor = $getData->proprietor;
        $this->telephone = $getData->telephone;
        $this->fax = $getData->fax;
        $this->mobile = $getData->mobile;
        $this->website = $getData->website;
        $this->zip_code = $getData->zip_code;
        $this->address = $getData->address;
        $this->country_id = $getData->country_id;
        $this->state_id = $getData->state_id;

        $this->email = $getData->email;
        $this->facebook = $getData->facebook;
        $this->twitter = $getData->twitter;
        $this->instragram = $getData->instragram;
        $this->linkedin = $getData->linkedin;
        $this->description = $getData->description;
        $this->uploadedLogo = $getData->logo;

        $this->formStatus = 'Update';

        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'company_name' => 'required',
            'category' => 'required',
            'country_id' => 'required',
        ]);

        $data = CompanyInfo::where('id', $this->edit_id)->first();
        $data->company_name = $this->company_name;
        $data->category = $this->category;
        $data->sub_category = $this->sub_category;
        $data->established = $this->established;
        $data->proprietor = $this->proprietor;
        $data->telephone = $this->telephone;
        $data->fax = $this->fax;
        $data->mobile = $this->mobile;
        $data->website = $this->website;
        $data->zip_code = $this->zip_code;

        $data->address = $this->address;
        $data->country_id = $this->country_id;
        $data->state_id = $this->state_id;
        $data->email = $this->email;
        $data->facebook = $this->facebook;
        $data->twitter = $this->twitter;
        $data->instragram = $this->instragram;
        $data->linkedin = $this->linkedin;
        $data->description = $this->description;

        $data->logo = $this->uploadedLogo;

        if($this->logo != ''){
            $imageName = Carbon::now()->timestamp. '.' . $this->logo->extension();
            $this->logo->storeAs('imgs/company',$imageName, 's3');
            $data->logo = env('AWS_BUCKET_URL') . 'imgs/company/'.$imageName;
        }

        $data->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'Company updated successfully']);

        $this->resetInputs();
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = CompanyInfo::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('categoryDeleted');
        $this->resetInputs();

    }

    public function uploadExcel()
    {
        $this->validate([
            'excel'=>'required',
        ]);

        Excel::import(new CompanyInfoImport, $this->excel);

        Session::put('last_uploaded_info_csv', $this->excel->getClientOriginalName());

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'Info uploaded successfully!']);

        $this->excel = '';
    }

    public function resetPagination()
    {
        $this->resetPage();
    }

    public function render()
    {
        $companyinfos = CompanyInfo::where('company_name', 'like', '%'.$this->searchTerm.'%')->orderBy('id', 'DESC')->paginate($this->sortingValue);
        $countries = Country::all();
        $states = State::where('country_id', $this->country_id)->get();
        return view('livewire.admin.company-info.company-info-component', ['companyinfos' => $companyinfos, 'countries' => $countries, 'states' => $states])->layout('livewire.admin.layouts.base');
    }
}
