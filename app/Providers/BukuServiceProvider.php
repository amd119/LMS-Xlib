<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Buku;
use App\Models\KategoriBuku;

class BukuServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('bukuService', function ($app) {
            return new class {
                public function getAllWithKategori()
                {
                    return Buku::with('kategoriBuku')->get();
                }

                public function createBukuWithKategori($data)
                {
                    $buku = new Buku();
                    $buku->fill($data);
                    $buku->save();

                    if (isset($data['kategori_id'])) {
                        $kategori = KategoriBuku::find($data['kategori_id']);
                        $buku->kategoriBuku()->associate($kategori);
                        $buku->save();
                    }

                    return $buku;

                }

                public function updateBuku(Buku $buku, $data)
                {
                    $buku->update($data);

                    if (isset($data['kategori_id'])) {
                        $kategori = KategoriBuku::find($data['kategori_id']);
                        $buku->kategoriBuku()->associate($kategori);
                    }

                    return $buku->save();
                }

                public function deleteBuku(Buku $buku)
                {
                    return $buku->delete();
                }

                public function getUlasanByBuku(Buku $buku)
                {
                    return $buku->ulasan()->get();
                }
            };
        });
    }

    public function boot(): void
    {
        //
    }
}
