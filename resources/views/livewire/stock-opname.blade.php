<div class="mb-3">
    {{-- search --}}
    {{-- {{dd(auth()->user())}} --}}
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
        <div class="w-full md:w-1/2">
            {{-- search --}}

                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="seacrh" wire:model.live="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search">

                </div>
        </div>

          
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">Product name</th>
                    <th scope="col" class="px-4 py-3">Category</th>
                    <th scope="col" class="px-4 py-3">Suplier</th>
                    <th scope="col" class="px-4 py-3">SKU</th>
                    <th scope="col" class="px-4 py-3 text-center">Product Masuk/keluar</th>
                    <th scope="col" class="px-4 py-3 text-center">Stock Fisik</th>
                    <th scope="col" class="px-4 py-3 text-center">Selisih Stock</th>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $d)
                <tr class="border-b dark:border-gray-700 odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800">
                    <td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $d->name }}</td>
                    <td class="px-4 py-3">{{ optional($d->category)->name }}</td>
                    <td class="px-4 py-3">{{ optional($d->supplier)->name }}</td>
                    <td class="px-4 py-3">{{ $d->sku }}</td>
                    <td class="px-4 py-3 text-center items-center">{{ $d->stock }}</td>
                    <td class="px-4 py-3 text-center">{{ $d->stock_fisik }}</td>
                    <td class="px-4 py-3 text-center">
                        @if ($d->stock < $d->stock_fisik)
                            {{ $d->stock_fisik - $d->stock }}
                        @elseif ($d->stock_fisik < $d->stock)
                            {{ $d->stock - $d->stock_fisik }}
                        @endif
                    </td>
                    <td class="px-4 py-3 justify-end space-x-2 flex items-center">

                        @if (auth()->user()->role == 'admin')
                            {{-- update modal --}}
                            <div x-data="{ openupdatemodal: false }" x-cloak="{display: none}" x-init="open = false" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-hidden': open }"  class="relative">
                                <!-- Button to open drawer -->
                                <button id="{{$d->id}}" @click="openupdatemodal = true" class="py-2 px-3 text-sm font-medium text-gray-500 bg-blue-500 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-blue-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-blue-700 dark:focus:ring-gray-600" type="button">
                                    <i class="fa-solid fa-pen-to-square text-white"></i>
                                </button>
                                
                                <div id="{{$d->id}}" x-show="openupdatemodal"
                                class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50" @click="openupdatemodal = false"></div>
                                
                                <!-- Drawer -->
                                <div id="{{$d->id}}" x-show="openupdatemodal" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0"
                                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform translate-x-0"
                                    x-transition:leave-end="transform translate-x-full"
                                    class="fixed top-0 right-0 z-50 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
                                    <!-- Drawer Header -->
                                    <div class="flex justify-between items-center">
                                        <h5 id="drawer-label" class="text-sm mb-5 font-semibold text-gray-500 uppercase dark:text-gray-400">Edit Stock</h5>
                                        <button @click="openupdatemodal = false" aria-controls="drawer-create-product-default"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close menu</span>
                                        </button>
                                    </div>
                                    <div class="h-full overflow-y-auto">
                                        <form action="{{route('admin.updateProduct',$d->id)}}" method="POST">
                                            @csrf
                                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                <div>
                                                    <label for="stock_fisik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                                                    <input type="number" name="stock_fisik" id="stock_fisik" value="{{ $d->stock_fisik }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <button type="submit" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                    Update Stock
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Form -->
                                </div>
                            </div>
                        @elseif (auth()->user()->role == 'manajer_gudang')
                            {{-- update modal --}}
                            <div x-data="{ openupdatemodal: false }" x-cloak="{display: none}" x-init="open = false" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-hidden': open }"  class="relative">
                                <!-- Button to open drawer -->
                                <button id="{{$d->id}}" @click="openupdatemodal = true" class="py-2 px-3 text-sm font-medium text-gray-500 bg-blue-500 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-blue-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-blue-700 dark:focus:ring-gray-600" type="button">
                                    <i class="fa-solid fa-pen-to-square text-white"></i>
                                </button>
                                
                                <div id="{{$d->id}}" x-show="openupdatemodal"
                                class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50" @click="openupdatemodal = false"></div>
                                
                                <!-- Drawer -->
                                <div id="{{$d->id}}" x-show="openupdatemodal" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0"
                                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform translate-x-0"
                                    x-transition:leave-end="transform translate-x-full"
                                    class="fixed top-0 right-0 z-50 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
                                    <!-- Drawer Header -->
                                    <div class="flex justify-between items-center">
                                        <h5 id="drawer-label" class="text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Edit Product</h5>
                                        <button @click="openupdatemodal = false" aria-controls="drawer-create-product-default"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close menu</span>
                                        </button>
                                    </div>
                                    <div class="h-full overflow-y-auto">
                                        <form action="{{route('manager.updateProduct',$d->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                <div class="sm:col-span-2">
                                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                    <input type="text" name="name" id="name" value="{{ $d->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                                </div>
                                                <div class="sm:col-span-2">
                                                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                                                    <select id="category" name="supplier_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        <option value="" hidden disabled {{ is_null($d->supplier_id) ? 'selected' : '' }}>Select a Supplier</option>
                                                        @foreach ($sup as $s)
                                                        <option value="{{ $s->id }}" {{ $d->supplier_id === $s->id ? 'selected' : '' }} >{{ $s->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purchase Price</label>
                                                    <input type="number" value="{{ $d->purchase_price }}" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                                </div>
                                                <div>
                                                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selling Price</label>
                                                    <input type="number" value="{{ $d->selling_price }}" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                                </div>
                                                <div>
                                                    <label for="sku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKU</label>
                                                    <input type="number" value="{{ $d->sku }}" name="sku" id="sku" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                                </div>
                                                <div>
                                                    <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                                                    <input type="number" name="stock" id="stock" value="{{$d->stock}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                                </div>
                                                <div class="sm:col-span-2">
                                                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                                    <select id="category" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        <option value="" hidden disabled {{ is_null($d->category_id) ? 'selected' : '' }}>Select a category</option>
                                                        @foreach ($cat as $c)
                                                        <option value="{{ $c->id }}" {{ $d->category_id === $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="sm:col-span-2">
                                                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                                                    <input type="file" name="image" accept="image/jpeg,image/png" id="image" class="block w-full text-sm text-gray-400 bg-white dark:bg-gray-700 rounded-lg cursor-pointer border border-gray-600 focus:outline-none focus:border-blue-500">
                                                </div>
                                                @if ($d->image)
                                                <div class="sm:col-span-2">
                                                    <img for="image" src="{{ asset('storage/'.$d->image ) }}" class="block w-full h-full object-cover rounded-lg border border-gray-600" />
                                                </div>
                                                @endif
                                                <div class="sm:col-span-2">
                                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                                    <textarea name="description" id="description" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write a description...">{{ $d->description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <button type="submit" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                    Update product
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Form -->
                                </div>
                            </div>
                        @endif
                        
                        
                        
                    </td>
                </tr>
                @endforeach
                <!--Update Main modal -->
            </tbody>
        </table>
    </div>
    @empty ($products->links())
    @else
    {{$products->links('pagination::tailwind')}}
    @endempty
</div>
