@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card ag-card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Product Category</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.product-categories.update', $productCategory) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label fw-bold">Category Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $productCategory->name) }}"
                                class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                placeholder="Enter category name..." required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Slug</label>
                            <input type="text" value="{{ $productCategory->slug }}" class="form-control" disabled>
                            <small class="text-muted">Slug akan otomatis diupdate jika nama kategori diubah</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" class="form-control" rows="3"
                                placeholder="Enter category description (optional)...">{{ old('description', $productCategory->description) }}</textarea>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Order</label>
                                <input type="number" name="order" value="{{ old('order', $productCategory->order) }}"
                                    class="form-control" placeholder="0" min="0">
                                <small class="text-muted">Urutan tampil kategori (angka lebih kecil muncul lebih dulu)</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Status</label>
                                <div class="form-check form-switch mt-2">
                                    {{-- hidden supaya kalau unchecked tetap kirim 0 --}}
                                    <input type="hidden" name="is_active" value="0">
                            
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                                        {{ old('is_active', $productCategory->is_active) ? 'checked' : '' }}>
                            
                                    <label class="form-check-label" for="is_active">
                                        Active
                                    </label>
                                </div>
                                <small class="text-muted">Kategori aktif akan muncul di form produk</small>
                            </div>

                        </div>

                        <div class="alert alert-info">
                            <strong>Info:</strong> Kategori ini digunakan oleh <strong>{{ $productCategory->products()->count() }}</strong> produk.
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                            <a href="{{ route('admin.product-categories.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="mdi mdi-check me-1"></i>
                                Update Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
