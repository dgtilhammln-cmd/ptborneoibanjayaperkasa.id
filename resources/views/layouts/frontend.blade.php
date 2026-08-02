<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SEO::generate() !!}

    <!-- Robots Meta Tag (NoIndex/NoFollow) -->
    @php
        $noindex = \App\Models\Setting::get('seo_noindex', false);
        $nofollow = \App\Models\Setting::get('seo_nofollow', false);
    @endphp
    @if($noindex || $nofollow)
        <meta name="robots" content="{{ ($noindex ? 'noindex' : '') }}{{ ($noindex && $nofollow) ? ', ' : '' }}{{ ($nofollow ? 'nofollow' : '') }}">
    @endif

    <!-- Custom Head HTML -->
    @php $customHeadHtml = \App\Models\Setting::get('seo_custom_head_html', ''); @endphp
    @if($customHeadHtml)
        {!! $customHeadHtml !!}
    @endif

    <!-- Favicon Icon -->
    @php
        $favicon = \App\Models\Setting::get('site_favicon');
        $faviconUrl = $favicon ? asset($favicon) : asset('assets/images/favicon.png');
    @endphp
    <link rel="shortcut icon" type="image/x-icon" href="{{ $faviconUrl }}">
    
    <!-- Resource Hints for Performance -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Critical: font-display swap inline to prevent FOIT -->
    <style>
        /* Prevent invisible text during font load */
        @font-face { font-display: swap; }
        body { font-family: 'Montserrat', system-ui, -apple-system, sans-serif; }
    </style>

    <!-- Google Fonts - Montserrat with font-display=swap -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"></noscript>
    @php $gaId = \App\Models\Setting::get('seo_google_analytics'); @endphp
    @if($gaId)
    <link rel="dns-prefetch" href="//www.googletagmanager.com">
    <link rel="preconnect" href="https://www.googletagmanager.com" crossorigin>
    @endif
    
    <!-- Google Site Verification -->
    @php $googleVerification = \App\Models\Setting::get('seo_google_site_verification'); @endphp
    @if($googleVerification)
    <meta name="google-site-verification" content="{{ $googleVerification }}">
    @endif
    
    <!-- Google Analytics - Defer to reduce blocking -->
    @if($gaId)
    <script>
        // Defer Google Analytics initialization
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $gaId }}', { 'send_page_view': false });
        
        // Load GA script after page load
        window.addEventListener('load', function() {
            const script = document.createElement('script');
            script.async = true;
            script.src = 'https://www.googletagmanager.com/gtag/js?id={{ $gaId }}';
            document.head.appendChild(script);
            script.onload = function() {
                gtag('config', '{{ $gaId }}');
            };
        });
    </script>
    @endif
    
    <!-- Critical CSS - Load immediately for above-the-fold content -->
    <link rel="stylesheet" href="{{ asset('assets/css/barfi/plugins/bootstrap.min.css') }}">
    
    <!-- Async CSS Loader Script -->
    <script>
        !function(e){"use strict";var t=function(t,n,o){var i,r=e.document,a=r.createElement("link");if(n)a.rel=n;else{if(!(i="preload"===a.rel))return;}a.href=t,a.href.indexOf("http")||(a.crossOrigin="anonymous"),"style"===n&&(a.onload=function(){this.media="all"},a.media="print"),o&&(a.onload=function(){this.onload=null,o(this)},a.onload()),r.head.appendChild(a)};e.loadCSS=t}("undefined"!=typeof global?global:this);
    </script>
    
    <!-- Critical CSS - Load immediately for above-the-fold content -->
    <link rel="stylesheet" href="{{ asset('assets/css/barfi/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/barfi/plugins/swiper-bundle.min.css') }}" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/css/barfi/plugins/swiper-bundle.min.css') }}"></noscript>
    
    <!-- FontAwesome - defer completely (icons not critical above fold) -->
    <link rel="stylesheet" href="{{ asset('assets/css/barfi/plugins/all.css') }}" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/css/barfi/plugins/all.css') }}"></noscript>
    
    <link rel="stylesheet" href="{{ asset('assets/css/barfi/plugins/animate.min.css') }}" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/css/barfi/plugins/animate.min.css') }}"></noscript>
    
    <link rel="stylesheet" href="{{ asset('assets/css/barfi/plugins/aos.css') }}" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/css/barfi/plugins/aos.css') }}"></noscript>
    
    <!-- Non-Critical Plugin CSS - Load asynchronously -->
    <link rel="stylesheet" href="{{ asset('assets/css/barfi/plugins/nice-select.css') }}" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/css/barfi/plugins/nice-select.css') }}"></noscript>
    
    <link rel="stylesheet" href="{{ asset('assets/css/barfi/plugins/magnific-popup.css') }}" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/css/barfi/plugins/magnific-popup.css') }}"></noscript>
    
    <link rel="stylesheet" href="{{ asset('assets/css/barfi/plugins/odometer-theme-default.min.css') }}" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/css/barfi/plugins/odometer-theme-default.min.css') }}"></noscript>
    
    <link rel="stylesheet" href="{{ asset('assets/css/glassmorphism.css') }}" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/css/glassmorphism.css') }}"></noscript>

    @stack('css')
    @stack('head')
