@extends('layouts.app')

@section('content')
    @include('layouts.header')

    <div class="flex min-h-screen bg-gray-50">
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Edit Reward</h1>
                <p class="text-gray-600">Modify the reward details</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                    <div class="flex">
                        <div class="ml-3">
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
                <form action="{{ route('admin.rewards.update', $reward) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="points_required" class="block text-sm font-medium text-gray-700 mb-2">Points
                            Required</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="number" name="points_required" id="points_required"
                                value="{{ old('points_required', $reward->points_required) }}" min="1" step="1"
                                class="block w-full pr-12 border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                placeholder="0" required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">points</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="cash_value" class="block text-sm font-medium text-gray-700 mb-2">Cash Value
                            (IDR)</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="number" name="cash_value" id="cash_value"
                                value="{{ old('cash_value', $reward->cash_value) }}" min="0" step="100"
                                class="block w-full pl-12 border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                placeholder="0" required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <div class="flex items-center">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" id="is_active" value="1" 
                                   class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 block text-sm text-gray-700">
                                Active
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('admin.rewards.index') }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Update Reward
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    @include('layouts.footer')
@endsection