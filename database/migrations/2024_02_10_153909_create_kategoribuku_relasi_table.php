<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoribukuRelasiTable extends Migration
{
    public function up()
    {
        Schema::create('kategoribuku_relasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bukuID');
            $table->unsignedBigInteger('kategoriID');
            $table->timestamps();

            // Menambahkan foreign key untuk bukuID yang merujuk ke tabel buku
            $table->foreign('bukuID')->references('id')->on('bukus')->onDelete('cascade');

            // Menambahkan foreign key untuk kategoriID yang merujuk ke tabel kategori
            $table->foreign('kategoriID')->references('id')->on('kategoribuku')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategoribuku_relasi');
    }
}