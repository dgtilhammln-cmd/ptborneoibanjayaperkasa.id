@extends('layouts.frontend')

@push('head')
@php
    $breadcrumbs = [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Layanan Kami', 'url' => url('/services')],
        ['name' => $service->name, 'url' => url('/services/' . $service->slug)]
    ];
@endphp
@include('partials.schema', ['schemaType' => 'breadcrumb', 'breadcrumbs' => $breadcrumbs])
@include('partials.schema', ['schemaType' => 'organization'])
@include('partials.schema', ['schemaType' => 'service', 'service' => $service])
<style>
    @media (max-width: 768px) {
        .service-main-card {
            padding: 24px 18px !important;
            border-radius: 24px !important;
        }
        .service-meta-badges {
            flex-direction: column !important;
            gap: 12px !important;
        }
        .service-cta-box {
            padding: 20px 18px !important;
            border-radius: 20px !important;
            text-align: center !important;
        }
        .service-cta-box a {
            width: 100% !important;
            justify-content: center !important;
        }
        .vl-sidebar {
            position: static !important;
        }
    }
    .service-rich-content p { 
        margin-bottom: 25px; 
    }
    .service-rich-content h2, .service-rich-content h3 { 
        color: #0F2453; 
        font-weight: 600; 
        margin-top: 40px; 
        margin-bottom: 20px; 
    }
    .service-rich-content img { 
        border-radius: 16px; 
        margin: 20px 0; 
        max-width: 100%; 
        height: auto;
    }
    .service-rich-content ul, .service-rich-content ol {
        margin-bottom: 25px;
        padding-left: 20px;
    }
    .service-rich-content li {
        margin-bottom: 8px;
    }
    .service-nav-link:hover {
        background-color: #eef2ff !important;
        color: #1E3A8A !important;
        transform: translateX(4px);
    }
    .service-nav-link {
        transition: all 0.3s ease !important;
    }
</style>
@endpush

@section('content')
<!--================= Breadcrumb section start =================-->
<section class="vl-breadcrumb-bg" style="background-image: url({{ asset('assets/img/shape/breadcrumb-shape.svg') }});">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-8 mx-auto text-center mb-30">
                <div class="vl-breadcrumb-content">
                    <h2 class="title pb-20">Detail Layanan</h2>
                    <ul>
                        <li><a href="{{ url('/') }}">Home </a></li>
                        <li><i class="fa-light fa-angle-right"></i></li>
                        <li><a href="{{ url('/services') }}">Layanan Kami</a></li>
                        <li><i class="fa-light fa-angle-right"></i></li>
                        <li><a class="active" href="#">{{ $service->name }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================= Breadcrumb section End =================-->

<!--================= Premium Service Detail Section Start =================--> 
<section class="vl-service-details-inner pt-100 pb-70" style="background-color: #f8fafc; font-family: 'Montserrat', sans-serif;">
    <div class="container">
        <div class="row g-4">
            <!-- MAIN CONTENT AREA -->
            <div class="col-lg-8 mb-30">
               <div class="service-main-card" style="background: #fff; padding: 40px; border-radius: 32px; box-shadow: 0 15px 50px rgba(15, 36, 83, 0.05); border: 1px solid #f1f1f1;">
                    
                    <!-- Header Meta & Title -->
                    <div class="mb-30">
                        <span style="background: #eef2ff; color: #1E3A8A; padding: 6px 16px; border-radius: 50px; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; display: inline-block; margin-bottom: 20px;">Layanan Unggulan</span>
                        <h1 style="font-size: clamp(26px, 4vw, 40px); color: #0F2453; font-weight: 700; line-height: 1.3; margin-bottom: 25px;">{{ $service->name }}</h1>
                        
                        <div class="service-meta-badges" style="display: flex; gap: 20px; flex-wrap: wrap; padding-bottom: 25px; border-bottom: 1px solid #f0f0f0;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 38px; height: 38px; background: #eef2ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa-solid fa-shield-check" style="color: #1E3A8A; font-size: 15px;"></i>
                                </div>
                                <div>
                                    <small style="display: block; color: #7C8192; font-size: 10px; font-weight: 700; text-transform: uppercase;">Kualitas</small>
                                    <span style="font-weight: 700; color: #0F2453; font-size: 13px;">Garansi Presisi 100%</span>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 38px; height: 38px; background: #eef2ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa-solid fa-clock-rotate-left" style="color: #1E3A8A; font-size: 15px;"></i>
                                </div>
                                <div>
                                    <small style="display: block; color: #7C8192; font-size: 10px; font-weight: 700; text-transform: uppercase;">Layanan</small>
                                    <span style="font-weight: 700; color: #0F2453; font-size: 13px;">Respon & Pengerjaan Cepat</span>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 38px; height: 38px; background: #eef2ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa-solid fa-industry" style="color: #1E3A8A; font-size: 15px;"></i>
                                </div>
                                <div>
                                    <small style="display: block; color: #7C8192; font-size: 10px; font-weight: 700; text-transform: uppercase;">Sektor</small>
                                    <span style="font-weight: 700; color: #0F2453; font-size: 13px;">Industri & Manufaktur</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Featured Image -->
                    @if($service->image)
                    <div style="border-radius: 24px; overflow: hidden; margin-bottom: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                        <img loading="lazy" src="{{ Str::startsWith($service->image, 'http') ? $service->image : asset($service->image) }}" alt="{{ $service->name }}" style="width: 100%; height: auto; max-height: 480px; display: block; object-fit: cover;">
                    </div>
                    @endif

                    <!-- Service Description Content -->
                    <div style="font-size: 17px; color: #4b5563; line-height: 1.9; margin-bottom: 40px;">
                        <div class="service-rich-content">
                            @if($service->description)
                                {!! $service->description !!}
                            @else
                                <p>Kami menyediakan layanan {{ $service->name }} profesional dengan standar presisi tinggi untuk mendukung kelancaran operasional dan kebutuhan spesifik proyek industri Anda.</p>
                                <p>Dengan dukungan perlengkapan modern dan tenaga kerja berpengalaman di bidang fabrikasi serta pemrosesan logam, setiap pengerjaan dijamin memenuhi spesifikasi teknis dan standar kualitas terbaik.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Key Features / Value Proposition Cards -->
                    <div class="row g-4 mb-40">
                        <div class="col-md-6">
                            <div style="background: #f8fafc; padding: 25px; border-radius: 20px; border: 1px solid #e2e8f0; height: 100%; display: flex; gap: 15px;">
                                <div style="width: 45px; height: 45px; background: #eef2ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa-solid fa-comments" style="color: #1E3A8A; font-size: 20px;"></i>
                                </div>
                                <div>
                                    <h4 style="font-size: 16px; color: #0F2453; font-weight: 700; margin-bottom: 8px;">Komunikasi Handal</h4>
                                    <p style="font-size: 13px; color: #64748b; line-height: 1.6; margin: 0;">Konsultasi teknis dan update berkala selama proses produksi untuk memastikan kesesuaian proyek.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="background: #f8fafc; padding: 25px; border-radius: 20px; border: 1px solid #e2e8f0; height: 100%; display: flex; gap: 15px;">
                                <div style="width: 45px; height: 45px; background: #eef2ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa-solid fa-user-gear" style="color: #1E3A8A; font-size: 20px;"></i>
                                </div>
                                <div>
                                    <h4 style="font-size: 16px; color: #0F2453; font-weight: 700; margin-bottom: 8px;">Tenaga Berpengalaman</h4>
                                    <p style="font-size: 13px; color: #64748b; line-height: 1.6; margin: 0;">Dikerjakan oleh teknisi terlatih dengan pemahaman mendalam pada karakter spesifik material.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Advantages Checklist -->
                    @php
                        $advantages = $service->advantages ?? [
                            'Presisi Tinggi & Akurasi Terjamin',
                            'Tim Profesional Berpengalaman',
                            'Custom Order Sesuai Kebutuhan Industri',
                            'Layanan Responsif & Pengerjaan Tepat Waktu'
                        ];
                    @endphp
                    @if(!empty($advantages) && count($advantages) > 0)
                    <div style="background: #f8faff; padding: 30px; border-radius: 24px; border: 1px solid #ebf0f9; margin-bottom: 40px;">
                        <h3 style="font-size: 20px; color: #0F2453; font-weight: 700; margin-bottom: 20px;">Keunggulan Layanan Kami</h3>
                        <div class="row g-3">
                            @foreach($advantages as $advantage)
                            <div class="col-md-6">
                                <div style="display: flex; align-items: center; gap: 12px; background: #fff; padding: 12px 18px; border-radius: 14px; border: 1px solid #f0f4f8;">
                                    <div style="width: 28px; height: 28px; background: #dcfce7; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="fa-solid fa-check" style="color: #16a34a; font-size: 14px;"></i>
                                    </div>
                                    <span style="font-size: 14px; font-weight: 600; color: #0F2453;">{{ $advantage }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Service FAQ Section -->
                    @php
                        use Illuminate\Support\Facades\Schema;
                        $faqs = collect([]);
                        try {
                            if (Schema::hasTable('faqs')) {
                                $faqs = \App\Models\Faq::active()
                                    ->where(function($query) use ($service) {
                                        $query->whereNull('service_id')
                                              ->orWhere('service_id', $service->id);
                                    })
                                    ->ordered()
                                    ->get();
                            }
                        } catch (\Exception $e) {
                            $faqs = collect([]);
                        }
                    @endphp
                    @if($faqs->count() > 0)
                    <div style="margin-bottom: 40px;">
                        <h3 style="font-size: 20px; color: #0F2453; font-weight: 700; margin-bottom: 20px;">Pertanyaan Umum (FAQ)</h3>
                        <div class="accordion" id="accordionServiceFaq" style="display: flex; flex-direction: column; gap: 12px;">
                            @foreach($faqs as $index => $faq)
                            <div class="accordion-item" style="border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden;">
                                <h2 class="accordion-header" id="faqHeading{{ $faq->id }}">
                                    <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse{{ $faq->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="faqCollapse{{ $faq->id }}" style="font-weight: 700; color: #0F2453; font-size: 15px; background: #fff; padding: 18px 24px; shadow: none;">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="faqCollapse{{ $faq->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="faqHeading{{ $faq->id }}" data-bs-parent="#accordionServiceFaq">
                                    <div class="accordion-body" style="background: #f8fafc; font-size: 14px; color: #4b5563; line-height: 1.8; padding: 18px 24px; border-top: 1px solid #e2e8f0;">
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Bottom Quick CTA Banner -->
                    @php
                        $contact_phone = \App\Models\Setting::get('contact_phone', '');
                        $waUrl = formatWhatsApp($contact_phone, 'Halo PT. Borneo Iban Jaya Perkasa, saya tertarik dengan layanan ' . $service->name . '. Boleh minta info penawaran harga dan konsultasi teknis?');
                    @endphp
                    <div class="service-cta-box" style="padding: 30px; background: linear-gradient(135deg, #0F2453 0%, #1E3A8A 100%); border-radius: 24px; color: #fff; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px; box-shadow: 0 15px 40px rgba(15, 36, 83, 0.2);">
                        <div>
                            <span style="background: rgba(255,255,255,0.15); color: #fff; padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; display: inline-block; margin-bottom: 10px;">Penawaran Spesial</span>
                            <h4 style="color: #fff; font-size: 20px; font-weight: 700; margin-bottom: 6px;">Butuh Layanan {{ $service->name }}?</h4>
                            <p style="color: rgba(255,255,255,0.85); font-size: 14px; margin: 0;">Hubungi kami sekarang untuk estimasi biaya dan penawaran terbaik.</p>
                        </div>
                        <a href="{{ $waUrl }}" target="_blank" style="background: #25D366; color: #fff; padding: 14px 28px; border-radius: 50px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; box-shadow: 0 8px 20px rgba(37, 211, 102, 0.3); transition: 0.3s; font-size: 14px;">
                            <i class="fa-brands fa-whatsapp" style="font-size: 20px;"></i> Konsultasi via WhatsApp
                        </a>
                    </div>

                </div>
            </div>

            <!-- SIDEBAR AREA -->
            <div class="col-lg-4 mb-30">
                <div class="vl-sidebar" style="position: sticky; top: 100px;">
                    
                    <!-- Search Widget -->
                    <div style="background: #fff; padding: 30px; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid #f1f1f1; margin-bottom: 30px;">
                        <h4 style="font-size: 18px; color: #0F2453; font-weight: 600; margin-bottom: 20px; border-left: 4px solid #0F2453; padding-left: 15px;">Pencarian Layanan</h4>
                        <div style="position: relative;">
                            <form action="{{ url('/services') }}" method="GET">
                                <input type="text" name="search" placeholder="Cari layanan..." value="{{ request('search') }}" style="width: 100%; padding: 12px 20px; border-radius: 12px; border: 1px solid #dee5f2; background: #fcfdfe; font-size: 14px; outline: none;">
                                <button type="submit" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); border: none; background: transparent; color: #0F2453;"><i class="fa-regular fa-magnifying-glass"></i></button>
                            </form>
                        </div>
                    </div>

                    <!-- Service Category Widget -->
                    <div style="background: #fff; padding: 30px; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid #f1f1f1; margin-bottom: 30px;">
                        <h4 style="font-size: 18px; color: #0F2453; font-weight: 600; margin-bottom: 20px; border-left: 4px solid #0F2453; padding-left: 15px;">Layanan Kami Lainnya</h4>
                        <div class="vl-service-list">
                            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px;">
                                @php
                                    $sidebarServices = \App\Models\Service::latest()->take(6)->get();
                                @endphp
                                @foreach($sidebarServices as $s)
                                @php
                                    $isActive = $s->id === $service->id;
                                @endphp
                                <li>
                                    <a href="{{ url('/services/' . $s->slug) }}" class="service-nav-link" style="display: flex; justify-content: space-between; align-items: center; padding: 12px 16px; background: {{ $isActive ? '#eef2ff' : '#f8faff' }}; border-radius: 12px; color: {{ $isActive ? '#1E3A8A' : '#4b5563' }}; text-decoration: none; font-weight: 700; font-size: 13px;">
                                        <span>{{ $s->name }}</span>
                                        <i class="fa-regular fa-chevron-right" style="font-size: 11px; color: #1E3A8A;"></i>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Contact & Assistance Widget -->
                    <div style="background: #fff; padding: 30px; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid #f1f1f1; margin-bottom: 30px;">
                        <h4 style="font-size: 18px; color: #0F2453; font-weight: 600; margin-bottom: 20px; border-left: 4px solid #0F2453; padding-left: 15px;">Bantuan & Kontak</h4>
                        <div style="display: flex; flex-direction: column; gap: 16px;">
                            @php
                                $contact_phone = \App\Models\Setting::get('contact_phone', '');
                                $contact_email = \App\Models\Setting::get('contact_email', '');
                                $contact_address = \App\Models\Setting::get('contact_address', '');
                            @endphp
                            @if($contact_phone)
                            <a href="{{ formatWhatsApp($contact_phone) }}" target="_blank" style="display: flex; align-items: center; gap: 12px; text-decoration: none; color: #4b5563; font-size: 13px; font-weight: 600;">
                                <div style="width: 36px; height: 36px; border-radius: 50%; background: #dcfce7; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa-brands fa-whatsapp" style="color: #25D366; font-size: 18px;"></i>
                                </div>
                                <span>{{ $contact_phone }}</span>
                            </a>
                            @endif
                            @if($contact_email)
                            <a href="mailto:{{ $contact_email }}" style="display: flex; align-items: center; gap: 12px; text-decoration: none; color: #4b5563; font-size: 13px; font-weight: 600;">
                                <div style="width: 36px; height: 36px; border-radius: 50%; background: #eef2ff; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa-solid fa-envelope" style="color: #1E3A8A; font-size: 15px;"></i>
                                </div>
                                <span style="word-break: break-all;">{{ $contact_email }}</span>
                            </a>
                            @endif
                            @if($contact_address)
                            <div style="display: flex; align-items: flex-start; gap: 12px; color: #4b5563; font-size: 13px; font-weight: 500;">
                                <div style="width: 36px; height: 36px; border-radius: 50%; background: #eef2ff; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa-solid fa-location-dot" style="color: #1E3A8A; font-size: 15px;"></i>
                                </div>
                                <span style="line-height: 1.5; margin-top: 4px;">{{ $contact_address }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Follow Us Widget -->
                    <div style="background: #0F2453; padding: 30px; border-radius: 24px; box-shadow: 0 15px 40px rgba(15, 36, 83, 0.2); color: #fff;">
                        <h4 style="font-size: 18px; color: #fff; font-weight: 800; margin-bottom: 20px;">Ikuti Kami</h4>
                        <div style="display: flex; gap: 12px;">
                            <a href="https://www.facebook.com/pt_bijp" target="_blank" rel="noopener noreferrer" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; transition: 0.3s;"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://www.tiktok.com/@pt_bijp" target="_blank" rel="noopener noreferrer" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; transition: 0.3s;"><i class="fa-brands fa-tiktok"></i></a>
                            <a href="https://www.instagram.com/pt_bijp" target="_blank" rel="noopener noreferrer" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; transition: 0.3s;"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--================= Other Services Section start =================-->
@if($relatedServices && $relatedServices->count() > 0)
<section id="other-services" class="vl-service-iner vkl-gray-bg-1 fix pt-100 pb-70" style="background-color: #f1f5f9;">
    <div class="container">
        <div class="row mb-50">
            <div class="col-xl-12 text-center">
                <span style="color: #1E3A8A; font-weight: 800; font-size: 12px; text-transform: uppercase; letter-spacing: 2px;">Rekomendasi</span>
                <h3 style="font-size: 32px; color: #0F2453; font-weight: 800; margin-top: 10px;">Layanan Lainnya</h3>
            </div>
        </div>
        <div class="row g-4">
            @foreach($relatedServices->take(3) as $related)
            <div class="col-xl-4 col-md-6 mb-20">
                <div style="background: #fff; border-radius: 28px; overflow: hidden; border: 1px solid #f1f1f1; box-shadow: 0 10px 30px rgba(15, 36, 83, 0.03); height: 100%; display: flex; flex-direction: column;">
                    <div style="aspect-ratio: 16/10; overflow: hidden; position: relative;">
                         @php
                            $relImg = $related->image ? (Str::startsWith($related->image, 'http') ? $related->image : asset($related->image)) : asset('assets/images/service-placeholder.jpg');
                         @endphp
                        <img loading="lazy" src="{{ $relImg }}" alt="{{ $related->name }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                    </div>
                    <div style="padding: 30px; flex-grow: 1; display: flex; flex-direction: column;">
                        <span style="color: #1E3A8A; font-weight: 700; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">Jasa & Manufaktur</span>
                        <h3 style="font-size: 18px; line-height: 1.4; font-weight: 800; margin-bottom: 20px;">
                            <a href="{{ url('/services/' . $related->slug) }}" style="color: #0F2453; text-decoration: none;">{{ Str::limit($related->name, 55) }}</a>
                        </h3>
                        <div style="margin-top: auto; padding-top: 15px; border-top: 1px solid #f0f0f0;">
                            <a href="{{ url('/services/' . $related->slug) }}" style="color: #1E3A8A; font-weight: 800; font-size: 13px; text-decoration: none; display: flex; justify-content: space-between; align-items: center;">
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
<!--================= Other Services Section End =================-->

@include('partials.cta')

@push('js')
@php
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => $service->name,
        'description' => strip_tags(Str::limit($service->description ?: 'Layanan ' . $service->name, 200)),
        'image' => $service->image ? (Str::startsWith($service->image, 'http') ? $service->image : asset($service->image)) : asset('assets/images/service-placeholder.jpg'),
        'provider' => [
            '@type' => 'Organization',
            'name' => \App\Models\Setting::get('site_name', 'PT Borneo Iban Jaya Perkasa')
        ],
        'url' => url('/services/' . $service->slug)
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endpush
@endsection



