<div class="product_gallery_slider_area" wire:ignore>
    <!-- Swiper -->
    <div class="swiper gallery-top">
        <div class="swiper-wrapper">
            @if (sizeof(json_decode($gallery->image)) == 0)
                <div class="swiper-slide">
                    <div class="product_details_img">
                        <img src="{{ json_decode($product->color_image)[$sl] }}" alt="{{ $product->name }}" />
                    </div>
                </div>
            @endif
            @foreach (json_decode($gallery->image) as $key => $gimage)
                <div class="swiper-slide">
                    <div class="product_details_img">
                        <img src="{{ $gimage }}" alt="" />
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="swiper gallery-thumbs">
        <div class="swiper-wrapper">
            @if (sizeof(json_decode($gallery->image)) == 0)
                <div class="swiper-slide">
                    <div class="product_thumb">
                        <img src="{{ json_decode($product->color_image)[$sl] }}" alt="{{ $product->name }}" />
                    </div>
                </div>
            @endif
            @foreach (json_decode($gallery->image) as $key => $gimage)
                <div class="swiper-slide">
                    <div class="product_thumb">
                        <img src="{{ $gimage }}" alt="" />
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Add Arrows -->
    <div class="slider_arrow d-flex align-items-center">
        <div class="slider_prev_arrow product_gallery_prev_arrow">
            <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M8.5 15L1.5 8L8.5 1" stroke="#130F26" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <div class="slider_next_arrow product_gallery_next_arrow">
            <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M1.5 1L8.5 8L1.5 15" stroke="#130F26" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
    </div>
</div>