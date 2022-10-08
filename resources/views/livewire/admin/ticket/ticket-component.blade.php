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
                            <li class="breadcrumb-item active">Support Desk</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Support Desk</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Support Desk</h4>
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
                                        <th>Ticket ID</th>
                                        <th>Sending Date</th>
                                        {{-- <th>Customer</th> --}}
                                        <th>Subject</th>
                                        <th>Status</th>
                                        <th>Last reply</th>
                                        <th>Open</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $sl = $tickets->perPage() * $tickets->currentPage() - ($tickets->perPage() - 1);
                                    @endphp
                                    @if ($tickets->count() > 0)
                                    @foreach ($tickets as $ticket)
                                    <tr>
                                        <td>1000{{ $sl++ }}</td>
                                        <td>{{ $ticket->created_at }}</td>
                                        {{-- <td>{{ user($ticket->user_id)->name }}</td> --}}
                                        <td>{{ $ticket->subject }}</td>
                                        <td>
                                            @if ($ticket->status == 1)
                                                <span class="badge bg-success">Solved</span>
                                            @else
                                                <span class="badge bg-warning">Open</span>
                                            @endif
                                        </td>
                                        <td>{{ $ticket->updated_at }}</td>
                                        <td>
                                            <a type="button" href="#" class="btn btn-sm btn-outline-success">Open</a>
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
                        {{ $tickets->links('pagination-links-table') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>