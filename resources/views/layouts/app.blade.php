<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Admin Dashboard - HVM Digital - Manage your website content">
    <meta name="author" content="HVM Digital">
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Favicon -->
    @php
        $favicon = \App\Models\Setting::get('site_favicon') ?? null;
        $faviconUrl = $favicon ? asset($favicon) : asset('assets/images/favicon.png');
    @endphp
    <link rel="shortcut icon" type="image/x-icon" href="{{ $faviconUrl }}">
    
    <!-- Title -->
    <title>@yield('title', 'Admin Dashboard') - HVM Digital</title>

    <!-- Google Fonts: Inter, Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css">

    <!-- Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #0066ff;
            --primary-blue-dark: #0052cc;
            --secondary-blue: #00a8ff;
            --bg-primary: #f5f7fa;
            --bg-secondary: #ffffff;
            --bg-tertiary: #f0f2f7;
            --text-primary: #1a1a2e;
            --text-secondary: #6b7280;
            --text-light: #9ca3af;
            --border-color: #e5e7eb;
            --border-color-light: #f0f2f7;
            --accent-red: #ef4444;
            --accent-green: #10b981;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            background-color: var(--bg-primary);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* ================== SIDEBAR ================== */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-right: 1px solid var(--border-color);
            z-index: 1050;
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--border-color-light);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--border-color);
        }

        /* Sidebar Logo */
        .sidebar-header {
            padding: 28px 20px;
            border-bottom: 1px solid var(--border-color-light);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            transition: var(--transition);
        }

        .sidebar-logo img {
            height: 44px;
            width: auto;
            max-width: 100%;
            filter: drop-shadow(0 2px 4px rgba(0, 102, 255, 0.1));
            transition: var(--transition);
        }

        .sidebar-logo:hover img {
            transform: scale(1.08);
            filter: drop-shadow(0 4px 8px rgba(0, 102, 255, 0.2));
        }

        .logo-text {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Sidebar Content */
        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            padding: 20px 12px;
        }

        .sidebar-section {
            margin-bottom: 24px;
        }

        .sidebar-section-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-light);
            padding: 12px 16px;
            margin-bottom: 8px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            margin-bottom: 6px;
            border-radius: 10px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: var(--transition);
            position: relative;
            border: 1px solid transparent;
        }

        .nav-link i {
            font-size: 18px;
            transition: var(--transition);
            color: var(--text-light);
        }

        .nav-link:hover {
            background-color: var(--bg-tertiary);
            color: var(--primary-blue);
            border-color: var(--border-color-light);
        }

        .nav-link:hover i {
            color: var(--primary-blue);
            transform: translateY(-2px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: white;
            border-color: transparent;
            box-shadow: var(--shadow-md);
        }

        .nav-link.active i {
            color: white;
            transform: scale(1.1);
        }

        .nav-link.nav-danger:hover {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--accent-red);
        }

        .nav-link.nav-danger:hover i {
            color: var(--accent-red);
        }

        /* Sidebar Footer */
        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--border-color-light);
            margin-top: auto;
            flex-shrink: 0;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 10px;
            background-color: var(--bg-tertiary);
            text-decoration: none;
            transition: var(--transition);
            border: 1px solid var(--border-color-light);
        }

        .user-profile:hover {
            background-color: var(--border-color-light);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            object-fit: cover;
            border: 2px solid var(--primary-blue);
            box-shadow: var(--shadow-sm);
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 11px;
            color: var(--text-light);
            display: block;
        }

        /* Mobile Sidebar Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(4px);
            z-index: 1040;
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .sidebar-overlay.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* ================== MAIN CONTENT ================== */
        .main-container {
            margin-left: 280px;
            transition: var(--transition);
        }

        .top-navbar {
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--border-color);
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
            flex: 1;
        }

        .mobile-menu-toggle {
            display: none;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: var(--shadow-md);
        }

        .mobile-menu-toggle:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .page-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
        }

        .page-subtitle {
            font-size: 13px;
            color: var(--text-light);
            margin: 4px 0 0 0;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar-divider {
            width: 1px;
            height: 24px;
            background-color: var(--border-color);
        }

        .profile-dropdown {
            position: relative;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--bg-tertiary);
            border: 1px solid var(--border-color-light);
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            font-size: 14px;
            font-weight: 500;
            color: var(--text-primary);
            text-decoration: none;
        }

        .profile-btn:hover {
            background-color: var(--border-color-light);
            border-color: var(--border-color);
        }

        .profile-avatar {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            object-fit: cover;
            border: 2px solid var(--primary-blue);
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            box-shadow: var(--shadow-xl);
            min-width: 180px;
            margin-top: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: var(--transition);
            z-index: 1100;
            overflow: hidden;
        }

        .dropdown-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            color: var(--text-primary);
            text-decoration: none;
            font-size: 14px;
            transition: var(--transition);
            border-bottom: 1px solid var(--border-color-light);
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background-color: var(--bg-tertiary);
            color: var(--primary-blue);
        }

        .dropdown-item i {
            font-size: 16px;
        }

        .dropdown-item.danger:hover {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--accent-red);
        }

        /* ================== PAGE CONTENT ================== */
        .page-content {
            padding: 32px;
            animation: slideUp 0.4s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-custom {
            border: 1px solid transparent;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: #059669;
            border-color: #10b9811a;
        }

        .alert-error {
            background-color: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border-color: #ef44441a;
        }

        .alert-warning {
            background-color: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border-color: #f59e0b1a;
        }

        .alert-info {
            background-color: rgba(59, 130, 246, 0.1);
            color: #1e40af;
            border-color: #3b82f61a;
        }

        /* ================== RESPONSIVE ================== */
        @media (max-width: 991px) {
            .sidebar {
                width: 260px;
                left: -260px;
            }

            .sidebar.active {
                left: 0;
            }

            .main-container {
                margin-left: 0;
            }

            .top-navbar {
                padding: 16px 20px;
            }

            .page-content {
                padding: 20px;
            }

            .mobile-menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .navbar-left {
                gap: 12px;
            }

            .page-title {
                font-size: 18px;
            }

            .sidebar-overlay {
                display: none;
            }

            .sidebar-overlay.active {
                display: block;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 240px;
                left: -240px;
            }

            .top-navbar {
                padding: 12px 16px;
                gap: 12px;
            }

            .navbar-right {
                gap: 12px;
            }

            .navbar-divider {
                display: none;
            }

            .page-title {
                font-size: 16px;
            }

            .page-subtitle {
                display: none;
            }

            .sidebar-header {
                padding: 20px 16px;
            }

            .page-content {
                padding: 16px;
            }
        }

        /* ================== FIX SUMMERNOTE Z-INDEX ================== */
        .note-editor {
            z-index: 500 !important;
        }

        .note-editor .dropdown-menu {
            z-index: 9999 !important;
        }

        .note-popover {
            z-index: 9999 !important;
        }

        /* ================== SMOOTH TRANSITIONS ================== */
        a, button {
            transition: var(--transition);
        }

        /* ================== UTILITY ================== */
        .d-flex-center {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gap-2 { gap: 8px; }
        .gap-3 { gap: 12px; }
        .gap-4 { gap: 16px; }
        .gap-5 { gap: 20px; }
    </style>

    @stack('css')
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <!-- Logo -->
        <div class="sidebar-header">
            <a href="{{ route('dashboard') }}" class="sidebar-logo">
                <img src="{{ asset('assets/images/logoborneo.webp') }}" alt="HVM Digital">
            </a>
        </div>

        <!-- Navigation Content -->
        <nav class="sidebar-content">
            <!-- Main Menu Section -->
            <div class="sidebar-section">
                <div class="sidebar-section-title">Menu</div>
                
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="mdi mdi-view-dashboard-outline"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.analytics.index') }}" class="nav-link {{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}">
                    <i class="mdi mdi-chart-line"></i>
                    <span>Analytics</span>
                </a>

                <a href="{{ route('admin.leads.index') }}" class="nav-link {{ request()->routeIs('admin.leads.*') ? 'active' : '' }}">
                    <i class="mdi mdi-account-star-outline"></i>
                    <span>Leads Tracking</span>
                </a>

                <a href="{{ route('admin.blog.index') }}" class="nav-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
                    <i class="mdi mdi-newspaper-variant-outline"></i>
                    <span>Blog Content</span>
                </a>

                <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="mdi mdi-package-variant-closed"></i>
                    <span>Products</span>
                </a>

                <a href="{{ route('admin.product-categories.index') }}" class="nav-link {{ request()->routeIs('admin.product-categories.*') ? 'active' : '' }}">
                    <i class="mdi mdi-tag-multiple-outline"></i>
                    <span>Categories</span>
                </a>

                <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                    <i class="mdi mdi-cog-outline"></i>
                    <span>Services</span>
                </a>

                <a href="{{ route('admin.home-content.index') }}" class="nav-link {{ request()->routeIs('admin.home-content.*') ? 'active' : '' }}">
                    <i class="mdi mdi-view-carousel-outline"></i>
                    <span>Home Content</span>
                </a>

                <a href="{{ route('admin.page-content.index') }}" class="nav-link {{ request()->routeIs('admin.page-content.*') ? 'active' : '' }}">
                    <i class="mdi mdi-file-document-edit-outline"></i>
                    <span>Page Content</span>
                </a>
            </div>

            <!-- Management Section -->
            <div class="sidebar-section">
                <div class="sidebar-section-title">Management</div>

                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="mdi mdi-account-group-outline"></i>
                    <span>User Management</span>
                </a>

                <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="mdi mdi-wrench-outline"></i>
                    <span>Site Settings</span>
                </a>
            </div>
        </nav>

        <!-- Sidebar Footer -->
        <div class="sidebar-footer">
            <a href="{{ route('profile.edit') }}" class="user-profile">
                <img src="{{ asset('assets/images/face1.jpg') }}" alt="Profile" class="user-avatar">
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-role">Administrator</span>
                </div>
            </a>
        </div>
    </aside>

    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <div class="navbar-left">
                <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
                    <i class="mdi mdi-menu"></i>
                </button>
                <div>
                    <h1 class="page-title">@yield('title', 'Dashboard')</h1>
                    <p class="page-subtitle">HVM Digital Management Portal</p>
                </div>
            </div>

            <div class="navbar-right">
                <div class="navbar-divider"></div>
                <div class="profile-dropdown">
                    <button class="profile-btn" id="profileBtn" type="button">
                        <img src="{{ asset('assets/images/face1.jpg') }}" alt="Profile" class="profile-avatar">
                        <span>{{ Auth::user()->name }}</span>
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <i class="mdi mdi-account-outline"></i>
                            <span>Profile Settings</span>
                        </a>
                        <a href="{{ route('dashboard') }}" class="dropdown-item">
                            <i class="mdi mdi-home-outline"></i>
                            <span>Go to Dashboard</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="w-100">
                            @csrf
                            <button type="submit" class="dropdown-item danger w-100" style="border: none; background: none; padding: 12px 16px; text-align: left; cursor: pointer;">
                                <i class="mdi mdi-logout"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="page-content">
            @if(session('success'))
                <div class="alert-custom alert-success" role="alert">
                    <i class="mdi mdi-check-circle-outline" style="font-size: 18px;"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert-custom alert-error" role="alert">
                    <i class="mdi mdi-alert-circle-outline" style="font-size: 18px;"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Menu Toggle
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const profileBtn = document.getElementById('profileBtn');
            const dropdownMenu = document.getElementById('dropdownMenu');

            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    sidebar.classList.add('active');
                    sidebarOverlay.classList.add('active');
                });
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                });
            }

            // Close sidebar when clicking nav links
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                });
            });

            // Profile Dropdown Toggle
            if (profileBtn && dropdownMenu) {
                profileBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdownMenu.classList.toggle('active');
                });

                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.profile-dropdown')) {
                        dropdownMenu.classList.remove('active');
                    }
                });
            }

            // Prevent dropdown close on form submit
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    // Let form submit naturally
                });
            });

            // Summernote Initialization
            if (jQuery('.summernote').length > 0) {
                jQuery('.summernote').summernote({
                    height: 300,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                });
            }

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.profile-dropdown') && dropdownMenu) {
                    dropdownMenu.classList.remove('active');
                }
            });
        });

        // Prevent form submission on profile dropdown items
        document.addEventListener('submit', function(e) {
            if (e.target.tagName === 'FORM') {
                // Allow form to submit
            }
        }, true);
    </script>

    @stack('js')
</body>

</html>