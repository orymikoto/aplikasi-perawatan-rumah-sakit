<div class="flex flex-col h-full min-h-[80vh] p-4 bg-white shadow-md rounded-[2rem] xl:w-[375px] lg:w-[325px] w-[300px]">
    {{-- Profil Pengguna --}}
    <div class="flex items-center gap-4 my-8 ">
        <div class="rounded-full w-20 shadow-md border border-neutral-400 hover:border-blue-800 duration-200">
            <img src="/logo.png" class="w-full h-full object-cover" alt="Foto Profil">
        </div>
        <div class="flex flex-col items-start text-emerald-800">
            <p class="font-jakarta-sans font-bold line-clamp-1">Username</p>
            <p class="font-josefin-sans font-normal text-neutral-600">Role</p>
        </div>
    </div>

    {{-- Menu --}}
    <div class="flex flex-col gap-2">
        <div
            class="flex items-center gap-4 rounded-lg px-2 py-2 text-neutral-400 hover:text-emerald-600 hover:bg-neutral-200 duration-200">
            <i class="fa-solid fa-house fa-lg w-8"></i>
            <a href="" class="font-jakarta-sans font-semibold">Dashboard</a>
        </div>
        <div
            class="flex items-center gap-4 rounded-lg px-2 py-2 text-neutral-400 hover:text-emerald-600 hover:bg-neutral-200 duration-200">
            <i class="fa-solid fa-users fa-lg w-8 "></i>
            <a href="" class="font-jakarta-sans font-semibold">Data Petugas</a>
        </div>
        <div
            class="flex items-center gap-4  rounded-lg px-2 py-2 text-neutral-400 hover:text-emerald-600 hover:bg-neutral-200 duration-200">
            <i class="fa-regular fa-hospital fa-lg w-8"></i>
            <a href="" class="font-jakarta-sans font-semibold">Data Ruangan</a>
        </div>
        <div
            class="flex items-center gap-4  rounded-lg px-2 py-2 text-neutral-400 hover:text-emerald-600 hover:bg-neutral-200 duration-200">
            <i class="fa-solid fa-door-open fa-lg w-8"></i>
            <a href="" class="font-jakarta-sans font-semibold">Pasien Masuk</a>
        </div>
        <div
            class="flex items-center gap-4  rounded-lg px-2 py-2 text-neutral-400 hover:text-emerald-600 hover:bg-neutral-200 duration-200">
            <i class="fa-solid fa-door-closed fa-lg w-8"></i>
            <a href="" class="font-jakarta-sans font-semibold">Pasien Keluar</a>
        </div>
        <div
            class="flex items-center gap-4  rounded-lg px-2 py-2 text-neutral-400 hover:text-emerald-600 hover:bg-neutral-200 duration-200">
            <i class="fa-solid fa-arrow-right-arrow-left fa-lg w-8"></i>
            <a href="" class="font-jakarta-sans font-semibold">Pasien Pindah</a>
        </div>
        <div
            class="flex items-center gap-4  rounded-lg px-2 py-2 text-neutral-400 hover:text-emerald-600 hover:bg-neutral-200 duration-200">
            <i class="fa-solid fa-file-contract fa-lg w-8"></i>
            <a href="" class="font-jakarta-sans font-semibold">Laporan</a>
        </div>
    </div>
</div>
