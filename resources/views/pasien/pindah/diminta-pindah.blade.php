@extends('components.dashboard-layout')

@section('content')
  <div class="flex flex-col justify-start items-start gap-6 overflow-x-clip h-full relative">
    <h1 class="font-josefin-sans font-semibold text-2xl text-emerald-600">Daftar Permintaan Pindah Ruangan Pasien</h1>
    <x-flash::message />

    <div class="flex gap-4">
      <a href="{{ route('daftar_pasien_pindah') }}"
        class="px-4 py-2 w-60 rounded-md text-white hover:shadow-md text-center text-lg font-josefin-sans font-medium hover:bg-white bg-emerald-600 hover:text-emerald-600 hover:shadow-emerald-400/50 duration-200 ">Daftar
        Pasien Dipindah</a>
      <a href="{{ route('daftar_pasien_diminta_pindah') }}"
        class="px-4 py-2 w-60 rounded-md text-white hover:shadow-md text-center text-lg font-josefin-sans font-medium hover:bg-white bg-emerald-600 hover:text-emerald-600 hover:shadow-emerald-400/50 duration-200 ">Permintaan
        Pindah</a>
    </div>
    <div class="max-w-full relative overflow-x-scroll">
      <table class="rounded-t-2xl w-full min-h-full flex-1 shadow-md overflow-hidden table ">
        <thead>
          <tr class="text-white font-josefin-sans font-medium h-16 text-lg bg-emerald-600">
            <th class="px-4 text-start w-12">No.</th>
            <th class="px-4 text-start w-16">Nomor RM</th>
            <th class="px-4 text-start min-w-60">Nama Pasien</th>
            <th class="px-4 text-start min-w-52">Ruang Lama</th>
            <th class="px-4 text-start min-w-52">Ruang Baru</th>
            <th class="px-4 text-start min-w-20 ">Diagnosa</th>
            <th class="px-4 text-center min-w-48">Tgl Diminta</th>
            <th class="px-4 text-center min-w-40">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($daftar_pasien_pindah as $pasien)
            <tr data-entry-id="{{ $pasien->id }}"
              class="h-12 text-lg font-josefin-sans font-medium text-neutral-800 border-b border-b-neutral-200/50">
              <td class="text-center">
                {{ ($daftar_pasien_pindah->currentPage() - 1) * $daftar_pasien_pindah->links()->paginator->perPage() + $loop->iteration }}
              </td>
              <td class="px-4">{{ $pasien->pasienDirawat->pasien->no_RM }}</td>
              <td class="px-4">{{ $pasien->pasienDirawat->pasien->nama }}</td>
              <td class="px-4">{{ $pasien->ruanganLama->nama_ruangan }}</td>
              <td class="px-4">{{ $pasien->ruanganBaru->nama_ruangan }}</td>
              <td class="px-4">{{ $pasien->pasienDirawat->kode_penyakit }}</td>
              <td class="px-4 text-center">{{ $pasien->tanggal_pindah->toDateString() }}</td>
              <td class="px-4 text-center">
                <div class="flex gap-2">
                  <a href="{{ route('setujui_pindah', $pasien->id) }}"
                    class="px-2 py-1 rounded-md text-white hover:shadow-md text-center font-josefin-sans font-medium hover:bg-white bg-emerald-600 hover:text-emerald-600 hover:shadow-emerald-400/50 duration-200 ">Setujui</a>
                  <a href="{{ route('tolak_pindah', $pasien->id) }}"
                    class="px-2 py-1 rounded-md text-white hover:shadow-md text-center font-josefin-sans font-medium hover:bg-white bg-red-600 hover:text-red-600 hover:shadow-red-400/50 duration-200 ">Tolak</a>

                </div>
              </td>
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
    {{ $daftar_pasien_pindah->onEachSide(1)->links('pagination::simple-tailwind') }}

  </div>
@stop
