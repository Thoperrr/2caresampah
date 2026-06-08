<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>2Care Sampah</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <!-- Leaflet Control Geocoder -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
  <style>
    #map {
      height: 400px;
    }
  </style>
</head>
@extends('layouts.app')

@section('content')
@include('layouts.header')

<!-- Notifikasi -->
<div class="max-w-6xl mx-auto mt-4 px-6">
  @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
    <strong class="font-bold">Sukses!</strong>
    <span class="block sm:inline">{{ session('success') }}</span>
    </div>
  @endif

  @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
    <strong class="font-bold">Error!</strong>
    <span class="block sm:inline">{{ session('error') }}</span>
    </div>
  @endif
</div>

<!-- Main Content -->
<main class="max-w-6xl mx-auto mt-10 px-6 grid grid-cols-1 md:grid-cols-2 gap-8">
  <!-- Form Request -->
  <div>
    <h2 class="text-xl font-bold mb-4">Request Penjemputan Sampah</h2>

    @if(session('pickup_wastes'))
    <div class="mb-4">
      <h3 class="font-semibold mb-2">Sampah yang akan dijemput:</h3>
      <ul class="space-y-1">
      @foreach(session('pickup_wastes') as $waste)
      <li class="bg-gray-100 rounded px-3 py-1 inline-block">
      {{ $waste['name'] }} ({{ $waste['weight'] }} kg)
      </li>
    @endforeach
      </ul>
    </div>
  @endif

    <form id="form-penjemputan" action="{{ route('penjemputan.store') }}" method="POST" class="space-y-4"
      @if(!session('pickup_wastes'))
      onsubmit="event.preventDefault(); alert('Silakan pilih sampah yang akan dijemput terlebih dahulu melalui menu Penukaran Sampah.');"
    @endif>
      @csrf
      <div>
        <label class="block text-sm font-medium">Alamat Penjemputan</label>
        <input type="text" name="alamat" id="alamat-penjemputan" placeholder="Masukkan alamat lengkap"
          class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-green-200">
        <div id="error-alamat" class="text-red-600 text-xs mt-1 hidden"></div>
      </div>
      <div>
        <label class="block text-sm font-medium">Pilih Petugas Penjemput</label>
        <select name="collector_id" id="collector-id" class="w-full px-4 py-2 border rounded-md">
          <option value="">-- Pilih Petugas --</option>
          @foreach($collectors as $collector)
        <option value="{{ $collector->id }}">{{ $collector->name }} (ID: {{ $collector->id }})</option>
      @endforeach
        </select>
        <div id="error-petugas" class="text-red-600 text-xs mt-1 hidden"></div>
      </div>
      <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition
        @if(!session('pickup_wastes')) opacity-50 cursor-not-allowed @endif">
        Request Penjemputan
      </button>
    </form>
  </div>

  <!-- Map Container -->
  <div>
    <h2 class="text-sm font-medium text-gray-600 mb-2">Lokasi Penjemputan</h2>
    <div id="map" class="w-full h-72 rounded-md"></div>
  </div>
</main>

<!-- Status Penjemputan -->
<section class="max-w-4xl mx-auto mt-10 px-6 py-6 bg-white rounded-lg shadow space-y-4">
  <h3 class="text-lg font-bold">Status Penjemputan Aktif</h3>

  @forelse($pickupRequests as $request)
    <div class="flex items-start gap-4 border-b pb-4">
    <div class="bg-green-100 rounded-full p-2">
      <i data-lucide="truck" class="w-5 h-5 text-green-700"></i>
    </div>
    <div class="flex-1">
      <p class="font-medium">Penjemputan <span class="text-gray-600">#{{ $request->transaction_id }}</span></p>
      <p class="text-sm text-gray-500">{{ $request->jenis_sampah }} - {{ $request->berat ?? 'N/A' }} kg</p>
      <p class="text-sm text-gray-500">Status:
      <span class="font-semibold text-{{ 
        $request->status === 'Pending' ? 'yellow-500' :
    ($request->status === 'Assigned' ? 'blue-500' :
      ($request->status === 'Completed' ? 'green-500' : 'red-500')) }}">
        {{ $request->status }}
      </span>
      </p>
      @if($request->collector)
      <p class="text-sm text-gray-500">Petugas: {{ $request->collector->name }} (ID: {{ $request->collector->id }})</p>
    @else
      <p class="text-sm text-gray-500">Petugas: <span class="text-red-500">Belum Ditugaskan</span></p>
    @endif
    </div>
    <!-- Tombol Pembatalan -->
    @if($request->status === 'Pending')
    <form action="{{ route('penjemputan.updateStatus', $request->id) }}" method="POST" class="self-center">
      @csrf
      @method('PATCH')
      <input type="hidden" name="status" value="Cancelled">
      <button type="submit" class="text-red-600 hover:underline text-sm font-medium">
      ❌ Batalkan
      </button>
    </form>
    @endif
    </div>
  @empty
    <p class="text-gray-500">Tidak ada penjemputan aktif saat ini.</p>
  @endforelse
</section>

<script>
  lucide.createIcons();

  // Initialize the map
  const map = L.map('map').setView([-6.2088, 106.8456], 13); // Default to Jakarta coordinates

  // Add tile layer (OpenStreetMap)
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  // Add a marker
  const marker = L.marker([-6.2088, 106.8456]).addTo(map)
    .bindPopup('Lokasi penjemputan')
    .openPopup();

  // Add geocoder (search box)
  L.Control.geocoder({
    defaultMarkGeocode: false
  })
    .on('markgeocode', function (e) {
      const latlng = e.geocode.center;
      map.setView(latlng, 16);
      marker.setLatLng(latlng)
        .setPopupContent(e.geocode.name)
        .openPopup();
      // Otomatis isi kolom alamat penjemputan
      document.querySelector('input[name="alamat"]').value = e.geocode.name;
    })
    .addTo(map);

  // Geolokasi browser
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
      const userLat = position.coords.latitude;
      const userLng = position.coords.longitude;

      map.setView([userLat, userLng], 15);
      marker.setLatLng([userLat, userLng])
        .setPopupContent('Lokasi Anda')
        .openPopup();
    });
  }

  // Validasi form sebelum submit
  document.getElementById('form-penjemputan').addEventListener('submit', function (e) {
    const alamat = document.querySelector('input[name="alamat"]').value.trim();
    const petugas = document.querySelector('select[name="collector_id"]').value.trim();

    // Ambil elemen error
    const errorAlamat = document.getElementById('error-alamat');
    const errorPetugas = document.getElementById('error-petugas');

    // Reset error
    errorAlamat.classList.add('hidden'); errorAlamat.textContent = '';
    errorPetugas.classList.add('hidden'); errorPetugas.textContent = '';

    let valid = true;

    if (!alamat) {
      errorAlamat.textContent = 'Alamat penjemputan wajib diisi.';
      errorAlamat.classList.remove('hidden');
      valid = false;
    }
    if (!petugas) {
      errorPetugas.textContent = 'Pilih petugas penjemput.';
      errorPetugas.classList.remove('hidden');
      valid = false;
    }

    if (!valid) e.preventDefault();
  });
</script>

@include('layouts.footer')
</body>

</html>