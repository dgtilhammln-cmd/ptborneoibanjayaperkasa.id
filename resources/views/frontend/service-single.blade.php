@extends('layouts.frontend')

@push('head')
@php
    $breadcrumbs = [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Layanan Kami', 'url' => url('/services')],
        ['name' => $service->name, 'url' => url('/service/' . $service->slug)]
    ];
@endphp
@include('partials.schema', ['schemaType' => 'breadcrumb', 'breadcrumbs' => $breadcrumbs])
@include('partials.schema', ['schemaType' => 'organization'])
@include('partials.schema', ['schemaType' => 'service', 'service' => $service])
@endpush

@section('content')
<!--================= Breadcrumb section start =================-->
<section class="vl-breadcrumb-bg" style="background-image: url({{ asset('assets/img/barfi/shape/breadcrumb-shape.svg') }});">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-8 mx-auto text-center mb-30">
                <div class="vl-breadcrumb-content">
                    <h2 class="title pb-20">Detail Layanan Kami</h2>
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

<!--================= Service Details section start =================--> 
<section class="vl-service-details-inner pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-30">
               <div class="vl-sidebar-details mr-30">
                    <!-- thumb -->
                    @if($service->image)
                    <div class="vl-thumb-larg mb-32">
                        <img class="br-8 w-100" src="{{ Str::startsWith($service->image, 'http') ? $service->image : asset($service->image) }}" alt="{{ $service->name }}">
                    </div>
                    @endif
                    
                    <!-- content one -->
                    <div class="vl-sidebar-conten1t mb-32">
                        <h3 class="title">{{ $service->name }}</h3>
                        @if($service->description)
                        <div class="para pt-16">
                            {!! $service->description !!}
                        </div>
                        @else
                        <p class="para pt-16">Layanan profesional dengan kualitas terjamin untuk memenuhi kebutuhan industri Anda. Tim berpengalaman kami siap membantu mewujudkan proyek Anda dengan hasil yang presisi dan berkualitas tinggi.</p>
                        @endif
                    </div>

                    <!-- content 2 -->
                    <div class="vl-sidebar-conten1t vl-sidebar-conten1t-2 mb-32">
                        <h3 class="title">Layanan yang Dapat Diandalkan</h3>
                        <p class="para pt-16">Dengan pengalaman bertahun-tahun di industri logam dan manufaktur, kami menyediakan layanan yang dapat diandalkan untuk berbagai kebutuhan. Tim profesional kami memastikan hasil yang presisi dan berkualitas tinggi.</p>
                        <p class="para pt-16">Kami memahami bahwa setiap proyek memiliki kebutuhan yang unik. Oleh karena itu, kami menawarkan solusi yang disesuaikan dengan kebutuhan spesifik Anda, mulai dari produksi skala kecil hingga proyek industri besar.</p>
                    </div>

                    <!-- icon block -->
                    <div class="row">
                        <div class="col-lg-6 col-md-6 mb-30">
                            <div class="vl-deatils-icon-block-flex">
                                <div class="content">
                                    <h4 class="title pb-16">Komunikasi yang Handal</h4>
                                    <p class="para">Kami menyediakan komunikasi dan respons cepat selama proses produksi, memastikan Anda selalu mendapat update terkini tentang proyek Anda.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-30">
                            <div class="vl-deatils-icon-block-flex">
                                <div class="content">
                                    <h4 class="title pb-16">Tenaga Profesional Terlatih</h4>
                                    <p class="para">Dari kebutuhan industri kecil hingga kompleks industri besar, kami menyesuaikan setiap layanan sesuai dengan kebutuhan spesifik Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- service sm thumb -->
                    @if($service->image)
                    <div class="row">
                        <div class="col-lg-6 col-md-6 mb-30">
                            <div class="vl-service-sm-thumb">
                                <img class="w-100 br-8" src="{{ Str::startsWith($service->image, 'http') ? $service->image : asset($service->image) }}" alt="{{ $service->name }}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-30">
                            <div class="vl-service-sm-thumb">
                                <img class="w-100 br-8" src="{{ Str::startsWith($service->image, 'http') ? $service->image : asset($service->image) }}" alt="{{ $service->name }}">
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- content 2 -->
                    <div class="vl-sidebar-conten1t vl-sidebar-conten1t-2 mb-32">
                        <h3 class="title">Layanan Terpercaya untuk Setiap Proyek</h3>
                        <p class="para pt-16">Kami tidak hanya menyediakan layanan — kami merencanakan dengan matang. Tim ahli kami menganalisis kebutuhan Anda dan menyusun strategi yang tepat untuk memastikan hasil yang optimal. Menggunakan peralatan canggih, teknologi kontrol presisi, dan metode yang teruji, kami menyelesaikan setiap proyek dengan efisien tanpa mengorbankan kualitas.</p>
                        <p class="para pt-16">Setiap layanan disesuaikan dengan kebutuhan Anda. Baik Anda membutuhkan layanan on-demand, perawatan berkelanjutan, atau kontrak jangka panjang, kami menawarkan opsi fleksibel yang dirancang sesuai jadwal dan anggaran Anda. Kami berlisensi penuh dan terjamin, memberikan Anda ketenangan pikiran bahwa proyek Anda berada di tangan yang tepat.</p>
                    </div>

                    <!-- content one -->
                    @php
                        $advantages = $service->advantages ?? [
                            'Presisi Tinggi & Akurasi Terjamin',
                            'Tim Profesional Berpengalaman',
                            'Custom Order Sesuai Kebutuhan',
                            'Layanan Responsif & Support'
                        ];
                    @endphp
                    @if(!empty($advantages) && count($advantages) > 0)
                    <div class="vl-sidebar-conten1t vl-sidebar-conten1t-2 mt-18 mb-32">
                        <h3 class="title mb-28">Keunggulan Layanan Kami</h3>
                        <div class="vl-service-check-list">
                            <ul>
                                @foreach($advantages as $advantage)
                                <li><span><i class="fa-solid fa-check-circle" style="color: #25D366; font-size: 18px;"></i></span>{{ $advantage }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    
                    <!-- service faq -->
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
                            // Table doesn't exist or other error, use empty collection
                            $faqs = collect([]);
                        }
                    @endphp
                    @if($faqs->count() > 0)
                    <div class="row">
                        <div class="vl-faqs2 vl-faqs2-inner mt-25">
                            <div class="accordion" id="accordionExample">
                                @foreach($faqs as $index => $faq)
                                <div class="vl-accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                        <button class="vl-accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $faq->id }}">
                                            {{ $faq->question }}  <span class="vl-faqarrow"><i class="fa-regular fa-angle-down"></i></span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#accordionExample">
                                        <div class="vl-accordion-body">
                                            <p class="para">{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 mb-30">
                <div class="vl-sidebar">
                    <!-- search widget -->
                     <div class="vl-widegt-1 vl-off-white-bg mb-30">
                        <h4 class="title pb-24">Search</h4>
                        <div class="vl-searh-form-wid">
                            <form action="{{ url('/services') }}" method="GET">
                                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span><i class="fa-regular fa-magnifying-glass"></i></span>
                            </form>
                        </div>
                     </div>
                    <!-- service widget -->
                    <div class="vl-widegt-2 mb-30">
                        <h4 class="title pb-24">Layanan Kami Lainnya</h4>
                        <div class="vl-service-list">
                            <ul>
                                @php
                                    $allServices = \App\Models\Service::latest()->take(5)->get();
                                @endphp
                                @foreach($allServices as $s)
                                <li><a href="{{ url('/services/' . $s->slug) }}">{{ $s->name }} <span><i class="fa-regular fa-angle-right"></i></span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- phone widget -->
                    <div class="vl-widegt-3 mb-30">
                        <h4 class="title pb-24">Jika Anda Membutuhkan Bantuan <br> Hubungi Kami</h4>
                        <!-- icon list -->
                        <div class="vl-icon-list vl-icon-list-inner">
                            <ul>
                                @php
                                    $contact_phone = \App\Models\Setting::get('contact_phone', '');
                                    $contact_email = \App\Models\Setting::get('contact_email', '');
                                    $contact_address = \App\Models\Setting::get('contact_address', '');
                                @endphp
                                @if($contact_phone)
                                <li><a href="{{ formatWhatsApp($contact_phone) }}" target="_blank"><span class="mr-8"><i class="fa-brands fa-whatsapp" style="color: #25D366; font-size: 18px;"></i></span>{{ $contact_phone }}</a></li>
                                @endif
                                @if($contact_address)
                                <li><a href="#"><span class="mr-8"><i class="fa-solid fa-location-dot" style="color: #1E3A8A; font-size: 18px;"></i></span>{{ $contact_address }}</a></li>
                                @endif
                                @if($contact_email)
                                <li><a href="mailto:{{ $contact_email }}"><span class="mr-8"><i class="fa-solid fa-envelope" style="color: #1E3A8A; font-size: 18px;"></i></span>{{ $contact_email }}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <!-- social widget -->
                    <div class="vl-widegt-4 mb-30">
                        <h4 class="title pb-24">Follow Us</h4>
                        <div class="vl-sidebar-social">
                            <ul>
                                <!-- Facebook -->
                                <li>
                                    <a href="https://www.facebook.com/pt_bijp" target="_blank" rel="noopener noreferrer">
                                        <span><i class="fa-brands fa-facebook-f"></i></span>
                                    </a>
                                </li>
                                
                                <!-- TikTok -->
                                <li>
                                    <a href="https://www.tiktok.com/@pt_bijp" target="_blank" rel="noopener noreferrer">
                                        <span><i class="fa-brands fa-tiktok"></i></span>
                                    </a>
                                </li>
                                
                                <!-- Instagram -->
                                <li>
                                    <a href="https://www.instagram.com/pt_bijp" target="_blank" rel="noopener noreferrer">
                                        <span><i class="fa-brands fa-instagram"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================= Service Details section End =================-->

<!--================= service section start =================-->
@if($relatedServices && $relatedServices->count() > 0)
<section id="service" class="vl-service-iner vkl-gray-bg-1 fix pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 mx-auto text-center">
                <h3 class="more-title mb-60">Layanan Lainnya</h3>
            </div>
        </div>
        <div class="row">
            @foreach($relatedServices as $related)
            <div class="col-xl-4 col-md-6 mb-30">
                <!-- single box Item Start -->
                <div class="vl-solution-box-wrap2">
                    <!-- thumb -->
                    <div class="vl-thumb">
                        @if($related->image)
                        <img src="{{ Str::startsWith($related->image, 'http') ? $related->image : asset($related->image) }}" alt="{{ $related->name }}">
                        <img src="{{ Str::startsWith($related->image, 'http') ? $related->image : asset($related->image) }}" alt="{{ $related->name }}">
                        @else
                        <img src="{{ asset('assets/images/service-placeholder.jpg') }}" alt="{{ $related->name }}">
                        <img src="{{ asset('assets/images/service-placeholder.jpg') }}" alt="{{ $related->name }}">
                        @endif
                    </div>
                    <!-- content -->
                    <div class="vl-content">
                        <h3 class="title"><a href="{{ url('/services/' . $related->slug) }}">{{ $related->name }}</a></h3>
                        <a href="{{ url('/services/' . $related->slug) }}" class="solutation-more">Baca Selengkapnya <span><i class="fa-regular fa-arrow-right"></i></span></a>
                    </div>
                </div> <!-- single box Item End --> 
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!--================= service section End =================-->

@include('partials.cta')
@endsection

