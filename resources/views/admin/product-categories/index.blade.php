@extends('layouts.app')

@section('content')
    @section('title', 'Manage Product Categories')
    @php
        use Illuminate\Support\Str;
    @endphp

    <div class="card ag-card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title mb-0">Product Categories</h5>
                <a href="{{ route('admin.product-categories.create') }}" class="btn btn-primary btn-sm">
                    <i class="mdi mdi-plus me-1"></i> Add New Category
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Products</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->order }}</td>
                            <td>
                                <strong>{{ $category->name }}</strong>
                                @if($category->description)
                                    <br><small class="text-muted">{{ Str::limit($category->description, 50) }}</small>
                                @endif
                            </td>
                            <td><code>{{ $category->slug }}</code></td>
                            <td>
                                <span class="badge bg-info">{{ $category->products()->count() }} produk</span>
                            </td>
                            <td>
                                @if($category->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.product-categories.edit', $category) }}" class="btn btn-sm btn-icon text-primary">
                                    <i class="mdi mdi-pencil-outline"></i>
                                </a>
                                <form action="{{ route('admin.product-categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Produk yang menggunakan kategori ini harus dipindahkan terlebih dahulu.');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-icon text-danger">
                                        <i class="mdi mdi-delete-outline"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <p class="text-muted mb-0">Belum ada kategori produk. <a href="{{ route('admin.product-categories.create') }}">Buat kategori pertama</a></p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
