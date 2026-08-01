@extends("layouts.frontend")

@push('head')
@include('partials.schema', ['schemaType' => 'organization'])
@include('partials.schema', ['schemaType' => 'website'])

@if($bannerSlider && $bannerSlider->is_active && !empty($slider_slides) && !empty($slider_slides[0]['background_image']))
@php
    $lcpImage = $slider_slides[0]['background_image'];
    $lcpImageUrl = Str::startsWith($lcpImage, 'http') ? $lcpImage : asset($lcpImage);
@endphp
<!-- Preload LCP Image for better performance -->
<link rel="preload" as="image" href="{{ $lcpImageUrl }}" fetchpriority="high">
@endif
@endpush

@section("content")


    <!--================= Banner section start =================-->
    @if($bannerSlider && $bannerSlider->is_active && !empty($slider_slides))
    <div class="banner-wrap5 fix">
    <div class="swiper mySwiper3">
      <div class="swiper-wrapper">
            @foreach($slider_slides as $slide)
            <div class="swiper-slide">
                <div class="vl-banner-area-3 fix">
                    <div class="banner-thumb-bg banner-thumb-bg-5">
                        <!-- banner thumb bg -->
                        <img class="banner-thumb3" src="{{ !empty($slide['background_image']) ? (Str::startsWith($slide['background_image'], 'http') ? $slide['background_image'] : asset($slide['background_image'])) : asset('assets/img/barfi/Landscaping/banner/banner-thumb-bg-5.1.png') }}" alt="PT. Borneo Iban Jaya Perkasa" fetchpriority="high" loading="eager" width="1920" height="1080">
                        <div class="container">
                            <div class="row">
                                <!-- banner padding -->
                                <div class="vl-banner-five-padding fix">
                                    <div class="banner-wraper-five-flex">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="vl-banner-content-5">
                                                    <!-- section title start -->
                                                    <div class="vl-section-title mb-76">
                                                        <div class="review-blox-flex5">
                                                            <!-- review icon -->
                                                            <div class="review-icon">
                                                                <ul>
                                                                    <li><i class="fa-solid fa-star"></i></li>
                                                                    <li><i class="fa-solid fa-star"></i></li>
                                                                    <li><i class="fa-solid fa-star"></i></li>
                                                                    <li><i class="fa-solid fa-star"></i></li>
                                                                    <li><i class="fa-solid fa-star"></i></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-number">
                                                                <h4 class="num">{{ $slide['rating'] ?? '5.0' }}</h4>
                                                            </div>
                                                            <div class="total-review">
                                                                <p class="para">{{ $slide['rating_text'] ?? '(Terpercaya)' }}</p>
                                                            </div>
                                                        </div>
                                                        <h1 class="title text-anime-style-2" style="min-height: 80px;">{{ $slide['title'] ?? 'Pabrik Fabrikasi Logam & Produsen Sparepart Presisi Sidoarjo' }}</h1>
                                                        <p class="para pt-16 pb-32" style="min-height: 100px;">{{ $slide['description'] ?? 'Spesialis potong, tekuk, dan plong plat besi dengan standar kualitas industri. Melayani produksi massal komponen otomotif, alat pertanian, dan bracket custom.' }}</p>
                                                    
                                                        <div class="vl-banner-btn-flex5 row gx-3 gy-2 align-items-stretch">
                                                            @if(!empty($slide['button1_text']) && !empty($slide['button1_link']))
                                                            <div class="col-auto d-flex">
                                                                <a href="{{ $slide['button1_link'] }}" class="vl-primary-btn5 w-100 d-inline-flex align-items-center justify-content-center"
                                                                   data-track-cta="banner_button"
                                                                   data-track-label="{{ $slide['button1_text'] }}"
                                                                   data-track-url="{{ $slide['button1_link'] }}">
                                                                    <span class="arrow1"><i class="fa-regular fa-arrow-right"></i></span>
                                                                    {{ $slide['button1_text'] }}
                                                                    <span class="arrow2"><i class="fa-regular fa-arrow-right"></i></span>
                                                                </a>
                                                            </div>
                                                            @endif
                                                            @if(!empty($slide['button2_text']))
                                                                <div class="col-auto d-flex">
                                                                    @if(($slide['button2_type'] ?? 'modal') == 'modal')
                                                                    <button type="button"
                                                                            class="vl-primary-btn5 vl-primary-btn5-sec w-100 d-inline-flex align-items-center justify-content-center"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#requestQuoteModal"
                                                                            data-track-cta="modal"
                                                                            data-track-label="{{ $slide['button2_text'] }}">
                                                                        <span class="arrow1"><i class="fa-regular fa-arrow-right"></i></span>
                                                                        {{ $slide['button2_text'] }}
                                                                        <span class="arrow2"><i class="fa-regular fa-arrow-right"></i></span>
                                                                    </button>
                                                                    @else
                                                                    <a href="{{ $slide['button2_link'] ?? '#' }}"
                                                                       class="vl-primary-btn5 vl-primary-btn5-sec w-100 d-inline-flex align-items-center justify-content-center"
                                                                       data-track-cta="banner_button"
                                                                       data-track-label="{{ $slide['button2_text'] }}"
                                                                       data-track-url="{{ $slide['button2_link'] ?? '#' }}">
                                                                        <span class="arrow1"><i class="fa-regular fa-arrow-right"></i></span>
                                                                        {{ $slide['button2_text'] }}
                                                                        <span class="arrow2"><i class="fa-regular fa-arrow-right"></i></span>
                                                                    </a>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div> <!-- section title End -->

                                                    <div class="vl-auth-main-flex5">
                                                    <div class="vl-star-content5">
                                                        <div class="icon">
                                                            <i class="fa-solid fa-star"></i>
                                                        </div>
                                                        <p class="para">{{ $slide['trust_text'] ?? 'Terpercaya dengan' }} <br class="d-none d-xl-block"> {{ !empty($slide['trust_text']) ? '' : 'pengalaman sejak 2007' }}</p>
                                                    </div>
                                                    <div class="vl-group-thumb">
                                                        <img w src="{{ !empty($slide['trust_image']) ? (Str::startsWith($slide['trust_image'], 'http') ? $slide['trust_image'] : asset($slide['trust_image'])) : asset('assets/img/barfi/Landscaping/banner/vl-banner-auth5.png') }}" alt="PT. Borneo Iban Jaya Perkasa" loading="lazy" width="200" height="auto">
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="vl-sm-thumb-mtop">
      <div class="container">
        <div class="row">
          <div class="col-xl-6"></div>
          <div class="col-xl-6 mb-60">
            <div class="swiper mySwiperthumb">
                <div class="swiper-wrapper">
                @foreach($slider_slides as $index => $slide)
                <div class="swiper-slide">
                  <div class="vl-sm-thumb3">
                    <img src="{{ !empty($slide['background_image']) ? (Str::startsWith($slide['background_image'], 'http') ? $slide['background_image'] : asset($slide['background_image'])) : asset('assets/img/barfi/Landscaping/banner/banner-thumb-bg-5.1.png') }}" alt="{{ $slide['title'] ?? 'PT. Borneo Iban Jaya Perkasa' }}" loading="lazy" width="300" height="200">
                  </div>
                </div>
                @endforeach
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
    </div>
    @endif
    <!--================= Banner section End =================-->

