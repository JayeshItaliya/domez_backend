<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Page Title -->
    <title>{{ trans('labels.website_title') }}</title>
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
    <!-- slick Css -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/slick/slick.css') }}">
    <!-- animate compact Css -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/animate.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/landing.css') }}">
    <!-- responsive Css -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/responsive.css') }}">
</head>

<body>
    <div class="layout">
        <header class="container header-section-contact">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand logo-img" href="{{ URL::to('/') }}">
                    <img src="{{ Helper::image_path('preloader.gif') }}" height="50">
                    <img src="{{ url('storage/app/public/admin/images/landing/logo_dark.png') }}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mr-4">
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="{{ URL::to('privacy-policy') }}">PRIVACY & POLICY</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="{{ URL::to('terms-conditions') }}">TERMS OF SERVICE</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="{{ URL::to('/') }}#faq">FAQ</a>
                        </li>
                    </ul>
                    <a href="{{ URL::to('login') }}" class="btn btn-success dmz-button px-4 my-2 my-sm-0">Sign In</a>
                </div>
            </nav>
        </header>
        <section style="margin:100px 0">
            <div class="container">
                {!! Helper::cms(2) !!}
            </div>
        </section>
        <!-- Footer start -->
        <footer class=" footer-text footer-section">
            <div class="container">
                <div class="row footer-content">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 ps-sm-0">
                        <div class="footer-box wow fadeInDown delay-0-4s animated">
                            <div class="logo-img mb-4 w-100">
                                <a href="{{ URL::to('/') }}"><img class="footer-logo"
                                        src="{{ url('storage/app/public/admin/images/landing/Domez-Logo-name-white.png') }}" /></a>
                            </div>
                            <p class="footer-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                do eiusmod tempor incididunt ut labore et dolore agna.Lorem ipsum dolor sit amet. Lorem
                                ipsum dolor.</p>
                            <div class="share-link-icon">
                                <ul class="social-icon d-flex list-unstyled">
                                    <li class="socail-space me-2"><a href="#" class="social"><i
                                                class="fa-brands fa-facebook-f"></i></a></li>
                                    <li class="socail-space mx-2"><a href="#" class="social"><i
                                                class="fa-brands fa-twitter"></i></a></li>
                                    <li class="socail-space mx-2"><a href="#" class="social"><i
                                                class="fa-brands fa-instagram"></i></a></li>
                                    <li class="socail-space mx-2"><a href="#" class="social"><i
                                                class="fa-brands fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 wow fadeInDown delay-0-4s animated">
                        <h6 class="fw-Medium mb-4">Support</h6>
                        <div class="footer-link link">
                            <p>
                                <a href="{{ URL::to('privacy-policy') }}"
                                    class="text-reset text-copyright mb-2">Privacy & Policy</a>
                            </p>
                            <p>
                                <a href="{{ URL::to('terms-conditions') }}" class="text-reset text-copyright">Terms Of
                                    Service</a>
                            </p>
                            <p>
                                <a href="{{ URL::to('/') }}#faq" class="text-reset text-copyright">FAQ</a>
                            </p>
                        </div>
                    </div>
                    <div
                        class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 ps-sm-0  footer-form-content wow fadeInDown delay-0-4s animated">
                        <h6 class="fw-Medium mb-4">Available on</h6>
                        <div class="footer-form">
                            <div class="icon-link d-flex align-items-center mb-3">
                                <img src="{{ url('storage/app/public/admin/images/landing/google-play.png') }}" />
                            </div>
                            <div class="icon-link d-flex align-items-center mb-4">
                                <img src="{{ url('storage/app/public/admin/images/landing/apple-store.png') }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer end -->
        <!--  footer bottom start -->
        <div class="footer-bottom-section text-center">
            <div class="container border-top">
                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 footer-bottom">
                        <p class="copright-text m-0 py-3"><a href="{{ URL::to('/') }}"
                                class="text-decoration-none text-copyright wow fadeInLeft delay-0-2s animated">Copyright
                                © 2023. All rights reserved.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Javascript -->
    <script src="{{ url('storage/app/public/admin/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/sweetalert/sweetalert2.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/toastr/toastr.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/slick/slick.min.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/custom.js') }}"></script>
</body>

</html>
