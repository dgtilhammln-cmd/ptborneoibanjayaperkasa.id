@extends('layouts.frontend')

@push('head')
@php
    $breadcrumbs = [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Our Blog', 'url' => url('/blog')]
    ];
@endphp
@include('partials.schema', ['schemaType' => 'breadcrumb', 'breadcrumbs' => $breadcrumbs])
@include('partials.schema', ['schemaType' => 'organization'])
@if(isset($blogs) && $blogs->count() > 0)
@include('partials.schema', ['schemaType' => 'blog', 'blogs' => $blogs])
@endif

<style>
/* =============================================
   BLOG PAGE - PREMIUM REDESIGN
   PT. Borneo Iban Jaya Perkasa
   ============================================= */

:root {
    --primary: #1a3fa8;
    --primary-dark: #0f2870;
    --primary-light: #2a5ce8;
    --accent: #f5a623;
    --accent-dark: #d4891a;
    --white: #ffffff;
    --gray-50: #f8fafc;
    --gray-100: #f1f5f9;
    --gray-200: #e2e8f0;
    --gray-600: #475569;
    --gray-700: #334155;
    --gray-900: #0f172a;
    --shadow-sm: 0 2px 8px rgba(26,63,168,0.08);
    --shadow-md: 0 8px 32px rgba(26,63,168,0.12);
    --shadow-lg: 0 20px 60px rgba(26,63,168,0.18);
    --shadow-xl: 0 32px 80px rgba(26,63,168,0.24);
    --radius-sm: 8px;
    --radius-md: 16px;
    --radius-lg: 24px;
    --radius-xl: 32px;
    --transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
}

.blog-page-wrap * { box-sizing: border-box; }

/* =============================================
   BLOG SECTION
   ============================================= */
.blog-main-section {
    background: var(--gray-50);
    padding: 100px 0 80px;
    position: relative;
    overflow: hidden;
}
.blog-main-section::before {
    content: '';
    position: absolute;
    top: -200px; right: -200px;
    width: 600px; height: 600px;
    background: radial-gradient(circle, rgba(26,63,168,0.04) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}

/* Section Header */
.blog-section-header {
    text-align: center;
    margin-bottom: 60px;
}
.section-label-blog {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(26,63,168,0.07);
    border: 1px solid rgba(26,63,168,0.15);
    color: var(--primary);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    padding: 8px 18px;
    border-radius: 50px;
    margin-bottom: 20px;
}
.section-label-blog::before {
    content: '';
    width: 6px; height: 6px;
    background: var(--primary);
    border-radius: 50%;
}
.blog-main-heading {
    font-size: clamp(28px, 3vw, 42px);
    font-weight: 600;
    color: var(--gray-900);
    letter-spacing: -1px;
    line-height: 1.2;
    margin-bottom: 16px;
}
.blog-main-heading .text-highlight {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.blog-sub-para {
    font-size: 16px;
    color: var(--gray-600);
    max-width: 560px;
    margin: 0 auto;
    line-height: 1.75;
}

/* =============================================
   BLOG CARD
   ============================================= */
.blog-card {
    background: #fff;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
    transition: var(--transition);
    height: 100%;
    display: flex;
    flex-direction: column;
}
.blog-card:hover {
    box-shadow: var(--shadow-lg);
    transform: translateY(-6px);
    border-color: transparent;
}

/* Card Image */
.blog-card-img {
    position: relative;
    overflow: hidden;
    height: 230px;
    flex-shrink: 0;
}
.blog-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.55s cubic-bezier(0.4, 0, 0.2, 1);
}
.blog-card:hover .blog-card-img img {
    transform: scale(1.07);
}
.blog-card-img .img-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 40%, rgba(10,26,80,0.45) 100%);
    opacity: 0;
    transition: var(--transition);
}
.blog-card:hover .blog-card-img .img-overlay {
    opacity: 1;
}

/* Category Tag on image */
.blog-card-category {
    position: absolute;
    top: 16px;
    left: 16px;
    background: var(--primary);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    padding: 5px 14px;
    border-radius: 50px;
    z-index: 2;
}

/* Card Body */
.blog-card-body {
    padding: 28px 28px 24px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

/* Meta */
.blog-card-meta {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 16px;
    flex-wrap: wrap;
}
.blog-card-meta .meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 600;
    color: var(--gray-600);
    text-decoration: none;
    transition: var(--transition);
}
.blog-card-meta .meta-item:hover { color: var(--primary); }
.blog-card-meta .meta-item i {
    font-size: 12px;
    color: var(--primary);
}

