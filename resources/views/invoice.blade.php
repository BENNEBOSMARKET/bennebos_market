<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice</title>

    <style>
        *,
        ::before,
        ::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap");

        body {
            font-family: "Poppins", sans-serif;
        }

        body,
        html {
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span {
            font-family: "Poppins", sans-serif;
        }

        img {
            max-width: 100%;
        }

        .text-end {
            text-align: right;
        }

        .vertical_top {
            vertical-align: top;
        }

        .overflow_auto {
            overflow: auto;
        }

        .float_left {
            float: left;
        }

        .float_right {
            float: right;
        }

        .clear_left {
            clear: left;
        }

        .clear_both {
            clear: both;
        }

        .position-relative {
            position: relative;
        }

        .table_wrapper {
            max-width: 600px;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .top_space {
            padding-top: 30px;
        }

        .left_space {
            padding-left: 30px;
        }

        .right_space {
            padding-right: 30px;
        }

        .remove_font_size {
            font-size: 0;
            text-align: center;
        }

        .logo {
            text-align: start;
            padding: 10px 0;
        }

        .product_table_area {
            padding: 26px 30px 0px 30px;
        }

        .border_table {
            border: 2px solid #74c247;
        }

        .table_two_column {
            max-width: 300px;
            width: 100%;
            border-collapse: collapse;
        }

        .invoice_location_area {
            font-family: "Poppins", sans-serif;
            padding-top: 10px;
            padding-left: 30px;
        }

        .invoice_location_area h4 {
            font-weight: 500;
            font-size: 14px;
            line-height: 160%;
            color: #13192b;
        }

        .invoice_location_area h3 {
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            font-size: 18px;
            line-height: 160%;
            color: #13192b;
            margin: 2px 0;
        }

        .invoice_location_area p {
            font-weight: 400;
            font-size: 12px;
            line-height: 160%;
            color: #6b7280;
            max-width: 180px;
            width: 100%;
        }

        .info_item_area {
            padding-top: 40px;
            padding-left: 270px;
            padding-right: 30px;
        }

        .info_item {
            min-height: 22px;
        }

        .info_item h4 {
            font-weight: 600;
            font-size: 12px;
            line-height: 160%;
            color: #13192b;
            margin: 2px 0;
            width: 110px;
            text-align: right;
        }

        .info_item h5 {
            font-weight: 500;
            font-size: 12px;
            line-height: 160%;
            color: #6b7280;
            margin-left: 15px;
        }

        .user_info_right_area {
            position: absolute;
            right: 0;
            top: 0;
        }

        .product_table_inner_area {
            height: 400px;
        }

        .product_table_inner_area th {
            font-weight: 500;
            font-size: 12px;
            line-height: 160%;
            color: #ffffff;
            padding: 12px;
            background: #74c247;
        }

        .product_table_inner_area td {
            padding: 10px;
        }

        .product_table_inner_area .table tr:nth-child(even) {
            background: #f7f7f7;
        }

        .product_img_area {
            width: 36px;
            height: 36px;
        }

        .product_img_area img {
            border-radius: 5px;
        }

        .product_title {
            font-weight: 400;
            font-size: 12px;
            line-height: 160%;
            text-align: center;
            color: #13192b;
            height: 38px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            max-width: 120px;
            width: 100%;
            margin: auto;
        }

        .proudct_description {
            font-weight: 400;
            font-size: 12px;
            line-height: 160%;
            text-align: center;
            color: #13192b;
        }

        .table_footer_area {
            padding-top: 15px;
            padding-left: 30px;
            padding-right: 30px;
        }

        .table_footer_area td {
            padding: 10px;
        }

        .singature_text {
            font-weight: 500;
            font-size: 12px;
            line-height: 160%;
            text-align: center;
            color: #000000;
            padding-top: 2px;
            border-top: 2px solid #cdd0d5;
            width: 140px;
        }

        .footer_price_wrapper {
            padding-left: 100px !important;
        }

        .footer_price_area {
            margin-top: 4px;
            min-height: 20px;
        }

        .footer_total_price_area h4,
        .footer_price_area h4 {
            font-weight: 600;
            font-size: 12px;
            line-height: 160%;
            color: #13192b;
            width: 70px;
            text-align: end;
        }

        .footer_total_price_area {
            padding: 8px;
            margin-top: 10px;
            min-height: 35px;
            background: #74c247;
        }

        .footer_total_price_area h4 {
            color: white;
        }
    </style>
</head>

<body>
<table class="table_wrapper">
    <!-- Top Bar Section -->
    <tr>
        <td class="top_space">
            <table class="table">
                <tr>
                    <td class="left_space">
                        <a href="#" class="logo">
                            <img src="{{ public_path('assets/front/images/header/logo.svg') }}"
                                 alt="logo bennebos" />
                        </a>
                    </td>
                    <td class="right_space">
                        <div style="display: block; text-align: right;">
                            <a href="#">
                                <img src="{{ public_path('assets/front/images/others/barcode.png') }}"
                                     alt="bar code" />
                            </a>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!-- Border Text Section -->
    <tr>
        <td>
            <table class="table">
                <tr>
                    <td>
                        <img src="{{ public_path('assets/front/images/others/invoie_border_img.png') }}"
                             alt="invoice_border"  style="width: 100%;" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- Customer Info Section -->
    <tr>
        <td>
            <table class="table">
                <tr>
                    <td class="invoice_location_area">
                        <h4>Invoice To:</h4>
                        <h3>{{ ($order->address->first_name ?? ' ') .' '. ($order->address->last_name ?? ' ') }}</h3>
                        <p>
                            {{ $order->shipping_address ?? '' }}
                        </p>
                    </td>
                    <td class="info_item_area">
                        <table class="table info_item">
                            <tr>
                                <td style="width: 120px">
                                    <h4>Order Code &nbsp;:</h4>
                                </td>
                                <td>
                                    <h5>{{ $order->code ?? '' }}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 120px">
                                    <h4>Payment Status &nbsp;:</h4>
                                </td>
                                <td>
                                    <h5>{{ $order->payment_status }}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 120px;">
                                    <h4>Date &nbsp;:</h4>
                                </td>
                                <td>
                                    <h5>{{ Carbon\Carbon::parse($order->date)->format('d M, Y') }}</h5>
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>

            </table>
        </td>
    </tr>

    <!-- Table Product Section -->
    <tr>
        <td class="product_table_area">
            <table class="table border_table">
                <tr class="vertical_top">
                    <td class="product_table_inner_area">
                        <div class="overflow_auto">
                            <table class="table">
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Delivery Type</th>
                                    <th>Qty</th>
                                    <th>Total Amount</th>
                                </tr>
                                @php $total = 0 @endphp
                                @foreach ($order->orderProducts as $details)
                                    <tr>
                                        <td>
                                            <div class="product_img_area">
                                                <img
                                                    src="{{ public_path('uploads/product/' . $details->products->thumbnail ?? '') }}" />
                                            </div>
                                        </td>
                                        <td>
                                            <h4 class="product_title">
                                                {{ $details->products->name ?? '' }}
                                            </h4>
                                        </td>
                                        <td>
                                            <h4 class="proudct_description">{{ $order->payment_type }}</h4>
                                        </td>
                                        <td>
                                            <h4 class="proudct_description">{{ $details->quantity }}</h4>
                                        </td>
                                        <td>
                                            <h4 class="proudct_description">$ {{ $details->price }} </h4>
                                        </td>
                                    </tr>
                                    @php $total += ($details->quantity * $details->products->unit_price) @endphp
                                @endforeach
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!-- Table Bottom   Section -->
    <tr>
        <td class="table_footer_area">
            <table class="table">
                <tr>
                    <td>
                        <h4 class="singature_text">Authorise Signature</h4>
                    </td>
                    <td class="footer_price_wrapper">
                        <div class="footer_price_area">
                            <h4 class="float_left">Sub Total &nbsp;:</h4>
                            <h4 class="float_left">$ {{ $total }} </h4>
                        </div>
                        <div class="footer_price_area">
                            <h4 class="float_left clear_both">Dicount &nbsp;:</h4>
                            <h4 class="float_left">${{ $order->discount ?? 0 }}</h4>
                        </div>
                        <div class="footer_total_price_area">
                            <h4 class="float_left">Total &nbsp;:</h4>
                            <h4 class="float_left">${{ $order->grand_total ?? 0 }}</h4>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>

</html>
