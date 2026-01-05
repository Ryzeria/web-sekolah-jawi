<x-adminpage.mainlayout>
    <x-slot:title>
        Billing Pelanggan
    </x-slot:title>
    {{-- <x-slot:header>
        <img src="https://dummyimage.com/1200x300/000/fff">
    </x-slot:header> --}}

    <x-slot:content>
        <x-adminpage.dataview-layout :collection="$billing" :itemToEdit="$billingToEdit ?? null" modelName="billing" title="Billing Pelanggan">

            {{-- Define the unique table headers for billing --}}
            <x-slot:tableHeaders>
                <tr class="divide-x divide-gray-200">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.
                    </th>
                    <th class="px-12 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paket
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Jumlah yang ditagih
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal bayar
                    </th>
                    <th class="px-2 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                </tr>
            </x-slot:tableHeaders>

            {{-- Define the unique table row structure for billing --}}
            <x-slot:tableRows>
                {{-- The loop is now here, in the parent view --}}
                @forelse ($billing as $billing1)
                    <tr class="divide-x divide-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->iteration }}
                        </td>
                        <td class="px-12 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $billing1->user->username }}
                        </td> {{-- Should be {{ $users->username }} --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $billing1->paket->nama_paket }}
                        </td> {{-- Should be {{ $paket->nama_paket }} --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $billing1->jumlah }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $billing1->tanggal_bayar }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('billing.edit', $billing1->id) }}"
                                class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                            <form action="{{ route('billing.destroy', $billing1->id) }}" method="POST"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                            Tidak menemukan Billing.
                        </td>
                    </tr>
                @endforelse
            </x-slot:tableRows>
        </x-adminpage.dataview-layout>
    </x-slot:content>
</x-adminpage.mainlayout>
