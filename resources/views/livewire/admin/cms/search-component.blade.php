<div>
    <style>
        #customSwitchSuccess {
            font-size: 25px;
        }
        input.sinput {
            width: 275px;
            padding: 10px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Customer Recent Searches</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Customer Recent Searches</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Customer Recent Searches</h4>
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
                                        <th>Search Tag</th>
                                        <th>Search Tag Count</th>
                                        <th>Search Time</th>
                                        {{-- <th style="text-align: center;">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $sl = ($recent_searchs->perPage() * $recent_searchs->currentPage())-($recent_searchs->perPage() - 1)
                                    @endphp
                                    @if ($recent_searchs->count() > 0)
                                    @foreach ($recent_searchs as $recent_search)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $recent_search->query }}</td>
                                        <td>{{ $recent_search->count }}</td>
                                        <td>{{ $recent_search->created_at }}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="6" style="text-align: center;">No data available!</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $recent_searchs->links('pagination-links-table') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    window.addEventListener('SearchDeleted', event => {
            Swal.fire(
                'Deleted!',
                'Banner has been deleted successfully.',
                'success'
            )
        });
</script>
@endpush