@extends('components.dashboard-layout')

@section('content')
  <div class="flex flex-col justify-start items-start gap-6">
    <h1 class="font-josefin-sans font-semibold text-2xl text-emerald-600">Tambah Pasien Masuk</h1>
    <a href="{{ route('pasiens.index') }}" class="text-blue-600 hover:text-blue-500 font-jakarta-sans font-medium duration-200">
      <div class="flex items-center"> <i class="fa-solid fa-arrow-left w-8"></i>
        <p>Kembali ke halaman daftar pasien masuk</p>
      </div>
    </a>
    <form action="{{ route('pasiens.store') }}" class="flex flex-col gap-2 p-4 rounded-2xl shadow-md xl:w-[540px] " method="POST">
      @csrf
      <div class="flex flex-col gap-2 font-jakarta-sans">
        <div class="flex gap-x-2 items-end">
          <x-input.text title="No. RM" class="flex-1" name="no_rm" placeholder="Nomor RM..." value="" />
          <button type="button" id="cek_rm" class="bg-yellow-600 hover:bg-yellow-500 duration-200 rounded-md px-4 py-2 text-white">Cek</button>
          <button type="reset" id="pasien_baru" class="bg-teal-600 hover:bg-teal-500 duration-200 rounded-md px-4 py-2 text-white">Pasien
            Baru</button>
        </div>
        <p id="pesan_no_rm" class="text-yellow-700">Silahkan cek pasien terlebih dahulu</p>
      </div>
      <x-input.text title="Nama Pasien" name="nama_pasien" placeholder="Nama Pasien .." value="" />
      <x-input.number title="Usia" name="umur" placeholder="Usia Pasien..." value="" />
      <x-input.select title="Jenis Kelamin" name="jenis_kelamin" placeholder="Pilih jenis kelamin pasien" :options="['LAKI - LAKI', 'PEREMPUAN']" />
      <x-input.text title="Alamat" name="alamat" placeholder="Alamat Pasien..." value="" />
      <div class="flex flex-col">
        <div class="form-group flex flex-col font-jakarta-sans gap-2">
          <label for="nama_dokter" class="text-emerald-600 text-lg font-semibold">ID Dokter</label>
          <input id="nama_dokter" name="nama_dokter" type="text" list="daftar_dokter_fieldlist"
            class=" w-full border border-neutral-600 focus:border-emerald-600 font-medium rounded-lg py-2 px-4 outline-none"
            placeholder="Nama Dokter...">
          <datalist id="daftar_dokter_fieldlist">
            @foreach ($daftar_dokter as $key => $value)
              <option value="{{ $value->id }}">
                {{ $value->nama_dokter }}</option>
            @endforeach
          </datalist>
          <span id="error" class="text-danger"></span>
        </div>
      </div>
      <div class="flex flex-col">
        <div class="form-group flex flex-col font-jakarta-sans gap-2">
          <label for="kode_penyakit" class="text-emerald-600 text-lg font-semibold">Kode Penyakit</label>
          <input id="kode_penyakit" name="kode_penyakit" type="text" list="kode_penyakit_fieldlist"
            class=" w-full border border-neutral-600 focus:border-emerald-600 font-medium rounded-lg py-2 px-4 outline-none"
            placeholder="Kode Penyakit...">
          <datalist id="kode_penyakit_fieldlist">
            @foreach ($daftar_penyakit as $key => $value)
              <option value="{{ $value->kode_penyakit }}">
                {{ $value->kode_penyakit . ' - ' . $value->nama_penyakit }}</option>
            @endforeach
          </datalist>
          <span id="error" class="text-danger"></span>
        </div>
      </div>
      <x-input.select title="Ruangan" name="ruangan" placeholder="Ruangan..." value="" :options="$daftar_ruangan" />
      <x-input.select title="Jenis Pembayaran" name="jenis_pembayaran" placeholder="Pilih tipe jenis pembayaran" value="" :options="[
          'BPJS DINAS - ANGKATAN LAIN KELUARGA',
          'BPJS DINAS - ANGKATAN LAIN PNS',
          'BPJS DINAS - TNI AD KELUARGA',
          'BPJS DINAS - TNI AD MILITER',
          'BPJS DINAS - TNI AD MILITER BANMIN',
          'BPJS DINAS - TNI AD MILITER SATPUR',
          'BPJS DINAS - TNI AD PNS',
          'BPJS MANDIRI',
          'BPJS PBI',
          'BPJS PENSIUNAN TNI',
          'BPJS PENSIUNAN UMUM',
          'UMUM',
          'YANKES TELKOM',
      ]" />
      <x-input.date title="Tanggal Masuk" name="tanggal_masuk" placeholder="Pilih tanggal masuk" />
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
  <script>
    const cek_rm = document.getElementById('cek_rm');
    const pasien_baru = document.getElementById('pasien_baru');
    const input_nama_pasien = document.getElementsByName("nama_pasien")[0].readOnly = true;
    const input_usia = document.getElementsByName("umur")[0].readOnly = true;
    const input_jenis_kelamin = document.getElementsByName("jenis_kelamin")[0].classList.add("pointer-events-none");
    const input_alamat = document.getElementsByName("alamat")[0].readOnly = true;
    const input_nama_dokter = document.getElementsByName("nama_dokter")[0].disabled = true;
    const input_kode_penyakit = document.getElementsByName("kode_penyakit")[0].disabled = true;
    const input_ruangan = document.getElementsByName("ruangan")[0].disabled = true;
    const input_jenis_pembayaran = document.getElementsByName("jenis_pembayaran")[0].disabled = true;
    const input_tanggal_masuk = document.getElementsByName("tanggal_masuk")[0].disabled = true;




    cek_rm.onclick = function() {
      const nomor_rm = document.getElementsByName('no_rm')[0].value;

      if (nomor_rm == "") {
        document.getElementById("pesan_no_rm").innerText = "Silahkan isi nomor rm!"
        document.getElementById("pesan_no_rm").classList = "text-red-600";
        return
      }
      // console.log("test", nomor_rm);
      fetch(`/pasiens/check-rm/${nomor_rm}`, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'url': `/pasiens/check-rm/${nomor_rm}`,
        },
      }).then(response => response.json()).then(res => {
        // console.log(res)
        if (!res.error) {
          let nama_pasien = document.getElementsByName('nama_pasien')[0].value = res.nama;
          let usia = document.getElementsByName('umur')[0].value = res.umur;
          let jenis_kelamin = document.getElementsByName('jenis_kelamin')[0].value = res
            .jenis_kelamin;

          let alamat = document.getElementsByName('alamat')[0].value = res.alamat;
          document.getElementsByName("nama_dokter")[0].disabled = false;
          document.getElementsByName("kode_penyakit")[0].disabled = false;
          document.getElementsByName("ruangan")[0].disabled = false;
          document.getElementsByName("jenis_pembayaran")[0].disabled = false;
          document.getElementsByName("tanggal_masuk")[0].disabled = false;
          document.getElementById("pesan_no_rm").innerText =
            `Data pasien atas nama ${res.nama} ditemukan!`;
          document.getElementById("pesan_no_rm").classList = "text-emerald-600";
          document.getElementById("submit_button").removeAttribute("disabled")

        } else {
          document.getElementById("pesan_no_rm").innerText =
            "Data pasien tidak ditemukan, silahkan tambah pasien baru!"
          document.getElementById("pesan_no_rm").classList = "text-red-600";
          document.getElementById("submit_button").setAttribute("disabled")
        }
      })
    }

    pasien_baru.onclick = function() {
      document.getElementsByName("nama_pasien")[0].readOnly = false;
      document.getElementsByName("umur")[0].readOnly = false;
      document.getElementsByName("jenis_kelamin")[0].classList.remove("pointer-events-none");
      document.getElementsByName("alamat")[0].readOnly = false;
      document.getElementsByName("nama_dokter")[0].disabled = false;
      document.getElementsByName("kode_penyakit")[0].disabled = false;
      document.getElementsByName("ruangan")[0].disabled = false;
      document.getElementsByName("jenis_pembayaran")[0].disabled = false;
      document.getElementsByName("tanggal_masuk")[0].disabled = false;
      document.getElementById("pesan_no_rm").innerText = "";
      document.getElementById("submit_button").removeAttribute("disabled");
    }
  </script>
@stop
