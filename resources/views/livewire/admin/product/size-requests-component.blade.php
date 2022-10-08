<div>
    <style>
        thead tr {
            background: rgb(219, 219, 219);
        }
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
                            <li class="breadcrumb-item active">Products</li>
                            <li class="breadcrumb-item active">Size Requests</li>
                        </ol>
                    </div>
                    <h4 class="page-title">All Requests</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Requests</h4>
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
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="thead-light">
                                <tr>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sl = $requests->perPage() * $requests->currentPage() - ($requests->perPage() - 1);
                                @endphp
                                @if ($requests->count() > 0)
                                    @foreach ($requests as $refund)
                                        <tr>
                                            
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center">No data available!</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $requests->links('pagination-links-table') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('showReasonModal', event => {
            $('#viewReason').modal('show');
        });
        window.addEventListener('showRejectModel', event => {
            $('#rejectModel').modal('show');
        });
        
        window.addEventListener('closeModal', event => {
            $('#addColorModal').modal('hide');
            $('#rejectModel').modal('hide');
        });
    </script>
@endpush