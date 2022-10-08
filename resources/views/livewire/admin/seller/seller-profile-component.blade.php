<div>
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#">Settings</a></li>
                            <li class="breadcrumb-item active">Seller Profile</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Seller Profile</h4>
                </div>
                <!--end page-title-box-->
            </div>
            <!--end col-->
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="met-profile">
                            <div class="row">
                                <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                    <div class="met-profile-main">
                                        <div class="met-profile-main-pic">
                                                @if ($sellerProfile->avatar)
                                                    <img src="{{  $sellerProfile->avatar }}" alt=""
                                                    height="110" class="rounded-circle">
                                                <span class="met-profile_main-pic-change">
                                                    <i class="fas fa-camera"></i>
                                                </span>
                                                @else
                                                <img src="{{ asset('assets/front/images/default/profile.png') }}" alt=""
                                                height="110" class="rounded-circle">
                                                <span class="met-profile_main-pic-change">
                                                    <i class="fas fa-camera"></i>
                                                </span>
                                                @endif
                                        </div>
                                        <div class="met-profile_user-detail">
                                            <h5 class="met-user-name">{{ $sellerProfile->name }}</h5>
                                            <p class="mb-0 met-user-name-post">UI/UX Designer, India</p>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-lg-4 ms-auto align-self-center">
                                    <ul class="list-unstyled personal-detail mb-0">
                                        <li class=""><i
                                                class="las la-phone mr-2 text-secondary font-22 align-middle"></i> <b>
                                                phone </b> : {{ $sellerProfile->phone }}</li>
                                        <li class="mt-2"><i
                                                class="las la-envelope text-secondary font-22 align-middle mr-2"></i>
                                            <b> Email </b> : {{ $sellerProfile->email }}</li>
                                        <li class="mt-2"><i
                                                class="las la-globe text-secondary font-22 align-middle mr-2"></i> <b>
                                                Website </b> :
                                            <a href=""
                                                class="font-14 text-primary">example.com</a>
                                        </li>
                                    </ul>

                                </div>
                                <!--end col-->
                                <div class="col-lg-4 align-self-center">
                                    <div class="row">
                                        <div class="col-auto text-end border-end">
                                            <button type="button"
                                                class="btn btn-soft-primary btn-icon-circle btn-icon-circle-sm mb-2">
                                                <i class="fab fa-facebook-f"></i>
                                            </button>
                                            <p class="mb-0 fw-semibold">Facebook</p>
                                            <h4 class="m-0 fw-bold">25k <span
                                                    class="text-muted font-12 fw-normal">Followers</span></h4>
                                        </div>
                                        <!--end col-->
                                        <div class="col-auto">
                                            <button type="button"
                                                class="btn btn-soft-info btn-icon-circle btn-icon-circle-sm mb-2">
                                                <i class="fab fa-twitter"></i>
                                            </button>
                                            <p class="mb-0 fw-semibold">Twitter</p>
                                            <h4 class="m-0 fw-bold">58k <span
                                                    class="text-muted font-12 fw-normal">Followers</span></h4>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end f_profile-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div><!-- container -->
</div>
