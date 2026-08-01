@extends('layouts.app')

@section('title', 'Home Content Management')

@section('content')
    <div class="card ag-card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title mb-0">Home Page Sections</h5>
            </div>

            <div class="row g-3">
                @php
                    $sections = [
                        'banner_slider' => ['name' => 'Banner / Hero Slider', 'icon' => 'mdi-image-multiple-outline', 'description' => 'Kelola slider banner utama (4 slides)'],
                        'about' => ['name' => 'About Section', 'icon' => 'mdi-information-outline', 'description' => 'Kelola section tentang kami'],
                        'services' => ['name' => 'Services Section', 'icon' => 'mdi-tools', 'description' => 'Kelola section layanan dengan items'],
                        'products' => ['name' => 'Products Section', 'icon' => 'mdi-package-variant', 'description' => 'Kelola section produk dengan items'],
                        'projects' => ['name' => 'Projects Section', 'icon' => 'mdi-folder-image', 'description' => 'Kelola section project/portfolio'],
                        'work_process' => ['name' => 'Work Process Section', 'icon' => 'mdi-cog-outline', 'description' => 'Kelola section cara kami bekerja'],
                        'why_choose_us' => ['name' => 'Why Choose Us', 'icon' => 'mdi-star-circle-outline', 'description' => 'Kelola section mengapa pilih kami'],
                        'testimonials' => ['name' => 'Testimonials', 'icon' => 'mdi-account-group-outline', 'description' => 'Kelola section testimoni'],
                        'blog' => ['name' => 'Blog Section', 'icon' => 'mdi-book-open-page-variant', 'description' => 'Kelola section blog']
                    ];
                @endphp

                @foreach($sections as $key => $sectionInfo)
                    @php
                        $dbSection = \App\Models\HomeSection::where('key', $key)->first();
                        $isActive = $dbSection ? $dbSection->is_active : false;
                    @endphp
                    <div class="col-md-6 col-lg-4">
                        <div class="card ag-glass border-0 h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="me-3">
                                        <i class="mdi {{ $sectionInfo['icon'] }} fs-1 text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 text-white">{{ $sectionInfo['name'] }}</h6>
                                        <p class="text-muted small mb-0">{{ $sectionInfo['description'] }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge {{ $isActive ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $isActive ? 'Active' : 'Inactive' }}
                                    </span>
                                    <a href="{{ route('admin.home-content.edit', $key) }}" class="btn btn-sm btn-primary">
                                        <i class="mdi mdi-pencil me-1"></i> Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

