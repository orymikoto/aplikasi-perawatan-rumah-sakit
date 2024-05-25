@props(['class' => '', 'title' => 'Submit'])

<button type="submit"
    class="bg-emerald-600 text-white font-jakarta-sans py-2 px-4 font-medium rounded-lg hover:bg-white hover:text-emerald-600 hover:shadow-md hover:shadow-emerald-600/50 duration-200 {{ $class }}">
    {{ $title }}
</button>
