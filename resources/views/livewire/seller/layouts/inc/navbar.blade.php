<div>
    <style>
        @media only screen and (min-width: 1340px) {
            .toogle-icon {
                display: none;
            }
        }
    </style>
    <div class="topbar">
        <nav class="navbar-custom" id="navbar-custom">
            <ul class="list-unstyled topbar-nav float-end mb-0">
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        @if (app()->getLocale() == 'ar')
                        <img src="{{ asset('assets/seller/images/flags/ar_flag.png') }}" alt=""
                            class="thumb-xxs rounded-circle">
                        @elseif(app()->getLocale() == 'en')
                        <img src="{{ asset('assets/seller/images/flags/us_flag.jpg') }}" alt=""
                            class="thumb-xxs rounded-circle">
                        @elseif(app()->getLocale() == 'tur')
                        <img src="{{ asset('assets/seller/images/flags/tur_flag.png') }}" alt=""
                            class="thumb-xxs rounded-circle">
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('changeLanguage', ['locale' => 'ar']) }}"><img
                                src="{{ asset('assets/seller/images/flags/ar_flag.png') }}" alt="" height="12"
                                class="me-2">Arabic</a>
                        <a class="dropdown-item" href="{{ route('changeLanguage', ['locale' => 'en']) }}"><img
                                src="{{ asset('assets/seller/images/flags/us_flag.jpg') }}" alt="" height="12"
                                class="me-2">English</a>
                        <a class="dropdown-item" href="{{ route('changeLanguage', ['locale' => 'tur']) }}"><img
                                src="{{ asset('assets/seller/images/flags/tur_flag.png') }}" alt="" height="12"
                                class="me-2">Turkish</a>
                        <a class="dropdown-item" href="{{ route('changeLanguage', ['locale' => 'fr']) }}"><img
                                src="{{ asset('assets/seller/images/flags/tur_flag.png') }}" alt="" height="12"
                                class="me-2">France</a>
                    </div>
                </li>
                {{-- Notification --}}
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti ti-bell"></i>
                        @if ($notifications->count() > 0)
                        <span class="alert-badge"></span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-lg pt-0">

                        <h6
                            class="dropdown-item-text font-15 m-0 py-3 border-bottom d-flex justify-content-between align-items-center">
                            {{ __('seller.notifications') }}
                        </h6>
                        <div class="notification-menu" data-simplebar>
                            @foreach ($notifications as $notification)
                            @if ($notification->subject == 'New Order')
                            @php
                            $content = json_decode($notification->content);
                            @endphp
                            <a href="{{ route('seller.orderDetails', $content->order->id) }}"
                                class="dropdown-item py-3">
                                <div class="media">
                                    <div class="avatar-md bg-soft-primary">
                                        <i class="ti ti-chart-arcs"></i>
                                    </div>
                                    <div class="media-body align-self-center ms-2 text-truncate">
                                        <h6 class="my-0 fw-normal text-dark">{{ $content->body }}</h6>
                                    </div>
                                </div>
                            </a>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </li>


                <li class="dropdown">
                    <a class="nav-link dropdown-toggle nav-user" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            @if (authSeller()->avatar)
                            <img src="{{ authSeller()->avatar }}"
                                class="rounded-circle thumb-sm" style="height: 40px; width: 40px; margin-right: 10px;">
                            @else
                            <img src="{{ asset('assets/images/avatar-place.png') }}" class="rounded-circle thumb-sm"
                                style="height: 40px; width: 40px; margin-right: 10px;">
                            @endif
                            <div>
                                <span class="d-none d-md-block font-15">{{ authSeller()->name }}</span>
                                <small class="d-none d-md-block fw-semibold font-12">{{ __('seller.id_navbar') }}
                                    {{ authSeller()->id }}</small>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#pointModal"
                            class="dropdown-item text-center">
                            <h5 style="color: black;"><strong>{{ $totalPoints }}</strong></h5>
                            <p style="color: black;">My points</p>
                        </a>
                        <div class="dropdown-divider mb-0"></div>
                        <a class="dropdown-item" href="#"><i class="ti ti-user font-16 me-1 align-text-bottom"></i> {{
                            __('seller.profile') }}</a>
                        <a class="dropdown-item" href="#"><i class="ti ti-settings font-16 me-1 align-text-bottom"></i>
                            {{ __('seller.settings_sidebar') }}</a>
                        <div class="dropdown-divider mb-0"></div>
                        <a class="dropdown-item" href="{{ route('seller.logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="ti ti-power font-16 me-1 align-text-bottom"></i> {{ __('seller.logout') }}</a>
                        <form id="logout-form" style="display: none;" method="POST"
                            action="{{ route('seller.logout') }}">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            <!--end topbar-nav-->

            <ul class="list-unstyled topbar-nav mb-0">
                <li class="toogle-icon">
                    <button class="nav-link button-menu-mobile nav-icon" id="togglemenu">
                        <i class="ti ti-menu-2"></i>
                    </button>
                </li>
                <li style="margin-left: 10px;">
                    <h4>@yield('page_title')</h4>
                </li>
            </ul>
        </nav>
    </div>

    <div wire:ignore.self class="modal fade" id="pointModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">My Points</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h3 style="color: white;"><strong>{{ $totalPoints }}</strong></h3>
                                    <p style="color: white;" class="mt-2">Points Available</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header text-white text-center">Redeem Points</div>
                                <div class="card-body">
                                    <form wire:submit.prevent="reedemPoint">
                                        <div class="mb-3">
                                            <label for="example-text-input">Enter Point</label>
                                            <input class="form-control" type="number" wire:model="point"
                                                placeholder="Enter points to reedem" wire:keyup='calculate'>
                                            @error('point')
                                            <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input">Amount Will Added</label>
                                            <input class="form-control" type="number" wire:model="amount"
                                                placeholder="0" readonly>
                                            @error('amount')
                                            <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-sm btn-primary">{!!
                                                    loadingStateWithText('reedemPoint', 'Redeem') !!}</button>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    data-bs-dismiss="modal">{{ __('seller.add_new_cancel') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@push('scripts')
<script>
    window.addEventListener('closeModal', event => {
        $('#pointModal').modal('hide');
    });
</script>
@endpush