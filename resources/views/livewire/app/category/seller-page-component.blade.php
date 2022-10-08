<div>
    <!-- All Sellar Section  -->
    <section class="all_sellar_wrapper">
        <div class="my-container">
            <h3 class="sellar_title">All Sellers</h3>
            <div class="sellar_brand_area">
                <div class="sellar_brand_grid">
                    @foreach ($topSellers as $topSeller)
                    <div class="sellar_brand_item_grid">
                        <div class="sellar_brand_img">
                            <div>
                                <img src="{{ $topSeller->logo }}" alt="" />
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                            <div>
                                <h4>{{ $topSeller->name }}</h4>
                                <div class="sellar_brand_review_area d-flex align-items-center">
                                    <img src="{{ asset('assets/front/images/icon/Star.svg') }}" class="star_img" alt="" />
                                    <span><b>{{ seller_avg_review($topSeller->id) }}</b></span> <span>({{ seller_review($topSeller->id) }} Reviews)</span>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('shop.seller', ['slug'=>$topSeller->slug]) }}" class="default_btn_bg">Visit Store</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{ $topSellers->links('front-pagination-links') }}
            </div>
        </div>
    </section>
</div>