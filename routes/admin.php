<?php

use App\Http\Controllers\DataUploadController;
use App\Http\Controllers\LogoutController;
use App\Http\Livewire\Admin\Category\CategoryComponent;
use App\Http\Livewire\Admin\Category\SubCategoryComponent;
use App\Http\Livewire\Admin\Category\SubSubCategoryComponent;
use App\Http\Livewire\Admin\DashboardComponent;
use App\Http\Livewire\Admin\Product\ProductComponent;
use App\Http\Livewire\Admin\Setting\Color\ColorComponent;
use App\Http\Livewire\Admin\Customer\CustomerComponent;
use App\Http\Livewire\Admin\Customer\CustomerProfileComponent;
use App\Http\Livewire\Admin\Seller\SellerComponent;
use App\Http\Livewire\Admin\Seller\SellerProfileComponent;
use App\Http\Livewire\Admin\Profile\ProfileComponent;
use App\Http\Livewire\Admin\Administrator\AdministratorComponent;
use App\Http\Livewire\Admin\Administrator\AdministratorProfileComponent;
use App\Http\Livewire\Admin\Blog\BlogComponent;
use App\Http\Livewire\Admin\Blog\Category\BlogCategoryComponent;
use App\Http\Livewire\Admin\Blog\CreateNewBlogComponent;
use App\Http\Livewire\Admin\Blog\EditBlogComponent;
use App\Http\Livewire\Admin\Careers\CareersComponent;
use App\Http\Livewire\Admin\Category\Brands\SubCategoryBrandsComponent;
use App\Http\Livewire\Admin\Category\CategoryTranslationComponent;
use App\Http\Livewire\Admin\Category\Products\SubCategoryProductsComponent;
use App\Http\Livewire\Admin\Cms\BigDealsComponent;
use App\Http\Livewire\Admin\Cms\BottomBannerComponent;
use App\Http\Livewire\Admin\Cms\ManageProductComponent;
use App\Http\Livewire\Admin\Cms\MiddleBannerComponent;
use App\Http\Livewire\Admin\Cms\ReportMapComponent;
use App\Http\Livewire\Admin\Cms\ReportMapComponentV2;
use App\Http\Livewire\Admin\Cms\SearchComponent;
use App\Http\Livewire\Admin\CompanyInfo\CompanyCategoryComponent;
use App\Http\Livewire\Admin\CompanyInfo\CompanyInfoComponent;
use App\Http\Livewire\Admin\Contactus\ContactUsComponent;
use App\Http\Livewire\Admin\Coupon\CouponComponent;
use App\Http\Livewire\Admin\DealsOfDay\DealsOfDayComponent;
use App\Http\Livewire\Admin\Marketing\NewsletterComponent;
use App\Http\Livewire\Admin\Marketing\PartnerComponent;
use App\Http\Livewire\Admin\Marketing\SubscriberComponent;
use App\Http\Livewire\Admin\Pages\AboutBennebosComponent;
use App\Http\Livewire\Admin\Pages\PrivacyPolicyComponent;
use App\Http\Livewire\Admin\Pages\TermsConditionComponent;
use App\Http\Livewire\Admin\Payout\PayoutComponent;
use App\Http\Livewire\Admin\Payout\PayoutRequestComponent;
use App\Http\Livewire\Admin\PendingProduct\PendingProductComponent;
use App\Http\Livewire\Admin\PendingProduct\PendingProductDetailsComponent;
use App\Http\Livewire\Admin\Product\AddProductComponentV2;
use App\Http\Livewire\Admin\Product\Brand\IndexComponent;
use App\Http\Livewire\Admin\Product\EditProductComponentV2;
use App\Http\Livewire\Admin\Product\Review\ReviewesComponent;
use App\Http\Livewire\Admin\Product\Size\SizeRequestsComponent as SizeSizeRequestsComponent;
use App\Http\Livewire\Admin\Profile\ProfileSettingComponent;
use App\Http\Livewire\Admin\Qutotation\QutotationCategoryComponent;
use App\Http\Livewire\Admin\Qutotation\QutotationComponent;
use App\Http\Livewire\Admin\Qutotation\QutotationDetailComponent;
use App\Http\Livewire\Admin\Referrals\ReferralComponent;
use App\Http\Livewire\Admin\Refund\AcceptedRefundRequestComponent;
use App\Http\Livewire\Admin\Refund\RefundConfigurationComponent;
use App\Http\Livewire\Admin\Refund\RefundRequestComponent;
use App\Http\Livewire\Admin\Refund\RejectedRefundRequestComponent;
use App\Http\Livewire\Admin\Report\InhouseProductReport;
use App\Http\Livewire\Admin\Report\SellerProductReport;
use App\Http\Livewire\Admin\Report\StockProductReport;
use App\Http\Livewire\Admin\Report\WishlistProductReport;
use App\Http\Livewire\Admin\Sales\AllOrdersComponent;
use App\Http\Livewire\Admin\Sales\Inhouse\InhouseOrderDetailsComponent;
use App\Http\Livewire\Admin\Sales\Inhouse\InhouseOrdersComponent;
use App\Http\Livewire\Admin\Sales\OrderDetailsComponent;
use App\Http\Livewire\Admin\Sales\Seller\SellerOrderDetailsComponent;
use App\Http\Livewire\Admin\Sales\Seller\SellerOrdersComponent;
use App\Http\Livewire\Admin\Seller\SellerCommissionComponent;
use App\Http\Livewire\Admin\Seller\ShopVerificationInfoComponent;
use App\Http\Livewire\Admin\Setting\CountryPhoneCodesComponent;
use App\Http\Livewire\Admin\Setting\FeaturesActivationComponent;
use App\Http\Livewire\Admin\Setting\PointSettingComponent;
use App\Http\Livewire\Admin\Setting\SocialLoginCredentialComponent;
use App\Http\Livewire\Admin\Slider\ElectronicSliderComponent;
use App\Http\Livewire\Admin\Slider\SliderComponent;
use App\Http\Livewire\Admin\Slider\TopBannerComponent;
use App\Http\Livewire\Admin\Ticket\TicketComponent;
use App\Http\Livewire\Admin\Variations\SizeComponent;
use App\Http\Livewire\Admin\Websitesetup\FooterSectionComponent;
use App\Http\Livewire\Admin\Websitesetup\HeaderSectionComponent;
use App\Http\Livewire\Auth\Admin\LoginComponent;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;


