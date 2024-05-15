<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang'; // Sesuaikan dengan nama tabel keranjang jika berbeda

    protected $fillable = [
        'id_barang',
        'jumlah',
    ];

    // Jika Anda ingin mendefinisikan relasi dengan model Barang, Anda dapat melakukannya di sini
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
