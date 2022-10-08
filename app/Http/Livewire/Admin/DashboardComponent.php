<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;

class DashboardComponent extends Component
{
    public function render()
    {
        $products = Product::orderBy('id', 'DESC')->take(6)->get();
        return view('livewire.admin.dashboard-component', ['products'=>$products])->layout('livewire.admin.layouts.base');
    }
}
