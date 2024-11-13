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

        {{-- add --}}
        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
            <div x-data="{ adddatamodal: false }" x-cloak="{display: none}" x-init="open = false" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-hidden': open }"  class="relative">
                <!-- Button to open drawer -->
                <button @click="adddatamodal = true" class="flex items-center justify-center dark:bg-blue-600 bg-blue-600 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800" type="button">
                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg>
                    Add Category
                </button>
                
                <div x-show="adddatamodal"
                class="fixed inset-0 bg-gray-800 bg-opacity-50 z-40" @click="adddatamodal = false"></div>
                
                <!-- Drawer -->
                <div x-show="adddatamodal" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform translate-x-0"
                    x-transition:leave-end="transform translate-x-full"
                    class="fixed top-0 right-0 z-50 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
                    <!-- Drawer Header -->
                    <div class="flex justify-between items-center">
                        <h5 id="drawer-label" class="text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">New Category</h5>
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
                        <form action="{{ route('addCategory') }}" method="POST">
                            @csrf
                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type category name" required="">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write category description here"></textarea>                    
                                </div>
                            </div>
                            <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                Add new category
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400 ">
                <tr>
                    <th scope="col" class="px-4 py-3"></th>
                    <th scope="col" class="px-4 py-3">Category name</th>
                    <th scope="col" class="px-4 py-3">Description</th>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cat as $d)
                <tr class="border-b dark:border-gray-700 odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800">
                    <td class="px-4 py-3"></td>
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $d->name }}</th>
                    <td class="px-4 py-3">{{ $d->description }}</td>
                    <td class="px-4 py-3 space-x-2 flex items-center">
                        
                        {{-- update modal --}}
                        <div x-data="{ openupdatemodal: false }" x-cloak="{display: none}" x-init="open = false" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-hidden': open }"  class="relative">
                            <!-- Button to open drawer -->
                            <button id="{{$d->id}}" @click="openupdatemodal = true" class="py-2 px-3 text-sm font-medium text-gray-500 bg-blue-500 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-blue-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-blue-700 dark:focus:ring-gray-600" type="button">
                                <i class="fa-solid fa-pen-to-square text-white"></i>
                            </button>
                            
                            <div id="{{$d->id}}" x-show="openupdatemodal"
                            class="fixed inset-0 bg-gray-800 bg-opacity-50 z-40" @click="openupdatemodal = false"></div>
                            
                            <!-- Drawer -->
                            <div id="{{$d->id}}" x-show="openupdatemodal" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0"
                                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform translate-x-0"
                                x-transition:leave-end="transform translate-x-full"
                                class="fixed top-0 right-0 z-50 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
                                <!-- Drawer Header -->
                                <div class="flex justify-between items-center">
                                    <h5 id="drawer-label" class="text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">New Product</h5>
                                    <button @click="openupdatemodal = false" aria-controls="drawer-create-product-default"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close menu</span>
                                    </button>
                                </div>
                                <div class="h-full overflow-y-auto">
                                    <form action="{{ route('updateCategory', $d->id)}}" method="POST">
                                        @csrf
                                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                            <div>
                                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                <input type="text" name="name" id="name" value="{{ $d->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                                            </div>
                                            <div class="sm:col-span-2">
                                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" >Description</label>
                                                <textarea id="description" name="description" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write a description...">{{$d->description}}</textarea>                    
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <button type="submit" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                Update Category
                                            </button>
                                            {{-- <button type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                                Delete
                                            </button> --}}
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
                            class="fixed inset-0 bg-gray-800 bg-opacity-50 z-40" @click="deletemodal = false"></div>
                            
                            <div id="{{$d->id}}" x-show="deletemodal"
                                class="fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
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
                                            <form action="{{ route('deleteCategory',$d->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
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
                    </td>
                </tr>
                @endforeach
                <!--Update Main modal -->
            </tbody>
        </table>
    </div>
    @empty ($cat->links())
    @else
    {{$cat->links('pagination::tailwind')}}
    @endempty
</div>

