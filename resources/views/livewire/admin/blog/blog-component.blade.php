<div>
    <style>
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
                            <li class="breadcrumb-item">Blogs</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Blogs</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Blogs</h4>
                        <a href="{{ route('admin.addNewBlog') }}" class="card-button btn btn-sm btn-primary" style="padding: 1px 7px;"><i class="ti ti-plus"></i> Add New Blog</a>
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
                                        <th>Blog</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl = ($blogs->perPage() * $blogs->currentPage())-($blogs->perPage() - 1)
                                    @endphp
                                    @if ($blogs->count() > 0)
                                        @foreach ($blogs as $blog)
                                            <tr>
                                                <td>{{ $sl++ }}</td>
                                                <td><img src="{{ $blog->banner }}" style="height: 50px; width: 70px;" class="img-fluid" alt=""> {{ $blog->title }}</td>

                                                       <td>{{$blog->category->name}}</td>

                                                <td>
                                                    @if ($blog->status == 1)
                                                        <span wire:click.prevent='changeStatus({{ $blog->id }})' class="badge bg-success statusPreLoad" style="font-size: 12.5px; cursor: pointer;">Active</span>
                                                    @else
                                                        <span wire:click.prevent='changeStatus({{ $blog->id }})' class="badge bg-danger statusPreLoad" style="font-size: 12.5px; cursor: pointer;">InActive<span>
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    <div class="button-items">
                                                        <a href="{{ route('admin.editBlog', ['id'=>$blog->id]) }}" class="btn btn-outline-secondary btn-icon-circle btn-icon-circle-sm"><i class="ti ti-edit"></i></a>

                                                        <a wire:click.prevent="deleteConfirmation({{ $blog->id }})" type="button" class="btn btn-outline-danger btn-icon-circle btn-icon-circle-sm"><i class="ti ti-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" style="text-align: center;">No data available!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $blogs->links('pagination-links-table') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('showEditModal', event => {
            $('#editDataModal').modal('show');
        });
        window.addEventListener('closeModal', event => {
            $('#addDataModal').modal('hide');
            $('#editDataModal').modal('hide');
        });
        window.addEventListener('blogDeleted', event => {
            Swal.fire(
                'Deleted!',
                'Blog has been deleted successfully',
                'success'
            )
        });
    </script>
@endpush

