<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> {{ trans('labels.website_title') }} | @yield('title')</title>
    <link rel="icon" href="{{ Helper::image_path('favicon.png') }}" sizes="any">
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/sweetalert/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/timepicker/jquery.timepicker.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/custom.css') }}">
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/responsive.css') }}">
    @yield('styles')
</head>

<body>
    <!-- PreLoader -->
    <div id="preloader">
        <div id="status">
            <img src="{{ Helper::image_path('preloader.gif') }}" width="150" height="150" alt="Prealoader">
        </div>
    </div>
    {{-- <button class="btn btn-primary position-fixed top-50 end-0 fs-5" style="z-index: 99"><i class="fa-regular fa-sliders"></i></button> --}}
    <main>
        <style>
            :root {
                --border-radius: 6px;
                --bs-primary: #468F72;
                --bs-secondary: #57A700;
                --bs-primary-rgb: 70, 143, 114;
                --bs-secondary-rgb: 87, 167, 0;
                --border-default: 1px solid rgba(var(--bs-primary-rgb), 0.25);
            }
        </style>
        <div class="container-fluid px-0">
            @if (!empty(Auth::user()))
                @include('admin.layout.header')
            @endif
            <div class="d-flex">
                @if (!empty(Auth::user()))
                    @include('admin.layout.sidebar')
                @endif
                <div class="content-wrapper me-3">
                    @yield('contents')
                </div>
            </div>
        </div>
        @if (!empty(Auth::user()))
            @include('admin.layout.footer')
        @endif
        <div id="primaryColor" style="color: var(--bs-primary)"></div>
        <div id="secondaryColor" style="color: var(--bs-secondary)"></div>
        <div id="lightSecondaryColor" style="color: rgba(var(--bs-secondary-rgb),0.75)"></div>
    </main>

    <!-- Javascript -->
    <script src="{{ url('storage/app/public/admin/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/sweetalert/sweetalert2.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/toastr/toastr.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/timepicker/jquery.timepicker.min.js') }}" defer=""></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.js"></script>
    <script>
        let are_you_sure = {{ Js::from(trans('messages.are_you_sure')) }};
        let yes = {{ Js::from(trans('messages.yes')) }};
        let no = {{ Js::from(trans('messages.no')) }};
        let wrong = {{ Js::from(trans('messages.wrong')) }};
        let oops = {{ Js::from(trans('messages.oops')) }};
        let no_data = {{ Js::from(trans('messages.no_data')) }};
        let is_vendor = {{ Js::from(Auth::user()->type == 2 ? true : false) }};
        let primary_color = $('#primaryColor').css('color');
        let secondary_color = $('#secondaryColor').css('color');
        let light_secondary_color = $('#lightSecondaryColor').css('color');
        toastr.options = {
            "closeButton": true
        }
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif
        @if (Session::has('info'))
            toastr.info("{{ session('info') }}");
        @endif
        @if (Session::has('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    <script src="{{ url('storage/app/public/admin/js/custom.js') }}"></script>
    @yield('scripts')
</body>

</html>
