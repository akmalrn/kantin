<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('table_pembeli', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pembeli');
            $table->string('password_pembeli');
            $table->string('alamat_pembeli');
            $table->string('no_hp_pembeli');
            $table->string('jk_pembeli');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_pembeli');
    }
};
