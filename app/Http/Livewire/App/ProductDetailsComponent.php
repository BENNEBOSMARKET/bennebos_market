<?php

namespace App\Http\Livewire\App;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\Review;
use App\Models\Shop;
use App\Models\Size;
use App\Models\SizeRequest;
use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;

class ProductDetailsComponent extends Component
{
    use WithPagination;
    public $product, $shop_id;
    public $product_id,
        $owner_id,
        $category_id,
        $price,
        $tax,
        $shipping_cost,
        $discount,
        $coupon_code,
        $quantity,
        $color,
        $size;

    public $gallery, $selectedSerial;
    public $tab = 'details';

    public $maincategory, $sub_category, $sub_sub_category;

    public $color_title, $color_price, $color_size;

    public $commonColors = [];
    public $commonSizes = [];

    public function mount($slug)
    {
        $local = Lang::locale() == "tur" ? "tr" : Lang::locale();

        $product = Product::where('slug', $slug)->first();
        $this->product = $product;

        $this->product_id = $product->id;
        $this->owner_id = $product->user_id;
        $this->price = $product->unit_price;
        $this->discount = $product->discount;
        $this->quantity = $product->min_qty;
        $this->category_id = $product->category_id;
        $this->size = $product->size_id;
        $this->color = $product->color_id;

        $categorytag = Category::where('id', $product->category_id)->first();
        if ($categorytag->parent_id == 0 && $categorytag->sub_parent_id == 0) {
            $this->maincategory = $categorytag;
        } else if ($categorytag->parent_id != 0 && $categorytag->sub_parent_id == 0) {
            $this->sub_category = $categorytag;
            $this->maincategory = Category::where('id', $categorytag->parent_id)->first();
        } else if ($categorytag->parent_id != 0 && $categorytag->sub_parent_id != 0) {
            $this->sub_sub_category = $categorytag;
            $this->maincategory = Category::where('id', $categorytag->parent_id)->first();
            $this->sub_category = Category::where('id', $categorytag->sub_parent_id)->first();
        }

        $this->gallery = $this->product->gallery_image ?? '[]';

        $this->commonSizes = Product::where('main_product_id', $this->product->main_product_id)
            ->pluck('size_id')
            ->toArray();
        $this->commonSizes = array_unique($this->commonSizes);

        $this->commonColors = Product::where('main_product_id', $this->product->main_product_id)
            ->where('size_id', $product->size_id)
            ->pluck('color_id')
            ->toArray();

        $this->commonColors = array_unique($this->commonColors);

        $this->commonSizes = Size::whereIn('id', $this->commonSizes)->get(['size', 'id']);
        $this->commonColors = Color::whereIn('id', $this->commonColors)->get(['name', 'image', 'id']);
    }

    public function changeTab($tab)
    {
        $this->tab = $tab;
    }

    public function selectColor($value, $key)
    {
        $this->color = $value;

        $product = Product::where('color_id', $value)
            ->where('size_id', $this->size)
            ->where('main_product_id', $this->product->main_product_id)
            ->first();

        if (empty($product))
            return;

        $this->gallery = $product->gallery_image ?? '[]';
        $this->color_title = $product->name;
        $this->color_price = $product->unit_price;

        $this->dispatchBrowserEvent('changeGalleryImages',  $this->gallery);
        $this->mount($product->slug);
    }

    public $request_size, $request_message;
    public function requestNewSize()
    {
        if(Auth::guard('web')->user()){
            $this->validate([
                'request_size' => 'required',
                'request_message' => 'required',
            ],
            [
                'request_size.required'=>'This field is required',
                'request_message.required'=>'This field is required',
            ]);
    
            $req = new SizeRequest(); 
            $req->product_id = $this->product_id; 
            $req->user_id = user()->id; 
            $req->requested_sizes = $this->request_size; 
            $req->message = $this->request_message; 
            $req->save(); 
    
            $this->dispatchBrowserEvent('closeModal');
            $this->dispatchBrowserEvent('success', ['message'=>'Your request submitted successfully']);

            $this->request_size = '';
            $this->request_message = '';
        } else{
            return redirect()->route('customerLogin');
        }
    }

