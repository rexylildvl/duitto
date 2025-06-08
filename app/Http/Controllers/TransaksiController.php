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

    public function tagihanStore(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
            'deadline' => 'required|date',
        ]);
        Transaksi::create([
            'tipe' => 'tagihan',
            'jumlah' => $request->jumlah,
            'user_id' => Auth::id(),
            'deadline' => $request->deadline,
            'status' => 'belum',
        ]);
        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil ditambahkan');
    }

    public function bayarTagihan($id)
    {
        $tagihan = Transaksi::findOrFail($id);
        if ($tagihan->status === 'belum') {
            $tagihan->status = 'sudah';
            $tagihan->save();
        }
        return redirect()->route('tagihan.index')->with('success', 'Tagihan sudah dibayar');
    }

    // ======= TABUNGAN =======
    public function tabunganIndex()
    {
        // Ambil semua tabungan, hitung total setor manual (tipe: setor_tabungan), dan kirim ke view
        $tabunganList = Transaksi::where('tipe', 'tabungan')->orderByDesc('created_at')->get();
        foreach ($tabunganList as $tabungan) {
            $tabungan->total_setor = Transaksi::where('tipe', 'setor_tabungan')
                ->where('nama', $tabungan->nama)
                ->sum('jumlah');
            $tabungan->last_setor_at = Transaksi::where('tipe', 'setor_tabungan')
                ->where('nama', $tabungan->nama)
                ->orderByDesc('created_at')
                ->value('created_at');
        }
        return view('transaksi.tabungan.index', ['list' => $tabunganList]);
    }

    public function tabunganStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'frekuensi' => 'required|in:hari,minggu,bulan',
            'target' => 'required|numeric|min:1',
            'jumlah' => 'required|numeric|min:1',
        ]);
        Transaksi::create([
            'tipe' => 'tabungan',
            'nama' => $request->nama,
            'frekuensi' => $request->frekuensi,
            'target' => $request->target,
            'jumlah' => $request->jumlah,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('tabungan.index')->with('success', 'Tabungan berhasil ditambahkan');
    }

    // ======= SETOR MANUAL TABUNGAN =======
    public function setorTabungan(Request $request, $id)
    {
        $tabungan = Transaksi::findOrFail($id);
        // Setor manual: buat transaksi baru tipe setor_tabungan
        Transaksi::create([
            'tipe' => 'setor_tabungan',
            'nama' => $tabungan->nama,
            'jumlah' => $tabungan->jumlah,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('tabungan.index')->with('success', 'Setor tabungan berhasil!');
    }
}