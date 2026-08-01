@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Site Settings</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" id="settings-form">
            @csrf

            <div class="ag-card">
                <div class="card-body">
                    <ul class="nav nav-tabs mb-4" id="settingsTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general"
                                type="button" role="tab">General & Contact</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                                role="tab">Homepage Slider</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo"
                                type="button" role="tab">SEO Settings</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cta-tab" data-bs-toggle="tab" data-bs-target="#cta"
                                type="button" role="tab">CTA & Form</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="footer-tab" data-bs-toggle="tab" data-bs-target="#footer"
                                type="button" role="tab">Footer</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="settingsTabContent">
                        <!-- General & Contact Tab -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="site_name" class="form-label">Site Name</label>
                                    <input type="text" name="site_name" id="site_name" class="form-control"
                                        value="{{ App\Models\Setting::get('site_name') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="contact_phone" class="form-label">Phone</label>
                                    <input type="text" name="contact_phone" id="contact_phone" class="form-control"
                                        value="{{ App\Models\Setting::get('contact_phone') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="contact_email" class="form-label">Email</label>
                                    <input type="email" name="contact_email" id="contact_email" class="form-control"
                                        value="{{ App\Models\Setting::get('contact_email') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="contact_address" class="form-label">Address</label>
                                    <textarea name="contact_address" id="contact_address" class="form-control"
                                        rows="2">{{ App\Models\Setting::get('contact_address') }}</textarea>
                                </div>
                            </div>
                            
                            <hr class="my-4">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="site_logo" class="form-label">Site Logo</label>
                                    <input type="file" name="site_logo" id="site_logo" class="form-control" accept="image/*">
                                    <small class="text-muted">Recommended: PNG with transparent background, max 500KB</small>
                                    @php $currentLogo = App\Models\Setting::get('site_logo'); @endphp
                                    @if($currentLogo)
                                        <div class="mt-2">
                                            <img src="{{ $currentLogo }}" alt="Current Logo" class="img-thumbnail" style="max-height: 100px;">
                                            <p class="small text-muted mt-1">Current Logo</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="site_favicon" class="form-label">Favicon</label>
                                    <input type="file" name="site_favicon" id="site_favicon" class="form-control" accept="image/*">
                                    <small class="text-muted">Recommended: ICO or PNG, 32x32 or 16x16 pixels</small>
                                    @php $currentFavicon = App\Models\Setting::get('site_favicon'); @endphp
                                    @if($currentFavicon)
                                        <div class="mt-2">
                                            <img src="{{ $currentFavicon }}" alt="Current Favicon" class="img-thumbnail" style="max-height: 32px; max-width: 32px;">
                                            <p class="small text-muted mt-1">Current Favicon</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Homepage Slider Tab -->
                        <div class="tab-pane fade" id="home" role="tabpanel">
                            <div class="alert alert-info mb-4">
                                <i class="mdi mdi-information"></i>
                                <strong>Note:</strong> Slider ini digunakan sebagai fallback jika tidak ada banner slider dari Home Content Management. Untuk mengelola banner utama, gunakan menu <strong>Home Content</strong>.
                            </div>
                            <div class="mb-3">
                                <label for="home_slider_images" class="form-label">Upload Slider Images (multiple)</label>
                                <input type="file" name="home_slider_images[]" id="home_slider_images" class="form-control"
                                    multiple accept="image/*">
                                <small class="text-muted">Select multiple images to add to the slider.</small>
                            </div>
                            <div class="row mt-3" id="slider-images-container">
                                @php 
                                    $sliderImages = App\Models\Setting::get('home_slider_images', []);
                                    // Convert old format (string array) to new format (object array)
                                    $sliderSlides = [];
                                    if (is_array($sliderImages) && count($sliderImages) > 0) {
                                        foreach ($sliderImages as $item) {
                                            if (is_string($item)) {
                                                $sliderSlides[] = ['image' => $item, 'badge' => '', 'tagline' => '', 'title' => '', 'subtitle' => '', 'ctas' => []];
                                            } else {
                                                $sliderSlides[] = $item;
                                            }
                                        }
                                    }
                                @endphp
                                @if(is_array($sliderSlides) && count($sliderSlides) > 0)
                                    @foreach($sliderSlides as $index => $slide)
                                        @php
                                            $image = is_string($slide) ? $slide : ($slide['image'] ?? '');
                                            $badge = is_string($slide) ? '' : ($slide['badge'] ?? '');
                                            $tagline = is_string($slide) ? '' : ($slide['tagline'] ?? '');
                                            $title = is_string($slide) ? '' : ($slide['title'] ?? '');
                                            $subtitle = is_string($slide) ? '' : ($slide['subtitle'] ?? ($slide['description'] ?? ''));
                                            $ctas = is_string($slide) ? [] : ($slide['ctas'] ?? []);
                                            if (empty($ctas) && !is_string($slide)) {
                                                // Try to get old format CTA if exists
                                                if (isset($slide['cta_title']) && isset($slide['cta_url'])) {
                                                    $ctas = [['title' => $slide['cta_title'], 'url' => $slide['cta_url']]];
                                                }
                                            }
                                        @endphp
                                        <div class="col-md-6 mb-4 slider-item" data-index="{{ $index }}">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="position-relative mb-3" style="height: 150px;">
                                                        <img src="{{ $image }}" alt="Slider Image" class="img-thumbnail w-100 h-100"
                                                            style="object-fit: cover;">
                                                        <button type="button" 
                                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 delete-slider-image"
                                                            data-image="{{ $image }}"
                                                            style="width: 28px; height: 28px; padding: 0; line-height: 1; border-radius: 50%;"
                                                            title="Delete image">
                                                            <i class="mdi mdi-close" style="font-size: 16px;"></i>
                                                        </button>
                                                    </div>
                                                    <div class="row g-2 mb-2">
                                                        <div class="col-6">
                                                            <label class="form-label small">Badge (opsional)</label>
                                                            <input type="text" 
                                                                class="form-control form-control-sm slider-badge" 
                                                                value="{{ old('badge', $badge) }}"
                                                                placeholder="e.g., New!, Terbaru">
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="form-label small">Tagline (opsional)</label>
                                                            <input type="text" 
                                                                class="form-control form-control-sm slider-tagline" 
                                                                value="{{ old('tagline', $tagline) }}"
                                                                placeholder="e.g., PT. Borneo Iban Jaya Perkasa">
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label small">Title</label>
                                                        <input type="text" 
                                                            class="form-control form-control-sm slider-title" 
                                                            value="{{ old('title', $title) }}"
                                                            placeholder="Enter slide title">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label small">Subtitle</label>
                                                        <textarea class="form-control form-control-sm slider-subtitle" 
                                                            rows="2"
                                                            placeholder="Enter slide subtitle/description">{{ old('subtitle', $subtitle) }}</textarea>
                                                    </div>
                                                    <div class="mb-2">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <label class="form-label small mb-0">Call To Action (CTAs)</label>
                                                            <button type="button" class="btn btn-sm btn-outline-primary add-cta" data-slide-index="{{ $index }}">
                                                                <i class="mdi mdi-plus"></i> Add CTA
                                                            </button>
                                                        </div>
                                                        <div class="ctas-container" data-slide-index="{{ $index }}">
                                                            @if(is_array($ctas) && count($ctas) > 0)
                                                                @foreach($ctas as $ctaIndex => $cta)
                                                                    <div class="cta-item mb-2 p-2 border rounded">
                                                                        <div class="row g-2">
                                                                            <div class="col-5">
                                                                                <input type="text" 
                                                                                    class="form-control form-control-sm cta-title" 
                                                                                    value="{{ $cta['title'] ?? '' }}"
                                                                                    placeholder="Button text">
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <input type="text" 
                                                                                    class="form-control form-control-sm cta-url" 
                                                                                    value="{{ $cta['url'] ?? '' }}"
                                                                                    placeholder="URL (e.g., /contact)">
                                                                            </div>
                                                                            <div class="col-1">
                                                                                <button type="button" class="btn btn-sm btn-danger remove-cta w-100">
                                                                                    <i class="mdi mdi-close"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <input type="hidden" class="slider-image" value="{{ $image }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-muted">No slider images uploaded yet.</p>
                                @endif
                            </div>
                        </div>

                        <!-- SEO Settings Tab -->
                        <div class="tab-pane fade" id="seo" role="tabpanel">
                            <div class="mb-3">
                                <label for="seo_meta_title" class="form-label">Meta Title</label>
                                <input type="text" name="seo_meta_title" id="seo_meta_title" class="form-control"
                                    value="{{ App\Models\Setting::get('seo_meta_title') }}"
                                    placeholder="Default page title (max 60 characters)">
                                <small class="text-muted">This will be used as the default title for pages. Leave empty to use site name.</small>
                            </div>
                            <div class="mb-3">
                                <label for="seo_meta_description" class="form-label">Meta Description</label>
                                <textarea name="seo_meta_description" id="seo_meta_description" class="form-control"
                                    rows="3"
                                    placeholder="Default meta description (max 160 characters)">{{ App\Models\Setting::get('seo_meta_description') }}</textarea>
                                <small class="text-muted">This will be used as the default description for pages.</small>
                            </div>
                            <div class="mb-3">
                                <label for="seo_meta_keywords" class="form-label">Meta Keywords</label>
                                <input type="text" name="seo_meta_keywords" id="seo_meta_keywords" class="form-control"
                                    value="{{ App\Models\Setting::get('seo_meta_keywords') }}"
                                    placeholder="keyword1, keyword2, keyword3">
                                <small class="text-muted">Comma-separated keywords for SEO.</small>
                            </div>
                            <div class="mb-3">
                                <label for="seo_og_image" class="form-label">Open Graph Image</label>
                                <input type="file" name="seo_og_image" id="seo_og_image" class="form-control" accept="image/*">
                                <small class="text-muted">Recommended: 1200x630 pixels, PNG or JPG. Used when sharing on social media.</small>
                                @php $currentOgImage = App\Models\Setting::get('seo_og_image'); @endphp
                                @if($currentOgImage)
                                    <div class="mt-2">
                                        <img src="{{ $currentOgImage }}" alt="Current OG Image" class="img-thumbnail" style="max-height: 200px;">
                                        <p class="small text-muted mt-1">Current OG Image</p>
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="seo_google_analytics" class="form-label">Google Analytics ID</label>
                                <input type="text" name="seo_google_analytics" id="seo_google_analytics" class="form-control"
                                    value="{{ App\Models\Setting::get('seo_google_analytics') }}"
                                    placeholder="G-XXXXXXXXXX or UA-XXXXXXXXX-X">
                                <small class="text-muted">Enter your Google Analytics tracking ID.</small>
                            </div>
                            <div class="mb-3">
                                <label for="seo_google_site_verification" class="form-label">Google Site Verification</label>
                                <input type="text" name="seo_google_site_verification" id="seo_google_site_verification" class="form-control"
                                    value="{{ App\Models\Setting::get('seo_google_site_verification') }}"
                                    placeholder="Verification code from Google Search Console">
                                <small class="text-muted">Enter your Google Search Console verification code.</small>
                            </div>

                            <hr class="my-4">

                            <h5 class="mb-3">Search Engine Indexing</h5>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="seo_noindex" id="seo_noindex" 
                                        value="1" {{ App\Models\Setting::get('seo_noindex', false) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="seo_noindex">
                                        <strong>No Index (Prevent search engines from indexing this site)</strong>
                                    </label>
                                </div>
                                <small class="text-muted">When enabled, adds &lt;meta name="robots" content="noindex"&gt; to all pages.</small>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="seo_nofollow" id="seo_nofollow" 
                                        value="1" {{ App\Models\Setting::get('seo_nofollow', false) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="seo_nofollow">
                                        <strong>No Follow (Prevent search engines from following links)</strong>
                                    </label>
                                </div>
                                <small class="text-muted">When enabled, adds "nofollow" to robots meta tag.</small>
                            </div>

                            <hr class="my-4">

                            <h5 class="mb-3">Custom HTML in Head</h5>
                            <div class="mb-3">
                                <label for="seo_custom_head_html" class="form-label">Custom HTML Code</label>
                                <textarea name="seo_custom_head_html" id="seo_custom_head_html" class="form-control" 
                                    rows="8" 
                                    placeholder="<!-- Custom meta tags, scripts, or other HTML code -->&#10;&lt;meta name=&quot;example&quot; content=&quot;value&quot;&gt;&#10;&lt;link rel=&quot;canonical&quot; href=&quot;...&quot;&gt;">{{ App\Models\Setting::get('seo_custom_head_html', '') }}</textarea>
                                <small class="text-muted">
                                    Add custom HTML code that will be inserted in the &lt;head&gt; section of all pages. 
                                    Useful for additional meta tags, canonical links, or custom scripts.
                                </small>
                            </div>
                        </div>

                        <!-- CTA & Form Tab -->
                        <div class="tab-pane fade" id="cta" role="tabpanel">
                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="cta_enabled" id="cta_enabled" 
                                        value="1" {{ App\Models\Setting::get('cta_enabled', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cta_enabled">
                                        <strong>Enable CTA Section</strong>
                                    </label>
                                </div>
                                <small class="text-muted">Show/hide the CTA section on homepage</small>
                            </div>

                            <hr class="my-4">

                            <h5 class="mb-3">CTA Section Settings</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cta_title" class="form-label">CTA Title</label>
                                    <input type="text" name="cta_title" id="cta_title" class="form-control"
                                        value="{{ App\Models\Setting::get('cta_title', 'Butuh Penawaran?') }}"
                                        placeholder="Butuh Penawaran?">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cta_button_text" class="form-label">Button Text</label>
                                    <input type="text" name="cta_button_text" id="cta_button_text" class="form-control"
                                        value="{{ App\Models\Setting::get('cta_button_text', 'Request Penawaran') }}"
                                        placeholder="Request Penawaran">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="cta_subtitle" class="form-label">CTA Subtitle</label>
                                    <textarea name="cta_subtitle" id="cta_subtitle" class="form-control" rows="2"
                                        placeholder="Dapatkan harga terbaik dengan mengisi form di bawah ini">{{ App\Models\Setting::get('cta_subtitle', 'Dapatkan harga terbaik dengan mengisi form di bawah ini') }}</textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="cta_background_image" class="form-label">CTA Background Image</label>
                                    <input type="file" name="cta_background_image" id="cta_background_image" class="form-control" accept="image/*">
                                    <small class="text-muted">Recommended: 1920x600 pixels, JPG or PNG. Background image untuk CTA section.</small>
                                    @php $currentCtaBg = App\Models\Setting::get('cta_background_image'); @endphp
                                    @if($currentCtaBg)
                                        <div class="mt-2">
                                            <img src="{{ asset($currentCtaBg) }}" alt="Current CTA Background" class="img-thumbnail" style="max-height: 200px; max-width: 100%;">
                                            <p class="small text-muted mt-1">Current Background Image</p>
                                        </div>
                                    @else
                                        <div class="mt-2">
                                            <img src="{{ asset('assets/img/barfi/Landscaping/cta/vl-cta-bg-5.1.png') }}" alt="Default CTA Background" class="img-thumbnail" style="max-height: 200px; max-width: 100%; opacity: 0.5;">
                                            <p class="small text-muted mt-1">Default Background Image (akan digunakan jika tidak ada upload)</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <hr class="my-4">

                            <h5 class="mb-3">Modal Settings</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cta_modal_title" class="form-label">Modal Title</label>
                                    <input type="text" name="cta_modal_title" id="cta_modal_title" class="form-control"
                                        value="{{ App\Models\Setting::get('cta_modal_title', 'Request Penawaran') }}"
                                        placeholder="Request Penawaran">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cta_modal_subtitle" class="form-label">Modal Subtitle</label>
                                    <input type="text" name="cta_modal_subtitle" id="cta_modal_subtitle" class="form-control"
                                        value="{{ App\Models\Setting::get('cta_modal_subtitle', 'Isi form untuk mendapatkan harga terbaik.') }}"
                                        placeholder="Isi form untuk mendapatkan harga terbaik.">
                                </div>
                            </div>

                            <hr class="my-4">

                            <h5 class="mb-3">WhatsApp Settings</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cta_whatsapp_number" class="form-label">WhatsApp Number</label>
                                    <input type="text" name="cta_whatsapp_number" id="cta_whatsapp_number" class="form-control"
                                        value="{{ App\Models\Setting::get('cta_whatsapp_number', '') }}"
                                        placeholder="6281234567890 (without + or spaces)">
                                    <small class="text-muted">Format: Country code + number (e.g., 6281234567890)</small>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="cta_whatsapp_message" class="form-label">WhatsApp Message Template</label>
                                    <textarea name="cta_whatsapp_message" id="cta_whatsapp_message" class="form-control" rows="5"
                                        placeholder="Halo, saya ingin request penawaran...">{{ App\Models\Setting::get('cta_whatsapp_message', '') }}</textarea>
                                    <small class="text-muted">Use {field_name} to insert form field values. Available fields: {full_name}, {domicile}, {product_name}, {quantity}, {shipping_destination}, {notes}</small>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="cta_whatsapp_info" class="form-label">WhatsApp Info Message</label>
                                    <input type="text" name="cta_whatsapp_info" id="cta_whatsapp_info" class="form-control"
                                        value="{{ App\Models\Setting::get('cta_whatsapp_info', 'Lampirkan gambar referensi di WhatsApp setelah klik Kirim.') }}"
                                        placeholder="Lampirkan gambar referensi di WhatsApp setelah klik Kirim.">
                                </div>
                            </div>

                            <hr class="my-4">

                            <h5 class="mb-3">Form Fields Configuration</h5>
                            <div class="mb-3">
                                <p class="text-muted">Configure which fields appear in the form and their properties.</p>
                                <div id="form-fields-container">
                                    @php
                                        $formFields = App\Models\Setting::get('cta_form_fields', [
                                            ['name' => 'full_name', 'label' => 'Nama Lengkap', 'type' => 'text', 'required' => true, 'enabled' => true, 'placeholder' => ''],
                                            ['name' => 'domicile', 'label' => 'Domisili (Kota)', 'type' => 'text', 'required' => true, 'enabled' => true, 'placeholder' => ''],
                                            ['name' => 'product_name', 'label' => 'Nama Produk', 'type' => 'text', 'required' => true, 'enabled' => true, 'placeholder' => ''],
                                            ['name' => 'quantity', 'label' => 'Jumlah (Pcs)', 'type' => 'text', 'required' => true, 'enabled' => true, 'placeholder' => ''],
                                            ['name' => 'shipping_destination', 'label' => 'Tujuan Pengiriman', 'type' => 'text', 'required' => false, 'enabled' => true, 'placeholder' => ''],
                                            ['name' => 'notes', 'label' => 'Catatan Tambahan (Spek/Ukuran)', 'type' => 'textarea', 'required' => false, 'enabled' => true, 'placeholder' => ''],
                                        ]);
                                        // Ensure all fields have placeholder key
                                        foreach ($formFields as &$field) {
                                            if (!isset($field['placeholder'])) {
                                                $field['placeholder'] = '';
                                            }
                                        }
                                    @endphp
                                    @foreach($formFields as $index => $field)
                                    <div class="card mb-3 form-field-item" data-index="{{ $index }}">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-md-1">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input field-enabled" type="checkbox" 
                                                            {{ ($field['enabled'] ?? true) ? 'checked' : '' }}>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control form-control-sm field-name" 
                                                        value="{{ $field['name'] }}" placeholder="field_name" readonly>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control form-control-sm field-label" 
                                                        value="{{ $field['label'] }}" placeholder="Field Label">
                                                </div>
                                                <div class="col-md-2">
                                                    <select class="form-select form-select-sm field-type">
                                                        <option value="text" {{ ($field['type'] ?? 'text') === 'text' ? 'selected' : '' }}>Text</option>
                                                        <option value="textarea" {{ ($field['type'] ?? 'text') === 'textarea' ? 'selected' : '' }}>Textarea</option>
                                                        <option value="email" {{ ($field['type'] ?? 'text') === 'email' ? 'selected' : '' }}>Email</option>
                                                        <option value="tel" {{ ($field['type'] ?? 'text') === 'tel' ? 'selected' : '' }}>Phone</option>
                                                        <option value="number" {{ ($field['type'] ?? 'text') === 'number' ? 'selected' : '' }}>Number</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input field-required" type="checkbox" 
                                                            {{ ($field['required'] ?? false) ? 'checked' : '' }}>
                                                        <label class="form-check-label small">Required</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-sm btn-danger remove-field">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control form-control-sm field-placeholder" 
                                                        value="{{ $field['placeholder'] ?? '' }}" placeholder="Placeholder text (optional)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="add-form-field">
                                    <i class="mdi mdi-plus"></i> Add Field
                                </button>
                                <input type="hidden" name="cta_form_fields" id="cta_form_fields" value="">
                            </div>
                        </div>

                        <!-- Footer Tab -->
                        <div class="tab-pane fade" id="footer" role="tabpanel">
                            <h5 class="mb-3">Footer Description</h5>
                            <div class="mb-3">
                                <label for="site_description" class="form-label">Footer Description</label>
                                <textarea name="site_description" id="site_description" class="form-control" rows="4"
                                    placeholder="Deskripsi singkat perusahaan yang akan ditampilkan di footer">{{ App\Models\Setting::get('site_description', '') }}</textarea>
                                <small class="text-muted">Deskripsi singkat tentang perusahaan yang akan ditampilkan di bagian footer.</small>
                            </div>

                            <hr class="my-4">

                            <h5 class="mb-3">Working Hours</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="working_hours_weekday" class="form-label">Weekday (Mon-Fri)</label>
                                    <input type="text" name="working_hours_weekday" id="working_hours_weekday" class="form-control"
                                        value="{{ App\Models\Setting::get('working_hours_weekday', '8:00 AM - 7:00 PM') }}"
                                        placeholder="8:00 AM - 7:00 PM">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="working_hours_saturday" class="form-label">Saturday</label>
                                    <input type="text" name="working_hours_saturday" id="working_hours_saturday" class="form-control"
                                        value="{{ App\Models\Setting::get('working_hours_saturday', '2:00 PM - 9:00 PM') }}"
                                        placeholder="2:00 PM - 9:00 PM">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="working_hours_sunday" class="form-label">Sunday</label>
                                    <input type="text" name="working_hours_sunday" id="working_hours_sunday" class="form-control"
                                        value="{{ App\Models\Setting::get('working_hours_sunday', 'Close') }}"
                                        placeholder="Close">
                                </div>
                            </div>

                            <hr class="my-4">

                            <h5 class="mb-3">Social Media Links</h5>
                            <p class="text-muted small mb-3">Tambahkan, edit, atau hapus social media links. Setiap link bisa menggunakan icon Font Awesome.</p>
                            
                            <div id="social-links-container">
                                @php
                                    $socialLinks = App\Models\Setting::get('social_links', []);
                                    if (is_string($socialLinks)) {
                                        $socialLinks = json_decode($socialLinks, true) ?: [];
                                    }
                                    // Migrate old format to new format
                                    if (empty($socialLinks)) {
                                        $oldLinks = [];
                                        if (App\Models\Setting::get('social_facebook')) {
                                            $oldLinks[] = ['label' => 'Facebook', 'url' => App\Models\Setting::get('social_facebook'), 'icon' => 'fa-brands fa-facebook-f'];
                                        }
                                        if (App\Models\Setting::get('social_instagram')) {
                                            $oldLinks[] = ['label' => 'Instagram', 'url' => App\Models\Setting::get('social_instagram'), 'icon' => 'fa-brands fa-instagram'];
                                        }
                                        if (App\Models\Setting::get('social_linkedin')) {
                                            $oldLinks[] = ['label' => 'LinkedIn', 'url' => App\Models\Setting::get('social_linkedin'), 'icon' => 'fa-brands fa-linkedin-in'];
                                        }
                                        if (App\Models\Setting::get('social_twitter')) {
                                            $oldLinks[] = ['label' => 'Twitter/X', 'url' => App\Models\Setting::get('social_twitter'), 'icon' => 'fa-brands fa-x-twitter'];
                                        }
                                        $socialLinks = $oldLinks;
                                    }
                                @endphp
                                
                                @if(count($socialLinks) > 0)
                                    @foreach($socialLinks as $index => $link)
                                    <div class="social-link-item border rounded p-3 mb-3" data-index="{{ $index }}">
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <label class="form-label small">Label</label>
                                                <input type="text" name="social_links[{{ $index }}][label]" class="form-control form-control-sm" 
                                                    value="{{ $link['label'] ?? '' }}" placeholder="Facebook">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label small">URL</label>
                                                <input type="url" name="social_links[{{ $index }}][url]" class="form-control form-control-sm" 
                                                    value="{{ $link['url'] ?? '' }}" placeholder="https://facebook.com/yourpage">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label small">Icon Class (Font Awesome)</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="social_links[{{ $index }}][icon]" class="form-control social-icon-input" 
                                                        value="{{ $link['icon'] ?? 'fa-brands fa-facebook-f' }}" placeholder="fa-brands fa-facebook-f">
                                                    <button type="button" class="btn btn-outline-secondary preview-icon-btn" title="Preview Icon">
                                                        <i class="{{ $link['icon'] ?? 'fa-brands fa-facebook-f' }}"></i>
                                                    </button>
                                                </div>
                                                <small class="text-muted">Contoh: fa-brands fa-facebook-f, fa-brands fa-instagram</small>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="form-label small">&nbsp;</label>
                                                <button type="button" class="btn btn-danger btn-sm w-100 remove-social-link">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-info">
                                        <i class="mdi mdi-information"></i> Belum ada social media links. Klik tombol "Tambah Link" di bawah untuk menambahkan.
                                    </div>
                                @endif
                            </div>
                            
                            <button type="button" class="btn btn-primary btn-sm mt-2" id="add-social-link">
                                <i class="mdi mdi-plus"></i> Tambah Link
                            </button>
                            
                            <input type="hidden" name="social_links_json" id="social-links-json" value="">

                            <hr class="my-4">

                            <h5 class="mb-3">Footer Styling</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="footer_background_color" class="form-label">Background Color</label>
                                    <div class="input-group">
                                        <input type="color" name="footer_background_color" id="footer_background_color" class="form-control form-control-color" 
                                            value="{{ App\Models\Setting::get('footer_background_color', '#1a1a1a') }}" 
                                            title="Pilih warna background footer">
                                        <input type="text" class="form-control" id="footer_background_color_text" 
                                            value="{{ App\Models\Setting::get('footer_background_color', '#1a1a1a') }}" 
                                            placeholder="#1a1a1a">
                                    </div>
                                    <small class="text-muted">Pilih warna background untuk footer. Default: #1a1a1a (dark gray)</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="footer_text_color" class="form-label">Text Color</label>
                                    <div class="input-group">
                                        <input type="color" name="footer_text_color" id="footer_text_color" class="form-control form-control-color" 
                                            value="{{ App\Models\Setting::get('footer_text_color', '#ffffff') }}" 
                                            title="Pilih warna text footer">
                                        <input type="text" class="form-control" id="footer_text_color_text" 
                                            value="{{ App\Models\Setting::get('footer_text_color', '#ffffff') }}" 
                                            placeholder="#ffffff">
                                    </div>
                                    <small class="text-muted">Pilih warna text untuk footer. Default: #ffffff (white)</small>
                                </div>
                            </div>

                            <hr class="my-4">

                            <h5 class="mb-3">Footer Copyright</h5>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="footer_copyright_text" class="form-label">Copyright Text</label>
                                    <input type="text" name="footer_copyright_text" id="footer_copyright_text" class="form-control"
                                        value="{{ App\Models\Setting::get('footer_copyright_text', '') }}"
                                        placeholder="© Copyright {{ date('Y') }} - {{ App\Models\Setting::get('site_name', 'Company Name') }}. All Right Reserved">
                                    <small class="text-muted">Custom copyright text. Kosongkan untuk menggunakan default: "© Copyright {year} - {site_name}. All Right Reserved". Gunakan {year} untuk tahun otomatis dan {site_name} untuk nama site.</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="footer_copyright_link" class="form-label">Copyright Link (Optional)</label>
                                    <input type="text" name="footer_copyright_link" id="footer_copyright_link" class="form-control"
                                        value="{{ App\Models\Setting::get('footer_copyright_link', '') }}"
                                        placeholder="/ atau https://example.com atau kosongkan">
                                    <small class="text-muted">Link untuk copyright text. Jika dikosongkan, copyright text tidak akan menjadi link.</small>
                                </div>
                            </div>

                            <hr class="my-4">

                            <h5 class="mb-3">Footer Links</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="site_url" class="form-label">Website URL</label>
                                    <input type="url" name="site_url" id="site_url" class="form-control"
                                        value="{{ App\Models\Setting::get('site_url', '') }}"
                                        placeholder="https://yourwebsite.com">
                                    <small class="text-muted">URL website yang akan ditampilkan di footer.</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="footer_terms_link" class="form-label">Terms & Conditions Link</label>
                                    <input type="text" name="footer_terms_link" id="footer_terms_link" class="form-control"
                                        value="{{ App\Models\Setting::get('footer_terms_link', '#') }}"
                                        placeholder="/terms atau #">
                                    <small class="text-muted">Link ke halaman Terms & Conditions.</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="footer_privacy_link" class="form-label">Privacy Policy Link</label>
                                    <input type="text" name="footer_privacy_link" id="footer_privacy_link" class="form-control"
                                        value="{{ App\Models\Setting::get('footer_privacy_link', '#') }}"
                                        placeholder="/privacy atau #">
                                    <small class="text-muted">Link ke halaman Privacy Policy.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary px-5">
                            <i class="mdi mdi-content-save me-2"></i> Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add CTA handler
            document.addEventListener('click', function(e) {
                if (e.target.closest('.add-cta')) {
                    e.preventDefault();
                    const button = e.target.closest('.add-cta');
                    const slideIndex = button.getAttribute('data-slide-index');
                    const container = document.querySelector(`.ctas-container[data-slide-index="${slideIndex}"]`);
                    
                    const ctaHtml = `
                        <div class="cta-item mb-2 p-2 border rounded">
                            <div class="row g-2">
                                <div class="col-5">
                                    <input type="text" 
                                        class="form-control form-control-sm cta-title" 
                                        value=""
                                        placeholder="Button text">
                                </div>
                                <div class="col-6">
                                    <input type="text" 
                                        class="form-control form-control-sm cta-url" 
                                        value=""
                                        placeholder="URL (e.g., /contact)">
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn btn-sm btn-danger remove-cta w-100">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', ctaHtml);
                }
                
                if (e.target.closest('.remove-cta')) {
                    e.preventDefault();
                    const button = e.target.closest('.remove-cta');
                    button.closest('.cta-item').remove();
                }
            });
            
            // Save slider data before form submit
            const form = document.getElementById('settings-form') || document.querySelector('form[action*="settings"]');
            if (form) {
                form.addEventListener('submit', function(e) {
                const sliderItems = document.querySelectorAll('.slider-item');
                const sliderData = [];
                
                sliderItems.forEach(function(item) {
                    const imageEl = item.querySelector('.slider-image');
                    const badgeEl = item.querySelector('.slider-badge');
                    const taglineEl = item.querySelector('.slider-tagline');
                    const titleEl = item.querySelector('.slider-title');
                    const subtitleEl = item.querySelector('.slider-subtitle');
                    
                    if (!imageEl) {
                        return; // Skip if image not found
                    }
                    
                    const image = imageEl.value ? imageEl.value.trim() : '';
                    const badge = badgeEl ? badgeEl.value.trim() : '';
                    const tagline = taglineEl ? taglineEl.value.trim() : '';
                    const title = titleEl ? titleEl.value.trim() : '';
                    const subtitle = subtitleEl ? subtitleEl.value.trim() : '';
                    
                    // Collect CTAs
                    const ctas = [];
                    const ctaItems = item.querySelectorAll('.cta-item');
                    ctaItems.forEach(function(ctaItem) {
                        const ctaTitleEl = ctaItem.querySelector('.cta-title');
                        const ctaUrlEl = ctaItem.querySelector('.cta-url');
                        if (ctaTitleEl && ctaUrlEl) {
                            const ctaTitle = ctaTitleEl.value.trim();
                            const ctaUrl = ctaUrlEl.value.trim();
                            if (ctaTitle && ctaUrl) {
                                ctas.push({
                                    title: ctaTitle,
                                    url: ctaUrl
                                });
                            }
                        }
                    });
                    
                    // Always add slide data if image exists
                    if (image) {
                        sliderData.push({
                            image: image,
                            badge: badge || '',
                            tagline: tagline || '',
                            title: title || '',
                            subtitle: subtitle || '',
                            ctas: ctas || []
                        });
                    }
                });
                
                // Always add hidden input with slider data (even if empty array)
                let sliderDataInput = document.querySelector('input[name="slider_data"]');
                if (!sliderDataInput) {
                    sliderDataInput = document.createElement('input');
                    sliderDataInput.type = 'hidden';
                    sliderDataInput.name = 'slider_data';
                    form.appendChild(sliderDataInput);
                }
                
                try {
                    sliderDataInput.value = JSON.stringify(sliderData);
                    console.log('Slider data to save:', sliderData);
                    console.log('Slider data JSON:', sliderDataInput.value);
                    console.log('Slider data count:', sliderData.length);
                    
                    // Verify the input is in the form
                    if (!form.contains(sliderDataInput)) {
                        form.appendChild(sliderDataInput);
                    }
                    
                    // Double check the value is set
                    console.log('Hidden input value after setting:', sliderDataInput.value);
                    console.log('Hidden input in form:', form.contains(sliderDataInput));
                } catch (error) {
                    console.error('Error stringifying slider data:', error);
                    alert('Error preparing slider data. Please check console for details.');
                    e.preventDefault();
                    return false;
                }
                });
            }
            
            // Handle form fields editor
            document.getElementById('add-form-field')?.addEventListener('click', function() {
                const container = document.getElementById('form-fields-container');
                const index = container.children.length;
                const fieldHtml = `
                    <div class="card mb-3 form-field-item" data-index="${index}">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-1">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input field-enabled" type="checkbox" checked>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control form-control-sm field-name" 
                                        value="field_${index}" placeholder="field_name">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control form-control-sm field-label" 
                                        value="" placeholder="Field Label">
                                </div>
                                <div class="col-md-2">
                                    <select class="form-select form-select-sm field-type">
                                        <option value="text">Text</option>
                                        <option value="textarea">Textarea</option>
                                        <option value="email">Email</option>
                                        <option value="tel">Phone</option>
                                        <option value="number">Number</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input field-required" type="checkbox">
                                        <label class="form-check-label small">Required</label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-sm btn-danger remove-field">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <input type="text" class="form-control form-control-sm field-placeholder" 
                                        value="" placeholder="Placeholder text (optional)">
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', fieldHtml);
            });

            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-field')) {
                    e.preventDefault();
                    const button = e.target.closest('.remove-field');
                    if (confirm('Are you sure you want to remove this field?')) {
                        button.closest('.form-field-item').remove();
                    }
                }
            });

            // Save form fields data before form submit
            form.addEventListener('submit', function(e) {
                const formFields = [];
                document.querySelectorAll('.form-field-item').forEach(function(item) {
                    const enabled = item.querySelector('.field-enabled').checked;
                    const name = item.querySelector('.field-name').value.trim();
                    const label = item.querySelector('.field-label').value.trim();
                    const type = item.querySelector('.field-type').value;
                    const required = item.querySelector('.field-required').checked;
                    const placeholder = item.querySelector('.field-placeholder').value.trim();

                    if (name && label) {
                        formFields.push({
                            name: name,
                            label: label,
                            type: type,
                            required: required,
                            enabled: enabled,
                            placeholder: placeholder
                        });
                    }
                });

                document.getElementById('cta_form_fields').value = JSON.stringify(formFields);
            });

            // Handle slider image deletion
            document.querySelectorAll('.delete-slider-image').forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const imagePath = this.getAttribute('data-image');
                    const imageContainer = this.closest('.slider-item');
                    
                    if (confirm('Are you sure you want to delete this image?')) {
                        // Create form data
                        const formData = new FormData();
                        formData.append('image', imagePath);
                        formData.append('_token', '{{ csrf_token() }}');
                        
                        // Send delete request
                        fetch('{{ route("admin.settings.slider.delete") }}', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Remove the image container
                                imageContainer.remove();
                                
                                // Show success message
                                const alertDiv = document.createElement('div');
                                alertDiv.className = 'alert alert-success alert-dismissible fade show';
                                alertDiv.innerHTML = data.message || 'Image deleted successfully.';
                                alertDiv.innerHTML += '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                                
                                const container = document.querySelector('.container-fluid');
                                container.insertBefore(alertDiv, container.firstChild);
                                
                                // Check if no images left
                                const remainingImages = document.querySelectorAll('.delete-slider-image');
                                if (remainingImages.length === 0) {
                                    const container = document.getElementById('slider-images-container');
                                    container.innerHTML = '<p class="text-muted">No slider images uploaded yet.</p>';
                                }
                            } else {
                                alert(data.message || 'Failed to delete image.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while deleting the image.');
                        });
                    }
                });
            });

            // Dynamic Social Media Links
            let socialLinkIndex = document.querySelectorAll('.social-link-item').length;
            
            // Add new social link
            document.getElementById('add-social-link')?.addEventListener('click', function() {
                const container = document.getElementById('social-links-container');
                const alertInfo = container.querySelector('.alert-info');
                if (alertInfo) {
                    alertInfo.remove();
                }
                
                const newItem = document.createElement('div');
                newItem.className = 'social-link-item border rounded p-3 mb-3';
                newItem.setAttribute('data-index', socialLinkIndex);
                newItem.innerHTML = `
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label small">Label</label>
                            <input type="text" name="social_links[${socialLinkIndex}][label]" class="form-control form-control-sm" 
                                value="" placeholder="Facebook">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small">URL</label>
                            <input type="url" name="social_links[${socialLinkIndex}][url]" class="form-control form-control-sm" 
                                value="" placeholder="https://facebook.com/yourpage">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small">Icon Class (Font Awesome)</label>
                            <div class="input-group input-group-sm">
                                <input type="text" name="social_links[${socialLinkIndex}][icon]" class="form-control social-icon-input" 
                                    value="fa-brands fa-facebook-f" placeholder="fa-brands fa-facebook-f">
                                <button type="button" class="btn btn-outline-secondary preview-icon-btn" title="Preview Icon">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </button>
                            </div>
                            <small class="text-muted">Contoh: fa-brands fa-facebook-f, fa-brands fa-instagram</small>
                        </div>
                        <div class="col-md-1">
                            <label class="form-label small">&nbsp;</label>
                            <button type="button" class="btn btn-danger btn-sm w-100 remove-social-link">
                                <i class="mdi mdi-delete"></i>
                            </button>
                        </div>
                    </div>
                `;
                container.appendChild(newItem);
                socialLinkIndex++;
                updateSocialLinksJson();
            });
            
            // Remove social link
            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-social-link')) {
                    const item = e.target.closest('.social-link-item');
                    if (confirm('Hapus social media link ini?')) {
                        item.remove();
                        updateSocialLinksJson();
                        
                        // Show info if no items left
                        const container = document.getElementById('social-links-container');
                        if (container.children.length === 0) {
                            container.innerHTML = '<div class="alert alert-info"><i class="mdi mdi-information"></i> Belum ada social media links. Klik tombol "Tambah Link" di bawah untuk menambahkan.</div>';
                        }
                    }
                }
            });
            
            // Update JSON before form submit
            document.getElementById('settings-form')?.addEventListener('submit', function() {
                updateSocialLinksJson();
            });
            
            // Update JSON on input change
            document.getElementById('social-links-container')?.addEventListener('input', function() {
                updateSocialLinksJson();
            });
            
            function updateSocialLinksJson() {
                const container = document.getElementById('social-links-container');
                const items = container.querySelectorAll('.social-link-item');
                const links = [];
                
                items.forEach(function(item) {
                    const label = item.querySelector('input[name*="[label]"]')?.value?.trim();
                    const url = item.querySelector('input[name*="[url]"]')?.value?.trim();
                    const icon = item.querySelector('input[name*="[icon]"]')?.value?.trim();
                    
                    if (label && url) {
                        links.push({
                            label: label,
                            url: url,
                            icon: icon || 'fa-brands fa-link'
                        });
                    }
                });
                
                document.getElementById('social-links-json').value = JSON.stringify(links);
            }
            
            // Preview icon on input change
            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('social-icon-input')) {
                    const button = e.target.nextElementSibling;
                    if (button && button.classList.contains('preview-icon-btn')) {
                        const iconClass = e.target.value.trim();
                        const preview = button.querySelector('i');
                        if (preview && iconClass) {
                            preview.className = iconClass;
                        }
                    }
                }
            });
            
            // Preview icon button click
            document.addEventListener('click', function(e) {
                if (e.target.closest('.preview-icon-btn')) {
                    const button = e.target.closest('.preview-icon-btn');
                    const input = button.previousElementSibling;
                    if (input && input.classList.contains('social-icon-input')) {
                        const iconClass = input.value.trim();
                        const preview = button.querySelector('i');
                        if (preview && iconClass) {
                            preview.className = iconClass;
                        }
                    }
                }
            });
            
            // Initialize JSON on page load
            updateSocialLinksJson();

            // Footer color picker sync
            const footerBgColor = document.getElementById('footer_background_color');
            const footerBgColorText = document.getElementById('footer_background_color_text');
            const footerTextColor = document.getElementById('footer_text_color');
            const footerTextColorText = document.getElementById('footer_text_color_text');

            if (footerBgColor && footerBgColorText) {
                footerBgColor.addEventListener('input', function() {
                    footerBgColorText.value = this.value;
                });
                footerBgColorText.addEventListener('input', function() {
                    if (/^#[0-9A-F]{6}$/i.test(this.value)) {
                        footerBgColor.value = this.value;
                    }
                });
            }

            if (footerTextColor && footerTextColorText) {
                footerTextColor.addEventListener('input', function() {
                    footerTextColorText.value = this.value;
                });
                footerTextColorText.addEventListener('input', function() {
                    if (/^#[0-9A-F]{6}$/i.test(this.value)) {
                        footerTextColor.value = this.value;
                    }
                });
            }
        });
    </script>
@endsection
