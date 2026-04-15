@extends('layouts.frontend')
@section('title','News')
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
    <!-- Section blog post -->
    <section class="s-blog-post has-img-item">
       <div class="s-img-item item-1">
          <img src="{{ asset('frontend') }}/assets/images/page-title-top2.png" alt="">
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
                         <div class="swiper-slide">
                            <article class="article-blog-item type-3 style-2 img-hover">
                               <div class="image">
                                  <div class="video-wrap hover-item">
                                     <img class="lazyload" data-src="{{ asset('frontend') }}/assets/images/project-1.jpg"
                                        src="{{ asset('frontend') }}/assets/images/project-1.jpg" alt="" />
                                     <a href="https://www.youtube.com/watch?v=MLpWrANjFbI"
                                        class="style-icon-play popup-youtube">
                                     <i class="fa-solid fa-play"></i>
                                     </a>
                                  </div>
                                  <div class="entry-date">
                                     <p class="day">
                                        08
                                     </p>
                                     <p class="month-year">
                                        Jun 24
                                     </p>
                                  </div>
                               </div>
                               <div class="content">
                                  <ul class="entry-meta">
                                     <li class="entry author">
                                        <i class="fa-solid fa-circle-user"></i>
                                        <p>
                                           <a href="#">
                                           By
                                           Hardson
                                           </a>
                                        </p>
                                     </li>
                                     <li class="entry tags">
                                        <i class="fa-solid fa-tag"></i>
                                        <p>
                                           <a href="#">Agriculture</a>,
                                           <a href="#">Farm</a>
                                        </p>
                                     </li>
                                  </ul>
                                  <h3 class="title fw-6">
                                     <a href="news-details.php">
                                     How to Care for
                                     Cows to have the
                                     Best Quality
                                     Meat
                                     </a>
                                  </h3>
                                  <p class="text text-line-clamp-3">
                                     Duis eleifend
                                     euismod arcu, nec
                                     faucibus mauris
                                     finibus id. Integer
                                     mattis, tellus non
                                     finibus rutrum quam
                                     lorem dignissim
                                     nulla.
                                  </p>
                               </div>
                            </article>
                         </div>
                         <div class="swiper-slide">
                            <article class="article-blog-item type-3 style-2 img-hover">
                               <div class="image">
                                  <div class="video-wrap hover-item">
                                     <img class="lazyload" data-src="{{ asset('frontend') }}/assets/images/project-2.jpg"
                                        src="{{ asset('frontend') }}/assets/images/project-2.jpg" alt="" />
                                     <a href="https://www.youtube.com/watch?v=MLpWrANjFbI"
                                        class="style-icon-play popup-youtube">
                                     <i class="fa-solid fa-play"></i>
                                     </a>
                                  </div>
                                  <div class="entry-date">
                                     <p class="day">
                                        08
                                     </p>
                                     <p class="month-year">
                                        Jun 24
                                     </p>
                                  </div>
                               </div>
                               <div class="content">
                                  <ul class="entry-meta">
                                     <li class="entry author">
                                        <i class="fa-solid fa-circle-user"></i>
                                        <p>
                                           <a class="" href="#">
                                           By
                                           Hardson
                                           </a>
                                        </p>
                                     </li>
                                     <li class="entry tags">
                                        <i class="fa-solid fa-tag"></i>
                                        <p>
                                           <a href="#">Agriculture</a>,
                                           <a href="#">Farm</a>
                                        </p>
                                     </li>
                                  </ul>
                                  <h3 class="title fw-6">
                                     <a href="news-details.php">
                                     The Best Time to Harvest <br>
                                     Corn Without Wilting
                                     </a>
                                  </h3>
                                  <p class="text text-line-clamp-3">
                                     Duis eleifend
                                     euismod arcu, nec
                                     faucibus mauris
                                     finibus id. Integer
                                     mattis, tellus non
                                     finibus rutrum quam
                                     lorem dignissim
                                     nulla.
                                  </p>
                               </div>
                            </article>
                         </div>
                         <div class="swiper-slide">
                            <article class="article-blog-item type-3 style-2 img-hover">
                               <div class="image">
                                  <div class="video-wrap hover-item">
                                     <img class="lazyload" data-src="{{ asset('frontend') }}/assets/images/project-3.jpg"
                                        src="{{ asset('frontend') }}/assets/images/project-3.jpg" alt="" />
                                     <a href="https://www.youtube.com/watch?v=MLpWrANjFbI"
                                        class="style-icon-play popup-youtube">
                                     <i class="fa-solid fa-play"></i>
                                     </a>
                                  </div>
                                  <div class="entry-date">
                                     <p class="day">
                                        08
                                     </p>
                                     <p class="month-year">
                                        Jun 24
                                     </p>
                                  </div>
                               </div>
                               <div class="content">
                                  <ul class="entry-meta">
                                     <li class="entry author">
                                        <i class="fa-solid fa-circle-user"></i>
                                        <p>
                                           <a class="" href="#">
                                           By
                                           Hardson
                                           </a>
                                        </p>
                                     </li>
                                     <li class="entry tags">
                                        <i class="fa-solid fa-tag"></i>
                                        <p>
                                           <a href="#">Agriculture</a>,
                                           <a href="#">Farm</a>
                                        </p>
                                     </li>
                                  </ul>
                                  <h3 class="title fw-6">
                                     <a href="news-details.php">
                                     The Joy of Working Every Day <br> on a Sheep Farm
                                     </a>
                                  </h3>
                                  <p class="text text-line-clamp-3">
                                     Duis eleifend
                                     euismod arcu, nec
                                     faucibus mauris
                                     finibus id. Integer
                                     mattis, tellus non
                                     finibus rutrum quam
                                     lorem dignissim
                                     nulla.
                                  </p>
                               </div>
                            </article>
                         </div>
                         <div class="swiper-slide">
                            <article class="article-blog-item type-3 style-2 img-hover">
                               <div class="image">
                                  <div class="video-wrap hover-item">
                                     <img class="lazyload" data-src="{{ asset('frontend') }}/assets/images/project-4.jpg"
                                        src="{{ asset('frontend') }}/assets/images/project-4.jpg" alt="" />
                                     <a href="https://www.youtube.com/watch?v=MLpWrANjFbI"
                                        class="style-icon-play popup-youtube">
                                     <i class="fa-solid fa-play"></i>
                                     </a>
                                  </div>
                                  <div class="entry-date">
                                     <p class="day">
                                        08
                                     </p>
                                     <p class="month-year">
                                        Jun 24
                                     </p>
                                  </div>
                               </div>
                               <div class="content">
                                  <ul class="entry-meta">
                                     <li class="entry author">
                                        <i class="fa-solid fa-circle-user"></i>
                                        <p>
                                           <a class="" href="#">
                                           By
                                           Hardson
                                           </a>
                                        </p>
                                     </li>
                                     <li class="entry tags">
                                        <i class="fa-solid fa-tag"></i>
                                        <p>
                                           <a href="#">Agriculture</a>,
                                           <a href="#">Farm</a>
                                        </p>
                                     </li>
                                  </ul>
                                  <h3 class="title fw-6">
                                     <a href="news-details.php">
                                     The Joy of Working Every Day <br> on a Sheep Farm
                                     </a>
                                  </h3>
                                  <p class="text text-line-clamp-3">
                                     Duis eleifend
                                     euismod arcu, nec
                                     faucibus mauris
                                     finibus id. Integer
                                     mattis, tellus non
                                     finibus rutrum quam
                                     lorem dignissim
                                     nulla.
                                  </p>
                               </div>
                            </article>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <div class="btn-s-blog-post btn-next">
             <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="58px" height="20px"
                viewBox="0 0 80 20" preserveAspectRatio="xMidYMid meet">
                <g fill="#0d401c">
                   <path
                      d="M63 19 c0 -0.5 2.6 -2.4 5.8 -4.2 l5.7 -3.3 -19.5 -0.8 c-11 -0.5 -27.1 -0.5 -37 0.1 -9.6 0.5 -17.7 0.7 -17.9 0.5 -2.4 -1.9 22 -3.5 48.7 -3.1 l25.2 0.3 -4.6 -3.9 c-2.5 -2.1 -4.3 -4 -4 -4.3 0.7 -0.7 14.6 8.9 14.6 10.2 0 1.1 -14.3 9.5 -16.2 9.5 -0.4 0 -0.8 -0.4 -0.8 -1z" />
                </g>
             </svg>
          </div>
          <div class="btn-s-blog-post btn-prev">
             <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="58px" height="20px"
                viewBox="0 0 80 20" preserveAspectRatio="xMidYMid meet">
                <g fill="#0d401c">
                   <path
                      d="M7 15.4 c-3.6 -2.4 -6.6 -5 -6.8 -5.7 -0.2 -1.2 13.8 -9.7 16 -9.7 2.4 0 0.2 2.4 -4.9 5.2 l-5.8 3.3 19.5 0.8 c11 0.5 27.1 0.5 37 -0.1 9.6 -0.5 17.7 -0.7 17.9 -0.5 2.4 1.9 -22 3.5 -48.6 3.1 l-25.2 -0.3 4.7 4.2 c6.1 5.5 4.4 5.3 -3.8 -0.3z" />
                </g>
             </svg>
          </div>
       </div>
    </section>
    <!-- Section blog post -->
@endsection
