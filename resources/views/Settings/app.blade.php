<?php
use Illuminate\Support\Facades\DB;

$appName = DB::table("app_settings")->value("app_name");
$appLogo = DB::table("app_settings")->value("logo");
?>
@section('title', 'Settings')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="px-4 pt-2">
        <div class="mb-5 border dark:border-gray-800 dark:bg-gray-800 rounded-lg shadow-lg bg-white border-gray-200">
            <div class="p-5">
                <h2 class="mb-5 text-5xl font-bold text-gray-900 dark:text-white">Settings</h2>
                <div class="bg-white dark:bg-gray-800 relative overflow-hidden">
                    <form action="{{route('admin.updateSettings')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">App Name</label>
                                <input type="text" name="app_name" id="app_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ $appName }}" required="">
                            </div>
                            <div class="sm:col-span-2">
                                <label for="logo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                                <input type="file" name="logo" accept="image/jpeg,image/png" id="logo" class="block w-full text-sm text-gray-400 bg-white dark:bg-gray-700 rounded-lg cursor-pointer border border-gray-600 focus:outline-none focus:border-blue-500" value="{{ $appLogo }}">
                            </div>
                            @if ($appLogo)
                            <div class="sm:col-span-2">
                                <img for="image" src="{{ asset('storage/'.$appLogo ) }}" class="block w-20 h-20 object-cover rounded-lg border border-gray-600" />
                            </div>
                            @endif
                        </div>
                        <button type="submit" class=" text-white dark:text-white inline-flex items-center bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
