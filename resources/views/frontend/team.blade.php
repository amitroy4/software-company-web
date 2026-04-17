@extends('layouts.frontend')
@section('title','Team')
@php($teamCount = ($managements?->count() ?? 0) + ($members?->count() ?? 0))
@section('meta_title', 'Powerhouse Team')
@section('meta_description', 'Meet the InfyraSoft powerhouse team of ' . $teamCount . '+ professionals delivering software, product, and digital innovation solutions.')
@section('meta_keywords', 'InfyraSoft team, software team, management team, developers, designers')
@section('content')
<!-- /.page-header -->
<section class="hero aos-init aos-animate" data-aos="fade">
   <div class="hero-bg">
        @foreach($allCoverImages as $coverImage)
            @if ($coverImage->page_name == 'explore_qBit_tech')
                <img src="{{ asset('storage/' . $coverImage->cover_image) }}" alt="Contact InfyraSoft">
            @endif
        @endforeach
   </div>
   <div class="bg-content container">
       <div class="hero-page-title">
          <span class="hero-sub-title">Know About</span>
            <h1 class="page-header__title">
            OUR TEAM MEMBER
            </h1>
      </div>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home.page') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Our Team</li>
         </ol>
      </nav>
   </div>
</section>
<!-- /.page-header -->
<!-- /.team-two -->
<section class="team-two" style="background-image: url({{ asset('frontend') }}/assets/images/team-2-bg.png);">
   <div class="container">
      <div class="sec-title-four text-center">
         <h6 class="sec-title-three__tagline"><span class="sec-title-three__tagline__left-border"></span>OUR TEAM MEMBER<span class="sec-title-three__tagline__right-border"></span></h6>
         <!-- /.sec-title-four__tagline -->
         <h3 class="sec-title-two__title"><span>Management</span> Body</h3>
         <!-- /.sec-title-four__title -->
      </div>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-4 mt-4 d-flex justify-content-center">
        @foreach ($managements as $management)
        <div class="col pt-4">
            <div class="team-card-four wow fadeInUp animated animated" data-wow-duration="1500ms" data-wow-delay="00ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
               <div class="team-card-four__image" style="height: 262px !important">
                @if ($management->image)
                <img src="{{ asset('storage/'.$management->image)}}" alt="Donald Martinez"  style="height: 100% !important; object-fit: cover">
                @else
                <img src="{{ asset('frontend') }}/assets/images/member-1.jpg" alt="Donald Martinez"  style="height: 100% !important; object-fit: cover">
                @endif
                  <div class="team-card-four__social">
                    @if ($management->whatsapp)
                    <a href="https://wa.me/{{ $management->whatsapp }}" target="_blank">
                    <i class="fab fa-whatsapp" aria-hidden="true"></i>
                    <span class="sr-only">WhatsApp</span>
                   </a>
                    @endif
                    @if ($management->facebook)
                    <a href="{{ $management->facebook}}" target="_blank">
                    <i class="fab fa-facebook-f" aria-hidden="true"></i>
                    <span class="sr-only">Facebook</span>
                    </a>
                    @endif
                    @if ($management->linkedin)
                    <a href="{{ $management->linkedin}}" target="_blank">
                    <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                    <span class="sr-only">LinkedIn</span>
                    </a>
                    @endif
                    @if ($management->github)
                    <a href="{{ $management->github}}" target="_blank">
                    <i class="fab fa-github" aria-hidden="true"></i>
                    <span class="sr-only">GitHub</span>
                    </a>
                    @endif

                  </div>
                  <!-- /.team-card-four__social -->
               </div>
               <!-- /.team-card-four__image -->
               <div class="team-card-four__content">
                  <h3 class="team-card-four__title">
                     <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $management->id }}">{{ $management->name??'' }}</a>
                  </h3>
                  <!-- /.team-card-four__title -->
                  <p class="team-card-four__designation">{{ $management->designation??'' }}</p>
                  <!-- /.team-card-four__designation -->
               </div>
               <!-- /.team-card-four__content -->
            </div>
         </div>
        @endforeach
      </div>

      @foreach ($managements as $management)
      <!--MODAL-->
      <div class="modal fade" id="staticBackdrop-{{ $management->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <div class="team-details__inner">
                     <div class="row">
                        <div class="col-lg-4">
                           <div class="team-details-image">
                            @if ($management->image)
                            <img src="{{ asset('storage/'.$management->image)}}" alt="tolak">
                            @else
                            <img src="{{ asset('frontend') }}/assets/images/member-1.jpg" alt="tolak">
                            @endif
                           </div>
                        </div>
                        <div class="col-lg-8">
                           <div class="team-details__content">
                              <h3 class="team-card-four__title">
                                 <a href="javascript:void(0)">{{ $management->name??'' }}</a>
                              </h3>
                              <p class="team-card-four__designation">{{ $management->designation??'' }}</p>
                              <p class="team-details__text">
                                 {{ $management->about??'' }}
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--MODAL-->
      @endforeach
   </div>
   <!-- /.container -->
