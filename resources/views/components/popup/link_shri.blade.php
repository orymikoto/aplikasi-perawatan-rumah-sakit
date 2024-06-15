@props(['id' => '', 'daftar_ruangan' => []])

{{-- <div class="w-full h-full"> --}}
<div class="relative">
    <button onclick="showModal(event, '{{ $id }}')"
        class="rounded-md bg-emerald-600 w-60 text-center py-2 text-white text-lg font-josefin-sans hover:bg-white hover:text-emerald-600 hover:shadow-md hover:shadow-teal-400/75 duration-200">
        Rekapitulasi SHRI</button>

    <div id="{{ $id }}" class="w-full h-full z-10 fixed bg-neutral-900/10 hidden top-0 left-0"
        onclick="hideModal('{{ $id }}')">
        <div id="popup.{{ $id }}"
            class="fixed rounded-lg shadow-lg flex flex-col  gap-2 overflow-hidden bg-white z-20">
            {{-- <button onclick="showPasienModal('pasien_pindah_{{ $id_pasien }}')"
                class="px-4 py-2 bg-white text-teal-600 hover:text-white hover:bg-teal-600 duration-200">Pasien
                Pindah</button>
            <button onclick="showPasienModal('pasien_keluar_{{ $id_pasien }}')"
                class="px-4 py-2 bg-white text-teal-600 hover:text-white hover:bg-teal-600 duration-200">Pasien
                Keluar</button> --}}
            @foreach ($daftar_ruangan as $key => $value)
                <a class="px-4 py-2 bg-white text-teal-600 hover:text-white hover:bg-teal-600 duration-200"
                    href="{{ route('laporan_shri', $value->id) }}">{{ $value->nama_ruangan }}</a>
            @endforeach
        </div>
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

    function checkSelectedPasienKeluar(id) {
        var select_pasien = document.getElementById(`kondisi_${id}`).value
        // console.log(select_pasien, id);
        if (select_pasien == 'Keluar - Dirujuk') {
            var rumah_sakit_input = document.getElementById(`rumah_sakit_${id}`).classList.remove('hidden')
        } else {
            var rumah_sakit_input = document.getElementById(`rumah_sakit_${id}`).classList.add('hidden')
        }
    }

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
