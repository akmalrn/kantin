<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'id_penjual', 'jenis_barang', 'nama_barang','image', 'harga_barang', 'jumlah_barang',
    ];

    public function getFullImagePathAttribute()
    {
        return asset('storage/images/' . $this->image_path);
    }

    public static function rules()
    {
        return [
            'id_penjual' => 'required',
            'jenis_barang' => 'required',
            'nama_barang' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga_barang' => 'required',
            'jumlah_barang' => 'required',
            
        ];
    }
    /**
     * Atribut yang harus tersembunyi saat di-serialize.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
    'updated_at',
    'id_penjual',
    ];

    /**
     * Atribut yang harus dikonversi ke tipe data tertentu.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    /**
     * Mendapatkan penjual yang memiliki barang.
     */
    public function penjual()
    {
        return $this->belongsTo(Penjual::class, 'id_penjual', 'id');
    }
}
