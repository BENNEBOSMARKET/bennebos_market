<?php

namespace App\Http\Livewire\App\Category;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class NewArrivalPageComponent extends Component
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
            $disProducts = Product::where('status', 1)->get();
            foreach($disProducts as $dspro){
                $categoryProducts1->push($dspro);
            }
            $newproducts = $categoryProducts1;
        }
        else{
            $categoryProducts = collect([]);
            $categories = [$this->category_id];
            
            $subcategories = Category::where('parent_id', $this->category_id)->get();
            foreach($subcategories as $subCat){
                array_push($categories, $subCat->id);
            }

            foreach($categories as $cat){
                $dproducts = Product::where('category_id', $cat)->where('status', 1)->get();

                foreach($dproducts as $dpro){
                    $categoryProducts->push($dpro);
                }
            }

            $newproducts = $categoryProducts;
        }
        

        if($this->sortType == 0){
            $newproducts = $newproducts->sortBy(function($item){
                return $item['unit_price'];
            });
        }
        if($this->sortType == 1){
            $newproducts = $newproducts->sortByDesc(function($item){
                return $item['unit_price'];
            });
        }
        if($this->sortType == ''){
            $newproducts = $newproducts->sortByDesc('id');
        }

        $newproducts = $newproducts->where('created_at', '>', now()->subDays(30)->endOfDay())->paginate($this->sortingValue);

        return view('livewire.app.category.new-arrival-page-component', ['newproducts'=>$newproducts, 'mainCategories'=>$mainCategories])->layout('livewire.layouts.base');
    }
}
