<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @php
            $companyName = $setting->company_name ?? config('app.name', 'InfyraSoft');
            $pageTitle = trim($__env->yieldContent('meta_title', $__env->yieldContent('title', $companyName)));
            $metaTitle = $pageTitle !== '' ? $pageTitle : $companyName;
            $fullTitle = $metaTitle === $companyName ? $companyName : $metaTitle . ' | ' . $companyName;

            $defaultDescription = trim(strip_tags($setting->description ?? 'InfyraSoft provides business software, web development, and digital solutions.'));
            $metaDescription = trim(strip_tags($__env->yieldContent('meta_description', $defaultDescription)));
            if ($metaDescription === '') {
                $metaDescription = 'InfyraSoft provides business software, web development, and digital solutions.';
            }

            $metaKeywords = trim($__env->yieldContent('meta_keywords', 'software company, web development, mobile app development, erp, digital solutions'));
            $canonicalUrl = trim($__env->yieldContent('canonical_url', url()->current()));
            $robots = trim($__env->yieldContent('meta_robots', 'index,follow'));
            $ogType = trim($__env->yieldContent('og_type', 'website'));
            $ogImage = trim($__env->yieldContent('og_image', $setting && $setting->logo_dark ? asset('storage/' . $setting->logo_dark) : asset('frontend/assets/images/logo-dark.png')));
            $twitterCard = trim($__env->yieldContent('twitter_card', 'summary_large_image'));
        @endphp

        <title>{{ $fullTitle }}</title>
        <meta name="description" content="{{ $metaDescription }}" />
        <meta name="keywords" content="{{ $metaKeywords }}" />
        <meta name="robots" content="{{ $robots }}" />
        <link rel="canonical" href="{{ $canonicalUrl }}" />

        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="{{ $ogType }}" />
        <meta property="og:title" content="{{ $fullTitle }}" />
        <meta property="og:description" content="{{ $metaDescription }}" />
        <meta property="og:url" content="{{ $canonicalUrl }}" />
        <meta property="og:site_name" content="{{ $companyName }}" />
        <meta property="og:image" content="{{ $ogImage }}" />

        <meta name="twitter:card" content="{{ $twitterCard }}" />
        <meta name="twitter:title" content="{{ $fullTitle }}" />
        <meta name="twitter:description" content="{{ $metaDescription }}" />
        <meta name="twitter:image" content="{{ $ogImage }}" />
        <!-- favicons Icons -->
        <!--<link rel="manifest" href="{{ asset('frontend') }}/assets/images/favicons/site.webmanifest" />-->

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
                            <img src="{{ asset('storage/' . $setting->logo_dark ) }}" alt="InfyraSoft" width="200">

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
                                    <a href="#">Explore InfyraSoft</a>
                                    <ul>
                                        <li><a href="{{ route('about-us.page') }}">Roots of InfyraSoft</a></li>
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
                                        alt="InfyraSoft">
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
                                <h2 class="footer-widget__title">Explore InfyraSoft</h2><!-- /.footer-widget__title -->
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
                <form role="search" method="get" class="search-popup__form" action="{{ route('global.search.page') }}">
                    <input type="text" id="globalSearchInput" name="query" placeholder="Search services, team, blogs, albums..." autocomplete="off" />
                    <button type="submit" aria-label="search submit" class="tolak-btn">
                        <b><i class="icon-magnifying-glass"></i></b><span></span>
                    </button>
                </form>
                <ul id="globalSearchResults" class="search-popup__results"></ul>
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

        <div id="siteAiAssistant" class="site-ai-assistant">
            <button type="button" id="aiAssistantToggle" class="site-ai-assistant__toggle" aria-label="Open assistant">
                <span class="site-ai-assistant__toggle-ring"></span>
                <i class="bx bxs-bot"></i>
            </button>

            <div id="aiAssistantPanel" class="site-ai-assistant__panel">
                <div class="site-ai-assistant__header">
                    <strong>Assistant</strong>
                    <span class="site-ai-assistant__status">Online</span>
                    <button type="button" id="aiAssistantClose" aria-label="Close assistant">&times;</button>
                </div>

                <div id="aiAssistantMessages" class="site-ai-assistant__messages">
                    <div class="site-ai-assistant__message site-ai-assistant__message--bot">
                        Hello, and welcome. I am the {{ $setting->company_name ?? 'website' }} support assistant. Tell me what you need, and I will help you step by step.
                    </div>
                </div>

                <div class="site-ai-assistant__suggestion-shell" id="aiAssistantSuggestions" aria-label="Suggested prompts">
                    <button type="button" class="site-ai-assistant__suggestions-toggle" id="aiAssistantSuggestionsToggle" aria-expanded="false">
                        Quick prompts
                        <span class="site-ai-assistant__suggestions-toggle__badge">9</span>
                        <i class="bx bx-chevron-down" aria-hidden="true"></i>
                    </button>
                    <div class="site-ai-assistant__suggestions-dropdown is-hidden" id="aiAssistantSuggestionsDropdown">
                        <div class="site-ai-assistant__suggestions-grid">
                            <button type="button" class="site-ai-assistant__suggestion" data-suggestion="team information">Team</button>
                            <button type="button" class="site-ai-assistant__suggestion" data-suggestion="what services do you offer">Services</button>
                            <button type="button" class="site-ai-assistant__suggestion" data-suggestion="send contact message">Contact</button>
                            <button type="button" class="site-ai-assistant__suggestion" data-suggestion="how are you">Small talk</button>
                            <button type="button" class="site-ai-assistant__suggestion" data-suggestion="tell me about your company">About us</button>
                            <button type="button" class="site-ai-assistant__suggestion" data-suggestion="show me your gallery">Gallery</button>
                            <button type="button" class="site-ai-assistant__suggestion" data-suggestion="latest blogs">Blogs</button>
                            <button type="button" class="site-ai-assistant__suggestion" data-suggestion="career openings">Careers</button>
                            <button type="button" class="site-ai-assistant__suggestion" data-suggestion="how can I contact you">Contact details</button>
                        </div>
                    </div>
                </div>

                <form id="aiAssistantForm" class="site-ai-assistant__form">
                    <input type="text" id="aiAssistantInput" placeholder="Ask me anything..." autocomplete="off" maxlength="1000">
                    <button type="submit">Send</button>
                </form>
            </div>
        </div>


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

        <script>
            (function () {
                const input = document.getElementById('globalSearchInput');
                const resultsBox = document.getElementById('globalSearchResults');
                const form = input ? input.closest('form') : null;
                let timer = null;

                if (!input || !resultsBox || !form) {
                    return;
                }

                function escapeHtml(value) {
                    return String(value)
                        .replace(/&/g, '&amp;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;')
                        .replace(/\"/g, '&quot;')
                        .replace(/'/g, '&#039;');
                }

                function clearResults() {
                    resultsBox.innerHTML = '';
                    resultsBox.style.display = 'none';
                }

                function renderResults(items) {
                    if (!Array.isArray(items) || items.length === 0) {
                        resultsBox.innerHTML = '<li class="search-popup__result-item search-popup__result-empty">No results found</li>';
                        resultsBox.style.display = 'block';
                        return;
                    }

                    const html = items.map(function (item) {
                        const group = escapeHtml(item.group || 'Result');
                        const title = escapeHtml(item.title || 'Untitled');
                        const subtitle = escapeHtml(item.subtitle || '');
                        const url = escapeHtml(item.url || '#');

                        return '<li class="search-popup__result-item">' +
                            '<a href="' + url + '" class="search-popup__result-link">' +
                            '<small class="search-popup__result-group">' + group + '</small>' +
                            '<strong class="search-popup__result-title">' + title + '</strong>' +
                            '<span class="search-popup__result-subtitle">' + subtitle + '</span>' +
                            '</a>' +
                            '</li>';
                    }).join('');

                    resultsBox.innerHTML = html;
                    resultsBox.style.display = 'block';
                }

                input.addEventListener('keyup', function () {
                    const query = input.value.trim();

                    if (query.length < 2) {
                        clearResults();
                        return;
                    }

                    clearTimeout(timer);
                    timer = setTimeout(function () {
                        fetch("{{ route('global.search.suggestions') }}?query=" + encodeURIComponent(query))
                            .then(function (response) { return response.json(); })
                            .then(function (data) { renderResults(data); })
                            .catch(function () {
                                resultsBox.innerHTML = '<li class="search-popup__result-item search-popup__result-empty">Search failed. Try again.</li>';
                                resultsBox.style.display = 'block';
                            });
                    }, 250);
                });

                form.addEventListener('submit', function (event) {
                    if (input.value.trim().length < 2) {
                        event.preventDefault();
                        input.focus();
                    }
                });

                document.addEventListener('click', function (event) {
                    if (!resultsBox.contains(event.target) && event.target !== input) {
                        clearResults();
                    }
                });
            })();

            (function () {
                const toggle = document.getElementById('aiAssistantToggle');
                const closeBtn = document.getElementById('aiAssistantClose');
                const panel = document.getElementById('aiAssistantPanel');
                const form = document.getElementById('aiAssistantForm');
                const input = document.getElementById('aiAssistantInput');
                const messages = document.getElementById('aiAssistantMessages');
                const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const history = [];
                const suggestionsWrap = document.getElementById('aiAssistantSuggestions');
                const suggestionsToggle = document.getElementById('aiAssistantSuggestionsToggle');
                const suggestionsDropdown = document.getElementById('aiAssistantSuggestionsDropdown');
                const suggestionsSeenKey = 'aiAssistantSuggestionsSeen';
                let suggestionsSeen = false;
                const contactFlow = {
                    active: false,
                    step: null,
                    data: {
                        name: '',
                        email: '',
                        subject: '',
                        message: ''
                    }
                };
                let contactReminderTimer = null;

                if (!toggle || !closeBtn || !panel || !form || !input || !messages) {
                    return;
                }

                try {
                    suggestionsSeen = window.sessionStorage.getItem(suggestionsSeenKey) === '1';
                } catch (error) {
                    suggestionsSeen = false;
                }

                function markSuggestionsSeen() {
                    suggestionsSeen = true;
                    try {
                        window.sessionStorage.setItem(suggestionsSeenKey, '1');
                    } catch (error) {
                        // Ignore storage issues.
                    }
                }

                function escapeHtml(value) {
                    return String(value)
                        .replace(/&/g, '&amp;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;')
                        .replace(/\"/g, '&quot;')
                        .replace(/'/g, '&#039;');
                }

                function formatAssistantMessage(text) {
                    const escaped = escapeHtml(String(text || ''));
                    const withLinks = escaped.replace(/(https?:\/\/[^\s<]+)/g, function (url) {
                        const cleanUrl = url.replace(/[),.;!?]+$/, '');
                        const trailing = url.slice(cleanUrl.length);
                        return '<a href="' + cleanUrl + '" class="site-ai-assistant__link" target="_self" rel="noopener noreferrer">' + cleanUrl + '</a>' + trailing;
                    });

                    return withLinks.replace(/\n/g, '<br>');
                }

                function appendMessage(text, type) {
                    const item = document.createElement('div');
                    item.className = 'site-ai-assistant__message ' + (type === 'user'
                        ? 'site-ai-assistant__message--user'
                        : 'site-ai-assistant__message--bot');
                    item.innerHTML = formatAssistantMessage(text);
                    messages.appendChild(item);
                    messages.scrollTop = messages.scrollHeight;
                    return item;
                }

                function setSuggestionsVisible(isVisible) {
                    if (!suggestionsDropdown || !suggestionsToggle) {
                        return;
                    }

                    suggestionsDropdown.classList.toggle('is-hidden', !isVisible);
                    suggestionsToggle.setAttribute('aria-expanded', isVisible ? 'true' : 'false');
                    suggestionsToggle.classList.toggle('is-active', isVisible);
                }

                function updateSuggestionsVisibility() {
                    const shouldShow = !suggestionsSeen && input.value.trim().length === 0 && panel.classList.contains('is-open');
                    setSuggestionsVisible(shouldShow);
                }

                function clearContactReminder() {
                    if (contactReminderTimer) {
                        clearTimeout(contactReminderTimer);
                        contactReminderTimer = null;
                    }
                }

                function getContactReminderText() {
                    if (!contactFlow.active) {
                        return '';
                    }

                    if (contactFlow.step === 'confirm_start') {
                        return 'Still there? Please reply with yes or no if you want to contact us.';
                    }
                    if (contactFlow.step === 'name') {
                        return 'Still there? Please share your full name.';
                    }
                    if (contactFlow.step === 'email') {
                        return 'Still there? Please enter your email address.';
                    }
                    if (contactFlow.step === 'subject') {
                        return 'Still there? Please enter the subject of your message.';
                    }
                    if (contactFlow.step === 'message') {
                        return 'Still there? Please write the message/description you want to send.';
                    }
                    if (contactFlow.step === 'confirm_submit') {
                        return 'Still there? Please confirm with yes or no to submit the contact message.';
                    }

                    return 'Still there? If you want, I can help you contact us. Reply with yes to continue or no to stop.';
                }

                function scheduleContactReminder() {
                    clearContactReminder();

                    if (!contactFlow.active) {
                        return;
                    }

                    contactReminderTimer = setTimeout(function () {
                        if (!contactFlow.active) {
                            return;
                        }

                        const reminderText = getContactReminderText();
                        if (reminderText) {
                            appendMessage(reminderText, 'bot');
                        }

                        if (contactFlow.active) {
                            scheduleContactReminder();
                        }
                    }, 10000);
                }

                function resetContactFlow() {
                    clearContactReminder();
                    contactFlow.active = false;
                    contactFlow.step = null;
                    contactFlow.data = {
                        name: '',
                        email: '',
                        subject: '',
                        message: ''
                    };
                }

                function shouldStartContactFlow(text) {
                    return /\b(send|submit)\b.*\b(contact|message|inquiry|enquiry)\b/i.test(text)
                        || /\b(contact|message|inquiry|enquiry)\b.*\b(send|submit)\b/i.test(text)
                        || /\b(contact\s*form|contact\s*message|quote\s*request)\b/i.test(text);
                }

                function isValidEmail(email) {
                    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(String(email || '').trim());
                }

                function isYes(value) {
                    return /^(yes|y|ok|okay|sure|confirm|go ahead|continue)$/i.test(String(value || '').trim());
                }

                function isNo(value) {
                    return /^(no|n|not now|cancel|stop|exit)$/i.test(String(value || '').trim());
                }

                function processContactFlowMessage(text) {
                    const value = String(text || '').trim();

                    if (/^(cancel|stop|exit)$/i.test(value) && contactFlow.active) {
                        resetContactFlow();
                        return { type: 'reply', text: 'No problem. I canceled the contact form request. You can type "send contact message" anytime to start again.' };
                    }

                    if (!contactFlow.active) {
                        contactFlow.active = true;
                        contactFlow.step = 'confirm_start';
                        scheduleContactReminder();
                        return { type: 'reply', text: 'Sure. Do you want to contact us? Please reply with yes or no.' };
                    }

                    if (contactFlow.step === 'confirm_start') {
                        if (isNo(value)) {
                            resetContactFlow();
                            return { type: 'reply', text: 'No problem. If you need later, just type "send contact message".' };
                        }
                        if (!isYes(value)) {
                            return { type: 'reply', text: 'Please reply with yes or no.' };
                        }
                        contactFlow.step = 'name';
                        scheduleContactReminder();
                        return { type: 'reply', text: 'Great. Please share your full name.' };
                    }

                    if (contactFlow.step === 'name') {
                        if (value.length < 2) {
                            return { type: 'reply', text: 'Please enter a valid name (at least 2 characters).' };
                        }
                        contactFlow.data.name = value;
                        contactFlow.step = 'email';
                        scheduleContactReminder();
                        return { type: 'reply', text: 'Great. Now please enter your email address.' };
                    }

                    if (contactFlow.step === 'email') {
                        if (!isValidEmail(value)) {
                            return { type: 'reply', text: 'That email looks invalid. Please provide a valid email address.' };
                        }
                        contactFlow.data.email = value;
                        contactFlow.step = 'subject';
                        scheduleContactReminder();
                        return { type: 'reply', text: 'Thanks. What is the subject of your message?' };
                    }

                    if (contactFlow.step === 'subject') {
                        if (value.length < 3) {
                            return { type: 'reply', text: 'Please provide a short subject (at least 3 characters).' };
                        }
                        contactFlow.data.subject = value;
                        contactFlow.step = 'message';
                        scheduleContactReminder();
                        return { type: 'reply', text: 'Perfect. Please write the message/description you want to send.' };
                    }

                    if (contactFlow.step === 'message') {
                        if (value.length < 5) {
                            return { type: 'reply', text: 'Please provide a bit more detail in your message (at least 5 characters).' };
                        }
                        contactFlow.data.message = value;

                        contactFlow.step = 'confirm_submit';
                        scheduleContactReminder();
                        const preview = [
                            'Please confirm before submit:',
                            '- Name: ' + contactFlow.data.name,
                            '- Email: ' + contactFlow.data.email,
                            '- Subject: ' + contactFlow.data.subject,
                            '- Description: ' + contactFlow.data.message,
                            '',
                            'Submit now? Reply with yes or no.'
                        ].join('\n');
                        return { type: 'reply', text: preview };
                    }

                    if (contactFlow.step === 'confirm_submit') {
                        if (isNo(value)) {
                            resetContactFlow();
                            return { type: 'reply', text: 'Okay, I did not submit it. You can start again anytime by typing "send contact message".' };
                        }
                        if (!isYes(value)) {
                            return { type: 'reply', text: 'Please reply with yes or no to confirm submission.' };
                        }

                        const payload = {
                            name: contactFlow.data.name,
                            email: contactFlow.data.email,
                            subject: contactFlow.data.subject,
                            message: contactFlow.data.message
                        };

                        resetContactFlow();
                        return { type: 'submit', payload: payload };
                    }

                    return { type: 'reply', text: 'Let us continue. Please share the requested field, or type "cancel" to stop.' };
                }

                function submitContactFromChat(payload) {
                    return fetch("{{ route('contactmessage.send') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrf || ''
                        },
                        body: JSON.stringify(payload)
                    }).then(function (response) {
                        return response.json().then(function (data) {
                            return {
                                ok: response.ok,
                                data: data || {}
                            };
                        });
                    });
                }

                function setOpen(isOpen) {
                    if (isOpen) {
                        panel.classList.add('is-open');
                        setTimeout(function () {
                            input.focus();
                            updateSuggestionsVisibility();
                        }, 40);
                    } else {
                        panel.classList.remove('is-open');
                    }
                }

                toggle.addEventListener('click', function () {
                    setOpen(!panel.classList.contains('is-open'));
                });

                closeBtn.addEventListener('click', function () {
                    setOpen(false);
                });

                if (suggestionsWrap) {
                    suggestionsWrap.addEventListener('click', function (event) {
                        const toggleButton = event.target.closest('#aiAssistantSuggestionsToggle');
                        if (toggleButton) {
                            const isHidden = suggestionsDropdown ? suggestionsDropdown.classList.contains('is-hidden') : true;
                            setSuggestionsVisible(isHidden);
                            return;
                        }

                        const button = event.target.closest('.site-ai-assistant__suggestion');
                        if (!button) {
                            return;
                        }

                        const suggestion = button.getAttribute('data-suggestion') || button.textContent || '';
                        input.value = suggestion;
                        markSuggestionsSeen();
                        updateSuggestionsVisibility();
                        input.focus();
                    });
                }

                input.addEventListener('input', function () {
                    if (input.value.trim().length > 0) {
                        markSuggestionsSeen();
                    }

                    updateSuggestionsVisibility();
                });
                input.addEventListener('focus', updateSuggestionsVisibility);
                input.addEventListener('blur', function () {
                    if (input.value.trim().length > 0) {
                        setSuggestionsVisible(false);
                    }
                });

                updateSuggestionsVisibility();

                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    const message = input.value.trim();
                    if (message.length < 2) {
                        input.focus();
                        return;
                    }

                    appendMessage(message, 'user');
                    history.push({ role: 'user', content: message });
                    if (history.length > 10) {
                        history.shift();
                    }
                    input.value = '';
                    markSuggestionsSeen();
                    updateSuggestionsVisibility();
                    clearContactReminder();

                    if (contactFlow.active || shouldStartContactFlow(message)) {
                        const flowResult = processContactFlowMessage(message);

                        if (flowResult.type === 'reply') {
                            appendMessage(flowResult.text, 'bot');
                            if (contactFlow.active) {
                                scheduleContactReminder();
                            }
                            return;
                        }

                        if (flowResult.type === 'submit') {
                            const loading = appendMessage('Thanks. Sending your message now...', 'bot');

                            submitContactFromChat(flowResult.payload)
                                .then(function (result) {
                                    if (!result.ok) {
                                        const errors = result.data.errors || {};
                                        const firstErrorKey = Object.keys(errors)[0] || null;
                                        const firstError = firstErrorKey && Array.isArray(errors[firstErrorKey])
                                            ? errors[firstErrorKey][0]
                                            : null;

                                        loading.innerHTML = formatAssistantMessage(firstError || result.data.message || 'I could not submit your contact request. Please try again.');
                                        return;
                                    }

                                    const successText = (result.data && result.data.message)
                                        ? result.data.message + ' Our team will contact you soon.'
                                        : 'Your contact message was submitted successfully. Our team will contact you soon.';

                                    loading.innerHTML = formatAssistantMessage(successText);
                                    history.push({ role: 'assistant', content: successText });
                                    if (history.length > 10) {
                                        history.shift();
                                    }
                                })
                                .catch(function () {
                                    loading.innerHTML = formatAssistantMessage('Sorry, I could not submit your message due to a network issue. Please try again.');
                                });

                            return;
                        }
                    }

                    const loading = appendMessage('Let me check that for you...', 'bot');

                    fetch("{{ route('assistant.ask') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrf || ''
                        },
                        body: JSON.stringify({
                            message: message,
                            history: history
                        })
                    })
                        .then(function (response) {
                            return response.json().then(function (data) {
                                return {
                                    ok: response.ok,
                                    status: response.status,
                                    data: data
                                };
                            });
                        })
                        .then(function (result) {
                            const data = result.data || {};

                            if (!result.ok) {
                                const firstErrorKey = data.errors ? Object.keys(data.errors)[0] : null;
                                const validationError = (firstErrorKey && Array.isArray(data.errors[firstErrorKey]) && data.errors[firstErrorKey][0])
                                    ? data.errors[firstErrorKey][0]
                                    : (data.message || null);
                                const errorText = validationError
                                    ? validationError
                                    : 'Sorry, I could not process your question. Please try again.';
                                loading.innerHTML = formatAssistantMessage(errorText);
                                return;
                            }

                            const answerText = (data && data.answer)
                                ? data.answer
                                : 'Sorry, I could not find an answer right now.';
                            loading.innerHTML = formatAssistantMessage(answerText);
                            history.push({ role: 'assistant', content: answerText });
                            if (history.length > 10) {
                                history.shift();
                            }
                        })
                        .catch(function () {
                            loading.innerHTML = formatAssistantMessage('Sorry, something went wrong. Please try again.');
                        });
                });
            })();

            (function () {
                const stickyHeaders = Array.from(document.querySelectorAll('.sticky-header--cloned'));
                if (!stickyHeaders.length) {
                    return;
                }

                stickyHeaders.forEach(function (header) {
                    header.classList.remove('sticky-header--normal');
                });

                function syncStickyVisibility() {
                    const isActive = window.scrollY > 10;
                    stickyHeaders.forEach(function (header) {
                        header.classList.toggle('active', isActive);
                    });
                }

                syncStickyVisibility();
                window.addEventListener('scroll', syncStickyVisibility, { passive: true });
            })();
        </script>

        <style>
            .main-header-six.sticky-header--cloned {
                z-index: 10010 !important;
            }

            .main-header-six.sticky-header--cloned.active {
                transform: translateY(0) !important;
                visibility: visible !important;
                opacity: 1;
            }

            .search-popup__content {
                position: relative;
            }

            .search-popup__results {
                list-style: none;
                margin: 12px 0 0;
                padding: 0;
                max-height: 360px;
                overflow-y: auto;
                background: #fff;
                border-radius: 12px;
                display: none;
            }

            .search-popup__result-item {
                border-bottom: 1px solid #f2f2f2;
            }

            .search-popup__result-item:last-child {
                border-bottom: 0;
            }

            .search-popup__result-link {
                display: block;
                padding: 12px 14px;
                text-decoration: none;
            }

            .search-popup__result-group {
                display: block;
                color: #f07b29;
                font-weight: 600;
                line-height: 1.2;
            }

            .search-popup__result-title {
                display: block;
                color: #2f2f2f;
                line-height: 1.3;
                margin-top: 2px;
            }

            .search-popup__result-subtitle {
                display: block;
                color: #71706e;
                font-size: 13px;
                line-height: 1.3;
                margin-top: 2px;
            }

            .search-popup__result-empty {
                padding: 12px 14px;
                color: #71706e;
            }

            .site-ai-assistant {
                position: fixed;
                right: 22px;
                bottom: 18px;
                z-index: 9999;
            }

            .scroll-to-top {
                right: 22px !important;
                bottom: 92px !important;
                z-index: 9998 !important;
            }

            .scroll-to-top {
                right: 0px !important;
                bottom: 128px !important;
                z-index: 9998 !important;
            }

            .site-ai-assistant__toggle {
                width: 58px;
                height: 58px;
                border: 0;
                border-radius: 50%;
                position: relative;
                background: linear-gradient(135deg, #f07b29 0%, #ff9a56 100%);
                color: #fff;
                font-size: 26px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 10px 30px rgba(240, 123, 41, 0.35);
                transition: transform 0.25s ease, box-shadow 0.25s ease;
                animation: aiPulse 2.4s infinite;
            }

            .site-ai-assistant__toggle:hover {
                transform: translateY(-2px) scale(1.03);
                box-shadow: 0 14px 34px rgba(240, 123, 41, 0.42);
            }

            .site-ai-assistant__toggle-ring {
                position: absolute;
                inset: -4px;
                border-radius: 50%;
                border: 1px solid rgba(240, 123, 41, 0.45);
                pointer-events: none;
            }

            .site-ai-assistant__panel {
                position: absolute;
                right: 0;
                bottom: 70px;
                width: 360px;
                max-width: calc(100vw - 24px);
                max-height: min(70vh, 560px);
                background: #fff;
                border: 1px solid #e9e9e9;
                border-radius: 14px;
                box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15);
                overflow: hidden;
                display: block;
                opacity: 0;
                visibility: hidden;
                pointer-events: none;
                transform: translateY(14px) scale(0.96);
                transform-origin: bottom right;
                transition: opacity 0.24s ease, transform 0.24s ease, visibility 0.24s ease;
            }

            .site-ai-assistant__panel.is-open {
                opacity: 1;
                visibility: visible;
                pointer-events: auto;
                transform: translateY(0) scale(1);
            }

            .site-ai-assistant__header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 12px 14px;
                color: #fff;
                background: linear-gradient(135deg, #71706e 0%, #5e5d5b 100%);
                gap: 10px;
            }

            .site-ai-assistant__header strong {
                font-size: 14px;
                font-weight: 700;
                letter-spacing: 0.01em;
                margin-right: auto;
            }

            .site-ai-assistant__status {
                font-size: 11px;
                font-weight: 600;
                padding: 3px 8px;
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.17);
                color: #fff;
            }

            .site-ai-assistant__header button {
                border: 0;
                background: transparent;
                color: #fff;
                font-size: 24px;
                line-height: 1;
                opacity: 0.9;
            }

            .site-ai-assistant__messages {
                max-height: min(42vh, 340px);
                overflow-y: auto;
                padding: 12px;
                background: #fcfcfc;
            }

            .site-ai-assistant__message {
                margin-bottom: 10px;
                padding: 10px 12px;
                border-radius: 10px;
                white-space: pre-wrap;
                line-height: 1.45;
                font-size: 14px;
                animation: aiMessageIn 0.2s ease;
            }

            .site-ai-assistant__message--bot {
                background: #f5f5f5;
                color: #2f2f2f;
                margin-right: 22px;
            }

            .site-ai-assistant__link {
                color: #cc5e1b;
                text-decoration: underline;
                word-break: break-all;
            }

            .site-ai-assistant__link:hover {
                color: #a24b15;
            }

            .site-ai-assistant__message--user {
                background: #f07b29;
                color: #fff;
                margin-left: 22px;
            }

            .site-ai-assistant__form {
                display: flex;
                border-top: 1px solid #ededed;
                padding: 10px;
                gap: 8px;
                background: #fff;
            }

            .site-ai-assistant__suggestions {
                position: relative;
                padding: 6px 10px 0;
            }

            .site-ai-assistant__suggestions.is-hidden {
                display: none;
            }

            .site-ai-assistant__suggestion-shell {
                position: relative;
            }

            .site-ai-assistant__suggestions-toggle {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                border: 1px solid #f0d9c8;
                background: #fffaf5;
                color: #7a3d1a;
                border-radius: 999px;
                padding: 6px 10px;
                font-size: 11px;
                font-weight: 700;
                line-height: 1;
                box-shadow: 0 4px 14px rgba(240, 123, 41, 0.08);
            }

            .site-ai-assistant__suggestions-toggle.is-active {
                background: #fff3ea;
                border-color: #f07b29;
            }

            .site-ai-assistant__suggestions-toggle__badge {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 18px;
                height: 18px;
                padding: 0 5px;
                border-radius: 999px;
                background: #f07b29;
                color: #fff;
                font-size: 10px;
                font-weight: 700;
            }

            .site-ai-assistant__suggestions-dropdown {
                position: absolute;
                left: 0;
                bottom: calc(100% + 8px);
                width: min(100%, 330px);
                z-index: 3;
                border: 1px solid #f0d9c8;
                border-radius: 14px;
                background: rgba(255, 255, 255, 0.98);
                box-shadow: 0 18px 40px rgba(46, 38, 34, 0.14);
                padding: 10px;
                max-height: 180px;
                overflow-y: auto;
                overflow-x: hidden;
            }

            .site-ai-assistant__suggestions-dropdown.is-hidden {
                display: none;
            }

            .site-ai-assistant__suggestions-title {
                font-size: 10px;
                font-weight: 700;
                letter-spacing: 0.04em;
                text-transform: uppercase;
                color: #8c7a6f;
                margin-bottom: 5px;
            }

            .site-ai-assistant__suggestions-grid {
                display: flex;
                flex-wrap: wrap;
                gap: 6px;
                overflow: visible;
                -webkit-overflow-scrolling: touch;
            }

            .site-ai-assistant__suggestion {
                border: 1px solid #f0d9c8;
                background: #fff;
                color: #7a3d1a;
                border-radius: 999px;
                padding: 6px 10px;
                font-size: 12px;
                line-height: 1;
                font-weight: 600;
                transition: transform 0.18s ease, border-color 0.18s ease, background-color 0.18s ease, box-shadow 0.18s ease;
                box-shadow: 0 4px 14px rgba(240, 123, 41, 0.08);
                white-space: nowrap;
                flex: 0 0 auto;
            }

            .site-ai-assistant__suggestion:hover {
                transform: translateY(-1px);
                border-color: #f07b29;
                background: #fff7f0;
                box-shadow: 0 6px 18px rgba(240, 123, 41, 0.12);
            }

            @media (max-width: 480px) {
                .site-ai-assistant__suggestions-dropdown {
                    width: min(100vw - 40px, 330px);
                    max-height: 160px;
                }
            }

            .site-ai-assistant__form input {
                flex: 1;
                border: 1px solid #dcdcdc;
                border-radius: 8px;
                padding: 10px;
                font-size: 14px;
            }

            .site-ai-assistant__form button {
                border: 0;
                border-radius: 8px;
                padding: 0 14px;
                background: #f07b29;
                color: #fff;
                font-weight: 600;
                transition: background-color 0.2s ease, transform 0.2s ease;
            }

            .site-ai-assistant__form button:hover {
                background: #d96a20;
                transform: translateY(-1px);
            }

            @keyframes aiPulse {
                0% { box-shadow: 0 10px 30px rgba(240, 123, 41, 0.35); }
                50% { box-shadow: 0 12px 36px rgba(240, 123, 41, 0.52); }
                100% { box-shadow: 0 10px 30px rgba(240, 123, 41, 0.35); }
            }

            @keyframes aiMessageIn {
                from {
                    opacity: 0;
                    transform: translateY(4px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @media (max-width: 575.98px) {
                .site-ai-assistant {
                    right: 12px;
                    bottom: 12px;
                }

                .scroll-to-top {
                    right: 12px !important;
                    bottom: 78px !important;
                }

                .scroll-to-top {
                    right: 12px !important;
                    bottom: 78px !important;
                }

                .site-ai-assistant__toggle {
                    width: 52px;
                    height: 52px;
                    font-size: 23px;
                    color: #fff;
                }

                .site-ai-assistant__panel {
                    width: calc(100vw - 24px);
                    right: 0;
                    bottom: 64px;
                    max-height: 68vh;
                }

                .site-ai-assistant__messages {
                    max-height: 40vh;
                }
            }
        </style>


         @stack('scripts')
    </body>

</html>
