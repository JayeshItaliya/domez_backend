<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> {{ trans('labels.website_title') }} | @yield('title')</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ Helper::image_path('preloader.gif') }}" type="image/gif" />
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/sweetalert/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/timepicker/jquery.timepicker.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/custom.css') }}">
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/responsive.css') }}">
    @yield('styles')
    <style>
        :root {
            --root-color: #000000;
        }
    </style>
</head>

<body>
    <!-- PreLoader -->
    <div id="preloader">
        <div id="status">
            <img src="{{ Helper::image_path('preloader.gif') }}" width="150" height="150" alt="Prealoader">
        </div>
    </div>
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

            .flatpickr-day.selected,
            .flatpickr-day.startRange,
            .flatpickr-day.endRange,
            .flatpickr-day.selected.inRange,
            .flatpickr-day.startRange.inRange,
            .flatpickr-day.endRange.inRange,
            .flatpickr-day.selected:focus,
            .flatpickr-day.startRange:focus,
            .flatpickr-day.endRange:focus,
            .flatpickr-day.selected:hover,
            .flatpickr-day.startRange:hover,
            .flatpickr-day.endRange:hover,
            .flatpickr-day.selected.prevMonthDay,
            .flatpickr-day.startRange.prevMonthDay,
            .flatpickr-day.endRange.prevMonthDay,
            .flatpickr-day.selected.nextMonthDay,
            .flatpickr-day.startRange.nextMonthDay,
            .flatpickr-day.endRange.nextMonthDay {
                background: var(--bs-secondary);
                -webkit-box-shadow: none;
                box-shadow: none;
                color: #fff;
                border-color: var(--bs-secondary);
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

    <button class="btn btn-primary position-fixed top-50 end-0 fs-5" style="z-index: 99" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
        <i class="fa-regular fa-sliders"></i>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header justify-content-end">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="" class="row">
                <h5 class="text-muted mb-2">{{ trans('labels.change_colors') }}</h5>
                <div class="form-group col-6">
                    <label for="primary_color" class="form-label">{{ trans('labels.primary_color') }}</label>
                    <input type="color" class="form-control" name="primary_color"
                        onkeyup="set_cookie('primary_color',this)" id="primary_color">
                </div>
                <div class="form-group col-6">
                    <label for="secondary_color" class="form-label">{{ trans('labels.secondary_color') }}</label>
                    <input type="color" class="form-control" name="secondary_color" id="secondary_color">
                </div>
            </form>
        </div>
    </div>

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
    <script>
        var primarycolor = $('input[type="color"]#primary_color');
        primarycolor.change(function() {
            var selectedColor = $(this).val();
            set_cookie('primary_color', selectedColor);
        });
        var secondarycolor = $('input[type="color"]#secondary_color');
        secondarycolor.change(function() {
            var selectedColor = $(this).val();
            set_cookie('secondary_color', selectedColor);
        });

        function set_cookie(name, selectedColor) {
            "use strict";
            $("#preloader , #status").show();
            var date = new Date();
            date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
            var expires = "; expires=" + date.toUTCString();
            document.cookie = name + " = " + (selectedColor || "") + expires + "; path=/";
            location.reload();
        }

        function getCookie(name) {
            "use strict";
            var cookie_name = name + "=";
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var c = cookies[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(cookie_name) == 0) return c.substring(cookie_name.length, c.length);
            }
            return;
        }
        $(window).on('load', function() {
            "use strict";
            if ( $.trim(getCookie("primary_color")) != "") {
                document.documentElement.style.setProperty('--bs-primary', getCookie("primary_color"));
                $('#primary_color').val(getCookie("primary_color"));
            }
            if ( $.trim(getCookie("secondary_color")) != "") {
                document.documentElement.style.setProperty('--bs-secondary', getCookie("secondary_color"));
                $('#secondary_color').val(getCookie("secondary_color"));
            }
        });
    </script>
    <script src="{{ url('storage/app/public/admin/js/custom.js') }}"></script>
    @yield('scripts')
</body>

</html>
