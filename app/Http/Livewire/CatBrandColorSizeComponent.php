<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use Livewire\Component;

class CatBrandColorSizeComponent extends Component
{
    public function render()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();

        return view('livewire.cat-brand-color-size-component', ['categories'=>$categories, 'brands'=>$brands, 'colors'=>$colors])->layout('livewire.layouts.demobase');
    }
}