</section>
<!-- /.team-two -->
<!--/.team-two -->
<section class="team-two" style="background-image: url({{ asset('frontend') }}/assets/images/shapes/team-2-bg.png);">
   <div class="container">
      <div class="sec-title-four text-center">
         <h6 class="sec-title-three__tagline"><span class="sec-title-three__tagline__left-border"></span>OUR TEAM MEMBER<span class="sec-title-three__tagline__right-border"></span></h6>
         <!--/.sec-title-four__tagline -->
         <h3 class="sec-title-two__title"><span>Powerfull </span>Team</h3>
         <!--/.sec-title-four__title -->
      </div>
      <div class="row mt-4 d-flex justify-content-center">
        @foreach ($members as $member )
        <div class="col-lg-3 col-md-6 col-sm-6 pt-4">
           <div class="team-card-two wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='000ms'>
              <div class="team-card-two__image" stytle="height: 262px !important">
                @if ($member->image)
                <img src="{{ asset('storage/'.$member->image)}}" alt="Lorata Barsa" style="height: 85% !important; object-fit: cover">
                @else
                <img src="{{ asset('frontend') }}/assets/images/member-1.jpg" alt="Lorata Barsa" style="height: 85% !important; object-fit: cover">
                @endif
              </div>
              <!-- /.team-card-two__image -->
              <div class="team-card-two__content">
                 <div class="team-card-two__hover">
                    <div class="team-card-two__social">
                       <i class="fa fa-plus"></i>
                       <div class="team-card-two__social__list">
                            @if ($member->whatsapp)
                            <a href="https://wa.me/{{ $member->whatsapp }}" target="_blank">
                            <i class="fab fa-whatsapp" aria-hidden="true"></i>
                            <span class="sr-only">WhatsApp</span>
                            </a>
                            @endif
                            @if ($member->facebook)
                            <a href="{{ $member->facebook}}" target="_blank">
                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                            <span class="sr-only">Facebook</span>
                            </a>
                            @endif
                            @if ($member->linkedin)
                            <a href="{{ $member->linkedin}}" target="_blank">
                            <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                            <span class="sr-only">LinkedIn</span>
                            </a>
                            @endif
                            @if ($member->github)
                            <a href="{{ $member->github}}" target="_blank">
                            <i class="fab fa-github" aria-hidden="true"></i>
                            <span class="sr-only">GitHub</span>
                            </a>
                            @endif
                       </div>
                       <!-- /.team-card-two__social__list -->
                    </div>
                    <!-- /.team-card-two__social -->
                 </div>
                 <!-- /.team-card-two__hover -->
                 <h3 class="team-card-two__title">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $member->id }}">{{ $member->name??'' }}</a>
                 </h3>
                 <p class="team-card-two__designation">{{ $member->designation??'' }}</p>
                 <!-- /.team-card-two__designation -->
              </div>
              <!-- /.team-card-two__content -->
           </div>
        </div>
        @endforeach
      </div>
   </div>
   </div>

   @foreach ($members as $member)
      <!--MODAL-->
      <div class="modal fade" id="staticBackdrop-{{ $member->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <div class="team-details__inner">
                     <div class="row">
                        <div class="col-lg-4 pt-3">
                           <div class="team-details-image" stytle="height: 262px !important">
                            @if ($member->image)
                            <img src="{{ asset('storage/'.$member->image)}}" alt="tolak">
                            @else
                            <img src="{{ asset('frontend') }}/assets/images/member-1.jpg" alt="tolak">
                            @endif
                           </div>
                        </div>
                        <div class="col-lg-8">
                           <div class="team-details__content">
                              <h3 class="team-card-four__title">
                                 <a href="javascript:void(0)">{{ $member->name??'' }}</a>
                              </h3>
                              <p class="team-card-four__designation">{{ $member->designation??'' }}</p>
                              <p class="team-details__text">
                                 {{ $member->about??'' }}
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--MODAL-->
      @endforeach
</section>
<!--/.team-two -->
@endsection
