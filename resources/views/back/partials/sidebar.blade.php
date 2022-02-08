<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

  <div data-simplebar class="h-100">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <!-- Left Menu Start -->
      <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Menu</li>

        <li>
          <a href="{{ route('dashboard') }}" class="waves-effect">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>



          <li>
            <a href="{{ route('setting') }}" class="waves-effect">
              <i class="fas fa-cogs"></i>
              <span>Settings</span>
            </a>
          </li>

        <li>
          <a href="{{ route('guardian.api') }}" class="waves-effect">
            <i class="fas fa-key"></i>
            <span>API Credentials</span>
          </a>
        </li>

        <li>
          <a href="{{ route('category.index') }}" class="waves-effect">
            <i class="fas fa-list"></i>
            <span>News Category</span>
          </a>
        </li>

        <li>
          <a href="{{ route('logs') }}" class="waves-effect">
            <i class="fas fa-list"></i>
            <span>API Logs</span>
          </a>
        </li>

      </ul>

    </div>
    <!-- Sidebar -->
  </div>
</div>
<!-- Left Sidebar End -->
