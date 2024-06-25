<?php

namespace App\Http\Controllers;

use App\Models\DataRuangan;
use App\Models\Pengguna;
use Hash;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $penggunas = Pengguna::with('dataRuangan')->get();
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
    Pengguna::create([
      'nama' => $request->nama,
      'email' => $request->email,
      'role' => $request->role,
      'data_ruangan_id' => $request->data_ruangan,
      'password' => Hash::make($request->password),
      'foto_profil' => ''
    ]);
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
    return view('petugas.edit', compact('pengguna'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Pengguna $pengguna)
  {
    // $old_pengguna = Pengguna::whereId($pengguna->id)->first();
    $pengguna = Pengguna::whereId($pengguna->id)->update([
      'nama' => $request->nama,
      'email' => $request->email,
      'role' => $request->role,
      'data_ruangan_id' => $request->ruangan,
      'password' => Hash::make($request->password),
      'foto_profil' => ''
    ]);

    return redirect("/pengguna");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Pengguna $pengguna)
  {
    //
  }
}
