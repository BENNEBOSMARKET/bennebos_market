<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Sellers List</a></li>
                            <li class="breadcrumb-item active">Seller Verification</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Seller Verification</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Seller Verification</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5><strong>User Info</strong></h5>
                                <div class="dropdown-divider"></div>
                                <p><b>Name:</b> {{ $seller->name }}</p>
                                <p><b>Email:</b> {{ $seller->email }}</p>
                                <p><b>Phone:</b> {{ $seller->phone }}</p>
                                <p><b>Address:</b> {{ $seller->address }}</p>

                                <h5 class="mt-5"><strong>Shop Info</strong></h5>
                                <div class="dropdown-divider"></div>
                                <p><b>Shop Name:</b> {{ $shop->name }}</p>
                                <p><b>Address:</b> {{ $shop->address }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5><strong>Verification Info</strong></h5>
                                <div class="dropdown-divider"></div>

                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td style="width: 20%; font-weight: bold;">Your Name</td>
                                            <td>{{ $verificationInfo->name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%; font-weight: bold;">Shop Name</td>
                                            <td>{{ $verificationInfo->shop_name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%; font-weight: bold;">Email</td>
                                            <td>{{ $verificationInfo->email }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%; font-weight: bold;">Licence No</td>
                                            <td>{{ $verificationInfo->license_no }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%; font-weight: bold;">Full Address</td>
                                            <td>{{ $verificationInfo->address }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%; font-weight: bold;">Phone</td>
                                            <td>{{ $verificationInfo->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%; font-weight: bold;">Tax Papers</td>
                                            <td>
                                                @foreach (json_decode($verificationInfo->tax_papers) as $paper)
                                                    {{ $paper }} <a href="{{ $paper }}" download><i class="fa fa-download"></i></a> <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        @if ($shop->verification_status == 1)
                                            <button class="btn btn-sm btn-success"><i class="fa fa-check"></i> Approved</button>
                                        @else
                                            <button class="btn btn-sm btn-primary" wire:click.prevent='accept({{ $shop->id }})'>
                                                {!! loadingStateWithText('accept' ,'Accept') !!}
                                            </button>
                                            <button class="btn btn-sm btn-danger" wire:click.prevent='reject({{ $shop->id }})'>
                                                {!! loadingStateWithText('reject' ,'Reject') !!}
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="sellerEnableConfirmation" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title">Approve Application</h5>
                </div>
                <div class="modal-body" style="border: 1px solid grey;">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h5>Are you sure, you want to approve this application?</h5>
                            <small class="text-muted">Note: All products of this seller will be published</small>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12 text-center">
                            <button class="btn btn-sm btn-success" wire:click.prevent="approveApplication" wire:loading.attr='disabled'>{!! loadingStateWithProcess('approveApplication', 'Yes, Approve') !!}</button>
                            <button class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('show-approve-confirmation', event => {
            $('#sellerEnableConfirmation').modal('show');
        });

        //Success Delete
        window.addEventListener('applicationApproved', event => {
            $('#sellerEnableConfirmation').modal('hide');
            Swal.fire(
                'Approved!',
                'Application Approved Successfully.',
                'success'
            )
        });


        window.addEventListener('show-reject-confirmation', event => {
            Swal.fire({
            title: 'Are you sure?',
            text: "You want to reject this application!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'red',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, Reject !'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('rejectConfirmed')
                }
            })
        });

        //Success Delete
        window.addEventListener('applicationRejected', event => {
            Swal.fire(
                'Rejected!',
                'Application Rejected Successfully.',
                'success'
            )
        });
    </script>
@endpush