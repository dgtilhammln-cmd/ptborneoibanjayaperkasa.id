@extends('layouts.app')

@section('content')
<!-- Google Fonts: DM Sans + DM Serif Display -->
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">

<style>
/* ─────────────────────────────────────────────
   RESET & BASE
───────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
a, button { text-decoration: none !important; outline: none; }

:root {
    --bg:            #F0F4FA;
    --surface:       #FFFFFF;
    --surface-2:     #F7F9FC;
    --border:        #E4EAF3;
    --text-primary:  #0D1B3E;
    --text-muted:    #7A8BAD;
    --text-light:    #B0BCCF;

    --brand:         #2563EB;
    --brand-light:   #EEF4FF;
    --brand-mid:     #BFCFFE;
    --accent-green:  #16A34A;
    --accent-teal:   #0891B2;
    --accent-amber:  #D97706;
    --accent-rose:   #E11D48;

    --radius-sm:  10px;
    --radius-md:  16px;
    --radius-lg:  24px;
    --radius-xl:  32px;

    --shadow-xs: 0 1px 3px rgba(13,27,62,.06);
    --shadow-sm: 0 4px 16px rgba(13,27,62,.08);
    --shadow-md: 0 8px 32px rgba(13,27,62,.10);
    --shadow-lg: 0 16px 48px rgba(13,27,62,.12);

    --transition: all 0.28s cubic-bezier(0.4, 0, 0.2, 1);
}

body {
    background: var(--bg);
    font-family: 'DM Sans', sans-serif;
    color: var(--text-primary);
    min-height: 100vh;
    -webkit-font-smoothing: antialiased;
}

/* ─────────────────────────────────────────────
   SCROLLBAR
───────────────────────────────────────────── */
::-webkit-scrollbar { width: 6px; height: 6px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: var(--border); border-radius: 99px; }
::-webkit-scrollbar-thumb:hover { background: var(--brand-mid); }

/* ─────────────────────────────────────────────
   LAYOUT WRAPPER
───────────────────────────────────────────── */
.an-wrap {
    max-width: 1440px;
    margin: 0 auto;
    padding: 32px 28px 60px;
}

/* ─────────────────────────────────────────────
   PAGE HEADER
───────────────────────────────────────────── */
.an-header {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 36px;
}

.an-header__greeting small {
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: var(--brand);
    display: block;
    margin-bottom: 6px;
}

.an-header__greeting h1 {
    font-family: 'DM Serif Display', serif;
    font-size: clamp(24px, 4vw, 38px);
    font-weight: 400;
    color: var(--text-primary);
    line-height: 1.15;
}

.an-header__greeting p {
    margin-top: 6px;
    font-size: 14px;
    color: var(--text-muted);
}

/* Period Controls */
.an-controls {
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: flex-end;
}

.period-tabs {
    display: flex;
    gap: 4px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 4px;
}

.period-tab {
    padding: 7px 18px;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-muted);
    border-radius: 8px;
    border: none;
    background: transparent;
    cursor: pointer;
    transition: var(--transition);
    white-space: nowrap;
    font-family: 'DM Sans', sans-serif;
}

.period-tab:hover { color: var(--brand); background: var(--brand-light); }
.period-tab.active { background: var(--brand); color: #fff !important; box-shadow: 0 4px 12px rgba(37,99,235,.3); }

.date-filter {
    display: flex;
    gap: 8px;
    align-items: center;
    flex-wrap: wrap;
}

.date-input {
    height: 38px;
    padding: 0 12px;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 500;
    color: var(--text-primary);
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    outline: none;
    transition: var(--transition);
    cursor: pointer;
}

.date-input:focus { border-color: var(--brand); box-shadow: 0 0 0 3px rgba(37,99,235,.12); }

.btn-filter {
    height: 38px;
    padding: 0 20px;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 600;
    color: #fff !important;
    background: var(--brand);
    border: none;
    border-radius: var(--radius-sm);
    cursor: pointer;
    transition: var(--transition);
    box-shadow: 0 4px 12px rgba(37,99,235,.3);
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.btn-filter:hover { background: #1d4ed8; transform: translateY(-1px); box-shadow: 0 6px 18px rgba(37,99,235,.4); }

/* ─────────────────────────────────────────────
   STAT CARDS
───────────────────────────────────────────── */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 28px;
}

.stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px 22px 20px;
    box-shadow: var(--shadow-xs);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.stat-card::after {
    content: '';
    position: absolute;
    bottom: -30px; right: -30px;
    width: 100px; height: 100px;
    border-radius: 50%;
    background: var(--card-accent-bg, rgba(37,99,235,.06));
    pointer-events: none;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: var(--card-accent, var(--brand));
    opacity: 0;
    transition: var(--transition);
}

.stat-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-md); }
.stat-card:hover::before { opacity: 1; }

