<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransaksiController extends Controller
{
    // Tampilkan form tambah transaksi + daftar transaksi
    public function create()
    {
        return view('transaksi.create', [
            'pemasukanList' => Session::get('pemasukan_list', []),
            'pengeluaranList' => Session::get('pengeluaran_list', []),
            'tagihanList' => Session::get('tagihan_list', []),
            'tabunganList' => Session::get('tabungan_list', []),
            'saldo' => Session::get('saldo', 0),
        ]);
    }

    // Menyimpan data transaksi
    public function store(Request $request)
    {
        $request->validate([
            'tipe' => 'required|in:pemasukan,pengeluaran,tagihan,tabungan',
            'jumlah' => 'required|numeric|min:0',
        ]);

        $tipe = $request->tipe;
        $jumlah = $request->jumlah;

        // Ambil data dari session
        $saldo = Session::get('saldo', 0);
        $pemasukanList = Session::get('pemasukan_list', []);
        $pengeluaranList = Session::get('pengeluaran_list', []);
        $tagihanList = Session::get('tagihan_list', []);
        $tabunganList = Session::get('tabungan_list', []);

        $entry = [
            'jumlah' => $jumlah,
            'waktu' => now()->toDateTimeString(),
        ];

        switch ($tipe) {
            case 'pemasukan':
                $saldo += $jumlah;
                $pemasukanList[] = $entry;
                Session::put('pemasukan_list', $pemasukanList);
                break;

            case 'pengeluaran':
                $saldo -= $jumlah;
                $pengeluaranList[] = $entry;
                Session::put('pengeluaran_list', $pengeluaranList);
                break;

            case 'tagihan':
                $saldo -= $jumlah;
                $tagihanList[] = $entry;
                Session::put('tagihan_list', $tagihanList);
                break;

            case 'tabungan':
                $saldo -= $jumlah;
                $tabunganList[] = $entry;
                Session::put('tabungan_list', $tabunganList);
                break;
        }

        Session::put('saldo', $saldo);

        return redirect()->route('transaksi.create')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // Opsional: menampilkan daftar tabungan saja
    public function tabunganIndex()
    {
        $tabunganList = Session::get('tabungan_list', []);
        $saldo = Session::get('saldo', 0);

        return view('tabungan.index', compact('tabunganList', 'saldo'));
    }
}
