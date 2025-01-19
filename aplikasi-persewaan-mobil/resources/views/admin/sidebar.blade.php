<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #6e5101">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('assets/zeroone.png') }}" alt="App Logo" class="brand-image" style="width: 30px; height: auto; margin-right: 10px;">
        <span class="brand-text font-weight-light">Rental App</span>
    </a>
  
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
  
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item @if(request()->is('home*')) menu-open @endif">
                    <a href="{{ route('home') }}" class="nav-link @if(request()->is('home*')) active @endif">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                
                <!-- Check if the user is authenticated -->
                @auth
                    {{-- Manajemen Mobil --}}
                    <li class="nav-item @if(request()->is('mobil*')) menu-open @endif">
                        <a href="{{ route('mobil.index') }}" class="nav-link @if(request()->is('mobil*')) active @endif">
                            <i class="nav-icon fas fa-car"></i>
                            <p>
                                Manajemen Mobil
                            </p>
                        </a>
                    </li>
                    {{-- Peminjaman Mobil --}}
                    <li class="nav-item @if(request()->is('peminjaman*')) menu-open @endif">
                        <a href="{{ route('peminjaman.index') }}" class="nav-link @if(request()->is('peminjaman*')) active @endif">
                            <i class="nav-icon fas fa-receipt"></i>
                            <p>
                                Peminjaman Mobil
                            </p>
                        </a>
                    </li>
                    {{-- Pengembalian Mobil --}}
                    <li class="nav-item @if(request()->is('returns*')) menu-open @endif">
                        <a href="{{ route('returns.index') }}" class="nav-link @if(request()->is('returns*')) active @endif">
                            <i class="nav-icon fas fa-receipt"></i>
                            <p>
                                Pengembalian Mobil
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Log Out</p>
                        </a>
                        <!-- Logout Form -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
