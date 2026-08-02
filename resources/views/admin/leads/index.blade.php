@extends('layouts.app')

@section('title', 'Leads Tracking')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Leads Tracking </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Leads Tracking</li>
            </ol>
        </nav>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title mb-0">Daftar Leads Masuk</h4>
                        <form action="{{ route('admin.leads.index') }}" method="GET" class="d-flex gap-2">
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Baru (New)</option>
                                <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>Telah Dihubungi (Contacted)</option>
                                <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Selesai (Closed)</option>
                            </select>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama / Perusahaan</th>
                                    <th>No. WhatsApp</th>
                                    <th>Kebutuhan</th>
                                    <th>Tracking UTM & Sumber</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($leads as $lead)
                                    <tr>
                                        <td>{{ $lead->created_at->format('d M Y, H:i') }}</td>
                                        <td>
                                            <div class="fw-bold">{{ $lead->name }}</div>
                                            @if($lead->company_location)
                                                <small class="text-muted"><i class="mdi mdi-map-marker-outline"></i> {{ $lead->company_location }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->whatsapp_number) }}" target="_blank" class="text-decoration-none text-success">
                                                <i class="mdi mdi-whatsapp"></i> {{ $lead->whatsapp_number }}
                                            </a>
                                        </td>
                                        <td style="max-width: 250px; white-space: normal;">
                                            {{ $lead->requirements ?? '-' }}
                                        </td>
                                        <td>
                                            @if($lead->utm_source || $lead->utm_medium || $lead->utm_campaign)
                                                <div class="small">
                                                    @if($lead->utm_source) <span class="badge bg-secondary mb-1">Source: {{ $lead->utm_source }}</span> @endif
                                                    @if($lead->utm_medium) <span class="badge bg-secondary mb-1">Medium: {{ $lead->utm_medium }}</span> @endif
                                                    @if($lead->utm_campaign) <span class="badge bg-secondary mb-1">Campaign: {{ $lead->utm_campaign }}</span> @endif
                                                </div>
                                            @endif
                                            @if($lead->source_url)
                                                <small class="text-muted d-block mt-1">
                                                    <i class="mdi mdi-link-variant"></i> <a href="{{ $lead->source_url }}" target="_blank" class="text-muted">Lihat Halaman</a>
                                                </small>
                                            @endif
                                            @if(!$lead->utm_source && !$lead->source_url)
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.leads.update_status', $lead->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-select form-select-sm {{ $lead->status == 'new' ? 'border-primary text-primary' : ($lead->status == 'contacted' ? 'border-warning text-warning' : 'border-success text-success') }}" onchange="this.form.submit()">
                                                    <option value="new" {{ $lead->status == 'new' ? 'selected' : '' }}>New</option>
                                                    <option value="contacted" {{ $lead->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                                                    <option value="closed" {{ $lead->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data lead ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-icon text-danger" title="Hapus Lead"><i class="mdi mdi-delete-outline"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">Belum ada data leads yang masuk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $leads->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
