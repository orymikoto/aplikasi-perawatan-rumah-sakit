<?php

namespace App\Http\Controllers;

use App\Models\DataRuangan;
use App\Models\Pasien;
use App\Models\PasienDirawat;
use Illuminate\Http\Request;

class PasienController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $pasien_dirawats = PasienDirawat::with('pasien', 'penyakit', 'jenisPembayaran')->get();
    $daftar_ruangan = DataRuangan::pluck('nama_ruangan');

    return view('pasien.masuk.index', compact('pasien_dirawats', 'daftar_ruangan'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('pasien.masuk.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    Pasien::create([
      'no_RM' => $request->no_rm,
      'nama' => $request->nama,
      'jenis_kelamin' => $request->jenis_kelamin,
      'jumlah_tempat_tidur' => $request->jumlah_tempat_tidur,
      'kelas' => $request->kelas
    ]);
    return redirect('/pasien');
  }

  /**
   * Display the specified resource.
   */
  public function show(Pasien $pasien)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    return view('pasien.masuk.edit');
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Pasien $pasien)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Pasien $pasien)
  {
    //
  }
}
