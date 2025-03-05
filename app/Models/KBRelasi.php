<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class KBRelasi extends Model
{
    use HasFactory;

    protected $table = 'kategoribuku_relasi';
    protected $primaryKey = 'KategoriBukuID';
    protected $fillable = ['KategoriID', 'BukuID'];
    public $timestamps = false;

    public function create(array $data)
    {
        return $this->create($data);
    }

    public function get()
    {
        $data = Buku::with('kategori')->orderBy('BukuID', 'desc')->get();

        $result = [];
        foreach ($data as $item) {
            $kategori = $item->kategori->pluck('NamaKategori')->toArray();

            $result[] = (object)[
                'BukuID' => $item->BukuID,
                'Cover' => $item->Cover,
                'Judul' => $item->Judul,
                'Deskripsi' => $item->Deskripsi,
                'Penulis' => $item->Penulis,
                'Penerbit' => $item->Penerbit,
                'TahunTerbit' => $item->TahunTerbit,
                'NamaKategori' => $kategori,
            ];
        }

        return $result;
    }

    public function searchBooks($searchTerm, $kategoriId)
    {
        $query = Buku::with('kategori')
        ->when($searchTerm, function ($query, $searchTerm) {
            return $query->where('Judul', 'like', '%' . $searchTerm . '%')
                ->orWhere('Deskripsi', 'like', '%' . $searchTerm . '%')
                ->orWhere('Penulis', 'like', '%' . $searchTerm . '%');
        })
        ->when($kategoriId && $kategoriId !== [''], function ($query, $kategoriId) {
            return $query->whereHas('kategori', function ($q) use ($kategoriId) {
                $q->whereIn('NamaKategori', $kategoriId);
            });
        })
        ->orderBy('BukuID', 'desc')
        ->get();

        $result = [];
        foreach ($query as $item) {
            $kategori = $item->kategori->pluck('NamaKategori')->toArray();

            $result[] = (object)[
                'BukuID' => $item->BukuID,
                'Cover' => $item->Cover,
                'Judul' => $item->Judul,
                'Deskripsi' => $item->Deskripsi,
                'Penulis' => $item->Penulis,
                'Penerbit' => $item->Penerbit,
                'TahunTerbit' => $item->TahunTerbit,
                'NamaKategori' => $kategori,
            ];
        }

        return $result;
    }

    public function updateKategori($bukuId, $kategoriIds)
    {
        // Menghapus relasi kategori yang sudah ada
        DB::table('kategoribuku_relasi')->where('BukuID', $bukuId)->delete();

        // Membuat relasi baru dengan kategori yang dipilih
        foreach ($kategoriIds as $kategoriId) {
            DB::table('kategoribuku_relasi')->insert([
                'BukuID' => $bukuId,
                'KategoriID' => $kategoriId,
            ]);
        }
    }
}
