@extends('layouts.frontend')
@section('title','All Properties')
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
                      portfolio detail
                   </h1>
                   <div class="icon-img">
                      <img src="{{ asset('frontend') }}/assets/images/item/line-throw-title.png" alt="">
                   </div>
                   <div class="breadcrumb">
                      <a href="index.php">Home</a>
                      <div class="icon">
                         <i class="icon-arrow-right1"></i>
                      </div>
                      <a href="all-project.php"> Grow Up Projects</a>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 <!-- /.Page-title -->
 <!-- Our Properties -->
 <div class="main-content page-portfolio-1 flat-portfolio">
    <div class="tf-container">
       <div class="row">
          <div class="col-lg-12">
             <div class="heading-section has-text text-center">
                <div class="img-item">
                   <p class="sub-title">
                      <i class='bx bxs-leaf'></i> GrowUp Agrotech
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
                            <img src="{{ asset('frontend') }}/assets/images/House-1.jpg"
                               data-src="{{ asset('frontend') }}/assets/images/House-1.jpg" alt=""
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
                            <img src="{{ asset('frontend') }}/assets/images/House-1.jpg"
                               data-src="{{ asset('frontend') }}/assets/images/House-1.jpg" alt="" class=" lazyload">
                         </div>
                         <div class="content">
                            <p class="sub font-farmhouse text-upper">Bashundhara</p>
                            <a href="property-details.php" class="title fs-23 font-worksans fw-6 hover-text-secondary">Silver Package</a>
                         </div>
                      </div>
                   </li>
                   <li class="item haau cox">
                      <div class="box-portfolio ">
                         <div class="image">
                            <img src="{{ asset('frontend') }}/assets/images/House-1.jpg"
                               data-src="{{ asset('frontend') }}/assets/images/House-1.jpg" alt="" class=" lazyload">
                         </div>
                         <div class="content">
                            <p class="sub font-farmhouse text-upper">RS Tower</p>
                            <a href="property-details.php" class="title fs-23 font-worksans fw-6 hover-text-secondary">Gold Package</a>
                         </div>
                      </div>
                   </li>
                   <li class="item cox haau rs">
                      <div class="box-portfolio ">
                         <div class="image">
                            <img src="{{ asset('frontend') }}/assets/images/House-1.jpg"
                               data-src="{{ asset('frontend') }}/assets/images/House-1.jpg" alt="" class=" lazyload">
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
                            <img src="{{ asset('frontend') }}/assets/images/House-1.jpg"
                               data-src="{{ asset('frontend') }}/assets/images/House-1.jpg" alt="" class=" lazyload">
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
                            <img src="{{ asset('frontend') }}/assets/images/House-1.jpg"
                               data-src="{{ asset('frontend') }}/assets/images/House-1.jpg" alt="" class=" lazyload">
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
@endsection
