@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card ag-card">
                <div class="card-header">
                    <h5 class="mb-0">{{ isset($product) ? 'Edit Product' : 'Create New Product' }}</h5>
                </div>
                <div class="card-body p-4">
                    <form
                        action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($product)) @method('PUT') @endif

                        <div class="mb-4">
                            <label class="form-label fw-bold">Product Name</label>
                            <input type="text" name="name" id="product-name" value="{{ old('name', $product->name ?? '') }}"
                                class="form-control form-control-lg" placeholder="Enter product name..." required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">URL Slug</label>
                            <div class="input-group">
                                <span class="input-group-text">/product/</span>
                                <input type="text" name="slug" id="product-slug" value="{{ old('slug', $product->slug ?? '') }}"
                                    class="form-control" placeholder="auto-generated-from-name">
                                <button type="button" class="btn btn-outline-secondary" id="generate-product-slug" title="Generate from name">
                                    <i class="mdi mdi-refresh"></i>
                                </button>
                            </div>
                            <small class="text-muted">Leave empty to keep current slug. Click refresh icon to regenerate from name.</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                            <select name="category" class="form-control form-control-lg" required>
                                <option value="">-- Pilih Kategori --</option>
                                @php
                                    $categories = \App\Models\ProductCategory::where('is_active', true)->orderBy('order')->orderBy('name')->get();
                                @endphp
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->slug }}" {{ old('category', $product->category ?? '') == $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">
                                <a href="{{ route('admin.product-categories.index') }}" target="_blank">Kelola Kategori</a>
                            </small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Description</label>
                            <textarea id="summernote" class="summernote"
                                name="description">{{ old('description', $product->description ?? '') }}</textarea>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Price</label>
                                <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}"
                                    class="form-control" placeholder="0.00" step="0.01">
                                <small class="text-muted">Kosongkan jika harga "Hubungi Kami"</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Featured Image (Main Image)</label>
                                <div class="p-2 border rounded">
                                    <input type="file" name="image" class="form-control mb-2" id="mainImageInput">
                                    <p class="text-muted small mb-0">Recommended size: 800x800px</p>
                                    <div id="mainImagePreview" class="mt-2">
                                        @if(isset($product) && $product->image)
                                            <p class="small mb-1">Current Image:</p>
                                            <img src="{{ asset($product->image) }}" class="rounded shadow-sm"
                                                style="max-width: 150px;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Multiple Images Upload -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Additional Product Images</label>
                            <div class="p-3 border rounded bg-light">
                                <input type="file" name="images[]" class="form-control mb-3" id="productImagesInput" multiple accept="image/*">
                                <p class="text-muted small mb-3">You can select multiple images at once. Recommended size: 800x800px</p>
                                
                                <!-- Existing Images -->
                                <div id="existingImagesContainer" class="mb-3">
                                    @if(isset($product) && $product->images && count($product->images) > 0)
                                        <p class="small fw-bold mb-2">Current Additional Images:</p>
                                        <div class="row g-2" id="existingImagesList">
                                            @foreach($product->images as $index => $img)
                                                <div class="col-md-3 col-sm-4 col-6 existing-image-item" data-image="{{ $img }}">
                                                    <div class="position-relative">
                                                        <img src="{{ asset($img) }}" class="img-thumbnail w-100" style="height: 120px; object-fit: cover;">
                                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 remove-existing-image" data-image="{{ $img }}">
                                                            <i class="mdi mdi-close"></i>
                                                        </button>
                                                        <input type="hidden" name="existing_images[]" value="{{ $img }}">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- New Images Preview -->
                                <div id="newImagesPreview" class="row g-2"></div>
                            </div>
                        </div>

                        <div class="card bg-light border mb-4">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3"><i class="mdi mdi-search-web me-2"></i>SEO Settings</h6>
                                <div class="mb-3">
                                    <label class="form-label small text-muted">Meta Title</label>
                                    <input type="text" name="meta_title"
                                        value="{{ old('meta_title', $product->meta_title ?? '') }}" class="form-control"
                                        placeholder="SEO Title...">
                                </div>
                                <div class="mb-0">
                                    <label class="form-label small text-muted">Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="3"
                                        placeholder="Brief summary for search engines...">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="mdi mdi-check me-1"></i>
                                {{ isset($product) ? 'Update Product' : 'Create Product' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Main image preview
        document.getElementById('mainImageInput')?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('mainImagePreview');
                    preview.innerHTML = '<p class="small mb-1">Preview:</p><img src="' + e.target.result + '" class="rounded shadow-sm" style="max-width: 150px;">';
                };
                reader.readAsDataURL(file);
            }
        });

        // Multiple images preview
        document.getElementById('productImagesInput')?.addEventListener('change', function(e) {
            const files = e.target.files;
            const preview = document.getElementById('newImagesPreview');
            preview.innerHTML = '';
            
            if (files.length > 0) {
                const label = document.createElement('p');
                label.className = 'small fw-bold mb-2 w-100';
                label.textContent = 'New Images Preview:';
                preview.appendChild(label);
            }

            Array.from(files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-md-3 col-sm-4 col-6';
                        col.innerHTML = `
                            <div class="position-relative">
                                <img src="${e.target.result}" class="img-thumbnail w-100" style="height: 120px; object-fit: cover;">
                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 remove-new-image" data-index="${index}">
                                    <i class="mdi mdi-close"></i>
                                </button>
                            </div>
                        `;
                        preview.appendChild(col);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        // Remove existing image
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-existing-image')) {
                const button = e.target.closest('.remove-existing-image');
                const imageItem = button.closest('.existing-image-item');
                const hiddenInput = imageItem.querySelector('input[type="hidden"]');
                hiddenInput.remove();
                imageItem.remove();
            }

            // Remove new image
            if (e.target.closest('.remove-new-image')) {
                const button = e.target.closest('.remove-new-image');
                const index = parseInt(button.dataset.index);
                const input = document.getElementById('productImagesInput');
                const dt = new DataTransfer();
                
                Array.from(input.files).forEach((file, i) => {
                    if (i !== index) {
                        dt.items.add(file);
                    }
                });
                
                input.files = dt.files;
                button.closest('.col-md-3').remove();
                
                // Trigger change to update preview
                input.dispatchEvent(new Event('change'));
            }
        });

        // Slug generation
        const productNameInput = document.getElementById('product-name');
        const productSlugInput = document.getElementById('product-slug');
        const generateProductSlugBtn = document.getElementById('generate-product-slug');
        
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
        
        if (productNameInput && productSlugInput && generateProductSlugBtn) {
            generateProductSlugBtn.addEventListener('click', function() {
                if (productNameInput.value) {
                    productSlugInput.value = generateSlug(productNameInput.value);
                }
            });
        }
    </script>
    @endpush
@endsection