.stat-card--visitors { --card-accent: var(--brand); --card-accent-bg: rgba(37,99,235,.06); }
.stat-card--wa       { --card-accent: var(--accent-green); --card-accent-bg: rgba(22,163,74,.06); }
.stat-card--phone    { --card-accent: var(--accent-teal); --card-accent-bg: rgba(8,145,178,.06); }
.stat-card--views    { --card-accent: var(--accent-amber); --card-accent-bg: rgba(217,119,6,.06); }

.stat-card__top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 16px;
}

.stat-card__label {
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.6px;
    text-transform: uppercase;
    color: var(--text-muted);
    line-height: 1.4;
    max-width: 130px;
}

.stat-icon {
    width: 44px; height: 44px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
    background: var(--icon-bg, var(--brand-light));
    color: var(--icon-color, var(--brand));
}

.stat-card--visitors .stat-icon { --icon-bg: #EEF4FF; --icon-color: var(--brand); }
.stat-card--wa       .stat-icon { --icon-bg: #F0FDF4; --icon-color: var(--accent-green); }
.stat-card--phone    .stat-icon { --icon-bg: #ECFEFF; --icon-color: var(--accent-teal); }
.stat-card--views    .stat-icon { --icon-bg: #FFFBEB; --icon-color: var(--accent-amber); }

.stat-card__value {
    font-family: 'DM Serif Display', serif;
    font-size: clamp(28px, 3vw, 42px);
    font-weight: 400;
    color: var(--text-primary);
    line-height: 1;
    margin-bottom: 10px;
}

.stat-card__badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 11px;
    font-weight: 700;
    padding: 3px 9px;
    border-radius: 99px;
    background: #F0FDF4;
    color: var(--accent-green);
}

/* ─────────────────────────────────────────────
   CHART CARD
───────────────────────────────────────────── */
.chart-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 28px;
    box-shadow: var(--shadow-xs);
    margin-bottom: 24px;
    transition: var(--transition);
}

.chart-card:hover { box-shadow: var(--shadow-sm); }

.card-header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 14px;
}

.card-title {
    font-family: 'DM Serif Display', serif;
    font-size: 20px;
    font-weight: 400;
    color: var(--text-primary);
}

.card-subtitle {
    font-size: 13px;
    color: var(--text-muted);
    margin-top: 3px;
}

.chart-legend {
    display: flex;
    gap: 18px;
    flex-wrap: wrap;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 12px;
    font-weight: 600;
    color: var(--text-muted);
}

.legend-dot {
    width: 10px; height: 10px;
    border-radius: 50%;
    flex-shrink: 0;
}

.chart-wrap {
    position: relative;
    height: 300px;
}

/* ─────────────────────────────────────────────
   BOTTOM GRID
───────────────────────────────────────────── */
.bottom-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.table-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px;
    box-shadow: var(--shadow-xs);
    transition: var(--transition);
}

.table-card:hover { box-shadow: var(--shadow-sm); }

.an-table {
    width: 100%;
    border-collapse: collapse;
}

.an-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: var(--transition);
}

.an-table tbody tr:last-child { border-bottom: none; }
.an-table tbody tr:hover { background: var(--surface-2); border-radius: 8px; }

.an-table td {
    padding: 13px 8px;
    font-size: 13.5px;
    color: var(--text-primary);
    vertical-align: middle;
}

.an-table td:first-child {
    color: var(--text-muted);
    font-weight: 500;
    padding-left: 0;
}

