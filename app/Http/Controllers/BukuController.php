<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateBukuRequest;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Laravel\Facades\Image;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use App\Traits\UploadCover;

// use PDF;
use App\Models\Buku;
use App\Models\KBRelasi;
use App\Models\UlasanBuku;
use App\Models\KategoriBuku;

use App\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class BukuController extends Controller
{
    use UploadCover;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Administrator,Petugas');
    }

    public function index()
    {
        $data = Buku::with('kategori')->get();
        return view('buku.home', compact('data'));
    }

    public function create()
    {
        $data = KategoriBuku::all();
        return view('buku.create', ['data' => $data]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'KategoriID' => 'required|array|exists:kategoribuku,KategoriID',
                'Cover' => 'required|image|max:2048',
                'Judul' => 'required|max:255',
                'Deskripsi' => 'required|max:1000',
                'Penulis' => 'required|max:255',
                'Penerbit' => 'required|max:255',
                'TahunTerbit' => 'required|digits:4|date_format:Y',
            ]);
  
            $cover = $request->file('Cover');
            $imageName = $cover->hashName();
            $cover->store('uploads', 'public');

            $buku = Buku::create([
                'Cover' => $imageName,
                'Judul' => $request->Judul,
                'Deskripsi' => $request->Deskripsi,
                'Penulis' => $request->Penulis,
                'Penerbit' => $request->Penerbit,
                'TahunTerbit' => $request->TahunTerbit,
            ]);

            $buku->kategori()->attach($request->KategoriID);

            return redirect()->route('buku.home')->with('success', 'Selamat, Buku Berhasil di Tambahkan');
        } catch (Exception $e) {
            Log::error('Error saat menyimpan buku: ' . $e->getMessage());
            return Redirect::back()->with('danger', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function edit($id)
    {
        $buku = Buku::find($id);
        $data = KategoriBuku::all();
        return view('buku.edit', compact('buku', 'data'));
    }

    public function update(Request $request, $id)
    {
        try {
            $buku = Buku::findOrFail($id);

            $validatedData = $request->validate([
                'Judul' => 'sometimes|required|string|max:255',
                'Deskripsi' => 'sometimes|required|max:1000',
                'Penulis' => 'sometimes|required|string|max:255',
                'Penerbit' => 'sometimes|required|string|max:255',
                'TahunTerbit' => 'sometimes|required|digits:4|date_format:Y',
                'Cover' => 'sometimes|image|max:2048'
            ]);

            if ($request->hasFile('Cover')) {
                if ($buku->Cover && Storage::disk('public')->exists('uploads/' . $buku->Cover)) {
                    Storage::disk('public')->delete('uploads/' . $buku->Cover);
                }
                
                $cover = $request->file('Cover');
                $imageName = $cover->hashName();
                $cover->store('uploads', 'public');
                
                $validatedData['Cover'] = $imageName;
            }

            $buku->update($validatedData);

            if ($request->has('KategoriID')) {
                $kbRelasi = new KBRelasi();
                $kbRelasi->updateKategori($buku->BukuID, $request->KategoriID);
            }

            return redirect()->route('buku.home')->with('success', 'Selamat, Data Buku Berhasil di Update');
        } catch (Exception $e) {
            Log::error('Error saat memperbarui buku: ' . $e->getMessage());
            return Redirect::back()->with('danger', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    public function delete(Buku $buku, $id)
    {
        try {
            $buku = Buku::findOrFail($id);
            $buku->delete();
            return redirect()->route('buku.home')->with('success', 'Selamat, Data Buku berhasil dihapus!');
        } catch (Exception $e) {
            session()->flash('error', 'Gagal menghapus Data Buku.');
            return response()->json(['success' => false], 500);
        }
    }

    public function ulasan($id)
    {
        $buku = Buku::findOrFail($id);
        $ulasan = UlasanBuku::where('BukuID', $buku->BukuID)->get();
        return view('buku.ulasan', compact('buku', 'ulasan'));
    }

    public function ulasandelete(Request $request, UlasanBuku $ulasanBuku, $id)
    {
        $ulasan = $ulasanBuku->findOrFail($id);
        $ulasan->delete();

        return redirect()->route('buku.ulasan', $ulasan->BukuID)->with('success', 'Ulasan berhasil dihapus.');
    }

    public function cetaklaporan()
    {
        $data = Buku::with('kategori')->get();
        $pdf = PDF::loadView('buku.pdf', ['data' => $data]);
        return $pdf->stream('DataBuku.pdf');
        // return $pdf->download('Data Buku.pdf'); // Untuk donlod pdf
    }
}
