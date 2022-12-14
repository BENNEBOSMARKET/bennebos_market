@section('page_title')
{{ __('seller.add_new_top_title') }}
@endsection
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
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" style="padding: 3px 10px;"
                                    class="btn btn-primary mb-1 @if($tabStatus == 1 || $tabStatus == 2 || $tabStatus == 3 || $tabStatus == 4) active @endif">@if($tabStatus
                                    == 1 || $tabStatus == 2 || $tabStatus == 3 || $tabStatus == 4)<i
                                        class="ti ti-check"></i> @endif {{ __('seller.information') }}</button>

                                <button type="button" style="padding: 3px 10px;"
                                    class="btn btn-primary mb-1 @if($tabStatus == 2 || $tabStatus == 3 || $tabStatus == 4) active @elseif($tabStatus == 1)  @else disabled @endif">@if($tabStatus
                                    == 2 || $tabStatus == 3 || $tabStatus == 4)<i class="ti ti-check"></i> @endif {{ __('seller.price_stock') }}</button>

                                <button type="button" style="padding: 3px 10px;"
                                    class="btn btn-primary mb-1 @if($tabStatus == 3 || $tabStatus == 4) active @elseif($tabStatus == 2)  @else disabled @endif">@if($tabStatus
                                    == 3 || $tabStatus == 4)<i class="ti ti-check"></i> @endif {{ __('seller.description') }}</button>

                                <button type="button" style="padding: 3px 10px;"
                                    class="btn btn-primary mb-1 @if($tabStatus == 4) active @elseif($tabStatus == 3)  @else disabled @endif">@if($tabStatus
                                    == 4)<i class="ti ti-check"></i> @endif {{ __('seller.gallery') }}</button>

                                <button type="button" style="padding: 3px 10px;"
                                    class="btn btn-primary mb-1 @if($tabStatus == 4)  @else disabled @endif">{{ __('seller.metas') }}</button>
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
                            <h4 class="card-title">{{ __('seller.product_information') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="name">{{ __('seller.product_name') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" placeholder="{{ __('seller.placeholder_enter_name') }}"
                                        wire:model="name" wire:keyup='generateslug' />
                                    @error('name')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="category">{{ __('seller.category_star') }} </label>
                                <div class="col-sm-9">
                                    <div wire:ignore>
                                        <select class="form-control" id="category" wire:model="category">
                                            <option  class="text-dark"value="">{{ __('seller.select_category') }}</option>
                                            @foreach ($categories as $category)

                                                @if ($category->parent_id != 0 && $category->sub_parent_id == 0)

                                                @elseif($category->parent_id != 0 && $category->sub_parent_id != 0)
                                                @else
                                                    <option  class="text-dark"value="{{ $category->id }}">     {{ $category->name }}      </option>
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
                                <label class="col-sm-3 col-form-label" for="subCategory">{{ __('seller.sub_category_star') }}</label>
                                <div class="col-sm-9">
                                    <div>
                                        <select class="form-control" id="subCategory"  wire:model="subCategory_id">
                                            <option class="text-dark" value="">{{ __('seller.select_sub_category') }}</option>
                                            @foreach ($subCategories as $subCategory)
                                                <option class="text-dark" value="{{ $subCategory->id }}">

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
                                <label class="col-sm-3 col-form-label" for="brand">{{ __('seller.brand') }}</label>
                                <div class="col-sm-9">
                                    <div wire:ignore>
                                        <select class="form-control" id="brand" wire:model="brand">
                                            <option  class="text-dark"value="">{{ __('seller.select_brand') }}</option>
                                            @foreach ($brands as $brand)
                                            <option  class="text-dark"value="{{ $brand->id }}">
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
                                <label class="col-sm-3 col-form-label" for="guarantee">{{ __("auth.guarantee") }}</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="guarantee"
                                        placeholder="{{ __("auth.guarantee") }} " wire:model="guarantee" />
                                    @error('guarantee')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="unit">{{ __('seller.unit') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="unit"
                                        placeholder="{{ __('seller.placeholder_enter_unit') }}" wire:model="unit" />
                                    @error('unit')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="minqty">{{ __('seller.Minimum_purchase_quantity') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="minqty" placeholder="{{ __('seller.placeholder_enter_qty') }}"
                                        wire:model="minimum_qty" />
                                    @error('minimum_qty')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="barcode">{{ __('seller.barcode') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="barcode" placeholder="{{ __('seller.placeholder_enter_barcode') }}"
                                        wire:model="barcode" />
                                    @error('barcode')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="refundable">{{ __('seller.refundable') }}</label>
                                <div class="col-sm-9">
                                    <div class="form-check form-switch form-switch-success" style="margin-left: 30px;">
                                        <input class="form-check-input" type="checkbox" wire:click="refundableStatus"
                                            id="customSwitchSuccess" @if ($refundable==1) checked @endif>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="meta_title">{{ __('seller.featured') }}</label>
                                <div class="col-sm-9">
                                    <div class="form-check form-switch form-switch-success" style="margin-left: 30px;">
                                        <input class="form-check-input" type="checkbox"
                                            wire:click.prevent="featuredStatus" id="customSwitchSuccess" @if($featured==1) checked @endif>
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
                                        <button type="submit" style="padding: 3px 10px;" class="btn btn-primary">{!!
                                            loadingStateWithProcess('changeApps(1)', '<i class="ti ti-arrow-right"></i>
                                            Next Step') !!}</button>
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
                            <h4 class="card-title">{{ __('seller.price_stock') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="unit_price">{{ __('seller.unit_price') }} <span
                                        class="text-danger">{{ __('seller.add_new_star') }}</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="unit_price"
                                        placeholder="{{ __('seller.placeholder_enter_unit_price') }}" wire:model="unit_price" />
                                    @error('unit_price')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="discount_date_range">{{ __('seller.discount_date_range') }}</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="" class="col-form-label">{{ __('seller.add_new_from') }}</label>
                                            <input type="date" class="form-control" wire:model="discount_date_from" />
                                            @error('discount_date_from')
                                            <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="col-form-label">{{ __('seller.add_new_to') }}</label>
                                            <input type="date" class="form-control" wire:model="discount_date_to" />
                                            @error('discount_date_to')
                                            <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="discount">{{ __('seller.discount_percentage') }}</label>
                                <div class="col-sm-9">
                                    <div wire:ignore>
                                        <select class="form-control" id="discount">
                                            <option  class="text-dark"value="0">0 %</option>
                                            <option  class="text-dark"value="5">5 %</option>
                                            <option  class="text-dark"value="10">10 %</option>
                                            <option  class="text-dark"value="15">15 %</option>
                                            <option  class="text-dark"value="20">20 %</option>
                                            <option  class="text-dark"value="25">25 %</option>
                                            <option  class="text-dark"value="30">30 %</option>
                                            <option  class="text-dark"value="35">35 %</option>
                                            <option  class="text-dark"value="40">40 %</option>
                                            <option  class="text-dark"value="45">45 %</option>
                                            <option  class="text-dark"value="50">50 %</option>
                                            <option  class="text-dark"value="55">55 %</option>
                                            <option  class="text-dark"value="60">60 %</option>
                                            <option  class="text-dark"value="65">65 %</option>
                                            <option  class="text-dark"value="70">70 %</option>
                                            <option  class="text-dark"value="75">75 %</option>
                                            <option  class="text-dark"value="80">80 %</option>
                                            <option  class="text-dark"value="85">85 %</option>
                                            <option  class="text-dark"value="90">90 %</option>
                                        </select>
                                    </div>
                                    @error('discount')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="quantity">{{ __('seller.add_new_quantity') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="quantity" placeholder="{{ __('seller.placeholder_enter_qty') }}"
                                        wire:model="quantity" />
                                    @error('quantity')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="sku">{{ __('seller.add_new_sku') }} <span
                                        class="text-danger">{{ __('seller.add_new_star') }}</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="sku" placeholder="{{ __('seller.placeholder_enter_sku') }}"
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
                                        <button type="button" wire:click.prevent="goBack('0')"
                                            style="padding: 3px 10px; float: left;" class="btn btn-danger">{!!
                                            loadingStateWithProcess('goBack(0)', '<i class="ti ti-arrow-left"></i>
                                            Back') !!}</button>

                                        <button type="submit" style="padding: 3px 10px;" class="btn btn-primary">{!!
                                            loadingStateWithProcess('changeApps(2)', '<i class="ti ti-arrow-right"></i>
                                            Next Step') !!}</button>
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
                            <h4 class="card-title">{{ __('seller.product_description') }}</h4>
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
                                        <button type="button" wire:click.prevent="goBack('1')"
                                            style="padding: 3px 10px; float: left;" class="btn btn-danger">{!!
                                            loadingStateWithProcess('goBack(1)', '<i class="ti ti-arrow-left"></i>
                                            Back') !!}</button>

                                        <button type="submit" style="padding: 3px 10px;" class="btn btn-primary">{!!
                                            loadingStateWithProcess('changeApps(3)', '<i class="ti ti-arrow-right"></i>
                                            Next Step') !!}</button>
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
{{--                            <button type="button" style="padding: 3px 10px;" wire:click.prevent="selectGalleryType('1')"--}}
{{--                                class="btn btn-outline-primary @if($galleryType == '1') active @endif">{!!--}}
{{--                                loadingStateWithText('selectGalleryType(1)', 'Product Gallery') !!}</button>--}}
                            <button type="button" style="padding: 3px 10px;" wire:click.prevent="selectGalleryType('2')"
                                class="btn btn-outline-primary @if($galleryType == '2') active @endif"">{!! loadingStateWithText('selectGalleryType(2)', 'Color Gallery') !!}</button>
                        </div>
                        <div class=" card-body">
                                <div class="row @if($galleryType == '') d-none @endif">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">{{ __('seller.product_images') }}</h4>
                                            </div>
                                            <div class="card-body">

                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label"
                                                        for="gallery_images">{{ __('seller.thumbnail_image') }} <span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <div wire:ignore>
                                                            <input class="form-control mb-2" type="file"
                                                                id="thumbnail_image" />
                                                            <div id="imgElem"></div>
                                                        </div>
                                                        @error('thumbnail_image')
                                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message
                                                            }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row mb-3 @if($galleryType != '1') d-none @endif">
                                                    <label class="col-sm-3 col-form-label" for="gallery_images">{{ __('seller.gallery_images') }}</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control mb-2" type="file"
                                                            wire:model="gallery_images" multiple />
                                                        @error('gallery_images')
                                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message
                                                            }}</span>
                                                        @enderror

                                                        <div wire:loading="gallery_images" wire:target="gallery_images"
                                                            wire:key="gallery_images" style="font-size: 12.5px;"
                                                            class="mr-2 text-white"><span
                                                                class="spinner-border spinner-border-sm" role="status"
                                                                aria-hidden="true"></span> {{ __('seller.uploading') }}</div>

                                                        @if ($gallery_images)
                                                        @foreach ($gallery_images as $galImg)
                                                        <img src="{{ $galImg->temporaryUrl() }}" width="80"
                                                            class="mt-2 mb-2" />
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card @if($galleryType != '1') d-none @endif">
                                            <div class="card-header">
                                                <h6 class="float-start"><strong>{{ __('seller.product_size') }}</strong></h6>
                                                <button type="button" style="padding: 3px 10px;" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addProductSizeModal">{{ __('seller.product_size') }}</button>
                                            </div>
                                            <div class="card-body">
                                                <div class="row justify-content-center mt-3">
                                                    <div class="col-md-12">
                                                        <table class="table table-sm">
                                                            <thead>

                                                            <th>Size</th>

                                                            <th></th>
                                                            </thead>
                                                            <tbody>
{{--                                                            @if (count($types_id) >0)--}}
{{--                                                                @foreach ($types_id as $key => $c_name)--}}
{{--                                                                    <tr>--}}


{{--                                                                        <td>{{ json_decode($product_sizes[$key]) }}</td>--}}
{{--                                                                        <td>--}}
{{--                                                                            <a href="" wire:click.prevent="removeFromArray({{ $key }})"><i class="fa fa-times text-danger"></i></a>--}}
{{--                                                                        </td>--}}
{{--                                                                    </tr>--}}
{{--                                                                @endforeach--}}
{{--                                                            @else--}}
{{--                                                                <tr>--}}
{{--                                                                    <td colspan="7" class="text-muted" style="text-align: center; font-size: 12.5px; padding: 20px 0px;">No Color Found</td>--}}
{{--                                                                </tr>--}}
{{--                                                            @endif--}}
                                                            </tbody>
                                                        </table>
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
                                                <h6 class="float-start"><strong>{{ __('seller.color_variations') }}</strong></h6>
                                                <button type="button" style="padding: 3px 10px;"
                                                    class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                                                    data-bs-target="#addColorModal">{{ __('seller.add_color_variation') }}</button>
                                            </div>
                                            <div class="card-body">
                                                <div class="row justify-content-center mt-3">
                                                    <div class="col-md-12">
                                                        <table class="table table-sm">
                                                            <thead>
                                                                <th> {{ __('seller.product_table_title') }}</th>
                                                                <th> {{ __('seller.product_table_color') }}</th>
                                                                <th>{{ __('seller.product_table_image') }}</th>
                                                                <th>{{ __('seller.product_table_gallery') }}</th>
                                                                <th>{{ __('seller.product_table_size') }}</th>
                                                                <th>{{ __('seller.product_table_price') }}</th>
                                                                <th></th>
                                                            </thead>
                                                            <tbody>
                                                                @if (count($color_names) >0)
                                                                @foreach ($color_names as $key => $c_name)
                                                                <tr>
                                                                    <td>{{ Str::replace('"',
                                                                        '',Str::limit(json_encode($color_titles[$key]),
                                                                        25)) }}</td>
                                                                    <td>{{ $c_name }}</td>
                                                                    <td>
                                                                        <img src="{{ $color_images[$key]->temporaryUrl() }}"
                                                                            width="25" class="mt-2 mb-2" />
                                                                    </td>
                                                                    <td>
                                                                        @foreach ($color_galleries[$key] as $item)
                                                                        <img src="{{ $item->temporaryUrl() }}"
                                                                            width="25" class="mt-2 mb-2" />
                                                                        @endforeach
                                                                    </td>
                                                                    <td>

                                                                        {{ $product_sizes[$key] }}

                                                                    </td>
                                                                    <td>{{ json_decode($color_prices[$key]) }}</td>
                                                                    <td>
                                                                        <a href=""
                                                                            wire:click.prevent="removeFromArray({{ $key }})"><i
                                                                                class="fa fa-times text-danger"></i></a>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                @else
                                                                <tr>
                                                                    <td colspan="7" class="text-muted"
                                                                        style="text-align: center; font-size: 12.5px; padding: 20px 0px;">
                                                                        {{ __('seller.product_table_no_color') }}</td>
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
                                                <h4 class="card-title">{{ __('seller.product_video') }}</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label" for="video_link">{{ __('seller.video_link') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="video_link"
                                                            placeholder="{{ __('seller.placeholder_enter_video_link') }}" wire:model="video_link" />
                                                        @error('video_link')
                                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message
                                                            }}</span>
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
                                        {{ __('seller.select_gallery_type') }}
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
                                        <button type="button" wire:click.prevent="goBack('2')"
                                            style="padding: 3px 10px; float: left;" class="btn btn-danger">{!!
                                            loadingStateWithProcess('goBack(2)', '<i class="ti ti-arrow-left"></i>
                                            Back') !!}</button>

                                        <button type="submit" style="padding: 3px 10px;" class="btn btn-primary">{!!
                                            loadingStateWithProcess('changeApps(4)', '<i class="ti ti-arrow-right"></i>
                                            Next Step') !!}</button>
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
                            <h4 class="card-title">{{ __('seller.seo_meta_tags') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="meta_title">{{ __('seller.meta_title') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="meta_title"
                                        placeholder="{{ __('seller.placeholder_enter_meta_title') }}" wire:model="meta_title" />

                                    @error('meta_title')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="meta_description">{{ __('seller.meta_description') }}</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" style="height: 200px;"
                                        id="meta_description" placeholder="{{ __('seller.placeholder_enter_meta_description') }}"
                                        wire:model="meta_description"></textarea>

                                    @error('meta_description')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="size">Product Shipping</label>
                                <div class="col-sm-9">
                                    <div wire:ignore>
                                        <select class="form-control" wire:model="shipping">
                                            <option  class="text-dark" value="">Select Shipping Time</option>
                                            <option  class="text-dark" value=1>1 day</option>
                                            <option  class="text-dark" value=2>2 days</option>
                                            <option  class="text-dark" value=3>3 days</option>
                                            <option  class="text-dark" value=4>4 days</option>
                                            <option  class="text-dark" value=5>5 days</option>
                                        </select>
                                    </div>
                                    @error('shipping')
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
                                        <button type="button" wire:click.prevent="goBack('3')"
                                            style="padding: 3px 10px; float: left;" class="btn btn-danger">{!!
                                            loadingStateWithProcess('goBack(3)', '<i class="ti ti-arrow-left"></i>
                                            Back') !!}</button>

                                        <button type="submit" style="padding: 3px 10px;" class="btn btn-primary">{!!
                                            loadingStateWithProcess('storeProduct', 'Store Product') !!}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
{{--                                <select class="form-control" wire:model='type_id'>--}}
{{--                                    <option  class="text-dark"value="">Select shipping Country</option>--}}
{{--                                    @foreach ($types as $country)--}}
{{--                                        <option  class="text-dark" class="text-dark" value="{{ $country->id }}">{{ $country->type }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error('type_id')--}}
{{--                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row mb-3">--}}
{{--                            <label class="col-sm-3 col-form-label" for="category">Category *</label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <div>--}}
{{--                                    <select class="form-control" id="category" wire:model="product_size" >--}}
{{--                                        <option  class="text-dark"value="">Select Category</option>--}}
{{--                                        @foreach ($sizesProducts as $category)--}}
{{--                                            <option  class="text-dark"value="{{ $category->id }}">--}}
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
    <div wire:ignore.self class="modal fade" id="addColorModal" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('seller.add_color_varient') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addColor">
                        <div class="row mb-3">
                            <label for="" class="col-sm-2"> {{ __('seller.sub_sub_category_star') }}</label>
                            <div class="col-sm-9">
                                <select class="form-control" wire:model='sub_sub_category_id'>
                                    <option value="">{{ __('seller.select_sub_sub_category') }}</option>
                                    @foreach ($subSubCategories as $subSubCategory)
                                        <option class="text-dark" class="text-d" value="{{ $subSubCategory->id }}">{{ $subSubCategory->name }}</option>
                                    @endforeach
                                </select>
                                @error('sub_sub_category_id')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="category">{{ __('seller.product_size') }}</label>
                            <div class="col-sm-9">
                                <div>
                                    <select class="form-control" id="productSize" wire:model="product_size" >
                                        <option class="text-dark" value="">{{ __('seller.product_size') }}</option>
                                        @foreach ($sizesProducts as $category)
                                            <option class="text-dark" value="{{ $category->id }}">
                                                {{ $category->size }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('product_size')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">{{ __('seller.color_name') }}</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="productSize" wire:model="color_name" >
                                    <option class="text-dark" value="">{{ __('seller.color_name') }}</option>
                                    @foreach ($ColorsProducts as $category)
                                        <option class="text-dark" style='background-color: {{ $category->color }};color:{{ $category->color }} ' value="{{$category->id }}">
                                            {{ $category->color }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('color_name')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">{{ __('seller.color_image') }}<br><small class="text-muted">{{ __('seller.color_image_min_height') }}</small></label>
                            <div class="col-sm-9">
                                <input class="form-control mb-2" type="file" wire:model="color_image">
                                @error('color_image')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror

                                <div wire:loading="color_image" wire:target="color_image" wire:key="color_image"
                                    style="font-size: 12.5px;" class="mr-2 text-white"><span
                                        class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span> {{ __('seller.uploading') }}</div>

                                @if ($color_image)
                                <img src="{{ $color_image->temporaryUrl() }}" width="80" class="mt-2 mb-2" />
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">{{ __('seller.color_gallery') }}<br><small
                                    class="text-muted">{{ __('seller.color_image_min_height') }}</small></label>
                            <div class="col-sm-9">
                                <input class="form-control mb-2" type="file" multiple wire:model="color_gallery">
                                @error('color_gallery')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror

                                <div wire:loading="color_gallery" wire:target="color_gallery" wire:key="color_gallery"
                                    style="font-size: 12.5px;" class="mr-2 text-white"><span
                                        class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span> {{ __('seller.uploading') }}</div>

                                @if ($color_gallery)
                                @foreach ($color_gallery as $cgallery)
                                <img src="{{ $cgallery->temporaryUrl() }}" width="80" class="mt-2 mb-2" />
                                @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">{{ __('seller.product_name') }}</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" placeholder="{{ __('seller.placeholder_enter_name') }}"
                                    wire:model="color_title">
                                @error('color_title')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">{{ __('seller.product_price') }}</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="number" step="any" placeholder="{{ __('seller.placeholder_enter_price') }}"
                                    wire:model="color_price">
                                @error('color_price')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Product Description</label>
                            <div class="col-sm-9">
                                <textarea wire:model="color_description" placeholder="Enter description"
                                          class="form-control"
                                          rows="8"
                                ></textarea>
                                @error('color_description')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-sm btn-primary">{!!
                                    loadingStateWithText('addColor', 'Submit') !!}</button>
                                <button type="button" class="btn btn-sm btn-danger"
                                    data-bs-dismiss="modal">{{ __('seller.add_new_cancel') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore class="modal" id="uploadThumbnailModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('seller.product_thumbnail') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h6><i class="fa fa-crop" aria-hidden="true"></i> {{ __('seller.Crop_your_mage') }}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div id="upload_demo" style="margin-top: 10px;"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary crop_image">{{ __('seller.add_new_upload') }}</button>
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
