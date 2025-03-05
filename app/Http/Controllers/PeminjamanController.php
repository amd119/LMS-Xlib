<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PeminjamanController extends Controller
{
    // Metode Dependency Injection
    public function index(Peminjaman $peminjaman)
    {
        $data = $peminjaman->getPinjam();
        return view('peminjaman.home', compact('data'));
    }
    ////////////

    public function bukuDipinjam()
    {
        $userId = Auth::id();
        $peminjaman = Peminjaman::whereHas('buku', function ($query) use ($userId) {
            $query->where('UserID', $userId);
        })->get();

        $bukuDipinjam = $peminjaman->load('buku');

        return view('pinjaman', compact('bukuDipinjam'));
    }

    public function pdetail($bid, $pid)
    {
        $peminjaman = Peminjaman::findOrFail($pid);
        $book = $peminjaman->buku;

        if ($book) {
            return view('pdetail', compact('book', 'peminjaman'));
        } else {
            return redirect()->back()->with('error', 'Buku tidak ditemukan atau tidak sedang dipinjam.');
        }
    }

    public function store(Request $request)
    {
        $book = Buku::findOrFail($request->input('BukuID'));

        $peminjaman = Peminjaman::create([
            'UserID' => Auth::id(),
            'BukuID' => $request->input('BukuID'),
            'TanggalPeminjaman' => now()->toDateString(),
            'StatusPeminjaman' => 'Belum di Kembalikan'
        ]);

        // $book->is_available = false;
        // $book->save();

        if ($peminjaman) {
            return redirect()->route('pinjaman')->with('success', 'Selamat, Buku berhasil di pinjam');
        } else {
            return redirect()->back()->with('error', 'Maaf, Buku gagal di pinjam');
        }
    }

    public function pkembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->TanggalPengembalian == null) {
            $peminjaman->update([
                'TanggalPengembalian' => now()->toDateString(),
                'StatusPeminjaman' => 'Sudah di Kembalikan'
            ]);

            // $buku = $peminjaman->buku()->first();
            // $buku->is_available = true;
            // $buku->save();

            if ($peminjaman->wasChanged()) {
                return redirect()->route('pinjaman')->with('success', 'Selamat, Buku berhasil di kembalikan!');
            } else {
                return redirect()->back()->with('error', 'Maaf, Buku gagal di kembalikan!');
            }
        } else {
            return redirect()->back()->with('error', 'Buku sudah dikembalikan sebelumnya.');
        }
    }
}
