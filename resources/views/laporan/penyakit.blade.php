@extends('components.dashboard-layout')

@section('content')
  <div class="flex flex-col justify-start items-start gap-6 h-full overflow-x-clip relative">
    <h1 class="font-josefin-sans font-semibold text-2xl text-emerald-600">Laporan</h1>
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

    <h2 class="text-2xl text-center mx-auto text-neutral-900 font-josefin-sans">Laporan Penyakit Bulan
      {{ request()->has('tanggal') ? \Carbon\Carbon::parse(request()->query('tanggal'))->translatedFormat('F, Y') : \Carbon\Carbon::now()->translatedFormat('F, Y') }}
      {{-- {{ request()->query('tanggal') }} --}}
    </h2>
    <div class="flex w-full justify-between">
      <div class="flex items-center gap-4">
        <p>Pilih Bulan : </p>
        <form action="">
          <input id="filter_bulan" class="rounded-md px-2 py-1 border-2 border-neutral-600" type="month"
            value="{{ request()->has('tanggal') ? \Carbon\Carbon::parse(request()->query('tanggal'))->format('Y-m') : \Carbon\Carbon::now()->format('Y-m') }}">
          {{-- <x-button.color-button type="submit" color="emerald-600" text="Simpan" /> --}}
          {{-- <button class="text-white bg-emerald-600 px-4 py-2 font-jakarta-sans hover:text-emerald-600 hover:bg-emerald-600">Simpan</button> --}}
        </form>
      </div>
      <a href="{{ route('export-penyakit', request()->has('tanggal') ? request()->query('tanggal') : \Carbon\Carbon::now()) }}"
        class="self-end rounded-md flex gap-x-2 items-center bg-emerald-600 text-center px-8 py-2 text-white text-lg font-josefin-sans hover:bg-white hover:text-emerald-600 hover:shadow-md hover:shadow-teal-400/75 duration-200">
        <p>Cetak</p>
        <i class="fa-solid fa-file-arrow-down fa-lg"></i>
      </a>
    </div>
    <div class=" overflow-x-scroll relative max-w-full">
      <table class="rounded-t-2xl w-full min-h-full flex-1 border-collapse shadow-md overflow-hidden table ">
        <thead>
          <tr class="text-white font-josefin-sans font-medium text-lg bg-emerald-600">
            <th rowspan="2" class="px-4 text-center w-16 border">No.</th>
            <th rowspan="2" class="px-4 text-center min-w-24 border">ICD 10</th>
            <th rowspan="3" class="px-4 text-center min-w-80 border">Jenis Penyakit</th>
            <th colspan="3" class="px-4 text-center border">TNI AD</th>
            <th colspan="3" class="px-4 text-center border">Angkatan Lain</th>
            <th rowspan="2" class="px-4 text-center border">BPJS</th>
            <th rowspan="2" class="px-4 text-center border">Pasien Umum</th>
            <th rowspan="2" class="px-4 text-center border">Jumlah Pasien</th>
            {{-- <th class="px-4 text-center w-16">Aksi</th> --}}
          </tr>
          <tr class="text-white font-josefin-sans font-medium text-lg bg-emerald-600">

            <th class="px-4 text-center  border">MIL</th>
            <th class="px-4 text-center  border">PNS</th>
            <th class="px-4 text-center  border">KEL</th>
            <th class="px-4 text-center  border">MIL</th>
            <th class="px-4 text-center  border">PNS</th>
            <th class="px-4 text-center  border">KEL</th>
          </tr>
          <tr class="text-white font-josefin-sans font-medium text-lg bg-emerald-600">

            <th class="px-4 text-center min-w-16 border">1</th>
            <th class="px-4 text-center border">2</th>
            <th class="px-4 text-center border">3</th>
            <th class="px-4 text-center min-w-20 border">4</th>
            <th class="px-4 text-center min-w-20 border">5</th>
            <th class="px-4 text-center min-w-20 border">6</th>
            <th class="px-4 text-center min-w-20 border">7</th>
            <th class="px-4 text-center min-w-20 border">8</th>
            <th class="px-4 text-center min-w-20 border">9</th>
            <th class="px-4 text-center min-w-20 border">10</th>
            <th class="px-4 text-center min-w-20 border">11</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($laporan as $key => $value)
            <tr data-entry-id="{{ $value->id }}" class="h-12 text-lg font-josefin-sans font-medium text-neutral-800">
              <td class="px-4 border-neutral-200/50 border-b-neutral-400/75 border text-center">
                {{ $key + 1 }}
              </td>
              <td class="px-4 border-neutral-200/50 border-b-neutral-400/75 border text-center">
                {{ $value->kode_penyakit }}</td>
              <td class="px-4 border-neutral-200/50 border-b-neutral-400/75 border text-start">
                {{ $value->jenis_penyakit }}</td>
              <td class="px-4 border-neutral-200/50 border-b-neutral-400/75 border text-center">
                {{ $value->tni_ad_mil }}</td>
              <td class="px-4 border-neutral-200/50 border-b-neutral-400/75 border text-center">
                {{ $value->tni_ad_pns }}</td>
              <td class="px-4 border-neutral-200/50 border-b-neutral-400/75 border text-center">
                {{ $value->tni_ad_kel }}</td>
              <td class="px-4 border-neutral-200/50 border-b-neutral-400/75 border text-center">
                {{ $value->tni_al_mil }}</td>
              <td class="px-4 border-neutral-200/50 border-b-neutral-400/75 border text-center">
                {{ $value->tni_al_pns }}</td>
              <td class="px-4 border-neutral-200/50 border-b-neutral-400/75 border text-center">
                {{ $value->tni_al_kel }}</td>
              <td class="px-4 border-neutral-200/50 border-b-neutral-400/75 border text-center">
                {{ $value->bpjs }}
              </td>
              <td class="px-4 border-neutral-200/50 border-b-neutral-400/75 border text-center">
                {{ $value->pasien_umum }}</td>
              <td class="px-4 border-neutral-200/50 border-b-neutral-400/75 border text-center">
                {{ $value->jumlah_pasien }}</td>
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

  <script>
    let filter_bulan = document.getElementById('filter_bulan');

    filter_bulan.onchange = function(e) {
      console.log(e.target.value);
      location.replace(`http://127.0.0.1:8000/laporan/penyakit?tanggal=${e.target.value}`)
      // const xhr = new XMLHttpRequest();
      // xhr.open("GET", `http://127.0.0.1:8000/laporan/penyakit?tanggal=${e.target.value}`);
      // xhr.send();
    }

    // document.getElementById('filter_bulan').addEventListener(
    //     'change',
    //     () => {
    //         console.log("tes");
    //     }
    // );
  </script>
@stop
