<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianDetailsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pembelian_details', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('pembelian_id');
      $table->foreign('pembelian_id')->references('id')->on('pembelians');
      $table->unsignedBigInteger('produk_id');
      $table->foreign('produk_id')->references('id')->on('produks');
      $table->integer('harga_beli');
      $table->integer('jumlah');
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
    Schema::dropIfExists('pembelian_details');
  }
}
