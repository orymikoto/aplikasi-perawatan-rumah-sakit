@if ($paginator->hasPages())
  <nav role="navigation" aria-label="Pagination Navigation" class="flex gap-x-2 justify-between mx-auto  items-center">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <span
        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md ">
        {!! __('pagination.previous') !!}
      </span>
    @else
      <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-teal-600 hover:shadow-md hover:shadow-teal-400/50 focus:outline-none focus:ring ring-teal-300/25 focus:border-blue-700/50 active:bg-teal-100/25 active:text-gray-700 transition ease-in-out duration-150 ">
        {!! __('pagination.previous') !!}
      </a>
    @endif

    @foreach ($elements as $element)
      {{-- "Three Dots" Separator --}}
      @if (is_string($element))
        <span aria-disabled="true">
          <span
            class="relative px-2 rounded-full text-sm font-medium text-gray-700 bg-white border border-gray-400/50 cursor-default">{{ $element }}</span>
        </span>
      @endif

      {{-- Array Of Links --}}
      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
            <span aria-current="page">
              <span
                class="relative px-2 rounded-full text-lg font-medium text-teal-600 shadow-sm shadow-teal-400/75 bg-white border border-gray-400/50 cursor-default">{{ $page }}</span>
            </span>
          @else
            <a href="{{ $url }}"
              class="relative px-2 rounded-full text-sm font-medium text-gray-700 bg-white border border-gray-400/50 hover:text-teal-600 hover:shadow-md hover:shadow-teal-400/25 transition ease-in-out duration-200"
              aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
              {{ $page }}
            </a>
          @endif
        @endforeach
      @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <a href="{{ $paginator->nextPageUrl() }}" rel="next"
        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-teal-600 hover:shadow-md hover:shadow-teal-400/50 focus:outline-none focus:ring ring-teal-300/25 focus:border-blue-700/50 active:bg-teal-100/25 active:text-gray-700 transition ease-in-out duration-150 ">
        {!! __('pagination.next') !!}
      </a>
    @else
      <span
        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md ">
        {!! __('pagination.next') !!}
      </span>
    @endif
  </nav>
@endif
