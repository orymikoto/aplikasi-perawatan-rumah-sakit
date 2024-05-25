@props(['title' => '', 'name' => '', 'placeholder' => '', 'value' => '', 'options' => []])

<div class="flex flex-col font-jakarta-sans">
    <p class="text-emerald-600 text-lg font-semibold">{{ $title }}</p>
    <select
        class="w-full border border-neutral-600 focus:border-emerald-600 font-medium rounded-lg py-2 px-3 outline-none"
        name="{{ $name }}" id="{{ $name }}">
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $value)
            <option value="{{ $value }}"> {{ $value }} </option>
        @endforeach
    </select>
</div>
