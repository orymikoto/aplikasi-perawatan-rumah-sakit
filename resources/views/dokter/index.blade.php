@extends('components.dashboard-layout')

@section('content')
  <div class="flex flex-col justify-start items-start gap-6 h-full">
    <h1 class="font-josefin-sans font-semibold text-2xl text-emerald-600">Daftar Dokter</h1>
    <a class="rounded-md px-4 py-2 w-auto font-josefin-sans font-semibold text-lg bg-emerald-600 text-white hover:bg-white hover:text-emerald-600 hover:shadow-md hover:shadow-emerald-600/50 duration-200"
      href='{{ route('daftar-dokter.create') }}'>Tambah Dokter</a>
    <table class="rounded-t-2xl w-full min-h-full flex-1 shadow-md overflow-hidden table ">
      <thead>
        <tr class="text-white font-josefin-sans font-medium h-16 text-lg bg-emerald-600">
          <th class="px-4 text-start w-16">No</th>
          <th class="px-4 text-start">Nama Dokter</th>
          <th class="px-4 text-start">No Hp</th>
          <th class="px-4 text-start">Alamat</th>
          <th class="px-4 text-start">Dikum</th>
          <th class="px-4 text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($daftar_dokter as $key => $dokter)
          <tr data-entry-id="{{ $dokter->id }}" class="h-12 text-lg font-josefin-sans font-medium text-neutral-800 border-b border-b-neutral-200/50">
            <td class="px-4">{{ $key + 1 }}</td>
            <td class="px-4">{{ $dokter->nama_dokter }}</td>
            <td class="px-4">{{ $dokter->No_hp}}</td>
            <td class="px-4">{{ $dokter->Alamat }}</td>
            <td class="px-4">{{ $dokter->DIKUM }}</td>
            <td class="px-4">
              <div class="flex gap-2 mx-auto justify-center">
                <form action="{{ route('daftar-dokter.destroy', [$dokter->id]) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="flex justify-center items-center bg-red-600 text-white hover:bg-red-500 p-1 px-2 rounded-md">
                    <i class="fa-solid fa-trash w-6 h-6 flex justify-center items-center"></i>
                  </button>
                </form>
                <a href="{{ route('daftar-dokter.edit', $dokter->id) }}"
                  class="flex justify-center items-center bg-teal-600 text-white hover:bg-teal-500 p-1 px-2 rounded-md">
                  <i class="fa-solid fa-pen w-6 h-6 flex justify-center items-center"></i>
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
