<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\LogoutController;
use App\Http\Livewire\Seller\DashboardComponent;
use App\Http\Livewire\Seller\Kargo\KargoComponent;
use App\Http\Livewire\Seller\Orders\OrderComponent;
use App\Http\Livewire\Seller\Refund\RefundComponent;
use App\Http\Livewire\Seller\Returns\ReturnsComponent;
use App\Http\Livewire\Auth\Seller\SellerLoginComponent;
use App\Http\Livewire\Seller\Product\ProductsComponent;
use App\Http\Livewire\Seller\Shop\ShopProfileComponent;
use App\Http\Livewire\Seller\WishList\WishListComponent;
use App\Http\Livewire\Seller\Withdraw\WithdrawComponent;
use App\Http\Livewire\Seller\Orders\OrderDetailsComponent;
use App\Http\Livewire\Seller\Product\AddProductsComponent;
use App\Http\Livewire\Seller\Wallet\SellerWalletComponent;
use App\Http\Livewire\Seller\Product\EditProductsComponent;
use App\Http\Livewire\Seller\Shop\ShopVerificationComponent;
use App\Http\Livewire\Auth\Seller\SellerRegistrationComponent;
use App\Http\Livewire\Seller\Setting\PasswordSettingComponent;
use App\Http\Livewire\Seller\Reviews\MyProductReviewsComponent;
use App\Http\Livewire\Seller\SupportTicket\TicketReplayComponent;
use App\Http\Livewire\Seller\SupportTicket\SupportTicketComponent;
use App\Http\Livewire\Seller\Commission\CommissionHistoryComponent;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

//Authentication

Route::prefix('seller')->name('seller.')->group(function(){
    // Route::view('/login','auth.seller.login')->middleware('guest:seller')->name('login');
    Route::get('/login', SellerLoginComponent::class)->middleware('guest:seller')->name('login');
    Route::get('/registration', SellerRegistrationComponent::class)->middleware('guest:seller')->name('registration');

    $limiter = config('fortify.limiters.login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware(array_filter([
            'guest:seller',
            $limiter ? 'throttle:'.$limiter : null,
        ]));

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth:seller')
        ->name('logout');

});

Route::post('/login-as-seller', [BaseController::class, 'loginAsSeller'])->name('loginAsSeller');
Route::get('/seller', DashboardComponent::class)->middleware('auth:seller');
Route::prefix('seller')->name('seller.')->middleware('auth:seller')->group(function(){
    Route::post('/logout', [LogoutController::class, 'sellerLogout'])->name('logout');
    Route::get('/dashboard', DashboardComponent::class)->name('home');

    //Products
    Route::get('/products', ProductsComponent::class)->name('allProducts');
    Route::get('/add-new-product', AddProductsComponent::class)->name('addProduct');
    Route::get('/products/edit/{id}', EditProductsComponent::class)->name('editProduct');

    //Shop
    Route::get('/shop/apply-for-verification', ShopVerificationComponent::class)->name('shopVerification');

    // Order
    Route::get('/orders', OrderComponent::class)->name('all-orders');
    Route::get('/orders/order-details/{id}', OrderDetailsComponent::class)->name('orderDetails');

    // Wish List
    Route::get('/wish-list', WishListComponent::class)->name('wish-list');

    // Return $ Cancel
    Route::get('/return-cancel', ReturnsComponent::class)->name('return-cancel');

    //Wallet
    Route::get('/wallet', SellerWalletComponent::class)->name('myWallet');

    //Comm History
    Route::get('/commission-history', CommissionHistoryComponent::class)->name('commissionHistory');

    //Refund
    Route::get('/refund-requests', RefundComponent::class)->name('refundRequests');

    //Reviews
    Route::get('/product-reviews', MyProductReviewsComponent::class)->name('productReviews');

    // Profile Settings
    Route::get('/shop-profile', ShopProfileComponent::class)->name('shopProfile');

    // Password Settings
    Route::get('/password-settings', PasswordSettingComponent::class)->name('password-settings');

    // Support Ticket
    Route::get('/support-ticket', SupportTicketComponent::class)->name('support.ticket');
    Route::get('/support-ticket-replay/{id}', TicketReplayComponent::class)->name('ticket.replay');

    // Money Withdraw
    Route::get('/money-withdraw', WithdrawComponent::class)->name('money.withdraw');

    // Kargo
    Route::get('/kargo-company', KargoComponent::class)->name('kargo.company');
});
