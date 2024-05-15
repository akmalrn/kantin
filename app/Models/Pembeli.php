<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Authenticatable implements AuthenticatableContract
{
    use Notifiable;

    protected $table = 'table_pembeli';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_pembeli', 'password_pembeli', 'alamat_pembeli', 'no_hp_pembeli', 'jk_pembeli',
    ];

    // Kolom yang harus disembunyikan dari array JSON
    protected $hidden = [
        'password_pembeli', 'remember_token',
    ];

    // Mutator untuk menghash password sebelum disimpan ke dalam database
    public function setPasswordAttribute($password)
    {
        $this->attributes['password_pembeli'] = bcrypt($password);
    }

    // Mendapatkan nama unik pengguna untuk otentikasi
    public function getAuthIdentifierName()
    {
        return 'nama_pembeli';
    }

    // Mendapatkan nilai unik pengguna untuk otentikasi
    public function getAuthIdentifier()
    {
        return $this->nama_pembeli;
    }

    // Mendapatkan kata sandi pengguna untuk otentikasi
    public function getAuthPassword()
    {
        return $this->password_pembeli;
    }
}
