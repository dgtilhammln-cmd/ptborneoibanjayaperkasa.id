@extends('layouts.frontend')

@push('head')
@php
    $breadcrumbs = [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Produk', 'url' => url('/products')],
        ['name' => $product->name, 'url' => url('/product/' . $product->slug)]
    ];
@endphp
@include('partials.schema', ['schemaType' => 'breadcrumb', 'breadcrumbs' => $breadcrumbs])
@include('partials.schema', ['schemaType' => 'organization'])
@include('partials.schema', ['schemaType' => 'product', 'product' => $product])
@endpush

@section('content')
<!--================= Breadcrumb section start =================-->
<section class="vl-breadcrumb-bg" style="background-image: url({{ asset('assets/img/shape/breadcrumb-shape.svg') }});">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-8 mx-auto text-center mb-30">
                <div class="vl-breadcrumb-content">
                    <h2 class="title pb-20">Detail Produk</h2>
                    <ul>
                        <li><a href="{{ url('/') }}">Home </a></li>
                        <li><i class="fa-light fa-angle-right"></i></li>
                        <li><a href="{{ route('products') }}">Produk</a></li>
                        <li><i class="fa-light fa-angle-right"></i></li>
                        <li><a class="active" href="#">{{ $product->name }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================= Breadcrumb section End =================-->

<!--================= Final Redesign: Product Details Start =================-->
<section class="vl-team-details-area vkl-gray-bg-1 pt-100 pb-70" style="background-color: #f8fafc; font-family: 'Inter', sans-serif;">
    <div class="container">
        
        <!-- ROW 1: HERO AREA (Thumbnail & Core Information) -->
        <div class="row align-items-stretch g-4 mb-40">
            
            <!-- KOLOM FOTO (Kiri Desktop, Atas Mobile) -->
            <div class="col-lg-5 col-xl-5">
                <div style="background: #fff; padding: 15px; border-radius: 32px; box-shadow: 0 15px 50px rgba(15, 36, 83, 0.08); border: 1px solid #f1f1f1; height: 100%; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    @php
                        $allImages = $product->getAllImages();
                        $mainImage = count($allImages) > 0 ? (Str::startsWith($allImages[0], 'http') ? $allImages[0] : asset($allImages[0])) : asset('assets/images/product-placeholder.jpg');
                    @endphp
                    <div style="width: 100%; height: 100%; position: relative;">
                         <img src="{{ $mainImage }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: contain; border-radius: 20px;">
                    </div>
                </div>
            </div>

            <!-- KOLOM KONTEN UTAMA (Kanan Desktop, Tengah Mobile) -->
            <div class="col-lg-7 col-xl-7">
                <div style="display: flex; flex-direction: column; justify-content: space-between; height: 100%; padding: 40px; background: #fff; border-radius: 32px; box-shadow: 0 15px 50px rgba(15, 36, 83, 0.05); border: 1px solid #f1f1f1;">
                    
                    <!-- Top: Identity -->
                    <div>
                        <span style="background: #eef2ff; color: #1E3A8A; padding: 6px 16px; border-radius: 50px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; display: inline-block; margin-bottom: 15px;">Industrial Premium Product</span>
                        <h1 style="font-size: 36px; color: #0F2453; font-weight: 800; margin-bottom: 10px; line-height: 1.2;">{{ $product->name }}</h1>
                        
                        <div class="d-flex align-items-center mb-20">
                            <div style="color: #FFD700; display: flex; gap: 4px; font-size: 14px;">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            </div>
                            <span style="margin-left: 10px; font-weight: 700; color: #0F2453; font-size: 14px;">5.0 <span style="font-weight: 400; color: #7C8192;">| Garansi Presisi 100%</span></span>
                        </div>
                    </div>

                    <!-- Middle: Short Description & Specs -->
                    <div style="margin: 25px 0;">
                        <div style="font-size: 15px; color: #4b5563; line-height: 1.8; margin-bottom: 25px;">
                            @if($product->description)
                                {!! Str::limit(strip_tags($product->description), 280) !!}
                            @else
                                Produk manufaktur unggulan PT. Borneo Iban Jaya Perkasa yang dirancang untuk durabilitas tinggi dan performa presisi di sektor industri maupun otomotif.
                            @endif
                        </div>

                        <!-- Info Box -->
                        <div style="display: flex; gap: 15px; background: #f8faff; padding: 20px; border-radius: 20px; border: 1px solid #ebf0f9;">
                            <div style="flex: 1;">
                                <label style="display: block; font-size: 9px; font-weight: 800; color: #7C8192; text-transform: uppercase; margin-bottom: 4px;">Kategori</label>
                                <span style="font-weight: 700; color: #0F2453; font-size: 13px; line-height: 1.2; display: block;">{{ str_replace('-', ' ', $product->category ?? 'Sparepart') }}</span>
                            </div>
                            <div style="width: 1px; background: #dee5f2;"></div>
                            <div style="flex: 1;">
                                <label style="display: block; font-size: 9px; font-weight: 800; color: #7C8192; text-transform: uppercase; margin-bottom: 4px;">Material</label>
                                <span style="font-weight: 700; color: #0F2453; font-size: 13px; display: block;">High-Grade Metal</span>
                            </div>
                            <div style="width: 1px; background: #dee5f2;"></div>
                            <div style="flex: 1;">
                                <label style="display: block; font-size: 9px; font-weight: 800; color: #7C8192; text-transform: uppercase; margin-bottom: 4px;">Standard</label>
                                <span style="font-weight: 700; color: #0F2453; font-size: 13px; display: block;">ISO Quality</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom: Action Buttons -->
                    <div class="row g-3">
                        @php
                            $contact_phone = \App\Models\Setting::get('contact_phone', '');
                            $whatsapp_number = preg_replace('/[^0-9]/', '', $contact_phone);
                        @endphp
                        <div class="col-md-6">
                            <a href="https://wa.me/{{ $whatsapp_number }}?text=Halo PT. Borneo Iban Jaya Perkasa, saya tertarik dengan produk {{ $product->name }}." 
                               target="_blank" 
                               style="background: #25D366; color: white; height: 60px; border-radius: 50px; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 10px; text-decoration: none; transition: 0.3s; box-shadow: 0 8px 20px rgba(37, 211, 102, 0.2); border: none; font-size: 16px;">
                                <i class="fa-brands fa-whatsapp" style="font-size: 24px;"></i> Hubungi Kami
                            </a>
                        </div>
                        <div class="col-md-6">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#productQuoteModal" 
                                    style="background: #0F2453; color: white; height: 60px; width: 100%; border-radius: 50px; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 10px; transition: 0.3s; border: none; font-size: 16px; box-shadow: 0 8px 20px rgba(15, 36, 83, 0.15);">
                                <i class="fa-solid fa-file-invoice-dollar"></i> Minta Penawaran
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROW 2: DETAILED INFO (Description & Sidebar Contact) -->
        <div class="row g-4">
            <!-- Deskripsi Lengkap (Kiri Desktop) -->
            <div class="col-xl-8 col-lg-7">
                <div style="background: #fff; padding: 45px; border-radius: 32px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid #f1f1f1; height: 100%;">
                    <div style="border-left: 5px solid #0F2453; padding-left: 20px; margin-bottom: 30px;">
                        <h3 style="font-size: 26px; color: #0F2453; font-weight: 800; margin-bottom: 0;">Keunggulan Produk</h3>
                    </div>
                    
                    <div style="font-size: 16px; color: #555; line-height: 1.9; margin-bottom: 40px;">
                        @if($product->description)
                            {!! $product->description !!}
                        @else
                            <p>Produk ini merupakan solusi andalan untuk kebutuhan industri Anda. Dengan material baja pilihan dan pengawasan kualitas yang ketat, kami menjamin setiap unit memiliki durabilitas jangka panjang.</p>
                        @endif
                    </div>

                    <!-- Modern Grid Feature -->
                    <div class="row g-4 mb-40">
                        <div class="col-sm-6">
                            <div style="display: flex; gap: 15px; background: #f8fafc; padding: 25px; border-radius: 20px; height: 100%;">
                                <i class="fa-solid fa-circle-check" style="color: #0F2453; font-size: 22px; margin-top: 3px;"></i>
                                <div>
                                    <h6 style="font-weight: 700; color: #0F2453; margin-bottom: 5px; font-size: 16px;">Quality Control</h6>
                                    <p style="font-size: 13px; color: #7C8192; margin: 0;">Pengecekan berlapis sebelum pengiriman ke tangan konsumen.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="display: flex; gap: 15px; background: #f8fafc; padding: 25px; border-radius: 20px; height: 100%;">
                                <i class="fa-solid fa-truck-fast" style="color: #0F2453; font-size: 22px; margin-top: 3px;"></i>
                                <div>
                                    <h6 style="font-weight: 700; color: #0F2453; margin-bottom: 5px; font-size: 16px;">Pengiriman Luas</h6>
                                    <p style="font-size: 13px; color: #7C8192; margin: 0;">Support pengiriman logistik aman ke seluruh Kawasan Industri Indonesia.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div style="border-top: 1px solid #eee; padding-top: 30px;">
                        <span style="font-weight: 800; color: #0F2453; font-size: 13px; margin-right: 15px; text-transform: uppercase; letter-spacing: 1px;">Tags:</span>
                        <a href="{{ route('products') }}" style="background: #f0f4f8; color: #0F2453; padding: 7px 18px; border-radius: 50px; font-size: 12px; font-weight: 700; text-decoration: none; margin-right: 8px;">#Sparepart</a>
                        <a href="{{ route('products') }}" style="background: #f0f4f8; color: #0F2453; padding: 7px 18px; border-radius: 50px; font-size: 12px; font-weight: 700; text-decoration: none; margin-right: 8px;">#Manufaktur</a>
                        <a href="{{ route('products') }}" style="background: #f0f4f8; color: #0F2453; padding: 7px 18px; border-radius: 50px; font-size: 12px; font-weight: 700; text-decoration: none;">#Industri</a>
                    </div>
                </div>
            </div>

            <!-- Kontak & Sosmed (Samping Desktop, Bawah Mobile) -->
            <div class="col-xl-4 col-lg-5">
                <div style="background: #fff; padding: 35px; border-radius: 32px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid #f1f1f1; height: 100%; display: flex; flex-direction: column;">
                    <h5 style="font-size: 11px; text-transform: uppercase; letter-spacing: 2px; color: #0F2453; font-weight: 800; margin-bottom: 25px; border-bottom: 1px solid #eee; padding-bottom: 15px;">Informasi Bisnis</h5>
                    
                    @php
                        $contact_email = \App\Models\Setting::get('contact_email', '');
                        $contact_address = \App\Models\Setting::get('contact_address', '');
                    @endphp

                    <div style="display: flex; flex-direction: column; gap: 20px;">
                        <!-- Telp/WA -->
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <span style="width: 42px; height: 42px; background: #f0f4f8; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;"><i class="fa-brands fa-whatsapp" style="color: #25D366; font-size: 20px;"></i></span>
                            <div>
                                <small style="display: block; color: #7C8192; font-size: 9px; font-weight: 800; text-transform: uppercase;">Layanan Cepat</small>
                                <span style="font-weight: 700; font-size: 15px; color: #0F2453;">{{ $contact_phone }}</span>
                            </div>
                        </div>

                        <!-- Email -->
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <span style="width: 42px; height: 42px; background: #f0f4f8; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;"><i class="fa-solid fa-envelope" style="color: #0F2453; font-size: 18px;"></i></span>
                            <div>
                                <small style="display: block; color: #7C8192; font-size: 9px; font-weight: 800; text-transform: uppercase;">Email Resmi</small>
                                <span style="font-weight: 600; font-size: 13px; color: #0F2453; word-break: break-all;">{{ $contact_email }}</span>
                            </div>
                        </div>

                        <!-- Lokasi -->
                        <div style="display: flex; align-items: flex-start; gap: 15px;">
                            <span style="width: 42px; height: 42px; background: #f0f4f8; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;"><i class="fa-solid fa-location-dot" style="color: #0F2453; font-size: 18px;"></i></span>
                            <div>
                                <small style="display: block; color: #7C8192; font-size: 9px; font-weight: 800; text-transform: uppercase;">Workshop Kami</small>
                                <span style="font-size: 12px; color: #0F2453; line-height: 1.5; font-weight: 500;">{{ $contact_address }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sosial Media -->
                    <div style="display: flex; gap: 12px; margin-top: auto; padding-top: 30px;">
                        <a href="https://www.instagram.com/pt_bijp" target="_blank" style="width: 45px; height: 45px; border-radius: 12px; background: #f8faff; border: 1px solid #eee; display: flex; align-items: center; justify-content: center; color: #0F2453; transition: 0.3s; text-decoration: none;"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://www.tiktok.com/@pt_bijp" target="_blank" style="width: 45px; height: 45px; border-radius: 12px; background: #f8faff; border: 1px solid #eee; display: flex; align-items: center; justify-content: center; color: #0F2453; transition: 0.3s; text-decoration: none;"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="https://www.facebook.com/pt_bijp" target="_blank" style="width: 45px; height: 45px; border-radius: 12px; background: #f8faff; border: 1px solid #eee; display: flex; align-items: center; justify-content: center; color: #0F2453; transition: 0.3s; text-decoration: none;"><i class="fa-brands fa-facebook-f"></i></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!--================= Product Details section End =================-->
<!--================= Team Details section End =================-->

<!--================= Konsultasi Cepat (Pesan Produk) start =================-->
<section class="vl-team-member-about-details vkl-gray-bg-1 pb-70">
    <div class="container">
       <div class="row justify-content-center">
          <div class="col-xl-10">
             <!-- Card Area -->
             <div class="team__member__details-cf" style="background: #fff; padding: 40px; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #eee;">
                
                <div class="row align-items-center">
                    <!-- Sisi Kiri: Teks -->
                    <div class="col-lg-7">
                        <h3 class="title" style="font-size: 26px; color: #0F2453; margin-bottom: 10px;">
                            Tertarik dengan <span style="color: #1E3A8A;">{{ $product->name }}</span>?
                        </h3>
                        <p style="font-size: 16px; color: #7C8192; line-height: 1.6;">
                            Dapatkan penawaran harga terbaik dan spesifikasi lengkap langsung dari tim teknis kami via WhatsApp.
                        </p>
                        
                        <!-- Info Kontak Mini -->
                        <div class="team__details__post-iconlist mt-24">
                            <ul style="display: flex; gap: 20px; flex-wrap: wrap;">
                                @if($contact_email)
                                <li><a href="mailto:{{ $contact_email }}"><i class="fa-solid fa-envelope" style="color: #1E3A8A;"></i> <span style="font-size: 14px;">{{ $contact_email }}</span></a></li>
                                @endif
                                @if($contact_phone)
                                <li><i class="fa-solid fa-clock" style="color: #1E3A8A;"></i> <span style="font-size: 14px;">Respon Cepat</span></li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <!-- Sisi Kanan: Tombol WA -->
                    <div class="col-lg-5 text-lg-end mt-30 mt-lg-0">
                        @if($contact_phone)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact_phone) }}?text={{ urlencode('Halo PT. Borneo Iban Jaya Perkasa, saya tertarik dengan produk: ' . $product->name . '. Bisa minta info harga dan spek lengkapnya?') }}" 
                           target="_blank" 
                           class="vl-primary-btn3" 
                           style="background: #25D366; border-color: #25D366; padding: 18px 35px; border-radius: 50px; display: inline-flex; align-items: center; gap: 10px; color: #fff; font-weight: 700; text-decoration: none;">
                            <i class="fa-brands fa-whatsapp" style="font-size: 24px;"></i> Tanya Via WhatsApp
                        </a>
                        @endif
                    </div>
                </div>

             </div>
          </div>
       </div>
    </div>
