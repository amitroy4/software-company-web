@extends('layouts.frontend')
@section('title','Ngo Activities')
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
 <!-- NGO Activities -->
 <section class="s-box-portfolio properties-section has-img-item">
    <div class="s-img-item item-1">
       <img src="{{ asset('frontend') }}/assets/images/page-title-top.png" alt="">
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
 <!-- NGO Activities -->
 @endsection
