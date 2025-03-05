<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Buku;
use App\Models\KategoriBuku;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;


class KategoribukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Administrator,Petugas');
    }

    public function index()
    {
        $data = KategoriBuku::all();
        return view('kategoribuku.home', compact('data'));
    }

    public function create(Request $request)
    {
        $kategoriBuku = KategoriBuku::find($request->KategoriID);
        return view('kategoribuku.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'NamaKategori' => 'required|string|max:255',
            ]);

            $kategoriBuku = new KategoriBuku();
            $kategoriBuku->NamaKategori = $request->NamaKategori;

            if ($kategoriBuku->save()) {
                return redirect()->route('kategoribuku.home')->with('success', 'Selamat, Data Kategori Berhasil di Tambahkan');
            } else {
                Log::error('Gagal menyimpan kategori buku: Operasi save() mengembalikan false.');
                return Redirect::back()->with('danger', 'Maaf, Data Kategori gagal di Tambahkan');
            }
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan kategori buku: ' . $e->getMessage());
            return Redirect::back()->with('danger', 'Terjadi kesalahan saat menyimpan data.');
        }

    }

    public function edit($id): View
    {
        $data = KategoriBuku::findOrFail($id);
        return view('kategoribuku.edit', compact('data'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $request->validate([
                'NamaKategori' => 'required|string|max:255',
            ]);

            $kategoriBuku = KategoriBuku::findOrFail($id);
            $kategoriBuku->NamaKategori = $request->NamaKategori;

            if ($kategoriBuku->save()) {
                return redirect()->route('kategoribuku.home')->with('success', 'Selamat, Data Kategori Berhasil di Update');
            } else {
                Log::error('Gagal memperbarui kategori buku: Operasi save() mengembalikan false.');
                return Redirect::back()->with('danger', 'Maaf, Data Kategori gagal di Update');
            }
        } catch (\Exception $e) {
            Log::error('Error saat memperbarui kategori buku: ' . $e->getMessage());
            return Redirect::back()->with('danger', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    public function delete($id)
	{
		try {
            $kategoriBuku = KategoriBuku::findOrFail($id);
            $kategoriBuku->delete();
            session()->flash('success', 'Kategori berhasil dihapus.');
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus kategori.');
            return response()->json(['success' => false], 500);
        }
	}
}