    public function selectSlider($value)
    {
        $this->sliderKey = $value;
    }

    public function selectSize($value)
    {
        $this->size = $value;
        $product = Product::where('size_id', $value)
            //->where('color_id', $this->color)
            ->where('main_product_id', $this->product->main_product_id)
            ->first();

        if (empty($product))
            return;

        $this->gallery = $product->gallery_image ?? '[]';
        $this->color_title = $product->name;
        $this->color_price = $product->unit_price;

        $this->dispatchBrowserEvent('changeGalleryImages',  $this->gallery);
        $this->mount($product->slug);
    }

    public function increase()
    {
        $this->quantity += 1;
    }

    public function decrease()
    {
        $product = Product::where('id', $this->product_id)->first();

        if ($this->quantity > $product->min_qty) {
            $this->quantity -= 1;
        }
    }

    public function addToCart()
    {
        if (Auth::guard('web')->user()) {
            $checkCart = Cart::where('user_id', user()->id)
                ->where('color', $this->color)
                ->where('size', $this->size)
                ->where('product_id', $this->product_id)
                ->first();

            if ($checkCart != '') {
                $checkCart->price = $checkCart->price + ($this->price * $this->quantity);
                $checkCart->quantity = $checkCart->quantity + $this->quantity;
                $checkCart->discount = $checkCart->discount + (($this->price * $this->discount) / 100) * $this->quantity;
                $checkCart->save();
            } else {
                $cart = new Cart();
                $cart->owner_id = $this->owner_id;
                $cart->product_id = $this->product_id;
                $cart->user_id = user()->id;
                $cart->price = $this->price * $this->quantity;
                $cart->quantity = $this->quantity;
                $cart->discount = (($this->price * $this->discount) / 100) * $this->quantity;
                $cart->color = $this->color;
                $cart->size = $this->size;
                $cart->status = 0;
                $cart->save();
            }

            $this->dispatchBrowserEvent('success', ['message' => 'Item added to cart successfully']);
            $this->emit('refreshCartIcon');

            $this->price = $this->product->unit_price;
            $this->quantity = $this->product->min_qty;
            $this->discount = $this->product->discount;
            $this->color = '';
            $this->size = '';
        } else {
            return redirect()->route('customerLogin');
        }
    }

    public function addToCartSingle($id)
    {
        if (Auth::guard('web')->user()) {
            $product = Product::find($id);
            $checkCart = Cart::where('user_id', user()->id)->where('product_id', $id)->first();

            if ($checkCart != '') {
                $checkCart->price = $checkCart->price + ($product->unit_price * 1);
                $checkCart->quantity = $checkCart->quantity + 1;
                $checkCart->discount = $checkCart->discount + (($product->unit_price * $product->discount) / 100) * 1;
                $checkCart->save();
            } else {
                $cart = new Cart();
                $cart->owner_id = $product->user_id;
                $cart->product_id = $id;
                $cart->user_id = user()->id;
                $cart->price = $product->unit_price;
                $cart->quantity = 1;
                $cart->discount = (($product->unit_price * $product->discount) / 100) * 1;
                $cart->color = '';
                $cart->size = '';
                $cart->status = 0;
                $cart->save();
            }

            $this->dispatchBrowserEvent('success', ['message' => 'Item added to cart successfully']);
            $this->emit('refreshCartIcon');
        } else {
            return redirect()->route('customerLogin');
        }
    }

    public function wishlist($id)
    {
        if (Auth::guard('web')->user()) {
            if (checkIfWishlisted($id) > 0) {
                $wishlist = WishList::where('product_id', $id)->where('user_id', user()->id)->first();
                $wishlist->delete();

                $this->dispatchBrowserEvent('warning', ['message' => 'Product removed from wishlist']);
            } else {
                $wishlist = new WishList();
                $wishlist->user_id = user()->id;
                $wishlist->product_id = $id;
                $wishlist->save();

                $this->dispatchBrowserEvent('success', ['message' => 'Product added to wishlist']);
            }
        } else {
            return redirect()->route('customerLogin');
        }
    }

