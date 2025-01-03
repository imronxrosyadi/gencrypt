<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/pt-buana-express.png') }}" alt="PT BUANA EXPRESS" width="75px" height="auto">
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
        Laporan
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Bill of Landing</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('*encryption*') ? 'active' : '' }}"
                    href="/report/encryption">Enkripsi</a>
                <a class="collapse-item {{ Request::is('*decryption*') ? 'active' : '' }}"
                    href="/report/decryption">Dekripsi</a>
            </div>
        </div>
    </li>
</ul>
<!-- End of Sidebar -->
