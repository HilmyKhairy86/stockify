<div class="mb-3">
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
        {{-- menu bar --}}
        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
            <div x-data="{ adddatamodal: false }" x-cloak="{display: none}" x-init="open = false" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-hidden': open }"  class="relative">
                <!-- Button to open drawer -->
                <button @click="adddatamodal = true" class="flex items-center justify-center dark:bg-blue-600 bg-blue-600 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800" type="button">
                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg>
                    Add product
                </button>
                <div x-show="adddatamodal"
                class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50 over" @click="adddatamodal = false"></div>
                <!-- Drawer -->
                <div x-show="adddatamodal" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform translate-x-0"
                    x-transition:leave-end="transform translate-x-full"
                    class="fixed top-0 right-0 z-50 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
                    <!-- Drawer Header -->
                    <div class="flex justify-between items-center">
                        <h5 id="drawer-label" class="text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">New Product</h5>
                        <button @click="adddatamodal = false" aria-controls="drawer-create-product-default"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close menu</span>
                        </button>
                    </div>
                    <div class="h-full overflow-y-auto">
                        @if (auth()->user()->role == 'admin')
                            {{-- form --}}
                            <form action="{{ route('admin.addProduct') }}" method="POST">
                                @csrf
                                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                    <div class="sm:col-span-2">
                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="supplier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                                        <select id="supplier" name="supplier_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                            <option value="" selected>Select Supplier</option>
                                            @foreach ($sup as $s)
                                            <option value="{{ $s->id }}" >{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="pur_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purchase Price</label>
                                        <input type="number" name="purchase_price" id="pur_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                    </div>
                                    <div>
                                        <label for="sell_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selling Price</label>
                                        <input type="number" name="selling_price" id="sell_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                    </div>
                                    <div>
                                        <label for="sku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKU</label>
                                        <input type="text" name="sku" id="sku" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                    </div>
                                    <div>
                                        <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                                        <input type="number" name="stock" id="stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                        <select id="category" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                            <option value="" disabled selected>Category</option>
                                            @foreach ($cat as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="block mb-2 text-sm font-medium text-black dark:text-white">Image</label>
                                    <input type="file" name="image" id="" class="block  w-full text-sm text-gray-400 bg-slate-100 dark:bg-gray-700 rounded-lg cursor-pointer border border-gray-600 focus:outline-none focus:border-blue-500">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write product description here"></textarea>                    
                                </div>
                                <button type="submit" class="py-2 px-3 mt-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                    Add new product
                                </button>
                            </form>
                        @elseif (auth()->user()->role == 'manajer_gudang')
                            <form action="{{ route('manager.addProduct') }}" method="POST">
                                @csrf
                                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                    <div class="sm:col-span-2">
                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="supplier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                                        <select id="supplier" name="supplier_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                            <option value="" selected>Select Supplier</option>
                                            @foreach ($sup as $s)
                                            <option value="{{ $s->id }}" >{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="pur_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purchase Price</label>
                                        <input type="number" name="purchase_price" id="pur_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                    </div>
                                    <div>
                                        <label for="sell_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selling Price</label>
                                        <input type="number" name="selling_price" id="sell_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                    </div>
                                    <div>
                                        <label for="sku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKU</label>
                                        <input type="number" name="sku" id="sku" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                    </div>
                                    <div>
                                        <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                                        <input type="number" name="stock" id="stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                        <select id="category" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                            <option value="" disabled selected>Category</option>
                                            @foreach ($cat as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="block mb-2 text-sm font-medium text-black dark:text-white">Image</label>
                                    <input type="file" name="image" id="" class="block  w-full text-sm text-gray-400 bg-slate-100 dark:bg-gray-700 rounded-lg cursor-pointer border border-gray-600 focus:outline-none focus:border-blue-500">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write product description here"></textarea>                    
                                </div>
                                <button type="submit" class="py-2 px-3 mt-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                    Add new product
                                </button>
                            </form>
                        @endif
                        
                    </div>
                </div>
            </div>

            @if (auth()->user()->role == 'admin')
            <div x-data="{ importdatamodal: false }" x-cloak="{display: none}" x-init="open = false" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-hidden': open }"  class="relative">
                <!-- Button to toggle the modal -->
                <button id="importmodal" @click="importdatamodal = true" class="flex items-center justify-center dark:bg-blue-600 bg-blue-600 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800" type="button">
                    <i class="fa-solid fa-file-import"></i>
                Import
                </button>
                
                <div id="importdatamodal" x-show="importdatamodal"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50" @click="importdatamodal = false"></div>
                
                {{-- modal header --}}
                <div id="importdatamodal" x-show="importdatamodal"
                    class="fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true" @click="importdatamodal = false">
                    <!-- Drawer Header -->
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        
                        <!-- Close Button -->
                        <button 
                            @click="importdatamodal = false" 
                            type="button" 
                            class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        
                            <div class="p-3">
                                <!-- Modal Text -->
                                <div class="flex p-6">
                                    <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-4 w-full">
                                            <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select File</label>
                                            <input type="file" name="file" id="file" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 dark:text-gray-400 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                            
                                        <div class="flex">
                                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none dark:focus:ring-blue-700">
                                                <i class="fa-solid fa-file-import"></i>
                                                Upload
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div 
                x-data="{ importdatamodal: false }" 
                x-show="importdatamodal" 
                x-transition 
                @keydown.escape.window="importdatamodal = false" 
                tabindex="-1" 
                class="fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50">
                
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    
                    <!-- Close Button -->
                    <button 
                    @click="importdatamodal = false" 
                    type="button" 
                    class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                    </button>
                    
                    <div class="p-4 md:p-5 text-center">
                    
                    <!-- Icon -->
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                
                    <!-- Modal Text -->
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                    
                    <!-- Action Buttons -->
                    <button 
                        @click="importdatamodal = false" 
                        type="button" 
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes, I'm sure
                    </button>
                    
                    <button 
                        @click="importdatamodal = false" 
                        type="button" 
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        No, cancel
                    </button>
                    </div>
                </div>
                
                </div>
                </div>
            </div>

            {{-- export --}}
            <div x-data="{ open: false }" x-cloak="{display: none}" class="relative inline-block text-left">
                <!-- Button to toggle the dropdown -->
                <div>
                    <button @click="open = !open" type="button" class="iw-full hover:text-gray-900 md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" id="menu-button" aria-expanded="true" aria-haspopup="true">
                        <i class="fa-solid fa-download mr-2"></i>
                        Export
                        <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                        </svg>
                    </button>
                </div>
                
                <div x-show="open" @click.away="open = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
                    role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                    <div class="py-1" role="none">
                        <!-- Active: "bg-gray-100 text-gray-900 outline-none", Not Active: "text-gray-700" -->
                        <div>
                            <form action="{{route('export')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-sm text-gray-700"></i>
                                    Export .CSV
                                </button>
                            </form>
                        </div>
                        <div>
                            <form action="{{route('exportxls')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-sm text-gray-700"></i>
                                    Export .XLSX
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif   
            
            {{-- filter --}}
            <div x-data="{ filtermodal: false }" x-cloak="{display: none}" x-init="open = false" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-hidden': open }" class="relative">
                <!-- Button to open drawer -->
                <button @click="filtermodal = true" class="w-full hover:text-gray-900 md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                    </svg>
                    Filter
                    <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </button>
                
                <div x-show="filtermodal"
                class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50 over" @click="filtermodal = false"></div>
                
                <!-- Drawer -->
                <div x-show="filtermodal" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform translate-x-0"
                    x-transition:leave-end="transform translate-x-full"
                    class="fixed top-0 right-0 z-50 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
                    <!-- Drawer Header -->
                    <div class="flex justify-between items-center mb-5">
                        <h5 id="drawer-label" class="text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Select Category</h5>
                        <button @click="filtermodal = false" aria-controls="drawer-create-product-default"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close menu</span>
                        </button>
                    </div>
                    <div class="h-full ">
                        <div class="grid gap-4 p-4 mb-5 sm:grid-cols-2 justify-items">
                            @foreach ($cat as $p)
                            <div class=" flex items-center">
                                <input wire:model.live="categories" id="cat-{{$p->id}}" type="checkbox" name="category" value="{{$p->id}}" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="cat-{{$p->id}}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $p->name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
          
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    {{-- <th scope="col" class="px-4 py-3"><input type="checkbox" id="select-all"></th> --}}
                    <th scope="col" class="px-4 py-3">Product name</th>
                    <th scope="col" class="px-4 py-3">Category</th>
                    <th scope="col" class="px-4 py-3">Suplier</th>
                    <th scope="col" class="px-4 py-3">SKU</th>
                    <th scope="col" class="px-4 py-3">Stock</th>
                    <th scope="col" class="px-4 py-3">Purchase Price</th>
                    <th scope="col" class="px-4 py-3">Selling Price</th>
                    <th scope="col" class="px-4 py-3">Description</th>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $d)
                <tr class="border-b dark:border-gray-700 odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800">
                    {{-- <td class="px-4 py-3">
                        <input type="checkbox" name="ids[]" value="{{ $d->id }}">
                        <script>
                            document.getElementById('select-all').addEventListener('change', function () {
                                const checkboxes = document.querySelectorAll('input[name="ids[]"]');
                                checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                            });
                        </script>
                    </td> --}}
                    <td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $d->name }}</td>
                    <td class="px-4 py-3">{{ optional($d->category)->name }}</td>
                    <td class="px-4 py-3">{{ optional($d->supplier)->name }}</td>
                    <td class="px-4 py-3">{{ $d->sku }}</td>
                    <td class="px-4 py-3">{{ $d->stock }}</td>
                    <td class="px-4 py-3">{{ $d->purchase_price }}</td>
                    <td class="px-4 py-3">{{ $d->selling_price }}</td>
                    <td class="px-4 py-3">{{ $d->description }}</td>
                    <td class="px-4 py-3 justify-end space-x-2 flex items-center">

                        @if (auth()->user()->role == 'admin')
                            {{-- update modal --}}
                            <div x-data="{ detailmodal: false }" x-cloak="{display: none}" x-init="open = false" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-hidden': open }"  class="relative">
                                <!-- Button to open drawer -->
                                <button id="{{$d->id}}" @click="detailmodal = true" class="py-2 px-3 text-sm font-medium text-gray-500 bg-blue-500 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-blue-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-blue-700 dark:focus:ring-gray-600" type="button">
                                    <i class="fa-solid fa-circle-info text-white"></i>
                                </button>
                                
                                <div id="{{$d->id}}" x-show="detailmodal"
                                class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50" @click="detailmodal = false"></div>
                                
                                <!-- Drawer -->
                                <div id="{{$d->id}}" x-show="detailmodal" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0"
                                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform translate-x-0"
                                    x-transition:leave-end="transform translate-x-full"
                                    class="fixed top-0 right-0 z-50 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
                                    <!-- Drawer Header -->
                                    <div class="flex justify-between items-center mb-5">
                                        <h5 id="drawer-label" class="text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Detail Product</h5>
                                        <button @click="detailmodal = false" aria-controls="drawer-create-product-default"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close menu</span>
                                        </button>
                                    </div>
                                    <div class="h-full overflow-y-auto">
                                        <form action="{{ route('admin.updateProduct', $d->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                <div class="sm:col-span-2">
                                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        {{ $d->name }}
                                                    </p>
                                                </div>
                                                <div class="sm:col-span-2">
                                                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                                                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        {{ $d->supplier_id }} - {{$d->supplier->name}}
                                                    </p>
                                                </div>
                                                <div>
                                                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purchase Price</label>
                                                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        {{ $d->purchase_price }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selling Price</label>
                                                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        {{ $d->selling_price }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <label for="sku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKU</label>
                                                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        {{ $d->sku }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                                                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">{{$d->stock}}</p>
                                                </div>
                                                <div class="sm:col-span-2">
                                                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        {{$d->category_id}} - {{$d->category->name}}
                                                    </p>
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
                                        </form>
                                    </div>
                                    <!-- Form -->
                                </div>
                            </div>

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
                                        <form action="{{route('admin.updateProduct',$d->id)}}" method="POST" enctype="multipart/form-data">
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

                            {{-- delete modal --}}
                            <div x-data="{ deletemodal: false }" x-cloak="{display: none}" x-init="open = false" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-hidden': open }"  class="relative">
                                <!-- Button to toggle the modal -->
                                <button id="{{$d->id}}" @click="deletemodal = true" class="py-2 px-3 text-sm font-medium text-gray-500 bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-red-900 focus:z-10 dark:red-blue-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-red-900 dark:focus:ring-gray-600" type="button">
                                    <i class="fa-solid fa-trash text-white"></i>
                                </button>
                                
                                <div id="{{$d->id}}" x-show="deletemodal"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50" @click="deletemodal = false"></div>
                                
                                <div id="{{$d->id}}" x-show="deletemodal"
                                    class="fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true" @click="deletemodal = false">
                                    <!-- Drawer Header -->
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        
                                        <!-- Close Button -->
                                        <button 
                                            @click="deletemodal = false" 
                                            type="button" 
                                            class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        
                                        <div class="p-4 md:p-5 text-center">
                                            <!-- Icon -->
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                    
                                            <!-- Modal Text -->
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                                            <div class="flex justify-center items-center">
                                                <form action="{{ route('admin.deleteProduct', $d->id) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                        Yes, I'm sure
                                                    </button>
                                                </form>
                                                
                                                <button 
                                                @click="deletemodal = false" 
                                                type="button" 
                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                No, cancel
                                                </button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <!-- Modal -->
                                <div 
                                x-data="{ deletemodal: false }" 
                                x-show="deletemodal" 
                                x-transition 
                                @keydown.escape.window="deletemodal = false" 
                                tabindex="-1" 
                                class="fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50">
                                
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    
                                    <!-- Close Button -->
                                    <button 
                                    @click="deletemodal = false" 
                                    type="button" 
                                    class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                    </button>
                                    
                                    <div class="p-4 md:p-5 text-center">
                                    
                                    <!-- Icon -->
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                
                                    <!-- Modal Text -->
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                                    
                                    <!-- Action Buttons -->
                                    <button 
                                        @click="deletemodal = false" 
                                        type="button" 
                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Yes, I'm sure
                                    </button>
                                    
                                    <button 
                                        @click="deletemodal = false" 
                                        type="button" 
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                        No, cancel
                                    </button>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>

                        @elseif (auth()->user()->role == 'manajer_gudang')
                            {{-- detail modal --}}
                            <div x-data="{ detailmodal: false }" x-cloak="{display: none}" x-init="open = false" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-hidden': open }"  class="relative">
                                <!-- Button to open drawer -->
                                <button id="{{$d->id}}" @click="detailmodal = true" class="py-2 px-3 text-sm font-medium text-gray-500 bg-blue-500 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-blue-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-blue-700 dark:focus:ring-gray-600" type="button">
                                    <i class="fa-solid fa-circle-info text-white"></i>
                                </button>
                                
                                <div id="{{$d->id}}" x-show="detailmodal"
                                class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50" @click="detailmodal = false"></div>
                                
                                <!-- Drawer -->
                                <div id="{{$d->id}}" x-show="detailmodal" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0"
                                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform translate-x-0"
                                    x-transition:leave-end="transform translate-x-full"
                                    class="fixed top-0 right-0 z-50 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
                                    <!-- Drawer Header -->
                                    <div class="flex justify-between items-center mb-5">
                                        <h5 id="drawer-label" class="text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Detail Product</h5>
                                        <button @click="detailmodal = false" aria-controls="drawer-create-product-default"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close menu</span>
                                        </button>
                                    </div>
                                    <div class="h-full overflow-y-auto">
                                        <form action="{{ route('manager.updateProduct', $d->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                <div class="sm:col-span-2">
                                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        {{ $d->name }}
                                                    </p>
                                                </div>
                                                <div class="sm:col-span-2">
                                                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                                                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        {{ $d->supplier->name }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purchase Price</label>
                                                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        {{ $d->purchase_price }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selling Price</label>
                                                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        {{ $d->selling_price }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <label for="sku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKU</label>
                                                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        {{ $d->sku }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                                                    <input type="number" name="stock" id="stock" value="{{$d->stock}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                                </div>
                                                <div class="sm:col-span-2">
                                                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        {{$d->category_id}}
                                                    </p>
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
                                        </form>
                                    </div>
                                    <!-- Form -->
                                </div>
                            </div>

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

                            {{-- delete modal --}}
                            <div x-data="{ deletemodal: false }" x-cloak="{display: none}" x-init="open = false" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-hidden': open }"  class="relative">
                                <!-- Button to toggle the modal -->
                                <button id="{{$d->id}}" @click="deletemodal = true" class="py-2 px-3 text-sm font-medium text-gray-500 bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-red-900 focus:z-10 dark:red-blue-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-red-900 dark:focus:ring-gray-600" type="button">
                                    <i class="fa-solid fa-trash text-white"></i>
                                </button>
                                
                                <div id="{{$d->id}}" x-show="deletemodal"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50" @click="deletemodal = false"></div>
                                
                                <div id="{{$d->id}}" x-show="deletemodal"
                                    class="fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true" @click="deletemodal = false">
                                    <!-- Drawer Header -->
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        
                                        <!-- Close Button -->
                                        <button 
                                            @click="deletemodal = false" 
                                            type="button" 
                                            class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        
                                        <div class="p-4 md:p-5 text-center">
                                            <!-- Icon -->
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                    
                                            <!-- Modal Text -->
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                                            <div class="flex justify-center items-center">
                                                <form action="{{ route('manager.deleteProduct', $d->id) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                        Yes, I'm sure
                                                    </button>
                                                </form>
                                                
                                                <button 
                                                @click="deletemodal = false" 
                                                type="button" 
                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                No, cancel
                                                </button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <!-- Modal -->
                                <div 
                                x-data="{ deletemodal: false }" 
                                x-show="deletemodal" 
                                x-transition 
                                @keydown.escape.window="deletemodal = false" 
                                tabindex="-1" 
                                class="fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50">
                                
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    
                                    <!-- Close Button -->
                                    <button 
                                    @click="deletemodal = false" 
                                    type="button" 
                                    class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                    </button>
                                    
                                    <div class="p-4 md:p-5 text-center">
                                    
                                    <!-- Icon -->
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                
                                    <!-- Modal Text -->
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                                    
                                    <!-- Action Buttons -->
                                    <button 
                                        @click="deletemodal = false" 
                                        type="button" 
                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Yes, I'm sure
                                    </button>
                                    
                                    <button 
                                        @click="deletemodal = false" 
                                        type="button" 
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                        No, cancel
                                    </button>
                                    </div>
                                </div>
                                </div>
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
