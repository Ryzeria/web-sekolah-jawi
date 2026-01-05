<x-adminpage.mainlayout>
    <x-slot:title>
        Manajemen Fitur Paket
    </x-slot:title>

    {{-- <x-slot:header>
        <img src="https://dummyimage.com/1200x300/000/fff">
    </x-slot:header> --}}

    <x-slot:content>
        <div class="p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Manajemen Fitur Paket</h2>
            <p class="text-gray-600 mb-6">Atur fitur yang tersedia untuk setiap paket. Centang kotak untuk mengaktifkan
                fitur pada paket yang bersangkutan.</p>

            {{-- Session Feedback Messages --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            {{-- The form submits all checkbox states to the update method --}}
            <form action="{{ route('fitur_paket.update', ['fitur_paket' => 1]) }}" method="POST">
                @csrf
                @method('PUT') {{-- Use PUT for the update operation as per RESTful conventions --}}

                <div class="overflow-x-auto border border-gray-200 rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr class="divide-x divide-gray-200">
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No.
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Daftar Fitur
                                </th>
                                {{-- Dynamically generate a table header for each package --}}
                                @foreach ($pakets as $paket)
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ $paket->nama_paket }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            {{-- Loop through each feature to create a table row --}}
                            @forelse ($fiturs as $fitur)
                                <tr class="divide-x divide-gray-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $fitur->title }}
                                    </td>
                                    {{-- Loop through each package again to create the corresponding checkbox --}}
                                    @foreach ($pakets as $paket)
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @php
                                                // Find the specific feature for this package to get its value
                                                $paketFitur = $paket->fiturs->firstWhere('id', $fitur->id);
                                                $value = $paketFitur ? $paketFitur->pivot->value : '';
                                            @endphp

                                            @if ($fitur->type == 'boolean')
                                                {{-- For boolean features, render a hidden input and a checkbox --}}
                                                <input type="hidden"
                                                    name="feature_matrix[{{ $paket->id }}][{{ $fitur->id }}]"
                                                    value="0">
                                                <input type="checkbox"
                                                    name="feature_matrix[{{ $paket->id }}][{{ $fitur->id }}]"
                                                    value="1"
                                                    class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                                    {{ $value == '1' ? 'checked' : '' }}>
                                            @else
                                                {{-- For features with variable values, render a text input --}}
                                                <input type="text"
                                                    name="feature_matrix[{{ $paket->id }}][{{ $fitur->id }}]"
                                                    value="{{ $value }}" placeholder="-"
                                                    class="w-24 text-center border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @empty
                                <tr class="divide-x divide-gray-200">
                                    <td colspan="{{ 2 + $pakets->count() }}"
                                        class="px-6 py-4 text-center text-gray-500">
                                        Tidak ada fitur atau paket yang ditemukan. Silakan tambahkan fitur dan paket
                                        terlebih dahulu.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end mt-6">
                    <a href="{{ route('fitur_paket.index') }}"
                        class="py-2 px-4 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 mr-3">
                        Batal
                    </a>
                    <button type="submit"
                        class="py-2 px-4 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </x-slot:content>
</x-adminpage.mainlayout>
