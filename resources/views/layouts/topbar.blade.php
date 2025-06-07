<div class="top-bar">
    <div class="searchbar">
        <i class="bi bi-search"></i>
        <input type="text" placeholder="Cari sesuatu...">
    </div>
    <div class="profile-dropdown">
        <span class="text-white">{{ Auth::user()->username }}</span>
        <div class="profile-dropdown-content">
            <a href="{{ route('profile') }}">Profil</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-top').submit();">Keluar</a>
            <form id="logout-form-top" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
