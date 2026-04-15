@extends('layouts.frontend')
@section('title', 'News')
@section('content')
  <!-- /.page-header -->
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
      <span class="hero-sub-title">Know About It</span>
      <h1 class="page-header__title">
      IT Solution Blog & Tips
      </h1>
    </div>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('home.page') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">News & Blog</li>
      </ol>
    </nav>
    </div>
  </section>
  <!-- /.page-header -->
  <!-- /.team-two -->
  <section class="blog-details">
    <div class="container">
    <div class="row gutter-y-60">
      <div class="col-lg-7">
      <div class="blog-details__content">
        <div class="blog-details__image">
        <img src="{{ asset($blog->image ?? 'frontend/assets/images/ui.jpg') }}" alt="{{ $blog->title }}"
          style="width: 670px; height: 500px; object-fit: cover;" loading="eager" fetchpriority="high" decoding="async">

        </div><!-- /.blog-details__image -->
        <div class="blog-details__meta">
        <div class="blog-details__meta__cats">
          <a href="blog-grid.html">{{ $blog->blogCategory->name }}</a>
        </div>
        <div class="blog-details__meta__date">
          <a href="#"> {{ $blog->author ?? 'Admin' }} </a> /
          {{ \Carbon\Carbon::parse($blog->date)->format('M d, Y') }}
        </div>
        </div><!-- /.list-unstyled blog-details__meta -->
        <h3 class="blog-card__title">{{ $blog->title }}</h3>
        <div class="blog-details__text">
        {!! $blog->description !!}
        </div>
      </div>
      </div><!-- /.col-lg-8 -->
      <div class="col-lg-5">

      <div class="sidebar">
        <aside class="widget-area">
        <div class="sidebar__single sidebar__single--search position-relative">
          <form id="blogSearchForm" action="javascript:void(0);" class="sidebar__search">
          <input type="text" id="searchInput" placeholder="Search blogs by title..." autocomplete="off">

          <button type="submit" aria-label="search submit">
            <span><i class="icofont-search-2"></i></span>
          </button>
          </form>
          <ul id="searchResults" class="list-group position-absolute w-100 mt-1 shadow-sm rounded overflow-hidden"
          style="z-index: 1000; display: none;">
          </ul>

        </div>
        <!-- /.sidebar__single -->
        <div class="sidebar__single">
          <h4 class="sidebar__title">Categories</h4><!-- /.sidebar__title -->
          <ul class="sidebar__categories list-unstyled">
          @foreach ($categories as $category)
        <li>
        <a href="{{ route('blog.category', ['id' => $category->id]) }}">
        {{ $category->name ?? '' }}
        </a> ({{ $category->blog_count ?? 0 }})
        </li>
      @endforeach
          </ul>
        </div>
        <div class="sidebar__single sidebar__single--tags">
          <h4 class="sidebar__title">Tags</h4><!-- /.sidebar__title -->
          <div class="sidebar__tags">
          @foreach ($allTags as $tag)
        <a href="{{ route('blog.tag', ['tag' => Str::slug($tag)]) }}">
        {{ $tag }}
        </a>
      @endforeach
          </div>
        </div>
        <div class="sidebar__single">
          <h4 class="sidebar__title">Recent Post</h4><!-- /.sidebar__title -->
          <ul class="sidebar__posts list-unstyled">
          @foreach ($blogs as $recent)
        <li class="sidebar__posts__item">
        <div class="sidebar__posts__image">
        <img src="{{ asset($recent->image ?? 'frontend/assets/images/ui.jpg') }}" alt="{{ $recent->title }}"
          style="width: 80px; height: 60px; object-fit: cover;" loading="lazy" decoding="async">
        </div>
        <div class="sidebar__posts__content">
        <p class="sidebar__posts__meta">
          <i class="icofont-calendar"></i>
          {{ \Carbon\Carbon::parse($recent->date)->format('M d, Y') }}
        </p>
        <h4 class="sidebar__posts__title">
          <a href="{{ route('blog.details', $recent->slug) }}">
          {{ Str::limit($recent->title, 50) }}
          </a>
        </h4>
        </div>
        </li>
      @endforeach
          </ul>
        </div><!-- /.sidebar__single -->
        </aside><!-- /.widget-area -->
      </div><!-- /.sidebar -->
      </div><!-- /.col-lg-4 -->

    </div><!-- /.row -->
    {{-- <blockquote class="mt-5 blog-details__blockquote">
      <div class="row">
      <div class="col-lg-7">
        <div class="">
        <div class="d-flex blog-card-four__content">
          <div class="w-10 m-0 me-5 comments-one__card__image">
          <img src="assets/images/amit.jpg" class="w-100" alt="tolak" loading="lazy" decoding="async">
          </div><!-- /.comments-one__card__image -->
          <div class="w-90">
          <ul class="list-unstyled blog-card-four__meta">
            <li>
            <h3 class="blog-card-four__title"><a href="blog-details-right.html">Md. Zakariya
              Hossain</a></h3>
            </li>
            <li>
            <p class="sidebar__posts__meta me-3"><i class="icofont-calendar"></i>Aug 10,
              2023</p>
            </li>
          </ul>
          <!-- /.blog-card-four__title -->
          <p class="blog-card-four__text">There are many variations of passages agency we have
            covered
            many special events such as fireworks, fairs, parades,
            races, walks, a Lorem Ipsumpassages agency we have covered many fireworks, fairs,
            parades,
            races, walks, a Lorem Ipsum Fasts injecte.</p><!-- /.blog-card-four__text -->
          <a class="blog-card-four__rm" href="blog-details-right.html"><span
            class="bx bx-log-in-circle me-2"></span> Reply</a>
          </div>
        </div>

        <div class="mt-5 d-flex blog-card-four__content">
          <div class="w-10 m-0 me-5 comments-one__card__image">
          <img src="assets/images/amit.jpg" class="w-100" alt="tolak" loading="lazy" decoding="async">
          </div><!-- /.comments-one__card__image -->
          <div class="w-90">
          <ul class="list-unstyled blog-card-four__meta">
            <li>
            <h3 class="blog-card-four__title"><a href="blog-details-right.html">Md. Zakariya
              Hossain</a></h3>
            </li>
            <li>
            <p class="sidebar__posts__meta me-3"><i class="icofont-calendar"></i>Aug 10,
              2023</p>
            </li>
          </ul>
          <!-- /.blog-card-four__title -->
          <p class="blog-card-four__text">There are many variations of passages agency we have
            covered
            many special events such as fireworks, fairs, parades,
            races, walks, a Lorem Ipsumpassages agency we have covered many fireworks, fairs,
            parades,
            races, walks, a Lorem Ipsum Fasts injecte.</p><!-- /.blog-card-four__text -->
          <a class="blog-card-four__rm" href="blog-details-right.html"><span
            class="bx bx-log-in-circle me-2"></span> Reply</a>
          </div>
        </div>
        <div class="mt-5 d-flex blog-card-four__content">
          <div class="w-10 m-0 me-5 comments-one__card__image">
          <img src="assets/images/amit.jpg" class="w-100" alt="tolak" loading="lazy" decoding="async">
          </div><!-- /.comments-one__card__image -->
          <div class="w-90">
          <ul class="list-unstyled blog-card-four__meta">
            <li>
            <h3 class="blog-card-four__title"><a href="blog-details-right.html">Md.
              Zakariya
              Hossain</a></h3>
            </li>
            <li>
            <p class="sidebar__posts__meta me-3"><i class="icofont-calendar"></i>Aug 10,
              2023</p>
            </li>
          </ul>
          <!-- /.blog-card-four__title -->
          <p class="blog-card-four__text">There are many variations of passages agency we have
            covered
            many special events such as fireworks, fairs, parades,
            races, walks, a Lorem Ipsumpassages agency we have covered many fireworks, fairs,
            parades,
            races, walks, a Lorem Ipsum Fasts injecte.</p><!-- /.blog-card-four__text -->
          <a class="blog-card-four__rm" href="blog-details-right.html"><span
            class="bx bx-log-in-circle me-2"></span> Reply</a>
          </div>
        </div>

        </div>
      </div>
      <div class="col-lg-5">
        <div class="comments-form mt-0">
        <h3 class="comments-form__title">Leave a comment</h3><!-- /.comments-form__title -->
        <form class="comments-form__form contact-form-validated form-one">
          <div class="form-one__group">
          <div class="form-one__control form-one__control--full">
            <input type="text" name="name" placeholder="Your name">
          </div><!-- /.form-one__control -->
          <div class="form-one__control form-one__control--full">
            <input type="email" name="email" placeholder="Email address">
          </div><!-- /.form-one__control -->
          <div class="form-one__control form-one__control--full">
            <textarea name="message" placeholder="Write  a message"></textarea><!-- /# -->
          </div><!-- /.form-one__control -->
          <div class="form-one__control form-one__control--full">
            <button type="submit" class="tolak-btn"><b>Submit
              Comment</b><span></span></button>
          </div><!-- /.form-one__control -->
          </div><!-- /.form-one__group -->
        </form>
        <div class="result"></div>
        </div><!-- /.comments-form -->
      </div>
      </div>
    </blockquote> --}}

    </div><!-- /.container -->
  </section><!-- /.blog-one blog-one--page -->
  <!-- /.team-two -->
