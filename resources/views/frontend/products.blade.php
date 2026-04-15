@extends('layouts.frontend')
@section('title','Products')
@section('content')
<!-- /.page-header -->
<section class="hero aos-init aos-animate pb-5" data-aos="fade">
   <div class="hero-bg">
      @foreach($allCoverImages as $coverImage)
      @if ($coverImage->page_name == 'products')
      <img src="{{ asset('storage/' . $coverImage->cover_image) }}" alt="Contact Qbit Tech">
        @endif
    @endforeach
   </div>
   <div class="bg-content container">
      <div class="hero-page-title">
         <h1 class="page-header__title">
           Our Products
         </h1>
      </div>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home.page') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Our Products</li>
         </ol>
      </nav>
   </div>
</section>
<!-- /.page-header -->
<section class="product-showcase-section ptb-100">
   <div class="container-fluid">
      <div class="sec-title-three text-center">
         <h6 class="sec-title-three__tagline"><span class="sec-title-three__tagline__left-border"></span>OUR BEST SERVICE<span class="sec-title-three__tagline__right-border"></span></h6>
         <!-- /.sec-title-three__tagline -->
         <h3 class="sec-title-three__title">We Are Service Your&nbsp;Business</h3>
         <p>We combine strategy, design, and technology to build exceptional digital experiences for our clients.</p>
      </div>
      <div class="product-filters">
         <ul>
            <li class="active mt-3" data-filter="*"><span>All</span></li>
            @foreach ($categories as $category)
               <li class="mt-3" data-filter=".cat-{{$category->id}}"><span>{{$category->name}}</span></li>
            @endforeach
         </ul>
      </div>

      <div class="row product-grid">
         @foreach ($products as $product)
         <div class="col-lg-6 product-item cat-{{ $product->product_category_id }}">
            <div class="card-hover card-lifted mx-auto mb-5" style="max-width: 600px;">
               <div class="card-lifted overflow-hidden rounded-3 mb-3" style="height: 480px; position: relative;">
                  <div style="width: 1700px; height: 1500px; transform: scale(0.35); transform-origin: top left; overflow: hidden;">
                     <iframe src="{{$product->link}}" style="width: 100%; height: 1500px; border: 0;" loading="lazy"></iframe>
                  </div>
               </div>
               <h3 class="h5 text-center mb-0">
                  {{$product->name}}
               </h3>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</section>
@endsection



@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<script>
   $(document).ready(function(){

      // Isotope initialize
      var $grid = $('.product-grid').isotope({
         itemSelector: '.product-item',
         layoutMode: 'fitRows'
      });

      // filter click
      $('.product-filters li').on('click', function(){
         $('.product-filters li').removeClass('active');
         $(this).addClass('active');

         var filterValue = $(this).attr('data-filter');
         $grid.isotope({ filter: filterValue });
      });

   });
</script>

@endpush
