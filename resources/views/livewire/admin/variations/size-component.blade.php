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
                            <li class="breadcrumb-item active">Product Size</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Product Size</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card" style="min-height: 70vh;">
                    <div class="card-header text-center">
                        Product Sizes management
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Add Size</h4>
                                    </div>
                                    <div class="card-body">
                                        <form wire:submit.prevent='storeData'>
                                            <div class="mb-3 row justify-content-center">
                                                <label for="example-text-input" class="col-sm-3 col-form-label">Product Type</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" wire:model="type_id">
                                                        <option value="">Select Type</option>

                                                        @foreach ($productType as $type)

                                                            <option value="{{ $type->id }}">{{ $type->type }}</option>

                                                        @endforeach

                                                    </select>
                                                    @error('type_id')
                                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3 row justify-content-center">
                                                <label for="example-text-input" class="col-sm-3 col-form-label">Enter Size</label>
                                                <div class="col-8">

                                                    <input class="form-control" type="text" wire:model="size" placeholder="Enter size">
                                                    @error('size')
                                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-4 pt-4">
                                                    <button type="submit" class="btn btn-sm btn-primary">{!! loadingStateWithText('storeData', 'Submit') !!}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">All Sizes</h4>
                                    </div>
                                    <div class="card-body p-1 pb-4">
                                        <table class="table table-md">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Size</th>
                                                    <th style="width: 10%;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($productSize as $size)
                                                    <tr>
                                                        <td>{{!is_null($size->productType)? $size->productType->type:'' }}</td>
                                                        <td>{{ $size->size }}</td>
                                                        <td>
                                                            <a wire:click.prevent="deleteData({{ $size->id }})" type="button" class="btn btn-outline-danger btn-icon-circle btn-icon-circle-sm"><i class="ti ti-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('sizeDeleted', event => {
            Swal.fire(
                'Deleted!',
                'Size has been deleted successfully.',
                'success'
            )
        });
    </script>
@endpush
