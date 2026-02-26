<!--=================================
Header start -->
<?php use Mcamara\LaravelLocalization\Facades\LaravelLocalization; ?>
<nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <!-- Logo -->
    <div class="text-left navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="{{ url('/') }}">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
        </a>
     
    </div>
<style>
    .navbar-brand img {
    transform: scale(4.2); /* يكبر 20% */
    margin-left:-20px ;
}
</style>
    <!-- Top bar left -->
    <ul class="nav navbar-nav mr-auto">
        <li class="nav-item">
            <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left" href="javascript:void(0);">
                <i class="zmdi zmdi-menu ti-align-right"></i>
            </a>
        </li>
        <li class="nav-item">
            <div class="search">
                <a class="search-btn not_click" href="javascript:void(0);"></a>
                <div class="search-box not-click">
                    <input type="text" class="not-click form-control" placeholder="Search" name="search">
                    <button class="search-button" type="submit">
                        <i class="fa fa-search not-click"></i>
                    </button>
                </div>
            </div>
        </li>
    </ul>

    <!-- Top bar right -->
    <ul class="nav navbar-nav ml-auto align-items-center">

        <!-- Language Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ti-world"></i> {{ strtoupper(app()->getLocale()) }}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a class="dropdown-item" 
                       hreflang="{{ $localeCode }}" 
                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                @endforeach
            </div>
        </li>

        <!-- Notifications -->
        <li class="nav-item dropdown">
            <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="ti-bell"></i>
                <span class="badge badge-danger notification-status"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
                <div class="dropdown-header notifications">
                    <strong>Notifications</strong>
                    <span class="badge badge-pill badge-warning">05</span>
                </div>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    New registered user 
                    <small class="float-right text-muted time">Just now</small>
                </a>
                <a href="#" class="dropdown-item">
                    New invoice received 
                    <small class="float-right text-muted time">22 mins</small>
                </a>
            </div>
        </li>

        <!-- User Avatar & Logout -->
        <li class="nav-item dropdown mr-30">
            <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('assets/images/profile-avatar.jpg') }}" alt="avatar">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0">{{ auth()->user()->name }}</h5>
                            <span>{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"><i class="text-secondary ti-reload"></i> Activity</a>
                <a class="dropdown-item" href="#"><i class="text-success ti-email"></i> Messages</a>
                <a class="dropdown-item" href="#"><i class="text-warning ti-user"></i> Profile</a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="ti-power-off"></i> {{ __('Logout') }}
                    </button>
                </form>
            </div>
        </li>

    </ul>
</nav>
<!-- Header End -->
