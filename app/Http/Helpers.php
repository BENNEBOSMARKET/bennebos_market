<?php

use App\Models\Cart;
use App\Models\Shop;
use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Point;
use App\Models\State;
use App\Models\Refund;
use App\Models\Review;
use App\Models\Seller;
use App\Models\Wallet;
use App\Models\Address;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use App\Models\QuoteNow;
use App\Models\WishList;
use App\Models\DealsOfDay;
use App\Models\ProductSize;
use App\Models\OrderDetails;
use App\Models\ProductImage;
use App\Models\SellerWallet;
use App\Models\WebsiteSetting;
use App\Models\BusinessSetting;
use App\Models\CompanyCategory;
use App\Models\QutotationCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Laravel\Passport\Client as PassportClient;

function admin()
{
    return Auth::guard('admin')->user();
}

function user()
{
    return Auth::guard('web')->user();
}

function authSeller()
{
    return Auth::guard('seller')->user();
}

function getPassportClient()
{
    return PassportClient::where("password_client", 1)->first();
}

function getUser($id)
{
    return User::where('id', $id)->first();
}

function seller($id)
{
    return Seller::where('id', $id)->first();
}

function sellerWallet($id)
{
    return SellerWallet::where('seller_id', $id)->first();
}

function wishList($id)
{
    $wisgList = WishList::where('product_id', $id)->get()->count();
    return $wisgList;
}

function brand($id)
{
    return Brand::where('id', $id)->first();
}

function orderProductCount($id)
{
    return OrderDetails::where('order_id', $id)->get()->count();
}

function loadingState($key, $title)
{
    $loadingSpinner = '
        <div wire:loading wire:target="' . $key . '" wire:key="' . $key . '"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> loading</div>
        <div wire:loading.remove wire:target="' . $key . '" wire:key="' . $key . '">' . $title . '</div>
    ';

    return $loadingSpinner;
}

function statusLoadingState($key)
{
    $loadingSpinner = '
        <div style="position: absolute; padding: 5px 5px 0px 0px;" wire:loading wire:target="' . $key . '" wire:key="' . $key . '"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>
    ';

    return $loadingSpinner;
}

function loadingStateWithText($key, $title)
{
    $loadingSpinner = '
        <div wire:loading wire:target="' . $key . '" wire:key="' . $key . '"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div> ' . $title . '
    ';

    return $loadingSpinner;
}

function loadingStateWithProcess($key, $title)
{
    $loadingSpinner = '
        <div wire:loading wire:target="' . $key . '" wire:key="' . $key . '"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>
        <span wire:loading wire:target="' . $key . '" wire:key="' . $key . '">Processing</span>
        <div wire:loading.remove wire:target="' . $key . '" wire:key="' . $key . '">' . $title . '</div>
    ';

    return $loadingSpinner;
}

function processing($key, $title)
{
    $loadingSpinner = '
        <div wire:loading wire:target="' . $key . '" wire:key="' . $key . '"><i class="fa fa-spinner fa-spin"></i></div>
        <span wire:loading wire:target="' . $key . '" wire:key="' . $key . '">Processing</span>
        <div wire:loading.remove wire:target="' . $key . '" wire:key="' . $key . '">' . $title . '</div>
    ';

    return $loadingSpinner;
}

function galleryImages($productId)
{
    $images = ProductImage::where('product_id', $productId)->get();

    return $images;
}

function subCategories($category_id)
{
    return Category::where('parent_id', $category_id)->where('sub_parent_id', 0)->get();
}

function subSubCategories($category_id)
{
    return Category::where('sub_parent_id', $category_id)->limit(6)->get();
}

function product($id)
{
    return Product::where('id', $id)->first();
}

function customer($id)
{
    return User::where('id', $id)->first();
}

function category($id)
{
    return Category::where('id', $id)->first();
}

function discountPrice($id)
{
    $product = Product::where('id', $id)->first();
    $discountPrice = $product->unit_price - (($product->unit_price * $product->discount) / 100);

    return round($discountPrice, 2);
}

function calculateDiscount($unitPrice, $discount)
{
    $discountPrice = $unitPrice - (($unitPrice * $discount) / 100);
    return round($discountPrice, 2);
}


