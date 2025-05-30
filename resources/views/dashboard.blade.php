<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Duitto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #2D3250;
            color: white;
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
        }
        .highlight {
            background: linear-gradient(to right, #fdb88d, white);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
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
        .sidebar {
            background-color: #3e446a;
            height: 100vh;
            padding-top: 2rem;
            position: fixed;
            width: 220px;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #2D3250;
        }
        .main-content {
            margin-left: 220px;
            padding: 2rem;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 1rem 2rem;
        }
        .logo img {
            width: 40px;
        }
        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
            background: linear-gradient(to right, #fdb88d, white);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .money-title {
            font-weight: bold;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="{{ asset('rubber-duck.png') }}" alt="Logo">
                <div class="logo-text">Duitto</div>
            </div>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('transaksi.create') }}" class="{{ request()->routeIs('transaksi.index') ? 'active' : '' }}">Transaksi</a>
            <a href="{{ route('tabungan.index') }}" class="{{ request()->routeIs('tabungan.index') ? 'active' : '' }}">Tabungan</a>
            <a href="{{ route('logout') }}">Logout</a>
        </div>

        <!-- Main Content -->
        <div class="main-content container-fluid">
            <!-- Greeting -->
            <h2 class="mb-4">Hello, {{ Auth::user()->username }}!</h2>

            <!-- Dashboard Content -->
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card p-3">
                        <div class="money-title">Pemasukan</div>
                        <ul class="mb-2">
                            @foreach($dataPemasukan as $item)
                                <li>Rp {{ number_format($item['jumlah'], 0, ',', '.') }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ route('transaksi.create', ['tipe' => 'pemasukan']) }}" class="btn btn-sm btn-peach mt-2">Tambah</a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card p-3">
                        <div class="money-title">Pengeluaran</div>
                        <ul class="mb-2">
                            @foreach($dataPengeluaran as $item)
                                <li>Rp {{ number_format($item['jumlah'], 0, ',', '.') }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ route('transaksi.create', ['tipe' => 'pengeluaran']) }}" class="btn btn-sm btn-peach mt-2">Tambah</a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card p-3">
                        <div class="money-title">Tagihan</div>
                        <ul class="mb-2">
                            @foreach($dataTagihan as $item)
                                <li>Rp {{ number_format($item['jumlah'], 0, ',', '.') }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ route('transaksi.create', ['tipe' => 'tagihan']) }}" class="btn btn-sm btn-peach mt-2">Tambah</a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card p-3">
                        <div class="money-title">Tabungan</div>
                        <h4>Rp {{ number_format($totalTabungan ?? 0, 0, ',', '.') }}</h4>
                        <a href="{{ route('transaksi.create', ['tipe' => 'tabungan']) }}" class="btn btn-sm btn-peach mt-2">Tambah</a>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card p-3">
                        <div class="money-title">Saldo Saat Ini</div>
                        <h3 class="mt-2">Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
