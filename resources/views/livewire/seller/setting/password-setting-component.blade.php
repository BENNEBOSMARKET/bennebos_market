@section('page_title')
{{ __('seller.change_password') }}
@endsection
<div>

    <div class="container-fluid">
        <form wire:submit.prevent='storeData'>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('seller.change_password') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.old_password') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-md" wire:model="current_password" autocomplete="off" />
                                    @error('current_password')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.new_password') }}</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control form-control-md" wire:model="password" autocomplete="off" />
                                    @error('password')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="" class="col-sm-2">{{ __('seller.confirm_password') }}</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control form-control-md" wire:model="confirm_password" />
                                    @error('confirm_password')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-2"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary btn-lg pl-4 pr-4 mt-4">
                                        {!! loadingStateWithText('storeData', 'Update Password') !!}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>