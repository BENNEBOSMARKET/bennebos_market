<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bennebos Market - Admin</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('uploads/logo') }}/{{ setting()->fav_icon }}">

    <!-- css -->
    <link href="{{ asset('assets/admin/plugins/select/selectr.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="{{ asset('assets/admin/plugins/uppy/uppy.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/custom_styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" />
    @livewireStyles
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap');

    body {
        font-family: 'Titillium Web', sans-serif;
        font-size: 15px;
    }

    .spinner-border-sm {
        width: 13px;
        height: 13px;
        border-width: 1px;
    }

    .spinner-border-xs {
        width: 10px;
        height: 10px;
        border-width: 1px;
    }

    .submitBtn {
        width: auto;
    }

    .col-form-label {
        color: #000000;
    }

    .custom_tbl tr:nth-child(odd) {
        background-color: white;
    }

    .custom_tbl tr:nth-child(even) {
        background-color: #F2F2F2;
    }

    .custom_tbl th {
        background-color: #e7e6e6;
        color: black;
        font-weight: bold;
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

    .btn-sm {
        padding: 5px 17px;
        font-size: 13.5px;
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
        border: 1px solid #E8EBF3;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        padding: 2px 4px 4px 4px;
        font-size: 13.5px;
        height: 39px;
        outline: none !important;
        transition: all .15s ease-in-out;
    }

    .select2.select2-container .select2-selection__arrow {
        height: 33px;
    }

    .select2.select2-container .select2-selection .select2-selection__rendered {
        color: #333;
        line-height: 32px;
        padding-right: 33px;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
        background: #f8f8f8;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
        -webkit-border-radius: 0 3px 0 0;
        -moz-border-radius: 0 3px 0 0;
        border-radius: 0 3px 0 0;
        height: 33px;
    }

    .select2-container .select2-dropdown {
        background: white;
        border: 1px solid #cccccc;
        font-size: 15px;
    }

    .select2-container .select2-dropdown .select2-search {
        padding: 5px;
    }

    .select2-container .select2-dropdown .select2-search input {
        outline: none !important;
        border: 1px solid #E8EBF3 !important;
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
        background-color: #0F172A;
    }

    .img-delete-btn {
        position: absolute;
        margin-left: -20px;
        margin-top: 7px;
        background: white;
        color: red;
        font-size: 11px;
        border-radius: 100%;
        padding: 1px 5px;
    }
</style>

<body id="body" class="dark-sidebar">

    @livewire('admin.layouts.inc.sidebar')
    @livewire('admin.layouts.inc.navbar')

    <div class="page-wrapper">
        <div class="page-content-tab">
            {{ $slot }}
            <!-- Footer Start -->
            <div>
                <footer class="footer text-center text-sm-start">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script> Bennebos-Market <span class="text-muted d-none d-sm-inline-block float-end">Crafted
                        with <i class="mdi mdi-heart text-danger"></i> by Bennebos-Market</span>
                </footer>
            </div>
            <!-- end Footer -->
        </div>
    </div>
    <!-- Javascript  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/admin/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <!-- Summernote -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <!-- sweet alert 2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Toaster -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('assets/admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/pages/forms-advanced.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/select/selectr.min.js') }}"></script>
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

    <script>
        $(document).ready(function(){
            $('.statusPreLoad').on('click', function(){
                $(this).html('<span class="spinner-border spinner-border-xs" role="status" aria-hidden="true"></span>');
            });
            $('.btnPreLoad').on('click', function(){
                $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            });
        });
    </script>
    @stack('scripts')

    @livewireScripts
</body>

</html>