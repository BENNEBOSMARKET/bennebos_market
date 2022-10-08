<?php

namespace App\Http\Livewire\Customer\Review;

use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;

class ReviewComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm, $delete_id;
    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    public function render()
    {
        $my_reviews = Review::where('user_id', user()->id)->paginate($this->sortingValue);
        return view('livewire.customer.review.review-component', ['my_reviews'=>$my_reviews])->layout('livewire.layouts.base');
    }
}
