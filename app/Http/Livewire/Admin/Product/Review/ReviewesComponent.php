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
        $productReviews = DB::table('reviews')->select('id', 'product_id', 'user_id', 'rating', 'comments', 'status')->
       where('rating', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('comment', 'LIKE', '%' . $this->searchTerm . '%')
            ->orderBy('id', 'DESC')->paginate($this->sortingValue);


        return view('livewire.admin.product.review.reviewes-component', ['productReviews' => $productReviews])->layout('livewire.admin.layouts.base');
    }
}
