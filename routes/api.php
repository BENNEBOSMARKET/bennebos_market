<?php
use App\Http\Controllers\Api\Auth\UserAuthenticationController;
use App\Http\Controllers\Api\BigDealsProductController;
use App\Http\Controllers\Api\BolgsController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ContacUsPageController;
use App\Http\Controllers\Api\FeaturesPageController;
use App\Http\Controllers\Api\HelpCenterPageController;
use App\Http\Controllers\Api\HomeApiController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ChecoutController;
use App\Http\Controllers\Api\HowBuyPageController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\NewsLetterController;
use App\Http\Controllers\Api\OurServicePageController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PhotoController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductsUpload;
use App\Http\Controllers\Api\SellerController;
use App\Http\Controllers\Api\SendMoneyCustomerController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WishListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/login',[UserAuthenticationController::class,"login"]);
Route::post("social/login", [UserAuthenticationController::class, 'socialLogin']);
Route::post('/register',[UserAuthenticationController::class,"register"]);
Route::post('/resendVerification',[UserAuthenticationController::class,"resendVerification"]);
Route::post('/verify',[UserAuthenticationController::class,"verifyUser"]);
Route::post('refresh/token',[UserAuthenticationController::class,"refreshToken"]);
Route::post('/reset/password',[UserAuthenticationController::class,"resetPassword"]);
Route::post('/change/password',[UserAuthenticationController::class,"changePassword"]);


Route::group(['middleware'=>["auth:api"]],function(){

    Route::post('/password/update',[UserAuthenticationController::class,"updatePassword"]);

    Route::post('product/review',[ProductController::class, "makeReview"]);
    Route::put('wishlist/assign', [WishListController::class, 'assignUserToWishlist']);
    Route::post('product/request/size', [ProductController::class, 'requestSize']);

    Route::get('/sendMoney/get/{id}',[SendMoneyCustomerController::class, "getCustomerPoint"]);

    Route::group(['prefix' => "me"],function(){
        Route::get('info',[UserController::class, "getUserInfo"]);

        Route::post('info/update',[UserController::class, "infoUpdate"]);
    });
    Route::get('/',function(){
        return "hello authentication service";
    });

    Route::prefix('checkout')->group(function () {
        Route::get('addresses', [ChecoutController::class, 'getAddresses']);
        Route::post('addresses/create', [ChecoutController::class, 'createAddresses']);
        Route::post('addresses/update', [ChecoutController::class, 'updateAddress']);
        Route::delete('addresses/delete/{address}', [ChecoutController::class, 'deleteAddress']);
        Route::post('order/create', [ChecoutController::class, 'makeOrder']);
        Route::delete('order/cancel/{order}', [ChecoutController::class, 'deleteOrder']);
        Route::get('orders', [ChecoutController::class, 'getOrders']);
        Route::get('order/product/{order}', [ChecoutController::class, 'getOrderProducts']);

    });
});



// Home slider and banners
Route::get('/home/sliderandbanner/{type}',[HomeApiController::class,"homeSliderAndBanner"]);
Route::get('/countries',[HomeApiController::class,"getCountries"]);
Route::get('/states/{country}',[HomeApiController::class,"getStates"]);

// All category router
Route::get('categories/all', [HomeApiController::class, 'allCategory']);
Route::get('brands/all', [HomeApiController::class, 'allBrands']);
Route::get('products/{type}', [HomeApiController::class, 'productByType']);
Route::get('category/subcategory/topthree', [HomeApiController::class, 'subCategoryTopThree']);


Route::prefix('cart')->name('cart.')->group(function () {
    Route::post( '/add', [CartController::class,'addCart']);
    Route::post('/add/multi', [CartController::class,'addCarts']);
    Route::post('/product/update', [CartController::class,'updateProductQuantity']);
    Route::delete('/remove', [CartController::class,'removeCart']);
    Route::post('/remove/products', [CartController::class,'removeProduct']);
    Route::post('/add/user', [CartController::class, 'addUserToCart']);
    Route::post('get/by/user', [CartController::class, 'getCartByUserId']);
});

