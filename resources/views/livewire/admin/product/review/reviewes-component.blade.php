<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Product Reviews</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Product Reviews</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Product Reviews</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12 mb-2 sort_cont">
                                <label class="font-weight-normal" style="">Show</label>
                                <select name="sortuserresults" class="sinput" id="" wire:model="sortingValue">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <label class="font-weight-normal" style="">entries</label>
                            </div>

                            <div class="col-md-6 col-sm-12 mb-2 search_cont">
                                <label class="font-weight-normal mr-2">Search:</label>
                                <input type="search" class="sinput" placeholder="Search" wire:model="searchTerm" />
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table custom_tbl">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Customer</th>
                                        <th>Rating</th>
                                        <th>Comments</th>
                                        <th>Publish Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl = $productReviews->perPage() * $productReviews->currentPage() - ($productReviews->perPage() - 1);
                                    @endphp
                                    @if ($productReviews->count() > 0)
                                        @foreach ($productReviews as $reviews)
                                            <tr>
                                                <td>{{ $sl++ }}</td>
                                                <td>{{ product($reviews->product_id)->name }}</td>
                                                <td>{{ customer($reviews->user_id)->name }}</td>
                                                <td>{{ $reviews->rating }}</td>
                                                <td>{{ $reviews->comments }}</td>
                                                <td>
                                                    <div class="form-check form-switch form-switch-success" style="margin-left: 25px;">
                                                        <input class="form-check-input publishStatus" type="checkbox" id="customSwitchSuccess" data-reviews_id="{{ $reviews->id }}" @if($reviews->status == 1) checked @endif>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">No data available!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $productReviews->links('pagination-links-table') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.publishStatus').on('click', function(){
                var id = $(this).data('reviews_id');
                @this.publishStatus(id);
            });
        });
    </script>
@endpush
