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
        Schema::create('detail_pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('no_trx');
            $table->string('nama');
            $table->integer('id_user');
            $table->integer('id_supplier');
            $table->integer('id_barang');
            $table->integer('jumlah');
            $table->integer('harga');
            $table->integer('subtotal');
            $table->integer('diskon');
            $table->integer('status')->default(0);
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
