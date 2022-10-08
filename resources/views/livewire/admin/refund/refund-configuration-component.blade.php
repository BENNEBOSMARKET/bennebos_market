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
                            <li class="breadcrumb-item active">Refund Configuration</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Refund Configuration</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        Add Refund Time
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent='store'>
                            <div class="mb-3 row justify-content-center">

                                <div class="col-8">
                                    <label for="">Refund Time</label>
                                    <input class="form-control" type="text" wire:model="refund_time"
                                        placeholder="Enter refund time">
                                    @error('refund_time')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-4 pt-4">
                                    <button type="submit"
                                        class="btn btn-sm btn-primary">{!! loadingStateWithText('store', 'Submit') !!}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