<!--================= Premium About Section Start =================-->
@if($aboutSection && $aboutSection->is_active)
<section id="about" class="vl-about-premium py-5" style="background-color: #fafbfc; font-family: 'Montserrat', sans-serif; overflow: hidden;">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            
            <!-- 1. SISI KIRI: Image Composition (Premium Overlapping Style) -->
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <div style="position: relative; padding-right: 15%; padding-bottom: 10%;">
                    
                    @php
                        $img1 = $aboutSection->image ? (Str::startsWith($aboutSection->image, 'http') ? $aboutSection->image : asset($aboutSection->image)) : asset("assets/img/barfi/Landscaping/about/vl-about-5.1.png");
                        $img2 = $aboutSection->image_2 ? (Str::startsWith($aboutSection->image_2, 'http') ? $aboutSection->image_2 : asset($aboutSection->image_2)) : asset("assets/img/barfi/Landscaping/about/vl-about-5.2.png");
                    @endphp

                    <!-- Main Image -->
                    <div style="border-radius: 24px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(15, 36, 83, 0.15);">
                        <img src="{{ $img1 }}" alt="PT. Borneo Iban Jaya Perkasa" style="width: 100%; aspect-ratio: 4/5; object-fit: cover; display: block; transition: transform 0.7s ease;" onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
                    </div>

                    <!-- Secondary Image (Overlapping Bottom Right) -->
                    <div style="position: absolute; bottom: 0; right: 0; width: 55%; border-radius: 20px; overflow: hidden; border: 8px solid #fafbfc; box-shadow: 0 20px 40px rgba(0,0,0,0.1);" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ $img2 }}" alt="Workshop PT. BIJP" style="width: 100%; aspect-ratio: 4/3; object-fit: cover; display: block;">
                    </div>

<!-- Floating Badge (Top Left) - FIXED -->
<div style="position: absolute; top: 40px; left: -20px; background: linear-gradient(135deg, #1E3A8A 0%, #003bc7 100%); padding: 16px 24px; border-radius: 16px; box-shadow: 0 15px 30px rgba(15, 36, 83, 0.3); display: flex; align-items: center; gap: 15px; z-index: 2;" data-aos="zoom-in" data-aos-delay="200">
    
    <!-- Ikon Baru: Medali Emas (Premium) -->
    <div style="background: rgba(251, 191, 36, 0.15); padding: 10px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FBBF24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="8" r="7"></circle>
            <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
        </svg>
    </div>

    <!-- Teks Pengalaman -->
    <div>
        <!-- Warna dipaksa putih agar tidak terpengaruh CSS template bawaan -->
        <h4 style="margin: 0; font-size: 26px; font-weight: 800; line-height: 1; color: #ffffff;">19+</h4>
        <span style="font-size: 11px; text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px; color: #cbd5e1; display: block; margin-top: 4px;">
            Tahun Pengalaman
        </span>
    </div>
    
</div>

                </div>
            </div>

            <!-- 2. SISI KANAN: Text Content -->
            <div class="col-lg-6 ps-lg-4">
                <div class="vl-about-content">
                    
                    <!-- Subtitle Premium -->
                    <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(30, 58, 138, 0.08); padding: 8px 16px; border-radius: 30px; margin-bottom: 20px;" data-aos="fade-up">
                        <!-- New Clean SVG Icon -->
                        <span style="font-size: 13px; font-weight: 700; color: #003bc7; text-transform: uppercase; letter-spacing: 1.5px;">
                            {{ $aboutSection->title ?? 'Tentang Kami' }}
                        </span>
                    </div>

                    <!-- Heading Utama -->
<h2 style="font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; font-size: clamp(28px, 4vw, 42px); color: #111827; font-weight: 700; line-height: 1.2; margin-bottom: 25px; letter-spacing: -1px;" data-aos="fade-up" data-aos-delay="100">
    {{ $aboutSection->heading ?? 'Solusi Terpercaya untuk Jasa Logam & Produksi Sparepart' }}
