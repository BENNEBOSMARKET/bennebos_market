    <div>
    <style>
        thead tr {
            background: rgb(219, 219, 219);
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
                            <li class="breadcrumb-item active">Admin List</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Admin List</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
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
                                <input type="search" class="sinput" placeholder="Search"
                                    wire:model="searchTerm" />
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table custom_tbl">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Joining Date</th>
                                        <th>Status</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl = $administrator->perPage() * $administrator->currentPage() - ($administrator->perPage() - 1);
                                    @endphp
                                    @if ($administrator->count() > 0)
                                        @foreach ($administrator as $admin)
                                            <tr>
                                                <td>{{ $sl++ }}</td>
                                                <td>
                                                    @if ($admin->avatar)
                                                    <img style="height: 50px; width: 50px;" src="{{  $admin->avatar }}" alt="">
                                                    @else
                                                    <img style="height: 50px; width: 50px;" src="{{ asset('assets/front/images/default/profile.png') }}" alt="">
                                                    @endif
                                                </td>
                                                <td>{{ $admin->name }}</td>
                                                <td>{{ $admin->email }}</td>
                                                <td>{{ $admin->created_at }}</td>
                                                <td>
                                                    <div class="form-check form-switch form-switch-success">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="customSwitchSuccess" checked="">
                                                    </div>
                                                </td>
                                                <td style="text-align: center;">
                                                    <div class="button-items">
                                                        <a href="{{ route('admin.admin.profile', ['id'=>$admin->id]) }}" type="button" class="btn btn-sm btn-outline-primary">View</a>
                                                        <a type="button" href=""
                                                            class="btn btn-sm btn-outline-success">Edit</a>
                                                        <a type="button"
                                                            class="btn btn-sm btn-outline-danger">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8">No data available!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $administrator->links('pagination-links-table') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@endpush
