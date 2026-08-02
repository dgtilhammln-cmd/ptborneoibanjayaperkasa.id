@extends('layouts.frontend')

@push('head')
@php
    $breadcrumbs = [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Blog', 'url' => url('/blog')],
        ['name' => $blog->title, 'url' => url('/blog/' . $blog->slug)]
    ];
@endphp
@include('partials.schema', ['schemaType' => 'breadcrumb', 'breadcrumbs' => $breadcrumbs])
@include('partials.schema', ['schemaType' => 'organization'])
@include('partials.schema', ['schemaType' => 'blogposting', 'blog' => $blog])
@endpush

@section('content')
<!--================= Breadcrumb section start =================-->
<section class="vl-breadcrumb-bg" style="background-image: url({{ asset('assets/img/shape/breadcrumb-shape.svg') }});">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-8 mx-auto text-center mb-30">
                <div class="vl-breadcrumb-content">
                    <h2 class="title pb-20">Detail Blog</h2>
                    <ul>
                        <li><a href="{{ url('/') }}">Home </a></li>
                        <li><i class="fa-light fa-angle-right"></i></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li><i class="fa-light fa-angle-right"></i></li>
                        <li><a class="active" href="#">{{ $blog->title }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================= Breadcrumb section End =================-->

<!--================= Premium Blog Detail Section Start =================--> 
<section class="vl-service-details-inner pt-100 pb-70" style="background-color: #f8fafc; font-family: 'Montserrat', sans-serif;">
    <div class="container">
        <div class="row g-4">
            <!-- MAIN CONTENT AREA -->
            <div class="col-lg-8 mb-30">
               <div style="background: #fff; padding: 40px; border-radius: 32px; box-shadow: 0 15px 50px rgba(15, 36, 83, 0.05); border: 1px solid #f1f1f1;">
                    
                    <!-- Header Meta & Title -->
                    <div class="mb-30">
                        <span style="background: #eef2ff; color: #1E3A8A; padding: 6px 16px; border-radius: 50px; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; display: inline-block; margin-bottom: 20px;">Berita & Wawasan</span>
                        <h1 style="font-size: clamp(28px, 4vw, 42px); color: #0F2453; font-weight: 600; line-height: 1.3; margin-bottom: 25px;">{{ $blog->title }}</h1>
                        
                        <div style="display: flex; gap: 20px; flex-wrap: wrap; padding-bottom: 25px; border-bottom: 1px solid #f0f0f0;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 35px; height: 35px; background: #f0f4f8; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-user" style="color: #0F2453; font-size: 14px;"></i>
                                </div>
                                <div>
                                    <small style="display: block; color: #7C8192; font-size: 10px; font-weight: 700; text-transform: uppercase;">Penulis</small>
                                    <span style="font-weight: 700; color: #0F2453; font-size: 14px;">{{ $blog->author ?? 'Admin BIJP' }}</span>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 35px; height: 35px; background: #f0f4f8; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-calendar-days" style="color: #0F2453; font-size: 14px;"></i>
                                </div>
                                <div>
                                    <small style="display: block; color: #7C8192; font-size: 10px; font-weight: 700; text-transform: uppercase;">Diterbitkan</small>
                                    <span style="font-weight: 700; color: #0F2453; font-size: 14px;">{{ $blog->created_at->format('d M, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Featured Image -->
                    @if($blog->image)
                    <div style="border-radius: 24px; overflow: hidden; margin-bottom: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                        <img loading="lazy" src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" style="width: 100%; height: auto; display: block; object-fit: cover;">
                    </div>
                    @endif

                    <!-- Blog Body Content -->
                    <div style="font-size: 17px; color: #4b5563; line-height: 1.9; margin-bottom: 40px;">
                        <style>
                            .blog-rich-content p { margin-bottom: 25px; }
                            .blog-rich-content h2, .blog-rich-content h3 { color: #0F2453; font-weight: 600; margin-top: 40px; margin-bottom: 20px; }
                            .blog-rich-content img { border-radius: 16px; margin: 20px 0; max-width: 100%; }
                        </style>
                        <div class="blog-rich-content">
                            {!! $blog->content !!}
                        </div>
                    </div>

                    <!-- Tags & Social Share -->
                    <div style="padding-top: 30px; border-top: 1px solid #f0f0f0;">
                        <div class="row align-items-center g-4">
                            <div class="col-md-7">
                                @if($blog->meta_keywords)
                                <div style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center;">
                                    <span style="font-weight: 600; color: #0F2453; font-size: 12px; margin-right: 10px; text-transform: uppercase;">Tags:</span>
                                    @foreach(explode(',', $blog->meta_keywords) as $keyword)
                                    <a href="{{ route('blog') }}?tag={{ trim($keyword) }}" style="background: #f0f4f8; color: #1E3A8A; padding: 6px 15px; border-radius: 50px; font-size: 12px; font-weight: 700; text-decoration: none; transition: 0.3s;">#{{ trim($keyword) }}</a>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            <div class="col-md-5 text-md-end">
                                <div style="display: flex; gap: 10px; justify-content: md-end; align-items: center;">
                                    <span style="font-weight: 600; color: #0F2453; font-size: 12px; text-transform: uppercase;">Share:</span>
                                    @php
                                        $shareUrl = urlencode(url('/blog/' . $blog->slug));
                                        $shareTitle = urlencode($blog->title);
                                    @endphp
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" style="width: 35px; height: 35px; border-radius: 10px; background: #3b5998; color: #fff; display: flex; align-items: center; justify-content: center; text-decoration: none;"><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" style="width: 35px; height: 35px; border-radius: 10px; background: #000; color: #fff; display: flex; align-items: center; justify-content: center; text-decoration: none;"><i class="fa-brands fa-x-twitter"></i></a>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareUrl }}&title={{ $shareTitle }}" target="_blank" style="width: 35px; height: 35px; border-radius: 10px; background: #0077b5; color: #fff; display: flex; align-items: center; justify-content: center; text-decoration: none;"><i class="fa-brands fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SIDEBAR AREA -->
            <div class="col-lg-4 mb-30">
                <div class="vl-sidebar" style="position: sticky; top: 100px;">
                    
                    <!-- Search Widget -->
                     <div style="background: #fff; padding: 30px; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid #f1f1f1; margin-bottom: 30px;">
                        <h4 style="font-size: 18px; color: #0F2453; font-weight: 600; margin-bottom: 20px; border-left: 4px solid #0F2453; padding-left: 15px;">Pencarian</h4>
                        <div style="position: relative;">
                            <form action="{{ route('blog') }}" method="GET">
                                <input type="text" name="search" placeholder="Cari artikel..." value="{{ request('search') }}" style="width: 100%; padding: 12px 20px; border-radius: 12px; border: 1px solid #dee5f2; background: #fcfdfe; font-size: 14px; outline: none;">
                                <button type="submit" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); border: none; background: transparent; color: #0F2453;"><i class="fa-regular fa-magnifying-glass"></i></button>
                            </form>
                        </div>
                     </div>

                    <!-- Service Category Widget -->
                    <div style="background: #fff; padding: 30px; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid #f1f1f1; margin-bottom: 30px;">
                        <h4 style="font-size: 18px; color: #0F2453; font-weight: 600; margin-bottom: 20px; border-left: 4px solid #0F2453; padding-left: 15px;">Layanan Presisi</h4>
                        <div class="vl-service-list">
                            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px;">
                                @php
                                    $services = \App\Models\Service::latest()->take(5)->get();
                                @endphp
                                @foreach($services as $s)
                                <li>
                                    <a href="{{ url('/services/' . $s->slug) }}" style="display: flex; justify-content: space-between; align-items: center; padding: 12px 15px; background: #f8faff; border-radius: 12px; color: #4b5563; text-decoration: none; font-weight: 600; font-size: 13px; transition: 0.3s;">
                                        {{ $s->name }} 
                                        <i class="fa-regular fa-chevron-right" style="font-size: 10px; color: #1E3A8A;"></i>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Recent Posts Widget -->
                    @if($relatedBlogs && $relatedBlogs->count() > 0)
                    <div style="background: #fff; padding: 30px; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid #f1f1f1; margin-bottom: 30px;">
                        <h4 style="font-size: 18px; color: #0F2453; font-weight: 600; margin-bottom: 20px; border-left: 4px solid #0F2453; padding-left: 15px;">Artikel Terkini</h4>
                        <div style="display: flex; flex-direction: column; gap: 20px;">
                            @foreach($relatedBlogs->take(3) as $related)
                            <div style="display: flex; gap: 15px; align-items: center;">
                                <div style="width: 70px; height: 70px; border-radius: 12px; overflow: hidden; flex-shrink: 0; background: #eee;">
                                    <a href="{{ url('/blog/' . $related->slug) }}">
                                        @if($related->image)
                                        <img loading="lazy" src="{{ asset($related->image) }}" alt="{{ $related->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                        <img loading="lazy" src="{{ asset('assets/images/blog-placeholder.jpg') }}" alt="{{ $related->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @endif
                                    </a>
                                </div>
                                <div>
                                    <small style="color: #7C8192; font-size: 11px; font-weight: 600; display: block; margin-bottom: 5px;">{{ $related->created_at->format('M d, Y') }}</small>
                                    <h5 style="font-size: 13px; line-height: 1.4; font-weight: 700; margin: 0;">
                                        <a href="{{ url('/blog/' . $related->slug) }}" style="color: #0F2453; text-decoration: none;">{{ Str::limit($related->title, 50) }}</a>
                                    </h5>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Follow Us Widget -->
                    <div style="background: #0F2453; padding: 30px; border-radius: 24px; box-shadow: 0 15px 40px rgba(15, 36, 83, 0.2); color: #fff;">
                        <h4 style="font-size: 18px; color: #fff; font-weight: 800; margin-bottom: 20px;">Ikuti Kami</h4>
                        <div style="display: flex; gap: 12px;">
                            <a href="https://facebook.com/pt_bijp" target="_blank" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; transition: 0.3s;"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://tiktok.com/@pt_bijp" target="_blank" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; transition: 0.3s;"><i class="fa-brands fa-tiktok"></i></a>
                            <a href="https://instagram.com/pt_bijp" target="_blank" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; transition: 0.3s;"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--================= Other Blogs Section start =================-->
@if($relatedBlogs && $relatedBlogs->count() > 0)
<section id="other-blogs" class="vl-service-iner vkl-gray-bg-1 fix pt-100 pb-70" style="background-color: #f1f5f9;">
    <div class="container">
        <div class="row mb-50">
            <div class="col-xl-12 text-center">
                <span style="color: #1E3A8A; font-weight: 800; font-size: 12px; text-transform: uppercase; letter-spacing: 2px;">Rekomendasi</span>
                <h3 style="font-size: 32px; color: #0F2453; font-weight: 800; margin-top: 10px;">Artikel Lainnya</h3>
            </div>
        </div>
        <div class="row g-4">
            @foreach($relatedBlogs->take(3) as $related)
            <div class="col-xl-4 col-md-6 mb-20">
                <div style="background: #fff; border-radius: 28px; overflow: hidden; border: 1px solid #f1f1f1; box-shadow: 0 10px 30px rgba(15, 36, 83, 0.03); height: 100%; display: flex; flex-direction: column;">
                    <div style="aspect-ratio: 16/10; overflow: hidden;">
                         @php
                            $relImg = $related->image ? asset($related->image) : asset('assets/images/blog-placeholder.jpg');
                         @endphp
                        <img loading="lazy" src="{{ $relImg }}" alt="{{ $related->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="padding: 30px; flex-grow: 1; display: flex; flex-direction: column;">
                        <div style="display: flex; gap: 15px; margin-bottom: 15px; font-size: 12px; color: #7C8192; font-weight: 700;">
                            <span><i class="fa-solid fa-calendar-days" style="color: #1E3A8A;"></i> {{ $related->created_at->format('d M, Y') }}</span>
                            <span><i class="fa-solid fa-user" style="color: #1E3A8A;"></i> {{ $related->author ?? 'Admin' }}</span>
                        </div>
                        <h3 style="font-size: 18px; line-height: 1.4; font-weight: 800; margin-bottom: 20px;">
                            <a href="{{ url('/blog/' . $related->slug) }}" style="color: #0F2453; text-decoration: none;">{{ Str::limit($related->title, 65) }}</a>
                        </h3>
                        <div style="margin-top: auto; padding-top: 15px; border-top: 1px solid #f0f0f0;">
                            <a href="{{ url('/blog/' . $related->slug) }}" style="color: #1E3A8A; font-weight: 800; font-size: 13px; text-decoration: none; display: flex; justify-content: space-between; align-items: center;">
                                Baca Selengkapnya
                                <span style="width: 28px; height: 28px; background: #eef2ff; border-radius: 50%; display: flex; align-items: center; justify-content: center;"><i class="fa-regular fa-arrow-right" style="font-size: 12px;"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!--================= Other Blogs Section End =================-->

@include('partials.cta')

@push('js')
<script>
// Track blog view
(function() {
    function trackBlog() {
        if (typeof window.trackBlogView === 'function') {
            window.trackBlogView({{ $blog->id }});
        } else {
            // Retry after a short delay if function not yet available
            setTimeout(trackBlog, 100);
        }
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', trackBlog);
    } else {
        trackBlog();
    }
})();
</script>
@php
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $blog->title,
        'description' => strip_tags(Str::limit($blog->content, 200)),
        'image' => $blog->image ? url($blog->image) : asset('assets/images/post-1.jpg'),
        'datePublished' => $blog->created_at->toIso8601String(),
        'dateModified' => $blog->updated_at->toIso8601String(),
        'author' => [
            '@type' => 'Organization',
            'name' => \App\Models\Setting::get('site_name', 'Borneo Jaya')
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => \App\Models\Setting::get('site_name', 'Borneo Jaya'),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('assets/images/logo.svg')
            ]
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => url('/blog/' . $blog->slug)
        ],
        'url' => url('/blog/' . $blog->slug)
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endpush
@endsection