</head>

<body>  
   

    @include('partials.header')

    <div id="smooth-wrapper">
        <div id="smooth-content">
            @yield('content')
        </div>
    </div>

    @include('partials.footer')

    <!-- progress -->
    <div class="paginacontainer">
        <div class="progress-wrap progress-wrap-2">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
            </svg>
        </div>
    </div>

    <!-- JS Loading Optimization - Defer all non-critical scripts -->
    <script defer src="{{ asset('assets/js/tracking.js') }}"></script>

    <!-- Critical JS - jQuery (required by many scripts) -->
    <script defer src="{{ asset('assets/js/barfi/plugins/jquery-3.7.1.min.js') }}"></script>

    <!-- Preload critical assets -->
    <link rel="preload" href="{{ asset('assets/css/barfi/plugins/bootstrap.min.css') }}" as="style">
    <link rel="preload" href="{{ asset('assets/js/barfi/plugins/jquery-3.7.1.min.js') }}" as="script">
    
    <!-- Non-Critical JS - Load after page is interactive -->
    <script>
        // Function to load script with dependency check
        function loadScript(src, callback, defer) {
            const script = document.createElement('script');
            script.src = src;
            if (defer) {
                script.defer = true;
            } else {
                script.async = true;
            }
            if (callback) {
                script.onload = callback;
            }
            document.body.appendChild(script);
        }
        
        // Load scripts after page is fully loaded to reduce TBT
        window.addEventListener('load', function() {
            // Bootstrap (depends on jQuery)
            loadScript('{{ asset("assets/js/barfi/plugins/bootstrap.min.js") }}', function() {
                // Swiper (can load independently)
                loadScript('{{ asset("assets/js/barfi/plugins/swiper-bundle.min.js") }}');
                
                // Other plugins (can load in parallel)
                loadScript('{{ asset("assets/js/barfi/plugins/jarallax.min.js") }}');
                loadScript('{{ asset("assets/js/barfi/plugins/nice-select.js") }}');
                loadScript('{{ asset("assets/js/barfi/plugins/fontawesome.min.js") }}');
                loadScript('{{ asset("assets/js/barfi/plugins/magnific-popup.js") }}');
                loadScript('{{ asset("assets/js/barfi/plugins/waypoints.js") }}');
                loadScript('{{ asset("assets/js/barfi/plugins/odometer.min.js") }}');
                loadScript('{{ asset("assets/js/barfi/plugins/aos.js") }}');
                loadScript('{{ asset("assets/js/barfi/plugins/ScrollSmoother.min.js") }}');
                loadScript('{{ asset("assets/js/barfi/plugins/plugin.js") }}');
                
                // Custom scripts (load after plugins)
                setTimeout(function() {
                    loadScript('{{ asset("assets/js/barfi/slider.js") }}');
                    loadScript('{{ asset("assets/js/barfi/main.js") }}');
                }, 100);
            });
        });
    </script>

    @stack('js')
</body>

</html>