/* Divider dot */
.blog-card-meta .meta-dot {
    width: 4px; height: 4px;
    background: var(--gray-200);
    border-radius: 50%;
}

/* Title */
.blog-card-title {
    font-size: 17px;
    font-weight: 700;
    color: var(--gray-900);
    line-height: 1.45;
    margin-bottom: 16px;
    flex: 1;
}
.blog-card-title a {
    color: inherit;
    text-decoration: none;
    transition: var(--transition);
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.blog-card-title a:hover { color: var(--primary); }

/* Separator */
.blog-card-sep {
    height: 1px;
    background: var(--gray-200);
    margin-bottom: 20px;
}

/* Read More Button */
.blog-read-more {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--primary);
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    letter-spacing: 0.3px;
    transition: var(--transition);
    align-self: flex-start;
}
.blog-read-more .btn-arrow {
    width: 30px; height: 30px;
    background: rgba(26,63,168,0.08);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px;
    transition: var(--transition);
}
.blog-read-more:hover {
    color: var(--primary-dark);
    text-decoration: none;
}
.blog-read-more:hover .btn-arrow {
    background: var(--primary);
    color: #fff;
    transform: translateX(3px);
}

/* =============================================
   PAGINATION
   ============================================= */
.blog-pagination-wrap {
    display: flex;
    justify-content: center;
    margin-top: 50px;
}
.blog-pagination {
    display: flex;
    align-items: center;
    gap: 8px;
    list-style: none;
    padding: 0;
    margin: 0;
}
.blog-pagination li a,
.blog-pagination li span {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: #fff;
    border: 1px solid var(--gray-200);
    color: var(--gray-700);
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
    cursor: pointer;
}
.blog-pagination li a:hover {
    background: var(--primary);
    border-color: var(--primary);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(26,63,168,0.3);
}
.blog-pagination li a.active,
.blog-pagination li span.active {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border-color: var(--primary);
    color: #fff;
    box-shadow: 0 6px 20px rgba(26,63,168,0.35);
}
.blog-pagination li a.disabled,
.blog-pagination li span.disabled {
    opacity: 0.4;
    cursor: not-allowed;
    pointer-events: none;
}

/* =============================================
   EMPTY STATE
   ============================================= */
.blog-empty-state {
    text-align: center;
    padding: 80px 20px;
    grid-column: 1 / -1;
}
.blog-empty-state .empty-icon {
    width: 80px; height: 80px;
    background: rgba(26,63,168,0.07);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 24px;
    font-size: 32px;
    color: var(--primary);
}
.blog-empty-state h4 { font-size: 22px; font-weight: 700; color: var(--gray-900); margin-bottom: 12px; }
.blog-empty-state p { font-size: 15px; color: var(--gray-600); }

/* =============================================
   SCROLL ANIMATION
   ============================================= */
.fade-up {
    opacity: 0;
    transform: translateY(28px);
    transition: opacity 0.55s ease, transform 0.55s ease;
}
.fade-up.visible {
    opacity: 1;
    transform: translateY(0);
}

/* =============================================
   RESPONSIVE
   ============================================= */
@media (max-width: 991px) {
    .blog-main-section { padding: 70px 0 50px; }
    .blog-card-img { height: 210px; }
}
@media (max-width: 767px) {
    .blog-main-section { padding: 60px 0 40px; }
    .blog-card-body { padding: 22px 20px 20px; }
    .blog-card-img { height: 200px; }
    .blog-card-title { font-size: 15px; }
}
</style>
@endpush

