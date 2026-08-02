@extends('layouts.frontend')

@section('content')
<!--================= Breadcrumb section start =================-->
<div class="vl-breadcrumb-area fix">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="vl-breadcrumb-content">
                    <h2 class="title">404 Error</h2>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="vl-breadcrumb-list">
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="active">404</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================= Breadcrumb section end =================-->

<!--================= Error section start =================-->
<div class="vl-error-area pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <div class="vl-error-content text-center">
                    <h1 class="error-title" style="font-size: 150px; font-weight: 800; color: #01358d; line-height: 1; margin-bottom: 30px;">404</h1>
                    <h2 class="title mb-30">Halaman Tidak Ditemukan!</h2>
                    <p class="para mb-40">Maaf, halaman yang Anda cari mungkin telah dihapus, namanya diubah, atau sementara tidak tersedia.</p>
                    <div class="vl-banner-btn-flex5 justify-content-center">
                        <a href="{{ url('/') }}" class="vl-primary-btn5">
                            <span class="arrow1"><i class="fa-regular fa-arrow-right"></i></span>
                            Kembali ke Beranda
                            <span class="arrow2"><i class="fa-regular fa-arrow-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================= Error section end =================-->
@endsection
