<?php

use App\Services\IyzicoPayment;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\BaseController;
use App\Http\Livewire\App\IndexComponent;
use App\Http\Controllers\LogoutController;
use App\Http\Livewire\Auth\LoginComponent;
use App\Http\Livewire\App\IndexComponentV3;
use App\Http\Controllers\SocialiteController;
use App\Http\Livewire\App\Blog\BlogComponent;
use App\Http\Livewire\App\Cart\CartComponent;
use App\Http\Livewire\App\Shop\ShopComponent;
use App\Http\Livewire\App\Others\AboutComponent;
use App\Http\Livewire\App\ProductsPageComponent;
use App\Http\Livewire\App\Others\RefundComponent;
use App\Http\Livewire\Auth\RegistrationComponent;
use App\Http\Livewire\CatBrandColorSizeComponent;
use App\Http\Livewire\App\ProductDetailsComponent;
use App\Http\Livewire\App\Quotations\RFQComponent;
use App\Http\Livewire\Customer\DashboardComponent;
use App\Http\Livewire\App\Careers\CareersComponent;
use App\Http\Livewire\App\IndexByCategoryComponent;
use App\Http\Livewire\App\Reports\ReportsComponent;
use App\Http\Livewire\Auth\ChangePasswordComponent;
use App\Http\Livewire\Auth\ForgetPasswordComponent;
use App\Http\Livewire\GetCountrySatateIDSComponent;
use App\Http\Livewire\App\Blog\BlogDetailsComponent;
use App\Http\Livewire\App\Others\HowToSellComponent;
use App\Http\Livewire\App\Pages\BestSellingProducts;
use App\Http\Livewire\App\Checkout\CheckoutComponent;
use App\Http\Livewire\App\IndexByCategoryComponentV3;
use App\Http\Livewire\App\Others\HelpCenterComponent;
use App\Http\Livewire\App\Reports\ReportsComponentV2;
use App\Http\Controllers\DependableDropdownController;
use App\Http\Livewire\Customer\Cancel\CancelComponent;
use App\Http\Livewire\Customer\Review\ReviewComponent;
use App\Http\Livewire\App\Category\SellerPageComponent;
use App\Http\Livewire\App\Checkout\CheckoutComponentV2;
use App\Http\Livewire\App\Contactus\ContactUsComponent;
use App\Http\Livewire\App\Category\AllCategoryComponent;
use App\Http\Livewire\App\Category\ApparelPageComponent;
use App\Http\Livewire\App\Others\PrivacyPolicyComponent;
use App\Http\Livewire\Customer\MyOrder\MyOrderComponent;
use App\Http\Livewire\Customer\Payment\PaymentComponent;
use App\Http\Livewire\Customer\Profile\ProfileComponent;
use App\Http\Livewire\Customer\Support\SupportComponent;
use App\Http\Livewire\App\Category\CategoryPageComponent;
use App\Http\Livewire\App\Category\DiscountPageComponent;
use App\Http\Livewire\App\Others\TermsConditionComponent;
use App\Http\Livewire\App\Quotations\QuotationsComponent;
use App\Http\Livewire\App\Reports\ReportDetailsComponent;
use App\Http\Livewire\App\Careers\CareersDetailsComponent;
use App\Http\Livewire\App\Category\FoodstuffPageComponent;
use App\Http\Livewire\App\CompanyInfo\CompanyMapComponent;
use App\Http\Livewire\Customer\Settings\SettingsComponent;
use App\Http\Livewire\Customer\Wishlist\WishlistComponent;
use App\Http\Livewire\App\Category\NewArrivalPageComponent;
use App\Http\Livewire\App\Category\TopProductPageComponent;
use App\Http\Livewire\App\CompanyInfo\CompanyInfoComponent;
use App\Http\Livewire\Customer\MyOrder\OrderStatusComponent;
use App\Http\Livewire\Customer\MyOrder\RefundOrderComponent;
use App\Http\Livewire\Customer\Quotation\QuotationComponent;
use App\Http\Livewire\App\Checkout\SuccessfullOrderComponent;
use App\Http\Livewire\App\Notification\NotificationComponent;
use App\Http\Livewire\App\Quotations\QuotationDetailsComponent;
use App\Http\Livewire\App\Quotations\QuoteNow\QuoteNowComponent;
use App\Http\Livewire\App\CompanyInfo\CompanyInfoDetailsComponent;
use App\Http\Livewire\Customer\Support\SupportTicketDetailsComponent;
use App\Http\Livewire\Customer\MyOrder\OrderDetailsComponent as MyOrderOrderDetailsComponent;
use App\Http\Livewire\Customer\Quotation\QuotationDetailsComponent as QuotationQuotationDetailsComponent;

