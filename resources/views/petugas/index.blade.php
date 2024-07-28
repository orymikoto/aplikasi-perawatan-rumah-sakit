@extends('components.dashboard-layout')

@section('content')
  <div class="flex flex-col justify-start items-start gap-6 h-full">
    <h1 class="font-josefin-sans font-semibold text-2xl text-emerald-600">Daftar Petugas</h1>
    <a class="rounded-md px-4 py-2 w-auto font-josefin-sans font-semibold text-lg bg-emerald-600 text-white hover:bg-white hover:text-emerald-600 hover:shadow-md hover:shadow-emerald-600/50 duration-200"
      href='{{ route('pengguna.create') }}''>Tambah
      petugas</a>
    <table class="rounded-t-2xl w-full min-h-full flex-1 shadow-md overflow-hidden table ">
      <thead>
        <tr class="text-white font-josefin-sans font-medium h-16 text-lg bg-emerald-600">
          <th class="px-4 text-start">Nama Petugas</th>
          <th class="px-4 text-start">Email</th>
          <th class="px-4 text-start w-40">Tipe</th>
          <th class="px-4 text-center w-48">Ruangan Perawat</th>
          <th class="px-4 text-center w-40">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($penggunas as $pengguna)
          <tr data-entry-id="{{ $pengguna->id }}" class="h-12 text-lg font-josefin-sans font-medium text-neutral-800 border-b border-b-neutral-200/50">
            <td class="px-4">{{ $pengguna->nama }}</td>
            <td class="px-4">{{ $pengguna->email }}</td>
            <td class="px-4">{{ $pengguna->role }}</td>
            <td class="px-4 text-start">
              @if ($pengguna->ruanganPerawat)
                @foreach ($pengguna->ruanganPerawat as $ruangan_perawat)
                  {{ $ruangan_perawat->dataRuangan->nama_ruangan . ', ' }}
                @endforeach
              @else
                -
              @endif
            </td>
            <td class="px-4">
              <div class="flex gap-2 mx-auto justify-center">
                <form action="{{ route('pengguna.destroy', $pengguna->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="bg-red-600 text-white flex items-center justify-center hover:bg-red-500 p-1 px-2 rounded-md">
                    <i class="fa-solid fa-trash "></i>
                  </button>
                </form>
                <a href="{{ route('pengguna.edit', $pengguna->id) }}"
                  class="justify-center items-center bg-teal-600 flex text-white hover:bg-teal-500 p-1 px-2 rounded-md">
                  <i class="fa-solid fa-pen w-6 h-6 m-auto flex items-center justify-center"></i>
                </a>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="9" class="text-center">{{ __('Data Empty') }}</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@stop
