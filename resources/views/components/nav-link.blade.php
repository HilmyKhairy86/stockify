@props(['active' => false])
<a {{ $attributes}} class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-700 dark:text-white {{ $active ? 'bg-gray-700 dark:bg-gray-700' : 'text-white opacity-75' }}  dark:text-white">{{ $slot }}</a>

{{-- flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 --}}