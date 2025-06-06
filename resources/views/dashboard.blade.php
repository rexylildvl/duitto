<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Duitto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
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
        }

        .sidebar:hover {
            width: 220px;
        }

        .sidebar .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem 0;
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
        }

        .btn-peach {
            background-color: #fdb88d;
            color: #2D3250;
            font-weight: bold;
            border-radius: 1rem;
        }

        .btn-peach:hover {
            background-color: #fab07f;
        }

        .money-title {
            font-weight: bold;
            font-size: 1.1rem;
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
        }

        .footer {
            background-color: #e3e1dc;
            color: #333;
            padding: 3rem 1rem 2rem;
            text-align: center;
            width: 100%;
            margin-top: auto;
            font-family: 'Segoe UI', sans-serif;
        }

        .footer .logo-text {
            font-weight: bold;
            font-size: 1.5rem;
            background: linear-gradient(to right, #fdb88d, #fff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-left: 0.5rem;
        }

        .footer .sponsor img,
        .footer .social-icons i {
            margin: 0 0.5rem;
        }

        .footer .social-icons i {
            font-size: 1.5rem;
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

        .profile-dropdown:hover .profile-dropdown-content {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('rubber-duck.png') }}" alt="Logo" style="width: 40px;">
            <span class="logo-text">Duitto</span>
        </div>
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i><span class="nav-text">Beranda</span>
        </a>
        <a href="{{ route('tagihan.index') }}" class="{{ request()->routeIs('tagihan.index') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i><span class="nav-text">Tagihan</span>
        </a>
        <a href="{{ route('pengeluaran.index') }}" class="{{ request()->routeIs('pengeluaran.index') ? 'active' : '' }}">
            <i class="bi bi-cash-stack"></i><span class="nav-text">Pengeluaran</span>
        </a>
        <a href="{{ route('pemasukan.index') }}" class="{{ request()->routeIs('pemasukan.index') ? 'active' : '' }}">
            <i class="bi bi-wallet2"></i><span class="nav-text">Pemasukkan</span>
        </a>
        <a href="{{ route('tabungan.index') }}" class="{{ request()->routeIs('tabungan.index') ? 'active' : '' }}">
            <i class="bi bi-piggy-bank"></i><span class="nav-text">Tabungan</span>
        </a>
        <br><br><br><br><br><br><br><br><br><br><br><br>
        <a href="#"><i class="bi bi-question-circle"></i><span class="nav-text">Bantuan</span></a>
    </div>

    <!-- Wrapper Content -->
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
                        <a href="#">Profil</a>
                        <a href="#">Pengaturan</a>
                        <a href="{{ route('logout') }}">Keluar</a>
                    </div>
                </div>
            </div>

            <h2 class="mb-4">Hello, {{ Auth::user()->username }}!</h2>

            <div class="row g-4">
                                <!-- Pemasukan -->
                <div class="col-md-6">
                    <div class="card p-3">
                        <div class="money-title">Pemasukan</div>
                        <ul class="mb-2">
                            @forelse($dataPemasukan as $item)
                                <li>Rp {{ number_format($item->jumlah, 0, ',', '.') }} <span class="text-muted small">{{ $item->created_at->format('d/m/Y') }}</span></li>
                            @empty
                                <li class="text-muted">Belum ada data.</li>
                            @endforelse
                        </ul>
                        <a href="{{ route('pemasukan.index') }}" class="btn btn-sm btn-peach mt-2">Tambah</a>
                        <a href="{{ route('pemasukan.index') }}" class="btn btn-sm btn-light mt-2">Lihat Semua</a>
                    </div>
                </div>
                <!-- Pengeluaran -->
                <div class="col-md-6">
                    <div class="card p-3">
                        <div class="money-title">Pengeluaran</div>
                        <ul class="mb-2">
                            @forelse($dataPengeluaran as $item)
                                <li>Rp {{ number_format($item->jumlah, 0, ',', '.') }} <span class="text-muted small">{{ $item->created_at->format('d/m/Y') }}</span></li>
                            @empty
                                <li class="text-muted">Belum ada data.</li>
                            @endforelse
                        </ul>
                        <a href="{{ route('pengeluaran.index') }}" class="btn btn-sm btn-peach mt-2">Tambah</a>
                        <a href="{{ route('pengeluaran.index') }}" class="btn btn-sm btn-light mt-2">Lihat Semua</a>
                    </div>
                </div>
                <!-- Tagihan -->
                <div class="col-md-6">
                    <div class="card p-3">
                        <div class="money-title">Tagihan</div>
                        <ul class="mb-2">
                            @forelse($dataTagihan as $item)
                                <li>Rp {{ number_format($item->jumlah, 0, ',', '.') }} <span class="text-muted small">{{ $item->created_at->format('d/m/Y') }}</span></li>
                            @empty
                                <li class="text-muted">Belum ada data.</li>
                            @endforelse
                        </ul>
                        <a href="{{ route('tagihan.index') }}" class="btn btn-sm btn-peach mt-2">Tambah</a>
                        <a href="{{ route('tagihan.index') }}" class="btn btn-sm btn-light mt-2">Lihat Semua</a>
                    </div>
                </div>
                <!-- Tabungan -->
                <div class="col-md-6">
                    <div class="card p-3">
                        <div class="money-title">Tabungan</div>
                        <h4>Rp {{ number_format($totalTabungan ?? 0, 0, ',', '.') }}</h4>
                        <a href="{{ route('tabungan.index') }}" class="btn btn-sm btn-peach mt-2">Tambah</a>
                        <a href="{{ route('tabungan.index') }}" class="btn btn-sm btn-light mt-2">Lihat Semua</a>
                    </div>
                </div>
                <!-- Saldo -->
                <div class="col-md-12">
                    <div class="card p-3">
                        <div class="money-title">Saldo Saat Ini</div>
                        <h3 class="mt-2">Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
        <!-- Logo dan Nama dalam Rounded Box -->
        <div class="d-flex justify-content-center align-items-center mb-3">
            <div class="bg-white text-dark px-3 py-2 rounded-pill d-inline-flex align-items-center shadow-sm">
                <img src="{{ asset('rubber-duck.png') }}" alt="Logo" width="30" class="me-2">
                <span class="fw-bold" style="font-size: 1.25rem;">Duitto</span>
            </div>
        </div>

        <div class="fw-bold text-uppercase small">Sponsored By</div>
        <div class="sponsor my-3">
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png" height="30">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d6/Visa_2021.svg/1920px-Visa_2021.svg.png" height="30">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" height="30">
            <img src="https://upload.wikimedia.org/wikipedia/commons/3/39/BI_Logo.png" height="30">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/213px-Bank_Mandiri_logo_2016.svg.png" height="30">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/960px-Bank_Central_Asia.svg.png" height="30">
            <img src="https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/200px-BNI_logo.svg.png?20240305030303" height="30">
        </div>

        <div class="fw-bold text-uppercase small">Contact Us</div>
        <div class="social-icons mt-2">
            <i class="bi bi-facebook"></i>
            <i class="bi bi-twitter-x"></i>
            <i class="bi bi-instagram"></i>
            <i class="bi bi-tiktok"></i>
            <i class="bi bi-youtube"></i>
        </div>
    
        <div class="mt-4 small">&copy;Copyright 2025 all rights reserved.</div>
    </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
