<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row navbar-light navbar-expand-lg">
    <div class="navbar-menu-wrapper d-flex align-items-center ml-auto ml-lg-0">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a href="{{ url('/') }}" class="navbar-brand brand-logo-mini">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" style="width: 30px;">
            </a>
        </div>
        <button type="button" class="navbar-toggler navbar-toggler align-self-center d-lg-block dark-border">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-none d-lg-block">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <div class="nav-profile-img">
                        <img src="{{ asset('assets/images/face1.jpg') }}" alt="image">
                    </div>
                    <div class="nav-profile-text d-flex align-items-center">
                        <p class="mb-0 text-dark font-weight-bold">{{ Auth::user()->name }}</p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="mdi mdi-cached mr-2 text-success"></i> Settings </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>