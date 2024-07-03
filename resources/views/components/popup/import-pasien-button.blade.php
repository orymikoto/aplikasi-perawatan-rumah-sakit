@props(['class' => '', 'color' => 'emerald-600', 'text' => ''])

<button id="open_upload_modal"
  {{ $attributes->merge(['class' => 'px-4 py-2 rounded-md bg-' . $color . ' text-white hover:text-' . $color . ' hover:shadow-md hover:bg-white hover:shadow-' . $color . '/50 duration-200' . $class]) }}>
  {{ $text }}
</button>

<div id="upload_modal" class="hidden fixed w-screen h-screen z-30 top-0 left-0 flex flex-col items-center justify-center bg-neutral-900/20">
  <form action="{{ route('import_pasien') }}" class="p-4 relative rounded-2xl gap-y-4 bg-white shadow-md flex flex-col " enctype="multipart/form-data"
    method="POST">
    @csrf
    <p class=" font-semibold text-lg text-emerald-700">Upload File</p>
    <input type="file" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
      class=" w-full border border-neutral-600 focus:border-emerald-600 font-medium rounded-lg py-2 px-4 outline-none" name="file"
      placeholder="Silahkan pilih file..." required>
    <button type="submit"
      class="rounded-md px-6 py-2 mx-auto text-xl bg-emerald-600 text-white hover:bg-white hover:text-emerald-600 hover:shadow-md hover:shadow-emerald-600/50 duration-200">Upload</button>
    <button id="close_upload_modal" type="reset" class="absolute top-0 right-0 p-2 rounded-full hover:text-red-500 text-red-600">
      <i class="fa-solid fa-xmark fa-lg"></i>
    </button>
  </form>
</div>

<script>
  let open_button = document.getElementById("open_upload_modal");
  let close_button = document.getElementById("close_upload_modal");
  let upload_modal = document.getElementById("upload_modal");

  open_button.onclick = () => {
    upload_modal.classList.remove("hidden")
  }

  close_button.onclick = () => {
    upload_modal.classList.add("hidden")
  }
</script>
