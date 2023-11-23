    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-info border-1" style="border-bottom-color:darkgrey ">

      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-sm" data-widget="pushmenu" href="javascript:void(0)" role="button"><i
              class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="javascript:void(0)" class="nav-link text-sm">LINGARAJ LAW COLLEGE, BERHAMPUR,
            GANJAM, ODISHA, 760010</a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <a class="nav-link text-sm" href="/" role="button" target="__blank">
            <i class="fas fa-home"></i>
          </a>
        </li>
        <li class="nav-item">
          <a id="re-fresh" class="nav-link text-sm" href="javascript:void(0)" role="button">
            <i class="fas fa-refresh"></i>
          </a>
        </li>
        <li class="nav-item">
          <a id="body_theme" name="body_theme" class="nav-link text-sm" href="javascript:void(0)" role="button">
            <i class="fas fa-palette"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-sm" data-widget="fullscreen" href="javascript:void(0)" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link text-sm" data-toggle="dropdown" href="javascript:void(0)"> <i class="fas fa-user mr-1"></i>
            {{-- {{ Auth::guard('admin')->user()->name }} --}}
          </a>

          <div class="dropdown-menu dropdown-menu dropdown-menu-right">
            <a href="" class="dropdown-item"> <i class="fas fa-envelope mr-1"></i>Reset
              Password</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
