<?php

namespace App\Http\Controllers;

use App\Models\DataRuangan;
use Illuminate\Http\Request;

class DataRuanganController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $data_ruangans = DataRuangan::all();
    return view('ruangan.index', compact('data_ruangans'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('ruangan.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    DataRuangan::create([
      'nama_ruangan' => $request->nama_ruangan,
      'jumlah_tempat_tidur' => $request->jumlah_tempat_tidur,
      'kelas' => $request->kelas
    ]);
    return redirect('/ruangan');
  }

  /**
   * Display the specified resource.
   */
  public function show(DataRuangan $dataRuangan)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    $data_ruangan = DataRuangan::whereId($id)->first();
    return view('ruangan.edit', compact('data_ruangan'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, DataRuangan $dataRuangan)
  {
    DataRuangan::whereId($dataRuangan->id)->update([
      'nama_ruangan' => $request->nama_ruangan,
      'jumlah_tempat_tidur' => $request->jumlah_tempat_tidur,
      'kelas' => $request->kelas
    ]);

    return redirect('/ruangan');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    // dd($id);
    DataRuangan::whereId($id)->delete();

    flash()->success('Data ruangan berhasil dihapus');
    return redirect('/ruangan');
    //
  }
}
