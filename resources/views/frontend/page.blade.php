@extends('layouts.frontend')

@push('head')
@php
    $breadcrumbs = [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => $page->title, 'url' => url('/page/' . $page->slug)]
    ];
@endphp
@include('partials.schema', ['schemaType' => 'breadcrumb', 'breadcrumbs' => $breadcrumbs])
@include('partials.schema', ['schemaType' => 'organization'])
@include('partials.schema', ['schemaType' => 'webpage', 'page' => $page])
@endpush

@section('content')

    <!--================= Breadcrumb section start =================-->
    <section class="vl-breadcrumb-bg" style="background-image: url({{ asset('assets/img/barfi/shape/breadcrumb-shape.svg') }});">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 mx-auto text-center mb-30">
                    <div class="vl-breadcrumb-content">
                        <h2 class="title pb-20">{{ $page->title }}</h2>
                        <ul>
                            <li><a href="{{ url("/") }}">Home </a></li>
                            <li><i class="fa-light fa-angle-right"></i></li>
                            <li><a class="active" href="#">{{ $page->title }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================= Breadcrumb section End =================-->

    <!--================= Page Content section start =================-->
    <section class="vl-about vkl-gray-bg-1 fix pt-100 pb-70">
        <div class="container">
            @if($page->featured_image)
            <div class="row mb-60">
                <div class="col-xl-12">
                    <div class="vl-about-thumb2">
                        <img loading="lazy" src="{{ asset($page->featured_image) }}" alt="{{ $page->title }}">
                        <img loading="lazy" src="{{ asset($page->featured_image) }}" alt="{{ $page->title }}">
                    </div>
                </div>
            </div>
            @endif

            <!-- Main Content -->
            @if($page->content)
            <div class="row mb-60">
                <div class="col-xl-12">
                    <div class="vl-about-content2">
                        <div class="page-main-content" style="font-size: 16px; line-height: 1.8; color: #333;">
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Dynamic Sections -->
            @if($page->sections && count($page->sections) > 0)
                @foreach($page->sections as $index => $section)
                    @php $sectionType = $section['type'] ?? 'text'; @endphp
                    @if($sectionType === 'text')
                        <!-- Text Section -->
                        <div class="row mb-60">
                            <div class="col-xl-12">
                                <div class="vl-about-content2">
                                    @if(!empty($section['title']))
                                    <div class="vl-section-title mb-40">
                                        <h2 class="title text-effect">{{ $section['title'] }}</h2>
                                    </div>
                                    @endif
                                    <div class="section-content" style="font-size: 16px; line-height: 1.8; color: #555;">
                                        {!! nl2br(e($section['content'])) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($sectionType === 'image_text')
                        <!-- Image + Text Section -->
                        <div class="row align-items-center mb-60 {{ $index % 2 == 0 ? '' : 'flex-row-reverse' }}">
                            <div class="col-xl-6 col-lg-6 mb-30">
                                <div class="vl-about-content2">
                                    @if(!empty($section['title']))
                                    <div class="vl-section-title mb-40">
                                        <h2 class="title text-effect">{{ $section['title'] }}</h2>
                                    </div>
                                    @endif
                                    <div class="section-content" style="font-size: 16px; line-height: 1.8; color: #555;">
                                        {!! nl2br(e($section['content'])) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 mb-30">
                                @if(!empty($section['image']))
                                <div class="vl-about-thumb2">
                                    <img loading="lazy" src="{{ asset($section['image']) }}" alt="{{ $section['title'] ?? 'Image' }}">
                                    <img loading="lazy" src="{{ asset($section['image']) }}" alt="{{ $section['title'] ?? 'Image' }}">
                                </div>
                                @else
                                <div class="vl-about-thumb2" style="background: #f5f5f5; min-height: 300px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                                    <p class="text-muted">No image</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    @elseif($sectionType === 'cta')
                        <!-- Call to Action Section -->
                        <div class="row mb-60">
                            <div class="col-xl-12">
                                <div class="vl-choose-content5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 60px 40px; border-radius: 20px; text-align: center;">
                                    @if(!empty($section['title']))
                                    <div class="vl-section-title mb-30">
                                        <h2 class="title text-white">{{ $section['title'] }}</h2>
                                    </div>
                                    @endif
                                    <p class="para text-white mb-40" style="font-size: 18px; line-height: 1.8;">
                                        {!! nl2br(e($section['content'])) !!}
                                    </p>
                                    <a href="{{ url('/contact') }}" class="vl-primary-btn5">
                                        <span class="arrow1"><i class="fa-regular fa-arrow-right"></i></span>
                                        Hubungi Kami
                                        <span class="arrow2"><i class="fa-regular fa-arrow-right"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @elseif($sectionType === 'features')
                        <!-- Features Grid Section -->
                        <div class="row mb-60">
                            <div class="col-xl-12 text-center mb-50">
                                @if(!empty($section['title']))
                                <div class="vl-section-title">
                                    <h2 class="title text-effect">{{ $section['title'] }}</h2>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            @php
                                $features = explode("\n", $section['content']);
                            @endphp
                            @foreach($features as $featureIndex => $feature)
                                @if(trim($feature))
                                <div class="col-xl-4 col-md-6 mb-30">
                                    <div class="vl-about-iconbox3 vl-about-iconbox3-inner">
                                        <div class="icon">
                                            <span><i class="fa-solid fa-check-circle" style="color: #667eea; font-size: 32px;"></i></span>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">{{ trim($feature) }}</h4>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </section>
    <!--================= Page Content section End =================-->

    @include('partials.cta')

    <!-- progress -->
    <div class="paginacontainer">
        <div class="progress-wrap progress-wrap-2">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
            </svg>
        </div>
    </div>

@endsection

@push('css')
<style>
    /* Page Content Styling */
    .page-main-content {
        font-size: 16px;
        line-height: 1.8;
        color: #333;
    }

    .page-main-content h1,
    .page-main-content h2,
    .page-main-content h3,
    .page-main-content h4,
    .page-main-content h5,
    .page-main-content h6 {
        color: #1a1a1a;
        font-weight: 600;
        margin-top: 30px;
        margin-bottom: 20px;
        line-height: 1.3;
    }

    .page-main-content h1 {
        font-size: 2.5rem;
    }

    .page-main-content h2 {
        font-size: 2rem;
    }

    .page-main-content h3 {
        font-size: 1.75rem;
    }

    .page-main-content h4 {
        font-size: 1.5rem;
    }

    .page-main-content p {
        margin-bottom: 20px;
        color: #555;
    }

    .page-main-content ul,
    .page-main-content ol {
        margin-bottom: 20px;
        padding-left: 30px;
    }

    .page-main-content ul li,
    .page-main-content ol li {
        margin-bottom: 10px;
        color: #555;
        line-height: 1.8;
    }

    .page-main-content ul li {
        list-style-type: disc;
    }

    .page-main-content ol li {
        list-style-type: decimal;
    }

    .page-main-content a {
        color: #667eea;
        text-decoration: none;
        transition: all 0.3s;
    }

    .page-main-content a:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    .page-main-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
    }

    .page-main-content blockquote {
        border-left: 4px solid #667eea;
        padding-left: 20px;
        margin: 20px 0;
        font-style: italic;
        color: #666;
    }

    .page-main-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .page-main-content table th,
    .page-main-content table td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .page-main-content table th {
        background-color: #f5f5f5;
        font-weight: 600;
    }

    .page-main-content code {
        background-color: #f4f4f4;
        padding: 2px 6px;
        border-radius: 4px;
        font-family: 'Courier New', monospace;
        font-size: 0.9em;
    }

    .page-main-content pre {
        background-color: #f4f4f4;
        padding: 15px;
        border-radius: 8px;
        overflow-x: auto;
        margin: 20px 0;
    }

    .page-main-content pre code {
        background-color: transparent;
        padding: 0;
    }

    /* Section Content Styling */
    .section-content {
        font-size: 16px;
        line-height: 1.8;
        color: #555;
    }

    .section-content p {
        margin-bottom: 15px;
    }

    .section-content ul,
    .section-content ol {
        margin-bottom: 15px;
        padding-left: 25px;
    }

    .section-content li {
        margin-bottom: 8px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-main-content h1 {
            font-size: 2rem;
        }

        .page-main-content h2 {
            font-size: 1.75rem;
        }

        .page-main-content h3 {
            font-size: 1.5rem;
        }

        .page-main-content {
            font-size: 15px;
        }
    }
</style>
@endpush
