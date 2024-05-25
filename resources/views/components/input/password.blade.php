@props(['title' => '', 'placeholder' => '', 'name' => ''])

<div class="flex flex-col gap-2 font-jakarta-sans">
    <p class=" font-semibold text-lg text-emerald-700">{{ $title }}</p>
    <input placeholder="{{ $placeholder }}"
        class=" w-full border border-neutral-600 focus:border-emerald-600 font-medium rounded-lg py-2 px-4 outline-none"
        type="password" name="{{ $name }}">
</div>
