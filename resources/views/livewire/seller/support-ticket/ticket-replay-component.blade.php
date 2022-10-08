<div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-3">
                        <div class="col-md-12 d-flex justify-content-between">
                            <h4>{{ __('seller.all_support_ticket') }}</h4>
                            <div class="input-group cstm_search">
                                <input type="search" class="form-control form-control-sm searchbox"
                                placeholder=" {{ __('seller.search_support_ticket') }}"wire:model="searchTerm"
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
                                    <th>{{ __('seller.msessage') }}</th>
                                    <th>{{ __('seller.attachment') }}</th>
                                    <th style="text-align: center;">{{ __('seller.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $sl = $ticket_relpays->perPage() * $ticket_relpays->currentPage() -
                                ($ticket_relpays->perPage() - 1);
                                @endphp
                                @if ($ticket_relpays->count() > 0)
                                @foreach ($ticket_relpays as $relpay)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $relpay->reply_mmessage }}</td>
                                    <td><img style="height: 50px; width: 50px;" src="{{ $relpay->attachment }}" onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';"></td>
                                    <td class="text-center">
                                        @if($relpay->status == 0)
                                        {{ __('seller.open') }}
                                        @else
                                        {{ __('seller.solved') }}

                                            Open
                                        @else
                                            Solved

                                            Open
                                        @else
                                            Solved
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="8" class="text-center">{{ __('seller.commission_table_none_text') }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{ $ticket_relpays->links('pagination-link-seller') }}
                </div>
                <div class="mb-3 row">
                    <div style="text-align: right; padding-right: 5%;" class="col-sm-12">
                        <a data-bs-toggle="modal" data-bs-target="#addDataModal" class="btn btn-sm btn-primary">Replay</a>
                    </div>
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
                    <h5 class="modal-title">Replay Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <form wire:submit.prevent="storeData">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">{{ __('seller.msessage') }}</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" style="background: #0E011C;" rows="8" cols="71"
                                            wire:model="reply_mmessage"></textarea>
                                        @error('reply_mmessage')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-number-input" class="col-sm-3 col-form-label">{{ __('seller.attachment') }}</label>
                                    <div class="col-sm-9">
                                        <input class="form-control mb-2" type="file" wire:model="attachment">
                                        @error('attachment')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                        <div wire:loading="attachment" wire:target="attachment" wire:key="attachment"
                                            style="font-size: 12.5px;" class="mr-2"><i
                                                class="fa fa-spinner fa-spin mt-3 ml-2"></i> {{ __('seller.uploading') }}</div>
                                        @if ($attachment)
                                        <img src="{{ $attachment->temporaryUrl() }}" width="80" class="mt-2 mb-2" />
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-sm btn-primary"> {{ __('seller.submit') }}</button>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            data-bs-dismiss="modal"> {{ __('seller.add_new_cancel') }}</button>
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