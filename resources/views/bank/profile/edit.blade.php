@extends('layouts.app')
@include('layouts.header')
@section('content')
<div class="max-w-6xl mx-auto py-10 px-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-8">Edit Profil Bank Sampah</h1>

    <form action="{{ route('bank.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-2xl p-8 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" name="name" id="name"
                value="{{ old('name', $profile->name ?? '') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500" required>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="description" id="description" rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">{{ old('description', $profile->description ?? '') }}</textarea>
        </div>

        <div>
            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
            <input type="text" name="location" id="location"
                value="{{ old('location', $profile->location ?? '') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
        </div>

        <div>
            <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Kontak</label>
            <input type="text" name="contact" id="contact"
                value="{{ old('contact', $profile->contact ?? '') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
        </div>

        <div>
            <label for="operational_hours" class="block text-sm font-medium text-gray-700 mb-1">Jam Operasional</label>
            <input type="text" name="operational_hours" id="operational_hours"
                value="{{ old('operational_hours', $profile->operational_hours ?? '') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
        </div>

        <div>
            <label for="waste_types" class="block text-sm font-medium text-gray-700 mb-1">Jenis Sampah yang Diterima</label>
            <input type="text" name="waste_types" id="waste_types"
                value="{{ old('waste_types', $profile->waste_types ?? '') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
        </div>

        <div>
            <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">Logo (Opsional)</label>
            <div class="flex items-center gap-4">
                <label class="cursor-pointer inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    <input type="file" name="logo" id="logo" class="hidden">
                    Unggah Logo
                </label>
                @if(isset($profile->logo) && $profile->logo)
                    <img src="{{ asset('storage/' . $profile->logo) }}" alt="Current Logo" class="w-16 h-16 object-cover rounded border">
                @endif
            </div>
        </div>

        <div class="text-right">
            <button type="submit"
                class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@include('layouts.footer')
@endsection
