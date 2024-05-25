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
                    <th class="px-4 text-center w-40">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="h-12 text-lg font-josefin-sans font-medium text-neutral-800">
                    <td class="px-4">Bagas</td>
                    <td class="px-4">bagas@mail.com</td>
                    <td class="px-4">Admin</td>
                    <td class="px-4">
                        <div class="flex gap-2 mx-auto justify-center">
                            <button class="bg-red-600 text-white hover:bg-red-500 p-1 px-2 rounded-md">
                                <i class="fa-solid fa-trash w-8"></i>
                            </button>
                            <a href="{{ route('pengguna.edit', 1) }}"
                                class="bg-teal-600 text-white hover:bg-teal-500 p-1 px-2 rounded-md">
                                <i class="fa-solid fa-pen w-8"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@stop
