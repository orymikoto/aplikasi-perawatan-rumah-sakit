@extends('components.dashboard-layout')

@section('content')
    <div class="flex flex-col justify-start items-start gap-6">
        <h1 class="font-josefin-sans font-semibold text-2xl text-emerald-600">Edit Petugas</h1>
        <a href="{{ route('pengguna.index') }}"
            class="text-blue-600 hover:text-blue-500 font-jakarta-sans font-medium duration-200">
            <div class="flex items-center"> <i class="fa-solid fa-arrow-left w-8"></i>
                <p>Kembali ke halaman daftar petugas</p>
            </div>
        </a>
        <form class="flex flex-col gap-4 p-4 rounded-2xl shadow-md xl:w-[480px] ">
            <x-input.text title="Nama" name="nama" placeholder="Nama..." value="" />
            <x-input.text title="Email" name="email" placeholder="Email..." value="" />
            <x-input.select title="Tipe" name="role" placeholder="Pilih tipe pengguna" value=""
                :options="['kepala', 'perawat', 'petugas']" />
            <x-input.password placeholder="Pasword Baru..." title="Password" name="password" />
            <div class="flex items-center self-end gap-4">
                <a href="{{ url()->previous() }}"
                    class="py-2 px-4 font-jakarta-sans font-semibold rounded-lg bg-red-600 text-white hover:shadow-md hover:bg-white hover:shadow-red-600/50 hover:text-red-600 duration-200">Batal</a>
                <button type="submit"
                    class="py-2 px-4 font-jakarta-sans font-semibold rounded-lg bg-emerald-600 text-white hover:shadow-md hover:bg-white hover:shadow-emerald-600/50 hover:text-emerald-600 duration-200">Simpan</button>
            </div>
        </form>
    </div>
@stop
