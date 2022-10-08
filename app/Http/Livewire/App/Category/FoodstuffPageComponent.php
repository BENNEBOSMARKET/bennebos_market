<?php

namespace App\Http\Livewire\App\Category;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class FoodstuffPageComponent extends Component
{
    use WithPagination;
    public $sortingValue = 20;

    public function render()
    {
        $foodstaffs = Product::where('status', 1)->orderBy('created_at', 'ASC')->inRandomOrder()->paginate($this->sortingValue);
        return view('livewire.app.category.foodstuff-page-component', ['foodstaffs'=>$foodstaffs])->layout('livewire.layouts.base');
    }
}
