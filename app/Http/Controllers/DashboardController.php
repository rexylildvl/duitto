<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPemasukan = Transaksi::where('tipe', 'pemasukan')->sum('jumlah') ?? 0;
        $totalPengeluaran = Transaksi::where('tipe', 'pengeluaran')->sum('jumlah') ?? 0;
        $totalTagihan = Transaksi::where('tipe', 'tagihan')->sum('jumlah') ?? 0;
        $totalTabungan = Transaksi::where('tipe', 'tabungan')->sum('jumlah') ?? 0;

        $saldo = $totalPemasukan - ($totalPengeluaran + $totalTagihan + $totalTabungan);

        $targetTabungan = 10000000; // bisa dari DB, default jika tidak ada

        return view('dashboard', compact(
            'saldo', 'totalPemasukan', 'totalPengeluaran',
            'totalTagihan', 'totalTabungan', 'targetTabungan'
        ));
    }

    public function store(Request $request)
    {
        Transaksi::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }
}
