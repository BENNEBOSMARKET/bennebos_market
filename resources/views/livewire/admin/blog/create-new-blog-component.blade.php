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
                            <li class="breadcrumb-item">Blogs</li>
                            <li class="breadcrumb-item active-item">Add New Blog</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add New Blog</h4>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Blog Informations</h4>
                        <a href="{{ route('admin.addNewBlog') }}" class="card-button btn btn-sm btn-primary" style="padding: 1px 7px;"><i class="ti ti-list"></i> All Blogs</a>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent='storeBlog'>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Title</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" wire:model="title" wire:keyup="generateSlug" placeholder="Enter title">
                                    @error('title')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Slug</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" wire:model="slug" placeholder="Enter slug">
                                    @error('slug')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-8">
                                    <select  class="form-control" wire:model="category">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-number-input" class="col-sm-3 col-form-label">Banner<br><small class="text-muted">(358x315)</small></label>
                                <div class="col-sm-9">
                                    <input class="form-control mb-2" type="file" wire:model="banner">
                                    @error('banner')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror

                                    <div wire:loading="banner" wire:target="banner" wire:key="banner" style="font-size: 12.5px;" class="mr-2"><i class="fa fa-spinner fa-spin mt-3 ml-2"></i> Uploading</div>

                                    @if ($banner)
                                        <img src="{{ $banner->temporaryUrl() }}" width="80" class="mt-2 mb-2" />
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Short Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="5" wire:model="short_description" placeholder="Enter short description"></textarea>
                                    @error('short_description')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Content</label>
                                <div class="col-sm-9">
                                    <div wire:ignore>
                                        <textarea class="form-control" rows="5" wire:model="content" id="description" placeholder="Enter short description"></textarea>
                                    </div>
                                    @error('content')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Meta Title</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" wire:model="meta_title" placeholder="Enter meta title">
                                    @error('meta_title')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Meta Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="5" wire:model="meta_description" placeholder="Enter meta description"></textarea>
                                    @error('meta_description')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        {!! loadingStateWithText('storeBlog', 'Submit') !!}
                                    </button>
                                </div>
                            </div>
                        </form>
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
        window.addEventListener('categoryDeleteError', event => {
            Swal.fire(
                'Error!',
                'Can not delete this category.<br>Because this category has active posts or subcategory.<br>Please delete them first.',
                'error'
            )
        });

        $(function() {
            // Summernote
            $('#description').summernote({
                height: 300,
                width: '100%',
                placeholder: 'Enter blog content',

                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('content', contents);
                    }
                }
            });
        });
    </script>
@endpush

