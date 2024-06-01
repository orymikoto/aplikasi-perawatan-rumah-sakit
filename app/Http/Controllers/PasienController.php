<?php

namespace App\Http\Controllers;

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

    return view('pasien.masuk.index', compact('pasien_dirawats'));
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
    //
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
