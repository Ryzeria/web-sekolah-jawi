<x-adminpage.mainlayout>
    <x-slot:title>
        Riwayat Billing Pelanggan
    </x-slot:title>
    {{-- <x-slot:header>
        <img src="https://dummyimage.com/1200x300/000/fff">
    </x-slot:header> --}}

    <x-slot:content>
        <x-adminpage.dataview-layout :collection="$history_billing" :itemToEdit="$history_billingToEdit ?? null" modelName="history_billing"
            title="Riwayat Billing Pelanggan">

            {{-- Define the unique table headers for history_billing --}}
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
                        <a
                            href="{{ route('history_billing.index', array_merge(request()->query(), ['sort' => 'created_at', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                            Tanggal bayar
                        </a>
                    </th>
                    <th class="px-2 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                </tr>
            </x-slot:tableHeaders>

            {{-- Define the unique table row structure for history_billing --}}
            <x-slot:tableRows>
                {{-- The loop is now here, in the parent view --}}
                @forelse ($history_billing as $history_billing1)
                    <tr class="divide-x divide-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->iteration }}
                        </td>
                        <td class="px-12 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $history_billing1->billing->user->username }}
                        </td> {{-- Should be {{ $users->username }} --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $history_billing1->billing->paket->nama_paket }}
                        </td> {{-- Should be {{ $paket->nama_paket }} --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $history_billing1->jumlah }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $history_billing1->billing->tanggal_bayar }}
                        </td> {{-- Should be {{ $billing->tanggal_bayar }} --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $history_billing1->status_baru }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                            Tidak menemukan Riwayat Billing.
                        </td>
                    </tr>
                @endforelse
            </x-slot:tableRows>
        </x-adminpage.dataview-layout>
    </x-slot:content>
</x-adminpage.mainlayout>
