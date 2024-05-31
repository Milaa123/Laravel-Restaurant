<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ URL::to('/') }}" class="brand-link">
        <img src="{{ asset('dist/img/logo.JPG') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Restaurant Q</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/avatar3.PNG') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->username }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ URL::to('/dashboard') }}"
                        class="nav-link {{ Request::is('dashboard') ? ' active' : '' }}"> <i
                            class="nav-icon fas fa-users"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-header">Restaurant Management</li>
                <li class="nav-item">
                    <a href="{{ URL::to('/category') }}"
                        class="nav-link {{ Request::is('category') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('/menu') }}" class="nav-link {{ Request::is('menu') ? ' active' : '' }}">
                        <i class="fas fa-utensils nav-icon"></i>
                        <p>
                            Menus
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('receipt') || Request::is('report') ? ' menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Request::is('receipt') || Request::is('report') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Transactions
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('/receipt') }}"
                                class="nav-link {{ Request::is('receipt') ? ' active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Receipt</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('/report') }}"
                                class="nav-link {{ Request::is('report') ? ' active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Report</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @if (auth()->user()->role == 'admin')
                    <li class="nav-header">User Management</li>
                    <li class="nav-item">
                        <a href="{{ URL::to('/user') }}" class="nav-link {{ Request::is('user') ? ' active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
