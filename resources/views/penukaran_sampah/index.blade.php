@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="max-w-5xl mx-auto px-6 mt-10 mb-10">
        <section class="flex flex-col md:flex-row md:space-x-12">
            <form id="exchange-form" action="{{ route('exchange.process') }}" method="POST" class="flex-1 max-w-lg space-y-6">
                @csrf
                <h2 class="font-extrabold text-lg">
                    Tukar Sampahmu Menjadi Poin!
                </h2>
                <p class="text-gray-400 text-sm font-normal">
                    Pilih jenis sampah, berat, dan tambahkan ke keranjang penukaran.
                </p>

                <div id="cart-items">
                    <div class="flex font-semibold text-gray-700 mb-1">
                        <div class="flex-1">Jenis Sampah</div>
                        <div class="w-24 text-center">Berat (Kg)</div>
                        <div class="w-8"></div>
                    </div>
                    <!-- Box kosong jika belum ada baris -->
                    <div id="empty-cart" class="text-gray-400 text-center py-6 border-2 border-dashed border-gray-200 rounded-lg mb-2">
                        Belum ada sampah yang ditambahkan.
                    </div>
                    <!-- Baris cart-row akan ditambahkan lewat JS -->
                </div>
                <button type="button" id="add-row" class="bg-green-100 text-green-700 px-3 py-1 rounded hover:bg-green-200 transition mb-2">+ Tambah Sampah</button>

                <div>
                    <label class="block text-sm font-normal mb-1" for="pickup_option">
                        Pilihan Penukaran
                    </label>
                    <select name="pickup_option" id="pickup_option" class="w-full border border-gray-200 rounded-md px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">-- Pilih Opsi --</option>
                        <option value="antar">Antar sendiri ke bank sampah</option>
                        <option value="jemput">Dijemput oleh petugas</option>
                    </select>
                </div>

                <button type="submit"
                    class="w-full bg-green-600 text-white font-semibold py-2 rounded-md hover:bg-green-700 transition-all">
                    Tukar Sampah
                </button>
            </form>
            <aside class="flex-1 max-w-md mt-10 md:mt-0 space-y-6">
                <div class="bg-green-50 rounded-lg p-6 text-center">
                    <h3 class="text-lg font-bold text-green-700 mb-2">Cara Penukaran Sampah</h3>
                    <ol class="text-sm text-gray-600 list-decimal list-inside space-y-1 text-left">
                        <li>Pilih jenis sampah yang ingin kamu tukar.</li>
                        <li>Pilih lokasi bank sampah terdekat.</li>
                        <li>Masukkan berat sampah sesuai yang akan disetor.</li>
                        <li>Klik "Tukar Sampah" dan tunggu konfirmasi dari petugas.</li>
                    </ol>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <h4 class="font-semibold mb-2 text-gray-700">Tips Penukaran</h4>
                    <ul class="list-disc list-inside text-sm text-gray-500 space-y-1">
                        <li>Pastikan sampah sudah dipilah sesuai jenisnya.</li>
                        <li>Bersihkan sampah sebelum disetor.</li>
                        <li>Bawa identitas diri jika diperlukan oleh bank sampah.</li>
                    </ul>
                </div>
                <div class="bg-white rounded-lg shadow p-6 mt-6">
                    <h4 class="font-semibold mb-2 text-gray-700">Poin per Jenis Sampah</h4>
                    <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                        @foreach($wasteTypes as $waste)
                            <li><span class="font-semibold">{{ $waste->name }}</span>: <span class="text-green-700 font-bold">{{ $waste->points_per_kg }}</span> poin/kg</li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </section>
    </div>
    @include('layouts.footer')
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cartItems = document.getElementById('cart-items');
    const addRowBtn = document.getElementById('add-row');
    const emptyCart = document.getElementById('empty-cart');

    function updateEmptyCartBox() {
        const rows = cartItems.querySelectorAll('.cart-row');
        if (rows.length === 0) {
            emptyCart.style.display = '';
        } else {
            emptyCart.style.display = 'none';
        }
    }

    // Tambah baris baru
    addRowBtn.addEventListener('click', function() {
        const row = document.createElement('div');
        row.className = 'cart-row flex space-x-2 mb-2';
        row.innerHTML = `
            <select name="waste_id[]" class="waste-select flex-1 border border-gray-200 rounded-md px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                <option value="">-- Pilih Jenis Sampah --</option>
                @foreach($wasteTypes as $waste)
                    <option value="{{ $waste->id }}">{{ $waste->name }}</option>
                @endforeach
            </select>
            <input type="number" name="weight[]" min="0.1" step="0.1" placeholder="Kg" class="w-24 border border-gray-200 rounded-md px-2 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" required>
            <button type="button" class="remove-row text-red-500 hover:text-red-700 font-bold px-2">&times;</button>
        `;
        cartItems.appendChild(row);
        updateEmptyCartBox();
    });

    // Hapus baris
    cartItems.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.parentElement.remove();
            updateEmptyCartBox();
        }
    });

    updateEmptyCartBox();
});
</script>
@endpush
