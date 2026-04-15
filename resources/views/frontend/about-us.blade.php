@extends('layouts.frontend')
@section('title','About Us')
@section('content')
<!-- /.page-header -->

<section class="hero aos-init aos-animate pb-5" data-aos="fade">
   <div class="hero-bg">
        @foreach($allCoverImages as $coverImage)
            @if ($coverImage->page_name == 'explore_qBit_tech')
                <img src="{{ asset('storage/' . $coverImage->cover_image) }}" alt="Contact InfyraSoft">
            @endif
        @endforeach
   </div>
   <div class="bg-content container">
       <div class="hero-page-title">
          <span class="hero-sub-title">Know About Us</span>
            <h1 class="page-header__title">
            Roots of InfyraSoft
            </h1>
      </div>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home.page') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Explore InfyraSoft</li>
         </ol>
      </nav>
   </div>
</section>


{{-- <section class="page-header">

    @foreach($allCoverImages as $coverImage)
        @if ($coverImage->page_name == 'explore_qBit_tech')
            <div class="page-header__bg" style="background-image: url('{{ asset('storage/uploads/cover_images/' . $coverImage->cover_image) }}')">
            </div>
        @endif
    @endforeach

   <div class="container">
      <div class="page-header__content">
         <h2 class="page-header__title">Roots of InfyraSoft</h2>
         <ul class="tolak-breadcrumb list-unstyled">
            <li><a href="{{ route('home.page') }}">Home</a></li>
            <li><span>Explore InfyraSoft</span></li>
         </ul>
      </div>
   </div>
</section> --}}
<!-- /.page-header -->
<!-- About Us -->
<section class="skill-one">
   <div class="container">
      <div class="row">
         <div class="col-lg-5 wow fadeInRight" data-wow-delay="00ms">
            <div class="skill-one__image">
               <div class="about-five__image__one wow fadeInUp" data-wow-delay="100ms">
                  <img src="{{ asset('storage/' . $about->image) }}" alt="tolak">
               </div>
               @if ($about->quote)
                <div class="skill-one__image__text wow fadeInUp" data-wow-delay="200ms">
                    <span>{!! implode(' ', array_slice(explode(' ', $about->quote), 0, 1)) !!}</span> {!! implode('
                    ', array_slice(explode(' ', $about->quote), 1)) !!}
                </div>
                @endif
            </div>
         </div>
         <div class="col-lg-7 wow fadeInUp" data-wow-delay="100ms">
            <div class="skill-one__content">
               <div class="sec-title-four text-left">
                        <h6 class="sec-title-three__tagline"><span
                                class="sec-title-three__tagline__left-border"></span>{{$about->title}}</h6>
                        <!-- /.sec-title-four__tagline -->
                        <h3 class="sec-title-two__title">
                            {!! implode(' ', array_slice(explode(' ', $about->sub_title), 0, 3)) !!}
                            <span>{!! implode(' ', array_slice(explode(' ', $about->sub_title), 3, 1)) !!}</span>
                            {!! implode(' ', array_slice(explode(' ', $about->sub_title), 4, 2)) !!}
                            <span>{!! implode(' ', array_slice(explode(' ', $about->sub_title), 6)) !!}</span>
                        </h3>
                    </div>
               <p class="why-choose-five__content__text">
                  {!! $about->description!!}
               </p>
               <div class="skill-one__content__bar"></div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- About Us -->




@endsection
