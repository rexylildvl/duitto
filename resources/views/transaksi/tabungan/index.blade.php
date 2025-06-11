{{-- filepath: resources/views/transaksi/tabungan/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tabungan - Duitto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        html, body { height: 100%; margin: 0; }
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
        .sidebar:hover { width: 220px; }
        .sidebar .logo { display: flex; align-items: center; justify-content: center; padding: 1rem 0; }
        .sidebar:hover .logo-text { display: inline; }
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
        .sidebar a:hover, .sidebar a.active { background-color: #2D3250; }
        .sidebar i { margin-right: 16px; font-size: 18px; }
        .nav-text { display: none; }
        .sidebar:hover .nav-text { display: inline; }
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
        .btn-peach:hover { background-color: #fab07f; }
        .form-control {
            background-color: #5b628c;
            border: none;
            border-radius: 1rem;
            color: white;
        }
        .form-control::placeholder { color: #d0d3ec; }
        .progress { height: 20px; background: #23264a; border-radius: 10px; }
        .progress-bar { font-weight: bold; }
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

    <div class="wrapper">
        <div class="main-content container-fluid">
            <div class="top-bar">
                <h2 class="fw-bold mb-0" style="color: #F3AB9D;">Tabungan</h2>
                <div class="profile-dropdown">
                    <i class="bi bi-person-circle fs-4"></i>
                    <div class="profile-dropdown-content">
                        <a href="#">Profil</a>
                        <a href="#">Pengaturan</a>
                        <a href="{{ route('logout') }}">Keluar</a>
                    </div>
                </div>
            </div>

            {{-- Form Tambah Tabungan --}}
            <div class="card p-4 mb-4" style="max-width: 600px;">
                <form action="{{ route('tabungan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label" style="color: #fff;">Nama Tabungan</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Contoh: Tabungan Umroh" required>
                    </div>
                    <div class="mb-3">
                        <label for="frekuensi" class="form-label" style="color: #fff;">Frekuensi</label>
                        <select name="frekuensi" id="frekuensi" class="form-control" required>
                            <option value="hari">Harian</option>
                            <option value="minggu">Mingguan</option>
                            <option value="bulan">Bulanan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="target" class="form-label" style="color: #fff;">Target Tabungan (Rp)</label>
                        <input type="number" name="target" id="target" class="form-control" placeholder="Target nominal" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label" style="color: #fff;">Nominal Per Frekuensi</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Nominal per frekuensi" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-peach">Buat Tabungan</button>
                    </div>
                </form>
            </div>
            {{-- Notifikasi --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- List Data Tabungan --}}
            <div class="card p-4 mb-4" style="max-width: 700px; background-color: #3e446a;">
                <h5 style="color: #fff;">Daftar Tabungan</h5>
                <ul class="list-group">
                    @forelse($list as $item)
                        @php
                            $totalSetor = $item->total_setor ?? 0;
                            $progress = $item->target > 0 ? min(100, round(($totalSetor / $item->target) * 100)) : 0;
                            $reminder = false;
                            if ($item->frekuensi && $item->created_at) {
                                $lastSetor = $item->last_setor_at ?? $item->created_at;
                                $carbonLastSetor = \Carbon\Carbon::parse($lastSetor);
                                if ($item->frekuensi == 'hari') {
                                    $nextSetor = $carbonLastSetor->copy()->addDay();
                                } elseif ($item->frekuensi == 'minggu') {
                                    $nextSetor = $carbonLastSetor->copy()->addWeek();
                                } elseif ($item->frekuensi == 'bulan') {
                                    $nextSetor = $carbonLastSetor->copy()->addMonth();
                                } else {
                                    $nextSetor = $carbonLastSetor;
                                }
                                $reminder = now()->greaterThanOrEqualTo($nextSetor) && $progress < 100;
                            }
                            $sisa = $item->jumlah > 0 ? ceil(max(0, $item->target - $totalSetor) / $item->jumlah) : 0;
                        @endphp
                        <li class="list-group-item bg-transparent border-0 mb-3" style="color: #fff; border-radius: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); background: rgba(255,255,255,0.04);">
                            <strong>{{ $item->nama }}</strong> <br>
                            Target: Rp {{ number_format($item->target, 0, ',', '.') }} <br>
                            Frekuensi: {{ ucfirst($item->frekuensi) }} <br>
                            Nominal/Periode: Rp {{ number_format($item->jumlah, 0, ',', '.') }} <br>
                            Terkumpul: Rp {{ number_format($totalSetor, 0, ',', '.') }}
                            <div class="progress my-2" style="background: #23264a;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">{{ $progress }}%</div>
                            </div>
                            @if($progress < 100)
                                <form action="{{ route('tabungan.setor', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-peach">Setor Sekarang</button>
                                </form>
                                @if($reminder)
                                    <span class="badge bg-warning text-dark ms-2">Sudah waktunya setor!</span>
                                @endif
                                <span class="badge bg-info text-dark ms-2">Sisa {{ $sisa }}x setor</span>
                            @else
                                <span class="badge bg-success ms-2">Target Tercapai!</span>
                            @endif
                            <div class="text-muted small mt-1">Dibuat: {{ $item->created_at->format('d/m/Y') }}</div>
                        </li>
                    @empty
                        <li class="list-group-item bg-transparent border-0" style="color: #fff;">Belum ada tabungan.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Footer -->
        @include('layouts.footer')
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>