</section>
<!--================= about team-member end =================-->

<!--================= Related Products Section Start =================-->
@if($relatedProducts && $relatedProducts->count() > 0)
<section id="related-products" class="vl-service-iner vkl-gray-bg-1 fix pt-100 pb-70" style="background-color: #f8fafc;">
    <div class="container">
        <!-- Header Section -->
        <div class="row mb-50">
            <div class="col-xl-12">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px; border-bottom: 2px solid #eef2ff; padding-bottom: 20px;">
                    <div style="border-left: 5px solid #0F2453; padding-left: 20px;">
                        <h3 style="font-size: 28px; color: #0F2453; font-weight: 800; margin: 0;">Produk <span style="color: #1E3A8A;">Terkait</span></h3>
                        <p style="font-size: 14px; color: #7C8192; margin: 5px 0 0;">Pilihan komponen presisi lainnya untuk kebutuhan Anda</p>
                    </div>
                    <a href="{{ route('products') }}" style="color: #1E3A8A; font-weight: 700; text-decoration: none; font-size: 14px; display: flex; align-items: center; gap: 8px;">
                        Lihat Semua Produk <i class="fa-regular fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row g-4">
            @foreach($relatedProducts as $related)
            <div class="col-xl-4 col-md-6 mb-10">
                <!-- Product Card Item -->
                <div style="background: #fff; border-radius: 24px; padding: 20px; border: 1px solid #f1f1f1; box-shadow: 0 10px 30px rgba(15, 36, 83, 0.03); height: 100%; display: flex; flex-direction: column; transition: all 0.3s ease-in-out;">
                    
                    <!-- Thumbnail (Sejajar 1:1) -->
                    <div style="width: 100%; aspect-ratio: 1/1; background: #f9f9f9; border-radius: 16px; overflow: hidden; margin-bottom: 20px; display: flex; align-items: center; justify-content: center; border: 1px solid #f8fafc;">
                        @php
                            $relatedImage = $related->image ? (Str::startsWith($related->image, 'http') ? $related->image : asset($related->image)) : asset('assets/images/product-placeholder.jpg');
                        @endphp
                        <img src="{{ $relatedImage }}" alt="{{ $related->name }}" style="max-width: 90%; max-height: 90%; object-fit: contain;">
                    </div>

                    <!-- Content Box -->
                    <div style="flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <h3 style="font-size: 19px; font-weight: 800; line-height: 1.4; margin-bottom: 12px;">
                                <a href="{{ url('/products/' . $related->slug) }}" style="color: #0F2453; text-decoration: none; transition: 0.3s;">
                                    {{ $related->name }}
                                </a>
                            </h3>
                            <p style="font-size: 14px; color: #7C8192; line-height: 1.6; margin-bottom: 20px;">
                                {{ Str::limit(strip_tags($related->description), 90) }}
                            </p>
                        </div>

                        <!-- Action Link -->
                        <div style="border-top: 1px solid #f1f1f1; padding-top: 15px;">
                            <a href="{{ url('/products/' . $related->slug) }}" style="color: #1E3A8A; font-weight: 700; text-decoration: none; font-size: 14px; display: flex; align-items: center; gap: 8px; transition: 0.3s;">
                                Detail Produk 
                                <span style="width: 28px; height: 28px; background: #eef2ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px;">
                                    <i class="fa-regular fa-arrow-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div> <!-- End Product Card -->
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!--================= Related Products Section End =================-->

