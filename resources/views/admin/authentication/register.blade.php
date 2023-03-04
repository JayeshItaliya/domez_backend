<!DOCTYPE html>
<html lang="en" data-theme="light" data-sidebar-behaviour="fixed" data-navigation-color="inverted" data-is-fluid="true">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="icon" href="{{ url('storage/app/public/admin/images/favicon/favicon.ico') }}" sizes="any">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/fontawesome/all.min.css') }}">
    <!-- Sweetalert CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/sweetalert/sweetalert2.min.css') }}">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/theme.bundle.css') }}" id="stylesheetLTR">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/toastr/toastr.min.css') }}">
    @yield('styles')
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/custom.css') }}">
    <!-- Page Title -->
    <title>Register | Domez</title>
</head>
<body>
    <!-- MAIN CONTENT -->
    <main class="container">
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-md-7 col-lg-6 d-flex flex-column py-6">
                <div class="my-auto">
                    <h1 class="mb-2">Free Sign Up</h1>
                    <!-- Subtitle -->
                    <p class="text-secondary">Don't have an account? Create your account, it takes less than a minute</p>
                    <!-- Form -->
                    <form action="{{URL::to('store-register')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <!-- Label -->
                                    <label class="form-label" for="name">Name</label>
                                    <!-- Input -->
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Your full name">
                                    @error('name') <span class="text-danger">{{$message}}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <!-- Label -->
                                    <label class="form-label" for="email">Email Address</label>
                                    <!-- Input -->
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Your email address">
                                    @error('email') <span class="text-danger">{{$message}}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <!-- Label -->
                                    <label class="form-label" for="password">Password</label>
                                    <!-- Input -->
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control" autocomplete="off" data-toggle-password-input="" placeholder="Your password">
                                        <button type="button" class="input-group-text px-4 text-secondary link-primary" data-toggle-password=""></button>
                                    </div>
                                    @error('password') <span class="text-danger">{{$message}}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <!-- Label -->
                                    <label class="form-label" for="cpassword">Confirm password</label>
                                    <!-- Input -->
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="cpassword" name="cpassword" class="form-control" autocomplete="off" data-toggle-password-input="" placeholder="Your password again">
                                        <button type="button" class="input-group-text px-4 text-secondary link-primary" data-toggle-password=""></button>
                                    </div>
                                    @error('cpassword') <span class="text-danger">{{$message}}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <!-- Button -->
                            <button type="submit" class="btn btn-primary">Get started</button>
                            <!-- Link -->
                            <small class="mb-0 text-muted">Already registered? <a href="{{URL::to('/')}}">Login</a></small>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-5 col-lg-6 px-lg-4 px-xl-6 d-none d-lg-block">
                <!-- Image -->
                <div class="text-center">
                    <img src="{{ Helper::image_path('register.svg') }}" alt="..." class="img-fluid">
                </div>
            </div>
        </div> <!-- / .row -->
    </main>
    <!-- JAVASCRIPT-->
    <script src="{{ url('storage/app/public/admin/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/sweetalert/sweetalert2.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/toastr/toastr.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/theme.bundle.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/chart.bundle.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/list.bundle.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/custom.js') }}"></script>
    @yield('scripts')
    <script>
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
</body>
</html>
