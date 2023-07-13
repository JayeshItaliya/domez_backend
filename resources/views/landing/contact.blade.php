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
            <nav class="navbar navbar-expand-lg navbar-light">
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
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <form action="{{ URL::to('dome-request') }}" method="POST" class="contact-us" id="contact_us">
                            @csrf
                            <h1 class="text-center fw-bold text-capitalize mb-3">Get ready to elevate your game.</h1>
                            <div class="row justify-content-center">
                                <div class="col-lg-6 form-group">
                                    <label for="name" class="from-label fw-semibold">Name</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Name" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="email" class="from-label fw-semibold">Email</label>
                                    <div class="input-group">
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" required>
                                        <button class="btn btn-success dmz-button send_otp" type="button">Verify</button>
                                    </div>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group d-none" id="verify_otp">
                                    <label for="otp" class="from-label fw-semibold">OTP</label>
                                    <div class="input-group">
                                        <input type="otp" id="otp" name="otp" value="{{ old('otp') }}" class="form-control" placeholder="OTP" required>
                                        <button class="btn btn-success dmz-button verify_otp" type="button" id="button-addon2">Verify</button>
                                    </div>
                                    @error('otp')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="phone" class="from-label fw-semibold">Phone Number</label>
                                    <div class="input-group">
                                        <input type="hidden" name="country" id="country" value="1">
                                        <input type="tel" id="phone" name="phone" class="form-control"
                                            placeholder="Phone Number" value="{{ old('phone') }}" required
                                            style="border-radius: 5px">
                                    </div>
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="dome_name" class="from-label fw-semibold">Dome Name</label>
                                    <input type="text" id="dome_name" name="dome_name"
                                        value="{{ old('dome_name') }}" class="form-control" placeholder="Dome Name"
                                        required>
                                    @error('dome_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address" class="from-label fw-semibold">Dome Address</label>
                                    <input type="text" id="address" name="dome_address"
                                        value="{{ old('address') }}" class="form-control" placeholder="Address"
                                        required>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="dome_city" class="from-label fw-semibold">City</label>
                                    <input type="text" id="dome_city" name="dome_city"
                                        value="{{ old('dome_city') }}" class="form-control" placeholder="City"
                                        required>
                                    @error('dome_city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="dome_postalcode" class="from-label fw-semibold">Zip / Postal
                                        Code</label>
                                    <input type="text" id="dome_postalcode" name="dome_postalcode"
                                        value="{{ old('dome_postalcode') }}" class="form-control"
                                        placeholder="Zip / Postal Code" required>
                                    @error('dome_postalcode')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="dome_state" class="from-label fw-semibold">State /
                                        Province</label>
                                    <input type="text" id="dome_state" name="dome_state"
                                        value="{{ old('dome_state') }}" class="form-control"
                                        placeholder="State / Province" required>
                                    @error('dome_state')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="dome_country" class="from-label fw-semibold">Country</label>
                                    <input type="text" id="dome_country" name="dome_country"
                                        value="{{ old('dome_country') }}" class="form-control" placeholder="Country"
                                        required>
                                    @error('dome_country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" id="contact_us_submit"
                                    class="btn btn-success dmz-button px-4 my-2 my-sm-0 w-auto">Submit</button>
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
                                <p class="mb-2"> <a href="{{ URL::to('privacy-policy') }}" class="text-reset text-copyright mb-2">Privacy & Policy</a> </p>
                                <p class="mb-2"> <a href="{{ URL::to('terms-conditions') }}" class="text-reset text-copyright">Terms Of Service</a> </p>
                                <p class="mb-2"> <a href="{{ URL::to('cancellation-policies') }}" class="text-reset text-copyright">Cancellation Policy</a> </p>
                                <p class="mb-2"> <a href="{{ URL::to('refund-policies') }}" class="text-reset text-copyright">Refund Policy</a> </p>
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
    <script src="{{ url('storage/app/public/admin/js/intelTelInput/intlTelInput.min.js') }}"></script>
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/js/intelTelInput/intlTelInput.min.css') }}">
    <script src="{{ url('storage/app/public/admin/js/intelTelInput/utils.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/custom.min.js') }}"></script>
    <script>
        var input = $('#phone');
        var iti = intlTelInput(input.get(0))
        iti.setCountry("ca");
        input.on('countrychange', function(e) {
            $('#country').val(iti.getSelectedCountryData().dialCode);
        });
        $('.iti--allow-dropdown').addClass('w-100');
    </script>
    <script>
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
        $(function() {
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
                    $('.send_otp').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                    );
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
                        $('#contact_us input:not(#name , #email) ,#contact_us_submit').prop('disabled',
                            false);
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
        $('#contact_us').submit(function(e) {
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
