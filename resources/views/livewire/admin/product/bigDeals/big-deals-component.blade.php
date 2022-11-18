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
                    <h4 class="page-title">Add Bid Deals Product</h4>
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
                                           wire:model="name" />
                                    @error('name')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-3">shipping country</label>
                                <div class="col-sm-9">
                                    <select class="form-control" wire:model='country_id'>
                                        <option value="">Select shipping Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="category">Category *</label>
                                <div class="col-sm-9">
                                    <div>
                                        <select class="form-control" id="category" wire:model="category">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                @if ($category->parent_id != 0 && $category->sub_parent_id == 0)
                                                @elseif($category->parent_id != 0 && $category->sub_parent_id != 0)
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->name }}   </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="subCategory">Sub Category *</label>
                                <div class="col-sm-9">
                                    <div>
                                        <select class="form-control" id="subCategory"  wire:model="subCategory_id">
                                            <option value="">Select Sub Category</option>
                                            @foreach ($subCategories as $subCategory)
                                                <option value="{{ $subCategory->id }}">

                                                    {{ $subCategory->name }}
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
                                <label for="" class="col-sm-3"> type</label>
                                <div class="col-sm-9">
                                    <select class="form-control" wire:model='sub_sub_category_id'>
                                        <option value="">Select type</option>
                                        @foreach ($subSubCategories as $subSubCategory)
                                            <option class="text-d" value="{{ $subSubCategory->id }}">{{ $subSubCategory->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('sub_sub_category_id')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="minqty"> Price *</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="minqty" placeholder="Enter qty"
                                           wire:model="price" />
                                    @error('price')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="minqty"> Quantity *</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="minqty" placeholder="Enter qty"
                                           wire:model="quantity" />
                                    @error('quantity')
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
                            <div class="mb-3 row">
                                <label for="" class="col-sm-3 col-form-label">Product Seller</label>
                                <div class="col-sm-9">
                                    <div wire:ignore>
                                        <select class="form-control" wire:model="seller" name="seller">
                                            <option value="">Select Seller</option>
                                            @foreach ($sellersOptions as $new_seller)
                                                <option value="{{ $new_seller->id }}">{{ $new_seller->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('seller')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="unit_price">Model No <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                           placeholder="Enter unit price" wire:model="model_no" />
                                    @error('model_no')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="unit_price"> Certification<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                           placeholder="Enter unit price" wire:model="certification" />
                                    @error('certification')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="unit_price"> Feet<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                           placeholder="Enter unit price" wire:model="feet" />
                                    @error('feet')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="unit_price"> Sku Code<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                           placeholder="Enter unit price" wire:model="sku" />
                                    @error('sku')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="unit_price"> Condition<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                           placeholder="Enter unit price" wire:model="condition" />
                                    @error('condition')
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
                            <div class="mb-3 row">
                                <label for="" class="col-sm-3 col-form-label">Color Image<br><small
                                        class="text-muted">(Min Height: 400px)</small></label>
                                <div class="col-sm-9">
                                    <input class="form-control mb-2" type="file" required wire:model="description_photo">
                                    @error('description_photo')
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
                            {{--                            <button type="button" style="padding: 3px 10px;" wire:click.prevent="selectGalleryType('1')" class="btn btn-outline-primary @if($galleryType == '1') active @endif">{!! loadingStateWithText('selectGalleryType(1)', 'Product Gallery') !!}</button>--}}
{{--                            <button type="button" style="padding: 3px 10px;" wire:click.prevent="selectGalleryType('2')" class="btn btn-outline-primary @if($galleryType == '2') active @endif"">{!! loadingStateWithText('selectGalleryType(2)', 'Color Gallery') !!}</button>--}}
                        </div>
                        <div class="card-body">
                            <div class="row mb-3  ">
                                <label class="col-sm-3 col-form-label" for="gallery_images"> Main Product Img</label>
                                <div class="col-sm-9">
                                    <input class="form-control mb-2" type="file" wire:model="main_photo" />
                                    @error('main_photo')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror

                                    <div wire:loading="main_photo" wire:target="main_photo" wire:key="main_photo" style="font-size: 12.5px;" class="mr-2"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading</div>


                                </div>
                            </div>
                            <div class="card-header">
                                <h6 class="float-start"><strong>Color Variations</strong></h6>
                                <button type="button" style="padding: 3px 10px;" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addPhotoModal">Add Color Variation</button>
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

{{--                                            @if (count($photos) >0)--}}
{{--                                                @foreach ($photos as $key => $c_name)--}}

{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            {{$c_name}}--}}
{{--                                                        </td>--}}
{{--                                                        <td>--}}
{{--                                                            <a href="" wire:click.prevent="removeFromArray({{ $key }})"><i class="fa fa-times text-danger"></i></a>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                @endforeach--}}
{{--                                            @else--}}
{{--                                                <tr>--}}
{{--                                                    <td colspan="7" class="text-muted" style="text-align: center; font-size: 12.5px; padding: 20px 0px;">No Color Found</td>--}}
{{--                                                </tr>--}}
{{--                                            @endif--}}
                                            </tbody>
                                        </table>
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
                                <label class="col-sm-3 col-form-label" for="meta_description">Note</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" style="height: 200px;" id="meta_description" placeholder="Enter meta description" wire:model="note"></textarea>

                                    @error('note')
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
                            <form wire:submit.prevent='storeProduct'>
                                <div class="row justify-content-center">
                                    <div class="col-xl-7 text-end">
                                        <button type="button" wire:click.prevent="goBack('3')" style="padding: 3px 10px; float: left;" class="btn btn-danger">{!! loadingStateWithProcess('goBack(3)', '<i class="ti ti-arrow-left"></i> Back') !!}</button>

                                        <button type="submit" style="padding: 3px 10px;" class="btn btn-primary">{!! loadingStateWithProcess('storeProduct', 'Store Product') !!}</button>
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
{{--    <div wire:ignore.self class="modal fade" id="addColorModal" tabindex="-1" data-bs-backdrop="static"--}}
{{--         data-bs-keyboard="false" role="dialog">--}}
{{--        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title">Add Color Varient</h5>--}}
{{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <form wire:submit.prevent="addColor">--}}


{{--                        <div class="row mb-3">--}}
{{--                            <label for="" class="col-sm-2"> type</label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <select class="form-control" wire:model='sub_sub_category_id'>--}}
{{--                                    <option value="">Select type</option>--}}
{{--                                    @foreach ($subSubCategories as $subSubCategory)--}}
{{--                                        <option class="text-d" value="{{ $subSubCategory->id }}">{{ $subSubCategory->name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error('sub_sub_category_id')--}}
{{--                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row mb-3">--}}
{{--                            <label class="col-sm-3 col-form-label" for="category">size *</label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <div>--}}
{{--                                    <select class="form-control" id="productSize" wire:model="product_size" >--}}
{{--                                        <option value="">Select size</option>--}}
{{--                                        @foreach ($sizesProducts as $category)--}}
{{--                                            <option value="{{ $category->id }}">--}}
{{--                                                {{ $category->size }}--}}
{{--                                            </option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                @error('product_size')--}}
{{--                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3 row">--}}
{{--                            <label for="" class="col-sm-3 col-form-label">Color Name</label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <select class="form-control" id="productSize" wire:model="color_name" >--}}
{{--                                    <option value="">Select size</option>--}}
{{--                                    @foreach ($ColorsProducts as $category)--}}
{{--                                        <option style='background-color: {{ $category->color }};color:{{ $category->color }} ' value="{{$category->id }}">--}}
{{--                                            {{ $category->color }}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error('color_name')--}}
{{--                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                        <div class="mb-3 row">--}}
{{--                            <label for="" class="col-sm-3 col-form-label">Color Image<br><small--}}
{{--                                    class="text-muted">(Min Height: 400px)</small></label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <input class="form-control mb-2" type="file" wire:model="color_image">--}}
{{--                                @error('color_image')--}}
{{--                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>--}}
{{--                                @enderror--}}

{{--                                <div wire:loading="color_image" wire:target="color_image" wire:key="color_image"--}}
{{--                                     style="font-size: 12.5px;" class="mr-2"><span--}}
{{--                                        class="spinner-border spinner-border-sm" role="status"--}}
{{--                                        aria-hidden="true"></span> Uploading</div>--}}

{{--                                @if ($color_image)--}}
{{--                                    <img src="{{ $color_image->temporaryUrl() }}" width="80" class="mt-2 mb-2" />--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="mb-3 row">--}}
{{--                            <label for="" class="col-sm-3 col-form-label">Color Gallery <br><small--}}
{{--                                    class="text-muted">(Min Height: 400px)</small></label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <input class="form-control mb-2" type="file" multiple wire:model="color_gallery">--}}
{{--                                @error('color_gallery')--}}
{{--                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>--}}
{{--                                @enderror--}}

{{--                                <div wire:loading="color_gallery" wire:target="color_gallery" wire:key="color_gallery"--}}
{{--                                     style="font-size: 12.5px;" class="mr-2"><span--}}
{{--                                        class="spinner-border spinner-border-sm" role="status"--}}
{{--                                        aria-hidden="true"></span> Uploading</div>--}}

{{--                                @if ($color_gallery)--}}
{{--                                    @foreach ($color_gallery as $cgallery)--}}
{{--                                        <img src="{{ $cgallery->temporaryUrl() }}" width="80"--}}
{{--                                             class="mt-2 mb-2" />--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="mb-3 row">--}}
{{--                            <label for="" class="col-sm-3 col-form-label">Product Name</label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <input class="form-control" type="text" placeholder="Enter name"--}}
{{--                                       wire:model="color_title">--}}
{{--                                @error('color_title')--}}
{{--                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="mb-3 row">--}}
{{--                            <label for="" class="col-sm-3 col-form-label">Product Price</label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <input class="form-control" type="number" step="any" placeholder="Enter price"--}}
{{--                                       wire:model="color_price">--}}
{{--                                @error('color_price')--}}
{{--                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="mb-3 row">--}}
{{--                            <label for="" class="col-sm-3 col-form-label">Product Seller</label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <div wire:ignore>--}}
{{--                                    <select id="ProductSeller" wire:model="seller" name="seller">--}}
{{--                                        <option value="">Select Seller</option>--}}
{{--                                        @foreach ($sellersOptions as $new_seller)--}}
{{--                                            <option value="{{ $new_seller->id }}">{{ $new_seller->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                @error('seller')--}}
{{--                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="mb-3 row">--}}
{{--                            <label for="" class="col-sm-3 col-form-label">Product Description</label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <textarea wire:model="color_description" placeholder="Enter description"--}}
{{--                                          class="form-control"--}}
{{--                                          rows="8"--}}
{{--                                ></textarea>--}}
{{--                                @error('color_description')--}}
{{--                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="mb-3 row">--}}
{{--                            <label for="" class="col-sm-3 col-form-label"></label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <button type="submit" class="btn btn-sm btn-primary">{!! loadingStateWithText('addColor', 'Submit') !!}</button>--}}
{{--                                <button type="button" class="btn btn-sm btn-danger"--}}
{{--                                        data-bs-dismiss="modal">Cancel</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


    {{--    <div wire:ignore.self class="modal fade" id="addProductSizeModal" tabindex="-1" data-bs-backdrop="static"--}}
    {{--         data-bs-keyboard="false" role="dialog">--}}
    {{--        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <h5 class="modal-title">Add Color Varient</h5>--}}
    {{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
    {{--                </div>--}}
    {{--                <div class="modal-body">--}}
    {{--                    <form wire:submit.prevent="addProductSize">--}}
    {{--                        <div class="row mb-3">--}}
    {{--                            <label for="" class="col-sm-2">shipping country</label>--}}
    {{--                            <div class="col-sm-9">--}}
    {{--                                <select class="form-control" wire:model='sub_sub_category_id'>--}}
    {{--                                    <option value="">Select shipping Country</option>--}}
    {{--                                    @foreach ($subSubCategories as $country)--}}
    {{--                                        <option value="{{ $country->id }}">{{ $country->name }}</option>--}}
    {{--                                    @endforeach--}}
    {{--                                </select>--}}
    {{--                                @error('sub_sub_category_id')--}}
    {{--                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>--}}
    {{--                                @enderror--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="row mb-3">--}}
    {{--                            <label class="col-sm-3 col-form-label" for="category">Category *</label>--}}
    {{--                            <div class="col-sm-9">--}}
    {{--                                <div>--}}
    {{--                                    <select class="form-control" id="productSize" wire:model="product_size" >--}}
    {{--                                        <option value="">Select Category</option>--}}
    {{--                                        @foreach ($sizesProducts as $category)--}}
    {{--                                            <option value="{{ $category->id }}">--}}
    {{--                                                {{ $category->size }}--}}
    {{--                                            </option>--}}
    {{--                                        @endforeach--}}
    {{--                                    </select>--}}
    {{--                                </div>--}}
    {{--                                @error('product_size')--}}
    {{--                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>--}}
    {{--                                @enderror--}}
    {{--                            </div>--}}
    {{--                        </div>--}}


    {{--                        <div class="mb-3 row">--}}
    {{--                            <label for="" class="col-sm-3 col-form-label"></label>--}}
    {{--                            <div class="col-sm-9">--}}
    {{--                                <button type="submit" class="btn btn-sm btn-primary">{!! loadingStateWithText('addProductSize', 'Submit') !!}</button>--}}
    {{--                                <button type="button" class="btn btn-sm btn-danger"--}}
    {{--                                        data-bs-dismiss="modal">Cancel</button>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </form>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

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
    <div wire:ignore.self class="modal fade" id="addPhotoModal" tabindex="-1" data-bs-backdrop="static"
         data-bs-keyboard="false" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Product Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addProductPhoto">
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label"> Photo <br><small
                                    class="text-muted">(Min Height: 400px)</small></label>
                            <div class="col-sm-9">
                                <input class="form-control mb-2" type="file" wire:model="photo">
                            </div>
                            @error('photo')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror

                            </div>


                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-sm btn-primary">{!! loadingStateWithText('addProductPhoto', 'Submit') !!}</button>
                                <button type="button" class="btn btn-sm btn-danger"
                                        data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@push('scripts')
    <script>
        window.addEventListener('closeModal', event => {
            $('#addProductPhoto').modal('hide');
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
                    size: 'viewport'
                }).then(function(response) {
                    var proImage = new Image(100, 150);
                    proImage.src = '' + response + '';
                    $('#imgElem').html(proImage);
                    $('#uploadThumbnailModal').modal('hide');
                @this.set('thumbnail_image', response);

                })
            });
        });
    </script>

    <script>




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
