<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Transaksi - Duitto</title>
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
        .form-control {
            background-color: #5b628c;
            border: none;
            border-radius: 1rem;
            color: white;
        }
        .form-control::placeholder {
            color: #d0d3ec;
        }
        .sidebar {
            background-color: #1f2235;
            padding: 2rem 1rem;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 220px;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 0.75rem 1rem;
            text-decoration: none;
            margin-bottom: 1rem;
            border-radius: 1rem;
        }
        .sidebar a.active,
        .sidebar a:hover {
            background-color: #fdb88d;
            color: #2D3250;
        }
        .main-content {
            margin-left: 240px;
            padding: 2rem;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 2rem;
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
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">
        <img src="{{ asset('rubber-duck.png') }}" alt="Logo">
        <div class="logo-text">Duitto</div>
    </div>
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('transaksi.create') }}" class="active">Transaksi</a>
    <a href="{{ route('tabungan.index') }}">Tabungan</a>
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>

<!-- Main Content -->
<div class="main-content">
    <h2 class="mb-4">Tambah Transaksi Baru</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-4 mb-4" style="max-width: 600px;">
        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="tipe" class="form-label">Tipe Transaksi</label>
                <select name="tipe" id="tipe" class="form-control" required>
                    <option value="">Pilih tipe</option>
                    <option value="pemasukan">Pemasukan</option>
                    <option value="pengeluaran">Pengeluaran</option>
                    <option value="tagihan">Tagihan</option>
                    <option value="tabungan">Tabungan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Rp" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-peach">Simpan Transaksi</button>
            </div>
        </form>
    </div>

    <!-- List Transaksi -->
    <div class="card p-4">
        <h4 class="mb-3">Riwayat Transaksi</h4>
        @php
            $data = [];
            foreach (['pemasukan', 'pengeluaran', 'tagihan', 'tabungan'] as $tipe) {
                $list = session($tipe . '_list', []);
                foreach ($list as $item) {
                    $data[] = array_merge($item, ['tipe' => $tipe]);
                }
            }
            usort($data, fn($a, $b) => strtotime($b['waktu']) <=> strtotime($a['waktu']));
        @endphp

        @if(count($data))
            <ul class="list-group list-group-flush">
                @foreach ($data as $trx)
                    <li class="list-group-item bg-transparent text-white d-flex justify-content-between">
                        <span>{{ ucfirst($trx['tipe']) }} - Rp {{ number_format($trx['jumlah'], 0, ',', '.') }}</span>
                        <small>{{ \Carbon\Carbon::parse($trx['waktu'])->format('d M Y H:i') }}</small>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-white">Belum ada transaksi.</p>
        @endif
    </div>
</div>

</body>
</html>
