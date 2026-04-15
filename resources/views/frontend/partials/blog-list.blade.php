{{-- @foreach ($blogs as $blog)
    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="200ms">
        <div class="blog-card wow fadeInUp animated" data-wow-duration="1500ms" data-wow-delay="00ms"
            style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
            <div class="blog-card__image">
                <img src="{{ asset($blog->image ?? 'frontend/assets/images/ui.jpg') }}" alt="{{ $blog->title ?? ''}}"
                    style="width: 350px; height: 262px; object-fit: cover;">
                <img src="{{ asset($blog->image ?? 'frontend/assets/images/ui.jpg') }}" alt="{{ $blog->title ?? ''}}"
                    style="width: 350px; height: 262px; object-fit: cover;">
                <a href="{{ route('blog.details', $blog->slug) }}" class="blog-card__image__link">
                    <span class="sr-only">{{ \Illuminate\Support\Str::limit($blog->title ?? '', 45) }}</span>
                </a>
            </div>
            <!-- /.blog-card__image -->
            <div class="blog-card__bg"></div>
            <div class="blog-card-two__meta">
                <div class="blog-card-two__meta__author">
                    <img src="{{ asset($blog->author_image ?? 'frontend/assets/images/award-1.jpg') }}"
                        alt="{{ $blog->author ?? 'Admin' }}" style="width: 40px; height: 40px; object-fit: cover;">
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
                <h3 class="blog-card__title"><a href="{{ route('blog.details', $blog->slug) }}">{{$blog->title ?? ""}}</a>
                </h3>
                <!-- /.blog-card__title -->
                <p class="blog-card__text">{{ Str::limit(strip_tags($blog->description), 100) }}</p>
                <!-- /.blog-card__text -->
                <a href="{{  route('blog.details', $blog->slug) }}" class="blog-card__link">
                    Read more
                    <i class="icofont-rounded-double-right"></i>
                </a><!-- /.blog-card__link -->
            </div>
            <!-- /.blog-card__content -->
            <div class="blog-card__border"></div>
        </div>
    </div>
@endforeach --}}

@foreach ($blogs as $blog)
<div class="col-lg-4 col-md-6 mb-4 blog-item">
  <div class="blog-card">
    <div class="blog-card__image">
      <img src="{{ asset($blog->image ?? 'frontend/assets/images/ui.jpg') }}"
           alt="{{ $blog->title ?? '' }}"
           style="width: 350px; height: 262px; object-fit: cover;">
      <a href="{{ route('blog.details', $blog->slug) }}" class="blog-card__image__link">
        <span class="sr-only">{{ \Illuminate\Support\Str::limit($blog->title ?? '', 45) }}</span>
      </a>
    </div>

    <div class="blog-card__content">
      <h3 class="blog-card__title">
        <a href="{{ route('blog.details', $blog->slug) }}">{{ $blog->title ?? '' }}</a>
      </h3>
      <p class="blog-card__text">{{ Str::limit(strip_tags($blog->description), 100) }}</p>
      <a href="{{ route('blog.details', $blog->slug) }}" class="blog-card__link">
        Read more <i class="icofont-rounded-double-right"></i>
      </a>
    </div>
  </div>
</div>
@endforeach