Route::get('/order/pdf/download/{id}', function ($id){

    return downloadOrderPdf($id);

})->name('order.pdf.download');

//Disable Routes
// Route::get('/login', function () {
//     return redirect('/');
// });
Route::get('/register', function () {
    abort(404);
});

//Get
Route::get('/get-country-state-ids', GetCountrySatateIDSComponent::class)->name('getIDS');
Route::get('/get-category-brand-color', CatBrandColorSizeComponent::class)->name('getCBC');

//Authentication
Route::get('/login', LoginComponent::class)->middleware('guest')->name('customerLogin');
Route::get('/registration', RegistrationComponent::class)->middleware('guest')->name('registration');
Route::get('/forget-password', ForgetPasswordComponent::class)->middleware('guest')->name('forgetPassword');
Route::get('/change-password/confirm', ChangePasswordComponent::class)->middleware('guest')->name('changePassword');

//Social Login Routes
//Google
Route::get('customer/login/google', [SocialiteController::class, 'googleAuth'])->name('authGoogle');
Route::get('customer/login/google/callback', [SocialiteController::class, 'googleAuthCallback'])->name('authGoogleCallback');
//facebook
Route::get('customer/login/facebook', [SocialiteController::class, 'facebookAuth'])->name('authFacebook');
Route::get('customer/login/facebook/callback', [SocialiteController::class, 'facebookAuthCallback'])->name('authFacebookCallback');
//twitter
Route::get('customer/login/twitter', [SocialiteController::class, 'twitterAuth'])->name('authTwitter');
Route::get('customer/login/twitter/callback', [SocialiteController::class, 'twitterAuthCallback'])->name('authTwitterCallback');

// Route::get('/', IndexComponent::class)->name('home.index');
Route::get('/', IndexComponentV3::class)->name('home.index');
// Route::get('/category/{slug}', IndexByCategoryComponent::class)->name('home.indexWithCategory');
Route::get('/category/{slug}', IndexByCategoryComponentV3::class)->name('home.indexWithCategory');
Route::get('/product-details/{slug}', ProductDetailsComponent::class)->name('front.productDetails');
Route::get('/all-categories', AllCategoryComponent::class)->name('front.allCategories');
Route::get('/products/{slug}', ProductsPageComponent::class)->name('front.allProducts');

Route::get('/products/category/{slug}', ProductsPageComponent::class)->name('front.category.products');
Route::get('/products/brand/{slug}', ProductsPageComponent::class)->name('front.brand.products');
Route::get('/products/shop/{slug}', ProductsPageComponent::class)->name('front.shop.products');

//cart && Checkout
Route::get('/cart', CartComponent::class)->name('front.cart')->middleware('auth');
Route::get('/checkout', CheckoutComponentV2::class)->name('front.checkout')->middleware('auth');
Route::get('/checkout/successfull', SuccessfullOrderComponent::class)->name('front.checkoutSuccess')->middleware('auth');

// Others Pages
Route::get('/terms-conditon', TermsConditionComponent::class)->name('terms-conditon');
Route::get('/returns-refunds', RefundComponent::class)->name('returns-refunds');
Route::get('/about-bennebos', AboutComponent::class)->name('about-bennebos');
Route::get('/help-center', HelpCenterComponent::class)->name('help-center');
Route::get('/privacy-policy', PrivacyPolicyComponent::class)->name('privacy-policy');
Route::get('/how-to-sell', HowToSellComponent::class)->name('how-to-sell');

// Notifications
Route::get('/notifications', NotificationComponent::class)->name('notifications');

Route::post('/get-states', [DependableDropdownController::class, 'getStates'])->name('getStates');

// Company Info Page
Route::get('/company-informations', CompanyInfoComponent::class)->name('company-informations');
Route::get('/company/info/{id}', CompanyInfoDetailsComponent::class)->name('front.company.info');
Route::get('/company-info/map-view', CompanyMapComponent::class)->name('company-info.mapview');

