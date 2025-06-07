<div class="sidebar">
    <div class="logo">
        <i class="bi bi-currency-dollar text-peach fs-4"></i>
        <span class="logo-text">Duitto</span>
    </div>
    <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
        <i class="bi bi-house-door-fill"></i>
        <span class="nav-text">Dashboard</span>
    </a>
    <a href="{{ route('transactions.index') }}" class="{{ request()->is('transactions*') ? 'active' : '' }}">
        <i class="bi bi-wallet2"></i>
        <span class="nav-text">Transaksi</span>
    </a>
    <a href="{{ route('profile') }}" class="{{ request()->is('profile') ? 'active' : '' }}">
        <i class="bi bi-person-fill"></i>
        <span class="nav-text">Profil</span>
    </a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right"></i>
        <span class="nav-text">Keluar</span>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
