@extends('layouts.app')

@section('title', 'Edit Page Content: ' . ucwords($pageKey))

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-2">Edit {{ ucwords($pageKey) }} Page Content</h1>
                    <p class="text-muted mb-0">Kelola konten dan section untuk halaman {{ $pageKey }}</p>
                </div>
                <a href="{{ route('admin.page-content.index') }}" class="btn btn-secondary">
                    <i class="mdi mdi-arrow-left me-1"></i> Back
                </a>
            </div>

            @php
                $sections = $page->sections ?? [];
            @endphp

            <form action="{{ route('admin.page-content.update', $pageKey) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if(!in_array($pageKey, ['services', 'products', 'blog', 'contact']))
                <!-- Breadcrumb Section (Only for pages that don't handle it in sections) -->
                <div class="card ag-card mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title mb-0">Breadcrumb Section</h5>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="breadcrumb[is_active]" value="1" id="breadcrumb_active" {{ (($sections['breadcrumb']['is_active'] ?? true)) ? 'checked' : '' }}>
                                <label class="form-check-label text-white" for="breadcrumb_active">Aktif</label>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-white">Title</label>
                                <input type="text" name="breadcrumb[title]" 
                                    value="{{ $sections['breadcrumb']['title'] ?? '' }}" 
                                    class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white">Background Image</label>
                                <input type="file" name="breadcrumb[background_image]" class="form-control" accept="image/*">
                                @if(!empty($sections['breadcrumb']['background_image']))
                                <div class="mt-2">
                                    <img src="{{ asset($sections['breadcrumb']['background_image']) }}" class="img-thumbnail" style="max-width: 200px;">
                                    <input type="hidden" name="breadcrumb[background_image_existing]" value="{{ $sections['breadcrumb']['background_image'] }}">
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($pageKey == 'about')
                    @include('admin.page-content.sections.about')
                @elseif($pageKey == 'contact')
                    @include('admin.page-content.sections.contact')
                @elseif($pageKey == 'services')
                    @include('admin.page-content.sections.services')
                @elseif($pageKey == 'products')
                    @include('admin.page-content.sections.products')
                @elseif($pageKey == 'blog')
                    @include('admin.page-content.sections.blog')
                @endif

                <div class="card ag-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-0">SEO Settings</h5>
                                <p class="text-muted mb-0 small">Optional: Configure SEO metadata for this page</p>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label text-white">Meta Title</label>
                                <input type="text" name="meta_title" value="{{ $page->meta_title ?? '' }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-white">Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="2">{{ $page->meta_description ?? '' }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-white">Meta Keywords</label>
                                <input type="text" name="meta_keywords" value="{{ $page->meta_keywords ?? '' }}" class="form-control" placeholder="keyword1, keyword2, keyword3">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-content-save me-1"></i> Save Page Content
                    </button>
                    <a href="{{ route('admin.page-content.index') }}" class="btn btn-secondary">
                        <i class="mdi mdi-arrow-left me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

