<div>
    <!-- Notification Section  -->
    <section class="notification_wrapper">
        <div class="my-container">
            <div class="notification_content_wrapper">
                <div class="notification_title d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                    <h2 class="cart_title"> {{ __('auth.notification') }}</h2>
                    <a href="{{ route('customer.notifications.markAllAsRead') }}">{{ __('auth.mark_all_as_read') }}</a>
                </div>
                <div class="notification_list_area">
                    <ul>
                        @if ($notifications->count() > 0)
                        @foreach($notifications as $notification)
                        @if( $notification->subject == 'New Order' )
                        @php
                        $content = json_decode($notification->content);
                        @endphp
                        <li class="notification_list">
                            <img src="{{ asset('assets/front/images/others/notification_img_1.png') }}"
                                alt="notification img" class="notification_img" />
                            <p>
                                {{ $content->body }}
                            </p>
                        </li>
                        @endif
                        @endforeach
                        @else
                        <li>
                            <p colspan="5" style="text-align: center;">No notification available!</p>
                        </li>
                        @endif
                    </ul>
                </div>
                {{ $notifications->links('pagination-links-table') }}
            </div>
        </div>
    </section>
</div>