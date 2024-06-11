<div id="pasien_keluar" class="fixed z-10 top-0 left-0 bg-slate-900/10 hidden justify-center items-center w-screen h-screen">
  <div class="p-6 flex flex-col gap-2 rounded-lg bg-white">
    <h3>Pasien Keluar</h3>
    <form action="{{ route('pasien_keluar', $id_pasien) }}" class="flex flex-col gap-2" method="POST">
      @csrf

      <x-input.select title="Kondisi Pasien" name="{{ 'kondisi_' . $id_pasien }}" placeholder="Kondisi Pasien..." onchange="checkSelectPasienKeluar(e)"
        value="" :options="['Keluar - Dirujuk', 'Keluar - Sembuh', 'Keluar - Belum Sembuh', 'Mati < 48 Jam', 'Mati > 48 Jam']" />
      <div class="flex justify-stretch w-full gap-x-2">
        <x-button.color-button onclick="hidePasienModal('pasien_keluar')" class="flex-1" text="Batal" color="red-600" type="reset" />
        <x-button.color-button text="Simpan" type="submit" class="flex-1" />
      </div>
    </form>
  </div>
</div>
