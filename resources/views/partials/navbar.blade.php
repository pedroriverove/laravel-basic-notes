<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="{{ route('dashboard') }}">Laravel</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
        <i class="fa fa-bars"></i>
    </button>
    <ul class="navbar-nav ms-auto ms-auto me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
               aria-expanded="false"><i class="fa fa-user fa-fw me-2"></i>{{ Auth::user()->name }}</a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('profile') }}">{{ __('global-message.profile') }}</a></li>
                <li>
                    <hr class="dropdown-divider"/>
                </li>
                <li><a role="button" class="dropdown-item" onclick="logout()">{{ __('global-message.logout') }}</a></li>
            </ul>
        </li>
    </ul>
</nav>
