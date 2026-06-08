<!-- Sidebar -->
<aside class="w-64 bg-white shadow-md">
    <div class="h-full flex flex-col">
        <div class="p-6 border-b">
            <h2 class="text-2xl font-bold text-gray-800">Admin Panel</h2>
        </div>

        <div class="p-4 flex-grow">
            <nav class="space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-green-50 text-green-700 font-medium' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>

                <!-- Point Values -->
                <a href="{{ route('admin.points.values') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors {{ request()->routeIs('admin.points.values*') ? 'bg-green-50 text-green-700 font-medium' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Point Values
                </a>

                <!-- List Bank Sampah -->
                <a href="{{ route('admin.list-bank.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors {{ request()->routeIs('admin.list-bank.index*') ? 'bg-green-50 text-green-700 font-medium' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 21h18M9 10h.01M15 10h.01M12 14h.01M4 3h16a1 1 0 011 1v18H3V4a1 1 0 011-1z" />
                    </svg>
                    List Bank Sampah
                </a>

                <!-- Rewards -->
                <a href="{{ route('admin.rewards.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors {{ request()->routeIs('admin.rewards.index*') ? 'bg-green-50 text-green-700 font-medium' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    Rewards
                </a>

                <!-- Penukaran Sampah -->
                <a href="{{ route('admin.penukaran_sampah.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors {{ request()->routeIs('admin.penukaran_sampah.index*') ? 'bg-green-50 text-green-700 font-medium' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 21h18M9 10h.01M15 10h.01M12 14h.01M4 3h16a1 1 0 011 1v18H3V4a1 1 0 011-1z" />
                    </svg>
                    Penukaran Sampah
                </a>

                <!-- Penjemputan Sampah -->
                <a href="{{ route('admin.pickup.requests') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors {{ request()->routeIs('admin.pickup.requests') ? 'bg-green-50 text-green-700 font-medium' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17V5a1 1 0 011-1h5a1 1 0 011 1v12m-1 0a2 2 0 104 0m-4 0a2 2 0 11-4 0m4 0H5a2 2 0 01-2-2V7a2 2 0 012-2h2" />
                    </svg>
                    Penjemputan Sampah
                </a>

                <!-- Redemption -->
                <a href="{{ route('admin.redemptions.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors {{ request()->routeIs('admin.redemptions.index*') ? 'bg-green-50 text-green-700 font-medium' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Redemption
                </a>

                <!-- Education -->
                <a href="{{ route('admin.edukasi.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors {{ request()->routeIs('admin.edukasi.index*') ? 'bg-green-50 text-green-700 font-medium' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Education
                </a>

                <!-- User Management Section -->
                <div class="mt-6">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">User
                        Management</h3>

                    <!-- User -->
                    <a href="{{ route('admin.clients.index') }}"
                        class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors {{ request()->routeIs('admin.clients.*') ? 'bg-green-50 text-green-700 font-medium' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        User
                    </a>

                    <!-- Bank Sampah -->
                    <a href="{{ route('admin.bank.bank-sampah.index') }}"
                        class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 transition-colors {{ request()->routeIs('admin.bank.bank-sampah.index') ? 'bg-green-50 text-green-700 font-medium' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7v4H5V7m14 0a2 2 0 00-2-2H7a2 2 0 00-2 2m14 0v10a2 2 0 01-2 2H7a2 2 0 01-2-2V7" />
                        </svg>
                        Bank Sampah
                    </a>
                </div>
            </nav>
        </div>
    </div>
</aside>