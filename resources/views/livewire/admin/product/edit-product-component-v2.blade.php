<div>
    <style>
        #customSwitchSuccess {
            font-size: 25px;
        }

        .note-editor .dropdown-toggle::after {
            all: unset;
        }

        .note-editor .note-dropdown-menu {
            box-sizing: content-box;
        }

        .note-editor .note-modal-footer {
            box-sizing: content-box;
        }

    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">Product</a></li>
                            <li class="breadcrumb-item active">Add Product</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add New Product</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" style="padding: 3px 10px;" class="btn btn-primary mb-1 @if($tabStatus == 1 || $tabStatus == 2 || $tabStatus == 3 || $tabStatus == 4) active @endif">@if($tabStatus == 1 || $tabStatus == 2 || $tabStatus == 3 || $tabStatus == 4)<i class="ti ti-check"></i> @endif Information</button>

                                <button type="button" style="padding: 3px 10px;" class="btn btn-primary mb-1 @if($tabStatus == 2 || $tabStatus == 3 || $tabStatus == 4) active @elseif($tabStatus == 1)  @else disabled @endif">@if($tabStatus == 2 || $tabStatus == 3 || $tabStatus == 4)<i class="ti ti-check"></i> @endif Price & Stock</button>

                                <button type="button" style="padding: 3px 10px;" class="btn btn-primary mb-1 @if($tabStatus == 3 || $tabStatus == 4) active @elseif($tabStatus == 2)  @else disabled @endif">@if($tabStatus == 3 || $tabStatus == 4)<i class="ti ti-check"></i> @endif Description</button>

                                <button type="button" style="padding: 3px 10px;" class="btn btn-primary mb-1 @if($tabStatus == 4) active @elseif($tabStatus == 3)  @else disabled @endif">@if($tabStatus == 4)<i class="ti ti-check"></i> @endif Gallery</button>

                                <button type="button" style="padding: 3px 10px;" class="btn btn-primary mb-1 @if($tabStatus == 4)  @else disabled @endif">Metas</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row @if($tabStatus != 0) d-none @endif">
            <div class="row justify-content-center">
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Product Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="name">Product Name *</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" placeholder="Enter name"
                                        wire:model="name" wire:keyup='generateslug' />
                                    @error('name')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="category">Category *</label>
                                <div class="col-sm-9">
                                    <div wire:ignore>
                                        <select class="form-control" id="category" wire:model="category">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    @if ($category->parent_id != 0 && $category->sub_parent_id == 0)
                                                        -
                                                    @elseif($category->parent_id != 0 && $category->sub_parent_id != 0)
                                                        --
                                                    @endif {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="brand">Brand</label>
                                <div class="col-sm-9">
                                    <div wire:ignore>
                                        <select class="form-control" id="brand" wire:model="brand">
                                            <option value="">Select Brand</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('brand')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="unit">Unit</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="unit"
                                        placeholder="Enter unit (eg: KG, Pc etc)" wire:model="unit" />
                                    @error('unit')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
    
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="guarantee">Years of Guarantee</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="guarantee"
                                        placeholder="Years of Guarantee " wire:model="guarantee" />
                                    @error('guarantee')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
    
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="minqty">Minimum Purchase Quantity *</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="minqty" placeholder="Enter qty"
                                        wire:model="minimum_qty" />
                                    @error('minimum_qty')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="barcode">Barcode</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="barcode" placeholder="Enter barcode"
                                        wire:model="barcode" />
                                    @error('barcode')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="refundable">Refundable</label>
                                <div class="col-sm-9">
                                    <div class="form-check form-switch form-switch-success" style="margin-left: 30px;">
                                        <input class="form-check-input" type="checkbox" wire:click="refundableStatus"
                                            id="customSwitchSuccess" @if ($refundable == 1) checked @endif>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="meta_title">Featured</label>
                                <div class="col-sm-9">
                                    <div class="form-check form-switch form-switch-success" style="margin-left: 30px;">
                                        <input class="form-check-input" type="checkbox"
                                            wire:click.prevent="featuredStatus" id="customSwitchSuccess"
                                            @if ($featured == 1) checked @endif>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form wire:submit.prevent="changeApps('1')">
                                <div class="row justify-content-center">
                                    <div class="col-xl-7 text-end">
                                        <button type="submit" style="padding: 3px 10px;" class="btn btn-primary">{!! loadingStateWithProcess('changeApps(1)', '<i class="ti ti-arrow-right"></i> Next Step') !!}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row @if($tabStatus != 1) d-none @endif">
            <div class="row justify-content-center">
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Price & Stock</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="unit_price">Unit Price <span
                                    class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="unit_price"
                                        placeholder="Enter unit price" wire:model="unit_price" />
                                    @error('unit_price')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="discount_date_range">Discount Date
                                    Range</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="" class="col-form-label">From</label>
                                            <input type="date" class="form-control" wire:model="discount_date_from" />
                                            @error('discount_date_from')
                                                <span class="text-danger"
                                                    style="font-size: 12.5px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="col-form-label">To</label>
                                            <input type="date" class="form-control" wire:model="discount_date_to" />
                                            @error('discount_date_to')
                                                <span class="text-danger"
                                                    style="font-size: 12.5px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="discount">Discount(%)</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="discount" placeholder="Enter discount"
                                        wire:model="discount" />
                                    @error('discount')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="quantity">Quantity</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="quantity" placeholder="Enter quantity"
                                        wire:model="quantity" />
                                    @error('quantity')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="sku">SKU <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="sku" placeholder="Enter sku"
                                        wire:model="sku" />
                                    @error('sku')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form wire:submit.prevent="changeApps('2')">
                                <div class="row justify-content-center">
                                    <div class="col-xl-7 text-end">
                                        <button type="button" wire:click.prevent="goBack('0')" style="padding: 3px 10px; float: left;" class="btn btn-danger">{!! loadingStateWithProcess('goBack(0)', '<i class="ti ti-arrow-left"></i> Back') !!}</button>

                                        <button type="submit" style="padding: 3px 10px;" class="btn btn-primary">{!! loadingStateWithProcess('changeApps(2)', '<i class="ti ti-arrow-right"></i> Next Step') !!}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row @if($tabStatus != 2) d-none @endif">
            <div class="row justify-content-center">
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Product Description</h4>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center mb-3">
                                <div class="col-sm-11">
                                    <div wire:ignore>
                                        <textarea id="description" wire:model="description"></textarea>
                                    </div>

                                    @error('description')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form wire:submit.prevent="changeApps('3')">
                                <div class="row justify-content-center">
                                    <div class="col-xl-7 text-end">
                                        <button type="button" wire:click.prevent="goBack('1')" style="padding: 3px 10px; float: left;" class="btn btn-danger">{!! loadingStateWithProcess('goBack(1)', '<i class="ti ti-arrow-left"></i> Back') !!}</button>

                                        <button type="submit" style="padding: 3px 10px;" class="btn btn-primary">{!! loadingStateWithProcess('changeApps(3)', '<i class="ti ti-arrow-right"></i> Next Step') !!}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row @if($tabStatus != 3) d-none @endif">
            <div class="row justify-content-center">
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-header text-center">
                            <button type="button" style="padding: 3px 10px;" wire:click.prevent="selectGalleryType('1')" class="btn btn-outline-primary @if($galleryType == '1') active @endif">{!! loadingStateWithText('selectGalleryType(1)', 'Product Gallery') !!}</button>
                            <button type="button" style="padding: 3px 10px;" wire:click.prevent="selectGalleryType('2')" class="btn btn-outline-primary @if($galleryType == '2') active @endif"">{!! loadingStateWithText('selectGalleryType(2)', 'Color Gallery') !!}</button>
                        </div>
                        <div class="card-body">
                            <div class="row @if($galleryType == '') d-none @endif">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Product Images</h4>
                                        </div>
                                        <div class="card-body">
                                            
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label" for="gallery_images">Thumbnail Image <span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <div wire:ignore>
                                                        <input class="form-control mb-2" type="file" id="thumbnail_image" />
                                                        <div id="imgElem">
                                                            @if ($uploadedThumbnailImage)
                                                                <img src="{{ $uploadedThumbnailImage }}" style="height: 150px; width: 100px;" alt="">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @error('thumbnail_image')
                                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <div class="row mb-3 @if($galleryType != '1') d-none @endif">
                                                <label class="col-sm-3 col-form-label" for="gallery_images">Gallery Images</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control mb-2" type="file" wire:model="gallery_images"
                                                        multiple />
                                                    @error('gallery_images')
                                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                                    @enderror
                
                                                    <div wire:loading="gallery_images" wire:target="gallery_images" wire:key="gallery_images" style="font-size: 12.5px;" class="mr-2"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading</div>
                
                                                    @if ($gallery_images)
                                                        @foreach ($gallery_images as $galKey => $galImg)
                                                            <img src="{{ $galImg->temporaryUrl() }}" width="80" class="mt-2 mb-2" />
                                                            <a href="#" class="img-delete-btn" wire:click.prevent='removeGalleryImageFromNewArray({{ $galKey }})'><i class="fa fa-times"></i></a>
                                                        @endforeach
                                                    @endif
                                                    @if ($uploadedGalleryImages)
                                                        @foreach ($uploadedGalleryImages as $ugiKey => $upgalImg)
                                                            <img src="{{ $upgalImg }}" width="80" class="mt-2 mb-2" />
                                                            <a href="#" class="img-delete-btn" wire:click.prevent='removeGalleryImageFromArray({{ $ugiKey }})'><i class="fa fa-times"></i></a>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card @if($galleryType != '1') d-none @endif">
                                        <div class="card-header">
                                            <h4 class="card-title">Product Size</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label" for="size">Product Size</label>
                                                <div class="col-sm-9">
                                                    <div wire:ignore>
                                                        <select id="ProductSize" wire:model="size" multiple>
                                                            @foreach ($sizes as $size)
                                                                <option value="{{ $size->size }}" @if(in_array($size->size, json_decode($selectedsizes))) selected @endif>{{ $size->size }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('size')
                                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row @if($galleryType != '2') d-none @endif">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="float-start"><strong>Color Variations</strong></h6>
                                            <button type="button" style="padding: 3px 10px;" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addColorModal">Add Color Variation</button>
                                        </div>
                                        <div class="card-body">
                                            <div class="row justify-content-center mt-3">
                                                <div class="col-md-12">
                                                    <table class="table table-sm">
                                                        <thead>
                                                            <th>Product Title</th>
                                                            <th>Color</th>
                                                            <th>Image</th>
                                                            <th>Gallery</th>
                                                            <th>Size</th>
                                                            <th>Price</th>
                                                            <th></th>
                                                        </thead>
                                                        <tbody>
                                                            @if (count($color_names) > 0 || count($get_color_names) > 0)
                                                                @if (count($get_color_names) > 0)
                                                                    @foreach ($get_color_names as $getkey => $get_c_name)
                                                                        <tr>
                                                                            <td>{{ Str::replace('"', '',Str::limit($get_color_titles[$getkey], 25)) }}</td>
                                                                            <td>{{ $get_c_name }}</td>
                                                                            <td>
                                                                                <img src="{{ $get_color_images[$getkey] }}" width="40" class="mt-2 mb-2" />
                                                                            </td>
                                                                            <td>
                                                                                @foreach (json_decode(productGalleryImages($product_id, $getkey)) as $gallery_image)
                                                                                    <img src="{{ $gallery_image }}" width="40" class="mt-2 mb-2" />
                                                                                @endforeach
                                                                            </td>
                                                                            <td>
                                                                                @foreach (json_decode(productColorSizes($product_id, $getkey)) as $usitem)
                                                                                    {!! $usitem !!}, 
                                                                                @endforeach
                                                                            </td>
                                                                            <td>{{ $get_color_prices[$getkey] }}</td>
                                                                            <td>
                                                                                <a href="" wire:click.prevent="removeColorGallery({{ $getkey }})"><i class="fa fa-times text-danger"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                                @foreach ($color_names as $key => $c_name)
                                                                    <tr>
                                                                        <td>{{ Str::replace('"', '',Str::limit(json_encode($color_titles[$key]), 25)) }}</td>
                                                                        <td>{{ $c_name }}</td>
                                                                        <td>
                                                                            <img src="{{ $color_images[$key]->temporaryUrl() }}" width="25" class="mt-2 mb-2" />
                                                                        </td>
                                                                        <td>
                                                                            @foreach ($color_galleries[$key] as $item)
                                                                                <img src="{{ $item->temporaryUrl() }}" width="25" class="mt-2 mb-2" />
                                                                            @endforeach
                                                                        </td>
                                                                        <td>
                                                                            @foreach ($color_sizes[$key] as $sitem)
                                                                                {!! $sitem !!}, 
                                                                            @endforeach
                                                                        </td>
                                                                        <td>{{ json_decode($color_prices[$key]) }}</td>
                                                                        <td>
                                                                            <a href="" wire:click.prevent="removeFromArray({{ $key }})"><i class="fa fa-times text-danger"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="4" class="text-muted" style="text-align: center; font-size: 12.5px; padding: 20px 0px;">No Color Found</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row @if($galleryType == '') d-none @endif">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Product Video</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label" for="video_link">Video Link</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="video_link"
                                                        placeholder="Enter video_link" wire:model="video_link" />
                                                    @error('video_link')
                                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row @if($galleryType != '') d-none @endif">
                                <div class="col-md-12 text-center pb-4 text-muted">
                                    <i class="ti ti-arrow-narrow-up" style="font-size: 30px;"></i>
                                    <br>
                                    Select Gallery Type
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form wire:submit.prevent="changeApps('4')">
                                <div class="row justify-content-center">
                                    <div class="col-xl-7 text-end">
                                        <button type="button" wire:click.prevent="goBack('2')" style="padding: 3px 10px; float: left;" class="btn btn-danger">{!! loadingStateWithProcess('goBack(2)', '<i class="ti ti-arrow-left"></i> Back') !!}</button>

                                        <button type="submit" style="padding: 3px 10px;" class="btn btn-primary">{!! loadingStateWithProcess('changeApps(4)', '<i class="ti ti-arrow-right"></i> Next Step') !!}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row @if($tabStatus != 4) d-none @endif">
            <div class="row justify-content-center">
                <div class="col-xl-7">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Seo Meta Tags</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="meta_title">Meta Title</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="meta_title"
                                        placeholder="Enter meta title" wire:model="meta_title" />

                                    @error('meta_title')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="meta_description">Meta Description</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" style="height: 200px;" id="meta_description" placeholder="Enter meta description" wire:model="meta_description"></textarea>

                                    @error('meta_description')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form wire:submit.prevent='updateProduct'>
                                <div class="row justify-content-center">
                                    <div class="col-xl-7 text-end">
                                        <button type="button" wire:click.prevent="goBack('3')" style="padding: 3px 10px; float: left;" class="btn btn-danger">{!! loadingStateWithProcess('goBack(3)', '<i class="ti ti-arrow-left"></i> Back') !!}</button>

                                        <button type="submit" style="padding: 3px 10px;" class="btn btn-primary">{!! loadingStateWithProcess('updateProduct', 'Update Product') !!}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addColorModal" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Color Varient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addColor">
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Color Name</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" placeholder="Enter name"
                                    wire:model="color_name">
                                @error('color_name')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Color Image<br><small
                                    class="text-muted">(Min Height: 400px)</small></label>
                            <div class="col-sm-9">
                                <input class="form-control mb-2" type="file" wire:model="color_image">
                                @error('color_image')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror

                                <div wire:loading="color_image" wire:target="color_image" wire:key="color_image"
                                    style="font-size: 12.5px;" class="mr-2"><span
                                        class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span> Uploading</div>

                                @if ($color_image)
                                    <img src="{{ $color_image->temporaryUrl() }}" width="80" class="mt-2 mb-2" />
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Color Gallery <br><small
                                    class="text-muted">(Min Height: 400px)</small></label>
                            <div class="col-sm-9">
                                <input class="form-control mb-2" type="file" multiple wire:model="color_gallery">
                                @error('color_gallery')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror

                                <div wire:loading="color_gallery" wire:target="color_gallery" wire:key="color_gallery"
                                    style="font-size: 12.5px;" class="mr-2"><span
                                        class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span> Uploading</div>

                                @if ($color_gallery)
                                    @foreach ($color_gallery as $cgallery)
                                        <img src="{{ $cgallery->temporaryUrl() }}" width="80"
                                            class="mt-2 mb-2" />
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Product Name</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" placeholder="Enter name"
                                    wire:model="color_title">
                                @error('color_title')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Product Price</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="number" step="any" placeholder="Enter price"
                                    wire:model="color_price">
                                @error('color_price')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Product Size</label>
                            <div class="col-sm-9">
                                <div wire:ignore>
                                    <select id="ProductSizeColor" wire:model="color_size" multiple>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->size }}">{{ $size->size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('color_size')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-sm btn-primary">{!! loadingStateWithText('addColor', 'Submit') !!}</button>
                                <button type="button" class="btn btn-sm btn-danger"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore class="modal" id="uploadThumbnailModal" tabindex="-1" role="dialog"
        data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Product Thumbnail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h6><i class="fa fa-crop" aria-hidden="true"></i> Crop Ydour Image an Click Upload</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div id="upload_demo" style="margin-top: 10px;"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary crop_image">Upload</button>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script>
        window.addEventListener('closeModal', event => {
            $('#addColorModal').modal('hide');
        });
    </script>

    <script>
        $(document).ready(function() {
            $image_crop = $('#upload_demo').croppie({
                enableExif: true,
                viewport: {
                    width: 400,
                    height: 500,
                    type: 'rectangle'
                },
                boundary: {
                    width: 400,
                    height: 700
                }
            });

            $('#thumbnail_image').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $image_crop.croppie('bind', {
                        url: event.target.result
                    }).then(function() {
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#uploadThumbnailModal').modal('show');
            });


            $('.crop_image').click(function(event) {
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'originala'
                }).then(function(response) {
                    var proImage = new Image(100, 100);
                    proImage.src = '' + response + '';
                    $('#imgElem').html(proImage);
                    $('#uploadThumbnailModal').modal('hide');
                    @this.set('thumbnail_image', response);

                })
            });
        });
    </script>

    <script>
        // SizeSelector
        var sizeSelector = new Selectr('#ProductSize', {
            multiple: true,
            placeholder: 'Select size'
        });
        sizeSelector.on('selectr.change', function(option) {
            var size = $('#ProductSize').val();
            @this.set('size', size);
        });

        var sizeSelector2 = new Selectr('#ProductSizeColor', {
            multiple: true,
            placeholder: 'Select size'
        });
        sizeSelector2.on('selectr.change', function(option) {
            var size = $('#ProductSizeColor').val();
            @this.set('size', size);
        });

        $(document).ready(function() {
            $('#category').select2({
                dropdownAutoWidth: true,
            });
            $('#brand').select2({
                dropdownAutoWidth: true,
            });


            //add model value
            $('#category').on('change', function() {
                var value = $(this).val();
                @this.set('category', value);
            });
            $('#brand').on('change', function() {
                var value = $(this).val();
                @this.set('brand', value);
            });
        });

        $(function() {
            // Summernote
            $('#description').summernote({
                height: 350,
                width: '100%',
                placeholder: 'Enter Post Description',

                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('description', contents);
                    }
                }
            });
        });
    </script>
@endpush
