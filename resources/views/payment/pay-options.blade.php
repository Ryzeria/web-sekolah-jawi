<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Metode Pembayaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
        integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        body {
            background-image: url("{{ asset('assets/images/Frame-1.png') }}"),
                url("{{ asset('assets/images/Background-1.png') }}");
            background-size: cover, cover;
            background-position: center, center;
            background-repeat: no-repeat, no-repeat;
            background-attachment: fixed, fixed;
        }
    </style>
</head>

<body>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        {{-- The Glassmorphism Card --}}
        <div
            class="w-full bg-white/30 backdrop-blur-lg rounded-lg shadow dark:border sm:max-w-6xl xl:p-0 dark:bg-gray-800 dark:border-gray-700">

            {{-- Card Header --}}
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <img src="{{ asset('assets/logo.png') }}" class="h-12 mx-auto" alt="SISKA Logo" />
                <h1
                    class="text-xl font-bold leading-tight tracking-tight text-center text-gray-900 md:text-2xl dark:text-white">
                    Form Aktivasi Lisensi
                </h1>

                {{-- Form Content --}}
                <form class="space-y-4 md:space-y-6" action="{{ route('payment.process-payment-method') }}"
                    method="POST" x-data="{ selectedMethod: 'virtual_bni' }">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        {{-- Left Column: Payment Methods --}}
                        <div class="lg:col-span-2 space-y-6">
                            {{-- QRIS Section --}}
                            <div
                                class="bg-gray-50/70 p-6 rounded-lg border border-gray-300 dark:bg-gray-700/70 dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">QRIS</h3>
                                <div class="space-y-3">
                                    <label
                                        class="flex items-center p-4 bg-white/50 rounded-lg cursor-pointer hover:bg-white/70 dark:bg-gray-600/50 dark:hover:bg-gray-600/70"
                                        :class="selectedMethod === 'qris' ?
                                            'border-2 border-blue-600 dark:border-blue-500' :
                                            'border border-gray-300 dark:border-gray-500'">
                                        <input type="radio" name="payment_method" value="qris"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            x-model="selectedMethod">
                                        <div class="flex items-center ml-3">
                                            <img src="https://via.placeholder.com/40x30?text=QRIS" alt="QRIS"
                                                class="w-10 h-8 mr-3">
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">QRIS</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            {{-- Virtual Account Section --}}
                            <div
                                class="bg-gray-50/70 p-6 rounded-lg border border-gray-300 dark:bg-gray-700/70 dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Virtual Account
                                </h3>
                                <div class="space-y-3">
                                    <label
                                        class="flex items-center p-4 bg-white/50 rounded-lg cursor-pointer hover:bg-white/70 dark:bg-gray-600/50 dark:hover:bg-gray-600/70"
                                        :class="selectedMethod === 'virtual_bni' ?
                                            'border-2 border-blue-600 dark:border-blue-500' :
                                            'border border-gray-300 dark:border-gray-500'">
                                        <input type="radio" name="payment_method" value="virtual_bni"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            x-model="selectedMethod">
                                        <div class="flex items-center ml-3">
                                            <img src="https://via.placeholder.com/40x30?text=BNI" alt="BNI"
                                                class="w-10 h-8 mr-3 bg-orange-500 text-white text-xs flex items-center justify-center rounded">
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">Bank Negara
                                                Indonesia</span>
                                        </div>
                                    </label>

                                    <label
                                        class="flex items-center p-4 bg-white/50 rounded-lg cursor-pointer hover:bg-white/70 dark:bg-gray-600/50 dark:hover:bg-gray-600/70"
                                        :class="selectedMethod === 'virtual_bri' ?
                                            'border-2 border-blue-600 dark:border-blue-500' :
                                            'border border-gray-300 dark:border-gray-500'">
                                        <input type="radio" name="payment_method" value="virtual_bri"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            x-model="selectedMethod">
                                        <div class="flex items-center ml-3">
                                            <img src="https://via.placeholder.com/40x30?text=BRI" alt="BRI"
                                                class="w-10 h-8 mr-3 bg-blue-600 text-white text-xs flex items-center justify-center rounded">
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">Bank Negara
                                                Indonesia</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            {{-- ATM Section --}}
                            <div
                                class="bg-gray-50/70 p-6 rounded-lg border border-gray-300 dark:bg-gray-700/70 dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">ATM</h3>
                                <div class="space-y-3">
                                    <label
                                        class="flex items-center p-4 bg-white/50 rounded-lg cursor-pointer hover:bg-white/70 dark:bg-gray-600/50 dark:hover:bg-gray-600/70"
                                        :class="selectedMethod === 'atm_bni' ?
                                            'border-2 border-blue-600 dark:border-blue-500' :
                                            'border border-gray-300 dark:border-gray-500'">
                                        <input type="radio" name="payment_method" value="atm_bni"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            x-model="selectedMethod">
                                        <div class="flex items-center ml-3">
                                            <img src="https://via.placeholder.com/40x30?text=BNI" alt="BNI"
                                                class="w-10 h-8 mr-3 bg-orange-500 text-white text-xs flex items-center justify-center rounded">
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">Bank Negara
                                                Indonesia</span>
                                        </div>
                                    </label>

                                    <label
                                        class="flex items-center p-4 bg-white/50 rounded-lg cursor-pointer hover:bg-white/70 dark:bg-gray-600/50 dark:hover:bg-gray-600/70"
                                        :class="selectedMethod === 'atm_bri' ?
                                            'border-2 border-blue-600 dark:border-blue-500' :
                                            'border border-gray-300 dark:border-gray-500'">
                                        <input type="radio" name="payment_method" value="atm_bri"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            x-model="selectedMethod">
                                        <div class="flex items-center ml-3">
                                            <img src="https://via.placeholder.com/40x30?text=BRI" alt="BRI"
                                                class="w-10 h-8 mr-3 bg-blue-600 text-white text-xs flex items-center justify-center rounded">
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">Bank Negara
                                                Indonesia</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit"
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Lanjutkan
                            </button>
                        </div>

                        {{-- Right Column: Payment Information --}}
                        <div class="lg:col-span-1">
                            <div
                                class="bg-gray-50/70 p-6 rounded-lg border border-gray-300 dark:bg-gray-700/70 dark:border-gray-600 sticky top-4">
                                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Informasi Paket</h2>
                                <div class="space-y-3">
                                    <dl class="flex items-center justify-between">
                                        <dt class="text-sm font-normal text-gray-700 dark:text-gray-300">Nama Paket
                                        </dt>
                                        <dd class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $paket->nama_paket }}
                                        </dd>
                                    </dl>
                                    <dl class="flex items-center justify-between">
                                        <dt class="text-sm font-normal text-gray-700 dark:text-gray-300">Periode Paket
                                        </dt>
                                        <dd class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ ucfirst($activationData['periode']) }}
                                        </dd>
                                    </dl>
                                    <dl class="flex items-center justify-between">
                                        <dt class="text-sm font-normal text-gray-700 dark:text-gray-300">Harga</dt>
                                        <dd class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ number_format($activationData['pricing']['periode'] === 'tahunan' ? $paket->harga_normal * 12 : $paket->harga_normal, 0, ',', '.') }}
                                        </dd>
                                    </dl>
                                    @if ($activationData['periode'] === 'tahunan')
                                        <dl class="flex items-center justify-between">
                                            <dt class="text-sm font-normal text-red-600 dark:text-red-400">
                                                Diskon ({{ $paket->diskon_persen }}%)
                                            </dt>
                                            <dd class="text-sm font-medium text-red-600 dark:text-red-400">
                                                -{{ number_format($paket->harga_normal * 12 - $paket->harga * 12, 0, ',', '.') }}
                                            </dd>
                                        </dl>
                                    @endif
                                    <dl
                                        class="flex items-center justify-between pt-3 border-t border-gray-400/50 dark:border-gray-600">
                                        <dt class="text-base font-bold text-gray-900 dark:text-white">Total Bayar</dt>
                                        <dd class="text-base font-bold text-gray-900 dark:text-white">
                                            {{ number_format($activationData['pricing']['total'] * 12, 0, ',', '.') }}
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Error/Success Messages --}}
    @if ($errors->any())
        <div class="fixed top-4 right-4 z-50 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-lg"
            role="alert">
            <strong class="font-bold">Error!</strong>
            <ul class="mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>

</html>
