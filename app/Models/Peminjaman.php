<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'PeminjamanID';
    protected $fillable = ['PeminjamanID', 'UserID', 'BukuID', 'TanggalPeminjaman', 'TanggalPengembalian', 'StatusPeminjaman'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'BukuID');
    }

    public function getPinjam()
    {
        return $this->join('users', 'peminjaman.UserID', '=', 'users.UserID')->join('buku', 'peminjaman.BukuID', '=', 'buku.BukuID')->where('peminjaman.UserID', Auth::id())->get();
    }

    public function getAll()
    {
        return $this->join('users', 'peminjaman.UserID', '=', 'users.UserID')->join('buku', 'peminjaman.BukuID', '=', 'buku.BukuID')->get();
    }
}
