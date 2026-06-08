@extends('layouts.app')
@extends('layouts.header')

@section('content')
<div class="flex">
    @include('admin.layouts.sidebar')
    <div class="flex-1 bg-gray-50 min-h-screen p-8">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Bank Sampah</h2>

            <form action="{{ route('admin.clients.admin.clients.bank.update', $bank->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Nama Bank Sampah</label>
                    <input type="text" name="name" value="{{ old('name', $bank->bankProfile->name ?? '') }}" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $bank->email) }}" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                </div>

                {{-- Phone --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $bank->bankProfile->phone ?? '') }}" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                </div>

                {{-- Lokasi --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Location</label>
                    <input type="text" name="location" value="{{ old('location', $bank->bankProfile->location ?? '') }}" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                </div>

                {{-- Jenis Sampah --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Waste Types</label>
                    <input type="text" name="waste_types" value="{{ old('waste_types', $bank->bankProfile->waste_types ?? '') }}" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                </div>

                {{-- Jam Operasional --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Operational Hours</label>
                    <input type="text" name="operational_hours" value="{{ old('operational_hours', $bank->bankProfile->operational_hours ?? '') }}" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Status</label>
                    <select name="status" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                        <option value="1" {{ old('status', $bank->status) == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $bank->status) == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                {{-- Image --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Image</label>
                    @if($bank->bankProfile->image ?? false)
                        <img src="{{ asset('storage/' . $bank->bankProfile->image) }}" alt="Image" class="h-24 mb-2 rounded">
                    @endif
                    <input type="file" name="image" class="w-full border rounded-lg px-4 py-2">
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-2">
                    <a href="{{ route('admin.bank.bank-sampah.index') }}" class="bg-gray-400 text-white px-6 py-2 rounded-lg hover:bg-gray-500 transition">Cancel</a>
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
