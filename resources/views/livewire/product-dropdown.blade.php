<div class="sm:col-span-2">
    <label for="product_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product</label>
    <input type="text" wire:model.live="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
    @if (!empty($search))
        <ul class="border border-gray-300 bg-white w-full">
            @forelse ($items as $item)
                <li 
                    class="p-2 hover:bg-gray-100 cursor-pointer"
                    wire:click="selectItem({{ $item->id }})"
                >
                    {{ $item->id }} - {{ $item->name }}
                </li>
            @empty
            @endforelse
        </ul>
    @endif
    <input type="hidden" name="product_id" value="{{ $selectedItemId }}">
</div>
