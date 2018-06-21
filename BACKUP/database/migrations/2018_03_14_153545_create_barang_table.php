<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tab_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('id_satuan')->nullable();
            $table->string('katalog')->nullable();
            $table->integer('id_kategori')->nullable();
            $table->integer('id_supplier')->nullable();
            $table->date('tgl_masuk')->nullable();
            $table->integer('id_merk')->nullable();
            $table->string('tipe')->nullable();
            $table->integer('id_principal')->nullable();
            $table->float('hrg_perolehan',12,2)->nullable();
            $table->float('hrg_jual',12,2)->nullable();
            $table->integer('status')->nullable();
            $table->string('komputer')->nullable();
            $table->string('user')->nullable();
            $table->date('tgl_entri')->nullable();
            $table->float('diskonv',12,2)->nullable();
            $table->integer('id_rs')->nullable();
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
        Schema::dropIfExists('tab_barang');
    }
}
