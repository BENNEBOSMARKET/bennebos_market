<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seller Dashboard</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ setting()->fav_icon }}">

    <!-- css -->
    <link href="{{ asset('assets/seller/plugins/select/selectr.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="{{ asset('assets/seller/plugins/uppy/uppy.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/seller/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/seller/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/seller/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/seller/css/style.css') }}" rel="stylesheet" type="text/css" />

    <!-- summernote -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" />

    {{-- Toaster --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/seller/plugins/select2/css/select2.min.css') }}">
    <!--Nice Select -->
    <link rel="stylesheet" href="{{ asset('assets/seller/plugins/niceSelect/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/seller/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/seller/plugins/daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css"/>

    @livewireStyles
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap');

    body {
        font-family: 'Titillium Web', sans-serif;
        font-size: 15px;
    }

    .submitBtn{
        width: auto;
    }

    .col-form-label{
        color: #000000;
    }

    .custom_tbl tr:nth-child(odd) {
        background-color: transparent;
        border-bottom: 1px solid #27123e;
    }

    .custom_tbl tr:nth-child(even) {
        background-color: transparent;
        border-bottom: 1px solid #27123e;
    }

    .custom_tbl th {
        background-color: transparent;
        color: white;
        font-weight: bold;
    }

    #customSwitchSuccess {
        font-size: 20px;
    }

    .searchbox{
        background: #23192D;
        font-size: 15px;
        color: white;
    }

    .card-title {
        float: left;
    }

    .card-button {
        float: right;
    }

    .sinput {
        border: 1px solid #CED4DA;
        border-radius: 4px;
        padding: 5px 7px;
        font-size: 12.5px;
    }

    .sinput:focus {
        border: 1px solid #046A70;
        box-shadow: none;
        outline: none;
    }

    .search_cont {
        text-align: right;
    }

    .sort_cont {
        text-align: left;
    }

    @media screen and (max-width: 720px) {
        .search_cont {
            text-align: center;
        }

        .sort_cont {
            text-align: center;
        }
    }

    .cstm_search {
        width: 20%;
    }
    .cstm_sort {
        width: 20%;
    }

    .sort_select{
        width: 70%;
        border-radius: 7px;
        background: #361a4a;
        color: white;
        padding: 5px;
        border: 1px solid #361a4a;
        font-size: 13px;
    }
    .filter-text{
        margin-top: 5px;
        margin-right: 5px;
    }
    .ti-filter{
        font-size: 25px;
        margin-top: -3px;
    }

    .page-item.active .page-link{
        background: #74c247;
        border-color: #74c247;
    }

    @media screen and (max-width: 1024px) {
        .cstm_search {
            width: 40%;
        }
        .cstm_sort {
            width: 30%;
        }
    }

    .btn-sm {
        padding: 5px 17px;
        font-size: 13.5px;
    }
    .form-control:read-only{
        background: transparent;
    }

    .form-select{
        background-color: #361A4A;
        color: white;
        border: 1px solid #361A4A;
    }
    .form-select:focus{
        background-color: #361A4A;
        color: white;
        border: 1px solid #361A4A;
    }
    .form-select:disabled{
        background-color: #200635;
        color: white;
        border: 1px solid #361A4A;
    }
    .btn-primary{
        border: 1px solid #74c247;
    }
    .btn-primary:hover{
        border: 1px solid #74c247;
    }

    .btn-primary.disabled, .btn-primary:disabled {
        color: #fff;
        background-color: #74C247;
        border: 1px solid #74C247;
    }

    label, .col-form-label{
        color: white;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active  {
        transition: background-color 5000s;
        -webkit-text-fill-color: #fff !important;
    }

    /* Summernote */
    .note-editor.note-frame .note-editing-area .note-editable {
        color: #ffffff;
        background-color: #0E011C;
        border: 1px solid #361A4A;
    }

    .note-editor.note-airframe .note-statusbar .note-resizebar, .note-editor.note-frame .note-statusbar .note-resizebar{
        bbackground-color: #0E011C;
    }

    .note-toolbar {
        background-color: #0E011C;
        border: 1px solid #361A4A;
        color: #ffffff;
    }

    .note-toolbar .note-btn{
        background-color: #0E011C;
        border: 1px solid #361A4A;
        color: #ffffff;
    }

    .note-dropdown-menu{
        color: #ffffff;
        background-color: #0E011C;
        border: 1px solid #361A4A;
    }
    a.note-dropdown-item {
        color: #ffffff;
        margin: 5px 0;
        text-decoration: none;
    }
    a.note-dropdown-item:hover {
        color: #ffffff;
        background: #361A4A;
        margin: 5px 0;
        text-decoration: none;
    }
    .note-editor.note-frame .note-statusbar .note-resizebar {
        background-color: #361A4A;
        color: white;
    }
    .note-editor.note-airframe .note-statusbar .note-resizebar .note-icon-bar, .note-editor.note-frame .note-statusbar .note-resizebar .note-icon-bar {
        border-top: 1px solid #ffffff;
        margin: 1px auto;
        width: 20px;
    }

    .btn-check:active+.btn-outline-primary, .btn-check:checked+.btn-outline-primary, .btn-outline-primary.active, .btn-outline-primary.dropdown-toggle.show, .btn-outline-primary:active{
        background: #74c247;
        color: white;
        border: 1px solid #74c247;
    }
    .btn-outline-primary{
        color: white;
        border: 1px solid #74c247;
    }
    .btn-outline-primary:hover{
        background: #74c247;
        color: white;
        border: 1px solid #74c247;
    }
    .btn-check:active+.btn-primary, .btn-check:checked+.btn-primary, .btn-primary.active, .btn-primary:active, .show>.btn-primary.dropdown-toggle{
        background: #4c8f25;
        color: white;
        border: 1px solid #4c8f25;
    }

    /* selectr */
    .selectr-options-container, .selectr-selected {
        border: 1px solid #361A4A !important;
        background-color: #0E011C;
        color: #ffffff;
    }
    .selectr-input{
        border: 1px solid #361A4A !important;
        background-color: #0E011C;
        color: #ffffff;
    }

    .selectr-option.active {
        color: #fff;
        background-color: #361A4A;
    }

    .selectr-option[aria-selected=true] {
        background-color: #361A4A;
        color: #ffffff;
    }
    .selectr-notice{
        background-color: #0E011C;
        color: #ffffff;
        border-top: 1px solid #361A4A;
    }

    .selectr-tag {
        background: #361A4A;
        border-radius: 3px;
        color: #ffffff;
    }

    .selectr-options::-webkit-scrollbar {
        width: 16px;
        background-clip: padding-box;
    }
    .selectr-options::-webkit-scrollbar-track {
        background-color: #26053D;
        height: 8px;
        background-clip: padding-box;
        border-right: 10px solid rgba(0, 0, 0, 0);
        border-top: 10px solid rgba(0, 0, 0, 0);
        border-bottom: 10px solid rgba(0, 0, 0, 0);
    }

    .selectr-options::-webkit-scrollbar-thumb {
        background-clip: padding-box;
        background-color: #402F53;
        border-right: 10px solid rgba(0, 0, 0, 0);
        border-top: 10px solid rgba(0, 0, 0, 0);
        border-bottom: 10px solid rgba(0, 0, 0, 0);
    }

    .selectr-options::-webkit-scrollbar-button {
        display: none;
    }

    /* input[type=file]::file-selector-button {
        color: #ffffff;
        background: #361A4A;
    }
    input[type=file]::file-selector-button:hover {
        color: #ffffff;
        background: #361A4A;
    } */

    /* Modal */
    .modal-content{
        background: #0E011C;
        border: 1px solid #361A4A;
    }
    .modal-body{
        background: #0E011C;
    }
    .spinner-border{
        color: white;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .select2.select2-container .select2-selection {
        border: 1px solid #402F53;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        padding: 2px 4px 4px 4px;
        font-size: 13.5px;
        height: 39px;
        outline: none !important;
        transition: all .15s ease-in-out;
        background-color: #0E011C;
    }

    .select2.select2-container .select2-selection__arrow {
        height: 33px;
    }

    .select2.select2-container .select2-selection .select2-selection__rendered {
        color: #ffffff;
        line-height: 32px;
        padding-right: 33px;
    }

    .select2-search__field{
        background-color: #0E011C;
        border: 1px solid #402F53;
        color: #ffffff;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
        background: #0E011C;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
        -webkit-border-radius: 0 3px 0 0;
        -moz-border-radius: 0 3px 0 0;
        border-radius: 0 3px 0 0;
        height: 33px;
    }

    .select2-container .select2-dropdown {
        background: #0E011C;
        border: 1px solid #402F53;
        font-size: 15px;
        color: white;
    }

    .select2-container .select2-dropdown .select2-search {
        padding: 5px;
    }

    .select2-container .select2-dropdown .select2-search input {
        outline: none !important;
        border: 1px solid #402F53 !important;
        padding: 5px 6px !important;
        font-size: 14px;
    }

    .select2-container .select2-dropdown .select2-results {
        padding: 5px;
    }

    .select2-container .select2-dropdown .select2-results ul {
        padding: 0px 0px 5px 0px;
    }

    .select2-container .select2-dropdown .select2-results ul .select2-results__option {
        padding: 5px 7px;
    }

    .select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
        background-color: #26053D;
    }

    .select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] li {
        background-color: #26053D;
    }
    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: #26053D;
    }

    .select2-results__options::-webkit-scrollbar {
        width: 16px;
        background-clip: padding-box;
    }
    .select2-results__options::-webkit-scrollbar-track {
        background-color: #26053D;
        height: 8px;
        background-clip: padding-box;
        border-right: 10px solid rgba(0, 0, 0, 0);
        border-top: 10px solid rgba(0, 0, 0, 0);
        border-bottom: 10px solid rgba(0, 0, 0, 0);
    }

    .select2-results__options::-webkit-scrollbar-thumb {
        background-clip: padding-box;
        background-color: #402F53;
        border-right: 10px solid rgba(0, 0, 0, 0);
        border-top: 10px solid rgba(0, 0, 0, 0);
        border-bottom: 10px solid rgba(0, 0, 0, 0);
    }

    .select2-results__options::-webkit-scrollbar-button {
        display: none;
    }