.an-table td:last-child {
    text-align: right;
    padding-right: 0;
    font-weight: 700;
    color: var(--brand);
    font-family: 'DM Serif Display', serif;
    font-size: 17px;
}

.rank-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 22px; height: 22px;
    border-radius: 50%;
    background: var(--brand-light);
    color: var(--brand);
    font-size: 10px;
    font-weight: 700;
    margin-right: 8px;
    flex-shrink: 0;
}

.page-cell { display: flex; align-items: center; }

.see-details {
    font-size: 12px;
    font-weight: 600;
    color: var(--brand) !important;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 5px 12px;
    border-radius: 8px;
    background: var(--brand-light);
    transition: var(--transition);
    white-space: nowrap;
}
.see-details:hover { background: var(--brand); color: #fff !important; }

/* ─────────────────────────────────────────────
   ANIMATIONS
───────────────────────────────────────────── */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
}

.fade-up {
    opacity: 0;
    animation: fadeUp 0.55s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

/* ─────────────────────────────────────────────
   RESPONSIVE
───────────────────────────────────────────── */
@media (max-width: 1100px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 768px) {
    .an-wrap { padding: 20px 16px 48px; }
    .an-header { flex-direction: column; align-items: flex-start; }
    .an-controls { align-items: flex-start; width: 100%; }
    .period-tabs { width: 100%; }
    .period-tab { flex: 1; text-align: center; padding: 7px 8px; font-size: 12px; }
    .date-filter { width: 100%; }
    .date-input { flex: 1; min-width: 120px; }
    .btn-filter { width: 100%; justify-content: center; }
    .stats-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
    .bottom-grid { grid-template-columns: 1fr; }
    .chart-wrap { height: 220px; }
    .card-header-row { flex-direction: column; align-items: flex-start; }
    .stat-card { padding: 18px 16px 14px; }
    .chart-card, .table-card { padding: 20px 16px; }
}

@media (max-width: 400px) {
    .stats-grid { grid-template-columns: 1fr; }
}
</style>

<div class="an-wrap">

    <!-- ── HEADER ── -->
    <div class="an-header fade-up" style="animation-delay:.05s">
        <div class="an-header__greeting">
            <small>Analytics Dashboard</small>
            <h1>Intelijen Analitik</h1>
            <p>Laporan performa konversi &amp; trafik realtime.</p>
        </div>

        <div class="an-controls">
            <div class="period-tabs">
                <a href="{{ route('admin.analytics.index', ['period' => 'today']) }}"
                   class="period-tab {{ $period == 'today' ? 'active' : '' }}">Hari Ini</a>
                <a href="{{ route('admin.analytics.index', ['period' => '7d']) }}"
                   class="period-tab {{ $period == '7d' ? 'active' : '' }}">7 Hari</a>
                <a href="{{ route('admin.analytics.index', ['period' => '30d']) }}"
                   class="period-tab {{ $period == '30d' ? 'active' : '' }}">30 Hari</a>
            </div>

            <form action="{{ route('admin.analytics.index') }}" method="GET" class="date-filter">
                <input type="hidden" name="period" value="{{ $period }}">
                <input type="date" name="start_date" class="date-input" value="{{ request('start_date') }}">
                <input type="date" name="end_date"   class="date-input" value="{{ request('end_date') }}">
                <button type="submit" class="btn-filter">
                    <i class="mdi mdi-filter-variant"></i> Filter
                </button>
            </form>
        </div>
    </div>

    <!-- ── STAT CARDS ── -->
    @php
        $periodLabel = (request('start_date') || request('end_date'))
            ? 'Rentang Custom'
            : match($period) {
                'today' => 'Hari Ini',
                '7d'    => '7 Hari Terakhir',
                '30d'   => '30 Hari Terakhir',
                '90d'   => '90 Hari Terakhir',
                '1y'    => '12 Bulan Terakhir',
                default => 'Periode',
            };

        $cards = [
            [
                'type'  => 'visitors',
                'label' => "Pengunjung · {$periodLabel}",
                'val'   => $stats['visitors']['period'],
                'icon'  => 'mdi-account-multiple',
            ],
            [
                'type'  => 'wa',
                'label' => "WA Leads · {$periodLabel}",
                'val'   => $stats['cta_clicks']['by_type']->where('cta_type', 'whatsapp')->first()->clicks ?? 0,
                'icon'  => 'mdi-whatsapp',
            ],
            [
                'type'  => 'phone',
                'label' => "Telepon · {$periodLabel}",
                'val'   => $stats['cta_clicks']['by_type']->where('cta_type', 'phone')->first()->clicks ?? 0,
                'icon'  => 'mdi-phone-incoming',
            ],
            [
                'type'  => 'views',
                'label' => "Tampilan Halaman · {$periodLabel}",
                'val'   => $stats['page_views']['period'],
                'icon'  => 'mdi-eye-outline',
            ],
        ];
    @endphp

    <div class="stats-grid">
        @foreach($cards as $i => $card)
        <div class="stat-card stat-card--{{ $card['type'] }} fade-up" style="animation-delay:{{ 0.1 + $i * 0.08 }}s">
            <div class="stat-card__top">
                <div class="stat-card__label">{{ $card['label'] }}</div>
                <div class="stat-icon"><i class="mdi {{ $card['icon'] }}"></i></div>
            </div>
            <div class="stat-card__value">{{ number_format($card['val']) }}</div>
            <span class="stat-card__badge">
                <i class="mdi mdi-circle" style="font-size:7px"></i> Live
            </span>
        </div>
        @endforeach
    </div>

    <!-- ── CHART ── -->
    <div class="chart-card fade-up" style="animation-delay:.42s">
        <div class="card-header-row">
            <div>
                <div class="card-title">Tren Visual Konversi</div>
                <div class="card-subtitle">Visitor, WA Leads &amp; Phone Leads dalam periode terpilih</div>
            </div>
            <div class="chart-legend">
                <div class="legend-item">
                    <span class="legend-dot" style="background:#2563EB"></span> Visitors
                </div>
                <div class="legend-item">
                    <span class="legend-dot" style="background:#16A34A"></span> WA Leads
                </div>
                <div class="legend-item">
                    <span class="legend-dot" style="background:#0891B2"></span> Phone Leads
                </div>
            </div>
        </div>
        <div class="chart-wrap">
            <canvas id="unifiedChart"></canvas>
        </div>
    </div>

    <!-- ── BOTTOM TABLES ── -->
    <div class="bottom-grid">
        <div class="table-card fade-up" style="animation-delay:.52s">
            <div class="card-header-row">
                <div>
                    <div class="card-title">Halaman Terpopuler</div>
                    <div class="card-subtitle">Berdasarkan jumlah tampilan</div>
                </div>
                <a href="#" class="see-details">Lihat Detail <i class="mdi mdi-arrow-right" style="font-size:14px"></i></a>
            </div>
            <table class="an-table">
                <tbody>
                    @foreach($stats['page_views']['popular_pages'] as $idx => $page)
                    <tr>
                        <td>
                            <div class="page-cell">
                                <span class="rank-badge">{{ $idx + 1 }}</span>
                                {{ $page->page_name ?: $page->page_path }}
                            </div>
                        </td>
                        <td>{{ number_format($page->views) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="table-card fade-up" style="animation-delay:.60s">
            <div class="card-header-row">
                <div>
                    <div class="card-title">Konten Blog Teratas</div>
                    <div class="card-subtitle">Artikel dengan performa terbaik</div>
                </div>
                <a href="#" class="see-details">Lihat Detail <i class="mdi mdi-arrow-right" style="font-size:14px"></i></a>
            </div>
            <table class="an-table">
                <tbody>
                    @foreach($stats['blog_views']['popular_blogs'] as $idx => $blogView)
                    <tr>
                        <td>
                            <div class="page-cell">
                                <span class="rank-badge">{{ $idx + 1 }}</span>
                                {{ optional($blogView->blog)->title ?? 'Blog ID: ' . $blogView->blog_id }}
                            </div>
                        </td>
                        <td>{{ number_format($blogView->views) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div><!-- /an-wrap -->

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const dailyStats   = @json($stats['daily_stats']);
    const period       = '{{ $period }}';
    const fallbackDays = (period === 'today') ? 1 : (period === '30d') ? 30 : 7;

    const dateSet = new Set([
        ...(dailyStats.visitors   || []).map(d => d.date),
        ...(dailyStats.page_views || []).map(d => d.date),
        ...(dailyStats.cta_clicks || []).map(d => d.date),
    ]);

    const sortedDates = Array.from(dateSet).sort();
    const chartDates  = sortedDates.length
        ? sortedDates
        : Array.from({ length: fallbackDays }, (_, i) => {
            const d = new Date();
            d.setDate(d.getDate() - (fallbackDays - i - 1));
            return `${d.getFullYear()}-${String(d.getMonth()+1).padStart(2,'0')}-${String(d.getDate()).padStart(2,'0')}`;
          });

    const labels      = chartDates.map(ds => new Date(`${ds}T00:00:00`).toLocaleDateString('id-ID', { month: 'short', day: 'numeric' }));
    const visitorData = chartDates.map(ds => (dailyStats.visitors   || []).find(d => d.date === ds)?.count ?? 0);
    const waData      = chartDates.map(ds => (dailyStats.cta_clicks || []).find(d => d.date === ds && d.type === 'whatsapp')?.count ?? 0);
    const phoneData   = chartDates.map(ds => (dailyStats.cta_clicks || []).find(d => d.date === ds && d.type === 'phone')?.count ?? 0);

    const ctx = document.getElementById('unifiedChart').getContext('2d');
    const gV  = ctx.createLinearGradient(0, 0, 0, 300);
    gV.addColorStop(0, 'rgba(37,99,235,0.15)');
    gV.addColorStop(1, 'rgba(37,99,235,0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'Visitors',
                    data: visitorData,
                    borderColor: '#2563EB',
                    backgroundColor: gV,
                    tension: 0.45, fill: true,
                    pointRadius: 4, pointHoverRadius: 7,
                    pointBackgroundColor: '#2563EB',
                    pointBorderColor: '#fff', pointBorderWidth: 2,
                    borderWidth: 2.5,
                },
                {
                    label: 'WA Leads',
                    data: waData,
                    borderColor: '#16A34A',
                    backgroundColor: 'transparent',
                    tension: 0.45, fill: false,
                    pointRadius: 4, pointHoverRadius: 7,
                    pointBackgroundColor: '#16A34A',
                    pointBorderColor: '#fff', pointBorderWidth: 2,
                    borderDash: [6, 4], borderWidth: 2,
                },
                {
                    label: 'Phone Leads',
                    data: phoneData,
                    borderColor: '#0891B2',
                    backgroundColor: 'transparent',
                    tension: 0.45, fill: false,
                    pointRadius: 4, pointHoverRadius: 7,
                    pointBackgroundColor: '#0891B2',
                    pointBorderColor: '#fff', pointBorderWidth: 2,
                    borderDash: [3, 3], borderWidth: 2,
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
                    backgroundColor: '#fff',
                    titleColor: '#0D1B3E',
                    bodyColor: '#7A8BAD',
                    borderColor: '#E4EAF3',
                    borderWidth: 1,
                    padding: 14,
                    cornerRadius: 14,
                    titleFont: { family: 'DM Sans', weight: '700', size: 13 },
                    bodyFont:  { family: 'DM Sans', size: 12 },
                    callbacks: {
                        label: ctx => ` ${ctx.dataset.label}: ${ctx.parsed.y.toLocaleString('id-ID')}`
                    }
                }
            },
            scales: {
                x: {
                    grid: { color: 'rgba(0,0,0,.04)', drawBorder: false },
                    ticks: { color: '#7A8BAD', font: { family: 'DM Sans', size: 11, weight: '500' } },
                    border: { display: false }
                },
                y: {
                    grid: { color: 'rgba(0,0,0,.04)', drawBorder: false },
                    ticks: { color: '#7A8BAD', font: { family: 'DM Sans', size: 11 }, padding: 8 },
                    border: { display: false },
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endpush
@endsection