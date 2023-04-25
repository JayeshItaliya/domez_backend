<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
    <style>
        :root {
            --border-radius: 6px;
        }
    </style>
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
        <section style="margin:50px 0">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-md-6">
                                <h4 class="mb-0">{{ $checkbooking->dome_name->name }}</h4>
                                <hr>
                                <div class="row">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex gap-2"> <strong>Booking ID</strong> :
                                            {{ $checkbooking->booking_id }}
                                        </li>
                                        <li class="list-group-item d-flex gap-2"> <strong>Payment Status</strong> :
                                            <span>
                                                @if ($checkbooking->payment_status == 1)
                                                    <span
                                                        class="badge rounded-pill cursor-pointer complete-pill">Completed</span>
                                                @else
                                                    <span
                                                        class="badge rounded-pill cursor-pointer partial-pill">Partial</span>
                                                @endif
                                        </li>
                                        <li class="list-group-item d-flex gap-2"> <strong>Booking Status</strong> :
                                            <span>
                                                @if ($checkbooking->booking_status == 1)
                                                    <span
                                                        class="badge rounded-pill cursor-pointer text-bg-success">Confirmed</span>
                                                @elseif ($checkbooking->booking_status == 2)
                                                    <span
                                                        class="badge rounded-pill cursor-pointer text-bg-warning">Pending</span>
                                                @else
                                                    <span
                                                        class="badge rounded-pill cursor-pointer text-bg-danger">Cancelled</span>
                                                @endif
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex gap-2"><strong>Total Amount</strong> :
                                            <span>{{ Helper::currency_format($checkbooking->total_amount) }}</span>
                                        </li>
                                        <li class="list-group-item d-flex gap-2"><strong>Paid Amount</strong> :
                                            <span
                                                class="text-success">{{ Helper::currency_format($checkbooking->paid_amount) }}</span>
                                        </li>
                                        <li class="list-group-item d-flex gap-2"><strong>Due Amount</strong> :
                                            <span
                                                class="text-danger">{{ Helper::currency_format($checkbooking->due_amount) }}</span>
                                        </li>

                                        <li class="list-group-item d-flex gap-2"><strong>Date</strong> :
                                            <span>{{ Helper::date_format($checkbooking->start_date) }}</span>
                                        </li>
                                        <li class="list-group-item d-flex gap-2"><strong>Time</strong> :
                                            <span>{{ Helper::time_format($checkbooking->start_time) . ' To ' . Helper::time_format($checkbooking->end_time) }}</span>
                                        </li>
                                        <li class="list-group-item d-flex gap-2"><strong>Players</strong> :
                                            <span>{{ $checkbooking->players }}</span>
                                        </li>
                                        <li class="list-group-item d-flex gap-2"><strong>Address</strong> : <p>
                                                {{ $checkbooking->dome_info->address }}
                                            </p>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                            <div class="col-md-6"
                                style="{{ $checkbooking->booking_status == 1 && $checkbooking->due_amount <= 0 ? 'display:none;' : '' }}">
                                <h4 class="mb-0">Payment</h4>
                                <hr>
                                <div class="success-card text-center">
                                    <div style="border-radius:200px; height:150px; width:150px; background: #F8FAF5; margin:0 auto;"
                                        class="d-flex justify-content-center">
                                        <i class="checkmark">✓</i>
                                    </div>
                                    <h1>Success</h1>
                                </div>

                                <form class="stripe-payment-form" action="" method="" id="payment-form">

                                    <div class="row form-inputs">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name"
                                                    id="receipt_name" placeholder="Enter Your name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email"
                                                    id="receipt_email" placeholder="Enter Email">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                                    <input type="number" class="form-control" name="amount"
                                                        id="amount" placeholder="Enter amount"
                                                        value="{{ $checkbooking->min_split_amount > $checkbooking->due_amount ? $checkbooking->due_amount : $checkbooking->min_split_amount }}"
                                                        {{ $checkbooking->min_split_amount > $checkbooking->due_amount ? 'readonly' : '' }}
                                                        min="{{ $checkbooking->min_split_amount > $checkbooking->due_amount ? $checkbooking->due_amount : $checkbooking->min_split_amount }}"
                                                        max="{{ $checkbooking->due_amount }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn btn-primary" type="button"
                                                id="btnamount">Submit</button>
                                        </div>
                                    </div>

                                    <div class="alert d-none" id="payment-message"></div>

                                    <div class="text-center my-3 my-spinner">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">{{ trans('labels.loading') }}</span>
                                        </div>
                                    </div>

                                    <div class="my-3" id="payment-element"></div>
                                    <button type="button" class="btn btn-primary w-100" id="mysubmit">Pay</button>
                                </form>

                                <div class="row my-2 new-payment">
                                    <div class="col-md-12 text-center">
                                        <a href="{{ $page_url }}" class="btn btn-sm btn-outline-primary">Make A
                                            New Payment</a>
                                    </div>
                                </div>
                            </div>
                        </div>

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
    <script src="{{ url('storage/app/public/admin/js/custom.js') }}"></script>
</body>
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
    if ({{ Js::from($checkbooking->booking_status) }} == 1 && {{ Js::from($checkbooking->due_amount) }} <= 0) {
        $('.card').find('.col-md-6').eq(1).remove();
        $('.card').find('.col-md-6').eq(0).addClass('col-12').removeClass('col-md-6');
    } else {
        var page_url = {{ Js::from($page_url) }};
        var process_url = {{ Js::from(URL::to('/payment/process')) }};
        var booking_token = {{ Js::from($booking_token) }};

        var clientSecret = '';
        var stripe = Stripe({{ Js::from(Helper::stripe_data()->public_key) }});
        var appearance = {
            theme: 'stripe',
            variables: {
                colorPrimary: '#0570de',
                colorBackground: '#ffffff',
                colorText: '#30313d',
                colorDanger: '#df1b41',
                fontFamily: 'Ideal Sans, system-ui, sans-serif',
                spacingUnit: '4px',
                borderRadius: '5px',
            },
        };
        var options = {
            country: 'CA',
        };
        checkStatus();
        async function checkStatus() {
            const clientSecret = new URLSearchParams(window.location.search).get("payment_intent_client_secret");
            if (!clientSecret) {
                return;
            }
            $('.form-inputs').hide();
            $('.my-spinner').show();
            const receipt_name = new URLSearchParams(window.location.search).get("receipt_name");
            try {
                const {
                    paymentIntent
                } = await stripe.retrievePaymentIntent(clientSecret);
                const amount = paymentIntent.amount / 100;
                switch (paymentIntent.status) {
                    case "succeeded":
                        changeStatus(paymentIntent.id, amount, receipt_name);
                        break;
                    case "processing":
                        changeStatus(paymentIntent.id, amount, receipt_name);
                        break;
                    case "requires_payment_method":
                        $('#payment-message').removeClass('d-none').addClass('text-danger').html(
                            "Your payment was not successful, please try again.");
                        break;
                    default:
                        $('#payment-message').removeClass('d-none').addClass('text-danger').html(
                            "Something went wrong.");
                        break;
                }
            } catch (error) {
                $('#payment-message').removeClass('d-none').addClass('text-danger').html("Something went wrong.");
                $('#payment-form').hide();
                return false;
            }
        }

        function changeStatus(transaction_id, amount, contributor_name) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                },
                type: "post",
                url: process_url,
                data: {
                    contributor_name: contributor_name,
                    amount: amount,
                    booking_token: booking_token,
                    transaction_id: transaction_id
                },
                beforeSend: function(response) {
                    $('.form-inputs, #payment-form').hide();
                    $('.my-spinner').show();
                },
                success: function(response) {
                    if (response.status == 1) {
                        $('.my-spinner').hide();
                        $('.success-card, .new-payment').show();
                        var urlWithoutParams = window.location.href.split('?')[0];
                        var queryParams = window.location.href.split('?')[1];
                        history.replaceState(null, null, urlWithoutParams);
                    } else {
                        $('#payment-message').removeClass('d-none').addClass('text-danger').html(response
                            .message);
                    }
                    return false;
                },
                error: function(response) {
                    $('#payment-message').removeClass('d-none').addClass('text-danger').html(
                        "Something went wrong.");
                    $('#btnamount').attr('disabled', false);
                },
            });
        }
        $('#receipt_name').val('James Loice');
        $('#receipt_email').val('james@yopmail.com');
        $('#btnamount').on('click', function() {
            if ($.trim($('#receipt_name').val()) == "") {
                $('#receipt_name').addClass('is-invalid');
                return false;
            } else {
                $('#receipt_name').removeClass('is-invalid');
            }
            if ($.trim($('#receipt_email').val()) == "" || !isValidEmail($('#receipt_email').val())) {
                $('#receipt_email').addClass('is-invalid');
                return false;
            } else {
                $('#receipt_email').removeClass('is-invalid');
            }
            var pay_amount = $.trim($('#amount').val());
            $('#amount').removeClass('is-invalid');
            if (pay_amount == "" || pay_amount == 0 || pay_amount >
                {{ Js::from($checkbooking->due_amount) }} || pay_amount <
                {{ Js::from($checkbooking->min_split_amount) }}) {
                $('#amount').addClass('is-invalid');
                return false;
            }
            if ({{ Js::from($checkbooking->min_split_amount) }} > {{ Js::from($checkbooking->due_amount) }}) {
                if ({{ Js::from($checkbooking->due_amount) }} != pay_amount) {
                    $('#amount').addClass('is-invalid');
                    return false;
                }
            }
            $.ajax({
                type: "get",
                url: page_url,
                data: {
                    amount: pay_amount,
                    name: $('#receipt_name').val(),
                    email: $('#receipt_email').val(),
                },
                beforeSend: function(response) {
                    $('#btnamount, #amount, #receipt_name, #receipt_email').attr('disabled', true);
                    $('#payment-message').addClass('d-none').removeClass('text-danger').html("");
                    $('.my-spinner').show();
                },
                success: function(response) {
                    $('.my-spinner').hide();
                    if (response.status == 1) {
                        var clientSecret = response.client_secret;
                        var elements = stripe.elements({
                            clientSecret,
                            appearance,
                        });
                        var paymentElement = elements.create('payment', options);
                        paymentElement.mount('#payment-element');
                        $('#mysubmit').fadeIn(4000);
                        $('#mysubmit').on('click', function() {
                            stripe.confirmPayment({
                                elements,
                                confirmParams: {
                                    return_url: page_url + '?receipt_name=' + $(
                                        '#receipt_name').val(),
                                    receipt_email: $('#receipt_email').val(),
                                },
                            });
                            return false;
                        });
                    } else {
                        $('#payment-message').removeClass('d-none').addClass(response.status == 2 ?
                            'text-success' : 'text-danger').html(response.message);
                        $('#btnamount, #amount, #receipt_name, #receipt_email').attr('disabled',
                            false);
                    }
                },
                error: function(response) {
                    $('.my-spinner').hide();
                    $('#payment-message').removeClass('d-none').addClass('text-danger').html(
                        "Something went wrong.");
                    $('#btnamount, #amount, #receipt_name, #receipt_email').attr('disabled', false);
                },
            });
        });

        function isValidEmail(email) {
            var emailRegex =
                /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return emailRegex.test(email);
        }
    }
</script>

</html>
