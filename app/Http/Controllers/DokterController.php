<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
    $daftar_dokter = Dokter::paginate(10);
    return view('dokter.index', compact('daftar_dokter'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('dokter.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    Dokter::create([
      'nama_dokter' => $request->nama_dokter
    ]);

    flash()->success('Data dokter berhasil ditambahkan');
    return redirect('/daftar-dokter');
  }

  /**
   * Display the specified resource.
   */
  public function show(Dokter $dokter)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    //
    $dokter = Dokter::whereId($id)->first();
    return view('dokter.edit', compact('dokter'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    //
    Dokter::whereId($id)->update([
      "nama_dokter" => $request->nama_dokter
    ]);

    flash()->success('Data dokter berhasil diperbarui');
    return redirect('/daftar-dokter');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    Dokter::whereId($id)->delete();

    flash()->success('Data dokter berhasil Dihapus');
    return redirect('/daftar-dokter');
  }
}
