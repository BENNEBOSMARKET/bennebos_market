<div>
    <section class="profile_account_wrapper">
        <div class="my-container">
            <div class="profile_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                <h3 class="cart_title">Dashboard</h3>
                <button type="button" id="profileSidebarIcon">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            <div class="profile_sidebar_grid_area">
                @livewire('customer.inc.sidebar')
                <div class="profile_content_wrapper">
                    <div
                      class="profile_content_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm"
                    >
                      <h3>Returns & Cancel</h3>
                      <div
                        class="category_product_title d-flex align-items-center g-sm"
                      >
                        <div class="d-flex align-items-center g-sm">
                          <img
                            src="{{ asset('assets/front/images/icon/filter.svg') }}"
                            alt="filter icon"
                          />
                          <h5>Sort By</h5>
                        </div>
                        <div class="selectbox_row">
                          <select>
                            <option data-display="All Orders">All Orders</option>
                            <option value="1">Price High to Low</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="order_product_item_area">
                      <div class="order_product_item">
                        <div
                          class="order_status_title_area d-flex align-items-center justify-content-between g-sm"
                        >
                          <div
                            class="order_number_status_title d-flex align-items-center flex-wrap-wrap"
                          >
                            <h4>Your Order ID: 000123456</h4>
                            <h5 class="order_status order_status_proccess">
                              Proccess
                            </h5>
                          </div>
                          <div class="order_more_button">
                            <button type="button">
                              <img
                                src="{{ asset('assets/front/images/icon/three_dot_icon.svg') }}"
                                id="orderMoreButton"
                                alt="three dot icon"
                              />
                            </button>
      
                            <ul class="order_dropdwon_list">
                              <li>
                                <a href="#" class="order_dropdown_item">
                                  <svg
                                    width="16"
                                    height="20"
                                    viewBox="0 0 16 20"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                  >
                                    <path
                                      fill-rule="evenodd"
                                      clip-rule="evenodd"
                                      d="M7.98493 13.3462C4.11731 13.3462 0.814453 13.931 0.814453 16.2729C0.814453 18.6148 4.09636 19.2205 7.98493 19.2205C11.8525 19.2205 15.1545 18.6348 15.1545 16.2938C15.1545 13.9529 11.8735 13.3462 7.98493 13.3462Z"
                                      stroke="#424C60"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    ></path>
                                    <path
                                      fill-rule="evenodd"
                                      clip-rule="evenodd"
                                      d="M7.98489 10.0059C10.523 10.0059 12.5801 7.94779 12.5801 5.40969C12.5801 2.8716 10.523 0.814453 7.98489 0.814453C5.44679 0.814453 3.3887 2.8716 3.3887 5.40969C3.38013 7.93922 5.42394 9.99731 7.95251 10.0059H7.98489Z"
                                      stroke="#424C60"
                                      stroke-width="1.42857"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    ></path>
                                  </svg>
      
                                  <span>Option 1</span>
                                </a>
                              </li>
                              <li>
                                <button type="button" class="order_dropdown_item">
                                  <svg
                                    width="21"
                                    height="21"
                                    viewBox="0 0 21 21"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                  >
                                    <path
                                      d="M13.016 5.38948V4.45648C13.016 2.42148 11.366 0.771484 9.33097 0.771484H4.45597C2.42197 0.771484 0.771973 2.42148 0.771973 4.45648V15.5865C0.771973 17.6215 2.42197 19.2715 4.45597 19.2715H9.34097C11.37 19.2715 13.016 17.6265 13.016 15.5975V14.6545"
                                      stroke="#EB5757"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    ></path>
                                    <path
                                      d="M19.8096 10.0214H7.76855"
                                      stroke="#EB5757"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    ></path>
                                    <path
                                      d="M16.8813 7.10632L19.8093 10.0213L16.8813 12.9373"
                                      stroke="#EB5757"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    ></path>
                                  </svg>
                                  <span> Option 2 </span>
                                </button>
                              </li>
                            </ul>
                            <div class="order_dropdown_overlay"></div>
                          </div>
                        </div>
                        <div class="order_product_area">
                          <div class="order_product_details_area">
                            <a href="#" class="hover_color">
                              <img
                                src="{{ asset('assets/front/images/product/order_product_img_1.png') }}"
                                class="order_product_img"
                                alt="product image"
                              />
                            </a>
                            <div class="order_product_content">
                              <h3>
                                <a href="#">
                                  Products Name, Brand Name, Details Here
                                </a>
                              </h3>
                              <h5>Seller Name Here</h5>
                              <h4>$120.00</h4>
                            </div>
                          </div>
                          <div class="order_date_area">
                            <h4>Returns Date</h4>
                            <h5>26 Apr To 29 Apr 2022</h5>
                          </div>
                        </div>
                      </div>
      
                      <div class="order_product_item">
                        <div
                          class="order_status_title_area d-flex align-items-center justify-content-between g-sm"
                        >
                          <div
                            class="order_number_status_title d-flex align-items-center flex-wrap-wrap"
                          >
                            <h4>Your Order ID: 000123456</h4>
                            <h5 class="order_status order_delivery">Change</h5>
                          </div>
                          <div class="order_more_button">
                            <button type="button">
                              <img
                                src="{{ asset('assets/front/images/icon/three_dot_icon.svg') }}"
                                id="orderMoreButton"
                                alt="three dot icon"
                              />
                            </button>
      
                            <ul class="order_dropdwon_list">
                              <li>
                                <a href="#" class="order_dropdown_item">
                                  <svg
                                    width="16"
                                    height="20"
                                    viewBox="0 0 16 20"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                  >
                                    <path
                                      fill-rule="evenodd"
                                      clip-rule="evenodd"
                                      d="M7.98493 13.3462C4.11731 13.3462 0.814453 13.931 0.814453 16.2729C0.814453 18.6148 4.09636 19.2205 7.98493 19.2205C11.8525 19.2205 15.1545 18.6348 15.1545 16.2938C15.1545 13.9529 11.8735 13.3462 7.98493 13.3462Z"
                                      stroke="#424C60"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    ></path>
                                    <path
                                      fill-rule="evenodd"
                                      clip-rule="evenodd"
                                      d="M7.98489 10.0059C10.523 10.0059 12.5801 7.94779 12.5801 5.40969C12.5801 2.8716 10.523 0.814453 7.98489 0.814453C5.44679 0.814453 3.3887 2.8716 3.3887 5.40969C3.38013 7.93922 5.42394 9.99731 7.95251 10.0059H7.98489Z"
                                      stroke="#424C60"
                                      stroke-width="1.42857"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    ></path>
                                  </svg>
      
                                  <span>Option 1</span>
                                </a>
                              </li>
                              <li>
                                <button type="button" class="order_dropdown_item">
                                  <svg
                                    width="21"
                                    height="21"
                                    viewBox="0 0 21 21"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                  >
                                    <path
                                      d="M13.016 5.38948V4.45648C13.016 2.42148 11.366 0.771484 9.33097 0.771484H4.45597C2.42197 0.771484 0.771973 2.42148 0.771973 4.45648V15.5865C0.771973 17.6215 2.42197 19.2715 4.45597 19.2715H9.34097C11.37 19.2715 13.016 17.6265 13.016 15.5975V14.6545"
                                      stroke="#EB5757"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    ></path>
                                    <path
                                      d="M19.8096 10.0214H7.76855"
                                      stroke="#EB5757"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    ></path>
                                    <path
                                      d="M16.8813 7.10632L19.8093 10.0213L16.8813 12.9373"
                                      stroke="#EB5757"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    ></path>
                                  </svg>
                                  <span> Option 2 </span>
                                </button>
                              </li>
                            </ul>
                            <div class="order_dropdown_overlay"></div>
                          </div>
                        </div>
                        <div class="order_product_area">
                          <div class="order_product_details_area">
                            <a href="#" class="hover_color">
                              <img
                                src="{{ asset('assets/front/images/product/order_product_img_1.png') }}"
                                class="order_product_img"
                                alt="product image"
                              />
                            </a>
                            <div class="order_product_content">
                              <h3>
                                <a href="#">
                                  Products Name, Brand Name, Details Here
                                </a>
                              </h3>
                              <h5>Seller Name Here</h5>
                              <h4>$120.00</h4>
                            </div>
                          </div>
                          <div class="order_date_area">
                            <h4>Delivery Date</h4>
                            <h5>26 Apr To 29 Apr 2022</h5>
                          </div>
                        </div>
                      </div>
                      <div class="order_product_item">
                        <div
                          class="order_status_title_area d-flex align-items-center justify-content-between g-sm"
                        >
                          <div
                            class="order_number_status_title d-flex align-items-center flex-wrap-wrap"
                          >
                            <h4>Your Order ID: 000123456</h4>
                            <h5 class="order_status order_shipping">Refunded</h5>
                          </div>
                          <div class="order_more_button">
                            <button type="button">
                              <img
                                src="{{ asset('assets/front/images/icon/three_dot_icon.svg') }}"
                                id="orderMoreButton"
                                alt="three dot icon"
                              />
                            </button>
      
                            <ul class="order_dropdwon_list">
                              <li>
                                <a href="#" class="order_dropdown_item">
                                  <svg
                                    width="16"
                                    height="20"
                                    viewBox="0 0 16 20"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                  >
                                    <path
                                      fill-rule="evenodd"
                                      clip-rule="evenodd"
                                      d="M7.98493 13.3462C4.11731 13.3462 0.814453 13.931 0.814453 16.2729C0.814453 18.6148 4.09636 19.2205 7.98493 19.2205C11.8525 19.2205 15.1545 18.6348 15.1545 16.2938C15.1545 13.9529 11.8735 13.3462 7.98493 13.3462Z"
                                      stroke="#424C60"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    ></path>
                                    <path
                                      fill-rule="evenodd"
                                      clip-rule="evenodd"
                                      d="M7.98489 10.0059C10.523 10.0059 12.5801 7.94779 12.5801 5.40969C12.5801 2.8716 10.523 0.814453 7.98489 0.814453C5.44679 0.814453 3.3887 2.8716 3.3887 5.40969C3.38013 7.93922 5.42394 9.99731 7.95251 10.0059H7.98489Z"
                                      stroke="#424C60"
                                      stroke-width="1.42857"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    ></path>
                                  </svg>
      
                                  <span>Option 1</span>
                                </a>
                              </li>
                              <li>
                                <button type="button" class="order_dropdown_item">
                                  <svg
                                    width="21"
                                    height="21"
                                    viewBox="0 0 21 21"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                  >
                                    <path
                                      d="M13.016 5.38948V4.45648C13.016 2.42148 11.366 0.771484 9.33097 0.771484H4.45597C2.42197 0.771484 0.771973 2.42148 0.771973 4.45648V15.5865C0.771973 17.6215 2.42197 19.2715 4.45597 19.2715H9.34097C11.37 19.2715 13.016 17.6265 13.016 15.5975V14.6545"
                                      stroke="#EB5757"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    ></path>
                                    <path
                                      d="M19.8096 10.0214H7.76855"
                                      stroke="#EB5757"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    ></path>
                                    <path
                                      d="M16.8813 7.10632L19.8093 10.0213L16.8813 12.9373"
                                      stroke="#EB5757"
                                      stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    ></path>
                                  </svg>
                                  <span> Option 2 </span>
                                </button>
                              </li>
                            </ul>
                            <div class="order_dropdown_overlay"></div>
                          </div>
                        </div>
                        <div class="order_product_area">
                          <div class="order_product_details_area">
                            <a href="#" class="hover_color">
                              <img
                                src="{{ asset('assets/front/images/product/order_product_img_1.png') }}"
                                class="order_product_img"
                                alt="product image"
                              />
                            </a>
                            <div class="order_product_content">
                              <h3>
                                <a href="#">
                                  Products Name, Brand Name, Details Here
                                </a>
                              </h3>
                              <h5>Seller Name Here</h5>
                              <h4>$120.00</h4>
                            </div>
                          </div>
                          <div class="order_date_area">
                            <h4>Refund Approve Date</h4>
                            <h5>26 Apr To 29 Apr 2022</h5>
                          </div>
                        </div>
                      </div>
                    </div>
      
                    <ul
                      class="pagination_list d-flex align-items-center justify-content-end flex-wrap-wrap g-sm"
                    >
                      <li>
                        <button type="button">
                          <svg
                            width="8"
                            height="14"
                            viewBox="0 0 8 14"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M6.91675 12.8334L1.08341 7.00002L6.91675 1.16669"
                              stroke="#424C60"
                              stroke-width="1.25"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
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
                          <svg
                            width="8"
                            height="14"
                            viewBox="0 0 8 14"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M1.08325 1.16665L6.91659 6.99998L1.08325 12.8333"
                              stroke="#424C60"
                              stroke-width="1.25"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                          </svg>
                        </button>
                      </li>
                    </ul>
                  </div>
            </div>
        </div>
        <div class="profile_sidebar_overlay" id="sidebarOverlay"></div>
    </section>
</div>