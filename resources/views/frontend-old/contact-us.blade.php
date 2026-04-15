@extends('layouts.frontend')
@section('title','Contact Us')
@section('content')
<!-- Page-title -->
<div class="page-title page-portfolio-details  ">
    <div class="rellax" data-rellax-speed="5">
        <img src="{{ asset('frontend') }}/assets/images/width-bg-1.jpg" alt="">
    </div>
    <div class="content-wrap">
        <div class="tf-container w-1290">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content">
                        <p class="sub-title">
                            See Outstanding Projects We Have Implemented
                        </p>
                        <h1 class="title">
                            Contact Us
                        </h1>
                        <div class="icon-img">
                            <img src="{{ asset('frontend') }}/assets/images/item/line-throw-title.png" alt="">
                        </div>
                        <div class="breadcrumb">
                            <a href="index.html">Home</a>
                            <div class="icon">
                                <i class="icon-arrow-right1"></i>
                            </div>
                            <a href="all-project.html"> Grow Up Projects</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.Page-title -->
@if(!empty($contacts) && $contacts->isNotEmpty())

<section class="s-our-agriculture">
    <div class="tf-container w-1290">
        <div class="row">
            @foreach ($contacts as $contact)
            <div class="col-md-4">
                <div class="wrap">
                    <div class="box-event style-2 ic-hover wow fadeInUp" data-wow-delay="0.1s">
                        <div class="content hover-icon-2">
                            <div class="icon">
                                <i class='bx bxs-business'></i>
                            </div>
                            <p class="sub font-snowfall">{{$contact->branch}}:</p>
                            <ul>
                                @if ($contact->email)
                                <li class="d-flex align-items-center justify-content-center mb-3">
                                    <i class='bx bx-mail-send'></i>
                                    <a href="#" class="contact-link">{{$contact->email}}</a>
                                </li>
                                @endif
                                @if ($contact->phone)
                                <li class="d-flex align-items-center justify-content-space-betwen mb-3">
                                    <div class="me-5">
                                        <i class='bx bxs-phone'></i>
                                        <a href="#" class="contact-link">{{$contact->phone}}</a>
                                    </div>
                                    <div class="">
                                        <i class='bx bxl-whatsapp'></i>
                                        <a href="#" class="contact-link">{{$contact->whatsapp}}</a>
                                    </div>
                                </li>
                                @endif
                                @if ($contact->address)
                                <li class="d-flex align-items-center justify-content-center mb-0">
                                    <i class='bx bxs-map'></i>
                                    <a href="#" class="contact-link">{{$contact->address}}</a>
                                </li>
                                @endif



                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endif
<section class="s-contact-us has-img-item">
    <div class="section-wrap">
        <div class="tf-container w-1290">
            <div class="row">
                <div class="col-lg-9 m-auto">
                    <div class="content-section">
                        <div class="heading-section mb-50 style-3 has-text text-center">
                            <p class="sub-title">Let's Cooperate Together</p>
                            <p class="title tf-animate-1 transition-1s active-animate">
                                Contact Us Today!
                            </p>
                            <p class="text">
                                We will reply you within 24 hours via email, thank you for contacting
                            </p>
                            <div class="img-item">
                                <img class="tf-animate-1 active-animate"
                                    src="{{ asset('frontend') }}/assets/images/item/rice-plant-2.png" alt="">
                            </div>
                        </div>
                        <form id="contactform" method="post" action="contact/contact-process.php"
                            novalidate="novalidate" class="form-send-message">
                            <div class="cols style-2 mb-15">
                                <fieldset>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name*"
                                        aria-required="true" required="">
                                </fieldset>
                                <fieldset>
                                    <input type="email" class="form-control email" id="mail" name="mail"
                                        placeholder="Email*" required="">
                                </fieldset>
                            </div>
                            <div class="cols style-2 mb-15">
                                <fieldset>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone*"
                                        aria-required="true" required="">
                                </fieldset>
                                <fieldset class="dropdown">
                                    <select name="text" id="Support">
                                        <option value="You need support?" selected="">You need suport?
                                        </option>
                                        <option value="You need support? 1">You need suport? 1
                                        </option>
                                        <option value="You need support? 2">You need suport? 2
                                        </option>
                                        <option value="You need support? 3">You need suport? 3
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
                                    <input type="checkbox" class="checkbox-item" checked="">
                                    <span class="btn-checkbox"></span>
                                </label>
                                <button type="submit" class="tf-btn gap-30">
                                    <span class="text-style cl-primary text-dark">
                                        Send Message
                                    </span>
                                    <span class="icon">
                                        <i class="icon-arrow_right"></i>
                                    </span>
                                </button>
                            </div>
                        </form>
                        <div class="img-item item-1 up-down-move">
                            <img src="{{ asset('frontend') }}/assets/images/item/corn-3.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section map -->
<div class="box-map">
    @php
    $firstMapUrl = $contacts->first()->map ?? '';
    @endphp
    @if ($contacts->first()->map)
    <div id="map" class="map">
        {!!$firstMapUrl!!}
    </div>
    @endif

</div>
<!-- Section map -->
@endsection
