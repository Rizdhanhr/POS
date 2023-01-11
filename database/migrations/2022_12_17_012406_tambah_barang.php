<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama');
            $table->integer('id_supplier');
            $table->integer('id_kategori');
            $table->integer('id_satuan');
            $table->integer('stok');
            $table->integer('stok_minimal');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->string('spesifikasi');
            $table->longText('gambar')->nullable();
            $table->string('lokasi')->nullable();
            $table->date('exp')->nullable();
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
