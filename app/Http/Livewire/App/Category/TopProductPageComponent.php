<?php

namespace App\Http\Livewire\App\Category;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class TopProductPageComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $topProducts = Product::where('status', 1)->orderBy('created_at', 'ASC')->paginate(20);
        return view('livewire.app.category.top-product-page-component', ['topProducts'=>$topProducts])->layout('livewire.layouts.base');
    }
}
