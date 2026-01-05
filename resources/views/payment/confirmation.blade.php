<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran</title>
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
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-screen lg:py-0">
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
                <form class="space-y-4 md:space-y-6" action="" method="POST" x-data="{
                    showSuccess: {{ session('payment_success') ? 'true' : 'false' }},
                    selectedMethod: '{{ $activationData['payment_method'] }}',
                    expandedSection: '{{ $activationData['payment_method'] }}',
                
                    submitPayment() {
                        // Submit the form normally to process payment
                        document.querySelector('form').submit();
                    },
                
                    toggleSection(section) {
                        this.expandedSection = this.expandedSection === section ? '' : section;
                    },
                
                    getSectionOrder() {
                        const sections = [
                            { id: 'qris', title: 'QRIS', icon: 'https://via.placeholder.com/40x30?text=QRIS' },
                            { id: 'virtual_account', title: 'Virtual Account', icon: null },
                            { id: 'atm', title: 'Transfer ATM', icon: null }
                        ];
                
                        // Move selected method to top
                        if (this.selectedMethod.includes('virtual')) {
                            return sections.sort((a, b) => a.id === 'virtual_account' ? -1 : b.id === 'virtual_account' ? 1 : 0);
                        } else if (this.selectedMethod.includes('atm')) {
                            return sections.sort((a, b) => a.id === 'atm' ? -1 : b.id === 'atm' ? 1 : 0);
                        } else {
                            return sections.sort((a, b) => a.id === 'qris' ? -1 : b.id === 'qris' ? 1 : 0);
                        }
                    }
                }"
                    x-init="// Auto expand selected payment method on load
                    if (selectedMethod.includes('virtual')) {
                        expandedSection = 'virtual_account';
                    } else if (selectedMethod.includes('atm')) {
                        expandedSection = 'atm';
                    } else {
                        expandedSection = 'qris';
                    }">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        {{-- Left Column: Payment Instructions --}}
                        <div class="lg:col-span-2 space-y-4">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Pembayaran</h2>

                            <div class="space-y-3">
                                {{-- Payment Summary --}}
                                <div
                                    class="bg-blue-50/70 p-4 rounded-lg border border-blue-300 dark:bg-blue-900/30 dark:border-blue-600">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            <span
                                                class="text-sm font-medium text-blue-800 dark:text-blue-200 mr-2">Biaya
                                                Admin</span>
                                        </div>
                                        <span class="text-sm font-bold text-blue-800 dark:text-blue-200">Rp 1.000</span>
                                    </div>
                                    <div class="flex justify-between items-center mt-2">
                                        <div class="flex items-center">
                                            @if ($activationData['payment_method'] === 'qris')
                                                <img src="https://via.placeholder.com/24x24?text=QR" alt="QRIS"
                                                    class="w-6 h-6 mr-2">
                                                <span
                                                    class="text-sm font-medium text-gray-900 dark:text-white">QRIS</span>
                                            @elseif(str_contains($activationData['payment_method'], 'virtual'))
                                                <div
                                                    class="w-6 h-6 mr-2 bg-{{ str_contains($activationData['payment_method'], 'bni') ? 'orange' : 'blue' }}-500 text-white text-xs flex items-center justify-center rounded">
                                                    {{ str_contains($activationData['payment_method'], 'bni') ? 'BNI' : 'BRI' }}
                                                </div>
                                                <span class="text-sm font-medium text-gray-900 dark:text-white">Bank
                                                    {{ str_contains($activationData['payment_method'], 'bni') ? 'Negara Indonesia' : 'Rakyat Indonesia' }}</span>
                                            @else
                                                <div
                                                    class="w-6 h-6 mr-2 bg-{{ str_contains($activationData['payment_method'], 'bni') ? 'orange' : 'blue' }}-500 text-white text-xs flex items-center justify-center rounded">
                                                    {{ str_contains($activationData['payment_method'], 'bni') ? 'BNI' : 'BRI' }}
                                                </div>
                                                <span class="text-sm font-medium text-gray-900 dark:text-white">Bank
                                                    {{ str_contains($activationData['payment_method'], 'bni') ? 'Negara Indonesia' : 'Rakyat Indonesia' }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Virtual Account Number --}}
                                    @if (str_contains($activationData['payment_method'], 'virtual'))
                                        <div class="mt-3 p-3 bg-white/50 rounded border dark:bg-gray-700/50">
                                            <div class="flex justify-between items-center">
                                                <span class="text-xs text-gray-600 dark:text-gray-400">Nomor Virtual
                                                    Account</span>
                                                <button type="button" class="text-blue-600 text-xs hover:underline"
                                                    onclick="navigator.clipboard.writeText('12345xxxxxx')">
                                                    <i class="fas fa-copy mr-1"></i>Salin
                                                </button>
                                            </div>
                                            <div class="text-lg font-mono font-bold text-gray-900 dark:text-white mt-1">
                                                12345xxxxxx
                                            </div>
                                            <p class="text-xs text-green-600 dark:text-green-400 mt-1">
                                                <i class="fas fa-info-circle mr-1"></i>
                                                Proses verifikasi kurang dari 10 menit setelah pembayaran berhasil
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                {{-- Payment Instructions Sections --}}
                                {{-- QRIS Section --}}
                                <div class="bg-gray-50/70 rounded-lg border border-gray-300 dark:bg-gray-700/70 dark:border-gray-600"
                                    x-show="selectedMethod === 'qris' || expandedSection === 'qris'">
                                    <button type="button"
                                        class="w-full p-4 text-left flex justify-between items-center hover:bg-gray-100/50 dark:hover:bg-gray-600/50 rounded-lg"
                                        @click="toggleSection('qris')"
                                        :class="expandedSection === 'qris' ? 'bg-gray-100/50 dark:bg-gray-600/50' : ''">
                                        <div class="flex items-center">
                                            <i class="fas fa-qrcode text-gray-600 dark:text-gray-400 mr-3"></i>
                                            <span class="font-medium text-gray-900 dark:text-white">Petunjuk QRIS</span>
                                        </div>
                                        <i class="fas fa-chevron-down transform transition-transform duration-200"
                                            :class="expandedSection === 'qris' ? 'rotate-180' : ''"></i>
                                    </button>

                                    <div x-show="expandedSection === 'qris'" x-collapse class="px-4 pb-4">
                                        <ol
                                            class="list-decimal list-inside space-y-2 text-sm text-gray-700 dark:text-gray-300">
                                            <li>Buka aplikasi mobile banking atau e-wallet yang mendukung QRIS</li>
                                            <li>Pilih menu "Bayar" atau "Scan QR"</li>
                                            <li>Arahkan kamera ke QR Code yang ditampilkan</li>
                                            <li>Periksa detail pembayaran dan jumlah yang harus dibayar</li>
                                            <li>Masukkan PIN atau konfirmasi pembayaran</li>
                                            <li>Simpan bukti pembayaran untuk konfirmasi</li>
                                        </ol>
                                    </div>
                                </div>

                                {{-- Virtual Account Section --}}
                                <div class="bg-gray-50/70 rounded-lg border border-gray-300 dark:bg-gray-700/70 dark:border-gray-600"
                                    x-show="selectedMethod.includes('virtual') || expandedSection === 'virtual_account'">
                                    <button type="button"
                                        class="w-full p-4 text-left flex justify-between items-center hover:bg-gray-100/50 dark:hover:bg-gray-600/50 rounded-lg"
                                        @click="toggleSection('virtual_account')"
                                        :class="expandedSection === 'virtual_account' ? 'bg-gray-100/50 dark:bg-gray-600/50' :
                                            ''">
                                        <div class="flex items-center">
                                            <i class="fas fa-university text-gray-600 dark:text-gray-400 mr-3"></i>
                                            <span class="font-medium text-gray-900 dark:text-white">Petunjuk Virtual
                                                Account</span>
                                        </div>
                                        <i class="fas fa-chevron-down transform transition-transform duration-200"
                                            :class="expandedSection === 'virtual_account' ? 'rotate-180' : ''"></i>
                                    </button>

                                    <div x-show="expandedSection === 'virtual_account'" x-collapse class="px-4 pb-4">
                                        <ol
                                            class="list-decimal list-inside space-y-2 text-sm text-gray-700 dark:text-gray-300">
                                            <li>Buka aplikasi mobile banking
                                                {{ str_contains($activationData['payment_method'], 'bni') ? 'BNI' : 'BRI' }}
                                            </li>
                                            <li>Pilih menu "Transfer" kemudian "Virtual Account"</li>
                                            <li>Masukkan nomor Virtual Account: <strong
                                                    class="font-mono">12345xxxxxx</strong></li>
                                            <li>Periksa detail pembayaran dan nominal yang harus dibayar</li>
                                            <li>Masukkan PIN dan konfirmasi transaksi</li>
                                            <li>Simpan bukti transfer untuk konfirmasi</li>
                                            <li>Proses verifikasi akan dilakukan dalam 10 menit</li>
                                        </ol>
                                    </div>
                                </div>

                                {{-- ATM Section --}}
                                <div class="bg-gray-50/70 rounded-lg border border-gray-300 dark:bg-gray-700/70 dark:border-gray-600"
                                    x-show="selectedMethod.includes('atm') || expandedSection === 'atm'">
                                    <button type="button"
                                        class="w-full p-4 text-left flex justify-between items-center hover:bg-gray-100/50 dark:hover:bg-gray-600/50 rounded-lg"
                                        @click="toggleSection('atm')"
                                        :class="expandedSection === 'atm' ? 'bg-gray-100/50 dark:bg-gray-600/50' : ''">
                                        <div class="flex items-center">
                                            <i class="fas fa-credit-card text-gray-600 dark:text-gray-400 mr-3"></i>
                                            <span class="font-medium text-gray-900 dark:text-white">Petunjuk Transfer
                                                ATM</span>
                                        </div>
                                        <i class="fas fa-chevron-down transform transition-transform duration-200"
                                            :class="expandedSection === 'atm' ? 'rotate-180' : ''"></i>
                                    </button>

                                    <div x-show="expandedSection === 'atm'" x-collapse class="px-4 pb-4">
                                        <ol
                                            class="list-decimal list-inside space-y-2 text-sm text-gray-700 dark:text-gray-300">
                                            <li>Masukkan kartu ATM & PIN kamu</li>
                                            <li>Pilih menu "Transaksi Lainnya"</li>
                                            <li>Pilih menu "Transfer"</li>
                                            <li>Pilih ke
                                                "{{ str_contains($activationData['payment_method'], 'bni') ? 'BNI Virtual Account' : 'BRI Virtual Account' }}"
                                            </li>
                                            <li>Masukkan nominal Top Up (minimal Rp 20.000)</li>
                                            <li>Ikuti petunjuk selanjutnya untuk menyelesaikan proses isi salah</li>
                                        </ol>
                                    </div>
                                </div>

                                {{-- Additional Transfer Instructions --}}
                                @if (str_contains($activationData['payment_method'], 'atm'))
                                    <div
                                        class="bg-gray-50/70 rounded-lg border border-gray-300 dark:bg-gray-700/70 dark:border-gray-600">
                                        <button type="button"
                                            class="w-full p-4 text-left flex justify-between items-center hover:bg-gray-100/50 dark:hover:bg-gray-600/50 rounded-lg"
                                            @click="toggleSection('mbanking')"
                                            :class="expandedSection === 'mbanking' ? 'bg-gray-100/50 dark:bg-gray-600/50' : ''">
                                            <div class="flex items-center">
                                                <i class="fas fa-mobile-alt text-gray-600 dark:text-gray-400 mr-3"></i>
                                                <span class="font-medium text-gray-900 dark:text-white">Petunjuk
                                                    Transfer mBanking</span>
                                            </div>
                                            <i class="fas fa-chevron-down transform transition-transform duration-200"
                                                :class="expandedSection === 'mbanking' ? 'rotate-180' : ''"></i>
                                        </button>

                                        <div x-show="expandedSection === 'mbanking'" x-collapse class="px-4 pb-4">
                                            <ol
                                                class="list-decimal list-inside space-y-2 text-sm text-gray-700 dark:text-gray-300">
                                                <li>Login ke aplikasi mobile banking</li>
                                                <li>Pilih menu Transfer</li>
                                                <li>Pilih transfer antar bank</li>
                                                <li>Masukkan kode bank dan nomor rekening tujuan</li>
                                                <li>Masukkan nominal transfer</li>
                                                <li>Konfirmasi detail transaksi dan selesaikan pembayaran</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <div
                                        class="bg-gray-50/70 rounded-lg border border-gray-300 dark:bg-gray-700/70 dark:border-gray-600">
                                        <button type="button"
                                            class="w-full p-4 text-left flex justify-between items-center hover:bg-gray-100/50 dark:hover:bg-gray-600/50 rounded-lg"
                                            @click="toggleSection('ibanking')"
                                            :class="expandedSection === 'ibanking' ? 'bg-gray-100/50 dark:bg-gray-600/50' : ''">
                                            <div class="flex items-center">
                                                <i class="fas fa-laptop text-gray-600 dark:text-gray-400 mr-3"></i>
                                                <span class="font-medium text-gray-900 dark:text-white">Petunjuk
                                                    Transfer iBanking</span>
                                            </div>
                                            <i class="fas fa-chevron-down transform transition-transform duration-200"
                                                :class="expandedSection === 'ibanking' ? 'rotate-180' : ''"></i>
                                        </button>

                                        <div x-show="expandedSection === 'ibanking'" x-collapse class="px-4 pb-4">
                                            <ol
                                                class="list-decimal list-inside space-y-2 text-sm text-gray-700 dark:text-gray-300">
                                                <li>Login ke internet banking melalui browser</li>
                                                <li>Pilih menu Transfer Dana</li>
                                                <li>Pilih transfer ke bank lain</li>
                                                <li>Masukkan informasi rekening tujuan</li>
                                                <li>Masukkan jumlah transfer dan konfirmasi</li>
                                                <li>Verifikasi dengan token atau SMS OTP</li>
                                            </ol>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Submit Button --}}
                            <button type="button" @click="submitPayment()"
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
                                        <dd class="text-sm font-medium text-gray-900 dark:text-white text-right">
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
                                            Rp
                                            {{ number_format($activationData['pricing']['periode'] === 'tahunan' ? $paket->harga_normal * 12 : $paket->harga_normal, 0, ',', '.') }}
                                        </dd>
                                    </dl>
                                    @if ($activationData['periode'] === 'tahunan')
                                        <dl class="flex items-center justify-between">
                                            <dt class="text-sm font-normal text-red-600 dark:text-red-400">
                                                Diskon ({{ $paket->diskon_persen }}%)
                                            </dt>
                                            <dd class="text-sm font-medium text-red-600 dark:text-red-400">
                                                -Rp
                                                {{ number_format($paket->harga_normal * 12 - $paket->harga * 12, 0, ',', '.') }}
                                            </dd>
                                        </dl>
                                    @endif
                                    <dl
                                        class="flex items-center justify-between pt-3 border-t border-gray-400/50 dark:border-gray-600">
                                        <dt class="text-base font-bold text-gray-900 dark:text-white">Total Bayar</dt>
                                        <dd class="text-base font-bold text-gray-900 dark:text-white">
                                            Rp {{ number_format($activationData['pricing']['total'] * 12, 0, ',', '.') }}
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                {{-- Success Modal --}}
                <div x-show="showSuccess" x-cloak
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                    x-transition:enter="transition ease-out duration-300">
                    <div class="bg-white rounded-lg p-8 max-w-sm mx-4 text-center"
                        x-transition:enter="transition ease-out duration-300 delay-100"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100">

                        {{-- Success Icon --}}
                        <div class="w-20 h-20 mx-auto mb-6 bg-blue-50 rounded-lg flex items-center justify-center">
                            <div class="w-12 h-12 bg-blue-600 rounded flex items-center justify-center">
                                <i class="fas fa-check text-white text-xl"></i>
                            </div>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-2">SUKSES</h3>
                        <p class="text-gray-600 mb-6">Selamat, pembayaran anda berhasil.</p>

                        <button @click="showSuccess = false"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg">
                            OK
                        </button>
                    </div>
                </div>
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

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</body>

</html>
