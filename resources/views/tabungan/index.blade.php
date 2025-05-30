@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="{{ route('transaksi.index') }}" class="list-group-item list-group-item-action">Transaksi</a>
                <a href="{{ route('tabungan.index') }}" class="list-group-item list-group-item-action active">Tabungan</a>
                <a href="{{ route('logout') }}" class="list-group-item list-group-item-action">Logout</a>
            </div>
        </div>

        <!-- Content -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Daftar Tabungan
                </div>
                <div class="card-body">
                    <p>Saldo saat ini: <strong>Rp {{ number_format($saldo, 0, ',', '.') }}</strong></p>

                    @if(count($tabunganList))
                        <ul class="list-group">
                            @foreach($tabunganList as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Rp {{ number_format($item['jumlah'], 0, ',', '.') }}
                                    <span class="text-muted small">{{ \Carbon\Carbon::parse($item['waktu'])->translatedFormat('d M Y H:i') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Belum ada tabungan yang tercatat.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
