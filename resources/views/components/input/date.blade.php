@props(['title' => '', 'name' => '', 'placeholder' => '', 'value' => '', 'required' => true])


<div class="flex flex-col gap-2 font-jakarta-sans">
    <p class=" font-semibold text-lg text-emerald-700">{{ $title }}</p>
    <input placeholder="{{ $placeholder }}"
        class=" w-full border border-neutral-600 focus:border-emerald-600 font-medium rounded-lg py-2 px-4 outline-none"
        type="date" name="{{ $name }}" value="{{ $value }}" {{ $required ? 'required' : '' }}>
</div>
