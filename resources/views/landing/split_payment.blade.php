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
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/slick/slick.css') }}">
    <!-- animate compact Css -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/animate.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/landing.css') }}">
    <!-- responsive Css -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/responsive.css') }}">

    <script src="https://js.stripe.com/v3/"></script>

    <style>
        form {
            /* width: 30vw; */
            /* min-width: 500px; */
            align-self: center;
            box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
                0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
            border-radius: 7px;
            padding: 40px;
            margin: auto;
        }

        #payment-message {
            color: rgb(105, 115, 134);
            font-size: 16px;
            line-height: 20px;
            padding-top: 12px;
            text-align: center;
        }

        #payment-element {
            margin-bottom: 24px;
        }

        /* Buttons and links */
        button {
            background: #5469d4;
            font-family: Arial, sans-serif;
            color: #ffffff;
            border-radius: 4px;
            border: 0;
            padding: 12px 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: block;
            transition: all 0.2s ease;
            box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
            width: 100%;
        }

        button:hover {
            filter: contrast(115%);
        }

        button:disabled {
            opacity: 0.5;
            cursor: default;
        }

        /* spinner/processing state, errors */
        .spinner,
        .spinner:before,
        .spinner:after {
            border-radius: 50%;
        }

        .spinner {
            color: #ffffff;
            font-size: 22px;
            text-indent: -99999px;
            margin: 0px auto;
            position: relative;
            width: 20px;
            height: 20px;
            box-shadow: inset 0 0 0 2px;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
        }

        .spinner:before,
        .spinner:after {
            position: absolute;
            content: "";
        }

        .spinner:before {
            width: 10.4px;
            height: 20.4px;
            background: #5469d4;
            border-radius: 20.4px 0 0 20.4px;
            top: -0.2px;
            left: -0.2px;
            -webkit-transform-origin: 10.4px 10.2px;
            transform-origin: 10.4px 10.2px;
            -webkit-animation: loading 2s infinite ease 1.5s;
            animation: loading 2s infinite ease 1.5s;
        }

        .spinner:after {
            width: 10.4px;
            height: 10.2px;
            background: #5469d4;
            border-radius: 0 10.2px 10.2px 0;
            top: -0.1px;
            left: 10.2px;
            -webkit-transform-origin: 0px 10.2px;
            transform-origin: 0px 10.2px;
            -webkit-animation: loading 2s infinite ease;
            animation: loading 2s infinite ease;
        }

        @-webkit-keyframes loading {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes loading {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @media only screen and (max-width: 600px) {
            form {
                width: 80vw;
                min-width: initial;
            }
        }
    </style>

    <style>
        .success-card {
            background: white;
            padding: 30px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
            margin: 0 auto;
            display: none;
        }

        .success-card h1 {
            color: #88B04B;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 30px;
            margin-bottom: 10px;
        }

        .success-card p {
            color: #404F5E;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-size: 20px;
            margin: 0;
        }

        .success-card i {
            color: #9ABC66;
            font-size: 50px;
            line-height: 150px;
            margin-left: -15px;
        }
    </style>

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
                                        <li class="list-group-item d-flex gap-3"> <strong>Payment Status</strong> :
                                            <span>
                                                @if ($checkbooking->payment_status == 1)
                                                    <span
                                                        class="badge rounded-pill cursor-pointer complete-pill">Completed</span>
                                                @else
                                                    <span
                                                        class="badge rounded-pill cursor-pointer partial-pill">Partial</span>
                                                @endif
                                        </li>
                                        <li class="list-group-item d-flex gap-3"> <strong>Booking Status</strong> :
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
                                        <li class="list-group-item d-flex gap-3"><strong>Total Amount</strong> :
                                            <span>{{ Helper::currency_format($checkbooking->total_amount) }}</span>
                                        </li>
                                        <li class="list-group-item d-flex gap-3"><strong>Paid Amount</strong> :
                                            <span
                                                class="text-success">{{ Helper::currency_format($checkbooking->paid_amount) }}</span>
                                        </li>
                                        <li class="list-group-item d-flex gap-3"><strong>Due Amount</strong> :
                                            <span
                                                class="text-danger">{{ Helper::currency_format($checkbooking->due_amount) }}</span>
                                        </li>

                                        <li class="list-group-item d-flex gap-3"><strong>Date</strong> :
                                            <span>{{ Helper::date_format($checkbooking->start_date) }}</span>
                                        </li>
                                        <li class="list-group-item d-flex gap-3"><strong>Time</strong> :
                                            <span>{{ Helper::time_format($checkbooking->start_time) . ' To ' . Helper::time_format($checkbooking->end_time) }}</span>
                                        </li>
                                        <li class="list-group-item d-flex gap-3"><strong>Players</strong> :
                                            <span>{{ $checkbooking->players }}</span>
                                        </li>
                                        <li class="list-group-item d-flex gap-3"><strong>Address</strong> : <p>
                                                {{ $checkbooking->dome_info->address }}
                                            </p>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-0">Payment</h4>
                                <hr>
                                <div class="success-card text-center">
                                    <div style="border-radius:200px; height:150px; width:150px; background: #F8FAF5; margin:0 auto;"
                                        class="d-flex justify-content-center">
                                        <i class="checkmark">✓</i>
                                    </div>
                                    <h1>Success</h1>
                                </div>

                                <div class="alert d-none" id="payment-message"></div>

                                <form action="" method="" id="payment-form">

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
                                                <input type="number" class="form-control" name="amount"
                                                    id="amount" placeholder="Enter amount"
                                                    max="{{ $checkbooking->due_amount }}">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn btn-primary" type="button"
                                                id="btnamount">Submit</button>
                                        </div>
                                    </div>

                                    <div class="text-center my-3 my-spinner">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">{{ trans('labels.loading') }}</span>
                                        </div>
                                    </div>

                                    <div class="my-3" id="payment-element"></div>
                                    <button type="button" class="btn btn-primary" id="mysubmit">Pay</button>
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
                            <p> <a href="{{ URL::to('privacy-policy') }}"
                                    class="text-reset text-copyright mb-2">Privacy & Policy</a> </p>
                            <p> <a href="{{ URL::to('terms-conditions') }}" class="text-reset text-copyright">Terms
                                    Of Service</a> </p>
                            <p> <a href="{{ URL::to('cancellation-policies') }}"
                                    class="text-reset text-copyright">Cancellation Policy</a> </p>
                            <p> <a href="{{ URL::to('refund-policies') }}" class="text-reset text-copyright">Refund
                                    Policy</a> </p>
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

<script>
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
    $('#mysubmit, .new-payment, .my-spinner').hide();

    // booking_status == 1 == Confirmed
    // booking_status == 2 == Pending
    // booking_status == 3 == Cancelled

    if ({{ Js::from($checkbooking->booking_status) }} == 1) {
        $('.success-card').show();
        $('#payment-form').hide();
    } else if ({{ Js::from($checkbooking->booking_status) }} == 3) {
        $('.card').find('.col-md-6').eq(1).remove();
        $('.card').find('.col-md-6').eq(0).addClass('col-12').removeClass('col-md-6');
    } else {
        checkStatus();
        async function checkStatus() {
            const clientSecret = new URLSearchParams(window.location.search).get(
                "payment_intent_client_secret"
            );
            const amount = new URLSearchParams(window.location.search).get(
                "amount"
            );
            const receipt_name = new URLSearchParams(window.location.search).get(
                "receipt_name"
            );
            if (!clientSecret) {
                return;
            }
            // var urlWithoutParams = window.location.href.split('?')[0];
            // var queryParams = window.location.href.split('?')[1];
            // history.replaceState(null, null, urlWithoutParams);
            $('.form-inputs').hide();
            $('.my-spinner').show();
            try {
                const {
                    paymentIntent
                } = await stripe.retrievePaymentIntent(clientSecret);
                // console.table('---');
                // console.table(paymentIntent);
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
            if ($.trim($('#amount').val()) == "" || $('#amount').val() == 0 || $('#amount').val() >
                {{ Js::from($checkbooking->due_amount) }}) {
                $('#amount').addClass('is-invalid');
                return false;
            } else {
                $('#amount').removeClass('is-invalid');
            }
            $.ajax({
                type: "get",
                url: page_url,
                data: {
                    amount: $('#amount').val()
                },
                beforeSend: function(response) {
                    $('#btnamount, #amount, #receipt_name, #receipt_email').attr('disabled', true);
                    $('.my-spinner').show();
                },
                success: function(response) {
                    $('.my-spinner').hide();
                    var clientSecret = response.client_secret;
                    var elements = stripe.elements({
                        clientSecret,
                        appearance,
                    });
                    // var paymentElement = elements.create('payment', {
                    //     layout: {
                    //         type: 'tabs',
                    //         defaultCollapsed: false,
                    //     },
                    // });
                    var paymentElement = elements.create('payment', options);
                    paymentElement.mount('#payment-element');
                    $('#mysubmit').fadeIn(4000);
                    $('#mysubmit').on('click', function() {
                        stripe.confirmPayment({
                            elements,
                            confirmParams: {
                                return_url: page_url + '?amount=' + $('#amount')
                                    .val() +
                                    '&receipt_email=' + $('#receipt_email').val() +
                                    '&receipt_name=' +
                                    $('#receipt_name').val(),
                                receipt_email: $('#receipt_email').val(),
                            },
                        });
                        return false;
                    });
                },
                error: function(response) {
                    $('#btnamount').attr('disabled', false);
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
