<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
    use HasFactory;

    protected $table = 'kategoribuku';
    protected $primaryKey = 'KategoriID';
    protected $fillable = ['NamaKategori'];
    public $timestamps = false;

    public function buku()
    {
        return $this->belongsToMany(
            Buku::class, 
            'kategoribuku_relasi', 
            'KategoriID', 
            'BukuID'
        )->withPivot('KategoriBukuID');
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($kategori) {
            $exists = static::where('NamaKategori', $kategori->NamaKategori)
                          ->where('KategoriID', '!=', $kategori->KategoriID)
                          ->exists();
            if ($exists) {
                throw new \Exception('Kategori sudah ada');
            }
        });
    }
}