@include('partials.cta')

<!--================= Modern Product Quote Modal =================-->
<div class="modal fade" id="productQuoteModal" tabindex="-1" aria-labelledby="productQuoteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 24px; border: none; box-shadow: 0 20px 60px rgba(15, 36, 83, 0.2); overflow: hidden;">
            
            <!-- Header Modal -->
            <div class="modal-header" style="background: #fff; border-bottom: 1px solid #f1f1f1; padding: 25px 30px;">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 45px; height: 45px; background: #f0f4f8; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-file-invoice-dollar" style="color: #0F2453; font-size: 20px;"></i>
                    </div>
                    <div>
                        <h5 class="modal-title" id="productQuoteModalLabel" style="font-size: 18px; color: #0F2453; font-weight: 800; margin-bottom: 2px;">Minta Penawaran</h5>
                        <p style="font-size: 12px; color: #7C8192; margin: 0;">Respon cepat via WhatsApp Sales</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 12px;"></button>
            </div>

            <!-- Body Modal -->
            <div class="modal-body" style="padding: 30px; background: #fff;">
                <!-- Ringkasan Produk (Compact) -->
                <div style="background: #f8faff; padding: 15px 20px; border-radius: 16px; border: 1px solid #ebf0f9; margin-bottom: 25px; display: flex; align-items: center; gap: 12px;">
                    <i class="fa-solid fa-box-open" style="color: #1E3A8A; font-size: 16px;"></i>
                    <span style="font-size: 14px; font-weight: 700; color: #0F2453;">Produk: {{ $product->name }}</span>
                </div>

                <form id="productQuoteForm">
                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                    
                    <div class="row g-3">
                        <!-- Nama -->
                        <div class="col-md-12">
                            <label class="form-label" style="font-size: 11px; font-weight: 800; color: #7C8192; text-transform: uppercase; letter-spacing: 0.5px;">Nama Lengkap *</label>
                            <input type="text" class="form-control shadow-none" name="name" required placeholder="Contoh: Budi Santoso" style="border-radius: 12px; padding: 12px 15px; border: 1px solid #dee5f2; font-size: 14px; background: #fcfdfe;">
                        </div>

                        <!-- WhatsApp & Jumlah (Satu Baris) -->
                        <div class="col-md-7">
                            <label class="form-label" style="font-size: 11px; font-weight: 800; color: #7C8192; text-transform: uppercase; letter-spacing: 0.5px;">No. WhatsApp *</label>
                            <input type="tel" class="form-control shadow-none" name="phone" required placeholder="08xxxxxxxxxx" style="border-radius: 12px; padding: 12px 15px; border: 1px solid #dee5f2; font-size: 14px; background: #fcfdfe;">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label" style="font-size: 11px; font-weight: 800; color: #7C8192; text-transform: uppercase; letter-spacing: 0.5px;">Jumlah *</label>
                            <input type="number" class="form-control shadow-none" name="quantity" required placeholder="Pcs" min="1" style="border-radius: 12px; padding: 12px 15px; border: 1px solid #dee5f2; font-size: 14px; background: #fcfdfe;">
                        </div>

                        <!-- Spesifikasi / Catatan -->
                        <div class="col-md-12">
                            <label class="form-label" style="font-size: 11px; font-weight: 800; color: #7C8192; text-transform: uppercase; letter-spacing: 0.5px;">Pesan / Spesifikasi Khusus</label>
                            <textarea class="form-control shadow-none" name="specs" rows="3" placeholder="Contoh: Ukuran kustom, material khusus, atau catatan lainnya..." style="border-radius: 12px; padding: 12px 15px; border: 1px solid #dee5f2; font-size: 14px; background: #fcfdfe; resize: none;"></textarea>
                        </div>
                    </div>
                </form>

                <!-- Footer Info -->
                <div style="margin-top: 20px; display: flex; align-items: start; gap: 10px;">
                    <i class="fa-solid fa-circle-info" style="color: #1E3A8A; font-size: 14px; margin-top: 2px;"></i>
                    <p style="font-size: 12px; color: #7C8192; margin: 0; line-height: 1.4;">Data akan diteruskan langsung ke tim admin kami untuk proses perhitungan harga terbaik.</p>
                </div>
            </div>

            <!-- Footer Modal -->
            <div class="modal-footer" style="border-top: 1px solid #f1f1f1; padding: 20px 30px; background: #fff;">
                <button type="button" class="btn" data-bs-dismiss="modal" style="font-size: 14px; font-weight: 700; color: #7C8192; text-decoration: none;">Batal</button>
                <button type="button" id="submitProductQuote" style="background: #25D366; color: white; border-radius: 50px; padding: 12px 30px; font-weight: 700; border: none; font-size: 14px; display: flex; align-items: center; gap: 8px; box-shadow: 0 8px 20px rgba(37, 211, 102, 0.2); transition: 0.3s;">
                    <i class="fa-brands fa-whatsapp" style="font-size: 18px;"></i> Kirim via WhatsApp
                </button>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
