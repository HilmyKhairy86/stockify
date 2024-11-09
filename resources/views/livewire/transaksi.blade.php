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
            <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button" class="flex items-center justify-center dark:bg-blue-600 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                </svg>
                Add Transaction
            </button>
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
                        {{-- @foreach ($cat as $p) --}}
                        <li class="flex items-center">
                            <input wire:model.live="types" id="" type="checkbox" name="type" value="masuk" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Masuk</label>
                        </li>
                        <li class="flex items-center">
                            <input wire:model.live="types" id="cat-" type="checkbox" name="type" value="keluar" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Keluar</label>
                        </li>
                        {{-- @endforeach --}}
                    </ul>
                    <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Status</h6>
                    <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                        <li class="flex items-center">
                            <input wire:model.live="status" id="" type="checkbox" name="status" value="diterima" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Diterima</label>
                        </li>
                        <li class="flex items-center">
                            <input wire:model.live="status" id="" type="checkbox" name="status" value="pending" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Pending</label>
                        </li>
                        <li class="flex items-center">
                            <input wire:model.live="status" id="" type="checkbox" name="status" value="ditolak" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Ditolak</label>
                        </li>
                        <li class="flex items-center">
                            <input wire:model.live="status" id="" type="checkbox" name="status" value="dikeluarkan" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Dikeluarkan</label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3"></th>
                                    <th scope="col" class="px-4 py-3">Product</th>
                                    <th scope="col" class="px-4 py-3">User</th>
                                    <th scope="col" class="px-4 py-3">Type</th>
                                    <th scope="col" class="px-4 py-3">Quantity</th>
                                    <th scope="col" class="px-4 py-3">Date</th>
                                    <th scope="col" class="px-4 py-3">Status</th>
                                    <th scope="col" class="px-4 py-3">Notes</th>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- {{dd($stock)}} --}}
                @foreach ($stock as $d)
                <tr class="border-b dark:border-gray-700 odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800">
                    <td class="px-4 py-3"></td>
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$d->product_id}} - {{ $d->product_name }}</th>
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $d->user_id }} - {{$d->user_name}}</th>
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $d->type }}</th>
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
                    <td class="px-4 py-3 flex items-center">
                    <div class="flex justify-end space-x-2" x-data="{ showUpdateModal: false, showDeleteModal: false }" x-init="
                        // Prevent background scroll when modal is open
                        () => {
                            $watch('showUpdateModal', value => {
                                document.body.style.overflow = value ? 'hidden' : '';
                            });
                            $watch('showDeleteModal', value => {
                                document.body.style.overflow = value ? 'hidden' : '';
                            });
                        }">
                            {{-- update btn --}}
                            <div id="-{{$d->id}}" class="mx-2">
                                <button @click="showUpdateModal = true" class="py-2 px-3 text-sm font-medium text-gray-500 bg-blue-500 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-blue-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-blue-700 dark:focus:ring-gray-600" type="button">
                                    <i class="fa-solid fa-pen-to-square text-white"></i>
                                </button>
                            </div>
                            {{-- delete btn --}}
                            <div>
                                <button @click="showDeleteModal = true" class="py-2 px-3 text-sm font-medium text-gray-500 bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-red-900 focus:z-10 dark:red-blue-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-red-900 dark:focus:ring-gray-600" type="button">
                                    <i class="fa-solid fa-trash text-white"></i>
                                </button>
                            </div>

                            {{-- modal --}}
                            <!-- Update Modal -->
                            <div
                                id="{{$d->id}}"
                                x-show="showUpdateModal"
                                @keydown.escape.window="showUpdateModal = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-20"
                                style="display: none;"
                                >
                                <div class="relative w-full sm:max-w-md mx-auto bg-white dark:bg-gray-800 rounded-lg sm:rounded-lg shadow-lg p-4 sm:p-6 max-h-screen sm:max-h-[85vh] overflow-y-auto h-full sm:h-auto">
                                    <!-- Modal Header -->
                                    <div class="flex justify-between items-center pb-2 sm:pb-4 mb-2 sm:mb-4 border-b dark:border-gray-600">
                                        <h3 class="text-md sm:text-lg font-semibold text-gray-900 dark:text-white">Update User</h3>
                                        <button @click="showUpdateModal = false" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 p-1 rounded dark:hover:bg-gray-600 dark:hover:text-white">
                                            <svg aria-hidden="true" class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Modal Body with Smaller Fields -->
                                    <form action="" method="POST">
                                        @csrf
                                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                            <div>
                                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product ID</label>
                                                <input value="{{$d->product_id}}" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                                            </div>
                                            <div>
                                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User ID</label>
                                                <input value="{{$d->user_id}}" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                                            </div>
                                            <div>
                                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                                <select id="category" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                                    <option value="" hidden disabled selected>Type</option>
                                                    <option value="masuk" {{ $d->type === 'masuk' ? 'selected' : '' }}>Masuk</option>
                                                    <option value="keluar" {{ $d->type === 'keluar' ? 'selected' : '' }}>Keluar</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="sku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                                                <input value="{{$d->quantity}}" type="number" name="quantity" id="sku" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                            </div>
                                            <div>
                                                <label for="sku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                                                <input value="{{$d->date}}" type="date" name="date" id="sku" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                            </div>
                                            <div>
                                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                                <select id="category" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
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
                                                Update Transaction
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <!-- Delete Modal -->
                            <div
                                x-show="showDeleteModal"
                                @keydown.escape.window="showDeleteModal = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                                style="display: none;"
                            >
                                <div class="relative w-full max-w-md mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                                    <div class="text-center">
                                        <p class="text-gray-500 dark:text-gray-300">Are you sure you want to delete this item?</p>
                                        <div class="flex justify-center mt-4 space-x-4">
                                            <button @click="showDeleteModal = false" class="py-2 px-4 text-sm font-medium text-gray-500 bg-white border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                                                No, cancel
                                            </button>
                                            <form action="{{ route('deleteUser',$d->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                    Yes, I'm sure
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                <!--Update Main modal -->
            </tbody>
        </table>
    </div>
    {{-- @empty ($sup->links())
    @else
    {{$sup->links('pagination::tailwind')}}
    @endempty --}}
</div>



