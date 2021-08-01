<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index(Request $request)
  {
    $dataproduk = Produk::query();
    if ($request->ajax()) {
      return datatables()->of($dataproduk)
        ->addColumn('kategori', function (Produk $model) {
          return $model->kategori->nama_kategory;
        })
        ->addColumn('aksi', function ($data) {
          $button = '<button class="btn btn-primary waves-effect waves-light btn-sm edit" id="' . $data->id . '" data-toggle="tooltip" data-placement="right" title="Edit Data Yang Anda Pilih"><i class="fas fa-edit"></i></button>';
          $button .= '<button class="btn btn-sm btn-danger ml-1 hapus" id="' . $data->id . '" name="hapus"><i class="fas fa-trash"></i></button>';
          return $button;
        })
        ->addColumn('select_all', function ($data) {
          return '<input type="checkbox" name="id_product[]" value="' . $data->id . '" id="id_product" />';
        })->rawColumns(['aksi', 'select_all'])
        ->make(true);
    }


    $kategorys = Kategori::all();
    return view('admin.product.list')->with(compact('kategorys'));
  }


  public function addProduct(Request $request)
  {
    $rules = [
      'kategori_id' => 'required|integer',
      'nama_produk' => 'required|string|min:3|unique:produks',
      'merk' => 'required|string|min:3',
      'harga_beli' => 'required|integer',
      'diskon' => 'required|integer',
      'harga_jual' => 'required|integer',
      'stok' => 'required|integer',
    ];

    $validasi = Validator::make($request->all(), $rules);

    if ($validasi->fails()) {
      return response()->json(['status' => 'Data Gagal Di simpan', 'message' => $validasi->errors()->first()], 422);
    }

    $product = Produk::latest()->first();

    $kodeProduk = 'P' . tambah_nol_didepan((int)$product->id + 1, 5);

    $data = [
      'kategori_id' => $request->kategori_id,
      'nama_produk' => $request->nama_produk,
      'merk' => $request->merk,
      'harga_beli' => $request->harga_beli,
      'diskon' => $request->diskon,
      'harga_jual' => $request->harga_jual,
      'stok' => $request->stok,
      'kode_produk' => $kodeProduk,
    ];

    Produk::create($data);

    return response()->json(['message' => 'Data Berhasil Di simpan'], 200);
  }

  public function editData(Request $request)
  {
    $data = Produk::find($request->id);

    if (!$data) {
      return response()->json(['message' => 'Data Tidak Tersedia'], 404);
    }

    return response()->json($data);
  }

  public function updateData(Request $request)
  {
    $rules = [
      'kategori_id' => 'required|integer',
      'nama_produk' => 'required|string|min:3',
      'merk' => 'required|string|min:3',
      'harga_beli' => 'required|integer',
      'diskon' => 'required|integer',
      'harga_jual' => 'required|integer',
      'stok' => 'required|integer',
      'id_edit' => 'required|integer',
    ];

    $validasi = Validator::make($request->all(), $rules);

    if ($validasi->fails()) {
      return response()->json(['status' => 'Data Gagal Di simpan', 'message' => $validasi->errors()->first()], 422);
    }


    Produk::where(['id' => $request->id_edit])->update([
      'kategori_id' => $request->kategori_id,
      'nama_produk' => $request->nama_produk,
      'merk' => $request->merk,
      'harga_beli' => $request->harga_beli,
      'diskon' => $request->diskon,
      'harga_jual' => $request->harga_jual,
      'stok' => $request->stok,
    ]);

    return response()->json(['message' => 'Data Berhasil Di Ubah'], 200);
  }

  public function delData(Request $request)
  {
    $data = Produk::find($request->id);

    if (!$data) {
      return response()->json(['message' => 'Data Tidak Tersedia'], 404);
    }

    $data->delete();
    return response()->json(['message' => 'Data Berhasil Di Hapus'], 200);
  }

  public function delDataSelected(Request $request)
  {
    foreach ($request->id_product as $id) {
      $data = Produk::find($id);
      $data->delete();
    }
    return response()->json(['message' => 'Data Berhasil Di Hapus'], 200);
  }
}
