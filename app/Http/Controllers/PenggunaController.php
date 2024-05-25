<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('petugas.index');
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
    return view('petugas.create');
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
  public function show(Pengguna $pengguna)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Pengguna $pengguna)
  {
    return view('petugas.edit');
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Pengguna $pengguna)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Pengguna $pengguna)
  {
    //
  }
}
