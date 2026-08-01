@extends('layouts.app')

@section('title', 'Page Content Management')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">Page Content Management</h1>
                <p class="text-muted mb-0">Kelola konten untuk halaman-halaman utama website</p>
            </div>
        </div>

        <div class="row g-4">
            @foreach($pages as $key => $page)
            <div class="col-xl-4 col-md-6">
                <div class="card ag-card h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box me-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.1); border-radius: 12px;">
                                <i class="mdi {{ $page['icon'] }}" style="font-size: 32px; color: #fff;"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 text-white">{{ $page['name'] }}</h5>
                                <small class="text-muted">/{{ $page['slug'] }}</small>
                            </div>
                        </div>
                        <p class="text-muted mb-3">Kelola section dan konten untuk halaman {{ strtolower($page['name']) }}</p>
                        <a href="{{ route('admin.page-content.edit', $key) }}" class="btn btn-primary btn-sm w-100">
                            <i class="mdi mdi-pencil me-1"></i> Edit Content
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

