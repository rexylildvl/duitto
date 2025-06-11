<div class="profile-dropdown">
    <i class="bi bi-person-circle fs-4"></i>
    <div class="profile-dropdown-content">
        <a href="{{ route('profile') }}">Profil</a>
        <form id="logout-form-profile" action="{{ route('logout') }}" method="POST" style="display: block; margin: 0;">
            @csrf
            <button type="submit" class="dropdown-item">Logout</button>
        </form>
    </div>
</div>