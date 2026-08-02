@extends('layouts.app')

@section('title', 'Leads Tracking')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --bg-page: #f0f4ff;
        --bg-card: #ffffff;
        --accent-blue: #3b82f6;
        --accent-blue-dark: #1d4ed8;
        --accent-blue-light: #eff6ff;
        --accent-blue-mid: #bfdbfe;
        --accent-green: #10b981;
        --accent-green-light: #ecfdf5;
        --accent-amber: #f59e0b;
        --accent-amber-light: #fffbeb;
        --accent-red: #ef4444;
        --accent-red-light: #fef2f2;
        --accent-violet: #7c3aed;
        --accent-violet-light: #ede9fe;
        --text-primary: #0f172a;
        --text-secondary: #64748b;
        --text-muted: #94a3b8;
        --border: #e2e8f0;
        --shadow-sm: 0 1px 3px rgba(59,130,246,0.06), 0 1px 2px rgba(0,0,0,0.04);
        --shadow-md: 0 4px 16px rgba(59,130,246,0.10), 0 2px 4px rgba(0,0,0,0.04);
        --shadow-lg: 0 8px 32px rgba(59,130,246,0.14), 0 4px 8px rgba(0,0,0,0.06);
        --radius-sm: 10px;
        --radius-md: 14px;
        --radius-lg: 20px;
    }

    *, *::before, *::after { box-sizing: border-box; }

    .leads-wrap {
        background: var(--bg-page);
        min-height: 100vh;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--text-primary);
        padding: 24px 20px 48px;
    }

    /* ── PAGE HEADER ── */
    .page-header {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-sm);
        padding: 24px 28px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }
    .page-header-left h1 {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0 0 4px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .page-header-left h1 .h-icon {
        width: 36px; height: 36px;
        background: linear-gradient(135deg, #3b82f6, #7c3aed);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: #fff;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .page-header-left p {
        font-size: 0.78rem;
        color: var(--text-muted);
        margin: 0;
    }
    .breadcrumb-strip {
        display: flex; align-items: center; gap: 6px;
        font-size: 0.72rem; color: var(--text-muted);
    }
    .breadcrumb-strip a { color: var(--text-muted); text-decoration: none; }
    .breadcrumb-strip a:hover { color: var(--accent-blue); }
    .breadcrumb-strip .sep { color: var(--border); }
    .breadcrumb-strip .cur { color: var(--accent-blue); font-weight: 600; }

    /* ── STAT CARDS ── */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 20px;
    }
    .stat-card {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-sm);
        padding: 20px 22px;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .stat-card:hover { box-shadow: var(--shadow-md); transform: translateY(-2px); }
    .stat-icon {
        width: 48px; height: 48px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    .icon-blue   { background: var(--accent-blue-light);   color: var(--accent-blue); }
    .icon-green  { background: var(--accent-green-light);  color: var(--accent-green); }
    .icon-amber  { background: var(--accent-amber-light);  color: var(--accent-amber); }
    .icon-violet { background: var(--accent-violet-light); color: var(--accent-violet); }
    .stat-val {
        font-size: 2rem; font-weight: 800; line-height: 1;
        color: var(--text-primary);
    }
    .stat-label {
        font-size: 0.7rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.8px; color: var(--text-muted);
        margin-top: 4px;
    }

    /* ── MAIN CARD ── */
    .main-card {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }
    .card-toolbar {
        padding: 18px 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .card-toolbar-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .card-toolbar-title i { color: var(--accent-blue); }

    /* Filter select */
    .filter-select {
        padding: 8px 14px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.78rem;
        font-weight: 600;
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        background: var(--bg-page);
        color: var(--text-primary);
        cursor: pointer;
        outline: none;
        transition: border-color 0.2s;
    }
    .filter-select:focus { border-color: var(--accent-blue); }

    /* ── TABLE ── */
    .leads-table { width: 100%; border-collapse: collapse; }
    .leads-table thead th {
        background: var(--bg-page);
        padding: 12px 20px;
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: var(--text-muted);
        text-align: left;
        border-bottom: 1px solid var(--border);
    }
    .leads-table tbody tr {
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.15s;
    }
    .leads-table tbody tr:hover { background: var(--accent-blue-light); }
    .leads-table tbody tr:last-child { border-bottom: none; }
    .leads-table tbody td {
        padding: 14px 20px;
        font-size: 0.82rem;
        vertical-align: middle;
    }

    /* Name cell */
    .name-main { font-weight: 700; color: var(--text-primary); margin-bottom: 2px; }
    .name-sub { font-size: 0.7rem; color: var(--text-muted); }

    /* WA link */
    .wa-link {
        display: inline-flex; align-items: center; gap: 6px;
        color: var(--accent-green);
        font-weight: 600;
        text-decoration: none;
        padding: 5px 10px;
        background: var(--accent-green-light);
        border-radius: 8px;
        font-size: 0.78rem;
        transition: all 0.2s;
    }
    .wa-link:hover {
        background: var(--accent-green);
        color: #fff;
    }

    /* UTM badges */
    .utm-badge {
        display: inline-flex; align-items: center;
        font-size: 0.65rem; font-weight: 700;
        padding: 3px 8px; border-radius: 6px;
        margin: 2px 2px 2px 0;
        background: var(--accent-blue-light);
        color: var(--accent-blue-dark);
        border: 1px solid var(--accent-blue-mid);
    }

    /* Status select */
    .status-select {
        padding: 5px 10px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.73rem;
        font-weight: 700;
        border-radius: 8px;
        cursor: pointer;
        outline: none;
        border: 1.5px solid transparent;
        transition: all 0.2s;
    }
    .status-select.s-new       { background: var(--accent-blue-light);   color: var(--accent-blue-dark);  border-color: var(--accent-blue-mid); }
    .status-select.s-contacted { background: var(--accent-amber-light);  color: #92400e; border-color: #fcd34d; }
    .status-select.s-closed    { background: var(--accent-green-light);  color: #065f46; border-color: #6ee7b7; }

    /* Delete button */
    .btn-del {
        width: 32px; height: 32px;
        border: 1.5px solid var(--border);
        background: var(--bg-page);
        border-radius: 8px;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        color: var(--text-muted);
        font-size: 1rem;
        transition: all 0.2s;
    }
    .btn-del:hover { background: var(--accent-red-light); border-color: #fca5a5; color: var(--accent-red); }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-muted);
    }
    .empty-state i { font-size: 3rem; display: block; margin-bottom: 14px; }
    .empty-state p { font-size: 0.9rem; font-weight: 600; }

    /* Pagination */
    .pagination-wrap { padding: 16px 24px; border-top: 1px solid var(--border); }

    /* Alert success */
    .alert-success-lux {
        background: var(--accent-green-light);
        border: 1.5px solid #a7f3d0;
        border-radius: var(--radius-md);
        color: #065f46;
        font-size: 0.82rem;
        font-weight: 600;
        padding: 14px 18px;
        margin-bottom: 16px;
        display: flex; align-items: center; gap: 8px;
    }

    /* Mobile */
    @media (max-width: 900px) {
        .stats-grid { grid-template-columns: 1fr 1fr; }
        .leads-wrap { padding: 16px 12px 40px; }
    }
    @media (max-width: 576px) {
        .stats-grid { grid-template-columns: 1fr 1fr; }
        .leads-table thead { display: none; }
        .leads-table tbody td { display: block; padding: 8px 16px; }
        .leads-table tbody td::before {
            content: attr(data-label);
            font-size: 0.65rem; font-weight: 700; text-transform: uppercase;
            color: var(--text-muted); display: block; margin-bottom: 3px;
        }
    }
</style>

<div class="leads-wrap">

    @if(session('success'))
        <div class="alert-success-lux">
            <i class="mdi mdi-check-circle-outline"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-left">
            <div class="breadcrumb-strip mb-1">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <span class="sep">/</span>
                <span class="cur">Leads Tracking</span>
            </div>
            <h1>
                <span class="h-icon"><i class="mdi mdi-account-star-outline"></i></span>
                Leads Tracking
            </h1>
            <p>Kelola semua prospek yang masuk melalui website</p>
        </div>
        <form action="{{ route('admin.leads.index') }}" method="GET">
            <select name="status" class="filter-select" onchange="this.form.submit()">
                <option value="">✦ Semua Status</option>
                <option value="new"       {{ request('status') == 'new'       ? 'selected' : '' }}>🔵 Baru (New)</option>
                <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>🟡 Dihubungi</option>
                <option value="closed"    {{ request('status') == 'closed'    ? 'selected' : '' }}>🟢 Selesai (Closed)</option>
            </select>
        </form>
    </div>

    {{-- Stat Cards --}}
    @php
        $allLeads       = \App\Models\Lead::count();
        $newLeadsCount  = \App\Models\Lead::where('status','new')->count();
        $contacted      = \App\Models\Lead::where('status','contacted')->count();
        $closed         = \App\Models\Lead::where('status','closed')->count();
    @endphp
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon icon-blue"><i class="mdi mdi-account-star-outline"></i></div>
            <div>
                <div class="stat-val">{{ $allLeads }}</div>
                <div class="stat-label">Total Leads</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-violet"><i class="mdi mdi-new-box"></i></div>
            <div>
                <div class="stat-val">{{ $newLeadsCount }}</div>
                <div class="stat-label">Baru (New)</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-amber"><i class="mdi mdi-phone-forward-outline"></i></div>
            <div>
                <div class="stat-val">{{ $contacted }}</div>
                <div class="stat-label">Dihubungi</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-green"><i class="mdi mdi-check-circle-outline"></i></div>
            <div>
                <div class="stat-val">{{ $closed }}</div>
                <div class="stat-label">Selesai (Closed)</div>
            </div>
        </div>
    </div>

    {{-- Main Table --}}
    <div class="main-card">
        <div class="card-toolbar">
            <div class="card-toolbar-title">
                <i class="mdi mdi-table-account"></i>
                Daftar Leads Masuk
                <span style="background:var(--accent-blue-light);color:var(--accent-blue);font-size:.65rem;font-weight:700;padding:2px 9px;border-radius:20px;border:1px solid var(--accent-blue-mid);">
                    {{ $leads->total() }} Total
                </span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="leads-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama / Perusahaan</th>
                        <th>WhatsApp</th>
                        <th>Kebutuhan</th>
                        <th>Tracking (UTM & Sumber)</th>
                        <th>Status</th>
                        <th style="width:50px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leads as $lead)
                        <tr>
                            <td data-label="Tanggal">
                                <div style="font-weight:700;font-size:.8rem;">{{ $lead->created_at->format('d M Y') }}</div>
                                <div style="font-size:.68rem;color:var(--text-muted);">{{ $lead->created_at->format('H:i') }}</div>
                            </td>
                            <td data-label="Nama">
                                <div class="name-main">{{ $lead->name }}</div>
                                @if($lead->company_location)
                                    <div class="name-sub"><i class="mdi mdi-map-marker-outline"></i> {{ $lead->company_location }}</div>
                                @endif
                            </td>
                            <td data-label="WhatsApp">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->whatsapp_number) }}" target="_blank" class="wa-link">
                                    <i class="mdi mdi-whatsapp"></i>
                                    {{ $lead->whatsapp_number }}
                                </a>
                            </td>
                            <td data-label="Kebutuhan" style="max-width:220px;">
                                <div style="color:var(--text-secondary);font-size:.8rem;line-height:1.5;">
                                    {{ Str::limit($lead->requirements ?? '-', 80) }}
                                </div>
                            </td>
                            <td data-label="Tracking">
                                <div>
                                    @if($lead->utm_source)   <span class="utm-badge">Source: {{ $lead->utm_source }}</span> @endif
                                    @if($lead->utm_medium)   <span class="utm-badge" style="background:var(--accent-violet-light);color:var(--accent-violet);border-color:#c4b5fd;">Medium: {{ $lead->utm_medium }}</span> @endif
                                    @if($lead->utm_campaign) <span class="utm-badge" style="background:var(--accent-green-light);color:#065f46;border-color:#6ee7b7;">Campaign: {{ $lead->utm_campaign }}</span> @endif
                                    @if(!$lead->utm_source && !$lead->utm_medium && !$lead->utm_campaign)
                                        <span style="color:var(--text-muted);font-size:.75rem;">— Organik</span>
                                    @endif
                                </div>
                                @if($lead->source_url)
                                    <div style="margin-top:4px;">
                                        <a href="{{ $lead->source_url }}" target="_blank" style="font-size:.68rem;color:var(--text-muted);text-decoration:none;" title="{{ $lead->source_url }}">
                                            <i class="mdi mdi-link-variant"></i> {{ Str::limit(str_replace(['http://','https://'], '', $lead->source_url), 35) }}
                                        </a>
                                    </div>
                                @endif
                            </td>
                            <td data-label="Status">
                                <form action="{{ route('admin.leads.update_status', $lead->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status"
                                        class="status-select {{ $lead->status == 'new' ? 's-new' : ($lead->status == 'contacted' ? 's-contacted' : 's-closed') }}"
                                        onchange="this.form.submit()">
                                        <option value="new"       {{ $lead->status == 'new'       ? 'selected' : '' }}>New</option>
                                        <option value="contacted" {{ $lead->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                                        <option value="closed"    {{ $lead->status == 'closed'    ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Hapus lead ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-del" title="Hapus">
                                        <i class="mdi mdi-delete-outline"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="mdi mdi-account-search-outline"></i>
                                    <p>Belum ada data leads yang masuk</p>
                                    <span style="font-size:.78rem;">Leads akan muncul di sini setelah pengunjung mengisi form WhatsApp di website</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap">
            {{ $leads->links() }}
        </div>
    </div>

</div>
@endsection
