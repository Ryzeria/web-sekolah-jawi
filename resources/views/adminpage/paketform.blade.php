{{-- resources/views/adminpage/paketform.blade.php --}}

<x-adminpage.mainlayout>
    <x-slot:title>
        {{-- Dynamic Title --}}
        {{ isset($paket) ? 'Edit Paket' : 'Tambah Paket Baru' }}
    </x-slot:title>

    {{-- <x-slot:header>
        <img src="https://dummyimage.com/1200x300/3498db/ffffff&text=Form+Manajemen+Paket" alt="Form Header">
    </x-slot:header> --}}

    <x-slot:content>
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6">
                {{ isset($paket) ? 'Edit Paket' : 'Tambah Paket Baru' }}
            </h2>

            {{-- General Error Message Summary --}}
            @if ($errors->any())
                <div class="mb-4 rounded-md bg-red-50 p-4" role="alert">
                    <h3 class="text-sm font-medium text-red-800">⚠️ There were some problems with your input.</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-inside list-disc pl-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Dynamic Form Action --}}
            <form action="{{ isset($paket) ? route('paket.update', $paket->id) : route('paket.store') }}" method="POST">
                @csrf
                {{-- Add PUT method for editing --}}
                @if (isset($paket))
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nama_paket" class="block text-sm font-medium text-gray-700">Nama Paket</label>
                        <input type="text" name="nama_paket" id="nama_paket"
                            class="mt-1 block w-full rounded-mdshadow-sm @error('nama_paket') border-red-500 @else border-gray-300 @enderror"
                            value="{{ old('nama_paket', $paket->nama_paket ?? '') }}">
                        @error('nama_paket')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="harga_normal" class="block text-sm font-medium text-gray-700">Harga Normal
                            (Diskon akan dihitung otomatis)</label>
                        <input type="number" name="harga_normal" id="harga_normal"
                            class="mt-1 block w-full rounded-md shadow-sm @error('harga_normal') border-red-500 @else border-gray-300 @enderror"
                            value="{{ old('harga_normal', $paket->harga_normal ?? '') }}">
                        @error('harga_normal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700">Harga (Setelah
                            Diskon)</label>
                        <input type="number" name="harga" id="harga"
                            class="mt-1 block w-full rounded-md shadow-sm @error('harga') border-red-500 @else border-gray-300 @enderror"
                            value="{{ old('harga', $paket->harga ?? '') }}">
                        @error('harga')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="durasi_bulan" class="block text-sm font-medium text-gray-700">Durasi (dalam
                            Bulan)</label>
                        <input type="number" name="durasi_bulan" id="durasi_bulan"
                            class="mt-1 block w-full rounded-md shadow-sm @error('durasi_bulan') border-red-500 @else border-gray-300 @enderror"
                            value="{{ old('durasi_bulan', $paket->durasi_bulan ?? '') }}">
                        @error('durasi_bulan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                            class="mt-1 block w-full rounded-md shadow-sm @error('deskripsi') border-red-500 @else border-gray-300 @enderror">{{ old('Deskripsi', $paket->Deskripsi ?? '') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="is_active" class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm"
                                @if (old('is_active', $paket->is_active ?? true)) checked @endif>
                            <span class="ml-2 text-sm text-gray-600">Is Active?</span>
                        </label>
                    </div>
                    <div>
                        <label for="is_popular" class="flex items-center">
                            <input type="checkbox" name="is_popular" id="is_popular" value="1"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm"
                                @if (old('is_popular', $paket->is_popular ?? true)) checked @endif>
                            <span class="ml-2 text-sm text-gray-600">Is Popular?</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6 space-x-4">
                    <a href="{{ route('paket.index') }}"
                        class="text-gray-600 hover:text-gray-900 px-4 py-2 rounded-md border border-gray-300">
                        Cancel
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{-- Dynamic Button Text --}}
                        {{ isset($paket) ? 'Update' : 'Insert' }}
                    </button>
                </div>
            </form>
        </div>
    </x-slot:content>
</x-adminpage.mainlayout>
