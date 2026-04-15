@extends('layouts.frontend')
@section('title', 'News')
@section('content')
    <section class="hero aos-init aos-animate pb-5" data-aos="fade">
        <div class="hero-bg">
            @foreach ($allCoverImages as $coverImage)
                @if ($coverImage->page_name == 'news')
                    <img src="{{ asset('storage/' . $coverImage->cover_image) }}" alt="Contact InfyraSoft" loading="eager" fetchpriority="high" decoding="async">
                @endif
            @endforeach
        </div>
        <div class="bg-content container">
            <div class="hero-page-title">
                <h1 class="page-header__title">
                    IT Solution Blog & News
                </h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home.page') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blog & News</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- /.page-header -->
    <section class="team-two" style="background-image: url({{ asset('frontend') }}/assets/images/shapes/team-2-bg.png);">
        <div class="container">
            <div class="sec-title-four text-center">
                <h6 class="sec-title-three__tagline"><span class="sec-title-three__tagline__left-border"></span>News &amp;
                    Blog<span class="sec-title-three__tagline__right-border"></span></h6>
                <h3 class="sec-title-two__title">Trending IT Solution <span>Blog &amp; Tips</span></h3>
            </div>
            <div class="row">
                @forelse ($blogs as $blog) <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                        <div class="blog-card wow fadeInUp animated my-1" data-wow-duration="1500ms" data-wow-delay="00ms"
                            style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
                            <div class="blog-card__image">
                                <img src="{{ asset($blog->image ?? 'frontend/assets/images/ui.jpg') }}"
                                    alt="{{ $blog->title ?? '' }}" style="width: 350px; height: 262px; object-fit: cover;" loading="lazy" decoding="async">
                                <img src="{{ asset($blog->image ?? 'frontend/assets/images/ui.jpg') }}"
                                    alt="{{ $blog->title ?? '' }}" style="width: 350px; height: 262px; object-fit: cover;" loading="lazy" decoding="async">
                                <a href="{{ route('blog.details', $blog->slug) }}" class="blog-card__image__link">
                                    <span class="sr-only">{{ \Illuminate\Support\Str::limit($blog->title ?? '', 45) }}</span>
                                </a>
                            </div>
                            <div class="blog-card__bg"></div>
                            <div class="blog-card-two__meta">
                                <div class="blog-card-two__meta__author">
                                    <img src="{{ asset($blog->author_image ?? 'frontend/assets/images/award-1.jpg') }}"
                                        alt="{{ $blog->author ?? 'Admin' }}"
                                        style="width: 40px; height: 40px; object-fit: cover;" loading="lazy" decoding="async">
                                    {{ $blog->author ?? 'Admin' }}
                                </div>
                                <div class="d-flex align-items-center">
                                    @php
                                        $date = \Carbon\Carbon::parse($blog->date);
                                    @endphp
                                    <div class="blog-card-two__meta__date">
                                        <span>{{ $date->format('d') }}</span>{{ $date->format('M') }}
                                    </div>
                                    <div class="blog-card-two__meta__year">{{ $date->format('Y') }}</div>
                                </div>
                            </div>

                            <div class="blog-card__content">
                                <h3 class="blog-card__title"><a
                                        href="{{ route('blog.details', $blog->slug) }}">{{ $blog->title ?? '' }}</a>
                                </h3>
                                <p class="blog-card__text">{{ Str::limit(strip_tags($blog->description), 100) }}</p>
                                <a href="{{ route('blog.details', $blog->slug) }}" class="blog-card__link">
                                    Read more
                                    <i class="icofont-rounded-double-right"></i>
                                </a><!-- /.blog-card__link -->
                            </div>
                            <div class="blog-card__border"></div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <h4>No blog posts found.</h4>
                        {{-- <p>Please check back later for updates.</p> --}}
                    </div>
                @endforelse
            </div>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            {{ $blogs->links() }}
        </div>
    </section>
@endsection

<style>
    .blog-card {
        height: 505px;
        background-color: #fff;
        border-radius: 1px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 10px;
        box-sizing: border-box;
    }

    .blog-card__image {
        width: 350px;
        height: 262px;
        overflow: hidden;
        border-radius: 1px;
    }

    .blog-card__image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .blog-card-two__meta {
        width: 350px;
        padding: 8px 0;
        font-size: 13px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .blog-card__content {
        width: 350px;
        height: 180px;
        padding: 10px 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-sizing: border-box;
    }

    .blog-card__title {
        font-size: 18px;
        font-weight: 600;
        margin: 0 0 8px 0;
        line-height: 1.3;
        max-height: 2.6em;
        /* 2 lines */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .blog-card__text {
        font-size: 14px;
        color: #555;
        margin-bottom: 10px;
        line-height: 1.5;
        max-height: 3em;
        /* 2 lines */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .blog-card__link {
        font-size: 14px;
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
        align-self: flex-start;
        transition: color 0.3s ease;
    }

    .blog-card__link:hover {
        color: #0056b3;
    }
</style>
