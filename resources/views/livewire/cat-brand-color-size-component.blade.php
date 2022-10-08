<div>
    <div class="container">
        <div class="row mt-5">

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>{{ __('seller.categories') }}</h4>
                    </div>
                    <div class="card-body">
                        <div style="height: 70vh; overflow-y: scroll;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('seller.product_component_category') }}</th>
                                        <th class="text-center">{{ __('seller.cart_id') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td class="text-center">{{ $category->id }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>{{ __('seller.brands') }}</h4>
                    </div>
                    <div class="card-body">
                        <div style="height: 70vh; overflow-y: scroll;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('seller.brand') }}</th>
                                        <th class="text-center">{{ __('seller.cart_id') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td>{{ $brand->name }}</td>
                                            <td class="text-center">{{ $brand->id }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>{{ __('seller.available_colors') }}</h4>
                    </div>
                    <div class="card-body">
                        <div style="height: 70vh; overflow-y: scroll;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('seller.color_codes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($colors as $color)
                                        <tr>
                                            <td style="display: flex;"><div style="background: {{ $color->code }}; height: 25px; width: 25px; margin-right: 7px;"></div> {{ $color->code }}</td>
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
