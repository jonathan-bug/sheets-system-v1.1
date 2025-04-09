<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <!-- <img
                     src="assets/img/kaiadmin/logo_light.svg"
                     alt="navbar brand"
                     class="navbar-brand"
                     height="20"
                     />
                -->
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar d-flex justify-content-center align-items-center" style="height: 22px; width: 22px">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler" style="height: 22px; width: 22px">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more  d-flex justify-content-center align-items-center" style="height: 22px; width: 22px">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                @foreach($options as $option)
                    @if($option["status"])
                        <li class="nav-item active">
                            <a href="{{$option['route']}}">
                                <i class="fas {{$option['icon']}}"></i>
                                <p>{{$option['title']}}</p>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{$option['route']}}">
                                <i class="fas {{$option['icon']}}"></i>
                                <p>{{$option['title']}}</p>
                            </a>
                        </li>
                    @endif
                    
                    @if($option["key"] == "dashboard")
                        <!-- Navbar Group -->
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Administrar</h4>
                        </li>
                    @endif
                @endforeach
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Periodo Actual</h4>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-check"></i>
                        <p class="period-title">{{session("period")->month}} - {{session("period")->year}}</p>
                    </a>
                </li>                
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
