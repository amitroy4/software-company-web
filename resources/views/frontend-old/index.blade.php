@extends('layouts.frontend')
@section('title','Homepage')
@section('content')
<!-- Slider -->
@if(!empty($sliders) && $sliders->isNotEmpty())
<div class="page-title-home-2">
    <div class="swiper-container slider-home-2">
        <div class="swiper-wrapper">
            @foreach ($sliders as $slider)
            <div class="swiper-slide">
                <div class="slide-home-2">
                    <div class="image overflow-hidden">
                        <img src="{{ asset('storage/' . $slider->image) }}"
                            data-src="{{ asset('storage/' . $slider->image) }}" alt=""
                            class="lazyload tf-animate-zoom-in-out">
                    </div>
                    <div class="content">
                        @php
                        $words = explode(' ', $slider->title);
                        @endphp

                        <h1 class="title font-farmhouse tf-fade-top fade-item-2">
                            {{ implode(' ', array_slice($words, 0, 3)) }}<br>
                            {{ implode(' ', array_slice($words, 3)) }}
                        </h1>
                        @php
                        $subTitle = explode(' ', $slider->sub_title);
                        @endphp

                        <p class="text font-nunito tf-fade-left fade-item-4">
                            {{ implode(' ', array_slice($subTitle, 0, 9)) }}<br>
                            {{ implode(' ', array_slice($subTitle, 9)) }}</p>
                        @if ($slider->button_text)
                        <a href="{{$slider->button_url}}" class="tf-btn btn-view tf-fade-bottom fade-item-5">
                            <span class="text-style cl-primary">
                                {{$slider->button_text}}
                            </span>
                            <div class="icon">
                                <i class='bx bxs-chevron-right'></i>
                            </div>
                        </a>
                        @endif

                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class=" btn-slide-home-2 btn-next">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="80px" height="20px" viewBox="0 0 80 20"
                preserveAspectRatio="xMidYMid meet">
                <g fill="#ffffff">
                    <path
                        d="M63 19 c0 -0.5 2.6 -2.4 5.8 -4.2 l5.7 -3.3 -19.5 -0.8 c-11 -0.5 -27.1 -0.5 -37 0.1 -9.6 0.5 -17.7 0.7 -17.9 0.5 -2.4 -1.9 22 -3.5 48.7 -3.1 l25.2 0.3 -4.6 -3.9 c-2.5 -2.1 -4.3 -4 -4 -4.3 0.7 -0.7 14.6 8.9 14.6 10.2 0 1.1 -14.3 9.5 -16.2 9.5 -0.4 0 -0.8 -0.4 -0.8 -1z" />
                </g>
            </svg>
        </div>
        <div class=" btn-slide-home-2 btn-prev">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="80px" height="20px" viewBox="0 0 80 20"
                preserveAspectRatio="xMidYMid meet">
                <g fill="#ffffff">
                    <path
                        d="M7 15.4 c-3.6 -2.4 -6.6 -5 -6.8 -5.7 -0.2 -1.2 13.8 -9.7 16 -9.7 2.4 0 0.2 2.4 -4.9 5.2 l-5.8 3.3 19.5 0.8 c11 0.5 27.1 0.5 37 -0.1 9.6 -0.5 17.7 -0.7 17.9 -0.5 2.4 1.9 -22 3.5 -48.6 3.1 l-25.2 -0.3 4.7 4.2 c6.1 5.5 4.4 5.3 -3.8 -0.3z" />
                </g>
            </svg>
        </div>
    </div>
