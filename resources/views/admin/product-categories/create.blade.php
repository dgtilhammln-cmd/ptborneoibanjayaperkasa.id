@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card ag-card">
                <div class="card-header">
                    <h5 class="mb-0">Create New Product Category</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.product-categories.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-bold">Category Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                placeholder="Enter category name..." required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" class="form-control" rows="3"
                                placeholder="Enter category description (optional)...">{{ old('description') }}</textarea>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Order</label>
                                <input type="number" name="order" value="{{ old('order', 0) }}"
                                    class="form-control" placeholder="0" min="0">
                                <small class="text-muted">Urutan tampil kategori (angka lebih kecil muncul lebih dulu)</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" 
                                        {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active
                                    </label>
                                </div>
                                <small class="text-muted">Kategori aktif akan muncul di form produk</small>
                            </div>
                        </div>
                        <input type="hidden" name="is_active" value="0">
<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
    {{ old('is_active', 1) ? 'checked' : '' }}>


                        <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                            <a href="{{ route('admin.product-categories.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="mdi mdi-check me-1"></i>
                                Create Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
