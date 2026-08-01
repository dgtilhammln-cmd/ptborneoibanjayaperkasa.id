@php
    $sections = $page->sections ?? [];
    $breadcrumb = $sections['breadcrumb'] ?? [];
    $intro_section = $sections['intro_section'] ?? [];
    $categories_section = $sections['categories_section'] ?? [];
    $why_choose_section = $sections['why_choose_section'] ?? [];
    $quality_section = $sections['quality_section'] ?? [];
@endphp

<!-- Breadcrumb Section -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Breadcrumb Section</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="sections[breadcrumb][is_active]" value="1" id="breadcrumb_active" {{ ($breadcrumb['is_active'] ?? true) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="breadcrumb_active">Aktif</label>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <label class="form-label fw-bold text-white">Title</label>
                <input type="text" name="sections[breadcrumb][title]" 
                    value="{{ old('sections.breadcrumb.title', $breadcrumb['title'] ?? 'Produk Kami') }}" 
                    class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Background Image</label>
                <input type="file" name="breadcrumb_background_image" class="form-control" accept="image/*">
                @if(!empty($breadcrumb['background_image']))
                <div class="mt-2">
                    <img src="{{ asset($breadcrumb['background_image']) }}" class="img-thumbnail" style="max-width: 200px;">
                    <input type="hidden" name="sections[breadcrumb][background_image_existing]" value="{{ $breadcrumb['background_image'] }}">
                </div>
                @else
                <small class="text-muted">Default: assets/img/barfi/shape/breadcrumb-shape.svg</small>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Products Intro Section -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Products Intro Section</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="sections[intro_section][is_active]" value="1" id="intro_section_active" {{ ($intro_section['is_active'] ?? true) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="intro_section_active">Aktif</label>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <label class="form-label fw-bold text-white">Subtitle</label>
                <input type="text" name="sections[intro_section][subtitle]" 
                    value="{{ old('sections.intro_section.subtitle', $intro_section['subtitle'] ?? 'Produk Kami') }}" 
                    class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Heading</label>
                <input type="text" name="sections[intro_section][heading]" 
                    value="{{ old('sections.intro_section.heading', $intro_section['heading'] ?? 'Sparepart & Aksesori Industri Berkualitas Tinggi') }}" 
                    class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Description Paragraph 1</label>
                <textarea name="sections[intro_section][description_1]" 
                    class="form-control" rows="3">{{ old('sections.intro_section.description_1', $intro_section['description_1'] ?? 'PT. Borneo Iban Jaya Perkasa memproduksi berbagai macam sparepart dan aksesori industri dengan standar kualitas tinggi. Produk kami meliputi komponen otomotif, bracket & mounting, suku cadang mesin, dan aksesori industri lainnya yang dirancang untuk memenuhi kebutuhan spesifik pelanggan.') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Description Paragraph 2</label>
                <textarea name="sections[intro_section][description_2]" 
                    class="form-control" rows="3">{{ old('sections.intro_section.description_2', $intro_section['description_2'] ?? 'Dengan teknologi modern dan pengalaman lebih dari 22 tahun, setiap produk yang kami hasilkan menjamin presisi tinggi, ketahanan yang baik, dan kualitas konsisten untuk mendukung operasional industri Anda.') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Image</label>
                <input type="file" name="intro_section_image" class="form-control" accept="image/*">
                @if(!empty($intro_section['image']))
                <div class="mt-2">
                    <img src="{{ asset($intro_section['image']) }}" class="img-thumbnail" style="max-width: 200px;">
                    <input type="hidden" name="sections[intro_section][image_existing]" value="{{ $intro_section['image'] }}">
                </div>
                @else
                <small class="text-muted">Default: assets/img/barfi/SnowRemovalTwo/about/vl-about2.1.png</small>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Product Categories Section -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Product Categories Section</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="sections[categories_section][is_active]" value="1" id="categories_section_active" {{ ($categories_section['is_active'] ?? true) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="categories_section_active">Aktif</label>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <label class="form-label fw-bold text-white">Subtitle</label>
                <input type="text" name="sections[categories_section][subtitle]" 
                    value="{{ old('sections.categories_section.subtitle', $categories_section['subtitle'] ?? 'Kategori Produk') }}" 
                    class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Heading</label>
                <input type="text" name="sections[categories_section][heading]" 
                    value="{{ old('sections.categories_section.heading', $categories_section['heading'] ?? 'Berbagai Kategori Produk untuk Kebutuhan Industri Anda') }}" 
                    class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Description</label>
                <textarea name="sections[categories_section][description]" 
                    class="form-control" rows="2">{{ old('sections.categories_section.description', $categories_section['description'] ?? 'Kami menyediakan produk dalam berbagai kategori untuk memenuhi kebutuhan industri yang beragam, dari komponen otomotif hingga aksesori industri.') }}</textarea>
            </div>
            
            <div class="col-12">
                <label class="form-label fw-bold text-white">Categories</label>
                <div id="categoriesContainer">
                    @php
                        $categories = $categories_section['categories'] ?? [
                            ['icon' => 'assets/img/barfi/icon/vl-chos-icon-ab-1.1.svg', 'title' => 'Komponen Otomotif', 'description' => 'Sparepart dan komponen otomotif dengan presisi tinggi untuk berbagai jenis kendaraan, dari sepeda motor hingga kendaraan berat.'],
                            ['icon' => 'assets/img/barfi/icon/vl-chos-icon-ab-1.2.svg', 'title' => 'Bracket & Mounting', 'description' => 'Sistem bracket dan mounting yang kuat dan tahan lama untuk berbagai aplikasi industri, dirancang untuk beban berat dan kondisi ekstrem.'],
                            ['icon' => 'assets/img/barfi/icon/vl-chos-icon-ab-1.3.svg', 'title' => 'Suku Cadang Mesin', 'description' => 'Suku cadang mesin industri dengan kualitas terjamin, dapat disesuaikan dengan spesifikasi mesin Anda untuk performa optimal.'],
                            ['icon' => 'assets/img/barfi/icon/vl-chos-icon-ab-1.4.svg', 'title' => 'Aksesori Industri', 'description' => 'Berbagai aksesori industri dengan desain fungsional untuk meningkatkan efisiensi dan produktivitas operasional pabrik Anda.'],
                            ['icon' => 'assets/img/barfi/icon/vl-chos-icon-ab-1.5.svg', 'title' => 'Custom Parts', 'description' => 'Komponen custom sesuai spesifikasi Anda. Kami melayani pembuatan komponen dengan presisi tinggi untuk kebutuhan khusus.'],
                            ['icon' => 'assets/img/barfi/icon/vl-chos-icon-ab-1.6.svg', 'title' => 'Moulding Parts', 'description' => 'Produk moulding dan injection dengan kualitas tinggi untuk berbagai aplikasi industri dengan bentuk dan ukuran yang fleksibel.'],
                        ];
                    @endphp
                    @foreach($categories as $index => $category)
                    <div class="card ag-glass border mb-3 category-item" data-category-index="{{ $index }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 text-white">Category {{ $index + 1 }}</h6>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-category">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label text-white small">Icon</label>
                                    <input type="file" name="category_{{ $index }}_icon" class="form-control" accept="image/*">
                                    @if(!empty($category['icon']))
                                    <div class="mt-2">
                                        <img src="{{ asset($category['icon']) }}" class="img-thumbnail" style="max-width: 50px;">
                                        <input type="hidden" name="sections[categories_section][categories][{{ $index }}][icon_existing]" value="{{ $category['icon'] }}">
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label text-white small">Title</label>
                                    <input type="text" name="sections[categories_section][categories][{{ $index }}][title]" 
                                        value="{{ $category['title'] ?? '' }}" class="form-control" placeholder="Category Title">
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-white small">Description</label>
                                    <textarea name="sections[categories_section][categories][{{ $index }}][description]" 
                                        class="form-control" rows="2" placeholder="Category description">{{ $category['description'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-sm btn-primary mt-2" id="addCategoryBtn">
                    <i class="mdi mdi-plus me-1"></i> Add Category
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Why Choose Our Products Section -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Why Choose Our Products Section</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="sections[why_choose_section][is_active]" value="1" id="why_choose_section_active" {{ ($why_choose_section['is_active'] ?? true) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="why_choose_section_active">Aktif</label>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <label class="form-label fw-bold text-white">Subtitle</label>
                <input type="text" name="sections[why_choose_section][subtitle]" 
                    value="{{ old('sections.why_choose_section.subtitle', $why_choose_section['subtitle'] ?? 'Mengapa Memilih Produk Kami') }}" 
                    class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Heading</label>
                <input type="text" name="sections[why_choose_section][heading]" 
                    value="{{ old('sections.why_choose_section.heading', $why_choose_section['heading'] ?? 'Keunggulan Produk yang Membuat Kami Dipercaya') }}" 
                    class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Description</label>
                <textarea name="sections[why_choose_section][description]" 
                    class="form-control" rows="2">{{ old('sections.why_choose_section.description', $why_choose_section['description'] ?? 'Setiap produk yang kami hasilkan melalui proses quality control ketat untuk memastikan kualitas terbaik dan sesuai dengan standar industri.') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Background Image</label>
                <input type="file" name="why_choose_section_background_image" class="form-control" accept="image/*">
                @if(!empty($why_choose_section['background_image']))
                <div class="mt-2">
                    <img src="{{ asset($why_choose_section['background_image']) }}" class="img-thumbnail" style="max-width: 200px;">
                    <input type="hidden" name="sections[why_choose_section][background_image_existing]" value="{{ $why_choose_section['background_image'] }}">
                </div>
                @else
                <small class="text-muted">Default: assets/img/barfi/shape/fact-shape-about-bg.svg</small>
                @endif
            </div>
            
            <div class="col-12">
                <label class="form-label fw-bold text-white">Features</label>
                <div id="whyChooseFeaturesContainer">
                    @php
                        $features = $why_choose_section['features'] ?? [
                            ['icon' => 'fa-check-circle', 'title' => 'Kualitas Terjamin', 'description' => 'Setiap produk melalui quality control ketat untuk memastikan kualitas sesuai standar industri dan spesifikasi yang diminta.'],
                            ['icon' => 'fa-ruler-combined', 'title' => 'Presisi Tinggi', 'description' => 'Produk dibuat dengan teknologi modern dan presisi tinggi untuk memastikan akurasi dimensi dan kualitas konsisten.'],
                            ['icon' => 'fa-tools', 'title' => 'Custom Sesuai Kebutuhan', 'description' => 'Kami melayani pembuatan produk custom sesuai spesifikasi Anda dengan fleksibilitas tinggi untuk berbagai kebutuhan.'],
                            ['icon' => 'fa-clock', 'title' => 'Tepat Waktu', 'description' => 'Komitmen kami untuk menyelesaikan setiap pesanan tepat waktu tanpa mengorbankan kualitas produk yang dihasilkan.'],
                        ];
                    @endphp
                    @foreach($features as $index => $feature)
                    <div class="card ag-glass border mb-3 why-choose-feature-item" data-feature-index="{{ $index }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 text-white">Feature {{ $index + 1 }}</h6>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-why-choose-feature">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label text-white small">Icon (FontAwesome class)</label>
                                    <input type="text" name="sections[why_choose_section][features][{{ $index }}][icon]" 
                                        value="{{ $feature['icon'] ?? '' }}" class="form-control" placeholder="fa-check-circle">
                                    <small class="text-muted">e.g., fa-check-circle, fa-ruler-combined</small>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label text-white small">Title</label>
                                    <input type="text" name="sections[why_choose_section][features][{{ $index }}][title]" 
                                        value="{{ $feature['title'] ?? '' }}" class="form-control" placeholder="Feature Title">
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-white small">Description</label>
                                    <textarea name="sections[why_choose_section][features][{{ $index }}][description]" 
                                        class="form-control" rows="2" placeholder="Feature description">{{ $feature['description'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-sm btn-primary mt-2" id="addWhyChooseFeatureBtn">
                    <i class="mdi mdi-plus me-1"></i> Add Feature
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Product Quality Section -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Product Quality Section</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="sections[quality_section][is_active]" value="1" id="quality_section_active" {{ ($quality_section['is_active'] ?? true) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="quality_section_active">Aktif</label>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <label class="form-label fw-bold text-white">Subtitle</label>
                <input type="text" name="sections[quality_section][subtitle]" 
                    value="{{ old('sections.quality_section.subtitle', $quality_section['subtitle'] ?? 'Standar Kualitas') }}" 
                    class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Heading</label>
                <input type="text" name="sections[quality_section][heading]" 
                    value="{{ old('sections.quality_section.heading', $quality_section['heading'] ?? 'Komitmen Kami terhadap Kualitas Produk') }}" 
                    class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Description Paragraph 1</label>
                <textarea name="sections[quality_section][description_1]" 
                    class="form-control" rows="3">{{ old('sections.quality_section.description_1', $quality_section['description_1'] ?? 'Setiap produk yang kami hasilkan menjalani proses quality control yang ketat di setiap tahap produksi. Kami menggunakan material berkualitas tinggi dan teknologi modern untuk memastikan produk yang dihasilkan memiliki presisi tinggi, ketahanan yang baik, dan sesuai dengan standar industri.') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Description Paragraph 2</label>
                <textarea name="sections[quality_section][description_2]" 
                    class="form-control" rows="3">{{ old('sections.quality_section.description_2', $quality_section['description_2'] ?? 'Dengan pengalaman lebih dari 22 tahun, kami memahami pentingnya kualitas dalam mendukung operasional industri. Setiap produk yang keluar dari workshop kami dijamin kualitasnya dan siap digunakan untuk kebutuhan industri Anda.') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Image</label>
                <input type="file" name="quality_section_image" class="form-control" accept="image/*">
                @if(!empty($quality_section['image']))
                <div class="mt-2">
                    <img src="{{ asset($quality_section['image']) }}" class="img-thumbnail" style="max-width: 200px;">
                    <input type="hidden" name="sections[quality_section][image_existing]" value="{{ $quality_section['image'] }}">
                </div>
                @else
                <small class="text-muted">Default: assets/img/barfi/SnowRemovalOne/service/vl-value-thumb1.1.png</small>
                @endif
            </div>
            
            <div class="col-12">
                <label class="form-label fw-bold text-white">Quality Boxes</label>
                <div id="qualityBoxesContainer">
                    @php
                        $qualityBoxes = $quality_section['quality_boxes'] ?? [
                            ['title' => 'Material Berkualitas', 'description' => 'Kami menggunakan material berkualitas tinggi yang telah teruji untuk memastikan produk memiliki ketahanan dan performa optimal.'],
                            ['title' => 'Quality Control Ketat', 'description' => 'Setiap produk melalui proses inspeksi kualitas di setiap tahap produksi untuk memastikan sesuai dengan spesifikasi dan standar yang ditetapkan.'],
                            ['title' => 'Garansi Kualitas', 'description' => 'Kami memberikan garansi kualitas untuk setiap produk yang kami hasilkan sebagai bentuk komitmen kami terhadap kepuasan pelanggan.'],
                        ];
                    @endphp
                    @foreach($qualityBoxes as $index => $box)
                    <div class="card ag-glass border mb-3 quality-box-item" data-box-index="{{ $index }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 text-white">Quality Box {{ $index + 1 }}</h6>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-quality-box">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label text-white small">Title</label>
                                    <input type="text" name="sections[quality_section][quality_boxes][{{ $index }}][title]" 
                                        value="{{ $box['title'] ?? '' }}" class="form-control" placeholder="Quality Box Title">
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-white small">Description</label>
                                    <textarea name="sections[quality_section][quality_boxes][{{ $index }}][description]" 
                                        class="form-control" rows="2" placeholder="Quality box description">{{ $box['description'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-sm btn-primary mt-2" id="addQualityBoxBtn">
                    <i class="mdi mdi-plus me-1"></i> Add Quality Box
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Info Alert -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="alert alert-info mb-0">
            <i class="mdi mdi-information-outline me-2"></i>
            <strong>Info:</strong> Daftar products yang ditampilkan dikelola melalui menu <a href="{{ route('admin.products.index') }}" class="alert-link" target="_blank">Products Management</a>. Section di atas hanya untuk mengatur konten tambahan pada halaman products.
        </div>
    </div>
</div>

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let categoryIndex = {{ count($categories_section['categories'] ?? []) }};
    let whyChooseFeatureIndex = {{ count($why_choose_section['features'] ?? []) }};
    let qualityBoxIndex = {{ count($quality_section['quality_boxes'] ?? []) }};
    
    // Add Category
    document.getElementById('addCategoryBtn')?.addEventListener('click', function() {
        const container = document.getElementById('categoriesContainer');
        const html = `
            <div class="card ag-glass border mb-3 category-item" data-category-index="${categoryIndex}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 text-white">Category ${categoryIndex + 1}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-category">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label text-white small">Icon</label>
                            <input type="file" name="category_${categoryIndex}_icon" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label text-white small">Title</label>
                            <input type="text" name="sections[categories_section][categories][${categoryIndex}][title]" 
                                class="form-control" placeholder="Category Title">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-white small">Description</label>
                            <textarea name="sections[categories_section][categories][${categoryIndex}][description]" 
                                class="form-control" rows="2" placeholder="Category description"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        categoryIndex++;
        
        const newItem = container.lastElementChild;
        newItem.querySelector('.remove-category').addEventListener('click', function() {
            if (confirm('Are you sure you want to remove this category?')) {
                newItem.remove();
            }
        });
    });
    
    // Remove Category
    document.querySelectorAll('.remove-category').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('Are you sure you want to remove this category?')) {
                this.closest('.category-item').remove();
            }
        });
    });
    
    // Add Why Choose Feature
    document.getElementById('addWhyChooseFeatureBtn')?.addEventListener('click', function() {
        const container = document.getElementById('whyChooseFeaturesContainer');
        const html = `
            <div class="card ag-glass border mb-3 why-choose-feature-item" data-feature-index="${whyChooseFeatureIndex}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 text-white">Feature ${whyChooseFeatureIndex + 1}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-why-choose-feature">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label text-white small">Icon (FontAwesome class)</label>
                            <input type="text" name="sections[why_choose_section][features][${whyChooseFeatureIndex}][icon]" 
                                class="form-control" placeholder="fa-check-circle">
                            <small class="text-muted">e.g., fa-check-circle, fa-ruler-combined</small>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label text-white small">Title</label>
                            <input type="text" name="sections[why_choose_section][features][${whyChooseFeatureIndex}][title]" 
                                class="form-control" placeholder="Feature Title">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-white small">Description</label>
                            <textarea name="sections[why_choose_section][features][${whyChooseFeatureIndex}][description]" 
                                class="form-control" rows="2" placeholder="Feature description"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        whyChooseFeatureIndex++;
        
        const newItem = container.lastElementChild;
        newItem.querySelector('.remove-why-choose-feature').addEventListener('click', function() {
            if (confirm('Are you sure you want to remove this feature?')) {
                newItem.remove();
            }
        });
    });
    
    // Remove Why Choose Feature
    document.querySelectorAll('.remove-why-choose-feature').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('Are you sure you want to remove this feature?')) {
                this.closest('.why-choose-feature-item').remove();
            }
        });
    });
    
    // Add Quality Box
    document.getElementById('addQualityBoxBtn')?.addEventListener('click', function() {
        const container = document.getElementById('qualityBoxesContainer');
        const html = `
            <div class="card ag-glass border mb-3 quality-box-item" data-box-index="${qualityBoxIndex}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 text-white">Quality Box ${qualityBoxIndex + 1}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-quality-box">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    </div>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label text-white small">Title</label>
                            <input type="text" name="sections[quality_section][quality_boxes][${qualityBoxIndex}][title]" 
                                class="form-control" placeholder="Quality Box Title">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-white small">Description</label>
                            <textarea name="sections[quality_section][quality_boxes][${qualityBoxIndex}][description]" 
                                class="form-control" rows="2" placeholder="Quality box description"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        qualityBoxIndex++;
        
        const newItem = container.lastElementChild;
        newItem.querySelector('.remove-quality-box').addEventListener('click', function() {
            if (confirm('Are you sure you want to remove this quality box?')) {
                newItem.remove();
            }
        });
    });
    
    // Remove Quality Box
    document.querySelectorAll('.remove-quality-box').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('Are you sure you want to remove this quality box?')) {
                this.closest('.quality-box-item').remove();
            }
        });
    });
});
</script>
@endpush
