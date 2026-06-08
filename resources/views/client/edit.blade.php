@extends('layouts.app')
@include('layouts.header')
@section('content')
    <div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-lg">
        <h1 class="text-3xl font-semibold mb-6 text-gray-800">Edit Profile</h1>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('client.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex items-center mb-6">
                <!-- Foto Profil Bulat -->
                <div class="w-32 h-32 mr-6">
                    <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/default-profile.png') }}"
                        alt="Profile Picture"
                        class="w-full h-full object-cover rounded-full border-4 border-green-500 shadow-md">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Change Profile Picture</label>
                    <input type="file" name="profile_picture" accept="image/*"
                        class="border p-3 rounded-lg w-full bg-gray-50 focus:ring-2 focus:ring-green-500 transition duration-300 ease-in-out">
                    @error('profile_picture')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-6">
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Name</label>
                    <input type="text" name="name"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500"
                        value="{{ old('name', $user->name) }}">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Email</label>
                    <input type="email" name="email"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500"
                        value="{{ old('email', $user->email) }}">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Phone</label>
                    <input type="text" name="phone"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500"
                        value="{{ old('phone', $user->phone) }}">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Address</label>
                    <input type="text" name="address"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500"
                        value="{{ old('address', $user->address) }}">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-full transition duration-300 ease-in-out transform hover:scale-105">
                        Update Profile
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection