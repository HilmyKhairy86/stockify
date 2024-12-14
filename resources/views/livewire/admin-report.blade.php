<div>
    <div class="w-full dark:bg-gray-600 bg-gray-200 p-2 rounded-md mb-3 md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
        <div x-data="{ adddatamodal: false }" x-cloak="{display: none}" x-init="open = false" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-hidden': open }"  class="relative">
            @if (auth()->user()->role == 'admin')
            <form action="{{ route('admin.exportpdf') }}" method="post">
            @csrf
            <button type="submit" class="flex items-center justify-center dark:bg-blue-600 bg-blue-600 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                <i class="fa-solid fa-file-export mx-1"></i>
                Export to PDF
            </button>
            </form>
            @elseif (auth()->user()->role == 'manajer_gudang')
            <button type="submit" class="flex items-center justify-center dark:bg-blue-600 bg-blue-600 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                <i class="fa-solid fa-file-export mx-1"></i>
                Export to PDF
            </button>
            </form>
            @endif
        </div>

        <div x-data="{ filtermodal: false }" x-cloak="{display: none}" x-init="open = false" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-hidden': open }"  class="relative">
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
                <div class="h-full overflow-y-auto">
                    <div class="grid gap-4 p-4 mb-5 sm:grid-cols-2 justify-items">
                        {{-- {{ dd($cat) }}
                        @foreach ($cat as $p)
                            <div class=" flex items-center">
                                <input wire:model.live="categories" id="cat-{{$p->id}}" type="checkbox" name="category" value="{{$p->id}}" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="cat-{{$p->id}}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $p->name }}</label>
                            </div>
                        @endforeach --}}
                    </div>
                </div>
            </div>
        </div>


        <div class="w-full hover:text-gray-900 md:w-auto flex items-center justify-center px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" >
            <div class="">
              <select wire:model.live="filtermasuk" id="underline_select" class="text-md dark:bg-gray-800 py-2.5 px-0 text-black bg-transparent border-0 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                  <option value="day" selected>Hari ini</option>
                  <option value="week">Seminggu</option>
                  <option value="month">Sebulan</option>
                  <option value="year">Setahun</option>
              </select>
            </div>
        </div>

    </div>
    <div class="overflow-x-auto w-full">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">No</th>
                    <th scope="col" class="px-4 py-3">Product</th>
                    <th scope="col" class="px-4 py-3">User</th>
                    <th scope="col" class="px-4 py-3">Type</th>
                    <th scope="col" class="px-4 py-3">Quantity</th>
                    <th scope="col" class="px-4 py-3">Date</th>
                    <th scope="col" class="px-4 py-3">Status</th>
                    <th scope="col" class="px-4 py-3">Notes</th>
                    
                </tr>
            </thead>
            <tbody>
                {{-- {{dd($stock)}} --}}
                @foreach ($stock as $index => $d)
                <tr class="border-b dark:border-gray-700 odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800">
                    <td class="px-4 py-3">{{$index+1}}</td>
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
                </tr>
                @endforeach
                <!--Update Main modal -->
            </tbody>
        </table>
        @empty ($stock->links())
        @else
        {{$stock->links('pagination::tailwind')}}
        @endempty
    </div>
</div>
