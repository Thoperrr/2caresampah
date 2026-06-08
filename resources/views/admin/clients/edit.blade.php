@extends('layouts.app')
@extends('layouts.header')

@section('content')
<div class="flex">
    @include('admin.layouts.sidebar')
    <div class="flex-1">
        <div class="container mx-auto px-4 py-8">
            <div class="bg-white shadow rounded-lg p-8 w-full max-w-4xl mx-auto">
                <h2 class="text-2xl font-bold mb-6">Edit Client</h2>
                <form action="{{ route('admin.clients.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700">Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded px-3 py-2 mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded px-3 py-2 mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Profile Photo</label>
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" class="h-24 w-24 object-cover rounded-full mb-2">
                        @endif
                        <input type="file" name="profile_photo" class="w-full border rounded px-3 py-2 mt-1">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Points</label>
                        <input type="number" name="points" value="{{ old('points', $user->points) }}" class="w-full border rounded px-3 py-2 mt-1">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Status</label>
                        <select name="status" class="w-full border rounded px-3 py-2 mt-1">
                            <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection