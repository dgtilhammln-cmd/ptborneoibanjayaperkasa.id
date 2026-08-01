@extends('layouts.frontend')

@push('head')
@php
    $breadcrumbs = [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Contact Us', 'url' => url('/contact')]
    ];
@endphp
@include('partials.schema', ['schemaType' => 'breadcrumb', 'breadcrumbs' => $breadcrumbs])
@include('partials.schema', ['schemaType' => 'organization'])
@if(isset($page))
@include('partials.schema', ['schemaType' => 'contactpage', 'page' => $page])
@endif

<style>
    /* ============================================
       CONTACT PAGE – Design System (Seragam Homepage)
       Font: Inter/system, Colors: #111827, #0F2453, #1E3A8A, #64748B
       ============================================ */

    #contact-hero {
        background-color: #fafbfc;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        padding: 80px 0 60px;
        overflow: hidden;
    }

    /* --- Info Cards (Seragam dengan product/service card homepage) --- */
    .contact-info-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #f1f5f9;
        padding: 32px 28px;
        height: 100%;
        display: flex;
        flex-direction: column;
        gap: 16px;
        transition: all 0.35s ease;
    }
    .contact-info-card:hover {
        border-color: #1E3A8A;
        box-shadow: 0 20px 40px -10px rgba(15, 36, 83, 0.12);
        transform: translateY(-6px);
    }
    .contact-info-card .card-icon {
        width: 52px;
        height: 52px;
        background: rgba(30, 58, 138, 0.08);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1E3A8A;
        flex-shrink: 0;
    }
    .contact-info-card h4 {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin: 0 0 4px;
    }
    .contact-info-card p,
    .contact-info-card a {
        font-size: 15px;
        color: #64748B;
        margin: 0;
        text-decoration: none;
        line-height: 1.6;
        transition: color 0.3s;
        display: block;
    }
    .contact-info-card a:hover {
        color: #1E3A8A;
    }

    /* --- CTA/WhatsApp Card (Aksen hijau) --- */
    .contact-wa-card {
        background: linear-gradient(135deg, #0F2453 0%, #1E3A8A 100%);
        border-radius: 20px;
        padding: 36px 32px;
        color: #fff;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 24px;
        position: relative;
        overflow: hidden;
    }
    .contact-wa-card::before {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }
    .contact-wa-card::after {
        content: '';
        position: absolute;
        bottom: -60px;
        right: 20px;
        width: 130px;
        height: 130px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
    }
    .contact-wa-card h3 {
        font-size: 22px;
        font-weight: 700;
        color: #fff;
        margin: 0;
        line-height: 1.3;
        position: relative;
        z-index: 1;
    }
    .contact-wa-card p {
        font-size: 14px;
        color: rgba(255,255,255,0.75);
        margin: 8px 0 0;
        position: relative;
        z-index: 1;
    }
    .wa-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #25D366;
        color: #fff !important;
        padding: 14px 24px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 15px;
        text-decoration: none !important;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
        width: fit-content;
    }
    .wa-btn:hover {
        background: #1ebe5a;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(37, 211, 102, 0.35);
    }

    /* --- Map Section --- */
    .contact-map-wrap {
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 60px -15px rgba(15, 36, 83, 0.12);
        border: 1px solid #f1f5f9;
        height: 420px;
    }
    .contact-map-wrap iframe {
        width: 100%;
        height: 100%;
        border: 0;
        display: block;
    }

    /* --- Map Info Sidebar --- */
    .map-info-block {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #f1f5f9;
        padding: 32px;
        height: 100%;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    .map-info-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
    }
    .map-info-item .mini-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: rgba(30, 58, 138, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1E3A8A;
        flex-shrink: 0;
        margin-top: 2px;
    }
    .map-info-item h5 {
        font-size: 13px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0 0 4px;
    }
    .map-info-item p, .map-info-item a {
        font-size: 15px;
        color: #111827;
        margin: 0;
        text-decoration: none;
        font-weight: 500;
        line-height: 1.5;
        transition: color 0.3s;
    }
    .map-info-item a:hover { color: #1E3A8A; }

    /* Divider line di map info */
    .map-info-divider {
        height: 1px;
        background: #f1f5f9;
    }

    /* --- Subtitle Badge (Sama persis homepage) --- */
    .section-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(30, 58, 138, 0.08);
        padding: 8px 16px;
        border-radius: 30px;
        margin-bottom: 20px;
    }
    .section-badge span {
        font-size: 13px;
        font-weight: 700;
        color: #1E3A8A;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    /* --- Breadcrumb override agar tetap pakai template existing --- */

    /* --- Mobile responsive --- */
    @media (max-width: 768px) {
        .contact-map-wrap { height: 280px; }
        #contact-hero { padding: 50px 0 40px; }
    }
</style>
@endpush

@section('content')

    <!--================= Breadcrumb section start =================-->
    @php
        $breadcrumb = isset($page) && $page ? $page->getSection('breadcrumb', ['title' => 'Hubungi Kami', 'background_image' => 'assets/img/barfi/shape/breadcrumb-shape.svg']) : ['title' => 'Hubungi Kami', 'background_image' => 'assets/img/barfi/shape/breadcrumb-shape.svg'];
    @endphp
    <section class="vl-breadcrumb-bg" style="background-image: url({{ asset($breadcrumb['background_image'] ?? 'assets/img/barfi/shape/breadcrumb-shape.svg') }});">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 mx-auto text-center mb-30">
                    <div class="vl-breadcrumb-content">
                        <h2 class="title pb-20">{{ $breadcrumb['title'] ?? 'Hubungi Kami' }}</h2>
                        <ul>
                            <li><a href="{{ url("/") }}">Home </a></li>
                            <li><i class="fa-light fa-angle-right"></i></li>
                            <li><a class="active" href="{{ url("/contact") }}">Hubungi Kami</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================= Breadcrumb section End =================-->


    <!--================= Contact Hero Section Start =================-->
    @php
        $contactSection = isset($page) && $page ? $page->getSection('contact_section', []) : [];
        $contactCardsRaw = isset($page) && $page ? ($page->sections['contact_cards'] ?? []) : [];
        $contactCards = is_array($contactCardsRaw) ? $contactCardsRaw : [];
        $isContactActive = isset($page) && $page ? $page->isSectionActive('contact_section') : true;
    @endphp

    @if($isContactActive)
    <section id="contact-hero" style="background-color: #fafbfc; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
        <div class="container">

            <!-- Header -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-7 text-center">
                    <div class="section-badge" data-aos="fade-up">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1E3A8A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                        <span>{{ $contactSection['subtitle'] ?? 'Hubungi Kami' }}</span>
                    </div>
                    <h2 style="font-size: clamp(28px, 4vw, 42px); color: #111827; font-weight: 700; line-height: 1.2; letter-spacing: -1px; margin-bottom: 16px;" data-aos="fade-up" data-aos-delay="100">
                        {{ $contactSection['heading'] ?? 'Hubungi Tim Profesional Kami' }}
                    </h2>
                    <p style="font-size: 16px; color: #64748B; line-height: 1.7; margin: 0;" data-aos="fade-up" data-aos-delay="150">
                        {{ $contactSection['description'] ?? 'Ada pertanyaan tentang layanan kami? Tim profesional PT. Borneo Iban Jaya Perkasa siap membantu. Hubungi kami untuk konsultasi gratis, penawaran harga, atau informasi lebih lanjut.' }}
                    </p>
                </div>
            </div>

            <!-- Banner Image -->
            @if(!empty($contactSection['image']))
            <div class="row mb-5" data-aos="fade-up" data-aos-delay="200">
                <div class="col-12">
                    <div style="border-radius: 24px; overflow: hidden; box-shadow: 0 20px 50px -15px rgba(15, 36, 83, 0.12);">
                        <img loading="lazy" src="{{ asset($contactSection['image']) }}" alt="PT. Borneo Iban Jaya Perkasa" style="width: 100%; max-height: 420px; object-fit: cover; display: block;">
                    </div>
                </div>
            </div>
            @endif

            <!-- Info Cards Row -->
            @php
                $contactCards = array_filter($contactCards, 'is_array');
            @endphp

            @if(count($contactCards) > 0)
            <div class="row g-4 mb-5">
                @foreach($contactCards as $index => $card)
                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ 100 + ($index * 80) }}">
                    <div class="contact-info-card">
                        <div class="card-icon">
                            @if(($card['icon_type'] ?? 'image') == 'whatsapp')
                                <i class="fa-brands fa-whatsapp" style="font-size: 24px; color: #25D366;"></i>
                            @else
                                <img loading="lazy" src="{{ asset($card['icon'] ?? 'assets/img/barfi/icon/vl-contact-icon1.1.svg') }}" alt="{{ $card['title'] ?? 'Contact' }}" style="width: 26px; height: 26px; object-fit: contain;">
                            @endif
                        </div>
                        <div>
                            <h4>{{ $card['title'] ?? 'Title' }}</h4>
                            @if(isset($card['content']) && is_array($card['content']))
                                @foreach($card['content'] as $i => $contentItem)
                                    @if(strpos(strtolower($card['title'] ?? ''), 'email') !== false)
                                        <a href="mailto:{{ $contentItem }}">{{ $contentItem }}</a>
                                    @elseif(strpos(strtolower($card['title'] ?? ''), 'whatsapp') !== false || ($card['icon_type'] ?? '') == 'whatsapp')
                                        @php $waLink = formatWhatsApp($contentItem); @endphp
                                        <a href="{{ $waLink }}" target="_blank">{{ $contentItem }}</a>
                                    @else
                                        <p>{{ $contentItem }}</p>
                                    @endif
                                @endforeach
                            @elseif(isset($card['content']))
                                <p>{{ $card['content'] }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @else
            {{-- Fallback: Hardcoded Cards --}}
            <div class="row g-4 mb-5">

                <!-- Email -->
                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-info-card">
                        <div class="card-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </div>
                        <div>
                            <h4>Email Kami</h4>
                            <a href="mailto:pt.borneoibanjayaperkasa@gmail.com">pt.borneoibanjayaperkasa@gmail.com</a>
                        </div>
                    </div>
                </div>

                <!-- WhatsApp -->
                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="180">
                    <div class="contact-info-card">
                        <div class="card-icon">
                            <i class="fa-brands fa-whatsapp" style="font-size: 24px; color: #25D366;"></i>
                        </div>
                        <div>
                            <h4>WhatsApp</h4>
                            @php
                                $contactPhone = \App\Models\Setting::get('contact_phone', '0812-5989-6884');
                                $whatsappLink = formatWhatsApp($contactPhone);
                            @endphp
                            <a href="{{ $whatsappLink }}" target="_blank">{{ $contactPhone }}</a>
                            <a href="tel:03185597449" style="margin-top: 4px;">(031) 8559-7449</a>
                        </div>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="260">
                    <div class="contact-info-card">
                        <div class="card-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div>
                            <h4>Alamat Workshop</h4>
                            <p>Jl. Ngingas Selatan No. 29, RT. 002, RW. 001, Waru, Sidoarjo, Jawa Timur 61256</p>
                        </div>
                    </div>
                </div>

                <!-- Jam Operasional -->
                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="340">
                    <div class="contact-info-card">
                        <div class="card-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        </div>
                        <div>
                            <h4>Jam Operasional</h4>
                            <p>Senin – Jumat</p>
                            <p style="color: #111827; font-weight: 600;">08:00 – 17:00 WIB</p>
                        </div>
                    </div>
                </div>

            </div>
            @endif

            <!-- WhatsApp CTA Card (Full Width) -->
            <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                <div class="col-12">
                    <div class="contact-wa-card">
                        <div>
                            <h3>Butuh Konsultasi atau Penawaran Harga?</h3>
                            <p>Tim sales kami siap merespons dengan cepat. Chat langsung via WhatsApp untuk diskusi kebutuhan fabrikasi, sparepart, atau custom order Anda.</p>
                        </div>
                        <div style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
                            @php
                                $waPhoneCta = \App\Models\Setting::get('contact_phone', '0812-5989-6884');
                                $waLinkCta  = formatWhatsApp($waPhoneCta);
                            @endphp
                            <a href="{{ $waLinkCta }}" target="_blank" class="wa-btn">
                                <i class="fa-brands fa-whatsapp" style="font-size: 20px;"></i>
                                Chat WhatsApp Sekarang
                            </a>
                            <a href="mailto:pt.borneoibanjayaperkasa@gmail.com" style="display: inline-flex; align-items: center; gap: 8px; color: rgba(255,255,255,0.8); font-size: 14px; font-weight: 600; text-decoration: none; transition: color 0.3s; position: relative; z-index: 1;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.8)'">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                pt.borneoibanjayaperkasa@gmail.com
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @endif
    <!--================= Contact Hero Section End =================-->


    <!--================= Map + Sidebar Section Start =================-->
    @php
        $mapUrl = isset($page) && $page ? $page->getSection('map_url', '') : '';
    @endphp
    <section style="background-color: #ffffff; padding: 80px 0; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
        <div class="container">

            <!-- Section Header -->
            <div class="row mb-5">
                <div class="col-lg-8">
                    <div class="section-badge" data-aos="fade-up">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1E3A8A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <span>Lokasi Workshop</span>
                    </div>
                    <h2 style="font-size: clamp(26px, 3.5vw, 38px); color: #111827; font-weight: 700; line-height: 1.2; letter-spacing: -1px; margin: 0;" data-aos="fade-up" data-aos-delay="100">
                        PT. Borneo Iban Jaya Perkasa
                    </h2>
                </div>
            </div>

            <!-- Map + Info Row -->
            <div class="row g-4 align-items-stretch">

                <!-- Map -->
                <div class="col-lg-8" data-aos="fade-right">
                    <div class="contact-map-wrap">
                        @if(!empty($mapUrl))
                            <iframe src="{{ $mapUrl }}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        @else
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5!2d112.72!3d-7.38!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMjInNDgiLjAiUyAxMTLCsDQzJzEyLjAiRQ!5e0!3m2!1sen!2sid!4v1680000000000!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        @endif
                    </div>
                </div>

                <!-- Info Sidebar -->
                <div class="col-lg-4" data-aos="fade-left" data-aos-delay="100">
                    <div class="map-info-block">

                        <!-- Title -->
                        <div>
                            <h3 style="font-size: 20px; font-weight: 700; color: #111827; margin: 0 0 6px;">Alamat Lengkap kami</h3>
                            <p style="font-size: 13px; color: #94a3b8; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin: 0;">Workshop & Kantor Pusat</p>
                        </div>

                        <div class="map-info-divider"></div>

                        <!-- Alamat -->
                        <div class="map-info-item">
                            <div class="mini-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            </div>
                            <div>
                                <h5>Alamat</h5>
                                <p>Jl. Ngingas Selatan RT 2 RW 1 No. 29, Waru, Sidoarjo, Jawa Timur 61256</p>
                            </div>
                        </div>

                        <div class="map-info-divider"></div>

                        <!-- Telepon -->
                        <div class="map-info-item">
                            <div class="mini-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.4 2 2 0 0 1 3.6 1.21h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.91a16 16 0 0 0 6.08 6.08l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            </div>
                            <div>
                                <h5>Telepon</h5>
                                <a href="tel:03185597449">(031) 8559-7449</a>
                                <a href="tel:081259896884" style="margin-top: 3px;">0812-5989-6884</a>
                            </div>
                        </div>

                        <div class="map-info-divider"></div>

                        <!-- Email -->
                        <div class="map-info-item">
                            <div class="mini-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            </div>
                            <div>
                                <h5>Email</h5>
                                <a href="mailto:pt.borneoibanjayaperkasa@gmail.com" style="font-size: 13.5px;">pt.borneoibanjayaperkasa@gmail.com</a>
                            </div>
                        </div>

                        <div class="map-info-divider"></div>

                        <!-- Jam Operasional -->
                        <div class="map-info-item">
                            <div class="mini-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            </div>
                            <div>
                                <h5>Jam Operasional</h5>
                                <p>Senin – Jumat: <strong>08:00 – 17:00 WIB</strong></p>
                            </div>
                        </div>

                        <!-- Direction Button -->
                        <a href="https://maps.google.com/?q=Jl+Ngingas+Selatan+No+29+Waru+Sidoarjo" target="_blank" style="display: inline-flex; align-items: center; gap: 8px; background: #0F2453; color: #fff; padding: 13px 22px; border-radius: 12px; font-weight: 700; font-size: 14px; text-decoration: none; transition: all 0.3s ease; margin-top: auto;" onmouseover="this.style.background='#1E3A8A'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#0F2453'; this.style.transform='translateY(0)';">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
                            Petunjuk Arah
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--================= Map + Sidebar Section End =================-->


    @include('partials.cta')

    <!-- progress -->
    <div class="paginacontainer">
        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
            </svg>
        </div>
    </div>

@endsection
