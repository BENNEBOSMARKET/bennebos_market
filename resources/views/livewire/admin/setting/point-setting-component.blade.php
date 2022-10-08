<div>
    <style>
        thead tr {
            background: rgb(219, 219, 219);
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Setting</li>
                            <li class="breadcrumb-item active">Points Setting</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Points Setting</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Points Per Order</h4>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="storeData">
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Customer Point</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" wire:model="customer_point">
                                    @error('customer_point')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Seller Point</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" wire:model="seller_point">
                                    @error('seller_point')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-sm btn-primary">{!! loadingStateWithText('storeData', 'Submit') !!}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Point Value</h4>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="storePointValue">
                            <div class="mb-4 row">
                                <div class="col-md-5">
                                    <label for="">Point</label>
                                    <input class="form-control" type="text" value="1" readonly>
                                </div>
                                <div class="col-md-1 text-center pt-4"> 
                                    = 
                                </div>
                                <div class="col-md-6">
                                    <label for="">TL (₺)</label>
                                    <input class="form-control" type="text" wire:model="point_value">
                                    @error('point_value')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-sm btn-primary">{!! loadingStateWithText('storePointValue', 'Submit') !!}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Minimum Redeem</h4>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="storeMinReedem">
                            <div class="mb-4 row">
                                <div class="col-md-12">
                                    <label for="">Min. Point to Redeem</label>
                                    <input class="form-control" type="text" placeholder="Enter point" wire:model='min_point'>
                                </div>
                            </div>

                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-sm btn-primary">{!! loadingStateWithText('storeMinReedem', 'Submit') !!}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