Route::group(['prefix' =>"category", "middleware" => "api.localization"],function(){
    Route::get('headerCategories',[CategoryController::class,'getAllHeaderCategory']);
    Route::get('headerSubCategories/{id}',[CategoryController::class,'getAllHeaderSubCategory']);
    Route::get('/',[CategoryController::class, "getCategories"]);
    Route::get('/single/{id}',[CategoryController::class, "getSingleCategory"]);
    Route::get('/categories/',[CategoryController::class, "getMainCategories"]);
    Route::get('/subcat/{category_id}',[CategoryController::class, "getSubCategories"]);
    Route::get('/subsubcat/{category_id}',[CategoryController::class, "getSubSubCategories"]);
    Route::get('/subsubcat/{category_id}',[CategoryController::class, "getSubSubCategories"]);
        Route::get('topThreeCategory',[HomeApiController::class, "subCategoryTopThree"]);

});

Route::group(['prefix' =>"product", "middleware" => "api.localization"],function(){
    Route::get('/',[ProductController::class, "getProducts"]);
    Route::get('/withDiscount',[ProductController::class, "getDiscountProducts"]);
    Route::get('/single/{id}',[ProductController::class, "getSingleProduct"]);
    Route::get('/category/{category_id}',[ProductController::class, "getCategoryProducts"]);
    Route::get('/related/{category_id}/{product_id}',[ProductController::class, "getRelatedProducts"]);
    Route::post('/by/category/{slug}',[ProductController::class, "productByCategorySlug"])->name('product.by.category.slug');
    Route::get('/by/size/color/{product_id}',[ProductController::class, "getProductByColorAndSize"])->name('product.by.size.color');
    Route::get('/statisticsProducts',[ProductController::class, "statisticsProducts"]);
    Route::get('/categoryStatistics/{category_id}',[CategoryController::class, "categoryStatistics"]);
    Route::get('/bigDeals',[BigDealsProductController::class, "getBigDealsProduct"]);

});

Route::group(['prefix' =>"brands"],function(){
    Route::get('/',[BrandController::class, "getBrands"]);
    Route::get('/products/{brand_id}',[BrandController::class, "getBrandProducts"]);
});


// wishlist API

Route::prefix('wishlist')->group(function () {
    Route::post('add', [WishListController::class, 'addWishList']);
    Route::get('get', [WishListController::class, 'getWishList']);
    Route::post('update', [WishListController::class, 'updateWishList']);
    Route::delete('delete', [WishListController::class, 'deleteWishList']);
    Route::delete('delete/product', [WishListController::class, 'deleteWishListProduct']);
});



Route::get('create/payment',[PaymentController::class, "create"]);
Route::match(array('GET', 'POST'),'payment/callback',[PaymentController::class, "callback"]);
Route::post('products/upload/data',[ProductsUpload::class, 'productsUpload']);
Route::get('search',[HomeApiController::class, "search"]);
Route::get('filter',[ProductController::class, "filter"]);
Route::get('allCategoryPhotos/{id}',[PhotoController::class,'getCategoryPhoto']);
Route::get('sliderRightProductPhotos/{id}',[PhotoController::class,'getSliderRightProductPhoto']);
Route::get('allHomePhotos',[PhotoController::class,'getHomePhoto']);
Route::get('allNews',[NewsController::class,'getNews']);
Route::get('howBuyPage',[HowBuyPageController::class,'getAllHowBuyPage']);
Route::get('allFeatures',[FeaturesPageController::class,'getAllFeatures']);
Route::get('allHelpCenter',[HelpCenterPageController::class,'getAllHelp']);
Route::get('allOurService',[OurServicePageController::class,'getAllServices']);
Route::get('getContactUs',[ContacUsPageController::class,'getAllContactUsPage']);
Route::get('getAllBlogs',[BolgsController::class,'getAllBlogs']);
Route::get('getCountSeller',[SellerController::class,'getCountSeller']);
Route::get('getInfoSeller',[SellerController::class,'getInfoSeller']);
Route::get('getSellerProfiles/{id}',[SellerController::class,'getSellerProfile']);
Route::get('getJobList',[JobController::class,'getJobList']);
Route::post('jobApplication',[JobController::class,'getJobApplication']);
Route::post('NewsLetter',[NewsLetterController::class,'postNewsLetter']);
Route::post('search/create',[HomeApiController::class, "setSearch"]);
Route::get('search/products',[HomeApiController::class, "mostSearchedProducts"]);
