<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Page Title -->
    <title>{{ trans('labels.website_title') }} | {{ trans('labels.forgot_password') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ Helper::image_path('preloader.gif') }}" sizes="any">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/bootstrap/bootstrap.min.css') }}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/fontawesome/all.min.css') }}">
    <!-- Sweetalert CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/sweetalert/sweetalert2.min.css') }}">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/toastr/toastr.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/custom.css') }}">
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
    <section class="auth-bg">
        <div class="row justify-content-center align-items-center g-0 w-100 h-100vh">
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 px-5">
                <div class="card auth-wrapper">
                    <a href="{{ URL::to('/') }}" class="logo">
                        <img src="{{ Helper::image_path('logo_dark.png') }}" alt="" srcset="">
                    </a>
                    <h4 class="text-secondary text-center fw-semibold text-capitalize mb-4">
                        {{ trans('labels.forgot_password') }}</h4>
                    <p class="text-center ">{{ trans('messages.forgot_password_note') }}</p>
                    <form action="{{ URL::to('send-pass') }}" method="POST" class="card-body pb-0">
                        @csrf
                        <div class="form-floating">
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="{{ trans('messages.enter_email_address') }}">
                            <label for="email">{{ trans('labels.email_address') }}</label>
                        </div>
                        <button type="submit"
                            class="btn btn-secondary w-100 mt-2">{{ trans('labels.continue') }}</button>
                        <div class="border-bottom my-4"></div>
                        <div class="text-center">
                            <span>{{ trans('labels.back_to') }} <a href="{{ URL::to('/login') }}"
                                    class="text-secondary">{{ trans('labels.sign_in') }}</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Javascript -->
    <script src="{{ url('storage/app/public/adminjquery/jquery.min.js') }}"></script>
    <script src="{{ url('storage/app/public/adminbootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('storage/app/public/adminsweetalert/sweetalert2.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admintoastr/toastr.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admincustom.js') }}"></script>
</body>

</html>
