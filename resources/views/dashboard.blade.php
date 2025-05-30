@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h2>Hello, {{ $user->name }}!</h2>
        <p>Ready to make smart money moves today? You’re one step closer to financial freedom 🚀</p>
    </div>

    <h4 class="mb-3 text-danger">Here's your money snapshot!</h4>

    <div class="row g-3">
        <div class="col-md-6 col-lg-3">
            <div class="card bg-warning">
                <div class="card-body">
                    <h5>Saldo</h5>
                    <h3>Rp {{ number_format($balance, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card bg-info">
                <div class="card-body">
                    <h5>Tabungan</h5>
                    @if($saving)
                        <p>Rp {{ number_format($saving->current_amount, 0, ',', '.') }}</p>
                        <p>Target: Rp {{ number_format($saving->target, 0, ',', '.') }}</p>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar"
                                 style="width: {{ ($saving->current_amount / $saving->target) * 100 }}%">
                                {{ intval(($saving->current_amount / $saving->target) * 100) }}%
                            </div>
                        </div>
                    @else
                        <p>Belum ada tabungan</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card bg-light">
                <div class="card-body">
                    <h5>Tagihan</h5>
                    <p>Rp 1.200.000</p> <!-- Statis, bisa dimodifikasi -->
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Pengeluaran</h5>
                    <p>Rp {{ number_format($expense, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Pemasukkan</h5>
                    <p>Rp {{ number_format($income, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
