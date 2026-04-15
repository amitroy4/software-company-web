<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') | {{$setting->company_name}}</title>
        <!-- favicons Icons -->
        <!--<link rel="manifest" href="{{ asset('frontend') }}/assets/images/favicons/site.webmanifest" />-->
        <meta name="description" content="QBit Tech is a modern php Template for Business, It Solution, Corporate, Agency, Portfolio shops. The template perfectly fits Beauty Spa, Salon, and Wellness
         Treatments websites and businesses." />

        <link rel="icon" href="{{ asset('storage/' . ($setting->favicon ?? 'default-favicon.ico')) }}"  />

        <!-- fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com/">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendors/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendors/bootstrap-select/bootstrap-select.min.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendors/animate/animate.min.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendors/fontawesome/css/all.min.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendors/icofont/icofont.min.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendors/jquery-ui/jquery-ui.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendors/jarallax/jarallax.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendors/nouislider/nouislider.min.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendors/nouislider/nouislider.pips.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendors/tiny-slider/tiny-slider.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendors/tolak-icons/style.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendors/owl-carousel/css/owl.carousel.min.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/vendors/owl-carousel/css/owl.theme.default.min.css" />
        <!-- template styles -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/custom.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/qbit.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/qbit-color-3.css" />
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/custom-erp-module.css" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/responsive.css" />


        @stack('styles')
    </head>

    <body class="custom-cursor">
        <div class="custom-cursor__cursor"></div>
        <div class="custom-cursor__cursor-two"></div>
        <!-- /.preloader -->
        <div class="page-wrapper">
            <header class="main-header-six sticky-header sticky-header--normal">
                <div class="container">
                    <div class="main-header-six__inner">
                        @if ($setting->logo_dark )

                        <div class="main-header-six__logo">
                            <a href="{{'/'}}">
                            <img src="{{ asset('storage/' . $setting->logo_dark ) }}" alt="QBit Tech" width="200">

                            </a>
                        </div>
                        @endif

                        <!-- /.main-header-six__logo -->
                        <nav class="main-header-six__nav main-menu">

                            <ul class="main-menu__list">
                                <li class="{{ request()->is('/') ? 'current' : '' }}">
                                    <a href="{{'/'}}">Start Here</a>
                                </li>
                                <li class="dropdown {{ request()->routeIs('about-us.page') || request()->routeIs('powerhouse.team') ? 'current' : '' }}">
                                    <a href="#">Explore QBit Tech</a>
                                    <ul>
                                        <li><a href="{{ route('about-us.page') }}">Roots of QBit Tech</a></li>
                                         <!-- <li><a href="why-choose.php">Difference We Make</a></li>  -->
                                         <!-- <li><a href="how-we-work.php">From Concept to Creation</a></li>  -->
                                        <li><a href="{{ route('powerhouse.team') }}">Powerhouse Team</a></li>
                                         <!-- <li><a href="trusted-clients.php">Brands We Serve</a></li>  -->
                                    </ul>
                                </li>
                                <li class="dropdown {{ request()->routeIs('service*') ? 'current' : '' }}">
                                    <a href="#">Solutions</a>
                                    <ul>
                                        <li><a href="{{ route('service') }}">All Solutions</a></li>
                                        @isset($services)
                                            @foreach ($services as $service)
                                                <li><a href="{{ route('service.details', $service->slug) }}">{{ $service->service_name }}</a></li>
                                            @endforeach
                                        @endisset
                                    </ul>
                                </li>
                                <li class="{{ request()->routeIs('products.page') ? 'current' : '' }}">
                                    <a href="{{ route('products.page') }}">Products</a>
                                </li>
                                <li class="{{ request()->routeIs('gallery.page') ? 'current' : '' }}">
                                    <a href="{{route('gallery.page') }}">Gallery</a>
                                </li>
                                <li class="{{ request()->routeIs('all.blogs') ? 'current' : '' }}">
                                    <a href="{{route('all.blogs') }}">News</a>
                                </li>
                                <li class="{{ request()->routeIs('contact-us.page') ? 'current' : '' }}"><a href="{{ route('contact-us.page') }}">Let’s Connect</a></li>
                                <!-- <li class="dot"></li> -->
                            </ul>
                        </nav>
                        <!-- /.main-header-six__nav -->
                        <div class="main-header-six__right">
                            <div class="mobile-nav__btn mobile-nav__toggler">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <!-- /.mobile-nav__toggler -->
                            <a href="#" class="search-toggler main-header-six__search">
                                <i class="icon-magnifying-glass" aria-hidden="true"></i>
                                <span class="sr-only">Search</span>
                            </a><!-- /.search-toggler -->
                            <a href="{{ route('contact-us.page') }}" class="tolak-btn-two main-header-six__btn">
                                <span class="tolak-btn-two__left-star"></span>
                                <span>Contact Us<i class="tolak-icons-two-arrow-right-short"></i></span>
                                <span class="tolak-btn-two__right-star"></span>
                            </a><!-- /.thm-btn main-header-six__btn -->
                        </div>
                        <!-- /.main-header-six__right -->
                    </div>
                    <!-- /.main-header-six__inner -->
                </div>
                <!-- /.container-fluid -->
            </header>
            <!-- /.main-header-six -->

            @yield('content')

            <footer class="main-footer background-black">
                <div class="main-footer__bg background-black"
                    style="background-image: url({{ asset('frontend') }}/assets/images/backgrounds/footer-bg-1-1.jpg);">
                </div>
                <!-- /.main-footer__bg -->
                <div class="main-footer__shape"
                    style="background-image: url({{ asset('frontend') }}/assets/images/shapes/footer-shape-1.png);">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="footer-widget footer-widget--about">

                                @if ($setting->logo_dark)
                                <a href="{{'/'}}" class="footer-widget__logo">
                                    <img src="{{ asset('storage/' . $setting->logo_dark) }}" width="225"
                                        alt="QBit Tech">
                                </a>
                                @endif

                                <div class="skill-one__content__bar"></div>
                                <ul class="footer-widget__info">
                                    @if ($setting->contact_number)
                                    <li> <a href="tel:{{$setting->contact_number}}"><span><i
                                                    class='bx bxs-phone'></i></span>{{$setting->contact_number}}</a></li>
                                    @endif
                                    @if ($setting->whatsapp_number)
                                    <li> <a href="tel:{{$setting->whatsapp_number}}"><span><i
                                                    class='bx bxl-whatsapp bx-tada'></i></span>{{$setting->whatsapp_number}}</a>
                                    </li>
                                    @endif
                                    @if ($setting->email)
                                    <li> <a href="mailto:{{$setting->email}}"><span><i
                                                    class='bx bx-envelope'></i></span>{{$setting->email}}</a></li>
                                    @endif
                                    @if ($setting->open_schedule)
                                    <li> <a href="#"><span><i
                                                    class='bx bx-time-five'></i></span>{{$setting->open_schedule}},@if($setting->close_schedule) {{$setting->close_schedule}} @endif</a></li>
                                    @endif
                                    @if ($setting->address)
                                    <li> <a href="#"><span><i
                                                    class='bx bxs-map-pin'></i></span>{{$setting->address}}</a></li>
                                    @endif
                                </ul>
                                <div class="footer-widget__social">
                                    @if ($setting->whatsapp_number)
                                    <a href="https://wa.me/{{ $setting->whatsapp_number}}" target="_blank">
                                    <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                    <span class="sr-only">WhatsApp</span>
                                    </a>
                                    @endif
                                    @if ($setting->facebook)
                                    <a href="{{ $setting->facebook}}" target="_blank">
                                    <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                    <span class="sr-only">Facebook</span>
                                    </a>
                                    @endif
                                    @if ($setting->linkedin)
                                    <a href="{{ $setting->linkedin}}" target="_blank">
                                    <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                                    <span class="sr-only">LinkedIn</span>
                                    </a>
                                    @endif
                                </div>
                                <div class="footer-widget__image">
                                    <img src="{{ asset('frontend') }}/assets/images/cta-2.jpg" alt="tolak">
                                </div>
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-md-6 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="footer-widget footer-widget--links footer-widget--last">
                                <h2 class="footer-widget__title">Explore QBit Tech</h2><!-- /.footer-widget__title -->
                                <ul class="list-unstyled footer-widget__links">
                                    <li><a href="{{ route('gallery.page') }}">Gallery</a></li>
                                    <li><a href="{{route('powerhouse.team')}}">Team</a></li>
                                    <li><a href="{{route('contact-us.page')}}">Contact</a></li>
                                    <li><a href="{{route('all.blogs')}}">News</a></li>
                                    <li><a href="{{route('career.page')}}">Career</a></li>
                                </ul><!-- /.list-unstyled footer-widget__links -->
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-md-6 -->
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-widget footer-widget--links">
                                <h2 class="footer-widget__title">Service</h2><!-- /.footer-widget__title -->
                                <ul class="list-unstyled footer-widget__links">
                                    <li><a href="{{ route('home.page') }}#why_choose_us">Why choose us</a></li>
                                    <li><a href="{{route('service')}}">Our Service</a></li>
                                    <li><a href="{{ route('home.page') }}#clients_list">Partners</a></li>
                                    <!-- <li><a href="contact.html">Core values</a></li> -->
                                    <li><a href="{{route('products.page')}}">Products</a></li>
                                </ul><!-- /.list-unstyled footer-widget__links -->
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-md-6 -->

                    </div><!-- /.row -->
                </div><!-- /.container -->
                <div class="main-footer__bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="main-footer__copyright">
                                    {{$setting->copyright_text ?? ''}}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled main-footer__bottom__list">
                                    <li><a href="{{route('about-us.page')}}">About Us</a></li>
                                    <li><a href="{{route('service')}}">Services</a></li>
                                    <li><a href="{{route('all.blogs')}}">News</a></li>
                                    <li><a href="{{route('products.page')}}">Portfolio</a></li>
                                </ul><!-- /.list-unstyled -->
                            </div>
                        </div><!-- /.main-footer__inner -->
                    </div><!-- /.container -->
                </div><!-- /.main-footer__bottom -->
            </footer><!-- /.main-footer -->

        </div><!-- /.page-wrapper -->



        <div class="mobile-nav__wrapper">
            <div class="mobile-nav__overlay mobile-nav__toggler"></div>
            <!-- /.mobile-nav__overlay -->
            <div class="mobile-nav__content">
                <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>
                @if ($setting->logo_dark)
                <div class="logo-box">
                    <a href="{{'/'}}" aria-label="logo image"><img src="{{ asset('storage/' . $setting->logo_dark) }}"
                            width="155" alt="" /></a>
                </div>
                @endif

                <!-- /.logo-box -->
                <div class="mobile-nav__container"></div>
                <!-- /.mobile-nav__container -->

                <ul class="mobile-nav__contact list-unstyled">
                    @if ($setting->email)
                    <li>
                        <i class="fa fa-envelope"></i>
                        <a href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                    </li>
                    @endif
                    @if ($setting->contact_number)
                    <li>
                        <i class="fa fa-phone-alt"></i>
                        <a href="tel:{{$setting->contact_number}}"> {{$setting->contact_number}}</a>
                    </li>
                    @endif
                </ul><!-- /.mobile-nav__contact -->
                <div class="mobile-nav__social">
                    @if ($setting->whatsapp_number)
                    <a href="https://wa.me/{{ $setting->whatsapp_number}}">
                        <i class="fab fa-whatsapp" aria-hidden="true"></i>
                        <span class="sr-only">WhatsApp</span>
                    </a>
                    @endif
                    @if ($setting->facebook)
                    <a href="{{ $setting->facebook}}">
                        <i class="fab fa-facebook-f" aria-hidden="true"></i>
                        <span class="sr-only">Facebook</span>
                    </a>
                    @endif
                    @if ($setting->linkedin)
                    <a href="{{ $setting->linkedin}}">
                        <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                        <span class="sr-only">linkedin</span>
                    </a>
                    @endif

                </div><!-- /.mobile-nav__social -->
            </div>
            <!-- /.mobile-nav__content -->
        </div>
        <!-- /.mobile-nav__wrapper -->
        <div class="search-popup">
            <div class="search-popup__overlay search-toggler"></div>
            <!-- /.search-popup__overlay -->
            <div class="search-popup__content">
                <form role="search" method="get" class="search-popup__form" action="#">
                    <input type="text" id="search" placeholder="Search Here..." />
                    <button type="submit" aria-label="search submit" class="tolak-btn">
                        <b><i class="icon-magnifying-glass"></i></b><span></span>
                    </button>
                </form>
            </div>
            <!-- /.search-popup__content -->
        </div>
        <!-- /.search-popup -->
        <!-- Sidebar One Start -->
        <aside class="sidebar-one">
            <div class="sidebar-one__overlay"></div><!-- /.siderbar-ovarlay -->
            <div class="sidebar-one__content">
                <div class="sidebar-one__close"><i class="icon-close"></i></div><!-- /.siderbar-close -->
                @if ($setting->logo_dark)

                <div class="sidebar-one__logo">
                    <a href="{{'/'}}" aria-label="logo image"><img src="{{ asset('storage/' . $setting->logo_dark) }}"
                            alt="Tolak HTML" width="184"></a>
                </div><!-- /.sidebar-one__logo-box -->
                @endif

                <p class="sidebar-one__text">
                    Mauris ut enim sit amet lacus ornare ullamcor. Praesent placerat nequ
                    puru rhoncu tincidunt odio ultrices. Sed feugiat feugiat felis.
                </p>
                <h4 class="sidebar-one__title">Contact Info:</h4>
                <ul class="sidebar-one__info">
                    <li>
                        <span class="fas fa-map-marker-alt"></span>
                        27, Dhaka London City Dhaka, Bangladesh
                    </li>
                    <li>
                        <span class="fas fa-clock"></span>
                        Mon - Fri: 8.00 am. - 6.00 pm.
                    </li>
                    <li>
                        <span class="fas fa-envelope"></span>
                        <a href="tel:09969569535">099 695 695 35</a>
                    </li>
                </ul>
                <div class="sidebar-one__social">
                    <a href="https://facebook.com/">
                        <i class="fab fa-facebook-f" aria-hidden="true"></i>
                        <span class="sr-only">Facebook</span>
                    </a>
                    <a href="https://pinterest.com/">
                        <i class="fab fa-pinterest-p" aria-hidden="true"></i>
                        <span class="sr-only">Pinterest</span>
                    </a>
                    <a href="https://twitter.com/">
                        <i class="fab fa-twitter" aria-hidden="true"></i>
                        <span class="sr-only">Twitter</span>
                    </a>
                    <a href="https://instagram.com/">
                        <i class="fab fa-instagram" aria-hidden="true"></i>
                        <span class="sr-only">Instagram</span>
                    </a>
                </div><!-- /sidebar-one__socila -->
                <h4 class="sidebar-one__title">Newsletter:</h4>
                <form action="#" data-url="MAILCHIMP_FORM_URL" class="sidebar-one__newsletter mc-form">
                    <input type="text" name="EMAIL" placeholder="Email address">
                    <button type="submit" class="fas fa-paper-plane">
                        <span class="sr-only">submit</span><!-- /.sr-only -->
                    </button>
                </form><!-- /.footer-widget__newsletter mc-form -->
            </div><!-- /.sidebar__content -->
        </aside>
        <!-- Sidebar One Start -->

        <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
            <span class="scroll-to-top__text">back top</span>
            <span class="scroll-to-top__wrapper"><span class="scroll-to-top__inner"></span></span>
        </a>


        <script src="{{ asset('frontend') }}/assets/vendors/jquery/jquery-3.7.0.min.js"></script>

        <script src="{{ asset('frontend') }}/assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!--<script src="{{ asset('frontend') }}/assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>-->

        <script src="{{ asset('frontend') }}/assets/vendors/jarallax/jarallax.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/jquery-ui/jquery-ui.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/jquery-appear/jquery.appear.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/jquery-validate/jquery.validate.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/nouislider/nouislider.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/tiny-slider/tiny-slider.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/wnumb/wNumb.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/owl-carousel/js/owl.carousel.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/wow/wow.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/tilt/tilt.jquery.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/simpleParallax/simpleParallax.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/imagesloaded/imagesloaded.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/isotope/isotope.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/countdown/countdown.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/jquery-circleType/jquery.circleType.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/jquery-lettering/jquery.lettering.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/vendors/progress-bar/knob.js"></script>

        <!-- chart js -->
        <!--<script src="{{ asset('frontend') }}/assets/vendors/chart/chart.js"></script>-->
        <!--<script src="{{ asset('frontend') }}/assets/vendors/chart/custome-chart.js"></script>-->

        <!-- template js -->
        <script src="{{ asset('frontend') }}/assets/js/tolak.js"></script>
        <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


         @stack('scripts')
    </body>

</html>
