<div>
    <div class="topbar">
        <nav class="navbar-custom" id="navbar-custom">
            <ul class="list-unstyled topbar-nav float-end mb-0">
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti ti-bell"></i>
                        @if ($totalUnread > 0)
                            <span class="alert-badge">{{ $totalUnread }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-lg pt-0">

                        <h6
                            class="dropdown-item-text font-15 m-0 py-3 border-bottom d-flex justify-content-between align-items-center">
                            Notifications <span
                                class="badge bg-soft-primary badge-pill">{{ $notifications->count() }}</span>
                        </h6>
                        <div class="notification-menu" data-simplebar>
                            @if ($notifications->count() > 10)
                                @foreach ($notifications as $notification)
                                    @if ($notification->subject == 'New Order')
                                        @php
                                            $content = json_decode($notification->content);
                                        @endphp
                                        <a href="{{ route('admin.orders-details', $content->order->id) . '?not=' . $notification->id }}"
                                            class="dropdown-item py-3">
                                            <small
                                                class="float-end text-muted ps-2">{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
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
                            @else
                                <div class="text-center pt-4 pb-5">No notifications found</div>
                            @endif
                        </div>
                        @if ($notifications->count() > 10)
                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                                View all <i class="fi-arrow-right"></i>
                            </a>
                        @endif

                    </div>
                </li>

                <li class="dropdown">
                    <a class="nav-link dropdown-toggle nav-user" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            @if (admin()->avatar)
                                <img src="{{ admin()->avatar }}" alt="user" class="rounded-circle thumb-md"
                                    style="height: 40px; width: 40px; margin-right: 10px;">
                            @endif
                            <div>
                                <small class="d-none d-md-block font-11">Admin</small>
                                <span class="d-none d-md-block fw-semibold font-12">{{ admin()->name }} <i class="mdi mdi-chevron-down"></i></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                                class="ti ti-user font-16 me-1 align-text-bottom"></i> Profile</a>
                        <div class="dropdown-divider mb-0"></div>
                        <a class="dropdown-item" href="{{ route('admin.logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="ti ti-power font-16 me-1 align-text-bottom"></i> Logout</a>
                        <form id="logout-form" style="display: none;" method="POST"
                            action="{{ route('admin.logout') }}">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>

            <ul class="list-unstyled topbar-nav mb-0">
                <li>
                    <button class="nav-link button-menu-mobile nav-icon" id="togglemenu">
                        <i class="ti ti-menu-2"></i>
                    </button>
                </li>
                <li style="margin-right: 10px;">
                    <a href="{{ route('home.index') }}" class="btn btn-secondary btn-sm" target="_blank"><i
                            class="ti ti-world"></i> Website</a>
                </li>
                <li>
                    <button class="btn btn-primary btn-sm" wire:click='optimizeSite'>
                        {!! loadingStateWithText('optimizeSite', 'Optimize') !!}
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</div>
