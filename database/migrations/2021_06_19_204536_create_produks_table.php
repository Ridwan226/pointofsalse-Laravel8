<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('produks', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('kategori_id');
      $table->foreign('kategori_id')->references('id')->on('kategoris');
      $table->string('nama_produk')->unique();
      $table->string('kode_produk')->unique();
      $table->string('merk')->nullable();
      $table->integer('harga_beli');
      $table->tinyInteger('diskon')->delfault(0);
      $table->integer('harga_jual');
      $table->integer('stok');
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
    Schema::dropIfExists('produks');
  }
}
