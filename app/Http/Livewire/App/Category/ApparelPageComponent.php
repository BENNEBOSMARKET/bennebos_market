<?php

namespace App\Http\Livewire\App\Category;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ApparelPageComponent extends Component
{
    use WithPagination;
    public $sortingValue = 20;

    public function render()
    {
        // $db =  DB::table('products')
        // ->leftJoin('products_descriptions', "products.id", 'products_descriptions.product_id')
        // ->leftJoin('items_languages', "items_languages.id", 'products_descriptions.language_id')
        // ->where('items_languages.local', session()->get('locale'));
        $db =  DB::table('products');
        $apparelproducts = $db
        ->whereIn('status', 1)
        ->select("products.slug", "products.unit_price","products.id","products.name","products.thumbnail")
        ->orderBy('created_at', 'DESC')
        ->paginate($this->sortingValue);
        return view('livewire.app.category.apparel-page-component', ['apparelproducts'=>$apparelproducts])->layout('livewire.layouts.base');
    }
}