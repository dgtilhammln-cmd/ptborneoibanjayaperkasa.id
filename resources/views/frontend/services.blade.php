@extends('layouts.frontend')

@push('head')
@php
    $breadcrumbs = [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Our Services', 'url' => url('/services')]
    ];
@endphp
@include('partials.schema', ['schemaType' => 'breadcrumb', 'breadcrumbs' => $breadcrumbs])
@include('partials.schema', ['schemaType' => 'organization'])
@if(isset($services) && $services->count() > 0)
@include('partials.schema', ['schemaType' => 'servicelist', 'services' => $services])
@endif
@endpush

@section('content')


    <!--================= Breadcrumb section start =================-->
    @php
        $breadcrumb = isset($page) && $page ? $page->getSection('breadcrumb', ['title' => 'Our Services', 'background_image' => 'assets/img/barfi/shape/breadcrumb-shape.svg']) : ['title' => 'Our Services', 'background_image' => 'assets/img/barfi/shape/breadcrumb-shape.svg'];
    @endphp
    <section class="vl-breadcrumb-bg" style="background-image: url({{ asset($breadcrumb['background_image'] ?? 'assets/img/barfi/shape/breadcrumb-shape.svg') }});">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 mx-auto text-center mb-30">
                    <div class="vl-breadcrumb-content">
                        <h2 class="title pb-20">{{ $breadcrumb['title'] ?? 'Our Services' }}</h2>
                        <ul>
                            <li><a href="{{ url("/") }}">Home </a></li>
                            <li><i class="fa-light fa-angle-right"></i></li>
                            <li><a class="active" href="#">Our Services</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================= Breadcrumb section End =================-->


    <!--================= service section start =================-->
    <section id="service" class="vl-service-iner vkl-gray-bg-1 fix pt-100 pb-70">
        <div class="container">
            <div class="row">
                @if(isset($services) && $services->count() > 0)
                    @foreach($services as $index => $service)
                    <div class="col-xl-4 col-md-6 mb-30">
                        <!-- single box Item Start -->
                        <div class="vl-solution-box-wrap2">
                            <!-- thumb -->
                            <div class="vl-thumb">
                                @if($service->image)
                                    <img src="{{ Str::startsWith($service->image, 'http') ? $service->image : asset($service->image) }}" alt="{{ $service->name }}">
                                    <img src="{{ Str::startsWith($service->image, 'http') ? $service->image : asset($service->image) }}" alt="{{ $service->name }}">
                                @else
                                    @php
                                        $imageIndex = ($index % 6) + 1;
                                    @endphp
                                    <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.{$imageIndex}.png") }}" alt="{{ $service->name }}">
                                    <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.{$imageIndex}.png") }}" alt="{{ $service->name }}">
                                @endif
                            </div>
                            <!-- content -->
                            <div class="vl-content">
                                <h3 class="title"><a href="{{ route('service.show', $service->slug) }}">{{ $service->name }}</a></h3>
                                <a href="{{ route('service.show', $service->slug) }}" class="solutation-more">Read More <span><i class="fa-regular fa-arrow-right"></i></span></a>
                            </div>
                        </div> <!-- single box Item End --> 
                    </div>
                    @endforeach
                @else
                <!-- Default Services (Hardcoded) -->
                <div class="col-xl-4 col-md-6 mb-30">
                    <!-- single box Item Start -->
                    <div class="vl-solution-box-wrap2">
                        <!-- thumb -->
                        <div class="vl-thumb">
                            <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.1.png") }}" alt="Barfi">
                            <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.1.png") }}" alt="Barfi">
                        </div>
                        <!-- content -->
                        <div class="vl-content">
                            <h3 class="title"><a href="{{ url("/services") }}">Residential Snow Removal</a></h3>
                            <p class="para">Keep your home safe accessible all winter long. Our residential snow removal service ensures your driveway, walkways.</p>
                            <a href="{{ url("/services") }}" class="solutation-more">Read More <span><i class="fa-regular fa-arrow-right"></i></span></a>
                        </div>
                    </div> <!-- single box Item End --> 
                </div>

                <div class="col-xl-4 col-md-6 mb-30">
                    <!-- single box Item Start -->
                    <div class="vl-solution-box-wrap2">
                        <!-- thumb -->
                        <div class="vl-thumb">
                            <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.2.png") }}" alt="Barfi">
                            <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.2.png") }}" alt="Barfi">
                        </div>
                        <!-- content -->
                        <div class="vl-content">
                            <h3 class="title"><a href="{{ url("/services") }}">Commercial Snow Removal</a></h3>
                            <p class="para">We know how important for businesses to stay open safe during winter weather Our commercial snow removal provides</p>
                            <a href="{{ url("/services") }}" class="solutation-more">Read More <span><i class="fa-regular fa-arrow-right"></i></span></a>
                        </div>
                    </div> <!-- single box Item End --> 
                </div>

                <div class="col-xl-4 col-md-6 mb-30">
                    <!-- single box Item Start -->
                    <div class="vl-solution-box-wrap2">
                        <!-- thumb -->
                        <div class="vl-thumb">
                            <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.3.png") }}" alt="Barfi">
                            <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.3.png") }}" alt="Barfi">
                        </div>
                        <!-- content -->
                        <div class="vl-content">
                            <h3 class="title"><a href="{{ url("/services") }}">Ice Management & De-Icing</a></h3>
                            <p class="para">Prevent slips fall & costly property damage with our proactive ice control solutions. We use environmentally safe de-icing material</p>
                            <a href="{{ url("/services") }}" class="solutation-more">Read More <span><i class="fa-regular fa-arrow-right"></i></span></a>
                        </div>
                    </div> <!-- single box Item End --> 
                </div>

                <div class="col-xl-4 col-md-6 mb-30">
                    <!-- single box Item Start -->
                    <div class="vl-solution-box-wrap2">
                        <!-- thumb -->
                        <div class="vl-thumb">
                            <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.4.png") }}" alt="Barfi">
                            <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.4.png") }}" alt="Barfi">
                        </div>
                        <!-- content -->
                        <div class="vl-content">
                            <h3 class="title"><a href="{{ url("/services") }}">Emergency Snow Removal</a></h3>
                            <p class="para">When a big storm hits you can count on us to respond quickly. Our emergency snow removal service is available 24/7 to handle.</p>
                            <a href="{{ url("/services") }}" class="solutation-more">Read More <span><i class="fa-regular fa-arrow-right"></i></span></a>
                        </div>
                    </div> <!-- single box Item End --> 
                </div>

                <div class="col-xl-4 col-md-6 mb-30">
                    <!-- single box Item Start -->
                    <div class="vl-solution-box-wrap2">
                        <!-- thumb -->
                        <div class="vl-thumb">
                            <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.5.png") }}" alt="Barfi">
                            <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.5.png") }}" alt="Barfi">
                        </div>
                        <!-- content -->
                        <div class="vl-content">
                            <h3 class="title"><a href="{{ url("/services") }}">Snow Plowing & Hauling</a></h3>
                            <p class="para">From heavy snowfalls to ongoing storms, our plowing and hauling services ensure your property stays clear remove snow.</p>
                            <a href="{{ url("/services") }}" class="solutation-more">Read More <span><i class="fa-regular fa-arrow-right"></i></span></a>
                        </div>
                    </div> <!-- single box Item End --> 
                </div>

                <div class="col-xl-4 col-md-6 mb-30">
                    <!-- single box Item Start -->
                    <div class="vl-solution-box-wrap2">
                        <!-- thumb -->
                        <div class="vl-thumb">
                            <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.6.png") }}" alt="Barfi">
                            <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.6.png") }}" alt="Barfi">
                        </div>
                        <!-- content -->
                        <div class="vl-content">
                            <h3 class="title"><a href="{{ url("/services") }}"> Sidewalk & Walkway Clearing</a></h3>
                            <p class="para">Keep your walkways and entry paths safe for family, employees, & visitors. Our team quickly clears snow & ice from sidewalks.</p>
                            <a href="{{ url("/services") }}" class="solutation-more">Read More <span><i class="fa-regular fa-arrow-right"></i></span></a>
                        </div>
                    </div> <!-- single box Item End --> 
                </div>

                <div class="col-xl-4 col-md-6 mb-30">
                    <!-- single box Item Start -->
                    <div class="vl-solution-box-wrap2">
                        <!-- thumb -->
                        <div class="vl-thumb">
                            <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.7.png") }}" alt="Barfi">
                            <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.7.png") }}" alt="Barfi">
                        </div>
                        <!-- content -->
                        <div class="vl-content">
                            <h3 class="title"><a href="{{ url("/services") }}"> Salting & Sanding Services</a></h3>
                            <p class="para">We offer professional salting and sanding to reduce ice buildup and improve traction. Using eco-friendly and effective materials.</p>
                            <a href="{{ url("/services") }}" class="solutation-more">Read More <span><i class="fa-regular fa-arrow-right"></i></span></a>
                        </div>
                    </div> <!-- single box Item End --> 
                </div>

                <div class="col-xl-4 col-md-6 mb-30">
                    <!-- single box Item Start -->
                    <div class="vl-solution-box-wrap2">
                        <!-- thumb -->
                        <div class="vl-thumb">
                            <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.8.png") }}" alt="Barfi">
                            <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.8.png") }}" alt="Barfi">
                        </div>
                        <!-- content -->
                        <div class="vl-content">
                            <h3 class="title"><a href="{{ url("/services") }}">Roof Snow Removal</a></h3>
                            <p class="para">Heavy snow buildup can put serious strain on roof. Our roof snow removal specialists safely clear accumulated snow and ice.</p>
                            <a href="{{ url("/services") }}" class="solutation-more">Read More <span><i class="fa-regular fa-arrow-right"></i></span></a>
                        </div>
                    </div> <!-- single box Item End --> 
                </div>

                <div class="col-xl-4 col-md-6 mb-30">
                    <!-- single box Item Start -->
                    <div class="vl-solution-box-wrap2">
                        <!-- thumb -->
                        <div class="vl-thumb">
                            <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.9.png") }}" alt="Barfi">
                            <img src="{{ asset("assets/img/barfi/SnowRemovalTwo/solution/solution-thumb2.9.png") }}" alt="Barfi">
                        </div>
                        <!-- content -->
                        <div class="vl-content">
                            <h3 class="title"><a href="{{ url("/services") }}">Snow Relocation & Disposal</a></h3>
                            <p class="para">When piles of snow start to take valuable space, our hauling service can help. We relocate and dispose of excess snow.</p>
                            <a href="{{ url("/services") }}" class="solutation-more">Read More <span><i class="fa-regular fa-arrow-right"></i></span></a>
                        </div>
                    </div> <!-- single box Item End --> 
                </div>
                @endif
            </div>

            @if(isset($services) && $services->hasPages())
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="vl-theme-pagination text-center mt-18 mb-30">
                        <ul>
                            @if($services->onFirstPage())
                                <li><a href="#"><i class="fa-regular fa-angle-left"></i></a></li>
                            @else
                                <li><a href="{{ $services->previousPageUrl() }}"><i class="fa-regular fa-angle-left"></i></a></li>
                            @endif

                            @foreach($services->getUrlRange(1, $services->lastPage()) as $page => $url)
                                @if($page == $services->currentPage())
                                    <li><a href="#" class="active">{{ $page }}</a></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            @if($services->hasMorePages())
                                <li><a href="{{ $services->nextPageUrl() }}"><i class="fa-regular fa-angle-right"></i></a></li>
                            @else
                                <li><a href="#"><i class="fa-regular fa-angle-right"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    <!--================= service section End =================-->

    <!--================= Work section Start =================-->
    @if(isset($page) && $page && $page->isSectionActive('work_section'))
        @php
            $workSection = $page->getSection('work_section', []);
            $steps = $workSection['steps'] ?? [];
        @endphp
        <section class="vl-about-fact bg-cmon fix pt-100 pb-100" style="background-image: url({{ asset($workSection['background_image'] ?? 'assets/img/barfi/shape/fact-shape-about-bg.svg') }});">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 mx-auto text-center">
                        <!-- section title start -->
                        <div class="vl-section-title mb-60">
                            <h4 class="subtitle"> <span><img class="circle" src="{{ asset("assets/img/barfi/icon/sub-title-icon1.1.svg") }}" alt="PT. Borneo Iban Jaya Perkasa"></span> {{ $workSection['subtitle'] ?? 'Cara Kami Bekerja' }}</h4>
                            <h2 class="title">{{ $workSection['heading'] ?? 'Proses Layanan Jasa Logam & Produksi Sparepart' }}</h2>
                        </div> <!-- section title End -->
                    </div>
                </div>
                <div class="row">
                    @if(count($steps) > 0)
                        @foreach($steps as $step)
                        <!-- single work box -->
                        <div class="col-xl-3 col-md-6 mb-30">
                            <div class="vl-work-box3 vl-work-box3-inner">
                                <!-- number -->
                                <div class="vl-number">
                                    <span>{{ $step['number'] ?? '01' }}</span>
                                </div>
                                <!-- content -->
                                <div class="vl-content">
                                    <h3 class="title title-2">{{ $step['title'] ?? 'Step' }}</h3>
                                    <p class="para para-2">{{ $step['description'] ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <!-- Fallback: Hardcoded steps -->
                        <div class="col-xl-4 col-md-6 mb-30">
                            <div class="vl-work-box3 vl-work-box3-inner">
                                <div class="vl-number">
                                    <span>01</span>
                                </div>
                                <div class="vl-content">
                                    <h3 class="title title-2">Konsultasi & Permintaan Penawaran</h3>
                                    <p class="para para-2">Hubungi kami melalui WhatsApp atau email untuk konsultasi kebutuhan Anda. Jelaskan spesifikasi, jumlah, dan detail proyek yang Anda butuhkan.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-30">
                            <div class="vl-work-box3 vl-work-box3-inner">
                                <div class="vl-number">
                                    <span>02</span>
                                </div>
                                <div class="vl-content">
                                    <h3 class="title title-2">Analisis & Perencanaan Produksi</h3>
                                    <p class="para para-2">Tim ahli kami akan menganalisis kebutuhan Anda secara detail, merencanakan proses produksi, dan menentukan material yang tepat.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-30">
                            <div class="vl-work-box3 vl-work-box3-inner">
                                <div class="vl-number">
                                    <span>03</span>
                                </div>
                                <div class="vl-content">
                                    <h3 class="title title-2">Produksi & Quality Control</h3>
                                    <p class="para para-2">Proses produksi dilakukan dengan standar kualitas tinggi menggunakan peralatan modern dengan kontrol kualitas ketat.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif
    <!--================= Work section End =================-->

    <!--================= Contact section Start =================-->
    @php
        $contactSection = isset($page) && $page ? $page->getSection('contact_section', []) : [];
        $contactCards = $contactSection['contact_cards'] ?? [];
    @endphp
    <section id="contact" class="vl-team4 vkl-gray-bg-1 fix pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 mx-auto text-center">
                    <!-- section title start -->
                    <div class="vl-section-title mb-60">
                        <h4 class="subtitle"> <span><img class="circle" src="{{ asset("assets/img/barfi/icon/sub-title-icon1.1.svg") }}" alt="PT. Borneo Iban Jaya Perkasa"></span> {{ $contactSection['subtitle'] ?? 'Hubungi Kami' }}</h4>
                        <h2 class="title">{{ $contactSection['heading'] ?? 'Layanan Profesional untuk Kebutuhan Industri Anda' }}</h2>
                    </div> <!-- section title End -->
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-xl-6 mb-30">
                    <div class="vl-contact-frombox-wrap6 vl-contact-frombox-wrap6-inner">
                        <h3 class="title title-2 mb-32">{{ $contactSection['contact_title'] ?? 'Hubungi Kami Sekarang' }}</h3>
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-6 mb-20">
                                    <div class="vl-single-input-box6 vl-single-input-box6-inner">
                                        <label for="#">Nama Lengkap*</label>
                                        <input type="text" placeholder="Nama Anda">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="vl-single-input-box6 vl-single-input-box6-inner">
                                        <label for="#">Email*</label>
                                        <input type="email" placeholder="email@example.com">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="vl-single-input-box6 vl-single-input-box6-inner">
                                        <label for="#">Nomor WhatsApp*</label>
                                        <input type="text" placeholder="081234567890">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="vl-single-input-box6 vl-single-input-box6-inner">
                                        <label for="#">Pilih Layanan*</label>
                                        <select class="nice-select vl-nice-select vl-nice-select-inner wide">
                                            <option data-display="Pilih Layanan">Pilih Layanan</option>
                                            <option value="1">Jasa Bubut</option>
                                            <option value="2">Jasa Stamping</option>
                                            <option value="3">Jasa Moulding</option>
                                            <option value="4">Jasa Plong</option>
                                            <option value="5">Jasa Tekuk</option>
                                            <option value="6">Produksi Sparepart</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-32">
                                    <div class="vl-single-input-box6 vl-single-input-box6-inner">
                                        <label for="#">Pesan*</label>
                                        <textarea name="message" id="message" placeholder="Jelaskan kebutuhan proyek Anda"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="vl-contact-form-btn6">
                                        <button class="w-100 br-50 vl-primary-btn3 vl-primary-btn3-9">Kirim Pesan <i class="fa-regular fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-6 mb-30">
                    <div class="vl-contact-wrapper-6">
                        <div class="vl-contact-wrap6 mb-48">
                            <h3 class="title title-2">Informasi Kontak</h3>
                            <p class="para para-2 pt-16">{{ $contactSection['contact_description'] ?? 'Ada pertanyaan tentang layanan kami? Tim profesional kami siap membantu Anda. Hubungi kami untuk konsultasi gratis, penawaran, atau informasi lebih lanjut tentang jasa bubut, stamping, moulding, plong, tekuk, dan produksi sparepart.' }}</p>
                        </div>
                        <!-- icon box -->
                        <div class="vl-contact-icon-wrap-6">
                            @if(count($contactCards) > 0)
                                @foreach($contactCards as $card)
                                <!-- single icon box -->
                                <div class="vl-single-box6 vl-single-box6-2 vl-single-box6-2-inner">
                                    <div class="vl-single-box6-icon">
                                        <span><img src="{{ asset($card['icon'] ?? 'assets/img/barfi/icon/vl-contact-icon-6.1.svg') }}" alt="{{ $card['title'] ?? 'Contact' }}"></span>
                                    </div>
                                    <div class="vl-single-box6-content">
                                        <h3 class="title title-2">{{ $card['title'] ?? 'Title' }}</h3>
                                        <p class="para para-2">{{ $card['text'] ?? '' }}</p>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <!-- Fallback: Hardcoded contact cards -->
                                <div class="vl-single-box6 vl-single-box6-2 vl-single-box6-2-inner">
                                    <div class="vl-single-box6-icon">
                                        <span><img src="{{ asset("assets/img/barfi/icon/vl-contact-icon-6.1.svg") }}" alt="PT. Borneo Iban Jaya Perkasa"></span>
                                    </div>
                                    <div class="vl-single-box6-content">
                                        <h3 class="title title-2">Alamat</h3>
                                        <p class="para para-2">Jl. Ngingas Selatan No. 29, RT. 002, RW. 001, Ngingas Waru, Sidoarjo, Jawa Timur 61256</p>
                                    </div>
                                </div>
                                <div class="vl-single-box6 vl-single-box6-2 vl-single-box6-2-inner">
                                    <div class="vl-single-box6-icon">
                                        <span><img src="{{ asset("assets/img/barfi/icon/vl-contact-icon-6.2.svg") }}" alt="PT. Borneo Iban Jaya Perkasa"></span>
                                    </div>
                                    <div class="vl-single-box6-content">
                                        <h3 class="title title-2">WhatsApp</h3>
                                        <p class="para para-2">031-8559-7449 / 0895-1553-2597</p>
                                    </div>
                                </div>
                                <div class="vl-single-box6 vl-single-box6-2 vl-single-box6-2-inner">
                                    <div class="vl-single-box6-icon">
                                        <span><img src="{{ asset("assets/img/barfi/icon/vl-contact-icon-6.3.svg") }}" alt="PT. Borneo Iban Jaya Perkasa"></span>
                                    </div>
                                    <div class="vl-single-box6-content">
                                        <h3 class="title title-2">Jam Operasional</h3>
                                        <p class="para para-2">Senin - Jumat: 08:00 - 17:00 WIB</p>
                                    </div>
                                </div>
                                <div class="vl-single-box6 vl-single-box6-2 vl-single-box6-2-inner">
                                    <div class="vl-single-box6-icon">
                                        <span><img src="{{ asset("assets/img/barfi/icon/vl-contact-icon-6.4.svg") }}" alt="PT. Borneo Iban Jaya Perkasa"></span>
                                    </div>
                                    <div class="vl-single-box6-content">
                                        <h3 class="title title-2">Email</h3>
                                        <p class="para para-2">bigjaya503@gmail.com</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================= Contact section End =================-->
    
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
