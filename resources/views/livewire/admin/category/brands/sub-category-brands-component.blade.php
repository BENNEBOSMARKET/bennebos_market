<div>
    <style>
        thead tr {
            background: rgb(219, 219, 219);
        }

        #customSwitchSuccess {
            font-size: 20px;
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
                            <li class="breadcrumb-item active">Select Brands</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Select Brands for {{ ucfirst($category->name) }}</h4>
                </div>
            </div>
        </div>

        <div class="row justify-content-between mt-3">
            <div class="col-lg-8 col-md-6" style="padding-top: 40px;">
                <a href="{{ route('admin.subCategoryProducts', ['id'=>$category->id]) }}" class="btn btn-outline-dark" style="margin-right: 4px;">Products</a>
                <a href="javascript:void(0)" class="btn btn-outline-dark active">Brands</a>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="row mb-4">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <label class="col-sm-6 col-form-label" for="name">Sort By</label>
                        <select class="form-select" id="exampleFormControlSelect1" wire:model="sortBy">
                            <option value="">All Brands</option>
                            <option value="pinned">Pinned Brands</option>
                        </select>
                    </div>
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
                                <input type="search" class="sinput" placeholder="Search" wire:model="searchTerm" />
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table custom_tbl">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 25%;">Image</th>
                                        <th>Name</th>
                                        <th>Pinned</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($brands->count() > 0)
                                    @foreach ($brands as $brand)
                                    <tr>
                                        <td style="width: 25%;">
                                            {{ $brand->id }} <img style="height: 50px; margin-right: 7px;" src="{{ $brand->logo }}" alt="">
                                        </td>
                                        <td>
                                            {{ Str::limit($brand->name, 35, '...') }}
                                        </td>

                                        <td style="text-align: center;">
                                            <div class="form-check form-switch form-switch-success"
                                                style="margin-left: 25px;">
                                                <input class="form-check-input" type="checkbox"
                                                    id="customSwitchSuccess" wire:click.prevent="brandPinned({{ $brand->id }})" @if(in_array($brand->id, json_decode($category->brands))) checked @endif>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8" class="text-center">No data available!</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $brands->links('pagination-links-table') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>