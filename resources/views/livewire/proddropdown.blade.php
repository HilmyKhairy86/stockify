<div x-data="{ open: false }" @click.away="open = false">
    <input type="text" placeholder="Type product name" x-model="search" wire:model.debounce.300ms="search"
           @focus="open = true" @keydown.escape="open = false" @keydown="open = true" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">

    <div x-show="open" class="absolute z-10 w-full bg-white border border-gray-300 rounded max-h-48 overflow-y-auto">
        @if(!empty($prod))
            <ul>
                @foreach($prod as $product)
                    <li @click="open = false; $wire.emit('productSelected', {{ $product->id }})"
                        class="px-4 py-2 cursor-pointer hover:bg-gray-200">
                        {{ $product->name }}
                    </li>
                @endforeach
            </ul>
        @else
            <div class="px-4 py-2 text-gray-500">No results found</div>
        @endif
    </div>
</div>

