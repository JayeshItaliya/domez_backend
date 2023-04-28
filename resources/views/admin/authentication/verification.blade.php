<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Page Title -->
    <title>{{ trans('labels.forgot_password') }} | {{ trans('labels.website_titile') }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ Helper::image_path('preloader.gif') }}" sizes="any">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/bootstrap/bootstrap.min.css') }}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/toastr/toastr.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/custom.min.css') }}">
</head>

<body>
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
    <!-- PreLoader -->
    <div id="preloader">
        <div id="status">
            <img src="{{ Helper::image_path('preloader.gif') }}" width="150" height="150" alt="Prealoader">
        </div>
    </div>
    <section class="auth-bg auth-main-content">
        <div class="row justify-content-center align-items-center g-0 w-100 h-100vh">
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 px-5">
                <div class="card auth-wrapper">
                    <div class="logo">
                        <img src="{{ Helper::image_path('logo_dark.png') }}" alt="" srcset="">
                    </div>
                    <h4 class="text-secondary text-center fw-semibold text-capitalize mb-4">{{ trans('labels.enter_verification_code') }}</h4>
                    {{-- <p class="text-center fw-semibold mb-2">We send you on mail.</p> --}}
                    @if (session()->has('verification_email') && session()->get('verification_email') != '')
                    <small class="text-muted text-center"> {{ trans('labels.send_you_code_on') }} {{ session()->get('verification_email') }}</small>
                    @endif
                    <form action="{{ URL::to('verify') }}" method="POST" class="card-body pb-0">
                        @csrf
                        <div class="otp-input mb-3">
                            <input class="otp form-control" name="otp[]" type="text"
                                oninput='digitValidate(this)'onkeyup='tabChange(1)'maxlength=1>
                            <input class="otp form-control" name="otp[]" type="text"
                                oninput='digitValidate(this)'onkeyup='tabChange(2)'maxlength=1>
                            <input class="otp form-control" name="otp[]" type="text"
                                oninput='digitValidate(this)'onkeyup='tabChange(3)'maxlength=1>
                            <input class="otp form-control" name="otp[]" type="text"
                                oninput='digitValidate(this)'onkeyup='tabChange(4)'maxlength=1>
                            @error('otp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit"
                            class="btn btn-primary w-100 mt-2 mb-4">{{ trans('labels.continue') }}</button>
                        <p class="text-center fw-semibold mb-3 fs-7">Did not receive the email? check your spam filter,
                            or
                        </p>
                        <div class="text-center">
                            <a href="#" class="btn btn-outline-secondary w-100">Resend Code</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="circles-backgound-area">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <script src="{{ url('storage/app/public/admin/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/toastr/toastr.min.js') }}"></script>
    <script>
        $(window).on("load", function() {
            "use strict";
            $("#status").delay(500).fadeOut("slow"), $("#preloader").delay(500).fadeOut("slow")
        })
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-bottom-right",
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
        let digitValidate = function(ele) {
            ele.value = ele.value.replace(/[^0-9]/g, "");
        };
        let tabChange = function(val) {
            let ele = document.querySelectorAll("input");
            if (ele[val - 1].value != "") {
                ele[val].focus();
            } else if (ele[val - 1].value == "") {
                ele[val - 2].focus();
            }
        };
    </script>
</body>

</html>
