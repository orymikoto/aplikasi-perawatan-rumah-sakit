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
        <h2 class="my-2 text-2xl text-center mx-auto text-neutral-900 font-josefin-sans">Rekapitulasi Rawat Inap Bulan
            {{ request()->has('tanggal') ? \Carbon\Carbon::parse(request()->query('tanggal'))->translatedFormat('F, Y') : \Carbon\Carbon::now()->subMonth()->translatedFormat('F, Y') }}
            {{-- {{ request()->query('tanggal') }} --}}
        </h2>
        <div class="flex items-center gap-4">
            <p>Pilih Bulan : </p>
            <form action="">
                <input id="filter_bulan" class="rounded-md px-2 py-1 border-2 border-neutral-600" type="month"
                    value="{{ request()->has('tanggal') ? \Carbon\Carbon::parse(request()->query('tanggal'))->format('Y-m') : \Carbon\Carbon::now()->subMonth()->format('Y-m') }}">
                {{-- <x-button.color-button type="submit" color="emerald-600" text="Simpan" /> --}}
                {{-- <button class="text-white bg-emerald-600 px-4 py-2 font-jakarta-sans hover:text-emerald-600 hover:bg-emerald-600">Simpan</button> --}}
            </form>
        </div>
        <div class=" overflow-x-scroll relative max-w-full">
            <table class="rounded-t-2xl w-full min-h-full flex-1 border-collapse shadow-md overflow-hidden table ">
                <thead>
                    <tr class="text-white font-josefin-sans font-medium text-lg bg-emerald-600">
                        <th rowspan="2" class="px-4 text-center w-16 border">No.</th>
                        <th rowspan="2" class="px-4 text-center min-w-80 border">Nama FKTL</th>
                        <th rowspan="3" class="px-4 text-center min-w-32 border">Tempat Tidur</th>
                        <th colspan="6" class="px-4 text-center border min">Nilai Paramater</th>
                        {{-- <th class="px-4 text-center w-16">Aksi</th> --}}
                    </tr>
                    <tr class="text-white font-josefin-sans font-medium text-lg bg-emerald-600">

                        <th class="px-4 text-center min-w-32 border">BOR</th>
                        <th class="px-4 text-center min-w-32 border">BTO</th>
                        <th class="px-4 text-center min-w-32 border">ALOS</th>
                        <th class="px-4 text-center min-w-32 border">TOI</th>
                        <th class="px-4 text-center min-w-32 border">GDR</th>
                        <th class="px-4 text-center min-w-32 border">NDR</th>
                    </tr>
                    <tr class="text-white font-josefin-sans font-medium text-lg bg-emerald-600">

                        <th class="px-4 text-center min-w-16 border">1</th>
                        <th class="px-4 text-center min-w-32 border">2</th>
                        <th class="px-4 text-center min-w-32 border">3</th>
                        <th class="px-4 text-center min-w-32 border">4</th>
                        <th class="px-4 text-center min-w-32 border">5</th>
                        <th class="px-4 text-center min-w-32 border">6</th>
                        <th class="px-4 text-center min-w-32 border">7</th>
                        <th class="px-4 text-center min-w-32 border">8</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($laporan)
                        <tr data-entry-id="{{ $laporan->id }}"
                            class="h-24 text-lg font-josefin-sans font-medium text-neutral-800 border-b border-b-neutral-200/50">
                            <td class="px-4 text-center">1</td>
                            <td class="px-4 text-start">{{ $laporan->nama_fktl }}</td>
                            <td class="px-4 text-center">{{ $laporan->jumlah_tempat_tidur }}</td>
                            <td class="px-4 text-center">{{ $laporan->nilai_bor }}</td>
                            <td class="px-4 text-center">{{ $laporan->nilai_bto }}</td>
                            <td class="px-4 text-center">{{ $laporan->nilai_alos }}</td>
                            <td class="px-4 text-center">{{ $laporan->nilai_toi }}</td>
                            <td class="px-4 text-center">{{ $laporan->nilai_gdr }}</td>
                            <td class="px-4 text-center">{{ $laporan->nilai_ndr }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="9" class="text-center">{{ __('Data Empty') }}</td>
                        </tr>
                    @endif


                </tbody>
            </table>
        </div>

    </div>

    <script>
        let filter_bulan = document.getElementById('filter_bulan');

        filter_bulan.onchange = function(e) {
            console.log(e.target.value);
            location.replace(`http://127.0.0.1:8000/laporan/ris?tanggal=${e.target.value}`)
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
