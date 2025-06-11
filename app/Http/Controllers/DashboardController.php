<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $dataPemasukan = Transaksi::where('tipe', 'pemasukan')->orderByDesc('created_at')->take(5)->get();
        $dataPengeluaran = Transaksi::where('tipe', 'pengeluaran')->orderByDesc('created_at')->take(5)->get();
        $dataTagihan = Transaksi::where('tipe', 'tagihan')->orderByDesc('created_at')->take(5)->get();

        // Ambil data tabungan terbaru (misal 5 data terakhir, sama seperti halaman tabungan)
        $tabunganList = \App\Models\Transaksi::where('tipe', 'tabungan')->orderByDesc('created_at')->get();

        $totalTabungan = Transaksi::whereIn('tipe', ['tabungan', 'setor_tabungan'])->sum('jumlah');
        $targetTabungan = Transaksi::where('tipe', 'tabungan')->orderByDesc('created_at')->value('target');

        // Saldo: hanya tagihan yang sudah dibayar yang dihitung
        $saldo = Transaksi::where('tipe', 'pemasukan')->sum('jumlah')
               - (
                    Transaksi::where('tipe', 'pengeluaran')->sum('jumlah')
                    + Transaksi::where('tipe', 'tagihan')->where('status', 'sudah')->sum('jumlah')
                    + Transaksi::where('tipe', 'tabungan')->sum('jumlah')
                    + Transaksi::where('tipe', 'setor_tabungan')->sum('jumlah')
                );

        return view('dashboard', compact(
            'dataPemasukan',
            'dataPengeluaran',
            'dataTagihan',
            'tabunganList', // <-- tambahkan ini
            'totalTabungan',
            'saldo',
            'targetTabungan'
        ));
    }
}