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
                    <th scope="col" class="px-4 py-3">No</th>
                    <th scope="col" class="px-4 py-3">Product name</th>
                    <th scope="col" class="px-4 py-3">SKU</th>
                    <th scope="col" class="px-4 py-3 text-center">Stock Awal</th>
                    <th scope="col" class="px-4 py-3 text-center">Product keluar</th>
                    <th scope="col" class="px-4 py-3 text-center">Stock Fisik</th>
                    <th scope="col" class="px-4 py-3 text-center">Selisih Stock</th>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $d)
                <tr class="border-b dark:border-gray-700 odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800">
                    <td class="px-4 py-3 text-center">{{$index+1}}</td>
                    <td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $d->name }}</td>
                    <td class="px-4 py-3">{{ $d->sku }}</td>
                    <td class="px-4 py-3 text-center">0</td>
                    <td class="px-4 py-3 text-center items-center">{{ $d->stock_total }}</td>
                    <td class="px-4 py-3 text-center">{{ $d->stock_fisik }}</td>
                    <td class="px-4 py-3 text-center">
                        @if ($d->stock_total < $d->stock_fisik)
                            Stock Lebih {{ $d->stock_fisik - $d->stock_total }}
                        @elseif ($d->stock_fisik < $d->stock_total)
                            Stock Kurang {{ $d->stock_total - $d->stock_fisik }}
                        @else
                            0
                        @endif
                    </td>
                    <td class="px-4 py-3 justify-end space-x-2 flex items-center">
                        @if (auth()->user()->role == 'admin')
                            @if(now()->isMonday())
                            {{-- input stock --}}
                            <div x-data="{ stockawal: false }" x-cloak="{display: none}" x-init="open = false" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-hidden': open }"  class="relative">
                                <!-- Button to open drawer -->
                                <button id="{{$d->id}}" @click="stockawal = true" class="py-2 px-3 text-sm font-medium text-gray-100 bg-blue-500 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-400 focus:z-10 dark:bg-blue-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-blue-700 dark:focus:ring-gray-600" type="button">
                                    Input Stock
                                </button>

                                <div id="{{$d->id}}" x-show="stockawal"
                                class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50" @click="stockawal = false"></div>

                                <!-- Drawer -->
                                <div id="{{$d->id}}" x-show="stockawal" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0"
                                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform translate-x-0"
                                    x-transition:leave-end="transform translate-x-full"
                                    class="fixed top-0 right-0 z-50 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
                                    <!-- Drawer Header -->
                                    <div class="flex justify-between items-center">
                                        <h5 id="drawer-label" class="text-sm mb-5 font-semibold text-gray-500 uppercase dark:text-gray-400">Cek Stock</h5>
                                        <button @click="stockawal = false" aria-controls="drawer-create-product-default"
                                            class="text-gray-100 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close menu</span>
                                        </button>
                                    </div>
                                    <div class="h-full overflow-y-auto">
                                        <form action="{{route('admin.stockOpname',$d->product_id)}}" method="POST">
                                            @csrf
                                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                <div class="sm:col-span-2">
                                                    <label for="stock_fisik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukkan Stock Fisik</label>
                                                    <input type="number" name="stock_fisik" id="stock_fisik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <button type="submit" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                    Cek Stock
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Form -->
                                </div>
                            </div>
                            @endif
                            <!-- modal -->
                            <div x-data="{ openupdatemodal: false }" x-cloak="{display: none}" x-init="open = false" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-hidden': open }"  class="relative">
                                <!-- Button to open drawer -->
                                <button id="{{$d->id}}" @click="openupdatemodal = true" class="py-2 px-3 text-sm font-medium text-gray-500 bg-blue-500 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-400 focus:z-10 dark:bg-blue-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-blue-700 dark:focus:ring-gray-600" type="button">
                                    Cek Stock
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
                                        <h5 id="drawer-label" class="text-sm mb-5 font-semibold text-gray-500 uppercase dark:text-gray-400">Cek Stock</h5>
                                        <button @click="openupdatemodal = false" aria-controls="drawer-create-product-default"
                                            class="text-gray-100 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close menu</span>
                                        </button>
                                    </div>
                                    <div class="h-full overflow-y-auto">
                                        <form action="{{route('admin.stockOpname',$d->product_id)}}" method="POST">
                                            @csrf
                                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                <div class="sm:col-span-2">
                                                    <label for="stock_fisik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukkan Stock Fisik</label>
                                                    <input type="number" name="stock_fisik" id="stock_fisik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <button type="submit" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                    Cek Stock
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
                                <button id="{{$d->id}}" @click="openupdatemodal = true" class="py-2 px-3 text-sm font-medium text-gray-100 bg-blue-500 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-300 focus:z-10 dark:bg-blue-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-blue-700 dark:focus:ring-gray-600" type="button">
                                    Cek Stock
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
                                        <h5 id="drawer-label" class="text-sm mb-5 font-semibold text-gray-500 uppercase dark:text-gray-400">Cek Stock</h5>
                                        <button @click="openupdatemodal = false" aria-controls="drawer-create-product-default"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close menu</span>
                                        </button>
                                    </div>
                                    <div class="h-full overflow-y-auto">
                                        <form action="{{route('manager.stockOpname',$d->product_id)}}" method="POST">
                                            @csrf
                                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                <div class="sm:col-span-2">
                                                    <label for="stock_fisik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukkan Stock Fisik</label>
                                                    <input type="number" name="stock_fisik" id="stock_fisik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <button type="submit" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                    Cek Stock
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
    {{-- @empty ($products->links())
    @else --}}
    {{$products->links('pagination::tailwind')}}
    {{-- @endempty --}}
</div>
