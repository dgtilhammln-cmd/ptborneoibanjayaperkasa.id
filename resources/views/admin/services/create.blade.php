@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card ag-card">
                <div class="card-header">
                    <h5 class="mb-0">{{ isset($service) ? 'Edit Service' : 'Create New Service' }}</h5>
                </div>
                <div class="card-body p-4">
                    <form
                        action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($service)) @method('PUT') @endif

                        <div class="mb-4">
                            <label class="form-label fw-bold">Service Name</label>
                            <input type="text" name="name" id="service-name" value="{{ old('name', $service->name ?? '') }}"
                                class="form-control form-control-lg" placeholder="Enter service name..." required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">URL Slug</label>
                            <div class="input-group">
                                <span class="input-group-text">/service/</span>
                                <input type="text" name="slug" id="service-slug" value="{{ old('slug', $service->slug ?? '') }}"
                                    class="form-control" placeholder="auto-generated-from-name">
                                <button type="button" class="btn btn-outline-secondary" id="generate-service-slug" title="Generate from name">
                                    <i class="mdi mdi-refresh"></i>
                                </button>
                            </div>
                            <small class="text-muted">Leave empty to auto-generate from name. Click refresh icon to regenerate.</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Description</label>
                            <textarea id="summernote" class="summernote"
                                name="description">{{ old('description', $service->description ?? '') }}</textarea>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Icon Class</label>
                                <input type="text" name="icon" value="{{ old('icon', $service->icon ?? '') }}"
                                    class="form-control" placeholder="e.g. mdi mdi-cog">
                                <small class="text-muted">Use Material Design Icons class names</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Featured Image</label>
                                <div class="p-2 border rounded">
                                    <input type="file" name="image" class="form-control mb-2">
                                    <p class="text-muted small mb-0">Recommended size: 800x600px</p>
                                    @if(isset($service) && $service->image)
                                        <div class="mt-2">
                                            <p class="small mb-1">Current Image:</p>
                                            <img src="{{ asset($service->image) }}" class="rounded shadow-sm"
                                                style="max-width: 150px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Service Advantages -->
                        <div class="card bg-light border mb-4">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3"><i class="mdi mdi-star-outline me-2"></i>Keunggulan Layanan Kami</h6>
                                <p class="text-muted small mb-3">Tambahkan daftar keunggulan layanan (maksimal 6 item)</p>
                                <div id="advantages-container">
                                    @php
                                        $advantages = old('advantages', [
                                            'Presisi Tinggi & Akurasi Terjamin',
                                            'Kualitas Material Premium',
                                            'Tim Profesional Berpengalaman',
                                            'Peralatan Modern & Teknologi Terkini',
                                            'Custom Order Sesuai Kebutuhan',
                                            'Layanan Responsif & Support 24/7'
                                        ]);
                                    @endphp
                                    @foreach($advantages as $index => $advantage)
                                    <div class="mb-2 advantage-item">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="mdi mdi-check-circle text-success"></i></span>
                                            <input type="text" name="advantages[]" class="form-control" 
                                                value="{{ $advantage }}" 
                                                placeholder="Masukkan keunggulan layanan...">
                                            @if($index > 0)
                                            <button type="button" class="btn btn-outline-danger remove-advantage">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="add-advantage">
                                    <i class="mdi mdi-plus me-1"></i> Tambah Keunggulan
                                </button>
                            </div>
                        </div>

                        <div class="card bg-light border mb-4">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3"><i class="mdi mdi-search-web me-2"></i>SEO Settings</h6>
                                <div class="mb-3">
                                    <label class="form-label small text-muted">Meta Title</label>
                                    <input type="text" name="meta_title"
                                        value="{{ old('meta_title', $service->meta_title ?? '') }}" class="form-control"
                                        placeholder="SEO Title...">
                                </div>
                                <div class="mb-0">
                                    <label class="form-label small text-muted">Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="3"
                                        placeholder="Brief summary for search engines...">{{ old('meta_description', $service->meta_description ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="mdi mdi-check me-1"></i>
                                {{ isset($service) ? 'Update Service' : 'Create Service' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const serviceNameInput = document.getElementById('service-name');
            const serviceSlugInput = document.getElementById('service-slug');
            const generateServiceSlugBtn = document.getElementById('generate-service-slug');
            
            function generateSlug(text) {
                return text
                    .toString()
                    .toLowerCase()
                    .trim()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+/, '')
                    .replace(/-+$/, '');
            }
            
            if (serviceNameInput && serviceSlugInput) {
                serviceNameInput.addEventListener('input', function() {
                    if (!serviceSlugInput.value || serviceSlugInput.dataset.autoGenerated === 'true') {
                        serviceSlugInput.value = generateSlug(this.value);
                        serviceSlugInput.dataset.autoGenerated = 'true';
                    }
                });
                
                if (generateServiceSlugBtn) {
                    generateServiceSlugBtn.addEventListener('click', function() {
                        if (serviceNameInput.value) {
                            serviceSlugInput.value = generateSlug(serviceNameInput.value);
                            serviceSlugInput.dataset.autoGenerated = 'true';
                        }
                    });
                }
                
                serviceSlugInput.addEventListener('input', function() {
                    this.dataset.autoGenerated = 'false';
                });
            }

            // Handle advantages add/remove
            const addAdvantageBtn = document.getElementById('add-advantage');
            const advantagesContainer = document.getElementById('advantages-container');
            
            if (addAdvantageBtn && advantagesContainer) {
                addAdvantageBtn.addEventListener('click', function() {
                    const advantageCount = advantagesContainer.querySelectorAll('.advantage-item').length;
                    if (advantageCount >= 6) {
                        alert('Maksimal 6 keunggulan');
                        return;
                    }
                    
                    const newItem = document.createElement('div');
                    newItem.className = 'mb-2 advantage-item';
                    newItem.innerHTML = `
                        <div class="input-group">
                            <span class="input-group-text"><i class="mdi mdi-check-circle text-success"></i></span>
                            <input type="text" name="advantages[]" class="form-control" 
                                placeholder="Masukkan keunggulan layanan...">
                            <button type="button" class="btn btn-outline-danger remove-advantage">
                                <i class="mdi mdi-delete"></i>
                            </button>
                        </div>
                    `;
                    advantagesContainer.appendChild(newItem);
                    
                    // Attach remove event
                    newItem.querySelector('.remove-advantage').addEventListener('click', function() {
                        newItem.remove();
                    });
                });

                // Handle remove buttons
                advantagesContainer.addEventListener('click', function(e) {
                    if (e.target.closest('.remove-advantage')) {
                        e.target.closest('.advantage-item').remove();
                    }
                });
            }
        });
    </script>
    @endpush
@endsection