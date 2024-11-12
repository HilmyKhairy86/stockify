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
            <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="flex items-center justify-center dark:bg-blue-600 bg-blue-600 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                </svg>
                Add product
            </button>
            <button type="button" id="importModalbutton" data-modal-target="importModal" data-modal-toggle="importModal" type="button" class="flex items-center justify-center dark:bg-blue-600 bg-blue-600 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                <i class="fa-solid fa-file-import"></i>
                Import
            </button>
            <div x-data="{ open: false }" x-show="open" @keydown.escape.window="open = false" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center" style="display: none;">
                <div class="relative w-96 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                    <!-- Close Button -->
                    <button type="button" @click="open = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 dark:text-gray-300 dark:hover:text-white">
                        &times;
                    </button>
            
                    <!-- Modal Header -->
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Import CSV File</h3>
            
                    <!-- Form -->
                    <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select File</label>
                            <input type="file" name="file" id="file" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 dark:text-gray-400 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
            
                        <div class="flex items-center justify-center">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none dark:focus:ring-blue-700">
                                Upload
                            </button>
                            <button type="button" @click="open = false" class="ml-2 px-4 py-2 bg-gray-300 text-gray-800 text-sm font-medium rounded-lg hover:bg-gray-400 focus:ring-4 focus:ring-gray-200 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div x-data="{ isOpen: false }" @click.away="isOpen = false" >
                <button @click="isOpen = !isOpen" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    <i class="fa-solid fa-download mr-2"></i>
                    Export
                    <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </button>
              
                <div x-show="isOpen" class="fixed w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                    <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                        <li class="items-center">
                            <form action="{{route('export')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <button type="submit" class="w-full dark:bg-blue-600 bg-blue-600 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                    <i class="fa-solid fa-download mr-2"></i>
                                    Export .CSV
                                </button>
                            </form>
                        </li>
                        <li class="items-center">
                            <form action="{{route('exportxls')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <button type="submit" class="w-full dark:bg-blue-600 bg-blue-600 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                    <i class="fa-solid fa-download mr-2"></i>
                                    Export .XLSX
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
                
            
    
            
            {{-- <form action="{{route('export')}}" method="post" enctype="multipart/form-data">
                @csrf
                <button type="submit" class="flex items-center justify-center dark:bg-blue-600 bg-blue-600 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                    <i class="fa-solid fa-download mr-2"></i>
                    Export
                </button>
            </form> --}}
            <div x-data="{ isOpen: false }" @click.away="isOpen = false" >
                <button @click="isOpen = !isOpen" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                    </svg>
                    Filter
                    <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </button>
              
                <div x-show="isOpen" class="fixed w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                    <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose Filter</h6>
                    <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                        @foreach ($cat as $p)
                        <li class="flex items-center">
                            <input wire:model.live="categories" id="cat-{{$p->id}}" type="checkbox" name="category" value="{{$p->id}}" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="cat-{{$p->id}}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $p->name }}</label>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3"><input type="checkbox" id="select-all"></th>
                    <th scope="col" class="px-4 py-3">Product name</th>
                    <th scope="col" class="px-4 py-3">Category</th>
                    <th scope="col" class="px-4 py-3">Suplier</th>
                    <th scope="col" class="px-4 py-3">SKU</th>
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
                    <td class="px-4 py-3">
                        <input type="checkbox" name="ids[]" value="{{ $d->id }}">
                        <script>
                            document.getElementById('select-all').addEventListener('change', function () {
                                const checkboxes = document.querySelectorAll('input[name="ids[]"]');
                                checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                            });
                        </script>
                    </td>
                    <td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $d->name }}</td>
                    <td class="px-4 py-3">{{ optional($d->category)->name }}</td>
                    <td class="px-4 py-3">{{ optional($d->supplier)->name }}</td>
                    <td class="px-4 py-3">{{ $d->sku }}</td>
                    <td class="px-4 py-3">{{ $d->purchase_price }}</td>
                    <td class="px-4 py-3">{{ $d->selling_price }}</td>
                    <td class="px-4 py-3">{{ $d->description }}</td>
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
                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                                style="display: none;"
                                >
                                <div class="relative w-full sm:max-w-md mx-auto bg-white dark:bg-gray-800 rounded-lg sm:rounded-lg shadow-lg p-4 sm:p-6 max-h-screen sm:max-h-[85vh] overflow-y-auto h-full sm:h-auto">
                                    <!-- Modal Header -->
                                    <div class="flex justify-between items-center pb-2 sm:pb-4 mb-2 sm:mb-4 border-b dark:border-gray-600">
                                        <h3 class="text-md sm:text-lg font-semibold text-gray-900 dark:text-white">Update Product</h3>
                                        <button @click="showUpdateModal = false" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 p-1 rounded dark:hover:bg-gray-600 dark:hover:text-white">
                                            <svg aria-hidden="true" class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Modal Body with Smaller Fields -->
                                    <form action="{{ route('updateProduct', $d->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                            <div>
                                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                <input type="text" name="name" id="name" value="{{ $d->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                            </div>
                                            <div>
                                                <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
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
                                            <form action="{{ route('deleteProduct', $d->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="py-2 px-4 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700">
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
    @empty ($products->links())
    @else
    {{$products->links('pagination::tailwind')}}
    @endempty
</div>
