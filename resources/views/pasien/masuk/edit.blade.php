@extends('components.dashboard-layout')

@section('content')
  <div class="flex flex-col justify-start items-start gap-6">
    <h1 class="font-josefin-sans font-semibold text-2xl text-emerald-600">Edit Pasien Masuk</h1>
    <a href="{{ route('pasiens.index') }}" class="text-blue-600 hover:text-blue-500 font-jakarta-sans font-medium duration-200">
      <div class="flex items-center"> <i class="fa-solid fa-arrow-left w-8"></i>
        <p>Kembali ke halaman daftar pasien masuk</p>
      </div>
    </a>
    <form action="{{ route('pasiens.update', $pasien_dirawat->id) }}" class="flex flex-col gap-2 p-4 rounded-2xl shadow-md xl:w-[480px] " method="POST">
      @method('PUT')
      @csrf
      <x-input.text title="No. RM" name="no_rm" placeholder="Nomor RM..." value="{{ $pasien_dirawat->pasien->no_RM }}" />
      <x-input.text title="Nama Pasien" name="nama_pasien" placeholder="Nama Pasien ..." value="{!! $pasien_dirawat->pasien->nama !!}" />
      <x-input.number title="Usia" name="umur" placeholder="Usia Pasien..." value="{{ $pasien_dirawat->pasien->umur }}" />
      <x-input.select title="Jenis Kelamin" name="jenis_kelamin" placeholder="Pilih jenis kelamin pasien" :options="['LAKI - LAKI', 'PEREMPUAN']"
        value="{{ $pasien_dirawat->pasien->jenis_kelamin }}" />
      <x-input.text title="Alamat" name="alamat" placeholder="Alamat Pasien..." value="{{ $pasien_dirawat->pasien->alamat }}" />
      <x-input.select title="Ruangan" name="ruangan" placeholder="Ruangan..." value="{{ $pasien_dirawat->dataRuangan->nama_ruangan }}"
        :options="$daftar_ruangan" />
      <div class="flex flex-col">
        <div class="form-group flex flex-col font-jakarta-sans gap-2">
          <label for="nama_dokter" class="text-emerald-600 text-lg font-semibold">Nama Dokter</label>
          <input id="nama_dokter" name="nama_dokter" type="text" list="daftar_dokter_fieldlist"
            class=" w-full border border-neutral-600 focus:border-emerald-600 font-medium rounded-lg py-2 px-4 outline-none"
            placeholder="Nama Dokter...">
          <datalist id="daftar_dokter_fieldlist">
            @foreach ($daftar_dokter as $key => $value)
              <option value="{{ $value->nama_dokter }}">
                {{ $value->nama_dokter }}</option>
            @endforeach
          </datalist>
          <span id="error" class="text-danger"></span>
        </div>
      </div>
      <div class="flex flex-col">
        <div class="form-group flex flex-col font-jakarta-sans gap-2">
          <label for="kode_penyakit" class="text-emerald-600 text-lg font-semibold">Kode Penyakit</label>
          <input id="kode_penyakit" name="kode_penyakit" type="text" list="kode_penyakit_fieldlist"
            class=" w-full border border-neutral-600 focus:border-emerald-600 font-medium rounded-lg py-2 px-4 outline-none"
            placeholder="Kode Penyakit..." value="{{ $pasien_dirawat->kode_penyakit }}">
          <datalist id="kode_penyakit_fieldlist">
            @foreach ($daftar_penyakit as $key => $value)
              <option value="{{ $value->kode_penyakit }}">
                {{ $value->kode_penyakit . ' - ' . $value->nama_penyakit }}</option>
            @endforeach
          </datalist>
          <span id="error" class="text-danger"></span>
        </div>
      </div>
      <x-input.select title="Jenis Pembayaran" name="jenis_pembayaran" placeholder="Pilih tipe jenis pembayaran"
        value="{{ $pasien_dirawat->jenisPembayaran->nama_jenis_pembayaran }}" :options="[
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
      <x-input.date title="Tanggal Masuk" name="tanggal_masuk" placeholder="Pilih tanggal masuk"
        value="{{ \Carbon\Carbon::parse($pasien_dirawat->tanggal_masuk)->format('Y-m-d') }}" />
      <div class="flex items-center self-end gap-4 my-4">
        <a href="{{ url()->previous() }}"
          class="py-2 px-4 font-jakarta-sans font-semibold rounded-lg bg-red-600 text-white hover:shadow-md hover:bg-white hover:shadow-red-600/50 hover:text-red-600 duration-200">Batal</a>
        <button type="submit"
          class="py-2 px-4 font-jakarta-sans font-semibold rounded-lg bg-emerald-600 text-white hover:shadow-md hover:bg-white hover:shadow-emerald-600/50 hover:text-emerald-600 duration-200">Simpan</button>
      </div>
    </form>
  </div>
@stop
