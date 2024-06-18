<div class="flex flex-col h-full min-h-[80vh] p-4 bg-white shadow-md rounded-[2rem] w-[25%]">
  {{-- Profil Pengguna --}}
  <div class="flex items-center gap-4 my-8 ">
    <div class="rounded-full w-16 h-16 shadow-md border border-neutral-400 hover:border-blue-800 duration-200 overflow-hidden">
      <img src="{{ auth()->user()->foto_profil }}" class="w-full h-full object-cover" alt="Foto Profil">
    </div>
    <div class="flex flex-col items-start text-emerald-800">
      <p class="font-jakarta-sans font-bold line-clamp-1">{{ auth()->user()->nama }}</p>
      <p class="font-josefin-sans font-normal text-neutral-600">{{ auth()->user()->role }}</p>
    </div>
  </div>

  {{-- Menu --}}
  <div class="flex flex-1 flex-col gap-2">
    {{-- {{ request()->path() }} --}}
    <a href="/"
      class="{{ request()->path() == '/' ? 'flex items-center gap-4 rounded-lg px-2 py-2 text-emerald-600 bg-emerald-300/50' : 'flex items-center gap-4 rounded-lg px-2 py-2 text-neutral-400 hover:text-emerald-600 hover:bg-neutral-200 duration-200' }} ">
      <i class="fa-solid fa-house fa-lg w-8"></i>
      <p class="font-jakarta-sans font-semibold">Dashboard
      </p>
    </a>
    <a href="{{ route('pengguna.index') }}"
      class="flex items-center gap-4 rounded-lg px-2 py-2 {{ explode('/', request()->path())[0] == 'pengguna'
          ? 'text-emerald-600 bg-emerald-300/50'
          : 'text-neutral-400 hover:text-emerald-600 hover:bg-neutral-200 duration-200' }} {{ auth()->user()->role != 'ADMIN' && auth()->user()->role != 'KEPALA' ? 'hidden' : '' }}">
      <i class="fa-solid fa-users fa-lg w-8 "></i>
      <p href="" class="font-jakarta-sans font-semibold">Data Petugas</p>
    </a>
    <a href="{{ route('ruangan.index') }}"
      class="flex items-center gap-4 rounded-lg px-2 py-2 {{ explode('/', request()->path())[0] == 'ruangan'
          ? 'text-emerald-600 bg-emerald-300/50'
          : 'text-neutral-400 hover:text-emerald-600 hover:bg-neutral-200 duration-200' }}
          {{ auth()->user()->role != 'ADMIN' && auth()->user()->role != 'KEPALA' ? 'hidden' : '' }}
          ">
      <i class="fa-regular fa-hospital fa-lg w-8"></i>
      <p class="font-jakarta-sans font-semibold">Data Ruangan</p>
    </a>
    <a href="{{ route('pasiens.index') }}"
      class="flex items-center gap-4 rounded-lg px-2 py-2 {{ explode('/', request()->path())[0] == 'pasiens'
          ? 'text-emerald-600 bg-emerald-300/50'
          : 'text-neutral-400 hover:text-emerald-600 hover:bg-neutral-200 duration-200' }}
          {{ auth()->user()->role != 'ADMIN' && auth()->user()->role != 'KEPALA' && auth()->user()->role != 'PERAWAT' ? 'hidden' : '' }}
          ">
      <i class="fa-solid fa-door-open fa-lg w-8"></i>
      <p class="font-jakarta-sans font-semibold">Pasien Masuk</p>
    </a>
    <a href="{{ route('daftar_pasien_keluar') }}"
      class="flex items-center gap-4 rounded-lg px-2 py-2 {{ explode('/', request()->path())[0] == 'pasien-keluar'
          ? 'text-emerald-600 bg-emerald-300/50'
          : 'text-neutral-400 hover:text-emerald-600 hover:bg-neutral-200 duration-200' }}
          {{ auth()->user()->role != 'ADMIN' && auth()->user()->role != 'KEPALA' && auth()->user()->role != 'PERAWAT' ? 'hidden' : '' }}
          ">
      <i class="fa-solid fa-door-closed fa-lg w-8"></i>
      <p class="font-jakarta-sans font-semibold">Pasien Keluar</p>
    </a>
    <a href="{{ route('daftar_pasien_pindah') }}"
      class="flex items-center gap-4 rounded-lg px-2 py-2 {{ explode('/', request()->path())[0] == 'pasien-pindah'
          ? 'text-emerald-600 bg-emerald-300/50'
          : 'text-neutral-400 hover:text-emerald-600 hover:bg-neutral-200 duration-200' }}
          {{ auth()->user()->role != 'ADMIN' && auth()->user()->role != 'KEPALA' && auth()->user()->role != 'PERAWAT' ? 'hidden' : '' }}
          ">
      <i class="fa-solid fa-arrow-right-arrow-left fa-lg w-8"></i>
      <p class="font-jakarta-sans font-semibold">Pasien Pindah</p>
    </a>
    <a href="{{ route('laporan_penyakit') }}"
      class="flex items-center gap-4 rounded-lg px-2 py-2 {{ explode('/', request()->path())[0] == 'laporan'
          ? 'text-emerald-600 bg-emerald-300/50'
          : 'text-neutral-400 hover:text-emerald-600 hover:bg-neutral-200 duration-200' }}
          {{ auth()->user()->role != 'ADMIN' && auth()->user()->role != 'KEPALA' && auth()->user()->role != 'PETUGAS' ? 'hidden' : '' }}
          ">
      <i class="fa-solid fa-file-contract fa-lg w-8"></i>
      <p class="font-jakarta-sans font-semibold">Laporan</p>
    </a>
  </div>

  <a href="{{ route('logout') }}"
    class="flex items-center justify-self-end my-4 gap-4 px-2 py-2 cursor-pointer w-36 rounded-lg text-red-400 hover:text-red-600 hover:bg-red-200 duration-200">
    <i class="fa-solid fa-arrow-right-from-bracket fa-xl"></i>
    <p class="font-jakarta-sans font-semibold">Keluar</p>
  </a>
</div>
