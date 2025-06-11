<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TabunganController extends Controller
{
    public function index()
    {
        $tabunganList = \App\Models\Transaksi::where('tipe', 'tabungan')
            ->orderByDesc('created_at')
            ->get();

        // Saldo tabungan = tabungan + setor_tabungan
        $saldo = \App\Models\Transaksi::whereIn('tipe', ['tabungan', 'setor_tabungan'])->sum('jumlah');
        $targetTabungan = \App\Models\Transaksi::where('tipe', 'tabungan')->orderByDesc('created_at')->value('target');

        foreach ($tabunganList as $tabungan) {
            $totalSetor = Transaksi::where('tipe', 'setor_tabungan')
                ->where('nama', $tabungan->nama)
                ->sum('jumlah');
            $totalSetor += $tabungan->jumlah; // Tambahkan nominal awal tabungan
            $tabungan->total_setor = $totalSetor;
            $tabungan->last_setor_at = Transaksi::where('tipe', 'setor_tabungan')
                ->where('nama', $tabungan->nama)
                ->orderByDesc('created_at')
                ->value('created_at');
        }

        return view('tabungan.index', compact('tabunganList', 'saldo', 'targetTabungan'));
    }
}