Route::prefix('customer')->name('customer.')->middleware('auth')->group(function(){
    Route::post('/logout', [LogoutController::class, 'customerLogout'])->name('logout');
    Route::get('/dashboard', DashboardComponent::class)->name('home');

    // My Profile
    Route::get('/my-profile', ProfileComponent::class)->name('my-profile');

    // Notification
    Route::get('/notifications', \App\Http\Livewire\Customer\NotificationComponent::class)->name('notifications');
    Route::get('notifications/mark-all-as-read', [\App\Http\Livewire\Customer\NotificationComponent::class, 'markAllRead'])->name('notifications.markAllAsRead');

    // My Order
    Route::get('/my-orders', MyOrderComponent::class)->name('my-orders');

    // My Order Details
    Route::get('/my-orders/details/{id}', MyOrderOrderDetailsComponent::class)->name('orders-details');
    Route::get('/my-orders/track/{order_code}', OrderStatusComponent::class)->name('orders-track');

    // refund order
    Route::get('/refund/{order}', RefundOrderComponent::class)->name('refund-order-get');


    // Return & Cancel
    Route::get('/return-cancel', CancelComponent::class)->name('return-cancel');

    // Rating & Review
    Route::get('/rating-review', ReviewComponent::class)->name('rating-review');

    // My Wishlist
    Route::get('/wishlist', WishlistComponent::class)->name('wishlist');

    // Payment
    Route::get('/my-payment', PaymentComponent::class)->name('my-peyment');

    // Payment
    Route::get('/support', SupportComponent::class)->name('support');
    Route::get('/support-replies/{id}', SupportTicketDetailsComponent::class)->name('supportDetails');

    // Settings
    Route::get('/settings', SettingsComponent::class)->name('settings');
});

Route::middleware('auth')->group(function(){
    // RFQ
    Route::get('/rfq-submission', RFQComponent::class)->name('rfq-submission');
    // RFQ
    Route::get('/my-quotations', QuotationComponent::class)->name('my-quotations');
    Route::get('/my-quotations/{id}', QuotationQuotationDetailsComponent::class)->name('quotationsdetails');
});

// Shop Pages
Route::get('/shop/seller/{slug}', ShopComponent::class)->name('shop.seller');

// Report Pages
Route::get('/reports/{slug}/{type}', ReportsComponentV2::class)->name('reports');
Route::get('/report-details/{slug}', ReportDetailsComponent::class)->name('reportDetails');

// quotations Pages
Route::get('/quotations', QuotationsComponent::class)->name('quotations');
Route::get('/quotations/details/{slug}', QuotationDetailsComponent::class)->name('quotations.details');


// Category Pages
Route::get('/category-page', CategoryPageComponent::class)->name('category-page');
Route::get('/new-arrival-products', NewArrivalPageComponent::class)->name('new-arrival');
Route::get('/apparel-products', ApparelPageComponent::class)->name('apparel-products');
Route::get('/discount-products', DiscountPageComponent::class)->name('discount-products');
Route::get('/foodstuff-products', FoodstuffPageComponent::class)->name('foodstuff-products');
Route::get('/top-products', TopProductPageComponent::class)->name('top-products');


Route::get('/best-selling-products/{slug}', BestSellingProducts::class)->name('best-selling-products');

// All Seller
Route::get('/all-seller', SellerPageComponent::class)->name('top-seller');

// Blog
Route::get('/our-blogs', BlogComponent::class)->name('our-blog');
Route::get('/our-blogs/{slug}', BlogDetailsComponent::class)->name('blogDetails');

// Careers Routes
Route::get('/careers', CareersComponent::class)->name('careers');
Route::get('/careers/{slug}', CareersDetailsComponent::class)->name('careersDetails');

//get Tab categories
Route::post('/get-tab-categories', [BaseController::class, 'getTabCategories'])->name('getTabCategories');
Route::post('/get-gallery-images', [BaseController::class, 'getTabGalleryImages'])->name('getTabGalleryImages');

// Contact us page
Route::get('/contact-us', ContactUsComponent::class)->name('contact-us');

Route::get('/optimize', function () {
    Artisan::call('optimize');
});

Route::get('/change/{locale}',  [BaseController::class, 'changeLanguage'])->name('changeLanguage');
Route::get('/change-delivery-country/{country}',  [BaseController::class, 'changeCountry'])->name('changeCountry');

require __DIR__ . '/admin.php';
require __DIR__ . '/seller.php';
