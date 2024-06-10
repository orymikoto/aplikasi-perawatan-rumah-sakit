<?php

namespace App\Http\Controllers;

use App\Models\DataRuangan;
use App\Models\JenisPembayaran;
use App\Models\Pasien;
use App\Models\PasienDirawat;
use App\Models\Penyakit;
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
    $daftar_penyakit = Penyakit::pluck('nama_penyakit');
    $daftar_ruangan = DataRuangan::pluck('nama_ruangan');
    // dd($daftar_penyakit);
    return view('pasien.masuk.create', compact('daftar_penyakit', 'daftar_ruangan'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $new_pasien = Pasien::create([
      'no_RM' => $request->no_rm,
      'nama' => $request->nama_pasien,
      'jenis_kelamin' => $request->jenis_kelamin,
      'tanggal_daftar' => $request->tanggal_daftar,
      'alamat' => $request->alamat,
      'umur' => $request->umur
    ]);

    $check_data_ruangan = DataRuangan::whereNamaRuangan($request->ruangan)->first();
    $check_data_penyakit = Penyakit::whereNamaPenyakit($request->kode_penyakit)->first();
    $check_jenis_pembayaran = JenisPembayaran::whereNamaJenisPembayaran($request->jenis_pembayaran)->first();
    $pasien_dirawat = PasienDirawat::create([
      'pasien_id' => $new_pasien->id,
      'data_ruangan_id' => $check_data_ruangan->id,
      'jenis_pembayaran_id' => $check_jenis_pembayaran->id,
      'kode_penyakit' => $check_data_penyakit->kode_penyakit,
      'tanggal_masuk' => $request->tanggal_masuk,
    ]);

    return redirect('/pasiens');
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
    $pasien_dirawat = PasienDirawat::whereId($id)->first();
    $daftar_ruangan = DataRuangan::pluck('nama_ruangan');
    $daftar_penyakit = Penyakit::pluck('nama_penyakit');


    // dd($pasien_dirawat->tanggal_masuk);
    return view('pasien.masuk.edit', compact('daftar_penyakit', 'daftar_ruangan', 'pasien_dirawat'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    $old_pasien_dirawats = PasienDirawat::whereId($id)->first();
    $new_pasien = Pasien::whereId($old_pasien_dirawats->pasien_id)->update([
      'no_RM' => $request->no_rm,
      'nama' => $request->nama_pasien,
      'jenis_kelamin' => $request->jenis_kelamin,
      'tanggal_daftar' => $request->tanggal_daftar,
      'alamat' => $request->alamat,
      'umur' => $request->umur
    ]);

    $check_data_ruangan = DataRuangan::whereNamaRuangan($request->ruangan)->first();
    $check_data_penyakit = Penyakit::whereNamaPenyakit($request->kode_penyakit)->first();
    $check_jenis_pembayaran = JenisPembayaran::whereNamaJenisPembayaran($request->jenis_pembayaran)->first();
    $pasien_dirawat = PasienDirawat::whereId($id)->update([
      'data_ruangan_id' => $check_data_ruangan->id,
      'jenis_pembayaran_id' => $check_jenis_pembayaran->id,
      'kode_penyakit' => $check_data_penyakit->kode_penyakit,
      'tanggal_masuk' => $request->tanggal_masuk,
    ]);

    return redirect('/pasiens');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Pasien $pasien)
  {
    //
  }
}
