@props(['title' => '', 'name' => '', 'placeholder' => '', 'value' => ''])

<div class="flex flex-col gap-2 font-jakarta-sans">
  <p class=" font-semibold text-lg text-emerald-700">{{ $title }}</p>
  <input class=" w-full border border-neutral-600 focus:border-emerald-600 font-medium rounded-lg py-2 px-4 outline-none" type="number"
    name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ $value }}">
</div>
