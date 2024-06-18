@extends('components.dashboard-layout')

@section('content')
  <div class="flex flex-col justify-start items-start gap-6 h-full overflow-x-clip relative">
    <h1 class="font-josefin-sans font-semibold text-2xl text-emerald-600">Laporan</h1>
    <div class="w-full flex gap-x-4 ">
      <x-popup.link_shri id="modal_link_shri" :daftar_ruangan="$data_ruangan" />
      <a href="{{ route('laporan_ris') }}"
        class="rounded-md bg-emerald-600 w-60 text-center py-2 text-white text-lg font-josefin-sans hover:bg-white hover:text-emerald-600 hover:shadow-md hover:shadow-teal-400/75 duration-200">
        Rekapatilasi Indikator RI</a>
      <a href="{{ route('laporan_penyakit') }}"
        class="rounded-md bg-emerald-600 w-60 text-center py-2 text-white text-lg font-josefin-sans hover:bg-white hover:text-emerald-600 hover:shadow-md hover:shadow-teal-400/75 duration-200">
        10 Besar Penyakit</a>
    </div>
    <h2 class="my-4 text-2xl text-center mx-auto text-neutral-900 font-josefin-sans">Rekapitulasi SHRI
      {{ $ruangan_saat_ini->nama_ruangan }}
    </h2>
    <div class=" overflow-x-scroll relative max-w-full">
      <table class="rounded-t-2xl w-full min-h-full flex-1 shadow-md overflow-hidden table ">
        <thead>
          <tr class="text-white font-josefin-sans font-medium h-16 text-lg bg-emerald-600">
            <th rowspan="2" class="px-4 text-start w-12">No.</th>
            <th rowspan="2" class="px-4 text-center min-w-32 ">Tanggal</th>
            <th rowspan="2" class="px-4 text-start w-24">Pasien Awal</th>
            <th rowspan="2" class="px-4 text-start w-24">Pasien Baru</th>
            <th rowspan="2" class="px-4 text-center w-24">Pindahan</th>
            <th rowspan="2" class="px-4 text-center w-24">Jumlah Pasien Masuk</th>
            <th rowspan="2" class="px-4 text-center w-24">Pasien Keluar Hidup</th>
            <th rowspan="2" class="px-4 text-center w-24">Pasien Dipindahkan</th>
            <th colspan="2" class="px-4 text-center w-60">Pasien Mati</th>
            <th rowspan="2" class="px-4 text-center w-24">Jumlah Pasien Keluar</th>
            <th rowspan="2" class="px-4 text-center w-24">Pasien Sisa</th>
            {{-- <th class="px-4 text-center w-16">Aksi</th> --}}
          </tr>
          <tr class="text-white font-josefin-sans font-medium h-16 text-lg bg-emerald-600">
            <th class="px-4 text-start w-30"> {{ '< 48 Jam' }}</th>
            <th class="px-4 text-start w-30"> {{ '> 48 Jam' }}</th>
            {{-- <th class="px-4 text-center w-16">Aksi</th> --}}
          </tr>
        </thead>
        <tbody>
          @forelse ($laporan as $key => $value)
            <tr data-entry-id="{{ $value->id }}"
              class="h-12 text-lg font-josefin-sans font-medium text-neutral-800 border-b border-b-neutral-200/50">
              <td class="px-4">{{ $key }}</td>
              <td class="px-4 text-center">{{ $value->tanggal->toDateString() }}</td>
              <td class="px-4 text-center">{{ $value->pasien_awal }}</td>
              <td class="px-4 text-center">{{ $value->pasien_baru }}</td>
              <td class="px-4 text-center">{{ $value->pindahan }}</td>
              <td class="px-4 text-center">{{ $value->jumlah_pasien_masuk }}</td>
              <td class="px-4 text-center">{{ $value->pasien_keluar_hidup }}</td>
              <td class="px-4 text-center">{{ $value->pasien_dipindahkan }}</td>
              <td class="px-4 text-center">{{ $value->pasien_mati_belum_48_jam }}</td>
              <td class="px-4 text-center">{{ $value->pasien_mati_sudah_48_jam }}</td>
              <td class="px-4 text-center">{{ $value->jumlah_pasien_keluar }}</td>
              <td class="px-4 text-center">{{ $value->pasien_sisa }}</td>
              {{-- <td class="px-4">
              <div class="flex gap-2 mx-auto justify-center">
                <button class="bg-red-600 text-white hover:bg-red-500 p-1 px-2 rounded-md">
                  <i class="fa-solid fa-trash w-6 h-6"></i>
                </button>
                <a href="{{ route('pasiens.edit', $pasien->id) }}"
                  class="bg-teal-600 flex items-center justify-center text-white hover:bg-teal-500 p-1 px-2 rounded-md">
                  <i class="fa-solid fa-pen w-6 h-6 flex items-center justify-center"></i>
                </a>
                <x-popup.ruangan-table-action id="{{ 'modal_popup_' . $pasien->id }}" :id_pasien="$pasien->id" :daftar_ruangan="$daftar_ruangan" />
              </div>
            </td> --}}
            </tr>
          @empty
            <tr>
              <td colspan="9" class="text-center">{{ __('Data Empty') }}</td>
            </tr>
          @endforelse


        </tbody>
      </table>
    </div>

  </div>
@stop
