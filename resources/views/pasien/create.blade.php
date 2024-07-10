@extends('components.dashboard-layout')

@section('content')
  <div class="flex flex-col justify-start items-start gap-6">
    <h1 class="font-josefin-sans font-semibold text-2xl text-emerald-600">Tambah Pasien Masuk</h1>
    <a href="{{ route('daftar_pasien') }}" class="text-blue-600 hover:text-blue-500 font-jakarta-sans font-medium duration-200">
      <div class="flex items-center"> <i class="fa-solid fa-arrow-left w-8"></i>
        <p>Kembali ke halaman daftar pasien</p>
      </div>
    </a>
    <form action="{{ route('tambah_pasien_post') }}" class="flex flex-col gap-2 p-4 rounded-2xl shadow-md xl:w-[540px] " method="POST">
      @csrf

      <x-input.text title="No. RM" name="no_rm" placeholder="Nomor RM..." value="" />
      <x-input.text title="Nama Pasien" name="nama_pasien" placeholder="Nama Pasien .." value="" />
      <x-input.number title="Usia" name="umur" placeholder="Usia Pasien..." value="" />
      <x-input.select title="Jenis Kelamin" name="jenis_kelamin" placeholder="Pilih jenis kelamin pasien" :options="['LAKI - LAKI', 'PEREMPUAN']" />
      <x-input.text title="Alamat" name="alamat" placeholder="Alamat Pasien..." value="" />
      <div class="flex items-center self-end gap-4 my-4">
        <a href="{{ url()->previous() }}"
          class="py-2 px-4 font-jakarta-sans font-semibold rounded-lg bg-red-600 text-white hover:shadow-md hover:bg-white hover:shadow-red-600/50 hover:text-red-600 duration-200">Batal</a>
        <button id="submit_button" type="submit"
          class="py-2  px-4 font-jakarta-sans font-semibold rounded-lg bg-emerald-600 text-white hover:shadow-md hover:bg-white hover:shadow-emerald-600/50 hover:text-emerald-600 duration-200">Simpan</button>
      </div>
    </form>
  </div>

  {{-- <script>
    const kode_penyakit_input = document.getElementById('kode_penyakit');

    kode_penyakit_input.oninput = function(e) {
      // console.log("tex");
      fetch(`/pasien/check-kode-penyakit/${e.target.value}`, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'url': `/pasien/check-kode-penyakit/${e.target.value}`,
        },
      }).then(response => response.json()).then(res => {
        console.log(document.getElementById("kode_penyakit_fieldlist").data)
        res.data.forEach(value => {
          document.getElementById("kode_penyakit_fieldlist")
        })
        // alert(kode_penyakit_input)
      })
    }
  </script> --}}

@stop
