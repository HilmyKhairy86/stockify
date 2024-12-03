@section('title', 'Report')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="px-4 pt-2">
        <div class="mb-5 border dark:border-gray-800 dark:bg-gray-800 rounded-lg shadow-lg bg-white border-gray-200">
            <div class="p-5">
                <h2 class="mb-2 text-5xl font-bold text-gray-900 dark:text-white">Laporan</h2>
                {{-- <h2 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Halo, {{auth()->user()->name}}</h2> --}}
            </div>
        </div>
        @livewire('KeluarMasukReport')
        {{-- @livewire('ProdKeluarMasuk') --}}
        
        <!-- Card Footer -->

        <!-- 2 columns -->
        {{-- masuk keluar --}}
        {{-- @livewire('MasukKeluar') --}}
    </div> 
    
</x-app-layout>

