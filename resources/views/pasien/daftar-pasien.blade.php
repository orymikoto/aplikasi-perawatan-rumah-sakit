@extends('components.dashboard-layout')

@section('content')
  <div class="flex flex-col justify-start items-start gap-6 h-full overflow-x-clip relative">
    <h1 class="font-josefin-sans font-semibold text-2xl text-emerald-600">Daftar Pasien</h1>

    <div class="flex justify-between w-full font-josefin-sans font-semibold text-lg ">
      <a class="rounded-md px-4 py-2 w-auto bg-emerald-600 text-white hover:bg-white hover:text-emerald-600 hover:shadow-md hover:shadow-emerald-600/50 duration-200 {{ auth()->user()->role == 'KEPALA' ? 'hidden' : '' }}"
        href='{{ route('tambah_pasien') }}'>Tambah Pasien</a>
      <x-popup.import-pasien-button text="Import Data Pasien" />
    </div>
    <form action="{{ route('daftar_pasien') }}" method="GET">
      <div class="flex items-center gap-x-2 px-2 py-1 border border-neutral-400 rounded-md">
        <i class="fa-solid fa-magnifying-glass text-neutral-600"></i>
        <input type="text" name="filter" class="outline-none text-neutral-600 font-jakarta-sans" placeholder="Cari berdasarkan no RM"
          autofocus="true" value="{{ $filter ?? '' }}">
      </div>
    </form>
    <div class=" overflow-x-scroll relative max-w-full">
      <table class="rounded-t-2xl w-full min-h-full flex-1 shadow-md overflow-hidden table">
        <thead>
          <tr class="text-white font-josefin-sans font-medium h-16 text-lg bg-emerald-600">
            <th class="px-4 text-start w-12">No.</th>
            <th class="px-4 text-start min-w-32">Nomor RM</th>
            <th class="px-4 text-start min-w-60">Nama Pasien</th>
            <th class="px-4 text-start min-w-40">Jenis Kelamin</th>
            <th class="px-4 text-start min-w-60">Alamat</th>
            <th class="px-4 text-center min-w-16">Umur</th>
            {{-- <th class="px-4 text-center w-40">Aksi</th> --}}
          </tr>
        </thead>
        <tbody>
          @forelse ($daftar_pasien as $pasien)
            <tr data-entry-id="{{ $pasien->id }}"
              class="h-12 text-lg font-josefin-sans font-medium text-neutral-800 border-b border-b-neutral-200/50">
              <td class="text-center">{{ ($daftar_pasien->currentPage() - 1) * $daftar_pasien->links()->paginator->perPage() + $loop->iteration }}
              </td>
              <td class="px-4 text-center">{{ $pasien->no_RM }}</td>
              <td class="px-4">{{ $pasien->nama }}</td>
              <td class="px-4 text-center">{{ $pasien->jenis_kelamin }}</td>
              <td class="px-4 ">{{ $pasien->alamat }}</td>
              <td class="px-4 text-center">{{ $pasien->umur }}</td>
              {{-- <td class="px-4">
                <div class="flex gap-2 mx-auto justify-center">
                  <button class="bg-red-600 text-white hover:bg-red-500 p-1 px-2 rounded-md">
                    <i class="fa-solid fa-trash w-6 h-6"></i>
                  </button>
                  <a href="#" class="bg-teal-600 flex items-center justify-center text-white hover:bg-teal-500 p-1 px-2 rounded-md">
                    <i class="fa-solid fa-pen w-6 h-6 flex items-center justify-center"></i>
                  </a> --}}
              {{-- <x-popup.ruangan-table-action id="{{ 'modal_popup_' . $pasien->id }}" id_pasien="{{ $pasien->id }}" :daftar_ruangan="$daftar_ruangan" /> --}}
              {{-- </div>
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
    {{ $daftar_pasien->onEachSide(1)->links('pagination::simple-tailwind') }}
  </div>

@stop
