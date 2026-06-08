@extends('layouts.app')
@include('layouts.header')
@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Profil Bank Sampah</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6">
        @if($profile && $profile->logo)
            <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo" class="w-32 h-32 object-cover rounded mb-4">
        @endif

        <p><strong>Nama:</strong> {{ $profile->name ?? '-' }}</p>
        <p><strong>Deskripsi:</strong> {{ $profile->description ?? '-' }}</p>
        <p><strong>Lokasi:</strong> {{ $profile->location ?? '-' }}</p>
        <p><strong>Kontak:</strong> {{ $profile->contact ?? '-' }}</p>
        <p><strong>Jam Operasional:</strong> {{ $profile->operational_hours ?? '-' }}</p>
        <p><strong>Jenis Sampah Diterima:</strong> {{ $profile->waste_types ?? '-' }}</p>

        <a href="{{ route('bank.profile.edit') }}"
           class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Edit Profil
        </a>
    </div>
</div>
@include('layouts.footer')
@endsection