@extends('layouts.frontend')
@section('title','Service')
@section('content')


<section class="hero aos-init aos-animate pb-5" data-aos="fade">
   <div class="hero-bg">
      @foreach($allCoverImages as $coverImage)
      @if ($coverImage->page_name == 'solutions')
      <img src="{{ asset('storage/' . $coverImage->cover_image) }}" alt="Contact InfyraSoft">
        @endif
        @endforeach
   </div>
   <div class="bg-content container">
      <div class="hero-page-title">
         <h1 class="page-header__title">
           Enterprise-Grade <br/>Services and Solutions
         </h1>
      </div>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home.page') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Our Solutions</li>
         </ol>
      </nav>
   </div>
</section>
<section class="blog-five">
   <div class="container-fluid">
      <div class="sec-title-four text-center">
         <h6 class="sec-title-three__tagline"><span class="sec-title-three__tagline__left-border"></span>Our Solutions<span class="sec-title-three__tagline__right-border"></span></h6>
         <h3 class="sec-title-two__title">Solutions That <span>Empower</span> Your <span>Business</span></h3>
      </div>
      <div class="row mt-4">
         @foreach ($frontendservices as $service)
         <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="100ms">
            <div class="blog-card-five wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='200ms'style="width: 100% !important;">
               <div class="blog-card-five__image" style="width: 100% !important; height: 400px;">
                  <img src="{{ asset('storage/' . $service->image) }}" alt="Are you Looking For a Solution Related">
                  <img src="{{ asset('storage/' . $service->image) }}" alt="Are you Looking For a Solution Related">
                  <a href="{{ route('service.details', $service->slug) }}" class="blog-card-five__image__link">
                  <span class="sr-only"></span>
                  </a>
               </div>
               <div class="blog-card-five__content">
                  <ul class="list-unstyled blog-card-five__meta">
                     <h3 class="service-one__item__title"><a href="{{ route('service.details', $service->slug) }}">{{$service->service_name}}</a></h3>
                  </ul>

                  <ul class="about-four__content__list">
                     <li>
                        @if($service->service_keypoint_1)
                           <p><i class='bx bx-chip me-1'></i>{{$service->service_keypoint_1}} </p>
                        @endif
                     </li>
                     <li>
                        @if($service->service_keypoint_2)
                           <p><i class='bx bx-chip me-1'></i> {{$service->service_keypoint_2}} </p>
                        @endif
                     </li>
                     <li>
                        @if($service->service_keypoint_3)
                           <p><i class='bx bx-chip me-1'></i> {{$service->service_keypoint_3}} </p>
                        @endif
                     </li>
                  </ul>
                  <a class="blog-card-five__rm" href="{{ route('service.details', $service->slug) }}"><i class='bx bx-expand-horizontal'></i></a>
               </div>
            </div>
         </div>
         @endforeach

      </div>
   </div>
</section>

@endsection

<style>

   .blog-card-five {
    width: 385px;
    height: 465px;
    overflow: hidden;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-sizing: border-box;
    background-color: #fff;
    margin: 0 auto; /* center within Bootstrap col */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.blog-card-five__image {
    width: 100%;
    height: 200px;
    overflow: hidden;
    position: relative;
}

.blog-card-five__image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.blog-card-five__content {
    padding: 15px;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.service-one__item__title {
    font-size: 18px;
    margin-bottom: 12px;
}

.about-four__content__list {
    padding: 0;
    margin: 0 0 10px 0;
    list-style: none;
}

.about-four__content__list li p {
    font-size: 14px;
    margin-bottom: 6px;
}

.blog-card-five__rm {
    align-self: flex-end;
    font-size: 20px;
    color: #333;
}

</style>
