<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;

class AuthController extends Controller
{
  public function login_view()
  {
    return view('auth.login');
  }

  public function login_post(Request $request)
  {
    $login_try = Pengguna::whereEmail($request->email)->first();
    // dd($login_try);
    if (!$login_try) {
      # code...
      flash()->error('Email atau Password salah');
      return redirect('login')->with('failed', 'Email atau password salah.');
    }

    $check = Hash::check($request->password, $login_try->password);
    if (!$check) {
      # code...
      flash()->error('Email atau Password salah');
      return redirect('login')->with('failed', 'Email atau password salah.');
    }

    Auth::login($login_try);

    return redirect('/');
  }

  public function logout()
  {
    auth()->logout();

    flash()->success('Anda telah keluar dari sesi anda.');
    return redirect('login');
  }
}
