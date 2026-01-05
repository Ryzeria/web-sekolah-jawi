<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi Lisensi</title>
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
            class="w-full bg-white/30 backdrop-blur-lg rounded-lg shadow dark:border sm:max-w-3xl xl:p-0 dark:bg-gray-800 dark:border-gray-700">

            {{-- Card Header --}}
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <img src="{{ asset('assets/logo.png') }}" class="h-12 mx-auto" alt="SISKA Logo" />
                <h1
                    class="text-xl font-bold leading-tight tracking-tight text-center text-gray-900 md:text-2xl dark:text-white">
                    Form Aktivasi Lisensi
                </h1>

                {{-- Form Content --}}
                <form class="space-y-4 md:space-y-6" action="#" method="POST" x-data="{
                    paket: '{{ old('pilih_paket', $pakets->first()->id) }}',
                    hargaBulanan: {},
                    hargaNormalTahunan: {},
                    hargaTahunan: {},
                    diskon: {},
                    pilihPaket: 'tahunan',
                    diskonPersen: {},
                }"
                    x-init="@foreach ($pakets as $paket)
                        hargaBulanan['{{ $paket->id }}'] = {{ $paket->harga_normal }};
                        hargaNormalTahunan['{{ $paket->id }}'] = {{ $paket->harga_normal * 12 }};
                        hargaTahunan['{{ $paket->id }}'] = {{ $paket->harga * 12 }};
                        diskon['{{ $paket->id }}'] = {{ $paket->harga_normal * 12 - $paket->harga * 12 }};
                        diskonPersen['{{ $paket->id }}'] = {{ $paket->diskon_persen }}; @endforeach">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Left Column: Form Inputs --}}
                        <div class="space-y-4 md:space-y-6">
                            <div>
                                <label for="id_sekolah"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    ID Sekolah</label>
                                <input type="text" name="id_sekolah" id="id_sekolah"
                                    class="bg-gray-200 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5 cursor-not-allowed dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="ID12345678" value="{{ $sekolahId ?? '' }}" required readonly
                                    onpaste="return false;" oncut="return false;">
                            </div>

                            <div>
                                <label for="pilih_paket"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Pilih Paket</label>
                                <select name="pilih_paket" id="pilih_paket" x-model="paket"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach ($pakets as $paket)
                                        <option value="{{ $paket->id }}"
                                            @if (old('pilih_paket', $pakets->first()->id) == $paket->id) selected @endif>
                                            {{ $paket->nama_paket }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Periode Paket</label>
                                <div class="flex space-x-4">
                                    {{-- Monthly Option --}}
                                    <label class="flex items-center p-3 rounded-lg cursor-pointer flex-1"
                                        :class="{
                                            'bg-blue-50 border-2 border-blue-600 dark:bg-blue-900/20 dark:border-blue-500': pilihPaket === 'bulanan',
                                            'bg-gray-50 border border-gray-300 dark:bg-gray-700 dark:border-gray-600': pilihPaket !== 'bulanan'
                                        }">
                                        <input type="radio" name="pilih_periode" value="bulanan"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            x-model="pilihPaket">
                                        <div class="ml-3">
                                            <span
                                                class="text-sm font-medium text-gray-900 dark:text-white">Bulanan</span>
                                            <div class="text-lg font-bold text-gray-900 dark:text-white"
                                                x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(hargaBulanan[paket]) + '/bulan'">
                                            </div>
                                        </div>
                                    </label>
                                    {{-- Yearly Option --}}
                                    <label class="flex items-center p-3 rounded-lg cursor-pointer flex-1"
                                        :class="{
                                            'bg-blue-50 border-2 border-blue-600 dark:bg-blue-900/20 dark:border-blue-500': pilihPaket === 'tahunan',
                                            'bg-gray-50 border border-gray-300 dark:bg-gray-700 dark:border-gray-600': pilihPaket !== 'tahunan'
                                        }">
                                        <input type="radio" name="pilih_periode" value="tahunan"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            x-model="pilihPaket">
                                        <div class="ml-3">
                                            <span
                                                class="text-sm font-medium text-gray-900 dark:text-white">Tahunan</span>
                                            <div class="text-lg font-bold text-gray-900 dark:text-white"
                                                x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(hargaTahunan[paket]) + '/tahun'">
                                            </div>
                                            <div class="text-xs font-medium text-blue-600 dark:text-blue-400">
                                                Diskon <span x-text="diskonPersen[paket]"></span>%
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Lanjutkan
                            </button>
                        </div>

                        {{-- Right Column: Paket Details --}}
                        <div
                            class="bg-gray-50/70 p-6 rounded-lg border border-gray-300 dark:bg-gray-700/70 dark:border-gray-600">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Informasi Paket</h2>
                            <div class="space-y-3">
                                <dl class="flex items-center justify-between">
                                    <dt class="text-sm font-normal text-gray-700 dark:text-gray-300">Nama Paket</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-white"
                                        x-text="$pakets.find(p => p.id === paket).nama_paket">
                                    </dd>
                                </dl>
                                <dl class="flex items-center justify-between">
                                    <dt class="text-sm font-normal text-gray-700 dark:text-gray-300">Periode Paket</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-white"
                                        x-text="pilihPaket === 'tahunan' ? 'Tahunan' : 'Bulanan'">
                                    </dd>
                                </dl>
                                <dl class="flex items-center justify-between">
                                    <dt class="text-sm font-normal text-gray-700 dark:text-gray-300">Harga</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-white"
                                        x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(pilihPaket === 'tahunan' ? hargaNormalTahunan[paket] : hargaBulanan[paket])">
                                    </dd>
                                </dl>
                                <dl class="flex items-center justify-between" x-show="pilihPaket === 'tahunan'">
                                    <dt class="text-sm font-normal text-red-600 dark:text-red-400">Diskon (<span
                                            x-text="diskonPersen[paket]"></span>%)</dt>
                                    <dd class="text-sm font-medium text-red-600 dark:text-red-400"
                                        x-text="'-' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(diskon[paket])">
                                    </dd>
                                </dl>
                                <dl
                                    class="flex items-center justify-between pt-3 border-t border-gray-400/50 dark:border-gray-600">
                                    <dt class="text-base font-bold text-gray-900 dark:text-white">Total Bayar</dt>
                                    <dd class="text-base font-bold text-gray-900 dark:text-white"
                                        x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(pilihPaket === 'tahunan' ? hargaTahunan[paket] : hargaBulanan[paket])">
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Alpine.js script to manage package data --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('pakets', () => ({
                pakets: @json($pakets),
                get selectedPaket() {
                    return this.pakets.find(p => p.id === this.paket);
                },
                get harga() {
                    return this.pilihPaket === 'tahunan' ? this.selectedPaket.harga * 12 :
                        this
                        .selectedPaket.harga_normal;
                },
                get diskon() {
                    return this.selectedPaket.harga_normal * 12 - this.selectedPaket.harga * 12;
                }
            }));
        });
    </script>
</body>

</html>
