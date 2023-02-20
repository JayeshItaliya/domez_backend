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
        {{-- Header Area Start  --}}
        <header class="container header-section">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand logo-img" href="{{URL::to('/')}}"><img
                        src="{{ url('storage/app/public/admin/images/landing/logo.png') }}" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mr-4">
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="#">PRIVACY & POLICY</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="#">TERMS OF SERVICE</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="#">FAQ</a>
                        </li>
                    </ul>

                    <a href="{{ URL::to('login') }}" class="btn btn-success dmz-button px-4 my-2 my-sm-0">Sign In</a>
                </div>
            </nav>
        </header>
        {{-- Header Area End --}}

        {{-- Main Banner Area Start --}}
        <section class="main-banner">
            <div class="container">
                <div class="banner-content wow fadeInDown animated animated" data-wow-duration="2s">
                    <span class="text-uppercase fs-5">welcome to domez</span>
                    <h2 class="text-capitalize">the most advanced <br> booking system for your dome</h2>
                    <p>get bookings faster than ever before through the DOMEZ
                        mobile application!</p>
                    <a href="{{URL::to('contact')}}" class="btn btn-success dmz-button px-4" data-bs-toggle="tooltip" data-bs-placement="right"
                        data-bs-title="Dear Dome Owner, If you want to join your dome service with us then please press the get to connect button and send your details to the master admin.">Get Started</a>
                </div>
                <div class="banner-images wow fadeInDown animated animated">
                    <img class="w-100" src="{{ url('storage/app/public/admin/images/landing/OBJECTS.png') }}" />
                </div>
            </div>
        </section>
        {{-- Main Banner Area End --}}

        {{-- Most Popular Sports Area Start --}}
        <section class="properly-games small-padding">
            <div class="container">
                <h1 class="heading-title wow fadeInDown delay-0-2s animated">Most Popular Sports</h1>
                <p class="mb-4 text-center text-muted fw-semibold">List the Sports and Games That Your Dome Offers on the DOMEZ Mobile App!</p>
                <div class="row justify-content-center py-5">
                    <div class="col-lg-3 col-md-6 col-auto mb-3">
                        <div class="most-games-box position-relative" data-wow-duration="1s">
                            <div class="game-info m-auto">
                                <img src="{{ url('storage/app/public/admin/images/landing/game-1.png') }}" />
                                <h5>Soccer</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-auto mb-3">
                        <div class="most-games-box position-relative" data-wow-duration="1s">
                            <div class="game-info m-auto">
                                <img src="{{ url('storage/app/public/admin/images/landing/game-2.png') }}" />
                                <h5>Volleyball</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-auto mb-3">
                        <div class="most-games-box position-relative" data-wow-duration="1s">
                            <div class="game-info m-auto">
                                <img src="{{ url('storage/app/public/admin/images/landing/game-3.png') }}" />
                                <h5>Tennis</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-auto mb-3">
                        <div class="most-games-box position-relative" data-wow-duration="1s">
                            <div class="game-info m-auto">
                                <img src="{{ url('storage/app/public/admin/images/landing/game-4.png') }}" />
                                <h5>Golf</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- Most Popular Sports Area End --}}

        <section class="game-details">
            <div class="container">
                <div class="row align-items-center">
                    <div
                        class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 right-column m-0 align-items-center text-md-start text-center ps-3 pe-3">
                        <div class="game-details-img" data-wow-duration="2s">
                            <img class="w-100"
                                src="{{ url('storage/app/public/admin/images/landing/game-play-1.png') }}" />
                        </div>
                    </div>
                    <div
                        class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 right-column m-0 align-items-center text-md-start  ps-3 pe-3">
                        <div class="game-details-text" data-wow-duration="2s">
                            <h2 class="wow fadeInDown  delay-0-2s animated">Monitor Your Revenue, Number of Bookings
                                and
                                Number of Users Daily.</h2>
                            <p class="text-muted fw-semibold">Domez provides a complete suite of tools to manage your bookings and payments processes.
                                At the centre of everything we do are the sports facilities themselves.</p>
                            <p class="text-muted fw-semibold">By their very nature, sports facilities vary based on a wide range of factors. Location,
                                opening times, typically booking slot lengths, facility types and much more.</p>
                            <p class="text-muted fw-semibold">At Domez, our sole focus is an online platform for sports facilities. This allows us to
                                focus on creating a platform that caters to the specific requirements of pitches,
                                courts, halls and other playing surfaces.</p>
                            <button class="btn btn-success wow fadeInRight delay-0-2s animated">Get Started</button>
                        </div>
                    </div>
                </div>
                <div class="row game-play align-items-center pt-md-5 pt-sm-4">
                    <div
                        class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 right-column m-0 align-items-center text-md-start  ps-3 pe-3">
                        <div class="game-details-text" data-wow-duration="2s">
                            <h2 class="wow fadeInDown  delay-0-2s animated">Domez Solved the Problem!</h2>
                            <p class="text-muted fw-semibold">Now each player can pay their portion since the app splits the amount among the number of
                                players equally through shared access to the booking. No more the hassle of paying back
                                and missed calculations after each match. An option to pay in full is also offered if
                                one player would like to pay for the whole booking fee.</p>
                            <button class="btn btn-success dmz-button wow fadeInRight delay-0-2s animated">Get
                                Started</button>
                        </div>
                    </div>
                    <div
                        class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 right-column m-0 align-items-center text-md-start text-center ps-3 pe-3">
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
                <div class="row align-items-center ">
                    <div
                        class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 right-column m-0 align-items-center text-md-start text-center ps-3 pe-3">
                        <div class="game-details-img" data-wow-duration="2s">
                            <img class="w-100"
                                src="{{ url('storage/app/public/admin/images/landing/Book.png') }}" />
                        </div>
                    </div>
                    <div
                        class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 right-column m-0 align-items-center text-md-start  ps-3 pe-3">
                        <div class="game-details-text" data-wow-duration="2s">
                            <h2 class="wow fadeInDown  delay-0-2s animated">Book a sports<br>facility near you</h2>
                            <p class="text-muted fw-semibold">At the Domez , we can offer your team a personalized playing experience due to our
                                adaptable playing surface. With outfield fences for Volleyball, and Soccer Goals, and
                                Tennis, and Golf, the Domez can easily be customized to fit your specific needs.</p>
                            <p class="text-muted fw-semibold">Contact us today, and we can take you through the<br>set-ups we can provide!</p>
                            <button class="btn btn-success dmz-button wow fadeInRight delay-0-2s animated">Get
                                Started</button>
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
                                    <img src="{{ url('storage/app/public/admin/images/landing/Eddie-Jacobs.png') }}" />
                                </div>
                                <div class="client-infomation mt-4">
                                    <div class="client-name">Eddie Jacobs</div>
                                    <div class="client-designation">Hocky Power</div>
                                </div>
                                <div class="client-feedback mt-3">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Cursus nibh mauris, nec turpis orci lectus maecenas.
                                        Suspendisse sed magna eget nibh in turpis. Consequat
                                        duis diam lacus arcu.</p>
                                </div>
                            </div>
                        </div>
                        <div class="rev_slide">
                            <div class="test">
                                <div class="client-img">
                                    <img src="{{ url('storage/app/public/admin/images/landing/Eddie-Jacobs.png') }}" />
                                </div>
                                <div class="client-infomation mt-4">
                                    <div class="client-name">Eddie Jacobs</div>
                                    <div class="client-designation">Hocky Power</div>
                                </div>
                                <div class="client-feedback mt-3">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Cursus nibh mauris, nec turpis orci lectus maecenas.
                                        Suspendisse sed magna eget nibh in turpis. Consequat
                                        duis diam lacus arcu.</p>
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
                            <h2 class="wow fadeInDown  delay-0-2s animated">Do you have any questions?
                                We are here to help!
                            </h2>
                            <form action="{{URL::to('/')}}" method="post">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label fw-semibold">Name</label>
                                            <input class="form-control" type="name" name="name" id="name" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label fw-semibold">Email</label>
                                            <input class="form-control" type="email" name="email" id="email" placeholder="Enter Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="form-label fw-semibold">Subject</label>
                                    <input class="form-control" type="subject" name="subject" id="subject" placeholder="Enter Subject">
                                </div>
                                <div class="form-group">
                                    <label for="message" class="form-label fw-semibold">Message</label>
                                    <textarea class="form-control" type="message" name="message" id="message" placeholder="Enter Message" rows="5"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success dmz-button wow fadeInRight delay-0-2s animated">Send your
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
        <section class="faq-quection">
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
                                                Can i watch local sports in my are?
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text
                                                    ever since the 1500s, when an unknown printer took a galley of type
                                                    and scrambled it to make a type specimen book. It has survived not..
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Can i sign in to watchESPN, fox sports go or NBC Sports ?
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text
                                                    ever since the 1500s, when an unknown printer took a galley of type
                                                    and scrambled it to make a type specimen book. It has survived not..
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                What is the video qualitu and how much bandwidth doi need ?
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text
                                                    ever since the 1500s, when an unknown printer took a galley of type
                                                    and scrambled it to make a type specimen book. It has survived not..
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFour">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                aria-expanded="false" aria-controls="collapseFour">
                                                How can i Stream sports on multiple devices at the same time ?
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse"
                                            aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text
                                                    ever since the 1500s, when an unknown printer took a galley of type
                                                    and scrambled it to make a type specimen book. It has survived not..
                                                </p>
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
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 ps-sm-0">
                        <div class="footer-box wow fadeInDown delay-0-4s animated">
                            <div class="logo-img mb-4 w-100">
                                <a href="{{URL::to('/')}}"><img class="footer-logo"
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
                                <a href="#" class="text-reset text-copyright mb-2"> Privacy & Policy</a>
                            </p>
                            <p>
                                <a href="#" class="text-reset text-copyright">Terms Of Service</a>
                            </p>
                            <p>
                                <a href="#" class="text-reset text-copyright">FAQ</a>
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
                        <p class="copright-text m-0 py-3"><a href="{{URL::to('/')}}"
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
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
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
            //console.log('beforeChange');
            var
                cur = $(slick.$slides[nextSlide]);
            //console.log(slick.$prev, slick.$next);
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
