@extends('layouts.app')
@section('content')
@include('layouts.header')
<div class="flex min-h-screen bg-gray-50">
    @include('admin.layouts.sidebar')
    <main class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Tambah Materi Edukasi</h1>
        @if ($errors->any())
        <div class="mb-6 bg-red-100 text-red-700 p-4 rounded-lg">
            <strong>Ada kesalahan:</strong>
            <ul class="mt-2 list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('admin.edukasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-semibold mb-2">Judul</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('title') border-red-500 @enderror"
                    required>
                @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="typeSelect" class="block text-gray-700 font-semibold mb-2">Jenis Materi</label>
                <select name="type" id="typeSelect"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('type') border-red-500 @enderror"
                    required>
                    <option value=""> -- Pilih Jenis -- </option>
                    <option value="article" {{ old('type')=='article' ? 'selected' : '' }}>Artikel</option>
                    <option value="video" {{ old('type')=='video' ? 'selected' : '' }}>Video</option>
                </select>
                @error('type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4" id="contentField">
                <label for="content" class="block text-gray-700 font-semibold mb-2">Isi Artikel / Video</label>
                <textarea name="content" id="content" rows="6"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('content') border-red-500 @enderror"
                    placeholder="Tulis artikel di sini...">{{ old('content') }}</textarea>
                @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4" id="urlField" style="display: {{ old('type') === 'video' ? 'block' : 'none' }};">
                <label for="url" class="block text-gray-700 font-semibold mb-2">URL Video</label>
                <input type="url" name="url" id="url" value="{{ old('url') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('url') border-red-500 @enderror">
                @error('url')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="thumbnail" class="block text-gray-700 font-semibold mb-2">Gambar Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('thumbnail') border-red-500 @enderror">
                @error('thumbnail')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-6 flex space-x-3">
                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">Simpan
                    Materi</button>
                <a href="{{ route('admin.edukasi.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg transition duration-200 inline-block">Batal</a>
            </div>
        </form>
    </main>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('typeSelect');
        const contentField = document.getElementById('contentField');
        const urlField = document.getElementById('urlField');
        if (select && contentField && urlField) {
            select.addEventListener('change', function () {
                const val = this.value;
                urlField.style.display = val === 'video' ? 'block' : 'none';
            });
        }
    });
</script>
@endsection