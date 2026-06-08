@extends('layouts.app')

@section('content')
    @include('layouts.header')

    <div class="flex min-h-screen bg-gray-50">
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Edit Point Value</h1>
                <p class="text-gray-600">Modify the point value for <span
                        class="font-medium capitalize">{{ $waste->name }}</span> waste type</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">Please correct the following errors:</p>
                            <ul class="mt-2 text-sm list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-sm p-6 max-w-2xl">
                <form action="{{ route('admin.points.values.update', $waste) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="points_per_kg" class="block text-sm font-medium text-gray-700 mb-2">Point Value per
                            Kilogram</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Points</span>
                            </div>
                            <input type="number" name="points_per_kg" id="points_per_kg"
                                value="{{ old('points_per_kg', $waste->points_per_kg) }}" min="0" step="1"
                                class="block w-full pl-16 pr-12 py-3 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                placeholder="0" required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">per kg</span>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Enter the number of points users will earn for each kilogram
                            of {{ $waste->name }} waste</p>
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" id="description" rows="3"
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">{{ old('description', $waste->description) }}</textarea>
                    </div>

                    <div class="flex items-center justify-end space-x-4 mt-8">
                        <a href="{{ route('admin.points.values') }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Update Point Value
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    @include('layouts.footer')
@endsection