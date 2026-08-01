@php
    $sections = $page->sections ?? [];
    $breadcrumb = $sections['breadcrumb'] ?? [];
    $work_section = $sections['work_section'] ?? [];
    $contact_section = $sections['contact_section'] ?? [];
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
                    value="{{ old('sections.breadcrumb.title', $breadcrumb['title'] ?? 'Our Services') }}" 
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

<!-- Work Section (How It Work) -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Work Section (How It Work)</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="sections[work_section][is_active]" value="1" id="work_section_active" {{ ($work_section['is_active'] ?? true) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="work_section_active">Aktif</label>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <label class="form-label fw-bold text-white">Subtitle</label>
                <input type="text" name="sections[work_section][subtitle]" 
                    value="{{ old('sections.work_section.subtitle', $work_section['subtitle'] ?? 'Cara Kami Bekerja') }}" 
                    class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Heading</label>
                <input type="text" name="sections[work_section][heading]" 
                    value="{{ old('sections.work_section.heading', $work_section['heading'] ?? 'Proses Layanan Jasa Logam & Produksi Sparepart') }}" 
                    class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Background Image</label>
                <input type="file" name="work_section_background_image" class="form-control" accept="image/*">
                @if(!empty($work_section['background_image']))
                <div class="mt-2">
                    <img src="{{ asset($work_section['background_image']) }}" class="img-thumbnail" style="max-width: 200px;">
                    <input type="hidden" name="sections[work_section][background_image_existing]" value="{{ $work_section['background_image'] }}">
                </div>
                @else
                <small class="text-muted">Default: assets/img/barfi/shape/fact-shape-about-bg.svg</small>
                @endif
            </div>
            
            <div class="col-12">
                <label class="form-label fw-bold text-white">Work Steps</label>
                <div id="workStepsContainer">
                    @php
                    $steps = $work_section['steps'] ?? [
                        ['number' => '01', 'title' => 'Konsultasi & Permintaan', 'description' => 'Hubungi kami melalui WhatsApp atau email untuk konsultasi kebutuhan Anda. Jelaskan spesifikasi, jumlah, dan detail proyek yang Anda butuhkan.'],
                        ['number' => '02', 'title' => 'Analisis & Penawaran', 'description' => 'Tim kami akan menganalisis kebutuhan Anda dan menyiapkan penawaran yang sesuai dengan spesifikasi, budget, dan timeline yang diinginkan.'],
                        ['number' => '03', 'title' => 'Produksi & Pengiriman', 'description' => 'Setelah disetujui, kami memulai proses produksi dengan kontrol kualitas ketat dan mengirimkan hasil sesuai jadwal yang telah disepakati.']
                    ];
                    @endphp
                    @foreach($steps as $index => $step)
                    <div class="card ag-glass border mb-3 work-step-item" data-step-index="{{ $index }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 text-white">Step {{ $index + 1 }}</h6>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-work-step">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <label class="form-label text-white small">Number</label>
                                    <input type="text" name="sections[work_section][steps][{{ $index }}][number]" 
                                        value="{{ $step['number'] ?? '' }}" class="form-control" placeholder="01">
                                </div>
                                <div class="col-md-10">
                                    <label class="form-label text-white small">Title</label>
                                    <input type="text" name="sections[work_section][steps][{{ $index }}][title]" 
                                        value="{{ $step['title'] ?? '' }}" class="form-control" placeholder="Step Title">
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-white small">Description</label>
                                    <textarea name="sections[work_section][steps][{{ $index }}][description]" 
                                        class="form-control" rows="2" placeholder="Step description">{{ $step['description'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-sm btn-primary mt-2" id="addWorkStepBtn">
                    <i class="mdi mdi-plus me-1"></i> Add Step
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Contact Section</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="sections[contact_section][is_active]" value="1" id="contact_section_active" {{ ($contact_section['is_active'] ?? true) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="contact_section_active">Aktif</label>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <label class="form-label fw-bold text-white">Subtitle</label>
                <input type="text" name="sections[contact_section][subtitle]" 
                    value="{{ old('sections.contact_section.subtitle', $contact_section['subtitle'] ?? 'Hubungi Kami') }}" 
                    class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Heading</label>
                <input type="text" name="sections[contact_section][heading]" 
                    value="{{ old('sections.contact_section.heading', $contact_section['heading'] ?? 'Layanan Profesional untuk Kebutuhan Industri Anda') }}" 
                    class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Contact Title</label>
                <input type="text" name="sections[contact_section][contact_title]" 
                    value="{{ old('sections.contact_section.contact_title', $contact_section['contact_title'] ?? 'Get In Touch With Us') }}" 
                    class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Contact Description</label>
                <textarea name="sections[contact_section][contact_description]" 
                    class="form-control" rows="3">{{ old('sections.contact_section.contact_description', $contact_section['contact_description'] ?? 'Ada pertanyaan tentang layanan kami? Tim profesional kami siap membantu Anda. Hubungi kami untuk konsultasi gratis, penawaran, atau informasi lebih lanjut tentang jasa bubut, stamping, moulding, dan produksi sparepart.') }}</textarea>
            </div>
            
            <div class="col-12">
                <label class="form-label fw-bold text-white">Contact Info Cards</label>
                <div id="contactCardsContainer">
                    @php
                    $contactCards = $contact_section['contact_cards'] ?? [
                        ['icon' => 'assets/img/barfi/icon/vl-contact-icon-6.1.svg', 'title' => 'Alamat', 'text' => 'Jl. Raya Industri No. 123, Surabaya, Jawa Timur'],
                        ['icon' => 'assets/img/barfi/icon/vl-contact-icon-6.2.svg', 'title' => 'WhatsApp', 'text' => '031-8559-7449'],
                        ['icon' => 'assets/img/barfi/icon/vl-contact-icon-6.3.svg', 'title' => 'Jam Operasional', 'text' => 'Senin - Jumat: 08:00 - 17:00 WIB'],
                        ['icon' => 'assets/img/barfi/icon/vl-contact-icon-6.4.svg', 'title' => 'Email', 'text' => 'info@borneoibanjaya.com']
                    ];
                    @endphp
                    @foreach($contactCards as $index => $card)
                    <div class="card ag-glass border mb-3 contact-card-item" data-card-index="{{ $index }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 text-white">Contact Card {{ $index + 1 }}</h6>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-contact-card">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label text-white small">Icon</label>
                                    <input type="file" name="contact_card_{{ $index }}_icon" class="form-control" accept="image/*">
                                    @if(!empty($card['icon']))
                                    <div class="mt-2">
                                        <img src="{{ asset($card['icon']) }}" class="img-thumbnail" style="max-width: 50px;">
                                        <input type="hidden" name="sections[contact_section][contact_cards][{{ $index }}][icon_existing]" value="{{ $card['icon'] }}">
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label text-white small">Title</label>
                                    <input type="text" name="sections[contact_section][contact_cards][{{ $index }}][title]" 
                                        value="{{ $card['title'] ?? '' }}" class="form-control" placeholder="e.g., Address, Mobile">
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-white small">Text/Value</label>
                                    <input type="text" name="sections[contact_section][contact_cards][{{ $index }}][text]" 
                                        value="{{ $card['text'] ?? '' }}" class="form-control" placeholder="Contact information">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-sm btn-primary mt-2" id="addContactCardBtn">
                    <i class="mdi mdi-plus me-1"></i> Add Contact Card
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
            <strong>Info:</strong> Daftar services yang ditampilkan dikelola melalui menu <a href="{{ route('admin.services.index') }}" class="alert-link" target="_blank">Services Management</a>. Section di atas hanya untuk mengatur konten tambahan pada halaman services.
        </div>
    </div>
</div>

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let workStepIndex = {{ count($work_section['steps'] ?? []) }};
    let contactCardIndex = {{ count($contact_section['contact_cards'] ?? []) }};
    
    // Add Work Step
    document.getElementById('addWorkStepBtn')?.addEventListener('click', function() {
        const container = document.getElementById('workStepsContainer');
        const stepNumber = String(workStepIndex + 1).padStart(2, '0');
        const html = `
            <div class="card ag-glass border mb-3 work-step-item" data-step-index="${workStepIndex}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 text-white">Step ${workStepIndex + 1}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-work-step">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label text-white small">Number</label>
                            <input type="text" name="sections[work_section][steps][${workStepIndex}][number]" 
                                value="${stepNumber}" class="form-control" placeholder="01">
                        </div>
                        <div class="col-md-10">
                            <label class="form-label text-white small">Title</label>
                            <input type="text" name="sections[work_section][steps][${workStepIndex}][title]" 
                                class="form-control" placeholder="Step Title">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-white small">Description</label>
                            <textarea name="sections[work_section][steps][${workStepIndex}][description]" 
                                class="form-control" rows="2" placeholder="Step description"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        workStepIndex++;
        
        // Setup remove button
        const newItem = container.lastElementChild;
        newItem.querySelector('.remove-work-step').addEventListener('click', function() {
            if (confirm('Are you sure you want to remove this step?')) {
                newItem.remove();
            }
        });
    });
    
    // Remove Work Step
    document.querySelectorAll('.remove-work-step').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('Are you sure you want to remove this step?')) {
                this.closest('.work-step-item').remove();
            }
        });
    });
    
    // Add Contact Card
    document.getElementById('addContactCardBtn')?.addEventListener('click', function() {
        const container = document.getElementById('contactCardsContainer');
        const html = `
            <div class="card ag-glass border mb-3 contact-card-item" data-card-index="${contactCardIndex}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 text-white">Contact Card ${contactCardIndex + 1}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-contact-card">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label text-white small">Icon</label>
                            <input type="file" name="contact_card_${contactCardIndex}_icon" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label text-white small">Title</label>
                            <input type="text" name="sections[contact_section][contact_cards][${contactCardIndex}][title]" 
                                class="form-control" placeholder="e.g., Address, Mobile">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-white small">Text/Value</label>
                            <input type="text" name="sections[contact_section][contact_cards][${contactCardIndex}][text]" 
                                class="form-control" placeholder="Contact information">
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        contactCardIndex++;
        
        // Setup remove button
        const newItem = container.lastElementChild;
        newItem.querySelector('.remove-contact-card').addEventListener('click', function() {
            if (confirm('Are you sure you want to remove this contact card?')) {
                newItem.remove();
            }
        });
    });
    
    // Remove Contact Card
    document.querySelectorAll('.remove-contact-card').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('Are you sure you want to remove this contact card?')) {
                this.closest('.contact-card-item').remove();
            }
        });
    });
});
</script>
@endpush

