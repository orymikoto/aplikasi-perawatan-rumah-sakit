@props(['text' => '', 'color' => 'teal-600', 'class' => '', 'type' => ''])

<button type="{{ $type }}"
  {{ $attributes->merge(['class' => 'px-2 py-1 rounded-md text-white hover:shadow-md hover:bg-white bg-' . $color . ' hover:text-' . $color . ' hover:shadow-' . $color . '/50 duration-200 ' . $class]) }}>{{ $text }}</button>
