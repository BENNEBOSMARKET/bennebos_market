<?php

namespace App\Http\Livewire\Admin\Product\Review;

use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ReviewesComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm;

    public function publishStatus($id)
    {
        $review = Review::find($id);

        if ($review->status == 0) {
            $review->status = 1;
        } else {
            $review->status = 0;
        }
        $review->save();

        $this->dispatchBrowserEvent('success', ['message' => 'Published reviews updated successfully']);
    }

    public function render()
    {
        $productReviews = DB::table('reviews')->join('products','reviews.product_id','=','products.id')
            ->join('users','reviews.user_id','=','users.id')->select('reviews.id', 'reviews.product_id', 'reviews.user_id', 'reviews.rating', 'reviews.comments', 'reviews.status')->
        where('products.name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('reviews.rating', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('reviews.comment', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('users.name', 'LIKE', '%' . $this->searchTerm . '%')->
        orderBy('reviews.id', 'DESC')->paginate($this->sortingValue);


        return view('livewire.admin.product.review.reviewes-component', ['productReviews' => $productReviews])->layout('livewire.admin.layouts.base');
    }
}