function categoryTotalProducts($id)
{
    $totalProduct = 0;
    $subSubProducts = 0;
    $subProducts = 0;
    $products = 0;
    $cat = Category::where('id', $id)->first();
    if ($cat->parent_id == 0 && $cat->sub_parent_id == 0) {
        $subs = Category::where('parent_id', $cat->id)->where('sub_parent_id', 0)->get();
        $products = Product::where('category_id', $cat->id)->where('status', 1)->get()->count();
        foreach ($subs as $sub) {
            $getS = Product::where('category_id', $sub->id)->where('status', 1)->get()->count();
            $subProducts = $subProducts + $getS;

            $subsubs = Category::where('parent_id', $cat->id)->where('sub_parent_id', $sub)->get();
            foreach ($subsubs as $subsub) {
                $getSS = Product::where('category_id', $subsub->id)->where('status', 1)->get()->count();
                $subSubProducts = $subSubProducts + $getSS;
            }
        }
    } else if ($cat->parent_id != 0 && $cat->sub_parent_id == 0) {
        $subProducts = Product::where('category_id', $cat->id)->where('status', 1)->get()->count();

        $subsubs = Category::where('parent_id', 0)->where('sub_parent_id', $cat->id)->get();
        foreach ($subsubs as $subsub) {
            $getSS = Product::where('category_id', $subsub->id)->where('status', 1)->get()->count();
            $subSubProducts = $subSubProducts + $getSS;
        }
    } else if ($cat->parent_id != 0 && $cat->sub_parent_id != 0) {
        $subSubProducts = Product::where('category_id', $cat->id)->where('status', 1)->get()->count();
    }


    $totalProduct = $products + $subProducts + $subSubProducts;

    return $totalProduct;
}

function mainCatTotalProducts($id)
{
    $totalProduct = 0;

    $categories = [$id];

    $subcategories = DB::table('categories')->where('parent_id', $id)->pluck("id")->toArray();
    $categories = array_merge($categories, $subcategories);
    $subsubcategories = DB::table('categories')->whereIn('sub_parent_id', $categories)->pluck("id")->toArray();
    $categories = array_merge($categories, $subsubcategories);

    $totalProduct = DB::table("products")->whereIn('category_id', $categories)->where('status', 1)->get()->count();

    return $totalProduct;
}

function brandTotalProducts($id)
{
    $totalProduct = Product::where('brand_id', $id)->where('status', 1)->get()->count();
    return $totalProduct;
}

function checkIfWishlisted($id)
{
    $data = 0;
    if (Auth::guard('web')->user()) {
        $data = WishList::where('product_id', $id)->where('user_id', user()->id)->get()->count();
    }

    return $data;
}

function getAddress($id)
{
    $address = Address::where('id', $id)->first();

    return $address;
}

function order($id)
{
    $order = Order::where('id', $id)->first();

    return $order;
}


function subOrderItem($id)
{
    $subOrderItem = OrderDetails::where('id', $id)->first();

    return $subOrderItem;
}

function subOrderItems($id)
{
    return OrderDetails::where('sub_order_id', $id)->get();
}

function companyCountry($id)
{
    return Country::where('id', $id)->first();


}

function companyCategory($id)
{

    return CompanyCategory::where('category_id', $id)->first()->name;


}

function setting()
{
    return WebsiteSetting::where('id', 1)->first();
}

function country($id)
{
    return Country::where('id', $id)->first();


}

function state($id)
{
    return State::where('id', $id)->first();

}

function shop($seller_id)
{
    return Shop::where('seller_id', $seller_id)->first();


}


function sellerProducts($seller_id)
{
    return Product::where('user_id', $seller_id)->get();
}


function productGalleryImages($product_id, $sl)
{
    $images = ProductImage::where('product_id', $product_id)->get();
    // $gallery = '';
    // foreach ($images as $key => $data){
    //     if($key == $sl){
    //         $gallery = $data;
    //     }
    // }

    return $images[$sl]->image;
}

function productColorSizes($product_id, $sl)
{
    $sizes = ProductSize::where('product_id', $product_id)->get();
    // $gallery = '';
    // foreach ($sizes as $key => $data){
    //     if($key == $sl){
    //         $gallery = $data;
    //     }
    // }

    return $sizes[$sl]->size;
}

function obfuscate_email($email)
{
    $em = explode("@", $email);
    $name = implode('@', array_slice($em, 0, count($em) - 1));
    $len = strlen($name);

    return str_repeat('*', ($len * 2)) . "@" . end($em);
}


function product_review($id)
{
    $reviews = Review::where('product_id', $id)->get()->count();
    return $reviews;
}

