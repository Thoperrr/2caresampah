@extends('layouts.app')
@include('layouts.header')
@section('content')
    <div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-lg">
        <div class="flex items-center justify-center mb-6">
            <!-- Foto Profil Bulat -->
            <div class="w-32 h-32 mr-6">
                <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/default-profile.png') }}"
                    alt="Profile Picture"
                    class="w-full h-full object-cover rounded-full border-4 border-green-500 shadow-md">
            </div>
            <div>
                <h1 class="text-3xl font-semibold text-gray-800 mb-2">{{ $user->name }}</h1>
                <p class="text-gray-600 text-md">{{ $user->email }}</p>
            </div>
        </div>

        <div class="space-y-6">
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Phone</label>
                <p class="text-gray-800">{{ $user->phone ?? 'Not provided' }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Address</label>
                <p class="text-gray-800">{{ $user->address ?? 'Not provided' }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Joined At</label>
                <p class="text-gray-800">{{ $user->created_at->format('d M Y') }}</p>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('client.profile.edit') }}"
                    class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-full transition duration-300 ease-in-out transform hover:scale-105">
                    Edit Profile
                </a>
            </div>
        </div>
    </div>
@endsection