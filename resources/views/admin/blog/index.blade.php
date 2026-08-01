@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --bg-base:         #f0f2f7;
        --bg-surface:      #ffffff;
        --bg-surface-2:    #f7f8fc;
        --border:          #e4e8f0;
        --border-strong:   #d0d6e4;
        --text-primary:    #0f1724;
        --text-secondary:  #5a6478;
        --text-muted:      #9aa3b8;
        --accent:          #3b6ef8;
        --accent-soft:     #eef2ff;
        --accent-green:    #22c55e;
        --accent-green-soft: #f0fdf4;
        --accent-red:      #ef4444;
        --accent-red-soft: #fef2f2;
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
    .ph p strong { color:var(--accent); font-weight:700; }

    /* ── Btn Primary ── */
    .btn-p {
        display:inline-flex; align-items:center; gap:7px;
        background:var(--accent); color:#fff !important;
        font-family:'Plus Jakarta Sans',sans-serif; font-weight:700; font-size:.82rem; letter-spacing:.2px;
        padding:10px 20px; border-radius:var(--r-sm); border:none; cursor:pointer;
        box-shadow:0 4px 14px rgba(59,110,248,.28); transition:all .25s ease; white-space:nowrap;
    }
    .btn-p:hover { background:#2c5ce8; box-shadow:0 6px 20px rgba(59,110,248,.4); transform:translateY(-1px); color:#fff !important; }

    /* ── Stats ── */
    .stats { display:grid; grid-template-columns:repeat(auto-fit, minmax(155px,1fr)); gap:1rem; margin-bottom:1.5rem; }
    .sc { background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--r); padding:1.2rem 1.4rem; display:flex; align-items:center; gap:.9rem; box-shadow:var(--shadow-sm); transition:box-shadow .2s; }
    .sc:hover { box-shadow:var(--shadow-md); }
    .si { width:42px; height:42px; border-radius:11px; display:flex; align-items:center; justify-content:center; font-size:1.15rem; flex-shrink:0; }
    .si.b { background:var(--accent-soft); color:var(--accent); }
    .si.g { background:var(--accent-green-soft); color:var(--accent-green); }
    .sv { font-size:1.55rem; font-weight:800; line-height:1; color:var(--text-primary); }
    .sl { font-size:.68rem; color:var(--text-muted); margin-top:3px; text-transform:uppercase; letter-spacing:.8px; font-weight:600; }

    /* ── Card ── */
    .card-lux { background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--r); box-shadow:var(--shadow-sm); overflow:hidden; }
    .card-head { padding:1.1rem 1.6rem; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap; }
    .card-head h3 { font-size:.9rem; font-weight:700; margin:0; display:flex; align-items:center; gap:8px; }
    .live-dot { width:8px; height:8px; border-radius:50%; background:var(--accent-green); box-shadow:0 0 0 3px rgba(34,197,94,.15); animation:blink 1.6s infinite; }
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.35} }

    /* ── Search ── */
    .sw { position:relative; width:255px; }
    .sw input { width:100%; background:var(--bg-surface-2); border:1px solid var(--border); border-radius:var(--r-xs); padding:8px 12px 8px 34px; font-family:'Plus Jakarta Sans',sans-serif; font-size:.8rem; color:var(--text-primary); outline:none; transition:border-color .2s,box-shadow .2s; }
    .sw input:focus { border-color:var(--accent); box-shadow:0 0 0 3px rgba(59,110,248,.1); }
    .sw .si2 { position:absolute; left:10px; top:50%; transform:translateY(-50%); color:var(--text-muted); font-size:.88rem; pointer-events:none; }

    /* ── Table ── */
    .tbl { width:100%; border-collapse:collapse; }
    .tbl thead th { padding:10px 18px; text-align:left; font-size:.68rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:1px; background:var(--bg-surface-2); border-bottom:1px solid var(--border); white-space:nowrap; }
    .tbl thead th:last-child { text-align:right; }
    .tbl tbody tr { border-bottom:1px solid var(--border); transition:background .15s; }
    .tbl tbody tr:last-child { border-bottom:none; }
    .tbl tbody tr:hover { background:var(--bg-surface-2); }
    .tbl td { padding:15px 18px; vertical-align:middle; font-size:.86rem; color:var(--text-primary); }

    /* ── Thumb ── */
    .thumb { width:50px; height:50px; border-radius:10px; object-fit:cover; border:1px solid var(--border); flex-shrink:0; }
    .thumb-ph { width:50px; height:50px; border-radius:10px; background:var(--bg-surface-2); border:1px solid var(--border); display:flex; align-items:center; justify-content:center; color:var(--text-muted); font-size:1.1rem; flex-shrink:0; }
    .art-title { font-weight:700; font-size:.86rem; margin-bottom:3px; }
    .art-uid { font-size:.68rem; color:var(--text-muted); font-weight:500; font-family:'Inter',sans-serif; }

    /* ── Badges ── */
    .badge-pub { display:inline-flex; align-items:center; gap:5px; background:var(--accent-green-soft); color:#16a34a; border:1px solid rgba(34,197,94,.2); border-radius:50px; padding:4px 11px; font-size:.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.5px; white-space:nowrap; }
    .badge-pub .d { width:6px; height:6px; border-radius:50%; background:var(--accent-green); animation:blink 1.5s infinite; }
    .badge-draft { display:inline-flex; align-items:center; gap:5px; background:#fefce8; color:#a16207; border:1px solid rgba(202,138,4,.2); border-radius:50px; padding:4px 11px; font-size:.68rem; font-weight:700; text-transform:uppercase; }

    /* ── Date ── */
    .dt { font-size:.78rem; color:var(--text-secondary); display:flex; align-items:center; gap:6px; font-family:'Inter',sans-serif; font-weight:500; }

    /* ── Row Num ── */
    .rn { font-size:.72rem; font-weight:700; color:var(--text-muted); font-family:'Inter',sans-serif; }

    /* ── Action Btns ── */
    .ag { display:flex; align-items:center; justify-content:flex-end; gap:5px; }
    .bi { width:34px; height:34px; border-radius:var(--r-xs); display:inline-flex; align-items:center; justify-content:center; font-size:.92rem; border:1px solid var(--border); background:var(--bg-surface); color:var(--text-secondary); cursor:pointer; transition:all .2s ease; }
    .bi:hover { background:var(--accent-soft); border-color:rgba(59,110,248,.3); color:var(--accent); transform:translateY(-1px); box-shadow:var(--shadow-sm); }
    .bi.d:hover { background:var(--accent-red-soft); border-color:rgba(239,68,68,.3); color:var(--accent-red); }

    /* ── Empty ── */
    .es { text-align:center; padding:3.5rem 2rem; }
    .ei { width:68px; height:68px; border-radius:18px; background:var(--bg-surface-2); border:1px solid var(--border); display:flex; align-items:center; justify-content:center; font-size:1.8rem; color:var(--text-muted); margin:0 auto 1.2rem; }
    .es h4 { font-size:.95rem; font-weight:700; margin-bottom:5px; }
    .es p { font-size:.82rem; color:var(--text-muted); margin-bottom:1.4rem; }

    /* ── Pagination ── */
    .pg-wrap { display:flex; align-items:center; justify-content:space-between; padding:.9rem 1.6rem; border-top:1px solid var(--border); flex-wrap:wrap; gap:1rem; }
    .pg-info { font-size:.78rem; color:var(--text-muted); font-family:'Inter',sans-serif; }
    .pg-info strong { color:var(--text-secondary); font-weight:600; }
    .pagination { gap:4px; margin:0; }
    .pagination .page-link { width:34px; height:34px; display:flex; align-items:center; justify-content:center; background:var(--bg-surface); border:1px solid var(--border); color:var(--text-secondary) !important; border-radius:var(--r-xs) !important; font-size:.8rem; font-weight:600; font-family:'Plus Jakarta Sans',sans-serif; transition:all .2s; }
    .pagination .page-link:hover { background:var(--accent-soft); border-color:rgba(59,110,248,.3); color:var(--accent) !important; }
    .pagination .page-item.active .page-link { background:var(--accent); border-color:var(--accent); color:#fff !important; box-shadow:0 4px 10px rgba(59,110,248,.3); }
    .pagination .page-item.disabled .page-link { opacity:.4; pointer-events:none; }

    /* ── Animations ── */
    @keyframes fadeUp { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
    .fu { animation:fadeUp .35s ease-out both; }

    @media(max-width:768px){
        .ps{padding:1rem}
        .stats{grid-template-columns:1fr 1fr}
        .sw{width:100%}
        .tbl thead{display:none}
        .tbl td{padding:12px 14px}
    }
</style>

<div class="ps">

    <!-- Breadcrumb -->
    <nav class="bc fu" style="animation-delay:.05s">
        <a href="#"><i class="mdi mdi-home-outline"></i></a>
        <span class="sep">/</span>
        <span class="cur">Manajemen Artikel</span>
    </nav>

    <!-- Page Header -->
    <div class="ph fu" style="animation-delay:.08s">
        <div>
            <h1>Manajemen Artikel</h1>
            <p>Total <strong>{{ $blogs->total() }}</strong> publikasi tersimpan dalam basis data</p>
        </div>
        <a href="{{ route('admin.blog.create') }}" class="btn-p">
            <i class="mdi mdi-plus"></i> Buat Artikel Baru
        </a>
    </div>

    <!-- Stats -->
    <div class="stats fu" style="animation-delay:.12s">
        <div class="sc">
            <div class="si b"><i class="mdi mdi-newspaper-variant-outline"></i></div>
            <div><div class="sv">{{ $blogs->total() }}</div><div class="sl">Total Artikel</div></div>
        </div>
        <div class="sc">
            <div class="si g"><i class="mdi mdi-check-circle-outline"></i></div>
            <div><div class="sv">{{ $blogs->total() }}</div><div class="sl">Dipublikasikan</div></div>
        </div>
        <div class="sc">
            <div class="si b"><i class="mdi mdi-eye-outline"></i></div>
            <div><div class="sv">–</div><div class="sl">Total Tayangan</div></div>
        </div>
        <div class="sc">
            <div class="si g"><i class="mdi mdi-layers-outline"></i></div>
            <div><div class="sv">{{ $blogs->lastPage() }}</div><div class="sl">Total Halaman</div></div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card-lux fu" style="animation-delay:.16s">
        <!-- Header -->
        <div class="card-head">
            <h3><span class="live-dot"></span> Daftar Artikel</h3>
            <div class="sw">
                <i class="mdi mdi-magnify si2"></i>
                <input type="text" id="search-input" placeholder="Cari artikel...">
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="tbl" id="blog-table">
                <thead>
                    <tr>
                        <th style="width:36px">#</th>
                        <th>Pratinjau &amp; Judul</th>
                        <th>Status</th>
                        <th>Tanggal Terbit</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $blog)
                        <tr class="fu" style="animation-delay:{{ .2 + $loop->index * .035 }}s">
                            <td><span class="rn">{{ $blogs->firstItem() + $loop->index }}</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @if($blog->image)
                                        <img src="{{ asset($blog->image) }}" class="thumb" alt="">
                                    @else
                                        <div class="thumb-ph"><i class="mdi mdi-image-outline"></i></div>
                                    @endif
                                    <div>
                                        <div class="art-title">{{ Str::limit($blog->title, 55) }}</div>
                                        <div class="art-uid">UID #B-{{ $blog->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge-pub"><span class="d"></span> Publik</span>
                            </td>
                            <td>
                                <div class="dt">
                                    <i class="mdi mdi-calendar-outline" style="color:var(--text-muted)"></i>
                                    {{ $blog->created_at->translatedFormat('d M Y') }}
                                </div>
                            </td>
                            <td>
                                <div class="ag">
                                    <a href="{{ route('admin.blog.edit', $blog) }}" class="bi" title="Edit Artikel">
                                        <i class="mdi mdi-pencil-outline"></i>
                                    </a>
                                    <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Hapus artikel ini secara permanen?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bi d" title="Hapus Artikel">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="es">
                                    <div class="ei"><i class="mdi mdi-newspaper-variant-multiple-outline"></i></div>
                                    <h4>Belum ada artikel</h4>
                                    <p>Mulai buat artikel pertama Anda sekarang</p>
                                    <a href="{{ route('admin.blog.create') }}" class="btn-p">
                                        <i class="mdi mdi-plus"></i> Buat Artikel Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($blogs->hasPages())
            <div class="pg-wrap">
                <div class="pg-info">
                    Menampilkan <strong>{{ $blogs->firstItem() }}</strong>–<strong>{{ $blogs->lastItem() }}</strong>
                    dari <strong>{{ $blogs->total() }}</strong> entri
                </div>
                <div>{{ $blogs->links('pagination::bootstrap-4') }}</div>
            </div>
        @endif
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inp = document.getElementById('search-input');
    const rows = document.querySelectorAll('#blog-table tbody tr');
    if (inp) {
        inp.addEventListener('input', function() {
            const q = this.value.toLowerCase();
            rows.forEach(r => {
                const t = r.querySelector('.art-title');
                if (t) r.style.display = t.textContent.toLowerCase().includes(q) ? '' : 'none';
            });
        });
    }
});
</script>
@endsection