function product_star_review($value)
{
    $total_star = $value;
    $rem_star = (5 - $value);

    $activestar = '<i class="fa fa-star active_stars"></i>';
    $inactivestar = '<i class="fa fa-star inactive_stars"></i>';

    $html = str_repeat($activestar, $total_star);
    $html .= str_repeat($inactivestar, $rem_star);

    return $html;
}

function product_avg_review($id)
{
    $total_review = Review::where('product_id', $id)->get()->count();
    $sum_of_reviews = Review::where('product_id', $id)->get()->sum('rating');

    if ($total_review != 0) {
        $avg = $sum_of_reviews / $total_review;
    } else {
        $avg = 0;
    }

    return round($avg, 1);
}


function avgReview($totalReview, $sumOfReviews)
{
    if ($totalReview != 0 && $totalReview != null) {
        $avg = $sumOfReviews / $totalReview;
    } else {
        $avg = 0;
    }
    return round($avg, 1);
}


function getProductKeyValue($product, $key)
{

    if (count($product->productDetails)) {
        return $product->productDetails[0]->$key;
    }

    return $product->$key ?? '';
}

function seller_review($seller_id)
{
    $total_review = 0;

    $products = Product::where('user_id', $seller_id)->get();

    foreach ($products as $product) {
        $total_review += product_review($product->id);
    }

    return $total_review;
}

function seller_avg_review($seller_id)
{
    $total_review = 0;
    $sum_of_reviews = 0;

    $products = Product::where('user_id', $seller_id)->get();

    foreach ($products as $product) {
        $total_review += product_review($product->id);
        $sum_of_reviews += Review::where('product_id', $product->id)->get()->sum('rating');
    }

    if ($total_review != 0) {
        $avg = $sum_of_reviews / $total_review;
    } else {
        $avg = 0;
    }


    return round($avg, 1);
}

function avarage_review($id)
{
    $reviews = Review::where('product_id', $id)->get();

    $total_star = $reviews->sum('rating');
    $total_review = $reviews->count();

    if ($total_review > 0) {
        $avarage_star = $total_star / $total_review;
    } else {
        $avarage_star = 0;
    }
    $remaining = 5 - round($avarage_star);

    $activestar = '<i class="fa fa-star active_stars"></i>';
    $inactivestar = '<i class="fa fa-star inactive_stars"></i>';

    $html = str_repeat($activestar, round($avarage_star));
    $html .= str_repeat($inactivestar, $remaining);

    return $html;
}

function single_avarage_review($user_id, $product_id)
{
    $reviews = Review::where('product_id', $product_id)->where('user_id', $user_id)->first();

    $total_star = $reviews->rating;

    $remaining = 5 - $total_star;

    $activestar = '<i class="fa fa-star active_stars"></i>';
    $inactivestar = '<i class="fa fa-star inactive_stars"></i>';

    $html = str_repeat($activestar, $total_star);
    $html .= str_repeat($inactivestar, $remaining);

    return $html;
}

function user_avarage_review($review_id)
{
    $reviews = Review::where('id', $review_id)->first();

    $total_star = $reviews->rating;

    $remaining = 5 - $total_star;

    $activestar = '<i class="fa fa-star active_stars"></i>';
    $inactivestar = '<i class="fa fa-star inactive_stars"></i>';

    $html = str_repeat($activestar, $total_star);
    $html .= str_repeat($inactivestar, $remaining);

    return $html;
}

function quotationCategory($id)
{
    return QutotationCategory::where('id', $id)->first();
}

function sellerOrders($seller_id)
{
    return Order::where('seller_id', $seller_id)->get();
}

function subCategoryProducts($id)
{
    $categories = [$id];
    $subcategories = DB::table('categories')->where('sub_parent_id', $id)->pluck("id")->toArray();
    $categories = array_merge($categories, $subcategories);

    $allProducts = DB::table('products')->whereIn('category_id', $categories)
        ->where('category_pinned', 1)
        ->where('status', 1)
        ->select('id', 'name', 'slug', 'thumbnail', 'discount', 'unit_price')
        ->orderBy('updated_at', 'DESC')
        ->limit(18)
        ->get();

    return $allProducts;
}

function subCategoryFeaturedProducts($id)
{
    $categories = [$id];
    $subcategories = DB::table('categories')->where('sub_parent_id', $id)->pluck("id")->toArray();
    $categories = array_merge($categories, $subcategories);

    $allProducts = DB::table('products')->whereIn('category_id', $categories)
        ->where('category_featured', 1)
        ->where('status', 1)
        ->select('slug', 'thumbnail')
        ->orderBy('updated_at', 'DESC')
        ->limit(6)
        ->get();

    return $allProducts;
}

