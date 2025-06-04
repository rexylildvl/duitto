<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // ======= PEMASUKAN =======
    public function pemasukanIndex()
    {
        $list = Transaksi::where('tipe', 'pemasukan')->orderByDesc('created_at')->get();
        return view('transaksi.pemasukan.index', compact('list'));
    }

    public function pemasukanCreate()
    {
        return view('transaksi.pemasukan.create');
    }

    public function pemasukanStore(Request $request)
    {
        $request->validate(['jumlah' => 'required|numeric|min:1']);
        Transaksi::create([
            'tipe' => 'pemasukan',
            'jumlah' => $request->jumlah,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('pemasukan.index')->with('success', 'Pemasukan berhasil ditambahkan');
    }

    // ======= PENGELUARAN =======
    public function pengeluaranIndex()
    {
        $list = Transaksi::where('tipe', 'pengeluaran')->orderByDesc('created_at')->get();
        return view('transaksi.pengeluaran.index', compact('list'));
    }

    public function pengeluaranCreate()
    {
        return view('transaksi.pengeluaran.create');
    }

    public function pengeluaranStore(Request $request)
    {
        $request->validate(['jumlah' => 'required|numeric|min:1']);
        Transaksi::create([
            'tipe' => 'pengeluaran',
            'jumlah' => $request->jumlah,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    // ======= TAGIHAN =======
    public function tagihanIndex()
    {
        $list = Transaksi::where('tipe', 'tagihan')->orderByDesc('created_at')->get();
        return view('transaksi.tagihan.index', compact('list'));
    }

    public function tagihanCreate()
    {
        return view('transaksi.tagihan.create');
    }
    public function tagihanStore(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
            'deadline' => 'required|date',
        ]);
        \App\Models\Transaksi::create([
            'tipe' => 'tagihan',
            'jumlah' => $request->jumlah,
            'user_id' => \Auth::id(),
            'deadline' => $request->deadline,
            'status' => 'belum',
        ]);
        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil ditambahkan');
    }

    public function bayarTagihan($id)
    {
        $tagihan = \App\Models\Transaksi::findOrFail($id);
        if ($tagihan->status === 'belum') {
            $tagihan->status = 'sudah';
            $tagihan->save();
            // Kurangi saldo (bisa update saldo user atau hanya tampilkan saldo di dashboard)
        }
        return redirect()->route('tagihan.index')->with('success', 'Tagihan sudah dibayar');
    }

    // ======= TABUNGAN =======
    public function tabunganIndex()
    {
        $list = Transaksi::where('tipe', 'tabungan')->orderByDesc('created_at')->get();
        return view('transaksi.tabungan.index', compact('list'));
    }

    public function tabunganCreate()
    {
        return view('transaksi.tabungan.create');
    }

    public function tabunganStore(Request $request)
    {
        $request->validate(['jumlah' => 'required|numeric|min:1']);
        Transaksi::create([
            'tipe' => 'tabungan',
            'jumlah' => $request->jumlah,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('tabungan.index')->with('success', 'Tabungan berhasil ditambahkan');
    }
}