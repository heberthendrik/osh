<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tab_customer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_rm')->nullable();
            $table->string('nama')->nullable();
            $table->string('sex')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('telepon')->nullable();
            $table->integer('status')->nullable();
            $table->float('diskon', 5, 2)->nullable();
            $table->float('ppn', 5, 2)->nullable();
            $table->float('jatuhtempo', 5, 2)->nullable();
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
        Schema::dropIfExists('tab_customer');
    }
}
