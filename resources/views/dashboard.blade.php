<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Duitto Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      background-color: #2d2346;
      color: #fff;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      background-color: #f9d7d7;
      color: #000;
      border-radius: 1rem;
    }
    .money-title {
      font-weight: bold;
      font-size: 1.2rem;
    }
    .sidebar {
      background-color: #1e1b36;
      height: 100vh;
    }
    .sidebar .nav-link {
      color: #fff;
    }
    .sidebar .nav-link:hover {
      color: #ffc107;
    }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-2 sidebar d-flex flex-column p-3">
      <h4 class="text-center">🦆</h4>
      <a href="#" class="nav-link">Dashboard</a>
      <a href="#" class="nav-link">Transaksi</a>
      <a href="#" class="nav-link">Tabungan</a>
    </div>

    <!-- Content -->
    <div class="col-md-10 p-4">
  <h2>Hello, Zuzu Sipa Raia!</h2>
  <p>Ready to make smart money moves today? You're one step closer to financial freedom 🚀</p>

  <h4 class="mt-4">Here's your money snapshot!</h4>

  <div class="row g-4 mt-2">
    <!-- Saldo -->
    <div class="col-md-4">
      <div class="card p-3">
        <div class="money-title">Saldo</div>
        <h4>Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}</h4>
        <form action="{{ route('transaksi.store') }}" method="POST">
          @csrf
          <input type="hidden" name="tipe" value="pemasukan">
          <input type="number" name="jumlah" placeholder="Tambah Saldo" class="form-control mt-2">
          <button class="btn btn-sm btn-success mt-2">Tambah</button>
        </form>
      </div>
    </div>

        <div class="col-md-4">
      <div class="card p-3">
        <div class="money-title">Tabungan</div>
        <h4>Rp {{ number_format($totalTabungan ?? 0, 0, ',', '.') }}</h4>
        <div>Target Rp {{ number_format($targetTabungan ?? 0, 0, ',', '.') }}</div>
        <div class="progress mt-2">
          <div class="progress-bar" role="progressbar"
            style="width: {{ ($targetTabungan ?? 1) > 0 ? min(($totalTabungan ?? 0)/($targetTabungan ?? 1)*100, 100) : 0 }}%">
          </div>
        </div>
        <form action="{{ route('transaksi.store') }}" method="POST">
          @csrf
          <input type="hidden" name="tipe" value="tabungan">
          <input type="number" name="jumlah" placeholder="Tambah Tabungan" class="form-control mt-2">
          <button class="btn btn-sm btn-primary mt-2">Tambah</button>
        </form>
      </div>
    </div>

        <div class="col-md-4">
      <div class="card p-3">
        <div class="money-title">Tagihan</div>
        <h4>Rp {{ number_format($totalTagihan ?? 0, 0, ',', '.') }}</h4>
        <form action="{{ route('transaksi.store') }}" method="POST">
          @csrf
          <input type="hidden" name="tipe" value="tagihan">
          <input type="number" name="jumlah" placeholder="Tambah Tagihan" class="form-control mt-2">
          <button class="btn btn-sm btn-danger mt-2">Tambah</button>
        </form>
      </div>
    </div>

        <div class="col-md-6">
      <div class="card p-3">
        <div class="money-title">Pengeluaran</div>
        <h4>Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}</h4>
        <form action="{{ route('transaksi.store') }}" method="POST">
          @csrf
          <input type="hidden" name="tipe" value="pengeluaran">
          <input type="number" name="jumlah" placeholder="Tambah Pengeluaran" class="form-control mt-2">
          <button class="btn btn-sm btn-danger mt-2">Tambah</button>
        </form>
      </div>
    </div>

        <div class="col-md-6">
      <div class="card p-3">
        <div class="money-title">Pemasukan</div>
        <h4>Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}</h4>
        <form action="{{ route('transaksi.store') }}" method="POST">
          @csrf
          <input type="hidden" name="tipe" value="pemasukan">
          <input type="number" name="jumlah" placeholder="Tambah Pemasukan" class="form-control mt-2">
          <button class="btn btn-sm btn-success mt-2">Tambah</button>
        </form>
      </div>
    </div>

      </div>
    </div>
  </div>
</div>
</body>
</html>
