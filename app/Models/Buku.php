<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $primaryKey = 'BukuID';
    protected $fillable = [
        'Cover', 
        'Judul', 
        'Deskripsi', 
        'Penulis', 
        'Penerbit', 
        'TahunTerbit'
    ];

    protected $casts = [
        'TahunTerbit' => 'integer',
    ];

    public $timestamps = false;

    public function kategori()
    {
        return $this->belongsToMany(
            KategoriBuku::class, 
            'kategoribuku_relasi', 
            'BukuID', 
            'KategoriID'
        );
    }

    public function diKoleksi()
    {
        $userId = Auth::id();
        $koleksi = Koleksi::where('UserID', $userId)->where('BukuID', $this->BukuID)->first();
        return $koleksi !== null;
    }

    public function bukuDipinjam()
    {
        $userId = Auth::id();
        $borrowedBook = $this->peminjaman()
            ->where('UserID', $userId)
            ->where('TanggalPengembalian', null)
            ->first();

        return $borrowedBook !== null;
    }

    public function peminjaman()
    {
        return $this->hasOne(Peminjaman::class, 'BukuID', 'BukuID');
    }

    public function ulasan()
    {
        return $this->hasMany(UlasanBuku::class, 'BukuID', 'BukuID');
    }
}
