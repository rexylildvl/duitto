{{-- filepath: resources/views/transaksi/pengeluaran/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengeluaran - Duitto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
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
            overflow-y: visible;
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
        .form-control {
            background-color: #5b628c;
            border: none;
            border-radius: 1rem;
            color: white;
        }
        .form-control::placeholder {
            color: #d0d3ec;
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

        .footer .d-flex.justify-content-center.align-items-center.mb-3 .bg-white {
        background-color: #2D3250 !important; /* Changed from white to match the website's purple background */
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .footer .d-flex.justify-content-center.align-items-center.mb-3 .bg-white .fw-bold {
        font-size: 1.25rem;
        background: linear-gradient(to right, #fdb88d, white);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        color: white; /* Added as fallback */
        }

        .footer .d-flex.justify-content-center.align-items-center.mb-3 .bg-white img {
            width: 30px; /* Adjust size as per image */
            height: 30px;
            margin-right: 0.5rem; /* Space between logo and text */
        }



        .footer .sponsor,
        .footer .social-icons {
            display: flex;
            justify-content: center;
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
            gap: 1rem; /* Spacing between items */
        }

        .footer .sponsor img,
        .footer .social-icons i {
            margin: 0; /* Reset margin from general rule, use gap instead */
        }

        .footer .social-icons i {
            font-size: 1.5rem;
            transition: color 0.3s;
            cursor: pointer;
        }

        .footer .social-icons i:hover {
            color: #2D3250;
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
        
        .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        width: 100%;
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
        <a href="{{ route('bantuan.index') }}" class="{{ request()->routeIs('bantuan.index') ? 'active' : '' }}"><i class="bi bi-question-circle"></i><span class="nav-text">Bantuan</span></a>
    </div>

    <div class="wrapper">
        <div class="main-content">
            <div class="top-bar">
                <div class="searchbar">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search Here" style="width: 100%;">
                </div>
                @include('layouts.profile-dropdown')
            </div>
            <h2 class="mb-4">Pengeluaran</h2>
            <div class="row mb-4">
                <!-- Atas: Form & Saldo Samping Form -->
                <div class="d-flex flex-column flex-md-row gap-3">
                    <!-- Form di pojok kiri atas -->
                    <div style="flex:1; max-width:620px;">
                        <div class="card p-4 mb-3" style="max-width:620px; width:100%;">
                            <form action="{{ route('pengeluaran.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label" style="color: #fff; font-weight: bold;">Nama Pengeluaran</label>
                                    <input type="text" name="nama" id="nama" class="form-control"
                                        style="background-color: #5b628c; color: #fff; border-radius: 1rem; border: none;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label" style="color: #fff; font-weight: bold;">Nominal</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control"
                                        style="background-color: #5b628c; color: #fff; border-radius: 1rem; border: none;" placeholder="Rp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kategori" class="form-label" style="color: #fff; font-weight: bold;">Kategori</label>
                                    <select name="kategori" id="kategori" class="form-control"
                                        style="background-color: #5b628c; color: #fff; border-radius: 1rem; border: none;" required>
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        <option value="rumah">Rumah</option>
                                        <option value="makanan">Makanan</option>
                                        <option value="transportasi">Transportasi</option>
                                        <option value="perbelanjaan">Perbelanjaan</option>
                                    </select>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-peach">Tambah</button>
                                </div>
                            </form>
                        </div>
                        <!-- List Data Pengeluaran di bawah form -->
                        <div class="card p-4 mb-4" style="max-width:620px; width:100%; color: #fff;">
                            <h5 class="mb-3 fw-bold"><i class="bi bi-cash-stack me-2"></i>Daftar Pengeluaran</h5>
                            <ul class="list-group">
                                @forelse($list as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center" style="background: #3e446a; color: #fff; border: none; border-radius: 1rem; margin-bottom: 10px;">
                                        <div>
                                            <div class="fw-bold">{{ $item->nama }}</div>
                                            <span class="badge bg-secondary">{{ ucfirst($item->kategori) }}</span>
                                        </div>
                                        <div class="fw-bold">
                                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item" style="background: #3e446a; color: #fff; border: none;">Belum ada pengeluaran.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <!-- Saldo dan Rekap di samping form -->
                    <div style="flex:1; max-width:620px; width:100%;">
                        <div class="card p-4 mb-3" style="background-color: #fdb88d; color: #2D3250; border-radius: 1.5rem; max-width:620px; width:100%;">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-wallet2" style="font-size: 2rem; margin-right: 10px;"></i>
                                <span class="fw-bold fs-4">Saldo</span>
                            </div>
                            <div>Saldo saat ini, biar kamu tahu batas aman sebelum belanja!</div>
                            <div class="fw-bold fs-3 mt-3">
                                Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}
                            </div>
                        </div>
                        <!-- Rekap Pengeluaran di bawah saldo -->
                        <div class="card p-4 mb-4" style="background-color: #fdb88d; color: #232323; border-radius: 1.5rem; max-width:620px; width:100%;">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-gift" style="font-size: 2rem; margin-right: 10px;"></i>
                                <span class="fw-bold fs-3" style="font-family: serif;">Kategori</span>
                            </div>
                            <div class="row text-center">
                                <div class="col-6 mb-3">
                                    <i class="bi bi-house-door" style="font-size: 1.5rem;"></i>
                                    <span class="fw-bold ms-1">Rumah</span>
                                    <div>{{ number_format($pengeluaranPerKategori['rumah'] ?? 0, 0, ',', '.') }}</div>
                                </div>
                                <div class="col-6 mb-3">
                                    <i class="bi bi-bus-front" style="font-size: 1.5rem;"></i>
                                    <span class="fw-bold ms-1">Transportasi</span>
                                    <div>{{ number_format($pengeluaranPerKategori['transportasi'] ?? 0, 0, ',', '.') }}</div>
                                </div>
                                <div class="col-6">
                                    <i class="bi bi-egg-fried" style="font-size: 1.5rem;"></i>
                                    <span class="fw-bold ms-1">Makanan</span>
                                    <div>{{ number_format($pengeluaranPerKategori['makanan'] ?? 0, 0, ',', '.') }}</div>
                                </div>
                                <div class="col-6">
                                    <i class="bi bi-cart2" style="font-size: 1.5rem;"></i>
                                    <span class="fw-bold ms-1">Perbelanjaan</span>
                                    <div>{{ number_format($pengeluaranPerKategori['perbelanjaan'] ?? 0, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Notifikasi --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
            </div>
        </div>
        @include('layouts.footer')
    </div>
</body>
</html>