function subCategoryFeaturedBrands($id)
{
    $category = Category::find($id);

    $brands = Brand::whereIn('id', json_decode($category->brands))->get();

    return $brands;
}

function mainCategoryProduct($id)
{
    $categories = [$id];

    $subcategories = DB::table('categories')->where('parent_id', $id)->where('sub_parent_id', 0)->pluck("id")->toArray();
    $categories = array_merge($categories, $subcategories);
    $subsubcategories = DB::table('categories')->whereIn('sub_parent_id', $subcategories)->pluck("id")->toArray();
    $categories = array_merge($categories, $subsubcategories);

    $allProducts = DB::table('products')->whereIn('category_id', $categories)->get();

    return $allProducts->count();
}

function subCategoryProduct($id)
{
    $categories = [$id];
    $subcategories = DB::table('categories')->where('sub_parent_id', $id)->pluck("id")->toArray();
    $categories = array_merge($categories, $subcategories);
    $allProducts = DB::table('products')->whereIn('category_id', $categories)->count();
    return $allProducts;
}

function subSubCategoryProduct($id)
{
    $allProducts = DB::table('products')->where('category_id', $id)->get();
    return $allProducts;
}


function dealOfDayProduct($product_id)
{
    $deal = DealsOfDay::where('product_id', $product_id)->first();

    return $deal;
}


function calculateCart($price, $quantity, $discount)
{
    return [
        'price' => $price + ($price * $quantity),
        'quantity' => $quantity,
        'discount' => $discount + (($price * $discount) / 100) * $quantity,
    ];
}


function isReviewed($product_id)
{
    $value = 0;

    $reviews = Review::where('product_id', $product_id)->where('user_id', user()->id)->get();
    if ($reviews->count() > 0) {
        $value = 1;
    } else {
        $value = 0;
    }

    return $value;
}

function cartItems($owner_id)
{
    return Cart::with(['product_size:id,size', 'product_color:id,name,code'])
        ->where('owner_id', $owner_id)
        ->where('user_id', user()->id)
        ->get();
}


function checkForBothApprove($refund_id)
{
    $refund = Refund::find($refund_id);
    if ($refund->seller_approved == 1 && $refund->admin_approved == 1) {
        $order = Order::find($refund->order_id);
        $order->order_status = 'accepted';
        $order->save();

        $refund->is_seen = 1;

        $orderDetails = OrderDetails::select('product_id', 'quantity')->where('order_id', $refund->order_id)->get();

        foreach ($orderDetails as $orderDetail) {
            $product = Product::find($orderDetail->product_id);
            if ($product->refundable == 1) {
                $product->quantity = $product->quantity + $orderDetail->quantity;
                $product->save();
                $orderDetail->delete();
            }
        }

        return true;
    }
    return false;
}


function isQuoted($quotation_id)
{
    $value = 0;

    if (Auth::guard('seller')->check()) {
        $data = QuoteNow::where('seller_id', authSeller()->id)->where('quotation_id', $quotation_id)->get();
        if ($data->count() > 0) {
            $value = 1;
        } else {
            $value = 0;
        }
    } else {
        $value = 0;
    }

    return $value;
}

function addPoint($order_id, $seller_id, $user_id)
{
    $customer_point = BusinessSetting::where('id', 1)->first()->customer_order_point;
    $seller_point = BusinessSetting::where('id', 1)->first()->seller_order_point;

    if ($customer_point != 0) {
        $customerPoint = Wallet::where('user_id', $user_id)->first();
        if ($customerPoint) {
            $point = $customerPoint;
            $point->points += $customer_point;
        } else {
            $point = new Wallet();
            $point->points = $customer_point;
            $point->user_id = $user_id;
        }
        $point->save();

    }

    if ($seller_point != 0 && $seller_id != 0) {
        $sellerPoint = SellerWallet::where('seller_id', $seller_id)->first();
        if ($sellerPoint) {
            $point = $customerPoint;
            $point->points += $seller_point;
        } else {
            $point = new SellerWallet();
            $point->points = $seller_point;
            $point->seller_id = $seller_id;
        }
        $point->save();

    }
}

function totalSale($product_id)
{
    $sale = OrderDetails::where('product_id', $product_id)
        ->join('orders', 'order_details.order_id', '=', 'orders.id')
        ->where('orders.delivery_status', 'delivered')->where('orders.payment_status', 'paid')->count();

    return $sale;
}

