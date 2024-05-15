<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barang')->constrained('barangs')->onDelete('cascade');
            $table->integer('jumlah_barang');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('keranjang');
    }
};
