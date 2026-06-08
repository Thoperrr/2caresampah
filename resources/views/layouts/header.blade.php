<header class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto flex justify-between items-center p-2">
        <!-- Logo -->
        <a href="{{ route('home') }}">
            <img src="/images/logo.png" alt="2CareSampah" class="w-20 h-20">
        </a>

        <!-- Desktop Menu -->
        <nav class="hidden md:flex items-center space-x-8">
            <a class="text-black font-medium hover:text-green-600 transition-colors {{ request()->is('/') ? 'border-b-2 border-green-600' : '' }}"
                href="/">Home</a>

            <!-- Dropdown Menu -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.away="open = false"
                    class="text-black font-medium hover:text-green-600 transition-colors flex items-center space-x-1 {{ request()->is('exchange*', 'withdraw*') ? 'border-b-2 border-green-600' : '' }}">
                    <span>Transactions</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div x-show="open" class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                    style="display: none;">
                    <a href="{{ route('exchange.index') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                        <i class="fa-solid fa-right-left mr-2"></i>Exchange
                    </a>
                    <a href="{{ route('points.redemptions.index') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                        <i class="fas fa-money-bill-transfer mr-2"></i>Redempt
                    </a>
                </div>
            </div>

            <!-- Community Dropdown Menu -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.away="open = false"
                    class="text-black font-medium hover:text-green-600 transition-colors flex items-center space-x-1 {{ request()->is('forum*', 'gamifikasi*', 'edukasi*', 'challenge*') ? 'border-b-2 border-green-600' : '' }}">
                    <span>Community</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div x-show="open" class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                    style="display: none;">
                    <a href="{{ route('forum.index') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                        <i class="fas fa-comments mr-2"></i>Forum
                    </a>
                    <a href="{{ route('gamifikasi.index') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                        <i class="fas fa-trophy mr-2"></i>Leaderboard
                    </a>
                    <a href="{{ route('challenge.index') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                        <i class="fas fa-bolt mr-2"></i>Tantangan
                    </a>
                    <a href="{{ route('edukasi.index') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                        <i class="fas fa-book mr-2"></i>Edukasi
                    </a>
                </div>
            </div>

            @auth
                <!-- Dashboard Dropdown Menu -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false"
                        class="text-black font-medium hover:text-green-600 transition-colors flex items-center space-x-1 {{ request()->is('dashboard*', 'admin/dashboard*', 'bank/dashboard*') ? 'border-b-2 border-green-600' : '' }}">
                        <span>Dashboard</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div x-show="open" class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                        style="display: none;">
                        @if (Auth::user()->hasRole('admin'))
                            <a href="{{ route('client.dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                                <i class="fas fa-user-shield mr-2"></i>Client Dashboard
                            </a>
                            <a href="{{ route('admin.dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                                <i class="fas fa-cogs mr-2"></i>Admin Panel
                            </a>
                        @elseif (Auth::user()->hasRole('bank_sampah'))
                            <a href="{{ route('bank.dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                                <i class="fas fa-building mr-2"></i>Bank Dashboard
                            </a>
                        @elseif (Auth::user()->hasRole('client'))
                            <a href="{{ route('client.dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                                <i class="fas fa-user mr-2"></i>My Dashboard
                            </a>
                        @endif
                    </div>
                </div>
            @endauth
        </nav>

        <!-- Desktop Auth Buttons -->
        <div class="hidden md:flex items-center space-x-4">
            <!-- Notification Button -->
            <button type="button"
                class="text-gray-600 hover:text-gray-900 relative focus:outline-none translate-y-1 mr-5">
                <span class="sr-only">View notifications</span>
                <div class="h-6 w-6 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="h-full w-full">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
                <span
                    class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-600 rounded-full transform translate-x-1/4 -translate-y-1/4"></span>
            </button>

            @auth
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false"
                        class="flex items-center space-x-2 hover:opacity-80 transition-opacity" id="profile-dropdown">
                        <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('images/default-profile.png') }}"
                            alt="Profile" class="w-8 h-8 rounded-full object-cover border-2 border-gray-200">
                        <span class="text-black font-medium">{{ Auth::user()->name }}</span>
                    </button>

                    <!-- Profile Dropdown menu -->
                    <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                        style="display: none;">
                        @if(Auth::user()->role == 'bank_sampah')
                            <a href="{{ route('bank.profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                                <i class="fas fa-user-circle mr-2"></i>Profile Bank Sampah
                            </a>
                        @elseif(Auth::user()->role == 'client')
                            <a href="{{ route('client.profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                                <i class="fas fa-user-circle mr-2"></i>Profile Client
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a class="text-black font-medium hover:text-green-600 transition-colors" href="{{ route('register') }}">Sign
                    Up</a>
                <a class="text-black font-medium border-2 border-green-600 px-4 py-1 rounded-full hover:bg-green-600 hover:text-white transition-colors"
                    href="{{ route('login') }}">Login</a>
            @endauth
        </div>

        <!-- Hamburger Button -->
        <button id="menu-toggle" class="md:hidden focus:outline-none">
            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden px-6 pb-4 space-y-2 hidden">
        <a class="block text-black font-medium hover:text-green-600 transition-colors {{ request()->is('/') ? 'border-b-2 border-green-600' : '' }}"
            href="/">Home</a>

        <!-- Mobile Transactions Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center justify-between w-full text-black font-medium hover:text-green-600 transition-colors">
                <span>Transactions</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </button>
            <div x-show="open" class="pl-4 space-y-2 mt-2">
                <a href="{{ route('points.redemptions.index') }}"
                    class="block text-black font-medium hover:text-green-600 transition-colors">
                    <i class="fas fa-exchange-alt mr-2"></i>Redempt
                </a>
            </div>
        </div>

        <!-- Mobile Community Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center justify-between w-full text-black font-medium hover:text-green-600 transition-colors">
                <span>Community</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </button>
            <div x-show="open" class="pl-4 space-y-2 mt-2">
                <a href="{{ route('forum.index') }}"
                    class="block text-black font-medium hover:text-green-600 transition-colors">
                    <i class="fas fa-comments mr-2"></i>Forum
                </a>
                <a href="{{ route('gamifikasi.index') }}"
                    class="block text-black font-medium hover:text-green-600 transition-colors">
                    <i class="fas fa-trophy mr-2"></i>Leaderboard
                </a>
                <a href="{{ route('challenge.index') }}"
                    class="block text-black font-medium hover:text-green-600 transition-colors font-bold">
                    <i class="fas fa-bolt mr-2"></i>Tantangan
                </a>
                <a href="{{ route('edukasi.index') }}"
                    class="block text-black font-medium hover:text-green-600 transition-colors">
                    <i class="fas fa-book mr-2"></i>Edukasi
                </a>
            </div>
        </div>

        @auth
            <!-- Mobile Dashboard Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full text-black font-medium hover:text-green-600 transition-colors">
                    <span>Dashboard</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div x-show="open" class="pl-4 space-y-2 mt-2">
                    @if (Auth::user()->hasRole('admin'))
                        <a href="{{ route('client.dashboard') }}"
                            class="block text-black font-medium hover:text-green-600 transition-colors">
                            <i class="fas fa-user-shield mr-2"></i>Client Dashboard
                        </a>
                        <a href="{{ route('admin.dashboard') }}"
                            class="block text-black font-medium hover:text-green-600 transition-colors">
                            <i class="fas fa-cogs mr-2"></i>Admin Panel
                        </a>
                    @elseif (Auth::user()->hasRole('bank_sampah'))
                        <a href="{{ route('bank.dashboard') }}"
                            class="block text-black font-medium hover:text-green-600 transition-colors">
                            <i class="fas fa-building mr-2"></i>Bank Dashboard
                        </a>
                    @elseif (Auth::user()->hasRole('client'))
                        <a href="{{ route('client.dashboard') }}"
                            class="block text-black font-medium hover:text-green-600 transition-colors">
                            <i class="fas fa-user mr-2"></i>My Dashboard
                        </a>
                    @endif
                </div>
            </div>
        @endauth

        @guest
            <a class="block text-black font-medium hover:text-green-600 transition-colors"
                href="{{ route('register') }}">Sign Up</a>
            <a class="block text-black font-medium border-2 border-green-600 px-4 py-1 rounded-full hover:bg-green-600 hover:text-white transition-colors w-fit"
                href="{{ route('login') }}">Login</a>
        @endguest
    </div>
</header>