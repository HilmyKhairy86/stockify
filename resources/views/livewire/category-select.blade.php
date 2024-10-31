<div x-data="{ open: false }" class="relative w-full">
    <!-- Label -->
    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        Category
    </label>                                        
    <select type="text" id="category" name="supplier_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
        <div>
            @foreach ($cat as $c)
            <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </div>
    </select>
</div>
