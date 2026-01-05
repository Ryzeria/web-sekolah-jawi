<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'SistemSekolah.id' }}</title>
    <meta name="description"
        content="Admin page created by Fawwaz Al-Jawi using Laravel 12 Flowbite, Tailwind CSS, Alpine js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
        integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .scrollbar-none::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .scrollbar-none {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>

    {{-- alpine --}}
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>
    {{-- Removed x-data="{ isSidebarOpen: false }" as it's no longer needed --}}
    <div class="main-page">
        {{-- Navbar --}}
        <x-adminpage.navbar>
            <x-slot:title>
                {{ $title ?? 'menu' }}
            </x-slot:title>
        </x-adminpage.navbar>

        {{-- Sidebar --}}
        <x-adminpage.sidebar></x-adminpage.sidebar>

        {{-- Replaced the conditional :class with a permanent ml-64 --}}
        <main class="ml-64 flex flex-col items-center p-4 pt-20">
            <header>
                {{ $header ?? '' }}
            </header>

            <div class="w-full">
                {{ $content ?? 'Konten' }}
            </div>
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    {{-- Sidebar position script --}}
    <script>
        function adjustSidebar() {
            const navbar = document.getElementById('main-navbar');
            const sidebar = document.getElementById('default-sidebar');

            if (navbar && sidebar) {
                // Get the rendered height of the navbar
                const navbarHeight = navbar.offsetHeight;

                // Set the sidebar's top style to be exactly below the navbar
                sidebar.style.top = navbarHeight + 'px';

                // Optional: Adjust the sidebar's height to fill the remaining space
                sidebar.style.height = `calc(100vh - ${navbarHeight}px)`;
            }
        }

        // Run the function on page load
        document.addEventListener('DOMContentLoaded', adjustSidebar);

        // Run the function again if the window is resized
        window.addEventListener('resize', adjustSidebar);
    </script>
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    @stack('scripts')
</body>

</html>
