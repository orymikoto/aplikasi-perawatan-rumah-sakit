<?php

namespace App\Http\Controllers;

use App\Models\DataRuangan;
use App\Models\Pengguna;
use App\Models\RuanganPerawat;
use Hash;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $penggunas = Pengguna::with('ruanganPerawat.dataRuangan')->get();
    // dd($penggunas[2]->ruanganPerawat);
    return view('petugas.index', compact('penggunas'));
  }

  public function login()
  {
    return view('auth.login');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $data_ruangan = DataRuangan::all();
    return view('petugas.create', compact('data_ruangan'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'email' => 'email|unique:penggunas,email',
      'password' => 'min:6|same:password_confirmation',
      'password_confirmation' => 'min:6'
    ]);

    // dd($request->data_ruangan);

    $new_user = Pengguna::create([
      'nama' => $request->nama,
      'email' => $request->email,
      'no_hp' => $request->no_hp,
      'role' => $request->role,
      'password' => Hash::make($request->password),
      'foto_profil' => ''
    ]);

    if ($request->data_ruangan) {
      foreach ($request->data_ruangan as $key => $value) {
        RuanganPerawat::create([
          'pengguna_id' => $new_user->id,
          'data_ruangan_id' => (int)$value
        ]);
      }
    }

    flash()->success('Data petugas berhasil ditambahkan');
    return redirect('/pengguna');
  }

  /**
   * Display the specified resource.
   */
  public function show(Pengguna $pengguna)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    $pengguna = Pengguna::whereId($id)->first();
    $data_ruangan = DataRuangan::all();
    $daftar_ruangan_perawat = RuanganPerawat::wherePenggunaId($id)->get();
    $ruangan_perawat = [];
    foreach ($daftar_ruangan_perawat as $key => $value) {
      array_push($ruangan_perawat, $value->data_ruangan_id);
    }

    // dd($ruangan_perawat);
    return view('petugas.edit', compact('pengguna', 'data_ruangan', 'ruangan_perawat'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Pengguna $pengguna)
  {
    // $old_pengguna = Pengguna::whereId($pengguna->id)->first();
    $request->validate([
      'email' => 'email|unique:penggunas,email,' . $pengguna->id,
      'password' => 'nullable|min:6|same:password_confirmation',
      'password_confirmation' => 'nullable|min:6'
    ]);

    Pengguna::whereId($pengguna->id)->update([
      'nama' => $request->nama,
      'email' => $request->email,
      'no_hp' => $request->no_hp,
      'role' => $request->role,
      'password' => Hash::make($request->password),
      'foto_profil' => ''
    ]);

    if ($request->data_ruangan) {
      RuanganPerawat::wherePenggunaId($pengguna->id)->delete();
      foreach ($request->data_ruangan as $key => $value) {
        RuanganPerawat::create([
          'pengguna_id' => $pengguna->id,
          'data_ruangan_id' => (int)$value
        ]);
      }
    }


    flash()->success('Data petugas berhasil diperbarui');
    return redirect("/pengguna");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $pengguna = Pengguna::whereId($id)->delete();

    flash()->success('Data petugas telah berhasil dihapus');
    return redirect("/pengguna");
  }
}
