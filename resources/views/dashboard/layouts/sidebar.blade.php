<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : ''}}" aria-current="page" href="/dashboard">
          <span data-feather="home" class="align-text-bottom"></span>
          Dashboard
        </a>
      </li>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-1 text-muted mt-3">
      <span>{{ auth()->user()->role === "ADMIN" ? "ADMINISTRATOR" : "KARYAWAN"}}</span>
    </h6>

    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/tasks*') ? 'active' : ''}}" href="/dashboard/tasks">
          <span data-feather="file-text" class="align-text-bottom"></span>
          Tugas
        </a>
      </li>
      @can('admin')
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/districts*') ? 'active' : ''}}" href="/dashboard/districts">
          <span data-feather="flag" class="align-text-bottom"></span>
          Kecamatan
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/users*') ? 'active' : ''}}" href="/dashboard/users">
          <span data-feather="users" class="align-text-bottom"></span>
          Users
        </a>
      </li>
      @endcan
    </ul>
  </div>
</nav>