<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
  public function index(Request $request)
  {
    $kategori = Kategori::query();
    if ($request->ajax()) {
      return datatables()->of($kategori)
        ->addColumn('aksi', function ($data) {
          $button = '<button class="btn btn-primary waves-effect waves-light btn-sm edit" id="' . $data->id . '" data-toggle="tooltip" data-placement="right" title="Edit Data Yang Anda Pilih"><i class="fas fa-edit"></i></button>';
          $button .= '<button class="btn btn-sm btn-danger ml-1 hapus" id="' . $data->id . '" name="hapus"><i class="fas fa-trash"></i></button>';
          return $button;
        })->rawColumns(['aksi'])
        ->make(true);
    }

    return view('admin.kategori.list');
  }

  public function addData(Request $request)
  {
    $rules = [
      'nama_kategory' => 'required|unique:kategoris',
    ];

    $validasi = Validator::make($request->all(), $rules);

    if ($validasi->fails()) {
      return response()->json(['status' => 'Data Gagal Di simpan', 'message' => $validasi->errors()->first()], 422);
    }
    Kategori::create(['nama_kategory' => $request->nama_kategory]);

    return response()->json(['message' => 'Data Berhasil Di simpan'], 200);
  }

  public function editData(Request $request)
  {
    $data = Kategori::find($request->id);

    if (!$data) {
      return response()->json(['message' => 'Data Tidak Tersedia'], 404);
    }

    return response()->json($data);
  }


  public function updateData(Request $request)
  {
    $rules = [
      'nama_kategory' => 'required|unique:kategoris',
    ];

    $validasi = Validator::make($request->all(), $rules);

    if ($validasi->fails()) {
      return response()->json(['status' => 'Data Gagal Di simpan', 'message' => $validasi->errors()->first()], 422);
    }

    Kategori::where(['id' => $request->id_edit])->update([
      'nama_kategory' => $request->nama_kategory,
    ]);

    return response()->json(['message' => 'Data Berhasil Di Ubah'], 200);
  }


  public function delData(Request $request)
  {
    $data = Kategori::find($request->id);

    if (!$data) {
      return response()->json(['message' => 'Data Tidak Tersedia'], 404);
    }

    $data->delete();
    return response()->json(['message' => 'Data Berhasil Di Hapus'], 200);
  }
}
