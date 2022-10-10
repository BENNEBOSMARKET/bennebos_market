<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use App\Models\CategoryTranslation;
use Livewire\Component;

class CategoryTranslationComponent extends Component
{
    public $category_id, $category, $name, $language, $edit_id;

    public function mount($id)
    {
        $this->category_id = $id;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'language' => 'required',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'name' => 'required',
            'language' => 'required',
        ]);
        $getData = CategoryTranslation::where('category_id', $this->category_id)->where('lang', $this->language)->first();

        if(!$getData){
            $data = new CategoryTranslation();
            $data->category_id = $this->category_id;
            $data->name = $this->name;
            $data->lang = $this->language;
            $data->save();

            $this->dispatchBrowserEvent('closeModal');
            $this->dispatchBrowserEvent('success', ['message'=>'New translation added successfully']);
            $this->resetInputs();
        }
        else{
            $this->dispatchBrowserEvent('error', ['message'=>'Translation already exists']);
        }
    }

    public function editData($id)
    {
        $data = CategoryTranslation::find($id);
        $this->name = $data->name;
        $this->language = $data->lang;
        $this->edit_id = $data->id;

        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'name' => 'required',
            'language' => 'required',
        ]);
        $getData = CategoryTranslation::where('category_id', $this->category_id)->where('lang', $this->language)->where('id', '!=', $this->edit_id)->first();

        if(!$getData){
            $data = CategoryTranslation::find($this->edit_id);
            $data->category_id = $this->category_id;
            $data->name = $this->name;
            $data->lang = $this->language;
            $data->save();

            $this->dispatchBrowserEvent('closeModal');
            $this->dispatchBrowserEvent('success', ['message'=>'Translation updated successfully']);
            $this->resetInputs();
        }
        else{
            $this->dispatchBrowserEvent('error', ['message'=>'Translation already exists']);
        }
    }

    public function close()
    {
        $this->resetInputs();
    }
    public function resetInputs()
    {
        $this->name = '';
        $this->language = '';
    }

    public function render()
    {
        $this->category = Category::find($this->category_id);

        $translations = CategoryTranslation::where('category_id', $this->category_id)->get();

        return view('livewire.admin.category.category-translation-component', ['translations'=>$translations])->layout('livewire.admin.layouts.base');
    }
}
