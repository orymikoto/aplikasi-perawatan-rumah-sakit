<?php

namespace App\Http\Controllers;

use App\Models\DataRuangan;
use App\Models\JenisPembayaran;
use App\Models\LaporanPenyakitPasien;
use App\Models\Pasien;
use App\Models\PasienDirawat;
use App\Models\PasienPindah;
use App\Models\Penyakit;
use App\Models\RekapitulasiSHRI;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PasienController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $daftar_ruangan = DataRuangan::pluck('nama_ruangan');
    if (auth()->user()->role == "PERAWAT" && auth()->user()->data_ruangan_id) {
      $pasien_dirawats = PasienDirawat::whereDataRuanganId(auth()->user()->data_ruangan_id)->whereTanggalKeluar(null)->with('pasien', 'penyakit', 'jenisPembayaran')->orderBy('tanggal_masuk', 'desc')->paginate(10);

      return view('pasien.masuk.index', compact('pasien_dirawats', 'daftar_ruangan'));
    } else {
      $pasien_dirawats = PasienDirawat::whereTanggalKeluar(null)->with('pasien', 'penyakit', 'jenisPembayaran')->orderBy('tanggal_masuk', 'desc')->paginate(10);

      return view('pasien.masuk.index', compact('pasien_dirawats', 'daftar_ruangan'));
    }
  }

  public function daftar_pindah()
  {
    if (auth()->user()->role == "PERAWAT" && auth()->user()->data_ruangan_id) {
      $pasien_pindah = PasienPindah::whereDisetujui(true)->where(function ($q) {
        $q->where('ruangan_lama_id', auth()->user()->data_ruangan_id)->orWhere('ruangan_baru_id', auth()->user()->data_ruangan_id);
      })->with(['pasienDirawat', 'ruanganLama', 'ruanganBaru'])->orderBy('tanggal_pindah', 'desc')->paginate(10);

      return view('pasien.pindah.index', compact('pasien_pindah'));
    } else {
      $pasien_pindah = PasienPindah::whereDisetujui(true)->with(['pasienDirawat', 'ruanganLama', 'ruanganBaru'])->orderBy('tanggal_pindah', 'desc')->paginate(10);

      return view('pasien.pindah.index', compact('pasien_pindah'));
    }
  }

  public function daftar_pasien_diminta_pindah()
  {
    if (auth()->user()->role == "PERAWAT" && auth()->user()->data_ruangan_id) {
      $daftar_pasien_pindah = PasienPindah::whereDisetujui(false)->whereRuanganBaruId(auth()->user()->data_ruangan_id)->orderBy('tanggal_pindah', 'desc')->paginate(10);

      return view('pasien.pindah.diminta-pindah', compact('daftar_pasien_pindah'));
    } else {
      $daftar_pasien_pindah = PasienPindah::whereDisetujui(false)->orderBy('tanggal_pindah', 'desc')->paginate(10);

      return view('pasien.pindah.diminta-pindah', compact('daftar_pasien_pindah'));
    }
  }

  public function setujui_pindah($pasien_pindah_id)
  {
    $old_pasien_pindah = PasienPindah::whereId($pasien_pindah_id)->first();

    PasienPindah::whereId($pasien_pindah_id)->update(['disetujui' => true]);
    PasienDirawat::whereId($old_pasien_pindah->pasien_dirawat_id)->update(['data_ruangan_id' => $old_pasien_pindah->ruangan_baru_id, 'pasien_pindahan' => true]);

    // rekapitulasi shri ruangan lama
    RekapitulasiSHRI::whereDate('tanggal', Carbon::today())->whereDataRuanganId($old_pasien_pindah->ruangan_lama_id)->incrementEach(['pasien_dipindahkan' => 1, 'jumlah_pasien_keluar' => 1])->decrement('pasien_sisa', 1);

    // rekapitulasi shri ruangan baru
    RekapitulasiSHRI::whereDate('tanggal', Carbon::today())->whereDataRuanganId($old_pasien_pindah->ruangan_baru_id)->incrementEach(['pindahan' => 1, 'jumlah_pasien_masuk' => 1, 'pasien_sisa' => 1]);

    flash()->success('Permintaan pasien pindah ruangan telah disetujui');
    return redirect('/pasien-pindah');
  }

  public function tolak_pindah($pasien_pindah_id)
  {
    PasienPindah::whereId($pasien_pindah_id)->delete();


    flash()->success('Permintaan pasien pindah ruangan telah ditolak');
    return redirect('/pasien-pindah');
  }

  public function pasien_pindah(Request $request, $id)
  {
    $pasien_dirawat = PasienDirawat::whereId($id)->first();

    $ruangan_baru = DataRuangan::whereNamaRuangan($request->ruangan)->first();

    $add_pasien_pindah = PasienPindah::create([
      'pasien_dirawat_id' => $id,
      'ruangan_lama_id' => $pasien_dirawat->data_ruangan_id,
      'ruangan_baru_id' => $ruangan_baru->id,
      'tanggal_pindah' => Carbon::now()
    ]);

    flash()->success('Permintaan pasien pindah ruangan telah ditambahkan, silahkan hubungi petugas untuk menyetujui!');
    return redirect('/pasien-pindah');
  }

  public function daftar_keluar()
  {
    if (auth()->user()->role == "PERAWAT" && auth()->user()->data_ruangan_id) {
      # code...
      $pasien_keluar = PasienDirawat::whereDataRuanganId(auth()->user()->data_ruangan_id)->orderBy('tanggal_masuk', 'desc')->paginate(10);

      return view('pasien.keluar.index', compact('pasien_keluar'));
    } else {
      $pasien_keluar = PasienDirawat::orderBy('tanggal_masuk', 'desc')->paginate(10);

      return view('pasien.keluar.index', compact('pasien_keluar'));
    }
  }

  public function pasien_keluar(Request $request, $id)
  {
    $pasien_dirawat = PasienDirawat::whereId($id)->first();
    $pasien_pindah = PasienDirawat::whereId($id)->update([
      'tanggal_keluar' => Carbon::now(),
      'keadaan_keluar' => $request->kondisi,
      'rumah_sakit_baru' => $request->rumah_sakit ?? null
    ]);

    if ($request->kondisi == "Mati < 48 Jam") {
      RekapitulasiSHRI::whereDate('tanggal', Carbon::today())->whereDataRuanganId($pasien_dirawat->data_ruangan_id)->incrementEach(['pasien_mati_belum_48_jam' => 1, 'jumlah_pasien_keluar' => 1])->decrement('pasien_sisa', 1);
    } else if ($request->kondisi == "Mati > 48 Jam") {
      RekapitulasiSHRI::whereDate('tanggal', Carbon::today())->whereDataRuanganId($pasien_dirawat->data_ruangan_id)->incrementEach(['pasien_mati_sudah_48_jam' => 1, 'jumlah_pasien_keluar' => 1])->decrement('pasien_sisa', 1);
    } else {
      RekapitulasiSHRI::whereDate('tanggal', Carbon::today())->whereDataRuanganId($pasien_dirawat->data_ruangan_id)->incrementEach(['jumlah_pasien_keluar' => 1, 'jumlah_pasien_keluar' => 1])->decrement('pasien_sisa', 1);
    }

    flash()->success('Data pasien keluar telah berhasil ditambahkan');

    return redirect('/pasiens');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $daftar_penyakit = Penyakit::pluck('nama_penyakit');
    $daftar_ruangan = DataRuangan::pluck('nama_ruangan');
    $daftar_penyakit = Penyakit::all();
    // dd($daftar_penyakit);
    return view('pasien.masuk.create', compact('daftar_penyakit', 'daftar_ruangan', 'daftar_penyakit'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function cek_rm($no_rm)
  {
    $check_pasien = Pasien::where('no_rm', $no_rm)->first();

    if ($check_pasien) {
      return response()->json([
        'id' => $check_pasien->id,
        'nama' => $check_pasien->nama,
        'jenis_kelamin' => $check_pasien->jenis_kelamin,
        'tanggal_daftar' => $check_pasien->tanggal_daftar,
        'alamat' => $check_pasien->alamat,
        'umur' => $check_pasien->umur,
      ]);
    } else {
      return response()->json([
        'error' => 'data pasien tidak ditemukan'
      ]);
    }
  }

  public function cek_kode_penyakit($kode_penyakit)
  {
    $check_penyakit = Penyakit::where('kode_penyakit', 'LIKE', '%' . $kode_penyakit . '%')->get();

    return response()->json([
      'data' => $check_penyakit
    ]);
  }

  public function store(Request $request)
  {
    $check_pasien = Pasien::where('no_rm', $request->no_rm)->first();

    $check_data_ruangan = DataRuangan::whereNamaRuangan($request->ruangan)->first();
    $check_data_penyakit = Penyakit::whereKodePenyakit($request->kode_penyakit)->first();
    $check_jenis_pembayaran = JenisPembayaran::whereNamaJenisPembayaran($request->jenis_pembayaran)->first();

    if (!$check_pasien) {
      $new_pasien = Pasien::create([
        'no_RM' => $request->no_rm,
        'nama' => $request->nama_pasien,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tanggal_daftar' => $request->tanggal_daftar,
        'alamat' => $request->alamat,
        'umur' => $request->umur
      ]);

      $pasien_dirawat = PasienDirawat::create([
        'pasien_id' => $new_pasien->id,
        'data_ruangan_id' => $check_data_ruangan->id,
        'jenis_pembayaran_id' => $check_jenis_pembayaran->id,
        'kode_penyakit' => $check_data_penyakit->kode_penyakit,
        'jenis_penyakit' => $request->jenis_penyakit,
        'tanggal_masuk' => $request->tanggal_masuk,
      ]);
    } else {
      $pasien_dirawat = PasienDirawat::create([
        'pasien_id' => $check_pasien->id,
        'data_ruangan_id' => $check_data_ruangan->id,
        'jenis_pembayaran_id' => $check_jenis_pembayaran->id,
        'kode_penyakit' => $check_data_penyakit->kode_penyakit,
        'jenis_penyakit' => $request->jenis_penyakit,
        'tanggal_masuk' => $request->tanggal_masuk,
      ]);
    }





    // $check_column_pembayaran

    $check_laporan_penyakit = LaporanPenyakitPasien::whereBetween('created_at', [
      Carbon::now()->startOfMonth(),
      Carbon::now()->endOfMonth()
    ])->whereKodePenyakit(strtoupper($request->kode_penyakit))->first();

    if ($check_laporan_penyakit) {
      // dd($check_laporan_penyakit);
      $check_laporan_penyakit->increment(
        $check_jenis_pembayaran->kategori_pasien,
        1
      );
      LaporanPenyakitPasien::whereBetween('created_at', [
        Carbon::now()->startOfMonth(),
        Carbon::now()->endOfMonth()
      ])->whereKodePenyakit($check_data_penyakit->kode_penyakit)->increment('jumlah_pasien', 1);
    } else {
      LaporanPenyakitPasien::create([
        'kode_penyakit' => $check_data_penyakit->kode_penyakit,
        'jenis_penyakit' =>  $check_data_penyakit->nama_penyakit,
        'tni_ad_mil' => 0,
        'tni_ad_kel' => 0,
        'tni_ad_pns' => 0,
        'tni_al_pns' => 0,
        'tni_al_kel' => 0,
        'tni_al_mil' => 0,
        'bpjs' => 0,
        'pasien_umum' => 0,
        'jumlah_pasien' => 0,
      ]);

      LaporanPenyakitPasien::whereKodePenyakit(strtoupper($request->kode_penyakit))->increment(
        $check_jenis_pembayaran->kategori_pasien,
        1
      );
    }

    RekapitulasiSHRI::whereDate('tanggal', Carbon::today())->whereDataRuanganId($check_data_ruangan->id)->incrementEach(['pasien_baru' => 1, 'jumlah_pasien_masuk' => 1, 'pasien_sisa' => 1]);

    return redirect('/pasiens');
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
    $pasien_dirawat = PasienDirawat::whereId($id)->first();
    $daftar_ruangan = DataRuangan::pluck('nama_ruangan');
    $daftar_penyakit = Penyakit::pluck('nama_penyakit');


    // dd($pasien_dirawat->tanggal_masuk);
    return view('pasien.masuk.edit', compact('daftar_penyakit', 'daftar_ruangan', 'pasien_dirawat'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    $old_pasien_dirawats = PasienDirawat::whereId($id)->first();
    $new_pasien = Pasien::whereId($old_pasien_dirawats->pasien_id)->update([
      'no_RM' => $request->no_rm,
      'nama' => $request->nama_pasien,
      'jenis_kelamin' => $request->jenis_kelamin,
      'tanggal_daftar' => $request->tanggal_daftar,
      'alamat' => $request->alamat,
      'umur' => $request->umur
    ]);

    $check_data_ruangan = DataRuangan::whereNamaRuangan($request->ruangan)->first();
    $check_jenis_pembayaran = JenisPembayaran::whereNamaJenisPembayaran($request->jenis_pembayaran)->first();
    $pasien_dirawat = PasienDirawat::whereId($id)->update([
      'data_ruangan_id' => $check_data_ruangan->id,
      'jenis_pembayaran_id' => $check_jenis_pembayaran->id,
      'kode_penyakit' => strtoupper($request->kode_penyakit),
      'jenis_penyakit' => $request->jenis_penyakit,
      'tanggal_masuk' => $request->tanggal_masuk,
    ]);

    $check_laporan_penyakit = LaporanPenyakitPasien::whereBetween('created_at', [
      Carbon::now()->startOfMonth(),
      Carbon::now()->endOfMonth()
    ])->whereKodePenyakit(strtoupper($request->kode_penyakit))->first();

    if ($check_laporan_penyakit) {
      // dd($check_laporan_penyakit);
      $old_jenis_pembayaran = JenisPembayaran::whereId($old_pasien_dirawats->jenis_pembayaran_id)->first();
      $check_laporan_penyakit->decrement(
        $old_jenis_pembayaran->kategori_pasien,
        1
      );
      LaporanPenyakitPasien::whereBetween('created_at', [
        Carbon::now()->startOfMonth(),
        Carbon::now()->endOfMonth()
      ])->whereKodePenyakit(strtoupper($request->kode_penyakit))->increment($check_jenis_pembayaran->kategori_pasien, 1);
    }

    RekapitulasiSHRI::whereDate('tanggal', $old_pasien_dirawats->tanggal_masuk)->whereDataRuanganId($old_pasien_dirawats->data_ruangan_id)->decrementEach(['pasien_baru' => 1, 'jumlah_pasien_masuk' => 1, 'pasien_sisa' => 1]);
    RekapitulasiSHRI::whereDate('tanggal', Carbon::today())->whereDataRuanganId($check_data_ruangan->id)->incrementEach(['pasien_baru' => 1, 'jumlah_pasien_masuk' => 1, 'pasien_sisa' => 1]);

    return redirect('/pasiens');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Pasien $pasien)
  {
    //
  }
}
