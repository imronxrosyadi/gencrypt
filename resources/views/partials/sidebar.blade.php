<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/buana-xpress-logo.png') }}" alt="PT BUANA EXPRESS" width="175px" height="auto">
        </div>
        {{-- <div class="sidebar-brand-text mx-3">PT Buana Express</div> --}}
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Bill of Lading
    </div>

    <li class="nav-item {{ Request::is('*encryption*') ? 'active' : '' }}">
        <a class="nav-link" href="/report/encryption">
            <i class="fas fa-fw fa-cog"></i>
            <span>Enkripsi</span></a>
    </li>
    <li class="nav-item {{ Request::is('*decryption*') ? 'active' : '' }}">
        <a class="nav-link" href="/report/decryption">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Dekripsi</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Settings
    </div>

    <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            <span>Logout</span></a>
    </li>
</ul>
<!-- End of Sidebar -->
