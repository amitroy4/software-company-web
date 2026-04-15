@extends('layouts.frontend')
@section('title','All Package')
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
 <!-- Main-content -->
 <div class="main-content page-portfolio-1 flat-portfolio">
    <div class="tf-container">
       <div class="row">
          <div class="col-lg-12">
             <div class="heading-section has-text text-center mb-2">
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
          <div class="col-lg-12">
             <div class="col-lg-12 mb-40">
                <div class="wg-tabs style-2">
                   <ul class="menu-tab portfolio-filter mb-4 mt-0">
                      <li class="item active">
                         <a href="#" class="btn-tab active" data-filter="*"> All Projects</a>
                      </li>
                      <li class="item"><a href="#" class="btn-tab" data-filter=".rs">Short Term</a></li>
                      <li class="item"><a href="#" class="btn-tab" data-filter=".bashu">Long Term</a></li>
                      <li class="item"><a href="#" class="btn-tab" data-filter=".cox">Shariah</a></li>
                   </ul>
                   <div class="wg-tabs">
                      <ul class=" portfolio-wrap grid-isotope-3">
                         <li class="grid-sizer"></li>
                         <li class="item cox bashu">
                            <div class="box-portfolio style-3 ">
                               <div class="image hover-item">
                                  <img src="{{ asset('frontend') }}/assets/images/rtg-2.jpg"
                                     data-src="{{ asset('frontend') }}/assets/images/rtg-2.jpg" alt="" class=" lazyload">
                                  <div class="content">
                                     <a href="project-details.php"
                                        class="title fs-23 font-worksans fw-6 hover-text-secondary">Cultivated Crop Land Mango-2</a>
                                  </div>
                               </div>
                               <div class="content-2">
                                  <div class="subtotal d-flex justify-content-between align-items-center  border-bottom pb-1">
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
                                  <div class="subtotal d-flex justify-content-between align-items-center pt-1 pb-1 border-bottom">
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
                               <div class="project-button-box mb-0 pb-0 d-flex justify-content-between align-items-center">
                                  <a href="project-details.php" class="project-button-1">See Details</a>
                                  <a href="project-invest.php" class="project-button-2">Invest Now</a>
                               </div>
                            </div>
                         </li>
                         <li class="item cox haau rs">
                            <div class="box-portfolio style-3 ">
                               <div class="image hover-item">
                                  <img src="{{ asset('frontend') }}/assets/images/rtg-2.jpg"
                                     data-src="{{ asset('frontend') }}/assets/images/rtg-2.jpg" alt="" class=" lazyload">
                                  <div class="content">
                                     <a href="project-details.php"
                                        class="title fs-23 font-worksans fw-6 hover-text-secondary">Cultivated Crop Land Mango-2</a>
                                  </div>
                               </div>
                               <div class="content-2">
                                  <div class="subtotal d-flex justify-content-between align-items-center  border-bottom pb-1">
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
                                  <div class="subtotal d-flex justify-content-between align-items-center pt-1 pb-1 border-bottom">
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
                               <div class="project-button-box mb-0 pb-0 d-flex justify-content-between align-items-center">
                                  <a href="project-details.php" class="project-button-1">See Details</a>
                                  <a href="project-invest.php" class="project-button-2">Invest Now</a>
                               </div>
                            </div>
                         </li>
                         <li class="item haau cox">
                            <div class="box-portfolio style-3 ">
                               <div class="image hover-item">
                                  <img src="{{ asset('frontend') }}/assets/images/rtg-2.jpg"
                                     data-src="{{ asset('frontend') }}/assets/images/rtg-2.jpg" alt="" class=" lazyload">
                                  <div class="content">
                                     <a href="project-details.php"
                                        class="title fs-23 font-worksans fw-6 hover-text-secondary">Cultivated Crop Land Mango-2</a>
                                  </div>
                               </div>
                               <div class="content-2">
                                  <div class="subtotal d-flex justify-content-between align-items-center  border-bottom pb-1">
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
                                  <div class="subtotal d-flex justify-content-between align-items-center pt-1 pb-1 border-bottom">
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
                               <div class="project-button-box mb-0 pb-0 d-flex justify-content-between align-items-center">
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
       </div>
    </div>
 </div>
 <!-- /.Main-content -->
@endsection