</style>

<body id="body" class="dark-sidebar">

    @livewire('seller.layouts.inc.sidebar')
    @livewire('seller.layouts.inc.navbar')

    <div class="page-wrapper">
        <div class="page-content-tab">
            {{ $slot }}
            <!-- Footer Start -->
            <div>
                <div id='default'></div>
                <footer class="footer text-center text-sm-start">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script> {{ __('seller.bennebos_market') }} <span class="text-muted d-none d-sm-inline-block float-end">{{ __('seller.crafted_with') }} <i class="mdi mdi-heart text-danger"></i> {{ __('seller.by_bennebos_market') }}</span>
                </footer>
            </div>
        </div>
    </div>

    <!-- Javascript  -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/seller/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>

    <script src="{{ asset('assets/seller/plugins/multi-animated-counter.js') }}"></script>
    <script src="{{ asset('assets/seller/plugins/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('assets/seller/plugins/chartjs/chart.js') }}"></script>
    <script src="{{ asset('assets/seller/plugins/niceSelect/jquery.nice-select.min.js') }}"></script>

    <!-- Summernote -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js" ></script>


    {{-- sweet alert 2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Toaster --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('assets/seller/plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- InputMask -->
    <script src="{{ asset('assets/seller/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/seller/plugins/inputmask/jquery.inputmask.min.js') }}"></script>

    <!-- date-range-picker -->
    <script src="{{ asset('assets/seller/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('assets/seller/pages/forms-advanced.js') }}"></script>
    <script src="{{ asset('assets/seller/plugins/select/selectr.min.js') }}"></script>


    <script src="{{ asset('assets/seller/js/main.js') }}"></script>
    <script src="{{ asset('assets/seller/js/app.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('.select2').select2({
                dropdownAutoWidth : true,
            });
        });
    </script>


    <script>
        $(document).ready(function(){
            toastr.options = {
                "progressBar": true,
                "positionClass": "toast-bottom-left"
            };

            $('[data-toggle="tooltip"]').tooltip();
        });

        window.addEventListener('success', event => {
            toastr.success(event.detail.message);
        });
        window.addEventListener('warning', event => {
            toastr.warning(event.detail.message);
        });
        window.addEventListener('error', event => {
            toastr.error(event.detail.message);
        });
        @if(Session::has('success'))
            toastr.options =
                {
                    "progressBar" : true,
                    "positionClass": "toast-bottom-left"
                }
                toastr.success("{{ session('success') }}");
        @endif
        @if(Session::has('error'))
            toastr.options =
                {
                    "progressBar" : true,
                    "positionClass": "toast-top-right"
                }
                toastr.error("{{ session('error') }}");
        @endif


        //SWL
        window.addEventListener('show-delete-confirmation', event => {
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete !'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteConfirmed')
                }
            })
        });

        //Success Delete
        window.addEventListener('categoryDeleted', event => {
            Swal.fire(
                'Deleted!',
                'Category has been deleted successfully.',
                'success'
            )
        });

    </script>



    @stack('scripts')

    @livewireScripts
</body>

</html>
