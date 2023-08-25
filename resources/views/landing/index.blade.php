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

    <link rel="stylesheet" href="{{ url('storage/app/public/admin/plugins/owl_carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/plugins/owl_carousel/owl.theme.default.min.css') }}">
</head>

<body>
    <div class="layout">
        <header class="container header-section">
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
                    <ul class="navbar-nav">
                        <li class="nav-item me-3">
                            <a class="nav-link" href="{{ URL::to('privacy-policy') }}">PRIVACY & POLICY</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="{{ URL::to('terms-conditions') }}">TERMS OF SERVICE</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="#faq">FAQ</a>
                        </li>
                    </ul>
                    <a href="{{ URL::to('login') }}" class="btn btn-success dmz-button px-4 my-2 my-sm-0">Sign In</a>
                </div>
            </nav>
        </header>
        <section class="main-banner">
            <div class="container">
                <div class="banner-content wow fadeInDown animated animated" data-wow-duration="2s">
                    <span class="text-uppercase fs-lg-5">welcome to domez</span>
                    <h2 class="text-capitalize">the most advanced <br> booking system for your dome</h2>
                    <p>get bookings faster than ever before through the DOMEZ
                        mobile application!</p>
                    <span style="letter-spacing: 0; text-transform:capitalize" class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-custom-class="custom-popover"
                        data-bs-content="Dear Dome Owner, If you want to join your dome service with us then please press the get to connect button and send your details to the master admin.">
                        <a href="{{ URL::to('contact') }}" class="btn btn-success dmz-button">Get Started</a>
                    </span>
                </div>
                <div class="banner-images wow fadeInDown animated animated">
                    <img class="w-100" src="{{ url('storage/app/public/admin/images/landing/OBJECTS.png') }}" />
                </div>
            </div>
        </section>
        {{-- Most Popular Sports Area Start --}}
        <section class="properly-games small-padding">
            <div class="container">
                <h1 class="heading-title wow fadeInDown delay-0-2s animated">Most Popular Sports</h1>
                <p class="mb-4 text-center text-muted fw-semibold lh-sm">List the Sports and Games That Your Dome
                    Offers on
                    the DOMEZ Mobile App!</p>
                <div id="popular_sports" class="owl-carousel mt-2 owl-loaded">
                    <div class="owl-stage-outer py-5">
                        <div class="owl-stage">
                            <div class="owl-item">
                                <div class="most-games-box position-relative" data-wow-duration="1s">
                                    <div class="game-info m-auto">
                                        <img
                                            src="{{ url('storage/app/public/admin/images/landing/game-soccer.png') }}" />
                                        <h5>Soccer</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="owl-item">
                                <div class="most-games-box position-relative" data-wow-duration="1s">
                                    <div class="game-info m-auto">
                                        <img
                                            src="{{ url('storage/app/public/admin/images/landing/game-volleyball.png') }}" />
                                        <h5>Volleyball</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="owl-item">
                                <div class="most-games-box position-relative" data-wow-duration="1s">
                                    <div class="game-info m-auto">
                                        <img
                                            src="{{ url('storage/app/public/admin/images/landing/game-tennis.png') }}" />
                                        <h5>Tennis</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="owl-item">
                                <div class="most-games-box position-relative" data-wow-duration="1s">
                                    <div class="game-info m-auto">
                                        <img
                                            src="{{ url('storage/app/public/admin/images/landing/game-golf.png') }}" />
                                        <h5>Golf</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="owl-item">
                                <div class="most-games-box position-relative" data-wow-duration="1s">
                                    <div class="game-info m-auto">
                                        <img
                                            src="{{ url('storage/app/public/admin/images/landing/game-frisbee.png') }}" />
                                        <h5>Frisbee</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="owl-item">
                                <div class="most-games-box position-relative" data-wow-duration="1s">
                                    <div class="game-info m-auto">
                                        <img
                                            src="{{ url('storage/app/public/admin/images/landing/game-hockey.png') }}" />
                                        <h5>Hockey</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        {{-- Most Popular Sports Area End --}}
        <section class="game-details">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-6 right-column m-0 align-items-center text-md-start text-center ps-3 pe-3">
                        <div class="game-details-img" data-wow-duration="2s">
                            <img class="w-100"
                                src="{{ url('storage/app/public/admin/images/landing/game-play-1.png') }}" />
                        </div>
                    </div>
                    <div class="col-md-6 right-column m-0 align-items-center text-md-start  ps-3 pe-3">
                        <div class="game-details-text" data-wow-duration="2s">
                            <h2 class="wow fadeInDown  delay-0-2s animated">Monitor Your Revenue,<br>Number of Bookings
                                and<br>Number of Users Daily.</h2>
                            <p class="text-muted fw-semibold" style="text-align: justify">Domez provides a complete
                                suite of tools to manage your
                                bookings and payments processes.
                                At the centre of everything we do are the sports facilities themselves.</p>
                            <p class="text-muted fw-semibold" style="text-align: justify">By their very nature, sports
                                facilities vary based on a
                                wide range of factors. Location,
                                opening times, typically booking slot lengths, facility types and much more.</p>
                            <p class="text-muted fw-semibold" style="text-align: justify">At Domez, our sole focus is
                                an online platform for sports
                                facilities. This allows us to
                                focus on creating a platform that caters to the specific requirements of pitches,
                                courts, halls and other playing surfaces.</p>
                            <a href="{{ URL::to('contact') }}"
                                class="btn btn-success wow fadeInRight delay-0-2s animated">Get Started</a>
                        </div>
                    </div>
                </div>
                <div class="row game-play align-items-center pt-md-5 pt-sm-4 pt-3">
                    <div class="col-md-6 right-column m-0 align-items-center text-md-start  ps-3 pe-3">
                        <div class="game-details-text" data-wow-duration="2s">
                            <h2 class="wow fadeInDown  delay-0-2s animated">Domez Solved the Problem!</h2>
                            <p class="text-muted fw-semibold" style="text-align: justify">Now each player can pay
                                their portion since the app
                                splits the amount among the number of
                                players equally through shared access to the booking. No more the hassle of paying back
                                and missed calculations after each match. An option to pay in full is also offered if
                                one player would like to pay for the whole booking fee.</p>
                            <a href="{{ URL::to('contact') }}"
                                class="btn btn-success dmz-button wow fadeInRight delay-0-2s animated">Get Started</a>
                        </div>
                    </div>
                    <div class="col-md-6 right-column m-0 align-items-center text-md-start text-center ps-3 pe-3">
                        <div class="game-details-img game-details-img" data-wow-duration="2s">
                            <img class="w-100"
                                src="{{ url('storage/app/public/admin/images/landing/game-play-2.png') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="book-sports">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-6 right-column m-0 align-items-center text-md-start text-center ps-3 pe-3">
                        <div class="game-details-img" data-wow-duration="2s">
                            <img class="w-100"
                                src="{{ url('storage/app/public/admin/images/landing/Book.png') }}" />
                        </div>
                    </div>
                    <div class="col-md-6 right-column m-0 align-items-center text-md-start  ps-3 pe-3">
                        <div class="game-details-text" data-wow-duration="2s">
                            <h2 class="wow fadeInDown  delay-0-2s animated text-capitalize">Start Your Own<br>Leagues
                            </h2>
                            <p class="text-muted fw-semibold" style="text-align: justify">DOMEZ provides you with the
                                opportunity to take full control over the management, organization, revenue and
                                operations of the leagues, which
                                is a crucial step toward providing a better experience for participants and spectators.
                                Additionally, by running the league in-house, your management can ensure that the league
                                operates at the highest standards and is managed with the utmost professionalism. And
                                most importantly, you keep all the revenue that the leagues generate because it is run
                                by your dome.</p>
                            <a href="{{ URL::to('contact') }}"
                                class="btn btn-success dmz-button wow fadeInRight delay-0-2s animated">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slick-slider">
            <div class="container">
                <div class="row">
                    <div class="rev_slider testimonial-slider">
                        <div class="rev_slide">
                            <div class="test">
                                <div class="client-img">
                                    <img
                                        src="{{ url('storage/app/public/admin/images/landing/boy-player-1.jpg') }}" />
                                </div>
                                <div class="client-infomation mt-4 pt-2">
                                    <div class="client-name">Eddie Jacobs</div>
                                </div>
                                <div class="review-star">
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                </div>
                                <div class="client-feedback mt-3">
                                    <p>"I have been using DOMEZ for several months now, and it has been a game-changer
                                        for me. It's incredibly user-friendly and easy to navigate, making it a breeze
                                        to book my favourite sports activities. I love how I can easily see availability
                                        and book my sessions instantly. Highly recommend!"</p>
                                </div>
                            </div>
                        </div>
                        <div class="rev_slide">
                            <div class="test">
                                <div class="client-img">
                                    <img
                                        src="{{ url('storage/app/public/admin/images/landing/girl-player-1.jpg') }}" />
                                </div>
                                <div class="client-infomation mt-4 pt-2">
                                    <div class="client-name">Jessica Wislson</div>
                                </div>
                                <div class="review-star">
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-regular fa-star text-warning"></i>
                                </div>
                                <div class="client-feedback mt-3">
                                    <p>"DOMEZ has exceeded my expectations. The interface is sleek and modern, and the
                                        booking process is so simple and convenient. I no longer have to spend hours
                                        searching for open sports activities or worry about cancellations. I can easily
                                        book my sessions and get reminders for upcoming activities. A must-have for all
                                        sports enthusiasts!"</p>
                                </div>
                            </div>
                        </div>
                        <div class="rev_slide">
                            <div class="test">
                                <div class="client-img">
                                    <img
                                        src="{{ url('storage/app/public/admin/images/landing/boy-player-2.jpg') }}" />
                                </div>
                                <div class="client-infomation mt-4 pt-2">
                                    <div class="client-name">James Carter</div>
                                </div>
                                <div class="review-star">
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                </div>
                                <div class="client-feedback mt-3">
                                    <p>"I've used several sports booking apps in the past, but this one takes the cake.
                                        The app is well-designed and packed with useful features, from real-time
                                        availability to the ability to leave reviews for sports activities. The support
                                        team is also incredibly responsive and helpful. If you're looking for a reliable
                                        sports booking app, look no further!"</p>
                                </div>
                            </div>
                        </div>
                        <div class="rev_slide">
                            <div class="test">
                                <div class="client-img">
                                    <img
                                        src="{{ url('storage/app/public/admin/images/landing/boy-player-3.jpg') }}" />
                                </div>
                                <div class="client-infomation mt-4 pt-2">
                                    <div class="client-name">Wirag Wilow</div>
                                </div>
                                <div class="review-star">
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-regular fa-star text-warning"></i>
                                </div>
                                <div class="client-feedback mt-3">
                                    <p>"I cannot recommend DOMEZ enough! It's so intuitive and easy to use, and the
                                        range of sports activities available is impressive. The app is constantly
                                        updated with new features and improvements, and the customer service is
                                        outstanding. If you want to simplify your sports booking experience, this app is
                                        a must-have."</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="contact-form">
            <div class="container">
                <div class="row  align-items-center">
                    <div class="col-lg-6 pt-sm-5">
                        <div class="game-details-text" data-wow-duration="2s">
                            <h2 class="wow fadeInDown  delay-0-2s animated">Do you have any questions? We are here to
                                help!</h2>
                            <form action="{{ URL::to('store-general-enquiries') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label fw-semibold">Name</label>
                                            <input class="form-control" autocomplete="off" type="name"
                                                name="name" value="{{ old('name') }}" id="name"
                                                placeholder="Name" required>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label fw-semibold">Email</label>
                                            <input class="form-control" autocomplete="off" type="email"
                                                name="email" value="{{ old('email') }}" id="email"
                                                placeholder="Email" required>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="form-label fw-semibold">Subject</label>
                                    <input class="form-control" autocomplete="off" type="subject" name="subject"
                                        value="{{ old('subject') }}" id="subject" placeholder="Subject" required>
                                    @error('subject')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message" class="form-label fw-semibold">Message</label>
                                    <textarea class="form-control" autocomplete="off" type="message" name="message" value="{{ old('message') }}"
                                        id="message" placeholder="Message" rows="5" required></textarea>
                                    @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit"
                                    class="btn btn-success dmz-button wow fadeInRight delay-0-2s animated">Send your
                                    message</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="game-details-img" data-wow-duration="2s">
                            <img class="w-100"
                                src="{{ url('storage/app/public/admin/images/landing/contact.png') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="faq-quection" id="faq">
            <div class="container">
                <div class="row ">
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                        <div class="faq-frequently-one">
                            <img src="{{ url('storage/app/public/admin/images/landing/fram-1.png') }}" />
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                        <div class="game-details-text" data-wow-duration="2s">
                            <h2 class="wow fadeInDown  delay-0-2s animated">frequently asked questions</h2>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 w-100 mt-4">
                                <div class="accordion wow fadeInDown delay-0-2s animated" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                How do I register my dome?
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p>Click the “Get Started” button to fill in your information. Click
                                                    “Submit.” Our team will review your documents to verify your dome
                                                    ownership.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                How long does the verification process take?
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p>Verifications take between 24-48 hours to be approved.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                What to do after I get my verification?
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p>Approved clients will receive a temporary username and password to
                                                    access the admin panel to manage bookings, booking rates, time
                                                    slots, fields, employees, types of sports, daily revenue and much
                                                    more.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                        <div class="faq-frequently">
                            <img src="{{ url('storage/app/public/admin/images/landing/frame-2.png') }}" />
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
    <script src="{{ url('storage/app/public/admin/plugins/owl_carousel/owl.carousel.js') }}"></script>
    <script src="{{ url('storage/app/public/admin/js/custom.min.js') }}"></script>
    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))



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
    </script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
    <script>
        $("#popular_sports").owlCarousel({
            loop: true,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayHoverPause: true,
            autoplayTimeout: 2000,
            responsive: {
                1400: {
                    items: 4,
                    dots: false,
                    nav: false,
                    loop: true,
                    arrows: true,
                    margin: 35,
                },
                1300: {
                    items: 3,
                    dots: false,
                    nav: false,
                    loop: true,
                    arrows: true,
                    margin: 35,
                },
                1200: {
                    items: 3,
                    dots: false,
                    nav: false,
                    loop: true,
                    arrows: true,
                    margin: 25,
                },
                1100: {
                    items: 3,
                    dots: false,
                    nav: false,
                    loop: true,
                    arrows: true,
                    margin: 20,
                },
                1100: {
                    items: 3,
                    dots: false,
                    nav: false,
                    loop: true,
                    arrows: true,
                    margin: 15,
                },
                1000: {
                    items: 3,
                    dots: false,
                    nav: false,
                    loop: true,
                    arrows: true,
                    margin: 15,
                },
                991: {
                    items: 2,
                    dots: false,
                    nav: false,
                    loop: true,
                    arrows: true,
                    margin: 10,
                },
                770: {
                    items: 2,
                    dots: false,
                    nav: false,
                    loop: true,
                    arrows: true,
                    margin: 5,
                },
                320: {
                    items: 1,
                    dots: false,
                    nav: false,
                    loop: true,
                    arrows: true,
                    margin: 0,
                },
            }
        });
    </script>
    <script>
        var rev = $('.rev_slider');
        rev.on('init', function(event, slick, currentSlide) {
            var
                cur = $(slick.$slides[slick.currentSlide]),
                next = cur.next(),
                prev = cur.prev();
            prev.addClass('slick-sprev');
            next.addClass('slick-snext');
            cur.removeClass('slick-snext').removeClass('slick-sprev');
            slick.$prev = prev;
            slick.$next = next;
        }).on('beforeChange', function(event, slick, currentSlide, nextSlide) {
            var cur = $(slick.$slides[nextSlide]);
            slick.$prev.removeClass('slick-sprev');
            slick.$next.removeClass('slick-snext');
            next = cur.next(),
                prev = cur.prev();
            prev.prev();
            prev.next();
            prev.addClass('slick-sprev');
            next.addClass('slick-snext');
            slick.$prev = prev;
            slick.$next = next;
            cur.removeClass('slick-next').removeClass('slick-sprev');
        });
        rev.slick({
            speed: 1000,
            autoplay: true,
            arrows: true,
            dots: false,
            focusOnSelect: true,
            prevArrow: '<button> prev</button>',
            nextArrow: '<button> next</button>',
            infinite: true,
            centerMode: true,
            slidesPerRow: 1,
            slidesToShow: 1,
            slidesToScroll: 1,
            centerPadding: '0',
            swipe: true,
            customPaging: function(slider, i) {
                return '';
            },
            /*infinite: false,*/
        });
    </script>
</body>

</html>
