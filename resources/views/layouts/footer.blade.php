<footer class="bg-white border-t">
    <div class="max-w-screen-xl px-4 py-12 mx-auto space-y-8 overflow-hidden sm:px-6 lg:px-8">
        <!-- Main Navigation -->
        <nav class="grid grid-cols-2 gap-8 sm:grid-cols-3 md:grid-cols-3 max-w-4xl mx-auto">
            <!-- Home & Main -->
            <div class="space-y-4 text-center">
                <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">Main</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('home') }}" class="text-base text-gray-500 hover:text-green-600 transition-colors">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('edukasi.index') }}" class="text-base text-gray-500 hover:text-green-600 transition-colors">
                            Edukasi
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Transactions -->
            <div class="space-y-4 text-center">
                <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">Transactions</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('points.redemptions.index') }}" class="text-base text-gray-500 hover:text-green-600 transition-colors">
                            Redempt
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('penjemputan.index') }}" class="text-base text-gray-500 hover:text-green-600 transition-colors">
                            Penjemputan
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Community -->
            <div class="space-y-4 text-center">
                <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">Community</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('forum.index') }}" class="text-base text-gray-500 hover:text-green-600 transition-colors">
                            Forum
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gamifikasi.index') }}" class="text-base text-gray-500 hover:text-green-600 transition-colors">
                            Leaderboard
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Social Media Links -->
        <div class="flex justify-center space-x-6">
            <a href="#" class="text-gray-400 hover:text-green-600 transition-colors">
                <span class="sr-only">Facebook</span>
                <i class="fab fa-facebook text-xl"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-green-600 transition-colors">
                <span class="sr-only">Instagram</span>
                <i class="fab fa-instagram text-xl"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-green-600 transition-colors">
                <span class="sr-only">Twitter</span>
                <i class="fab fa-twitter text-xl"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-green-600 transition-colors">
                <span class="sr-only">LinkedIn</span>
                <i class="fab fa-linkedin text-xl"></i>
            </a>
        </div>

        <!-- Copyright -->
        <div class="mt-8 border-t border-gray-200 pt-8">
            <p class="text-base text-center text-gray-400">
                © {{ date('Y') }} 2CareSampah. All rights reserved.
            </p>
        </div>
    </div>
</footer>