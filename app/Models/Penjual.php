<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjual extends Authenticatable implements AuthenticatableContract
{
    use Notifiable;

    protected $table = 'table_penjual';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_penjual', 'password_penjual', 'alamat_penjual', 'no_hp_penjual', 'email_penjual', 'jk_penjual',
    ];

    // Kolom yang harus disembunyikan dari array JSON
    protected $hidden = [
        'password_penjual', 'remember_token',
    ];

    // Mutator untuk menghash password sebelum disimpan ke dalam database
    public function setPasswordAttribute($password)
    {
        $this->attributes['password_penjual'] = bcrypt($password);
    }

    // Mendapatkan nama unik pengguna untuk otentikasi
    public function getAuthIdentifierName()
    {
        return 'nama_penjual';
    }

    // Mendapatkan nilai unik pengguna untuk otentikasi
    public function getAuthIdentifier()
    {
        return $this->nama_penjual;
    }

    // Mendapatkan kata sandi pengguna untuk otentikasi
    public function getAuthPassword()
    {
        return $this->password_penjual;
    }
}