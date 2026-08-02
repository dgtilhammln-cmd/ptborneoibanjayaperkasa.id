@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --bg-page: #f0f4ff;
            --bg-card: #ffffff;
            --bg-card-hover: #f8faff;
            --accent-blue: #3b82f6;
            --accent-blue-dark: #1d4ed8;
            --accent-blue-light: #eff6ff;
            --accent-blue-mid: #bfdbfe;
            --accent-teal: #06b6d4;
            --accent-teal-light: #ecfeff;
            --accent-violet: #7c3aed;
            --accent-violet-light: #ede9fe;
            --accent-green: #10b981;
            --accent-green-light: #ecfdf5;
            --accent-amber: #f59e0b;
            --accent-amber-light: #fffbeb;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border: #e2e8f0;
            --border-hover: #bfdbfe;
            --shadow-sm: 0 1px 3px rgba(59, 130, 246, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 4px 16px rgba(59, 130, 246, 0.10), 0 2px 4px rgba(0, 0, 0, 0.04);
            --shadow-lg: 0 8px 32px rgba(59, 130, 246, 0.14), 0 4px 8px rgba(0, 0, 0, 0.06);
            --radius-sm: 10px;
            --radius-md: 14px;
            --radius-lg: 20px;
            --radius-xl: 28px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .dash-wrap {
            background: var(--bg-page);
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-primary);
            padding: 24px 20px 48px;
        }

        /* ── TOP BAR ── */
        .top-bar {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            padding: 20px 24px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 16px;
            flex: 1;
            min-width: 0;
        }

        .company-avatar {
            width: 56px;
            height: 56px;
            background: var(--bg-page);
            border-radius: var(--radius-md);
            border: 1.5px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 6px;
            box-shadow: var(--shadow-sm);
            flex-shrink: 0;
        }

        .company-avatar img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .company-name {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1.2;
        }

        .company-sub {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .company-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 6px;
        }

        .badge-pill {
            font-size: 0.68rem;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            letter-spacing: 0.3px;
        }

        .badge-blue {
            background: var(--accent-blue-light);
            color: var(--accent-blue-dark);
            border: 1px solid var(--accent-blue-mid);
        }

        .badge-teal {
            background: var(--accent-teal-light);
            color: #0e7490;
            border: 1px solid #a5f3fc;
        }

        .badge-green {
            background: var(--accent-green-light);
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        /* Top bar right info strip */
        .top-bar-right {
            display: flex;
            align-items: stretch;
            gap: 0;
            background: var(--bg-page);
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
            overflow: hidden;
            flex-shrink: 0;
        }

        .info-cell {
            padding: 12px 18px;
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 110px;
        }

        .info-cell:last-child {
            border-right: none;
        }

        .info-cell-label {
            font-size: 0.62rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.9px;
            color: var(--text-muted);
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .info-cell-value {
            font-size: 0.9rem;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1;
        }

        .info-cell-sub {
            font-size: 0.65rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .info-cell-value.green {
            color: var(--accent-green);
        }

        .info-cell-value.blue {
            color: var(--accent-blue);
        }

        .live-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--accent-green);
            background: var(--accent-green-light);
            border: 1px solid #a7f3d0;
            border-radius: 50px;
            padding: 4px 11px;
            align-self: center;
            margin: 0 14px;
        }

        .live-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent-green);
            animation: blink 1.5s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .3
            }
        }

        /* ── SECTION TITLE ── */
        .section-label {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: var(--text-muted);
            margin-bottom: 14px;
        }

        /* ── STAT CARDS ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            padding: 24px 22px 18px;
            box-shadow: var(--shadow-sm);
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
            border-color: var(--border-hover);
        }

        .stat-card-icon {
            width: 42px;
            height: 42px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            margin-bottom: 16px;
        }

        .ic-blue {
            background: var(--accent-blue-light);
            color: var(--accent-blue);
        }

        .ic-teal {
            background: var(--accent-teal-light);
            color: var(--accent-teal);
        }

        .ic-violet {
            background: var(--accent-violet-light);
            color: var(--accent-violet);
        }

        .ic-green {
            background: var(--accent-green-light);
            color: var(--accent-green);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 16px;
        }

        .stat-progress-track {
            height: 5px;
            background: var(--bg-page);
            border-radius: 10px;
            overflow: hidden;
        }

        .stat-progress-fill {
            height: 100%;
            border-radius: 10px;
            width: 0%;
            transition: width 1.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .fill-blue {
            background: linear-gradient(90deg, #60a5fa, #3b82f6);
        }

        .fill-teal {
            background: linear-gradient(90deg, #22d3ee, #06b6d4);
        }

        .fill-violet {
            background: linear-gradient(90deg, #a78bfa, #7c3aed);
        }

        .fill-green {
            background: linear-gradient(90deg, #34d399, #10b981);
        }

        /* ── MAIN GRID ── */
        .main-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 20px;
        }

        /* ── CARD BASE ── */
        .card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            padding: 24px;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
        }

        .btn-ghost {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-muted);
            background: var(--bg-page);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 6px 14px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            font-family: 'Plus Jakarta Sans', sans-serif;
            white-space: nowrap;
        }

        .btn-ghost:hover {
            color: var(--accent-blue);
            border-color: var(--accent-blue-mid);
            background: var(--accent-blue-light);
        }

        /* ── BLOG TABLE ── */
        .blog-table {
            width: 100%;
            border-collapse: collapse;
        }

        .blog-table thead th {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            padding: 0 12px 12px;
            border-bottom: 1px solid var(--border);
            text-align: left;
        }

        .blog-table thead th:last-child {
            text-align: right;
        }

        .blog-table tbody tr {
            transition: background 0.15s;
            border-bottom: 1px solid var(--border);
        }

        .blog-table tbody tr:last-child {
            border-bottom: none;
        }

        .blog-table tbody tr:hover {
            background: var(--bg-page);
        }

        .blog-table td {
            padding: 13px 12px;
            vertical-align: middle;
        }

        .blog-thumb {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            object-fit: cover;
            flex-shrink: 0;
            border: 1px solid var(--border);
        }

        .blog-thumb-placeholder {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: var(--accent-blue-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-blue);
            font-size: 1rem;
            flex-shrink: 0;
        }

        .blog-title-text {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-primary);
            line-height: 1.3;
        }

        .blog-date {
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .status-pill {
            font-size: 0.68rem;
            font-weight: 700;
            padding: 4px 11px;
            border-radius: 50px;
            display: inline-block;
        }

        .status-published {
            background: var(--accent-green-light);
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .status-draft {
            background: var(--accent-amber-light);
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .btn-edit {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-page);
            border: 1px solid var(--border);
            color: var(--text-secondary);
            transition: all 0.2s;
            text-decoration: none;
            font-size: 0.85rem;
        }

        .btn-edit:hover {
            background: var(--accent-blue-light);
            border-color: var(--accent-blue-mid);
            color: var(--accent-blue);
        }

        /* ── RIGHT COLUMN ── */
        .right-col {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* ── SYSTEM SUMMARY ── */
        .mini-stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .mini-stat {
            background: var(--bg-page);
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            padding: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s;
        }

        .mini-stat:hover {
            border-color: var(--border-hover);
            background: var(--accent-blue-light);
        }

        .mini-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .mini-icon-label {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
        }

        .mini-icon-value {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1;
        }

        /* ── SEO CARD ── */
        .seo-card {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 60%, #06b6d4 100%);
            border-radius: var(--radius-lg);
            padding: 26px 24px;
            position: relative;
            overflow: hidden;
        }

        .seo-card-deco {
            position: absolute;
            right: -20px;
            bottom: -20px;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .07);
        }

        .seo-card-deco2 {
            position: absolute;
            right: 30px;
            bottom: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .06);
        }

        .seo-card-deco3 {
            position: absolute;
            right: -10px;
            top: -30px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .05);
        }

        .badge-seo {
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            background: rgba(255, 255, 255, 0.18);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 4px 12px;
            border-radius: 50px;
            display: inline-block;
            margin-bottom: 14px;
        }

        .seo-title {
            font-size: 1.15rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 8px;
        }

        .seo-desc {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.75);
            margin-bottom: 20px;
            line-height: 1.6;
            max-width: 95%;
        }

        .btn-seo {
            background: #fff;
            color: var(--accent-blue-dark);
            border: none;
            border-radius: 10px;
            padding: 11px 20px;
            font-size: 0.82rem;
            font-weight: 800;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: all 0.2s ease;
            text-decoration: none;
            width: 100%;
            justify-content: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
        }

        .btn-seo:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            color: var(--accent-blue-dark);
        }

        /* ── TIP BAR ── */
        .tip-bar {
            background: var(--bg-card);
            border: 1px solid var(--accent-blue-mid);
            border-left: 3px solid var(--accent-blue);
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 20px;
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .tip-bar strong {
            color: var(--text-primary);
            font-weight: 700;
        }

        .tip-bar a {
            color: var(--accent-blue);
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            font-size: 0.78rem;
            border: 1px solid var(--accent-blue-mid);
            background: var(--accent-blue-light);
            padding: 5px 12px;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .tip-bar a:hover {
            background: var(--accent-blue);
            color: #fff;
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .anim {
            opacity: 0;
            animation: fadeUp 0.5s ease forwards;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1100px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .main-grid {
                grid-template-columns: 1fr;
            }

            .top-bar-right {
                flex-wrap: wrap;
            }
        }

        @media (max-width: 768px) {
            .top-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            .top-bar-right {
                width: 100%;
                overflow-x: auto;
            }

            .info-cell {
                min-width: 90px;
                padding: 10px 14px;
            }
        }

        @media (max-width: 640px) {
            .dash-wrap {
                padding: 16px 14px 40px;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .stat-number {
                font-size: 1.6rem;
            }

            .stat-card {
                padding: 18px 16px 14px;
            }

            .mini-stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .card {
                padding: 18px 14px;
            }

            .blog-table thead th,
            .blog-table td {
                padding: 10px 8px;
            }

            .blog-title-text {
                font-size: 0.78rem;
            }
        }

        @media (max-width: 400px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .mini-stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="dash-wrap">

        {{-- TOP BAR (Informative) --}}
        <div class="top-bar anim" style="animation-delay:0.05s">
            <div class="top-bar-left">
                <div class="company-avatar">
                    <img src="{{ asset('assets/images/PT Borneo (5).png') }}" alt="Logo">
                </div>
                <div>
                    <div class="company-name">PT. Borneo Iban Jaya</div>
                    <div class="company-sub">Dashboard Admin &mdash; {{ now()->translatedFormat('l, d F Y') }}</div>
                    <div class="company-badges">
                        <span class="badge-pill badge-blue">
                            <i class="mdi mdi-shield-check"></i> HVM Digital
                        </span>
                        <span class="badge-pill badge-teal">
                            <i class="mdi mdi-calendar-clock"></i> Aktif s/d 24 Des 2026
                        </span>
                        <span class="badge-pill badge-green">
                            <i class="mdi mdi-check-circle-outline"></i> Semua Sistem Normal
                        </span>
                    </div>
                </div>
            </div>

            <div class="top-bar-right">
                <div class="info-cell">
                    <div class="info-cell-label"><i class="mdi mdi-clock-outline"></i> Waktu</div>
                    <div class="info-cell-value blue" id="live-clock">--:--:--</div>
                    <div class="info-cell-sub">WIB (UTC+7)</div>
                </div>
                <div class="info-cell">
                    <div class="info-cell-label"><i class="mdi mdi-post-outline"></i> Total Blog</div>
                    <div class="info-cell-value">{{ \App\Models\Blog::count() }}</div>
                    <div class="info-cell-sub">{{ \App\Models\Blog::where('status', 'published')->count() }} published</div>
                </div>
                <div class="info-cell">
                    <div class="info-cell-label"><i class="mdi mdi-refresh"></i> Data</div>
                    <div class="info-cell-value green">Live</div>
                    <div class="info-cell-sub" id="last-updated">Updated baru saja</div>
                </div>
                <span class="live-badge"><span class="live-dot"></span> LIVE</span>
            </div>
        </div>

        {{-- STAT CARDS --}}
        <div class="section-label anim" style="animation-delay:0.12s">
            Ringkasan Statistik — Rolling 30 Hari
        </div>
        <div class="stats-grid">
            <div class="stat-card anim" style="animation-delay:0.15s">
                <div class="stat-card-icon ic-blue"><i class="mdi mdi-account-group-outline"></i></div>
                <div class="stat-number">{{ number_format($visitorCount) }}</div>
                <div class="stat-label">Visitor (30 Hari)</div>
                <div class="stat-progress-track">
                    <div class="stat-progress-fill fill-blue" data-width="{{ $visitorBar }}"></div>
                </div>
            </div>
            <div class="stat-card anim" style="animation-delay:0.3s">
                <div class="stat-card-icon ic-green"><i class="mdi mdi-whatsapp"></i></div>
                <div class="stat-number">{{ number_format($waLeads) }}</div>
                <div class="stat-label">WA Leads (30 Hari)</div>
                <div class="stat-progress-track">
                    <div class="stat-progress-fill fill-green" data-width="{{ $waBar }}"></div>
                </div>
            </div>
        </div>

        {{-- TIP BAR --}}
        <div class="tip-bar anim" style="animation-delay:0.32s">
            <span>
                <i class="mdi mdi-information-outline me-1" style="color:var(--accent-blue)"></i>
                Tip: di <strong>Analitik</strong> default filter biasanya <strong>7 hari</strong>. Pilih <strong>30
                    Hari</strong> untuk data apple-to-apple.
            </span>
            <a href="{{ route('admin.analytics.index', ['period' => '30d']) }}">
                Buka Analitik 30 Hari →
            </a>
        </div>

        {{-- MAIN GRID --}}
        <div class="main-grid">

            {{-- BLOG TABLE --}}
            <div class="card anim" style="animation-delay:0.35s">
                <div class="card-header">
                    <div class="card-title">
                        <div class="card-title-icon ic-blue"><i class="mdi mdi-file-document-edit-outline"></i></div>
                        Konten Blog Terbaru
                    </div>
                    <a href="{{ route('admin.blog.index') }}" class="btn-ghost">Lihat Semua</a>
                </div>
                <div style="overflow-x: auto;">
                    <table class="blog-table">
                        <thead>
                            <tr>
                                <th>Informasi Konten</th>
                                <th>Status</th>
                                <th style="text-align:right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Blog::latest()->take(4)->get() as $blog)
                                <tr>
                                    <td>
                                        <div style="display:flex; align-items:center; gap:12px;">
                                            @if($blog->image)
                                                <img src="{{ asset($blog->image) }}" class="blog-thumb" alt="">
                                            @else
                                                <div class="blog-thumb-placeholder"><i class="mdi mdi-image-outline"></i></div>
                                            @endif
                                            <div>
                                                <div class="blog-title-text">{{ Str::limit($blog->title, 40) }}</div>
                                                <div class="blog-date">{{ $blog->created_at->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="status-pill {{ $blog->status == 'published' ? 'status-published' : 'status-draft' }}">
                                            {{ ucfirst($blog->status) }}
                                        </span>
                                    </td>
                                    <td style="text-align:right">
                                        <a href="{{ route('admin.blog.edit', $blog) }}" class="btn-edit">
                                            <i class="mdi mdi-pencil-outline"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- RIGHT COLUMN --}}
            <div class="right-col">

                {{-- SYSTEM SUMMARY --}}
                <div class="card anim" style="animation-delay:0.38s">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="card-title-icon ic-violet"><i class="mdi mdi-view-grid-outline"></i></div>
                            Ringkasan Web
                        </div>
                        <span class="live-badge"><span class="live-dot"></span> Real-time</span>
                    </div>
                    <div class="mini-stats-grid">
                        <div class="mini-stat">
                            <div class="mini-icon ic-blue"><i class="mdi mdi-package-variant-closed"></i></div>
                            <div>
                                <div class="mini-icon-label">Produk</div>
                                <div class="mini-icon-value">{{ \App\Models\Product::count() }}</div>
                            </div>
                        </div>
                        <div class="mini-stat">
                            <div class="mini-icon ic-teal"><i class="mdi mdi-hammer-wrench"></i></div>
                            <div>
                                <div class="mini-icon-label">Layanan</div>
                                <div class="mini-icon-value">{{ \App\Models\Service::count() }}</div>
                            </div>
                        </div>
                        <div class="mini-stat">
                            <div class="mini-icon ic-violet"><i class="mdi mdi-post-outline"></i></div>
                            <div>
                                <div class="mini-icon-label">Blog</div>
                                <div class="mini-icon-value">{{ \App\Models\Blog::count() }}</div>
                            </div>
                        </div>
                        <div class="mini-stat">
                            <div class="mini-icon ic-green"><i class="mdi mdi-account-group-outline"></i></div>
                            <div>
                                <div class="mini-icon-label">User</div>
                                <div class="mini-icon-value">{{ \App\Models\User::count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SEO CARD --}}
                <div class="seo-card anim" style="animation-delay:0.42s">
                    <div class="seo-card-deco"></div>
                    <div class="seo-card-deco2"></div>
                    <div class="seo-card-deco3"></div>
                    <div style="position:relative;">
                        <span class="badge-seo">#1 Rank di Google</span>
                        <div class="seo-title">Upgrade SEO Anda</div>
                        <div class="seo-desc">
                            Optimalkan sekarang agar produk & jasa anda muncul di halaman pertama Google ketika calon buyer
                            mencari.
                        </div>
                        <a href="https://wa.me/6285162612373" class="btn-seo">
                            <i class="mdi mdi-lightning-bolt"></i> Kelola SEO Sekarang
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Progress bars
            setTimeout(function () {
                document.querySelectorAll('.stat-progress-fill').forEach(function (el) {
                    el.style.width = (el.getAttribute('data-width') || '0') + '%';
                });
            }, 400);

            // Live clock WIB
            function updateClock() {
                var now = new Date();
                var wib = new Date(now.toLocaleString('en-US', { timeZone: 'Asia/Jakarta' }));
                var h = String(wib.getHours()).padStart(2, '0');
                var m = String(wib.getMinutes()).padStart(2, '0');
                var s = String(wib.getSeconds()).padStart(2, '0');
                var el = document.getElementById('live-clock');
                if (el) el.textContent = h + ':' + m + ':' + s;
            }
            updateClock();
            setInterval(updateClock, 1000);

            // Last updated timestamp
            var upd = document.getElementById('last-updated');
            if (upd) {
                var now = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                upd.textContent = 'Pukul ' + now + ' WIB';
            }
        });
    </script>

@endsection