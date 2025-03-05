<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'UserID';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'password',
        'NamaLengkap',
        'Alamat',
        'Role',
    ];

    protected $guarded = ['google_id', 'google_token', 'google_refresh_token'];

    protected $hidden = [
        'remember_token',
    ];

    public function ulasan()
    {
        return $this->hasMany(UlasanBuku::class, 'UserID', 'UserID');
    }

    // protected function casts(): array
    // {
    //     return [
    //         'email_verified_at' => 'datetime',
    //         'password' => 'hashed',
    //     ];
    // }
}
