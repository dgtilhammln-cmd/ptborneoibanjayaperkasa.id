<!--================= Header section start =================-->
@php
    $isHomePage = request()->is('/');
    $headerClass = $isHomePage ? 'vl-header-area vl-header-area-5 vl-transparent-header' : 'vl-header-area vl-transparent-header';
    $containerClass = $isHomePage ? 'header-bg-5' : '';
    $menuClass = $isHomePage ? 'vl-main-menu-5' : '';
    $menuCol = $isHomePage ? 'col-xl-7' : 'col-xl-7'; // Kurangi menu 1 kolom
    $buttonCol = $isHomePage ? 'col-xl-3' : 'col-xl-3'; // Tambah area tombol 1 kolom
    
    $contactPhone = \App\Models\Setting::get('contact_phone', '7857126532');
    $whatsappLink = formatWhatsApp($contactPhone);
@endphp
<header>
    <div id="vl-header-sticky" class="{{ $headerClass }}">
        <div class="container {{ $containerClass }}">
            <div class="row align-items-center">
                <div class="col-xl-2 col-md-6 col-6">
                    <div class="vl-logo">
                        @php
                            $logo = \App\Models\Setting::get('site_logo');
                            $siteName = \App\Models\Setting::get('site_name');
                        @endphp
                        <a href="{{ url('/') }}">
                            @if($logo)
                                <img style="max-width: 190px;" src="{{ asset($logo) }}" alt="{{ $siteName }}">
                            @else
                                <img style="max-width: 190px;" src="{{ asset('assets/img/barfi/logo/logo-black.png') }}" alt="{{ $siteName }}">
                            @endif
                        </a>
                    </div>
                </div>
                <div class="{{ $menuCol }} d-none d-xl-block">
                    <div class="vl-main-menu {{ $menuClass }} text-center">
                        <nav class="vl-mobile-menu-active">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ url('/about') }}">About</a></li>
                                <li><a href="{{ url('/products') }}">Products</a></li>
                                <li><a href="{{ url('/services') }}">Services</a></li>
                                <li><a href="{{ url('/blog') }}">Blog</a></li>
                                <li><a href="{{ url('/contact') }}">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="{{ $buttonCol }} col-md-6 col-6">
                    @if($isHomePage)
                    <!-- header btn (Home Page Style) -->
                    <div class="d-none d-xl-block">
                        <div class="vl-header-menu-iconbox2 vl-header-menu-iconbox2-5">
                            <div class="icon">
                                <span><i class="fa-brands fa-whatsapp" style="font-size: 24px; color: #25D366;"></i></span>
                            </div>
<div class="content d-flex flex-column justify-content-center ms-2">
    <p class="para mb-0" style="line-height: 1.2; font-size: 13px; color: #fff;">Hubungi Kami</p>
    <a style="font-size: 15px; white-space: nowrap; line-height: 1.2; font-weight: 700;" 
       href="{{ $whatsappLink }}" 
       target="_blank" 
       class="topnumber text-white">
       {{ $contactPhone }}
    </a>
</div>
                        </div>
                    </div>
                    <!-- action btn -->
                    <div class="vl-header-action-item vl-header-action-item-5 d-block d-xl-none">
                        <button type="button" class="vl-offcanvas-toggle">
                           <svg xmlns="http://www.w3.org/2000/svg" width="30" height="16" viewBox="0 0 30 16">
                              <rect x="10" width="20" height="2" fill="currentColor"></rect>
                              <rect x="5" y="7" width="25" height="2" fill="currentColor"></rect>
                              <rect x="10" y="14" width="20" height="2" fill="currentColor"></rect>
                           </svg>
                        </button>
                     </div>
                    @else
                    <!-- header btn (Non-Home Page Style) -->
                    <div class="vl-header-btn d-none d-xl-block">
                       <a href="{{ $whatsappLink }}" target="_blank" class="vl-btn-primary"> <span><i class="fa-brands fa-whatsapp" style="font-size: 18px; color: #25D366;"></i></span> {{ $contactPhone }} </a>
                    </div>
                    <!-- action btn -->
                    <div class="vl-header-action-item d-block d-xl-none">
                        <button type="button" class="vl-offcanvas-toggle">
                           <svg xmlns="http://www.w3.org/2000/svg" width="30" height="16" viewBox="0 0 30 16">
                              <rect x="10" width="20" height="2" fill="currentColor"></rect>
                              <rect x="5" y="7" width="25" height="2" fill="currentColor"></rect>
                              <rect x="10" y="14" width="20" height="2" fill="currentColor"></rect>
                           </svg>
                        </button>
                     </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>

