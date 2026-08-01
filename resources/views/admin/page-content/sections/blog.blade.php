@php
    $sections = $page->sections ?? [];
    $breadcrumb = $sections['breadcrumb'] ?? [];
    $blog_section = $sections['blog_section'] ?? [];
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
                    value="{{ old('sections.breadcrumb.title', $breadcrumb['title'] ?? 'Our Blog') }}" 
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

<!-- Blog Section -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Blog Section</h5>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="sections[blog_section][is_active]" value="1" id="blog_section_active" {{ ($blog_section['is_active'] ?? true) ? 'checked' : '' }}>
                <label class="form-check-label text-white" for="blog_section_active">Aktif</label>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <label class="form-label fw-bold text-white">Subtitle</label>
                <input type="text" name="sections[blog_section][subtitle]" 
                    value="{{ old('sections.blog_section.subtitle', $blog_section['subtitle'] ?? '') }}" 
                    class="form-control" placeholder="Optional subtitle">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Heading</label>
                <input type="text" name="sections[blog_section][heading]" 
                    value="{{ old('sections.blog_section.heading', $blog_section['heading'] ?? '') }}" 
                    class="form-control" placeholder="Optional heading">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold text-white">Description</label>
                <textarea name="sections[blog_section][description]" 
                    class="form-control" rows="3" placeholder="Optional description">{{ old('sections.blog_section.description', $blog_section['description'] ?? '') }}</textarea>
            </div>
        </div>
    </div>
</div>

<!-- Info Alert -->
<div class="card ag-card mb-4">
    <div class="card-body p-4">
        <div class="alert alert-info mb-0">
            <i class="mdi mdi-information-outline me-2"></i>
            <strong>Info:</strong> Daftar blog posts yang ditampilkan dikelola melalui menu <a href="{{ route('admin.blog.index') }}" class="alert-link" target="_blank">Blog Management</a>. Section di atas hanya untuk mengatur konten tambahan pada halaman blog (jika diperlukan).
        </div>
    </div>
</div>
