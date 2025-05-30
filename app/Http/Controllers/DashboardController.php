<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
{
    $dataPemasukan = session('riwayat', collect([]))->where('tipe', 'pemasukan');
    $dataPengeluaran = session('riwayat', collect([]))->where('tipe', 'pengeluaran');
    $dataTagihan = session('riwayat', collect([]))->where('tipe', 'tagihan');
    $totalTabungan = session('tabungan', 0);
    $saldo = session('saldo', 0);

    return view('dashboard', compact(
        'dataPemasukan',
        'dataPengeluaran',
        'dataTagihan',
        'totalTabungan',
        'saldo'
    ));
}


    public function store(Request $request)
    {
        Transaksi::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }
}
