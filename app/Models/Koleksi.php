<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Koleksi extends Model
{
    protected $table = 'koleksipribadi';
    protected $primaryKey = 'KoleksiID';
    public $timestamps = false;
    protected $fillable = ['UserID', 'BukuID'];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'BukuID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function getKoleksiPribadi()
    {
        $userId = Auth::id();
        return $this->where('UserID', $userId)->with(['buku', 'user'])->orderByDesc('KoleksiID')->get();
    }
}
