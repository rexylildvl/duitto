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
        $saldo = Transaksi::where('tipe', 'pemasukan')->sum('jumlah')
            - (
                Transaksi::where('tipe', 'pengeluaran')->sum('jumlah')
                + Transaksi::where('tipe', 'tagihan')->where('status', 'sudah')->sum('jumlah')
                + Transaksi::where('tipe', 'tabungan')->sum('jumlah')
            );

        return view('transaksi.pemasukan.index', compact('list', 'saldo'));
    }

    public function pemasukanStore(Request $request)
    {
        $request->validate(['jumlah' => 'required|numeric|min:1']);
        Transaksi::create([
            'tipe' => 'pemasukan',
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('pemasukan.index')->with('success', 'Pemasukan berhasil ditambahkan');
    }

    // ======= PENGELUARAN =======
    public function pengeluaranIndex()
    {
        $list = Transaksi::where('tipe', 'pengeluaran')->orderByDesc('created_at')->get();

        // Hitung saldo
        $saldo = Transaksi::where('tipe', 'pemasukan')->sum('jumlah')
            - (
                Transaksi::where('tipe', 'pengeluaran')->sum('jumlah')
                + Transaksi::where('tipe', 'tagihan')->where('status', 'sudah')->sum('jumlah')
                + Transaksi::where('tipe', 'tabungan')->sum('jumlah')
            );

        $kategoriList = ['rumah', 'makanan', 'transportasi', 'perbelanjaan'];
        $ikon = [
            'rumah' => 'bi-house-door',
            'makanan' => 'bi-egg-fried',
            'transportasi' => 'bi-bus-front',
            'perbelanjaan' => 'bi-cart2'
        ];
        $pengeluaranPerKategori = \App\Models\Transaksi::where('tipe', 'pengeluaran')
            ->selectRaw('kategori, SUM(jumlah) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori')
            ->toArray();
        return view('transaksi.pengeluaran.index', compact('list', 'saldo', 'kategoriList', 'ikon', 'pengeluaranPerKategori'));
    }

    public function pengeluaranStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:1',
            'kategori' => 'required|string|max:255',
        ]);
        Transaksi::create([
            'tipe' => 'pengeluaran',
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            'kategori' => $request->kategori,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil ditambahkan');
    }


    // ======= TAGIHAN =======
    public function tagihanIndex()
    {
        $list = Transaksi::where('tipe', 'tagihan')->orderByDesc('created_at')->get();

        // Hitung saldo
        $saldo = Transaksi::where('tipe', 'pemasukan')->sum('jumlah')
            - (
                Transaksi::where('tipe', 'pengeluaran')->sum('jumlah')
                + Transaksi::where('tipe', 'tagihan')->where('status', 'sudah')->sum('jumlah')
                + Transaksi::where('tipe', 'tabungan')->sum('jumlah')
            );

        return view('transaksi.tagihan.index', compact('list', 'saldo'));
    }

    public function tagihanStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:1',
            'deadline' => 'required|date',
            'kategori' => 'required|string|max:255',
        ]);
        Transaksi::create([
            'tipe' => 'tagihan',
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            'user_id' => Auth::id(),
            'deadline' => $request->deadline,
            'status' => 'belum',
            'kategori' => $request->kategori,
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

    public function bayar($id)
    {
        $tagihan = Transaksi::findOrFail($id);
        if ($tagihan->status === 'belum') {
            $tagihan->status = 'sudah';
            $tagihan->save();

            // Tambahkan ke pengeluaran
            Transaksi::create([
                'tipe' => 'pengeluaran',
                'nama' => $tagihan->nama,
                'jumlah' => $tagihan->jumlah,
                'kategori' => $tagihan->kategori,
                'user_id' => auth()->id(),
            ]);
        }
        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil dibayar!');
    }

    // ======= TABUNGAN =======
    public function tabunganIndex()
    {
        // Ambil semua tabungan, hitung total setor manual (tipe: setor_tabungan), dan kirim ke view
        $tabunganList = Transaksi::where('tipe', 'tabungan')->orderByDesc('created_at')->get();
        foreach ($tabunganList as $tabungan) {
            $tabungan->total_setor = Transaksi::where('tipe', 'setor_tabungan')
                ->where('nama', $tabungan->nama)
                ->sum('jumlah') + $tabungan->jumlah; // tambahkan nominal awal tabungan
            $tabungan->last_setor_at = Transaksi::where('tipe', 'setor_tabungan')
                ->where('nama', $tabungan->nama)
                ->orderByDesc('created_at')
                ->value('created_at');
        }

        // Saldo tabungan = tabungan + setor_tabungan
        $saldo = Transaksi::whereIn('tipe', ['tabungan', 'setor_tabungan'])->sum('jumlah');
        // Target tabungan (ambil dari tabungan terbaru, jika ada)
        $targetTabungan = Transaksi::where('tipe', 'tabungan')->orderByDesc('created_at')->value('target');

        return view('transaksi.tabungan.index', [
            'list' => $tabunganList,
            'saldo' => $saldo,
            'targetTabungan' => $targetTabungan,
        ]);
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