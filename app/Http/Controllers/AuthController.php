<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
  public function login_view()
  {
    return view('auth.login');
  }

  public function login_post()
  {
  }
}
