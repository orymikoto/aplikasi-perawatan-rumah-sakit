@props(['title' => '', 'name' => '', 'id' => '', 'placeholder' => '', 'value' => '', 'class' => '', 'required' => true, 'options' => []])

<div {{ $attributes->merge(['class' => 'flex flex-col gap-2 font-jakarta-sans ' . $class]) }}>
  <p class="text-emerald-600 text-lg font-semibold">{{ $title }}</p>
  <select class="w-full border border-neutral-600 focus:border-emerald-600 font-medium rounded-lg py-2 px-3 outline-none" name="{{ $name }}"
    id="{{ $id ?? $name }}" {{ $required ? 'required' : '' }}>
    <option value="">{{ $placeholder }}</option>
    @foreach ($options as $e)
      <option value="{{ $e }}" {{ $e == $value ? 'selected' : '' }}> {{ $e }}
      </option>
    @endforeach
  </select>
</div>
