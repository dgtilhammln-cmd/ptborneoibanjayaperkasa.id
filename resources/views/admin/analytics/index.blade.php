@extends('layouts.app')

@section('title', 'Analitik')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --bg-base:           #f0f2f7;
        --bg-surface:        #ffffff;
        --bg-surface-2:      #f7f8fc;
        --border:            #e4e8f0;
        --border-strong:     #d0d6e4;
        --text-primary:      #0f1724;
        --text-secondary:    #5a6478;
        --text-muted:        #9aa3b8;
        --accent:            #3b6ef8;
        --accent-soft:       #eef2ff;
        --accent-green:      #22c55e;
        --accent-green-soft: #f0fdf4;
        --accent-red:        #ef4444;
        --accent-red-soft:   #fef2f2;
        --accent-amber:      #f59e0b;
        --accent-amber-soft: #fffbeb;
        --shadow-sm: 0 1px 3px rgba(15,23,36,.06), 0 1px 2px rgba(15,23,36,.04);
        --shadow-md: 0 4px 16px rgba(15,23,36,.08), 0 2px 6px rgba(15,23,36,.04);
        --r: 16px; --r-sm: 10px; --r-xs: 8px;
    }

    * { box-sizing: border-box; }
    a, a:hover { text-decoration: none !important; outline: none; }
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: var(--bg-base); }
    ::-webkit-scrollbar-thumb { background: var(--border-strong); border-radius: 10px; }

    body {
        background: var(--bg-base);
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--text-primary);
        -webkit-font-smoothing: antialiased;
    }

    /* ── Shell ── */
    .ps { padding: 2rem 2.5rem; max-width: 1320px; margin: 0 auto; }

    /* ── Breadcrumb ── */
    .bc { display:flex; align-items:center; gap:6px; font-size:.75rem; color:var(--text-muted); margin-bottom:1.5rem; }
    .bc a { color:var(--text-muted); transition:color .2s; } .bc a:hover { color:var(--accent); }
    .bc .sep { color:var(--border-strong); } .bc .cur { color:var(--text-secondary); font-weight:600; }

    /* ── Page Header ── */
    .ph { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.75rem; flex-wrap:wrap; gap:1rem; }
    .ph h1 { font-size:1.55rem; font-weight:800; letter-spacing:-.5px; margin:0 0 4px; }
    .ph p { font-size:.82rem; color:var(--text-secondary); margin:0; }

    /* ── Period Filter ── */
    .filter-wrap { display:flex; align-items:center; gap:.75rem; flex-wrap:wrap; }
    .period-group { display:flex; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--r-sm); overflow:hidden; box-shadow:var(--shadow-sm); }
    .period-btn {
        padding:9px 16px; font-family:'Plus Jakarta Sans',sans-serif; font-size:.78rem; font-weight:700;
        color:var(--text-secondary); background:transparent; border:none; cursor:pointer;
        border-right:1px solid var(--border); transition:all .2s; white-space:nowrap;
    }
    .period-btn:last-child { border-right:none; }
    .period-btn:hover { background:var(--bg-surface-2); color:var(--accent); }
    .period-btn.active { background:var(--accent); color:#fff; box-shadow:inset 0 1px 3px rgba(0,0,0,.1); }

    .date-form { display:flex; align-items:center; gap:6px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--r-sm); padding:5px 8px; box-shadow:var(--shadow-sm); }
    .date-inp {
        background:var(--bg-surface-2); border:1px solid var(--border); border-radius:var(--r-xs);
        padding:6px 10px; font-size:.78rem; font-family:'Plus Jakarta Sans',sans-serif;
        color:var(--text-primary); outline:none; transition:border-color .2s;
    }
    .date-inp:focus { border-color:var(--accent); box-shadow:0 0 0 2px rgba(59,110,248,.1); }
    .date-sep { font-size:.72rem; color:var(--text-muted); font-weight:600; }
    .btn-filter {
        display:inline-flex; align-items:center; gap:5px;
        background:var(--accent); color:#fff; font-family:'Plus Jakarta Sans',sans-serif;
        font-weight:700; font-size:.75rem; padding:7px 14px; border-radius:var(--r-xs);
        border:none; cursor:pointer; transition:all .2s;
    }
    .btn-filter:hover { background:#2c5ce8; }

    /* ── Stats Grid ── */
    .stats { display:grid; grid-template-columns:repeat(auto-fit, minmax(200px,1fr)); gap:1rem; margin-bottom:1.5rem; }
    .sc { background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--r); padding:1.3rem 1.5rem; display:flex; align-items:center; gap:1rem; box-shadow:var(--shadow-sm); transition:box-shadow .2s,transform .2s; }
    .sc:hover { box-shadow:var(--shadow-md); transform:translateY(-1px); }
    .si { width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.15rem; flex-shrink:0; }
    .si.blue   { background:var(--accent-soft); color:var(--accent); }
    .si.green  { background:var(--accent-green-soft); color:var(--accent-green); }
    .si.amber  { background:var(--accent-amber-soft); color:var(--accent-amber); }
    .si.red    { background:var(--accent-red-soft); color:var(--accent-red); }
    .sv { font-size:1.65rem; font-weight:800; line-height:1; color:var(--text-primary); font-family:'Inter',sans-serif; }
    .sl { font-size:.67rem; color:var(--text-muted); margin-top:3px; text-transform:uppercase; letter-spacing:.8px; font-weight:600; }

    /* ── Card ── */
    .card-lux { background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--r); box-shadow:var(--shadow-sm); overflow:hidden; }
    .card-head { padding:1.1rem 1.6rem; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap; }
    .card-head h3 { font-size:.9rem; font-weight:700; margin:0; display:flex; align-items:center; gap:8px; }
    .live-dot { width:8px; height:8px; border-radius:50%; background:var(--accent-green); box-shadow:0 0 0 3px rgba(34,197,94,.15); animation:blink 1.6s infinite; }
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.35} }

    /* ── Chart Container ── */
    .chart-wrap { padding:1.5rem 1.6rem; }
    .chart-box { position:relative; height:340px; }

    /* ── Legend Pills ── */
    .chart-legend { display:flex; align-items:center; gap:.75rem; flex-wrap:wrap; }
    .leg-item { display:flex; align-items:center; gap:6px; font-size:.72rem; font-weight:600; color:var(--text-secondary); }
    .leg-dot { width:8px; height:8px; border-radius:50%; }

    /* ── Table ── */
    .tbl { width:100%; border-collapse:collapse; }
    .tbl thead th { padding:10px 18px; text-align:left; font-size:.68rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:1px; background:var(--bg-surface-2); border-bottom:1px solid var(--border); }
    .tbl thead th:last-child { text-align:right; }
    .tbl tbody tr { border-bottom:1px solid var(--border); transition:background .15s; }
    .tbl tbody tr:last-child { border-bottom:none; }
    .tbl tbody tr:hover { background:var(--bg-surface-2); }
    .tbl td { padding:13px 18px; vertical-align:middle; font-size:.84rem; color:var(--text-primary); }
    .tbl td:last-child { text-align:right; }

    /* ── Rank badge ── */
    .rank { width:24px; height:24px; border-radius:6px; background:var(--accent-soft); color:var(--accent); font-size:.68rem; font-weight:800; display:inline-flex; align-items:center; justify-content:center; font-family:'Inter',sans-serif; }
    .rank.g1 { background:var(--accent-soft); color:var(--accent); }
    .rank.g2 { background:var(--bg-surface-2); color:var(--text-secondary); }

    /* ── View count ── */
    .vc { font-size:.82rem; font-weight:700; color:var(--text-primary); font-family:'Inter',sans-serif; }
    .vc-bar-wrap { display:flex; align-items:center; gap:10px; }
    .vc-bar { flex:1; height:4px; background:var(--border); border-radius:10px; overflow:hidden; max-width:80px; }
    .vc-bar-fill { height:100%; border-radius:10px; background:var(--accent); }

    /* ── Empty ── */
    .empty-row td { padding:2.5rem; text-align:center; color:var(--text-muted); font-size:.82rem; }

    /* ── Grid 2col ── */
    .grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; }

    /* ── Animations ── */
    @keyframes fadeUp { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
    .fu { animation:fadeUp .35s ease-out both; }

    @media(max-width:900px) { .grid-2 { grid-template-columns:1fr; } }
    @media(max-width:768px) { .ps{padding:1rem;} .stats{grid-template-columns:1fr 1fr;} .ph{flex-direction:column;align-items:flex-start;} .filter-wrap{flex-direction:column;align-items:flex-start;} }
</style>

<div class="ps">

    {{-- Breadcrumb --}}
    <nav class="bc fu" style="animation-delay:.05s">
        <a href="#"><i class="mdi mdi-home-outline"></i></a>
        <span class="sep">/</span>
        <span class="cur">Analitik</span>
    </nav>

    {{-- Page Header --}}
    <div class="ph fu" style="animation-delay:.08s">
        <div>
            <h1>Laporan Analitik</h1>
            <p>Laporan performa konversi dan trafik secara realtime</p>
        </div>

        {{-- Period Filter --}}
        <div class="filter-wrap">
            <div class="period-group">
                <a href="{{ route('admin.analytics.index', ['period' => 'today']) }}"
                   class="period-btn {{ $period == 'today' ? 'active' : '' }}">Hari Ini</a>
                <a href="{{ route('admin.analytics.index', ['period' => '7d']) }}"
                   class="period-btn {{ $period == '7d' ? 'active' : '' }}">7 Hari</a>
                <a href="{{ route('admin.analytics.index', ['period' => '30d']) }}"
                   class="period-btn {{ $period == '30d' ? 'active' : '' }}">30 Hari</a>
            </div>
            <form action="{{ route('admin.analytics.index') }}" method="GET" class="date-form">
                <input type="hidden" name="period" value="{{ $period }}">
                <input type="date" name="start_date" class="date-inp" value="{{ request('start_date') }}">
                <span class="date-sep">—</span>
                <input type="date" name="end_date" class="date-inp" value="{{ request('end_date') }}">
                <button type="submit" class="btn-filter"><i class="mdi mdi-filter-outline"></i> Filter</button>
            </form>
        </div>
    </div>

    {{-- Stats Cards --}}
    @php
        $periodLabel = (request('start_date') || request('end_date'))
            ? 'Rentang custom'
            : match($period) {
                'today' => 'Hari ini',
                '7d'    => '7 hari terakhir',
                '30d'   => '30 hari terakhir',
                '90d'   => '90 hari terakhir',
                '1y'    => '12 bulan terakhir',
                default => 'Periode terpilih',
            };

        $waClicks    = $stats['cta_clicks']['by_type']->where('cta_type', 'whatsapp')->first()->clicks ?? 0;
        $totalLeads  = \App\Models\Lead::count();
        $newLeads    = \App\Models\Lead::where('status', 'new')->count();

        $stat_items = [
            ['label' => 'Pengunjung',        'val' => $stats['visitors']['period'],   'icon' => 'mdi-account-group-outline',    'color' => 'blue'],
            ['label' => 'Tampilan Halaman',  'val' => $stats['page_views']['period'], 'icon' => 'mdi-eye-outline',              'color' => 'green'],
            ['label' => 'WA Leads (Klik)',   'val' => $waClicks,                      'icon' => 'mdi-whatsapp',                 'color' => 'green'],
            ['label' => 'Leads Tersimpan',   'val' => $totalLeads,                    'icon' => 'mdi-account-star-outline',     'color' => 'amber'],
        ];
    @endphp

    <div class="stats fu" style="animation-delay:.12s">
        @foreach($stat_items as $item)
            <div class="sc">
                <div class="si {{ $item['color'] }}"><i class="mdi {{ $item['icon'] }}"></i></div>
                <div>
                    <div class="sv">{{ number_format($item['val']) }}</div>
                    <div class="sl">{{ $item['label'] }}</div>
                    <div style="font-size:.67rem;color:var(--text-muted);margin-top:1px;">{{ $periodLabel }}</div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Trend Chart --}}
    <div class="card-lux fu" style="animation-delay:.16s;margin-bottom:1.25rem;">
        <div class="card-head">
            <h3><span class="live-dot"></span> Tren Visual Konversi</h3>
            <div class="chart-legend">
                <div class="leg-item"><div class="leg-dot" style="background:#3b6ef8;"></div> Pengunjung</div>
                <div class="leg-item"><div class="leg-dot" style="background:#22c55e;"></div> WA Leads</div>
            </div>
        </div>
        <div class="chart-wrap">
            <div class="chart-box">
                <canvas id="unifiedChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Geolocation Chart --}}
    @php
        $geoLeads = \App\Models\Lead::selectRaw('TRIM(SUBSTRING_INDEX(company_location, "-", -1)) as region, COUNT(*) as total')
            ->whereNotNull('company_location')
            ->groupBy('region')
            ->orderByDesc('total')
            ->limit(10)
            ->get();
        $geoLeadsLabels = $geoLeads->pluck('region')->map(fn($r) => trim($r))->toArray();
        $geoLeadsData   = $geoLeads->pluck('total')->toArray();

        // UTM Source breakdown from leads
        $utmSources = \App\Models\Lead::selectRaw('COALESCE(utm_source, "Organik") as source, COUNT(*) as total')
            ->groupBy('source')
            ->orderByDesc('total')
            ->limit(8)
            ->get();
        $utmLabels = $utmSources->pluck('source')->toArray();
        $utmData   = $utmSources->pluck('total')->toArray();
    @endphp

    <div class="grid-2 fu" style="animation-delay:.18s;margin-bottom:1.25rem;">
        {{-- Geolocation Bar Chart --}}
        <div class="card-lux">
            <div class="card-head">
                <h3><i class="mdi mdi-map-marker-radius-outline" style="color:#3b6ef8;"></i> Sebaran Lokasi Leads</h3>
            </div>
            <div class="chart-wrap" style="padding:1.2rem;">
                <div class="chart-box" style="height:250px;">
                    <canvas id="geoChart"></canvas>
                </div>
                @if(count($geoLeadsData) === 0)
                    <div style="text-align:center;color:var(--text-muted);padding:30px 0;font-size:.83rem;"><i class="mdi mdi-map-marker-off-outline" style="font-size:2rem;display:block;margin-bottom:6px;"></i>Belum ada data lokasi leads</div>
                @endif
            </div>
        </div>

        {{-- UTM Source Doughnut Chart --}}
        <div class="card-lux">
            <div class="card-head">
                <h3><i class="mdi mdi-source-branch" style="color:#22c55e;"></i> Sumber Leads (UTM)</h3>
            </div>
            <div class="chart-wrap" style="padding:1.2rem;">
                <div style="position:relative;height:250px;display:flex;align-items:center;justify-content:center;">
                    <canvas id="utmChart"></canvas>
                </div>
                @if(count($utmData) === 0)
                    <div style="text-align:center;color:var(--text-muted);padding:30px 0;font-size:.83rem;"><i class="mdi mdi-chart-pie-outline" style="font-size:2rem;display:block;margin-bottom:6px;"></i>Belum ada data UTM source</div>
                @endif
            </div>
        </div>
    </div>

    {{-- Tables --}}
    <div class="grid-2 fu" style="animation-delay:.2s">

        {{-- Halaman Terpopuler --}}
        <div class="card-lux">
            <div class="card-head">
                <h3><i class="mdi mdi-fire" style="color:var(--accent-red);"></i> Halaman Terpopuler</h3>
            </div>
            <div class="table-responsive">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th style="width:36px">#</th>
                            <th>Halaman</th>
                            <th>Tayangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stats['page_views']['popular_pages'] as $i => $page)
                            <tr>
                                <td><span class="rank {{ $i < 3 ? 'g1' : 'g2' }}">{{ $i + 1 }}</span></td>
                                <td>
                                    <div style="font-weight:600;font-size:.83rem;">{{ $page->page_name ?: $page->page_path }}</div>
                                    @if($page->page_name)
                                        <div style="font-size:.68rem;color:var(--text-muted);font-family:'Inter',sans-serif;">{{ $page->page_path }}</div>
                                    @endif
                                </td>
                                <td>
                                    @php $maxPV = $stats['page_views']['popular_pages']->max('views'); @endphp
                                    <div class="vc-bar-wrap" style="justify-content:flex-end;">
                                        <div class="vc-bar">
                                            <div class="vc-bar-fill" style="width:{{ $maxPV ? round(($page->views / $maxPV) * 100) : 0 }}%;"></div>
                                        </div>
                                        <span class="vc">{{ number_format($page->views) }}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-row"><td colspan="3"><i class="mdi mdi-chart-line" style="font-size:1.4rem;display:block;margin-bottom:6px;"></i>Belum ada data halaman</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Blog Teratas --}}
        <div class="card-lux">
            <div class="card-head">
                <h3><i class="mdi mdi-newspaper-variant-outline" style="color:var(--accent);"></i> Konten Blog Teratas</h3>
            </div>
            <div class="table-responsive">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th style="width:36px">#</th>
                            <th>Judul Artikel</th>
                            <th>Tayangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stats['blog_views']['popular_blogs'] as $i => $blogView)
                            <tr>
                                <td><span class="rank {{ $i < 3 ? 'g1' : 'g2' }}">{{ $i + 1 }}</span></td>
                                <td>
                                    <div style="font-weight:600;font-size:.83rem;">
                                        {{ optional($blogView->blog)->title ?? 'Blog ID: ' . $blogView->blog_id }}
                                    </div>
                                    @if(optional($blogView->blog)->slug)
                                        <div style="font-size:.68rem;color:var(--text-muted);font-family:'Inter',sans-serif;">/blog/{{ $blogView->blog->slug }}</div>
                                    @endif
                                </td>
                                <td>
                                    @php $maxBV = $stats['blog_views']['popular_blogs']->max('views'); @endphp
                                    <div class="vc-bar-wrap" style="justify-content:flex-end;">
                                        <div class="vc-bar">
                                            <div class="vc-bar-fill" style="width:{{ $maxBV ? round(($blogView->views / $maxBV) * 100) : 0 }}%;background:var(--accent-green);"></div>
                                        </div>
                                        <span class="vc">{{ number_format($blogView->views) }}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-row"><td colspan="3"><i class="mdi mdi-newspaper-variant-multiple-outline" style="font-size:1.4rem;display:block;margin-bottom:6px;"></i>Belum ada data artikel</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const dailyStats  = @json($stats['daily_stats']);
    const period      = '{{ $period }}';
    const fallbackDays = period === 'today' ? 1 : period === '30d' ? 30 : 7;

    const dateSet = new Set([
        ...(dailyStats.visitors   || []).map(d => d.date),
        ...(dailyStats.page_views || []).map(d => d.date),
        ...(dailyStats.cta_clicks || []).map(d => d.date),
    ]);

    const sortedDates = Array.from(dateSet).sort();
    const chartDates  = sortedDates.length ? sortedDates : Array.from({ length: fallbackDays }, (_, i) => {
        const d = new Date();
        d.setDate(d.getDate() - (fallbackDays - i - 1));
        return `${d.getFullYear()}-${String(d.getMonth()+1).padStart(2,'0')}-${String(d.getDate()).padStart(2,'0')}`;
    });

    const labels      = chartDates.map(s => new Date(`${s}T00:00:00`).toLocaleDateString('id-ID', { month: 'short', day: 'numeric' }));
    const visitorData = chartDates.map(s => (dailyStats.visitors   || []).find(d => d.date === s)?.count ?? 0);
    const waData      = chartDates.map(s => (dailyStats.cta_clicks || []).find(d => d.date === s && d.type === 'whatsapp')?.count ?? 0);

    // Theme colors
    const blue   = '#3b6ef8';
    const green  = '#22c55e';
    const amber  = '#f59e0b';
    const gridC  = 'rgba(15,23,36,.06)';
    const tickC  = '#9aa3b8';

    new Chart(document.getElementById('unifiedChart').getContext('2d'), {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'Pengunjung',
                    data: visitorData,
                    borderColor: blue,
                    backgroundColor: 'rgba(59,110,248,.08)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: blue,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    borderWidth: 2.5,
                },
                {
                    label: 'WA Leads',
                    data: waData,
                    borderColor: green,
                    backgroundColor: 'rgba(34,197,94,0.08)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: green,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    borderWidth: 2,
                    borderDash: [5, 4],
                }
            ]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#ffffff',
                    titleColor: '#0f1724',
                    bodyColor: '#5a6478',
                    borderColor: '#e4e8f0',
                    borderWidth: 1,
                    padding: 12,
                    boxPadding: 5,
                    titleFont: { family: "'Plus Jakarta Sans', sans-serif", weight: '700', size: 12 },
                    bodyFont: { family: "'Plus Jakarta Sans', sans-serif", size: 12 },
                    callbacks: {
                        label: ctx => ` ${ctx.dataset.label}: ${ctx.parsed.y.toLocaleString('id-ID')}`
                    }
                }
            },
            scales: {
                x: {
                    grid: { color: gridC, drawBorder: false },
                    ticks: { color: tickC, font: { family: "'Plus Jakarta Sans', sans-serif", size: 11 } }
                },
                y: {
                    grid: { color: gridC, drawBorder: false },
                    ticks: { color: tickC, font: { family: "'Plus Jakarta Sans', sans-serif", size: 11 }, precision: 0 },
                    beginAtZero: true
                }
            }
        }
    });

    // === Geolocation Bar Chart ===
    const geoLabels = @json($geoLeadsLabels);
    const geoData   = @json($geoLeadsData);
    const geoColors = [
        '#3b6ef8','#22c55e','#f59e0b','#ef4444','#8b5cf6',
        '#06b6d4','#ec4899','#84cc16','#f97316','#14b8a6'
    ];

    if (geoLabels.length > 0) {
        new Chart(document.getElementById('geoChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: geoLabels,
                datasets: [{
                    label: 'Jumlah Leads',
                    data: geoData,
                    backgroundColor: geoColors.slice(0, geoData.length).map(c => c + 'cc'),
                    borderColor: geoColors.slice(0, geoData.length),
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#0f1724',
                        bodyColor: '#5a6478',
                        borderColor: '#e4e8f0',
                        borderWidth: 1,
                        padding: 10,
                        titleFont: { family: "'Plus Jakarta Sans', sans-serif", weight: '700', size: 12 },
                        bodyFont: { family: "'Plus Jakarta Sans', sans-serif", size: 12 },
                        callbacks: { label: ctx => ` ${ctx.parsed.x} leads` }
                    }
                },
                scales: {
                    x: { grid: { color: gridC }, ticks: { color: tickC, precision: 0, font: { size: 11 } } },
                    y: { grid: { display: false }, ticks: { color: '#0f1724', font: { size: 11, weight: '600' } } }
                }
            }
        });
    }

    // === UTM Source Doughnut Chart ===
    const utmLabels = @json($utmLabels);
    const utmData   = @json($utmData);
    const utmColors = ['#3b6ef8','#22c55e','#f59e0b','#ef4444','#8b5cf6','#06b6d4','#ec4899','#84cc16'];

    if (utmLabels.length > 0) {
        new Chart(document.getElementById('utmChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: utmLabels,
                datasets: [{
                    data: utmData,
                    backgroundColor: utmColors.slice(0, utmData.length).map(c => c + 'cc'),
                    borderColor: utmColors.slice(0, utmData.length),
                    borderWidth: 2,
                    hoverOffset: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        display: true,
                        position: 'right',
                        labels: {
                            font: { family: "'Plus Jakarta Sans', sans-serif", size: 11 },
                            color: '#5a6478',
                            usePointStyle: true,
                            pointStyleWidth: 8,
                            padding: 10
                        }
                    },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#0f1724',
                        bodyColor: '#5a6478',
                        borderColor: '#e4e8f0',
                        borderWidth: 1,
                        padding: 10,
                        callbacks: {
                            label: ctx => ` ${ctx.label}: ${ctx.parsed} leads (${Math.round(ctx.parsed/utmData.reduce((a,b)=>a+b,0)*100)}%)`
                        }
                    }
                }
            }
        });
    }
});
</script>
@endpush
@endsection