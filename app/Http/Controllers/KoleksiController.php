<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Koleksi;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class KoleksiController extends Controller
{
    public function __construct(Koleksi $koleksi)
    {
        $this->middleware('role:Peminjam');
        $this->koleksi = $koleksi;
    }

    public function koleksi(Koleksi $koleksi)
    {
        $koleksiPribadi = $koleksi->getKoleksiPribadi();
        return view('koleksi', compact('koleksiPribadi'));
    }

    public function index()
    {
        $userId = auth()->id();
        $koleksi = Koleksi::with('buku')->where('UserID', $userId)->get();
        return view('koleksi', compact('koleksi'));
    }

    public function store(Request $request)
    {
        $userId = auth()->id();
        $bukuId = $request->input('BukuID');

        $existing = Koleksi::where('UserID', $userId)
            ->where('BukuID', $bukuId)
            ->first();

        if ($existing === null) {
            $koleksi = new Koleksi([
                'UserID' => $userId,
                'BukuID' => $bukuId,
            ]);
            $koleksi->save();
        }

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke koleksi pribadi.');
    }

    public function delete(Koleksi $koleksi, $id)
    {
        $koleksi = Koleksi::findOrFail($id);
        $koleksi->delete();
        return redirect()->route('koleksi')->with('success', 'Koleksi berhasil dihapus.');
    }
}
