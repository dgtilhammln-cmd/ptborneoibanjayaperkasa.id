@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Edit Page: {{ $page->title }}</h1>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
                <i class="mdi mdi-arrow-left"></i> Back
            </a>
        </div>

        <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="ag-card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Page Content</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title', $page->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <div class="input-group">
                                    <span class="input-group-text">/page/</span>
                                    <input type="text" name="slug" id="slug"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        value="{{ old('slug', $page->slug) }}">
                                    <button type="button" class="btn btn-outline-secondary" id="generateSlug" title="Generate from title">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                </div>
                                <small class="text-muted">Click refresh icon to regenerate from title.</small>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea name="content" id="content" class="form-control summernote"
                                    rows="15">{{ old('content', $page->content) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Sections Builder -->
                    <div class="ag-card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Page Sections</h5>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="addSection">
                                <i class="mdi mdi-plus"></i> Add Section
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="sectionsContainer">
                                @php $sections = $page->sections ?? []; @endphp
                                @if(count($sections) === 0)
                                    <p class="text-muted text-center py-3" id="noSectionsMsg">No sections added yet. Click "Add
                                        Section" to create one.</p>
                                @else
                                    <p class="text-muted text-center py-3" id="noSectionsMsg" style="display:none;">No sections
                                        added yet.</p>
                                    @foreach($sections as $index => $section)
                                        <div class="section-item border rounded p-3 mb-3">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <h6 class="mb-0">Section {{ $loop->iteration }}</h6>
                                                <button type="button" class="btn btn-sm btn-outline-danger remove-section">
                                                    <i class="mdi mdi-close"></i>
                                                </button>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">Section Title</label>
                                                <input type="text" class="form-control section-title"
                                                    value="{{ $section['title'] ?? '' }}">
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">Section Type</label>
                                                <select class="form-select section-type">
                                                    <option value="text" {{ ($section['type'] ?? '') === 'text' ? 'selected' : '' }}>
                                                        Text Content</option>
                                                    <option value="image_text" {{ ($section['type'] ?? '') === 'image_text' ? 'selected' : '' }}>Image + Text</option>
                                                    <option value="cta" {{ ($section['type'] ?? '') === 'cta' ? 'selected' : '' }}>
                                                        Call to Action</option>
                                                    <option value="features" {{ ($section['type'] ?? '') === 'features' ? 'selected' : '' }}>Features Grid</option>
                                                </select>
                                            </div>
                                            <div class="mb-0">
                                                <label class="form-label">Content</label>
                                                <textarea class="form-control section-content"
                                                    rows="3">{{ $section['content'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <input type="hidden" name="sections" id="sectionsData" value="{{ json_encode($sections) }}">
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Publish Settings -->
                    <div class="ag-card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Publish</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-check mb-3">
                                <input type="checkbox" name="is_published" id="is_published" class="form-check-input"
                                    value="1" {{ old('is_published', $page->is_published) ? 'checked' : '' }}>
                                <label for="is_published" class="form-check-label">Published</label>
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" name="show_in_menu" id="show_in_menu" class="form-check-input"
                                    value="1" {{ old('show_in_menu', $page->show_in_menu) ? 'checked' : '' }}>
                                <label for="show_in_menu" class="form-check-label">Show in Menu</label>
                            </div>
                            <div class="mb-3">
                                <label for="order" class="form-label">Order</label>
                                <input type="number" name="order" id="order" class="form-control"
                                    value="{{ old('order', $page->order) }}">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="mdi mdi-content-save"></i> Update Page
                            </button>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="ag-card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Featured Image</h5>
                        </div>
                        <div class="card-body">
                            @if($page->featured_image)
                                <img src="{{ $page->featured_image }}" alt="Featured" class="img-thumbnail mb-2 w-100">
                            @endif
                            <input type="file" name="featured_image" id="featured_image" class="form-control"
                                accept="image/*">
                            <small class="text-muted">Will be converted to WebP</small>
                        </div>
                    </div>

                    <!-- SEO Settings -->
                    <div class="ag-card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">SEO Settings</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="meta_title" class="form-label">Meta Title</label>
                                <input type="text" name="meta_title" id="meta_title" class="form-control"
                                    value="{{ old('meta_title', $page->meta_title) }}" maxlength="60">
                                <small class="text-muted">Leave empty to use page title</small>
                            </div>
                            <div class="mb-3">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <textarea name="meta_description" id="meta_description" class="form-control" rows="3"
                                    maxlength="160">{{ old('meta_description', $page->meta_description) }}</textarea>
                                <small class="text-muted">Recommended: 150-160 characters</small>
                            </div>
                            <div class="mb-3">
                                <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"
                                    value="{{ old('meta_keywords', $page->meta_keywords) }}">
                                <small class="text-muted">Comma separated</small>
                            </div>
                            <div class="mb-3">
                                <label for="og_image" class="form-label">Open Graph Image</label>
                                @if($page->og_image)
                                    <img src="{{ $page->og_image }}" alt="OG Image" class="img-thumbnail mb-2 w-100">
                                @endif
                                <input type="file" name="og_image" id="og_image" class="form-control" accept="image/*">
                                <small class="text-muted">Recommended: 1200x630px</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Section Template -->
    <template id="sectionTemplate">
        <div class="section-item border rounded p-3 mb-3">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <h6 class="mb-0">Section</h6>
                <button type="button" class="btn btn-sm btn-outline-danger remove-section">
                    <i class="mdi mdi-close"></i>
                </button>
            </div>
            <div class="mb-2">
                <label class="form-label">Section Title</label>
                <input type="text" class="form-control section-title" placeholder="Section title">
            </div>
            <div class="mb-2">
                <label class="form-label">Section Type</label>
                <select class="form-select section-type">
                    <option value="text">Text Content</option>
                    <option value="image_text">Image + Text</option>
                    <option value="cta">Call to Action</option>
                    <option value="features">Features Grid</option>
                </select>
            </div>
            <div class="mb-0">
                <label class="form-label">Content</label>
                <textarea class="form-control section-content" rows="3" placeholder="Section content..."></textarea>
            </div>
        </div>
    </template>

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const container = document.getElementById('sectionsContainer');
                const addBtn = document.getElementById('addSection');
                const template = document.getElementById('sectionTemplate');
                const noMsg = document.getElementById('noSectionsMsg');
                const dataInput = document.getElementById('sectionsData');
                const titleInput = document.getElementById('title');
                const slugInput = document.getElementById('slug');
                const generateSlugBtn = document.getElementById('generateSlug');
                
                // Auto-generate slug from title
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
                
                // Manual slug generation button
                generateSlugBtn.addEventListener('click', function() {
                    if (titleInput.value) {
                        slugInput.value = generateSlug(titleInput.value);
                    }
                });

                function updateSectionsData() {
                    const sections = [];
                    container.querySelectorAll('.section-item').forEach(item => {
                        sections.push({
                            title: item.querySelector('.section-title').value,
                            type: item.querySelector('.section-type').value,
                            content: item.querySelector('.section-content').value
                        });
                    });
                    dataInput.value = JSON.stringify(sections);
                }

                // Initialize existing sections
                container.querySelectorAll('.section-item input, .section-item select, .section-item textarea')
                    .forEach(el => el.addEventListener('change', updateSectionsData));
                container.querySelectorAll('.remove-section').forEach(btn => {
                    btn.addEventListener('click', function () {
                        this.closest('.section-item').remove();
                        updateSectionsData();
                        if (container.querySelectorAll('.section-item').length === 0) {
                            noMsg.style.display = 'block';
                        }
                    });
                });

                addBtn.addEventListener('click', function () {
                    noMsg.style.display = 'none';
                    const clone = template.content.cloneNode(true);
                    container.appendChild(clone);

                    container.querySelectorAll('.section-item:last-child input, .section-item:last-child select, .section-item:last-child textarea')
                        .forEach(el => el.addEventListener('change', updateSectionsData));

                    container.querySelector('.section-item:last-child .remove-section').addEventListener('click', function () {
                        this.closest('.section-item').remove();
                        updateSectionsData();
                        if (container.querySelectorAll('.section-item').length === 0) {
                            noMsg.style.display = 'block';
                        }
                    });
                });

                // Summernote is initialized globally in layouts/app.blade.php
                // No need to re-initialize here to avoid conflicts
            });
        </script>
    @endpush
@endsection
