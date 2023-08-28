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
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/slick/slick.min.css') }}">
    <!-- animate compact Css -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/animate.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/landing.min.css') }}">
    <!-- responsive Css -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/responsive.min.css') }}">
</head>

<body>
    <div class="layout">
        <header class="container header-section-contact">
            <nav class="navbar navbar-expand-lg navbar-light pt-4">
                <a class="navbar-brand logo-img" href="{{ URL::to('/') }}">

                    <img src="{{ url('storage/app/public/admin/images/logo_dark.png') }}">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="offcanvasExample"
                    aria-labelledby="offcanvasExampleLabel" style="width: 300px; background-color:#f4fcf9;">
                    <div class="offcanvas-header">
                        <img src="{{ url('storage/app/public/admin/images/logo_dark.png') }}" alt=""
                            srcset="">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            data-bs-target="#offcanvasExample" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="list-unstyled my-3">
                            <li class="my-3">
                                <a style="color: #468f72" class="text-decoration-none"
                                    href="{{ URL::to('privacy-policy') }}">PRIVACY & POLICY</a>
                            </li>
                            <li class="my-3">
                                <a style="color: #468f72" class="text-decoration-none"
                                    href="{{ URL::to('terms-conditions') }}">TERMS OF SERVICE</a>
                            </li>
                            <li class="my-3">
                                <a style="color: #468f72" class="text-decoration-none" href="#faq">FAQ</a>
                            </li>
                            <a href="{{ URL::to('login') }}" class="btn btn-success dmz-button px-4 my-2 my-sm-0">Sign
                                In</a>
                        </ul>
                    </div>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mr-4">
                        <li class="nav-item me-3">
                            <a class="nav-link" href="{{ URL::to('privacy-policy') }}">PRIVACY & POLICY</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="{{ URL::to('terms-conditions') }}">TERMS OF SERVICE</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="{{ URL::to('/') }}#faq">FAQ</a>
                        </li>
                    </ul>
                    <a href="{{ URL::to('login') }}" class="btn btn-success dmz-button px-4 my-2 my-sm-0">Sign In</a>
                </div>
            </nav>
        </header>
        <section style="margin:100px 0">
            <div class="container">
                {!! Helper::cms(3) !!}
            </div>
        </section>
        <!-- Footer start -->
        <footer class=" footer-text footer-section">
            <div class="container">
                <div class="row footer-content">
                    <div class="col-lg-6 mb-3 ps-sm-0">
                        <div class="footer-box wow fadeInDown delay-0-4s animated">
                            <div class="logo-img mb-4 w-100">
                                <a href="{{ URL::to('/') }}"><img class="footer-logo"
                                        src="{{ url('storage/app/public/admin/images/logo-white.png') }}" /></a>
                            </div>
                            <p class="footer-description">Revolutionizing the way you book your next game! Get instant
                                access to all the domes in the city and book at the tap of a button. <br><br>

                                Say goodbye to the hassle of bringing cash to pay back your friend who booked the dome.
                                With our innovative feature, each player can pay their portion of the reservation with
                                ease, as DOMEZ automatically splits the total cost equally among all players with shared
                                access to the booking. No more awkward conversations or disputes about who owes what.
                                Whether you're a seasoned athlete or a casual sports enthusiast, DOMEZ
                                is designed to provide you with the best experience possible, so you can focus on what
                                matters most: dominating the field or court like a true champion!</p>

                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-3 wow fadeInDown delay-0-4s animated">
                        <div style="display: grid; justify-content:center;">
                            <h6 class="fw-Medium mb-4">Support</h6>
                            <div class="footer-link link">
                                <p class="mb-2"> <a href="{{ URL::to('privacy-policy') }}"
                                        class="text-reset text-copyright mb-2">Privacy & Policy</a> </p>
                                <p class="mb-2"> <a href="{{ URL::to('terms-conditions') }}"
                                        class="text-reset text-copyright">Terms Of Service</a> </p>
                                <p class="mb-2"> <a href="{{ URL::to('cancellation-policies') }}"
                                        class="text-reset text-copyright">Cancellation Policy</a> </p>
                                <p class="mb-2"> <a href="{{ URL::to('refund-policies') }}"
                                        class="text-reset text-copyright">Refund Policy</a> </p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-lg-3 col-sm-6 mb-3 ps-sm-0  footer-form-content wow fadeInDown delay-0-4s animated">
                        <div style="display: grid; justify-content:center;">
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
            </div>
        </footer>
        <!-- Footer end -->
        <!--  footer bottom start -->
        <div class="footer-bottom-section text-center">
            <div class="container border-top">
                <div class="row">
                    <div class="footer-bottom">
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
    <script src="{{ url('storage/app/public/admin/js/custom.min.js') }}"></script>
</body>

</html>
