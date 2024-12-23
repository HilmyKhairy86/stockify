@section('title', 'Stock Minimum Setting')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
            <div class="mx-auto md:px-5 sm:px-5 lg:px-5">
                <!-- Start coding here -->
                <div class="mb-5 border dark:border-gray-800 dark:bg-gray-800 rounded-lg shadow-lg bg-white border-gray-200">
                    <div class="p-5">
                        <h2 class="mb-2 text-5xl font-bold text-gray-900 dark:text-white">Stock Minimum</h2>
                        {{-- <h2 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Halo, {{auth()->user()->name}}</h2> --}}
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    {{-- content --}}
                    @livewire('StockMinimum')
                </div>
            </div>
        </section>

            @if (session('success'))
            <div id="info-popup" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-4 w-full max-w-lg h-full md:h-auto">
                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 md:p-8">
                        <div class="mb-4 text-sm font-light text-gray-500 dark:text-gray-400">
                            <h3 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">Data Added</h3>
                            <p>
                                Data Successfuly added
                            </p>
                        </div>
                        <div class="justify-between items-center pt-0 space-y-4 sm:flex sm:space-y-0">
                            <div class="items-center space-y-4 sm:space-x-4 sm:flex sm:space-y-0">
                                <button id="close-modal" type="button"  class="py-2 px-4 w-full text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 sm:w-auto hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            @endif
</x-app-layout>


