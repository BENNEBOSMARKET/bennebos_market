<div>
    <div style="padding-top: 40px;" class="row">
        <div class="col-lg-4 offset-2">
            <div class="card">
                <a>
                    <div style="text-align: center;" class="card-body">
                        <h2>{{ $wallet->amount }} {{ __('seller.try') }}</h2>
                        <h4 class="header-title text-muted fw-bold item">{{ __('seller.pending_balance') }}</h4>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <a data-bs-toggle="modal" data-bs-target="#addDataModal">
                    <div style="text-align: center;" class="card-body">
                        <i class="ti ti-circle-plus text-success font-40"></i>
                        <h4 class="header-title text-muted fw-bold item">{{ __('seller.withdraw_request') }}</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-3">
                        <div class="col-md-12 d-flex justify-content-between">
                            <h4>{{ __('seller.withdraw_request_history') }}</h4>
                            <div class="input-group cstm_search">
                                <input type="search" class="form-control form-control-sm searchbox"
                                placeholder=" {{ __('seller.search_support_ticket') }}" wire:model="searchTerm"
                                    wire:keyup='resetPage' />
                                <div class="input-group-prepend">
                                    <i class="ti ti-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table custom_tbl">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('seller.date_time') }}</th>
                                    <th>{{ __('seller.amount_wallet') }}</th>
                                    <th style="text-align: center;">{{ __('seller.status') }}</th>
                                    <th>{{ __('seller.msessage') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $sl = $withdraw_requests->perPage() * $withdraw_requests->currentPage() -
                                ($withdraw_requests->perPage() - 1);
                                @endphp
                                @if ($withdraw_requests->count() > 0)
                                @foreach ($withdraw_requests as $withdraw_request)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $withdraw_request->created_at }}</td>
                                    <td>{{ $withdraw_request->amount }}</td>
                                    <td class="text-center">
                                        @if($withdraw_request->status == 0)
                                        {{ __('seller.pending') }}
                                        @else
                                          {{ __('seller.paid') }}
                                        @endif
                                    </td>
                                    <td>{{ $withdraw_request->message }}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="8" class="text-center">   {{ __('seller.no_request_available') }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{ $withdraw_requests->links('pagination-link-seller') }}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addDataModal" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">   {{ __('seller.send_withdraw_request') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <form wire:submit.prevent="storeData">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">{{ __('seller.amount_wallet') }}</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="amount"
                                            placeholder="{{ __('seller.enter_amount') }}">
                                        @error('amount')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">   {{ __('seller.msessage') }}</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" style="background: #0E011C;" rows="8" cols="71"
                                            wire:model="message"></textarea>
                                        @error('message')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-sm btn-primary">{{ __('seller.submit') }}</button>
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

@push('scripts')
<script>
    window.addEventListener('closeModal', event => {
            $('#addDataModal').modal('hide');
        });
</script>
@endpush