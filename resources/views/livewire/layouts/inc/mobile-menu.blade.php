<div>
    <section class="mobile_menu_wrapper" id="mobileNavbarArea">
        <select>
            <option data-display="English">English</option>
            <option value="1">BN</option>
            <option value="2">IN</option>
        </select>

        <div class="mobile_menu_close_icon text-end">
            <i class="fa-solid fa-xmark" id="mobileMenuCloseIcon"></i>
        </div>
        <ul class="mobile_menu_list" id="mobileMenuList">
            <li>
                <a href="#">Redeem Rewards</a>
            </li>
            <li>
                <a href="#">Ship</a>
            </li>
            <li>
                <a href="#">Support</a>
            </li>
            <li>
                <a href="{{ route('front.allCategories') }}">All Category</a>
            </li>
        </ul>
    </section>
    <div class="mobile_menu_overlay" id="mobileMenuOverlay"></div>
</div>
