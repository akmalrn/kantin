<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = "transaksi";

    protected $fillable = [
        'user_id',
        'id_barang',
        'jumlah_barang',
        'total_harga',
        'status_barang',
        'tempat',
        'pembayaran',
    ];

    public function barang()
    {
        return $this->belongsTo(Keranjang::class,'id_barang');
    }
    public function definisi()
{
    return $this->hasMany(TransaksiDefinisi::class, 'transaksi_id');
}
}
