@section('page_title')
    {{ __('seller.all_products') }}
@endsection

<div>
    <div class="container-fluid">

        <div class="rpw mt-4">
            <div class="col-md-12 d-flex justify-content-between">
                <a href="{{ route('seller.addProduct') }}" class="btn btn-primary"><i class="ti ti-plus"></i> {{ __('seller.product_component_add_new') }}</a>

                <div class="d-flex cstm_sort">
                    <span class="d-flex filter-text"><i class="ti ti-filter"></i> {{ __('seller.sort_by') }}</span>
                    <select class="sort_select">
                        <option value="">{{ __('seller.all_products') }}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row mb-3">
                            <div class="col-md-12 d-flex justify-content-between">
                                <h4>{{ __('seller.all_products') }}</h4>
                                <div class="input-group cstm_search">
                                    <input type="search" class="form-control form-control-sm searchbox" placeholder="Search Products" wire:model="searchTerm" wire:keyup='resetPage' />
                                    <div class="input-group-prepend">
                                        <i class="ti ti-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert bg-success">{{ session('success') }}</div>
                        @endif
                        <div class="table-responsive">
                            <table class="table custom_tbl">
                                <thead>
                                    <tr>
                                        <th>{{ __('seller.product_component_number') }}</th>
                                        <th>{{ __('seller.product_component_image') }}</th>
                                        <th>{{ __('seller.product_component_name') }}</th>
                                        <th>{{ __('seller.product_component_category') }}</th>
                                        <th>{{ __('seller.product_component_info') }}</th>
                                        <th>{{ __('seller.publish') }}</th>
                                        <th style="text-align: center;">{{ __('seller.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl = $products->perPage() * $products->currentPage() - ($products->perPage() - 1);
                                    @endphp
                                    @if ($products->count() > 0)
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $sl++ }}</td>
                                                <td><img style="height: 50px; width: 50px;" src="{{ $product->thumbnail }}" alt=""></td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>
                                                    <small><strong>{{ __('seller.base_price') }}</strong> {{ $product->unit_price }}</small> <br>
                                                    <small><strong>{{ __('seller.') }}</strong> {{ $product->quantity }}</small> <br>
                                                    <small><strong>{{ __('seller.rating') }}</strong> {{ $product->reviews->count() }}</small>
                                                </td>
                                                <td>
                                                    @if ($product->admin_approval)
                                                        <div style="position: absolute; padding: 5px 5px 0px 0px;" wire:loading wire:target='publishStatus({{ $product->id }})' wire:key='publishStatus({{ $product->id }})'><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>

                                                        <div class="form-check form-switch form-switch-success" style="margin-left: 30px;">
                                                            <input class="form-check-input publishStatus" type="checkbox" id="customSwitchSuccess" wire:click.prevent="publishStatus({{ $product->id }})" @if($product->status == 1) checked @endif>
                                                        </div>
                                                    @else
                                                        <div class="badge bg-danger">Under Review</div>
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    <div class="button-items">
                                                        <a href="{{ route('front.productDetails', ['slug'=>$product->slug]) }}" type="button" title="view" class="btn btn-secondary btn-icon-circle btn-icon-circle-sm" target="_blank"><i class="ti ti-eye"></i></a>

                                                        <a href="{{ route('seller.editProduct', ['id' => $product->id]) }}" type="button" title="edit" class="btn btn-warning btn-icon-circle btn-icon-circle-sm"><i class="ti ti-edit"></i></a>

                                                        <a wire:click.prevent="deleteConfirmation({{ $product->id }})" type="button" title="delete" class="btn btn-danger btn-icon-circle btn-icon-circle-sm"><i class="ti ti-trash"></i></a>
                                                    </div>
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
                        {{ $products->links('pagination-link-seller') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function(){
            $('#sortCategory').on('change', function(){
                $var = $(this).val();

                @this.set('sortCategory', $var);
            });
        });

        //Success Delete
        window.addEventListener('productDeleted', event => {
            Swal.fire(
                'Deleted!',
                'Product has been deleted successfully.',
                'success'
            )
        });
    </script>
@endpush