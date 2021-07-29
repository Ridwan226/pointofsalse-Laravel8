<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pembelians', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('supplier_id');
      $table->foreign('supplier_id')->references('id')->on('suppliers');
      $table->integer('total_item');
      $table->integer('total_harga');
      $table->tinyInteger('diskon')->default(0);
      $table->integer('bayar')->default(0);
      $table->string('user_id', 36);
      $table->foreign('user_id')->references('id')->on('users');
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
    Schema::dropIfExists('pembelians');
  }
}
