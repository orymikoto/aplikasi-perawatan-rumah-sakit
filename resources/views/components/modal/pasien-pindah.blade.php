<div id="pasien_pindah" class="fixed z-10 top-0 left-0 bg-slate-900/10 hidden justify-center items-center w-screen h-screen">
  <div class="p-6 flex flex-col gap-2 rounded-lg bg-white">
    <h3>Pasien Pindah</h3>
    <form action="{{ route('pasien_pindah', $id_pasien) }}" class="flex flex-col gap-2" method="POST">
      @csrf
      <x-input.select title="Pindah Ruang" name="ruangan" placeholder="Pilih Ruangan Baru..." value="" :options="$daftar_ruangan" />
      <div class="flex justify-stretch w-full gap-x-2">
        <x-button.color-button onclick="hidePasienModal('pasien_pindah')" class="flex-1" text="Batal" color="red-600" type="reset" />
        <x-button.color-button text="Simpan" type="submit" class="flex-1" />
      </div>
    </form>
  </div>
</div>