(function() {
    'use strict';
    
    document.addEventListener('click', function(e) {
        if (e.target && e.target.id === 'submitProductQuote') {
            const form = document.getElementById('productQuoteForm');
            
            // Validasi Dasar
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            
            const formData = new FormData(form);
            const data = Object.fromEntries(formData);
            
            // Format Pesan WhatsApp
            let waMessage = `*HALO PT. BORNEO IBAN JAYA PERKASA*\n`;
            waMessage += `Saya ingin meminta penawaran khusus untuk produk:\n\n`;
            waMessage += `*Produk:* ${data.product_name}\n`;
            waMessage += `*Nama:* ${data.name}\n`;
            waMessage += `*WhatsApp:* ${data.phone}\n`;
            waMessage += `*Jumlah:* ${data.quantity} Pcs\n`;
            
            if (data.specs) {
                waMessage += `*Spesifikasi/Catatan:* ${data.specs}\n`;
            }
            
            waMessage += `\n*Link Produk:* ${window.location.href}`;
            
            // Ambil Nomor WhatsApp Sales dari Setting
            const rawPhone = '{{ \App\Models\Setting::get("contact_phone", "081259896884") }}';
            const cleanPhone = rawPhone.replace(/\D/g, ''); // Hanya ambil angka
            
            // Redirect
            const finalUrl = `https://wa.me/${cleanPhone}?text=${encodeURIComponent(waMessage)}`;
            window.open(finalUrl, '_blank');
            
            // Tutup Modal
            const modalEl = document.getElementById('productQuoteModal');
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) modalInstance.hide();
            
            // Reset Form
            form.reset();
        }
    });
})();
</script>
@endpush

@endsection
