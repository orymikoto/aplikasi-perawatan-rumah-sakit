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
    //
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
    return view('ruangan.edit');
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, DataRuangan $dataRuangan)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(DataRuangan $dataRuangan)
  {
    //
  }
}
