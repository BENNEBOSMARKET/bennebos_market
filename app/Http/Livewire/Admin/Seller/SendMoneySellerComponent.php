<?php

namespace App\Http\Livewire\Admin\Seller;

use App\Models\Admin;
use App\Models\Photo;
use App\Models\Seller;
use App\Models\SendMoneySeller;
use App\Models\Slider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SendMoneySellerComponent extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;
    public $seller, $money, $description;
    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    private static function paginate($sortingValue)
    {
    }

    public function storeData()
    {
        $this->validate([

            'seller' => 'required',
            'money' => 'required',
        ]);


        $data = new SendMoneySeller();



//        $data->banner =  $imageName;
        $data->seller_id = $this->seller;
        $data->money = $this->money;
        $data->description = $this->description;

        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>' created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }
    public function resetInputs()
    {
        $this->seller = '';
        $this->money = '';
        $this->description = '';

    }

    public function editData($id)
    {
        $getData = SendMoneySeller::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->seller = $getData->seller_id;
        $this->money = $getData->money;
        $this->description = $getData->description;

        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'seller' => 'required',
            'money' => 'required',
        ]);

        $data = SendMoneySeller::where('id', $this->edit_id)->first();
        $data->seller_id = $this->seller;
        $data->money = $this->money;
        $data->description = $this->description;



        $data->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>' updated successfully']);
        $this->resetInputs();
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = SendMoneySeller::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('sliderDeleted');
        $this->resetInputs();

    }
    public function render()
    {
        $sellers=Seller::all();
        $sellerMoneys = SendMoneySeller::where('money', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('description', 'LIKE', '%' . $this->searchTerm . '%')->paginate($this->sortingValue);
        return view('livewire.admin.seller.send-money-seller-component', ['sellerMoneys' => $sellerMoneys,'sellers'=>$sellers])->layout('livewire.admin.layouts.base');
        }
    }
