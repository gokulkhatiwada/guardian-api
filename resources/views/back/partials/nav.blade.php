<header id="page-topbar">
  <div class="navbar-header">
    <div class="d-flex">
      <!-- LOGO -->
      <div class="navbar-brand-box">

        <a href="/" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ settings('name') }}" alt="" height="22">
                    </span>
          <span class="logo-lg">
                        <img src="{{ settings('name') }}" alt="" height="20">
                    </span>
        </a>
      </div>

      <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
        <i class="fas fa-align-justify"></i>
      </button>

    </div>

    <div class="d-flex">

      <div class="dropdown d-none d-lg-inline-block ml-1">
        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
          <i class="fas fa-expand-arrows-alt"></i>
        </button>
      </div>



      <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i>
          <span class="d-none d-sm-inline-block ml-1">{{ auth()->user()->name }}</span>
          <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
          <!-- item-->
          <a class="dropdown-item" href="{{ route('change.password') }}"><i class="mdi mdi-lock font-size-16 align-middle mr-1"></i> Change Password</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" onclick="document.getElementById('logout-form').submit()"><i class="mdi mdi-logout font-size-16 align-middle mr-1"></i> Logout</a>
          <form action="{{ route('logout') }}" id="logout-form" method="post" style="display: none">@csrf</form>
        </div>
      </div>

    </div>
  </div>
</header>
