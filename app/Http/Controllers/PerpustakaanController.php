<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\KategoriBuku;
use App\Models\UlasanBuku;
use App\Models\KBRelasi;
use App\Models\Buku;
use App\Models\User;


class PerpustakaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Peminjam');
    }

    // Dependency Injection
    public function index(KBRelasi $kbRelasi)
    {
        $data = $kbRelasi->get();
        return view('perpustakaan.home', compact('data'));
    }
    /////////////

    public function cari(KBRelasi $kbRelasi)
    {
        $data = $kbRelasi->get();
        $namaKategori = KategoriBuku::pluck('NamaKategori')->toArray();
        return view('caribuku', compact('data', 'namaKategori'));
    }

    public function detail(Buku $book, $id)
    {
        $book = $book->with('kategori')->find($id);
        $bukuDipinjam = $book->bukuDipinjam();
        return view('detail', compact('book', 'bukuDipinjam'));
    }
    
    public function search(Request $request, KBRelasi $kbRelasi)
    {
        $searchTerm = $request->input('searchTerm');
        $kategoriId = $request->input('KategoriID');
        $namaKategori = KategoriBuku::pluck('NamaKategori')->toArray();
        $data = $kbRelasi->searchBooks($searchTerm, $kategoriId);

        return view('caribuku', compact('data', 'namaKategori'));
    }

    public function pinjaman(KBRelasi $kbRelasi)
    {
        $data = $kbRelasi->get();
        $namaKategori = KategoriBuku::pluck('NamaKategori')->toArray();
        return view('pinjaman', compact('data', 'namaKategori'));
    }

    public function pdetail(Buku $book, $id)
    {
        $book = $book->with('kategori')->find($id);
        return view('pdetail', compact('book'));
    }

    public function detailbuku(Buku $buku, $id)
    {
        $buku = $buku->find($id);
        $ulasan = UlasanBuku::where('BukuID', $id)->get();
        $ulasanChunks = $ulasan->chunk(5);

        return view('perpustakaan.buku', [
            'data' => [
                'buku' => $buku,
                'ulasan' => $ulasan,
                'ulasanChunks' => $ulasanChunks
            ]
        ]);
    }

    public function ulasanbuku(Request $request)
    {
        if (!Auth::check()) {
            abort(403);
        }

        $data = UlasanBuku::with('buku')
            ->whereHas('user', function ($q) {
                $q->where('UserID', Auth::user()->UserID);
            })
            ->get();

        return view('detail', [
            'data' => $data,
        ]);
    }

    public function ulasanstore(Request $request, UlasanBuku $ulasanBuku)
    {
        $validatedData = $request->validate([
            'BukuID' => 'required|integer',
            'Ulasan' => 'required|string',
            'Rating' => 'required|integer|between:1,5',
        ]);

        $ulasan = new UlasanBuku;
        $ulasan->fill([
            'UserID' => Auth::user()->UserID,
            'BukuID' => $validatedData['BukuID'],
            'Ulasan' => $validatedData['Ulasan'],
            'Rating' => $validatedData['Rating'],
        ]);
        $ulasan->save();

        return redirect()->route('detail', $validatedData['BukuID'])->with('success', 'Ulasan berhasil ditambahkan.');
    }

    public function ulasanupdate(Request $request, UlasanBuku $ulasanBuku, $id)
    {
        $validatedData = $request->validate([
            'BukuID' => 'required|integer',
            'Ulasan' => 'required|string',
            'Rating' => 'required|integer|between:1,5',
        ]);

        $ulasan = $ulasanBuku->findOrFail($id);
        $ulasan->fill([
            'Ulasan' => $validatedData['Ulasan'],
            'Rating' => $validatedData['Rating'],
        ]);
        $ulasan->save();

        return redirect()->route('pdetail', [$ulasan->buku->BukuID, $ulasan->buku->peminjaman->PeminjamanID])->with('success', 'Ulasan berhasil diupdate.');
    }

    public function ulasandelete(Request $request, UlasanBuku $ulasanBuku, $id)
    {
        $ulasan = $ulasanBuku->findOrFail($id);
        $bukuId = $ulasan->buku->BukuID;
        $peminjamanId = $ulasan->buku->peminjaman ? $ulasan->buku->peminjaman->PeminjamanID : null;
        $ulasan->delete();

        if ($peminjamanId) {
            return redirect()->route('pdetail', [$bukuId, $peminjamanId])->with('success', 'Ulasan berhasil dihapus.');
        } else {
            return redirect()->route('detail', $bukuId)->with('success', 'Ulasan berhasil dihapus.');
        }
    }
}
