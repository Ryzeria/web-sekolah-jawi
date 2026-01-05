<x-adminpage.mainlayout>
    <x-slot:title>
        Manajemen Testimoni
    </x-slot:title>
    {{-- <x-slot:header>
        <img src="https://dummyimage.com/1200x300/000/fff">
    </x-slot:header> --}}

    <x-slot:content>
        <x-adminpage.crud-layout :collection="$testimoni" :itemToEdit="$testimoniToEdit ?? null" modelName="testimoni" title="Manajemen Tetimoni">

            {{-- Define the unique table headers for testimoni --}}
            <x-slot:tableHeaders>
                <tr class="divide-x divide-gray-200">
                    <th class="px-1 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.
                    </th>
                    <th class="px-12 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Pesan
                    </th>
                    <th class="px-1 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Edit/Delete
                    </th>
                </tr>
            </x-slot:tableHeaders>

            {{-- Define the unique table row structure for testimoni --}}
            <x-slot:tableRows>
                {{-- The loop is now here, in the parent view --}}
                @forelse ($testimoni as $testimonii)
                    <tr class="divide-x divide-gray-200">
                        <td class="px-1 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $testimonii->urutan }}
                        </td>
                        <td class="px-12 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $testimonii->nama }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($testimonii->foto_url)
                                {{-- Check if the file is a PDF --}}
                                @if (Str::endsWith($testimonii->foto_url, '.pdf'))
                                    <a href="{{ asset('storage/' . $testimonii->foto_url) }}" target="_blank"
                                        class="text-sm text-blue-600 hover:text-blue-800 hover:underline">
                                        View PDF
                                    </a>
                                @else
                                    {{-- Otherwise, assume it's an image --}}
                                    <img src="{{ asset('storage/' . $testimonii->foto_url) }}"
                                        alt="{{ $testimonii->nama }}" class="h-12 w-20 object-cover rounded">
                                @endif
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $testimonii->pesan }}
                        </td>
                        <td class="px-1 py-4 whitespace-nowrap text-right text-sm font-medium">

                            <div class="flex items-center justify-end gap-x-4">
                                <a href="{{ route('testimoni.edit', $testimonii->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4 20H20M4 20V16L14.8686 5.13146C15.2652 4.73488 15.463 4.53709 15.691 4.46301C15.8919 4.39775 16.1082 4.39775 16.3091 4.46301C16.5369 4.53704 16.7345 4.7346 17.1288 5.12892L18.8686 6.86872C19.2646 7.26474 19.4627 7.46284 19.5369 7.69117C19.6022 7.89201 19.6021 8.10835 19.5369 8.3092C19.4628 8.53736 19.265 8.73516 18.8695 9.13061L8 20L4 20Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </a>

                                <form action="{{ route('testimoni.destroy', $testimonii->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Are you sure?')">
                                        <svg class="w-5 h-5" viewBox="0 0 16 16" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg" fill="none">
                                            <path fill="currentColor"
                                                d="M11,5h2v8.5c0,0.825-0.675,1.5-1.5,1.5h-7C3.675,15,3,14.325,3,13.5V5h2v8h2V5h2v8h2V5z M2,2h12v2H2V2z M6,0h4v1H6V0z">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                            Tidak menemukan Testimoni. Coba Tambah Baru
                        </td>
                    </tr>
                @endforelse
            </x-slot:tableRows>
        </x-adminpage.crud-layout>
    </x-slot:content>
</x-adminpage.mainlayout>
