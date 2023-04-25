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
    <!-- Sweetalert CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/sweetalert/sweetalert2.min.css') }}">
    <!-- Toastr CSS -->
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
                    <div class="logo"><img src="{{ Helper::image_path('logo_dark.png') }}" alt=""
                            srcset=""></div>
                    <h4 class="text-secondary text-center fw-semibold text-capitalize mb-4">{{ trans('labels.hi') }},
                        {{ trans('check_email') }}</h4>
                    <p class="text-center fw-semibold mb-4">{{ trans('messages.check_mail_note') }}</p>
                    <a href="{{ URL::to('/') }}" class="btn btn-secondary w-100 mt-2">{{ trans('labels.back_to') }}
                        {{ trans('labels.sign_in') }}</a>
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
    <!-- Javascript -->
    <script src="{{ url('storage/app/public/admin/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/sweetalert/sweetalert2.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/toastr/toastr.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/custom.js') }}"></script>
</body>
</html>
