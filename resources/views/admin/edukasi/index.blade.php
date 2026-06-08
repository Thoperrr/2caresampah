@extends('layouts.app')

@section('content')
    @include('layouts.header')

    <div class="flex min-h-screen bg-gray-50">
        <!-- Sidebar Admin -->
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <main class="container mx-auto p-6">
            <h1 class="text-2xl font-bold mb-6">Kelola Materi Edukasi</h1>

            <!-- Tampilkan Notifikasi Sukses -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 text-green-700 p-4 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Search Bar -->
            <div class="mb-6 flex items-center space-x-2">
                <input type="text" id="searchInput" placeholder="Cari materi..."
                    class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500"
                    oninput="search()" />
                <button onclick="search()" type="button"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition-colors duration-200">
                    Cari
                </button>
            </div>

            <!-- Tabel Daftar Materi -->
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 border-b text-left">Judul</th>
                        <th class="px-6 py-3 border-b text-left">Jenis</th>
                        <th class="px-6 py-3 border-b text-left">Utama</th>
                        <th class="px-6 py-3 border-b text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody id="materialsTableBody">
                    @forelse($materials as $material)
                        <tr data-searchable data-section="{{ $material->type }}"
                            class="border-b hover:bg-gray-100 transition-colors duration-150">
                            <td class="px-6 py-4">{{ $material->title }}</td>
                            <td class="px-6 py-4">{{ ucfirst($material->type) }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.edukasi.toggleFeatured', $material) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="text-sm {{ $material->is_featured ? 'text-yellow-500' : 'text-gray-500' }}">
                                        {{ $material->is_featured ? 'Ya' : 'Tidak' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 flex space-x-3">
                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.edukasi.edit', $material) }}"
                                    class="text-blue-500 hover:text-blue-700 font-medium">
                                    Edit
                                </a>

                                <!-- Form Hapus -->
                                <form action="{{ route('admin.edukasi.destroy', $material) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada materi ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Tombol Tambah Materi -->
            <div class="mt-8">
                <a href="{{ route('admin.edukasi.create') }}"
                    class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded transition duration-200 inline-block">
                    Tambah Materi
                </a>
            </div>
        </main>
    </div>

    <!-- Script Pencarian Dinamis -->
    <script>
        function search() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#materialsTableBody tr[data-searchable]');

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        }
    </script>
@endsection