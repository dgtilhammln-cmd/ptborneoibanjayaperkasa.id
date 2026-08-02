@extends('layouts.app')

@section('title', 'Buat Artikel Baru')

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

    .ps { padding: 2rem 2.5rem; max-width: 1080px; margin: 0 auto; }

    .bc { display:flex; align-items:center; gap:6px; font-size:.75rem; color:var(--text-muted); margin-bottom:1.5rem; }
    .bc a { color:var(--text-muted); transition:color .2s; } .bc a:hover { color:var(--accent); }
    .bc .sep { color:var(--border-strong); } .bc .cur { color:var(--text-secondary); font-weight:600; }

    .ph { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.75rem; flex-wrap:wrap; gap:1rem; }
    .ph h1 { font-size:1.45rem; font-weight:800; letter-spacing:-.5px; margin:0 0 4px; }
    .ph p { font-size:.82rem; color:var(--text-secondary); margin:0; }

    .btn-p {
        display:inline-flex; align-items:center; gap:7px;
        background:var(--accent); color:#fff !important;
        font-family:'Plus Jakarta Sans',sans-serif; font-weight:700; font-size:.82rem;
        padding:10px 20px; border-radius:var(--r-sm); border:none; cursor:pointer;
        box-shadow:0 4px 14px rgba(59,110,248,.28); transition:all .25s ease;
    }
    .btn-p:hover { background:#2c5ce8; box-shadow:0 6px 20px rgba(59,110,248,.4); transform:translateY(-1px); }
    .btn-ghost {
        display:inline-flex; align-items:center; gap:7px;
        background:var(--bg-surface); color:var(--text-secondary) !important;
        font-family:'Plus Jakarta Sans',sans-serif; font-weight:600; font-size:.82rem;
        padding:10px 20px; border-radius:var(--r-sm); border:1px solid var(--border); cursor:pointer; transition:all .25s;
    }
    .btn-ghost:hover { background:var(--bg-surface-2); border-color:var(--border-strong); }

    .card-lux { background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--r); box-shadow:var(--shadow-sm); overflow:hidden; margin-bottom:1.25rem; }
    .card-head { padding:1.1rem 1.6rem; border-bottom:1px solid var(--border); display:flex; align-items:center; gap:10px; }
    .card-head h3 { font-size:.88rem; font-weight:700; margin:0; }
    .icon-wrap { width:30px; height:30px; border-radius:8px; background:var(--accent-soft); color:var(--accent); display:flex; align-items:center; justify-content:center; font-size:.9rem; flex-shrink:0; }
    .card-body { padding:1.6rem; }

    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; margin-bottom:1.25rem; }
    .form-group { display:flex; flex-direction:column; gap:6px; }
    label.fl { font-size:.7rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:.8px; display:flex; align-items:center; gap:6px; }
    label.fl i { color:var(--accent); }
    .fi {
        width:100%; background:var(--bg-surface-2); border:1.5px solid var(--border);
        border-radius:var(--r-xs); padding:10px 14px; font-size:.86rem;
        color:var(--text-primary); font-family:'Plus Jakarta Sans',sans-serif;
        outline:none; transition:border-color .2s,box-shadow .2s;
    }
    .fi:focus { border-color:var(--accent); box-shadow:0 0 0 3px rgba(59,110,248,.1); }
    textarea.fi { resize:vertical; line-height:1.6; }
    .input-group { display:flex; }
    .ig-pre { padding:10px 13px; background:var(--bg-surface-2); border:1.5px solid var(--border); border-right:none; border-radius:var(--r-xs) 0 0 var(--r-xs); font-size:.78rem; color:var(--text-muted); font-weight:600; white-space:nowrap; display:flex; align-items:center; }
    .input-group .fi { border-radius:0; border-left:none; }
    .ig-btn { padding:10px 13px; background:var(--bg-surface-2); border:1.5px solid var(--border); border-left:none; border-radius:0 var(--r-xs) var(--r-xs) 0; cursor:pointer; color:var(--accent); font-size:.9rem; transition:background .2s; }
    .ig-btn:hover { background:var(--accent-soft); }

    .note-editor.note-frame { border:1.5px solid var(--border) !important; border-radius:var(--r-xs) !important; overflow:hidden; }
    .note-toolbar { background:var(--bg-surface-2) !important; border-bottom:1px solid var(--border) !important; padding:8px 12px !important; }
    .note-editable { background:#ffffff !important; color:#212529 !important; font-family:'Plus Jakarta Sans',sans-serif !important; min-height:320px; }
    .note-btn { background:var(--bg-surface) !important; border:1px solid var(--border) !important; color:var(--text-secondary) !important; border-radius:6px !important; }
    .note-btn:hover { background:var(--accent-soft) !important; color:var(--accent) !important; }
    .note-statusbar { background:var(--bg-surface-2) !important; border-top:1px solid var(--border) !important; }

    .upload-zone { border:2px dashed var(--border-strong); border-radius:var(--r-xs); padding:1.5rem; text-align:center; cursor:pointer; transition:all .2s; background:var(--bg-surface-2); }
    .upload-zone:hover { border-color:var(--accent); background:var(--accent-soft); }
    .upload-zone .uz-icon { font-size:1.8rem; color:var(--text-muted); margin-bottom:.5rem; display:block; }
    .upload-zone p { font-size:.78rem; color:var(--text-secondary); margin:0; }
    .upload-zone .sub { font-size:.68rem; color:var(--text-muted); margin-top:3px; }

    .status-card { background:var(--bg-surface-2); border:1.5px solid var(--border); border-radius:var(--r-xs); padding:.9rem; }
    .status-option { display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:var(--r-xs); margin-bottom:6px; border:1.5px solid transparent; cursor:pointer; }
    .status-option:last-child { margin-bottom:0; }
    .s-dot { width:8px; height:8px; border-radius:50%; flex-shrink:0; }
    .s-label { font-size:.8rem; font-weight:700; }
    .s-desc { font-size:.68rem; color:var(--text-muted); }

    .seo-section { background:linear-gradient(135deg,#f8faff 0%,var(--accent-soft) 100%); border:1.5px solid rgba(59,110,248,.15); border-radius:var(--r-xs); padding:1.4rem; }
    .seo-badge { background:var(--accent); color:#fff; font-size:.62rem; font-weight:800; letter-spacing:.8px; padding:3px 8px; border-radius:4px; text-transform:uppercase; }
    .char-info { display:flex; align-items:center; justify-content:space-between; margin-top:4px; }
    .char-count { font-size:.68rem; color:var(--text-muted); }
    .char-count.warn { color:#eab308; } .char-count.ok { color:var(--accent-green); }
    .seo-preview { background:#fff; border:1px solid var(--border); border-radius:8px; padding:12px 16px; margin-top:.8rem; }
    .seo-preview .prev-label { font-size:.62rem; color:var(--text-muted); margin-bottom:6px; font-weight:600; text-transform:uppercase; letter-spacing:.5px; }
    .seo-preview .prev-title { font-size:.9rem; color:#1a0dab; font-weight:600; line-height:1.3; }
    .seo-preview .prev-url { font-size:.72rem; color:#006621; margin:2px 0; }
    .seo-preview .prev-desc { font-size:.78rem; color:#545454; line-height:1.5; }

    .form-actions { display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap; padding:1.2rem 1.6rem; border-top:1px solid var(--border); }
    .err-msg { font-size:.72rem; color:var(--accent-red); margin-top:3px; display:flex; align-items:center; gap:4px; }
    .fi.is-invalid { border-color:var(--accent-red); }
    .alert-err { background:var(--accent-red-soft); border:1px solid rgba(239,68,68,.2); border-radius:var(--r-xs); padding:.9rem 1.1rem; margin-bottom:1.25rem; font-size:.82rem; color:var(--accent-red); }

    @keyframes fadeUp { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
    .fu { animation:fadeUp .35s ease-out both; }

    @media(max-width:768px){ .ps{padding:1rem;} .form-row{grid-template-columns:1fr;} }
</style>

<div class="ps">

    <nav class="bc fu" style="animation-delay:.05s">
        <a href="#"><i class="mdi mdi-home-outline"></i></a>
        <span class="sep">/</span>
        <a href="{{ route('admin.blog.index') }}">Manajemen Artikel</a>
        <span class="sep">/</span>
        <span class="cur">Buat Artikel Baru</span>
    </nav>

    <div class="ph fu" style="animation-delay:.08s">
        <div>
            <h1>Buat Artikel Baru</h1>
            <p>Rancang dan terbitkan konten baru ke basis data publikasi</p>
        </div>
        <a href="{{ route('admin.blog.index') }}" class="btn-ghost">
            <i class="mdi mdi-arrow-left"></i> Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="alert-err fu" style="animation-delay:.1s">
            <strong><i class="mdi mdi-alert-circle-outline"></i> Terdapat kesalahan pada form:</strong>
            <ul style="margin:.5rem 0 0 1.2rem;padding:0;">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Informasi Utama --}}
        <div class="card-lux fu" style="animation-delay:.12s">
            <div class="card-head">
                <div class="icon-wrap"><i class="mdi mdi-file-document-outline"></i></div>
                <h3>Informasi Utama</h3>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label class="fl" for="title"><i class="mdi mdi-format-title"></i> Judul Postingan <span style="color:var(--accent-red);margin-left:2px">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="fi {{ $errors->has('title') ? 'is-invalid' : '' }}"
                            placeholder="Masukkan judul artikel yang menarik..." required>
                        @error('title')<span class="err-msg"><i class="mdi mdi-alert-circle-outline"></i> {{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="fl" for="slug"><i class="mdi mdi-link-variant"></i> URL Slug</label>
                        <div class="input-group">
                            <span class="ig-pre">/blog/</span>
                            <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                                class="fi" placeholder="slug-otomatis-dari-judul">
                            <button type="button" class="ig-btn" id="gen-slug" title="Generate dari judul">
                                <i class="mdi mdi-refresh"></i>
                            </button>
                        </div>
                        @error('slug')<span class="err-msg"><i class="mdi mdi-alert-circle-outline"></i> {{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Konten Artikel --}}
        <div class="card-lux fu" style="animation-delay:.16s">
            <div class="card-head">
                <div class="icon-wrap"><i class="mdi mdi-pencil-outline"></i></div>
                <h3>Konten Artikel</h3>
            </div>
            <div class="card-body" style="padding-bottom:1rem;">
                <textarea id="summernote" name="content" class="summernote">{{ old('content') }}</textarea>
                @error('content')<span class="err-msg" style="margin-top:6px;"><i class="mdi mdi-alert-circle-outline"></i> {{ $message }}</span>@enderror
            </div>
            <div style="padding:.5rem 1.6rem 1rem;display:flex;align-items:center;gap:6px;">
                <i class="mdi mdi-information-outline" style="color:var(--text-muted);font-size:.9rem;"></i>
                <span style="font-size:.72rem;color:var(--text-muted);">Konten mendukung HTML penuh. Gambar dapat diunggah langsung dari toolbar editor.</span>
            </div>
        </div>

        {{-- Gambar + Status --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.25rem;" class="fu" style="animation-delay:.2s">

            <div class="card-lux" style="margin-bottom:0;">
                <div class="card-head">
                    <div class="icon-wrap"><i class="mdi mdi-image-outline"></i></div>
                    <h3>Gambar Utama</h3>
                </div>
                <div class="card-body">
                    <div class="upload-zone" onclick="document.getElementById('image-input').click()">
                        <i class="mdi mdi-cloud-upload-outline uz-icon"></i>
                        <p>Klik untuk unggah gambar</p>
                        <p class="sub">PNG, JPG, WEBP — Maks. 2MB · Rekomendasi 1200×630px</p>
                        <input type="file" name="image" id="image-input" accept="image/*" style="display:none;">
                    </div>
                    <div id="img-preview-wrap" style="display:none;margin-top:.9rem;text-align:center;">
                        <img id="img-preview" style="max-width:100%;height:110px;object-fit:cover;border-radius:var(--r-xs);border:1.5px solid var(--accent);" alt="Preview">
                    </div>
                    @error('image')<span class="err-msg" style="margin-top:6px;"><i class="mdi mdi-alert-circle-outline"></i> {{ $message }}</span>@enderror
                </div>
            </div>

            <div class="card-lux" style="margin-bottom:0;">
                <div class="card-head">
                    <div class="icon-wrap" style="background:var(--accent-green-soft);color:var(--accent-green);"><i class="mdi mdi-eye-outline"></i></div>
                    <h3>Status Publikasi</h3>
                </div>
                <div class="card-body">
                    <div class="status-card">
                        <label class="status-option" style="background:var(--accent-green-soft);border-color:rgba(34,197,94,.25);">
                            <input type="radio" name="status" value="published" checked style="display:none;">
                            <div class="s-dot" style="background:var(--accent-green);"></div>
                            <div><div class="s-label">Publikasikan</div><div class="s-desc">Langsung tampil di halaman depan</div></div>
                            <i class="mdi mdi-check-circle-outline" style="margin-left:auto;color:var(--accent-green);font-size:1rem;"></i>
                        </label>
                        <label class="status-option">
                            <input type="radio" name="status" value="draft" style="display:none;">
                            <div class="s-dot" style="background:#eab308;"></div>
                            <div><div class="s-label">Simpan Draft</div><div class="s-desc">Tersimpan, belum dipublikasikan</div></div>
                            <i class="mdi mdi-circle-outline" style="margin-left:auto;color:var(--text-muted);font-size:1rem;"></i>
                        </label>
                    </div>
                    <div style="margin-top:.9rem;padding:.8rem;background:var(--accent-soft);border-radius:var(--r-xs);border:1px solid rgba(59,110,248,.15);">
                        <label style="font-size:.7rem;font-weight:700;color:var(--accent);text-transform:uppercase;letter-spacing:.5px;display:flex;align-items:center;gap:6px;margin-bottom:6px;">
                            <i class="mdi mdi-calendar-clock"></i> Jadwalkan Terbit (opsional)
                        </label>
                        <input type="datetime-local" name="published_at" value="{{ old('published_at') }}" class="fi" style="font-size:.78rem;padding:8px 10px;background:#fff;">
                    </div>
                </div>
            </div>
        </div>

        {{-- SEO --}}
        <div class="card-lux fu" style="animation-delay:.24s">
            <div class="card-head">
                <div class="icon-wrap" style="background:#f0fdf4;color:#16a34a;"><i class="mdi mdi-google-analytics"></i></div>
                <h3>Optimasi SEO</h3>
            </div>
            <div class="card-body">
                <div class="seo-section">
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:1rem;">
                        <span class="seo-badge">SEO</span>
                        <span style="font-size:.82rem;font-weight:700;">Pengaturan mesin pencari</span>
                    </div>
                    <div class="form-row" style="margin-bottom:.75rem;">
                        <div class="form-group">
                            <label class="fl" for="meta_title"><i class="mdi mdi-google"></i> Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" class="fi" placeholder="Judul untuk Google Search...">
                            <div class="char-info">
                                <span style="font-size:.68rem;color:var(--text-muted);">Idealnya 50–60 karakter</span>
                                <span class="char-count" id="mt-count">0/60</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="fl" for="meta_description"><i class="mdi mdi-text-short"></i> Meta Description</label>
                            <textarea name="meta_description" id="meta_description" class="fi" rows="3" placeholder="Ringkasan singkat untuk hasil pencarian...">{{ old('meta_description') }}</textarea>
                            <div class="char-info">
                                <span style="font-size:.68rem;color:var(--text-muted);">Idealnya 140–160 karakter</span>
                                <span class="char-count" id="md-count">0/160</span>
                            </div>
                        </div>
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="fl" for="meta_keywords"><i class="mdi mdi-tag-multiple-outline"></i> Meta Keywords</label>
                            <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}" class="fi" placeholder="Pisahkan dengan koma. Contoh: alat berat, sparepart, kalimantan">
                            <div class="char-info">
                                <span style="font-size:.68rem;color:var(--text-muted);">Masukkan kata kunci yang relevan (opsional)</span>
                            </div>
                        </div>
                    </div>
                    <div class="seo-preview">
                        <div class="prev-label">Pratinjau di Google</div>
                        <div class="prev-title" id="prev-title">Judul artikel akan muncul di sini</div>
                        <div class="prev-url">https://situsanda.com/blog/<span id="prev-slug">slug-artikel</span></div>
                        <div class="prev-desc" id="prev-desc">Deskripsi meta akan ditampilkan sebagai cuplikan di hasil pencarian Google...</div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <a href="{{ route('admin.blog.index') }}" class="btn-ghost"><i class="mdi mdi-close"></i> Batalkan</a>
                <div style="display:flex;gap:.6rem;flex-wrap:wrap;">
                    <button type="submit" class="btn-p"><i class="mdi mdi-content-save-outline"></i> Simpan Artikel</button>
                </div>
            </div>
        </div>

    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const titleInp = document.getElementById('title');
    const slugInp  = document.getElementById('slug');
    const genBtn   = document.getElementById('gen-slug');

    function toSlug(t) {
        return t.toString().toLowerCase().trim()
            .replace(/\s+/g,'-').replace(/[^\w\-]+/g,'')
            .replace(/\-\-+/g,'-').replace(/^-+/,'').replace(/-+$/,'');
    }

    titleInp.addEventListener('input', function () {
        if (!slugInp.dataset.manual) {
            slugInp.value = toSlug(this.value);
            document.getElementById('prev-slug').textContent = slugInp.value || 'slug-artikel';
        }
    });
    slugInp.addEventListener('input', function () {
        this.dataset.manual = 'true';
        document.getElementById('prev-slug').textContent = this.value || 'slug-artikel';
    });
    genBtn.addEventListener('click', function () {
        if (titleInp.value) {
            slugInp.value = toSlug(titleInp.value);
            delete slugInp.dataset.manual;
            document.getElementById('prev-slug').textContent = slugInp.value;
            slugInp.style.borderColor = 'var(--accent)';
            setTimeout(() => slugInp.style.borderColor = '', 600);
        }
    });

    // Char counter
    function charCount(id, countId, max, prevId) {
        const el = document.getElementById(id);
        el.addEventListener('input', function () {
            const len = this.value.length;
            const c = document.getElementById(countId);
            c.textContent = len + '/' + max;
            c.className = 'char-count ' + (len > max ? 'warn' : len >= max * .8 ? 'ok' : '');
            if (prevId) document.getElementById(prevId).textContent = this.value || document.getElementById(prevId).dataset.default;
        });
    }
    document.getElementById('prev-title').dataset.default = 'Judul artikel akan muncul di sini';
    document.getElementById('prev-desc').dataset.default  = 'Deskripsi meta akan ditampilkan sebagai cuplikan di hasil pencarian Google...';
    charCount('meta_title', 'mt-count', 60, 'prev-title');
    charCount('meta_description', 'md-count', 160, 'prev-desc');

    // Image preview
    document.getElementById('image-input').addEventListener('change', function () {
        if (!this.files[0]) return;
        const r = new FileReader();
        r.onload = e => {
            document.getElementById('img-preview').src = e.target.result;
            document.getElementById('img-preview-wrap').style.display = 'block';
        };
        r.readAsDataURL(this.files[0]);
    });

    // Status highlight
    document.querySelectorAll('input[name="status"]').forEach(radio => {
        radio.addEventListener('change', function () {
            document.querySelectorAll('.status-option').forEach(o => {
                o.style.background = ''; o.style.borderColor = 'transparent';
            });
            const lbl = this.closest('label');
            if (this.value === 'published') {
                lbl.style.background = 'var(--accent-green-soft)';
                lbl.style.borderColor = 'rgba(34,197,94,.25)';
            } else {
                lbl.style.background = '#fefce8';
                lbl.style.borderColor = 'rgba(202,138,4,.2)';
            }
        });
    });
});
</script>
@endpush
@endsection