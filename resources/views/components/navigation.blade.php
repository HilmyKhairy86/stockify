<div class="antialiased bg-gray-50 dark:bg-gray-900">
    <x-nav></x-nav>
    <!-- Sidebar -->
    <x-sidebar></x-sidebar>
    <main class="p-1 md:ml-64 h-auto pt-20">
      {{ $slot }}
    </main>
</div>