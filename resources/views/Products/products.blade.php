@section('title', 'Products')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if (session('success'))
        <!-- Modal toggle -->
        <div x-data="{ isOpen: true }" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-y-hidden': open }">
            <!-- Modal -->
            <div 
                x-show="isOpen" 
                @click.self="isOpen = false"
                class="fixed inset-0 z-50 flex items-center justify-center w-full h-screen bg-black bg-opacity-50"
                x-cloak
                x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
            >
                <div class="relative p-4 w-full max-w-2xl bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Success!
                        </h3>
                        <button 
                            @click="isOpen = false" 
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white"
                        >
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal Body -->
                    <div class="p-4 text-center">
                        <h3 class="text-4xl font-semibold text-gray-900 dark:text-white">
                            Action Success!
                        </h3>
                    </div>
                    <!-- Modal Footer -->
                    <div class="flex items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button 
                            @click="isOpen = false" 
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto md:px-5 sm:px-5 lg:px-5">
            <!-- Start coding here -->
            <div class="mb-5 border dark:border-gray-800 dark:bg-gray-800 rounded-lg shadow-lg bg-white border-gray-200">
                <div class="p-5">
                    <h2 class="mb-2 text-5xl font-bold text-gray-900 dark:text-white">Products</h2>
                    {{-- <h2 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Halo, {{auth()->user()->name}}</h2> --}}
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                {{-- table --}}
                @livewire('search')
            </div>
        </div>
    </section>
    
  
</x-app-layout>


