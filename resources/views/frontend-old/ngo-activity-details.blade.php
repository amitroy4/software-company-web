@extends('layouts.frontend')
@section('title','Ngo Activitiy Details')
@section('content')
  <!-- Page-title -->
      <div class="page-title page-portfolio-details  ">
         <div class="rellax" data-rellax-speed="5">
            <img src="{{ asset('frontend') }}/images/width-bg-1.jpg" alt="">
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
                           Activity Detail
                        </h1>
                        <div class="icon-img">
                           <img src="{{ asset('frontend') }}/images/item/line-throw-title.png" alt="">
                        </div>
                        <div class="breadcrumb">
                           <a href="index.html">Home</a>
                           <div class="icon">
                              <i class="icon-arrow-right1"></i>
                           </div>
                           <a href="all-project.html"> NGO Activity</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- /.Page-title -->
      <!-- Main-content -->
      <div class="main-content page-blog-single">
         <div class="blog-single">
            <div class="tf-container w-1290">
               <div class="row">
                  <div class="col-lg-8">
                     <div class="content">
                        <div class="swiper-container slider-service-detail">
                           <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                @if($activity->image)
                                <div class="swiper-slide">
                                <div class="image">
                                    <img src="{{ asset('storage/' . $activity->image) }}"
                                       data-src="{{ asset('storage/' . $activity->image) }}" alt="" class="lazyload">
                                 </div>
                                </div>
                                @endif

                              </div>
                              {{-- <div class="swiper-slide">
                                 <div class="image">
                                    <img src="{{ asset('frontend') }}/images/project-2.jpg"
                                       data-src="{{ asset('frontend') }}/images/project-2.jpg" alt="" class="lazyload">
                                 </div>
                              </div> --}}
                           </div>
                           <div class="btn-service-detail btn-next style-2">
                              <i class="icon-arrow_right"></i>
                           </div>
                           <div class="btn-service-detail btn-prev style-2">
                              <i class="icon-arrow_left"></i>
                           </div>
                        </div>
                        @if($activity->location)
                        <p class="date mt-4 mb-0"><i class='bx bxs-building-house me-3'></i>{{$activity->location}}</p>
                        @endif
                        <h2 class="title fw-7 text-anime-style-1">
                          {{$activity->title}}
                        </h2>
                        <p class="text text-1">{!!$activity->description!!}</p>
                        <div class="blog-bot">
                            @if(!empty($tag))
                            @php
                                // Convert comma-separated tags to an array
                                $tags = explode(',', $activity->tags);
                                // Trim whitespace from each tag
                                $tags = array_map('trim', $tags);
                            @endphp
                           <ul class="tags-list">
                            @foreach($tags as $tag)
                            <li><a href="#">{{ $tag }}</a></li>
                            @endforeach
                           </ul>
                           @endif

                           <div class="share">
                            <div class="icon">
                                <i class="fa-solid fa-share-nodes"></i>
                            </div>
                            <p class="fw-5 font-worksans mr-23">
                                Share:
                            </p>
                            <ul class="social-list style-2">
                                <li class="item">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('ngo-activities.details', $activity->slug)) }}" target="_blank" rel="noopener noreferrer">
                                        <i class="icon-facebook"></i>
                                    </a>
                                </li>
                                <li class="item">
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('ngo-activities.details', $activity->slug)) }}&text={{ urlencode($activity->title) }}" target="_blank" rel="noopener noreferrer">
                                        <i class="icon-twitter"></i>
                                    </a>
                                </li>
                                <li class="item">
                                    <a href="https://web.skype.com/share?url={{ urlencode(route('ngo-activities.details', $activity->slug)) }}&text={{ urlencode($activity->title) }}" target="_blank" rel="noopener noreferrer">
                                        <i class="fa-brands fa-skype"></i>
                                    </a>
                                </li>
                                <li class="item">
                                    <a href="https://t.me/share/url?url={{ urlencode(route('ngo-activities.details', $activity->slug)) }}&text={{ urlencode($activity->title) }}" target="_blank" rel="noopener noreferrer">
                                        <i class="fa-brands fa-telegram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="tf-sidebar">
                        <div class="sidebar-item sb-latest-new">
                           <h5 class="sb-title">
                              Recent Activities
                           </h5>
                           <div class="sb-content">
                              <ul class="latest-list">
                                @foreach ($ngos as $ngo)
                                 <li class="item img-hover">
                                    <div class="image hover-item">
                                       <img src="{{ asset('storage/' . $ngo->image) }}" alt="">
                                    </div>
                                    <div class="content">
                                       <p class="date"><i class='bx bxs-building-house me-3'></i>{{$ngo->title}}</p>
                                       <a class="name-post " href="{{ route('ngo-activities.details', $activity->slug) }}">{{$ngo->location}}</a>
                                    </div>
                                 </li>
                                 @endforeach
                              </ul>
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
