@extends('layouts.app')

@section('content')
    @include('layouts.header')

    <div class="max-w-5xl mx-auto py-8 px-4">
        <div class="flex justify-between items-center mb-6">
            <div class="flex space-x-2">
                <button class="px-3 py-1 rounded-t bg-white border-b-2 border-blue-600 font-semibold text-blue-600">Latest</button>
                <button class="px-3 py-1 rounded-t bg-gray-100 text-gray-600 hover:text-blue-600 hover:bg-white">Top</button>
                <button class="px-3 py-1 rounded-t bg-gray-100 text-gray-600 hover:text-blue-600 hover:bg-white">Categories</button>
            </div>
            <a href="{{ route('forum.create') }}" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 text-sm">Create New Thread</a>
        </div>

        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Topic</th>
                        <th class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Replies</th>
                        <th class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Views</th>
                        <th class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Activity</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($forums as $forum)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4 flex items-center space-x-3">
                                <img src="{{ $forum->user->profile_photo ? asset('storage/' . $forum->user->profile_photo) : asset('images/default-profile.png') }}" alt="User Avatar" class="w-8 h-8 rounded-full object-cover border border-gray-300">
                                <div>
                                    <a href="{{ route('forum.show', $forum) }}" class="font-semibold text-gray-900 hover:text-blue-600 text-base">{{ $forum->title }}</a>
                                    <div class="flex items-center space-x-2 mt-1">
                                        <span class="text-xs text-gray-500">by {{ $forum->user->name }}</span>
                                        <span class="text-xs text-gray-400">• {{ $forum->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="text-xs text-gray-600 mt-1 line-clamp-1">{{ Str::limit($forum->body, 80) }}</div>
                                </div>
                                @if(Auth::check() && Auth::user()->role === 'admin')
                                    <form action="{{ route('forum.destroy', $forum) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this forum?');" class="ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-xs">Delete</button>
                                    </form>
                                @endif
                            </td>
                            <td class="px-2 py-4 text-center text-sm text-gray-700">{{ $forum->comments->count() }}</td>
                            <td class="px-2 py-4 text-center text-sm text-gray-700">{{ $forum->views ?? 0 }}</td>
                            <td class="px-2 py-4 text-center text-xs text-gray-500">{{ $forum->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-600">No forum threads found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $forums->links() }}
        </div>
    </div>

    @include('layouts.footer')
@endsection

@if(Auth::check())
    <p>Role: {{ Auth::user()->role }}</p>
@endif
