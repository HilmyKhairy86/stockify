@if ($paginator->hasPages())
    <div class="flex items-center justify-between p-4 text-sm text-black bg-slate-200 dark:text-gray-400 dark:bg-gray-800 rounded-lg">
        <!-- Showing X of Y -->
        <div>
            <span>Showing</span>
            <span class="font-medium text-black dark:text-gray-300">{{ $paginator->firstItem() }}</span>
            <span>to</span>
            <span class="font-medium text-black dark:text-gray-300">{{ $paginator->lastItem() }}</span>
            <span>of</span>
            <span class="font-medium text-black dark:text-gray-300">{{ $paginator->total() }}</span>
        </div>

        <!-- Pagination Links -->
        <div class="flex items-center space-x-1">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-1 text-black dark:text-white bg-slate-300 dark:bg-gray-700 rounded cursor-not-allowed">←</span>
            @else
                <button wire:click="previousPage" class="px-3 py-1 text-black dark:text-white bg-slate-300 dark:bg-gray-700 rounded hover:bg-gray-600">←</button>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-3 py-1 text-black">...</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-1 text-white bg-blue-600 rounded">{{ $page }}</span>
                        @else
                            <button wire:click="gotoPage({{ $page }})" class="px-3 py-1 text-gray-400 bg-slate-300 dark:bg-gray-700 hover:bg-slate-400 rounded hover:text-white dark:hover:bg-gray-600">{{ $page }}</button>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" class="px-3 py-1 text-black dark:text-white bg-slate-300 dark:bg-gray-700 rounded hover:bg-gray-600">→</button>
            @else
                <span class="px-3 py-1 text-black dark:text-white bg-slate-300 dark:bg-gray-700 rounded cursor-not-allowed">→</span>
            @endif
        </div>
    </div>
@endif
