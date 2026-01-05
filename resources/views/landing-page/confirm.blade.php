<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
        integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body {
            /* --- MULTIPLE BACKGROUND IMAGES --- */
            /* The first image is the top layer, the second is the bottom layer. */
            background-image: url("{{ asset('assets/images/Frame-1.png') }}"),
                url("{{ asset('assets/images/Background-1.png') }}");

            /* --- SIZING FOR EACH LAYER --- */
            /* The first value applies to the first image, the second to the second, etc. */
            background-size: cover, cover;

            /* --- Other properties for each layer --- */
            background-position: center, center;
            background-repeat: no-repeat, no-repeat;
            background-attachment: fixed, fixed;
            /* Both backgrounds will be fixed */
        }
    </style>
</head>

<body>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        {{-- The Glassmorphism Card --}}
        <div
            class="w-full bg-white/30 backdrop-blur-lg rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">

            {{-- Card Header --}}
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <img src="{{ asset('assets/logo.png') }}" class="h-12" alt="SISKA Logo" />
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    ✅ Registration Successful!
                </h1>
                <p class="text-sm font-light text-gray-900 dark:text-gray-300">
                    Your account has been created. Please save this information securely.
                </p>

                {{-- Confirmation Details --}}
                <div class="space-y-3">
                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-base font-normal text-gray-700 dark:text-gray-300">Nama Sekolah</dt>
                        <dd class="text-base font-medium text-gray-900 dark:text-white">{{ $user->nama_sekolah }}</dd>
                    </dl>

                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-base font-normal text-gray-700 dark:text-gray-300">ID Sekolah</dt>
                        <dd class="text-base font-medium text-green-500">{{ $user->id_sekolah }}</dd>
                    </dl>

                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-base font-normal text-gray-700 dark:text-gray-300">Email</dt>
                        <dd class="text-base font-medium text-gray-900 dark:text-white">{{ $user->email_sekolah }}</dd>
                    </dl>

                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-base font-normal text-gray-700 dark:text-gray-300">Nomor Telepon</dt>
                        <dd class="text-base font-medium text-gray-900 dark:text-white">{{ $user->nomor_telepon }}</dd>
                    </dl>

                    <dl
                        class="flex items-center justify-between gap-4 pt-3 border-t border-gray-400/50 dark:border-gray-600">
                        <dt class="text-base font-bold text-gray-900 dark:text-white">Link Sekolah</dt>
                        <dd class="text-base font-bold text-gray-900 dark:text-white">{{ $user->link_sekolah }}</dd>
                    </dl>
                </div>

                {{-- Login Button --}}
                <a href="{{ route('login') }}"
                    class="block w-full px-5 py-2.5 text-sm font-medium text-center text-white rounded-lg bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Proceed to Login
                </a>
            </div>
        </div>
    </div>
</body>

</html>
