<?php

namespace App\Http\Controllers;

use App\Imports\ImportPasien;
use App\Imports\ImportPasienDirawat;
use App\Models\DataRuangan;
use App\Models\JenisPembayaran;
use App\Models\LaporanPenyakitPasien;
use App\Models\Pasien;
use App\Models\PasienDirawat;
use App\Models\PasienPindah;
use App\Models\Penyakit;
use App\Models\RekapitulasiSHRI;
use App\Models\RuanganPerawat;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Faker\Factory as FakerFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

use function PHPUnit\Framework\isEmpty;

class PasienController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $filter = $request->query('filter');
    // dd($filter);
    $daftar_ruangan = DataRuangan::pluck('nama_ruangan');



    if (auth()->user()->role == "PERAWAT") {
      $ruangan_perawat = RuanganPerawat::wherePenggunaId(auth()->user()->id)->pluck('data_ruangan_id')->toArray();
      // dd($ruangan_perawat);
      if ($filter) {
        $pasien_dirawats = PasienDirawat::whereRelation('pasien', 'no_RM', 'like', '%' . $filter . '%')->whereDataRuanganId(auth()->user()->data_ruangan_id)->whereTanggalKeluar(null)->with('pasien', 'penyakit', 'jenisPembayaran')->orderBy('tanggal_masuk', 'desc')->paginate(10);
      } else {
        $pasien_dirawats = PasienDirawat::whereIn('data_ruangan_id', $ruangan_perawat)->whereTanggalKeluar(null)->with('pasien', 'penyakit', 'jenisPembayaran')->orderBy('tanggal_masuk', 'desc')->paginate(10);
      }
      return view('pasien.masuk.index')->with(['pasien_dirawats' => $pasien_dirawats, 'daftar_ruangan' => $daftar_ruangan, 'filter' => $filter]);
    } else {
      if ($filter) {
        // dd($filter);
        $pasien_dirawats = PasienDirawat::whereRelation('pasien', 'no_RM', 'like', '%' . $filter . '%')->whereTanggalKeluar(null)->with('pasien', 'penyakit', 'jenisPembayaran')->orderBy('tanggal_masuk', 'desc')->paginate(10);
      } else {
        $pasien_dirawats = PasienDirawat::whereTanggalKeluar(null)->with('pasien', 'penyakit', 'jenisPembayaran')->orderBy('tanggal_masuk', 'desc')->paginate(10);
      }

      return view('pasien.masuk.index')->with(['pasien_dirawats' => $pasien_dirawats, 'daftar_ruangan' => $daftar_ruangan, 'filter' => $filter]);
    }
  }

  public function daftar_pasien(Request $request)
  {
    $filter = $request->query('filter');

    if ($filter) {

      $daftar_pasien = Pasien::where('no_RM', 'like', '%' . $filter . '%')->paginate(20);
    } else {
      $daftar_pasien = Pasien::paginate(20);
    }
    return view('pasien.daftar-pasien', compact('daftar_pasien', 'filter'));
  }

  public function tambah_pasien()
  {
    return view('pasien.create');
  }

  public function edit_pasien()
  {
    return view('pasien.edit');
  }

  public function daftar_pindah()
  {
    if (auth()->user()->role == "PERAWAT") {
      $ruangan_perawat = RuanganPerawat::wherePenggunaId(auth()->user()->id)->pluck('data_ruangan_id')->toArray();
      $pasien_pindah = PasienPindah::whereDisetujui(true)->where(function ($q) use ($ruangan_perawat) {
        $q->whereIn('ruangan_lama_id', $ruangan_perawat)->orWhereIn('ruangan_baru_id', $ruangan_perawat);
      })->with(['pasienDirawat', 'ruanganLama', 'ruanganBaru'])->orderBy('tanggal_pindah', 'desc')->paginate(10);

      return view('pasien.pindah.index', compact('pasien_pindah'));
    } else {
      $pasien_pindah = PasienPindah::whereDisetujui(true)->with(['pasienDirawat', 'ruanganLama', 'ruanganBaru'])->orderBy('tanggal_pindah', 'desc')->paginate(10);

      return view('pasien.pindah.index', compact('pasien_pindah'));
    }
  }

  public function daftar_pasien_diminta_pindah()
  {
    if (auth()->user()->role == "PERAWAT") {
      $ruangan_perawat = RuanganPerawat::wherePenggunaId(auth()->user()->id)->pluck('data_ruangan_id')->toArray();
      $daftar_pasien_pindah = PasienPindah::whereDisetujui(false)->whereIn('ruangan_baru_id', $ruangan_perawat)->orderBy('tanggal_pindah', 'desc')->paginate(10);

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

    $check_laporan_shri_ruangan_baru = RekapitulasiSHRI::whereDate('tanggal', Carbon::today())->whereDataRuanganId($old_pasien_pindah->ruangan_baru_id);
    if (!$check_laporan_shri_ruangan_baru) {
      $day_before = RekapitulasiSHRI::whereDataRuanganId($old_pasien_pindah->ruangan_baru_id)->whereDate('created_at', Carbon::today())->first();

      // Kalau ada
      if ($day_before) {
        # code...
        $new_row = RekapitulasiSHRI::create([
          'tanggal' => Carbon::today(),
          'data_ruangan_id' => $day_before->data_ruangan_id,
          'pasien_awal' => $day_before->pasien_sisa,
          'pasien_baru' => 0,
          'pindahan' => 0,
          'jumlah_pasien_masuk' => 0,
          'pasien_keluar_hidup' => 0,
          'pasien_dipindahkan' => 0,
          'pasien_mati_belum_48_jam' => 0,
          'pasien_mati_sudah_48_jam' => 0,
          'jumlah_pasien_keluar' => 0,
          'pasien_sisa' => $day_before->pasien_sisa,
        ]);
        // Kalau tidak ada
      } else {
        $new_row = RekapitulasiSHRI::create([
          'tanggal' =>  Carbon::today(),
          'data_ruangan_id' => $old_pasien_pindah->ruangan_baru_id,
          'pasien_awal' => 0,
          'pasien_baru' => 0,
          'pindahan' => 0,
          'jumlah_pasien_masuk' => 0,
          'pasien_keluar_hidup' => 0,
          'pasien_dipindahkan' => 0,
          'pasien_mati_belum_48_jam' => 0,
          'pasien_mati_sudah_48_jam' => 0,
          'jumlah_pasien_keluar' => 0,
          'pasien_sisa' => 0,
        ]);
      }
    }

    $check_laporan_shri_ruangan_lama = RekapitulasiSHRI::whereDate('tanggal', Carbon::today())->whereDataRuanganId($old_pasien_pindah->ruangan_lama_id);
    if (!$check_laporan_shri_ruangan_lama) {
      $day_before = RekapitulasiSHRI::whereDataRuanganId($old_pasien_pindah->ruangan_lama_id)->whereDate('created_at', Carbon::today())->first();

      // Kalau ada
      if ($day_before) {
        # code...
        $new_row = RekapitulasiSHRI::create([
          'tanggal' => Carbon::today(),
          'data_ruangan_id' => $day_before->data_ruangan_id,
          'pasien_awal' => $day_before->pasien_sisa,
          'pasien_baru' => 0,
          'pindahan' => 0,
          'jumlah_pasien_masuk' => 0,
          'pasien_keluar_hidup' => 0,
          'pasien_dipindahkan' => 0,
          'pasien_mati_belum_48_jam' => 0,
          'pasien_mati_sudah_48_jam' => 0,
          'jumlah_pasien_keluar' => 0,
          'pasien_sisa' => $day_before->pasien_sisa,
        ]);
        // Kalau tidak ada
      } else {
        $new_row = RekapitulasiSHRI::create([
          'tanggal' =>  Carbon::today(),
          'data_ruangan_id' => $old_pasien_pindah->ruangan_lama_id,
          'pasien_awal' => 0,
          'pasien_baru' => 0,
          'pindahan' => 0,
          'jumlah_pasien_masuk' => 0,
          'pasien_keluar_hidup' => 0,
          'pasien_dipindahkan' => 0,
          'pasien_mati_belum_48_jam' => 0,
          'pasien_mati_sudah_48_jam' => 0,
          'jumlah_pasien_keluar' => 0,
          'pasien_sisa' => 0,
        ]);
      }
    }

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
    if (auth()->user()->role == "PERAWAT") {
      $ruangan_perawat = RuanganPerawat::wherePenggunaId(auth()->user()->id)->pluck('data_ruangan_id')->toArray();
      $pasien_keluar = PasienDirawat::whereIn('data_ruangan_id', $ruangan_perawat)->whereNotNull("tanggal_keluar")->orderBy('tanggal_keluar', 'desc')->paginate(10);

      return view('pasien.keluar.index', compact('pasien_keluar'));
    } else {
      $pasien_keluar = PasienDirawat::whereNotNull("tanggal_keluar")->orderBy('tanggal_keluar', 'desc')->paginate(10);

      return view('pasien.keluar.index', compact('pasien_keluar'));
    }
  }

  public function pasien_keluar(Request $request, $id)
  {
    $pasien_dirawat = PasienDirawat::whereId($id)->first();
    PasienDirawat::whereId($id)->update([
      'tanggal_keluar' => Carbon::today(),
      'keadaan_keluar' => $request->kondisi,
      'rumah_sakit_baru' => $request->rumah_sakit ?? null,
      'jam_dirujuk' => $request->jam_rujuk ?? null
    ]);

    $check_laporan_shri = RekapitulasiSHRI::whereDate('tanggal', Carbon::today())->whereDataRuanganId($pasien_dirawat->data_ruangan_id)->first();
    // dd($check_laporan_shri);
    if (!$check_laporan_shri) {
      $day_before = RekapitulasiSHRI::whereDataRuanganId($pasien_dirawat->data_ruangan_id)->whereDate('created_at', Carbon::today()->subDay())->first();

      // Kalau ada
      if ($day_before) {
        # code...
        $new_row = RekapitulasiSHRI::create([
          'tanggal' => Carbon::today(),
          'data_ruangan_id' => $day_before->data_ruangan_id,
          'pasien_awal' => $day_before->pasien_sisa,
          'pasien_baru' => 0,
          'pindahan' => 0,
          'jumlah_pasien_masuk' => 0,
          'pasien_keluar_hidup' => 0,
          'pasien_dipindahkan' => 0,
          'pasien_mati_belum_48_jam' => 0,
          'pasien_mati_sudah_48_jam' => 0,
          'jumlah_pasien_keluar' => 0,
          'pasien_sisa' => $day_before->pasien_sisa,
        ]);
        // Kalau tidak ada
      } else {
        $new_row = RekapitulasiSHRI::create([
          'tanggal' =>  Carbon::today(),
          'data_ruangan_id' => $pasien_dirawat->data_ruangan_id,
          'pasien_awal' => 0,
          'pasien_baru' => 0,
          'pindahan' => 0,
          'jumlah_pasien_masuk' => 0,
          'pasien_keluar_hidup' => 0,
          'pasien_dipindahkan' => 0,
          'pasien_mati_belum_48_jam' => 0,
          'pasien_mati_sudah_48_jam' => 0,
          'jumlah_pasien_keluar' => 0,
          'pasien_sisa' => 0,
        ]);
      }
    }

    if ($request->kondisi == "Mati < 48 Jam") {
      RekapitulasiSHRI::whereDate('tanggal', Carbon::today())->whereDataRuanganId($pasien_dirawat->data_ruangan_id)->incrementEach(['pasien_mati_belum_48_jam' => 1, 'jumlah_pasien_keluar' => 1])->decrement('pasien_sisa', 1);
    } else if ($request->kondisi == "Mati > 48 Jam") {
      RekapitulasiSHRI::whereDate('tanggal', Carbon::today())->whereDataRuanganId($pasien_dirawat->data_ruangan_id)->incrementEach(['pasien_mati_sudah_48_jam' => 1, 'jumlah_pasien_keluar' => 1])->decrement('pasien_sisa', 1);
    } else {
      RekapitulasiSHRI::whereDate('tanggal', Carbon::today())->whereDataRuanganId($pasien_dirawat->data_ruangan_id)->incrementEach(['pasien_keluar_hidup' => 1, 'jumlah_pasien_keluar' => 1])->decrement('pasien_sisa', 1);
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

  public function import_pasien(Request $request)
  {
    // dd($request);
    $request->validate([
      'file' => 'required|mimes:xlsx,xls',
    ]);

    // Get the uploaded file
    $file = $request->file('file');

    try {
      //code...
      $import = new ImportPasien;
      $excel = Excel::import($import, $file);
      $array = $import->getArray();

      foreach ($array as $row) {
        $check_pasien = Pasien::whereNo_rm($row["no_rm"])->first();

        if (!$check_pasien) {
          # code...
          Pasien::create([
            'no_RM' => $row["no_rm"],
            'nama' => $row["nama"],
            'jenis_kelamin' => $row["jenis_kelamin"] == "L" ? "LAKI - LAKI" : "PEREMPUAN",
            'umur' => intval($row["umur"]),
            'alamat' => $row["alamat"],
          ]);
        }
      }

      flash()->success('Data import pasien berhasil ditambahkan.');
      return redirect('/daftar-pasien');
    } catch (Error $err) {
      dd($err);
      flash()->error('Terjadi error data import pasien gagal ditambahkan.');
      return redirect('/daftar-pasien');
      //   //throw $th;
    }
  }

  public function import_pasien_masuk(Request $request)
  {
    // dd($request);


    $request->validate([
      'file' => 'required|mimes:xlsx,xls',
    ]);

    // Get the uploaded file
    $file = $request->file('file');

    // dd($file);
    try {
      // code...
      $import = new ImportPasienDirawat;
      $excel = Excel::import($import, $file);
      $array = $import->getArray();


      // dd($array);

      $faker = FakerFactory::create();
      // dd($rows);
      foreach ($array as $row) {
        $kode_penyakit = "";
        if (substr($row['kode_penyakit'], 0, 1) == "Z") {
          $array_of_kode_penyakit = explode(";", $row['kode_penyakit']);
          $kode_penyakit = $array_of_kode_penyakit[1];
        } else {
          $array_of_kode_penyakit = explode(";", $row['kode_penyakit']);
          $kode_penyakit = $array_of_kode_penyakit[0];
        }
        // dd($kode_penyakit);
        $check_pembayaran = JenisPembayaran::whereNamaJenisPembayaran($row['jenis_pembayaran'])->first();
        $check_penyakit = Penyakit::whereKodePenyakit($kode_penyakit)->first();
        $jumlah_ruangan = DataRuangan::all()->count();
        $check_pasien = Pasien::whereNo_rm($row["no_rm"])->first();
        $id_pasien = 0;
        if (!$check_pasien) {
          # code...
          $new_pasien = Pasien::create([
            'no_RM' => $row["no_rm"],
            'nama' => $row["nama"],
            'jenis_kelamin' => $row["jenis_kelamin"] == "L" ? "LAKI - LAKI" : "PEREMPUAN",
            'umur' => intval($row["umur"]),
            'alamat' => $row["alamat"],
          ]);

          $id_pasien = $new_pasien->id;
        } else {
          $id_pasien = $check_pasien->id;
        }

        $pasien_mati = $row["kondisi_keluar"] == "meninggal" ? true : false;
        $kondisi_pasien = "";
        $dirujuk_ke = "";

        if ($row["kondisi_keluar"] == "Sembuh" || $row["kondisi_keluar"] == "Membaik" || $row["kondisi_keluar"] == "Lain-lain") {
          $kondisi_pasien = "Keluar - Sembuh";
        } else if ($row["kondisi_keluar"] == "Pulang" || $row == "Pulang Paksa") {
          $kondisi_pasien = "Keluar - Belum Sembuh";
        } else if ($row["kondisi_keluar"] == "Dirujuk" || $row["kondisi_keluar"] == "Dirujuk RS Lain" || $row["kondisi_keluar"] == "Dirujuk RS Lain Lebih Tinggi") {
          $kondisi_pasien = "Keluar - Dirujuk";
        } else if ($row["kondisi_keluar"] == "Meninggal" && ($row["kondisi_mati"] == "Meninggal 0 - 24 Jam" || $row["kondisi_mati"] == "Meninggal 24 - 48 Jam")) {
          $kondisi_pasien = "Mati < 48 Jam";
        } else if ($row["kondisi_keluar"] == "Meninggal" && $row["kondisi_mati"] == "Meninggal lebih dari 48 Jam") {
          $kondisi_pasien = "Mati > 48 Jam";
        }

        // dd($kondisi_pasien);
        if ($row["dirujuk_ke"] != "") {
          $dirujuk_ke = $row["dirujuk_ke"];
        }

        PasienDirawat::create([
          'pasien_id' => $id_pasien,
          'jenis_pembayaran_id' => $check_pembayaran->id,
          'kode_penyakit' => $kode_penyakit,
          'data_ruangan_id' =>  $faker->numberBetween(1, $jumlah_ruangan - 1),
          'nama_dokter' => $row["nama_dokter"],
          'tanggal_masuk' => $row["tanggal_masuk"],
          'tanggal_keluar' => $row["tanggal_keluar"],
          'pasien_pindahan' => false,
          'pasien_mati' => $pasien_mati,
          'keadaan_keluar' => $kondisi_pasien != "" ? $kondisi_pasien : null,
          'rumah_sakit_baru' => $dirujuk_ke != "" ? $dirujuk_ke : null

        ]);
      }
      flash()->success('Data import pasien berhasil ditambahkan.');
      return redirect('/pasiens');
    } catch (Error $err) {
      dd($err);
      flash()->error('Terjadi error data import pasien gagal ditambahkan.');
      return redirect('/pasiens');
      //   //throw $th;
    }
  }

  /**
   * Store a newly created resource in storage.
   */
  public function tambah_pasien_post(Request $request)
  {
    $this->validate($request, [
      'no_rm' => 'required|max:32|unique:pasiens,no_RM'
    ]);

    Pasien::create([
      'no_RM' => $request->no_rm,
      'nama' => $request->nama_pasien,
      'alamat' => $request->alamat,
      'umur' => $request->umur,
    ]);

    flash()->success('Pasien berhasil ditambahkan');
    return redirect('/daftar-pasien');
  }

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
        'alamat' => $request->alamat,
        'umur' => $request->umur
      ]);

      $pasien_dirawat = PasienDirawat::create([
        'pasien_id' => $new_pasien->id,
        'data_ruangan_id' => $check_data_ruangan->id,
        'jenis_pembayaran_id' => $check_jenis_pembayaran->id,
        'kode_penyakit' => $check_data_penyakit->kode_penyakit,
        'nama_dokter' => $request->nama_dokter,
        'jenis_penyakit' => $request->jenis_penyakit,
        'tanggal_masuk' => $request->tanggal_masuk,
      ]);
    } else {
      $pasien_dirawat = PasienDirawat::create([
        'pasien_id' => $check_pasien->id,
        'data_ruangan_id' => $check_data_ruangan->id,
        'jenis_pembayaran_id' => $check_jenis_pembayaran->id,
        'kode_penyakit' => $check_data_penyakit->kode_penyakit,
        'nama_dokter' => $request->nama_dokter,
        'jenis_penyakit' => $request->jenis_penyakit,
        'tanggal_masuk' => $request->tanggal_masuk,
      ]);
    }
    // $check_column_pembayaran

    // Ini memperbarui data total penyakit 10 besar Bulan ini
    $check_laporan_penyakit = LaporanPenyakitPasien::whereBetween('created_at', [
      Carbon::parse($request->tanggal_masuk)->startOfMonth(),
      Carbon::parse($request->tanggal_masuk)->endOfMonth()
    ])->whereKodePenyakit($request->kode_penyakit)->first();

    if ($check_laporan_penyakit) {
      // dd($check_laporan_penyakit);
      $check_laporan_penyakit->incrementEach(
        [
          $check_jenis_pembayaran->kategori_pasien => 1,
          'jumlah_pasien' => 1
        ]
      );
      LaporanPenyakitPasien::whereBetween('created_at', [
        Carbon::parse($request->tanggal_masuk)->startOfMonth(),
        Carbon::parse($request->tanggal_masuk)->endOfMonth()
      ])->whereKodePenyakit($check_data_penyakit->kode_penyakit)->incrementEach(
        [
          $check_jenis_pembayaran->kategori_pasien => 1,
          'jumlah_pasien' => 1
        ]
      );
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
        'created_at' => Carbon::parse($request->tanggal_masuk)
      ]);

      LaporanPenyakitPasien::whereKodePenyakit($request->kode_penyakit)->incrementEach(
        [
          $check_jenis_pembayaran->kategori_pasien => 1,
          'jumlah_pasien' => 1
        ]
      );
    }

    // Memperbarui nilai SHRI hari ini
    $check_laporan_shri = RekapitulasiSHRI::whereDate('tanggal', Carbon::parse($request->tanggal_masuk))->whereDataRuanganId($check_data_ruangan->id)->first();
    if ($check_laporan_shri) {
      # code...
      RekapitulasiSHRI::whereDate('tanggal', Carbon::today())->whereDataRuanganId($check_data_ruangan->id)->incrementEach(['pasien_baru' => 1, 'jumlah_pasien_masuk' => 1, 'pasien_sisa' => 1]);
    } else {
      $day_before = RekapitulasiSHRI::whereDataRuanganId($check_data_ruangan->id)->whereDate('created_at', Carbon::parse($request->tanggal_masuk)->subDay())->first();

      // Kalau ada
      if ($day_before) {
        # code...
        $new_row = RekapitulasiSHRI::create([
          'tanggal' => Carbon::parse($request->tanggal_masuk),
          'data_ruangan_id' => $day_before->data_ruangan_id,
          'pasien_awal' => $day_before->pasien_sisa,
          'pasien_baru' => 0,
          'pindahan' => 0,
          'jumlah_pasien_masuk' => 0,
          'pasien_keluar_hidup' => 0,
          'pasien_dipindahkan' => 0,
          'pasien_mati_belum_48_jam' => 0,
          'pasien_mati_sudah_48_jam' => 0,
          'jumlah_pasien_keluar' => 0,
          'pasien_sisa' => $day_before->pasien_sisa,
        ]);
        // Kalau tidak ada
      } else {
        $new_row = RekapitulasiSHRI::create([
          'tanggal' =>  Carbon::parse($request->tanggal_masuk),
          'data_ruangan_id' => $check_data_ruangan->id,
          'pasien_awal' => 1,
          'pasien_baru' => 1,
          'pindahan' => 0,
          'jumlah_pasien_masuk' => 1,
          'pasien_keluar_hidup' => 0,
          'pasien_dipindahkan' => 0,
          'pasien_mati_belum_48_jam' => 0,
          'pasien_mati_sudah_48_jam' => 0,
          'jumlah_pasien_keluar' => 0,
          'pasien_sisa' => 1,
        ]);
      }
    }

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
    $pasien_dirawat = PasienDirawat::with('pasien')->whereId($id)->first();
    $daftar_ruangan = DataRuangan::pluck('nama_ruangan');
    $daftar_penyakit = Penyakit::all();


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
      'alamat' => $request->alamat,
      'umur' => $request->umur
    ]);

    $check_data_ruangan = DataRuangan::whereNamaRuangan($request->ruangan)->first();
    $check_jenis_pembayaran = JenisPembayaran::whereNamaJenisPembayaran($request->jenis_pembayaran)->first();
    $pasien_dirawat = PasienDirawat::whereId($id)->update([
      'data_ruangan_id' => $check_data_ruangan->id,
      'jenis_pembayaran_id' => $check_jenis_pembayaran->id,
      'kode_penyakit' => strtoupper($request->kode_penyakit),
      'nama_dokter' => $request->nama_dokter,
      'tanggal_masuk' => $request->tanggal_masuk,
    ]);

    $check_laporan_penyakit = LaporanPenyakitPasien::whereBetween('created_at', [
      Carbon::parse($old_pasien_dirawats->tanggal_masuk)->startOfMonth(),
      Carbon::parse($old_pasien_dirawats->tanggal_masuk)->endOfMonth()
    ])->whereKodePenyakit($request->kode_penyakit)->first();

    if ($check_laporan_penyakit) {
      // dd($check_laporan_penyakit);
      $old_jenis_pembayaran = JenisPembayaran::whereId($old_pasien_dirawats->jenis_pembayaran_id)->first();
      LaporanPenyakitPasien::whereBetween('created_at', [
        Carbon::parse($old_pasien_dirawats->tanggal_masuk)->startOfMonth(),
        Carbon::parse($old_pasien_dirawats->tanggal_masuk)->endOfMonth()
      ])->whereKodePenyakit($request->kode_penyakit)->decrementEach(
        [
          $old_jenis_pembayaran->kategori_pasien => 1,
          'jumlah_pasien' => 1
        ]
      );
      LaporanPenyakitPasien::whereBetween('created_at', [
        Carbon::now()->startOfMonth(),
        Carbon::now()->endOfMonth()
      ])->whereKodePenyakit(strtoupper($request->kode_penyakit))->incrementEach(
        [
          $check_jenis_pembayaran->kategori_pasien => 1,
          'jumlah_pasien' => 1
        ]
      );
    }

    RekapitulasiSHRI::whereDate('tanggal', $old_pasien_dirawats->tanggal_masuk)->whereDataRuanganId($old_pasien_dirawats->data_ruangan_id)->decrementEach(['pasien_baru' => 1, 'jumlah_pasien_masuk' => 1, 'pasien_sisa' => 1]);
    $check_laporan_shri = RekapitulasiSHRI::whereDate('tanggal', Carbon::parse($request->tanggal_masuk))->whereDataRuanganId($check_data_ruangan->id)->first();
    if ($check_laporan_shri) {
      # code...
      RekapitulasiSHRI::whereDate('tanggal', Carbon::today())->whereDataRuanganId($check_data_ruangan->id)->incrementEach(['pasien_baru' => 1, 'jumlah_pasien_masuk' => 1, 'pasien_sisa' => 1]);
    } else {
      $day_before = RekapitulasiSHRI::whereDataRuanganId($check_data_ruangan->id)->whereDate('created_at', Carbon::parse($request->tanggal_masuk)->subDay())->first();

      // Kalau ada
      if ($day_before) {
        # code...
        $new_row = RekapitulasiSHRI::create([
          'tanggal' => Carbon::parse($request->tanggal_masuk),
          'data_ruangan_id' => $day_before->data_ruangan_id,
          'pasien_awal' => $day_before->pasien_sisa,
          'pasien_baru' => 0,
          'pindahan' => 0,
          'jumlah_pasien_masuk' => 0,
          'pasien_keluar_hidup' => 0,
          'pasien_dipindahkan' => 0,
          'pasien_mati_belum_48_jam' => 0,
          'pasien_mati_sudah_48_jam' => 0,
          'jumlah_pasien_keluar' => 0,
          'pasien_sisa' => $day_before->pasien_sisa,
        ]);
        // Kalau tidak ada
      } else {
        $new_row = RekapitulasiSHRI::create([
          'tanggal' =>  Carbon::parse($request->tanggal_masuk),
          'data_ruangan_id' => $check_data_ruangan->id,
          'pasien_awal' => 1,
          'pasien_baru' => 1,
          'pindahan' => 0,
          'jumlah_pasien_masuk' => 1,
          'pasien_keluar_hidup' => 0,
          'pasien_dipindahkan' => 0,
          'pasien_mati_belum_48_jam' => 0,
          'pasien_mati_sudah_48_jam' => 0,
          'jumlah_pasien_keluar' => 0,
          'pasien_sisa' => 1,
        ]);
      }
    }


    flash()->success('Data pasien masuk berhasil diperbarui');
    return redirect('/pasiens');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $pasien_delete = PasienDirawat::whereId($id)->delete();

    flash()->success('Data pasien masuk berhasil dihapus');
    return redirect('/pasiens');
  }
}
