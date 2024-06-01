<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nama_ruangan
 * @property int $jumlah_tempat_tidur
 * @property string $kelas
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PasienDirawat> $pasienDirawat
 * @property-read int|null $pasien_dirawat_count
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan query()
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan whereJumlahTempatTidur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan whereKelas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan whereNamaRuangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan whereUpdatedAt($value)
 */
	class DataRuangan extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nama_jenis_pembayaran
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PasienDirawat> $pasienDirawat
 * @property-read int|null $pasien_dirawat_count
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran query()
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran whereNamaJenisPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran whereUpdatedAt($value)
 */
	class JenisPembayaran extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|KelasRuangan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KelasRuangan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KelasRuangan query()
 * @method static \Illuminate\Database\Eloquent\Builder|KelasRuangan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KelasRuangan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KelasRuangan whereUpdatedAt($value)
 */
	class KelasRuangan extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $penyakit_id
 * @property string $icd
 * @property int $ad_mil
 * @property int $ad_pns
 * @property int $ad_kel
 * @property int $al_mil
 * @property int $al_pns
 * @property int $al_kel
 * @property int $bpjs
 * @property int $pasien_umum
 * @property int $jumlah_pasien
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Penyakit $penyakit
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien query()
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereAdKel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereAdMil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereAdPns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereAlKel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereAlMil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereAlPns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereBpjs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereIcd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereJumlahPasien($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien wherePasienUmum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien wherePenyakitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereUpdatedAt($value)
 */
	class LaporanPenyakitPasien extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $no_RM
 * @property string $nama
 * @property string $jenis_kelamin
 * @property string $tanggal_daftar
 * @property string $alamat
 * @property int $umur
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien whereNoRM($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien whereTanggalDaftar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien whereUmur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien whereUpdatedAt($value)
 */
	class Pasien extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $pasien_id
 * @property int $data_ruangan_id
 * @property int|null $jenis_pembayaran_id
 * @property string $kode_penyakit
 * @property string $tanggal_masuk
 * @property string $tanggal_keluar
 * @property int $pasien_pindahan
 * @property int $pasien_mati
 * @property string $keadaan_keluar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DataRuangan $dataRuangan
 * @property-read \App\Models\JenisPembayaran|null $jenisPembayaran
 * @property-read \App\Models\Pasien $pasien
 * @property-read \App\Models\Penyakit $penyakit
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat query()
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereDataRuanganId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereJenisPembayaranId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereKeadaanKeluar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereKodePenyakit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat wherePasienId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat wherePasienMati($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat wherePasienPindahan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereTanggalKeluar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereUpdatedAt($value)
 */
	class PasienDirawat extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah query()
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah whereUpdatedAt($value)
 */
	class PasienPindah extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pengguna newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengguna newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengguna query()
 */
	class Pengguna extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $kode_penyakit
 * @property string $nama_penyakit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LaporanPenyakitPasien> $laporanPenyakitPasien
 * @property-read int|null $laporan_penyakit_pasien_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PasienDirawat> $pasienDirawat
 * @property-read int|null $pasien_dirawat_count
 * @method static \Illuminate\Database\Eloquent\Builder|Penyakit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Penyakit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Penyakit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Penyakit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penyakit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penyakit whereKodePenyakit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penyakit whereNamaPenyakit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penyakit whereUpdatedAt($value)
 */
	class Penyakit extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $tanggal
 * @property string $nama_fktl
 * @property int $jumlah_tempat_tidur
 * @property float $nilai_bor
 * @property float $nilai_bto
 * @property float $nilai_alos
 * @property float $nilai_toi
 * @property float $nilai_gdr
 * @property float $nilai_ndr
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI query()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI whereJumlahTempatTidur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI whereNamaFktl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI whereNilaiAlos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI whereNilaiBor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI whereNilaiBto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI whereNilaiGdr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI whereNilaiNdr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI whereNilaiToi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI whereUpdatedAt($value)
 */
	class RekapitulasiIndikatorRI extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $tanggal
 * @property int $pasien_awal
 * @property int $pasien_baru
 * @property int $pindahan
 * @property int $jumlah_pasien_masuk
 * @property int $pasien_keluar_hidup
 * @property int $pasien_dipindahkan
 * @property int $pasien_mati_belum_48_jam
 * @property int $pasien_mati_sudah_48_jam
 * @property int $jumlah_pasien_keluar
 * @property int $lama_dirawat
 * @property int $pasien_sisa
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI query()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI whereJumlahPasienKeluar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI whereJumlahPasienMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI whereLamaDirawat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI wherePasienAwal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI wherePasienBaru($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI wherePasienDipindahkan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI wherePasienKeluarHidup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI wherePasienMatiBelum48Jam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI wherePasienMatiSudah48Jam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI wherePasienSisa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI wherePindahan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI whereUpdatedAt($value)
 */
	class RekapitulasiSHRI extends \Eloquent {}
}

