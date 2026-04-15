@extends('layouts.frontend')
@section('title', 'Search Results')

@section('content')
    <section class="hero aos-init aos-animate pb-5" data-aos="fade">
        <div class="bg-content container">
            <div class="hero-page-title">
                <h1 class="page-header__title">Search Results</h1>
                <p class="mb-0">Showing results for: <strong>{{ $query }}</strong></p>
            </div>
        </div>
    </section>

    <section class="blog-details pt-0">
        <div class="container">
            <div class="sidebar__single mb-4">
                <form method="get" action="{{ route('global.search.page') }}" class="sidebar__search">
                    <input type="text" name="query" value="{{ $query }}" placeholder="Search services, team, blogs, albums..." autocomplete="off">
                    <button type="submit" aria-label="search submit">
                        <span><i class="icofont-search-2"></i></span>
                    </button>
                </form>
            </div>

            @php
                $hasAny = collect($results)->flatten(1)->isNotEmpty();
                $labels = [
                    'services' => 'Services',
                    'members' => 'Team Members',
                    'blogs' => 'News & Blogs',
                    'albums' => 'Image Albums',
                    'sections' => 'Sections',
                ];
            @endphp

            @if (mb_strlen($query) < 2)
                <div class="sidebar__single text-center">
                    <p class="mb-0">Type at least 2 characters to search.</p>
                </div>
            @elseif (!$hasAny)
                <div class="sidebar__single text-center">
                    <p class="mb-0">No results found for <strong>{{ $query }}</strong>.</p>
                </div>
            @else
                <div class="row gutter-y-24">
                    @foreach ($results as $group => $items)
                        @if (!empty($items))
                            <div class="col-lg-6">
                                <div class="sidebar__single h-100">
                                    <h4 class="sidebar__title">{{ $labels[$group] ?? ucfirst($group) }}</h4>
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($items as $item)
                                            <li class="py-2 border-bottom">
                                                <a href="{{ $item['url'] }}" class="d-block fw-semibold">{{ $item['title'] }}</a>
                                                <small class="text-muted">{{ $item['subtitle'] }}</small>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
