@section('title') {{ __('auth.company_info') }} @endsection
<div>
    <style>
        #cstmSelect {
            width: 100%;
            background: #ffffff;
            border: 1px solid #e8e9ec;
            border-radius: 10px;
            padding-left: 15px;
            padding-right: 15px;
            font-size: 16px;
            color: #13192b;
            height: 46px;
        }

        #cstmSelect:focus {
            outline: none;
            box-shadow: 0 0 3pt 2pt #000000;
        }

        #cstmSelect::-webkit-scrollbar {
            width: 5px;
        }

        #cstmSelect::-webkit-scrollbar-track {
            background: rgba(153, 153, 153, 0.2);
            border-radius: 5px;
        }

        #cstmSelect::-webkit-scrollbar-thumb {
            background: #f84f4f;
            border-radius: 5px;
        }

        #cstmSelect::-webkit-scrollbar-thumb:hover {
            background: #74C247;
            cursor: -webkit-grab;
            cursor: grab;
        }

        @media all and (max-width: 991px) {
            #cstmSelect {
                -webkit-transition: 0.5s;
                transition: 0.5s;
                width: 100%;
            }
        }
    </style>
    <!-- Info page  -->
    <section class="info_wrapper">
        <div class="my-container">
            <div class="info_grid">
                <div class="info_filter_are">
                    <form action="" class="form_area">
                        <div class="info_filter_item">
                            <div class="input_row nice_select_row">
                                <div id="stat"></div>
                                <label for="">{{ __('auth.country') }}</label>
                                <select id="cstmSelect" class="country" wire:model='country_id'
                                    wire:change='selectCountry' wire:change='selectCountry'>
                                    <option value="">{{ __('auth.select_country') }}</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="info_filter_item">
                            <div class="input_row nice_select_row">
                                <label for="">{{ __('auth.category') }}</label>
                                <select id="cstmSelect" class="state" wire:model='category' wire:change='selectCategory'>
                                    <option value="">{{ __('auth.select_category') }}</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input_row nice_select_row">
                                <label for="">{{ __('auth.sub_category') }}</label>
                                <select id="cstmSelect" class="sub_category" wire:model='sub_category'>
                                    <option value="">{{ __('auth.select_sub_category') }}</option>
                                    @if ($sub_categories->count() > 0)
                                        @foreach ($sub_categories as $subcategory)
                                            <option value="{{ $subcategory->sub_category }}">{{ $subcategory->sub_category }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="info_content_area">
                    <div
                        class="info_search_area info_seach_map_area d-flex align-items-center justify-content-between flex-wrap-wrap g-lg">
                        <form action="" class="info_search_form">
                            <input type="text" placeholder="Search by company, state,">
                            <button type="button" id="searchInputIcon">
                                <img src="{{ asset('assets/front/images/header/Search.svg') }}" alt="search image">
                            </button>
                        </form>
                        <div class="map_features_area">
                            <div style="border: 1.5px solid #e8e9ec; padding: 10px; border-radius: 8px"
                                class="map-view">
                                <p><a href="{{ route('company-info.mapview') }}">{{ __('auth.map_view') }}</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="info_search_item_grid">
                        @foreach ($infos as $info)
                        <div class="info_search_item">
                            <div class="info_brand_logo_title">
                                @if($info->logo && $info->logo != ' ')
                                <div class="info_search_logo">
                                    <img src="{{ $info->logo }}" alt="info brand" />
                                </div>
                                @else
                                <img src="{{ asset('assets/images/company_info_logo.png') }}"
                                    class="sellar_img" alt="sellar img" />
                                @endif

                                <div class="info_brand_content">
                                    <h3><a href="{{ route('front.company.info', ['id'=>$info->id]) }}">{{
                                            $info->company_name }}</a></h3>
                                    <ul>
                                        @if ($info->address != '')
                                        <li>
                                            <img src="{{ asset('assets/front/images/icon/info_location.svg') }}"
                                                alt="" />
                                            <span>{{ $info->address }}</span>
                                        </li>
                                        @endif
                                        @if ($info->mobile != '')
                                        <li>
                                            <img src="{{ asset('assets/front/images/icon/info call.svg') }}" alt="" />
                                            <a>{{ substr($info->mobile, 0, 5)
                                                }}******</a>
                                        </li>
                                        @endif
                                        @if ($info->email != '')
                                        <li>
                                            <img src="{{ asset('assets/front/images/icon/info_sms.svg') }}" alt="" />
                                            <a href="javascript:void(0)">{{Str::limit($info->email, 1,'***@***.com')}}</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div
                                class="info_search_footer d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                <ul class="info_search_social_list d-flex align-items-center flex-wrap-wrap g-sm">

                                   @php
                                   $facebook = '';
                                   $twitter = '';
                                   $instagram = '';
                                   $linkedin = '';
                                   $whatsapp = '';
                                   $youtube = '';
                                        if($info->social_media != ['']){
                                        foreach(json_decode(str_replace("'", '"',$info['social_media'])) as $social){
                                            if(strpos($social, 'facebook') != false){
                                                $facebook = $social;
                                            }
                                            else if(strpos($social, 'twitter') != false){
                                                $twitter = $social;
                                            }
                                            else if(strpos($social, 'instagram') != false){
                                                $instagram = $social;
                                            }
                                            else if(strpos($social, 'linkedin') != false){
                                                $linkedin = $social;
                                            }
                                            else if(strpos($social, 'whatsapp') != false){
                                                $whatsapp = $social;
                                            }
                                            else if(strpos($social, 'youtube') != false){
                                                $youtube = $social;
                                            }
                                        }
                                    }
                                   @endphp


                                    @if ($facebook != '')
                                    <li>
                                        <a href="{{ $facebook }}" target="_blank">
                                            <img src="{{ asset('assets/front/images/icon/info_social_media_icon1.svg') }}"
                                                alt="" />
                                        </a>
                                    </li>
                                    @endif
                                    @if ($twitter != '')
                                    <li>
                                        <a href="{{ $twitter }}" target="_blank">
                                            <img src="{{ asset('assets/front/images/icon/info_social_media_icon2.svg') }}"
                                                alt="" />
                                        </a>
                                    </li>
                                    @endif
                                    @if ($instagram != '')
                                    <li>
                                        <a href="{{ $instagram }}" target="_blank">
                                            <img src="{{ asset('assets/front/images/icon/info_social_media_icon3.svg') }}"
                                                alt="" />
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                                @if ($info->website != '')
                                <a href="{{ $info->website }}" target="_blank"
                                    class="brand_website d-flex align-items-center flex-wrap-wrap g-sm">
                                    <div class="url_img">
                                        <img src="{{ asset('assets/front/images/icon/info_website.svg') }}" alt="" />
                                    </div>
                                    <div class="url_text d-flex align-items-center flex-wrap-wrap g-sm">
                                        <span>{{ __('auth.visit') }}</span>
                                        <svg width="13" height="15" viewBox="0 0 13 15" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.9839 0.821113C10.8851 0.277737 10.3645 -0.082667 9.82112 0.0161287L0.966286 1.6261C0.42291 1.72489 0.0625062 2.24548 0.161302 2.78885C0.260098 3.33223 0.780681 3.69263 1.32406 3.59384L9.19502 2.16275L10.6261 10.0337C10.7249 10.5771 11.2455 10.9375 11.7889 10.8387C12.3322 10.7399 12.6926 10.2193 12.5938 9.67594L10.9839 0.821113ZM1.82219 14.5692L10.8222 1.56921L9.17781 0.430789L0.177808 13.4308L1.82219 14.5692Z"
                                                fill="#13192B" />
                                        </svg>
                                    </div>
                                </a>
                                @endif
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                <br>
                {{ $infos->links('front-pagination-links') }}
            </div>
        </div>
    </section>

</div>

@push('scripts')
{{-- <script>
    $(document).ready(function(){
            $('.country').on('change', function(){
                @this.set('country', $(this).val());
            })
        });

</script> --}}
@endpush