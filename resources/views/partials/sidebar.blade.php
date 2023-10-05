<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-tachometer fa-fw"></i></div>
                    {{ __('global-message.dashboard') }}
                </a>
                <div class="sb-sidenav-menu-heading">{{ __('global-message.modules') }}</div>
                <a class="nav-link {{ Route::is('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-users fa-fw"></i></div>
                    {{ __('global-message.users') }}
                </a>
                <a class="nav-link {{ Route::is('notes.*') ? 'active' : '' }}" href="{{ route('notes.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-book fa-fw"></i></div>
                    {{ __('global-message.notes') }}
                </a>
            </div>
        </div>
    </nav>
</div>
