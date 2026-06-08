@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    @include('admin.layouts.sidebar')
    <div class="w-full px-6 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Bank Sampah</h1>
        <form action="{{ route('admin.list-bank.update', $bankProfile->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-2xl p-6 border border-gray-100 max-w-xl mx-auto">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name', $bankProfile->name) }}" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Deskripsi</label>
                <textarea name="description" class="w-full px-4 py-2 border rounded-lg" required>{{ old('description', $bankProfile->description) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Lokasi</label>
                <input type="text" name="location" value="{{ old('location', $bankProfile->location) }}" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Kontak</label>
                <input type="text" name="contact" value="{{ old('contact', $bankProfile->contact) }}" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Jam Operasional</label>
                <input type="text" name="operational_hours" value="{{ old('operational_hours', $bankProfile->operational_hours) }}" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Jenis Sampah</label>
                <input type="text" name="waste_types" value="{{ old('waste_types', $bankProfile->waste_types) }}" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Logo</label>
                <input type="file" name="logo" class="w-full px-4 py-2 border rounded-lg">
                @if($bankProfile->logo)
                    <img src="{{ asset('storage/' . $bankProfile->logo) }}" alt="Logo" class="w-16 h-16 mt-2 rounded-lg object-cover border border-gray-200">
                @endif
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection