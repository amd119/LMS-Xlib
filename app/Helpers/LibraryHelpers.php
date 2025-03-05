<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Models\Koleksi;
use App\Models\Peminjaman;

class LibraryHelpers
{
    public static function checkIsNotLogin()
    {
        if (!Session::has('login')) {
            return Redirect::to('/login');
        }
    }

    public static function urlTo($to)
    {
        return url($to);
    }

    public static function redirectTo($icon, $pesan, $tujuan)
    {
        session()->flash('alert', [$icon, $pesan]);
        return Redirect::to($tujuan);
    }

    public static function menuActive($menu)
    {
        $currentRoute = request()->route()->getName();
        return in_array($currentRoute, $menu) ? 'active' : '';
    }

    public static function menuOpen($menu)
    {
        $currentRoute = request()->route()->getName();
        return in_array($currentRoute, $menu) ? 'menu-open' : '';
    }

    public static function hitung($table)
    {
        return DB::table($table)->count();
    }

    public static function totalKoleksi($table, $userId)
    {
        return Koleksi::where('UserID', $userId)->count();
    }

    // public static function totalPinjamanDikembalikan($table, $userId)
    // {
    //     return Peminjaman::where('UserID', $userId)->count();
    // }

    public static function totalPinjamanDikembalikan($table, $userId)
    {
        $dikembalikan = Peminjaman::where('UserID', $userId)
                             ->where('StatusPeminjaman', 'Sudah di Kembalikan')
                             ->whereNotNull('TanggalPengembalian');

        return $dikembalikan->count();
    }
}
