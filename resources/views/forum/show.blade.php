@extends('layouts.app')

@section('content')
    @include('layouts.header')

    <div class="flex justify-center bg-gray-50 min-h-screen">
        <div class="flex w-full max-w-5xl">
            <!-- Main Content -->
            <div class="flex-1 p-6">
                <div class="border-b border-gray-200 pb-8 mb-4">
                    <h1 class="text-4xl font-extrabold mb-4 leading-tight">{{ $forum->title }}</h1>
                    <div class="flex items-center mb-2">
                        <img src="{{ $forum->user->profile_photo ? asset('storage/' . $forum->user->profile_photo) : asset('storage/profile-photos/default-avatar.jpg') }}" class="w-12 h-12 rounded-full object-cover border border-gray-300 mr-3">
                        <div>
                            <p class="font-bold text-lg text-gray-900">{{ $forum->user->name }}</p>
                            <p class="text-gray-500 text-sm">{{ $forum->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    <div class="text-lg text-gray-900 mb-6 mt-2 whitespace-pre-line">{{ $forum->body }}</div>
                    <div class="flex items-center space-x-8 text-sm text-gray-500 mt-2">
                        <span><span class="font-semibold">{{ $forum->views ?? 0 }}</span> views</span>
                        <span><span class="font-semibold">{{ $forum->comments->count() }}</span> replies</span>
                        <span><span class="font-semibold">{{ $forum->comments->pluck('user_id')->unique()->count() + 1 }}</span> users</span>
                        @auth
                            <form action="{{ route('forum.subscribe', $forum) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="ml-4 flex items-center px-3 py-1 rounded bg-blue-100 text-blue-700 font-semibold hover:bg-blue-200 transition">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                    {{ auth()->user()->isSubscribedTo($forum) ? 'Unfollow' : 'Follow' }}
                                </button>
                            </form>
                            @if(auth()->user()->role === 'admin')
                                <div class="relative inline-block text-left ml-2">
                                    <button type="button" class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-200 focus:outline-none" id="forum-menu-btn" aria-expanded="true" aria-haspopup="true" onclick="toggleDropdown('forum-menu-dropdown')">
                                        <span class="sr-only">Open options</span>
                                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="4" cy="10" r="2"/><circle cx="10" cy="10" r="2"/><circle cx="16" cy="10" r="2"/></svg>
                                    </button>
                                    <div id="forum-menu-dropdown" class="hidden absolute right-0 mt-2 w-44 rounded-xl bg-white shadow-xl ring-1 ring-black ring-opacity-5 z-30 transition-all">
                                        <ul class="py-2 flex flex-col gap-1">
                                            <li>
                                                <a href="{{ route('forum.edit', $forum) }}" class="block px-5 py-2 text-base text-gray-800 hover:bg-blue-50 hover:text-blue-700 font-medium transition">Edit</a>
                                            </li>
                                            <li>
                                                <form action="{{ route('forum.destroy', $forum) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this topic?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-full text-left px-5 py-2 text-base text-red-600 hover:bg-red-50 font-medium transition">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>

                <!-- Comments -->
                <div class="divide-y divide-gray-200">
                    @foreach ($forum->comments as $i => $comment)
                        <div class="flex items-start space-x-4 py-6">
                            <img src="{{ $comment->user->profile_photo ? asset('storage/' . $comment->user->profile_photo) : asset('storage/profile-photos/default-avatar.jpg') }}" class="w-10 h-10 rounded-full object-cover border border-gray-300 mt-1">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center space-x-2 mb-1">
                                    <span class="font-semibold text-gray-900">{{ $comment->user->name }}</span>
                                    <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                                    <span class="text-xs text-gray-300">#{{ $i+2 }}</span>
                                </div>
                                <div class="text-gray-800 whitespace-pre-line">{{ $comment->body }}</div>
                                <div class="flex items-center space-x-4 text-xs text-gray-400 mt-2">
                                    <span>{{ $comment->created_at->format('d M Y') }}</span>
                                    <button type="button" class="flex items-center cursor-pointer hover:text-blue-500 reply-btn" data-comment-id="{{ $comment->id }}">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 15l7-7 7 7"/></svg>Reply
                                    </button>
                                    <span class="flex items-center cursor-pointer hover:text-pink-500"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>Like</span>
                                    @auth
                                        @if(auth()->user()->role === 'admin')
                                            <div class="relative inline-block text-left ml-1">
                                                <button type="button" class="flex items-center justify-center w-7 h-7 rounded-full hover:bg-gray-200 focus:outline-none" id="comment-menu-btn-{{ $comment->id }}" aria-expanded="true" aria-haspopup="true" onclick="toggleDropdown('comment-menu-dropdown-{{ $comment->id }}')">
                                                    <span class="sr-only">Open options</span>
                                                    <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="4" cy="10" r="2"/><circle cx="10" cy="10" r="2"/><circle cx="16" cy="10" r="2"/></svg>
                                                </button>
                                                <div id="comment-menu-dropdown-{{ $comment->id }}" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5 z-20 transition-all">
                                                    <ul class="py-2 flex flex-col gap-1">
                                                        <li>
                                                            <a href="{{ route('comments.edit', $comment) }}" class="block px-5 py-2 text-base text-gray-800 hover:bg-gray-100 hover:text-blue-700 font-medium transition">Edit</a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Delete this comment?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="w-full text-left px-5 py-2 text-base text-red-600 hover:bg-gray-100 font-medium transition">Delete</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                                <!-- Reply form (hidden by default) -->
                                <form action="{{ route('comments.store') }}" method="POST" class="reply-form mt-4 hidden" data-parent-id="{{ $comment->id }}">
                                    @csrf
                                    <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <textarea name="body" rows="2" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Reply to this comment..." required></textarea>
                                    <div class="flex justify-end mt-2">
                                        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Post Reply</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Comment Form -->
                @auth
                    <form action="{{ route('comments.store') }}" method="POST" class="mt-8">
                        @csrf
                        <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                        <textarea name="body" rows="3" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-green-600" placeholder="Add a comment..." required></textarea>
                        <button type="submit" class="mt-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Post Comment</button>
                    </form>
                @else
                    <p class="text-gray-600 mt-8">Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">login</a> to add a comment.</p>
                @endauth
            </div>

            <!-- Timeline Scrollbar -->
            <div class="hidden md:flex flex-col items-center w-32 pt-10 relative">
                <div class="absolute left-1/2 -translate-x-1/2 top-0 h-full w-1 bg-blue-100 rounded"></div>
                <div class="z-10 bg-white border border-blue-200 rounded px-3 py-2 shadow text-center mb-4">
                    <div class="text-xs text-gray-400">{{ $forum->created_at->format('M Y') }}</div>
                    <div class="font-bold text-lg">1 / {{ $forum->comments->count() + 1 }}</div>
                    <div class="text-xs text-gray-400">{{ $forum->created_at->format('M Y') }}</div>
                </div>
                <div class="flex-1"></div>
                <div class="text-xs text-gray-400 absolute bottom-0 left-1/2 -translate-x-1/2">{{ $forum->comments->last()?->created_at->format('M Y') ?? $forum->created_at->format('M Y') }}</div>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script>
    function toggleDropdown(id) {
        document.querySelectorAll('.origin-top-right').forEach(el => {
            if (el.id !== id) el.classList.add('hidden');
        });
        const dropdown = document.getElementById(id);
        if (dropdown) dropdown.classList.toggle('hidden');
    }
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.relative.inline-block.text-left')) {
            document.querySelectorAll('.origin-top-right').forEach(el => el.classList.add('hidden'));
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.reply-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const commentId = this.getAttribute('data-comment-id');
                document.querySelectorAll('.reply-form').forEach(f => f.classList.add('hidden'));
                const form = document.querySelector('.reply-form[data-parent-id="' + commentId + '"]');
                if (form) form.classList.toggle('hidden');
            });
        });
    });
    </script>
@endsection
