@extends('components.dashboard-layout')

@section('content')
  <div class="flex flex-col justify-start items-start gap-6">
    <h1 class="font-josefin-sans font-semibold text-2xl text-emerald-600">Tambah Petugas</h1>
    <a href="{{ route('pengguna.index') }}" class="text-blue-600 hover:text-blue-500 font-jakarta-sans font-medium duration-200">
      <div class="flex items-center"> <i class="fa-solid fa-arrow-left w-8"></i>
        <p>Kembali ke halaman daftar petugas</p>
      </div>
    </a>
    <form class="flex flex-col gap-4 p-4 rounded-2xl shadow-md xl:w-[480px] " action="{{ route('pengguna.store') }}" method="POST"
      enctype="multipart/form-data">
      @csrf
      <x-input.text title="Nama" name="nama" placeholder="Nama..." value="" />
      <x-input.text title="Email" name="email" type="email" placeholder="Email..." value="" />
      <x-input.text title="Nomor Telepon" name="no_hp" type="tel" placeholder="Nomor Telepon..." value="" />
      <x-input.select title="Tipe" name="role" placeholder="Pilih tipe pengguna" value="" :options="['ADMIN', 'PERAWAT', 'PETUGAS']" />
      <div id="ruangan" class=' hidden flex-col gap-2 font-jakarta-sans '>
        <p class="text-emerald-600 text-lg font-semibold">Ruangan</p>
        <select id="ruangan_select" name="data_ruangan[]" multiple="multiple"
          class="form-select w-full border border-neutral-600 focus:border-emerald-600 font-medium rounded-lg py-2 px-3 outline-none">
          @foreach ($data_ruangan as $e)
            <option value="{{ $e->id }}"> {{ $e->nama_ruangan }}
            </option>
          @endforeach
        </select>
      </div>
      <x-input.password placeholder="Pasword..." title="Password" name="password" />
      <x-input.password placeholder="Confirm Pasword..." title="Password Verivication" name="password_confirmation" />
      <div class="flex items-center self-end gap-4">
        <a href="{{ url()->previous() }}"
          class="py-2 px-4 font-jakarta-sans font-semibold rounded-lg bg-red-600 text-white hover:shadow-md hover:bg-white hover:shadow-red-600/50 hover:text-red-600 duration-200">Batal</a>
        <button type="submit"
          class="py-2 px-4 font-jakarta-sans font-semibold rounded-lg bg-emerald-600 text-white hover:shadow-md hover:bg-white hover:shadow-emerald-600/50 hover:text-emerald-600 duration-200">Simpan</button>
      </div>
    </form>
  </div>

  <script type="module">
    const role_select = document.getElementsByName("role")[0]
    role_select.onchange = function(e) {
      if (e.target.value == "PERAWAT") {
        document.getElementById("ruangan").classList.remove("hidden");
        document.getElementById("ruangan").classList.add("flex");
        document.getElementsByName("data_ruangan[]")[0].required = true;
      } else {
        document.getElementById("ruangan").classList.remove("flex"); +
        document.getElementById("ruangan").classList.add("hidden");
        document.getElementsByName("data_ruangan[]")[0].required = false;
        document.getElementsByName("data_ruangan[]")[0].value = null;
      }
    }

    $('#ruangan_select').select2({
      tokenSeparators: [',', ' '],
      placeholder: "Silahkan tambahkan ruangan perawat...",
      selectionCssClass: "w-full border border-neutral-600 focus:border-emerald-600 font-medium rounded-lg py-2 px-3 outline-none"
    });
  </script>
@stop
