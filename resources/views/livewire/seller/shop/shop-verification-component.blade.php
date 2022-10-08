@section('page_title')
{{ __('seller.shop_verification') }}
@endsection
<div>
    <div class="container-fluid">
        <form wire:submit.prevent='applyVerification'>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('seller.shop_information') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.your_name') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-md" placeholder="Enter your name" wire:model="name" />
                                    @error('name')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.shop_name') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-md" placeholder="Enter shop name" wire:model="shop_name" />
                                    @error('shop_name')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.email') }}</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control form-control-md" placeholder="Enter email" wire:model="email" />
                                    @error('email')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.licence_no') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-md" placeholder="Enter licence no" wire:model="licence_no" />
                                    @error('licence_no')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.phone') }}</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control form-control-md" placeholder="Enter phone" wire:model="phone" />
                                    @error('phone')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.full_address') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-md" placeholder="Enter full address" wire:model="full_address" />
                                    @error('full_address')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.tax_papers') }}</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control form-control-md" wire:model="taxpapers" />
                                    @error('taxpapers')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                    <div wire:loading="taxpapers" wire:target="taxpapers" wire:key="taxpapers" style="font-size: 12.5px;"
                                        class="mr-2"><i class="fa fa-spinner fa-spin mt-3 ml-2"></i> {{ __('seller.uploading') }}</div>

                                    @if ($taxpapers)
                                        <i class="fa fa-check" style="color: green; margin-top: 6px;"></i> <span style="font-size: 12.5px;">{{ __('seller.file_uploaded') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-2"></label>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:model='checkbox' value="1" id="invalidCheck">
                                        <label class="form-check-label" for="invalidCheck">
                                            {{ __('seller.agree_to') }} <a target="_blank" href="{{ route('terms-conditon') }}">{{ __('seller.terms_conditions') }}</a>
                                        </label>

                                    </div>
                                    @error('checkbox')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-2"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary btn-lg pl-4 pr-4 mt-4">
                                        {!! loadingStateWithText('applyVerification', 'Submit Verification') !!}
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