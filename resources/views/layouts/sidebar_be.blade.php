
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion @yield('toogled')" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fa-solid fa-house-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Osua</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
        {{-- {{ dd((request()->route()->named('admin.dashboard')) ? 'active' : '') }} --}}
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fa-solid fa-gauge"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ (request()->is('admin/article')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.article') }}">
            <i class="fa-solid fa-newspaper"></i>
            <span>Artikel</span>
        </a>
    </li>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ (request()->is('admin/product')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.product') }}">
            <i class="fa-solid fa-tags"></i>
            <span>Produk</span>
        </a>
    </li>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ (request()->is('admin/transaction')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.transaction') }}">
            <i class="fa-solid fa-money-bill-transfer"></i>
            <span>Transaksi</span>
        </a>
    </li>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ (request()->is('admin/hiking-trail')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.hiking-trail') }}">
            <i class="fa-solid fa-money-bill-transfer"></i>
            <span>Hiking Trail</span>
        </a>
    </li>

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> 

</ul>