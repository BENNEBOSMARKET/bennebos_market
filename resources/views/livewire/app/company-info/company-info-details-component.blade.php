@section('title') {{ $companyDetails->company_name }} @endsection
<div>
    <!-- Page Pagination Section  -->
    <section class="page_pagination_wrapper">
        <div class="my-container">
            <ul class="page_pagination_list d-flex align-items-center flex-wrap-wrap">
                <li>
                    <a href="/">{{ __('auth.company_home') }}</a>
                    <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                </li>
                <li>
                    <a href="{{ route('company-informations') }}">{{ __('auth.info') }}</a>
                    <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                </li>
                <li>
                    {{ __('auth.company_details') }}
                    <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                </li>
            </ul>
        </div>
    </section>
    <!-- Info Detail Section   -->
    <section class="info_details_wrapper">
        <div class="my-container">
            <div class="search_info_title d-flex align-items-center justify-content-between flex-wrap-wrap ">
                <div class="info_img_name_area">
                    @if ($companyDetails->logo != '')
                        <img src="{{ $companyDetails->logo }}" class="sellar_info_logo" alt="" />
                    @else
                        <img src="{{ asset('assets/images/company_info_logo.png') }}" class="sellar_info_logo" alt="" />
                    @endif
                    <div>
                        <h3>{{ $companyDetails->company_name }}</h3>
                        <h4 class="d-flex align-items-center g-sm">
                            <img src="{{ asset('assets/front/images/icon/Location.svg') }}" alt="" />
                            <span>{{ $companyDetails->address }}</span>
                        </h4>
                    </div>
                </div>
                <div class="sellar_contact_info_button d-flex align-items-center flex-wrap-wrap  ">
                    <button type="button" class="info_button" id="cartHeartIcon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                stroke="#424C60" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <a href="{{ route('company-info.mapview') }}" class="info_button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M11.1734 2.04399C8.46176 2.48759 6.73332 4.66546 6.72609 7.64766C6.72456 8.27023 6.76428 8.60559 6.90751 9.17901C7.11707 10.0181 7.44 10.8224 8.00237 11.9061C8.18406 12.2563 8.33272 12.551 8.33272 12.5609C8.33272 12.5709 7.81324 12.5791 7.17829 12.5791C5.94286 12.5791 5.8585 12.5904 5.68862 12.7793C5.56716 12.9143 2 21.2628 2 21.412C2 21.6075 2.13776 21.8326 2.31171 21.9213C2.46506 21.9995 2.52186 22 12.0073 22C21.4927 22 21.5495 21.9995 21.7028 21.9213C21.8768 21.8326 22.0145 21.6075 22.0145 21.412C22.0145 21.2628 18.4474 12.9143 18.3259 12.7793C18.156 12.5904 18.0717 12.5791 16.8362 12.5791C16.2013 12.5791 15.6818 12.5712 15.6818 12.5617C15.6818 12.5521 15.8392 12.2398 16.0315 11.8678C16.9272 10.1351 17.2872 8.93708 17.2866 7.69199C17.2858 6.338 16.9663 5.21605 16.2962 4.21423C16.0439 3.83705 15.3551 3.14815 14.9782 2.89601C14.4167 2.5205 13.7707 2.2487 13.0823 2.09848C12.6063 1.99461 11.6433 1.96709 11.1734 2.04399ZM12.5936 3.21495C13.2509 3.31463 13.739 3.49918 14.26 3.84498C15.4572 4.6397 16.1108 6.00061 16.1116 7.70051C16.1123 9.16842 15.371 10.9617 13.7648 13.3782C13.3334 14.0271 12.4044 15.2991 12.1072 15.6477L12.0073 15.765L11.9066 15.6477C11.6225 15.3169 10.6862 14.0342 10.25 13.3782C9.09269 11.6378 8.3613 10.1545 8.0345 8.88501C7.93118 8.48366 7.92375 8.4029 7.92301 7.67319C7.92239 6.99672 7.9345 6.83606 8.01319 6.48092C8.12417 5.97993 8.32111 5.46921 8.56211 5.0575C8.77339 4.69654 9.26254 4.16166 9.60075 3.92172C10.4573 3.31409 11.5483 3.05644 12.5936 3.21495ZM11.7222 5.54676C11.2153 5.61994 10.6832 6.00432 10.4535 6.46337C10.2882 6.79376 10.2339 7.06196 10.2589 7.42614C10.3134 8.22062 10.9205 8.87922 11.7323 9.02429C12.7162 9.20012 13.6865 8.43374 13.7556 7.42614C13.835 6.26752 12.8751 5.38031 11.7222 5.54676ZM12.324 6.8042C12.586 6.97921 12.6697 7.33482 12.5057 7.57585C12.3625 7.78616 12.2277 7.86415 12.0073 7.86415C11.7868 7.86415 11.652 7.78616 11.5089 7.57585C11.2658 7.21876 11.5574 6.71546 12.0073 6.71546C12.1334 6.71546 12.2329 6.74334 12.324 6.8042ZM9.31172 14.1062C9.44275 14.3011 9.66299 14.6208 9.80105 14.8166C9.93916 15.0125 10.0479 15.1761 10.0427 15.1803C10.0374 15.1845 8.87218 15.7817 7.45318 16.5075C6.03418 17.2332 4.84234 17.843 4.80461 17.8627C4.74469 17.8939 4.74746 17.8723 4.82654 17.6917C4.87631 17.578 5.2764 16.645 5.71571 15.6184L6.51441 13.7518H7.79393H9.07342L9.31172 14.1062ZM18.3724 15.7883C18.8522 16.9083 19.239 17.8292 19.2321 17.8347C19.2252 17.8402 17.9266 18.5158 16.3464 19.336L13.4732 20.8273H12.8671H12.261L10.4548 19.0193L8.64854 17.2114L9.68668 16.6836C10.2577 16.3934 10.7394 16.1559 10.7571 16.1559C10.7749 16.1559 10.9723 16.3758 11.1958 16.6445C11.6637 17.2073 11.6664 17.2098 11.8588 17.2623C12.0967 17.3272 12.2921 17.2539 12.5011 17.0213C12.9791 16.4897 13.9285 15.2418 14.5647 14.3089L14.9446 13.7518H16.2224H17.5002L18.3724 15.7883ZM8.80498 20.8179C7.83897 20.8235 6.24738 20.8235 5.26808 20.8179L3.48753 20.8077L3.74846 20.2005L4.00943 19.5933L5.77039 18.6894L7.53136 17.7854L9.04633 19.2966L10.5613 20.8077L8.80498 20.8179ZM20.1311 19.8891L20.5233 20.8077L19.4121 20.8181C18.8009 20.8238 17.7978 20.8238 17.183 20.8181L16.065 20.8077L17.8768 19.8642C18.8733 19.3453 19.7 18.932 19.7138 18.9456C19.7277 18.9593 19.9155 19.3838 20.1311 19.8891Z"
                                fill="#13192B" />
                        </svg>
                    </a>
                </div>
            </div>
            @if ($companyDetails->description != '')
                <div class="info_details_item">
                    <h2>{{ __('auth.company_details') }}</h2>
                    <p>
                        {{ $companyDetails->description }}
                    </p>
                </div>
            @endif

            <div class="info_details_item table_info_item">
                <h2>{{ __('auth.company_profile') }}</h2>
                <div class="info_table_wrapper">


                    <table class="info_table">

                        @if ($companyDetails->established != '')
                            <tr>
                                <td class="info_name">
                                    <h5>Year Established</h5>
                                </td>
                                <td>
                                    <h6>{{ $companyDetails->established }}</h6>
                                </td>
                            </tr>
                        @endif
                        @if ($companyDetails->category != null)
                            <tr>
                                <td class="info_name">
                                    <h5>Business Type</h5>
                                </td>
                                <td>
                                    <h6>
                                        {{ companyCategory($companyDetails->category) }}
                                    </h6>
                                </td>
                            </tr>
                        @endif

                        @if ($companyDetails->proprietor != '')
                            <tr>
                                <td class="info_name">
                                    <h5>{{ __('auth.proprietor') }}</h5>
                                </td>
                                <td>
                                    <h6>{{ $companyDetails->proprietor }}</h6>
                                </td>
                            </tr>
                        @endif

                        @if ($companyDetails->telephone != '')
                            <tr>
                                <td class="info_name">
                                    <h5>{{ __('auth.telephone') }}</h5>
                                </td>
                                <td>
                                    <h6><a href="tel:{{ $companyDetails->telephone }}">{{ $companyDetails->telephone }}</a></h6>
                                </td>
                            </tr>
                        @endif

                        @if ($companyDetails->fax != '')
                            <tr>
                                <td class="info_name">
                                    <h5>{{ __('auth.fax') }}</h5>
                                </td>
                                <td>
                                    <h6>{{ $companyDetails->fax }}</h6>
                                </td>
                            </tr>
                        @endif

                        @if ($companyDetails->mobile != '')
                            <tr>
                                <td class="info_name">
                                    <h5>{{ __('auth.mobile_phone') }}</h5>
                                </td>
                                <td>
                                    <h6><a>{{ substr($companyDetails->mobile, 0, 5) }}******</a></h6>
                                </td>
                            </tr>
                        @endif


                        @if ($companyDetails->email != '')
                            <tr>
                                <td class="info_name">
                                    <h5>{{ __('auth.email') }}</h5>
                                </td>
                                <td>
                                    <h6><a href="javascript:void(0)">{{ Str::limit($companyDetails->email, 1,'***@***.com') }}</a></h6>
                                </td>
                            </tr>
                        @endif


                        @if ($companyDetails->website != '')
                            <tr>
                                <td class="info_name">
                                    <h5>{{ __('auth.website') }}</h5>
                                </td>
                                <td>
                                    <h6><a href="{{ $companyDetails->website }}" target="_blank">{{ $companyDetails->website }}</a></h6>
                                </td>
                            </tr>
                        @endif


                        @if ($companyDetails->zip_code != '')
                            <tr>
                                <td class="info_name">
                                    <h5>{{ __('auth.zip_code') }}</h5>
                                </td>
                                <td>
                                    <h6>{{ $companyDetails->zip_code }}</h6>
                                </td>
                            </tr>
                        @endif

                        @if ($companyDetails->country_id != '')
                            <tr>
                                <td class="info_name">
                                    <h5>{{ __('auth.country') }}</h5>
                                </td>
                                <td>
                                    <h6>{{ country($companyDetails->country_id)->name }}</h6>
                                </td>
                            </tr>
                        @endif

                        @if ($companyDetails->state_id != '')
                            <tr>
                                <td class="info_name">
                                    <h5>{{ __('auth.state') }}</h5>
                                </td>
                                <td>
                                    <h6></h6>
                                </td>
                            </tr>
                        @endif

                        @if ($companyDetails->address != '')
                            <tr>
                                <td class="info_name">
                                    <h5>{{ __('auth.address') }}</h5>
                                </td>
                                <td>
                                    <h6>{{ $companyDetails->address }}</h6>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>

            @php
            $facebook = '';
            $twitter = '';
            $instagram = '';
            $linkedin = '';
            $whatsapp = '';
            $youtube = '';
                 if($companyDetails->social_media != ['']){
                 foreach(json_decode(str_replace("'", '"',$companyDetails['social_media'])) as $social){
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

            <ul class="sellar_info_social_list d-flex align-items-center flex-wrap-wrap">
                @if ($facebook)
                <li>
                    <a href="{{ $facebook }}" target="_blank">
                        <img src="{{ asset('assets/front/images/footer/social_icon_1.svg') }}" alt="footer social">
                    </a>
                </li>
                @endif
                @if ($twitter)
                <li>
                    <a href="{{ $twitter }}" target="_blank">
                        <img src="{{ asset('assets/front/images/footer/social_icon_2.svg') }}" alt="footer social">
                    </a>
                </li>
                @endif
                @if ($whatsapp)
                <li>
                    <a href="{{ $whatsapp }}" target="_blank">
                        <img src="{{ asset('assets/front/images/footer/social_icon_3.svg') }}" alt="footer social">
                    </a>
                </li>
                @endif
                @if ($linkedin)
                <li>
                    <a href="{{ $linkedin }}" target="_blank">
                        <img src="{{ asset('assets/front/images/footer/social_icon_4.svg') }}" alt="footer social">
                    </a>
                </li>
                @endif
                @if ($instagram)
                <li>
                    <a href="{{ $instagram }}" target="_blank">
                        <img src="{{ asset('assets/front/images/footer/social_icon_5.svg') }}" alt="footer social">
                    </a>
                </li>
                @endif
                @if ($youtube)
                <li>
                    <a href="{{ $youtube }}" target="_blank">
                        <img src="{{ asset('assets/front/images/footer/social_icon_6.svg') }}" alt="footer social">
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </section>
</div>
