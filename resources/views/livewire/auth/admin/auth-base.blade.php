<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bennebos Market - Admin Login</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('uploads/logo') }}/{{ setting()->fav_icon }}">

    <!-- css -->
    <link href="{{ asset('assets/admin/plugins/select/selectr.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="{{ asset('assets/admin/plugins/uppy/uppy.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.css') }}">

    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/codemirror/theme/monokai.css') }}">


    {{-- Toaster --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.css') }}">


    @livewireStyles
</head>

<body id="body" class="auth-page" style="background-image: url('{{ asset('assets/admin/images/p-1.png') }}'); background-size: cover; background-position: center center;">

    {{ $slot }}

    <!-- Javascript  -->
    <script src="{{ asset('assets/admin/plugins/select/selectr.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/admin/js/app.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <!-- CodeMirror -->
    <script src="{{ asset('assets/admin/plugins/codemirror/codemirror.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/codemirror/mode/css/css.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>

    {{-- sweet alert 2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Toaster --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- InputMask -->
    <script src="{{ asset('assets/admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/inputmask/jquery.inputmask.min.js') }}"></script>

    <!-- date-range-picker -->
    <script src="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('assets/admin/pages/forms-advanced.js') }}"></script>


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
