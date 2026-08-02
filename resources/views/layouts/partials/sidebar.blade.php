<nav id="sidebar" class="sidebar sidebar-offcanvas">
    <ul class="nav">
        <li class="nav-item sidebar-brand">
            <a href="{{ route('dashboard') }}" class="nav-link bg-transparent d-block">
                <div class="sidebar-brand-wrapper">
                    <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" class="brand-logo"
                        style="height: 40px;">
                    <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" class="brand-logo-mini"
                        style="width: 30px;">
                </div>
            </a>
        </li>
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link pt-2 d-flex">
                <div class="nav-profile-image">
                    <img src="{{ asset('assets/images/face1.jpg') }}" alt="profile">
                </div>
                <div class="nav-profile-text">
                    <span class="font-weight-medium mb-2">{{ Auth::user()->name }}</span>
                    <span class="text-secondary text-small">{{ Auth::user()->role }}</span>
                </div>
            </a>
        </li>
        <li class="nav-item pt-2">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.blog.index') }}"
                class="nav-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
                <i class="mdi mdi-file-document menu-icon"></i>
                <span class="menu-title">Blog</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.products.index') }}"
                class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="mdi mdi-cart menu-icon"></i>
                <span class="menu-title">Products</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.services.index') }}"
                class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="mdi mdi-settings-outline menu-icon"></i>
                <span class="menu-title">Services</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.page-content.index') }}"
                class="nav-link {{ request()->routeIs('admin.page-content.*') ? 'active' : '' }}">
                <i class="mdi mdi-file-document-edit-outline menu-icon"></i>
                <span class="menu-title">Page Content</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}"
                class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="mdi mdi-account-group menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.leads.index') }}"
                class="nav-link {{ request()->routeIs('admin.leads.*') ? 'active' : '' }}">
                <i class="mdi mdi-account-star menu-icon"></i>
                <span class="menu-title">Leads Tracking</span>
            </a>
        </li>
        <li class="nav-item mt-5">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                    class="nav-link">
                    <i class="mdi mdi-logout menu-icon"></i>
                    <span class="menu-title signout-color font-weight-medium">Sign Out</span>
                </a>
            </form>
        </li>
    </ul>
</nav>