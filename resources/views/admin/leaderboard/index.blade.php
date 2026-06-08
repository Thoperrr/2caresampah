@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="flex min-h-screen bg-gray-50">
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Leaderboard User (Admin)</h1>
                    <p class="text-gray-600">Lihat dan edit peringkat user berdasarkan poin</p>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peringkat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Poin</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $i => $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{ $i+1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                {{ $user->points_balance }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                <form action="{{ route('admin.leaderboard.update', $user) }}" method="POST" class="inline-flex items-center space-x-2">
                                    @csrf
                                    <input type="number" name="points_balance" value="{{ $user->points_balance }}" min="0"
                                        class="border rounded px-2 py-1 w-24 text-center focus:outline-none focus:ring-2 focus:ring-blue-200 transition" />
                                    <button type="submit"
                                        class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 transition">Update</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
@endsection