<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDefinisi extends Model
{
    use HasFactory;

    protected $table = "transaksi_definisi";

    protected $fillable = [
        'transaksi_id', 'user_id', 'id_barang'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}
