<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('assets/dist/img/boxed-bg.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Web Lanjut</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/anim.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Diah Putri Nofianti</a>
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
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profile', ['name' => 'Diah Putri Nofianti']) }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/mahasiswa') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Students
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('experience') }}" class="nav-link">
                        <i class="nav-icon fas fa-school"></i>
                        <p>
                            Experiences
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/artikel') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Articles
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/matkul') }}" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Courses
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/keluarga') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Families
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/hobi') }}" class="nav-link">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>
                            Hobbies
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
