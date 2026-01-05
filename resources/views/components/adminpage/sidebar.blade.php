{{-- Wrap the component with x-data to initialize the activeMenu variable --}}
<div x-data="{ activeMenu: '{{ request()->segment(2) }}' }">
    {{-- Removed transition-transform and the :class for collapsing --}}
    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen" aria-label="Sidenav">
        <div
            class="overflow-y-auto py-5 px-3 h-full border-r bg-primary border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <ul class="space-y-2">
                <li>
                    {{-- Add :class to check if the activeMenu is 'dashboard' --}}
                    <a href="/admin/dashboard"
                        class="flex items-center p-2 text-base font-normal text-gray-100 rounded-lg dark:text-white hover:bg-indigo-900 dark:hover:bg-gray-700 group"
                        :class="{ 'bg-indigo-900': activeMenu === 'dashboard' }">
                        <svg aria-hidden="true"
                            class="w-6 h-6 text-gray-100 transition duration-75 dark:text-gray-100 group-hover:text-gray-100 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    {{-- Add :class to check if activeMenu is one of the dropdown's items --}}
                    <button type="button"
                        class="flex items-center p-2 w-full text-base font-normal text-gray-100 rounded-lg transition duration-75 group hover:bg-indigo-900 dark:text-white dark:hover:bg-gray-700"
                        :class="{ 'bg-indigo-900': ['slider', 'fitur', 'alasan', 'testimoni'].includes(activeMenu) }"
                        aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                        <svg aria-hidden="true"
                            class="flex-shrink-0 w-6 h-6 text-gray-100 transition duration-75 group-hover:text-gray-100 dark:text-gray-100 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Manajemen Konten</span>
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    {{-- Conditionally remove the 'hidden' class if an item is active --}}
                    <ul id="dropdown-pages" class="py-2 space-y-2"
                        :class="{ 'hidden': !['slider', 'fitur', 'alasan', 'testimoni'].includes(activeMenu) }">
                        <li>
                            <a href="/admin/slider"
                                class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-100 rounded-lg transition duration-75 group hover:bg-indigo-900 dark:text-white dark:hover:bg-gray-700"
                                :class="{ 'bg-indigo-900': activeMenu === 'slider' }">Slider</a>
                        </li>
                        <li>
                            <a href="/admin/fitur"
                                class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-100 rounded-lg transition duration-75 group hover:bg-indigo-900 dark:text-white dark:hover:bg-gray-700"
                                :class="{ 'bg-indigo-900': activeMenu === 'fitur' }">Fitur</a>
                        </li>
                        <li>
                            <a href="/admin/alasan"
                                class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-100 rounded-lg transition duration-75 group hover:bg-indigo-900 dark:text-white dark:hover:bg-gray-700"
                                :class="{ 'bg-indigo-900': activeMenu === 'alasan' }">Alasan</a>
                        </li>
                        <li>
                            <a href="/admin/testimoni"
                                class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-100 rounded-lg transition duration-75 group hover:bg-indigo-900 dark:text-white dark:hover:bg-gray-700"
                                :class="{ 'bg-indigo-900': activeMenu === 'testimoni' }">Testimoni</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center p-2 w-full text-base font-normal text-gray-100 rounded-lg transition duration-75 group hover:bg-indigo-900 dark:text-white dark:hover:bg-gray-700"
                        :class="{ 'bg-indigo-900': ['paket', 'fitur-paket'].includes(activeMenu) }"
                        aria-controls="dropdown-sales" data-collapse-toggle="dropdown-sales">
                        <svg aria-hidden="true"
                            class="flex-shrink-0 w-6 h-6 text-gray-100 transition duration-75 group-hover:text-gray-100 dark:text-gray-100 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Layanan Paket</span>
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul id="dropdown-sales" class="py-2 space-y-2"
                        :class="{ 'hidden': !['paket', 'fitur-paket'].includes(activeMenu) }">
                        <li>
                            <a href="/admin/paket"
                                class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-100 rounded-lg transition duration-75 group hover:bg-indigo-900 dark:text-white dark:hover:bg-gray-700"
                                :class="{ 'bg-indigo-900': activeMenu === 'paket' }">Manajemen
                                Paket</a>
                        </li>
                        <li>
                            <a href="/admin/fitur-paket"
                                class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-100 rounded-lg transition duration-75 group hover:bg-indigo-900 dark:text-white dark:hover:bg-gray-700"
                                :class="{ 'bg-indigo-900': activeMenu === 'fitur-paket' }">Fitur
                                Paket</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="/admin/billing"
                        class="flex items-center p-2 text-base font-normal text-gray-100 rounded-lg dark:text-white hover:bg-indigo-900 dark:hover:bg-gray-700 group"
                        :class="{ 'bg-indigo-900': activeMenu === 'billing' }">
                        <svg aria-hidden="true"
                            class="flex-shrink-0 w-6 h-6 text-gray-100 transition duration-75 dark:text-gray-100 group-hover:text-gray-100 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                            </path>
                            <path
                                d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                            </path>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Billing</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/history-billing"
                        class="flex items-center p-2 text-base font-normal text-gray-100 rounded-lg dark:text-white hover:bg-indigo-900 dark:hover:bg-gray-700 group"
                        :class="{ 'bg-indigo-900': activeMenu === 'history-billing' }">
                        <svg aria-hidden="true"
                            class="flex-shrink-0 w-6 h-6 text-gray-100 transition duration-75 dark:text-gray-100 group-hover:text-gray-100 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">History Billing</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
</div>
