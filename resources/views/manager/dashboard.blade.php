@section('title', 'Dashboard')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div>
            <div>
                Stok Menipis
            </div>
        </div>
        barang masuk hari ini
        barang keluar hari ini
    </section>
</x-app-layout>
