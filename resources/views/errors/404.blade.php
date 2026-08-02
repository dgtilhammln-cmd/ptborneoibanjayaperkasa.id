@extends('layouts.frontend')

@section('content')
<style>
    /* Premium 404 Error Page CSS - PT Borneo Iban Jaya Perkasa */
    .premium-error-section {
        font-family: 'Montserrat', system-ui, -apple-system, sans-serif !important;
        min-height: 100vh;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 150px 20px 100px;
        position: relative;
        overflow: hidden;
    }
    
    .premium-error-section::before {
        content: '';
        position: absolute;
        top: -20%;
        left: -10%;
        width: 50%;
        height: 70%;
        background: radial-gradient(circle, rgba(26,63,168,0.08) 0%, rgba(26,63,168,0) 70%);
        border-radius: 50%;
        z-index: 0;
    }
    
    .premium-error-section::after {
        content: '';
        position: absolute;
        bottom: -20%;
        right: -10%;
        width: 40%;
        height: 60%;
        background: radial-gradient(circle, rgba(245,166,35,0.08) 0%, rgba(245,166,35,0) 70%);
        border-radius: 50%;
        z-index: 0;
    }

    .premium-error-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 24px;
        padding: 60px 40px;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
        max-width: 600px;
        width: 100%;
        position: relative;
        z-index: 1;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .premium-error-card:hover {
        transform: translateY(-10px);
    }

    .premium-error-number {
        font-family: 'Montserrat', sans-serif !important;
        font-size: 160px;
        font-weight: 900;
        line-height: 1;
        background: linear-gradient(135deg, #1a3fa8 0%, #f5a623 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 20px;
        filter: drop-shadow(0 10px 10px rgba(26,63,168,0.1));
    }

    .premium-error-title {
        font-family: 'Montserrat', sans-serif !important;
        font-size: 32px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 15px;
        letter-spacing: -0.5px;
    }

    .premium-error-desc {
        font-family: 'Montserrat', sans-serif !important;
        font-size: 16px;
        color: #475569;
        margin-bottom: 40px;
        line-height: 1.6;
        font-weight: 500;
    }

    .premium-error-btn {
        font-family: 'Montserrat', sans-serif !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 16px 36px;
        background: linear-gradient(135deg, #1a3fa8 0%, #2a5ce8 100%);
        color: #ffffff !important;
        font-size: 16px;
        font-weight: 600;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(26,63,168,0.2);
    }

    .premium-error-btn i {
        margin-left: 10px;
        font-size: 14px;
        transition: transform 0.3s ease;
    }

    .premium-error-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 25px rgba(26,63,168,0.35);
    }

    .premium-error-btn:hover i {
        transform: translateX(6px);
    }

    @media (max-width: 768px) {
        .premium-error-number { font-size: 120px; }
        .premium-error-title { font-size: 24px; }
        .premium-error-section { padding: 120px 15px 80px; }
        .premium-error-card { padding: 40px 20px; }
    }
</style>

<div class="premium-error-section">
    <div class="premium-error-card">
        <div class="premium-error-number">404</div>
        <h1 class="premium-error-title">Halaman Tidak Ditemukan</h1>
        <p class="premium-error-desc">Maaf, halaman yang Anda cari mungkin telah dipindahkan, dihapus, atau Anda salah mengetikkan URL.</p>
        <a href="{{ url('/') }}" class="premium-error-btn">
            Kembali ke Beranda <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</div>
@endsection
