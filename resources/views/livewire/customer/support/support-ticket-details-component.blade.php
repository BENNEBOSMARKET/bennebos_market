@section('title')
{{ __('customer.support_ticket') }}
@endsection
<div>
    <style>
        .active_stars {
            font-size: 12px;
            color: #F2994A;
        }

        .inactive_stars {
            font-size: 12px;
            color: #CDD0D5;
        }

        .fetures_product_wrapper .prodcut_inner_area li img {
            border-radius: 15px;
            width: 100%;
            height: 75px;
            object-fit: cover;
        }
        .reply_btn{
            background: #E65C6A;
            padding: 7px 20px;
            border-radius: 10px;
            color: white;
        }
        [type="file"] {
            /* Style the color of the message that says 'No file chosen' */
            color: #878787;
        }
        [type="file"]::-webkit-file-upload-button {
            background: #ffffff;
            border: 2px solid #9e9e9e;
            border-radius: 4px;
            color: rgb(0, 0, 0);
            cursor: pointer;
            font-size: 10px;
            outline: none;
            padding: 17px 15px;
        }
    </style>

    <section class="profile_account_wrapper">
        <div class="my-container">
            <div class="profile_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                <h3 class="cart_title">{{ __('customer.dashboard') }}</h3>
                <button type="button" id="profileSidebarIcon">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            <div class="profile_sidebar_grid_area">
                @livewire('customer.inc.sidebar')
                <div class="profile_content_wrapper">
                    <div class="profile_content_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                        <h3>{{ __('customer.ticket_replies') }}</h3>
                    </div>
                    <div class="order_product_item_area review_order_item_area" style="text-align: right; margin-top: 25px;">
                        <button class="reply_btn" id="modalClickButton1">{{ __('customer.reply') }}</button>
                    </div>
                    <br><br>
                    <div class="profile_sub_content_area">
                        <div class="order_details_product_table">
                            <table>
                                <tr>
                                    <td>
                                        <h3>{{ __('customer.from') }}</h3>
                                    </td>
                                    <td>
                                        <h3>{{ __('customer.message') }}</h3>
                                    </td>
                                    <td>
                                        <h3>{{ __('customer.attachment') }}</h3>
                                    </td>
                                </tr>
                                @if ($ticket_replies->count() > 0)
                                    @foreach ($ticket_replies as $ticket)
                                        <tr>
                                            <td>@if($ticket->user_id == user()->id) {{ __('customer.me') }} @else {{ __('customer.admin') }} @endif</td>
                                            <td>{{ $ticket->reply_mmessage }}</td>
                                            <td>
                                                @if ($ticket->attachment)
                                                    <a href="{{ asset('uploads/support') }}/{{ $ticket->attachment }}" download></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" style="text-align: center;">{{ __('customer.no_data_found') }}</td>
                                    </tr>
                                @endif

                            </table>
                        </div>

                    </div>
                </div>
                <!-- Modal Adress -->
                <div wire:ignore.self class="modal_wrapper" id="modalID1">
                    <div class="modal_dialog">
                        <div class="modal_header d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                            <h3 style="font-size: 17px;">{{ __('customer.add_reply') }}</h3>
                            <button type="button" id="modalClose1">
                                <i class="fa fa-times" style="font-size: 25px;"></i>
                            </button>
                        </div>
                        <div class="modal_body">
                            <form wire:submit.prevent='storeData' class="form_area">
                                <div class="input_row">
                                    <label for="" style="font-size: 13px;">{{ __('customer.message') }}</label>
                                    <textarea name="" id="" rows="7" wire:model='message' placeholder="Enter your message"></textarea>
                                    @error('message')
                                        <p style="color: red; font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <label for="" style="font-size: 13px;">{{ __('customer.attachment') }}</label>
                                <input type="file" wire:model='attachment' />
                                <br>
                                <br>
                                <div wire:loading="attachment" wire:target="attachment" wire:key="attachment" style="font-size: 12.5px;" class="mr-2"><i class="fa fa-spinner fa-spin"></i>  {{ __('customer.uploading') }}</div>
                                @if ($attachment)
                                    <i class="fa fa-check"></i> {{ __('customer.uploaded') }}
                                @endif

                                <div class="sign_up_button" style="text-align: center;">
                                    <button type="submit" class="btnPreLoad" style="width: 45%;">{{ __('customer.submit') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div wire:ignore class="modal_overlay" id="modalOverlay1"></div>

            </div>
        </div>
        <div class="profile_sidebar_overlay" id="sidebarOverlay"></div>
    </section>
</div>
@push('scripts')
    <script>
        window.addEventListener('closeModal', event => {
            modalHide("modalID1", "modalOverlay1");
        });
    </script>
    <script>
        window.addEventListener('success', event => {
            toastr.success(event.detail.message);
        });
        window.addEventListener('warning', event => {
            toastr.warning(event.detail.message);
        });
        window.addEventListener('error', event => {
            toastr.error(event.detail.message);
        });
    </script>
@endpush