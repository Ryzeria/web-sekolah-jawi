@props([
    'modelName', // The base name for routes (e.g., 'sliders', 'fitur')
    'title', // The page title (e.g., 'Manajemen Slider')
    'collection', // The paginated data collection ($sliders, $fiturs)
    'itemToEdit' => null, // The item being edited (optional)
])

<div class="p-4">
    {{-- Optional: Display Success/Error Messages --}}
    {{-- General Error Message Summary --}}
    {{-- Display Success/Error Messages (Moved from form to here for general page notifications) --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    {{-- ####################### DATA TABLE ####################### --}}
    <div class="bg-white p-6 rounded-lg shadow-md">

        <div class="flex justify-end mb-4">
            <form action="{{ route($modelName . '.index') }}" method="GET" class="flex items-center ">
                <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                    class="block w-64 px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-r-md border border-indigo-600">
                    <svg height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 339.921 339.921" xml:space="preserve"
                        fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path style="fill:#ffffff;"
                                    d="M335.165,292.071l-81.385-84.077c-5.836-6.032-13.13-8.447-16.29-5.363 c-3.171,3.062-10.47,0.653-16.306-5.379l-1.164-1.207c36.425-47.907,32.89-116.499-10.851-160.24 c-47.739-47.739-125.142-47.739-172.875,0c-47.739,47.739-47.739,125.131,0,172.87c44.486,44.492,114.699,47.472,162.704,9.045 l0.511,0.533c5.825,6.032,7.995,13.402,4.814,16.469c-3.166,3.068-1.012,10.443,4.83,16.464l81.341,84.11 c5.836,6.016,15.452,6.195,21.49,0.354l22.828-22.088C340.827,307.735,340.99,298.125,335.165,292.071z M182.306,181.81 c-32.852,32.857-86.312,32.857-119.159,0.011c-32.852-32.852-32.847-86.318,0-119.164c32.847-32.852,86.307-32.847,119.148,0.005 C215.152,95.509,215.152,148.964,182.306,181.81z">
                                </path>
                            </g>
                        </g>
                    </svg>
                </button>
            </form>
        </div>
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <h3 class="text-xl mr-1">show</h3>
                <form action="{{ route($modelName . '.index') }}" method="GET">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <select name="per_page" onchange="this.form.submit()"
                        class="block w-full pl-3 pr-5 py-1 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="5" @if (request('per_page') == 5) selected @endif>5</option>
                        <option value="10" @if (request('per_page') == 10) selected @endif>10</option>
                        <option value="25" @if (request('per_page') == 25) selected @endif>25</option>
                        <option value="50" @if (request('per_page') == 50) selected @endif>50</option>
                    </select>
                </form>
                <h3 class="text-xl ml-1">entries per page</h3>
            </div>
            <a href="{{ route($modelName . '.create') }}"
                class="bg-primary-700 hover:bg-primary-900 text-white font-bold py-2 px-4 rounded">
                Tambah Baru
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border border-gray-200 rounded-lg">
                <thead class="bg-gray-50">
                    {{ $tableHeaders }}
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    {{ $tableRows }}
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $collection->withQueryString()->links() }}
        </div>
    </div>
</div>
