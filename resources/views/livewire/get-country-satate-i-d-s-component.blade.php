<div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>{{ __('seller.search_country') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12 text-center">
                                <input type="text" class="form-control" wire:model='country' style="text-align: center;" placeholder="{{ __('seller.enter_country_name') }}" />
                            </div>
                        </div>
                        <div style="max-height: 40vh; overflow-y: scroll;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('seller.country') }}</th>
                                        <th class="text-center">{{ __('seller.cart_id') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($countries as $country)
                                        <tr>
                                            <td>{{ $country->name }}</td>
                                            <td class="text-center">{{ $country->id }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>{{ __('seller.search_state') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12 text-center">
                                <input type="text" class="form-control" wire:model='state' style="text-align: center;" placeholder="{{ __('seller.enter_state_name') }}" />
                            </div>
                        </div>
                        <div style="max-height: 40vh; overflow-y: scroll;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('seller.country_state') }}</th>
                                        <th class="text-center">{{ __('seller.cart_id') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($states as $state)
                                        <tr>
                                            <td>{{ $state->name }}</td>
                                            <td class="text-center">{{ $state->id }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
