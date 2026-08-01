@extends('layouts.app')

@section('title', 'Manajemen Produk')

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
        --accent-teal: #06b6d4;
        --accent-teal-light: #ecfeff;
        --accent-violet: #7c3aed;
        --accent-violet-light: #ede9fe;
        --accent-green: #10b981;
        --accent-green-light: #ecfdf5;
        --accent-red: #ef4444;
        --accent-red-light: #fef2f2;
        --accent-amber: #f59e0b;
        --accent-amber-light: #fffbeb;
        --text-primary: #0f172a;
        --text-secondary: #64748b;
        --text-muted: #94a3b8;
        --border: #e2e8f0;
        --border-hover: #bfdbfe;
        --shadow-sm: 0 1px 3px rgba(59,130,246,0.06), 0 1px 2px rgba(0,0,0,0.04);
        --shadow-md: 0 4px 16px rgba(59,130,246,0.10), 0 2px 4px rgba(0,0,0,0.04);
        --radius-sm: 10px;
        --radius-md: 14px;
        --radius-lg: 20px;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    .prod-wrap {
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
        padding: 22px 28px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }
    .page-header-left { display: flex; align-items: center; gap: 14px; }
    .page-header-icon {
        width: 48px; height: 48px;
        background: var(--accent-blue-light);
        border-radius: var(--radius-md);
        border: 1px solid var(--accent-blue-mid);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem;
        color: var(--accent-blue);
        flex-shrink: 0;
    }
    .page-title { font-size: 1.15rem; font-weight: 800; color: var(--text-primary); line-height: 1.2; }
    .page-sub   { font-size: 0.75rem; color: var(--text-muted); margin-top: 3px; }

    .btn-primary {
        background: var(--accent-blue);
        color: #fff;
        border: none;
        border-radius: var(--radius-sm);
        padding: 10px 20px;
        font-size: 0.83rem;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        box-shadow: 0 4px 14px rgba(59,130,246,0.35);
        transition: all 0.2s ease;
        text-decoration: none;
        font-family: 'Plus Jakarta Sans', sans-serif;
        white-space: nowrap;
    }
    .btn-primary:hover {
        background: var(--accent-blue-dark);
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(59,130,246,0.4);
        color: #fff;
        text-decoration: none;
    }

    /* ── STATS STRIP ── */
    .stats-strip {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-bottom: 20px;
    }
    .strip-card {
        background: var(--bg-card);
        border-radius: var(--radius-md);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-sm);
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 14px;
        transition: all 0.2s;
    }
    .strip-card:hover { box-shadow: var(--shadow-md); transform: translateY(-1px); border-color: var(--border-hover); }
    .strip-icon {
        width: 44px; height: 44px;
        border-radius: var(--radius-sm);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .ic-blue   { background: var(--accent-blue-light);   color: var(--accent-blue); }
    .ic-green  { background: var(--accent-green-light);  color: var(--accent-green); }
    .ic-violet { background: var(--accent-violet-light); color: var(--accent-violet); }
    .strip-label { font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: var(--text-muted); }
    .strip-value { font-size: 1.6rem; font-weight: 800; color: var(--text-primary); line-height: 1; }

    /* ── MAIN CARD ── */
    .main-card {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }
    .main-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .card-title {
        font-size: 0.92rem; font-weight: 700; color: var(--text-primary);
        display: flex; align-items: center; gap: 8px;
    }
    .card-title-icon {
        width: 30px; height: 30px; border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.85rem;
    }
    .total-badge {
        font-size: 0.72rem; font-weight: 700;
        background: var(--accent-blue-light);
        color: var(--accent-blue-dark);
        border: 1px solid var(--accent-blue-mid);
        padding: 4px 12px; border-radius: 50px;
    }

    /* ── SEARCH ── */
    .search-wrap { position: relative; display: flex; align-items: center; }
    .search-wrap i { position: absolute; left: 12px; color: var(--text-muted); font-size: 1rem; pointer-events: none; }
    .search-input {
        padding: 8px 14px 8px 36px;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        font-size: 0.8rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg-page);
        color: var(--text-primary);
        outline: none;
        width: 210px;
        transition: all 0.2s;
    }
    .search-input:focus { border-color: var(--accent-blue-mid); background: #fff; box-shadow: 0 0 0 3px rgba(59,130,246,0.08); }

    /* ── TABLE ── */
    .prod-table { width: 100%; border-collapse: collapse; }
    .prod-table thead th {
        font-size: 0.67rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: 1px;
        color: var(--text-muted);
        padding: 0 20px 14px;
        border-bottom: 1px solid var(--border);
        text-align: left;
    }
    .prod-table thead th:last-child { text-align: right; }
    .prod-table tbody tr { border-bottom: 1px solid var(--border); transition: background 0.15s; }
    .prod-table tbody tr:last-child { border-bottom: none; }
    .prod-table tbody tr:hover { background: var(--bg-page); }
    .prod-table td { padding: 16px 20px; vertical-align: middle; }

    .prod-thumb {
        width: 48px; height: 48px; border-radius: var(--radius-sm);
        object-fit: cover; border: 1px solid var(--border); flex-shrink: 0;
    }
    .prod-thumb-placeholder {
        width: 48px; height: 48px; border-radius: var(--radius-sm);
        background: var(--accent-blue-light); border: 1px solid var(--accent-blue-mid);
        display: flex; align-items: center; justify-content: center;
        color: var(--accent-blue); font-size: 1.1rem; flex-shrink: 0;
    }
    .prod-name { font-size: 0.87rem; font-weight: 700; color: var(--text-primary); line-height: 1.3; }
    .prod-uid  { font-size: 0.68rem; color: var(--text-muted); margin-top: 2px; }

    .cat-badge {
        font-size: 0.68rem; font-weight: 700;
        padding: 4px 12px; border-radius: 50px;
        background: var(--accent-violet-light);
        color: var(--accent-violet);
        border: 1px solid #ddd6fe;
        display: inline-flex; align-items: center; gap: 4px;
    }
    .cat-na { color: var(--text-muted); font-size: 0.75rem; font-style: italic; }

    .date-text { font-size: 0.78rem; color: var(--text-secondary); display: flex; align-items: center; gap: 6px; }

    .btn-action {
        width: 34px; height: 34px; border-radius: 9px;
        display: inline-flex; align-items: center; justify-content: center;
        border: 1px solid var(--border); background: var(--bg-page);
        color: var(--text-secondary); transition: all 0.2s;
        text-decoration: none; font-size: 0.88rem; cursor: pointer;
        font-family: inherit;
    }
    .btn-action:hover { background: var(--accent-blue-light); border-color: var(--accent-blue-mid); color: var(--accent-blue); text-decoration: none; }
    .btn-action.del:hover { background: var(--accent-red-light); border-color: #fecaca; color: var(--accent-red); }

    /* ── EMPTY STATE ── */
    .empty-state { text-align: center; padding: 60px 20px; }
    .empty-icon {
        width: 72px; height: 72px; background: var(--accent-blue-light);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 1.8rem; color: var(--accent-blue); margin: 0 auto 16px;
    }
    .empty-title { font-size: 0.95rem; font-weight: 700; color: var(--text-primary); margin-bottom: 6px; }
    .empty-sub   { font-size: 0.78rem; color: var(--text-muted); }

    /* ── PAGINATION ── */
    .pagination-wrap {
        padding: 16px 24px; border-top: 1px solid var(--border);
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 12px;
    }
    .pagination-info { font-size: 0.75rem; color: var(--text-muted); }
    .pagination { display: flex; gap: 4px; list-style: none; margin: 0; padding: 0; }
    .pagination .page-item .page-link {
        padding: 6px 12px; border-radius: 8px;
        border: 1px solid var(--border); background: var(--bg-page);
        color: var(--text-secondary); font-size: 0.78rem; font-weight: 600;
        font-family: 'Plus Jakarta Sans', sans-serif;
        text-decoration: none; transition: all 0.2s;
        display: flex; align-items: center;
    }
    .pagination .page-item .page-link:hover { background: var(--accent-blue-light); border-color: var(--accent-blue-mid); color: var(--accent-blue); }
    .pagination .page-item.active .page-link { background: var(--accent-blue); border-color: var(--accent-blue); color: #fff; }
    .pagination .page-item.disabled .page-link { opacity: 0.4; pointer-events: none; }

    /* ── ANIMATIONS ── */
    @keyframes fadeUp { from{opacity:0;transform:translateY(14px)} to{opacity:1;transform:translateY(0)} }
    .anim { opacity: 0; animation: fadeUp 0.45s ease forwards; }

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) { .stats-strip { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 640px) {
        .prod-wrap { padding: 14px 12px 40px; }
        .stats-strip { grid-template-columns: 1fr; }
        .page-header { flex-direction: column; align-items: flex-start; }
        .main-card-header { flex-direction: column; align-items: flex-start; }
        .search-input { width: 100%; }
        .prod-table thead th, .prod-table td { padding: 12px 14px; }
    }
</style>

<div class="prod-wrap">

    {{-- PAGE HEADER --}}
    <div class="page-header anim" style="animation-delay:0.05s">
        <div class="page-header-left">
            <div class="page-header-icon">
                <i class="mdi mdi-package-variant-closed"></i>
            </div>
            <div>
                <div class="page-title">Manajemen Produk</div>
                <div class="page-sub">Kelola seluruh katalog produk dalam satu tempat</div>
            </div>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-primary">
            <i class="mdi mdi-plus"></i> Tambah Produk Baru
        </a>
    </div>

    {{-- STATS STRIP --}}
    <div class="stats-strip">
        <div class="strip-card anim" style="animation-delay:0.1s">
            <div class="strip-icon ic-blue"><i class="mdi mdi-package-variant-closed"></i></div>
            <div>
                <div class="strip-label">Total Produk</div>
                <div class="strip-value">{{ $products->total() }}</div>
            </div>
        </div>
        <div class="strip-card anim" style="animation-delay:0.15s">
            <div class="strip-icon ic-green"><i class="mdi mdi-list-box-outline"></i></div>
            <div>
                <div class="strip-label">Ditampilkan</div>
                <div class="strip-value">{{ $products->count() }}</div>
            </div>
        </div>
        <div class="strip-card anim" style="animation-delay:0.2s">
            <div class="strip-icon ic-violet"><i class="mdi mdi-book-open-page-variant-outline"></i></div>
            <div>
                <div class="strip-label">Total Halaman</div>
                <div class="strip-value">{{ $products->lastPage() }}</div>
            </div>
        </div>
    </div>

    {{-- MAIN TABLE CARD --}}
    <div class="main-card anim" style="animation-delay:0.22s">
        <div class="main-card-header">
            <div class="card-title">
                <div class="card-title-icon ic-blue"><i class="mdi mdi-format-list-bulleted"></i></div>
                Daftar Produk
                <span class="total-badge">{{ $products->total() }} entri</span>
            </div>
            <div class="search-wrap">
                <i class="mdi mdi-magnify"></i>
                <input type="text" class="search-input" id="tableSearch" placeholder="Cari produk...">
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table class="prod-table" id="prodTable">
                <thead>
                    <tr>
                        <th>Detail Produk</th>
                        <th>Kategori</th>
                        <th>Tanggal Input</th>
                        <th style="text-align:right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>
                            <div style="display:flex; align-items:center; gap:12px;">
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" class="prod-thumb" alt="">
                                @else
                                    <div class="prod-thumb-placeholder">
                                        <i class="mdi mdi-image-off-outline"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="prod-name">{{ Str::limit($product->name, 40) }}</div>
                                    <div class="prod-uid">#P-{{ $product->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @php
                                $category = \App\Models\ProductCategory::where('slug', $product->category)->first();
                            @endphp
                            @if($category)
                                <span class="cat-badge">
                                    <i class="mdi mdi-tag-outline"></i>{{ $category->name }}
                                </span>
                            @else
                                <span class="cat-na">{{ $product->category ?? 'N/A' }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="date-text">
                                <i class="mdi mdi-calendar-outline"></i>
                                {{ $product->created_at->format('d M Y') }}
                            </div>
                        </td>
                        <td style="text-align:right">
                            <div style="display:flex; justify-content:flex-end; gap:8px;">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn-action" title="Edit Produk">
                                    <i class="mdi mdi-pencil-outline"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                    style="display:inline; margin:0;"
                                    onsubmit="return confirm('Hapus produk ini secara permanen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action del" title="Hapus Produk">
                                        <i class="mdi mdi-trash-can-outline"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="mdi mdi-package-variant"></i>
                                </div>
                                <div class="empty-title">Belum ada produk</div>
                                <div class="empty-sub">Mulai tambahkan produk pertama Anda.</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($products->hasPages())
        <div class="pagination-wrap">
            <div class="pagination-info">
                Menampilkan <strong>{{ $products->firstItem() }}</strong> &ndash; <strong>{{ $products->lastItem() }}</strong>
                dari <strong>{{ $products->total() }}</strong> produk
            </div>
            {{ $products->links() }}
        </div>
        @endif
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var input = document.getElementById('tableSearch');
    if (input) {
        input.addEventListener('input', function () {
            var q = this.value.toLowerCase();
            document.querySelectorAll('#prodTable tbody tr').forEach(function (row) {
                row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
            });
        });
    }
});
</script>

@endsection