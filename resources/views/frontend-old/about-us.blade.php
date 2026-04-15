@extends('layouts.frontend')
@section('title','About Us')
@section('content')
<!-- Page-title -->
<div class="page-title page-about-us">
    <div class="rellax" data-rellax-speed="5">
        <img src="{{ asset('frontend') }}/assets/images/width-bg-1.jpg" alt="">
    </div>
    <div class="content-wrap">
        <div class="tf-container w-1290">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content">
                        <p class="sub-title">
                            Nurturing the Earth, Feeding the World
                        </p>
                        <h1 class="title">
                            About the Farm
                        </h1>
                        <div class="icon-img">
                            <img src="{{ asset('frontend') }}/assets/images/item/line-throw-title.png" alt="">
                        </div>
                        <div class="breadcrumb">
                            <a href="index.html">Home</a>
                            <div class="icon">
                                <i class="icon-arrow-right1"></i>
                            </div>
                            <a href="javascript:void(0)">About Us </a>
                            <div class="icon">
                                <i class="icon-arrow-right1"></i>
                            </div>
                            <a href="javascript:void(0)">About The Farm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="img-item item-2">
        <img src="{{ asset('frontend') }}/assets/images/item/grass.png" alt="">
    </div>
</div>
<!-- /.Page-title -->
<!-- Main-content -->
<div class="main-content pb-0 pt-0">
    <!-- Section our history -->
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
                            <p class="text">{!! Str::limit($about->description, 500, '...') !!}</p>
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
            <img src="{{ asset('frontend') }}/assets/images/item/brown-top.png" alt="">
        </div>
        <div class="s-img-item item-bottom">
            <img src="{{ asset('frontend') }}/assets/images/item/brown-bottom.png" alt="">
        </div>
        <div class="s-img-item item-3 wow zoomIn">
            <div class="scroll-element-3">
                <img src="{{ asset('frontend') }}/assets/images/item/windmill-2.png" alt="">
            </div>
        </div>
    </section>
    <!-- /.Section our history -->
    <!-- Section farmer tour -->
    <section class="s-farm-tour">
        <div class="tf-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="tf-container w-1780">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="solution">
                                    <div class="wg-tabs style-5">
                                        <ul class="overflow-x-auto menu-tab">
                                            <li class="item active"><a href="javascript:void(0)"
                                                    class="btn-tab">Mission</a>
                                            </li>
                                            <li class="item"><a href="javascript:void(0)" class="btn-tab">Vision</a>
                                            </li>
                                            <li class="item"><a href="javascript:void(0)" class="btn-tab">Our Goal</a>
                                            </li>
                                        </ul>
                                        <div class="widget-content-tab">
                                            <div class="widget-content-inner active" style="">
                                                <p>Growup's mission is to bridge the resource and knowledge gaps in
                                                    agriculture by providing affordable technology,
                                                    quality inputs, and modern agricultural expertise. Through strategic
                                                    partnerships, streamlined supply chains, and a
                                                    consumer-centric approach, Growup is dedicated to driving
                                                    significant reforms in the agricultural industry, ensuring
                                                    a sustainable future for all involved.
                                                </p>
                                            </div>
                                            <div class="widget-content-inner" style="display: none;">
                                                <p>Growup's mission is to bridge the resource and knowledge gaps in
                                                    agriculture by providing affordable technology,
                                                    quality inputs, and modern agricultural expertise. Through strategic
                                                    partnerships, streamlined supply chains, and a
                                                    consumer-centric approach, Growup is dedicated to driving
                                                    significant reforms in the agricultural industry, ensuring
                                                    a sustainable future for all involved.
                                                </p>
                                            </div>
                                            <div class="widget-content-inner" style="display: none;">
                                                <p>Growup aims to revolutionize the agricultural sector by empowering
                                                    farmers and stakeholders with the necessary resources,
                                                    technology, and knowledge to improve their livelihoods and
                                                    productivity. The organization is committed to creating a
                                                    sustainable and equitable agricultural ecosystem that benefits all
                                                    stakeholders, from farmers to consumers.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.Section farmer tour -->
    <!-- Section partner -->
    <section class="s-partner style-2 has-img-item pb-71">
        <div class="tf-container w-1780">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider-wrap">
                        <div class="swiper-container slider-partner">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="slide-partner">
                                        <div class="image">
                                            <a href="#">
                                                <img src="{{ asset('frontend') }}/assets/images/partner/wide-open.png"
                                                    alt="" class="lazyload">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slide-partner">
                                        <div class="image">
                                            <a href="#">
                                                <img src="{{ asset('frontend') }}/assets/images/partner/sollio.png"
                                                    alt="" class="lazyload">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slide-partner">
                                        <div class="image">
                                            <a href="#">
                                                <img src="{{ asset('frontend') }}/assets/images/partner/syngenta.png"
                                                    alt="" class="lazyload">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slide-partner">
                                        <div class="image">
                                            <a href="#">
                                                <img src="{{ asset('frontend') }}/assets/images/partner/strachan-valley.png"
                                                    alt="" class="lazyload">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slide-partner">
                                        <div class="image">
                                            <a href="#">
                                                <img src="{{ asset('frontend') }}/assets/images/partner/new-holland.png"
                                                    alt="" class="lazyload">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slide-partner">
                                        <div class="image">
                                            <a href="#">
                                                <img src="{{ asset('frontend') }}/assets/images/partner/stony-field.png"
                                                    alt="" class="lazyload">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="s-img-item item-1">
            <img src="{{ asset('frontend') }}/assets/images/item/page-title-top.png" alt="" />
        </div>
    </section>
    <!-- /.Section partner -->
    <!-- Section history -->
    <section class="s-history has-img-item tf-pt-0">
        <div class="tf-container w-1290">
            <div class="heading-section text-center has-text has-img-item  mt-0">
                <p class="sub-title">GrowUp Agro
                </p>
                <p class="title text-anime-style-1 overflow-hidden">Company History</p>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-history">
                        <span class="line"></span>
                        <div class="wg-history mb-50 type-left">
                            <div class="image hover-item hover14">
                                <img src="{{ asset('frontend') }}/assets/images/project-2.jpg"
                                    data-src="{{ asset('frontend') }}/assets/images/project-2.jpg" alt=""
                                    class="lazyload">
                            </div>
                            <div class="year">
                                <p class="number font-snowfall fs-30">
                                    1992
                                </p>
                            </div>
                            <div class="content">
                                <h3 class="title fw-6 font-worksans">
                                    The Inception of ROSA NGO
                                </h3>
                                <p class="text font-nunito">
                                    The seeds of Growup's vision were sown with the establishment of ROSA NGO in 1992.
                                    Dedicated to improving the lives of marginalized communities, ROSA embarked on
                                    numerous social initiatives, laying the foundation for what would become Growup.
                                    ROSA's commitment to social welfare and sustainable development inspired a focus on
                                    agriculture, recognizing its critical role in community empowerment.
                                </p>
                            </div>
                        </div>
                        <div class="wg-history mb-50 type-right img-hover  tf-img-hover">
                            <div class="content text-right">
                                <h3 class="title fw-6 font-worksans">
                                    Recognizing the Agricultural Challenge
                                </h3>
                                <p class="text font-nunito ">
                                    As ROSA expanded its outreach, it became increasingly clear that the agricultural
                                    sector faced significant challenges. Small-scale and marginalized farmers struggled
                                    with limited access to resources, modern technology, and market information.
                                    Recognizing these issues, ROSA began exploring ways to support farmers more
                                    effectively, setting the stage for a specialized initiative focused on agriculture.
                                </p>
                            </div>
                            <div class="year">
                                <p class="number font-snowfall fs-30">
                                    2010
                                </p>
                            </div>
                            <div class="image hover-item hover14">
                                <img src="{{ asset('frontend') }}/assets/images/project-2.jpg"
                                    data-src="{{ asset('frontend') }}/assets/images/project-2.jpg" alt=""
                                    class="lazyload">
                            </div>
                        </div>
                        <div class="wg-history mb-50 type-left img-hover tf-img-hover">
                            <div class="image hover-item hover14">
                                <img src="{{ asset('frontend') }}/assets/images/project-2.jpg"
                                    data-src="{{ asset('frontend') }}/assets/images/project-2.jpg" alt=""
                                    class="lazyload">
                            </div>
                            <div class="year ">
                                <p class="number font-snowfall fs-30">
                                    2015
                                </p>
                            </div>
                            <div class="content">
                                <h3 class="title fw-6 font-worksans">
                                    Conceptualization of Growup
                                </h3>
                                <p class="text font-nunito ">
                                    The idea of Growup began to take shape in 2015. Driven by a mission to empower
                                    farmers and enhance agricultural practices,
                                    ROSA's leadership team envisioned a dedicated organization that would leverage
                                    technology and modern agricultural techniques
                                    to support farmers. This vision was centered around making essential resources
                                    affordable and accessible, thereby promoting
                                    sustainable farming practices.
                                </p>
                            </div>
                        </div>
                        <div class="wg-history mb-50 type-right img-hover tf-img-hover">
                            <div class="content text-right">
                                <h3 class="title fw-6 font-worksans">
                                    Townline Farms Serving Veggies
                                </h3>
                                <p class="text font-nunito ">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacus odio,
                                    egestas vitae augue sed, vulputate viverra
                                    velit. Quisque fringilla viverra turpis, at condimentum arcu convallis sit
                                    amet. Class aptent taciti sociosqu ad litora
                                    torquent per conubia nostra, per inceptos himenaeos.
                                </p>
                            </div>
                            <div class="year">
                                <p class="number font-snowfall fs-30">
                                    1965
                                </p>
                            </div>
                            <div class="image hover-item hover14">
                                <img src="{{ asset('frontend') }}/assets/images/images/project-2.jpg"
                                    data-src="{{ asset('frontend') }}/assets/images/project-2.jpg" alt=""
                                    class="lazyload">
                            </div>
                        </div>
                        <div class="wg-history mb-50 type-left img-hover tf-img-hover">
                            <div class="image hover-item hover14">
                                <img src="{{ asset('frontend') }}/assets/images/project-2.jpg"
                                    data-src="{{ asset('frontend') }}/assets/images/project-2.jpg" alt=""
                                    class="lazyload">
                            </div>
                            <div class="year ">
                                <p class="number font-snowfall fs-30">
                                    2015
                                </p>
                            </div>
                            <div class="content">
                                <h3 class="title fw-6 font-worksans">
                                    Conceptualization of Growup
                                </h3>
                                <p class="text font-nunito ">
                                    The idea of Growup began to take shape in 2015. Driven by a mission to empower
                                    farmers and enhance agricultural practices,
                                    ROSA's leadership team envisioned a dedicated organization that would leverage
                                    technology and modern agricultural techniques
                                    to support farmers. This vision was centered around making essential resources
                                    affordable and accessible, thereby promoting
                                    sustainable farming practices.
                                </p>
                            </div>
                        </div>
                        <div class="wg-history mb-50 type-right img-hover tf-img-hover">
                            <div class="content text-right">
                                <h3 class="title fw-6 font-worksans">
                                    Townline Farms Serving Veggies
                                </h3>
                                <p class="text font-nunito ">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacus odio,
                                    egestas vitae augue sed, vulputate viverra
                                    velit. Quisque fringilla viverra turpis, at condimentum arcu convallis sit
                                    amet. Class aptent taciti sociosqu ad litora
                                    torquent per conubia nostra, per inceptos himenaeos.
                                </p>
                            </div>
                            <div class="year">
                                <p class="number font-snowfall fs-30">
                                    1965
                                </p>
                            </div>
                            <div class="image hover-item hover14">
                                <img src="{{ asset('frontend') }}/assets/images/images/project-2.jpg"
                                    data-src="{{ asset('frontend') }}/assets/images/project-2.jpg" alt=""
                                    class="lazyload">
                            </div>
                        </div>
                        <div class="wg-history mb-50 type-left img-hover tf-img-hover">
                            <div class="image hover-item hover14">
                                <img src="{{ asset('frontend') }}/assets/images/project-2.jpg"
                                    data-src="{{ asset('frontend') }}/assets/images/project-2.jpg" alt=""
                                    class="lazyload">
                            </div>
                            <div class="year ">
                                <p class="number font-snowfall fs-30">
                                    2015
                                </p>
                            </div>
                            <div class="content">
                                <h3 class="title fw-6 font-worksans">
                                    Conceptualization of Growup
                                </h3>
                                <p class="text font-nunito ">
                                    The idea of Growup began to take shape in 2015. Driven by a mission to empower
                                    farmers and enhance agricultural practices,
                                    ROSA's leadership team envisioned a dedicated organization that would leverage
                                    technology and modern agricultural techniques
                                    to support farmers. This vision was centered around making essential resources
                                    affordable and accessible, thereby promoting
                                    sustainable farming practices.
                                </p>
                            </div>
                        </div>
                        <div class="wg-history mb-50 type-right img-hover tf-img-hover">
                            <div class="content text-right">
                                <h3 class="title fw-6 font-worksans">
                                    Townline Farms Serving Veggies
                                </h3>
                                <p class="text font-nunito ">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacus odio,
                                    egestas vitae augue sed, vulputate viverra
                                    velit. Quisque fringilla viverra turpis, at condimentum arcu convallis sit
                                    amet. Class aptent taciti sociosqu ad litora
                                    torquent per conubia nostra, per inceptos himenaeos.
                                </p>
                            </div>
                            <div class="year">
                                <p class="number font-snowfall fs-30">
                                    1965
                                </p>
                            </div>
                            <div class="image hover-item hover14">
                                <img src="{{ asset('frontend') }}/assets/images/images/project-2.jpg"
                                    data-src="{{ asset('frontend') }}/assets/images/project-2.jpg" alt=""
                                    class="lazyload">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="s-img-item item-1">
            <img src="{{ asset('frontend') }}/assets/images/item/page-title-top.png" alt="">
        </div>
    </section>

</div>
<!-- /.Main-content -->
@endsection
