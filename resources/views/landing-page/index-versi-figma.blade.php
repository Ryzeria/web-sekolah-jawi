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
                    <img src="{{ url('') }}/assets/logo.png" class="h-12" alt="Landing Page Logo" />
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
                <!-- Carousel wrapper -->
                <div class="relative h-56 md:h-[calc(100vh-64px)] overflow-hidden">
                    <!-- Item Default -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <div class="relative w-full h-full">
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
                                        <img src="{{ url('') }}/assets/landingpage-hero.png" alt="hero-image">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <template x-for="carouselItem in carouselItems">
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img :src="carouselItem.image"
                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                alt="carousel-image">
                            <div class="absolute top-1/2 left-10 translate-y-1/2">
                                <p x-text="carouselItem.title"></p>
                                <p x-text="carouselItem.description"></p>
                            </div>
                        </div>
                    </template>

                </div>
                <!-- Slider indicators -->
                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="true" :aria-label="'Slide 0'"
                        :data-carousel-slide-to="0"></button>
                    <template x-for="(carouselItem, i) in carouselItems">
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="true"
                            :aria-label="'Slide ' + (i + 1)" :data-carousel-slide-to="(i + 1)"></button>
                    </template>
                </div>
                <!-- Slider controls -->
                <button type="button"
                    class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-prev>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/30 dark:bg-gray-800/30 group-hover:bg-primary/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
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
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/30 dark:bg-gray-800/30 group-hover:bg-primary/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
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
                        <!-- Paket Single -->
                        <div
                            class="bg-white rounded-lg border border-slate-300 overflow-hidden hover:shadow-lg hover:border-secondary transition-all duration-300">
                            <div class="px-6 pt-8 pb-14">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">Paket Single</h3>
                                <p class="text-gray-600 text-sm mb-5">Cocok untuk sekolah dengan 1 unit sekolah</p>

                                <div class="mb-8">
                                    <div class="mb-2">
                                        <span class="text-3xl font-bold text-secondary">Rp 1.500.000</span>
                                        <span class="text-sm">/ bulan</span>
                                    </div>
                                    <span class="text-gray-400 line-through">Rp 2.000.000</span>
                                    <span
                                        class="ml-2 text-sm bg-secondary/10 text-secondary font-medium px-2 py-1 rounded">Diskon
                                        25%</span>
                                </div>

                                <button
                                    class="w-full bg-white outline hover:bg-primary text-primary hover:text-white font-medium py-2 px-4 rounded-md transition duration-300 mb-8">
                                    Pilih Paket
                                </button>

                                <ul class="space-y-3">
                                    <li class="flex items-center text-gray-700">
                                        <div
                                            class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span>1 Unit Sekolah</span>
                                    </li>
                                    <li class="flex items-center text-gray-700">
                                        <div
                                            class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span>Unlimited User</span>
                                    </li>
                                    <li class="flex items-center text-gray-700">
                                        <div
                                            class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span>Gratis Update</span>
                                    </li>
                                    <li class="flex items-center text-gray-700">
                                        <div
                                            class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span>Gratis Update</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Paket Medium -->
                        <div
                            class="bg-white rounded-lg border border-slate-300 overflow-hidden hover:shadow-lg hover:border-secondary transition-all duration-300">
                            <div class="px-6 pt-8 pb-14">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">Paket Medium</h3>
                                <p class="text-gray-600 text-sm mb-5">Cocok untuk sekolah dengan 2 unit sekolah</p>

                                <div class="mb-8">
                                    <div class="mb-2">
                                        <span class="text-[28px] font-bold text-secondary">Rp 2.500.000</span>
                                        <span class="text-sm">/ bulan</span>
                                    </div>
                                    <span class="text-gray-400 line-through">Rp 2.000.000</span>
                                    <span
                                        class="ml-2 text-sm bg-secondary/10 text-secondary font-medium px-2 py-1 rounded">Diskon
                                        25%</span>
                                </div>

                                <button
                                    class="w-full bg-white outline hover:bg-primary text-primary hover:text-white font-medium py-2 px-4 rounded-md transition duration-300 mb-8">
                                    Pilih Paket
                                </button>

                                <ul class="space-y-3">
                                    <li class="flex items-center text-gray-700">
                                        <div
                                            class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span>1 Unit Sekolah</span>
                                    </li>
                                    <li class="flex items-center text-gray-700">
                                        <div
                                            class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span>Unlimited User</span>
                                    </li>
                                    <li class="flex items-center text-gray-700">
                                        <div
                                            class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span>Gratis Update</span>
                                    </li>
                                    <li class="flex items-center text-gray-700">
                                        <div
                                            class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span>Gratis Update</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Paket Premium -->
                        <div
                            class="bg-white rounded-lg border overflow-hidden shadow-lg border-primary transition-all duration-300 hover:-translate-y-1">
                            <div class="bg-primary text-white px-6 py-1.5 text-sm">Terpopuler</div>
                            <div class="px-6 pt-8 pb-14">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">Paket Premium</h3>
                                <p class="text-gray-600 text-sm mb-5">Cocok untuk sekolah dengan 3 unit sekolah</p>

                                <div class="mb-8">
                                    <div class="mb-2">
                                        <span class="text-[28px] font-bold text-secondary">Rp 3.000.000</span>
                                        <span class="text-sm">/ bulan</span>
                                    </div>
                                    <span class="text-gray-400 line-through">Rp 2.000.000</span>
                                    <span
                                        class="ml-2 text-sm bg-secondary/10 text-secondary font-medium px-2 py-1 rounded">Diskon
                                        25%</span>
                                </div>

                                <button
                                    class="w-full bg-white outline hover:bg-primary text-primary hover:text-white font-medium py-2 px-4 rounded-md transition duration-300 mb-8">
                                    Pilih Paket
                                </button>

                                <ul class="space-y-3">
                                    <li class="flex items-center text-gray-700">
                                        <div
                                            class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span>1 Unit Sekolah</span>
                                    </li>
                                    <li class="flex items-center text-gray-700">
                                        <div
                                            class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span>Unlimited User</span>
                                    </li>
                                    <li class="flex items-center text-gray-700">
                                        <div
                                            class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span>Gratis Update</span>
                                    </li>
                                    <li class="flex items-center text-gray-700">
                                        <div
                                            class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span>Gratis Update</span>
                                    </li>
                                    <li class="flex items-center text-gray-700">
                                        <div
                                            class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span>Gratis Update</span>
                                    </li>
                                    <li class="flex items-center text-gray-700">
                                        <div
                                            class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span>Gratis Update</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Paket Advance -->
                        <div
                            class="bg-white rounded-lg border border-slate-300 overflow-hidden hover:shadow-lg hover:border-secondary transition-all duration-300">
                            <div class="px-6 pt-8 pb-14">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">Paket Advance</h3>
                                <p class="text-gray-600 text-sm mb-5">Cocok untuk sekolah dengan 4 unit sekolah</p>

                                <div class="mb-8">
                                    <div class="mb-2">
                                        <span class="text-[28px] font-bold text-secondary">Rp 4.000.000</span>
                                        <span class="text-sm">/ bulan</span>
                                    </div>
                                    <span class="text-gray-400 line-through">Rp 2.000.000</span>
                                    <span
                                        class="ml-2 text-sm bg-secondary/10 text-secondary font-medium px-2 py-1 rounded">Diskon
                                        25%</span>
                                </div>

                                <button
                                    class="w-full bg-white outline hover:bg-primary text-primary hover:text-white font-medium py-2 px-4 rounded-md transition duration-300 mb-8">
                                    Pilih Paket
                                </button>

                                <ul class="space-y-3">
                                    <li class="flex items-center text-gray-700">
                                        <div
                                            class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span>1 Unit Sekolah</span>
                                    </li>
                                    <li class="flex items-center text-gray-700">
                                        <div
                                            class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span>Unlimited User</span>
                                    </li>
                                    <li class="flex items-center text-gray-700">
                                        <div
                                            class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span>Gratis Update</span>
                                    </li>
                                    <li class="flex items-center text-gray-700">
                                        <div
                                            class="bg-secondary w-5 h-5 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span>Gratis Update</span>
                                    </li>
                                </ul>
                            </div>
                        </div>


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

                            <template x-for="(fitur, index) in listFitur">
                                <div class="px-6 py-12" :class="getFiturClass(index)">
                                    <div class="text-center text-white">
                                        <img src="{{ url('') }}/assets/image-icons/folder.svg" alt=""
                                            class="inline-block">
                                        <h3 class="py-4 text-xl font-semibold">
                                            Administrasi
                                        </h3>
                                        <p class="text-base pb-4">
                                            Data administrasi sekolah akan tersimpan oleh sistem dan bisa dicari,
                                            termonitoring
                                            dan aman.
                                        </p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-20 font-inter" id="keunggulan">
                <div class="container mx-auto">
                    <div class="section-title mb-12">
                        <h2 class="text-center text-3xl mb-4 font-semibold text-gray-800">
                            Mengapa Harus SistemSekolah.id ?
                        </h2>
                        <p class="text-center text-gray-600 mb-12">Kami sangat merekomendasikan SistemSekolah.id</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <div class="bg-gray-200 px-5 py-10 rounded-[10px] text-center">
                            <div class="icon text-center">
                                <img src="{{ url('') }}/assets/image-icons/thumb.svg" class="inline-block">
                            </div>
                            <h3 class="py-4 text-2xl font-semibold">
                                Tim Pendamping
                            </h3>
                            <p class="text-base pb-4">
                                Untuk Penggunaan sistem ini,
                                SistemSekolah.id pengguna akan
                                diberikan pendampingan dalam mengoperasikan sistem.
                            </p>
                        </div>

                        <div class="bg-[#FCBA00] px-5 py-10 rounded-[10px] text-center">
                            <div class="icon text-center">
                                <img src="{{ url('') }}/assets/image-icons/book.svg" class="inline-block">
                            </div>
                            <h3 class="py-4 text-2xl font-semibold">
                                Tim Pendamping
                            </h3>
                            <p class="text-base pb-4">
                                Untuk Penggunaan sistem ini,
                                SistemSekolah.id pengguna akan
                                diberikan pendampingan dalam mengoperasikan sistem.
                            </p>
                        </div>


                        <div class="bg-gray-200 px-5 py-10 rounded-[10px] text-center">
                            <div class="icon text-center">
                                <img src="{{ url('') }}/assets/image-icons/folder.svg" class="inline-block">
                            </div>
                            <h3 class="py-4 text-2xl font-semibold">
                                Tim Pendamping
                            </h3>
                            <p class="text-base pb-4">
                                Untuk Penggunaan sistem ini,
                                SistemSekolah.id pengguna akan
                                diberikan pendampingan dalam mengoperasikan sistem.
                            </p>
                        </div>

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
                        <!-- Carousel wrapper -->
                        <div class="relative h-96 overflow-hidden">
                            <!-- Items -->
                            <div class="flex transition-transform duration-300 ease-in-out -mx-2"
                                id="features-carousel">
                                <!-- Item 1 -->
                                <div class="w-full md:w-1/3 p-2 flex-shrink-0">
                                    <div class="bg-gray-200 rounded-lg px-6 py-12 h-full text-center">
                                        <div class="rounded-full flex items-center justify-center mb-6">
                                            <img src="{{ url('') }}/assets/images/image-1.jpg"
                                                class="inline-block size-30 object-cover">
                                        </div>
                                        <h3 class="text-2xl font-semibold mb-5">Ani Putri Intansari</h3>
                                        <p class="text-gray-600 line-clamp-3">Lorem ipsum dolor sit amet consectetur
                                            adipisicing elit. Ullam blanditiis reprehenderit tempore! Eligendi suscipit
                                            facere reiciendis, repellendus minus aspernatur, ipsa quia molestias ad
                                            doloribus illum quisquam explicabo odit, sapiente beatae.</p>
                                    </div>
                                </div>
                                <!-- Item 2 -->
                                <div class="w-full md:w-1/3 p-2 flex-shrink-0">
                                    <div class="bg-gray-200 rounded-lg px-6 py-12 h-full text-center">
                                        <div class="rounded-full flex items-center justify-center mb-6">
                                            <img src="{{ url('') }}/assets/images/image-2.jpg"
                                                class="inline-block size-30 object-cover">
                                        </div>
                                        <h3 class="text-2xl font-semibold mb-5">Ani Putri Intansari</h3>
                                        <p class="text-gray-600 line-clamp-3">Lorem ipsum dolor sit amet consectetur
                                            adipisicing elit. Ullam blanditiis reprehenderit tempore! Eligendi suscipit
                                            facere reiciendis, repellendus minus aspernatur, ipsa quia molestias ad
                                            doloribus illum quisquam explicabo odit, sapiente beatae.</p>
                                    </div>
                                </div>
                                <!-- Item 3 -->
                                <div class="w-full md:w-1/3 p-2 flex-shrink-0">
                                    <div class="bg-gray-200 rounded-lg px-6 py-12 h-full text-center">
                                        <div class="rounded-full flex items-center justify-center mb-6">
                                            <img src="{{ url('') }}/assets/images/image-3.jpg"
                                                class="inline-block size-30 object-cover">
                                        </div>
                                        <h3 class="text-2xl font-semibold mb-5">Ani Putri Intansari</h3>
                                        <p class="text-gray-600 line-clamp-3">Lorem ipsum dolor sit amet consectetur
                                            adipisicing elit. Ullam blanditiis reprehenderit tempore! Eligendi suscipit
                                            facere reiciendis, repellendus minus aspernatur, ipsa quia molestias ad
                                            doloribus illum quisquam explicabo odit, sapiente beatae.</p>
                                    </div>
                                </div>
                                <!-- Item 4 -->
                                <div class="w-full md:w-1/3 p-2 flex-shrink-0">
                                    <div class="bg-gray-200 rounded-lg px-6 py-12 h-full text-center">
                                        <div class="rounded-full flex items-center justify-center mb-6">
                                            <img src="{{ url('') }}/assets/image-icons/folder.svg"
                                                class="inline-block">
                                        </div>
                                        <h3 class="text-2xl font-semibold mb-5">Ani Putri Intansari</h3>
                                        <p class="text-gray-600 line-clamp-3">Lorem ipsum dolor sit amet consectetur
                                            adipisicing elit. Ullam blanditiis reprehenderit tempore! Eligendi suscipit
                                            facere reiciendis, repellendus minus aspernatur, ipsa quia molestias ad
                                            doloribus illum quisquam explicabo odit, sapiente beatae.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slider controls -->
                    <button id="feature-prev"
                        class="absolute left-2 top-1/2 -translate-y-1/2 z-10 p-2 rounded-full bg-white shadow-md hover:bg-gray-100 focus:outline-none ml-2">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button id="feature-next"
                        class="absolute right-2 top-1/2 -translate-y-1/2 z-10 p-2 rounded-full bg-white shadow-md hover:bg-gray-100 focus:outline-none mr-2">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const carousel = document.getElementById('features-carousel');
                        const items = document.querySelectorAll('#features-carousel > div');
                        const itemCount = items.length;
                        let currentIndex = 0;
                        const itemsToShow = window.innerWidth < 768 ? 1 : 3;

                        function updateCarousel() {
                            const itemWidth = 100 / itemsToShow;
                            carousel.style.transform = `translateX(-${currentIndex * itemWidth}%)`;

                            // Disable/enable buttons based on current index
                            document.getElementById('feature-prev').disabled = currentIndex === 0;
                            document.getElementById('feature-next').disabled = currentIndex >= itemCount - itemsToShow;
                        }

                        // Handle window resize
                        window.addEventListener('resize', function() {
                            const newItemsToShow = window.innerWidth < 768 ? 1 : 3;
                            if (newItemsToShow !== itemsToShow) {
                                currentIndex = 0;
                                updateCarousel();
                            }
                        });

                        // Navigation buttons
                        document.getElementById('feature-prev').addEventListener('click', function() {
                            if (currentIndex > 0) {
                                currentIndex--;
                                updateCarousel();
                            }
                        });

                        document.getElementById('feature-next').addEventListener('click', function() {
                            if (currentIndex < itemCount - itemsToShow) {
                                currentIndex++;
                                updateCarousel();
                            }
                        });

                        // Initialize
                        updateCarousel();
                    });
                </script>

            </section>

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
                        <img src="{{ url('') }}/assets/logo.png" alt="SISKA SistemSekolah.id" class="h-12">
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
                        <li><a href="#" class="text-gray-600 hover:text-primary transition-colors">Login</a>
                        </li>
                        <li><a href="#" class="text-gray-600 hover:text-primary transition-colors">Profil</a>
                        </li>
                        <li><a href="#" class="text-gray-600 hover:text-primary transition-colors">Manfaat</a>
                        </li>
                        <li><a href="#" class="text-gray-600 hover:text-primary transition-colors">Testimoni</a>
                        </li>
                        <li><a href="#" class="text-gray-600 hover:text-primary transition-colors">Kontak
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
                carouselItems: [{
                        title: 'lorem 1',
                        description: 'lorem inpum dowo 1',
                        image: 'https://dummyimage.com/1200x800/000/fff'
                    },
                    {
                        title: 'lorem 2',
                        description: 'lorem inpum dowo 2',
                        image: 'https://dummyimage.com/1200x800/000/fff'
                    },
                    {
                        title: 'lorem 3',
                        description: 'lorem inpum dowo 3',
                        image: 'https://dummyimage.com/1200x800/000/fff'
                    },
                    {
                        title: 'lorem 4',
                        description: 'lorem inpum dowo 4',
                        image: 'https://dummyimage.com/1200x800/000/fff'
                    },
                    {
                        title: 'lorem 5',
                        description: 'lorem inpum dowo 5',
                        image: 'https://dummyimage.com/1200x800/000/fff'
                    },
                ],
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
                listFitur: [{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}],
                fiturStyles: [
                    'bg-[#01006C] rounded-tr-[40px] rounded-bl-[40px]',
                    'bg-[#306899] rounded-tl-[40px] rounded-br-[40px]',
                    'bg-[#01006C] rounded-tr-[40px] rounded-bl-[40px]',
                    'bg-[#FCBA00] rounded-tl-[40px] rounded-br-[40px]',
                    'bg-[#01006C] rounded-tr-[40px] rounded-bl-[40px]',
                    'bg-[#FCBA00] rounded-tl-[40px] rounded-br-[40px]',
                    'bg-[#01006C] rounded-tr-[40px] rounded-bl-[40px]',
                    'bg-[#306899] rounded-tl-[40px] rounded-br-[40px]',
                ],
                getFiturClass(index) {
                    index = index % this.fiturStyles.length;
                    return this.fiturStyles[index];
                },
                gallery: [{
                        src: '{{ url('') }}/assets/images/image-1.jpg'
                    },
                    {
                        src: '{{ url('') }}/assets/images/image-2.jpg'
                    },
                    {
                        src: '{{ url('') }}/assets/images/image-3.jpg'
                    },
                    {
                        src: '{{ url('') }}/assets/images/image-1.jpg'
                    },
                    {
                        src: '{{ url('') }}/assets/images/image-2.jpg'
                    },
                    {
                        src: '{{ url('') }}/assets/images/image-3.jpg'
                    },
                    {
                        src: '{{ url('') }}/assets/images/image-1.jpg'
                    },
                    {
                        src: '{{ url('') }}/assets/images/image-2.jpg'
                    },
                ],
            }))
        })
    </script>
</body>

</html>
