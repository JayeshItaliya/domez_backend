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
                <a class="navbar-brand logo-img" href="{{ URL::to('/') }}"><img
                        src="{{ url('storage/app/public/admin/images/landing/logo.png') }}" /></a>
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
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <form action="{{URL::to('dome-request')}}" method="POST" class="contact-us" id="contact_us">
                            @csrf
                            <h1 class="text-center fw-bold text-capitalize mb-3">Interested in discussing?</h1>
                            <div class="row justify-content-center">
                                <div class="col-lg-6 form-group">
                                    <label for="name" class="from-label fw-semibold">Name</label>
                                    <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control" placeholder="Name" required>
                                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="email" class="from-label fw-semibold">Email</label>
                                    <div class="input-group">
                                        <input type="email" id="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email" required>
                                        <button class="btn btn-success dmz-button send_otp" type="button">Verify</button>
                                    </div>
                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group d-none" id="verify_otp">
                                    <label for="otp" class="from-label fw-semibold">OTP</label>
                                    <div class="input-group">
                                        <input type="otp" id="otp" name="otp" value="{{old('otp')}}" class="form-control" placeholder="OTP" value="{{ old('otp') }}" required>
                                        <button class="btn btn-success dmz-button verify_otp" type="button" id="button-addon2">Verify</button>
                                    </div>
                                    @error('otp')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="phone" class="from-label fw-semibold">Phone Number</label>
                                    <input type="text" id="phone" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Phone Number" required>
                                    @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="dome_name" class="from-label fw-semibold">Dome Name</label>
                                    <input type="text" id="dome_name" name="dome_name" value="{{old('dome_name')}}" class="form-control" placeholder="Dome Name" required>
                                    @error('dome_name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="address" class="from-label fw-semibold">Address</label>
                                    <input type="text" id="address" name="dome_address" value="{{old('address')}}" class="form-control" placeholder="Address" required>
                                    @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="dome_city" class="from-label fw-semibold">Dome City</label>
                                    <input type="text" id="dome_city" name="dome_city" value="{{old('dome_city')}}" class="form-control" placeholder="Dome City" required>
                                    @error('dome_city')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="dome_postalcode" class="from-label fw-semibold">Dome Postal Code</label>
                                    <input type="text" id="dome_postalcode" name="dome_postalcode" value="{{old('dome_postalcode')}}" class="form-control" placeholder="Dome Postal Code" required>
                                    @error('dome_postalcode')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="dome_state" class="from-label fw-semibold">Dome State / Province</label>
                                    <input type="text" id="dome_state" name="dome_state" value="{{old('dome_state')}}" class="form-control" placeholder="Dome State / Province" required>
                                    @error('dome_state')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="dome_country" class="from-label fw-semibold">Dome Country</label>
                                    <input type="text" id="dome_country" name="dome_country" value="{{old('dome_country')}}" class="form-control" placeholder="Dome Country" required>
                                    @error('dome_country')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <button type="submit" id="contact_us_submit" class="btn btn-success dmz-button px-4 my-2 my-sm-0 w-auto">Send Your Message</button>
                            </div>
                        </form>
                    </div>
                </div>
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
    <script>
        toastr.options = {
            "closeButton": true
        }
        $(function(){
            $('form, input,textarea ').attr("autocomplete", 'off');
            $('#contact_us input:not(#name , #email, #otp) ,#contact_us_submit').prop('disabled', true);
        });
        $('.send_otp').click(function() {
            if ($.trim($('#name').val()) == "") {
                $('#name').addClass('is-invalid');
                return false;
            } else {
                $('#name').removeClass('is-invalid');
            }
            if ($.trim($('#email').val()) == "") {
                $('#email').addClass('is-invalid');
                return false;
            } else {
                $('#email').removeClass('is-invalid');
            }
            $.ajax({
                url: "{{ URL::to('dome-request') }}",
                type: 'POST',
                data: {
                    '_token': "{{ csrf_token() }}",
                    send_otp: 1,
                    name: $('#name').val(),
                    email: $('#email').val(),
                },
                beforeSend: function(response) {
                    $('.send_otp').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                },
                success: function(response) {
                    if (response.status == 1) {
                        $('.send_otp').text('Resend OTP');
                        $('#verify_otp').removeClass('d-none');
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                        $('.send_otp').text('Verify');
                        return false;
                    }
                },
                error: function(error) {
                    toastr.error('Something went wrong while sending OTP to Email');
                    $('.send_otp').text('Verify');
                    return false;
                }
            });
        });
        $('.verify_otp').click(function() {
            if ($.trim($('#otp').val()) == "") {
                $('#otp').addClass('is-invalid');
                return false;
            } else {
                $('#otp').removeClass('is-invalid');
            }
            $.ajax({
                url: "{{ URL::to('dome-request') }}",
                type: 'POST',
                data: {
                    '_token': "{{ csrf_token() }}",
                    verify_otp: 1,
                    otp: $('#otp').val(),
                },
                success: function(response) {
                    if (response.status == 1) {
                        toastr.success(response.message);
                        $('#verify_otp').addClass('d-none');
                        $('.send_otp').attr('disabled', true);
                        $('#email').attr('readonly', true);
                        $('#contact_us input:not(#name , #email) ,#contact_us_submit').prop('disabled', false);
                    } else {
                        toastr.error(response.message);
                        return false;
                    }
                },
                error: function(error) {
                    toastr.error('Something went wrong!');
                    return false;
                }
            });
        });
        $('#contact_us').submit(function (e) {
            // e.preventDefault();
            if ($.trim($('#name').val()) == "") {
                $('#name').addClass('is-invalid');
                return false;
            } else {
                $('#name').removeClass('is-invalid');
            }
            if ($.trim($('#email').val()) == "") {
                $('#email').addClass('is-invalid');
                return false;
            } else {
                $('#email').removeClass('is-invalid');
            }
            if ($.trim($('#phone').val()) == "") {
                $('#phone').addClass('is-invalid');
                return false;
            } else {
                $('#phone').removeClass('is-invalid');
            }
            if ($.trim($('#dome_name').val()) == "") {
                $('#dome_name').addClass('is-invalid');
                return false;
            } else {
                $('#dome_name').removeClass('is-invalid');
            }
            if ($.trim($('#address').val()) == "") {
                $('#address').addClass('is-invalid');
                return false;
            } else {
                $('#address').removeClass('is-invalid');
            }
            if ($.trim($('#dome_city').val()) == "") {
                $('#dome_city').addClass('is-invalid');
                return false;
            } else {
                $('#dome_city').removeClass('is-invalid');
            }
            if ($.trim($('#dome_postalcode').val()) == "") {
                $('#dome_postalcode').addClass('is-invalid');
                return false;
            } else {
                $('#dome_postalcode').removeClass('is-invalid');
            }
            if ($.trim($('#dome_state').val()) == "") {
                $('#dome_state').addClass('is-invalid');
                return false;
            } else {
                $('#dome_state').removeClass('is-invalid');
            }
            if ($.trim($('#dome_country').val()) == "") {
                $('#dome_country').addClass('is-invalid');
                return false;
            } else {
                $('#dome_country').removeClass('is-invalid');
            }
        });
    </script>
</body>
</html>
