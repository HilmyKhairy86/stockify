<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
        <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
        <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
        tailwind.config = {
            content: ["./*.html"],
            theme: {
            extend: {
                colors: {
                primary: {
                    blue: {
                    light: "#00ccdd"
                    }
                }
                }
            }
            },
            darkMode: "class"
        };
        </script>

        <!-- Scripts -->
        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
        <script>
            var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
            
            // Change the icons inside the button based on previous settings
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                themeToggleLightIcon.classList.remove('hidden');
            } else {
                themeToggleDarkIcon.classList.remove('hidden');
            }
            
            var themeToggleBtn = document.getElementById('theme-toggle');
            
            themeToggleBtn.addEventListener('click', function() {
            
                // toggle icons inside button
                themeToggleDarkIcon.classList.toggle('hidden');
                themeToggleLightIcon.classList.toggle('hidden');
            
                // if set via local storage previously
                if (localStorage.getItem('color-theme')) {
                    if (localStorage.getItem('color-theme') === 'light') {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    }
            
                // if NOT set via local storage previously
                } else {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                }
                
            });
            
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="grid grid-cols-1 my-4 xl:grid-cols-2 xl:gap-4">
            <!-- Activity Card -->
            <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 xl:mb-0">
                <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Product Masuk</h3>
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                      <tr>
                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                          Product Name
                        </th>
                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                          SKU
                        </th>
                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                          Status
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        @foreach ($masuk as $m) 
                        <tr>
                          <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                            {{$m->product->name}}
                          </td>
                          <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                            {{$m->product->sku}}
                          </td>
                          <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                            @switch($m->status)
                                @case('pending')
                                    <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-600 dark:text-yellow-200">
                                        <span class="w-2 h-2 me-1 bg-yellow-500 rounded-full"></span>
                                        Pending
                                    </span>
                                    @break
                                @case('diterima')
                                    <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                        <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                        Diterima
                                    </span>
                                    @break
                                @case('ditolak')
                                    <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                        <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                        Ditolak
                                    </span>
                                    @break
                                @case('dikeluarkan')
                                    <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                        <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                        Dikeluarkan
                                    </span>
                                    @break
                                @default
                            @endswitch
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
              <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Product Keluar</h3>
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                  <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                      <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                        Product Name
                      </th>
                      <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                        SKU
                      </th>
                      <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                        Status
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white dark:bg-gray-800">
                      @foreach ($keluar as $k) 
                      <tr>
                        <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                          {{$k->product->name}}
                        </td>
                        <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                          {{$k->product->sku}}
                        </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                          @switch($k->status)
                              @case('pending')
                                  <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-600 dark:text-yellow-200">
                                      <span class="w-2 h-2 me-1 bg-yellow-500 rounded-full"></span>
                                      Pending
                                  </span>
                                  @break
                              @case('diterima')
                                  <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                      <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                      Diterima
                                  </span>
                                  @break
                              @case('ditolak')
                                  <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                      <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                      Ditolak
                                  </span>
                                  @break
                              @case('dikeluarkan')
                                  <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                      <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                      Dikeluarkan
                                  </span>
                                  @break
                              @default
                          @endswitch
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
        </div>
    </body>
</html>