    public function proceedToCheckout()
    {
        if (Auth::guard('web')->user()) {
            $this->addToCart();

            session()->put('checkout', [
                'status' => 1,
                'cartItems' => Cart::where('product_id', $this->product_id)->where('user_id', user()->id)->pluck('id')->toArray(),
                'totalItem' => $this->quantity,
                'subtotal' => $this->price * $this->quantity,
                'totalDiscount' => 0,
                'coupon_discount' => 0,
                'grand_total' => $this->price * $this->quantity,
            ]);

            return redirect()->route('front.checkout');
        } else {
            return redirect()->route('customerLogin');
        }
    }

    public function render()
    {
        if ($this->product != '') {
            $local = Lang::locale() == "tur" ? "tr" : Lang::locale();
            $this->product = Product::where('products.id', $this->product_id)->first([
                "products.slug",
                "products.unit_price",
                "products.unit_price",
                "products.category_id",
                "products.user_id",
                "products.id",
                "products.name",
                "products.thumbnail",
                "products.min_qty",
                "products.brand_id",
                "products.gallery_image",
                "products.unit",
                "products.size",
                "products.description",
                "products.discount",
                "products.color_titles",
                "products.color_prices",
                "products.color",
                "products.color_image",
            ]);
            $gImages = ProductImage::where('product_id', $this->product_id)->limit(4)->get();
            // $products_query = Product::leftJoin('products_descriptions', function ($join) {
            //     $join->on('products.id', '=', 'products_descriptions.product_id');
            // })
            //     ->leftJoin("items_languages", function ($join) {
            //         $join->on('items_languages.id', '=', 'products_descriptions.language_id');
            //     })
            //     ->where('items_languages.local', $local)
            //     ->select(
            //         "products.slug",
            //         "products.unit_price",
            //         "products.unit_price",
            //         "products.category_id",
            //         "products.user_id",
            //         "products.id",
            //         "products_descriptions.name",
            //         "products.thumbnail",
            //         "products.min_qty",
            //         "products.brand_id",
            //         "products.gallery_image",
            //         "products.unit",
            //         "products.size",
            //         "products_descriptions.description",
            //         "products_descriptions.name",
            //         "products.discount",
            //         "products.color_titles",
            //         "products.color_prices",
            //         "products.color",
            //         "products.color_image",
            //     );
            $products_query = Product::select(
                "products.slug",
                "products.unit_price",
                "products.unit_price",
                "products.category_id",
                "products.user_id",
                "products.id",
                "products.name",
                "products.thumbnail",
                "products.min_qty",
                "products.brand_id",
                "products.gallery_image",
                "products.unit",
                "products.size",
                "products.description",
                "products.discount",
                "products.color_titles",
                "products.color_prices",
                "products.color",
                "products.color_image",
            );
            $supplierPoducts = $products_query->where('products.user_id', $this->owner_id)
                ->where('products.id', '!=', $this->product_id)
                ->where('products.status', 1)->inRandomOrder()->limit(3)->get();
            $popularProducts = $products_query->where('products.status', 1)->orderBy('products.total_review', 'DESC')->take('7')->get();
            $similarProducts = $products_query->where('products.status', 1)->where('products.category_id', $this->category_id)->where('products.id', '!=', $this->product_id)->take('8')->get();

            $product_reviews = Review::where('product_id', $this->product_id)->paginate(5);

            return view('livewire.app.product-details-component', ['gImages' => $gImages, 'supplierPoducts' => $supplierPoducts, 'popularProducts' => $popularProducts, 'similarProducts' => $similarProducts, 'product_reviews' => $product_reviews])->layout('livewire.layouts.base');
        } else {
            abort('404');
        }
    }
}
