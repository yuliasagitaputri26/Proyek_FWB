<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" style="height: 100vh;">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text mx-3">Laundryku</div>
    </a>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('customer.dashboard') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard Saya</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('customer.orders.create') }}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Buat Pesanan</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('customer.status') }}">
            <i class="fas fa-fw fa-truck"></i>
            <span>Status Pesanan</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('customer.profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Profil</span>
        </a>
    </li>
</ul>
