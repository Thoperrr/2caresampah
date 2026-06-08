@extends('layouts.app')

@section('content')
    @include('layouts.header')

    <div class="flex justify-center bg-gray-50 min-h-screen">
        <div class="w-full max-w-2xl p-8">
            <div class="border-b border-gray-200 pb-8 mb-8">
                <h1 class="text-3xl font-extrabold mb-6 leading-tight">Create New Topic</h1>
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>- {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('forum.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="title" class="block font-semibold mb-2 text-lg">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg bg-gray-50"
                            placeholder="Enter a descriptive title..." />
                    </div>
                    <div>
                        <label for="body" class="block font-semibold mb-2 text-lg">Body</label>
                        <textarea name="body" id="body" rows="8" required
                            class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-base bg-gray-50"
                            placeholder="What do you want to discuss? Be detailed!">{{ old('body') }}</textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                            Create Topic
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.footer')
@endsection
