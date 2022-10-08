<div>
    <!-- Page Pagination Section  -->
    <section class="page_pagination_wrapper">
        <div class="my-container">
            <ul class="page_pagination_list d-flex align-items-center flex-wrap-wrap">
                <li>
                    <a href="#">Home</a>
                    <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                </li>

                <li>
                    New Arrivals
                    <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                </li>
            </ul>
        </div>
    </section>
    <!-- Arrivals Product Section  -->
    <section class="new_arrivals_wrapper">
        <div class="my-container">
            <div class="category_product_title">
                <div class="d-flex align-items-center justify-content-between g-sm">
                    <h3>Men’s T-Shirts</h3>
                    <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="mobile_product_list_icon" id="mobileProductCategoryIcon">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M1.5 -0.000976562C0.947715 -0.000976562 0.5 0.446739 0.5 0.999023C0.5 1.55131 0.947715 1.99902 1.5 1.99902H18.5C19.0523 1.99902 19.5 1.55131 19.5 0.999023C19.5 0.446739 19.0523 -0.000976562 18.5 -0.000976562H1.5ZM0.5 6.99902C0.5 6.44674 0.947715 5.99902 1.5 5.99902H18.5C19.0523 5.99902 19.5 6.44674 19.5 6.99902C19.5 7.55131 19.0523 7.99902 18.5 7.99902H1.5C0.947715 7.99902 0.5 7.55131 0.5 6.99902ZM0.5 13C0.5 12.4477 0.947715 12 1.5 12H18.5C19.0523 12 19.5 12.4477 19.5 13C19.5 13.5523 19.0523 14 18.5 14H1.5C0.947715 14 0.5 13.5523 0.5 13Z"
                            fill="#424C60" />
                    </svg>
                </div>
                <div class="d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                    <h4>75,785 itemd found in T-Shirts</h4>
                    <div class="d-flex align-items-center g-sm">
                        <div class="d-flex align-items-center g-sm">
                            <img src="{{ asset('assets/front/images/icon/filter.svg') }}" alt="filter icon" />
                            <h5>Sort By</h5>
                        </div>
                        <div class="selectbox_row">
                            <select class="niceSelect">
                                <option data-display="Price Low to High">
                                    Price Low to High
                                </option>
                                <option value="1">Price High to Low</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="new_arrival_tab_area">
                <div class="category_tab_button">
                    <button type="button" class="tablinks" id="defaultOpen2" onclick="openTab(event, 'categoryTab')">
                        Tüm Kategoriler
                    </button>
                    <button type="button" class="tablinks" onclick="openTab(event, 'electronicTab')">
                        Electronic
                    </button>
                    <button type="button" class="tablinks" onclick="openTab(event, 'foodTab')">
                        Foodstuffs
                    </button>
                    <button type="button" class="tablinks" onclick="openTab(event, 'medicalTab')">
                        Medical Devices
                    </button>
                    <button type="button" class="tablinks" onclick="openTab(event, 'productionTab')">
                        Production Lines
                    </button>
                    <button type="button" class="tablinks" onclick="openTab(event, 'beautyTab')">
                        Beauty
                    </button>
                </div>
            </div>
            <div class="tab_content_area">
                <div class="tab_item" id="categoryTab">
                    <div class="new_arrival_grid">
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img1.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img2.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img3.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img4.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img5.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img6.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img7.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img8.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img9.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img10.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img1.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img2.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img3.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img4.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img5.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img6.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img7.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img8.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img9.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img10.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img1.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img2.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img3.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img4.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img5.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img6.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img7.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img8.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img9.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img10.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="pagination_list d-flex align-items-center justify-content-end flex-wrap-wrap g-sm">
                        <li>
                            <button type="button">
                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.91675 12.8334L1.08341 7.00002L6.91675 1.16669" stroke="#424C60"
                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </li>
                        <li class="active_pagination">
                            <a href="#">1</a>
                        </li>
                        <li>
                            <a href="#">2</a>
                        </li>
                        <li>
                            <a href="#">3</a>
                        </li>
                        <li>
                            <a href="#">4</a>
                        </li>
                        <li>
                            <a href="#">5</a>
                        </li>
                        <li>
                            <a href="#">6</a>
                        </li>
                        <li>
                            <a href="#">-</a>
                        </li>
                        <li>
                            <a href="#">100</a>
                        </li>
                        <li>
                            <button type="button">
                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.08325 1.16665L6.91659 6.99998L1.08325 12.8333" stroke="#424C60"
                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab_item" id="electronicTab">
                    <div class="new_arrival_grid">
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img1.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img2.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img3.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img4.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img5.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img6.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img7.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img8.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img9.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img10.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img1.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img2.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img3.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img4.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img5.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img6.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img7.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img8.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img9.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img10.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img1.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img2.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img3.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img4.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img5.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img6.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img7.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img8.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img9.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img10.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="pagination_list d-flex align-items-center justify-content-end flex-wrap-wrap g-sm">
                        <li>
                            <button type="button">
                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.91675 12.8334L1.08341 7.00002L6.91675 1.16669" stroke="#424C60"
                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </li>
                        <li class="active_pagination">
                            <a href="#">1</a>
                        </li>
                        <li>
                            <a href="#">2</a>
                        </li>
                        <li>
                            <a href="#">3</a>
                        </li>
                        <li>
                            <a href="#">4</a>
                        </li>
                        <li>
                            <a href="#">5</a>
                        </li>
                        <li>
                            <a href="#">6</a>
                        </li>
                        <li>
                            <a href="#">-</a>
                        </li>
                        <li>
                            <a href="#">100</a>
                        </li>
                        <li>
                            <button type="button">
                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.08325 1.16665L6.91659 6.99998L1.08325 12.8333" stroke="#424C60"
                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab_item" id="foodTab">
                    <div class="new_arrival_grid">
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img1.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img2.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img3.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img4.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img5.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img6.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img7.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img8.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img9.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img10.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img1.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img2.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img3.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img4.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img5.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img6.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img7.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img8.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img9.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img10.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img1.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img2.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img3.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img4.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img5.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img6.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img7.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img8.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img9.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img10.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="pagination_list d-flex align-items-center justify-content-end flex-wrap-wrap g-sm">
                        <li>
                            <button type="button">
                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.91675 12.8334L1.08341 7.00002L6.91675 1.16669" stroke="#424C60"
                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </li>
                        <li class="active_pagination">
                            <a href="#">1</a>
                        </li>
                        <li>
                            <a href="#">2</a>
                        </li>
                        <li>
                            <a href="#">3</a>
                        </li>
                        <li>
                            <a href="#">4</a>
                        </li>
                        <li>
                            <a href="#">5</a>
                        </li>
                        <li>
                            <a href="#">6</a>
                        </li>
                        <li>
                            <a href="#">-</a>
                        </li>
                        <li>
                            <a href="#">100</a>
                        </li>
                        <li>
                            <button type="button">
                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.08325 1.16665L6.91659 6.99998L1.08325 12.8333" stroke="#424C60"
                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab_item" id="medicalTab">
                    <div class="new_arrival_grid">
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img1.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img2.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img3.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img4.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img5.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img6.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img7.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img8.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img9.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img10.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img1.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img2.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img3.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img4.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img5.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img6.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img7.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img8.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img9.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img10.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img1.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img2.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img3.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img4.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img5.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img6.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img7.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img8.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img9.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img10.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="pagination_list d-flex align-items-center justify-content-end flex-wrap-wrap g-sm">
                        <li>
                            <button type="button">
                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.91675 12.8334L1.08341 7.00002L6.91675 1.16669" stroke="#424C60"
                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </li>
                        <li class="active_pagination">
                            <a href="#">1</a>
                        </li>
                        <li>
                            <a href="#">2</a>
                        </li>
                        <li>
                            <a href="#">3</a>
                        </li>
                        <li>
                            <a href="#">4</a>
                        </li>
                        <li>
                            <a href="#">5</a>
                        </li>
                        <li>
                            <a href="#">6</a>
                        </li>
                        <li>
                            <a href="#">-</a>
                        </li>
                        <li>
                            <a href="#">100</a>
                        </li>
                        <li>
                            <button type="button">
                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.08325 1.16665L6.91659 6.99998L1.08325 12.8333" stroke="#424C60"
                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab_item" id="productionTab">
                    <div class="new_arrival_grid">
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img1.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img2.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img3.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img4.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img5.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img6.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img7.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img8.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img9.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img10.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img1.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img2.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img3.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img4.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img5.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img6.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img7.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img8.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img9.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img10.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img1.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img2.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img3.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img4.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img5.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img6.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img7.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img8.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img9.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img10.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="pagination_list d-flex align-items-center justify-content-end flex-wrap-wrap g-sm">
                        <li>
                            <button type="button">
                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.91675 12.8334L1.08341 7.00002L6.91675 1.16669" stroke="#424C60"
                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </li>
                        <li class="active_pagination">
                            <a href="#">1</a>
                        </li>
                        <li>
                            <a href="#">2</a>
                        </li>
                        <li>
                            <a href="#">3</a>
                        </li>
                        <li>
                            <a href="#">4</a>
                        </li>
                        <li>
                            <a href="#">5</a>
                        </li>
                        <li>
                            <a href="#">6</a>
                        </li>
                        <li>
                            <a href="#">-</a>
                        </li>
                        <li>
                            <a href="#">100</a>
                        </li>
                        <li>
                            <button type="button">
                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.08325 1.16665L6.91659 6.99998L1.08325 12.8333" stroke="#424C60"
                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab_item" id="beautyTab">
                    <div class="new_arrival_grid">
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img1.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img2.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img3.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img4.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img5.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img6.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img7.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img8.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img9.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img10.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img1.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img2.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img3.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img4.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img5.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img6.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img7.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img8.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img9.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img10.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img1.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img2.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img3.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img4.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img5.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img6.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img7.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img8.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img9.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                        <div class="product_item product_item_text">
                            <a href="product-details.html" class="product_img hover_color">
                                <img src="{{ asset('assets/front/images/product/new_arrivals_img10.png') }}" alt="product image" />
                            </a>
                            <div class="product_content">
                                <h3>
                                    <a href="product-details.html">Products Name, Brand Name, Destails Here</a>
                                </h3>
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                    4.9
                                    <span>(1200 Reviews)</span>
                                </div>
                                <div class="product_price">
                                    <h4>$230.00</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="pagination_list d-flex align-items-center justify-content-end flex-wrap-wrap g-sm">
                        <li>
                            <button type="button">
                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.91675 12.8334L1.08341 7.00002L6.91675 1.16669" stroke="#424C60"
                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </li>
                        <li class="active_pagination">
                            <a href="#">1</a>
                        </li>
                        <li>
                            <a href="#">2</a>
                        </li>
                        <li>
                            <a href="#">3</a>
                        </li>
                        <li>
                            <a href="#">4</a>
                        </li>
                        <li>
                            <a href="#">5</a>
                        </li>
                        <li>
                            <a href="#">6</a>
                        </li>
                        <li>
                            <a href="#">-</a>
                        </li>
                        <li>
                            <a href="#">100</a>
                        </li>
                        <li>
                            <button type="button">
                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.08325 1.16665L6.91659 6.99998L1.08325 12.8333" stroke="#424C60"
                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>