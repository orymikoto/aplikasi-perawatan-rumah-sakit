@props(['id' => '', 'id_pasien' => 0, 'daftar_ruangan' => []])

{{-- <div class="w-full h-full"> --}}
<div class="relative">
    <button onclick="showModal(event, '{{ $id }}')" class="px-4 py-2 bg-blue-500 text-white rounded">
        <i class="fa-solid fa-ellipsis"></i>
    </button>

    <div id="{{ $id }}" class="w-full h-full z-10 fixed bg-neutral-900/10 hidden top-0 left-0"
        onclick="hideModal('{{ $id }}')">
        <div id="popup.{{ $id }}"
            class="fixed rounded-lg shadow-lg flex flex-col gap-2 overflow-hidden bg-white z-20">
            <button onclick="showPasienModal('pasien_pindah')"
                class="px-4 py-2 bg-white text-teal-600 hover:text-white hover:bg-teal-600 duration-200">Pasien
                Pindah</button>
            <button onclick="showPasienModal('pasien_keluar')"
                class="px-4 py-2 bg-white text-teal-600 hover:text-white hover:bg-teal-600 duration-200">Pasien
                Keluar</button>
        </div>
    </div>

</div>

<div id="pasien_keluar"
    class="fixed z-10 top-0 left-0 bg-slate-900/10 hidden justify-center items-center w-screen h-screen">
    <div class="p-6 flex flex-col gap-2 rounded-lg bg-white">
        <h3>Pasien Keluar</h3>
        <form action="{{ route('pasien_keluar', $id_pasien) }}" class="flex flex-col gap-2" method="POST">
            @csrf

            <x-input.select title="Kondisi Pasien" name="kondisi" placeholder="Kondisi Pasien..." value=""
                :options="['Keluar - Sembuh', 'Keluar - Belum Sembuh', 'Mati < 48 Jam', 'Mati > 48 Jam']" />
            <div class="flex justify-stretch w-full gap-x-2">
                <x-button.color-button onclick="hidePasienModal('pasien_keluar')" class="flex-1" text="Batal"
                    color="red-600" type="reset" />
                <x-button.color-button text="Simpan" type="submit" class="flex-1" />
            </div>
        </form>
    </div>
</div>

<div id="pasien_pindah"
    class="fixed z-10 top-0 left-0 bg-slate-900/10 hidden justify-center items-center w-screen h-screen">
    <div class="p-6 flex flex-col gap-2 rounded-lg bg-white">
        <h3>Pasien Pindah</h3>
        <form action="{{ route('pasien_pindah', $id_pasien) }}" class="flex flex-col gap-2" method="POST">
            @csrf
            <x-input.select title="Pindah Ruang" name="ruangan" placeholder="Pilih Ruangan Baru..." value=""
                :options="$daftar_ruangan" />
            <div class="flex justify-stretch w-full gap-x-2">
                <x-button.color-button onclick="hidePasienModal('pasien_pindah')" class="flex-1" text="Batal"
                    color="red-600" type="reset" />
                <x-button.color-button text="Simpan" type="submit" class="flex-1" />
            </div>
        </form>
    </div>
</div>


<script>
    function showModal(event, id) {
        const modal = document.getElementById(id);
        const popup_action = document.getElementById(`popup.${id}`)
        popup_action.style.left = `${event.clientX - 100}px`;
        popup_action.style.top = `${event.clientY + 50}px`;
        modal.classList.remove('hidden');
        modal.classList.add('block');
        disableScroll()
    }

    function showPasienModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden')
        modal.classList.add('flex')
    }

    function hidePasienModal(id) {
        const modal = document.getElementById(id);
        modal.classList.add('hidden')
        modal.classList.remove('flex')
    }

    function hideModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('block');
        modal.classList.add('hidden');
        enableScroll()
    }

    // left: 37, up: 38, right: 39, down: 40,
    // spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
    var keys = {
        37: 1,
        38: 1,
        39: 1,
        40: 1
    };

    function preventDefault(e) {
        e.preventDefault();
    }

    function preventDefaultForScrollKeys(e) {
        if (keys[e.keyCode]) {
            preventDefault(e);
            return false;
        }
    }

    // modern Chrome requires { passive: false } when adding event
    var supportsPassive = false;
    try {
        window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
            get: function() {
                supportsPassive = true;
            }
        }));
    } catch (e) {}

    var wheelOpt = supportsPassive ? {
        passive: false
    } : false;
    var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';

    // call this to Disable
    function disableScroll() {
        window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
        window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
        window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
        window.addEventListener('keydown', preventDefaultForScrollKeys, false);
    }

    // call this to Enable
    function enableScroll() {
        window.removeEventListener('DOMMouseScroll', preventDefault, false);
        window.removeEventListener(wheelEvent, preventDefault, wheelOpt);
        window.removeEventListener('touchmove', preventDefault, wheelOpt);
        window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
    }
</script>
