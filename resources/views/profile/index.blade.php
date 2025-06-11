<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil - Duitto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        body {
            background-color: #2D3250;
            color: white;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-height: 100vh;
            overflow-y: auto;
        }

        .sidebar {
            background-color: #424769;
            height: 100vh;
            width: 70px;
            position: fixed;
            transition: width 0.3s ease;
            overflow-x: hidden;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 1rem;
        }

        .sidebar:hover {
            width: 220px;
        }

        .sidebar .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem 0;
            margin-bottom: 1rem;
        }

        .sidebar:hover .logo-text {
            display: inline;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
            background: linear-gradient(to right, #fdb88d, white);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: none;
            margin-left: 10px;
            white-space: nowrap;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            font-weight: bold;
            white-space: nowrap;
            transition: background-color 0.3s;
            width: 100%;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #2D3250;
        }

        .sidebar i {
            margin-right: 16px;
            font-size: 18px;
        }

        .nav-text {
            display: none;
        }

        .sidebar:hover .nav-text {
            display: inline;
        }

        .main-content {
            margin-left: 70px;
            transition: margin-left 0.3s ease;
            padding: 2rem;
            flex: 1;
            width: calc(100% - 70px);
        }

        .sidebar:hover ~ .wrapper .main-content {
            margin-left: 220px;
            width: calc(100% - 220px);
        }

        .card {
            background-color: #3e446a;
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            padding: 1.5rem;
        }

        .btn-peach {
            background-color: #fdb88d;
            color: #2D3250;
            font-weight: bold;
            border-radius: 1rem;
            border: none;
        }

        .btn-peach:hover {
            background-color: #fab07f;
        }

        .searchbar {
            background-color: #eee;
            border-radius: 20px;
            padding: 5px 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #333;
            width: 400px;
            max-width: 100%;
        }

        .searchbar input {
            border: none;
            background: transparent;
            width: 100%;
            outline: none;
            color: #333;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            width: 100%;
        }

        .profile-dropdown {
            position: relative;
            display: inline-block;
        }

        .profile-dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 160px;
            right: 0;
            z-index: 1001;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .profile-dropdown-content a {
            color: #333;
            padding: 10px 16px;
            text-decoration: none;
            display: block;
        }

        .profile-dropdown-content a,
    .profile-dropdown-content button.dropdown-item {
        color: #333;
        padding: 10px 16px;
        text-decoration: none;
        display: block;
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        font-size: 1rem;
        cursor: pointer;
        box-sizing: border-box;
    }
    .profile-dropdown-content form {
        margin: 0;
    }

        .profile-dropdown:hover .profile-dropdown-content {
            display: block;
        }

        .profile-dropdown-content a:hover,
.profile-dropdown-content button.dropdown-item:hover {
    color: #F3AB9D; 
    background-color: transparent;
    text-decoration: underline; 
}

        /* Profile Page Specific Styles */
        .profile-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .profile-header h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .profile-icon {
            font-size: 5rem;
            color: #fdb88d;
            margin-bottom: 1rem;
        }

        .profile-form {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: bold;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            background-color: #424769;
            border: 1px solid #565b7f;
            color: white;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            width: 100%;
        }

        .form-control:focus {
            background-color: #424769;
            color: white;
            border-color: #fdb88d;
            box-shadow: 0 0 0 0.25rem rgba(253, 184, 141, 0.25);
        }

        .btn-save {
            background-color: #fdb88d;
            color: #2D3250;
            padding: 0.75rem 2rem;
            font-weight: bold;
            border-radius: 0.75rem;
            border: none;
            transition: all 0.3s;
        }

        .btn-save:hover {
            background-color: #fab07f;
            transform: translateY(-2px);
        }

        .btn-change-password {
            background-color: transparent;
            color: #fdb88d;
            border: 1px solid #fdb88d;
            padding: 0.75rem 2rem;
            font-weight: bold;
            border-radius: 0.75rem;
            transition: all 0.3s;
        }

        .btn-change-password:hover {
            background-color: rgba(253, 184, 141, 0.1);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('rubber-duck.png') }}" alt="Logo" style="width: 40px;">
            <span class="logo-text">Duitto</span>
        </div>
        <a href="{{ route('dashboard') }}">
            <i class="bi bi-house-door"></i><span class="nav-text">Beranda</span>
        </a>
        <a href="{{ route('tagihan.index') }}">
            <i class="bi bi-receipt"></i><span class="nav-text">Tagihan</span>
        </a>
        <a href="{{ route('pengeluaran.index') }}">
            <i class="bi bi-cash-stack"></i><span class="nav-text">Pengeluaran</span>
        </a>
        <a href="{{ route('pemasukan.index') }}">
            <i class="bi bi-wallet2"></i><span class="nav-text">Pemasukkan</span>
        </a>
        <a href="{{ route('tabungan.index') }}">
            <i class="bi bi-piggy-bank"></i><span class="nav-text">Tabungan</span>
        </a>
        <br><br><br><br><br><br><br><br><br><br><br><br>
        <a href="{{ route('bantuan.index') }}">
            <i class="bi bi-question-circle"></i>
            <span class="nav-text">Bantuan</span>
        </a>
    </div>

    <div class="wrapper">
        <div class="main-content container-fluid">
            <div class="top-bar">
                <div class="searchbar">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search Here" style="width: 100%;">
                </div>
                <div class="profile-dropdown">
                    <i class="bi bi-person-circle fs-4"></i>
                    <div class="profile-dropdown-content">
                        <a href="{{ route('profile') }}">Profil</a>
                        <a href="{{ route('logout') }}">Keluar</a>
                    </div>
                </div>
            </div>

            <div class="profile-header">
                <div class="profile-icon">
                    <i class="bi bi-person-circle"></i>
                </div>
                <h1>Profil Pengguna</h1>
            </div>

            <div class="card">
                <div class="profile-form">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->username }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                        </div>

                        <div class="d-flex gap-3 mt-4">
                            <button type="submit" class="btn btn-save">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>