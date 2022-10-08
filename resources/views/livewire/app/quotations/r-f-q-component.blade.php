@section('title')
{{ __('auth.submit_rfq') }}
@endsection
<div>
    <!-- Cart Item Section  -->
    <section class="qutotaion_form_wrapper">
        <div class="my-container">
            <h3 class="cart_title">{{ __('auth.tell_supplier_need') }}</h3>
            <form wire:submit.prevent='storeData' class="product_add_form">
                <div class="product_list_wrapper dashboard_card_wrapper">
                    <div
                        class="profile_content_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                        <h3>{{ __('auth.products_information') }}</h3>
                    </div>
                    <div class="add_product_details_form_area">
                        <div class="input_row">
                            <label for="">{{ __('auth.products_name') }} <span>*</span></label>
                            <input type="text" id="name" placeholder="{{ __('auth.placeholder_enter_products_name') }}" wire:model='name' wire:change='generateSlug' />
                            @error('name')
                                <label for=""></label>
                                <span style="font-size: 12.5px; color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input_row">
                            <label for="">{{ __('auth.category') }} <span>*</span></label>
                            <div wire:ignore>
                                <select class="niceSelect" id="category">
                                    <option value="">{{ __('auth.choose_category') }}</option>
                                    @foreach ($qutationCategory as $qutation)
                                        <option value="{{ $qutation->id }}">{{ $qutation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <label for=""></label>
                                <span style="font-size: 12.5px; color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input_row">
                            <label for="">{{ __('auth.sourcing_type') }}<span>*</span></label>
                            <div class="add_form_inner_grid">
                                <div wire:ignore>
                                    <select class="niceSelect" id="sourcing">
                                        <option value="">{{ __('auth.choose_sourcing_type') }}</option>
                                        <option value="Customized Product">{{ __('auth.customized_product') }}</option>
                                        <option value="Non-customized Product">{{ __('auth.non_customized_product') }}</option>
                                        <option value="Total Solution">{{ __('auth.total_solution') }}</option>
                                        <option value="Business Service">{{ __('auth.business_service') }}</option>
                                        <option value="Other">{{ __('auth.other') }}</option>
                                    </select>
                                </div>
                                <div id="sTypeSelectCont" style="display: none;" wire:ignore>
                                    <select class="niceSelect" id="sourcingSelectType">
                                        <option value="">{{ __('auth.please_select') }}</option>
                                        <option value="Customized Logo">{{ __('auth.customized_logo') }}</option>
                                        <option value="Customized Packaging">{{ __('auth.customized_packaging') }}</option>
                                        <option value="Graphic Customization">{{ __('auth.graphic_customization') }}</option>
                                        <option value="OEM">{{ __('auth.oem') }}</option>
                                        <option value="Assembling">{{ __('auth.assembling') }}</option>
                                        <option value="Customized Function">{{ __('auth.customized_function') }}</option>
                                        <option value="Other">{{ __('auth.others') }}</option>
                                    </select>
                                </div>
                                <div id="sTypeInputCont" style="display: none;" wire:ignore>
                                    <input type="text" id="sourcingInputType" placeholder="{{ __('auth.placeholder_enter_products_name') }}" />
                                </div>

                                @error('sourcing')
                                    <label for=""></label>
                                    <span style="font-size: 12.5px; color: red;">{{ $message }}</span>
                                @enderror
                                @error('sourcing_type')
                                    <label for=""></label>
                                    <span style="font-size: 12.5px; color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="input_row">
                            <label for="">{{ __('auth.quantity') }} <span>*</span></label>
                            <div class="add_form_inner_grid">
                                <div class="qty_increase_decrease_grid">
                                    <button type="button" wire:click.prevent='decrease'>
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <input type="number" placeholder="{{ __('auth.placeholder_enter_qty') }}" wire:model="quantity" />
                                    <button type="button" wire:click.prevent='increase'>
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>

                                <div wire:ignore>
                                    <select class="niceSelect" id="piece">
                                        <option value="Pieces">{{ __('auth.pieces') }}</option>
                                        <option value="Acres">{{ __('auth.acres') }}</option>
                                        <option value="Amperes">{{ __('auth.amperes') }}</option>
                                        <option value="Bags">{{ __('auth.bags') }}</option>
                                        <option value="Barrels">{{ __('auth.barrels') }}</option>
                                        <option value="Blades">{{ __('auth.blades') }}</option>
                                        <option value="Boxes">{{ __('auth.boxes') }}</option>
                                        <option value="Bushels">{{ __('auth.bushels') }}</option>
                                        <option value="Carats">{{ __('auth.carats') }}</option>
                                        <option value="Cartons">{{ __('auth.cartons') }}</option>
                                        <option value="Cases">{{ __('auth.cases') }}</option>
                                        <option value="Centimeters">{{ __('auth.centimeters') }}</option>

                                        <option value="Chains">{{ __('auth.chains') }}</option>
                                        <option value="Combos">{{ __('auth.combos') }}</option>
                                        <option value="Cubic Centimeters">{{ __('auth.cubic_centimeters') }}</option>
                                        <option value="Cubic Feet">{{ __('auth.cubic_feet') }}</option>
                                        <option value="Cubic Inches">{{ __('auth.cubic_inches') }}</option>
                                        <option value="Cubic Meters">{{ __('auth.cubic_meters') }}</option>
                                        <option value="Cubic Yards">{{ __('auth.cubic_yards') }}</option>
                                        <option value="Degrees Celsius">{{ __('auth.Degrees_celsius') }}</option>
                                        <option value="Degrees Fahrenheit">{{ __('auth.degrees_fahrenheit') }}</option>
                                        <option value="Dozens">{{ __('auth.dozens') }}</option>
                                        <option value="Drams">{{ __('auth.drams') }}</option>
                                        <option value="Fluid Ounces">{{ __('auth.fluid_ounces') }}</option>
                                        <option value="Feet">{{ __('auth.feet') }}</option>
                                        <option value="Forty-Foot Container ">{{ __('auth.forty_foot_container') }} </option>
                                        <option value="Furlongs">{{ __('auth.furlongs') }}</option>
                                        <option value="Gallons">{{ __('auth.gallons') }}</option>
                                        <option value="Gills">{{ __('auth.gills') }}</option>
                                        <option value="Grains">{{ __('auth.grains') }}</option>
                                        <option value="Grams">{{ __('auth.grams') }}</option>

                                        <option value="Gross">{{ __('auth.gross') }}</option>
                                        <option value="Hectares">{{ __('auth.hectares') }}</option>
                                        <option value="Hertz">{{ __('auth.hertz') }}</option>
                                        <option value="Inches">{{ __('auth.inches') }}</option>
                                        <option value="Kiloamperes">{{ __('auth.kiloamperes') }}</option>
                                        <option value="Kilograms">{{ __('auth.kilograms') }}</option>
                                        <option value="Kilohertz">{{ __('auth.kilohertz') }}</option>
                                        <option value="Kilometers">{{ __('auth.kilometer') }}</option>
                                        <option value="Kiloohms">{{ __('auth.kiloohms') }}</option>
                                        <option value="Kilovolts">{{ __('auth.kilovolts') }}</option>
                                        <option value="Kilowatts">{{ __('auth.kilowatts') }}</option>
                                        <option value="Liters">{{ __('auth.liters') }}</option>
                                        <option value="Long Tons">{{ __('auth.long_tons') }}</option>
                                        <option value="Megahertz">{{ __('auth.Megahertz') }}</option>
                                        <option value="Meters">{{ __('auth.Meters') }}</option>

                                        <option value="Metric Tons">{{ __('auth.metric_tons') }}</option>
                                        <option value="Miles">{{ __('auth.miles') }}</option>
                                        <option value="Milliamperes">{{ __('auth.milliamperes') }}</option>
                                        <option value="Milligrams">{{ __('auth.milligrams') }}</option>
                                        <option value="Millihertz">{{ __('auth.millihertz') }}</option>
                                        <option value="Milliliters">{{ __('auth.milliliters') }}</option>
                                        <option value="Millimeters">{{ __('auth.millimeters') }}</option>
                                        <option value="Milliohms">{{ __('auth.milliohms') }}</option>
                                        <option value="Millivolts">{{ __('auth.millivolts') }}</option>
                                        <option value="Milliwatts">{{ __('auth.milliwatts') }}</option>
                                        <option value="Nautical Miles">{{ __('auth.nautical_miles') }}</option>
                                        <option value="Ohms">{{ __('auth.ohms') }}</option>
                                        <option value="Ounces">{{ __('auth.ounces') }}</option>
                                        <option value="Packs">{{ __('auth.packs') }}</option>
                                        <option value="Pairs">{{ __('auth.pairs') }}</option>
                                        <option value="Pallets">{{ __('auth.pallets') }}</option>
                                        <option value="Parcels">{{ __('auth.parcels') }}</option>
                                        <option value="Perches">{{ __('auth.perches') }}</option>
                                        <option value="Pieces">{{ __('auth.pieces') }}</option>
                                        <option value="Pints">{{ __('auth.pints') }}</option>
                                        <option value="Plants">{{ __('auth.plants') }}</option>
                                        <option value="Poles">{{ __('auth.poles') }}</option>

                                        <option value="Pounds">{{ __('auth.pounds') }}</option>
                                        <option value="Quarts">{{ __('auth.quarts') }}</option>
                                        <option value="Quarters">{{ __('auth.quarters') }}</option>
                                        <option value="Rods">{{ __('auth.rods') }}</option>
                                        <option value="Rolls">{{ __('auth.rolls') }}</option>
                                        <option value="Sets">{{ __('auth.sets') }}</option>
                                        <option value="Sheets">{{ __('auth.sheets') }}</option>
                                        <option value="Short Tons">{{ __('auth.short_tons') }}</option>
                                        <option value="Square Centimeters">{{ __('auth.square_centimeters') }}</option>
                                        <option value="Square Feet">{{ __('auth.square_feet') }}</option>
                                        <option value="Square Inches">{{ __('auth.square_inches') }}</option>
                                        <option value="Square Meters">{{ __('auth.square_meters') }}</option>
                                        <option value="Square Miles">{{ __('auth.square_miles') }}</option>
                                        <option value="Square Yards">{{ __('auth.square_yards') }}</option>
                                        <option value="Stones">{{ __('auth.stones') }}</option>
                                        <option value="Strands">{{ __('auth.strands') }}</option>
                                        <option value="Tons">{{ __('auth.tons') }}</option>
                                        <option value="Tonnes">{{ __('auth.tonnes') }}</option>
                                        <option value="Trays">{{ __('auth.trays') }}</option>
                                        <option value="Twenty-Foot Container">{{ __('auth.twenty_foot_container') }}</option>
                                        <option value="Units">{{ __('auth.units') }}</option>
                                        <option value="Volts">{{ __('auth.volts') }}</option>
                                        <option value="Watts">{{ __('auth.watts') }}</option>
                                        <option value="Wp">{{ __('auth.wp') }}</option>
                                        <option value="Yards">{{ __('auth.yards') }}</option>
                                    </select>
                                </div>

                                @error('quantity')
                                    <label for=""></label>
                                    <span style="font-size: 12.5px; color: red;">{{ $message }}</span>
                                @enderror
                                @error('piece')
                                    <label for=""></label>
                                    <span style="font-size: 12.5px; color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="input_row">
                            <label for="">{{ __('auth.trade_terms') }} </label>
                            <div wire:ignore>
                                <select class="niceSelect" id="tradeTerms">
                                    <option value="">Choose Trade Terms</option>
                                    <option value="FOB">FOB</option>
                                    <option value="EXW">EXW</option>
                                    <option value="FAS">FAS</option>
                                    <option value="FCA">FCA</option>
                                    <option value="CFR">CFR</option>
                                    <option value="CPT">CPT</option>
                                    <option value="CIF">CIF</option>
                                    <option value="CIP">CIP</option>
                                    <option value="DES">DES</option>
                                    <option value="DAF">DAF</option>
                                    <option value="DEQ">DEQ</option>
                                    <option value="DDP">DDP</option>
                                    <option value="DDU">DDU</option>
                                </select>
                            </div>
                            @error('trade_terms')
                                <label for=""></label>
                                <span style="font-size: 12.5px; color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input_row">
                            <label for="">{{ __('auth.max_budget') }} <span>*</span></label>
                            <div class="add_form_inner_grid">
                                <div wire:ignore>
                                    <select class="niceSelect" id="maxBudget">
                                        <option value="">{{ __('auth.choose_budget') }}</option>
                                        <option value="<1000"><1000</option>
                                        <option value="1000-5000">1000-5000</option>
                                        <option value="5000-10000">5000-10000</option>
                                        <option value="10000-50000">10000-50000</option>
                                        <option value=">50000">>50000</option>
                                    </select>
                                </div>
                                <div wire:ignore>
                                    <select class="niceSelect" id="curency">
                                        <option value="">{{ __('auth.select_currency') }}</option>
                                        <option value="USD">USD</option>
                                        <option value="AFN">AFN</option>
                                        <option value="ALL">ALL</option>
                                        <option value="DZD">DZD</option>
                                        <option value="AOA">AOA</option>
                                        <option value="ARS">ARS</option>
                                        <option value="AMD">AMD</option>
                                        <option value="AWG">AWG</option>
                                        <option value="AUD">AUD</option>
                                        <option value="AZN">AZN</option>
                                        <option value="BSD">BSD</option>
                                        <option value="BHD">BHD</option>
                                        <option value="BDT">BDT</option>
                                        <option value="BBD">BBD</option>
                                        <option value="BYR">BYR</option>
                                        <option value="BEF">BEF</option>
                                        <option value="BZD">BZD</option>
                                        <option value="BMD">BMD</option>
                                        <option value="BTN">BTN</option>
                                        <option value="BTC">BTC</option>
                                        <option value="BOB">BOB</option>
                                        <option value="BAM">BAM</option>
                                        <option value="BWP">BWP</option>
                                        <option value="BRL">BRL</option>
                                        <option value="GBP">GBP</option>
                                        <option value="BND">BND</option>
                                        <option value="BGN">BGN</option>
                                        <option value="BIF">BIF</option>
                                        <option value="KHR">KHR</option>
                                        <option value="CAD">CAD</option>
                                        <option value="CVE">CVE</option>
                                        <option value="KYD">KYD</option>
                                        <option value="XOF">XOF</option>
                                        <option value="XAF">XAF</option>
                                        <option value="XPF">XPF</option>
                                        <option value="CLP">CLP</option>
                                        <option value="CNY">CNY</option>
                                        <option value="COP">COP</option>
                                        <option value="KMF">KMF</option>
                                        <option value="CDF">CDF</option>
                                        <option value="CRC">CRC</option>
                                        <option value="HRK">HRK</option>
                                        <option value="CUC">CUC</option>
                                        <option value="CZK">CZK</option>
                                        <option value="DKK">DKK</option>
                                        <option value="DJF">DJF</option>
                                        <option value="DOP">DDOP</option>
                                        <option value="XCD">XCD</option>
                                        <option value="EGP">EGP</option>
                                        <option value="ERN">ERN</option>
                                        <option value="EEK">EEK</option>
                                        <option value="ETB">ETB</option>
                                        <option value="EUR">EUR</option>
                                        <option value="FKP">FKP</option>
                                        <option value="FJD">FJD</option>
                                        <option value="GMD">GMD</option>
                                        <option value="GEL">GEL</option>
                                        <option value="DEM">DEM</option>
                                        <option value="GHS">GHS</option>
                                        <option value="GIP">GIP</option>
                                        <option value="GRD">GRD</option>
                                        <option value="GTQ">GTQ</option>
                                        <option value="GNF">GNF</option>
                                        <option value="GYD">GYD</option>
                                        <option value="HTG">HTG</option>
                                        <option value="HNL">HNL</option>
                                        <option value="HKD">HKD</option>
                                        <option value="HUF">HUF</option>
                                        <option value="ISK">ISK</option>
                                        <option value="INR">INR</option>
                                        <option value="IDR">IDR</option>
                                        <option value="IRR">IRR</option>
                                        <option value="IQD">IQD</option>
                                        <option value="ILS">ILS</option>
                                        <option value="ITL">ITL</option>
                                        <option value="JMD">JMD</option>
                                        <option value="JPY">JPY</option>
                                        <option value="JOD">JOD</option>
                                        <option value="KZT">KZT</option>
                                        <option value="KES">KES</option>
                                        <option value="KWD">KWD</option>
                                        <option value="KGS">KGS</option>
                                        <option value="LAK">LAK</option>
                                        <option value="LVL">LVL</option>
                                        <option value="LBP">LBP</option>
                                        <option value="LSL">LSL</option>
                                        <option value="LRD">LRD</option>
                                        <option value="LYD">LYD</option>
                                        <option value="LTL">LTL</option>
                                        <option value="MOP">MOP</option>
                                        <option value="MKD">MKD</option>
                                        <option value="MGA">MGA</option>
                                        <option value="MWK">MWK</option>
                                        <option value="MYR">MYR</option>
                                        <option value="MVR">MVR</option>
                                        <option value="MRO">MRO</option>
                                        <option value="MUR">MUR</option>
                                        <option value="MXN">MXN</option>
                                        <option value="MDL">MDL</option>
                                        <option value="MNT">MNT</option>
                                        <option value="MAD">MAD</option>
                                        <option value="MZM">MZM</option>
                                        <option value="MMK">MMK</option>
                                        <option value="NAD">NAD</option>
                                        <option value="NPR">NPR</option>
                                        <option value="ANG">ANG</option>
                                        <option value="TWD">TWD</option>
                                        <option value="NZD">NZD</option>
                                        <option value="NIO">NIO</option>
                                        <option value="NGN">NGN</option>
                                        <option value="KPW">KPW</option>
                                        <option value="NOK">NOK</option>
                                        <option value="OMR">OMR</option>
                                        <option value="PKR">PKR</option>
                                        <option value="PAB">PAB</option>
                                        <option value="PGK">PGK</option>
                                        <option value="PYG">PYG</option>
                                        <option value="PEN">PEN</option>
                                        <option value="PHP">PHP</option>
                                        <option value="PLN">PLN</option>
                                        <option value="QAR">QAR</option>
                                        <option value="RON">RON</option>
                                        <option value="RUB">RUB</option>
                                        <option value="RWF">RWF</option>
                                        <option value="SVC">SVC</option>
                                        <option value="WST">WST</option>
                                        <option value="SAR">SAR</option>
                                        <option value="RSD">RSD</option>
                                        <option value="SCR">SCR</option>
                                        <option value="SLL">SLL</option>
                                        <option value="SGD">SGD</option>
                                        <option value="SKK">SKK</option>
                                        <option value="SBD">SBD</option>
                                        <option value="SOS">SOS</option>
                                        <option value="ZAR">ZAR</option>
                                        <option value="KRW">KRW</option>
                                        <option value="XDR">XDR</option>
                                        <option value="LKR">LKR</option>
                                        <option value="SHP">SHP</option>
                                        <option value="SDG">SDG</option>
                                        <option value="SRD">SRD</option>
                                        <option value="SZL">SZL</option>
                                        <option value="SEK">SEK</option>
                                        <option value="CHF">CHF</option>
                                        <option value="SYP">SYP</option>
                                        <option value="STD">STD</option>
                                        <option value="TJS">TJS</option>
                                        <option value="TZS">TZS</option>
                                        <option value="THB">THB</option>
                                        <option value="TOP">TOP</option>
                                        <option value="TTD">TTD</option>
                                        <option value="TND">TND</option>
                                        <option value="TRY">TRY</option>
                                        <option value="TMT">TMT</option>
                                        <option value="UGX">UGX</option>
                                        <option value="UAH">UAH</option>
                                        <option value="AED">AED</option>
                                        <option value="UYU">UYU</option>
                                        <option value="UZS">UZS</option>
                                        <option value="VUV">VUV</option>
                                        <option value="VEF">VEF</option>
                                        <option value="VND">VND</option>
                                        <option value="YER">YER</option>
                                        <option value="ZMK">ZMK</option>
                                    </select>
                                </div>


                                @error('max_budget')
                                    <span style="font-size: 12.5px; color: red;">{{ $message }}</span>
                                @enderror

                                @error('curency')
                                    <span style="font-size: 12.5px; color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="input_row">
                            <label for="">{{ __('auth.repetition') }} </label>
                            <div class="add_form_inner_three_grid">
                                <div wire:ignore>
                                    <select class="niceSelect" id="repitation">
                                        <option value="">{{ __('auth.select') }}</option>
                                        <option value="Once">{{ __('auth.once') }}</option>
                                        <option value="Regular">{{ __('auth.regular') }}</option>
                                    </select>
                                </div>
                                <div wire:ignore>
                                    <select class="niceSelect" id="days">
                                        <option value="">{{ __('auth.select') }}</option>
                                        <option value="1">5</option>
                                        <option value="1">10</option>
                                        <option value="1">20</option>
                                        <option value="1">50</option>
                                        <option value="1">100</option>
                                        <option value="1">500</option>
                                        <option value="1">1000</option>
                                    </select>
                                </div>
                                <div wire:ignore>
                                    <select class="niceSelect" id="duration">
                                        <option value="">{{ __('auth.select') }}</option>
                                        <option value="Daily">{{ __('auth.daily') }}</option>
                                        <option value="Weekly">{{ __('auth.weekly') }}</option>
                                        <option value="Monthly">{{ __('auth.monthly') }}</option>
                                        <option value="Yearly">{{ __('auth.yearly') }}</option>
                                    </select>
                                </div>

                                @error('repitation')
                                    <label for=""></label>
                                    <span style="font-size: 12.5px; color: red;">{{ $message }}</span>
                                @enderror
                                @error('days')
                                    <label for=""></label>
                                    <span style="font-size: 12.5px; color: red;">{{ $message }}</span>
                                @enderror
                                @error('duration')
                                    <label for=""></label>
                                    <span style="font-size: 12.5px; color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="input_row">
                            <label for="">{{ __('auth.details') }} </label>
                            <textarea cols="30" rows="8" placeholder="Enter Details" wire:model='details'></textarea>
                            @error('details')
                                <label for=""></label>
                                <span style="font-size: 12.5px; color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input_row">
                            <label for="">{{ __('auth.attachments') }} </label>
                            <div class="file_upload_scan_area">
                                <div class="file_upload_flex d-flex align-items-start flex-wrap-wrap g-lg">
                                    <label for="scanUpload" class="scan_label">
                                        <div class="scan_icon_text">
                                            <img src="assets/images/icon/upload_green_icon.svg" alt="" />
                                            <h4>
                                                {{ __('auth.sourcing') }} <br />
                                                {{ __('auth.document') }}
                                            </h4>
                                        </div>
                                        <input type="file" class="d-none" id="scanUpload" wire:model="file" />
                                    </label>
                                </div>
                                <p class="file_upload_des">
                                    {{ __('auth.product_images_or_files') }}
                                </p>
                            </div>

                            @error('file')
                                <span></span>
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                            @enderror

                            <span></span><div wire:loading="file" wire:target="file" wire:key="file" style="font-size: 12.5px;" class="mr-2"><i class="fa fa-spinner fa-spin mt-3 ml-2"></i> {{ __('auth.uploading') }}</div>

                            @if ($file)
                                <span style="font-size: 13.5px;"><i class="fa fa-check mt-3 ml-2" style="color: green;"></i> {{ __('auth.file_added') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="product_list_wrapper dashboard_card_wrapper" wire:ignore>
                    <div
                        class="profile_content_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                        <h3>{{ __('auth.shipping_and_payment') }}</h3>
                    </div>
                    <div class="add_product_details_form_area">
                        <div class="input_row">
                            <label for="">{{ __('auth.shipping_method') }}</label>
                            <div wire:ignore>
                                <select class="niceSelect" id="shippingMethod">
                                    <option value="">{{ __('auth.please_select') }}</option>
                                    <option value="Sea freight">{{ __('auth.sea_freight') }}</option>
                                    <option value="Air freight">{{ __('auth.air_freight') }}</option>
                                    <option value="Express">{{ __('auth.express') }}</option>
                                    <option value="Land freight">{{ __('auth.land_freight') }}</option>
                                </select>
                            </div>
                            @error('shipping_method')
                                <span></span>
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input_row">
                            <label for="">{{ __('auth.destination') }}</label>
                            <div wire:ignore>
                                <select class="niceSelect" id="Destination">
                                    <option value="">{{ __('auth.please_country') }}</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('shipping_method')
                                <span></span>
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input_row">
                            <label for="">{{ __('auth.lead_time') }}</label>
                            <div class="lead_time_flex">
                                <ul class="d-flex align-items-center flex-wrap-wrap">
                                    <li>{{ __('auth.ship_in') }}</li>
                                    <li><input type="text" wire:model='lead_time'></li>
                                    <li>{{ __('auth.day_after_supplier') }}</li>
                                </ul>
                                @error('lead_time')
                                    <span></span>
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="input_row">
                            <label for="">{{ __('auth.payment_method') }}</label>
                            <div wire:ignore>
                                <select class="niceSelect" id="paymentMethod">
                                    <option value="">{{ __('auth.please_select') }}</option>
                                    <option value="T/T">T/T</option>
                                    <option value="L/C">L/C</option>
                                    <option value="D/P">Once 3</option>
                                    <option value="Western Union">Western Union</option>
                                    <option value="Money Gram">Money Gram</option>
                                </select>
                            </div>
                            @error('payment_method')
                                <span></span>
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="checkbox_row">
                            <div
                                class="custom_checkbox_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                <label class="checkbox_wrapper">{{ __('auth.i_agree_to_share') }}
                                    <input type="checkbox" />
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div
                                class="custom_checkbox_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                <label class="checkbox_wrapper">{{ __('auth.i_have_read_understood') }}
                                    <a href="#">{{ __('auth.buying_request') }}</a>
                                    <input type="checkbox" />
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="submit_button_row">
                            <button type="submit" class="submit_btn">{{ __('auth.submit') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

@push('scripts')
    <script>
        $(document).ready(function(){
            $('#category').on('change', function(){
                @this.set('category_id', $(this).val());
            });

            $('#sourcing').on('change', function(){
                var val = $(this).val();

                if(val == 'Customized Product'){
                    $('#sTypeSelectCont').show();
                    $('#sTypeInputCont').hide();
                }
                else if(val == 'Other'){
                    $('#sTypeInputCont').show();
                    $('#sTypeSelectCont').hide();
                }
                else{
                    $('#sTypeSelectCont').hide();
                    $('#sTypeInputCont').hide();
                }

                @this.set('sourcing', val);
            });

            $('#sourcingSelectType').on('change', function(){
                @this.set('sourcing_type', $(this).val());
            });

            $('#sourcingInputType').on('change', function(){
                @this.set('sourcing_type', $(this).val());
            });
            $('#piece').on('change', function(){
                @this.set('piece', $(this).val());
            });
            $('#tradeTerms').on('change', function(){
                @this.set('trade_terms', $(this).val());
            });
            $('#maxBudget').on('change', function(){
                @this.set('max_budget', $(this).val());
            });
            $('#curency').on('change', function(){
                @this.set('curency', $(this).val());
            });
            $('#repitation').on('change', function(){
                @this.set('repitation', $(this).val());
            });
            $('#days').on('change', function(){
                @this.set('days', $(this).val());
            });
            $('#duration').on('change', function(){
                @this.set('duration', $(this).val());
            });


            $('#shippingMethod').on('change', function(){
                @this.set('shipping_method', $(this).val());
            });

            $('#Destination').on('change', function(){
                @this.set('country', $(this).val());
            });

            $('#paymentMethod').on('change', function(){
                @this.set('payment_method', $(this).val());
            });
        });
    </script>

    <script>
        window.addEventListener('success', event => {
            toastr.success(event.detail.message);
        });
        window.addEventListener('warning', event => {
            toastr.warning(event.detail.message);
        });
        window.addEventListener('error', event => {
            toastr.error(event.detail.message);
        });
    </script>
@endpush
