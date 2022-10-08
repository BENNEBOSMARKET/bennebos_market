<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BaseController extends Controller
{
    public function changeLanguage($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }

    public function changeCountry($country)
    {
        $asset = '';
        if($country == 'Turkey'){
            $asset = 'assets/images/icons/country_flag/flag-of-Turkey.jpg';
        }
        if($country == 'Germany'){
            $asset = 'assets/images/icons/country_flag/flag-of-Germany.jpg';
        }
        if($country == 'Austria'){
            $asset = 'assets/images/icons/country_flag/flag-of-Austria.jpg';
        }
        if($country == 'Belgium'){
            $asset = 'assets/images/icons/country_flag/flag-of-Belgium.jpg';
        }
        if($country == 'Bulgaria'){
            $asset = 'assets/images/icons/country_flag/flag-of-Bulgaria.jpg';
        }
        if($country == 'Croatia'){
            $asset = 'assets/images/icons/country_flag/flag-of-Croatia.jpg';
        }
        if($country == 'Czecia'){
            $asset = 'assets/images/icons/country_flag/flag-of-Czecia.jpg';
        }
        if($country == 'Denmark'){
            $asset = 'assets/images/icons/country_flag/flag-of-Denmark.jpg';
        }
        if($country == 'Estonia'){
            $asset = 'assets/images/icons/country_flag/flag-of-Estonia.jpg';
        }
        if($country == 'Finland'){
            $asset = 'assets/images/icons/country_flag/flag-of-Finland.jpg';
        }
        if($country == 'France'){
            $asset = 'assets/images/icons/country_flag/flag-of-France.jpg';
        }
        if($country == 'Greece'){
            $asset = 'assets/images/icons/country_flag/flag-of-Greece.jpg';
        }
        if($country == 'Hungary'){
            $asset = 'assets/images/icons/country_flag/flag-of-Hungary.jpg';
        }
        if($country == 'Iceland'){
            $asset = 'assets/images/icons/country_flag/flag-of-Iceland.jpg';
        }
        if($country == 'Italy'){
            $asset = 'assets/images/icons/country_flag/flag-of-Italy.jpg';
        }
        if($country == 'Latvia'){
            $asset = 'assets/images/icons/country_flag/flag-of-Latvia.jpg';
        }
        if($country == 'Lithuania'){
            $asset = 'assets/images/icons/country_flag/flag-of-Lithuania.jpg';
        }
        if($country == 'Malta'){
            $asset = 'assets/images/icons/country_flag/flag-of-Malta.jpg';
        }
        if($country == 'Netherlands'){
            $asset = 'assets/images/icons/country_flag/flag-of-Netherlands.jpg';
        }
        if($country == 'Poland'){
            $asset = 'assets/images/icons/country_flag/flag-of-Poland.jpg';
        }
        if($country == 'Portugal'){
            $asset = 'assets/images/icons/country_flag/flag-of-Portugal.jpg';
        }
        if($country == 'Romania'){
            $asset = 'assets/images/icons/country_flag/flag-of-Romania.jpg';
        }
        if($country == 'Slovakia'){
            $asset = 'assets/images/icons/country_flag/flag-of-Slovakia.jpg';
        }
        if($country == 'Slovenia'){
            $asset = 'assets/images/icons/country_flag/flag-of-Slovenia.jpg';
        }
        if($country == 'Spain'){
            $asset = 'assets/images/icons/country_flag/flag-of-Spain.jpg';
        }
        if($country == 'Sweden'){
            $asset = 'assets/images/icons/country_flag/flag-of-Sweden.jpg';
        }
        if($country == 'UnitedKingdom'){
            $asset = 'assets/images/icons/country_flag/flag-of-United-Kingdom.jpg';
        }
        if($country == 'Luxembourg'){
            $asset = 'assets/images/icons/country_flag/flag-of-Luxembourg.jpg';
        }


        Session::put('delivery_country', $country);
        Session::put('delivery_country_asset', $asset);
        return redirect()->back();
    }

    public function getTabCategories(Request $request)
    {
        $id = $request->get('value');

        $categories = Category::where('parent_id', $id)->get();

        return response()->json([
            'categories'=>$categories,
        ]);
    }

    public function getTabGalleryImages(Request $request)
    {
        $product_id = $request->get('value');
        $sl = $request->get('sl');

        $images = ProductImage::where('product_id', $product_id)->get();
        $product = Product::where('id', $product_id)->first();
        $gallery = '';
        foreach ($images as $key => $data){
            if($key == $sl){
                $gallery = $data;
            }
        }

        
        return array(
            'slider_view' => view('partials.product-details-slider', compact('gallery', 'product', 'sl'))->render(),
        );
    }

    public function loginAsSeller(Request $request)
    {
        $seller = Seller::where('email', $request->email)->first();

        if($seller->disabled == 0){
            Auth::guard('seller')->login($seller);

            session()->flash('success', 'Login Successfull!');
            return redirect()->route('seller.home');
        }
        else{
            session()->flash('error', 'Can not login a disabled seller account!');
            return redirect()->back();
        }
        
    }

}
