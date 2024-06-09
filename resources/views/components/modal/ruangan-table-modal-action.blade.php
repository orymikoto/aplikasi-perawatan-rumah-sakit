@props(['title' => '', 'id' => '', 'confirmText' => '', 'buttonText' => ''])

<div class="relative w-full h-full">

  <button onclick="showModal(event, '{{ $id }}')" class="px-4 py-2 hover:bg-teal-600 text-teal-600 hover:text-white rounded w-full">
    {{ $buttonText }}
  </button>

  <div class="fixed hidden items-center justify-center z-10 top-0 left-0 w-screen h-screen bg-neutral-900/10" id="{{ $id }}">
    <div class="modal bg-white p-4 rounded-lg shadow-lg m-auto">
      <h2 class="text-xl font-semibold mb-4">{{ $title }}</h2>
      {{ $slot }}
      <div class="mt-4 flex justify-end">
        <button onclick="hideModal('{{ $id }}')" class="px-4 py-2 bg-gray-500 text-white rounded">Tidak</button>
        <button class="submit px-4 py-2 bg-blue-500 text-white rounded ml-2">{{ $confirmText }}</button>
      </div>
    </div>
  </div>
</div>

<script>
  function showModal(event, id) {
    const modal = document.getElementById(id);
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }

  function hideModal(id) {
    const modal = document.getElementById(id);
    modal.classList.remove('block');
    modal.classList.add('hidden');
  }
</script>
