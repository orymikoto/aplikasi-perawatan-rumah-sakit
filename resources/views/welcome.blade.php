@extends('components.dashboard-layout')

@section('content')

    <div class="flex flex-col gap-8 text-center font-jakarta-sans font-semibold text-xl text-gray-800">
        <div class="flex justify-between w-full gap-4">
            <div class="flex-1 bg-teal-500 rounded-md flex flex-col overflow-hidden">
                <div class=" flex flex-col text-left gap-2 px-2 py-6">
                    <p class="text-white">
                        Total Pasien Masuk
                    </p>
                    <p class="text-2xl text-neutral-900">{{ $total_pasien_masuk }} Pasien</p>
                </div>
                <div class="w-full h-8 bg-teal-800"></div>
            </div>
            <div class="flex-1 bg-red-500 rounded-md flex flex-col overflow-hidden">
                <div class=" flex flex-col text-left gap-2 px-2 py-6">
                    <p class="text-white">
                        Total Pasien Keluar
                    </p>
                    <p class="text-2xl text-neutral-900">{{ $total_pasien_keluar }} Pasien</p>
                </div>
                <div class="w-full h-8 bg-red-800"></div>
            </div>
            <div class="flex-1 bg-yellow-500 rounded-md flex flex-col overflow-hidden">
                <div class=" flex flex-col text-left gap-2 px-2 py-6">
                    <p class="text-white">
                        Total Petugas
                    </p>
                    <p class="text-2xl text-neutral-900">{{ $total_petugas }} Petugas</p>
                </div>
                <div class="w-full h-8 bg-yellow-800"></div>
            </div>
            <div class="flex-1 bg-neutral-500 rounded-md flex flex-col overflow-hidden">
                <div class=" flex flex-col text-left gap-2 px-2 py-6 flex-1">
                    <p class="text-white">
                        Waktu
                    </p>
                    <p class="text-2xl text-neutral-900" id="time">--:--:-- WIB</p>
                </div>
                <div class="w-full h-8 bg-neutral-800"></div>
            </div>
        </div>

        {{-- {{ $pasien }} --}}
        <div class="w-full flex gap-4">

            <div class="flex flex-col gap-4 max-w-[60%]">
                <div class=" overflow-x-scroll relative max-w-full rounded-t-2xl">
                    <table class="rounded-t-2xl w-full min-h-full flex-1 shadow-md overflow-hidden table">
                        <thead>
                            <tr class="text-white font-josefin-sans font-medium h-16 text-lg bg-emerald-600">
                                <th class="px-4 text-start w-12">No.</th>
                                <th class="px-4 text-start w-16">Nomor RM</th>
                                <th class="px-4 text-center min-w-32">Tgl Masuk</th>
                                <th class="px-4 text-start min-w-60">Nama Pasien</th>
                                <th class="px-4 text-start min-w-52">Ruangan Dirawat</th>
                                <th class="px-4 text-start min-w-20">Diagnosa</th>
                                <th class="px-4 text-center min-w-52">Jenis Pembayaran</th>
                                <th class="px-4 text-center min-w-32">Tgl Keluar</th>
                                <th class="px-4 text-center min-w-60">Kondisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pasien_dirawats as $pasien)
                                <tr data-entry-id="{{ $pasien->id }}"
                                    class="h-12 text-lg font-josefin-sans font-medium text-neutral-800 border-b border-b-neutral-200/50">
                                    <td class="text-center">
                                        {{ ($pasien_dirawats->currentPage() - 1) * $pasien_dirawats->links()->paginator->perPage() + $loop->iteration }}
                                    <td class="px-4">{{ $pasien->pasien->no_RM }}</td>
                                    <td class="px-4 text-start">{{ $pasien->tanggal_masuk->toDateString() }}</td>
                                    <td class="px-4 text-start">{{ $pasien->pasien->nama }}</td>
                                    <td class="px-4 text-start">{{ $pasien->dataRuangan->nama_ruangan }}</td>
                                    <td class="px-4 text-center">{{ $pasien->kode_penyakit }}</td>
                                    <td class="px-4 text-start">{{ $pasien->jenisPembayaran->nama_jenis_pembayaran }}</td>
                                    <td class="px-4 text-center">{{ $pasien->tanggal_keluar }}</td>
                                    <td class="px-4 text-start">{{ $pasien->keadaan_keluar }}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">{{ __('Data Empty') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $pasien_dirawats->onEachSide(1)->links('pagination::simple-tailwind') }}
            </div>

            <div class="flex flex-col gap-4 max-w-[40%]">
                <table class="rounded-t-2xl w-full max-h-40 flex-1 shadow-md overflow-hidden table">
                    <thead>
                        <tr class="text-white font-josefin-sans font-medium h-16 text-lg bg-emerald-600">
                            <th class="px-4 text-center ">BOR</th>
                            <th class="px-4 text-center ">AvLOS</th>
                            <th class="px-4 text-center ">TOI</th>
                            <th class="px-4 text-center ">BTO</th>
                            <th class="px-4 text-center ">GDR</th>
                            <th class="px-4 text-center ">NDR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($indikator_ri)
                            <tr class="h-24">
                                <td class="px-4 text-center border border-neutral-200">{{ $indikator_ri->nilai_bor }}</td>
                                <td class="px-4 text-center border border-neutral-200">{{ $indikator_ri->nilai_alos }}</td>
                                <td class="px-4 text-center border border-neutral-200">{{ $indikator_ri->nilai_toi }}</td>
                                <td class="px-4 text-center border border-neutral-200">{{ $indikator_ri->nilai_bto }}</td>
                                <td class="px-4 text-center border border-neutral-200">{{ $indikator_ri->nilai_gdr }}</td>
                                <td class="px-4 text-center border border-neutral-200">{{ $indikator_ri->nilai_ndr }}</td>
                            </tr>
                        @else
                            <tr>
                                <td class="px-4 text-center border border-neutral-200"></td>
                                <td class="px-4 text-center border border-neutral-200"></td>
                                <td class="px-4 text-center border border-neutral-200"></td>
                                <td class="px-4 text-center border border-neutral-200"></td>
                                <td class="px-4 text-center border border-neutral-200"></td>
                                <td class="px-4 text-center border border-neutral-200"></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <table class="rounded-t-2xl w-full max-h-40 flex-1 shadow-md overflow-hidden table">
                    <thead>
                        <tr class="text-white font-josefin-sans font-medium h-16 text-lg bg-emerald-600">
                            <th class="px-4 text-center ">No</th>
                            <th class="px-4 text-center ">ICD 10</th>
                            <th class="px-4 text-center min-w-40">Jenis Penyakit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporan_penyakit as $key => $penyakit)
                            <tr class="h-12">
                                <td class="px-4 text-center border border-neutral-200">{{ $key + 1 }}</td>
                                <td class="px-4 text-center border border-neutral-200">{{ $penyakit->kode_penyakit }}</td>
                                <td class="px-4 text-start border border-neutral-200">{{ $penyakit->jenis_penyakit }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">{{ __('Data Empty') }}</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function showTime() {
            var date = new Date(),
                utc = new Date(Date.UTC(
                    date.getFullYear(),
                    date.getMonth(),
                    date.getDate(),
                    date.getHours() - 7,
                    date.getMinutes(),
                    date.getSeconds()
                ), );

            document.getElementById('time').innerHTML = utc.toLocaleTimeString('en-US', {
                // hour: '2-digit',
                hour12: false,
                // timeZone: 'Asia/Jakarta'
            }) + " WIB";
        }

        setInterval(showTime, 1000);
    </script>
@stop

{{-- @push('head')
@endpush --}}
