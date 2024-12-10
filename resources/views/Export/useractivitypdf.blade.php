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
        <style>
            @page {
                margin: 20px;
            }
            thead {
                display: table-header-group;
            }
            tbody {
                page-break-inside: avoid;
            }
            tfoot {
                display: table-footer-group;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">No</th>
                        <th scope="col" class="px-4 py-3">User</th>
                        <th scope="col" class="px-4 py-3">Activity</th>
                        <th scope="col" class="px-4 py-3">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $d)
                    <tr class="border-b dark:border-gray-700 odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800">
                        <td class="px-4 py-3">{{ $index + 1}}</td>
                        <td class="px-4 py-3">{{ $d->user_id }} - {{ $d->user->name }}</td>
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                            {{ $d->kegiatan }}
                        </th>
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                            {{ $d->tanggal }}
                        </th>
                    </tr>
                    @endforeach
                    <!--Update Main modal -->
                </tbody>
            </table>
        </div>
    </body>
</html>
