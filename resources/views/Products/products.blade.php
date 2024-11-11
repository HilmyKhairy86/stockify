@section('title', 'Products')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
            <div class="mx-auto md:px-5 sm:px-5 lg:px-5">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    {{-- table --}}
                    @livewire('search')
                    <div id="importModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                            <!-- Modal content -->
                            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5 max-h-[80vh] overflow-y-auto">
                                <!-- Modal header -->
                                <div class="flex justify-between items-center pb-4 mb-4 rounded-t sm:mb-5 dark:border-gray-600">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        Import Product
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="importModal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->

                                {{-- work --}}
                                <form action="{{route('import')}}" method="post" enctype="multipart/form-data" id="dropzone">
                                    @csrf
                                    <div class="gap-4 mb-4">
                                        <div>
                                            <input type="file" name="file" id="" class="block w-full text-sm bg-white text-gray-400 dark:bg-gray-700 rounded-lg cursor-pointer border border-gray-600 focus:outline-none focus:border-blue-500">
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                        <i class="fa-solid fa-file-import"></i>
                                        Import
                                    </button>
                                </form>
                                <script type="text/javascript">
                                    Dropzone.options.dropzone =
                                    {
                                        addRemoveLinks: true,
                                        timeout: 60000,
                                        removedfile: function(file) 
                                        {
                                            var name = file.upload.filename;
                                            $.ajax({
                                                headers: {
                                                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                                        },
                                                type: 'POST',
                                                url: '{{ url("files/destroy") }}',
                                                data: {filename: name},
                                                success: function (data){
                                                    console.log("File has been successfully removed!!");
                                                },
                                                error: function(e) {
                                                    console.log(e);
                                                }});
                                                var fileRef;
                                                return (fileRef = file.previewElement) != null ? 
                                                fileRef.parentNode.removeChild(file.previewElement) : void 0;
                                        },
                                        success: function (file, response) {
                                            console.log(response);
                                        },
                                        error: function (file, response) {
                                            return false;
                                        }
                                    };
                                </script>




                                {{-- <form action="{{route('import')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="gap-4 mb-4">
                                        <div>
                                            <label for="image" class="block mb-2 text-sm font-medium text-white dark:text-white">Import Data</label>
                                            <input type="file" name="file" id="" class="block w-full text-sm text-gray-400 bg-gray-700 rounded-lg cursor-pointer border border-gray-600 focus:outline-none focus:border-blue-500">
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                        <i class="fa-solid fa-file-import"></i>
                                        Import
                                    </button>
                                </form> --}}
                                {{-- <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="gap-4 mb-4">
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-white dark:text-white">Import Data</label>
                                
                                            <!-- Drag and Drop Area -->
                                            <div 
                                                id="drop-zone" 
                                                class="block w-full text-sm text-gray-400 bg-gray-700 rounded-lg cursor-pointer border border-gray-600 focus:outline-none focus:border-blue-500 p-6 text-center"
                                                style="border-style: dashed; min-height: 100px;">
                                                <p class="text-gray-400">Drag & Drop your file here or click to select</p>
                                            </div>
                                
                                            <!-- Hidden File Input -->
                                            <input type="file" name="file" id="drop-zone" class="" onchange="updateFileName()" value="updateFileName()">
                                        </div>
                                    </div>
                                
                                    <button type="submit" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                        <i class="fa-solid fa-file-import"></i>
                                        Import
                                    </button>
                                </form>
                                
                                <!-- JavaScript for Drag and Drop -->
                                <script>
                                    const dropZone = document.getElementById('drop-zone');
                                    const fileInput = document.getElementById('file');
                                
                                    // Prevent default behavior when dragging over the drop zone
                                    dropZone.addEventListener('dragover', (e) => {
                                        e.preventDefault();
                                        dropZone.style.backgroundColor = "#2d3748";  // Change color on hover
                                    });
                                
                                    // Handle when a file is dropped
                                    dropZone.addEventListener('drop', (e) => {
                                        e.preventDefault();
                                        dropZone.style.backgroundColor = "#4a5568";  // Reset background color
                                        const files = e.dataTransfer.files;
                                        if (files.length > 0) {
                                            fileInput.files = files;  // Add the dropped file to the input
                                            updateFileName(files[0].name);  // Update the label with the file name
                                        }
                                    });
                                
                                    // Allow clicking on the drop zone to open file selector
                                    dropZone.addEventListener('click', () => {
                                        fileInput.click();  // Trigger file input click
                                    });
                                
                                    // Update the displayed file name when a file is selected
                                    function updateFileName(fileName = '') {
                                        const label = dropZone.querySelector('p');
                                        if (fileName) {
                                            label.textContent = `Selected file: ${fileName}`;
                                        } else {
                                            label.textContent = 'Drag & Drop your file here or click to select';
                                        }
                                    }
                                
                                    // For when a file is selected via the file input
                                    fileInput.addEventListener('change', () => {
                                        const file = fileInput.files[0];
                                        if (file) {
                                            updateFileName(file.name);
                                        }
                                    });
                                
                                    // Optional: Ensure form submits when there is a valid file
                                    document.querySelector('form').addEventListener('submit', function (event) {
                                        if (fileInput.files.length === 0) {
                                            alert('Please select a file to import!');
                                            event.preventDefault();  // Prevent form submission if no file is selected
                                        }
                                    });
                                </script> --}}
                                
                                                               
                            </div>
                        </div>
                    </div>
                    

                    
                    
                </div>
            </div>
            </section>

            {{-- addproduct --}}
            <!-- Main modal -->
            <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                    <!-- Modal content -->
                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5 max-h-[80vh] overflow-y-auto">
                        <!-- Modal header -->
                        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Add Product
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="{{ route('addProduct') }}" method="POST">
                            @csrf
                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                                </div>
                                <div>
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
                            <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                Add new product
                            </button>
                        </form>
                    </div>
                </div>
            </div>
              {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.3/dist/cdn.min.js" defer></script> --}}
</x-app-layout>


