@extends('layouts.frontend')
@section('title', 'Gallery')
@section('content')
<style>
    /* Image container for uniform height */
    .img-container {
        height: 250px; /* adjust height as needed */
        overflow: hidden;
    }

    .img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.3s;
    }

    /* Optional: slight zoom on hover */
    .card:hover .img-container img {
        transform: scale(1.05);
    }

    .card:hover .overlay{
        margin-bottom: 10px !important;
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
<section class="team-two" style="background-image: url({{ asset('frontend') }}/assets/images/shapes/team-2-bg.png);">
    <div class="container">
        <div class="sec-title-four text-center mb-5">
            <h6 class="sec-title-three__tagline">
                <span class="sec-title-three__tagline__left-border"></span>
                Our Gallery
                <span class="sec-title-three__tagline__right-border"></span>
            </h6>
            <h3 class="sec-title-two__title">Photo <span>Albums</span></h3>
        </div>

        <div class="row g-4" id="albumContainer">
            @foreach ($albums as $index => $album)
                <div class="col-12 col-sm-6 col-lg-4 album-item {{ $index >= 6 ? 'd-none' : '' }}">
                    <div class="card h-100 border-0 shadow overflow-hidden position-relative">
                        <!-- Clickable image container -->
                        <a href="{{ route('gallery.all', ['number' => $album->id]) }}">
                            <div class="img-container">
                                <img src="{{ asset('storage/' . $album->cover_image) }}" alt="{{ $album->name }}">
                            </div>
                        </a>

                        <!-- Bottom overlay -->
                        <div class="overlay position-absolute text-white p-3 text-center"
                             style="background: rgba(0,0,0,0.6); width: calc(100% - 20px); left: 50%; transform: translate(-50%, 100%); bottom: 0; border-radius: 8px; transition: transform 0.3s;">
                            <h5 class="mb-1 text-white">{{ $album->name }}</h5>
                                {{ $album->albumImageVideos->where('type', 'image')->count() }} Images |
                                {{ $album->albumImageVideos->where('type', 'video')->count() }} Videos
                            </p>
                            <a href="{{ route('gallery.all', ['number' => $album->id]) }}" class="btn btn-secondary btn-sm">View Full Album</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($albums->count() > 6)
            <div class="text-center mt-4">
                <button id="viewAll" class="tolak-btn-two tolak-btn-two--home-five">
                    View All Albums
                </button>
            </div>
        @endif
    </div>
</section>

@endsection


@push('scripts')
<script>
    $(document).ready(function() {
        // View All button
        $('#viewAll').on('click', function() {
            $('.album-item.d-none').removeClass('d-none');
            $(this).hide();
        });

        // Bottom overlay hover effect
        $('.card').hover(
            function() {
                $(this).find('.overlay').css('transform', 'translate(-50%, 0)');
            },
            function() {
                $(this).find('.overlay').css('transform', 'translate(-50%, 100%)');
            }
        );
    });
</script>
@endpush
