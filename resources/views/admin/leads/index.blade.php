@extends('layouts.app')

@section('title', 'Leads Tracking')

@section('content')
<style>
    .leads-container {
        background-color: #f4f6fb;
        min-height: 100vh;
        padding: 24px;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    /* ── HEADER BAR ── */
    .leads-header {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        padding: 24px 28px;
        margin-bottom: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }
    .leads-title-group h1 {
        font-size: 1.4rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 4px 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .leads-title-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #0066ff 0%, #0052cc 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 102, 255, 0.25);
    }
    .leads-title-group p {
        font-size: 0.82rem;
        color: #64748b;
        margin: 0;
    }

    /* ── STAT CARDS (Sesuai Desain Referensi) ── */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }
    .stat-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #eef2f6;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
        padding: 20px 24px;
        display: flex;
        align-items: center;
        gap: 18px;
        transition: all 0.25s ease;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
    }
    .stat-icon-wrap {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .icon-total { background: #eef4ff; color: #3b82f6; }
    .icon-new { background: #f3e8ff; color: #8b5cf6; }
    .icon-contacted { background: #fff8e6; color: #f59e0b; }
    .icon-closed { background: #e6f9f0; color: #10b981; }

    .stat-num {
        font-size: 2.1rem;
        font-weight: 800;
        line-height: 1.1;
        color: #0f172a;
        letter-spacing: -0.5px;
    }
    .stat-lbl {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #64748b;
        margin-top: 4px;
    }

    /* ── FILTER TOOLBAR ── */
    .filter-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        padding: 20px 24px;
        margin-bottom: 24px;
    }
    .filter-form {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
    }
    .filter-group {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .filter-label {
        font-size: 0.78rem;
        font-weight: 700;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .filter-input, .filter-select-box {
        padding: 9px 14px;
        font-size: 0.82rem;
        font-weight: 600;
        border: 1.5px solid #cbd5e1;
        border-radius: 12px;
        background: #ffffff;
        color: #0f172a;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .filter-input:focus, .filter-select-box:focus {
        border-color: #0066ff;
        box-shadow: 0 0 0 3px rgba(0, 102, 255, 0.1);
    }
    .custom-date-container {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .btn-filter-submit {
        background: #0066ff;
        color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 9px 20px;
        font-size: 0.82rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .btn-filter-submit:hover {
        background: #0052cc;
    }
    .btn-filter-reset {
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        padding: 9px 16px;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }
    .btn-filter-reset:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    /* ── TABLE CARD ── */
    .table-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        overflow: hidden;
    }
    .table-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .table-card-title {
        font-size: 1rem;
        font-weight: 800;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .leads-table-custom {
        width: 100%;
        border-collapse: collapse;
    }
    .leads-table-custom thead th {
        background: #f8fafc;
        padding: 14px 20px;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #64748b;
        border-bottom: 1px solid #e2e8f0;
        text-align: left;
    }
    .leads-table-custom tbody tr {
        border-bottom: 1px solid #f1f5f9;
        transition: background-color 0.15s;
    }
    .leads-table-custom tbody tr:hover {
        background-color: #f8fafc;
    }
    .leads-table-custom tbody td {
        padding: 16px 20px;
        font-size: 0.84rem;
        vertical-align: middle;
        color: #334155;
    }

    /* Badges & Links */
    .wa-btn-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #dcfce7;
        color: #15803d;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 50px;
        text-decoration: none;
        font-size: 0.78rem;
        transition: all 0.2s;
        border: 1px solid #bbf7d0;
    }
    .wa-btn-badge:hover {
        background: #25d366;
        color: #ffffff;
        border-color: #25d366;
    }

    .utm-tag {
        display: inline-flex;
        align-items: center;
        font-size: 0.68rem;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 6px;
        margin: 2px 2px 2px 0;
        background: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }
    .utm-tag-medium { background: #f3e8ff; color: #6b21a8; border-color: #e9d5ff; }
    .utm-tag-campaign { background: #ecfdf5; color: #047857; border-color: #a7f3d0; }

    /* Action Buttons */
    .btn-action-detail {
        background: #eff6ff;
        color: #0066ff;
        border: 1px solid #bfdbfe;
        border-radius: 10px;
        padding: 6px 12px;
        font-size: 0.75rem;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }
    .btn-action-detail:hover {
        background: #0066ff;
        color: #ffffff;
        border-color: #0066ff;
    }

    .btn-action-delete {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #ef4444;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-action-delete:hover {
        background: #ef4444;
        color: #ffffff;
        border-color: #ef4444;
    }

    .status-select-inline {
        padding: 5px 10px;
        font-size: 0.75rem;
        font-weight: 700;
        border-radius: 8px;
        cursor: pointer;
        outline: none;
        border: 1.5px solid transparent;
        transition: all 0.2s;
    }
    .status-select-inline.s-new { background: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
    .status-select-inline.s-contacted { background: #fffbeb; color: #b45309; border-color: #fde68a; }
    .status-select-inline.s-closed { background: #ecfdf5; color: #047857; border-color: #a7f3d0; }

    /* Empty State */
    .empty-box {
        text-align: center;
        padding: 60px 20px;
        color: #64748b;
    }

    /* Modal Styling */
    .lead-modal-content {
        border-radius: 24px;
        border: none;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }
    .lead-modal-header {
        background: #ffffff;
        border-bottom: 1px solid #e2e8f0;
        padding: 22px 28px;
    }
    .lead-modal-body {
        padding: 28px;
        background: #ffffff;
        max-height: 75vh;
        overflow-y: auto;
    }
    .req-detail-box {
        background: #f8fafc;
        border: 1.5px solid #cbd5e1;
        border-radius: 16px;
        padding: 20px;
        font-size: 0.92rem;
        line-height: 1.8;
        color: #0f172a;
        white-space: pre-wrap;
        word-break: break-word;
        margin-top: 8px;
        font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .leads-container { padding: 16px; }
    }
    @media (max-width: 576px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .filter-form { flex-direction: column; align-items: stretch; }
        .custom-date-container { flex-direction: column; }
        .leads-table-custom thead { display: none; }
        .leads-table-custom tbody td {
            display: block;
            padding: 10px 16px;
            text-align: right;
            border-bottom: 1px solid #f1f5f9;
        }
        .leads-table-custom tbody td::before {
            content: attr(data-label);
            float: left;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #64748b;
        }
    }
</style>

<div class="leads-container">

    @if(session('success'))
    <div class="alert alert-success d-flex align-items-center mb-4" style="border-radius: 14px; border: 1px solid #a7f3d0; background: #ecfdf5; color: #047857; font-weight: 600; padding: 14px 20px;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 10px;"><polyline points="20 6 9 17 4 12"/></svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    {{-- Page Header --}}
    <div class="leads-header">
        <div class="leads-title-group">
            <h1>
                <div class="leads-title-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M19 8v6"></path>
                        <path d="M22 11h-6"></path>
                    </svg>
                </div>
                Leads Tracking
            </h1>
            <p>Kelola dan pantau prospek yang masuk secara real-time dari formulir WhatsApp website</p>
        </div>
    </div>

    {{-- Stat Cards (Matching User's Reference Card Layout) --}}
    <div class="stats-grid">
        <!-- TOTAL LEADS -->
        <div class="stat-card">
            <div class="stat-icon-wrap icon-total">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <div>
                <div class="stat-num">{{ number_format($allLeadsCount) }}</div>
                <div class="stat-lbl">TOTAL LEADS</div>
            </div>
        </div>

        <!-- BARU (NEW) -->
        <div class="stat-card">
            <div class="stat-icon-wrap icon-new">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="12" y1="18" x2="12" y2="12"></line>
                    <line x1="9" y1="15" x2="15" y2="15"></line>
                </svg>
            </div>
            <div>
                <div class="stat-num">{{ number_format($newLeadsCount) }}</div>
                <div class="stat-lbl">BARU (NEW)</div>
            </div>
        </div>

        <!-- DIHUBUNGI -->
        <div class="stat-card">
            <div class="stat-icon-wrap icon-contacted">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
            </div>
            <div>
                <div class="stat-num">{{ number_format($contactedCount) }}</div>
                <div class="stat-lbl">DIHUBUNGI</div>
            </div>
        </div>

        <!-- SELESAI (CLOSED) -->
        <div class="stat-card">
            <div class="stat-icon-wrap icon-closed">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <div>
                <div class="stat-num">{{ number_format($closedCount) }}</div>
                <div class="stat-lbl">SELESAI (CLOSED)</div>
            </div>
        </div>
    </div>

    {{-- Filter Toolbar --}}
    <div class="filter-card">
        <form action="{{ route('admin.leads.index') }}" method="GET" class="filter-form" id="leadFilterForm">
            
            <!-- Periode Filter Dropdown -->
            <div class="filter-group">
                <label class="filter-label">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    Periode:
                </label>
                <select name="period" id="periodSelect" class="filter-select-box" onchange="handlePeriodChange()">
                    <option value="all" {{ $period == 'all' ? 'selected' : '' }}>Semua Waktu</option>
                    <option value="7_days" {{ $period == '7_days' ? 'selected' : '' }}>7 Hari Terakhir</option>
                    <option value="30_days" {{ $period == '30_days' ? 'selected' : '' }}>30 Hari Terakhir</option>
                    <option value="90_days" {{ $period == '90_days' ? 'selected' : '' }}>90 Hari Terakhir</option>
                    <option value="1_year" {{ $period == '1_year' ? 'selected' : '' }}>1 Tahun Terakhir</option>
                    <option value="custom" {{ $period == 'custom' ? 'selected' : '' }}>Atur Periode Custom</option>
                </select>
            </div>

            <!-- Custom Date Range Inputs (Tampil Jika Periode Custom Dipilih) -->
            <div class="custom-date-container" id="customDateWrap" style="display: {{ $period == 'custom' ? 'flex' : 'none' }};">
                <div class="filter-group">
                    <label class="filter-label">Mulai:</label>
                    <input type="date" name="start_date" class="filter-input" value="{{ $startDate }}">
                </div>
                <div class="filter-group">
                    <label class="filter-label">Selesai:</label>
                    <input type="date" name="end_date" class="filter-input" value="{{ $endDate }}">
                </div>
            </div>

            <!-- Status Filter Dropdown -->
            <div class="filter-group">
                <label class="filter-label">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    Status:
                </label>
                <select name="status" class="filter-select-box">
                    <option value="all" {{ request('status') == 'all' || !request('status') ? 'selected' : '' }}>Semua Status</option>
                    <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Baru (New)</option>
                    <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>Dihubungi</option>
                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Selesai (Closed)</option>
                </select>
            </div>

            <!-- Search Field -->
            <div class="filter-group" style="flex-grow: 1; max-width: 280px;">
                <input type="text" name="search" class="filter-input w-100" placeholder="Cari nama, WA, kebutuhan..." value="{{ request('search') }}">
            </div>

            <!-- Submit & Reset Buttons -->
            <button type="submit" class="btn-filter-submit">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                Terapkan Filter
            </button>

            @if(request()->hasAny(['period', 'status', 'search', 'start_date', 'end_date']))
            <a href="{{ route('admin.leads.index') }}" class="btn-filter-reset">
                Reset
            </a>
            @endif
        </form>
    </div>

    {{-- Main Leads Table --}}
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0066ff" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                Daftar Leads Masuk
                <span style="background: #eff6ff; color: #0066ff; font-size: 0.72rem; font-weight: 700; padding: 3px 10px; border-radius: 20px; border: 1px solid #bfdbfe;">
                    {{ $leads->total() }} data
                </span>
                @if($period !== 'all')
                <span style="background: #f0fdf4; color: #15803d; font-size: 0.7rem; font-weight: 600; padding: 3px 10px; border-radius: 20px; border: 1px solid #bbf7d0;">
                    @if($period === '7_days') 7 Hari Terakhir
                    @elseif($period === '30_days') 30 Hari Terakhir
                    @elseif($period === '90_days') 90 Hari Terakhir
                    @elseif($period === '1_year') 1 Tahun Terakhir
                    @elseif($period === 'custom') Custom: {{ $startDate }} s/d {{ $endDate }}
                    @endif
                </span>
                @endif
            </div>
        </div>

        <div class="table-responsive">
            <table class="leads-table-custom">
                <thead>
                    <tr>
                        <th style="width: 140px;">Tanggal</th>
                        <th>Nama / Perusahaan</th>
                        <th>WhatsApp</th>
                        <th style="max-width: 250px;">Kebutuhan</th>
                        <th>Tracking (UTM & Sumber)</th>
                        <th>Status</th>
                        <th style="width: 130px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leads as $lead)
                    <tr>
                        <td data-label="Tanggal">
                            <div style="font-weight: 700; color: #0f172a;">{{ $lead->created_at->format('d M Y') }}</div>
                            <div style="font-size: 0.72rem; color: #64748b;">{{ $lead->created_at->format('H:i') }} WIB</div>
                        </td>

                        <td data-label="Nama / Perusahaan">
                            <div style="font-weight: 700; color: #0f172a;">{{ $lead->name }}</div>
                            @if($lead->company_location)
                            <div style="font-size: 0.75rem; color: #64748b; margin-top: 2px; display: flex; align-items: center; gap: 4px;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                {{ $lead->company_location }}
                            </div>
                            @endif
                        </td>

                        <td data-label="WhatsApp">
                            @php
                                $cleanNumber = preg_replace('/[^0-9]/', '', $lead->whatsapp_number);
                            @endphp
                            <a href="https://wa.me/{{ $cleanNumber }}" target="_blank" class="wa-btn-badge">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                {{ $lead->whatsapp_number }}
                            </a>
                        </td>

                        <td data-label="Kebutuhan" style="max-width: 250px;">
                            <div style="font-size: 0.8rem; color: #475569; line-height: 1.5;">
                                {{ Str::limit($lead->requirements ?: 'Tidak ada catatan khusus', 75) }}
                            </div>
                        </td>

                        <td data-label="Tracking">
                            <div>
                                @if($lead->utm_source)
                                <span class="utm-tag">Src: {{ $lead->utm_source }}</span>
                                @endif
                                @if($lead->utm_medium)
                                <span class="utm-tag utm-tag-medium">Med: {{ $lead->utm_medium }}</span>
                                @endif
                                @if($lead->utm_campaign)
                                <span class="utm-tag utm-tag-campaign">Cmp: {{ $lead->utm_campaign }}</span>
                                @endif
                                @if(!$lead->utm_source && !$lead->utm_medium && !$lead->utm_campaign)
                                <span style="font-size: 0.72rem; color: #94a3b8; font-weight: 600;">Organik / Direct</span>
                                @endif
                            </div>
                            @if($lead->source_url)
                            <div style="margin-top: 4px;">
                                <a href="{{ $lead->source_url }}" target="_blank" style="font-size: 0.72rem; color: #64748b; text-decoration: none;" title="{{ $lead->source_url }}">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                                    {{ Str::limit(str_replace(['http://', 'https://'], '', $lead->source_url), 30) }}
                                </a>
                            </div>
                            @endif
                        </td>

                        <td data-label="Status">
                            <form action="{{ route('admin.leads.update_status', $lead->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="status-select-inline {{ $lead->status == 'new' ? 's-new' : ($lead->status == 'contacted' ? 's-contacted' : 's-closed') }}" onchange="this.form.submit()">
                                    <option value="new" {{ $lead->status == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="contacted" {{ $lead->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                                    <option value="closed" {{ $lead->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </form>
                        </td>

                        <td data-label="Aksi" style="text-align: center;">
                            <div style="display: flex; align-items: center; justify-content: center; gap: 6px;">
                                <!-- Tombol Pop-up Detail -->
                                <button type="button" class="btn-action-detail btn-lead-detail" 
                                    data-id="{{ $lead->id }}"
                                    data-name="{{ $lead->name }}"
                                    data-whatsapp="{{ $lead->whatsapp_number }}"
                                    data-company="{{ $lead->company_location }}"
                                    data-requirements="{{ $lead->requirements }}"
                                    data-source-url="{{ $lead->source_url }}"
                                    data-utm-source="{{ $lead->utm_source }}"
                                    data-utm-medium="{{ $lead->utm_medium }}"
                                    data-utm-campaign="{{ $lead->utm_campaign }}"
                                    data-status="{{ $lead->status }}"
                                    data-created-formatted="{{ $lead->created_at->format('l, d F Y - H:i') }} WIB">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    Detail
                                </button>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Hapus data lead ini?');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-delete" title="Hapus Lead">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-box">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" style="margin-bottom: 12px;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><circle cx="11" cy="14" r="3"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                <p style="font-size: 0.95rem; font-weight: 700; color: #0f172a; margin-bottom: 4px;">Tidak ada data leads ditemukan</p>
                                <span style="font-size: 0.8rem; color: #64748b;">Coba ubah opsi filter periode atau kata kunci pencarian Anda.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="padding: 20px 24px; border-top: 1px solid #e2e8f0;">
            {{ $leads->links() }}
        </div>
    </div>

</div>

<!--================= MODAL DETAIL LEADS (POP UP UTAMA) =================-->
<div class="modal fade" id="leadDetailModal" tabindex="-1" aria-labelledby="leadDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content lead-modal-content">
            
            <!-- Header Modal -->
            <div class="lead-modal-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 42px; height: 42px; background: #eff6ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #0066ff;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                    </div>
                    <div>
                        <h5 class="modal-title" id="leadDetailModalLabel" style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin: 0;">Detail Lead #<span id="modalLeadId"></span></h5>
                        <p style="font-size: 0.78rem; color: #64748b; margin: 0;" id="modalLeadDate"></p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body Modal -->
            <div class="lead-modal-body">
                <div class="row g-4">
                    
                    <!-- Informasi Utama -->
                    <div class="col-md-6">
                        <div style="background: #f8fafc; padding: 18px; border-radius: 16px; border: 1px solid #e2e8f0; height: 100%;">
                            <label style="font-size: 0.7rem; font-weight: 800; text-transform: uppercase; color: #64748b; letter-spacing: 0.8px; display: block; margin-bottom: 6px;">Nama / Perusahaan</label>
                            <div style="font-size: 1.1rem; font-weight: 800; color: #0f172a;" id="modalLeadName"></div>
                            <div style="font-size: 0.84rem; color: #475569; margin-top: 4px; display: flex; align-items: center; gap: 6px;" id="modalLeadCompanyWrap">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                <span id="modalLeadCompany"></span>
                            </div>
                        </div>
                    </div>

                    <!-- WhatsApp Link Button -->
                    <div class="col-md-6">
                        <div style="background: #f8fafc; padding: 18px; border-radius: 16px; border: 1px solid #e2e8f0; height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <label style="font-size: 0.7rem; font-weight: 800; text-transform: uppercase; color: #64748b; letter-spacing: 0.8px; display: block; margin-bottom: 6px;">Nomor WhatsApp</label>
                                <div style="font-size: 1rem; font-weight: 700; color: #0f172a;" id="modalLeadWaText"></div>
                            </div>
                            <div style="margin-top: 12px;">
                                <a href="#" id="modalLeadWaLink" target="_blank" style="background: #25d366; color: #ffffff; padding: 10px 18px; border-radius: 12px; font-weight: 700; text-decoration: none; font-size: 0.84rem; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(37, 211, 102, 0.25);">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                    Chat via WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- DETAIL KEBUTUHAN (JANGAN SAMPAI TERPOTONG) -->
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between">
                            <label style="font-size: 0.78rem; font-weight: 800; text-transform: uppercase; color: #0066ff; letter-spacing: 0.8px; display: flex; align-items: center; gap: 6px;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                                Detail Kebutuhan Pelanggan (Lengkap):
                            </label>
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="btnCopyReq" onclick="copyRequirementsText()" style="border-radius: 8px; font-size: 0.75rem; font-weight: 700;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 4px;"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                                Salin Teks
                            </button>
                        </div>
                        <div class="req-detail-box" id="modalLeadRequirements"></div>
                    </div>

                    <!-- Tracking & UTM Information -->
                    <div class="col-12">
                        <div style="background: #f8fafc; padding: 20px; border-radius: 16px; border: 1px solid #e2e8f0;">
                            <label style="font-size: 0.78rem; font-weight: 800; text-transform: uppercase; color: #475569; letter-spacing: 0.8px; display: flex; align-items: center; gap: 6px; margin-bottom: 12px;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                                Data Tracking & Analytics
                            </label>

                            <div class="row g-3">
                                <div class="col-md-12">
                                    <span style="font-size: 0.75rem; color: #64748b; font-weight: 700; display: block;">Halaman Sumber (Source URL):</span>
                                    <div class="d-flex align-items-center gap-2 mt-1">
                                        <span id="modalLeadSourceUrl" style="font-size: 0.85rem; font-weight: 600; color: #0f172a; word-break: break-all;"></span>
                                        <a href="#" id="modalLeadSourceUrlLink" target="_blank" class="btn btn-sm btn-light" style="border-radius: 6px; padding: 2px 8px; font-size: 0.72rem; font-weight: 700;" title="Buka URL">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <span style="font-size: 0.72rem; color: #64748b; font-weight: 700; display: block;">UTM Source:</span>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle mt-1" id="modalLeadUtmSource" style="font-size: 0.78rem; padding: 6px 12px; border-radius: 8px;"></span>
                                </div>

                                <div class="col-md-4">
                                    <span style="font-size: 0.72rem; color: #64748b; font-weight: 700; display: block;">UTM Medium:</span>
                                    <span class="badge bg-purple-subtle text-purple border border-purple-subtle mt-1" id="modalLeadUtmMedium" style="font-size: 0.78rem; padding: 6px 12px; border-radius: 8px;"></span>
                                </div>

                                <div class="col-md-4">
                                    <span style="font-size: 0.72rem; color: #64748b; font-weight: 700; display: block;">UTM Campaign:</span>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle mt-1" id="modalLeadUtmCampaign" style="font-size: 0.78rem; padding: 6px 12px; border-radius: 8px;"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Update Status di Modal -->
                    <div class="col-12">
                        <form id="modalStatusForm" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="d-flex align-items-center justify-content-between p-3 rounded-4" style="background: #f1f5f9; border: 1px solid #cbd5e1;">
                                <label style="font-size: 0.84rem; font-weight: 700; color: #0f172a; margin: 0;">Ubah Status Lead Ini:</label>
                                <div class="d-flex align-items-center gap-2">
                                    <select name="status" id="modalStatusSelect" class="form-select form-select-sm" style="border-radius: 8px; font-weight: 700; width: 140px;">
                                        <option value="new">New</option>
                                        <option value="contacted">Contacted</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary" style="border-radius: 8px; font-weight: 700; padding: 5px 14px;">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <!-- Footer Modal -->
            <div class="modal-footer" style="border-top: 1px solid #e2e8f0; padding: 16px 28px; background: #ffffff;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 10px; font-weight: 700; font-size: 0.84rem;">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
function handlePeriodChange() {
    const period = document.getElementById('periodSelect').value;
    const customWrap = document.getElementById('customDateWrap');
    if (period === 'custom') {
        // Tampilkan date picker, jangan auto-submit dulu
        customWrap.style.display = 'flex';
    } else {
        // Untuk periode preset: langsung submit form
        customWrap.style.display = 'none';
        document.getElementById('leadFilterForm').submit();
    }
}

function toggleCustomDates() {
    handlePeriodChange();
}

document.addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-lead-detail');
    if (btn) {
        document.getElementById('modalLeadId').textContent = btn.dataset.id;
        document.getElementById('modalLeadName').textContent = btn.dataset.name;
        
        const companyWrap = document.getElementById('modalLeadCompanyWrap');
        if (btn.dataset.company && btn.dataset.company.trim() !== '') {
            document.getElementById('modalLeadCompany').textContent = btn.dataset.company;
            companyWrap.style.display = 'flex';
        } else {
            companyWrap.style.display = 'none';
        }
        
        document.getElementById('modalLeadWaText').textContent = btn.dataset.whatsapp;
        const cleanWa = btn.dataset.whatsapp.replace(/\D/g, '');
        document.getElementById('modalLeadWaLink').href = 'https://wa.me/' + cleanWa;
        document.getElementById('modalLeadDate').textContent = btn.dataset.createdFormatted;
        
        // Requirements (Full Text without truncation)
        document.getElementById('modalLeadRequirements').textContent = btn.dataset.requirements || 'Tidak ada catatan kebutuhan khusus.';
        
        // Tracking URL & UTM
        const sourceUrl = btn.dataset.sourceUrl;
        document.getElementById('modalLeadSourceUrl').textContent = sourceUrl || 'Direct / Langsung (Tanpa URL Referer)';
        const linkEl = document.getElementById('modalLeadSourceUrlLink');
        if (sourceUrl && sourceUrl !== 'null' && sourceUrl !== '') {
            linkEl.href = sourceUrl;
            linkEl.style.display = 'inline-flex';
        } else {
            linkEl.style.display = 'none';
        }
        
        document.getElementById('modalLeadUtmSource').textContent = btn.dataset.utmSource && btn.dataset.utmSource !== 'null' ? btn.dataset.utmSource : 'Organik / None';
        document.getElementById('modalLeadUtmMedium').textContent = btn.dataset.utmMedium && btn.dataset.utmMedium !== 'null' ? btn.dataset.utmMedium : '-';
        document.getElementById('modalLeadUtmCampaign').textContent = btn.dataset.utmCampaign && btn.dataset.utmCampaign !== 'null' ? btn.dataset.utmCampaign : '-';
        
        // Status select inside modal
        document.getElementById('modalStatusSelect').value = btn.dataset.status;
        document.getElementById('modalStatusForm').action = '{{ url("/admin/leads") }}/' + btn.dataset.id + '/status';
        
        // Show Modal
        const modalEl = document.getElementById('leadDetailModal');
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    }
});

function copyRequirementsText() {
    const reqText = document.getElementById('modalLeadRequirements').textContent;
    navigator.clipboard.writeText(reqText).then(function() {
        const btn = document.getElementById('btnCopyReq');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:4px;"><polyline points="20 6 9 17 4 12"></polyline></svg> Tersalin!';
        btn.classList.remove('btn-outline-secondary');
        btn.classList.add('btn-success', 'text-white');
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('btn-success', 'text-white');
            btn.classList.add('btn-outline-secondary');
        }, 2000);
    });
}
</script>
@endpush
@endsection