</div>
@endif
<!-- Slider -->
<!-- Top Counter -->
@if ($counter)
<section class="s-about-us-2">
    <div class="tf-container w-1290">
        <div class="row">
            <div class="col-md-4">
                <div class="wrap wg-counter style-4">
                    <div class="box-event style-2 ic-hover wow fadeInUp" data-wow-delay="0s">
                        <div class="counter-item">
                            <p class="title font-worksans fw-5">{{$counter->title_1}}</p>
                            <div class="counter">
                                <div id="odometer" class="odometer fs-65 style-4">{{$counter->amount_1}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="wrap wg-counter style-4">
                    <div class="box-event style-2 ic-hover wow fadeInUp" data-wow-delay="0.1s">
                        <div class="counter-item">
                            <p class="title font-worksans fw-5">{{$counter->title_2}}</p>
                            <div class="counter">
                                <div class="odometer fs-65 style-4-2">{{$counter->amount_2}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="wrap wg-counter style-4">
                    <div class="box-event style-2 ic-hover wow fadeInUp" data-wow-delay="0.2s">
                        <div class="counter-item">
                            <p class="title font-worksans fw-5">{{$counter->title_3}}</p>
                            <div class="counter">
                                <div class="odometer fs-65 style-4-3">{{$counter->amount_3}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Top Counter -->
@if ($about)
<section class="s-our-history has-img-item tf-pt-0">
    <div class="tf-container w-1620">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-section img-hover">
                    <div class="image hover-item">
                        <img src="{{ asset('storage/' . $about->image) }}"
                            data-src="{{ asset('storage/' . $about->image) }}" alt="" class="lazyload">
                    </div>
                    <div class="heading-section style-4 has-text style-3">
                        <div class="img-item">
                            <p class="sub-title">{{$about->title}}</p>
                        </div>
                        <p class="title text-anime-style-1">{{$about->sub_title}}</p>
                        @if ($about->description)
                        <p class="text">{!! Str::limit($about->description, 500, '...') !!}</p>
                        @endif
                        <a href="{{route('about-us.page')}}" class="tf-btn gap-30" data-wow-delay="0s">
                            <span class="text-style cl-primary">
                                Read More
                            </span>
                            <div class="icon">
                                <i class="icon-arrow_right"></i>
                            </div>
                        </a>
                        @if ($about->year_of_experience)
                        <div class="wg-exprerience text-center z-5 tf-rotate-back-and-forth">
                            <p class="year">{{$about->year_of_experience}}</p>
                            <p class="text">
                                Years Of <br> Experience
                            </p>
                        </div>

                        @endif

                    </div>
                </div>
            </div>
        </div>
        <div class="about-static">
            <p class="sub font-snowfall fs-30 text-anime-style-1">
                We believe that to have good health, clean and healthy food sources are the key
            </p>
            <div class="swiper-container slider-box-icon">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <ul class="box-icon-list style-2">
                            @foreach ($aboutCounters as $aboutCounter)
                            <li>
                                <div class="box-icon style-3 ic-hover wow fadeInUp" data-wow-delay="0s">
                                    <div class="icon style-circle hover-icon">
                                        <img src="{{ asset('storage/' . $aboutCounter->image) }}" alt="Worm Icon"
                                            style="width: 45px; height: 45px; ">

                                    </div>
                                    <a href="our-commitments.html" class="caption fw-6 font-worksans hover-text-4">
                                        {{$aboutCounter->title}}
                                    </a>
                                </div>
                            </li>
                            @endforeach


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="s-img-item item-1">
        <img src="{{ asset('frontend/assets') }}/images/item/brown-top.png" alt="">
    </div>
    <div class="s-img-item item-bottom">
        <img src="{{ asset('frontend/assets') }}/images/item/brown-bottom.png" alt="">
    </div>
    <div class="s-img-item item-3 wow zoomIn">
        <div class="scroll-element-3">
            <img src="{{ asset('frontend/assets') }}/images/item/windmill-2.png" alt="">
        </div>
    </div>
</section>
@endif

<!-- Project Section-->
<section class="s-service-2 relative overflow-hidden page-portfolio-1 flat-portfolio">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-5">
                <div class="heading-section has-text">
                    <div class="img-item">
                        <p class="sub-title">
                            <i class='bx bxs-leaf'></i> GrowUp Agrotech
                        </p>
                    </div>
                    <p class="title text-anime-style-2">
                        Grow Up Projects
                    </p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="wg-tabs style-2">
                    <ul class="menu-tab portfolio-filter mb-0 mt-5">
                        <li class="item active">
                            <a href="#" class="btn-tab active" data-filter="*"> All Projects</a>
                        </li>
                        <li class="item"><a href="#" class="btn-tab" data-filter=".rs">Short Term</a></li>
                        <li class="item"><a href="#" class="btn-tab" data-filter=".bashu">Long Term</a></li>
                        <li class="item"><a href="#" class="btn-tab" data-filter=".cox">Shariah</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="wg-tabs">
                    <ul class=" portfolio-wrap grid-isotope-3">
                        <li class="grid-sizer"></li>
                        <li class="item cox bashu">
                            <div class="box-portfolio style-3 ">
                                <div class="image hover-item">
                                    <img src="{{ asset('frontend/assets') }}/images/rtg-2.jpg"
                                        data-src="{{ asset('frontend/assets') }}/images/rtg-2.jpg" alt=""
                                        class=" lazyload">
                                    <div class="content">
                                        <a href="project-details.php"
                                            class="title fs-23 font-worksans fw-6 hover-text-secondary">Cultivated Crop
                                            Land Mango-2</a>
                                    </div>
                                </div>
                                <div class="content-2">
                                    <div
                                        class="subtotal d-flex justify-content-between align-items-center  border-bottom pb-1">
                                        <p class="text-main-2">Business type</p>
                                        <p class="total text-main-2">Production/Land Ownership</p>
                                    </div>
                                    <ul class="order-meta-list border-bottom">
                                        <li>
                                            <span class="text-small-2 text-uppercase">Investment Time:</span>
                                            <span class="fw-medium text-main-2">16 days</span>
                                        </li>
                                        <li class="text-end">
                                            <span class="text-small-2 text-uppercase">Project Duration:</span>
                                            <span class="fw-medium text-main-2">Lifetime</span>
                                        </li>
                                    </ul>
                                    <ul class="order-meta-list border-bottom">
                                        <li>
                                            <span class="text-small-2 text-uppercase">Investment goal:</span>
                                            <span class="fw-medium text-main-2">35600000/=</span>
                                        </li>
                                        <li class="text-end">
                                            <span class="text-small-2 text-uppercase">Min. Investment:</span>
                                            <span class="fw-medium text-main-2">300000/=</span>
                                        </li>
                                    </ul>
                                    <ul class="order-meta-list border-bottom">
                                        <li>
                                            <span class="text-small-2 text-uppercase">Raised:</span>
                                            <span class="fw-medium text-main-2">21850000/=</span>
                                        </li>
                                        <li class="text-end">
                                            <span class="text-small-2 text-uppercase">In waiting:</span>
                                            <span class="fw-medium text-main-2">13750000/=</span>
                                        </li>
                                    </ul>
                                    <div
                                        class="subtotal d-flex justify-content-between align-items-center pt-1 pb-1 border-bottom">
                                        <p class="text-main-2">Projected:</p>
                                        <p class="total text-main-2">Excluding Service Charge</p>
                                    </div>
                                    <ul class="order-meta-list">
                                        <li>
                                            <span class="text-small-2 text-uppercase">ROI:</span>
                                            <span class="fw-medium text-main-2">Annually 40%</span>
                                        </li>
                                        <li class="text-end">
                                            <span class="text-small-2 text-uppercase">Project status:</span>
                                            <span class="fw-medium text-main-2">Running</span>
                                        </li>
                                    </ul>
                                </div>
                                <div
                                    class="project-button-box mb-0 pb-0 d-flex justify-content-between align-items-center">
                                    <a href="project-details.php" class="project-button-1">See Details</a>
                                    <a href="project-invest.php" class="project-button-2">Invest Now</a>
                                </div>
                            </div>
                        </li>
                        <li class="item cox haau rs">
                            <div class="box-portfolio style-3 ">
                                <div class="image hover-item">
                                    <img src="{{ asset('frontend/assets') }}/images/rtg-2.jpg"
                                        data-src="{{ asset('frontend/assets') }}/images/rtg-2.jpg" alt=""
                                        class=" lazyload">
                                    <div class="content">
                                        <a href="project-details.php"
                                            class="title fs-23 font-worksans fw-6 hover-text-secondary">Cultivated Crop
                                            Land Mango-2</a>
                                    </div>
                                </div>
                                <div class="content-2">
                                    <div
                                        class="subtotal d-flex justify-content-between align-items-center  border-bottom pb-1">
                                        <p class="text-main-2">Business type</p>
                                        <p class="total text-main-2">Production/Land Ownership</p>
                                    </div>
                                    <ul class="order-meta-list border-bottom">
                                        <li>
                                            <span class="text-small-2 text-uppercase">Investment Time:</span>
                                            <span class="fw-medium text-main-2">16 days</span>
                                        </li>
                                        <li class="text-end">
                                            <span class="text-small-2 text-uppercase">Project Duration:</span>
                                            <span class="fw-medium text-main-2">Lifetime</span>
                                        </li>
                                    </ul>
                                    <ul class="order-meta-list border-bottom">
                                        <li>
                                            <span class="text-small-2 text-uppercase">Investment goal:</span>
                                            <span class="fw-medium text-main-2">35600000/=</span>
                                        </li>
                                        <li class="text-end">
                                            <span class="text-small-2 text-uppercase">Min. Investment:</span>
                                            <span class="fw-medium text-main-2">300000/=</span>
                                        </li>
                                    </ul>
                                    <ul class="order-meta-list border-bottom">
                                        <li>
                                            <span class="text-small-2 text-uppercase">Raised:</span>
                                            <span class="fw-medium text-main-2">21850000/=</span>
                                        </li>
                                        <li class="text-end">
                                            <span class="text-small-2 text-uppercase">In waiting:</span>
                                            <span class="fw-medium text-main-2">13750000/=</span>
                                        </li>
                                    </ul>
                                    <div
                                        class="subtotal d-flex justify-content-between align-items-center pt-1 pb-1 border-bottom">
                                        <p class="text-main-2">Projected:</p>
                                        <p class="total text-main-2">Excluding Service Charge</p>
                                    </div>
                                    <ul class="order-meta-list">
                                        <li>
                                            <span class="text-small-2 text-uppercase">ROI:</span>
                                            <span class="fw-medium text-main-2">Annually 40%</span>
                                        </li>
                                        <li class="text-end">
                                            <span class="text-small-2 text-uppercase">Project status:</span>
                                            <span class="fw-medium text-main-2">Running</span>
                                        </li>
                                    </ul>
                                </div>
                                <div
                                    class="project-button-box mb-0 pb-0 d-flex justify-content-between align-items-center">
                                    <a href="project-details.php" class="project-button-1">See Details</a>
                                    <a href="project-invest.php" class="project-button-2">Invest Now</a>
                                </div>
                            </div>
                        </li>
                        <li class="item haau cox">
                            <div class="box-portfolio style-3 ">
                                <div class="image hover-item">
                                    <img src="{{ asset('frontend/assets') }}/images/rtg-2.jpg"
                                        data-src="{{ asset('frontend/assets') }}/images/rtg-2.jpg" alt=""
                                        class=" lazyload">
                                    <div class="content">
                                        <a href="project-details.php"
                                            class="title fs-23 font-worksans fw-6 hover-text-secondary">Cultivated Crop
                                            Land Mango-2</a>
                                    </div>
                                </div>
                                <div class="content-2">
                                    <div
                                        class="subtotal d-flex justify-content-between align-items-center  border-bottom pb-1">
                                        <p class="text-main-2">Business type</p>
                                        <p class="total text-main-2">Production/Land Ownership</p>
                                    </div>
                                    <ul class="order-meta-list border-bottom">
                                        <li>
                                            <span class="text-small-2 text-uppercase">Investment Time:</span>
                                            <span class="fw-medium text-main-2">16 days</span>
                                        </li>
                                        <li class="text-end">
                                            <span class="text-small-2 text-uppercase">Project Duration:</span>
                                            <span class="fw-medium text-main-2">Lifetime</span>
                                        </li>
                                    </ul>
                                    <ul class="order-meta-list border-bottom">
                                        <li>
                                            <span class="text-small-2 text-uppercase">Investment goal:</span>
                                            <span class="fw-medium text-main-2">35600000/=</span>
                                        </li>
                                        <li class="text-end">
                                            <span class="text-small-2 text-uppercase">Min. Investment:</span>
                                            <span class="fw-medium text-main-2">300000/=</span>
                                        </li>
                                    </ul>
                                    <ul class="order-meta-list border-bottom">
                                        <li>
                                            <span class="text-small-2 text-uppercase">Raised:</span>
                                            <span class="fw-medium text-main-2">21850000/=</span>
                                        </li>
                                        <li class="text-end">
                                            <span class="text-small-2 text-uppercase">In waiting:</span>
                                            <span class="fw-medium text-main-2">13750000/=</span>
                                        </li>
                                    </ul>
                                    <div
                                        class="subtotal d-flex justify-content-between align-items-center pt-1 pb-1 border-bottom">
                                        <p class="text-main-2">Projected:</p>
                                        <p class="total text-main-2">Excluding Service Charge</p>
                                    </div>
                                    <ul class="order-meta-list">
                                        <li>
                                            <span class="text-small-2 text-uppercase">ROI:</span>
                                            <span class="fw-medium text-main-2">Annually 40%</span>
                                        </li>
                                        <li class="text-end">
                                            <span class="text-small-2 text-uppercase">Project status:</span>
                                            <span class="fw-medium text-main-2">Running</span>
                                        </li>
                                    </ul>
                                </div>
                                <div
                                    class="project-button-box mb-0 pb-0 d-flex justify-content-between align-items-center">
                                    <a href="project-details.php" class="project-button-1">See Details</a>
                                    <a href="project-invest.php" class="project-button-2">Invest Now</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="d-flex justify-center">
                        <button id="load-more" class="tf-btn btn-loadMore mt-20 scale-40">
                            <span class="text-style">
                                Load More Projects
                            </span>
                            <div class="icon">
                                <i class="icon-arrow_right"></i>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Project Section -->
<!-- Section counter -->
<section class="s-counter has-img-item ">
    <div class="tf-container w-1290">
        <div class="row">
            <div class="col-lg-12">
                <div class="wg-counter p-0">
                    @foreach ($achivements as $achivement)
                    <div class="counter-item">
                        <div class="counter">
                            <div class="odometer fs-65 style-1 style-1-1">
                                {{$achivement->amount}}
                            </div>
                        </div>
                        <p class="sub">{{$achivement->title}}</p>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <div class="s-img-item item-1">
        <img src="{{ asset('frontend/assets') }}/images/item/brown-top.png" alt="" />
    </div>
    <div class="s-img-item item-2 zoomIn wow">
        <div class="scroll-element-4">
            <img src="{{ asset('frontend/assets') }}/images/item/tructor.png" alt="" />
        </div>
    </div>
    <div class="s-img-item item-bottom">
        <img src="{{ asset('frontend/assets') }}/images/item/brown-bottom.png" alt="" />
    </div>
</section>
<!-- /.Section counter -->
<!-- Our Properties -->
<div class="main-content page-portfolio-1 flat-portfolio">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-section has-text text-center">
                    <div class="img-item">
                        <p class="sub-title">
                            <i class='bx bxs-leaf'></i>GrowUp Agrotech
                        </p>
                    </div>
                    <p class="title text-anime-style-2">
                        Our Properties
                    </p>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="wg-tabs">
                    <ul class="overflow-x-auto menu-tab portfolio-filter">
                        <li class="item active">
                            <a href="#" class="btn-tab active" data-filter="*"> All Projects</a>
                        </li>
                        <li class="item"><a href="#" class="btn-tab" data-filter=".rs">Cox Crown</a></li>
                        <li class="item"><a href="#" class="btn-tab" data-filter=".bashu">Bashundhara</a></li>
                        <li class="item"><a href="#" class="btn-tab" data-filter=".cox">RS Tower</a></li>
                        <li class="item"><a href="#" class="btn-tab" data-filter=".haau">Haaue Palace</a>
                        </li>
                    </ul>
                    <ul class=" portfolio-wrap grid-isotope-3">
                        <li class="grid-sizer"></li>
                        <li class="item cox bashu">
                            <div class="box-portfolio ">
                                <div class="image">
                                    <img src="{{ asset('frontend/assets') }}/images/House-1.jpg"
                                        data-src="{{ asset('frontend/assets') }}/images/House-1.jpg" alt=""
                                        class=" lazyload transition">
                                </div>
                                <div class="content">
                                    <p class="sub font-farmhouse text-upper">Cox Crown</p>
                                    <a href="property-details.php"
                                        class="title fs-23 font-worksans fw-6 hover-text-secondary">Premium Package</a>
                                </div>
                            </div>
                        </li>
                        <li class="item cox haau rs">
                            <div class="box-portfolio ">
                                <div class="image">
                                    <img src="{{ asset('frontend/assets') }}/images/House-1.jpg"
                                        data-src="{{ asset('frontend/assets') }}/images/House-1.jpg" alt=""
                                        class=" lazyload">
                                </div>
                                <div class="content">
                                    <p class="sub font-farmhouse text-upper">Bashundhara</p>
                                    <a href="property-details.php"
                                        class="title fs-23 font-worksans fw-6 hover-text-secondary">Silver Package</a>
                                </div>
                            </div>
                        </li>
                        <li class="item haau cox">
                            <div class="box-portfolio ">
                                <div class="image">
                                    <img src="{{ asset('frontend/assets') }}/images/House-1.jpg"
                                        data-src="{{ asset('frontend/assets') }}/images/House-1.jpg" alt=""
                                        class=" lazyload">
                                </div>
                                <div class="content">
                                    <p class="sub font-farmhouse text-upper">RS Tower</p>
                                    <a href="property-details.php"
                                        class="title fs-23 font-worksans fw-6 hover-text-secondary">Gold Package</a>
                                </div>
                            </div>
                        </li>
                        <li class="item cox haau rs">
                            <div class="box-portfolio ">
                                <div class="image">
                                    <img src="{{ asset('frontend/assets') }}/images/House-1.jpg"
                                        data-src="{{ asset('frontend/assets') }}/images/House-1.jpg" alt=""
                                        class=" lazyload">
                                </div>
                                <div class="content">
                                    <p class="sub font-farmhouse text-upper">Cox's Crown</p>
                                    <a href="property-details.php"
                                        class="title fs-23 font-worksans fw-6 hover-text-secondary">Silver Package</a>
                                </div>
                            </div>
                        </li>
                        <li class="item haau cox">
                            <div class="box-portfolio ">
                                <div class="image">
                                    <img src="{{ asset('frontend/assets') }}/images/House-1.jpg"
                                        data-src="{{ asset('frontend/assets') }}/images/House-1.jpg" alt=""
                                        class=" lazyload">
                                </div>
                                <div class="content">
                                    <p class="sub font-farmhouse text-upper">RS Tower</p>
                                    <a href="property-details.php"
                                        class="title fs-23 font-worksans fw-6 hover-text-secondary">Platinum Package</a>
                                </div>
                            </div>
                        </li>
                        <li class="item rs haau bashu">
                            <div class="box-portfolio ">
                                <div class="image">
                                    <img src="{{ asset('frontend/assets') }}/images/House-1.jpg"
                                        data-src="{{ asset('frontend/assets') }}/images/House-1.jpg" alt=""
                                        class=" lazyload">
                                </div>
                                <div class="content">
                                    <p class="sub font-farmhouse text-upper">Bashundhara</p>
                                    <a href="property-details.php"
                                        class="title fs-23 font-worksans fw-6 hover-text-secondary">Premium Package</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="d-flex justify-center">
                        <button id="load-more" href="all-property.php" class="tf-btn btn-loadMore mt-20 scale-40">
                            <span class="text-style">
                                Load More Projects
                            </span>
                            <div class="icon">
                                <i class="icon-arrow_right"></i>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Our Properties -->
<!-- Perallax -->
@if ($advertisment)
<section class="s-break-page style-2">
    <div class="content">
        <h1 class="font-farmhouse text-center text-anime-style-1">

            @php
            $advertise = explode(' ', $advertisment->title);
            @endphp
            {{ implode(' ', array_slice($advertise, 0, 3)) }}<br>
            {{ implode(' ', array_slice($advertise, 3, 3)) }}<br>
            {{ implode(' ', array_slice($advertise, 6)) }}
        </h1>
    </div>
</section>
@endif

<!--Perallax -->
<!-- NGO Activities -->
@if(!empty($activities) && $activities->isNotEmpty())
<section class="s-box-portfolio properties-section has-img-item">
    <div class="s-img-item item-1">
        <img src="{{ asset('frontend/assets') }}/images/page-title-top.png" alt="">
    </div>
    <div class="tf-container w-1290">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-section has-text text-center">
                    <div class="img-item">
                        <p class="sub-title">
                            <i class='bx bxs-leaf'></i> GrowUp Agrotech
                        </p>
                    </div>
                    <p class="title text-anime-style-2">
                        NGO Activities
                    </p>
                </div>
            </div>
            @foreach ($activities as $activity)
            <div class="col-lg-4 col-md-6">
                <div class="box-portfolio style-4 tf-img-hover mb-s-991">
                    @if($activity->image)
                    <div class="image hover01">
                        <img src="{{ asset('storage/' . $activity->image) }}"
                            data-src="{{ asset('storage/' . $activity->image) }}" alt="" class="lazyload" />
                    </div>
                    @endif
                    <div class="content">
                        @php
                        $activityTitle = explode(' ', $activity->title);
                        @endphp
                        <a href="{{ route('ngo-activities.details', $activity->slug) }}"
                            class="title fs-22 font-worksans fw-6 hover-text-4">
                            {{ implode(' ', array_slice($activityTitle, 0, 3)) }}
                            @if(count($activityTitle) > 3)
                            <br>{{ implode(' ', array_slice($activityTitle, 3, 3)) }}
                            @endif
                        </a>
                        <p class="text font-nunito"> {!! Str::limit($activity->description, 150, '...') !!}</p>

                        <div class="bot">
                            <a href="{{ route('ngo-activities.details', $activity->slug) }}"
                                class="btn-read font-worksans fw-5">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- NGO Activities -->
<!-- Section happy farm -->
<!--<section class="s-happy-farm">-->
<!--   <div class="bg-section">-->
<!--      <div class="scroll-element-3">-->
<!--         <img class="lazyload  scale-1-1" src="{{ asset('frontend/assets') }}/images/width-bg-1.jpg"-->
<!--            data-src="{{ asset('frontend/assets') }}/images/width-bg-1.jpg" alt="">-->
<!--      </div>-->
<!--   </div>-->
<!--   <div class="content-section">-->
<!--      <div class="tf-container w-1290">-->
<!--         <div class="row">-->
<!--            <div class="col-lg-12">-->
<!--               <div class="content">-->
<!--                  <div class="heading-section style-3 has-text">-->
<!--                     <div class="top">-->
<!--                        <p class="sub-title fs-35 tf-animate-1">Happy Farming!</p>-->
<!--                        <div class="img-item item-2 tf-heartBeat">-->
<!--                           <img class="wow zoomIn " src="{{ asset('frontend/assets') }}/images/item/happy.png" alt="" />-->
<!--                        </div>-->
<!--                     </div>-->
<!--                     <p class="title wow fadeInUp" data-wow-delay="0s">-->
<!--                        We Passionately Care About-->
<!--                        Farmers, Consumers.-->
<!--                     </p>-->
<!--                     <p class="text wow fadeInUp" data-wow-delay="0s">-->
<!--                        If you need to buy clean agricultural products and learn about us, contact us-->
<!--                        now!-->
<!--                     </p>-->
<!--                     <a href="contact-us.php" class="tf-btn bg-white scale-40 wow fadeInUp"-->
<!--                        data-wow-delay="0s">-->
<!--                        <span class="text-style cl-primary">-->
<!--                        Contact Us Today-->
<!--                        </span>-->
<!--                        <div class="icon">-->
<!--                           <i class="icon-arrow_right"></i>-->
<!--                        </div>-->
<!--                     </a>-->
<!--                  </div>-->
<!--                  <div class="image-wrap">-->
<!--                     <img src="{{ asset('frontend/assets') }}/images/rtg-2.jpg" data-src="{{ asset('frontend/assets') }}/images/rtg-2.jpg"-->
<!--                        alt="" class="lazyload">-->
<!--                  </div>-->
<!--                  <div class="img-item item-1 nhapNhap">-->
<!--                     <img src="{{ asset('frontend/assets') }}/images/item/house-mountain-2.png" alt="">-->
<!--                  </div>-->
<!--               </div>-->
<!--            </div>-->
<!--         </div>-->
<!--      </div>-->
<!--   </div>-->
<!--</section>-->
<!-- /.Section happy farm -->
<!-- Section partner -->
@if(!empty($clients) && $clients->isNotEmpty())
<section class="s-partner style-2 has-img-item">
    <div class="tf-container w-1780">
        <div class="row">
            <div class="col-lg-12">
                <div class="slider-wrap">
                    <div class="swiper-container slider-partner">
                        <div class="swiper-wrapper">
                            @foreach ($clients as $client)
                            <div class="swiper-slide">
                                <div class="slide-partner">
                                    <div class="image">
                                        <a href="{{ $client->show_url == 1 ? $client->url : '#' }}"
                                            @if($client->show_url == 1) target="_blank"
                                            @endif
                                            style="{{ $client->show_url == 1 ? 'cursor: pointer;' : '' }}">
                                            <img src="{{ asset('storage/' . $client->logo) }}" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="s-img-item item-1">
        <img src="{{ asset('frontend/assets') }}/images/page-title-top.png" alt="" />
    </div>
</section>
@endif
<!-- /.Section partner -->
<!-- Section testimonial -->
@if(!empty($testimonials) && $testimonials->isNotEmpty())
<section class="s-testimonial-2">
    <div class="tf-container w-1290">
        <div class="row">
            <div class="col-md-6">
                <div class="heading-section">
                    <p class="sub-title">Testimonials From People Who Have Experienced It
                    </p>
                    <p class="title text-anime-style-1">What Customers Says?</p>
                    <div class="img-item">
                        <img src="{{ asset('frontend/assets') }}/images/item/rice-plant-2.png" class="tf-animate-1"
                            alt="" />
                    </div>
                    <div class="img-item item-2">
                        <i class="icon-quote"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="counter-wrap">
                    <div class="wg-counter style-5 style-6">
                        <div class="icon style-circle">
                            <i class="icon-barley"></i>
                        </div>
                        <div class="counter-item">
                            <p class="title font-worksans fw-5 fs-18">
                                Trust By Clients
                            </p>
                            <div class="counter">
                                <div class="odometer style-6">{{$testimonials->count()}}</div>
                                <span class="sub-odo color-secondary">+</span>
                            </div>
                        </div>
                    </div>
                    <div class="img-item">
                        <img src="{{ asset('frontend/assets') }}/images/item/line-throw-title.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="s-slider">
        <div class="tf-container w-1290">
            <div class="row">
                <div class="col-lg-12">
                    <div class="swiper-container slider-s-testimonial-2">
                        <div class="swiper-wrapper">
                            @foreach ($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="testimonial style-2">
                                    <div class="comment">
                                        <p class="caption fs-23 font-snowfall">{{$testimonial->title}}</p>
                                        <p class="text font-worksans">{!!$testimonial->description!!}</p>
                                    </div>
                                    <div class="author-wrap">
                                        <div class="left">
                                            @if ($testimonial->image)
                                            <div class="image-avt">
                                                <img src="{{ asset('storage/'.$testimonial->image) }}" alt="">
                                            </div>
                                            @endif
                                            <div class="infor">
                                                <div class="name-wrap">
                                                    <a href="#" class="name text-upper hover-text-4">
                                                        {{$testimonial->customer_name}}
                                                    </a>
                                                </div>
                                                <p class="duty">
                                                    @if ($testimonial->customer_designation)
                                                    {{$testimonial->customer_designation}}
                                                    @endif
                                                    @if ($testimonial->customer_organization)
                                                    , {{$testimonial->customer_organization}}
                                                    @endif

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" btn-slide-testimonial-2 btn-next">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="58px" height="15px" viewBox="0 0 80 20"
                preserveAspectRatio="xMidYMid meet">
                <g fill="#0d401c">
                    <path
                        d="M63 19 c0 -0.5 2.6 -2.4 5.8 -4.2 l5.7 -3.3 -19.5 -0.8 c-11 -0.5 -27.1 -0.5 -37 0.1 -9.6 0.5 -17.7 0.7 -17.9 0.5 -2.4 -1.9 22 -3.5 48.7 -3.1 l25.2 0.3 -4.6 -3.9 c-2.5 -2.1 -4.3 -4 -4 -4.3 0.7 -0.7 14.6 8.9 14.6 10.2 0 1.1 -14.3 9.5 -16.2 9.5 -0.4 0 -0.8 -0.4 -0.8 -1z" />
                </g>
            </svg>
        </div>
        <div class=" btn-slide-testimonial-2 btn-prev">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="58px" height="15px" viewBox="0 0 80 20"
                preserveAspectRatio="xMidYMid meet">
                <g fill="#0d401c">
                    <path
                        d="M7 15.4 c-3.6 -2.4 -6.6 -5 -6.8 -5.7 -0.2 -1.2 13.8 -9.7 16 -9.7 2.4 0 0.2 2.4 -4.9 5.2 l-5.8 3.3 19.5 0.8 c11 0.5 27.1 0.5 37 -0.1 9.6 -0.5 17.7 -0.7 17.9 -0.5 2.4 1.9 -22 3.5 -48.6 3.1 l-25.2 -0.3 4.7 4.2 c6.1 5.5 4.4 5.3 -3.8 -0.3z" />
                </g>
            </svg>
        </div>
    </div>
</section>
@endif
<!-- /.Section testimonial -->
<!-- Section blog post -->
@if(!empty($blogs) && $blogs->isNotEmpty())
<section class="s-blog-post has-img-item">
    <div class="s-img-item item-1">
        <img src="{{ asset('frontend/assets') }}/images/page-title-top2.png" alt="">
    </div>
    <div class="tf-container w-1290">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-section has-text text-center">
                    <p class="sub-title"><i class='bx bxs-leaf'></i>From The Blog Post</p>
                    <p class="title tf-animate-2">Latest News & Articles</p>
                </div>
            </div>
        </div>
    </div>
    <div class="s-slide">
        <div class="tf-container w-1290">
            <div class="row">
                <div class="col-lg-12">
                    <div class="swiper-container slider-blog-post">
                        <div class="swiper-wrapper">
                            @foreach ( $blogs as $blog )
                            <div class="swiper-slide">
                                <article class="article-blog-item type-3 style-2 img-hover">
                                    <div class="image">
                                        <div class="video-wrap hover-item">
                                            <img class="lazyload"
                                                data-src="{{ asset('storage/'.$blog->image) }}"
                                                src="{{ asset('storage/'.$blog->image) }}" alt="" />
                                            <a href="https://www.youtube.com/watch?v=MLpWrANjFbI"
                                                class="style-icon-play popup-youtube">
                                                <i class="fa-solid fa-play"></i>
                                            </a>
                                        </div>
                                        @php
                                        $date = \Carbon\Carbon::parse($blog->date);
                                    @endphp

                                    <div class="entry-date">
                                        <p class="day">
                                            {{ $date->format('d') }}
                                        </p>
                                        <p class="month-year">
                                            {{ $date->format('M y') }}
                                        </p>
                                    </div>
                                    </div>
                                    <div class="content">
                                        <ul class="entry-meta">
                                            @if ($blog->author)


                                            <li class="entry author">
                                                <i class="fa-solid fa-circle-user"></i>
                                                <p>
                                                    <a href="#">
                                                        By
                                                        {{$blog->author}}
                                                    </a>
                                                </p>
                                            </li>
                                            @endif
                                            @if ($blog->tags)
                                            @php
                                            // Convert comma-separated tags to an array
                                            $tags = explode(',', $blog->tags);
                                            // Trim whitespace from each tag
                                            $tags = array_map('trim', $tags);
                                            @endphp
                                            <li class="entry tags">
                                                <i class="fa-solid fa-tag"></i>

                                                <p>
                                                    @foreach($tags as $tag)
                                                    <a href="#">{{ $tag }}</a>,@endforeach
                                                </p>
                                            </li>
                                            @endif
                                        </ul>
                                        <h3 class="title fw-6">
                                            <a href="{{ route('blog.details', $blog->slug) }}">{{$blog->title}}</a>
                                        </h3>
                                        <p class="text text-line-clamp-3">{!! Str::limit($blog->description, 150, '...') !!}</p>
                                    </div>
                                </article>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-s-blog-post btn-next">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="58px" height="20px" viewBox="0 0 80 20"
                preserveAspectRatio="xMidYMid meet">
                <g fill="#0d401c">
                    <path
                        d="M63 19 c0 -0.5 2.6 -2.4 5.8 -4.2 l5.7 -3.3 -19.5 -0.8 c-11 -0.5 -27.1 -0.5 -37 0.1 -9.6 0.5 -17.7 0.7 -17.9 0.5 -2.4 -1.9 22 -3.5 48.7 -3.1 l25.2 0.3 -4.6 -3.9 c-2.5 -2.1 -4.3 -4 -4 -4.3 0.7 -0.7 14.6 8.9 14.6 10.2 0 1.1 -14.3 9.5 -16.2 9.5 -0.4 0 -0.8 -0.4 -0.8 -1z" />
                </g>
            </svg>
        </div>
        <div class="btn-s-blog-post btn-prev">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="58px" height="20px" viewBox="0 0 80 20"
                preserveAspectRatio="xMidYMid meet">
                <g fill="#0d401c">
                    <path
                        d="M7 15.4 c-3.6 -2.4 -6.6 -5 -6.8 -5.7 -0.2 -1.2 13.8 -9.7 16 -9.7 2.4 0 0.2 2.4 -4.9 5.2 l-5.8 3.3 19.5 0.8 c11 0.5 27.1 0.5 37 -0.1 9.6 -0.5 17.7 -0.7 17.9 -0.5 2.4 1.9 -22 3.5 -48.6 3.1 l-25.2 -0.3 4.7 4.2 c6.1 5.5 4.4 5.3 -3.8 -0.3z" />
                </g>
            </svg>
        </div>
    </div>
</section>
@endif
<!-- Section blog post -->
<!-- Section faq -->
@if(!empty($faqs) && $faqs->isNotEmpty())
<section class="s-faq has-img-item">
    <div class="s-img-item item-1">
        <img src="{{ asset('frontend/assets') }}/images/page-title-top.png" alt="">
    </div>
    <div class="tf-container w-1290">
        <div class="row">
            <div class="col-lg-7">
                <div class="content-section">
                    <div class="heading-section style-2 has-text">
                        <div class="img-item">
                            <p class="sub-title">
                                <i class='bx bxs-leaf'></i>Frequently Asked Questions
                            </p>
                        </div>
                        <p class="title wow fadeInUp" data-wow-delay="0s">
                            Most Frequently Asked Questions
                        </p>
                    </div>
                    <div class="tf-accordion accordion" id="accordionExample">
                        @foreach ( $faqs as $faq )
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">{{$faq->question}}</button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">{{$faq->answer}}</div>
                            </div>
                        </div>

                        @endforeach


                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="s-right img-hover">
                    <div class="image-wrap hover-item">
                        <div class="image">
                            <img src="{{ asset('frontend/assets') }}/images/contact-form.jpg"
                                data-src="{{ asset('frontend/assets') }}/images/contact-form.jpg" alt=""
                                class="lazyload tf-animate-2" />
                        </div>
                    </div>
                    <div class="content">
                        <p class="text fs-30 font-snowfall">
                            You didn't find your question? See
                            more questions and ask us today!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- Section faq -->
<!-- Section meet farmer -->
<section class="s-meet-farmer has-img-item tf-pt-0">
    <div class="content-section">
        <div class="tf-container w-1290">
            <div class="row">
                <div class="col-md-6">
                    <div class="heading-section style-4 has-text style-3">
                        <div class="img-item">
                            <div class="item mr-23">
                                <img src="{{ asset('frontend/assets') }}/images/item/rice-plant-2.png"
                                    class="tf-animate-1" alt="">
                            </div>
                            <p class="sub-title">
                                Meet The Farmer
                            </p>
                        </div>
                        <p class="title text-anime-style-2">
                            We Are Dedicated Farmers!
                        </p>
                        <p class="text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sodales faucibus
                            commodo.
                            Proin vehicula massa id congue rutrum, ex libero sodales ex, cursus euismod purus.
                        </p>
                        <!--<button id="load-more" class="tf-btn btn-loadMore mt-20 scale-40">-->
                        <!--   <span class="text-style">-->
                        <!--   Load More Projects-->
                        <!--   </span>-->
                        <!--   <div class="icon">-->
                        <!--      <i class="icon-arrow_right"></i>-->
                        <!--   </div>-->
                        <!--</button>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="s-img-item item-1">
        <img src="{{ asset('frontend/assets') }}/images/page-title-top.png" alt="" />
    </div>
    <div class="s-img-item item-2">
        <img src="{{ asset('frontend/assets') }}/images/page-title-top.png" alt="" />
    </div>
</section>
<!-- /.Section meet farmer -->
<!-- Section contact us -->

<section class="s-contact-us style-2">
    <div class="section-wrap">
        <div class="tf-container w-1290">
            <div class="row">
                <div class="col-lg-6">
                    <div class="content-section">
                        <div class="heading-section has-text mb-50">
                            <p class="sub-title">Let's Cooperate Together</p>
                            <p class="title tf-animate-1">Contact Us Today!</p>
                            <p class="text">
                                We will reply you within 24 hours via email, thank you for contacting
                            </p>
                        </div>
                        <form id="contactform" method="post" action="contact/contact-process.php"
                            novalidate="novalidate" class="form-send-message style-2">
                            <div class="cols style-2 mb-15">
                                <fieldset>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name*"
                                        aria-required="true" required />
                                </fieldset>
                                <fieldset>
                                    <input type="email" class="form-control email" id="mail" name="mail"
                                        placeholder="Email*" required />
                                </fieldset>
                            </div>
                            <div class="cols style-2 mb-15">
                                <fieldset>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone*"
                                        aria-required="true" required />
                                </fieldset>
                                <fieldset class="dropdown">
                                    <select name="text" class="lt-sp-07" id="Support">
                                        <option value="You need support?" selected="">You need support?
                                        </option>
                                        <option value="You need support? 1">You need support? 1
                                        </option>
                                        <option value="You need support? 2">You need support? 2
                                        </option>
                                        <option value="You need support? 3">You need support? 3
                                        </option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="cols mb-30">
                                <fieldset>
                                    <textarea name="message" id="message" placeholder="Message..."></textarea>
                                </fieldset>
                            </div>
                            <div class="checkbox-item send-wrap">
                                <label class="mb-0">
                                    <span class="text font-nunito">Agree to our terms and
                                        conditions</span>
                                    <input type="checkbox" class="checkbox-item" checked>
                                    <span class="btn-checkbox"></span>
                                </label>
                                <button type="submit" class="tf-btn ">
                                    <span class="text-style">
                                        Send Message
                                    </span>
                                    <span class="icon">
                                        <i class="icon-arrow_right"></i>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @if(!empty($contacts) && $contacts->isNotEmpty())

                <div class="col-lg-6">
                    <div class="content-left">
                        @if ($contacts->first()->map)
                        <div class="box-map style-2">
                            @php
                            $firstMapUrl = $contacts->first()->map ?? '';
                            @endphp

                            <div id="map" class="map">
                                {!!$firstMapUrl!!}
                            </div>
                        </div>
                        @endif
                        <ul class="contact-list overflow-hidden">
                            @foreach ($contacts as $contact)
                            <li class="wow fadeInUp" data-wow-duration="1.4s">
                                <div class="icon style-circle">
                                    <i class='bx bx-building-house'></i>
                                </div>
                                <div class="infor">
                                    <p class="title">
                                        {{$contact->branch}}:
                                    </p>
                                    @if ($contact->email)
                                    <p class="text"><i class='bx bx-mail-send'></i>{{$contact->email}}</p>
                                    @endif
                                    <p class="text"><i class='bx bxs-phone'></i>{{$contact->phone}}</p>
                                    <p class="text"><i class='bx bxs-map'></i>{{$contact->address}}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- /.Section contact us -->
@endsection
