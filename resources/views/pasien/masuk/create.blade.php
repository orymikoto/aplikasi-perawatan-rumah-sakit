@extends('components.dashboard-layout')

@section('content')
  <div class="flex flex-col justify-start items-start gap-6">
    <h1 class="font-josefin-sans font-semibold text-2xl text-emerald-600">Tambah Pasien Masuk</h1>
    <a href="{{ route('pasiens.index') }}" class="text-blue-600 hover:text-blue-500 font-jakarta-sans font-medium duration-200">
      <div class="flex items-center"> <i class="fa-solid fa-arrow-left w-8"></i>
        <p>Kembali ke halaman daftar pasien masuk</p>
      </div>
    </a>
    <form action="{{ route('pasiens.store') }}" class="flex flex-col gap-2 p-4 rounded-2xl shadow-md xl:w-[480px] " method="POST">
      @csrf
      <x-input.text title="No. RM" name="no_rm" placeholder="Nomor RM..." value="" />
      <x-input.text title="Nama Pasien" name="nama_pasien" placeholder="Nama Pasien .." value="" />
      <x-input.number title="Usia" name="umur" placeholder="Usia Pasien..." value="" />
      <x-input.select title="Jenis Kelamin" name="jenis_kelamin" placeholder="Pilih jenis kelamin pasien" :options="['LAKI - LAKI', 'PEREMPUAN']" />
      <x-input.date title="Tanggal Daftar Pasien" name="tanggal_daftar" placeholder="Tanggal Daftar Pasien..." value="" />
      <x-input.text title="Alamat" name="alamat" placeholder="Alamat Pasien..." value="" />
      <x-input.select title="Ruangan" name="ruangan" placeholder="Ruangan..." value="" :options="$daftar_ruangan" />
      <x-input-text placeholder="Kode Penyakit..." name="kode_penyakit" title="Kode Penyakit" value="" />
      <x-input-text placeholder="Jenis Penyakit..." name="jenis_penyakit" title="Jenis Penyakit" value="" />
      <x-input.select title="Jenis Pembayaran" name="jenis_pembayaran" placeholder="Pilih tipe jenis pembayaran" value="" :options="[
          'BPJS DINAS - ANGKATAN LAIN KELUARGA',
          'BPJS DINAS - ANGKATAN LAIN PNS',
          'BPJS DINAS - TNI AD KELUARGA',
          'BPJS DINAS - TNI AD MILITER',
          'BPJS DINAS - TNI AD MILITER BANMIN',
          'BPJS DINAS - TNI AD MILITER SATPUR',
          'BPJS DINAS - TNI AD PNS',
          'BPJS MANDIRI',
          'BPJS PBI',
          'BPJS PENSIUNAN TNI',
          'BPJS PENSIUNAN UMUM',
          'UMUM',
          'YANKES TELKOM',
      ]" />
      <x-input.date title="Tanggal Masuk" name="tanggal_masuk" placeholder="Pilih tanggal masuk" />
      <div class="flex items-center self-end gap-4 my-4">
        <a href="{{ url()->previous() }}"
          class="py-2 px-4 font-jakarta-sans font-semibold rounded-lg bg-red-600 text-white hover:shadow-md hover:bg-white hover:shadow-red-600/50 hover:text-red-600 duration-200">Batal</a>
        <button type="submit"
          class="py-2 px-4 font-jakarta-sans font-semibold rounded-lg bg-emerald-600 text-white hover:shadow-md hover:bg-white hover:shadow-emerald-600/50 hover:text-emerald-600 duration-200">Simpan</button>
      </div>
    </form>
  </div>
@stop
