@extends('layouts.app')

@section('content')
@include('layouts.header')

<body class="bg-white text-gray-800">
    <main class="text-center">
        <section>
            <div class="w-full mt-32 flex flex-col md:flex-row items-center justify-center">
                <img alt="Illustration of a person managing digital content on a computer" class="w-100 md:mr-8"
                    src="/images/hero_image.png" />
                <div class="text-center md:text-left">
                    <h2 class="text-6xl font-bold mt-4">
                        Turn your <br />
                        <span class="text-5xl text-green-600">Trash</span> <br />
                        To <span class="text-5xl text-green-600">Cash</span>
                    </h2>
                </div>
            </div>
        </section>
        <section class="mt-32" id="features">
            <h2 class="text-4xl font-bold text-center mb-12">
                Our Features
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto px-4">
                <div class="p-6 rounded-lg border border-gray-200 hover:shadow-lg transition">
                    <i class="fas fa-recycle text-4xl text-green-600 mb-4">
                    </i>
                    <h3 class="text-2xl font-semibold mb-2">
                        Penukaran Sampah
                    </h3>
                    <p class="text-gray-600">
                        Tukar sampahmu dengan barang atau hadiah menarik!
                    </p>
                </div>
                <div class="p-6 rounded-lg border border-gray-200 hover:shadow-lg transition">
                    <i class="fas fa-trash-alt text-4xl text-green-600 mb-4">
                    </i>
                    <h3 class="text-2xl font-semibold mb-2">
                        Kategori Sampah
                    </h3>
                    <p class="text-gray-600">
                        Kenali jenis sampah dan cara mengelolanya dengan benar.
                    </p>
                </div>
                <div class="p-6 rounded-lg border border-gray-200 hover:shadow-lg transition">
                    <i class="fas fa-users text-4xl text-green-600 mb-4">
                    </i>
                    <h3 class="text-2xl font-semibold mb-2">
                        Forum Komunitas
                    </h3>
                    <p class="text-gray-600">
                        Gabung diskusi dan berbagi pengalaman tentang lingkungan.
                    </p>
                </div>
                <div class="p-6 rounded-lg border border-gray-200 hover:shadow-lg transition">
                    <i class="fas fa-history text-4xl text-green-600 mb-4">
                    </i>
                    <h3 class="text-2xl font-semibold mb-2">
                        Riwayat Transaksi
                    </h3>
                    <p class="text-gray-600">
                        Cek catatan transaksi sampah dan poin yang kamu kumpulkan.
                    </p>
                </div>
                <div class="p-6 rounded-lg border border-gray-200 hover:shadow-lg transition">
                    <i class="fas fa-gift text-4xl text-green-600 mb-4">
                    </i>
                    <h3 class="text-2xl font-semibold mb-2">
                        Point And Reward
                    </h3>
                    <p class="text-gray-600">
                        Kumpulkan poin dari sampah dan tukarkan dengan hadiah menarik!
                    </p>
                </div>
                <div class="p-6 rounded-lg border border-gray-200 hover:shadow-lg transition">
                    <i class="fas fa-truck text-4xl text-green-600 mb-4">
                    </i>
                    <h3 class="text-2xl font-semibold mb-2">
                        Penjemputan Sampah
                    </h3>
                    <p class="text-gray-600">
                        Minta jemput sampah dengan mudah tanpa ribet.
                    </p>
                </div>
                <div class="p-6 rounded-lg border border-gray-200 hover:shadow-lg transition">
                    <i class="fas fa-lightbulb text-4xl text-green-600 mb-4">
                    </i>
                    <h3 class="text-2xl font-semibold mb-2">
                        Edukasi Daur
                    </h3>
                    <p class="text-gray-600">
                        Dapatkan tips daur ulang dan kelola sampah lebih baik.
                    </p>
                </div>
                <div class="p-6 rounded-lg border border-gray-200 hover:shadow-lg transition">
                    <i class="fas fa-map-marker-alt text-4xl text-green-600 mb-4">
                    </i>
                    <h3 class="text-2xl font-semibold mb-2">
                        Lokasi Bank
                    </h3>
                    <p class="text-gray-600">
                        Temukan bank sampah terdekat di sekitar kamu.
                    </p>
                </div>
                <div class="p-6 rounded-lg border border-gray-200 hover:shadow-lg transition">
                    <i class="fas fa-trophy text-4xl text-green-600 mb-4">
                    </i>
                    <h3 class="text-2xl font-semibold mb-2">
                        Leaderboard Gamifikasi
                    </h3>
                    <p class="text-gray-600">
                        Lihat peringkat kamu dan bersaing dengan pengguna lain!
                    </p>
                </div>
            </div>
        </section>
        <section class="mt-32 max-w-5xl mx-auto px-4 text-center" id="how-it-works">
            <h2 class="text-4xl font-bold mb-12">
                How It Works
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="flex flex-col items-center">
                    <img alt="Illustration of a person collecting trash in a bag outdoors" class="mb-6 rounded-full shadow-lg" height="150" src="https://storage.googleapis.com/a1aa/image/57970035-45ae-4ab8-0eeb-e02b0e067a1b.jpg" width="150" />
                    <h3 class="text-2xl font-semibold mb-2">
                        Collect Trash
                    </h3>
                    <p class="text-gray-600 max-w-xs">
                        Gather your recyclable trash from home or office.
                    </p>
                </div>
                <div class="flex flex-col items-center">
                    <img alt="Illustration of exchanging trash for points on a mobile app" class="mb-6 rounded-full shadow-lg" height="150" src="https://storage.googleapis.com/a1aa/image/f4c8a8db-97c0-454d-1b5b-d5e7a3a16916.jpg" width="150" />
                    <h3 class="text-2xl font-semibold mb-2">
                        Exchange Points
                    </h3>
                    <p class="text-gray-600 max-w-xs">
                        Submit your trash and earn points through our app.
                    </p>
                </div>
                <div class="flex flex-col items-center">
                    <img alt="Illustration of a person redeeming rewards and gifts" class="mb-6 rounded-full shadow-lg" height="150" src="https://storage.googleapis.com/a1aa/image/ace9bbd4-119c-4c5d-ff13-3415e2d0d937.jpg" width="150" />
                    <h3 class="text-2xl font-semibold mb-2">
                        Redeem Rewards
                    </h3>
                    <p class="text-gray-600 max-w-xs">
                        Use your points to redeem exciting rewards and gifts.
                    </p>
                </div>
            </div>
        </section>
        <section class="mt-32 max-w-6xl mx-auto px-4 text-center" id="community">
            <h2 class="text-4xl font-bold mb-12">
                Join Our Community
            </h2>
            <p class="text-lg text-gray-700 max-w-3xl mx-auto mb-12">
                Connect with like-minded people who care about the environment. Share tips, participate in discussions, and stay motivated.
            </p>
            <img alt="Illustration of a diverse group of people engaging in an online community forum about recycling and environment" class="w-full rounded-lg shadow-lg" height="300" src="https://storage.googleapis.com/a1aa/image/bfa50de9-1ddb-4cf6-c9dd-b2cb9f5611af.jpg" width="900" />
        </section>
        <section class="mt-32 max-w-4xl mx-auto px-4 text-center mb-20" id="contact">
            <h2 class="text-4xl font-bold mb-8">
                Get In Touch
            </h2>
            <p class="text-gray-700 mb-8">
                Have questions or want to collaborate? Reach out to us!
            </p>
            <form action="#" class="space-y-6 text-left" method="POST">
                <div>
                    <label class="block mb-2 font-semibold text-gray-700" for="name">
                        Name
                    </label>
                    <input class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="name" name="name" required="" type="text" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-gray-700" for="email">
                        Email
                    </label>
                    <input class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="email" name="email" required="" type="email" />
                </div>
                <div>
                    <label class="block mb-2 font-semibold text-gray-700" for="message">
                        Message
                    </label>
                    <textarea class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600" id="message" name="message" required="" rows="4"></textarea>
                </div>
                <button class="w-full md:w-auto bg-green-600 text-white font-semibold px-8 py-3 rounded-md hover:bg-green-700 transition" type="submit">
                    Send Message
                </button>
            </form>
        </section>
    </main>
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
@include('layouts.footer')

</html>
@endsection