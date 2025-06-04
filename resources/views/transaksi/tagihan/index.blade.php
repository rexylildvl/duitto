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

    <div class="wrapper">
        <div class="main-content">
            <h2 class="mb-4">Tagihan</h2>
            {{-- Form Tambah Tagihan --}}
            <div class="card p-4 mb-4" style="max-width: 600px;">
                <form action="{{ route('tagihan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Rp" required>
                    </div>
                    <div class="mb-3">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="date" name="deadline" id="deadline" class="form-control" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-peach">Simpan Tagihan</button>
                    </div>
                </form>
            </div>
            {{-- Notifikasi --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            {{-- List Data Tagihan --}}
            <div class="card p-4 mb-4" style="max-width: 600px;">
                <h5>Daftar Tagihan</h5>
                <ul class="list-group">
                    @forelse($list as $item)
                        @php
                            $lewat_deadline = $item->status == 'belum' && $item->deadline && \Carbon\Carbon::parse($item->deadline)->isPast();
                        @endphp
                        <li class="list-group-item d-flex justify-content-between align-items-center
                            @if($item->status == 'sudah') list-group-item-success
                            @elseif($lewat_deadline) list-group-item-danger
                            @endif
                        ">
                            <div>
                                <strong>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</strong>
                                <span class="badge bg-secondary ms-2">{{ $item->deadline ? \Carbon\Carbon::parse($item->deadline)->format('d/m/Y') : '-' }}</span>
                                @if($lewat_deadline)
                                    <span class="badge bg-danger ms-2">Lewat Deadline!</span>
                                @endif
                                @if($item->status == 'sudah')
                                    <span class="badge bg-success ms-2">Sudah Dibayar</span>
                                @else
                                    <span class="badge bg-warning text-dark ms-2">Belum Dibayar</span>
                                @endif
                            </div>
                            @if($item->status == 'belum')
                            <form action="{{ route('tagihan.bayar', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Bayar</button>
                            </form>
                            @endif
                        </li>
                    @empty
                        <li class="list-group-item">Belum ada tagihan.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</body>
</html>