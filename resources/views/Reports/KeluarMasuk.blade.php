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
        <div class="mb-5 border dark:border-gray-800 dark:bg-gray-800 rounded-lg shadow-lg bg-white border-gray-200">
            <div  class="relative p-3">
                @if (auth()->user()->role == 'admin')
                    <form action="{{ route('admin.exportpdfkel') }}" method="post">
                    @csrf
                    <button type="submit" class="flex items-center justify-center dark:bg-blue-600 bg-blue-600 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <i class="fa-solid fa-file-export mx-1"></i>
                        Export to PDF
                    </button>
                    </form>
                @elseif (auth()->user()->role == 'manajer_gudang')
                    <form action="{{ route('manager.exportpdfkel') }}" method="post">
                    @csrf
                    <button type="submit" class="flex items-center justify-center dark:bg-blue-600 bg-blue-600 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <i class="fa-solid fa-file-export mx-1"></i>
                        Export to PDF
                    </button>
                    </form>
                @endif
            </div>
        </div>
        @livewire('KeluarMasukReport')
    </div> 
    
</x-app-layout>

