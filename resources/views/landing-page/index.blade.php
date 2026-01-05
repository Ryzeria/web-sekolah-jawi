<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Landing Page</title>
    <meta name="description"
        content="Landing page Created by Asbobi Mulyo using Laravel 12 Flowbite, Tailwind CSS, Alpine js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
        integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

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
    <div class="main-page" x-data="landingpageData">
        {{-- navbar by flowbite --}}
        <nav class="bg-white border-gray-200 dark:bg-gray-900 fixed w-full z-50 top-0 left-0 shadow">
            <div class="container flex flex-wrap items-center justify-between mx-auto p-2">
                <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="{{ asset('assets/logo.png') }}" class="h-12" alt="Landing Page Logo" />
                    {{-- <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Landing Page</span> --}}
                </a>
                <button data-collapse-toggle="navbar-default" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
                <div class="hidden w-full md:block md:w-auto font-inter" id="navbar-default">
                    <ul
                        class="flex flex-col md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        <template x-for="menu in navmenu">
                            <li>
                                <a :href="menu.href" class="transition duration-300 ease-in-out"
                                    @click="activeMenu = menu.text"
                                    :class="{
                                        'block font-medium text-sm py-2 px-3 text-white md:text-primary bg-blue-700 rounded-sm md:bg-transparent md:p-0 dark:text-white md:dark:text-blue-500': activeMenu ===
                                            menu.text,
                                        'block font-normal text-sm py-2 px-3 text-gray-500 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-primary md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent': activeMenu !==
                                            menu.text
                                    }">
                                    <span x-text="menu.text"></span>
                                </a>
                            </li>
                        </template>
                    </ul>
                </div>
                <a href="/login">
                    <button
                        class="bg-primary hover:bg-primary/80 text-white text-[13px] font-medium py-3 px-6 rounded-md transition duration-300 cursor-pointer">
                        DEMO APLIKASI
                    </button>
                </a>
            </div>
        </nav>

        <div class="main-content pt-16" id="beranda">
            {{-- carousel by flowbite --}}
            <div id="default-carousel" class="relative w-full" data-carousel="slide">
                <div class="relative h-56 md:h-[calc(100vh-64px)] overflow-hidden">
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <div class="relative w-full h-full">
                            <img src="https://placehold.co/1920x1080/ECF1F8/E1E1E1?text=+"
                                class="absolute inset-0 w-full h-full object-cover -z-10" alt="Background">
                            <div class="absolute inset-0 bg-[#ECF1F854] flex items-center">
                                <div class="container mx-auto px-6 md:px-12 flex items-center">
                                    <div class="w-full max-w-xl">
                                        <h2 class="text-base md:text-5xl font-semibold text-black mb-4 leading-14">
                                            Buat Efisien dengan
                                            Manajemen Sekolah
                                        </h2>
                                        <p class="text-base text-black mb-6 max-w-2xl leading-8">Membantu anda menjadi
                                            lebih efisien dalam me-manajemen seluruh aktifitas administrasi sekolah
                                            menggunakan 1 aplikasi saja. Sistem otomatis, terdokumentasi dengan rapi,
                                            mudah dimonitoring, dan penyimpanan data base on cloud..</p>
                                    </div>
                                    <div class="ml-auto">
                                        <img src="{{ asset('assets/landingpage-hero.png') }}" alt="hero-image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach ($sliders as $slider)
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            {{-- Use standard Blade echo for all attributes and text --}}
                            <img src="{{ asset('storage/' . $slider->image_url) }}"
                                class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                alt="{{ $slider->title }}">

                            <div class="absolute inset-0 bg-black/40"></div>
                            <div class="absolute top-1/2 left-10 md:left-24 -translate-y-1/2 text-white p-4 max-w-lg">
                                <h3 class="text-2xl md:text-5xl font-bold">{{ $slider->title }}</h3>
                                <p class="text-sm md:text-lg mt-4">{{ $slider->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                        data-carousel-slide-to="0"></button>

                    @foreach ($sliders as $loop)
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="false"
                            aria-label="Slide {{ $loop->iteration + 1 }}"
                            data-carousel-slide-to="{{ $loop->iteration }}"></button>
                    @endforeach
                </div>
                <button type="button"
                    class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-prev>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/30 group-hover:bg-primary/50">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 1 1 5l4 4" />
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button"
                    class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-next>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/30 group-hover:bg-primary/50">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>

            <div class="clients py-8">
                <div class="container mx-auto">
                    <div class="overflow-x-auto scrollbar-none">
                        <div class="flex">
                            <template x-for="client in clients">
                                <div class="px-20">
                                    <img :src="client.logo" alt=""
                                        class="h-18 max-w-40 object-contain mix-blend-multiply opacity-60 hover:opacity-100 transition-opacity duration-300">
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>



            <section class="py-20 overflow-hidden relative">
                <div
                    class="gimmick-ball absolute -top-40 -left-10 bg-primary w-0 h-0 md:w-[200px] md:h-[200px] lg:w-[400px] lg:h-[400px] rounded-full -z-1">
                </div>
                <div
                    class="gimmick-ball absolute -bottom-40 -right-20 bg-primary w-0 h-0 md:w-[200px] md:h-[200px] lg:w-[300px] lg:h-[300px] rounded-full -z-1">
                </div>

                <div class="container mx-auto">
                    <h2 class="text-center mb-12 text-3xl font-medium font-inter text-gray-700">
                        Yang sudah Menggunakan Aplikasi Kami
                    </h2>

                    <div class="max-w-[800px] mx-auto">
                        <div class="grid grid-cols-2 gap-4 md:gap-12">
                            <div class="px-5 py-10 text-center bg-white shadow-lg rounded-md">
                                <p class="text-xl mb-3 text-gray-700">Sekolah</p>
                                <span class="text-3xl text-primary font-medium">200</span>
                            </div>
                            <div class="px-5 py-10 text-center bg-white shadow-lg rounded-md">
                                <p class="text-xl mb-3 text-gray-700">Murid</p>
                                <span class="text-3xl text-primary font-medium">200.000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="py-20 font-inter" id="layanan">
                <div class="container mx-auto">
                    <div class="section-title mb-18">
                        <h2 class="text-center text-3xl mb-4 font-semibold text-gray-800">
                            Pilihan Paket
                        </h2>
                        <p class="text-center text-gray-600 mb-12">Pilihan Paket yang tersedia dalam pelayanan kami</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 px-4">

                        {{-- Loop through each package from the controller --}}
                        @foreach ($paket as $item)
                            <div
                                class="bg-white rounded-lg border overflow-hidden transition-all duration-300
                            {{-- Conditionally add styles for the popular package --}}
                            @if ($item->is_popular) shadow-lg border-primary hover:-translate-y-1
                            @else
                                border-slate-300 hover:shadow-lg hover:border-secondary @endif
                            ">

                                {{-- Conditionally show the 'Terpopuler' banner --}}
                                @if ($item->is_popular)
                                    <div class="bg-primary text-white px-6 py-1.5 text-sm text-center">Terpopuler</div>
                                @endif

                                <div class="px-6 pt-8 pb-14">
                                    {{-- DYNAMIC: Package Name --}}
                                    <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $item->nama_paket }}</h3>
                                    {{-- DYNAMIC: Package Description --}}
                                    <p class="text-gray-600 text-sm mb-5">{{ $item->deskripsi }}</p>

                                    <div class="mb-8">
                                        <div class="mb-2">
                                            {{-- DYNAMIC: Formatted Price --}}
                                            <span class="text-3xl font-bold text-secondary">Rp
                                                {{ number_format($item->harga, 0, ',', '.') }}</span>
                                            <span class="text-sm">/ bulan</span>
                                        </div>

                                        {{-- Conditionally show discount info --}}
                                        @if ($item->diskon_persen > 0 && $item->harga_normal)
                                            <span class="text-gray-400 line-through">Rp
                                                {{ number_format($item->harga_normal, 0, ',', '.') }}</span>
                                            <span
                                                class="ml-2 text-sm bg-secondary/10 text-secondary font-medium px-2 py-1 rounded">
                                                Diskon {{ $item->diskon_persen }}%
                                            </span>
                                        @endif
                                    </div>

                                    <button
                                        class="w-full bg-white outline hover:bg-primary text-primary hover:text-white font-medium py-2 px-4 rounded-md transition duration-300 mb-8">
                                        Pilih Paket
                                    </button>

                                    {{-- DYNAMIC: Feature list --}}
                                    <ul class="space-y-3">
                                        {{-- Loop through each feature included in the current package --}}
                                        @foreach ($item->fiturs as $paket_fitur)
                                            <li class="flex items-center text-gray-700">
                                                {{-- Checkmark Icon --}}
                                                <div
                                                    class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                                    <svg class="w-4 h-4 text-white" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>

                                                {{-- Container for title and value badge --}}
                                                <div class="flex items-center w-full">
                                                    {{-- Feature Title --}}
                                                    <span>{{ $paket_fitur->title }}</span>
                                                    {{-- Conditionally show the value as a styled badge --}}
                                                    @if ($paket_fitur->type === 'string' && $paket_fitur->pivot->value)
                                                        <span
                                                            class="ml-4 text-sm font-medium text-sky-800 bg-sky-100 px-3 py-0.5 rounded-full">
                                                            {{ $paket_fitur->pivot->value }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>

            <section class="py-20 font-inter" id="fitur">
                <div class="container mx-auto">
                    <div class="section-title mb-12">
                        <h2 class="text-center text-3xl mb-4 font-semibold text-gray-800">
                            Daftar Fitur
                        </h2>
                        <p class="text-center text-gray-600 mb-12">Aplikasi kami memiliki fitur-fitur yang lengkap</p>
                    </div>
                    <div class="h-[calc(100vh-84px)] overflow-y-auto">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                            {{-- 1. Define the styles array in PHP --}}
                            @php
                                $fiturStyles = [
                                    'bg-[#01006C] rounded-tr-[40px] rounded-bl-[40px]',
                                    'bg-[#306899] rounded-tl-[40px] rounded-br-[40px]',
                                    'bg-[#01006C] rounded-tr-[40px] rounded-bl-[40px]',
                                    'bg-[#FCBA00] rounded-tl-[40px] rounded-br-[40px]',
                                    'bg-[#01006C] rounded-tr-[40px] rounded-bl-[40px]',
                                    'bg-[#FCBA00] rounded-tl-[40px] rounded-br-[40px]',
                                    'bg-[#01006C] rounded-tr-[40px] rounded-bl-[40px]',
                                    'bg-[#306899] rounded-tl-[40px] rounded-br-[40px]',
                                ];
                            @endphp

                            {{-- 2. Replace the Alpine <template> with a Blade @foreach loop --}}
                            @foreach ($fitur as $fiturr)
                                {{-- 3. Apply a style from the array using the loop index --}}
                                <div class="px-6 py-12 {{ $fiturStyles[$loop->index % count($fiturStyles)] }}">
                                    <div class="text-center text-white">
                                        {{-- 4. Use data from the $fitur object --}}
                                        {{-- IMPORTANT: Assumes 'icon' is stored in 'storage/app/public/...' --}}
                                        <img src="{{ asset('storage/' . $fiturr->icon) }}"
                                            alt="{{ $fiturr->title }} Icon" class="inline-block h-20 w-20">
                                        {{-- Added consistent sizing for icons --}}
                                        <h3 class="py-4 text-xl font-semibold">
                                            {{ $fiturr->title }}
                                        </h3>
                                        <p class="text-base pb-4">
                                            {!! $fiturr->description !!}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </section>

            <section class="py-20 font-inter" id="keunggulan">
                <div class="section-title mb-12">
                    <h2 class="text-center text-3xl mb-4 font-semibold text-gray-800">
                        Mengapa Harus SistemSekolah.id ?
                    </h2>
                    <p class="text-center text-gray-600 mb-12">Kami sangat merekomendasikan SistemSekolah.id</p>
                </div>
                <div class="relative overflow-hidden">

                    {{-- carousel structure for "Keunggulan" --}}
                    <div class="container mx-auto">
                        <div class="relative h-auto overflow-hidden">
                            <div class="flex transition-transform duration-300 ease-in-out -mx-2"
                                id="keunggulan-carousel">

                                @php
                                    // Define alternating styles for the cards
                                    $keunggulanStyles = ['bg-gray-200', 'bg-[#FCBA00]', 'bg-gray-200'];
                                @endphp

                                @foreach ($alasan as $alasann)
                                    <div class="w-full md:w-1/3 p-2 flex-shrink-0">
                                        {{-- Use the loop index to cycle through the styles --}}
                                        <div
                                            class="{{ $keunggulanStyles[$loop->index % count($keunggulanStyles)] }} px-5 py-10 rounded-[10px] text-center h-full">
                                            <div class="icon text-center">
                                                <img src="{{ asset('storage/' . $alasann->icon) }}"
                                                    alt="{{ $alasann->title }} Icon" class="inline-block h-20 w-20">
                                            </div>
                                            <h3 class="py-4 text-2xl font-semibold">
                                                {{ $alasann->title }}
                                            </h3>
                                            <p class="text-base pb-4">
                                                {!! $alasann->description !!}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <button id="keunggulan-prev"
                            class="absolute left-2 top-1/2 -translate-y-1/2 z-10 p-2 rounded-full bg-white/70 shadow-md hover:bg-gray-100 focus:outline-none ml-2 disabled:opacity-50">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button id="keunggulan-next"
                            class="absolute right-2 top-1/2 -translate-y-1/2 z-10 p-2 rounded-full bg-white/70 shadow-md hover:bg-gray-100 focus:outline-none mr-2 disabled:opacity-50">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                    </div>

                </div>

            </section>

            <section class="py-20 font-inter" id="testimoni">
                <div class="section-title mb-12">
                    <h2 class="text-center text-3xl mb-4 font-semibold text-gray-800">
                        Apa Kata Mereka
                    </h2>
                    <p class="text-center text-gray-600 mb-12">Testimoni yang diberikan oleh para pengguna</p>
                </div>

                <div class="relative overflow-hidden">
                    <div class="container mx-auto">
                        <div class="relative h-auto md:h-96 overflow-hidden">
                            {{--  carousel ID for clarity --}}
                            <div class="flex transition-transform duration-300 ease-in-out -mx-2"
                                id="testimoni-carousel">

                                {{-- Loop through testimoni data from the controller --}}
                                @foreach ($testimoni as $testimonii)
                                    <div class="w-full md:w-1/3 p-2 flex-shrink-0">
                                        <div
                                            class="bg-gray-200 rounded-lg px-6 py-12 h-full text-center flex flex-col justify-center">
                                            <div class="mb-6">
                                                <img src="{{ asset('storage/' . $testimonii->foto_url) }}"
                                                    alt="Foto {{ $testimonii->nama }}"
                                                    class="inline-block size-40 object-cover rounded-full border-4 border-white shadow-lg">
                                            </div>
                                            <h3 class="text-2xl font-semibold mb-1">{{ $testimonii->nama }}</h3>
                                            <p class="text-gray-500 text-sm mb-4">{{ $testimonii->profesi }}</p>
                                            <p class="text-gray-600 line-clamp-4">
                                                {!! $testimonii->pesan !!}</p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        {{-- Updated button IDs to match the carousel --}}
                        <button id="testimoni-prev"
                            class="absolute left-2 top-1/2 -translate-y-1/2 z-10 p-2 rounded-full bg-white shadow-md hover:bg-gray-100 focus:outline-none ml-2 disabled:opacity-50">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button id="testimoni-next"
                            class="absolute right-2 top-1/2 -translate-y-1/2 z-10 p-2 rounded-full bg-white shadow-md hover:bg-gray-100 focus:outline-none mr-2 disabled:opacity-50">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <section class="py-20 font-inter" id="galeri">
                    <div class="section-title mb-12">
                        <h2 class="text-center text-3xl mb-4 font-semibold text-gray-800">
                            Galeri
                        </h2>
                        <p class="text-center text-gray-600 mb-12">Dokumentasi yang ada di SistemSekolah.id</p>
                    </div>

                    <div class="container mx-auto">
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                            <template x-for="image in gallery">
                                <a href="">
                                    <div class="overflow-hidden h-72 rounded-lg relative">
                                        <div
                                            class="absolute top-0 left-0 h-72 w-full transition-all duration-300 bg-black opacity-0 hover:opacity-50">
                                        </div>
                                        <img :src="image.src" alt="" class="w-full h-full object-cover">
                                    </div>
                                </a>
                            </template>

                        </div>
                    </div>

                </section>
        </div>

    </div>

    <footer class="bg-gray-100 pt-12 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Tentang Kami -->
                <div class="mb-8 md:mb-0">
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('assets/logo.png') }}" alt="SISKA SistemSekolah.id" class="h-12">
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Tentang Kami</h3>
                    <p class="text-gray-600 text-sm">
                        SISKA SistemSekolah.id Sistem Informasi Manajemen Sekolah
                    </p>
                    <p class="text-gray-600 text-sm mt-2">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.
                    </p>
                </div>

                <!-- Kontak Kami -->
                <div class="mb-8 md:mb-0">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Kontak Kami</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-phone-alt mr-3 text-primary w-5"></i>
                            <span>0812345xxxxx</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-envelope mr-3 text-primary w-5"></i>
                            <span>email@mail.com</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-globe mr-3 text-primary w-5"></i>
                            <span>sekolah.co</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-map-marker-alt mr-3 text-primary w-5"></i>
                            <span>Jl. Mawar No. 30 Bandung</span>
                        </li>
                    </ul>
                </div>

                <!-- Menu -->
                <div>
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Menu</h3>
                    <ul class="space-y-2">
                        <li><a href="/login" class="text-gray-600 hover:text-primary transition-colors">Login</a>
                        </li>
                        <li><a href="#layanan"
                                class="text-gray-600 hover:text-primary transition-colors">Kerjasama</a>
                        </li>
                        <li><a href="#keunggulan"
                                class="text-gray-600 hover:text-primary transition-colors">Manfaat</a>
                        </li>
                        <li><a href="#testimoni"
                                class="text-gray-600 hover:text-primary transition-colors">Testimoni</a>
                        </li>
                        <li><a href="" class="text-gray-600 hover:text-primary transition-colors">Kontak
                                Kami</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-200 mt-12 pt-8 text-center text-gray-500 text-sm">
                <p>© {{ date('Y') }} SISKA SistemSekolah.id. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    {{-- mini-Caraousel --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Generic function to initialize a carousel
            function setupCarousel(carouselId, prevBtnId, nextBtnId) {
                const carousel = document.getElementById(carouselId);
                if (!carousel) return; // Exit if carousel not found

                const items = carousel.querySelectorAll(':scope > div');
                const prevBtn = document.getElementById(prevBtnId);
                const nextBtn = document.getElementById(nextBtnId);
                const itemCount = items.length;
                let currentIndex = 0;

                function getItemsToShow() {
                    if (window.innerWidth < 768) return 1; // Mobile
                    if (window.innerWidth < 1024) return 2; // Tablet
                    return 3; // Desktop
                }

                function updateCarousel() {
                    const itemsToShow = getItemsToShow();
                    // We move one item at a time, which is simpler for this transform logic
                    const itemWidth = carousel.querySelector(':scope > div').offsetWidth;

                    // Use transform with a calculation for better responsiveness
                    carousel.style.transform = `translateX(-${currentIndex * itemWidth}px)`;

                    prevBtn.disabled = currentIndex === 0;
                    nextBtn.disabled = currentIndex >= itemCount - itemsToShow;
                }

                prevBtn.addEventListener('click', function() {
                    if (currentIndex > 0) {
                        currentIndex--;
                        updateCarousel();
                    }
                });

                nextBtn.addEventListener('click', function() {
                    const itemsToShow = getItemsToShow();
                    if (currentIndex < itemCount - itemsToShow) {
                        currentIndex++;
                        updateCarousel();
                    }
                });

                // Handle window resize
                window.addEventListener('resize', () => {
                    // Reset to avoid issues
                    currentIndex = 0;
                    updateCarousel();
                });

                // Initial setup
                updateCarousel();
            }

            // Initialize both carousels
            setupCarousel('keunggulan-carousel', 'keunggulan-prev', 'keunggulan-next');
            setupCarousel('testimoni-carousel', 'testimoni-prev', 'testimoni-next');
        });
    </script>
    {{-- Data Placeholder --}}
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("landingpageData", () => ({
                navmenu: [{
                        text: 'Beranda',
                        href: '#beranda'
                    },
                    {
                        text: 'Layanan',
                        href: '#layanan'
                    },
                    {
                        text: 'Fitur',
                        href: '#fitur'
                    },
                    {
                        text: 'Keunggulan',
                        href: '#keunggulan'
                    },
                    {
                        text: 'Testimoni',
                        href: '#testimoni'
                    },
                    {
                        text: 'Galeri',
                        href: '#galeri'
                    },
                ],
                activeMenu: 'Beranda',
                init() {
                    this.activeMenu = this.navmenu[0].text;
                    //bisa diubah sesuai menu aktif dari PHP
                },
                // carouselItems: [{
                //         title: 'lorem 1',
                //         description: 'lorem inpum dowo 1',
                //         image: 'https://dummyimage.com/1200x800/000/fff'
                //     },
                //     {
                //         title: 'lorem 2',
                //         description: 'lorem inpum dowo 2',
                //         image: 'https://dummyimage.com/1200x800/000/fff'
                //     },
                //     {
                //         title: 'lorem 3',
                //         description: 'lorem inpum dowo 3',
                //         image: 'https://dummyimage.com/1200x800/000/fff'
                //     },
                //     {
                //         title: 'lorem 4',
                //         description: 'lorem inpum dowo 4',
                //         image: 'https://dummyimage.com/1200x800/000/fff'
                //     },
                //     {
                //         title: 'lorem 5',
                //         description: 'lorem inpum dowo 5',
                //         image: 'https://dummyimage.com/1200x800/000/fff'
                //     },
                // ],
                clients: [{
                        logo: "https://afindo-inf.com/public/storage/klien/64ae44dfe9f3e.jpg",
                    },
                    {
                        logo: "https://afindo-inf.com/public/storage/klien/64b0e6c3bee79.png",
                    },
                    {
                        logo: "https://afindo-inf.com/public/storage/klien/64ae5ea03d39e.png",
                    },
                    {
                        logo: "https://afindo-inf.com/public/storage/klien/64ae5baa62759.png",
                    },
                    {
                        logo: "https://afindo-inf.com/public/storage/klien/64ae590a91f83.jpg",
                    },
                    {
                        logo: "https://afindo-inf.com/public/storage/klien/64ae588f61849.png",
                    },
                    {
                        logo: "https://afindo-inf.com/public/storage/klien/64ae5059583b0.jpeg",
                    },
                    {
                        logo: "https://afindo-inf.com/public/storage/klien/64ae4e36475cd.png",
                    },
                    {
                        logo: "https://afindo-inf.com/public/storage/klien/64ae4d51ce51d.png",
                    },
                    {
                        logo: "https://afindo-inf.com/public/storage/klien/64ae4c99e2111.jpg",
                    },
                    {
                        logo: "https://afindo-inf.com/public/storage/klien/64ae4ba1a1dd5.jpg",
                    }
                ],
                // listFitur: [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}],
                // fiturStyles: [
                //     'bg-[#01006C] rounded-tr-[40px] rounded-bl-[40px]',
                //     'bg-[#306899] rounded-tl-[40px] rounded-br-[40px]',
                //     'bg-[#01006C] rounded-tr-[40px] rounded-bl-[40px]',
                //     'bg-[#FCBA00] rounded-tl-[40px] rounded-br-[40px]',
                //     'bg-[#01006C] rounded-tr-[40px] rounded-bl-[40px]',
                //     'bg-[#FCBA00] rounded-tl-[40px] rounded-br-[40px]',
                //     'bg-[#01006C] rounded-tr-[40px] rounded-bl-[40px]',
                //     'bg-[#306899] rounded-tl-[40px] rounded-br-[40px]',
                // ],
                getFiturClass(index) {
                    index = index % this.fiturStyles.length;
                    return this.fiturStyles[index];
                },
                gallery: [{
                        src: '{{ asset('assets/images/image-1.jpg') }}'
                    },
                    {
                        src: '{{ asset('assets/images/image-2.jpg') }}'
                    },
                    {
                        src: '{{ asset('assets/images/image-3.jpg') }}'
                    },
                    {
                        src: '{{ asset('assets/images/image-1.jpg') }}'
                    },
                    {
                        src: '{{ asset('assets/images/image-2.jpg') }}'
                    },
                    {
                        src: '{{ asset('assets/images/image-1.jpg') }}'
                    },
                    {
                        src: '{{ asset('assets/images/image-3.jpg') }}'
                    },
                    {
                        src: '{{ asset('assets/images/image-2.jpg') }}'
                    },
                ],
            }))
        })
    </script>
</body>

</html>
