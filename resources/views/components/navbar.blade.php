<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img
                    src="assets/img/kaiadmin/logo_light.svg"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="20"
                />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar d-flex justify-content-center align-items-center" style="height: 22px; width: 22px;">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler" style="height: 22px; width: 22px;">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more d-flex justify-content-center align-items-center">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom shadow-sm">
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <!-- User -->
                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a
                        href="#"
                        aria-expanded="false"
                    >
                        <span class="profile-username">
                            <span class="op-7">Hola,</span>
                            <span class="fw-bold">{{$user}}</span>
                        </span>
                    </a>
                </li>
                
                <!-- Icon Button -->
                <li class="nav-item topbar-icon dropdown hidden-caret">
                    <a
                        class="nav-link dropdown-toggle"
                        href="{{route('logout')}}"
                        id="messageDropdown"
                        role="button"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i class="fa fa-key"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>