</h2>

                    <!-- Deskripsi -->
                    <p style="font-size: 16px; color: #64748B; line-height: 1.7; margin-bottom: 30px;" data-aos="fade-up" data-aos-delay="150">
                        {{ $aboutSection->content ?? 'PT. Borneo Iban Jaya Perkasa adalah perusahaan yang bergerak di bidang jasa logam, plong, dan produksi aksesori serta suku cadang berkualitas tinggi sejak 2007.Kami Melayani Kebutuhan industri dan otomotif dengan komitmen terhadap kualitas dan kepuasan perusahaan pelanggan' }}
                    </p>

                    <!-- Poin Keunggulan (Opsional, memberi kesan premium) -->
                    <div class="row g-3 mb-40" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-sm-6">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="background: #E0F2FE; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #0284C7;">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </div>
                                <span style="font-size: 14px; font-weight: 600; color: #0F2453;">Material Kualitas Terbaik</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="background: #E0F2FE; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #0284C7;">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </div>
                                <span style="font-size: 14px; font-weight: 600; color: #0F2453;">Teknisi Berpengalaman</span>
                            </div>
                        </div>
                    </div>

                    <!-- Button Premium -->
                    <div class="mt-4" data-aos="fade-up" data-aos-delay="250">
                        <a href="{{ url('/about') }}" class="premium-btn" style="display: inline-flex; align-items: center; gap: 10px; background: #0F2453; color: #fff; padding: 15px 32px; border-radius: 12px; text-decoration: none; font-weight: 600; font-size: 15px; transition: all 0.3s ease; box-shadow: 0 8px 20px rgba(15, 36, 83, 0.2);" onmouseover="this.style.background='#'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#003bc7'; this.style.transform='translateY(0)';">
                            Lihat Lebih Lanjut
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.3s ease;" class="btn-arrow"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endif
<!--================= Premium About Section End =================-->

<!--================= Premium Products Section Start =================-->
@if($productsSection && $productsSection->is_active)

<!-- CSS Scoped untuk Fitur Swipe Mobile -->
<style>
    @media (max-width: 768px) {
        .product-swipe-row {
            display: flex !important;
            flex-wrap: nowrap !important;
            overflow-x: auto !important;
            scroll-snap-type: x mandatory !important;
            gap: 15px !important;
            padding-bottom: 25px !important;
            margin-left: -15px;
            margin-right: -15px;
            padding-left: 15px;
            padding-right: 15px;
        }
        .product-swipe-row::-webkit-scrollbar {
            display: none;
        }
        .product-swipe-col {
            flex: 0 0 75% !important; /* Ukuran kartu di HP */
            scroll-snap-align: center !important;
        }
    }
</style>

<section id="products" class="py-5" style="background-color: #ffffff; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
    <div class="container py-4">
        
        <!-- Header Section -->
        <div class="row mb-5 justify-content-center">
            <div class="col-lg-7 text-center">
                <!-- Subtitle Badge -->
                <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(30, 58, 138, 0.08); padding: 8px 16px; border-radius: 30px; margin-bottom: 20px;" data-aos="fade-up">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1E3A8A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    <span style="font-size: 13px; font-weight: 700; color: #1E3A8A; text-transform: uppercase; letter-spacing: 1.5px;">
                        {{ $productsSection->subtitle ?? 'Katalog Produk' }}
                    </span>
                </div>

                <!-- Heading Utama (Style 100% Sama dengan Request) -->
                <h2 style="font-size: clamp(28px, 4vw, 40px); color: #111827; font-weight: 700; line-height: 1.2; letter-spacing: -1px; margin-bottom: 0;" data-aos="fade-up" data-aos-delay="100">
                    {{ $productsSection->heading ?? 'Produk Berkualitas untuk Kebutuhan Industri Anda' }}
                </h2>
            </div>
        </div>

        <!-- Products Grid / Swipe -->
        <div class="row g-4 product-swipe-row">
            @if($products->count() > 0)
                @foreach($products->take(6) as $index => $product)
                <div class="col-xl-4 col-md-6 product-swipe-col" data-aos="fade-up" data-aos-delay="{{ 100 + ($index * 50) }}">
                    <div style="background: #ffffff; border-radius: 20px; overflow: hidden; border: 1px solid #f1f5f9; transition: all 0.3s ease; height: 100%; display: flex; flex-direction: column;" onmouseover="this.style.borderColor='#1E3A8A'; this.style.boxShadow='0 20px 30px -10px rgba(15,36,83,0.1)';" onmouseout="this.style.borderColor='#f1f5f9'; this.style.boxShadow='none';">
                        
                        <!-- Product Image (1:1 Ratio) -->
                        <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; position: relative; background: #f8fafc;">
                            @php
                                $imgSrc = $product->image ? (Str::startsWith($product->image, 'http') ? $product->image : asset($product->image)) : asset("assets/img/barfi/Landscaping/service/vl-service-5.".(($index % 4) + 1).".png");
                            @endphp
                            <img src="{{ $imgSrc }}" alt="{{ $product->name }}" loading="lazy" style="width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                            
                            <!-- Category/Badge Kecil -->
                            <div style="position: absolute; top: 15px; right: 15px; background: rgba(255,255,255,0.9); backdrop-filter: blur(4px); padding: 5px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; color: #1E3A8A; text-transform: uppercase; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                                Best Quality
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div style="padding: 24px; flex-grow: 1; display: flex; flex-direction: column;">
                            <h4 style="font-size: 20px; font-weight: 700; color: #111827; margin-bottom: 10px; letter-spacing: -0.5px; line-height: 1.3;">
                                <a href="{{ route('product.show', $product->slug) }}" style="color: inherit; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#1E3A8A'" onmouseout="this.style.color='#111827'">
                                    {{ $product->name }}
                                </a>
                            </h4>

                            <!-- Deskripsi Singkat (SEO Friendly) -->
                            <p style="font-size: 14px; color: #64748B; line-height: 1.5; margin-bottom: 20px; flex-grow: 1;">
                                {{ Str::limit(strip_tags($product->description ?? 'Sparepart industri presisi tinggi yang diproduksi dengan standar kualitas internasional untuk performa maksimal.'), 90) }}
                            </p>

                            <!-- Button & Icon Action -->
                            <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 15px; border-top: 1px dashed #e2e8f0;">
                                <a href="{{ route('product.show', $product->slug) }}" style="font-size: 14px; font-weight: 700; color: #0F2453; text-decoration: none; display: flex; align-items: center; gap: 5px;">
                                    Detail Produk
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                </a>
                                
                                <!-- Decorative Icon -->
                                <div style="width: 35px; height: 35px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #64748B;">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <!-- Fallback: Hardcoded Products -->
                @for($i = 1; $i <= 3; $i++)
                <div class="col-xl-4 col-md-6 product-swipe-col">
                    <div style="background: #ffffff; border-radius: 20px; overflow: hidden; border: 1px solid #f1f5f9; height: 100%;">
                        <div style="width: 100%; aspect-ratio: 1 / 1; background: #f8fafc;">
                            <img src="{{ asset("assets/img/barfi/Landscaping/service/vl-service-5.{$i}.png") }}" alt="Produk PT BIJP" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div style="padding: 24px;">
                            <h4 style="font-size: 20px; font-weight: 700; color: #111827; margin-bottom: 10px;">Produk Unggulan {{ $i }}</h4>
                            <p style="font-size: 14px; color: #64748B; margin-bottom: 20px;">Deskripsi produk berkualitas tinggi untuk kebutuhan sparepart industri Anda.</p>
                            <a href="{{ url('/products') }}" style="font-size: 14px; font-weight: 700; color: #0F2453; text-decoration: none;">Lihat Detail →</a>
                        </div>
                    </div>
                </div>
                @endfor
            @endif
        </div>

        <!-- Tombol "Lihat Semua" di Bawah (Opsional & Premium) -->
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ url('/products') }}" style="display: inline-block; padding: 12px 30px; border: 2px solid #0F2453; color: #0F2453; border-radius: 12px; font-weight: 700; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.background='#0F2453'; this.style.color='#fff';" onmouseout="this.style.background='transparent'; this.style.color='#0F2453';">
                Lihat Semua Katalog
            </a>
        </div>

    </div>
</section>
@endif
<!--================= Premium Products Section End =================-->

<!--================= Premium Service Section Start =================-->
@if($servicesSection && $servicesSection->is_active)

<!-- CSS Khusus Mobile Swipe (Sangat aman, tidak akan bentrok dengan CSS bawaan/error) -->
<style>
    @media (max-width: 768px) {
        .premium-swipe-row {
            display: flex !important;
            flex-wrap: nowrap !important;
            overflow-x: auto !important;
            overflow-y: hidden !important;
            scroll-snap-type: x mandatory !important;
            scroll-behavior: smooth !important;
            -webkit-overflow-scrolling: touch !important;
            padding-bottom: 20px !important;
            margin-left: -15px;
            margin-right: -15px;
            padding-left: 15px;
            padding-right: 15px;
        }
        .premium-swipe-row::-webkit-scrollbar {
            display: none; /* Menyembunyikan scrollbar agar rapi seperti Instagram/Gojek */
        }
        .premium-swipe-col {
            flex: 0 0 85% !important; /* Lebar card di mobile */
            scroll-snap-align: center !important;
        }
    }
</style>

<section id="service" class="py-5" style="background-color: #fafbfc; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
    <div class="container py-4">
        
        <!-- Header Section -->
        <div class="row mb-5 justify-content-center">
            <div class="col-lg-8 text-center">
                <!-- Subtitle Premium -->
                <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(30, 58, 138, 0.08); padding: 8px 16px; border-radius: 30px; margin-bottom: 20px;" data-aos="fade-up">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1E3A8A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                    <span style="font-size: 13px; font-weight: 700; color: #1E3A8A; text-transform: uppercase; letter-spacing: 1.5px;">
                        {{ $servicesSection->title ?? 'Layanan Kami' }}
                    </span>
                </div>

                <!-- Heading (Sama Persis 100% dengan Request) -->
                <h2 style="font-size: clamp(28px, 4vw, 42px); color: #111827; font-weight: 700; line-height: 1.2; letter-spacing: -1px; margin-bottom: 0;" data-aos="fade-up" data-aos-delay="100">
                    {{ $servicesSection->heading ?? 'Layanan Profesional untuk Kebutuhan Industri Anda' }}
                </h2>
            </div>
        </div>

        <!-- Cards Row (Desktop Grid, Mobile Swipe) -->
        <div class="row g-4 premium-swipe-row">
            
            @if($services->count() > 0)
                @foreach($services->take(3) as $index => $service)
                <div class="col-xl-4 col-md-6 premium-swipe-col" data-aos="fade-up" data-aos-delay="{{ 150 + ($index * 100) }}">
                    <!-- Card Container -->
                    <div style="background: #ffffff; border-radius: 24px; overflow: hidden; box-shadow: 0 10px 40px -10px rgba(15, 36, 83, 0.08); height: 100%; display: flex; flex-direction: column; border: 1px solid rgba(0,0,0,0.03); transition: transform 0.4s ease, box-shadow 0.4s ease;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 40px -10px rgba(15, 36, 83, 0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 40px -10px rgba(15, 36, 83, 0.08)';">
                        
                        <!-- Gambar (Rasio 1:1 Square) -->
                        <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; position: relative;">
                            @php
                                $imgSrc = $service->image ? (Str::startsWith($service->image, 'http') ? $service->image : asset($service->image)) : asset("assets/img/barfi/Landscaping/service/vl-service-5.".(($index % 3) + 1).".png");
                            @endphp
                            <img src="{{ $imgSrc }}" alt="{{ $service->name }}" loading="lazy" style="width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.6s ease;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                        </div>

                        <!-- Konten Text & SEO Support -->
                        <div style="padding: 30px; display: flex; flex-direction: column; flex-grow: 1;">
                            <h4 style="font-size: 22px; font-weight: 700; color: #111827; margin-bottom: 12px; letter-spacing: -0.5px;">
                                <a href="{{ route('service.show', $service->slug) }}" style="color: inherit; text-decoration: none;">{{ $service->name }}</a>
                            </h4>
                            
                            <!-- SEO Friendly Text (strip_tags menghilangkan HTML kotor dari database) -->
                            <p style="font-size: 15px; color: #64748B; line-height: 1.6; margin-bottom: 25px; flex-grow: 1;">
                                {{ Str::limit(strip_tags($service->description ?? 'Menyediakan layanan berkualitas tinggi dengan ketepatan presisi untuk memenuhi kebutuhan produksi industri dan manufaktur Anda.'), 110) }}
                            </p>

                            <!-- Tombol Link Modern -->
                            <a href="{{ route('service.show', $service->slug) }}" style="display: inline-flex; align-items: center; gap: 8px; color: #0F2453; font-weight: 700; font-size: 15px; text-decoration: none; margin-top: auto; transition: color 0.3s ease;" onmouseover="this.style.color='#2563EB'" onmouseout="this.style.color='#0F2453'">
                                Selengkapnya 
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.3s ease;" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </a>
                        </div>

                    </div>
                </div>
                @endforeach
            @else
                <!-- Fallback: Hardcoded Services -->
                @for($i = 1; $i <= 3; $i++)
                <div class="col-xl-4 col-md-6 premium-swipe-col" data-aos="fade-up" data-aos-delay="{{ 150 + ($i * 100) }}">
                    <div style="background: #ffffff; border-radius: 24px; overflow: hidden; box-shadow: 0 10px 40px -10px rgba(15, 36, 83, 0.08); height: 100%; display: flex; flex-direction: column; border: 1px solid rgba(0,0,0,0.03); transition: transform 0.4s ease;" onmouseover="this.style.transform='translateY(-8px)'" onmouseout="this.style.transform='translateY(0)'">
                        
                        <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden;">
                            <img src="{{ asset("assets/img/barfi/Landscaping/service/vl-service-5.{$i}.png") }}" alt="Jasa Bubut" loading="lazy" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <div style="padding: 30px; display: flex; flex-direction: column; flex-grow: 1;">
                            <h4 style="font-size: 22px; font-weight: 700; color: #111827; margin-bottom: 12px; letter-spacing: -0.5px;">
                                <a href="{{ url('/services') }}" style="color: inherit; text-decoration: none;">Jasa Bubut Presisi</a>
                            </h4>
                            <p style="font-size: 15px; color: #64748B; line-height: 1.6; margin-bottom: 25px; flex-grow: 1;">
                                Layanan bubut presisi tinggi untuk berbagai komponen logam dengan akurasi dan kualitas terjamin sesuai standar pabrik.
                            </p>
                            <a href="{{ url('/services') }}" style="display: inline-flex; align-items: center; gap: 8px; color: #0F2453; font-weight: 700; font-size: 15px; text-decoration: none;">
                                Selengkapnya 
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endfor
            @endif

        </div>
    </div>
</section>
@endif
<!--================= Premium Service Section End =================-->

    
    <!--================= project section Start =================-->
    @if($projectsSection && $projectsSection->is_active)
    <section id="project" class="fix pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 mx-auto text-center">
                    <div class="vl-choose-content4">
                        <!-- section title start -->
                        <div class="vl-section-title mb-60">
                            <h4 class="subtitle subtitle-5-1" data-aos="zoom-in-up"> <span><img class="circle" src="{{ asset("assets/img/barfi/icon/sub-title-icon1.4.svg") }}" alt="PT. Borneo Iban Jaya Perkasa"></span> {{ $projectsSection->subtitle ?? 'Portfolio Kami' }}</h4>
                            <h2 class="title text-effect">{{ $projectsSection->heading ?? 'Proyek-Proyek Unggulan Kami' }}</h2>
                        </div> <!-- section title End -->
                    </div>
                </div>
            </div>

            <div class="row">
                @if($projectsItems->count() > 0)
                    @foreach($projectsItems->take(8) as $project)
                    <div class="col-xl-3 col-md-6 mb-30" data-aos="zoom-in-up">
                        <div class="vl-project-wrap5">
                            <div class="vl-thumb">
                                <img src="{{ !empty($project->image) ? (Str::startsWith($project->image, 'http') ? $project->image : asset($project->image)) : asset('assets/img/barfi/Landscaping/project/vl-project-thumb-5.1.png') }}" alt="{{ $project->title }}">
                            </div>
                            <div class="vl-icon">
                                <a href="{{ !empty($project->link) ? url($project->link) : url('/services') }}"><span><i class="fa-regular fa-arrow-right"></i></span></a>
                            </div>
                            <div class="vl-content">
                                <p class="para">{{ $project->extra_data['category'] ?? 'Umum' }}</p>
                                <h4 class="title pt-16"><a href="{{ !empty($project->link) ? url($project->link) : url('/services') }}">{{ $project->title }}</a></h4>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <!-- Fallback: Hardcoded Projects -->
                    @for($i = 1; $i <= 8; $i++)
                    <div class="col-xl-3 col-md-6 mb-30" data-aos="zoom-in-up">
                        <div class="vl-project-wrap5">
                            <div class="vl-thumb">
                                <img src="{{ asset("assets/img/barfi/Landscaping/project/vl-project-thumb-5.{$i}.png") }}" alt="Komponen Industri">
                            </div>
                            <div class="vl-icon">
                                <a href="{{ url("/services") }}"><span><i class="fa-regular fa-arrow-right"></i></span></a>
                            </div>
                            <div class="vl-content">
                                <p class="para">Jasa Bubut</p>
                                <h4 class="title pt-16"><a href="{{ url("/services") }}">Komponen Industri</a></h4>
                            </div>
                        </div>
                    </div>
                    @endfor
                @endif
            </div>
        </div>
    </section>
    @endif
    <!--================= project section End =================-->

<!--================= Premium Work/Info Section Start =================-->
@if($workProcessSection && $workProcessSection->is_active)

<!-- CSS Scoped untuk Fitur Swipe Mobile & Efek Card -->
<style>
    @media (max-width: 768px) {
        .work-swipe-row {
            display: flex !important;
            flex-wrap: nowrap !important;
            overflow-x: auto !important;
            scroll-snap-type: x mandatory !important;
            gap: 15px !important;
            padding-bottom: 30px !important;
            margin-left: -15px;
            margin-right: -15px;
            padding-left: 15px;
            padding-right: 15px;
        }
        .work-swipe-row::-webkit-scrollbar {
            display: none;
        }
        .work-swipe-col {
            flex: 0 0 75% !important; /* Ukuran kartu di HP agar terlihat kartu berikutnya sedikit */
            scroll-snap-align: center !important;
        }
    }
    .work-card-premium {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        aspect-ratio: 4 / 5; /* Rasio Feed IG Portrait */
        background: #e2e8f0;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        display: block;
        text-decoration: none;
    }
    .work-card-premium:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(15, 36, 83, 0.2);
    }
    .work-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15, 36, 83, 0.8) 0%, rgba(15, 36, 83, 0.2) 50%, transparent 100%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 25px;
        transition: opacity 0.3s ease;
    }
</style>

<section id="work" class="py-5" style="background-color: #F5F7FB; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
    <div class="container py-4">
        
        <!-- Header Section -->
        <div class="row align-items-end mb-5">
            <div class="col-lg-8">
                <!-- Subtitle Badge -->
                <div style="display: inline-flex !important; align-items: center !important; gap: 10px !important; background: rgba(30, 58, 138, 0.1) !important; padding: 10px 24px !important; border-radius: 50px !important; margin-bottom: 20px !important;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1E3A8A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    <span style="font-size: 13px !important; font-weight: 800 !important; color: #1E3A8A !important; text-transform: uppercase !important; letter-spacing: 2px !important; line-height: 1 !important;">
                        {{ $workProcessSection->subtitle ?? 'Info & Panduan' }}
                    </span>
                </div>

                <!-- Headline Utama (Style 100% Sesuai Request) -->
                <h2 style="font-size: clamp(28px, 4vw, 42px); color: #111827; font-weight: 700; line-height: 1.2; letter-spacing: -1px; margin-bottom: 0;" data-aos="fade-up">
                    {{ $workProcessSection->heading ?? 'Panduan Singkat Layanan Kami' }}
                </h2>
            </div>
            <div class="col-lg-4 text-lg-end d-none d-lg-block">
                <a href="{{ $workProcessSection->extra_data['view_all_link'] ?? '/services' }}" style="display: inline-flex; align-items: center; gap: 10px; color: #1E3A8A; font-weight: 700; text-decoration: none; font-size: 16px; border-bottom: 2px solid rgba(30, 58, 138, 0.2); padding-bottom: 5px; transition: 0.3s;" onmouseover="this.style.borderColor='#1E3A8A'" onmouseout="this.style.borderColor='rgba(30, 58, 138, 0.2)'">
                    Lihat Semua Layanan 
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>
        </div>

        <!-- Work Grid / Swipe Row -->
        <div class="row g-4 work-swipe-row">
            @if($workProcessItems->count() > 0)
                @foreach($workProcessItems->take(4) as $index => $item)
                <div class="col-xl-3 col-md-6 work-swipe-col" data-aos="fade-up" data-aos-delay="{{ 100 + ($index * 100) }}">
                    <a href="{{ $item->link ?? '#' }}" class="work-card-premium">
                        <!-- Background Image (IG Feed Size 4:5) -->
                        <img src="{{ !empty($item->image) ? (Str::startsWith($item->image, 'http') ? $item->image : asset($item->image)) : asset('assets/img/barfi/Landscaping/project/vl-project-thumb-5.1.png') }}" 
                             alt="{{ $item->title }}" 
                             style="width: 100%; height: 100%; object-fit: cover; display: block;"
                             loading="lazy">
                        
                        <!-- Premium Overlay -->
                        <div class="work-overlay">
                            <span style="color: rgba(255,255,255,0.7); font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px;">Step 0{{ $index + 1 }}</span>
                            <h3 style="color: #ffffff; font-size: 20px; font-weight: 700; line-height: 1.3; margin-bottom: 0;">{{ $item->title }}</h3>
                        </div>
                    </a>
                </div>
                @endforeach
            @else
                <!-- Fallback: Hardcoded Cards -->
                @for($i = 1; $i <= 4; $i++)
                <div class="col-xl-3 col-md-6 work-swipe-col">
                    <a href="#" class="work-card-premium">
                        <img src="{{ asset("assets/img/barfi/Landscaping/project/vl-project-thumb-5.{$i}.png") }}" alt="Panduan" style="width: 100%; height: 100%; object-fit: cover;">
                        <div class="work-overlay">
                            <span style="color: rgba(255,255,255,0.7); font-size: 12px; font-weight: 700; letter-spacing: 2px; margin-bottom: 8px;">INFO 0{{ $i }}</span>
                            <h3 style="color: #ffffff; font-size: 20px; font-weight: 700;">Panduan Layanan Terpercaya</h3>
                        </div>
                    </a>
                </div>
                @endfor
            @endif
        </div>

    </div>
</section>
@endif
<!--================= Premium Work/Info Section End =================-->

    <!--================= choose section Start =================-->
    @if($whyChooseUsSection && $whyChooseUsSection->is_active)
    <section id="choose" class="fix pt-100 pb-70">
        <div class="container">
            <div class="row flex-lg-row flex-column-reverse align-items-center">
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="vl-choose-wrap5" data-aos="fade-right">
                        <div class="vl-choose-shape-thumb5">
                            <img src="{{ asset("assets/img/barfi/shape/vl-choose-shape-5.1.png") }}" alt="Barfi">
                        </div>
                        <div class="vl-choose-thumb5">
                            <img src="{{ !empty($whyChooseUsSection->image) ? asset($whyChooseUsSection->image) : asset("assets/img/barfi/Landscaping/choose/vl-choose-thumb-5.1.png") }}" alt="Barfi">
                        </div>
                        <div class="vl-phonebox5">
                            <div class="icon">
                                <span><i class="fa-brands fa-whatsapp" style="color: #25D366; font-size: 32px;"></i></span>
                            </div>
                            <div class="content">
                                <h4 class="title">{{ $whyChooseUsSection->extra_data['cta_title'] ?? 'Ada Pertanyaan?' }}</h4>
                                @php
                                    $contactPhone = \App\Models\Setting::get('contact_phone', '031-8559-7449');
                                    $whatsappLink = formatWhatsApp($contactPhone);
                                @endphp
                                <a href="{{ $whatsappLink }}" target="_blank" class="cnumber">{{ $whyChooseUsSection->extra_data['cta_button_text'] ?? 'Hubungi Kami' }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="vl-choose-content5">
                        <div class="vl-section-title mb-32">
                            <h4 class="subtitle subtitle-5-1" data-aos="zoom-in-up"> <span><img class="circle" src="{{ asset("assets/img/barfi/icon/sub-title-icon1.4.svg") }}" alt="PT. Borneo Iban Jaya Perkasa"></span> {{ $whyChooseUsSection->title ?? 'Mengapa Pilih Kami' }}</h4>
                            <h2 class="title pb-16 text-effect">{{ $whyChooseUsSection->heading ?? 'Kualitas & Kepercayaan, Setiap Proyek, Setiap Detail' }}</h2>
                            <p class="para">{{ $whyChooseUsSection->content ?? 'Memilih PT. Borneo Iban Jaya Perkasa berarti memilih tim yang peduli dengan kebutuhan industri Anda. Kami menggabungkan pengalaman, presisi, dan keandalan untuk memberikan produk dan jasa berkualitas tinggi yang memenuhi standar industri.' }}</p>
                        </div>
                        @foreach($whyChooseUsItems as $item)
                        <div class="vl-about-iconbox3 vl-about-iconbox3-4 mb-32" data-aos="zoom-in-up">
                            <div class="icon">
                                <span><img class="animate__animated animate__shakeX" src="{{ Str::startsWith($item->icon, 'http') ? $item->icon : asset($item->icon) }}" alt="{{ $item->title }}"></span>
                            </div>
                            <div class="content">
                                <h4 class="title">{{ $item->title }}</h4>
                                <p class="para pt-10">{{ $item->description }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!--================= choose section End =================-->

<!--================= Premium Testimonial Section Start =================-->
@if($testimonialsSection && $testimonialsSection->is_active)
<section id="testimonial" class="py-5" style="background-color: #ffffff; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; overflow: hidden;">
    <div class="container py-4">
        
        <!-- Header Section -->
        <div class="row align-items-end mb-5">
            <div class="col-lg-7">
                <!-- Subtitle Badge - CONSISTENT STYLE -->
                <div style="display: inline-flex !important; align-items: center !important; gap: 10px !important; background: rgba(30, 58, 138, 0.08) !important; padding: 10px 24px !important; border-radius: 50px !important; margin-bottom: 20px !important;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1E3A8A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    <span style="font-size: 13px !important; font-weight: 800 !important; color: #1E3A8A !important; text-transform: uppercase !important; letter-spacing: 2px !important; line-height: 1 !important;">
                        {{ $testimonialsSection->subtitle ?? 'Testimoni' }}
                    </span>
                </div>

                <!-- Headline (Style 100% Identik) -->
                <h2 style="font-size: clamp(28px, 4vw, 42px); color: #111827; font-weight: 700; line-height: 1.2; letter-spacing: -1px; margin-bottom: 0;" data-aos="fade-up">
                    {{ $testimonialsSection->heading ?? 'Apa Kata Klien Kami' }}
                </h2>
            </div>
            
            <!-- Custom Navigation Buttons (Desktop Only) -->
            <div class="col-lg-5 text-end d-none d-lg-block">
                <div style="display: flex; gap: 12px; justify-content: flex-end;">
                    <div class="vl-review-button-prev" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid #f1f5f9; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.3s; color: #0F2453;">
                        <i class="fa-regular fa-chevron-left" style="font-size: 18px;"></i>
                    </div>
                    <div class="vl-review-button-next" style="width: 50px; height: 50px; border-radius: 50%; background: #0F2453; color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 20px rgba(15, 36, 83, 0.2);">
                        <i class="fa-regular fa-chevron-right" style="font-size: 18px;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slider Content -->
        <div class="swiper vlTestimonialActive5" data-aos="fade-up" data-aos-delay="200" style="padding: 20px 5px 60px 5px;">
            <div class="swiper-wrapper">
                @foreach($testimonialsItems as $item)
                <div class="swiper-slide h-auto">
                    <!-- Testimonial Card -->
                    <div style="background: #ffffff; border-radius: 24px; padding: 40px; border: 1px solid #f1f5f9; box-shadow: 0 10px 30px rgba(0,0,0,0.03); height: 100%; display: flex; flex-direction: column; position: relative;">
                        
                        <!-- Quote Icon (Modern SVG) -->
                        <div style="margin-bottom: 25px; color: #1E3A8A; opacity: 0.2;">
                            <svg width="45" height="45" viewBox="0 0 24 24" fill="currentColor"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 7.55228 14.017 7V5C14.017 4.44772 14.4647 4 15.017 4H20.017C21.1216 4 22.017 4.89543 22.017 6V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM3.017 21L3.017 18C3.017 16.8954 3.91243 16 5.017 16H8.017C8.56928 16 9.017 15.5523 9.017 15V9C9.017 8.44772 8.56928 8 8.017 8H4.017C3.46472 8 3.017 7.55228 3.017 7V5C3.017 4.44772 3.46472 4 4.017 4H9.017C10.1216 4 11.017 4.89543 11.017 6V15C11.017 18.3137 8.33071 21 5.017 21H3.017Z"/></svg>
                        </div>

                        <!-- Star Rating -->
                        <div style="display: flex; gap: 4px; margin-bottom: 20px;">
                            @for ($i = 0; $i < ($item->extra_data['rating'] ?? 5); $i++)
                                <i class="fa-solid fa-star" style="color: #FBBF24; font-size: 14px;"></i>
                            @endfor
                        </div>

                        <!-- Description -->
                        <p style="font-size: 17px; color: #475569; line-height: 1.7; font-style: italic; flex-grow: 1; margin-bottom: 30px;">
                            "{{ strip_tags($item->description) }}"
                        </p>

                        <!-- Author Info -->
                        <div style="display: flex; align-items: center; gap: 15px; border-top: 1px solid #f1f5f9; pt-25; padding-top: 25px;">
                            <div style="width: 55px; height: 55px; border-radius: 50%; overflow: hidden; flex-shrink: 0; border: 2px solid #E0F2FE;">
                                <img src="{{ Str::startsWith($item->image, 'http') ? $item->image : asset($item->image) }}" alt="{{ $item->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div>
                                <h4 style="font-size: 18px; font-weight: 700; color: #111827; margin-bottom: 2px;">{{ $item->title }}</h4>
                                <p style="font-size: 13px; color: #64748B; margin-bottom: 0; font-weight: 500;">{{ $item->extra_data['position'] ?? 'Klien Terpercaya' }}</p>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

<!-- Hover Navigation Style -->
<style>
    .vl-review-button-prev:hover { background: #0F2453; color: #fff !important; border-color: #0F2453; }
    .vl-review-button-next:hover { transform: scale(1.05); background: #1E3A8A; }
    
    @media (max-width: 991px) {
        /* Memastikan swiper tetap rapi di mobile */
        .vlTestimonialActive5 { padding-bottom: 40px !important; }
    }
</style>
@endif
<!--================= Premium Testimonial Section End =================-->

<!--================= Premium Blog Section Start =================-->
@if($blogSection && $blogSection->is_active)

<!-- CSS Scoped khusus Swipe Desktop & Mobile -->
<style>
    .blog-swipe-row {
        display: flex !important;
        flex-wrap: nowrap !important;
        overflow-x: auto !important;
        scroll-snap-type: x mandatory !important;
        gap: 24px !important;
        padding-bottom: 30px !important;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none;  /* IE 10+ */
    }
    .blog-swipe-row::-webkit-scrollbar {
        display: none; /* Chrome, Safari, Opera */
    }
    .blog-swipe-col {
        flex: 0 0 85% !important; /* Mobile default */
        scroll-snap-align: start !important;
    }
    @media (min-width: 768px) {
        .blog-swipe-col {
            flex: 0 0 45% !important; /* Tablet */
        }
    }
    @media (min-width: 1200px) {
        .blog-swipe-col {
            flex: 0 0 32% !important; /* Desktop (3.5 cards visible) */
        }
    }
    .blog-card-premium {
        background: #ffffff;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid #f1f5f9;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: all 0.4s ease;
    }
    .blog-card-premium:hover {
        border-color: #1E3A8A;
        box-shadow: 0 20px 40px -10px rgba(15, 36, 83, 0.1);
        transform: translateY(-5px);
    }
</style>

<section id="blog" class="py-5" style="background-color: #ffffff; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
    <div class="container py-4">
        
        <!-- Header Section -->
        <div class="row mb-5 justify-content-center">
            <div class="col-lg-8 text-center">
                <!-- Subtitle Badge (Consistent) -->
                <div style="display: inline-flex !important; align-items: center !important; gap: 10px !important; background: rgba(30, 58, 138, 0.08) !important; padding: 10px 24px !important; border-radius: 50px !important; margin-bottom: 20px !important;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1E3A8A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    <span style="font-size: 13px !important; font-weight: 800 !important; color: #1E3A8A !important; text-transform: uppercase !important; letter-spacing: 2px !important; line-height: 1 !important;">
                        {{ $blogSection->subtitle ?? 'Blog & Berita' }}
                    </span>
                </div>

                <!-- Headline (Consistent Style) -->
                <h2 style="font-size: clamp(28px, 4vw, 42px); color: #111827; font-weight: 700; line-height: 1.2; letter-spacing: -1px; margin-bottom: 0;" data-aos="fade-up">
                    {{ $blogSection->heading ?? 'Update Terbaru dari Industri' }}
                </h2>
            </div>
        </div>

        <!-- Swipeable Blog Row -->
        <div class="blog-swipe-row" data-aos="fade-up" data-aos-delay="200">
            @foreach($blogs as $blog)
            <div class="blog-swipe-col">
                <div class="blog-card-premium">
                    
                    <!-- Image Wrapper (16:9 Aspect Ratio) -->
                    <div style="width: 100%; aspect-ratio: 16 / 10; overflow: hidden; position: relative;">
                        <img src="{{ Str::startsWith($blog->image, 'http') ? $blog->image : asset($blog->image) }}" 
                             alt="{{ $blog->title }}" 
                             style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;"
                             onmouseover="this.style.transform='scale(1.1)'" 
                             onmouseout="this.style.transform='scale(1)'">
                        
                        <!-- Date Badge (Floating) -->
                        <div style="position: absolute; bottom: 15px; left: 15px; background: #ffffff; padding: 6px 14px; border-radius: 10px; font-size: 11px; font-weight: 800; color: #1E3A8A; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                            {{ $blog->created_at ? $blog->created_at->format('d M Y') : 'Terbaru' }}
                        </div>
                    </div>

                    <!-- Blog Content -->
                    <div style="padding: 25px; flex-grow: 1; display: flex; flex-direction: column;">
                        <!-- Meta Info -->
                        <div style="display: flex; gap: 15px; margin-bottom: 12px;">
                            <span style="font-size: 12px; color: #64748B; display: flex; align-items: center; gap: 5px;">
                                <i class="fa-solid fa-user" style="color: #cbd5e1;"></i> Admin
                            </span>
                            <span style="font-size: 12px; color: #64748B; display: flex; align-items: center; gap: 5px;">
                                <i class="fa-solid fa-eye" style="color: #cbd5e1;"></i> {{ $blog->views ?? 0 }} Views
                            </span>
                        </div>

                        <!-- Title -->
                        <h3 style="font-size: 20px; font-weight: 700; color: #111827; line-height: 1.4; margin-bottom: 15px; flex-grow: 1;">
                            <a href="{{ route('blog.show', $blog->slug) }}" style="color: inherit; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#1E3A8A'" onmouseout="this.style.color='#111827'">
                                {{ $blog->title }}
                            </a>
                        </h3>

                        <!-- Link -->
                        <div style="margin-top: auto; padding-top: 15px; border-top: 1px solid #f1f5f9;">
                            <a href="{{ route('blog.show', $blog->slug) }}" style="display: inline-flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 700; color: #0F2453; text-decoration: none; transition: gap 0.3s;" onmouseover="this.querySelector('svg').style.transform='translateX(5px)'" onmouseout="this.querySelector('svg').style.transform='translateX(0)'">
                                Baca Selengkapnya 
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.3s;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        <!-- Hint for Desktop Swipe -->
        <div class="text-center mt-3 d-none d-lg-block">
            <span style="font-size: 12px; color: #94a3b8; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Geser untuk melihat berita lainnya &rarr;</span>
        </div>

    </div>
</section>
@endif
<!--================= Premium Blog Section End =================-->

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