//Authentication
Route::prefix('admin')->name('admin.')->group(function(){
    // Route::view('/login','auth.admin.login')->middleware('guest:admin')->name('login');
    Route::get('/login', LoginComponent::class)->middleware('guest:admin')->name('login');

    $limiter = config('fortify.limiters.login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware(array_filter([
            'guest:admin',
            $limiter ? 'throttle:'.$limiter : null,
        ]));
});

Route::get('/admin', DashboardComponent::class)->middleware('auth:admin');
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function(){
    Route::post('/logout', [LogoutController::class, 'adminLogout'])->name('logout');
    Route::get('/dashboard', DashboardComponent::class)->name('home');

    //CategoryRoutes
    Route::get('/category/main-categories', CategoryComponent::class)->name('category');
    Route::get('/category/sub-categories', SubCategoryComponent::class)->name('subCategory');
    Route::get('/category/sub-sub-categories', SubSubCategoryComponent::class)->name('subSubCategory');
    Route::get('/category/sub-categories/products/{id}', SubCategoryProductsComponent::class)->name('subCategoryProducts');
    Route::get('/category/sub-categories/brands/{id}', SubCategoryBrandsComponent::class)->name('subCategoryBrands');
    Route::get('/category/translations/{id}', CategoryTranslationComponent::class)->name('categoryTranslation');

    //Product Routes
    Route::get('/products', ProductComponent::class)->name('products');
    Route::get('/products/add-new-product', AddProductComponentV2::class)->name('addProduct');
    Route::get('/products/edit-product/{slug}', EditProductComponentV2::class)->name('editProduct');
    Route::get('/products/brands', IndexComponent::class)->name('brands');
    Route::get('/products/coupons', CouponComponent::class)->name('coupon');
    Route::get('/products/reviews', ReviewesComponent::class)->name('productReviewes');
    Route::get('/products/size-requests', SizeSizeRequestsComponent::class)->name('productSizeRequests');

    // Pending product routes
    Route::get('/pending/products', PendingProductComponent::class)->name('pending.products');
    Route::get('/pending/products/{slug}', PendingProductDetailsComponent::class)->name('pending.products.details');


    // Setting Routes
    // Colors
    Route::get('/setting/colors', ColorComponent::class)->name('colorSetting');

    Route::get('/setting/features-activation', FeaturesActivationComponent::class)->name('featuresActivation');
    Route::get('/setting/social-login', SocialLoginCredentialComponent::class)->name('socialLoginSetting');
    Route::get('/setting/points', PointSettingComponent::class)->name('pointsSetting');

    Route::get('/setting/phone-codes', CountryPhoneCodesComponent::class)->name('countryPhoneCodes');


    // Profile
    Route::get('/profile', ProfileSettingComponent::class)->name('profile');
    Route::get('/setting/profile', ProfileComponent::class)->name('profileSetting');

    // User Management
    // Customer
    Route::get('/user-management/customer/list', CustomerComponent::class)->name('customersList');
    Route::get('/user-management/customer/profile/{id}', CustomerProfileComponent::class)->name('customer.profile');

    // Seller
    Route::get('/seller/all-seller', SellerComponent::class)->name('sellerList');
    Route::get('/seller/all-seller/verification-info/{seller_id}', ShopVerificationInfoComponent::class)->name('seller.shopVerificationInfo');
    Route::get('/seller/profile/{id}', SellerProfileComponent::class)->name('seller.profile');

    // Admin
    Route::get('/user-management/admin/list', AdministratorComponent::class)->name('administratorList');
    Route::get('/user-management/admin/profile/{id}', AdministratorProfileComponent::class)->name('admin.profile');

    // Marketting Section
    Route::get('/marketing/subscribers', SubscriberComponent::class)->name('subscribers');
    Route::get('/marketing/newsletter', NewsletterComponent::class)->name('newsLetter');

    // Partner Logo
    Route::get('/marketing/partners', PartnerComponent::class)->name('partners');

    // Slider
    Route::get('/sliders', SliderComponent::class)->name('sliders');
    Route::get('/electronic/sliders', ElectronicSliderComponent::class)->name('electronic-sliders');
    Route::get('/top/banner', TopBannerComponent::class)->name('top.banner');

    //Blog
    Route::get('/blogs', BlogComponent::class)->name('allBlogs');
    Route::get('/blogs/add-new-blog', CreateNewBlogComponent::class)->name('addNewBlog');
    Route::get('/blogs/edit-blog/{id}', EditBlogComponent::class)->name('editBlog');
    Route::get('/blogs/categories', BlogCategoryComponent::class)->name('blogCategories');

    // Career Routes
    Route::get('/career', CareersComponent::class)->name('career');

    // Payout/Payment
    Route::get('/payout', PayoutComponent::class)->name('payout');
    Route::get('/payout/request', PayoutRequestComponent::class)->name('payout.request');

    // Support
    Route::get('/ticket', TicketComponent::class)->name('ticket');

    //Sales Routes
    Route::get('/sales/all-orders', AllOrdersComponent::class)->name('all-orders');
    Route::get('/sales/all-orders/details/{id}', OrderDetailsComponent::class)->name('orders-details');

    Route::get('/sales/inhouse-orders', InhouseOrdersComponent::class)->name('inhouse-orders');
    Route::get('/sales/inhouse-orders/details/{id}', InhouseOrderDetailsComponent::class)->name('inhouse-orders-details');

    Route::get('/sales/seller-orders', SellerOrdersComponent::class)->name('seller-orders');
    Route::get('/sales/seller-orders/details/{id}', SellerOrderDetailsComponent::class)->name('seller-orders-details');

    Route::get('refund/requests', RefundRequestComponent::class)->name('refundRequests');
    Route::get('refund/config', RefundConfigurationComponent::class)->name('refundConfig');
    Route::get('refund/accepted', AcceptedRefundRequestComponent::class)->name('acceptedRefund');
    Route::get('refund/rejected', RejectedRefundRequestComponent::class)->name('rejectedRefund');


    // Reports
    Route::get('/inhouse/product/reports', InhouseProductReport::class)->name('inhouse-product-reports');
    Route::get('/seller/product/reports', SellerProductReport::class)->name('seller-product-reports');
    Route::get('/stock/product/reports', StockProductReport::class)->name('stock-product-reports');
    Route::get('/wishlist/product/reports', WishlistProductReport::class)->name('wishlist-product-reports');

    // Website Setup
    Route::get('/website-setup/header', HeaderSectionComponent::class)->name('headerSetup');
    Route::get('/website-setup/footer', FooterSectionComponent::class)->name('footerSetup');

    // Company Info
    Route::get('/company-infomation', CompanyInfoComponent::class)->name('company.info');
    Route::get('/company-categories', CompanyCategoryComponent::class)->name('companyCategory');

    // Deals Of The Day
    Route::get('/deals-of-day', DealsOfDayComponent::class)->name('deals-of-day');

    // Qutotation
    Route::get('/qutotations', QutotationComponent::class)->name('qutotations');
    Route::get('/quotation/details/{slug}', QutotationDetailComponent::class)->name('quotation.details');
    Route::get('/qutotation-category', QutotationCategoryComponent::class)->name('qutotation-category');

    // Data Upload
    Route::post('/company-infomation-upload', [DataUploadController::class, 'companyInfo'])->name('uploadCompanyInfo');
    Route::get('/company-infomation-upload-store', [DataUploadController::class, 'storeInfo']);

    // Product Variations
    Route::get('/products/sizes', SizeComponent::class)->name('productSizes');

    //CMS
    Route::get('/cms/report-map', ReportMapComponentV2::class)->name('reportMap');
    Route::get('/cms/report-map/upload', ReportMapComponent::class);
    Route::get('/cms/middle-banner', MiddleBannerComponent::class)->name('middle-banner');
    Route::get('/cms/bottom-banner', BottomBannerComponent::class)->name('bottom-banner');
    Route::get('/cms/customer/search', SearchComponent::class)->name('recent.search');
    Route::get('/cms/manage/home/product', ManageProductComponent::class)->name('manage.product');
    Route::get('/cms/big-deals', BigDealsComponent::class)->name('bigDeals');

    // contact Message
    Route::get('/contact/message', ContactUsComponent::class)->name('contact.us.message');

    // Pages
    Route::get('/privacy-policy', PrivacyPolicyComponent::class)->name('privacy.policy');
    Route::get('/terms-conditions', TermsConditionComponent::class)->name('terms.conditions');
    Route::get('/about-bennebos', AboutBennebosComponent::class)->name('about.bennebos');

    //Commission History
    Route::get('/commission-history', SellerCommissionComponent::class)->name('commission.history');
    
    //Marketing Referrals
    Route::get('/referrals', ReferralComponent::class)->name('referrals');
});
