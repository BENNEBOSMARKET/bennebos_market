<?php

namespace App\Http\Livewire\App\Category;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class DiscountPageComponent extends Component
{
    use WithPagination;
    public $sortingValue = 20;

    public $category_id = 0, $tabStatus = 0, $sortType;

    public function selectCategory($value)
    {
        $this->category_id = $value;
        $this->tabStatus = $value;
        $this->resetPage();

    }

    public function render()
    {
        $mainCategories = Category::where('parent_id', 0)->where('sub_parent_id', 0)->take(6)->get();

        if($this->category_id == 0){
            $categoryProducts1 = collect([]);
            $disProducts = Product::where('discount', '!=', 0)->where('status', 1)->get();
            foreach($disProducts as $dspro){
                $categoryProducts1->push($dspro);
            }
            $discountProducts = $categoryProducts1;
        }
        else{
            $categoryProducts = collect([]);
            $categories = [$this->category_id];
            
            $subcategories = Category::where('parent_id', $this->category_id)->get();
            foreach($subcategories as $subCat){
                array_push($categories, $subCat->id);
            }

            foreach($categories as $cat){
                $dproducts = Product::where('discount', '!=', 0)->where('category_id', $cat)->where('status', 1)->get();

                foreach($dproducts as $dpro){
                    $categoryProducts->push($dpro);
                }
            }

            $discountProducts = $categoryProducts;
        }
        

        if($this->sortType == 0){
            $discountProducts = $discountProducts->sortBy(function($item){
                return discountPrice($item['id']);
            });
        }
        if($this->sortType == 1){
            $discountProducts = $discountProducts->sortByDesc(function($item){
                return discountPrice($item['id']);
            });
        }
        if($this->sortType == ''){
            $discountProducts = $discountProducts->sortByDesc('id');
        }

        $discountProducts = $discountProducts->paginate($this->sortingValue);

        return view('livewire.app.category.discount-page-component', ['discountProducts'=>$discountProducts, 'mainCategories'=>$mainCategories])->layout('livewire.layouts.base');
    }
}
