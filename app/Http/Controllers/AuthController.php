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

  public function lupa_password_view()
  {
    return view('auth.lupa-password');
  }

  public function lupa_password_post(Request $request)
  {
    $validate = $request->validate(['email' => 'exists:penggunas,email']);

    // if ($validate->fails()) {
    //   flash()->error('Pengguna dengan email tersebut tidak ada.');
    //   redirect('/lupa-password');
    // }

    $user = Pengguna::whereEmail($request->email)->update([
      'minta_reset_password' => true,
    ]);

    flash()->success('Permintaan reset password diajukan. Admin akan menghubungi anda segera setelah proses selesai.');
    return redirect('/login');
  }

  public function logout()
  {
    auth()->logout();

    flash()->success('Anda telah keluar dari sesi anda.');
    // return redirect('login');
    return redirect('login');
  }

  public function ganti_password()
  {
    return view('profile.ganti-password');
  }

  public function ganti_password_store(Request $request)
  {
    $user_id = auth()->user()->id;
    $user_old = Pengguna::whereId($user_id)->first();

    if (!Hash::check($request->password_lama, $user_old->password)) {
      flash()->error('Old password is not correct');
      return redirect('/ganti-password');
    }

    $request->validate([
      'password' => 'nullable|min:6|same:password_confirmation',
      'password_confirmation' => 'nullable|min:6'
    ]);


    $user = Pengguna::whereId($user_id)->update([
      "password" => Hash::make($request->password)
    ]);

    auth()->logout();

    flash()->success('password berhasil diganti silahkan login kembali');
    return redirect('/login');
  }
}
