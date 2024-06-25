@props(['title' => '', 'name' => '', 'placeholder' => '', 'value' => '', 'required' => true, 'class' => '', 'type' => 'text'])

<div {{ $attributes->merge(['class' => 'flex flex-col gap-2 font-jakarta-sans ' . $class]) }}>
  <p class=" font-semibold text-lg text-emerald-700">{{ $title }}</p>
  <input type="{{ $type }}" class=" w-full border border-neutral-600 focus:border-emerald-600 font-medium rounded-lg py-2 px-4 outline-none"
    type="text" name="{{ $name }}" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }}>
</div>
