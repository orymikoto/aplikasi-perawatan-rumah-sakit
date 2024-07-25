@extends('components.dashboard-layout')

@section('content')
  <div class="flex flex-col justify-start items-start gap-6 h-full overflow-x-clip relative">
    <h1 class="font-josefin-sans font-semibold text-2xl text-emerald-600">Laporan</h1>
    {{-- <h2 class="text-center text-neutral-900">Laporan </h2> --}}
    <div class="w-full flex gap-x-4 overflow-x-scroll scrollbar-thin pb-2 " style="scrollbar-color: #059669 white ">
      <x-popup.link_shri id="modal_link_shri" :daftar_ruangan="$data_ruangan" />
      <a href="{{ route('laporan_ris') }}"
        class="rounded-md bg-emerald-600 min-w-60 text-center py-2 text-white text-lg font-josefin-sans hover:bg-white hover:text-emerald-600 hover:shadow-md hover:shadow-teal-400/75 duration-200">
        Rekapatilasi Indikator RI</a>
      <a href="{{ route('laporan_penyakit') }}"
        class="rounded-md bg-emerald-600 min-w-60 text-center py-2 text-white text-lg font-josefin-sans hover:bg-white hover:text-emerald-600 hover:shadow-md hover:shadow-teal-400/75 duration-200">
        10 Besar Penyakit</a>
      <a href="{{ route('laporan_ruangan') }}"
        class="rounded-md bg-emerald-600 min-w-60 text-center py-2 text-white text-lg font-josefin-sans hover:bg-white hover:text-emerald-600 hover:shadow-md hover:shadow-teal-400/75 duration-200">
        Data Ruangan</a>
    </div>
    <h2 class="text-2xl text-center mx-auto text-neutral-900 font-josefin-sans">Data Ruangan
    </h2>
    <div class="flex items-center gap-4">
      <p>Pilih Bulan : </p>
      <form action="">
        <input id="filter_bulan" class="rounded-md px-2 py-1 border-2 border-neutral-600" type="month"
          value="{{ request()->has('tanggal') ? \Carbon\Carbon::parse(request()->query('tanggal'))->format('Y-m') : \Carbon\Carbon::now()->format('Y-m') }}">
        {{-- <x-button.color-button type="submit" color="emerald-600" text="Simpan" /> --}}
        {{-- <button class="text-white bg-emerald-600 px-4 py-2 font-jakarta-sans hover:text-emerald-600 hover:bg-emerald-600">Simpan</button> --}}
      </form>
    </div>
    <div class=" overflow-x-scroll w-full relative max-w-full">
      <table class="rounded-t-2xl w-full min-h-full flex-1 shadow-md overflow-hidden table ">
        <thead>
          <tr class="text-white font-josefin-sans font-medium h-16 text-lg bg-emerald-600">
            {{-- <th rowspan="2" class="px-4 text-start w-12">No.</th> --}}
            <th class="px-4 text-center w-12 ">No</th>
            <th class="px-4 text-center w-24">Umum</th>
            <th class="px-4 text-center w-24">Kelas 1</th>
            <th class="px-4 text-center w-24">Kelas 2</th>
            <th class="px-4 text-center w-24">Kelas 3</th>
            <th class="px-4 text-center w-24">Jumlah</th>
            {{-- <th class="px-4 text-center w-16">Aksi</th> --}}
          </tr>
        </thead>
        <tbody>

          <tr data-entry-id="{{ 1 }}" class="h-12 text-lg font-josefin-sans font-medium text-neutral-800 border-b border-b-neutral-200/50">
            <td class="px-4 text-center">1 </td>
            <td class="px-4 text-center">{{ $laporan_ruangan['Umum'] }}</td>
            <td class="px-4 text-center">{{ $laporan_ruangan['Kelas 1'] }}</td>
            <td class="px-4 text-center">{{ $laporan_ruangan['Kelas 2'] }}</td>
            <td class="px-4 text-center">{{ $laporan_ruangan['Kelas 3'] }}</td>
            <td class="px-4 text-center">{{ $laporan_ruangan['Jumlah'] }}</td>
          </tr>



        </tbody>
      </table>
    </div>

  </div>
  <script>
    let filter_bulan = document.getElementById('filter_bulan');

    filter_bulan.onchange = function(e) {
      console.log(e.target.value);
      location.replace(
        `http://127.0.0.1:8000/laporan/ruangan/{{ request()->route('id') }}?tanggal=${e.target.value}`)
    }
  </script>
@stop
