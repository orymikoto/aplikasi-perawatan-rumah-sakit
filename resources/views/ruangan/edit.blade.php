@extends('components.dashboard-layout')

@section('content')
  <div class="flex flex-col justify-start items-start gap-6">
    <h1 class="font-josefin-sans font-semibold text-2xl text-emerald-600">Edit Ruangan</h1>
    <a href="{{ route('ruangan.index') }}" class="text-blue-600 hover:text-blue-500 font-jakarta-sans font-medium duration-200">
      <div class="flex items-center"> <i class="fa-solid fa-arrow-left w-8"></i>
        <p>Kembali ke halaman daftar ruangan</p>
      </div>
    </a>
    <form class="flex flex-col gap-4 p-4 rounded-2xl shadow-md xl:w-[480px] " action="{{ route('ruangan.update', $data_ruangan->id) }}" method="POST">
      @csrf
      @method('PUT')
      <x-input.text title="Nama ruangan" name="nama_ruangan" placeholder="Nama Ruangan..." value="{{ $data_ruangan->nama_ruangan }}" />
      <x-input.number title="Jumlah tempat tidur" name="jumlah_tempat_tidur" placeholder="Jumlah tempat tidur..."
        value="{{ $data_ruangan->jumlah_tempat_tidur }}" />
      <x-input.select title="Kelas" name="kelas" placeholder="Pilih jenis kelas" value="{{ $data_ruangan->kelas }}" :options="['Umum', 'Kelas 1', 'Kelas 2', 'Kelas 3']" />
      <div class="flex items-center self-end gap-4">
        <a href="{{ url()->previous() }}"
          class="py-2 px-4 font-jakarta-sans font-semibold rounded-lg bg-red-600 text-white hover:shadow-md hover:bg-white hover:shadow-red-600/50 hover:text-red-600 duration-200">Batal</a>
        <button type="submit"
          class="py-2 px-4 font-jakarta-sans font-semibold rounded-lg bg-emerald-600 text-white hover:shadow-md hover:bg-white hover:shadow-emerald-600/50 hover:text-emerald-600 duration-200">Simpan</button>
      </div>
    </form>
  </div>
@stop
