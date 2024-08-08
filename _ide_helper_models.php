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
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PasienDirawat> $pasienDirawat
 * @property-read int|null $pasien_dirawat_count
 * @property-read \App\Models\Pengguna|null $perawat
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan query()
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan whereJumlahTempatTidur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan whereKelas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan whereNamaRuangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DataRuangan withoutTrashed()
 */
	class DataRuangan extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PasienDirawat> $pasienDirawat
 * @property-read int|null $pasien_dirawat_count
 * @method static \Illuminate\Database\Eloquent\Builder|Dokter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dokter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dokter onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Dokter query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dokter withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Dokter withoutTrashed()
 */
	class Dokter extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nama_jenis_pembayaran
 * @property string $kategori_pasien
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PasienDirawat> $pasienDirawat
 * @property-read int|null $pasien_dirawat_count
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran query()
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran whereKategoriPasien($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran whereNamaJenisPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|JenisPembayaran withoutTrashed()
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
 * @property string $kode_penyakit
 * @property string $jenis_penyakit
 * @property int $tni_ad_mil
 * @property int $tni_ad_pns
 * @property int $tni_ad_kel
 * @property int $tni_al_mil
 * @property int $tni_al_pns
 * @property int $tni_al_kel
 * @property int $bpjs
 * @property int $pasien_umum
 * @property int $jumlah_pasien
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Penyakit|null $penyakit
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien query()
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereBpjs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereJenisPenyakit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereJumlahPasien($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereKodePenyakit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien wherePasienUmum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereTniAdKel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereTniAdMil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereTniAdPns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereTniAlKel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereTniAlMil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereTniAlPns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LaporanPenyakitPasien withoutTrashed()
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
 * @property string $alamat
 * @property int $umur
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PasienDirawat> $pasienDirawat
 * @property-read int|null $pasien_dirawat_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien whereNoRM($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien whereUmur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasien withoutTrashed()
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
 * @property \Illuminate\Support\Carbon $tanggal_masuk
 * @property \Illuminate\Support\Carbon|null $tanggal_keluar
 * @property string|null $jam_dirujuk
 * @property string $nama_dokter
 * @property int|null $pasien_pindahan
 * @property int|null $pasien_mati
 * @property string|null $keadaan_keluar
 * @property string|null $rumah_sakit_baru
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\DataRuangan $dataRuangan
 * @property-read \App\Models\JenisPembayaran|null $jenisPembayaran
 * @property-read \App\Models\Pasien $pasien
 * @property-read \App\Models\Penyakit $penyakit
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat query()
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereDataRuanganId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereJamDirujuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereJenisPembayaranId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereKeadaanKeluar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereKodePenyakit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereNamaDokter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat wherePasienId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat wherePasienMati($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat wherePasienPindahan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereRumahSakitBaru($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereTanggalKeluar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PasienDirawat withoutTrashed()
 */
	class PasienDirawat extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $ruangan_lama_id
 * @property int $ruangan_baru_id
 * @property int $pasien_dirawat_id
 * @property int $disetujui
 * @property \Illuminate\Support\Carbon $tanggal_pindah
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\PasienDirawat $pasienDirawat
 * @property-read \App\Models\DataRuangan $ruanganBaru
 * @property-read \App\Models\DataRuangan $ruanganLama
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah query()
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah whereDisetujui($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah wherePasienDirawatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah whereRuanganBaruId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah whereRuanganLamaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah whereTanggalPindah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PasienPindah withoutTrashed()
 */
	class PasienPindah extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nama
 * @property string $email
 * @property string $role
 * @property string $password
 * @property string $foto_profil
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RuanganPerawat> $ruanganPerawat
 * @property-read int|null $ruangan_perawat_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pengguna newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengguna newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengguna query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengguna whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengguna whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengguna whereFotoProfil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengguna whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengguna whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengguna wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengguna whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengguna whereUpdatedAt($value)
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
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI query()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI whereDeletedAt($value)
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
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiIndikatorRI withoutTrashed()
 */
	class RekapitulasiIndikatorRI extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $data_ruangan_id
 * @property \Illuminate\Support\Carbon $tanggal
 * @property int $pasien_awal
 * @property int $pasien_baru
 * @property int $pindahan
 * @property int $jumlah_pasien_masuk
 * @property int $pasien_keluar_hidup
 * @property int $pasien_dipindahkan
 * @property int $pasien_mati_belum_48_jam
 * @property int $pasien_mati_sudah_48_jam
 * @property int $jumlah_pasien_keluar
 * @property int $pasien_sisa
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\DataRuangan $dataRuangan
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI query()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI whereDataRuanganId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI whereJumlahPasienKeluar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI whereJumlahPasienMasuk($value)
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
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapitulasiSHRI withoutTrashed()
 */
	class RekapitulasiSHRI extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $pengguna_id
 * @property int|null $data_ruangan_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DataRuangan|null $dataRuangan
 * @property-read \App\Models\Pengguna|null $pengguna
 * @method static \Illuminate\Database\Eloquent\Builder|RuanganPerawat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RuanganPerawat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RuanganPerawat query()
 * @method static \Illuminate\Database\Eloquent\Builder|RuanganPerawat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RuanganPerawat whereDataRuanganId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RuanganPerawat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RuanganPerawat wherePenggunaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RuanganPerawat whereUpdatedAt($value)
 */
	class RuanganPerawat extends \Eloquent {}
}

