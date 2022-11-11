<div>
    <style>
        thead tr {
            background: rgb(219, 219, 219);
        }

        input.sinput {
            width: 275px;
            padding: 10px;
        }

        #customSwitchSuccess {
            font-size: 20px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Job List</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Job List</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Job List</h4>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Description</th>
                                    <th>Attachment</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if ($jobs->count() > 0)
                                @foreach ($jobs as $job)
                                <tr>
                                    <td>{{ $job->name }}</td>
                                    <td>{{ $job->email }}</td>
                                    <td>{{ $job->phone }}</td>
                                    <td>{{ $job->description }}</td>

                                    <td><img src="{{$job->file}}"></td>

                                    <td style="text-align: center;">
                                        <div class="button-items">
                                            {{-- <a type="button" href="#" class="btn btn-sm btn-outline-success"
                                                    wire:click.prevent="editData({{ $career->id }})">Edit</a> --}}
                                            <a wire:click.prevent="deleteConfirmation({{ $job->id }})"
                                               type="button" class="btn btn-sm btn-outline-danger">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6" style="text-align: center;">No job available!</td>
                                </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $jobs->links('pagination-links-table') }}
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

@push('scripts')
<script>


    //Success Delete
    window.addEventListener('CareerDeleted', event => {
        Swal.fire(
            'Deleted!',
            'Job has been deleted successfully.',
            'success'
        )
    });

    $(document).ready(function(){
        $('.publishStatus').on('click', function(){
            var id = $(this).data('career_id');
        @this.publishStatus(id);
        });
    });

</script>
@endpush