@section('content')
<div class="blog-page-wrap">

    {{-- ===================== BREADCRUMB (original — untouched) ===================== --}}
    @php
        $breadcrumb = isset($page) && $page ? $page->getSection('breadcrumb', ['title' => 'Our Blog', 'background_image' => 'assets/img/barfi/shape/breadcrumb-shape.svg']) : ['title' => 'Our Blog', 'background_image' => 'assets/img/barfi/shape/breadcrumb-shape.svg'];
    @endphp
    <section class="vl-breadcrumb-bg" style="background-image: url({{ asset($breadcrumb['background_image'] ?? 'assets/img/barfi/shape/breadcrumb-shape.svg') }});">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-8 mx-auto text-center mb-30">
                    <div class="vl-breadcrumb-content">
                        <h2 class="title pb-20">{{ $breadcrumb['title'] ?? 'Our Blog' }}</h2>
                        <ul>
                            <li><a href="{{ url("/") }}">Home </a></li>
                            <li><i class="fa-light fa-angle-right"></i></li>
                            <li><a class="active" href="#">Our Blog</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- ===================== END BREADCRUMB ===================== --}}


    {{-- ===================== BLOG SECTION ===================== --}}
    <section id="blog" class="blog-main-section">
        <div class="container">

            {{-- Section Header --}}
            <div class="blog-section-header fade-up">
                <div class="section-label-blog">Artikel & Berita</div>
                <h2 class="blog-main-heading">Wawasan & Informasi Terkini dari <span class="text-highlight">PT. Borneo Iban Jaya Perkasa</span></h2>
                <p class="blog-sub-para">Temukan artikel, tips industri, dan informasi terbaru seputar jasa logam, produksi sparepart, dan solusi industri.</p>
            </div>

            <div class="row">
                @if(isset($blogs) && $blogs->count() > 0)
                    @foreach($blogs as $index => $blog)
                    <div class="col-xl-4 col-md-6 mb-4 fade-up" style="transition-delay: {{ ($index % 3) * 0.1 }}s">
                        <div class="blog-card">
                            <div class="blog-card-img">
                                <div class="img-overlay"></div>
                                <div class="blog-card-category">Artikel</div>
                                @if($blog->image)
                                    <img loading="lazy" src="{{ Str::startsWith($blog->image, 'http') ? $blog->image : asset($blog->image) }}" alt="{{ $blog->title }}">
                                @else
                                    @php
                                        $imageIndex = ($index % 9) + 1;
                                        $imagePath = $imageIndex <= 3 ? "SnowRemovalTwo/blog/vl-blog-2.{$imageIndex}.png" : "SnowRemovalOne/blog/vl-blog-inner1.{$imageIndex}.png";
                                    @endphp
                                    <img loading="lazy" src="{{ asset("assets/img/barfi/{$imagePath}") }}" alt="{{ $blog->title }}">
                                @endif
                            </div>
                            <div class="blog-card-body">
                                <div class="blog-card-meta">
                                    <a href="#" class="meta-item">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        {{ $blog->created_at->format('M d, Y') }}
                                    </a>
                                    <span class="meta-dot"></span>
                                    <a href="#" class="meta-item">
                                        <i class="fa-solid fa-user"></i>
                                        {{ $blog->author ?? 'Admin' }}
                                    </a>
                                </div>
                                <h3 class="blog-card-title">
                                    <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                                </h3>
                                <div class="blog-card-sep"></div>
                                <a href="{{ route('blog.show', $blog->slug) }}" class="blog-read-more">
                                    Baca Selengkapnya
                                    <span class="btn-arrow"><i class="fa-regular fa-arrow-right"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                @else
                    {{-- Hardcoded fallback posts --}}
                    @php
                        $fallbackPosts = [
                            ['img' => 'assets/img/barfi/SnowRemovalTwo/blog/vl-blog-2.1.png',       'date' => 'Aug 23, 2025', 'author' => 'Corina McCoy',     'title' => 'From Storms to Solutions Your Guide to Snow & Ice Management'],
                            ['img' => 'assets/img/barfi/SnowRemovalTwo/blog/vl-blog-2.2.png',       'date' => 'Sep 4, 2025',  'author' => 'Daniel Hamilton',  'title' => 'Winter Preparedness Made Easy Practical Tips You Can Trust'],
                            ['img' => 'assets/img/barfi/SnowRemovalTwo/blog/vl-blog-2.3.png',       'date' => 'Aug 23, 2025', 'author' => 'Mary Freund',      'title' => "Don't Let Snow Slow You Down Pro Tips for a Stress-Free Winter"],
                            ['img' => 'assets/img/barfi/SnowRemovalOne/blog/vl-blog-inner1.4.png',  'date' => 'Sep 16, 2025', 'author' => 'Iva Ryan',         'title' => 'Stay Ahead of the Storm Winter Tips for a Safer Property'],
                            ['img' => 'assets/img/barfi/SnowRemovalOne/blog/vl-blog-inner1.5.png',  'date' => 'Sep 26, 2025', 'author' => 'Alex Buckmaster',  'title' => 'From Driveways to Parking Lots Why Expert Snow Care Matters'],
                            ['img' => 'assets/img/barfi/SnowRemovalOne/blog/vl-blog-inner1.6.png',  'date' => 'Sep 26, 2025', 'author' => 'Frances Swann',    'title' => 'Beat the Ice Before It Builds Smart De-Icing Strategies That Work'],
                            ['img' => 'assets/img/barfi/SnowRemovalOne/blog/vl-blog-inner1.7.png',  'date' => 'Oct 6, 2025',  'author' => 'Corina McCoy',     'title' => 'Winter Maintenance Made Simple Keeping Your Home Clear & Safe'],
                            ['img' => 'assets/img/barfi/SnowRemovalOne/blog/vl-blog-inner1.8.png',  'date' => 'Oct 3, 2025',  'author' => 'Daniel Hamilton',  'title' => 'The Science of Snow Removal Tool Timing and Teamwork in Action'],
                            ['img' => 'assets/img/barfi/SnowRemovalOne/blog/vl-blog-inner1.9.png',  'date' => 'Sep 30, 2025', 'author' => 'Bradley Lawlor',   'title' => 'Winter Weather Warnings How to Prepare Before the First Flake'],
                        ];
                    @endphp
                    @foreach($fallbackPosts as $i => $post)
                    <div class="col-xl-4 col-md-6 mb-4 fade-up" style="transition-delay: {{ ($i % 3) * 0.1 }}s">
                        <div class="blog-card">
                            <div class="blog-card-img">
                                <div class="img-overlay"></div>
                                <div class="blog-card-category">Artikel</div>
                                <img loading="lazy" src="{{ asset($post['img']) }}" alt="{{ $post['title'] }}">
                            </div>
                            <div class="blog-card-body">
                                <div class="blog-card-meta">
                                    <span class="meta-item">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        {{ $post['date'] }}
                                    </span>
                                    <span class="meta-dot"></span>
                                    <span class="meta-item">
                                        <i class="fa-solid fa-user"></i>
                                        {{ $post['author'] }}
                                    </span>
                                </div>
                                <h3 class="blog-card-title">
                                    <a href="{{ url('/blog') }}">{{ $post['title'] }}</a>
                                </h3>
                                <div class="blog-card-sep"></div>
                                <a href="{{ url('/blog') }}" class="blog-read-more">
                                    Baca Selengkapnya
                                    <span class="btn-arrow"><i class="fa-regular fa-arrow-right"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

            {{-- Pagination --}}
            @if(isset($blogs) && $blogs->hasPages())
            <div class="blog-pagination-wrap fade-up">
                <ul class="blog-pagination">
                    {{-- Prev --}}
                    <li>
                        @if($blogs->onFirstPage())
                            <span class="disabled"><i class="fa-regular fa-angle-left"></i></span>
                        @else
                            <a href="{{ $blogs->previousPageUrl() }}"><i class="fa-regular fa-angle-left"></i></a>
                        @endif
                    </li>

                    {{-- Page Numbers --}}
                    @foreach($blogs->getUrlRange(1, $blogs->lastPage()) as $pageNum => $url)
                        <li>
                            @if($pageNum == $blogs->currentPage())
                                <span class="active">{{ $pageNum }}</span>
                            @else
                                <a href="{{ $url }}">{{ $pageNum }}</a>
                            @endif
                        </li>
                    @endforeach

                    {{-- Next --}}
                    <li>
                        @if($blogs->hasMorePages())
                            <a href="{{ $blogs->nextPageUrl() }}"><i class="fa-regular fa-angle-right"></i></a>
                        @else
                            <span class="disabled"><i class="fa-regular fa-angle-right"></i></span>
                        @endif
                    </li>
                </ul>
            </div>
            @endif

        </div>
    </section>
    {{-- ===================== END BLOG SECTION ===================== --}}

    @include('partials.cta')

    <!-- progress -->
    <div class="paginacontainer">
        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
            </svg>
        </div>
    </div>

</div>

<script>
(function () {
    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });

    document.querySelectorAll('.fade-up').forEach(function (el) {
        observer.observe(el);
    });
})();
</script>
@endsection
