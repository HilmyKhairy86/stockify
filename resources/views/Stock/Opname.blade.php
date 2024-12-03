@section('title', 'Stock Opname')
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
                        <h2 class="mb-2 text-5xl font-bold text-gray-900 dark:text-white">Stock Opname</h2>
                        {{-- <h2 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Halo, {{auth()->user()->name}}</h2> --}}
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    {{-- table --}}
                    @livewire('StockOpname')
                </div>
            </div>
        </section>
</x-app-layout>