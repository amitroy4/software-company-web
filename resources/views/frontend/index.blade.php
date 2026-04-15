@extends('layouts.frontend')
@section('title', 'Home')
@push('styles')
    @if (!empty($sliders) && $sliders->isNotEmpty())
        <link rel="preload" as="image" href="{{ asset('storage/' . $sliders->first()->image) }}" fetchpriority="high">
    @endif
<style>
    /* for testimonials */
    .testimonials-five__item__content {
        max-height: calc(1.2em * 5);
        line-height: 1.2em;
        overflow-y: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .testimonials-five__item__content::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari, Opera */
    }

    /* for client */

    .featurer-six__item {
        position: relative;
        transition: all 0.3s ease;
    }

    .client-name-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.65);
        color: #fff;
        font-size: 16px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        text-align: center;
        padding: 10px;
    }

    .featurer-six__item:hover .client-name-overlay {
        opacity: 1;
    }

    /* Solutions That Empower Your Business */
    .blog-card-five {
        width: 426px;
        height: 456px;
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin: 0 auto;
    }

    .blog-card-five__image {
        width: 424px;
        height: 283px;
        overflow: hidden;
        position: relative;
    }

    .blog-card-five__image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .blog-card-five__image__link {
        position: absolute;
        inset: 0;
        z-index: 1;
    }

    .blog-card-five__content {
        padding: 12px 16px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: calc(456px - 283px);
        /* Remaining height for content */
    }

    .service-one__item__title {
        font-size: 18px;
        margin-bottom: 8px;
        line-height: 1.3;
        max-height: 2.6em;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .about-four__content__list {
        padding: 0;
        margin: 0 0 10px 0;
        list-style: none;
    }

    .about-four__content__list li p {
        font-size: 14px;
        margin-bottom: 5px;
        color: #555;
    }

    .blog-card-five__rm {
        align-self: flex-end;
        font-size: 20px;
        color: #007bff;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .blog-card-five__rm:hover {
        color: #0056b3;
        transform: scale(1.1);
    }


    /* Types Of Applications We Deliver */
    .why-choose-five__box {
        width: 210px;
        height: 170px;
        padding: 15px;
        background-color: #1c1c1c;
        /* or whatever fits your dark theme */
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-sizing: border-box;
        border-radius: 8px;
    }

    .why-choose-five__box__icon {
        width: 50px;
        height: 50px;
        margin-bottom: 10px;
    }

    .why-choose-five__box__icon img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .why-choose-five__box__title {
        font-size: 16px;
        color: #fff;
        margin: 0;
    }

    /* blog and news */
    .blog-card {
        height: 505px;
        background-color: #fff;
        border-radius: 1px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 10px;
        box-sizing: border-box;
        margin: 0 auto;
        position: relative;
    }

    .blog-card__image {
        width: 350px;
        height: 262px;
        overflow: hidden;
        border-radius: 1px;
        position: relative;
    }

    .blog-card__image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .blog-card__image__link {
        position: absolute;
        inset: 0;
        z-index: 1;
    }

    .blog-card-two__meta {
        width: 350px;
        padding: 8px 0;
        font-size: 13px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #444;
    }

    .blog-card-two__meta__author {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .blog-card-two__meta__author img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .blog-card-two__meta__date {
        font-weight: 500;
        font-size: 13px;
        margin-right: 8px;
        text-align: center;
    }

    .blog-card-two__meta__date span {
        display: block;
        font-size: 15px;
    }

    .blog-card-two__meta__year {
        font-size: 12px;
        color: #999;
    }

    .blog-card__content {
        width: 350px;
        height: 180px;
        padding: 10px 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-sizing: border-box;
    }

    .blog-card__title {
        font-size: 18px;
        font-weight: 600;
        margin: 0 0 8px 0;
        line-height: 1.3;
        max-height: 2.6em;
        /* ~2 lines */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .blog-card__text {
        font-size: 14px;
        color: #555;
        margin-bottom: 10px;
        line-height: 1.5;
        max-height: 3em;
        /* ~2 lines */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .blog-card__link {
        font-size: 14px;
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
        align-self: flex-start;
        transition: color 0.3s ease;
    }

    .blog-card__link i {
        margin-left: 4px;
    }

    .blog-card__link:hover {
        color: #0056b3;
    }

    .blog-card__border {
        display: none;
        /* You can style or show this if needed */
    }
</style>
@endpush
@section('content')
    <!-- main-slider-start -->
    @if (!empty($sliders) && $sliders->isNotEmpty())
        <section class="main-slider-one">
            <div class="main-slider-one__carousel tolak-owl__carousel owl-carousel" data-owl-options='{
                              "loop": true,
                              "animateOut": "fadeOut",
                              "animateIn": "fadeIn",
                              "items": 1,
                              "autoplay": true,
                              "autoplayTimeout": 7000,
                              "smartSpeed": 1000,
                              "nav": false,
                              "navText": ["<span class=\"icon-left-arrow\"></span>","<span class=\"icon-right-arrow\"></span>"],
                              "dots": true,
                              "margin": 0
                              }'>
                <!-- item -->
                @foreach ($sliders as $slider)
                    <div class="item">
                        <div class="main-slider-one__item">
                            <div class="main-slider-one__bg"
                                style="background-image: url({{ asset('storage/' . $slider->image) }});">
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="main-slider-one__content">
                                            <h5 class="main-slider-one__sub-title w-40">{{ $slider->title }}</h5>
                                            <!-- slider-sub-title -->
                                            <h2 class="main-slider-one__title w-50">
                                                {!! implode(' ', array_slice(explode(' ', $slider->sub_title), 0, -1)) !!}
                                                <span>{!! explode(' ', $slider->sub_title)[count(explode(' ', $slider->sub_title)) - 1] !!}</span>
                                            </h2>

                                            <!-- slider-text -->
                                            @if ($slider->button_text)
                                                <div class="main-slider-one__bottom">
                                                    <div class="main-slider-one__btn">
                                                        <a href="{{ $slider->button_url }}" class="tolak-btn-two">
                                                            <span class="tolak-btn-two__left-star"></span>
                                                            <span>{{ $slider->button_text }}<i
                                                                    class="tolak-icons-two-arrow-right-short"></i></span>
                                                            <span class="tolak-btn-two__right-star"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="main-slider-one__floating-text">{{ $setting->company_name }}</div>
                        </div>
                    </div>
                @endforeach
                <!-- item -->

            </div>
            @if ($sliderCounter)
                <div class="main-slider-one__project wow fadeInUp" data-wow-delay="200ms">
                            <div class="main-slider-one__project__icon"><img src="{{ asset('storage/' . $sliderCounter->counter_icon) }}"
                            alt="Project Icon" style="width: 50px;" loading="eager" fetchpriority="high" decoding="async" /></div>
                    <h5 class="main-slider-one__project__number count-box"><span class="count-text"
                            data-stop="{{ $sliderCounter->data_count }}"
                            data-speed="1500"></span>{{ $sliderCounter->counter_symbol }}</h5>
                    <p class="main-slider-one__project__title">{{ $sliderCounter->counter_title }}</p>
                </div>
            @endif
            <!-- slider-fact -->
        </section>
    @endif
    <!-- main-slider-end -->
    <!-- About Us -->
    @if ($about)
        <section class="skill-one">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 wow fadeInRight" data-wow-delay="00ms">
                        <div class="skill-one__image">
                            <div class="about-five__image__one wow fadeInUp" data-wow-delay="100ms">
                                <img src="{{ asset('storage/' . $about->image) }}" alt="tolak" loading="eager" fetchpriority="high" decoding="async">
                            </div>
                            @if ($about->quote)
                                            <div class="skill-one__image__text wow fadeInUp" data-wow-delay="200ms">
                                                <span>{!! implode(' ', array_slice(explode(' ', $about->quote), 0, 1)) !!}</span> {!! implode(
                                    '
                                                                                                                                    ',
                                    array_slice(explode(' ', $about->quote), 1),
                                ) !!}
                                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="col-lg-7 wow fadeInUp" data-wow-delay="100ms">
                        <div class="skill-one__content">
                            <div class="sec-title-four text-left">
                                <h6 class="sec-title-three__tagline"><span
                                        class="sec-title-three__tagline__left-border"></span>{{ $about->title }}</h6>
                                <!-- /.sec-title-four__tagline -->
                                <h3 class="sec-title-two__title">
                                    {!! implode(' ', array_slice(explode(' ', $about->sub_title), 0, 3)) !!}
                                    <span>{!! implode(' ', array_slice(explode(' ', $about->sub_title), 3, 1)) !!}</span>
                                    {!! implode(' ', array_slice(explode(' ', $about->sub_title), 4, 2)) !!}
                                    <span>{!! implode(' ', array_slice(explode(' ', $about->sub_title), 6)) !!}</span>
                                </h3>
                            </div>
                            <p class="why-choose-five__content__text">{!! Str::limit($about->description, 400, '...') !!}</p>
                            <div class="row">
                                <div class="col-md-7">
                                    <ul class="skill-one__content__list">
                                        @foreach ($about->keypoints as $index => $keypoint)
                                            <li>
                                                <span class="icofont-checked"></span>
                                                <p>{{ $keypoint->keypoint }}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @if ($about->counter_title)
                                    <div class="col-md-5">
                                        <div class="about-four__content__fact count-box counted">
                                            @if ($about->counter_icon)
                                                <div class="about-four__content__fact__icon">
                                                    <img src="{{ asset('storage/' . $about->counter_icon) }}" alt="Project Icon"
                                                        style="width: 50px;" />
                                                </div>
                                            @endif
                                            <!-- /.about-four__content__fact__icon -->
                                            <div class="about-four__content__fact__content">
                                                <h3 class="about-four__content__fact__count"><span class="count-text"
                                                        data-stop="426"
                                                        data-speed="1500">{{ $about->data_count }}</span>{{ $about->counter_symbol }}
                                                </h3>
                                                <!-- /.about-four__content__fact__count -->
                                                <p class="about-four__content__fact__text">{{ $about->counter_title }}</p>
                                                <!-- /.about-four__content__fact__text -->
                                            </div>
                                            <!-- /.about-four__content__fact__content -->
                                        </div>
                                    </div>

                                @endif
                            </div>
                            <ul class="cta-eleven__box">
                                <li>
                                    <a href="{{ route('about-us.page') }}" class="text-white tolak-btn-two">
                                        <span class="tolak-btn-two__left-star"></span>
                                        <span>Know More..<i class="tolak-icons-two-arrow-right-short"></i></span>
                                        <span class="tolak-btn-two__right-star"></span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-success-1 custom-bg-success-100 cta-eleven__box__icon"><span><i
                                                class='bx bxl-whatsapp bx-tada'></i></span></div>
                                    <h4 class="cta-eleven__box__title">Get Contact Now</h4>
                                    <p class="cta-eleven__box__text"><a href="https://wa.me/{{ $setting->whatsapp }}"
                                            target="_blank">{{ $setting->whatsapp_number }}</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- About Us -->

    <!-- Main Counter -->
    {{-- @if (!empty($counters) && $counters->isNotEmpty())
    <section class="video-four">
        <div class="video-four__bg jarallax" data-jarallax data-speed="0.3" data-imgPosition="50% -100%"
            style="background-image: url({{ asset('frontend') }}/assets/images/bg-1.jpg);"></div>
        <div class="container-fluid">
            <div class="row gutter-y-30">

                <!-- /.item -->
                @foreach ($counters as $counter)
                <div class=" col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                    <div class="funfact-three__item count-box">
                        <div class="funfact-three__item__bg"
                            style="background-image: url({{ asset('frontend') }}/assets/images/funfact-3-shape.png);"></div>
                        @if ($counter->counter_icon)
                        <div class="funfact-three__item__icon">
                            <img src="{{ asset('storage/'.$counter->counter_icon) }}" alt="Project Icon" />
                        </div>
                        @endif

                        <!-- /.funfact-three__icon -->
                        <h3 class="funfact-three__item__count"><span class="count-text" data-stop="{{$counter->data_count}}"
                                data-speed="1500"></span>{{$counter->counter_symbol}}</h3>
                        <!-- /.funfact-three__count -->
                        <p class="funfact-three__item__text">{{$counter->counter_title}}</p>
                        <!-- /.funfact-three__text -->
                    </div>
                    <!-- /.funfact-three__item -->
                </div>
                @endforeach
                <!-- /.item -->
            </div>
            <!-- /.row -->
        </div>
    </section>
    @endif --}}
    <!-- Main Counter -->

    <!--Counter-1-->
    @if (!empty($counters) && $counters->isNotEmpty())
        <section class="custom-bg-success-100 funfact-two">
            <div class="container">
                <ul class="list-unstyled funfact-two__list">
                    <!-- /.item -->
                    @foreach ($counters as $counter)
                        <li class="funfact-two__item count-box">
                            <div class="funfact-two__icon">
                                @if ($counter->counter_icon)
                                    <img src="{{ asset('storage/' . $counter->counter_icon) }}" alt="Project Icon" />
                                @else
                                    <i class="icon-briefing"></i>
                                @endif
                            </div>
                            <!-- /.funfact-two__icon -->
                            <div class="funfact-two__content">
                                <h3 class="funfact-two__count"><span class="count-text" data-stop="{{ $counter->data_count }}"
                                        data-speed="1500"></span>
                                    {{ $counter->counter_symbol }}</h3>
                                <!-- /.funfact-two__count -->
                                <p class="funfact-two__text">{{ $counter->counter_title }}</p>
                                <!-- /.funfact-two__text -->
                            </div>
                            <!-- /.funfact-two__content -->
                        </li>
                    @endforeach
                    <!-- /.item -->

                </ul>
                <!-- /.list-unstyled funfact-two__list -->
            </div>
            <!-- /.container -->
        </section>
    @endif
    <!-- /.funfact-two -->
    <!--Counter-1-->

    <!-- Service Start -->
    @if (!empty($frontendservices) && $frontendservices->isNotEmpty())
        <section class="blog-five">
            <div class="container-fluid">
                <div class="sec-title-four text-center">
                    <h6 class="sec-title-three__tagline"><span
                            class="sec-title-three__tagline__left-border"></span>Enterprise-Grade Services and
                        Solutions<span class="sec-title-three__tagline__right-border"></span></h6>
                    <h3 class="sec-title-two__title">Solutions That <span>Empower</span> Your <span>Business</span></h3>
                </div>
                <div class="mt-3 blog-two__carousel tolak-owl__carousel tolak-owl__carousel--basic-nav tolak-owl__carousel--with-shadow owl-carousel owl-theme"
                    data-owl-options='{
                                 "items": 1,
                                 "margin": 30,
                                 "loop": false,
                                 "smartSpeed": 700,
                                 "nav": false,
                                 "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                                 "dots": false,
                                 "autoplay": false,
                                 "responsive": {
                                 "0": {
                                 "items": 1
                                 },
                                 "768": {
                                 "items": 2
                                 },
                                 "992": {
                                 "items": 3
                                 }
                                 }
                                 }'>
                    <!-- /.item -->
                    @foreach ($frontendservices as $service)
                        <div class="item">
                            <div class="blog-card-five wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='100ms' style="width: 100% !important;">
                                <div class="blog-card-five__image" style="width: 100% !important;">
                                    <img src="{{ asset('storage/' . $service->image) }}"
                                        alt="Are you Looking For a Solution Related">
                                    <img src="{{ asset('storage/' . $service->image) }}"
                                        alt="Are you Looking For a Solution Related">
                                    <a href="{{ route('service.details', $service->slug) }}" class="blog-card-five__image__link">
                                        <span class="sr-only">{{ $service->service_name }}</span>
                                    </a>
                                </div>
                                <div class="blog-card-five__content">
                                    <ul class="list-unstyled blog-card-five__meta">
                                        <h3 class="service-one__item__title">
                                            <a
                                                href="{{ route('service.details', $service->slug) }}">{{ $service->service_name }}</a>
                                        </h3>
                                    </ul>
                                    <ul class="about-four__content__list">
                                        <li>
                                            <p><i class='bx bx-chip me-2'></i>{{ $service->service_keypoint_1 }}</p>
                                        </li>
                                        <li>
                                            <p><i class='bx bx-chip me-2'></i>{{ $service->service_keypoint_2 }}</p>
                                        </li>
                                        <li>
                                            <p><i class='bx bx-chip me-2'></i>{{ $service->service_keypoint_3 }}</p>
                                        </li>
                                    </ul>
                                    <a class="blog-card-five__rm" href="{{ route('service.details', $service->slug) }}"><i
                                            class='bx bx-expand-horizontal'></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- /.item -->
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('service') }}" class="tolak-btn-two tolak-btn-two--home-six">
                        <span class="tolak-btn-two__left-star"></span>
                        <span>All Solutions<i class="tolak-icons-two-arrow-right-short"></i></span>
                        <span class="tolak-btn-two__right-star"></span>
                    </a>
                </div>
            </div>
        </section>
    @endif
    <!-- Service End -->


    <!--Call-To-Action - 1-->
    @if ($action)
        {{-- <section class="cta-five">
            <div class="container-fluid">
                <div class="cta-five__bg" style="background-image: url({{ asset('frontend') }}/assets/images/cta-1.jpg);">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-7 wow fadeInUp animated" data-wow-delay="00ms"
                            style="visibility: visible; animation-delay: 0ms; animation-name: fadeInUp;">
                            <div class="cta-five__content">
                                @if ($action->main_icon)
                                <div class="cta-five__content__image">
                                    <img src="{{ asset('storage/'.$action->main_icon) }}" alt="Project Icon"
                                        style="width: 100px;" />
                                </div>
                                @endif
                                <div class="">
                                    <h5 class="cta-five__content__title">{!! implode(' ', array_slice(explode(' ',
                                        $action->title), 0, 3)) !!}<a href="#">{!! implode(' ', array_slice(explode(' ',
                                            $action->title), 3)) !!}</a>
                                    </h5>
                                    <p class="cta-three__content__text">{{$action->sub_title}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-end col-md-5 wow fadeInUp animated" data-wow-delay="200ms"
                            style="visibility: visible; animation-delay: 200ms; animation-name: fadeInUp;">
                            <ul class="cta-eleven__box">
                                @if (!empty($action->call_button_url) || !empty($action->contact_no))
                                <li>
                                    @if ($action->call_button_icon)
                                    <div class="cta-eleven__box__image"><span>
                                            <img src="{{ asset('storage/'.$action->call_button_icon) }}" alt="Project Icon"
                                                style="width: 30px;" />
                                        </span></div>
                                    @endif

                                    <h4 class="cta-eleven__box__title">{{$action->call_button_text}}</h4>
                                    <p class="cta-eleven__box__text"><a
                                            href="{{$action->call_button_url}}">{{$action->contact_no}}</a></p>
                                </li>

                                @endif

                                @if ($action->button_url)
                                <a href="{{$action->button_url}}" class="tolak-btn-two tolak-btn-two--home-six">
                                    <span class="tolak-btn-two__left-star"></span>
                                    <span>{{$action->button_text}}<i class="tolak-icons-two-arrow-right-short"></i></span>
                                    <span class="tolak-btn-two__right-star"></span>
                                </a>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        <section class="cta-five">
            <div class="container-fluid">
                <div class="cta-five__bg" style="background-image: url(assets/images/cta-1.jpg);">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-6 col-lg-7 col-xl-8 wow fadeInUp animated" data-wow-delay="00ms"
                            style="visibility: visible; animation-delay: 0ms; animation-name: fadeInUp;">
                            <div class="cta-five__content">

                                @if ($action->main_icon)
                                    <div class="cta-five__content__image">
                                        <img src="{{ asset('storage/' . $action->main_icon) }}" alt="Project Icon"
                                            style="width: 100px;" />
                                    </div>
                                @else
                                    <div class="cta-five__content__icon">
                                        <i class="icon-customer-service"></i>
                                    </div>
                                @endif


                                <div class="">
                                    <h5 class="cta-five__content__title">
                                        {!! implode(' ', array_slice(explode(' ', $action->title), 0, 3)) !!} <a
                                            href="#">{!! implode(' ', array_slice(explode(' ', $action->title), 3)) !!}</a>
                                    </h5>
                                    <p class="cta-three__content__text">{{ $action->sub_title }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-end col-md-6 col-lg-5 col-xl-4 wow fadeInUp animated" data-wow-delay="200ms"
                            style="visibility: visible; animation-delay: 200ms; animation-name: fadeInUp;">
                            <ul class="cta-eleven__box">
                                @if (!empty($action->call_button_url) || !empty($action->contact_no))
                                    <li>
                                        @if ($action->call_button_icon)
                                            <div class="cta-eleven__box__icon">
                                                <img src="{{ asset('storage/' . $action->call_button_icon) }}" alt="Project Icon"
                                                    style="width: 30px;" />
                                            </div>
                                        @else
                                            <div class="cta-eleven__box__icon"><span><i class="bx bxl-whatsapp"></i>
                                                </span></div>
                                        @endif
                                        <h4 class="cta-eleven__box__title">{{ $action->call_button_text }}</h4>
                                        <p class="cta-eleven__box__text"><a href="tel:+11234751328">{{ $action->contact_no }}</a>
                                        </p>
                                    </li>
                                @endif

                                @if ($action->button_url)
                                    <a href="{{$action->button_url}}" class="tolak-btn-two tolak-btn-two--home-six">
                                        <span class="tolak-btn-two__left-star"></span>
                                        <span>{{ $action->button_text }}<i class="tolak-icons-two-arrow-right-short"></i></span>
                                        <span class="tolak-btn-two__right-star"></span>
                                    </a>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--Call-To-Action - 1-->



    <!-- /.solution-two -->
    {{-- <section class="solution-two">
        <div class="solution-two__bg"
            style="background-image: url({{ asset('frontend') }}/assets/images/backgrounds/solution-bg-2.jpg);"></div>
        <div class="container">
            <div class="sec-title-four text-center">
                <h6 class="sec-title-three__tagline"><span class="sec-title-three__tagline__left-border"></span>High Quality
                    and Performance<span class="sec-title-three__tagline__left-border"></span></h6>
                <h3 class="sec-title-two__title">Why Work <span>With Us?</span></h3>
            </div>
            <!-- /.sec-title-four -->
            <div class="row mt-3">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="00ms">

                    <div class="solution-two__box">
                        <h3 class="solution-two__box__title"><i class='bx bx-select-multiple bx-tada'></i>Expertise &
                            Specialization</h3>
                        <p class="solution-two__box__text">
                            A highly skilled team proficient in various technologies and programming languages.
                        </p>
                        <a class="solution-two__box__rm" href="business-marketing.html"><i
                                class='bx bx-expand-horizontal'></i></a>
                    </div>
                    <!-- /.box -->
                    <div class="solution-two__box">
                        <h3 class="solution-two__box__title"><i class='bx bx-select-multiple bx-tada'></i>Customized &
                            Scalable Solutions</h3>
                        <p class="solution-two__box__text">
                            Bespoke software tailored to meet specific business needs, ensuring future scalability.
                        </p>
                        <a class="solution-two__box__rm" href="{{ route('service.details', $service->slug) }}"><i
                                class='bx bx-expand-horizontal'></i></a>
                    </div>
                    <!-- /.box -->
                    <div class="solution-two__box">
                        <h3 class="solution-two__box__title"><i class='bx bx-select-multiple bx-tada'></i>Commitment to
                            Quality & Security</h3>
                        <p class="solution-two__box__text">
                            Adherence to rigorous testing standards for secure and high-performing software.
                        </p>
                        <a class="solution-two__box__rm" href="{{ route('service.details', $service->slug) }}"><i
                                class='bx bx-expand-horizontal'></i></a>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                    <div class="solution-two__image">
                        <img src="{{ asset('frontend') }}/assets/images/About.jpg" alt="tolak">
                    </div>
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="00ms">
                    <div class="solution-two__box">
                        <h3 class="solution-two__box__title"><i class='bx bx-select-multiple bx-tada'></i>Empowering the
                            Next Generation</h3>
                        <p class="solution-two__box__text">
                            Providing employees with opportunities to learn, innovate, and excel in multiple technology
                            domains.
                        </p>
                        <a class="solution-two__box__rm" href="business-marketing.html"><i
                                class='bx bx-expand-horizontal'></i></a>
                    </div>
                    <!-- /.box -->
                    <div class="solution-two__box">
                        <h3 class="solution-two__box__title"><i class='bx bx-select-multiple bx-tada'></i>Timely Project
                            Delivery</h3>
                        <p class="solution-two__box__text">
                            Proven track record of meeting deadlines and ensuring seamless project execution.
                        </p>
                        <a class="solution-two__box__rm" href="{{ route('service.details', $service->slug) }}"><i
                                class='bx bx-expand-horizontal'></i></a>
                    </div>
                    <!-- /.box -->
                    <div class="solution-two__box">
                        <h3 class="solution-two__box__title"><i class='bx bx-select-multiple bx-tada'></i>24/7 Client
                            Support</h3>
                        <p class="solution-two__box__text">
                            o Dedicated round-the-clock support and maintenance for ongoing efficiency.
                        </p>
                        <a class="solution-two__box__rm" href="{{ route('service.details', $service->slug) }}"><i
                                class='bx bx-expand-horizontal'></i></a>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section> --}}
    <section class="solution-two" id="why_choose_us">
        <div class="solution-two__bg"
            style="background-image: url({{ asset('frontend') }}/assets/images/backgrounds/solution-bg-2.jpg);"></div>
        <div class="container">
            <div class="sec-title-four text-center">
                <h6 class="sec-title-three__tagline"><span class="sec-title-three__tagline__left-border"></span>High
                    Quality
                    and Performance<span class="sec-title-three__tagline__right-border"></span></h6>
                <h3 class="sec-title-two__title">Why Work <span>With Us?</span></h3>
            </div>
            <!-- /.sec-title-four -->
            <div class="row mt-3 d-flex align-items-stretch">
                <!-- Left Column -->
                <div class="col-lg-4 col-md-6 d-flex flex-column">
                    @foreach ($firstHalf as $first)
                        <div class="solution-two__box mb-3">
                            <h3 class="solution-two__box__title"><i
                                    class='bx bx-select-multiple bx-tada'></i>{{ $first->title }}</h3>
                            <p class="solution-two__box__text">{{ $first->details }}</p>
                            <a class="solution-two__box__rm" href="#"><i class='bx bx-expand-horizontal'></i></a>
                        </div>
                    @endforeach
                </div>

                <!-- Image Column -->
                @if ($whyWorkImage && $whyWorkImage->status == 1)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="solution-two__image w-100">
                            <img src="{{ asset('storage/' . $whyWorkImage->image) }}" alt="tolak" class="img-fluid h-100 w-100"
                                style="object-fit: cover;" loading="lazy" decoding="async">
                        </div>
                    </div>
                @endif

                <!-- Right Column -->
                <div class="col-lg-4 col-md-6 d-flex flex-column">
                    @foreach ($secondHalf as $second)
                        <div class="solution-two__box mb-3">
                            <h3 class="solution-two__box__title"><i
                                    class='bx bx-select-multiple bx-tada'></i>{{ $second->title }}</h3>
                            <p class="solution-two__box__text">{{ $second->details }}</p>
                            <a class="solution-two__box__rm" href="#"><i class='bx bx-expand-horizontal'></i></a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /.solution-two -->
    <!-- Application We Deliver -->
    @if (!empty($applications) && $applications->isNotEmpty())
    <section class="faq-one faq-one--dark"
        style="background-image: url({{ asset('frontend') }}/assets/images/app-type-bg.jpg); background-size: cover; background-position: center;">
        <div class="container">
            <!-- Section Title -->
            <div class="sec-title-four text-center mb-5">
                <h6 class="sec-title-three__tagline text-white">
                    <span class="sec-title-three__tagline__left-border"></span>
                    Enterprise-Grade Solutions
                    <span class="sec-title-three__tagline__right-border"></span>
                </h6>
                <h3 class="sec-title-two__title">
                    Types Of <span>Applications</span> We Deliver
                </h3>
            </div>

            <!-- Applications Grid -->
            <div class="row justify-content-center g-3 g-md-4"> <!-- g-3 = gap on mobile, g-md-4 = larger gap on md+ -->
                @foreach ($applications as $application)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 d-flex justify-content-center">
                    <div class="why-choose-five__box text-center rounded shadow-sm w-100 h-100">
                        <div class="why-choose-five__box__icon mb-2">
                            <img src="{{ asset('storage/' . $application->icon) }}" alt="{{ $application->title }}" class="img-fluid" style="max-height: 80px;" loading="lazy" decoding="async">
                        </div>
                        <h3 class="why-choose-five__box__title">
                            <a @if ($application->show_url == 1) href="{{ $application->url ?? 'javascript:void(0)' }}" @else href="javascript:void(0)" @endif>
                                {{ $application->title }}
                            </a>
                        </h3>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Application We Deliver -->
    {{-- <!-- /.team-two -->
    <section class="team-two" style="background-image: url({{ asset('frontend') }}/assets/images/shapes/team-2-bg.png);">
        <div class="container">
            <div class="sec-title-four text-center">
                <h6 class="sec-title-three__tagline"><span class="sec-title-three__tagline__left-border"></span>OUR TEAM
                    MEMBER<span class="sec-title-three__tagline__left-border"></span></h6>
                <!-- /.sec-title-four__tagline -->
                <h3 class="sec-title-two__title">Our <span>Experts</span></h3>
                <!-- /.sec-title-four__title -->
            </div>
            <div class="team-two__carousel tolak-owl__carousel tolak-owl__carousel--basic-nav owl-carousel"
                data-owl-options='{
                     "items": 1,
                     "margin": 30,
                     "loop": false,
                     "smartSpeed": 700,
                     "nav": false,
                     "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                     "dots": false,
                     "autoplay": false,
                     "responsive": {
                     "0": {
                     "items": 1
                     },
                     "768": {
                     "items": 2
                     },
                     "992": {
                     "items": 3
                     },
                     "1200": {
                     "items": 4
                     }
                     }
                     }'>
                <div class="item">
                    <div class="team-card-two wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='000ms'>
                        <div class="team-card-two__image">
                            <img src="{{ asset('frontend') }}/assets/images/CEO2.jpg" alt="Lorata Barsa">
                        </div>
                        <!-- /.team-card-two__image -->
                        <div class="team-card-two__content">
                            <div class="team-card-two__hover">
                                <div class="team-card-two__social">
                                    <i class="fa fa-plus"></i>
                                    <div class="team-card-two__social__list">
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
                                    </div>
                                    <!-- /.team-card-two__social__list -->
                                </div>
                                <!-- /.team-card-two__social -->
                            </div>
                            <!-- /.team-card-two__hover -->
                            <h3 class="team-card-two__title">
                                <a href="team-details.php">Lorata Barsa</a>
                            </h3>
                            <!-- /.team-card-two__title -->
                            <p class="team-card-two__designation">Founder</p>
                            <!-- /.team-card-two__designation -->
                        </div>
                        <!-- /.team-card-two__content -->
                    </div>
                    <!-- /.team-card-two -->
                </div>
                <!-- /.item -->
                <div class="item">
                    <div class="team-card-two team-card-two--even wow fadeInUp" data-wow-duration='1500ms'
                        data-wow-delay='100ms'>
                        <div class="team-card-two__image">
                            <img src="{{ asset('frontend') }}/assets/images/CEO2.jpg" alt="Moras Batas">
                        </div>
                        <!-- /.team-card-two__image -->
                        <div class="team-card-two__content">
                            <div class="team-card-two__hover">
                                <div class="team-card-two__social">
                                    <i class="fa fa-plus"></i>
                                    <div class="team-card-two__social__list">
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
                                    </div>
                                    <!-- /.team-card-two__social__list -->
                                </div>
                                <!-- /.team-card-two__social -->
                            </div>
                            <!-- /.team-card-two__hover -->
                            <h3 class="team-card-two__title">
                                <a href="team-details.php">Moras Batas</a>
                            </h3>
                            <!-- /.team-card-two__title -->
                            <p class="team-card-two__designation">Manager</p>
                            <!-- /.team-card-two__designation -->
                        </div>
                        <!-- /.team-card-two__content -->
                    </div>
                    <!-- /.team-card-two -->
                </div>
                <!-- /.item -->
                <div class="item">
                    <div class="team-card-two wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='200ms'>
                        <div class="team-card-two__image">
                            <img src="{{ asset('frontend') }}/assets/images/CEO2.jpg" alt="Korata Mana">
                        </div>
                        <!-- /.team-card-two__image -->
                        <div class="team-card-two__content">
                            <div class="team-card-two__hover">
                                <div class="team-card-two__social">
                                    <i class="fa fa-plus"></i>
                                    <div class="team-card-two__social__list">
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
                                    </div>
                                    <!-- /.team-card-two__social__list -->
                                </div>
                                <!-- /.team-card-two__social -->
                            </div>
                            <!-- /.team-card-two__hover -->
                            <h3 class="team-card-two__title">
                                <a href="team-details.php">Korata Mana</a>
                            </h3>
                            <!-- /.team-card-two__title -->
                            <p class="team-card-two__designation">Founder</p>
                            <!-- /.team-card-two__designation -->
                        </div>
                        <!-- /.team-card-two__content -->
                    </div>
                    <!-- /.team-card-two -->
                </div>
                <!-- /.item -->
                <div class="item">
                    <div class="team-card-two team-card-two--even wow fadeInUp" data-wow-duration='1500ms'
                        data-wow-delay='300ms'>
                        <div class="team-card-two__image">
                            <img src="{{ asset('frontend') }}/assets/images/CEO2.jpg" alt="Mark Smith">
                        </div>
                        <!-- /.team-card-two__image -->
                        <div class="team-card-two__content">
                            <div class="team-card-two__hover">
                                <div class="team-card-two__social">
                                    <i class="fa fa-plus"></i>
                                    <div class="team-card-two__social__list">
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
                                    </div>
                                    <!-- /.team-card-two__social__list -->
                                </div>
                                <!-- /.team-card-two__social -->
                            </div>
                            <!-- /.team-card-two__hover -->
                            <h3 class="team-card-two__title">
                                <a href="team-details.php">Mark Smith</a>
                            </h3>
                            <!-- /.team-card-two__title -->
                            <p class="team-card-two__designation">Manager</p>
                            <!-- /.team-card-two__designation -->
                        </div>
                        <!-- /.team-card-two__content -->
                    </div>
                    <!-- /.team-card-two -->
                </div>
                <!-- /.item -->
                <div class="item">
                    <div class="team-card-two wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='000ms'>
                        <div class="team-card-two__image">
                            <img src="{{ asset('frontend') }}/assets/images/CEO2.jpg" alt="Lorata Barsa">
                        </div>
                        <!-- /.team-card-two__image -->
                        <div class="team-card-two__content">
                            <div class="team-card-two__hover">
                                <div class="team-card-two__social">
                                    <i class="fa fa-plus"></i>
                                    <div class="team-card-two__social__list">
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
                                    </div>
                                    <!-- /.team-card-two__social__list -->
                                </div>
                                <!-- /.team-card-two__social -->
                            </div>
                            <!-- /.team-card-two__hover -->
                            <h3 class="team-card-two__title">
                                <a href="team-details.php">Lorata Barsa</a>
                            </h3>
                            <!-- /.team-card-two__title -->
                            <p class="team-card-two__designation">Founder</p>
                            <!-- /.team-card-two__designation -->
                        </div>
                        <!-- /.team-card-two__content -->
                    </div>
                    <!-- /.team-card-two -->
                </div>
                <!-- /.item -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /.team-two --> --}}


    <!--Trusted Clients-->
    @if (count($clients) > 0)
        <section class="featurer-six" id="clients_list">
            <div class="container-fluid">
                <div class="sec-title-four text-center">
                    <h6 class="sec-title-three__tagline"><span class="sec-title-three__tagline__left-border"></span>Who
                        We've Worked With<span class="sec-title-three__tagline__right-border"></span></h6>
                    <h3 class="sec-title-two__title mb-3"><span>Trusted by</span> Ambitious Brands</h3>
                </div>
                <!-- /.sec-title-four -->
                <div class="row row-cols-6 gutter-y-30 m-auto justify-content-center ">
                    @foreach ($clients as $client)
                        <div class="col-md-2 col-sm-4 col-6 wow fadeInUp animated mt-0 mb-4" data-wow-delay="00ms"
                            style="visibility: visible; animation-delay: 0ms; animation-name: fadeInUp;">
                            <div class="custom-bg-primary-100 featurer-six__item">
                                <div class="featurer-six__item__hover"
                                    style="background-image: url(assets/images/resources/feature-6-1.jpg);"></div>
                                <div class="cta-eleven__image">
                                    <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" loading="lazy" decoding="async">
                                </div>
                                <div class="client-name-overlay">
                                    <span>{{ $client->name }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!--Trusted Clients-->

    <!-- /.testimonials-five -->
    @if (!empty($testimonials) && $testimonials->isNotEmpty())
        <section class="testimonials-five" id="testimonial">
            <div class="testimonials-five__bg jarallax" data-jarallax data-speed="0.3" data-imgPosition="50% -100%"
                style="background-image: url({{ asset('frontend') }}/assets/images/bg-2.jpg);"></div>
            <div class="testimonials-five__shape"
                style="background-image: url({{ asset('frontend') }}/assets/images/testimonial-bg-4-shape.png);"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="sec-title-three text-left">
                            <h6 class="sec-title-three__tagline text-white"><span
                                    class="sec-title-three__tagline__left-border"></span>Testimonials<span
                                    class="sec-title-three__tagline__right-border"></span></h6>
                            <h3 class="sec-title-two__title text-white">What Our <span>Clients </span>Say</h3>
                        </div>
                        <!-- /.sec-title-three -->
                    </div>
                </div>
                <div class="skill-one__content__bar"></div>
                <div class="pt-5 testimonials-five__carousel tolak-owl__carousel tolak-owl__carousel--basic-nav owl-carousel owl-theme"
                    data-owl-options='{
                                 "items": 1,
                                 "margin": 30,
                                 "loop": false,
                                 "smartSpeed": 700,
                                 "nav": false,
                                 "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                                 "dots": true,
                                 "autoplay": false,
                                 "responsive": {
                                 "0": {
                                 "items": 1
                                 },
                                 "992": {
                                 "items": 2
                                 }
                                 }
                                 }'>
                    @foreach ($testimonials as $testimonial)
                        <!-- /.item -->
                        <div class="item">
                            <div class="testimonials-five__item wow fadeInUp" data-wow-delay="100ms">
                                <div class="testimonials-five__item__image">
                                    <img src="{{ $testimonial->image ? asset('storage/' . $testimonial->image) : asset('/frontend/assets/images/no_user.png') }}"
                                        alt="tolak" loading="lazy" decoding="async">
                                </div>
                                <div class="testimonials-five__item__content">{{ $testimonial->review }}</div>
                                <!-- /.testimonials-five__item__content -->
                                <h3 class="testimonials-five__item__name">{{ $testimonial->client_name }}</h3>
                                <!-- /.testimonials-five__item__name -->
                                <p class="testimonials-five__item__designation">{{ $testimonial->designation }}</p>
                                <!-- /.testimonials-five__item__designation -->
                                <div class="testimonials-five__item__triangle"></div>
                                <!-- /.testimonials-five__item__triangle -->
                            </div>
                            <!-- /.testimonials-five__item -->
                        </div>
                        <!-- /.item -->
                    @endforeach
                </div>
                <!-- /.testimonials-five__carousel -->
            </div>
            <!-- /.container -->
        </section>
    @endif
    <!-- /.testimonials-five -->
    <!-- /.blog-one -->
    <section class="blog-one">
        <div class="container">
            <div class="sec-title-four text-center">
                <h6 class="sec-title-three__tagline"><span class="sec-title-three__tagline__left-border"></span>News &
                    Blog<span class="sec-title-three__tagline__right-border"></span></h6>
                <!-- /.sec-title-four__tagline -->
                <h3 class="sec-title-two__title">Trending IT Solution <span>Blog & Tips</span></h3>
                <!-- /.sec-title-four__title -->
            </div>
            <div class="mt-3 blog-one__carousel tolak-owl__carousel tolak-owl__carousel--basic-nav owl-carousel owl-theme"
                data-owl-options='{"items": 1,"margin": 30,"loop": false,"smartSpeed": 700,"nav": false,
                                         "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],"dots": false,
                                         "autoplay": false,"responsive": {"0": {"items": 1},"768": {"items": 2},"992": {"items": 3}}}'>

                @foreach ($blogs as $blog)
                    <div class="item">
                        <div class="blog-card wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='00ms'>
                            <div class="blog-card__image">
                                <img src="{{ asset($blog->image ?? 'frontend/assets/images/ui.jpg') }}" alt="{{ $blog->title }}"
                                    style="width: 350px; height: 262px; object-fit: cover;" loading="lazy" decoding="async">
                                <img src="{{ asset($blog->image ?? 'frontend/assets/images/ui.jpg') }}" alt="{{ $blog->title }}"
                                    style="width: 350px; height: 262px; object-fit: cover;" loading="lazy" decoding="async">
                                <a href="{{ route('blog.details', $blog->slug) }}" class="blog-card__image__link"></a>
                            </div>
                            <div class="blog-card__bg"></div>
                            <div class="blog-card-two__meta">
                                <div class="blog-card-two__meta__author">
                                    <img src="{{ asset($blog->author_image ?? 'frontend/assets/images/award-1.jpg') }}"
                                        alt="{{ $blog->author ?? 'Admin' }}"
                                        style="width: 40px; height: 40px; object-fit: cover;" loading="lazy" decoding="async">
                                    {{ $blog->author ?? 'Admin' }}
                                </div>
                                <div class="d-flex align-items-center">
                                    @php
                                        $date = \Carbon\Carbon::parse($blog->date);
                                    @endphp
                                    <div class="blog-card-two__meta__date">
                                        <span>{{ $date->format('d') }}</span>{{ $date->format('M') }}
                                    </div>
                                    <div class="blog-card-two__meta__year">{{ $date->format('Y') }}</div>
                                </div>
                            </div>
                            <div class="blog-card__content">
                                <h3 class="blog-card__title">
                                    <a href="{{ route('blog.details', $blog->slug) }}">
                                        {{ Str::limit($blog->title, 60) }}
                                    </a>
                                </h3>
                                <p class="blog-card__text">{{ Str::limit(strip_tags($blog->description), 100) }}</p>
                                <a href="{{ route('blog.details', $blog->slug) }}" class="blog-card__link">
                                    Read more <i class="icofont-rounded-double-right"></i>
                                </a>
                            </div>
                            <div class="blog-card__border"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('blogs.page') }}" class="tolak-btn-two tolak-btn-two--home-six">
                    <span class="tolak-btn-two__left-star"></span>
                    <span>See All News<i class="tolak-icons-two-arrow-right-short"></i></span>
                    <span class="tolak-btn-two__right-star"></span>
                </a>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /.blog-one -->
@endsection



