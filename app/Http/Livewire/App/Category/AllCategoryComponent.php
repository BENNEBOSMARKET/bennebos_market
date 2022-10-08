<?php

namespace App\Http\Livewire\App\Category;

use App\Models\Category;
use Livewire\Component;

class AllCategoryComponent extends Component
{
    public $tabStatus = 0, $selectedCategory;

    public function selectCategory($id)
    {
        $this->selectedCategory = Category::where('id', $id)->first();

        $this->tabStatus = $id;
    }

    public function render()
    {
        $maincategories = Category::where('parent_id', 0)->where('sub_parent_id', 0)->get();

        return view('livewire.app.category.all-category-component', ['maincategories'=>$maincategories])->layout('livewire.layouts.base');
    }
}
