<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Content</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Privacy Policy Page Content</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Privacy Policy Page Content</h4>
                    </div>
                    <!--end card-header-->
                    <div class="card-body">
                        <form wire:submit.prevent="storeData">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3 row">
                                        <div class="col-sm-12">
                                            <div wire:ignore>
                                                <textarea id="description" wire:model="description"></textarea>
                                            </div>
                                            @error('content')
                                            <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <button class="btn btn-primary" type="submit">Save &
                                    Publish</button>
                            </div>
                        </form>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
            </div>
        </div>
        <!--end row-->
    </div>

    @push('scripts')
    <script>
        $(function() {
            // Summernote
            $('#description').summernote({
                height: 350,
                width: '100%',
                placeholder: 'Privacy Policy Page Content',

                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('description', contents);
                    }
                }
            });
        });
    </script>
    @endpush