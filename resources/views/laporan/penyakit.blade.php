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
                        <tr data-entry-id="{{ $value->id }}"
                            class="h-12 text-lg font-josefin-sans font-medium text-neutral-800">
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
@stop
