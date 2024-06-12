<div class="flex row">
    <button {{ $paginator->onFirstPage() ? 'disabled' : '' }}
        class="relative h-10 max-h-[40px] w-10 max-w-[40px] block select-none rounded-lg rounded-r-none border border-r-0 border-gray-900 text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
        type="button">
        <a href="{{ $paginator->previousPageUrl() }}" class="h-10 max-h-[40px] w-10 max-w-[40px] block">
            <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                </svg>
            </span>
        </a>
    </button>
    @for ($i = 0; $i < ceil($paginator->total() / $paginator->perPage()); $i++)
        <a href="{{ $paginator->url($i + 1) }}"
            class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg rounded-r-none rounded-l-none border border-r-0 border-gray-900 bg-gray-100 text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none {{ $paginator->currentPage() == $i + 1 ? 'bg-gray-900 text-white' : '' }}"
            type="button">
            <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                {{ $i + 1 }}
            </span>
        </a>
    @endfor

    <button {{ $paginator->onLastPage() ? 'disabled' : '' }}
        class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg rounded-l-none border border-gray-900 text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
        type="button">
        <a href="{{ $paginator->nextPageUrl() }}" class="h-10 max-h-[40px] w-10 max-w-[40px] block">
            <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3">
                    </path>
                </svg>
            </span>
        </a>
    </button>
</div>
