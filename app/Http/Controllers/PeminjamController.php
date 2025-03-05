<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PDF;
use App\Http\Controllers\Controller;

use App\Models\Peminjaman;

class PeminjamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Administrator,Petugas');
    }

    public function index($id = null)
    {
        $laporan = Peminjaman::with(['user', 'buku'])->when($id, function ($query) use ($id) {
            $query->whereMonth('TanggalPeminjaman', $id);
        })->get();

        $sekarang = $id ?: now()->month;

        return view('peminjam.home', compact('laporan', 'sekarang'));
    }

    public function cetaklaporan($id)
    {
        $laporan = Peminjaman::with(['user', 'buku'])->whereMonth('TanggalPeminjaman', $id)->get();

        $sekarang = $id - 1;

        $pdf = PDF::loadView('peminjam.pdf', compact('laporan', 'sekarang'));
        return $pdf->stream('DataBuku.pdf');
        // return $pdf->download('Data Buku.pdf'); // Untuk donlod pdf
    }
}
