<div>
    <div class="left-sidebar">
        <!-- LOGO -->
        <div class="brand">
            <a href="{{ route('admin.home') }}" class="logo">
                <img src="{{ asset('assets/admin/images/logo.png') }}" alt="logo-large" class="logo-lg logo-light"
                    style="height: 44px; width: 190px;">
            </a>
        </div>
        <div class="border-end text-center pt-3">
            @if (Auth::guard('admin')->user()->avatar)
            <img src="{{ Auth::guard('admin')->user()->avatar }}" alt="user"
                class="rounded-circle thumb-md">
            @else
            <img src="{{ asset('assets/front/images/default/profile.png') }}" alt="user"
                class="rounded-circle thumb-md">
            @endif
        </div>
        <div class="sidebar-user-pro media border-end">
            <div class="media-body ms-2 user-detail align-self-center text-center">
                <h5 class="font-14 m-0 fw-bold">{{ Auth::guard('admin')->user()->name }} </h5>
                <p class="opacity-50 mb-0">{{ Auth::guard('admin')->user()->email }}</p>
            </div>
        </div>
        <!--end logo-->
        <div class="menu-content h-100" data-simplebar>
            <div class="menu-body navbar-vertical">
                <div class="collapse navbar-collapse tab-content" id="sidebarCollapse">
                    
                    <ul class="navbar-nav tab-pane active" id="Main" role="tabpanel">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.home') }}"><i
                                    class="ti ti-dashboard menu-icon"></i><span>Dashboard</span></a>
                        </li>

                        <!-- Products -->
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarProducts" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarProducts">
                                <i class="ti ti-shopping-cart menu-icon"></i>
                                <span>Products</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/products') || request()->is('admin/products/*') ? 'show' : '' }}"
                                id="sidebarProducts">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.addProduct') }}"
                                            class="nav-link {{ request()->is('admin/products/add-new-product') || request()->is('admin/products/add-new-product/*') ? 'active' : '' }}">Add
                                            New Product</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.products') }}"
                                            class="nav-link {{ request()->is('admin/products') || request()->is('admin/products/edit-product/*') ? 'active' : '' }}">All
                                            Products</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.pending.products') }}"
                                            class="nav-link {{ request()->is('admin/pending/products') || request()->is('admin/pending/products/edit-product/*') ? 'active' : '' }}">Pending
                                            Products</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.brands') }}"
                                            class="nav-link {{ request()->is('admin/brands') || request()->is('admin/brands/edit-product') ? 'active' : '' }}">Brands</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.productSizes') }}"
                                            class="nav-link {{ request()->is('admin/products/sizes') || request()->is('admin/products/sizes/*') ? 'active' : '' }}">Sizes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.productSizeRequests') }}"
                                            class="nav-link {{ request()->is('admin/products/size-requests') || request()->is('admin/products/size-requests/*') ? 'active' : '' }}">Size Requests</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.coupon') }}"
                                            class="nav-link {{ request()->is('admin/brands') || request()->is('admin/coupon/coupons') ? 'active' : '' }}">Coupon</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.productReviewes') }}"
                                            class="nav-link {{ request()->is('admin/products/reviews') || request()->is('admin/products/reviews') ? 'active' : '' }}">Product Reviews</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.deals-of-day') }}"
                                            class="nav-link {{ request()->is('admin/deals-of-day') || request()->is('admin/deals-of-day') ? 'active' : '' }}">Deals
                                            Of The Day</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Categories -->
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarCategory" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarCategory">
                                <i class="ti ti-layout-2 menu-icon"></i>
                                <span>Category</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/category') || request()->is('admin/category/*') ? 'show' : '' }}"
                                id="sidebarCategory">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.category') }}"
                                            class="nav-link {{ request()->is('admin/category/main-categories') || request()->is('admin/category/main-categories/*') ? 'active' : '' }}">Main
                                            Category</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.subCategory') }}"
                                            class="nav-link {{ request()->is('admin/category/sub-categories') || request()->is('admin/category/sub-categories/*') ? 'active' : '' }}">Sub
                                            Category</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.subSubCategory') }}"
                                            class="nav-link {{ request()->is('admin/category/sub-sub-categories') || request()->is('admin/category/sub-sub-categories/*') ? 'active' : '' }}">Sub
                                            Sub Category</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Orders -->
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarOrder" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarOrder">
                                <i class="ti ti-report-money menu-icon"></i>
                                <span>Orders</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/sales') || request()->is('admin/sales/*') ? 'show' : '' }}"
                                id="sidebarOrder">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.all-orders') }}"
                                            class="nav-link {{ ((request()->is('admin/sales/all-orders') || request()->is('admin/sales/all-orders/*')) && !request()->is('admin/sales/all-orders/refund')) ? 'active' : '' }}">All
                                            Orders</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('admin.inhouse-orders') }}"
                                            class="nav-link {{ request()->is('admin/sales/inhouse-orders') || request()->is('admin/sales/inhouse-orders/*') ? 'active' : '' }}">Inhouse
                                            Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.seller-orders') }}"
                                            class="nav-link {{ request()->is('admin/sales/seller-orders') || request()->is('admin/sales/seller-orders/*') ? 'active' : '' }}">Seller
                                            Orders</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Sellers -->
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarSeller" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarSeller">
                                <i class="ti ti-users menu-icon"></i>
                                <span>Sellers</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/seller') || request()->is('admin/seller/*') ? 'show' : '' }}"
                                id="sidebarSeller">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.sellerList') }}"
                                            class="nav-link {{ request()->is('admin/seller/list') || request()->is('admin/seller/list/*') ? 'active' : '' }}">All
                                            Seller</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.payout') }}"
                                            class="nav-link {{ request()->is('admin/payout') || request()->is('admin/payout/*') ? 'active' : '' }}">Payouts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.payout.request') }}"
                                            class="nav-link {{ request()->is('admin/payout/request') || request()->is('admin/payout/request/*') ? 'active' : '' }}">Payouts
                                            Request</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.commission.history') }}#" class="nav-link {{ request()->is('admin/commission-history') || request()->is('admin/commission-history/*') ? 'active' : '' }}">Seller Commision</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- User Management -->
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarUser" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarUser">
                                <i class="ti ti-users menu-icon"></i>
                                <span>User Management</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/user-management') || request()->is('admin/user-management/*') ? 'show' : '' }}"
                                id="sidebarUser">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.customersList') }}"
                                            class="nav-link {{ request()->is('admin/customer/list') || request()->is('admin/user-management/customer/list/*') ? 'active' : '' }}">Customer
                                            List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.administratorList') }}"
                                            class="nav-link {{ request()->is('admin/admin/list') || request()->is('admin/user-management/admin/list/*') ? 'active' : '' }}">Admin
                                            List</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Refunds -->
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarRefund" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarRefund">
                                <i class="ti ti-report-money menu-icon"></i>
                                <span>Refunds</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/refund') || request()->is('admin/refund/*') ? 'show' : '' }}"
                                id="sidebarRefund">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.refundRequests') }}" class="nav-link {{ request()->is('admin/refund/requests') ? 'active' : '' }}">Refund Requests</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('admin.acceptedRefund') }}" class="nav-link {{ request()->is('admin/refund/accepted') ? 'active' : '' }}">Accepted Refunds</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('admin.rejectedRefund') }}" class="nav-link {{ request()->is('admin/refund/rejected') ? 'active' : '' }}">Rejected Refunds</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('admin.refundConfig') }}" class="nav-link {{ request()->is('admin/refund/config') ? 'active' : '' }}">Refund Configuration</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Reports -->
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarReport" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarReport">
                                <i class="ti ti-report-analytics menu-icon"></i>
                                <span>Reports</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/Report') || request()->is('admin/Report/*') ? 'show' : '' }}"
                                id="sidebarReport">
                                <ul class="nav flex-column">
                                    <li
                                        class="nav-item {{ request()->is('admin/inhouse/product/reports') || request()->is('admin/inhouse/product/reports/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.inhouse-product-reports') }}" class="nav-link">Inhouse
                                            Products Report</a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->is('admin/seller/product/reports') || request()->is('admin/seller/product/reports/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.seller-product-reports') }}" class="nav-link">Seller
                                            Products Report</a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->is('admin/stock/product/reports') || request()->is('admin/stock/product/reports/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.stock-product-reports') }}" class="nav-link">Products
                                            Stock Report</a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->is('	admin/wishlist/product/reports') || request()->is('	admin/wishlist/product/reports/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.wishlist-product-reports') }}"
                                            class="nav-link">Products WishList</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Company Info -->
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarCompanyInfo" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarCompanyInfo">
                                <i class="ti ti-world menu-icon"></i>
                                <span>Company Info</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/company-infomation') || request()->is('admin/company-infomation/*') ? 'show' : '' }}"
                                id="sidebarCompanyInfo">
                                <ul class="nav flex-column">
                                    <li
                                        class="nav-item {{ request()->is('admin/company-categories/') || request()->is('admin/company-categories/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.companyCategory') }}" class="nav-link">Company
                                            Category</a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->is('admin/company-infomation/') || request()->is('admin/company-infomation/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.company.info') }}" class="nav-link">Company
                                            Info</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Qutotations -->
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarQutotations" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarQutotations">
                                <i class="ti ti-atom menu-icon"></i>
                                <span>Qutotations</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/qutotations') || request()->is('admin/qutotations/*') ? 'show' : '' }}"
                                id="sidebarQutotations">
                                <ul class="nav flex-column">
                                    <li
                                        class="nav-item {{ request()->is('admin/qutotations/') || request()->is('admin/qutotations/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.qutotations') }}" class="nav-link">Qutotations List</a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->is('admin/qutotations/') || request()->is('admin/qutotations/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.qutotation-category') }}" class="nav-link">Qutotations
                                            Category</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Blogs -->
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarBlogs" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarBlogs">
                                <i class="ti ti-report-analytics menu-icon"></i>
                                <span>Blogs</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/blogs') || request()->is('admin/blogs/*') ? 'show' : '' }}"
                                id="sidebarBlogs">
                                <ul class="nav flex-column">
                                    <li
                                        class="nav-item {{ request()->is('admin/blogs') || request()->is('admin/blogs/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.allBlogs') }}" class="nav-link">All Blogs</a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->is('admin/blogs/categories') || request()->is('admin/blogs/categories/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.blogCategories') }}" class="nav-link">Blog Category</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Marketing -->
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarMarketing" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarMarketing">
                                <i class="ti ti-speakerphone menu-icon"></i>
                                <span>Marketing</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/marketing') || request()->is('admin/marketing/*') ? 'show' : '' }}"
                                id="sidebarMarketing">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.subscribers') }}"
                                            class="nav-link {{ request()->is('admin/marketing/subscribers') || request()->is('admin/marketing/subscribers/*') ? 'active' : '' }}">Subscribers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.partners') }}"
                                            class="nav-link {{ request()->is('admin/marketing/partners') || request()->is('admin/marketing/partners/*') ? 'active' : '' }}">Partner Logo</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- Sliders -->
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarSlider" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarSlider">
                                <i class="ti ti-slideshow menu-icon"></i>
                                <span>Sliders</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/sliders') || request()->is('admin/sliders/*') ? 'show' : '' }}"
                                id="sidebarSlider">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.sliders') }}"
                                            class="nav-link {{ request()->is('admin/marketing/subscribers') || request()->is('admin/marketing/subscribers/*') ? 'active' : '' }}">Main
                                            Slider</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.electronic-sliders') }}"
                                            class="nav-link {{ request()->is('admin/electronic/sliders') || request()->is('	admin/electronic/sliders/*') ? 'active' : '' }}">Electronics
                                            Slider</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.top.banner') }}"
                                            class="nav-link {{ request()->is('admin/top/banner') || request()->is('	admin/top/banner/*') ? 'active' : '' }}">Hero
                                            Top Banner</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Support -->
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarTicket" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarTicket">
                                <i class="ti ti-user menu-icon"></i>
                                <span>Support</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/ticket') || request()->is('admin/ticket/*') ? 'show' : '' }}"
                                id="sidebarTicket">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.ticket') }}"
                                            class="nav-link {{ request()->is('admin/ticket') || request()->is('admin/ticket/*') ? 'active' : '' }}">Ticket
                                            <span style="margin-left: 50%;" class="badge bg-primary">5</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Product Queries</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Contact Messages -->
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarContact" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarContact">
                                <i class="ti ti-user menu-icon"></i>
                                <span>Contact Message</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/contact/message') || request()->is('admin/contact/message/*') ? 'show' : '' }}"
                                id="sidebarContact">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.contact.us.message') }}"
                                            class="nav-link {{ request()->is('admin/contact/message') || request()->is('admin/contact/message/*') ? 'active' : '' }}">Message
                                            <span style="margin-left: 50%;" class="badge bg-primary">5</span></a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Staffs -->
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#sidebarStaffs" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarStaffs">
                                <i class="ti ti-user menu-icon"></i>
                                <span>Staffs</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/Staffs') || request()->is('admin/Staffs/*') ? 'show' : '' }}"
                                id="sidebarStaffs">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">All Staffs</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Staffs Permission</a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}

                        <!-- CMS -->
                        <li class="nav-item">
                            <a class="nav-link" href="#cms_section" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="cms_section">
                                <i class="ti ti-atom menu-icon"></i>
                                <span>CMS</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/cms') || request()->is('admin/cms/*') ? 'show' : '' }}"
                                id="cms_section">
                                <ul class="nav flex-column">
                                    <li
                                        class="nav-item {{ request()->is('admin/cms/report-map/') || request()->is('admin/cms/report-map/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.reportMap') }}" class="nav-link">Report
                                            Map</a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->is('admin/cms/middle-banner/') || request()->is('admin/cms/middle-banner/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.middle-banner') }}" class="nav-link">Middle Banner</a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->is('admin/cms/bottom-banner/') || request()->is('admin/cms/bottom-banner/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.bottom-banner') }}" class="nav-link">Bottom Banner</a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->is('admin/cms/customer/search/') || request()->is('admin/cms/customer/search/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.recent.search') }}" class="nav-link">Recent Search</a>
                                    </li>
                                    <li class="nav-item {{ request()->is('admin/cms/manage/home/product/') || request()->is('admin/cms/manage/home/product/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.manage.product') }}" class="nav-link">Manage Product View</a>
                                    </li>
                                    <li class="nav-item {{ request()->is('admin/big-deals') || request()->is('admin/big-deals/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.bigDeals') }}" class="nav-link">Big Deals</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Pages Design -->
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarPageDesign" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarPageDesign">
                                <i class="ti ti-snowflake menu-icon"></i>
                                <span>Pages Design</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/website-setup') || request()->is('admin/website-setup/*') ? 'show' : '' }}"
                                id="sidebarPageDesign">
                                <ul class="nav flex-column">
                                    <li
                                        class="nav-item {{ request()->is('admin/privacy-policy') || request()->is('admin/privacy-policy/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.privacy.policy') }}" class="nav-link">Privacy Policy</a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->is('admin/terms-conditions') || request()->is('admin/terms-conditions/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.terms.conditions') }}" class="nav-link">Terms & Conditions</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        <!-- Career -->
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarCareer" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarCareer">
                                <i class="ti ti-report-analytics menu-icon"></i>
                                <span>Career</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/career') || request()->is('admin/career/*') ? 'show' : '' }}"
                                id="sidebarCareer">
                                <ul class="nav flex-column">
                                    <li
                                        class="nav-item {{ request()->is('admin/career') || request()->is('admin/career/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.career') }}" class="nav-link">Job List</a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->is('admin/blogs/categories') || request()->is('admin/blogs/categories/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.blogCategories') }}" class="nav-link">Job Application</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Website Setup -->
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarWebsiteSetup" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarWebsiteSetup">
                                <i class="ti ti-snowflake menu-icon"></i>
                                <span>Website Setup</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/website-setup') || request()->is('admin/website-setup/*') ? 'show' : '' }}"
                                id="sidebarWebsiteSetup">
                                <ul class="nav flex-column">
                                    <li
                                        class="nav-item {{ request()->is('admin/website-setup/header') || request()->is('admin/website-setup/header/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.headerSetup') }}" class="nav-link">Header</a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->is('admin/website-setup/footer') || request()->is('admin/website-setup/footer/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.footerSetup') }}" class="nav-link">Footer</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Settings -->
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarSetting" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarSetting">
                                <i class="ti ti-settings menu-icon"></i>
                                <span>Setting</span>
                            </a>
                            <div class="collapse {{ request()->is('admin/setting') || request()->is('admin/setting/*') ? 'show' : '' }}"
                                id="sidebarSetting">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.featuresActivation') }}"
                                            class="nav-link {{ request()->is('admin/setting/feature-activation') || request()->is('admin/setting/feature-activation/*') ? 'active' : '' }}">Features
                                            Activation</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.socialLoginSetting') }}"
                                            class="nav-link {{ request()->is('admin/setting/social-login') || request()->is('admin/setting/social-login/*') ? 'active' : '' }}">Social
                                            Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.pointsSetting') }}"
                                            class="nav-link {{ request()->is('admin/setting/points') || request()->is('admin/setting/points/*') ? 'active' : '' }}">Point Settings</a>
                                    </li>
                                    <li class="nav-item d-none">
                                        <a href="{{ route('admin.countryPhoneCodes') }}"
                                            class="nav-link {{ request()->is('admin/setting/phone-codes') || request()->is('admin/setting/phone-codes/*') ? 'active' : '' }}">Phone
                                            Codes</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