<!-- MouseCursor Start - Disabled -->
{{-- @if($isHomePage)
<div class="mouseCursor cursor-outer color-4"></div>
<div class="mouseCursor cursor-inner color-4"></div>
@else
<div class="mouseCursor cursor-outer"></div>
<div class="mouseCursor cursor-inner"></div>
@endif --}}

<!-- offcanvas menu start -->
<div class="vl-offcanvas">
    <div class="vl-offcanvas-wrapper">
        <div class="vl-offcanvas-header d-flex justify-content-between align-items-center mb-30">
            <div class="vl-offcanvas-logo">
                <a href="{{ url('/') }}">
                    @if($logo)
                        <img src="{{ asset($logo) }}" alt="{{ $siteName }}" style="max-width: 180px; height: auto;">
                    @else
                        <img src="{{ asset('assets/img/barfi/logo/logo-black.png') }}" alt="{{ $siteName }}" style="max-width: 180px; height: auto;">
                    @endif
                </a>
            </div>
            <div class="vl-offcanvas-close">
               <button class="vl-offcanvas-close-toggle" type="button"><i class="fal fa-times"></i></button>
            </div>
        </div>

        <div class="vl-offcanvas-menu vl-offcanvas-menu-4 mb-30">
            <nav>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/about') }}">About</a></li>
                    <li><a href="{{ url('/products') }}">Products</a></li>
                    <li><a href="{{ url('/services') }}">Services</a></li>
                    <li><a href="{{ url('/blog') }}">Blog</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                </ul>
            </nav>
        </div>

        <div class="vl-offcanvas-info vl-offcanvas-info-4 mb-30">
                <div class="col-12">
                    <a href="{{ $whatsappLink }}" target="_blank" class="vl-offcanvas-contact-link" style="background: #25D366; color: white; padding: 12px 20px; border-radius: 12px; display: inline-block; width: 100%; text-align: center; text-decoration: none; font-weight: 700; margin-top: 15px;">
                        <i class="fa-brands fa-whatsapp" style="margin-right: 8px; font-size: 18px;"></i> Hubungi via WhatsApp
                    </a>
                </div>
            </div>
        </div>
 
        <div class="vl-offcanvas-social vl-offcanvas-social-4">
            <h3 class="vl-offcanvas-sm-title mb-20">Follow Us</h3>
            <div class="vl-offcanvas-social-wrapper">
                @php
                    $socialLinks = \App\Models\Setting::get('social_links', []);
                    if (is_string($socialLinks)) {
                        $socialLinks = json_decode($socialLinks, true) ?: [];
                    }
                    // Fallback to old format if new format is empty
                    if (empty($socialLinks)) {
                        if (\App\Models\Setting::get('social_facebook')) {
                            $socialLinks[] = ['label' => 'Facebook', 'url' => \App\Models\Setting::get('social_facebook'), 'icon' => 'fab fa-facebook-f'];
                        }
                        if (\App\Models\Setting::get('social_instagram')) {
                            $socialLinks[] = ['label' => 'Instagram', 'url' => \App\Models\Setting::get('social_instagram'), 'icon' => 'fab fa-instagram'];
                        }
                        if (\App\Models\Setting::get('social_linkedin')) {
                            $socialLinks[] = ['label' => 'LinkedIn', 'url' => \App\Models\Setting::get('social_linkedin'), 'icon' => 'fab fa-linkedin-in'];
                        }
                        if (\App\Models\Setting::get('social_twitter')) {
                            $socialLinks[] = ['label' => 'Twitter/X', 'url' => \App\Models\Setting::get('social_twitter'), 'icon' => 'fab fa-twitter'];
                        }
                    }
                @endphp
                @foreach($socialLinks as $link)
                    @if(!empty($link['url']))
                    <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer" title="{{ $link['label'] ?? '' }}" class="vl-offcanvas-social-link">
                        <i class="{{ $link['icon'] ?? 'fab fa-link' }}"></i>
                    </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="vl-offcanvas-overlay"></div>

<!-- offcanvas menu end -->

<!--================= Header section End =================-->
