@extends('layouts.app')

@section('title', 'Edit Home Section: ' . ucwords(str_replace('_', ' ', $section->key)))

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <!-- Banner Slider Section -->
            @if($section->key == 'banner_slider')
            <div class="card ag-card mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="card-title mb-2">Banner / Hero Slider Management</h5>
                            <p class="text-muted mb-0">Kelola slide banner utama. Klik "Add Slide" untuk menambah slide baru.</p>
                        </div>
                        <button type="button" class="btn btn-primary" id="addSlideBtn">
                            <i class="mdi mdi-plus me-1"></i> Add Slide
                        </button>
                    </div>
                    
                    <form action="{{ route('admin.home-content.update', $section->key) }}" method="POST" enctype="multipart/form-data" id="bannerSliderForm">
                        @csrf
                        @method('PUT')
                        
                        <div id="slidesContainer">
                            @php
                                $sliderData = $section->extra_data['slides'] ?? [];
                                if (empty($sliderData)) {
                                    // Default slides dari homepage
                                    $sliderData = [
                                        [
                                            'background_image' => 'assets/img/barfi/Landscaping/banner/banner-thumb-bg-5.1.png',
                                            'rating' => '5.0',
                                            'rating_text' => '(Terpercaya)',
                                            'title' => 'Jasa Bubut Presisi untuk Kebutuhan Industri Anda',
                                            'description' => 'Layanan bubut berkualitas tinggi dengan teknologi terkini. Kami melayani pembuatan komponen mesin, sparepart industri, dan custom machining sesuai kebutuhan spesifik Anda dengan presisi tinggi dan ketepatan waktu.',
                                            'button1_text' => 'Lihat Layanan Kami',
                                            'button1_link' => '/services',
                                            'button2_text' => 'Request Penawaran',
                                            'button2_type' => 'modal',
                                            'trust_text' => 'Terpercaya dengan pengalaman sejak 2003',
                                            'trust_image' => 'assets/img/barfi/Landscaping/banner/vl-banner-auth5.png'
                                        ],
                                        [
                                            'background_image' => 'assets/img/barfi/Landscaping/banner/banner-thumb-bg-5.2.png',
                                            'rating' => '5.0',
                                            'rating_text' => '(Terpercaya)',
                                            'title' => 'Jasa Stamping & Plong Profesional',
                                            'description' => 'Layanan stamping dan plong dengan mesin modern untuk berbagai kebutuhan industri. Kami melayani potong, plong, tekuk, dan tiruskan pipa sesuai spesifikasi Anda dengan hasil yang rapi dan presisi.',
                                            'button1_text' => 'Lihat Layanan Kami',
                                            'button1_link' => '/services',
                                            'button2_text' => 'Request Penawaran',
                                            'button2_type' => 'modal',
                                            'trust_text' => 'Terpercaya dengan pengalaman sejak 2003',
                                            'trust_image' => 'assets/img/barfi/Landscaping/banner/vl-banner-auth5.png'
                                        ],
                                        [
                                            'background_image' => 'assets/img/barfi/Landscaping/banner/banner-thumb-bg-5.3.png',
                                            'rating' => '5.0',
                                            'rating_text' => '(Terpercaya)',
                                            'title' => 'Moulding & Sparepart Industri Berkualitas',
                                            'description' => 'Produksi moulding dan sparepart industri dengan standar kualitas tinggi. Kami menyediakan aksesori dan suku cadang untuk kebutuhan industri dan otomotif dengan jaminan kualitas dan ketepatan waktu pengiriman.',
                                            'button1_text' => 'Lihat Produk Kami',
                                            'button1_link' => '/products',
                                            'button2_text' => 'Request Penawaran',
                                            'button2_type' => 'modal',
                                            'trust_text' => 'Terpercaya dengan pengalaman sejak 2003',
                                            'trust_image' => 'assets/img/barfi/Landscaping/banner/vl-banner-auth5.png'
                                        ],
                                        [
                                            'background_image' => 'assets/img/barfi/Landscaping/banner/banner-thumb-bg-5.3.png',
                                            'rating' => '5.0',
                                            'rating_text' => '(Terpercaya)',
                                            'title' => 'Solusi Lengkap untuk Kebutuhan Industri Anda',
                                            'description' => 'Dari jasa bubut, stamping, moulding hingga sparepart berkualitas tinggi. Kami melayani kontraktor industri, perdagangan, dan jasa dengan komitmen kualitas, ketepatan waktu, dan pelayanan terbaik.',
                                            'button1_text' => 'Pelajari Lebih Lanjut',
                                            'button1_link' => '/about',
                                            'button2_text' => 'Request Penawaran',
                                            'button2_type' => 'modal',
                                            'trust_text' => 'Terpercaya dengan pengalaman sejak 2003',
                                            'trust_image' => 'assets/img/barfi/Landscaping/banner/vl-banner-auth5.png'
                                        ]
                                    ];
                                }
                            @endphp
                            
                            @foreach($sliderData as $index => $slide)
                            <div class="card ag-glass border mb-3 slide-item" data-slide-index="{{ $index }}">
                                <div class="card-header bg-transparent border-bottom d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 text-white">Slide {{ $index + 1 }}</h6>
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-slide">
                                        <i class="mdi mdi-delete"></i> Remove
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label text-white">Background Image</label>
                                            <input type="file" name="slides[{{ $index }}][background_image]" class="form-control slide-bg-image" accept="image/*">
                                            @if(!empty($slide['background_image']))
                                            <div class="mt-2 slide-image-preview">
                                                <img src="{{ asset($slide['background_image']) }}" class="img-thumbnail" style="max-width: 200px;">
                                                <input type="hidden" name="slides[{{ $index }}][background_image_existing]" value="{{ $slide['background_image'] }}" class="slide-bg-existing">
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label text-white">Rating</label>
                                            <input type="text" name="slides[{{ $index }}][rating]" value="{{ $slide['rating'] ?? '5.0' }}" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label text-white">Rating Text</label>
                                            <input type="text" name="slides[{{ $index }}][rating_text]" value="{{ $slide['rating_text'] ?? '(Terpercaya)' }}" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-white">Trust Badge Text</label>
                                            <input type="text" name="slides[{{ $index }}][trust_text]" value="{{ $slide['trust_text'] ?? '' }}" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-white">Trust Badge Image</label>
                                            <input type="file" name="slides[{{ $index }}][trust_image]" class="form-control slide-trust-image" accept="image/*">
                                            @if(!empty($slide['trust_image']))
                                            <div class="mt-2 slide-trust-preview">
                                                <img src="{{ asset($slide['trust_image']) }}" class="img-thumbnail" style="max-width: 150px;">
                                                <input type="hidden" name="slides[{{ $index }}][trust_image_existing]" value="{{ $slide['trust_image'] }}" class="slide-trust-existing">
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label text-white">Title (H1) <span class="text-danger">*</span></label>
                                            <input type="text" name="slides[{{ $index }}][title]" value="{{ $slide['title'] ?? '' }}" class="form-control" required>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label text-white">Description <span class="text-danger">*</span></label>
                                            <textarea name="slides[{{ $index }}][description]" class="form-control" rows="3" required>{{ $slide['description'] ?? '' }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-white">Button 1 Text</label>
                                            <input type="text" name="slides[{{ $index }}][button1_text]" value="{{ $slide['button1_text'] ?? '' }}" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-white">Button 1 Link</label>
                                            <input type="text" name="slides[{{ $index }}][button1_link]" value="{{ $slide['button1_link'] ?? '' }}" class="form-control" placeholder="/services">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-white">Button 2 Text</label>
                                            <input type="text" name="slides[{{ $index }}][button2_text]" value="{{ $slide['button2_text'] ?? '' }}" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-white">Button 2 Type</label>
                                            <select name="slides[{{ $index }}][button2_type]" class="form-select">
                                                <option value="link" {{ ($slide['button2_type'] ?? 'modal') == 'link' ? 'selected' : '' }}>Link</option>
                                                <option value="modal" {{ ($slide['button2_type'] ?? 'modal') == 'modal' ? 'selected' : '' }}>Modal (Request Quote)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-white">Button 2 Link (jika type = link)</label>
                                            <input type="text" name="slides[{{ $index }}][button2_link]" value="{{ $slide['button2_link'] ?? '' }}" class="form-control" placeholder="/contact">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <label class="form-label text-white">Status</label>
                                    <select name="is_active" class="form-select" style="max-width: 200px;">
                                        <option value="1" {{ ($section->is_active ?? true) ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ !($section->is_active ?? true) ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-content-save me-1"></i> Save Banner Slider
                            </button>
                            <a href="{{ route('admin.home-content.index') }}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Back
                            </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Slide Template -->
            <template id="slideTemplate">
                <div class="card ag-glass border mb-3 slide-item" data-slide-index="">
                    <div class="card-header bg-transparent border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-white slide-number">Slide</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-slide">
                            <i class="mdi mdi-delete"></i> Remove
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label text-white">Background Image</label>
                                <input type="file" name="slides[SLIDE_INDEX][background_image]" class="form-control slide-bg-image" accept="image/*">
                                <div class="mt-2 slide-image-preview"></div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label text-white">Rating</label>
                                <input type="text" name="slides[SLIDE_INDEX][rating]" value="5.0" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label text-white">Rating Text</label>
                                <input type="text" name="slides[SLIDE_INDEX][rating_text]" value="(Terpercaya)" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Trust Badge Text</label>
                                <input type="text" name="slides[SLIDE_INDEX][trust_text]" value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Trust Badge Image</label>
                                <input type="file" name="slides[SLIDE_INDEX][trust_image]" class="form-control slide-trust-image" accept="image/*">
                                <div class="mt-2 slide-trust-preview"></div>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-white">Title (H1) <span class="text-danger">*</span></label>
                                <input type="text" name="slides[SLIDE_INDEX][title]" value="" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-white">Description <span class="text-danger">*</span></label>
                                <textarea name="slides[SLIDE_INDEX][description]" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Button 1 Text</label>
                                <input type="text" name="slides[SLIDE_INDEX][button1_text]" value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Button 1 Link</label>
                                <input type="text" name="slides[SLIDE_INDEX][button1_link]" value="" class="form-control" placeholder="/services">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Button 2 Text</label>
                                <input type="text" name="slides[SLIDE_INDEX][button2_text]" value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Button 2 Type</label>
                                <select name="slides[SLIDE_INDEX][button2_type]" class="form-select">
                                    <option value="link">Link</option>
                                    <option value="modal" selected>Modal (Request Quote)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Button 2 Link (jika type = link)</label>
                                <input type="text" name="slides[SLIDE_INDEX][button2_link]" value="" class="form-control" placeholder="/contact">
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            @endif

            <!-- About Section -->
            @if($section->key == 'about')
            <div class="card ag-card mb-4">
                <div class="card-body p-4">
                    <form action="{{ route('admin.home-content.update', $section->key) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h5 class="card-title mb-4">About Section</h5>
                        
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Subtitle</label>
                                <input type="text" name="title" value="{{ old('title', $section->title ?? 'Tentang Kami') }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Main Heading (H2)</label>
                                <input type="text" name="heading" value="{{ old('heading', $section->heading ?? 'Solusi Terpercaya untuk Kebutuhan Jasa Logam & Produksi Sparepart') }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Description</label>
                                <textarea name="subtitle" class="form-control" rows="4">{{ old('subtitle', $section->subtitle ?? 'PT. Borneo Iban Jaya Perkasa adalah perusahaan yang bergerak di bidang jasa logam, plong, dan produksi aksesori serta suku cadang berkualitas tinggi. Dengan pengalaman sejak 2003, kami melayani kebutuhan industri dan otomotif dengan komitmen terhadap kualitas dan kepuasan pelanggan.') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Image 1</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                @if($section->image)
                                <div class="mt-2">
                                    <img src="{{ asset($section->image) }}" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Image 2</label>
                                <input type="file" name="image_2" class="form-control" accept="image/*">
                                @if($section->image_2)
                                <div class="mt-2">
                                    <img src="{{ asset($section->image_2) }}" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Button Text</label>
                                <input type="text" name="button_text" value="{{ old('button_text', $section->extra_data['button_text'] ?? 'Pelajari Lebih Lanjut') }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Button Link</label>
                                <input type="text" name="button_link" value="{{ old('button_link', $section->extra_data['button_link'] ?? '/about') }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Status</label>
                                <select name="is_active" class="form-select">
                                    <option value="1" {{ ($section->is_active ?? true) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !($section->is_active ?? true) ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Order</label>
                                <input type="number" name="order" value="{{ old('order', $section->order ?? 2) }}" class="form-control">
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-content-save me-1"></i> Save Section
                            </button>
                            <a href="{{ route('admin.home-content.index') }}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <!-- Services Section -->
            @if($section->key == 'services')
            <div class="card ag-card mb-4">
                <div class="card-body p-4">
                    <form action="{{ route('admin.home-content.update', $section->key) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h5 class="card-title mb-4">Services Section</h5>
                        
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Subtitle</label>
                                <input type="text" name="title" value="{{ old('title', $section->title ?? 'Layanan Kami') }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Main Heading (H2)</label>
                                <input type="text" name="heading" value="{{ old('heading', $section->heading ?? 'Layanan Profesional untuk Kebutuhan Industri Anda') }}" class="form-control">
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Pilih Services untuk Ditampilkan</label>
                                <p class="text-muted small mb-3">Pilih services yang ingin ditampilkan di homepage. Urutkan dengan drag & drop.</p>
                                
                                @php
                                    $allServices = \App\Models\Service::orderBy('name')->get();
                                    $selectedServiceIds = $section->extra_data['selected_services'] ?? [];
                                @endphp
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-white small">Available Services</label>
                                        <select id="availableServices" class="form-select" size="8" style="height: 200px;">
                                            @foreach($allServices as $service)
                                                @if(!in_array($service->id, $selectedServiceIds))
                                                    <option value="{{ $service->id }}" data-name="{{ $service->name }}">{{ $service->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-white small">Selected Services (Drag to reorder)</label>
                                        <ul id="selectedServicesList" class="list-group" style="max-height: 200px; overflow-y: auto;">
                                            @foreach($selectedServiceIds as $serviceId)
                                                @php
                                                    $service = \App\Models\Service::find($serviceId);
                                                @endphp
                                                @if($service)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" data-service-id="{{ $service->id }}" style="cursor: move;">
                                                        <span><i class="mdi mdi-drag-vertical me-2"></i>{{ $service->name }}</span>
                                                        <button type="button" class="btn btn-sm btn-danger remove-service" data-service-id="{{ $service->id }}">
                                                            <i class="mdi mdi-close"></i>
                                                        </button>
                                                        <input type="hidden" name="selected_services[]" value="{{ $service->id }}">
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="d-flex gap-2 mb-3">
                                    <button type="button" class="btn btn-sm btn-primary" id="addServiceBtn">
                                        <i class="mdi mdi-arrow-right me-1"></i> Add Selected
                                    </button>
                                    <button type="button" class="btn btn-sm btn-secondary" id="addAllServicesBtn">
                                        <i class="mdi mdi-arrow-right-bold me-1"></i> Add All
                                    </button>
                                </div>
                                
                                <div class="alert alert-info">
                                    <i class="mdi mdi-information me-2"></i>
                                    <small>Services dikelola di menu <a href="{{ route('admin.services.index') }}" target="_blank" class="text-white"><strong>Services</strong></a>. Pilih services yang ingin ditampilkan di homepage dan atur urutannya dengan drag & drop.</small>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Status</label>
                                <select name="is_active" class="form-select">
                                    <option value="1" {{ ($section->is_active ?? true) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !($section->is_active ?? true) ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Order</label>
                                <input type="number" name="order" value="{{ old('order', $section->order ?? 3) }}" class="form-control">
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-content-save me-1"></i> Save Section
                            </button>
                            <a href="{{ route('admin.home-content.index') }}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <!-- Products Section -->
            @if($section->key == 'products')
            <div class="card ag-card mb-4">
                <div class="card-body p-4">
                    <form action="{{ route('admin.home-content.update', $section->key) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h5 class="card-title mb-4">Products Section</h5>
                        
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Subtitle</label>
                                <input type="text" name="title" value="{{ old('title', $section->title ?? 'Produk Kami') }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Main Heading (H2)</label>
                                <input type="text" name="heading" value="{{ old('heading', $section->heading ?? 'Produk Berkualitas untuk Kebutuhan Anda') }}" class="form-control">
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Filter by Category (Optional)</label>
                                <select id="productCategoryFilter" class="form-select">
                                    <option value="">-- Semua Kategori --</option>
                                    @php
                                        $categories = \App\Models\ProductCategory::where('is_active', true)->orderBy('order')->orderBy('name')->get();
                                    @endphp
                                    @foreach($categories as $category)
                                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Filter produk berdasarkan kategori untuk memudahkan pemilihan</small>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Pilih Products untuk Ditampilkan</label>
                                <p class="text-muted small mb-3">Pilih products yang ingin ditampilkan di homepage. Urutkan dengan drag & drop.</p>
                                
                                @php
                                    $allProducts = \App\Models\Product::with('productCategory')->orderBy('name')->get();
                                    $selectedProductIds = $section->extra_data['selected_products'] ?? [];
                                @endphp
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-white small">Available Products</label>
                                        <select id="availableProducts" class="form-select" size="8" style="height: 200px;">
                                            @foreach($allProducts as $product)
                                                @if(!in_array($product->id, $selectedProductIds))
                                                    <option value="{{ $product->id }}" 
                                                            data-name="{{ $product->name }}" 
                                                            data-category="{{ $product->category ?? '' }}">
                                                        {{ $product->name }} 
                                                        @if($product->productCategory)
                                                            <small>({{ $product->productCategory->name }})</small>
                                                        @endif
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-white small">Selected Products (Drag to reorder)</label>
                                        <ul id="selectedProductsList" class="list-group" style="max-height: 200px; overflow-y: auto;">
                                            @foreach($selectedProductIds as $productId)
                                                @php
                                                    $product = \App\Models\Product::with('productCategory')->find($productId);
                                                @endphp
                                                @if($product)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" data-product-id="{{ $product->id }}" style="cursor: move;">
                                                        <span>
                                                            <i class="mdi mdi-drag-vertical me-2"></i>
                                                            {{ $product->name }}
                                                            @if($product->productCategory)
                                                                <small class="text-muted">({{ $product->productCategory->name }})</small>
                                                            @endif
                                                        </span>
                                                        <button type="button" class="btn btn-sm btn-danger remove-product" data-product-id="{{ $product->id }}">
                                                            <i class="mdi mdi-close"></i>
                                                        </button>
                                                        <input type="hidden" name="selected_products[]" value="{{ $product->id }}">
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="d-flex gap-2 mb-3">
                                    <button type="button" class="btn btn-sm btn-primary" id="addProductBtn">
                                        <i class="mdi mdi-arrow-right me-1"></i> Add Selected
                                    </button>
                                    <button type="button" class="btn btn-sm btn-secondary" id="addAllProductsBtn">
                                        <i class="mdi mdi-arrow-right-bold me-1"></i> Add All (Filtered)
                                    </button>
                                </div>
                                
                                <div class="alert alert-info">
                                    <i class="mdi mdi-information me-2"></i>
                                    <small>Products dikelola di menu <a href="{{ route('admin.products.index') }}" target="_blank" class="text-white"><strong>Products</strong></a>. Pilih products yang ingin ditampilkan di homepage dan atur urutannya dengan drag & drop. Anda bisa filter berdasarkan kategori untuk memudahkan pemilihan.</small>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Status</label>
                                <select name="is_active" class="form-select">
                                    <option value="1" {{ ($section->is_active ?? true) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !($section->is_active ?? true) ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Order</label>
                                <input type="number" name="order" value="{{ old('order', $section->order ?? 4) }}" class="form-control">
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-content-save me-1"></i> Save Section
                            </button>
                            <a href="{{ route('admin.home-content.index') }}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <!-- Projects Section -->
            @if($section->key == 'projects')
            <div class="card ag-card mb-4">
                <div class="card-body p-4">
                    <form action="{{ route('admin.home-content.update', $section->key) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h5 class="card-title mb-4">Projects Section</h5>
                        
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Subtitle</label>
                                <input type="text" name="title" value="{{ old('title', $section->title ?? '') }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Main Heading (H2)</label>
                                <input type="text" name="heading" value="{{ old('heading', $section->heading ?? '') }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Status</label>
                                <select name="is_active" class="form-select">
                                    <option value="1" {{ ($section->is_active ?? true) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !($section->is_active ?? true) ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Order</label>
                                <input type="number" name="order" value="{{ old('order', $section->order ?? 5) }}" class="form-control">
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-content-save me-1"></i> Save Section
                            </button>
                            <a href="{{ route('admin.home-content.index') }}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <!-- Work Process Section -->
            @if($section->key == 'work_process')
            <div class="card ag-card mb-4">
                <div class="card-body p-4">
                    <form action="{{ route('admin.home-content.update', $section->key) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h5 class="card-title mb-4">Work Process Section</h5>
                        
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Subtitle</label>
                                <input type="text" name="title" value="{{ old('title', $section->title ?? 'Cara Kami Bekerja') }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Main Heading (H2)</label>
                                <input type="text" name="heading" value="{{ old('heading', $section->heading ?? 'Proses Produksi yang Terpercaya, Langkah demi Langkah') }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Tag Cloud (pisahkan dengan koma)</label>
                                <input type="text" name="tag_cloud" value="{{ old('tag_cloud', $section->extra_data['tag_cloud'] ?? 'Bubut, Stamping, Moulding, Sparepart, Presisi, Kualitas, Industri, Otomotif, Logam, Plong, Tekuk, Potong, Bracket, Pedal Rem, Aksesori') }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Status</label>
                                <select name="is_active" class="form-select">
                                    <option value="1" {{ ($section->is_active ?? true) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !($section->is_active ?? true) ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Order</label>
                                <input type="number" name="order" value="{{ old('order', $section->order ?? 6) }}" class="form-control">
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-content-save me-1"></i> Save Section
                            </button>
                            <a href="{{ route('admin.home-content.index') }}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <!-- Why Choose Us Section -->
            @if($section->key == 'why_choose_us')
            <div class="card ag-card mb-4">
                <div class="card-body p-4">
                    <form action="{{ route('admin.home-content.update', $section->key) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h5 class="card-title mb-4">Why Choose Us Section</h5>
                        
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Subtitle</label>
                                <input type="text" name="title" value="{{ old('title', $section->title ?? 'Mengapa Pilih Kami') }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Main Heading (H2)</label>
                                <input type="text" name="heading" value="{{ old('heading', $section->heading ?? 'Kualitas & Kepercayaan, Setiap Proyek, Setiap Detail') }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Description</label>
                                <textarea name="subtitle" class="form-control" rows="3">{{ old('subtitle', $section->subtitle ?? 'Memilih PT. Borneo Iban Jaya Perkasa berarti memilih tim yang peduli dengan kebutuhan industri Anda. Kami menggabungkan pengalaman, presisi, dan keandalan untuk memberikan produk dan jasa berkualitas tinggi yang memenuhi standar industri.') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Main Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                @if($section->image)
                                <div class="mt-2">
                                    <img src="{{ asset($section->image) }}" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">WhatsApp Contact Box Image</label>
                                <input type="file" name="image_2" class="form-control" accept="image/*">
                                @if($section->image_2)
                                <div class="mt-2">
                                    <img src="{{ asset($section->image_2) }}" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Status</label>
                                <select name="is_active" class="form-select">
                                    <option value="1" {{ ($section->is_active ?? true) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !($section->is_active ?? true) ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Order</label>
                                <input type="number" name="order" value="{{ old('order', $section->order ?? 7) }}" class="form-control">
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-content-save me-1"></i> Save Section
                            </button>
                            <a href="{{ route('admin.home-content.index') }}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <!-- Testimonials Section -->
            @if($section->key == 'testimonials')
            <div class="card ag-card mb-4">
                <div class="card-body p-4">
                    <form action="{{ route('admin.home-content.update', $section->key) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h5 class="card-title mb-4">Testimonials Section</h5>
                        
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Subtitle</label>
                                <input type="text" name="title" value="{{ old('title', $section->title ?? 'Testimoni') }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Main Heading (H2)</label>
                                <input type="text" name="heading" value="{{ old('heading', $section->heading ?? 'Apa Kata Klien Kami') }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Status</label>
                                <select name="is_active" class="form-select">
                                    <option value="1" {{ ($section->is_active ?? true) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !($section->is_active ?? true) ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Order</label>
                                <input type="number" name="order" value="{{ old('order', $section->order ?? 8) }}" class="form-control">
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-content-save me-1"></i> Save Section
                            </button>
                            <a href="{{ route('admin.home-content.index') }}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <!-- Blog Section -->
            @if($section->key == 'blog')
            <div class="card ag-card mb-4">
                <div class="card-body p-4">
                    <form action="{{ route('admin.home-content.update', $section->key) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h5 class="card-title mb-4">Blog Section</h5>
                        
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Subtitle</label>
                                <input type="text" name="title" value="{{ old('title', $section->title ?? 'Blog Kami') }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Main Heading (H2)</label>
                                <input type="text" name="heading" value="{{ old('heading', $section->heading ?? 'Tips, Informasi & Update Terbaru dari Industri') }}" class="form-control">
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-bold text-white">Pilih Blog Posts untuk Ditampilkan</label>
                                <p class="text-muted small mb-3">Pilih blog posts yang ingin ditampilkan di homepage. Urutkan dengan drag & drop.</p>
                                
                                @php
                                    $allBlogs = \App\Models\Blog::where('status', 'published')->orderBy('created_at', 'desc')->get();
                                    $selectedBlogIds = $section->extra_data['selected_blogs'] ?? [];
                                @endphp
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-white small">Available Blog Posts</label>
                                        <select id="availableBlogs" class="form-select" size="8" style="height: 200px;">
                                            @foreach($allBlogs as $blog)
                                                @if(!in_array($blog->id, $selectedBlogIds))
                                                    <option value="{{ $blog->id }}" data-name="{{ $blog->title }}">{{ $blog->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-white small">Selected Blog Posts (Drag to reorder)</label>
                                        <ul id="selectedBlogsList" class="list-group" style="max-height: 200px; overflow-y: auto;">
                                            @foreach($selectedBlogIds as $blogId)
                                                @php
                                                    $blog = \App\Models\Blog::find($blogId);
                                                @endphp
                                                @if($blog)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" data-blog-id="{{ $blog->id }}" style="cursor: move;">
                                                        <span><i class="mdi mdi-drag-vertical me-2"></i>{{ $blog->title }}</span>
                                                        <button type="button" class="btn btn-sm btn-danger remove-blog" data-blog-id="{{ $blog->id }}">
                                                            <i class="mdi mdi-close"></i>
                                                        </button>
                                                        <input type="hidden" name="selected_blogs[]" value="{{ $blog->id }}">
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="d-flex gap-2 mb-3">
                                    <button type="button" class="btn btn-sm btn-primary" id="addBlogBtn">
                                        <i class="mdi mdi-arrow-right me-1"></i> Add Selected
                                    </button>
                                    <button type="button" class="btn btn-sm btn-secondary" id="addAllBlogsBtn">
                                        <i class="mdi mdi-arrow-right-bold me-1"></i> Add All
                                    </button>
                                </div>
                                
                                <div class="alert alert-info">
                                    <i class="mdi mdi-information me-2"></i>
                                    <small>Blog posts dikelola di menu <a href="{{ route('admin.blog.index') }}" target="_blank" class="text-white"><strong>Blog</strong></a>. Pilih blog posts yang ingin ditampilkan di homepage dan atur urutannya dengan drag & drop.</small>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Status</label>
                                <select name="is_active" class="form-select">
                                    <option value="1" {{ ($section->is_active ?? true) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !($section->is_active ?? true) ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Order</label>
                                <input type="number" name="order" value="{{ old('order', $section->order ?? 9) }}" class="form-control">
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-content-save me-1"></i> Save Section
                            </button>
                            <a href="{{ route('admin.home-content.index') }}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <!-- Section Items (Only for sections that need custom items) -->
            @if(in_array($section->key, ['work_process', 'why_choose_us', 'testimonials']))
            <div class="card ag-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title mb-0">Section Items</h5>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addItemModal">
                            <i class="mdi mdi-plus me-1"></i> Add Item
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover ag-table">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $item)
                                    <tr>
                                        <td>{{ $item->order }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td><span class="badge bg-info">{{ $item->type }}</span></td>
                                        <td>
                                            <span class="badge {{ $item->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $item->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-sm btn-outline-warning" 
                                                onclick="editItem({{ json_encode($item) }})">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <form action="{{ route('admin.home-content.item.destroy', [$section->key, $item->id]) }}" 
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Are you sure?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">No items found. Add your first item!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Add Item Modal -->
    @if($section->key != 'banner_slider')
    <div class="modal fade" id="addItemModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ag-glass border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white">Add New Item</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.home-content.item.store', $section->key) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-white">Type</label>
                                <select name="type" class="form-select" required>
                                    <option value="service">Service</option>
                                    <option value="product">Product</option>
                                    <option value="project">Project</option>
                                    <option value="testimonial">Testimonial</option>
                                    <option value="blog">Blog</option>
                                    <option value="work_step">Work Step</option>
                                    <option value="feature">Feature</option>
                                    <option value="item">Item</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Order</label>
                                <input type="number" name="order" class="form-control" 
                                    value="{{ ($items->max('order') ?? 0) + 1 }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-white">Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-white">Description</label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>
                            @if($section->key == 'products')
                            <div class="col-md-6">
                                <label class="form-label text-white">Price</label>
                                <input type="text" name="price" class="form-control" placeholder="Rp 150.000">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Category</label>
                                <select name="category" class="form-select">
                                    <option value="">All Products</option>
                                    <option value="automotive">Komponen Otomotif</option>
                                    <option value="bracket">Bracket & Mounting</option>
                                    <option value="sparepart">Suku Cadang</option>
                                    <option value="accessory">Aksesori</option>
                                </select>
                            </div>
                            @endif
                            @if($section->key == 'testimonials')
                            <div class="col-md-6">
                                <label class="form-label text-white">Author Name</label>
                                <input type="text" name="author_name" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Author Position</label>
                                <input type="text" name="author_position" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Rating (1-5)</label>
                                <input type="number" name="rating" class="form-control" min="1" max="5" value="5">
                            </div>
                            @endif
                            @if($section->key == 'work_process')
                            <div class="col-md-6">
                                <label class="form-label text-white">Step Number</label>
                                <input type="number" name="step_number" class="form-control" min="1" max="4">
                            </div>
                            @endif
                            @if($section->key == 'projects')
                            <div class="col-md-6">
                                <label class="form-label text-white">Category</label>
                                <input type="text" name="category" class="form-control" placeholder="e.g., Jasa Bubut">
                            </div>
                            @endif
                            <div class="col-12">
                                <label class="form-label text-white">Content (Rich Text)</label>
                                <textarea name="content" class="form-control summernote" rows="5"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                <p class="text-white small mt-2 mb-0">Rekomendasi ukuran: 270px × 320px atau sesuai rasio</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Icon (URL or class)</label>
                                <input type="text" name="icon" class="form-control" placeholder="e.g., assets/img/barfi/icon/vl-service-icon-5.1.svg">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Link</label>
                                <input type="text" name="link" class="form-control" placeholder="URL">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Link Text</label>
                                <input type="text" name="link_text" class="form-control" placeholder="e.g., Selengkapnya">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Status</label>
                                <select name="is_active" class="form-select">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Edit Item Modal -->
    @if($section->key != 'banner_slider')
    <div class="modal fade" id="editItemModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ag-glass border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white">Edit Item</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="editItemForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-white">Type</label>
                                <select name="type" id="edit_type" class="form-select" required>
                                    <option value="service">Service</option>
                                    <option value="product">Product</option>
                                    <option value="project">Project</option>
                                    <option value="testimonial">Testimonial</option>
                                    <option value="blog">Blog</option>
                                    <option value="work_step">Work Step</option>
                                    <option value="feature">Feature</option>
                                    <option value="item">Item</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Order</label>
                                <input type="number" name="order" id="edit_order" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-white">Title</label>
                                <input type="text" name="title" id="edit_title" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-white">Description</label>
                                <textarea name="description" id="edit_description" class="form-control" rows="3"></textarea>
                            </div>
                            @if($section->key == 'products')
                            <div class="col-md-6">
                                <label class="form-label text-white">Price</label>
                                <input type="text" name="price" id="edit_price" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Category</label>
                                <select name="category" id="edit_category" class="form-select">
                                    <option value="">All Products</option>
                                    <option value="automotive">Komponen Otomotif</option>
                                    <option value="bracket">Bracket & Mounting</option>
                                    <option value="sparepart">Suku Cadang</option>
                                    <option value="accessory">Aksesori</option>
                                </select>
                            </div>
                            @endif
                            @if($section->key == 'testimonials')
                            <div class="col-md-6">
                                <label class="form-label text-white">Author Name</label>
                                <input type="text" name="author_name" id="edit_author_name" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Author Position</label>
                                <input type="text" name="author_position" id="edit_author_position" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Rating (1-5)</label>
                                <input type="number" name="rating" id="edit_rating" class="form-control" min="1" max="5">
                            </div>
                            @endif
                            @if($section->key == 'work_process')
                            <div class="col-md-6">
                                <label class="form-label text-white">Step Number</label>
                                <input type="number" name="step_number" id="edit_step_number" class="form-control" min="1" max="4">
                            </div>
                            @endif
                            @if($section->key == 'projects')
                            <div class="col-md-6">
                                <label class="form-label text-white">Category</label>
                                <input type="text" name="category" id="edit_category" class="form-control">
                            </div>
                            @endif
                            <div class="col-12">
                                <label class="form-label text-white">Content (Rich Text)</label>
                                <textarea name="content" id="edit_content" class="form-control summernote" rows="5"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                <p class="text-white small mt-2 mb-0">Rekomendasi ukuran: 270px × 320px atau sesuai rasio</p>
                                <div id="edit_image_preview" class="mt-2"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Icon</label>
                                <input type="text" name="icon" id="edit_icon" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Link</label>
                                <input type="text" name="link" id="edit_link" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Link Text</label>
                                <input type="text" name="link_text" id="edit_link_text" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Status</label>
                                <select name="is_active" id="edit_is_active" class="form-select">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    @push('js')
    <script>
        @if($section->key == 'banner_slider')
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('slidesContainer');
            const addBtn = document.getElementById('addSlideBtn');
            const template = document.getElementById('slideTemplate');
            
            @php
                $existingSlides = $section->extra_data['slides'] ?? [];
                if (empty($existingSlides)) {
                    $existingSlides = [
                        ['title' => ''],
                        ['title' => ''],
                        ['title' => ''],
                        ['title' => '']
                    ];
                }
            @endphp
            let slideIndex = {{ count($existingSlides) }};
            
            function updateSlideNumbers() {
                container.querySelectorAll('.slide-item').forEach((item, index) => {
                    const slideNumber = item.querySelector('.slide-number');
                    if (slideNumber) {
                        slideNumber.textContent = 'Slide ' + (index + 1);
                    }
                    item.setAttribute('data-slide-index', index);
                    
                    // Update all input names
                    item.querySelectorAll('input, select, textarea').forEach(input => {
                        const name = input.getAttribute('name');
                        if (name) {
                            const newName = name.replace(/slides\[\d+\]/, 'slides[' + index + ']');
                            input.setAttribute('name', newName);
                        }
                    });
                });
            }
            
            // Handle image preview
            function setupImagePreview(input, previewContainer) {
                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewContainer.innerHTML = '<img src="' + e.target.result + '" class="img-thumbnail" style="max-width: 200px;">';
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
            
            // Add new slide
            addBtn.addEventListener('click', function() {
                const clone = template.content.cloneNode(true);
                const slideItem = clone.querySelector('.slide-item');
                
                // Replace SLIDE_INDEX with actual index
                slideItem.querySelectorAll('input, select, textarea').forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        input.setAttribute('name', name.replace('SLIDE_INDEX', slideIndex));
                    }
                });
                
                slideItem.setAttribute('data-slide-index', slideIndex);
                slideItem.querySelector('.slide-number').textContent = 'Slide ' + (slideIndex + 1);
                
                container.appendChild(clone);
                
                // Setup remove button
                const removeBtn = slideItem.querySelector('.remove-slide');
                removeBtn.addEventListener('click', function() {
                    if (confirm('Are you sure you want to remove this slide?')) {
                        slideItem.remove();
                        updateSlideNumbers();
                    }
                });
                
                // Setup image previews
                const bgInput = slideItem.querySelector('.slide-bg-image');
                const bgPreview = slideItem.querySelector('.slide-image-preview');
                if (bgInput && bgPreview) {
                    setupImagePreview(bgInput, bgPreview);
                }
                
                const trustInput = slideItem.querySelector('.slide-trust-image');
                const trustPreview = slideItem.querySelector('.slide-trust-preview');
                if (trustInput && trustPreview) {
                    setupImagePreview(trustInput, trustPreview);
                }
                
                slideIndex++;
                updateSlideNumbers();
            });
            
            // Setup existing remove buttons
            container.querySelectorAll('.remove-slide').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (confirm('Are you sure you want to remove this slide?')) {
                        this.closest('.slide-item').remove();
                        updateSlideNumbers();
                    }
                });
            });
            
            // Setup image previews for existing slides
            container.querySelectorAll('.slide-item').forEach(item => {
                const bgInput = item.querySelector('.slide-bg-image');
                const bgPreview = item.querySelector('.slide-image-preview');
                if (bgInput && bgPreview) {
                    setupImagePreview(bgInput, bgPreview);
                }
                
                const trustInput = item.querySelector('.slide-trust-image');
                const trustPreview = item.querySelector('.slide-trust-preview');
                if (trustInput && trustPreview) {
                    setupImagePreview(trustInput, trustPreview);
                }
            });
            
            // Form validation before submit
            const form = document.getElementById('bannerSliderForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const slides = container.querySelectorAll('.slide-item');
                    let hasValidSlide = false;
                    
                    slides.forEach(slide => {
                        const title = slide.querySelector('input[name*="[title]"]')?.value.trim();
                        const description = slide.querySelector('textarea[name*="[description]"]')?.value.trim();
                        if (title || description) {
                            hasValidSlide = true;
                        }
                    });
                    
                    if (!hasValidSlide && slides.length > 0) {
                        e.preventDefault();
                        alert('Please fill at least one slide with title or description.');
                        return false;
                    }
                });
            }
        });
        @endif

        // Services, Products, Blog Selection & Drag & Drop
        @if(in_array($section->key, ['services', 'products', 'blog']))
        document.addEventListener('DOMContentLoaded', function() {
            const isServices = '{{ $section->key }}' === 'services';
            const isProducts = '{{ $section->key }}' === 'products';
            const isBlog = '{{ $section->key }}' === 'blog';
            
            const availableSelect = document.getElementById(isServices ? 'availableServices' : (isProducts ? 'availableProducts' : 'availableBlogs'));
            const selectedList = document.getElementById(isServices ? 'selectedServicesList' : (isProducts ? 'selectedProductsList' : 'selectedBlogsList'));
            const addBtn = document.getElementById(isServices ? 'addServiceBtn' : (isProducts ? 'addProductBtn' : 'addBlogBtn'));
            const addAllBtn = document.getElementById(isServices ? 'addAllServicesBtn' : (isProducts ? 'addAllProductsBtn' : 'addAllBlogsBtn'));
            const categoryFilter = document.getElementById('productCategoryFilter');
            
            // Product category filter
            if (isProducts && categoryFilter) {
                categoryFilter.addEventListener('change', function() {
                    const selectedCategory = this.value;
                    Array.from(availableSelect.options).forEach(option => {
                        if (!selectedCategory || option.dataset.category === selectedCategory) {
                            option.style.display = '';
                        } else {
                            option.style.display = 'none';
                        }
                    });
                });
            }
            
            // Add selected item
            if (addBtn) {
                addBtn.addEventListener('click', function() {
                    const selected = availableSelect.selectedOptions[0];
                    if (selected) {
                        addItemToList(selected.value, selected.dataset.name, selected.dataset.category || '');
                        selected.remove();
                    }
                });
            }
            
            // Add all items (filtered for products)
            if (addAllBtn) {
                addAllBtn.addEventListener('click', function() {
                    const filterCategory = isProducts && categoryFilter ? categoryFilter.value : '';
                    Array.from(availableSelect.options).forEach(option => {
                        if (!filterCategory || option.dataset.category === filterCategory) {
                            addItemToList(option.value, option.dataset.name, option.dataset.category || '');
                            option.remove();
                        }
                    });
                });
            }
            
            // Add item to selected list
            function addItemToList(id, name, category) {
                const li = document.createElement('li');
                li.className = 'list-group-item d-flex justify-content-between align-items-center';
                li.setAttribute('data-' + (isServices ? 'service' : (isProducts ? 'product' : 'blog')) + '-id', id);
                li.style.cursor = 'move';
                
                const categoryText = category ? ` <small class="text-muted">(${category})</small>` : '';
                li.innerHTML = `
                    <span><i class="mdi mdi-drag-vertical me-2"></i>${name}${categoryText}</span>
                    <button type="button" class="btn btn-sm btn-danger remove-${isServices ? 'service' : (isProducts ? 'product' : 'blog')}" data-${isServices ? 'service' : (isProducts ? 'product' : 'blog')}-id="${id}">
                        <i class="mdi mdi-close"></i>
                    </button>
                    <input type="hidden" name="selected_${isServices ? 'services' : (isProducts ? 'products' : 'blogs')}[]" value="${id}">
                `;
                
                selectedList.appendChild(li);
                
                // Setup remove button
                const removeBtn = li.querySelector('.remove-' + (isServices ? 'service' : (isProducts ? 'product' : 'blog')));
                removeBtn.addEventListener('click', function() {
                    const itemId = this.dataset[isServices ? 'service' : (isProducts ? 'product' : 'blog') + 'Id'];
                    removeItemFromList(itemId, name, category);
                    li.remove();
                });
            }
            
            // Remove item from selected list
            function removeItemFromList(id, name, category) {
                const option = document.createElement('option');
                option.value = id;
                option.dataset.name = name;
                if (category) {
                    option.dataset.category = category;
                }
                option.textContent = name + (category ? ` (${category})` : '');
                availableSelect.appendChild(option);
            }
            
            // Setup remove buttons for existing items
            selectedList.querySelectorAll('.remove-' + (isServices ? 'service' : (isProducts ? 'product' : 'blog'))).forEach(btn => {
                btn.addEventListener('click', function() {
                    const itemId = this.dataset[isServices ? 'service' : (isProducts ? 'product' : 'blog') + 'Id'];
                    const li = this.closest('li');
                    const name = li.querySelector('span').textContent.replace(/\(.*?\)/g, '').trim();
                    const categoryMatch = li.querySelector('span').textContent.match(/\(([^)]+)\)/);
                    const category = categoryMatch ? categoryMatch[1] : '';
                    
                    removeItemFromList(itemId, name, category);
                    li.remove();
                });
            });
            
            // Drag & Drop using SortableJS (if available) or native HTML5
            if (typeof Sortable !== 'undefined') {
                new Sortable(selectedList, {
                    animation: 150,
                    handle: '.mdi-drag-vertical',
                    onEnd: function(evt) {
                        // Update hidden inputs order
                        selectedList.querySelectorAll('input[type="hidden"]').forEach((input, index) => {
                            // Order is maintained by DOM order
                        });
                    }
                });
            } else {
                // Fallback: Make items draggable
                selectedList.querySelectorAll('li').forEach(li => {
                    li.draggable = true;
                    li.addEventListener('dragstart', function(e) {
                        e.dataTransfer.setData('text/plain', '');
                        this.style.opacity = '0.5';
                    });
                    li.addEventListener('dragend', function() {
                        this.style.opacity = '1';
                    });
                    li.addEventListener('dragover', function(e) {
                        e.preventDefault();
                        const afterElement = getDragAfterElement(selectedList, e.clientY);
                        if (afterElement == null) {
                            selectedList.appendChild(this);
                        } else {
                            selectedList.insertBefore(this, afterElement);
                        }
                    });
                });
            }
        });
        
        function getDragAfterElement(container, y) {
            const draggableElements = [...container.querySelectorAll('li:not(.dragging)')];
            return draggableElements.reduce((closest, child) => {
                const box = child.getBoundingClientRect();
                const offset = y - box.top - box.height / 2;
                if (offset < 0 && offset > closest.offset) {
                    return { offset: offset, element: child };
                } else {
                    return closest;
                }
            }, { offset: Number.NEGATIVE_INFINITY }).element;
        }
        @endif

        @if(in_array($section->key, ['work_process', 'why_choose_us', 'testimonials']))
        function editItem(item) {
            document.getElementById('editItemForm').action = '{{ route("admin.home-content.item.update", [$section->key, ":id"]) }}'.replace(':id', item.id);
            document.getElementById('edit_type').value = item.type || 'item';
            document.getElementById('edit_order').value = item.order || 0;
            document.getElementById('edit_title').value = item.title || '';
            document.getElementById('edit_description').value = item.description || '';
            document.getElementById('edit_icon').value = item.icon || '';
            document.getElementById('edit_link').value = item.link || '';
            document.getElementById('edit_link_text').value = item.link_text || '';
            document.getElementById('edit_is_active').value = item.is_active ? '1' : '0';
            
            @if($section->key == 'products')
            if (item.extra_data && item.extra_data.price) {
                document.getElementById('edit_price').value = item.extra_data.price;
            }
            if (item.extra_data && item.extra_data.category) {
                document.getElementById('edit_category').value = item.extra_data.category;
            }
            @endif
            
            @if($section->key == 'testimonials')
            if (item.extra_data) {
                if (item.extra_data.author_name) {
                    document.getElementById('edit_author_name').value = item.extra_data.author_name;
                }
                if (item.extra_data.author_position) {
                    document.getElementById('edit_author_position').value = item.extra_data.author_position;
                }
                if (item.extra_data.rating) {
                    document.getElementById('edit_rating').value = item.extra_data.rating;
                }
            }
            @endif
            
            @if($section->key == 'work_process')
            if (item.extra_data && item.extra_data.step_number) {
                document.getElementById('edit_step_number').value = item.extra_data.step_number;
            }
            @endif
            
            @if($section->key == 'projects')
            if (item.extra_data && item.extra_data.category) {
                document.getElementById('edit_category').value = item.extra_data.category;
            }
            @endif
            
            // Set content for summernote
            if ($('#edit_content').length) {
                $('#edit_content').summernote('code', item.content || '');
            }
            
            // Show image preview if exists
            const previewDiv = document.getElementById('edit_image_preview');
            if (item.image) {
                previewDiv.innerHTML = `<img src="{{ asset('') }}${item.image}" class="img-thumbnail" style="max-width: 200px;">`;
            } else {
                previewDiv.innerHTML = '';
            }
            
            new bootstrap.Modal(document.getElementById('editItemModal')).show();
        }
        @endif
    </script>
    @endpush
@endsection
