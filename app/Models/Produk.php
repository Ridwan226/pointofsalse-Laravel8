<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
  use HasFactory, SoftDeletes;
  protected $fillable = [
    'kategori_id',
    'nama_produk',
    'merk',
    'harga_beli',
    'harga_jual',
    'diskon',
    'stok',
    'kode_produk',
  ];
  public function kategori()
  {
    return $this->belongsTo('App\Models\Kategori');
  }
}
