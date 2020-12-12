<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
          $table->id();
          $table->string('code',40);
          $table->date('tanggal');
          $table->integer('nilai');
          $table->integer('dompet_id')->unsigned()->index();
          $table->integer('kategori_id')->unsigned()->index();
          $table->integer('status_id');
          $table->timestamps();
        });

        Schema::table('transaksis', function($table) {
            $table->foreign('dompet_id')->references('id')->on('dompets');
            $table->foreign('kategori_id')->references('id')->on('kategoris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
