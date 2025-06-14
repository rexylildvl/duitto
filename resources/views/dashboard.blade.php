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

        .bg-soft-peach {
        background-color: #F0C28D !important;
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
        
        .circular-chart {
            max-width: 100%;
            max-height: 100%;
        }

        .circle-bg {
            stroke: #eee;
        }

        .circle {
            stroke-linecap: round;
            transition: stroke-dasharray 0.3s ease;
        }

        .percentage {
            font-family: Arial, sans-serif;
            font-weight: bold;
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
        <a href="{{ route('bantuan.index') }}" class="{{ request()->routeIs('bantuan.index') ? 'active' : '' }}">
    <i class="bi bi-question-circle"></i>
    <span class="nav-text">Bantuan</span>
</a>

    </div>

    <!-- Wrapper Content -->
    <div class="wrapper">
        <div class="main-content container-fluid">
            <div class="top-bar">
                <div class="searchbar">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search Here" style="width: 100%;">
                </div>
                @include('layouts.profile-dropdown')
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div>
                    <div class="bg-white text-dark px-4 py-3 rounded-4 d-inline-flex align-items-center shadow-sm">
                        <img src="{{ asset('rubber-duck.png') }}" alt="Logo" width="40" class="me-3">
                        <div>
                            <div class="fw-bold fs-5 mb-1">Hello, {{ Auth::user()->username }}!</div>
                            <div class="text-muted small">Ready to make smart money moves today? You’re one step closer to financial freedom 🚀</div>
                        </div>
                    </div>
                </div>
            <div class="text-end">
                <h4 class="mb-0 fw-bold fs-2" style="color: #F3AB9D;">Here’s your money snapshot!</h4>
                <div class="text-white-50">{{ \Carbon\Carbon::now()->format('F Y') }}</div>
            </div>
    </div>

            <div class="row g-4">
                <!-- Saldo -->
                <div class="col-md-6">
                    <div class="card p-4 bg-soft-peach rounded-4 shadow-sm d-flex flex-row justify-content-between align-items-center">
                        <!-- Kiri - Ikon dan Saldo -->
                        <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-wallet2" style="font-size: 1.8rem;"></i>
                        </div>
                        <div>
                            <div class="fw-semibold fs-5">Saldo</div>
                            <div class="fw-bold fs-3">Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}</div>
                        </div>
                        </div>

                        <!-- Kanan - Tombol Tambah Saldo -->
                        <div class="text-center">
                        <a href="{{ route('pemasukan.index') }}" class="text-dark text-decoration-none">
                            <div class="border border-dark rounded p-2 d-inline-block">
                            <i class="bi bi-plus" style="font-size: 1.2rem;"></i>
                            </div>
                            <div class="mt-1 small">Tambah Saldo</div>
                        </a>
                        </div>
                    </div>
                    </div>


                <!-- Tabungan -->
                <div class="col-12">
                    <div class="row g-3">
                        @forelse($tabunganList as $tabungan)
                            @php
                                // Hitung total setor untuk tabungan ini
                                $totalSetor = \App\Models\Transaksi::where('tipe', 'setor_tabungan')
                                    ->where('nama', $tabungan->nama)
                                    ->sum('jumlah') + $tabungan->jumlah;
                                $target = $tabungan->target > 0 ? $tabungan->target : 10000000;
                                $progress = min(100, round(($totalSetor / $target) * 100));
                            @endphp
                            <div class="col-md-6">
                                <div class="card p-3 bg-soft-peach mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="money-title">
                                                <i class="bi bi-piggy-bank-fill me-1"></i> {{ $tabungan->nama }}
                                            </div>
                                            <h4>Rp {{ number_format($totalSetor, 0, ',', '.') }}</h4>
                                            <small class="text-muted">Target: Rp {{ number_format($tabungan->target, 0, ',', '.') }}</small>
                                        </div>
                                        <div style="width: 80px; height: 80px; position: relative;">
                                            <svg viewBox="0 0 36 36" class="circular-chart">
                                                <path class="circle-bg"
                                                    d="M18 2.0845
                                                        a 15.9155 15.9155 0 0 1 0 31.831
                                                        a 15.9155 15.9155 0 0 1 0 -31.831"
                                                    fill="none"
                                                    stroke="#f0e9df"
                                                    stroke-width="4" />
                                                <path class="circle"
                                                    stroke-dasharray="{{ $progress }}, 100"
                                                    d="M18 2.0845
                                                        a 15.9155 15.9155 0 0 1 0 31.831
                                                        a 15.9155 15.9155 0 0 1 0 -31.831"
                                                    fill="none"
                                                    stroke="#4b3f72"
                                                    stroke-width="4" />
                                                <text x="18" y="20.35" class="percentage" text-anchor="middle" fill="#000" font-size="6">{{ $progress }}%</text>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="card p-3 bg-soft-peach mb-3 text-center">
                                    Belum ada tabungan.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Pemasukan -->
                <div class="col-md-4">
                    <div class="card p-3 bg-white">
                        <div class="money-title">Pemasukan</div>
                        <ul class="mb-2">
                            @forelse($dataPemasukan as $item)
                                <li>Rp {{ number_format($item->jumlah, 0, ',', '.') }} <span class="text-muted small">{{ $item->created_at->format('d/m/Y') }}</span></li>
                            @empty
                                <li class="text-muted">Belum ada data.</li>
                            @endforelse
                        </ul>
                        <a href="{{ route('pemasukan.index') }}" class="btn btn-sm btn-peach mt-2">Tambah</a>
                        <a href="{{ route('pemasukan.index') }}" class="btn btn-sm btn-peach mt-2">Lihat Semua</a>
                    </div>
                </div>
                <!-- Pengeluaran -->
                <div class="col-md-4">
                    <div class="card p-3 bg-white" >
                        <div class="money-title">Pengeluaran</div>
                        <ul class="mb-2">
                            @forelse($dataPengeluaran as $item)
                                <li>Rp {{ number_format($item->jumlah, 0, ',', '.') }} <span class="text-muted small">{{ $item->created_at->format('d/m/Y') }}</span></li>
                            @empty
                                <li class="text-muted">Belum ada data.</li>
                            @endforelse
                        </ul>
                        <a href="{{ route('pengeluaran.index') }}" class="btn btn-sm btn-peach mt-2">Tambah</a>
                        <a href="{{ route('pengeluaran.index') }}" class="btn btn-sm btn-peach mt-2">Lihat Semua</a>
                    </div>
                </div>
                <!-- Tagihan -->
                <div class="col-md-4">
                    <div class="card p-3 bg-white">
                        <div class="money-title">Tagihan</div>
                        <ul class="mb-2">
                            @forelse($dataTagihan as $item)
                                <li>Rp {{ number_format($item->jumlah, 0, ',', '.') }} <span class="text-muted small">{{ $item->created_at->format('d/m/Y') }}</span></li>
                            @empty
                                <li class="text-muted">Belum ada data.</li>
                            @endforelse
                        </ul>
                        <a href="{{ route('tagihan.index') }}" class="btn btn-sm btn-peach mt-2">Tambah</a>
                        <a href="{{ route('tagihan.index') }}" class="btn btn-sm btn-peach mt-2">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        @include('layouts.footer')  
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
