@extends('layouts.frontend')
@section('title', 'Gallery')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<style>
    /* Card & image container */
    .album-card {
        border: 0;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        height: 250px; /* uniform height */
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        transition: transform 0.3s;
    }

    .album-card:hover {
        transform: scale(1.03);
    }

    .album-card img,
    .album-card video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.3s;
    }

    .album-card:hover img,
    .album-card:hover video {
        transform: scale(1.05);
    }

    /* Overlay */
    .album-overlay {
        position: absolute;
        left: 50%;
        bottom: 0; /* peek visible */
        transform: translateX(-50%);
        width: calc(100% - 20px);
        background: rgba(0,0,0,0.6);
        color: #fff;
        padding: 10px 15px;
        border-radius: 8px;
        text-align: center;
        transition: bottom 0.3s;
    }

    .album-overlay h5 {
        margin-bottom: 5px;
    }

    .album-overlay p {
        margin-bottom: 5px;
        font-size: 0.875rem;
    }

    .album-overlay a {
        font-size: 0.8rem;
    }
</style>
<!-- Hero / Banner Section -->
<section class="hero pb-5" data-aos="fade">
    <div class="hero-bg">
        @foreach ($allCoverImages as $coverImage)
            @if ($coverImage->page_name == 'gallery')
                <img src="{{ asset('storage/' . $coverImage->cover_image) }}" alt="Gallery Banner">
            @endif
        @endforeach
    </div>
    <div class="bg-content container">
        <div class="hero-page-title">
            <h1 class="page-header__title">Our Gallery</h1>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home.page') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Our Gallery</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Album Gallery Section -->
<section class="team-two" id="eventSection">
   <div class="container">
      <div class="section__header text-center mb-4" data-aos="fade-up" data-aos-duration="1000">
         <span class="sub-title-main"><i class='bx bx-images'></i> Images & Videos</span>
         <h2 class="title-animation">{{$album->name}}</h2>
      </div>

      <div class="row g-4" id="albumContainer">
            @foreach ($mediaItems as $index => $mediaItem)
                <div class="col-12 col-lg-4 album-item {{ $index >= 6 ? 'd-none' : '' }}">
                    <div class="album-card" data-aos="fade-up" data-aos-duration="1000">
                        @if ($mediaItem->type === 'image')
                            <a href="{{ asset('storage/' . $mediaItem->file_path) }}" class="glightbox" data-gallery="gallery">
                                <img src="{{ asset('storage/' . $mediaItem->file_path) }}" alt="Image">
                            </a>
                        @elseif ($mediaItem->type === 'video')
                            <a href="{{ asset('storage/' . $mediaItem->file_path) }}" class="glightbox" data-gallery="gallery" data-type="video">
                                <video>
                                    <source src="{{ asset('storage/' . $mediaItem->file_path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
      </div>

      @if ($mediaItems->count() > 6)
          <div class="row mt-4">
              <div class="col-12 text-center">
                  <button id="viewAll" class="tolak-btn-two tolak-btn-two--home-five">
                      View All Images & Videos
                  </button>
              </div>
          </div>
      @endif
   </div>
</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
    const lightbox = GLightbox({
        selector: '.glightbox'
    });

    $(document).ready(function () {
        // View All button
        $('#viewAll').on('click', function () {
            $('.album-item.d-none').removeClass('d-none');
            $(this).hide();
        });

        // Overlay hover effect: slide overlay 10px above bottom
        $('.album-card').hover(
            function() {
                $(this).find('.album-overlay').css('bottom', '10px');
            },
            function() {
                $(this).find('.album-overlay').css('bottom', '0');
            }
        );
    });
</script>
@endpush
