<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #6e5101">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
            <!-- User Info -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
          <span class="ml-2">USER</span>
        </a>
        {{-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="dropdown-item" type="submit"><i class="fas fa-sign-out-alt mr-2"></i> Logout</button>
          </form>
          </a>
        </div> --}}
      </li>
    </ul>
  </nav>