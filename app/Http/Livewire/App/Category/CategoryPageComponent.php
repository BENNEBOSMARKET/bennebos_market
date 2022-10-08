<?php

namespace App\Http\Livewire\App\Category;

use Livewire\Component;

class CategoryPageComponent extends Component
{
    public function render()
    {
        return view('livewire.app.category.category-page-component')->layout('livewire.layouts.base');
    }
}
