<div>
    <!-- Notification Section  -->
    <section class="notification_wrapper">
        <div class="my-container">
          <div class="notification_content_wrapper">
            <div
              class="notification_title d-flex align-items-center justify-content-between flex-wrap-wrap g-sm"
            >
              <h2 class="cart_title"> {{ __('auth.notification') }}</h2>
              <button type="button">{{ __('auth.mark_all_as_read') }}</button>
            </div>
            <div class="notification_list_area">
              <ul>
                <li class="notification_list">
                  <img
                    src="{{ asset('assets/front/images/others/notification_img_1.png') }}"
                    alt="notification img"
                    class="notification_img"
                  />
                  <p>
                    {{ __('auth.notification_para1') }}
                  </p>
                </li>
                <li class="notification_list">
                  <img
                    src="{{ asset('assets/front/images/others/notification_img_2.png') }}"
                    alt="notification img"
                    class="notification_img"
                  />
                  <p>
                    {{ __('auth.notification_para2') }}
                  </p>
                </li>
                <li>
                  <a href="#">
                    <img
                      src="{{ asset('assets/front/images/banner/notification_banner_1.png') }}"
                      alt="notification banner"
                      class="notification_banner"
                    />
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img
                      src="{{ asset('assets/front/images/banner/notification_banner_2.png') }}"
                      alt="notification banner"
                      class="notification_banner"
                    />
                  </a>
                </li>
                <li class="notification_list">
                  <img
                    src="{{ asset('assets/front/images/others/notification_img_1.png') }}"
                    alt="notification img"
                    class="notification_img"
                  />
                  <p>
                    {{ __('auth.notification_para3') }}
                  </p>
                </li>
                <li class="notification_list">
                  <img
                    src="{{ asset('assets/front/images/others/notification_img_2.png') }}"
                    alt="notification img"
                    class="notification_img"
                  />
                  <p>
                    {{ __('auth.notification_para4') }}
                  </p>
                </li>
                <li>
                  <a href="#">
                    <img
                      src="{{ asset('assets/front/images/banner/notification_banner_3.png') }}"
                      alt="notification banner"
                      class="notification_banner"
                    />
                  </a>
                </li>
              </ul>
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
      </section>
</div>
