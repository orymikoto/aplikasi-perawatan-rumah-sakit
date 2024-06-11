@extends('components.dashboard-layout')

@section('content')
  <div class="flex flex-col justify-start items-start gap-6 h-full overflow-x-clip relative">
    <h1 class="font-josefin-sans font-semibold text-2xl text-emerald-600">Daftar Pasien Keluar</h1>

    <div class=" overflow-x-scroll relative max-w-full">
      <table class="rounded-t-2xl w-full min-h-full flex-1 shadow-md overflow-hidden table ">
        <thead>
          <tr class="text-white font-josefin-sans font-medium h-16 text-lg bg-emerald-600">
            <th class="px-4 text-start w-12">No.</th>
            <th class="px-4 text-start w-16">Nomor RM</th>
            <th class="px-4 text-start min-w-60">Nama Pasien</th>
            <th class="px-4 text-center w-32">Diagnosa</th>
            <th class="px-4 text-center w-16">Lama Dirawat</th>
            <th class="px-4 text-center w-16">Hari Perawatan</th>
            <th class="px-4 text-center min-w-48">Tanggal Keluar</th>
            <th class="px-4 text-center min-w-56">Kondisi</th>
            {{-- <th class="px-4 text-center w-16">Aksi</th> --}}
          </tr>
        </thead>
        <tbody>
          @forelse ($pasien_keluar as $pasien)
            <tr data-entry-id="{{ $pasien->id }}"
              class="h-12 text-lg font-josefin-sans font-medium text-neutral-800 border-b border-b-neutral-200/50">
              <td class="text-center">{{ ($pasien_keluar->currentPage() - 1) * $pasien_keluar->links()->paginator->perPage() + $loop->iteration }}
              <td class="px-4">{{ $pasien->pasien->no_RM }}</td>
              <td class="px-4">{{ $pasien->pasien->nama }}</td>
              <td class="px-4 text-center">{{ $pasien->penyakit->kode_penyakit }}</td>
              <td class="px-4 text-center">
                {{ $pasien->tanggal_keluar ? $pasien->tanggal_keluar->diffInDays($pasien->tanggal_masuk) : Carbon::today()->diffInDays($pasien->tanggal_masuk) }}
              </td>
              <td class="px-4 text-center">
                {{ $pasien->tanggal_keluar ? $pasien->tanggal_keluar->diffInDays($pasien->tanggal_masuk) + 1 : Carbon::today()->diffInDays($pasien->tanggal_masuk) + 1 }}
              </td>
              <td class="px-4 text-center">{{ $pasien->tanggal_keluar->toDateString() ?? '-' }}</td>
              <td class="px-4">{{ $pasien->keadaan_keluar ?? 'Dirawat' }}</td>
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
    {{ $pasien_keluar->links('pagination::simple-tailwind') }}

  </div>
@stop
