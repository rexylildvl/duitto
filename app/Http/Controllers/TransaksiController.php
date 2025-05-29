<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tipe' => 'required|in:pemasukan,pengeluaran,tagihan,tabungan',
            'jumlah' => 'required|numeric|min:0',
        ]);

        $tipe = $request->tipe;
        $jumlah = $request->jumlah;

        $saldo = Session::get('saldo', 0);
        $pemasukan = Session::get('pemasukan', 0);
        $pengeluaran = Session::get('pengeluaran', 0);
        $tabungan = Session::get('tabungan', 0);
        $tagihan = Session::get('tagihan', 0);

        switch ($tipe) {
            case 'pemasukan':
                $saldo += $jumlah;
                $pemasukan += $jumlah;
                break;
            case 'pengeluaran':
                $saldo -= $jumlah;
                $pengeluaran += $jumlah;
                break;
            case 'tagihan':
                $saldo -= $jumlah;
                $tagihan += $jumlah;
                break;
            case 'tabungan':
                $saldo -= $jumlah;
                $tabungan += $jumlah;
                break;
        }

        Session::put('saldo', $saldo);
        Session::put('pemasukan', $pemasukan);
        Session::put('pengeluaran', $pengeluaran);
        Session::put('tabungan', $tabungan);
        Session::put('tagihan', $tagihan);

        return redirect()->route('dashboard');
    }
}
