<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanDetailsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('penjualan_details', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('penjualan_id');
      $table->foreign('penjualan_id')->references('id')->on('penjualans');
      $table->unsignedBigInteger('produk_id');
      $table->foreign('produk_id')->references('id')->on('produks');
      $table->integer('harga_jual');
      $table->integer('jumlah');
      $table->tinyInteger('diskon')->default(0);
      $table->integer('sub_total');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('penjualan_details');
  }
}
