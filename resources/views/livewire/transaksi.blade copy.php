<div class="mb-3">
    {{-- search --}}
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

        {{-- addproduct --}}
        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
            <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                @if (auth()->user()->role == 'admin')
                <div x-data="{ adddatamodal: false }" x-cloak="{display: none}" x-init="open = false" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-hidden': open }"  class="relative">
                    <!-- Button to open drawer -->
                    <button @click="adddatamodal = true" class="flex items-center justify-center dark:bg-blue-600 bg-blue-600 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800" type="button">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Add Transaction
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
                            {{-- form --}}
                            <form action="{{route('admin.addTransaction')}}" method="POST">
                                @csrf
                                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                    <div class="sm:col-span-2">
                                        <label for="product_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product ID</label>
                                        <input type="text" name="product_id" id="product_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type Product name" required="">
                                    </div class="sm:col-span-2">
                                    {{-- @livewire('proddropdown') --}}
                                    <div class="sm:col-span-2">
                                        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User ID</label>
                                        <input type="text" name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ auth()->user()->id }}" readonly required="">
                                    </div>
                                    <div>
                                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                        <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                            <option value="" hidden disabled selected>Type</option>
                                            <option value="masuk" >Masuk</option>
                                            <option value="keluar" >Keluar</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                                        <input type="number" required name="quantity" id="sku" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                                        <input type="date" name="date" value="{{ date('Y-m-d') }}" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required>
                                    </div>
                                    {{-- <div>
                                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                        <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                            <option value="" hidden disabled selected>Status</option>
                                            <option value="pending" >Pending</option>
                                            <option value="diterima" >Diterima</option>
                                            <option value="ditolak" >Ditolak</option>
                                            <option value="dikeluarkan" >Dikeluarkan</option>
                                        </select>
                                    </div> --}}
                                    <div class="sm:col-span-2">
                                        <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notes</label>
                                        <textarea id="notes" name="notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write Notes here"></textarea>                    
                                    </div>
                                </div>
                                <button type="submit" class=" text-white dark:text-white inline-flex items-center bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                    Add new Transaction
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                @elseif (auth()->user()->role == 'manajer_gudang')
                

                @endif
                
            </div>
            <!-- filter -->
            <div x-data="{ isOpen: false }" @click.away="isOpen = false" >
                <button @click="isOpen = !isOpen" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 hover:text-black dark:hover:text-white dark:hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                    </svg>
                    Filter
                    <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </button>
              
                <div x-show="isOpen" class="fixed w-48 p-3 bg-white rounded-lg shadow-xl dark:bg-gray-700">
                    <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose Filter</h6>
                    <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Type</h6>
                    <ul class="space-y-2 text-sm mb-3" aria-labelledby="filterDropdownButton">
                        <li class="flex items-center">
                            <input wire:model.live="types" id="masuk" type="radio" name="radio" value="all" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">All Type</label>
                        </li>
                        <li class="flex items-center">
                            <input wire:model.live="types" id="masuk" type="radio" name="radio" value="masuk" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Masuk</label>
                        </li>
                        <li class="flex items-center">
                            <input wire:model.live="types" id="keluar" type="radio" name="radio" value="keluar" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Keluar</label>
                        </li>
                    </ul>
                    <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Status</h6>
                    <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                        <li class="flex items-center">
                            <input wire:model.live="status" id="" type="radio" name="status" value="all" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">All</label>
                        </li>
                        <li class="flex items-center">
                            <input wire:model.live="status" id="" type="radio" name="status" value="diterima" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Diterima</label>
                        </li>
                        <li class="flex items-center">
                            <input wire:model.live="status" id="" type="radio" name="status" value="pending" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Pending</label>
                        </li>
                        <li class="flex items-center">
                            <input wire:model.live="status" id="" type="radio" name="status" value="ditolak" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Ditolak</label>
                        </li>
                        <li class="flex items-center">
                            <input wire:model.live="status" id="" type="radio" name="status" value="dikeluarkan" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Dikeluarkan</label>
                        </li>
                    </ul>
                        
                </div>
            </div>

            <div x-data="{ isOpen: false }" @click.away="isOpen = false" >
                <div class="relative max-w-sm">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                       <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input wire:model.live="date" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Filter Date">
                  </div>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">Product</th>
                    <th scope="col" class="px-4 py-3">User</th>
                    <th scope="col" class="px-4 py-3">Type</th>
                    <th scope="col" class="px-4 py-3">Quantity</th>
                    <th scope="col" class="px-4 py-3">Date</th>
                    <th scope="col" class="px-4 py-3">Status</th>
                    <th scope="col" class="px-4 py-3">Notes</th>
                    @if (auth()->user()->role == 'admin')

                    @elseif (auth()->user()->role == 'staff_gudang')
                    <th scope="col" class="px-4 py-3">Action</th>
                    @endif
                    
                </tr>
            </thead>
            <tbody>
                {{-- {{dd($stock)}} --}}
                @foreach ($stock as $d)
                <tr class="border-b dark:border-gray-700 odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800">
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$d->product_id}} - {{ $d->product->name }}</th>
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $d->user_id }} - {{$d->user->name}}</th>
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @if ($d->type == 'masuk')
                        <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                            <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                            {{ $d->type }}
                        </span>
                        @else
                        <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                            <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                            {{ $d->type }}
                        </span>
                        @endif
                    </th>
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $d->quantity }}</th>
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $d->date }}</th>
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @switch($d->status)
                            @case('pending')
                                <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-600 dark:text-yellow-200">
                                    <span class="w-2 h-2 me-1 bg-yellow-500 rounded-full"></span>
                                    Pending
                                </span>
                                @break
                            @case('diterima')
                                <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                    <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                    Diterima
                                </span>
                                @break
                            @case('ditolak')
                                <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                    <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                    Ditolak
                                </span>
                                @break
                            @case('dikeluarkan')
                                <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                    <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                    Dikeluarkan
                                </span>
                                @break
                            @default
                        @endswitch
                    </th>
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $d->notes }}</th>
                    @if (auth()->user()->role == 'admin')    
                        @elseif (auth()->user()->role == 'staff_gudang')
                        <td class="px-4 py-3 flex items-center">
                            <div x-data="{ openupdatemodal: false }" x-cloak="{display: none}" x-init="open = false" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-hidden': open }"  class="relative">
                                <!-- Button to open drawer -->
                                <button id="{{$d->id}}" @click="openupdatemodal = true" class="py-2 px-3 text-sm font-medium text-gray-500 bg-blue-500 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-blue-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-blue-700 dark:focus:ring-gray-600" type="button">
                                    <i class="fa-solid fa-check text-white"></i>
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
                                        <h5 id="drawer-label" class="text-sm mb-5 font-semibold text-gray-500 uppercase dark:text-gray-400">Confirm Transaction</h5>
                                        <button @click="openupdatemodal = false" aria-controls="drawer-create-product-default"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close menu</span>
                                        </button>
                                    </div>
                                    <div class="h-full overflow-y-auto">
                                        <form action="{{ route('staff.confirmtransaction',$d->id) }}" method="POST">
                                            @csrf
                                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                <div class="sm:col-span-2">
                                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product ID</label>
                                                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        {{ $d->product_id }} - {{ $d->product->name }}
                                                    </p>
                                                    <input type="text" name="product_id" readonly hidden value="{{ $d->product_id }}">
                                                </div>
                                                <div class="sm:col-span-2">
                                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User ID</label>
                                                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        {{ $d->user_id }} - {{ $d->user->name }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        {{ $d->type }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <label for="sku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                                                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        {{ $d->quantity }}
                                                    </p>
                                                    <input type="text" name="quantity" readonly hidden value="{{ $d->quantity }}">
                                                </div>
                                                <div>
                                                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                                                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        {{ $d->date }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                                    <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                                        <option value="" hidden disabled selected>Status</option>
                                                        <option value="pending" {{ $d->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="diterima" {{ $d->status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                                                        <option value="ditolak" {{ $d->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                        <option value="dikeluarkan" {{ $d->status === 'dikeluarkan' ? 'selected' : '' }}>Dikeluarkan</option>
                                                    </select>
                                                </div>
                                                <div class="sm:col-span-2">
                                                    <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notes</label>
                                                    <textarea id="notes" name="notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write Notes here">{{$d->notes}}</textarea>                    
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <button type="submit" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                    Confirm Transaction
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Form -->
                                </div>
                            </div>
                        </td>
                        @else
                        @endif
                    </td>
                @endforeach
                <!--Update Main modal -->
            </tbody>
        </table>
    </div>
    @empty ($stock->links())
    @else
    {{$stock->links('pagination::tailwind')}}
    @endempty
</div>



