@extends('layouts.frontend')
@section('title','Service Details')
@section('content')
<style>
    .featurer-six__item__title:hover {
    color: #FFA726 !important; /* Light orange, you can adjust the hex as you like */
    cursor: pointer; /* Optional: shows pointer on hover */
    transition: color 0.3s ease; /* Smooth color transition */
}

</style>
<section class="hero aos-init aos-animate" data-aos="fade">
   <div class="hero-bg">
      @foreach($allCoverImages as $coverImage)
      @if ($coverImage->page_name == 'solutions')
      <img src="{{ asset('storage/' . $coverImage->cover_image) }}" alt="Contact InfyraSoft">
        @endif
        @endforeach
   </div>
   <div class="bg-content container">
      <div class="hero-page-title">
          <span class="hero-sub-title">Enterprise-Grade Services and Solutions</span>
         <h1 class="page-header__title">
            {{ $service->service_name??'' }}
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
<section class="p-top-90 p-bottom-90 bg-gray-gradient">
   <div class="container">
      <ul class="nav tab-menu tour-nav mb-4" id="tour-tab" role="tablist">
         <li class="nav-item" role="presentation">
            <button class="nav-link active" id="overview-tab" data-bs-toggle="pill" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">
            Overview
            </button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="benefits-tab" data-bs-toggle="pill" data-bs-target="#key-benefits" type="button" role="tab" aria-controls="key-benefits" aria-selected="false">
            Key Benefits
            </button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="process-tab" data-bs-toggle="pill" data-bs-target="#development-process" type="button" role="tab" aria-controls="development-process" aria-selected="false">
            Development Process
            </button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="faq-tab" data-bs-toggle="pill" data-bs-target="#faqs" type="button" role="tab" aria-controls="faqs" aria-selected="false">
            FAQ's
            </button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="tech-tab" data-bs-toggle="pill" data-bs-target="#technologies" type="button" role="tab" aria-controls="technologies" aria-selected="false">
            Technologies We Use
            </button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="offered-services-tab" data-bs-toggle="pill" data-bs-target="#offered-services" type="button" role="tab" aria-controls="offered-services" aria-selected="false">
            Offered Services
            </button>
         </li>
         <li class="nav-item nav-item-button" role="presentation">
            <a href="{{ route('contact-us.page') }}" class="nav-link" id="book-tab" aria-selected="false" role="tab">
            <i class="hicon hicon-bold hicon-pay-on-checkin me-1"></i>
            <span> Contact Now</span>
            </a>
         </li>
      </ul>
      <div class="tab-content rounded" id="pills-tabContent">
         <div class="tab-pane rounded fade active show" id="overview" role="tabpanel" aria-labelledby="overview-tab" tabindex="0">
            <div class="card border-0 p-xl-3 shadow-sm">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-lg-5">
                        <div class="team-details__image">
                            @if ($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="Web Development Overview">
                            @else
                            <img src="/frontend/assets/images/web-dev.jpg" alt="Web Development Overview">
                            @endif
                        </div>
                     </div>
                     <div class="col-lg-7">
                        <div class="team-details__content">
                           <div class="sec-title-four text-left pb-3">
                              <h3 class="fs-25 mb-0 sec-title-two__title">{{ $service->service_name??'' }}</h3>
                           </div>
                           <p class="funfact-four__content__text">
                              {{ $service->service_details??'' }}
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-pane rounded fade" id="key-benefits" role="tabpanel" aria-labelledby="benefits-tab" tabindex="0">
            <div class="card border-0 p-xl-3 shadow-sm">
               <div class="card-body">
                  <div class="sec-title-three text-center">
                     <h3 class="fs-25 mb-4 sec-title-two__title"><span>Why </span>Do You <span>Need This?</span></h3>
                  </div>
                  <div class="row">
                    @foreach ($service->whyNeeds as $whyNeed)
                    <div class="col-md-6 wow fadeInUp animated" data-wow-delay="00ms">
                       <div class="solution-two__box bg-white">
                          <h3 class="solution-two__box__title border-0 pb-0"><i class="bx bx-select-multiple bx-tada"></i>{{ $whyNeed->keypoint_title??'' }}</h3>
                          <p class="solution-two__box__text">{{ $whyNeed->keypoint_details??'' }}</p>
                       </div>
                    </div>
                    @endforeach
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-pane rounded fade" id="development-process" role="tabpanel" aria-labelledby="process-tab" tabindex="0">
            <div class="card border-0 p-xl-3 shadow-sm">
               <div class="card-body">
                  <div class="sec-title-four text-center">
                     <h3 class="fs-22 mb-0 sec-title-two__title">Our Development <span>Process</span></h3>
                  </div>
@php
    $processes = collect($service->developmentProcess);
    $topItems = $processes->slice(0, 2); // First row
    $remainingItems = $processes->slice(2); // For second row

    $totalRemaining = $remainingItems->count();
    $half = ceil($totalRemaining / 2); // Left gets more if odd

    $leftItems = $remainingItems->slice(0, $half);
    $rightItems = $remainingItems->slice($half);
@endphp

<div class="row mt-3">
    {{-- First row: Two col-lg-6 items --}}
    @foreach($topItems as $process)
        <div class="col-lg-6 col-md-6 wow fadeInUp animated">
            <div class="solution-two__box bg-white">
                <h3 class="solution-two__box__title">
                    <i class="bx bx-select-multiple bx-tada"></i>
                    Step {{ $loop->iteration }}: {{ $process->process_title ?? '' }}
                </h3>
                <p class="solution-two__box__text">{{ $process->process_details ?? '' }}</p>
            </div>
        </div>
    @endforeach

    {{-- Second row: Left column --}}
    @if($leftItems->isNotEmpty())
        <div class="col-lg-4 col-md-6 wow fadeInUp animated">
            @foreach($leftItems as $process)
                <div class="solution-two__box bg-white">
                    <h3 class="solution-two__box__title">
                        <i class="bx bx-select-multiple bx-tada"></i>
                        Step {{ $loop->iteration + 2 }}: {{ $process->process_title ?? '' }}
                    </h3>
                    <p class="solution-two__box__text">{{ $process->process_details ?? '' }}</p>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Second row: Middle static image --}}
    <div class="col-lg-4 col-md-6 wow fadeInUp animated" data-wow-delay="200ms">
        <div class="project-details-faq__image">
            @if ($service->image)
            <img src="{{ asset('storage/' . $service->image) }}" alt="Web Development Overview">
            @else
            <img src="/frontend/assets/images/web-dev.jpg" alt="Web Development Overview">
            @endif
            <div class="project-details-faq__item count-box tolak-tilt" data-tilt-options='{ "glare": false, "maxGlare": 0, "maxTilt": 9, "speed": 700, "scale": 1 }'>
                <h3 class="project-details-faq__item__count"><span class="count-text" data-stop="34" data-speed="1500">34</span>k+</h3>
                <p class="project-details-faq__item__text">Customers Support</p>
            </div>
        </div>
    </div>

    {{-- Second row: Right column --}}
    @if($rightItems->isNotEmpty())
        <div class="col-lg-4 col-md-6 wow fadeInUp animated">
            @foreach($rightItems as $process)
                <div class="solution-two__box bg-white">
                    <h3 class="solution-two__box__title">
                        <i class="bx bx-select-multiple bx-tada"></i>
                        Step {{ $loop->iteration + 2 + $leftItems->count() }}: {{ $process->process_title ?? '' }}
                    </h3>
                    <p class="solution-two__box__text">{{ $process->process_details ?? '' }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>

               </div>
            </div>
         </div>
         <div class="tab-pane rounded fade" id="faqs" role="tabpanel" aria-labelledby="faq-tab" tabindex="0">
            <div class="card border-0 p-xl-3 shadow-sm">
               <div class="card-body">
                  <div class="row">
                     <div class="col-xl-7 wow fadeInLeft animated">
                        <h2 class="faq-two__content__title">Frequently Asked Questions</h2>
                        <div class="faq-three__accordion tolak-accrodion" data-grp-name="tolak-accrodion-faq">
                           @foreach($service->faqs as $faq)
    <div class="accrodion">
        <div class="accrodion-title">
            <h4><i class="fa fa-check-circle"></i>{{ $faq->question }}</h4>
        </div>
        <div class="accrodion-content">
            <div class="inner">
                <p>{{ $faq->answer }}</p>
            </div>
        </div>
    </div>
@endforeach

                        </div>
                     </div>
                     <div class="col-xl-5">
                        <div class="contact-three__content custom-bg-primary-100">
                           <div class="sec-title-four text-center">
                              <h3 class="sec-title-four__title text-dark">Enquire Us</h3>
                           </div>
                           <form class="mb-0 contact-three__form contact-form-validated form-one" action="inc/sendemail.php">
                              <div class="form-one__group">
                                 <div class="form-one__control form-one__control--full"><input type="text" name="service_id" placeholder="Your Name *" value="{{ $service->id }}" hidden></div>
                                 <div class="form-one__control form-one__control--full"><input type="text" name="name" placeholder="Your Name *"></div>
                                 <div class="form-one__control form-one__control--full"><input type="text" name="phone" placeholder="Your Phone"></div>
                                 <div class="form-one__control form-one__control--full"><input type="email" name="email" placeholder="Your Email *"></div>
                                 <div class="form-one__control form-one__control--full"><input type="text" name="subject" placeholder="Your Subject *"></div>
                                 <div class="form-one__control form-one__control--full"><textarea name="message" placeholder="Your Message *"></textarea></div>
                                 <div class="form-one__control form-one__control--full text-center mt-3"><button type="submit" class="tolak-btn-two tolak-btn-two--home-six"><span class="tolak-btn-two__left-star"></span><span>Send Request<i class="tolak-icons-two-arrow-right-short"></i></span><span class="tolak-btn-two__right-star"></span></button></div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-pane rounded fade" id="technologies" role="tabpanel" aria-labelledby="tech-tab" tabindex="0">
            <div class="card border-0 p-xl-3 shadow-sm">
               <div class="card-body">
                  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 gutter-y-30 m-auto justify-content-center">
                        @foreach($service->technologies as $technology)
                            <div class="col wow fadeInUp animated">
                                <div class="featurer-six__item custom-bg-success-100">
                                    <div class="cta-eleven__image">
                                        <img src="{{ asset('storage/' . $technology->technology_image) }}" alt="{{ $technology->technology_name??'' }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
         </div>
         <div class="tab-pane rounded fade" id="offered-services" role="tabpanel" aria-labelledby="offered-services-tab" tabindex="0">
            <div class="card border-0 p-xl-3 shadow-sm">
               <div class="card-body">
                 <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 gutter-y-30 m-auto justify-content-center">
                    @foreach($service->offeredService as $offer)
                        <div class="col">
                            <div class="featurer-six__item">
                                <div class="tab-one__thumb d-flex">
                                    <img src="{{ asset('storage/'. $offer->service_image)  }}" alt="{{ $offer->offered_service??'' }}" style="width: 100%; height: 100px; object-fit: cover;">
                                </div>
                                <h4 class="featurer-six__item__title">{{ $offer->offered_service??'' }}</h4>
                            </div>
                        </div>
                    @endforeach
                </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>


@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function () {
    $('.contact-three__form').on('submit', function (e) {
        e.preventDefault();

        let formData = {
            name: $('input[name="name"]').val(),
            phone: $('input[name="phone"]').val(),
            email: $('input[name="email"]').val(),
            subject: $('input[name="subject"]').val(),
            message: $('textarea[name="message"]').val(),
            service_id: $('input[name="service_id"]').val(),
        };

        $.ajax({
            url: '/contact-messege/send',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                Swal.fire({
                  icon: 'success',
                  title: 'Message Sent!',
                  text: response.message,
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
               });

                $('.contact-three__form')[0].reset();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = '';
                    for (let field in errors) {
                        errorMessages += errors[field].join('\n') + '\n';
                    }
                   Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: '<pre style="text-align:left;white-space:pre-wrap;">' + errorMessages + '</pre>',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'An error occurred. Please try again.',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });

                }
            }
        });
    });
});
</script>