@endsection



{{-- @push('scripts')
<script>
  console.log('Script loaded');

  document.addEventListener("DOMContentLoaded", function () {
    console.log('DOM fully loaded');

    const searchInput = document.getElementById("searchInput");

    if (searchInput) {
      console.log('searchInput found');
      searchInput.addEventListener("keyup", function () {
        console.log("Search input:", searchInput.value);
      });
    } else {
      console.log('searchInput not found');
    }
  });
</script>
@endpush --}}

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const resultsList = document.getElementById('searchResults');

    if (!searchInput || !resultsList) {
      console.error('Search input or results list not found');
      return;
    }

    searchInput.addEventListener('keyup', function (event) {
      const query = event.target.value.trim();
      console.log('Query:', query);

      if (query.length === 0) {
      resultsList.innerHTML = '';
      resultsList.style.display = 'none';
      return;
      }

      fetch(`{{ route('blogs.search') }}?query=${encodeURIComponent(query)}`)
      .then(res => {
        if (!res.ok) throw new Error('Network response was not ok');
        return res.json();
      })
      .then(data => {
        resultsList.innerHTML = '';

        if (data.length > 0) {
        data.forEach(blog => {
          const item = document.createElement('li');
          item.classList.add('px-3', 'py-2');
          item.innerHTML = `
          <a href="/blogs/details/${blog.slug}" class="d-block text-decoration-none list-group-item list-group-item-action">
          ${blog.title}
          </a>`;
          resultsList.appendChild(item);
        });
        } else {
        resultsList.innerHTML = '<li class="px-3 py-2 text-muted">No results found.</li>';
        }

        resultsList.style.display = 'block';
      })
      .catch(error => {
        console.error('Search failed:', error);
        resultsList.innerHTML = '<li class="px-3 py-2 text-danger">Search failed.</li>';
        resultsList.style.display = 'block';
      });
    });

    document.addEventListener('click', function (e) {
      if (!searchInput.contains(e.target) && !resultsList.contains(e.target)) {
      resultsList.style.display = 'none';
      }
    });
    });
  </script>
@endpush
<style>
  #searchResults {
    max-height: 300px;
    overflow-y: auto;
    background-color: white;
    border: 1px solid #ddd;
  }

  #searchResults li a {
    padding: 10px 15px;
    display: block;
    color: #333;
  }

  #searchResults li a:hover {
    background-color: #f5f5f5;
    text-decoration: none;
  }

  #searchResults li.text-muted,
  #searchResults li.text-danger {
    padding: 10px 15px;
    /* font-style: ; */
  }
  #searchResults .list-group-item:hover {
    background-color: #007bff !important;
    color: white !important;
  }
</style>
