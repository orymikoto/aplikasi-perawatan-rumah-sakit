@props(['placeholder' => '', 'name' => '', 'title' => 'Title', 'type' => 'text', 'value' => ''])

<div class="flex flex-col gap-2 w-full">
    <p class="font-jakarta-sans font-medium text-lg text-neutral-900 ml-2">{{ $title }}</p>
    <input type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
        class="w-full rounded-lg py-2 px-4 outline-none border border-neutral-400 hover:border-emerald-600 focus:border-emerald-600"
        value="{{ $value }}">
</div>
